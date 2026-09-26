<?php

class Contrato {
    private float $custo;
    private Investigador $investigador;

    public function __construct(float $custo, Investigador $investigador)
    {
        $this->custo = $custo;
        $this->investigador = $investigador;
    }

    
    public function getNome(){
        return $this->investigador->getNome();
    }

    /**
     * Get the value of custo
     */
    public function getCusto(): float
    {
        return $this->custo;
    }

    /**
     * Set the value of custo
     */
    public function setCusto(float $custo): self
    {
        $this->custo = $custo;

        return $this;
    }

    /**
     * Get the value of investigador
     */
    public function getInvestigador(): Investigador
    {
        return $this->investigador;
    }

    /**
     * Set the value of investigador
     */
    public function setInvestigador(Investigador $investigador): self
    {
        $this->investigador = $investigador;

        return $this;
    }
    
}