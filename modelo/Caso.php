<?php

require_once('Entidade.php');
require_once('Local.php');

class Caso {
    private int $cod;
    
    private Local $local;
    private string $descricao;

    private float $orcamento;

    private int $dificuldadeGeral;

    private Entidade $entidade;

    public function __construct($cod, Local $local, $desc, $orcamento, Entidade $entidade)
    {
        $this->cod = $cod;
        $this->local = $local;
        $this->descricao = $desc;
        $this->orcamento = $orcamento;
        $this->entidade = $entidade;
        $this->dificuldadeGeral = $this->calcularDificuldadeGeral();
    }

    private function calcularDificuldadeGeral(): int
    {
        $dificuldadeLocal = $this->local->getDificuldade();
        $dificuldadeEntidade = $this->entidade->getAgressividade();

        // Fórmula que usa as duas dificuldades ao mesmo tempo.
        // Quando ambos valem 10, o resultado fica 100:
        // (10 * 10) + ((10 - 10) * (10 - 10) / 10) = 100
        return (($dificuldadeLocal * $dificuldadeEntidade) + (($dificuldadeLocal - $dificuldadeEntidade) * ($dificuldadeLocal - $dificuldadeEntidade) / 10));
    }
    public function __toString()
    {
        return "Caso: " . $this->cod . "\nLocal: " . $this->local->getNome() . "\nDescrição: " . $this->descricao . "\nOrçamento: " . $this->orcamento . "\n" . "Dificuldade Geral: " . $this->dificuldadeGeral;
    }
    
    public function getCod(): int
    {
        return $this->cod;
    }

    public function setCod(int $cod): self
    {
        $this->cod = $cod;

        return $this;
    }

    public function getLocal(): Local
    {
        return $this->local;
    }

    public function setLocal(Local $local): self
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

    public function getorcamento(): float
    {
        return $this->orcamento;
    }

    public function setorcamento(float $orcamento): self
    {
        $this->orcamento = $orcamento;

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