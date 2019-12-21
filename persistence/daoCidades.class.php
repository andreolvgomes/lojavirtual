<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

require_once BASEURL . 'persistence/daoEstados.class.php';
require_once BASEURL . 'persistence/connection.class.php';
require_once BASEURL . 'model/cidades.class.php';

class daoCidades {

    function select($cid_sequencial = "") {
        $sql = "select * from cidades";
        if ($cid_sequencial != "") {
            $sql = "select * from cidades where cid_sequencial = '$cid_sequencial ' ";
        }
        foreach (Connection::connect()->query($sql) as $record) {
            $cidades = new cidades();
            $cidades->setCid_sequencial($record['cid_sequencial']);
            $cidades->setEst_sequencial($record['est_sequencial']);
            $cidades->setCid_nome($record['cid_nome']);
            $cidades->setCid_cep($record['cid_cep']);
            $list_cidades[] = $cidades;
        }
        return $list_cidades;
    }

    function selectCidadeEstados($est_sequencial = "") {


        $sql = "select * from cidades where est_sequencial = '$est_sequencial ' ";
        foreach (Connection::connect()->query($sql) as $record) {
            $cidades = new cidades();
            $cidades->setCid_sequencial($record['cid_sequencial']);
            $cidades->setEst_sequencial($record['est_sequencial']);
            $cidades->setCid_nome($record['cid_nome']);
            $cidades->setCid_cep($record['cid_cep']);
            $list_cidades[] = $cidades;
        }
        return $list_cidades;
    }

}
