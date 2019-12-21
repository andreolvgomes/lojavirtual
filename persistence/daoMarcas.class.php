<?php

include_once '../persistence/daoMarcas.class.php';
require_once '../persistence/connection.class.php';
require_once '../model/marcas.class.php';

class DaoMarcas {

    function insert(Marcas $marcas) {
        $sql = "insert into marcas(Mar_descricao) values (:Mar_descricao)";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Mar_descricao", $marcas->getMar_descricao(), PDO::PARAM_STR);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update(Marcas $marcas) {
        $sql = "update marcas set mar_descricao = :mar_descricao where "
                . "mar_codigo = :mar_codigo";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":mar_descricao", $marcas->getMar_descricao(), PDO::PARAM_INT);
        $stmt->bindValue(":mar_codigo", $marcas->getMar_codigo(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete($mar_codigo) {
        $sql = "delete from marcas where Mar_codigo = :Mar_codigo";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Mar_codigo", $mar_codigo, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function selectAll($from_record_num, $records_per_page) {
        return $this->selectMarcas("", $from_record_num, $records_per_page);
    }

    function select($mar_codigo = "") {

        $sql = "select * from marcas";
        if ($mar_codigo != "") {
            $sql = "select * from marcas where mar_codigo = '$mar_codigo' ";
        }
        foreach (Connection::connect()->query($sql) as $record) {
            $marca = new Marcas();
            $marca->setMar_codigo($record['Mar_codigo']);
            $marca->setMar_descricao($record['Mar_descricao']);
            $list_marcas[] = $marca;
        }
        return $list_marcas;
    }

    function existeByMar_descricao(Marcas $marca) {
        $sql = "select count(mar_descricao) from marcas where mar_descricao = :mar_descricao";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":mar_descricao", $marca->getMar_descricao(), PDO::PARAM_STR);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return false;
    }

    function existeByMar_codigo(Marcas $marca) {
        $sql = "select count(mar_descricao) from marcas where mar_descricao = :mar_descricao and mar_codigo <> :mar_codigo";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":mar_descricao", $marca->getMar_descricao(), PDO::PARAM_STR);
        $stmt->bindValue(":mar_codigo", $marca->getMar_codigo(), PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return false;
    }

//    function readAll($from_record_num, $records_per_page) {
//
//        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nm_pdo LIMIT {$from_record_num}, {$records_per_page}";
//
//        $stmt = $this->conn->prepare($query);
//        $stmt->execute();
//
//        return $stmt;
//    }

    function getCount() {
        $sql = "select count(mar_descricao) from marcas";
        $stmt = Connection::connect()->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return false;
    }

    function marca_utilizada($mar_codigo) {
        return Connection::exists("select count(mar_descricao) from marcas where Mar_codigo = '$mar_codigo'");
    }

}
