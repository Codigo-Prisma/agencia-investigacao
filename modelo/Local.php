<?php

class Local {
    private string $nome;
    private string $desc;
    private int $dificuldade;
    private array $comodos;

    public function __construct($nm, $desc, $dif, $comodos = [])
    {
        $this->nome = $nm;
        $this->desc = $desc;
        $this->dificuldade = $dif;
        $this->comodos = $comodos;
    }

    public function __toString()
    {
        $msg = "";
        foreach($this->comodos as $i=>$valor){
            $msg .= "Comodo " . ($i+1) . ": " . $valor->getNome() . "\n";
        }
        return $msg;
    }
    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getDesc(): string
    {
        return $this->desc;
    }

    public function setDesc(string $desc): void
    {
        $this->desc = $desc;
    }

    public function getDificuldade(): int
    {
        return $this->dificuldade;
    }

    public function setDificuldade(int $dificuldade): void
    {
        $this->dificuldade = $dificuldade;
    }

    public function getComodos(): array
    {
        return $this->comodos;
    }

    public function setComodos(array $comodos): void
    {
        $this->comodos = $comodos;
    }
}
