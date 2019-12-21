<?php

class Tamanhos {

    private $tam_codigo = '';
    private $pro_codigo = '';
    private $tam_quantidade = '';
    private $tam_tamanho = '';

    function getTam_quantidade() {
        return $this->tam_quantidade;
    }

    function setTam_quantidade($tam_quantidade) {
        $this->tam_quantidade = $tam_quantidade;
    }

    function getTam_codigo() {
        return $this->tam_codigo;
    }

    function getPro_codigo() {
        return $this->pro_codigo;
    }

    function getTam_tamanho() {
        return $this->tam_tamanho;
    }

    function setTam_codigo($tam_codigo) {
        $this->tam_codigo = $tam_codigo;
    }

    function setPro_codigo($pro_codigo) {
        $this->pro_codigo = $pro_codigo;
    }

    function setTam_tamanho($tam_tamanho) {
        $this->tam_tamanho = $tam_tamanho;
    }

}
