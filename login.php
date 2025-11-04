<?php
session_start();
require_once __DIR__ . '/app/model/Usuario.php';
require_once __DIR__ . '/app/controller/UsuarioController.php';

// Recebe POST
$usuario = new Usuario();
$usuario->setEmail(isset($_POST['email']) ? trim($_POST['email']) : '');
$usuario->setSenha(isset($_POST['senha']) ? $_POST['senha'] : '');

try {
    if (empty($usuario->getEmail()) || empty($usuario->getSenha())) {
        throw new Exception('Preencha todos os campos');
    }

        $usuarioController = new UsuarioController();
        $user = $usuarioController->login($usuario);
        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['idusuario'],
                'email' => $user['email'],
                'tipo' => $user['tipo']
            ];
        }else{
            $_SESSION['login_error'] = 'E‑mail ou senha inválidos.';
            header('Location: index.php');
            exit;
        }

        // Redirecionar para área do usuário / admin
        if ($_SESSION['user']['tipo'] === 'administrador') {
            header('Location: app/view/admin/home_admin.html');
        } elseif ($_SESSION['user']['tipo'] === 'aluno') {
            header('Location: app/view/usuario/home.html');
        }
        exit;

} catch (Exception $e) {
    error_log('Login error: ' . $e->getMessage());
    $_SESSION['login_error'] = 'Erro no processo de login. Tente novamente.';
    header('Location: index.php');
    exit;
}