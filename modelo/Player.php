<?php

class Player {
    private string $nome;
    private int $tipo;

    public function __construct($nm,$tip)
    {
        $this->nome = $nm;
        $this->tipo = $tip;
    }
}
