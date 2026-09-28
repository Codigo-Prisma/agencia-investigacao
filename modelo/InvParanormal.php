<?php

require_once('Investigador.php');
require_once('Caso.php');

class InvParanormal extends Investigador{

    public function __construct($nm){
        parent::__construct($nm);
    }

    public function ColetarEvidencias(Caso $caso) {
        $comodo = $caso->getLocal()->getComodos()[$this->getComodoDesignado()];
        $EvidenciasParanormais = [];

        foreach($caso->getEntidade()->getEviPossiveis() as $evidencia) {
            if ($evidencia[1] == 2) {
                $EvidenciasParanormais[] = $evidencia;
            }
        }

        $achar = rand(1,100);

        if ($achar <= 50 && !empty($EvidenciasParanormais)) {
            $evidenciaColetada = $EvidenciasParanormais[array_rand($EvidenciasParanormais)];
            escritaLenta("\n" . $this->getNome() . " coletou a evidência: " . $evidenciaColetada[0] . ".\n", 10);
            return $evidenciaColetada;
        } else {
            escritaLenta("\n" . $this->getNome() . " não encontrou nenhuma evidência no cômodo " . $comodo . ".\n", 10);
            return null;
        }
    }
}