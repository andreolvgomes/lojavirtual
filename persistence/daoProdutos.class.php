<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/persistence/daoProdutos.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/persistence/connection.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/model/produtos.class.php';

class DaoProdutos {

    function insert(Produtos $produto) {
        $sql = "insert into produtos(pro_descricao,pro_detalhes,pro_pvenda,pro_pvendatabela,"
                . "pro_imagens,mar_codigo,pro_destaque,cat_codigo, Pro_datahora_cadastro, Pro_estoque) values "
                . "(:pro_descricao,:pro_detalhes,:pro_pvenda,:pro_pvendatabela,:pro_imagens,"
                . ":mar_codigo,:pro_destaque,:cat_codigo, :Pro_datahora_cadastro, :Pro_estoque)";

        $date = date("Y-m-d H:i:s");

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":pro_descricao", $produto->getPro_descricao(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_detalhes", $produto->getPro_detalhes(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_pvenda", $produto->getPro_pvenda(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_pvendatabela", $produto->getPro_pvendatabela(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_imagens", $produto->getPro_imagens(), PDO::PARAM_STR);
        $stmt->bindValue(":mar_codigo", $produto->getMar_codigo(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_destaque", $produto->getPro_destaque(), PDO::PARAM_STR);
        $stmt->bindValue(":cat_codigo", $produto->getCat_codigo(), PDO::PARAM_STR);
        $stmt->bindValue(":Pro_datahora_cadastro", $date, PDO::PARAM_STR);
        $stmt->bindValue(":Pro_estoque", $produto->getPro_estoque(), PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update(Produtos $produto) {
        $sql = "update produtos set pro_descricao = :pro_descricao,pro_detalhes = :pro_detalhes,pro_pvenda = :pro_pvenda,"
                . "pro_pvendatabela = :pro_pvendatabela,pro_imagens = :pro_imagens,mar_codigo = :mar_codigo,pro_destaque = :pro_destaque,"
                . "cat_codigo = :cat_codigo, Pro_datahora_ultima_visualizacao = :Pro_datahora_ultima_visualizacao, Pro_estoque = :Pro_estoque "
                . " where pro_codigo = :pro_codigo";

        $stmt = Connection::connect()->prepare($sql);

        $stmt->bindValue(":pro_descricao", $produto->getPro_descricao(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_detalhes", $produto->getPro_detalhes(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_pvenda", $produto->getPro_pvenda(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_pvendatabela", $produto->getPro_pvendatabela(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_imagens", $produto->getPro_imagens(), PDO::PARAM_STR);
        $stmt->bindValue(":mar_codigo", $produto->getMar_codigo(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_destaque", $produto->getPro_destaque(), PDO::PARAM_STR);
        $stmt->bindValue(":cat_codigo", $produto->getCat_codigo(), PDO::PARAM_STR);
        $stmt->bindValue(":pro_codigo", $produto->getPro_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":Pro_datahora_ultima_visualizacao", $produto->getPro_datahora_ultima_visualizacao(), PDO::PARAM_STR);
        $stmt->bindValue(":Pro_estoque", $produto->getPro_estoque(), PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete($pro_codigo) {
        $sql = "delete from produtos where pro_codigo = :pro_codigo";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":pro_codigo", $pro_codigo, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function select($pro_codigo = "") {

        $sql = "select * from produtos";
        if ($pro_codigo != "") {
            $sql = "select * from produtos where pro_codigo = '$pro_codigo'";
        }
        $list_produto = [];
        foreach (Connection::connect()->query($sql) as $record) {
            $produto = new Produtos();
            $produto->setCat_codigo($record['Cat_codigo']);
            $produto->setMar_codigo($record['Mar_codigo']);
            $produto->setPro_codigo($record['Pro_codigo']);
            $produto->setPro_descricao($record['Pro_descricao']);
            $produto->setPro_destaque($record['Pro_destaque']);
            $produto->setPro_detalhes($record['Pro_detalhes']);
            $produto->setPro_imagens($record['Pro_imagens']);
            $produto->setPro_pvenda($record['Pro_pvenda']);
            $produto->setPro_pvendatabela($record['Pro_pvendatabela']);
            $produto->setPro_estoque($record['Pro_estoque']);
            $list_produto[] = $produto;
        }
        return $list_produto;
    }

    function produtosCategoria($cat_cidgo) {

        $sql = "select * from produtos where cat_codigo = '$cat_cidgo'";
        $list_produto = [];
        foreach (Connection::connect()->query($sql) as $record) {
            $produto = new Produtos();
            $produto->setCat_codigo($record['Cat_codigo']);
            $produto->setMar_codigo($record['Mar_codigo']);
            $produto->setPro_codigo($record['Pro_codigo']);
            $produto->setPro_descricao($record['Pro_descricao']);
            $produto->setPro_destaque($record['Pro_destaque']);
            $produto->setPro_detalhes($record['Pro_detalhes']);
            $produto->setPro_imagens($record['Pro_imagens']);
            $produto->setPro_pvenda($record['Pro_pvenda']);
            $produto->setPro_pvendatabela($record['Pro_pvendatabela']);
            $produto->setPro_estoque($record['Pro_estoque']);
            $list_produto[] = $produto;
        }
        return $list_produto;
    }

    function produtosCategoriaRoot($cat_codigo_root) {

        $sql = "select * from produtos where Cat_codigo in (select Cat_codigo from categorias where Cat_parent = '$cat_codigo_root')";
        $list_produto = [];
        foreach (Connection::connect()->query($sql) as $record) {
            $produto = new Produtos();
            $produto->setCat_codigo($record['Cat_codigo']);
            $produto->setMar_codigo($record['Mar_codigo']);
            $produto->setPro_codigo($record['Pro_codigo']);
            $produto->setPro_descricao($record['Pro_descricao']);
            $produto->setPro_destaque($record['Pro_destaque']);
            $produto->setPro_detalhes($record['Pro_detalhes']);
            $produto->setPro_imagens($record['Pro_imagens']);
            $produto->setPro_pvenda($record['Pro_pvenda']);
            $produto->setPro_pvendatabela($record['Pro_pvendatabela']);
            $produto->setPro_estoque($record['Pro_estoque']);
            $list_produto[] = $produto;
        }
        return $list_produto;
    }

    function getCount() {
        $sql = "select count(pro_codigo) from produtos";
        $stmt = Connection::connect()->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return false;
    }

    function buscaCategoriasRoot() {
        return Connection::select("SELECT Cat_codigo, Cat_descricao FROM categorias where cat_parent = 0");
    }

    function buscaProdutosCategoriaRoot($Cat_codigo) {
        return Connection::select("select * from produtos where Cat_codigo in (select Cat_codigo from categorias where cat_parent = '$Cat_codigo')");
    }

    function buscaProdutosByCategoria($Cat_codigo) {
        return Connection::select("select * from produtos where Cat_codigo = '$Cat_codigo'");
    }

    function buscaProdutosDeInteresse($car_codigo) {
        return Connection::select("select * from produtos "
                        . "where cat_codigo in (select DISTINCT produtos.cat_codigo from itenscarrinho inner join produtos on itenscarrinho.Pro_codigo = produtos.Pro_codigo where itenscarrinho.Ite_cancela = 0 and itenscarrinho.Car_codigo = '$car_codigo') "
                        . "order by produtos.Pro_pvenda");
    }

    function buscaResultado_ProdutosQueMaisVende() {
        return Connection::select("select marcas.Mar_descricao, result.quantidade_total, produtos.* from (select Pro_codigo, sum(ite_quantidade) as quantidade_total from itenscarrinho
               inner join carrinho on itenscarrinho.Car_codigo = carrinho.Car_codigo
where itenscarrinho.Ite_cancela = 0 and carrinho.Car_compraefetuada = 1
group by Pro_codigo) as result
inner join produtos on result.pro_codigo = produtos.Pro_codigo
inner join marcas on produtos.Mar_codigo = marcas.Mar_codigo
order by result.quantidade_total desc
limit 10");
    }

    function buscaResultado_ProdutosQueMenosVende() {
        if ($this->getCount() > 5) {
            $str_where = $this->getWhere();
            $sql = "select marcas.Mar_descricao, result.quantidade_total, produtos.* from (select Pro_codigo, sum(ite_quantidade) as quantidade_total from itenscarrinho
               inner join carrinho on itenscarrinho.Car_codigo = carrinho.Car_codigo
where itenscarrinho.Ite_cancela = 0 and carrinho.Car_compraefetuada = 1
group by Pro_codigo) as result
inner join produtos on result.pro_codigo = produtos.Pro_codigo
inner join marcas on produtos.Mar_codigo = marcas.Mar_codigo";

            if (strlen($str_where)) {
                $sql .= " where produtos.pro_codigo not in (";
                $sql .= $str_where;
                $sql .= ") ";
            }
            $sql .= " order by result.quantidade_total asc limit 10";
            return Connection::select($sql);
        }
        $result = [];
        return $result;
    }

    function getWhere() {
        $str = "";
        $exec = 0;
        foreach ($this->buscaResultado_ProdutosQueMaisVende() as $value) {
            if ($exec > 0)
                $str .= ", ";
            $str.= $value['Pro_codigo'];
            $exec++;
        }
        return $str;
    }

    function buscaResultado_ClientesQueMaisCompram() {
        
    }

    function produto_sendo_utilizado($pro_codigo) {
        return Connection::exists("select count(Pro_codigo) from produtos where Pro_codigo = '$pro_codigo'");
    }

    function AddPro_estoque($pro_codigo, $ite_quantidade){
        return Connection::execute("update produtos set Pro_estoque = Pro_estoque + '$ite_quantidade' where Pro_codigo = '$pro_codigo'");
    }
    
    function buscaResultadoProdutosEmFalta(){
        return Connection::select("select marcas.Mar_descricao, produtos.* from produtos"
                . " inner join marcas on produtos.Mar_codigo = marcas.Mar_codigo"
                . " where Pro_estoque <= 0");
    }
}
