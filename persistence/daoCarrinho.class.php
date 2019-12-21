<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

require_once BASEURL . 'persistence/daoCarrinho.class.php';
require_once BASEURL . 'persistence/connection.class.php';
require_once BASEURL . 'model/carrinho.class.php';

class DaoCarrinho {

    function insert(Carrinho $carrinho) {
        $date = date("Y-m-d H:i:s");
        $sql = "insert into carrinho(car_statuspgto, car_total, car_qtitens, Car_datahora_abertura) values (:Car_statuspgto, :car_total, :car_qtitens, :Car_datahora_abertura)";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Car_statuspgto", $carrinho->getCar_statuspgto(), PDO::PARAM_STR);
        $stmt->bindValue(":car_total", $carrinho->getCar_total(), PDO::PARAM_STR);
        $stmt->bindValue(":car_qtitens", $carrinho->getCar_qtitens(), PDO::PARAM_INT);
        $stmt->bindValue(":Car_datahora_abertura", $date, PDO::PARAM_STR);

        $stmt->execute();

        $id = Connection::connect()->lastInsertId();
        $carrinho->setCar_codigo($id);

        return $carrinho;
    }

    function update(Carrinho $carrinho) {
        $sql = "update carrinho set car_statuspgto = :Car_statuspgto, Car_total = :car_total"
                . ", Car_qtitens = :car_qtitens, Car_compraefetuada = :Car_compraefetuada"
                . ", Usu_codigo = :Usu_codigo, Car_datahora_checkout = :Car_datahora_checkout, Car_status_andamento = :Car_status_andamento"
                . " where car_codigo = :Car_codigo";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Car_statuspgto", $carrinho->getCar_statuspgto(), PDO::PARAM_INT);
        $stmt->bindValue(":car_total", utf8_decode($carrinho->getCar_total()), PDO::PARAM_STR);
        $stmt->bindValue(":car_qtitens", $carrinho->getCar_qtitens(), PDO::PARAM_INT);
        $stmt->bindValue(":Car_codigo", $carrinho->getCar_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":Car_compraefetuada", $carrinho->getCar_compraefetuada(), PDO::PARAM_INT);
        $stmt->bindValue(":Usu_codigo", $carrinho->getUsu_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":Car_datahora_checkout", $carrinho->getCar_datahora_checkout());
        $stmt->bindValue(":Car_status_andamento", $carrinho->getCar_status_andamento(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    function delete($car_codigo) {
        $sql = "delete from carrinho where car_codigo = :Car_codigo";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Car_codigo", $car_codigo, PDO::PARAM_INT);

        return $stmt->execute();
    }

    function select($car_codigo = "") {

        $sql = "select * from carrinho";
        if ($car_codigo > 0) {
            $sql = "select * from carrinho where car_codigo = '$car_codigo' ";
        }

        $list_carrinho = [];
        foreach (Connection::connect()->query($sql) as $record) {
            $carrinho = new Carrinho();

            $carrinho->setCar_codigo($record['Car_codigo']);
            $carrinho->setCar_total($record['Car_total']);
            $carrinho->setCar_qtitens($record['Car_qtitens']);
            $carrinho->setCar_statuspgto($record['Car_statuspgto']);
            $carrinho->setUsu_codigo($record['Usu_codigo']);
            $carrinho->setCar_status_andamento($record['Car_status_andamento']);
            $carrinho->setCar_compraefetuada($record['Car_compraefetuada']);
            
            $carrinho->setCar_datahora_abertura($record['Car_datahora_abertura']);
            $carrinho->setCar_datahora_checkout($record['Car_datahora_checkout']);
            $carrinho->setCar_datahora_ultima_modificacao($record['Car_datahora_ultima_modificacao']);
            $list_carrinho[] = $carrinho;
        }
        return $list_carrinho;
    }

    function buscaPedidos($usu_codigo) {
        $STH = Connection::prepare("select * from Carrinho where Car_compraefetuada = 1 and Usu_codigo = '$usu_codigo'");
        $STH->execute();
        return $STH->fetchAll();
    }

    function buscaClientesMaisCompra() {
        return Connection::select("select carrinho.Usu_codigo, count(carrinho.Usu_codigo) as quantidade_compras, usuarios.* "
                        . "from carrinho "
                        . "inner join usuarios on carrinho.Usu_codigo = usuarios.Usu_codigo where carrinho.Car_compraefetuada = 1 "
                        . "GROUP by carrinho.Usu_codigo "
                        . "limit 10");
    }

    function vendasAguardandoAprovacao($value_select) {
        return Connection::select("select usuarios.Usu_nomecompleto, CONCAT_WS('~', estados.est_nome, cidades.cid_nome) as destino, carrinho.* "
                        . "from carrinho "
                        . "inner join usuarios on carrinho.Usu_codigo = usuarios.Usu_codigo "
                        . "inner join cidades on usuarios.Cid_sequencial = cidades.cid_sequencial "
                        . "inner join estados on cidades.est_sequencial = estados.est_sequencial "
                        . "where carrinho.Car_compraefetuada = 1 and carrinho.Car_status_andamento = '$value_select'");
    }

    function vendasAguardandoAprovadas() {
        return Connection::select("select usuarios.Usu_nomecompleto, CONCAT_WS('~', estados.est_nome, cidades.cid_nome) as destino, carrinho.* "
                        . "from carrinho "
                        . "inner join usuarios on carrinho.Usu_codigo = usuarios.Usu_codigo "
                        . "inner join cidades on usuarios.Cid_sequencial = cidades.cid_sequencial "
                        . "inner join estados on cidades.est_sequencial = estados.est_sequencial "
                        . "where carrinho.Car_compraefetuada = 1 and carrinho.Car_status_andamento = 1");
    }

    function buscaCarrinho($car_codigo) {
        return Connection::select("select usuarios.Usu_nomecompleto, carrinho.* from carrinho
inner join usuarios on carrinho.Usu_codigo = usuarios.Usu_codigo where Car_codigo = '$car_codigo'")[0];
    }

    function buscaItensCarrinho($car_codigo){
        return Connection::select("select * from itenscarrinho where Car_codigo = '$car_codigo' and Ite_cancela = 0");
    }
    
    function vendasEncalhada(){
        return Connection::select("select * from carrinho where Car_desencalhado = 0 and Car_compraefetuada = 0");
    }
}
