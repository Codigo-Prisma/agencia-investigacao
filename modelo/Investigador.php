<?php

class Investigador {
    protected string $nome;
    protected int $comodoDesignado;

    public function __construct($nm)
    {
        $this->nome = $nm;
        $this->comodoDesignado = -1;

    }

    public function resetarComodoDesignado(): void
    {
        $this->comodoDesignado = -1;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }



    public function getComodoDesignado(): int
    {
        return $this->comodoDesignado;
    }
    public function setComodoDesignado(int $comodoDesignado): self
    {
        $this->comodoDesignado = $comodoDesignado;

        return $this;
    }
}
