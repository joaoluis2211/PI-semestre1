<?php

class Turma {
    private int $id;
    private int $periodo;
    private string $curso;


    public function getId(): int
    {
        return $this->id;
    }

    public function getPeriodo(): int
    {
        return $this->periodo;
    }

    public function setPeriodo(int $periodo): void
    {
        $this->periodo = $periodo;
    }
    
    public function setCurso(string $curso): void
    {
        $this->curso = $curso;
    }

    public function getCurso(): string
    {
        return $this->curso;
    }
}