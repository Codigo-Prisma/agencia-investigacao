<?php

require_once('Investigador.php');

class Player{
    private string $nome;
    private Investigador $tipo;

    public function __construct($nm,$tip)
    {
        $this->nome = $nm;
        $this->tipo = $tip;
    }
}
