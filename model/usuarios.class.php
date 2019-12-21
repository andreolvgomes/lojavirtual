<?php

class Usuarios {

    private $usu_codigo = '';
    private $usu_nomecompleto = '';
    private $usu_email = '';
    private $usu_senha = '';
    private $usu_observarcao = '';
    private $usu_tipo = '';
    private $usu_permicao = '';
    private $usu_rua='';
    private $usu_numero ='';
    private $usu_bairro ='';
    private $usu_cep = '';
    private $cid_sequencial = '';
    private $est_sequencial = '';
    private $usu_celular= '';
    private $usu_telefone= '';
    
    function getCid_sequencial() {
        return $this->cid_sequencial;
    }

    function getEst_sequencial() {
        return $this->est_sequencial;
    }

    function setCid_sequencial($cid_sequencial) {
        $this->cid_sequencial = $cid_sequencial;
    }

    function setEst_sequencial($est_sequencial) {
        $this->est_sequencial = $est_sequencial;
    }

        
    function getUsu_rua() {
        return $this->usu_rua;
    }

    function getUsu_numero() {
        return $this->usu_numero;
    }

    function getUsu_bairro() {
        return $this->usu_bairro;
    }

    function getUsu_cep() {
        return $this->usu_cep;
    }


    function getUsu_celular() {
        return $this->usu_celular;
    }

    function getUsu_telefone() {
        return $this->usu_telefone;
    }

    function setUsu_rua($usu_rua) {
        $this->usu_rua = $usu_rua;
    }

    function setUsu_numero($usu_numero) {
        $this->usu_numero = $usu_numero;
    }

    function setUsu_bairro($usu_bairro) {
        $this->usu_bairro = $usu_bairro;
    }

    function setUsu_cep($usu_cep) {
        $this->usu_cep = $usu_cep;
    }


    function setUsu_celular($usu_celular) {
        $this->usu_celular = $usu_celular;
    }

    function setUsu_telefone($usu_telefone) {
        $this->usu_telefone = $usu_telefone;
    }

        function getUsu_permicao() {
        return $this->usu_permicao;
    }

    function setUsu_permicao($usu_permicao) {
        $this->usu_permicao = $usu_permicao;
    }

        
    function getUsu_tipo() {
        return $this->usu_tipo;
    }

    function setUsu_tipo($usu_tipo) {
        $this->usu_tipo = $usu_tipo;
    }

        function getUsu_codigo() {
        return $this->usu_codigo;
    }

    function getUsu_nomecompleto() {
        return $this->usu_nomecompleto;
    }

    function getUsu_email() {
        return $this->usu_email;
    }

    function getUsu_senha() {
        return $this->usu_senha;
    }

    function getUsu_observarcao() {
        return $this->usu_observarcao;
    }

    function setUsu_codigo($usu_codigo) {
        $this->usu_codigo = $usu_codigo;
    }

    function setUsu_nomecompleto($usu_nomecompleto) {
        $this->usu_nomecompleto = $usu_nomecompleto;
    }

    function setUsu_email($usu_email) {
        $this->usu_email = $usu_email;
    }

    function setUsu_senha($usu_senha) {
        $this->usu_senha = $usu_senha;
    }

    function setUsu_observarcao($usu_observarcao) {
        $this->usu_observarcao = $usu_observarcao;
    }


}
