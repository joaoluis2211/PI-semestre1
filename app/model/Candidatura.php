<?php

class Candidatura{
    private int $id;
    private string $dataInicio;
    private string $dataFim;
    private Turma $turma;
    private string $curso;

    public function __construct(string $dataInicio, string $dataFim, Turma $turma, string $curso)
    {
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->turma = $turma;
        $this->curso = $curso;
    }
}