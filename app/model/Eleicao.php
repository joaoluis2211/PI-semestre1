<?php

class Eleicao{
    private int $ideleicao;
    private string $dataInicioCandidatura;
    private string $dataFimCandidatura;
    private string $dataInicioVotacao;
    private string $dataFimVotacao;
    private int $idturma;
    private string $status;

    public function getIdeleicao(): int
    {
        return $this->ideleicao;
    }

    public function getDataInicioCandidatura(): string
    {
        return $this->dataInicioCandidatura;
    }

    public function setDataInicioCandidatura(string $dataInicioCandidatura): void
    {
        $this->dataInicioCandidatura = $dataInicioCandidatura;
    }

    public function getDataFimCandidatura(): string
    {
        return $this->dataFimCandidatura;
    }

    public function setDataFimCandidatura(string $dataFimCandidatura): void
    {
        $this->dataFimCandidatura = $dataFimCandidatura;
    }


    public function getDataInicioVotacao(): string
    {
        return $this->dataInicioVotacao;
    }

    public function setDataInicioVotacao(string $dataInicioVotacao): void
    {
        $this->dataInicioVotacao = $dataInicioVotacao;
    }

    public function getDataFimVotacao(): string
    {
        return $this->dataFimVotacao;
    }

    public function setDataFimVotacao(string $dataFimVotacao): void
    {
        $this->dataFimVotacao = $dataFimVotacao;
    }

    public function getIdturma(): int
    {
        return $this->idturma;
    }

    public function setIdturma(int $idturma): void
    {
        $this->idturma = $idturma;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}