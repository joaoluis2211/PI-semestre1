<?php
require_once __DIR__ . '/../config/TurmaDAO.php';
require_once __DIR__ . '/../model/Turma.php';

class TurmaController {
    private $turmaDAO;
    public function __construct() {
        $this->turmaDAO = new TurmaDAO();
    }
    
    public function cadastrar(Turma $turma){
        try {
            $this->turmaDAO->cadastrarTurma($turma);
        } catch (Exception $e) {
            error_log("Erro ao cadastrar turma: " . $e->getMessage());
        }
    }

    public function getTurma(Turma $turma){
        try {
            return $this->turmaDAO->localizarTurma($turma);
        } catch (Exception $e) {
            error_log("Erro ao buscar turma: " . $e->getMessage());
            return null;
        }
    }

}