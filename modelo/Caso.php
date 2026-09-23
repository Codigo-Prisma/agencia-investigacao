<?php

require_once('Entidade.php');

class Caso {
    private int $cod;
    private string $local;
    private string $descricao;
    private float $recompensa;
    private int $tempoAtual;
    private int $tempoMax;
    private Entidade $entidade;
    
    public function getCod(): int
    {
        return $this->cod;
    }

    public function setCod(int $cod): self
    {
        $this->cod = $cod;

        return $this;
    }

    public function getLocal(): string
    {
        return $this->local;
    }

    public function setLocal(string $local): self
    {
        $this->local = $local;

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

    public function getRecompensa(): float
    {
        return $this->recompensa;
    }

    public function setRecompensa(float $recompensa): self
    {
        $this->recompensa = $recompensa;

        return $this;
    }

    public function getTempoAtual(): int
    {
        return $this->tempoAtual;
    }

    public function setTempoAtual(int $tempoAtual): self
    {
        $this->tempoAtual = $tempoAtual;

        return $this;
    }

    public function getTempoMax(): int
    {
        return $this->tempoMax;
    }

    public function setTempoMax(int $tempoMax): self
    {
        $this->tempoMax = $tempoMax;

        return $this;
    }

    public function getEntidade(): Entidade
    {
        return $this->entidade;
    }

    public function setEntidade(Entidade $entidade): self
    {
        $this->entidade = $entidade;

        return $this;
    }
}