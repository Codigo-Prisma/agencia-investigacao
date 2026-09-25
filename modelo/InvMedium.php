<?php

require_once('Investigador.php');

class InvMedium extends Investigador{

    public function __construct($nm, $custo){
        parent::__construct($nm, $custo);
    }

}