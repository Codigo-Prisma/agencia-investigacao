<?php

require_once('Investigador.php');
require_once('Caso.php');

class InvCampo extends Investigador{

    public function __construct($nm){
        parent::__construct($nm);
    }

    public function ColetarEvidencias(Caso $caso) {
        $comodo = $caso->getLocal()->getComodos()[$this->getComodoDesignado()];
        $EvidenciasCampo = [];

        foreach($caso->getEntidade()->getEviPossiveis() as $evidencia) {
            if ($evidencia[1] == 1) {
                $EvidenciasCampo[] = $evidencia;
            }
        }

        $achar = rand(1,100);

        if ($achar <= 50 && !empty($EvidenciasCampo)) {
            $evidenciaColetada = $EvidenciasCampo[array_rand($EvidenciasCampo)];
            escritaLenta("\n" . $this->getNome() . " coletou a evidência: " . $evidenciaColetada[0] . ".\n", 10);
            return $evidenciaColetada;
        } else {
            escritaLenta("\n" . $this->getNome() . " não encontrou nenhuma evidência no cômodo " . $comodo . ".\n", 10);
            return null;
        }
    }
}