<?php


class cidades {
    private $cid_sequencial = '';
    private $est_sequencial = '';
    private $cid_cep = '';
    private $cid_nome = '';
    
    function getCid_sequencial() {
        return $this->cid_sequencial;
    }

    function getEst_sequencial() {
        return $this->est_sequencial;
    }

    function getCid_cep() {
        return $this->cid_cep;
    }

    function getCid_nome() {
        return $this->cid_nome;
    }

    function setCid_sequencial($cid_sequencial) {
        $this->cid_sequencial = $cid_sequencial;
    }

    function setEst_sequencial($est_sequencial) {
        $this->est_sequencial = $est_sequencial;
    }

    function setCid_cep($cid_cep) {
        $this->cid_cep = $cid_cep;
    }

    function setCid_nome($cid_nome) {
        $this->cid_nome = $cid_nome;
    }


    
}
