<?php

class Entidade {
    private string $nome;
    private string $descricao;
    private array $eviPossiveis;

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getEviPossiveis(): array
    {
        return $this->eviPossiveis;
    }

    public function setEviPossiveis(array $eviPossiveis): self
    {
        $this->eviPossiveis = $eviPossiveis;

        return $this;
    }
}