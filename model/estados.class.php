<?php


class estados {
    private $est_sequencial = '';
    private $est_nome = '';
    private $est_sigla = '';
    
    function getEst_sequencial() {
        return $this->est_sequencial;
    }

    function getEst_nome() {
        return $this->est_nome;
    }

    function getEst_sigla() {
        return $this->est_sigla;
    }

    function setEst_sequencial($est_sequencial) {
        $this->est_sequencial = $est_sequencial;
    }

    function setEst_nome($est_nome) {
        $this->est_nome = $est_nome;
    }

    function setEst_sigla($est_sigla) {
        $this->est_sigla = $est_sigla;
    }


    
}
