<?php

class Aluno {
    private int $id;
    private string $nome;
    private int $idturma;


    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getIdturma(): int
    {
        return $this->idturma;
    }

    public function setIdturma(int $idturma): void
    {
        $this->idturma = $idturma;
    }
}
