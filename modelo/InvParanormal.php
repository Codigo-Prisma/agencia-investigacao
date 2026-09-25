<?php

require_once('Investigador.php');

class InvParanormal extends Investigador{

    public function __construct($nm, $custo){
        parent::__construct($nm, $custo);
    }

}