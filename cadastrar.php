<?php
session_start();
require_once __DIR__ . '/app/config/dbconection.php'; // use o mesmo caminho do login.php
require_once __DIR__ . '/app/model/Aluno.php';
require_once __DIR__ . '/app/model/Turma.php';
require_once __DIR__ . '/app/model/Usuario.php';
require_once __DIR__ . '/app/controller/AlunoController.php';
require_once __DIR__ . '/app/controller/TurmaController.php';
require_once __DIR__ . '/app/controller/UsuarioController.php';

$aluno = new Aluno();
$usuario = new Usuario();
$turma = new Turma();

$aluno->setNome(isset($_POST['nome']) ? trim($_POST['nome']) : '');

$usuario->setEmail(isset($_POST['email']) ? trim($_POST['email']) : '');
$usuario->setSenha(isset($_POST['senha']) ? $_POST['senha'] : '');
$usuario->setTipo('aluno');

$turma->setCurso(isset($_POST['curso']) ? trim($_POST['curso']) : '');
$turma->setPeriodo(isset($_POST['periodo']) ? (int)$_POST['periodo'] : 0);


if (empty($aluno->getNome()) || empty($usuario->getEmail()) || empty($usuario->getSenha()) || empty($turma->getPeriodo())) {
    $_SESSION['login_error'] = 'Preencha nome, e-mail, senha e período.';
    header('Location: app/view/usuario/cadastrarView.php');
    exit;
}

try {
    $db = new Database();
    $pdo = $db->getConnection();

    // verifica email existente
    $stmt = $pdo->prepare('SELECT idusuario FROM usuario WHERE email = ? LIMIT 1');
    $stmt->execute([$usuario->getEmail()]);
    if ($stmt->fetch()) {
        $_SESSION['login_error'] = 'E‑mail já cadastrado.';
        header('Location: app/view/usuario/cadastrarView.php');
        exit;
    }else{
        $turmaController = new TurmaController();
        $idturma = $turmaController->getTurma($turma);
        $aluno->setIdturma($idturma);
        $alunoController = new AlunoController();
        $resp = $alunoController->cadastrar($aluno);
        if ($resp) {
            $idaluno = $alunoController->getAluno($aluno);
            $usuario->setIdaluno($idaluno);
            $usuarioController = new UsuarioController();
            $resp2 = $usuarioController->cadastrar($usuario);
        }
        if (!$resp || !$resp2) {
            throw new Exception('Erro ao cadastrar usuário.');
        }
        
    }

    $_SESSION['login_success'] = 'Cadastro realizado com sucesso. Faça login.';
    header('Location: index.php');
    exit;
} catch (Exception $e) {
    error_log('Cadastro error: ' . $e->getMessage());
    $_SESSION['login_error'] = 'Erro no cadastro. Tente novamente.';
    header('Location: app/view/usuario/cadastrarView.php');
    exit;
}