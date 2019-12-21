<?php

class Carrinho {

    private $car_codigo = 0;
    private $car_statuspgto = 0;
    private $car_total = 0;
    private $car_qtitens = 0;
    private $car_compraefetuada = 0;
    private $usu_codigo = 0;
    private $car_datahora_checkout;
    private $car_status_andamento = 0;
    private $car_datahora_abertura;
    private $car_datahora_ultima_modificacao;

    function getCar_codigo() {
        return $this->car_codigo;
    }

    function getCar_statuspgto() {
        return $this->car_statuspgto;
    }

    function setCar_codigo($car_codigo) {
        $this->car_codigo = $car_codigo;
    }

    function setCar_statuspgto($car_statuspgto) {
        $this->car_statuspgto = $car_statuspgto;
    }

    function getCar_total() {
        return $this->car_total;
    }

    function setCar_total($car_total) {
        $this->car_total = $car_total;
    }

    function getCar_qtitens() {
        return $this->car_qtitens;
    }

    function setCar_qtitens($car_qtitens) {
        $this->car_qtitens = $car_qtitens;
    }

    function getCar_compraefetuada() {
        return $this->car_compraefetuada;
    }

    function setCar_compraefetuada($car_compraefetuada) {
        $this->car_compraefetuada = $car_compraefetuada;
    }

    function getUsu_codigo() {
        return $this->usu_codigo;
    }

    function setUsu_codigo($usu_codigo) {
        $this->usu_codigo = $usu_codigo;
    }

    function getCar_datahora_checkout() {
        return $this->car_datahora_checkout;
    }

    function setCar_datahora_checkout($car_datahora_checkout) {
        $this->car_datahora_checkout = $car_datahora_checkout;
    }

    function getCar_status_andamento() {
        return $this->car_status_andamento;
    }

    function setCar_status_andamento($car_status_andamento) {
        $this->car_status_andamento = $car_status_andamento;
    }

    function getCar_datahora_abertura() {
        return $this->car_datahora_abertura;
    }

    function setCar_datahora_abertura($car_datahora_abertura) {
        $this->car_datahora_abertura = $car_datahora_abertura;
    }
    function getCar_datahora_ultima_modificacao() {
        return $this->car_datahora_ultima_modificacao;
    }

    function setCar_datahora_ultima_modificacao($car_datahora_ultima_modificacao) {
        $this->car_datahora_ultima_modificacao = $car_datahora_ultima_modificacao;
    }


}
