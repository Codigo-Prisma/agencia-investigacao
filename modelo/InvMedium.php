<?php

require_once('Investigador.php');

class InvMedium extends Investigador{

    public function __construct($nm){
        parent::__construct($nm);
    }

    public function ColetarEvidencias(Caso $caso) {
        $comodo = $caso->getLocal()->getComodos()[$this->getComodoDesignado()];
        $EvidenciasMedimum = [];

        foreach($caso->getEntidade()->getEviPossiveis() as $evidencia) {
            if ($evidencia[1] == 3) {
                $EvidenciasMedimum[] = $evidencia;
            }
        }

        $achar = rand(1,100);

        if ($achar <= 50 && !empty($EvidenciasMedimum)) {
            $evidenciaColetada = $EvidenciasMedimum[array_rand($EvidenciasMedimum)];
            escritaLenta("\n" . $this->getNome() . " coletou a evidência: " . $evidenciaColetada[0] . ".\n", 10);
            return $evidenciaColetada;
        } else {
            escritaLenta("\n" . $this->getNome() . " não encontrou nenhuma evidência no cômodo " . $comodo . ".\n", 10);
            return null;
        }
    }

}