<?php
require_once __DIR__ . '/../config/UsuarioDAO.php';
require_once __DIR__ . '/../model/Usuario.php';

class UsuarioController {
    private $usuarioDAO;
    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function cadastrar(Usuario $usuario){
        try {
            $this->usuarioDAO->cadastrarUsuario($usuario);
        } catch (Exception $e) {
            error_log("Erro ao cadastrar usuário: " . $e->getMessage());
        }
    }

    public function login(Usuario $usuario){
        try {
            $user = $this->usuarioDAO->iniciarSessao($usuario);
            if (!$user) {
                throw new Exception('Usuário não encontrado');
            }
            return $user;
        } catch (Exception $e) {
            error_log("Erro ao iniciar sessão: " . $e->getMessage());
        }
    }

    public function logout(Usuario $usuario){
        try {
            $this->usuarioDAO->fecharSessao($usuario);
        } catch (Exception $e) {
            error_log("Erro ao encerrar sessão: " . $e->getMessage());
        }
    }
}