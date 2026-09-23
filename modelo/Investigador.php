<?php

class Investigador {
    private string $nome;
    private float $custo;

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
}