<?php

class Investigador
{
    protected string $nome;
    protected int $comodoDesignado;
    protected int $courage;

    public function __construct($nm)
    {
        $this->nome = $nm;
        $this->comodoDesignado = -1;
        $this->courage = 100;
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

    public function getCourage(): int
    {
        return $this->courage;
    }

    public function alterarCourage(int $valor): void
    {
        $this->courage += $valor;

        if ($this->courage < 0) {
            $this->courage = 0;
        }

        if ($this->courage > 100) {
            $this->courage = 100;
        }
    }
}
