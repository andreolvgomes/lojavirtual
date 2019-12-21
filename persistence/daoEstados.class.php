<?php

//include_once 'daoEstados.class.php';
//require_once 'connection.class.php';
//require_once '../model/estados.class.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

require_once BASEURL . 'persistence/daoEstados.class.php';
require_once BASEURL . 'persistence/connection.class.php';
require_once BASEURL . 'model/estados.class.php';

class DaoEstados {

    function select($est_sequencial = "") {
        $sql = "select * from estados";
        if ($est_sequencial != "") {
            $sql = "select * from estados where est_sequencial = '$est_sequencial' ";
        }
        foreach (Connection::connect()->query($sql) as $record) {
            $estados = new estados();
            $estados->setEst_sequencial($record['est_sequencial']);
            $estados->setEst_nome($record['est_nome']);
            $estados->setEst_sigla($record['est_sigla']);
            $list_estados[] = $estados;
            
        }
        return $list_estados;
    }

}
