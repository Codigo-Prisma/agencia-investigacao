<?php

class Itens {
    private string $nome;
    private string $desc;
    private float $custo;
    private int $tipo;

    public function __construct($nm,$desc,$cus,$tipo)
    {
        $this->nome = $nm;
        $this->desc = $desc;
        $this->custo = $cus;
        $this->tipo = $tipo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function getCusto(): float
    {
        return $this->custo;
    }

    public function getTipo(): int
    {
        return $this->tipo;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }
    public function setDesc(string $desc): self
    {
        $this->desc = $desc;

        return $this;
    }
    public function setCusto(float $custo): self
    {
        $this->custo = $custo;

        return $this;
    }
    public function setTipo(int $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }
}