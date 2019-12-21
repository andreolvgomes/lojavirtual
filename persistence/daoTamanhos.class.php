<?php

include_once '../persistence/daoTamanhos.class.php';
require_once '../persistence/connection.class.php';
require_once '../model/tamanhos.class.php';

class DaoTamanhos {

    function insert(Tamanhos $tamanhos) {
        $sql = "insert into tamanhos(Pro_codigo,Tam_quantidade,Tam_tamanho) values (:Pro_codigo,:Tam_quantidade,:Tam_tamanho)";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Pro_codigo", $tamanhos->getPro_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":Tam_quantidade", $tamanhos->getTam_quantidade(), PDO::PARAM_STR);
        $stmt->bindValue(":Tam_tamanho", $tamanhos->getTam_tamanho(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    function update(Tamanhos $tamanho) {
        $sql = "update tamanhos set pro_codigo = :pro_codigo, tam_quantidade = :tam_quantidade , tam_tamanho = :tam_tamanho   where "
                . "Tam_codigo = :Tam_codigo";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":pro_codigo", $tamanho->getPro_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":tam_quantidade", $tamanho->getTam_quantidade(), PDO::PARAM_STR);
        $stmt->bindValue(":tam_tamanho", $tamanho->getTam_tamanho(), PDO::PARAM_STR);
        $stmt->bindValue(":Tam_codigo", $tamanho->getTam_codigo(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    function delete($tam_codigo) {
        $sql = "delete from tamanhos where Tam_codigo = :Tam_codigo";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Tam_codigo", $tam_codigo, PDO::PARAM_INT);

        return $stmt->execute();
    }

    function select($tam_codigo = "") {

        $sql = "select * from tamanhos";
        if ($tam_codigo != "") {
            $sql = "select * from tamanhos where tam_codigo = '$tam_codigo' ";
        }
        foreach (Connection::connect()->query($sql) as $record) {
            $tamanhos = new Tamanhos();
            $tamanhos->setTam_codigo($record['Tam_codigo']);
            $tamanhos->setPro_codigo($record['Pro_codigo']);
            $tamanhos->setTam_quantidade($record['Tam_quantidade']);
            $tamanhos->setTam_tamanho($record['Tam_tamanho']);
            $list_tamanhos[] = $tamanhos;
        }
        return $list_tamanhos;
    }

    function getCount() {
        $sql = "select count(tam_codigo) from tamanhos";
        $stmt = Connection::connect()->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return 0;
    }

}