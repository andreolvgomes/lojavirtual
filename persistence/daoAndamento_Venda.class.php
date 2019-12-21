<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

require_once BASEURL . 'persistence/connection.class.php';
require_once BASEURL . 'model/andamento_venda.class.php';

class daoAndamento_Venda {

    function insert(Andamento_venda $andamento_venda) {

        $sql = "insert into andamento_venda (Car_codigo, And_detalhes, Est_sequencial, Cid_sequencial, And_datahora, And_codigo_anterior) "
                . "values (:Car_codigo, :And_detalhes, :Est_sequencial, :Cid_sequencial, :And_datahora, :And_codigo_anterior)";

        $date = date("Y-m-d H:i:s");
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Car_codigo", $andamento_venda->getCar_codigo(), PDO::PARAM_STR);
        $stmt->bindValue(":And_detalhes", $andamento_venda->getAnd_detalhes(), PDO::PARAM_STR);
        $stmt->bindValue(":Est_sequencial", $andamento_venda->getEst_sequencial(), PDO::PARAM_STR);
        $stmt->bindValue(":Cid_sequencial", $andamento_venda->getCid_sequencial(), PDO::PARAM_STR);
        $stmt->bindValue(":And_datahora", $date);
        $stmt->bindValue(":And_codigo_anterior", $andamento_venda->getAnd_codigo_anterior(), PDO::PARAM_STR);

        $stmt->execute();

        $id = Connection::connect()->lastInsertId();
        $andamento_venda->setAnd_codigo($id);

        return $andamento_venda;
    }

    function update(Andamento_venda $andamento_venda) {
        $sql = "update andamento_venda set Car_codigo = :Car_codigo, And_detalhes = :And_detalhes, Est_sequencial = :Est_sequencial, "
                . "Cid_sequencial = :Cid_sequencial, And_codigo_anterior = :And_codigo_anterior "
                . "where And_codigo = :And_codigo";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":And_codigo", $andamento_venda->getAnd_codigo(), PDO::PARAM_STR);
        $stmt->bindValue(":Car_codigo", $andamento_venda->getCar_codigo(), PDO::PARAM_STR);
        $stmt->bindValue(":And_detalhes", $andamento_venda->getAnd_detalhes(), PDO::PARAM_STR);
        $stmt->bindValue(":Est_sequencial", $andamento_venda->getEst_sequencial(), PDO::PARAM_STR);
        $stmt->bindValue(":Cid_sequencial", $andamento_venda->getCid_sequencial(), PDO::PARAM_STR);
//        $stmt->bindValue(":And_datahora", $date);
        $stmt->bindValue(":And_codigo_anterior", $andamento_venda->getAnd_codigo_anterior(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    function delete($and_codigo) {

        $sql = "delete from andamento_venda where And_codigo = :And_codigo";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":And_codigo", $and_codigo, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function select($end_codigo) {
        $sql = "select * from andamento_venda";
        if ($end_codigo > 0) {
            $sql = "select * from andamento_venda where And_codigo = '$end_codigo' ";
        }
        foreach (Connection::connect()->query($sql) as $record) {
            $andamento = new Andamento_venda();
            $andamento->setAnd_codigo($record['And_codigo']);
            $andamento->setCar_codigo($record['Car_codigo']);
            $andamento->setAnd_detalhes($record['And_detalhes']);
            $andamento->setEst_sequencial($record['Est_sequencial']);
            $andamento->setCid_sequencial($record['Cid_sequencial']);
            $andamento->setAnd_datahora($record['And_datahora']);
            $andamento->setAnd_codigo_anterior($record['And_codigo_anterior']);
            $list_andamento[] = $andamento;
        }
        return $list_andamento;
    }

    function buscaRapido($car_codigo) {
        return Connection::select("SELECT ant.and_detalhes as And_detalhes_ant, 
                atual.and_detalhes as And_detalhes_atual, atual.And_codigo, atual.And_datahora 
                FROM `andamento_venda` as ant
right join andamento_venda as atual on ant.and_codigo = atual.And_codigo_anterior
where atual.Car_codigo = '$car_codigo'");
    }

    function buscaLastAnd_codigo($car_codigo) {
        $result = Connection::select("select max(And_codigo) as r from andamento_venda where Car_codigo = '$car_codigo'");
        $and_codigo_last = 0;
        if (count($result) > 0)
            $and_codigo_last = $result[0]['r'];
        if ($and_codigo_last == null)
            return 0;
        return $and_codigo_last;
    }

}
