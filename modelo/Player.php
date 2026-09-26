<?php

require_once('Investigador.php');

class Player{
    private string $nome;
    private InvCampo|InvParanormal|InvMedium $tipo;

    public function __construct($nm,$tip)
    {
        $this->nome = $nm;
        $this->tipo = $tip;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of tipo
     */
    public function getTipo(): InvCampo|InvParanormal|InvMedium
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     */
    public function setTipo(InvCampo|InvParanormal|InvMedium $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }


}
