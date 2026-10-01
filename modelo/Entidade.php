<?php

class Entidade {
    private string $nome;
    private string $descricao;
    private array $eviPossiveis;
    private int $agressividade;
    private array $sustos;
    private array $ataques;

    public function __construct($nm,$desc,$evPo,$agressividade, $sustos, $ataques)
    {
        $this->nome = $nm;
        $this->descricao = $desc;
        $this->eviPossiveis = $evPo;
        $this->agressividade = $agressividade;
        $this->sustos = $sustos;
        $this->ataques = $ataques;
    }

    public function __toString()
    {
        return "\n\n\nNome: " . $this->nome . "\n\nDescrição: " . $this->descricao . "\nEvidências Possíveis: " . $this->getEviPossiveisString() . "\nAgressividade: " . $this->agressividade;
    }

    public function getEviPossiveisString(): string
    {
        $msg = "";
        foreach($this->eviPossiveis as $i=>$valor){
            $msg .= " | " . $valor[0];
        }
        return $msg;
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

    public function getAgressividade(): int
    {
        return $this->agressividade;
    }

    public function setAgressividade(int $agressividade): self
    {
        $this->agressividade = $agressividade;

        return $this;
    }

    public function getSustos(): array
    {
        return $this->sustos;
    }

    public function setSustos(array $sustos): self
    {
        $this->sustos = $sustos;

        return $this;
    }

    public function getAtaques(): array
    {
        return $this->ataques;
    }

    public function setAtaques(array $ataques): self
    {
        $this->ataques = $ataques;

        return $this;
    }
}