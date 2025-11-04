<?php
require_once __DIR__ . '/dbconection.php';

class AlunoDAO{
    private $db;
    public function __construct() {
        $this->db = new Database();
    }
    
    public function cadastrarAluno(Aluno $aluno){
        try {
            $conn = $this->db->getConnection();
            $sql = "INSERT INTO aluno (nome, idturma) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$aluno->getNome(), $aluno->getIdturma()]);
            return true;
        } catch (\Throwable $th) {
            error_log('Cadastrar aluno error: ' . $th->getMessage());
            return false;
        }
        
    }

    public function procurarAluno(Aluno $aluno){
        try {
            $conn = $this->db->getConnection();
            $sql = "SELECT idaluno FROM aluno WHERE nome = ? AND idturma = ? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$aluno->getNome(), $aluno->getIdturma()]);
            $idaluno = $stmt->fetchColumn();
            return $idaluno;
        } catch (\Throwable $th) {
            error_log('Procurar aluno error: ' . $th->getMessage());
            return null;
        }
        
    }
}
?>