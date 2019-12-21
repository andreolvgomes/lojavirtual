<?php

class Pagamentos {

    private $pag_nrpgamento;
    private $car_codigo;
    private $Pag_forma;

    function getPag_nrpgamento() {
        return $this->pag_nrpgamento;
    }

    function getCar_codigo() {
        return $this->car_codigo;
    }

    function getPag_forma() {
        return $this->Pag_forma;
    }

    function setPag_nrpgamento($pag_nrpgamento) {
        $this->pag_nrpgamento = $pag_nrpgamento;
    }

    function setCar_codigo($car_codigo) {
        $this->car_codigo = $car_codigo;
    }

    function setPag_forma($Pag_forma) {
        $this->Pag_forma = $Pag_forma;
    }

}
