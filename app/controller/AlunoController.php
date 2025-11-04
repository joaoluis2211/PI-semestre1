<?php
require_once __DIR__ . '/../config/AlunoDAO.php';
require_once __DIR__ . '/../model/Aluno.php';

class AlunoController {
    private $alunoDAO;
    public function __construct() {
        $this->alunoDAO = new AlunoDAO();
    }

    public function cadastrar(Aluno $aluno){
        try {
            $this->alunoDAO->cadastrarAluno($aluno);
        } catch (Exception $e) {
            error_log("Erro ao cadastrar aluno: " . $e->getMessage());
        }
    }

    public function getAluno(Aluno $aluno){
        try {
            return $this->alunoDAO->procurarAluno($aluno);
        } catch (Exception $e) {
            error_log("Erro ao buscar aluno: " . $e->getMessage());
            return null;
        }
    }

}