<?php

require_once('Investigador.php');
require_once('Caso.php');

class InvParanormal extends Investigador{

    public function __construct($nm){
        parent::__construct($nm);
    }

    public function ColetarEvidencias(Caso $caso) {
        if($this->comodoDesignado == -1){
            return null;
        }

        $comodo = $caso->getLocal()->getComodos()[$this->comodoDesignado];
        $EvidenciasParanormais = [];

        foreach($caso->getEntidade()->getEviPossiveis() as $evidencia) {
            if ($evidencia[1] == 2) {
                $EvidenciasParanormais[] = $evidencia;
            }
        }

        $achar = rand(1,100);

        if ($achar <= 50 && !empty($EvidenciasParanormais)) {
            $evidenciaColetada = $EvidenciasParanormais[array_rand($EvidenciasParanormais)];
            escritaLenta("\n" . $this->nome . " coletou a evidência: " . $evidenciaColetada[0] . ".\n", 10);
            return $evidenciaColetada;
        } else {
            escritaLenta("\n" . $this->nome . " não encontrou nenhuma evidência no cômodo " . $comodo . ".\n", 10);
            return null;
        }
    }
}