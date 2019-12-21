<?php

class ItensCarrinho {

    private $Ite_nritem;
    private $Car_codigo;
    private $Pro_codigo;
    private $Ite_quantidade;
    private $Ite_pvcompra;
    private $Tam_codigo;
    private $Ite_cancela = 0;

    function getIte_nritem() {
        return $this->Ite_nritem;
    }

    function getCar_codigo() {
        return $this->Car_codigo;
    }

    function getPro_codigo() {
        return $this->Pro_codigo;
    }

    function getIte_quantidade() {
        return $this->Ite_quantidade;
    }

    function getIte_pvcompra() {
        return $this->Ite_pvcompra;
    }

    function getTam_codigo() {
        return $this->Tam_codigo;
    }

    function setIte_nritem($Ite_nritem) {
        $this->Ite_nritem = $Ite_nritem;
    }

    function setCar_codigo($Car_codigo) {
        $this->Car_codigo = $Car_codigo;
    }

    function setPro_codigo($Pro_codigo) {
        $this->Pro_codigo = $Pro_codigo;
    }

    function setIte_quantidade($Ite_quantidade) {
        $this->Ite_quantidade = $Ite_quantidade;
    }

    function setIte_pvcompra($Ite_pvcompra) {
        $this->Ite_pvcompra = $Ite_pvcompra;
    }

    function setTam_codigo($Tam_codigo) {
        $this->Tam_codigo = $Tam_codigo;
    }
    function getIte_cancela() {
        return $this->Ite_cancela;
    }

    function setIte_cancela($Ite_cancela) {
        $this->Ite_cancela = $Ite_cancela;
    }


}
