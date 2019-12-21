<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

require_once BASEURL . 'persistence/daoItensCarrinho.class.php';
require_once BASEURL . 'persistence/connection.class.php';
require_once BASEURL . 'model/itensCarrinho.class.php';

class DaoItensCarrinho {

    function insert(ItensCarrinho $ItensCarrinho) {
        $sql = "insert into itenscarrinho(Car_codigo,Pro_codigo,Ite_quantidade,Ite_pvcompra,Tam_codigo) values "
                . "(:Car_codigo,:Pro_codigo,:Ite_quantidade,:Ite_pvcompra,:Tam_codigo)";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Car_codigo", $ItensCarrinho->getCar_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":Pro_codigo", $ItensCarrinho->getPro_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":Ite_quantidade", $ItensCarrinho->getIte_quantidade(), PDO::PARAM_INT);
        $stmt->bindValue(":Ite_pvcompra", $ItensCarrinho->getIte_pvcompra(), PDO::PARAM_INT);
        $stmt->bindValue("Tam_codigo", $ItensCarrinho->getTam_codigo(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update(ItensCarrinho $ItensCarrinho) {
        $sql = "update itenscarrinho set Pro_codigo = :Pro_codigo, Ite_quantidade = :Ite_quantidade,"
                . "Ite_pvcompra = :Ite_pvcompra, Tam_codigo = :Tam_codigo where Ite_nritem = :Ite_nritem and Car_codigo = :Car_codigo";

        $stmt = Connection::connect()->prepare($sql);
        
        $stmt->bindValue(":Pro_codigo", $ItensCarrinho->getPro_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":Ite_quantidade", $ItensCarrinho->getIte_quantidade(), PDO::PARAM_INT);
        $stmt->bindValue(":Ite_pvcompra", $ItensCarrinho->getIte_pvcompra(), PDO::PARAM_INT);
        $stmt->bindValue(":Tam_codigo", $ItensCarrinho->getTam_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":Ite_nritem", $ItensCarrinho->getIte_nritem(), PDO::PARAM_INT);
        $stmt->bindValue(":Car_codigo", $ItensCarrinho->getCar_codigo(), PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    function delete($ite_nritem, $car_codigo) {
        $sql = "delete from itenscarrinho where Ite_nritem = :Ite_nritem and Car_codigo = :Car_codigo";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Ite_nritem", $ite_nritem, PDO::PARAM_STR);
        $stmt->bindValue(":Car_codigo", $car_codigo, PDO::PARAM_STR);

        return $stmt->execute();
    }

    function cancela($ite_nritem, $car_codigo) {
        $sql = "update itenscarrinho set Ite_cancela = 1 where Ite_nritem = :Ite_nritem and Car_codigo = :Car_codigo";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Ite_nritem", $ite_nritem, PDO::PARAM_STR);
        $stmt->bindValue(":Car_codigo", $car_codigo, PDO::PARAM_STR);

        return $stmt->execute();
    }

    function select($ite_nritem = "", $car_codigo = "") {

        $sql = "select * from itenscarrinho";
        if ($car_codigo != "" && $ite_nritem != "") {
            $sql = "select * from itenscarrinho where car_codigo = '$car_codigo' and ite_nritem = '$ite_nritem' ";
        }
        $list_itenscarrinho = [];
        foreach (Connection::connect()->query($sql) as $record) {
            $itenscarrinho = new ItensCarrinho();
            $itenscarrinho->setCar_codigo($record['Car_codigo']);
            $itenscarrinho->setIte_nritem($record['Ite_nritem']);
            $itenscarrinho->setIte_pvcompra($record['Ite_pvcompra']);
            $itenscarrinho->setIte_quantidade($record['Ite_quantidade']);
            $itenscarrinho->setPro_codigo($record['Pro_codigo']);
            $itenscarrinho->setTam_codigo($record['Tam_codigo']);
            $itenscarrinho->setIte_cancela($record['Ite_cancela']);
            $list_itenscarrinho[] = $itenscarrinho;
        }
        return $list_itenscarrinho;
    }

    function selectItem($car_codigo = "", $pro_codigo = "") {

        $sql = "select * from itenscarrinho where car_codigo = '$car_codigo' and pro_codigo = '$pro_codigo' and Ite_cancela = 0";
        foreach (Connection::connect()->query($sql) as $record) {
            $itenscarrinho = new ItensCarrinho();
            $itenscarrinho->setCar_codigo($record['Car_codigo']);
            $itenscarrinho->setIte_nritem($record['Ite_nritem']);
            $itenscarrinho->setIte_pvcompra($record['Ite_pvcompra']);
            $itenscarrinho->setIte_quantidade($record['Ite_quantidade']);
            $itenscarrinho->setPro_codigo($record['Pro_codigo']);
            $itenscarrinho->setTam_codigo($record['Tam_codigo']);
            $itenscarrinho->setIte_cancela($record['Ite_cancela']);
            return $itenscarrinho;
        }
        return new ItensCarrinho();
    }

    function selectItensCarrinho($car_codigo) {

        $sql = "select * from itenscarrinho where car_codigo = '$car_codigo' and Ite_cancela = 0";
        $list_itenscarrinho = [];
        foreach (Connection::connect()->query($sql) as $record) {
            $itenscarrinho = new ItensCarrinho();
            $itenscarrinho->setCar_codigo($record['Car_codigo']);
            $itenscarrinho->setIte_nritem($record['Ite_nritem']);
            $itenscarrinho->setIte_pvcompra($record['Ite_pvcompra']);
            $itenscarrinho->setIte_quantidade($record['Ite_quantidade']);
            $itenscarrinho->setPro_codigo($record['Pro_codigo']);
            $itenscarrinho->setTam_codigo($record['Tam_codigo']);
            $list_itenscarrinho[] = $itenscarrinho;
        }
        return $list_itenscarrinho;
    }

}
