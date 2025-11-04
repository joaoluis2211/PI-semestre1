<?php

class Usuario {
    private int $id;
    private string $email;
    private string $senha;
    private int $idaluno;
    private string $tipo;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getIdaluno(): int
    {
        return $this->idaluno;
    }
    public function setIdaluno(int $idaluno): void
    {
        $this->idaluno = $idaluno;
    }
}
