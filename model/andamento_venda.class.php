<?php

class Andamento_venda{
    private $and_codigo = 0;
    private $car_codigo = 0;
    private $and_detalhes = '';
    private $est_sequencial = 0;
    private $cid_sequencial = 0;
    private $and_datahora;
    private $and_codigo_anterior = 0;
    
    function getAnd_codigo() {
        return $this->and_codigo;
    }

    function getCar_codigo() {
        return $this->car_codigo;
    }

    function getAnd_detalhes() {
        return $this->and_detalhes;
    }

    function getEst_sequencial() {
        return $this->est_sequencial;
    }

    function getCid_sequencial() {
        return $this->cid_sequencial;
    }

    function getAnd_datahora() {
        return $this->and_datahora;
    }

    function getAnd_codigo_anterior() {
        return $this->and_codigo_anterior;
    }

    function setAnd_codigo($and_codigo) {
        $this->and_codigo = $and_codigo;
    }

    function setCar_codigo($car_codigo) {
        $this->car_codigo = $car_codigo;
    }

    function setAnd_detalhes($and_detalhes) {
        $this->and_detalhes = $and_detalhes;
    }

    function setEst_sequencial($est_sequencial) {
        $this->est_sequencial = $est_sequencial;
    }

    function setCid_sequencial($cid_sequencial) {
        $this->cid_sequencial = $cid_sequencial;
    }

    function setAnd_datahora($and_datahora) {
        $this->and_datahora = $and_datahora;
    }

    function setAnd_codigo_anterior($and_codigo_anterior) {
        $this->and_codigo_anterior = $and_codigo_anterior;
    }


}