<?php
require_once __DIR__ . '/../config/UsuarioDAO.php';
require_once __DIR__ . '/../controller/TurmaController.php';
require_once __DIR__ . '/../controller/AlunoController.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../model/Turma.php';
require_once __DIR__ . '/../model/Aluno.php';

class UsuarioController {
    private $usuarioDAO;
    private $usuario;
    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
        $this->usuario = new Usuario();
    }

    public function cadastrar(){
        try {
            $aluno = new Aluno();
            $turma = new Turma();

            $aluno->setNome(isset($_POST['nome']) ? trim($_POST['nome']) : '');

            $this->usuario->setEmail(isset($_POST['email']) ? trim($_POST['email']) : '');
            $this->usuario->setSenha(isset($_POST['senha']) ? $_POST['senha'] : '');
            $this->usuario->setTipo('aluno');

            $turma->setCurso(isset($_POST['curso']) ? trim($_POST['curso']) : '');
            $turma->setPeriodo(isset($_POST['periodo']) ? (int)$_POST['periodo'] : 0);

            if (empty($aluno->getNome()) || empty($this->usuario->getEmail()) || empty($this->usuario->getSenha()) || empty($turma->getPeriodo())) {
            $_SESSION['login_error'] = 'Preencha nome, e-mail, senha e período.';
            header('Location: app/view/usuario/cadastrarView.php');
            exit;
            }
            if ($this->usuarioDAO->verificarEmailExiste($this->usuario->getEmail())) {
                $_SESSION['login_error'] = 'E‑mail já cadastrado.';
                header('Location: app/view/usuario/cadastrarView.php');
                exit;
            }

            $turmaController = new TurmaController();
            $idturma = $turmaController->getIdTurma($turma);
            $aluno->setIdturma($idturma);
            $alunoController = new AlunoController();
            $alunoController->cadastrar($aluno);
            $idaluno = $alunoController->getIdAluno($aluno);
            $this->usuario->setIdaluno($idaluno);
            $this->usuarioDAO->cadastrarUsuario($this->usuario);
            $_SESSION['login_success'] = 'Cadastro realizado com sucesso. Faça login.';
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            error_log("Erro ao cadastrar usuário: " . $e->getMessage());
        }
    }

    public function login(){
        try {
            $this->usuario->setEmail(isset($_POST['email']) ? trim($_POST['email']) : '');
            $this->usuario->setSenha(isset($_POST['senha']) ? $_POST['senha'] : '');
            $user = $this->usuarioDAO->iniciarSessao($this->usuario->getEmail(), $this->usuario->getSenha());
            $_SESSION['user'] = $user;
            if (!$user) {
                $_SESSION['login_error'] = 'E‑mail ou senha inválidos.';
                header('Location: index.php');
                exit;
            }
            if ($_SESSION['user']->getTipo() === 'administrador') {
            header('Location: app/view/admin/home_admin.html');
            } elseif ($_SESSION['user']->getTipo() === 'aluno') {
            $aluno = $this->getAlunoUsuario($user);
            $turmaController = new TurmaController();
            $turma = new Turma();
            $turma = $turmaController->procurarTurma($aluno->getIdturma());
            $mes = date('m');
            $periodo = $turma->getPeriodo();
            if ($mes == 1 || $mes == 7 && $periodo <= 6 ) {
                $alunoController = new AlunoController();
                $alunoController->atualizarTurma($aluno, $periodo);
            }
            header('Location: app/view/usuario/home.html');
        }
            return $user;
        } catch (Exception $e) {
            echo "<script>console.log('Erro ao iniciar sessão: " . $e->getMessage() . "');</script>";
        }
    }

    public function logout(Usuario $usuario){
        try {
            $this->usuarioDAO->fecharSessao($usuario);
        } catch (Exception $e) {
            error_log("Erro ao encerrar sessão: " . $e->getMessage());
        }
    }

    public function getAlunoUsuario(Usuario $usuario){
        try {
            return $this->usuarioDAO->pegarAlunoUsuario($usuario);
        } catch (Exception $e) {
            error_log("Erro ao buscar aluno: " . $e->getMessage());
            return null;
        }
    }
}