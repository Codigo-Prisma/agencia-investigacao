<?php

class Investigador {
    private string $nome;
    private float $custo;
    private int $comodoDesignado;

    public function __construct($nm, $custo)
    {
        $this->nome = $nm;
        $this->custo = $custo;
        $this->comodoDesignado = 0;

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

    public function getCusto(): float
    {
        return $this->custo;
    }

    public function setCusto(float $custo): self
    {
        $this->custo = $custo;

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