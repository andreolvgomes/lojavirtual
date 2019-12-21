<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/persistence/daoCategorias.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/persistence/connection.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/model/categorias.class.php';

class DaoCategorias {

    function insert(Categorias $categorias) {

        $sql = "insert into categorias(Cat_descricao,Cat_parent) values (:Cat_descricao,:Cat_parent)";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Cat_descricao", $categorias->getCat_descricao(), PDO::PARAM_STR);
        $stmt->bindValue(":Cat_parent", $categorias->getCat_parent(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update(Categorias $categorias) {

        $sql = "update categorias set Cat_descricao = :Cat_descricao ,Cat_parent = :Cat_parent  where "
                . "Cat_codigo = :Cat_codigo";

        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Cat_parent", $categorias->getCat_parent(), PDO::PARAM_INT);
        $stmt->bindValue(":Cat_descricao", $categorias->getCat_descricao(), PDO::PARAM_INT);
        $stmt->bindValue(":Cat_codigo", $categorias->getCat_codigo(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete($cat_codigo, $delete_subcategorias = false) {

        $sql = "delete from categorias where cat_codigo = :Cat_codigo";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":Cat_codigo", $cat_codigo, PDO::PARAM_INT);
        if ($stmt->execute()) {

            if ($delete_subcategorias) {
                $sql = "delete from categorias where cat_parent = :Cat_codigo";
                $stmt = Connection::connect()->prepare($sql);
                $stmt->bindValue(":Cat_codigo", $cat_codigo, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    return true;
                }
            }
            return true;
        }
        return false;
    }

    function select($cat_codigo = "") {

        $sql = "select * from categorias";
        if ($cat_codigo != "") {
            $sql = "select * from categorias where cat_codigo = '$cat_codigo' ";
        }
        $list_categorias = [];
        foreach (Connection::connect()->query($sql) as $record) {
            $categoria = new Categorias();
            $categoria->setCat_codigo($record['Cat_codigo']);
            $categoria->setCat_descricao($record['Cat_descricao']);
            $categoria->setCat_parent($record['Cat_parent']);
            $list_categorias[] = $categoria;
        }
        return $list_categorias;
    }

    function selectRoot() {

        $sql = "select * from categorias where cat_parent = 0";
        $list_categorias = [];
        foreach (Connection::connect()->query($sql) as $record) {
            $categoria = new Categorias();
            $categoria->setCat_codigo($record['Cat_codigo']);
            $categoria->setCat_descricao($record['Cat_descricao']);
            $categoria->setCat_parent($record['Cat_parent']);
            $list_categorias[] = $categoria;
        }
        return $list_categorias;
    }

    function rootToParent($cat_parent) {

        $sql = "select * from categorias where cat_codigo = '$cat_parent'";
        foreach (Connection::connect()->query($sql) as $record) {
            $categoria = new Categorias();
            $categoria->setCat_codigo($record['Cat_codigo']);
            $categoria->setCat_descricao($record['Cat_descricao']);
            $categoria->setCat_parent($record['Cat_parent']);
            return $categoria;
        }
        return new Categorias();
    }

    function selectParent($cat_codigo) {

        $sql = "select * from categorias where cat_parent = '$cat_codigo'";
        $list_categorias = [];

        foreach (Connection::connect()->query($sql) as $record) {
            $categoria = new Categorias();
            $categoria->setCat_codigo($record['Cat_codigo']);
            $categoria->setCat_descricao($record['Cat_descricao']);
            $categoria->setCat_parent($record['Cat_parent']);
            $list_categorias[] = $categoria;
        }
        return $list_categorias;
    }

    function getCount() {
        $sql = "select count(cat_codigo) from categorias";
        $stmt = Connection::connect()->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return 0;
    }

    function getCountParent($cat_codigo) {

        $sql = "select count(cat_codigo) from categorias where cat_parent = '$cat_codigo'";
        $stmt = Connection::connect()->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return 0;
    }

    function existsUpdateExists(Categorias $categoria) {

        $sql = "select count(cat_codigo) from categorias where cat_codigo = :cat_codigo and cat_descricao = :cat_descricao";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":cat_codigo", $categoria->getCat_codigo(), PDO::PARAM_INT);
        $stmt->bindValue(":cat_descricao", $categoria->getCat_descricao(), PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchColumn() > 1;
        }
        return false;
    }

    function existsInsertExists(Categorias $categoria) {

        $sql = "select count(cat_codigo) from categorias where cat_descricao = :cat_descricao";
        $stmt = Connection::connect()->prepare($sql);
        $stmt->bindValue(":cat_descricao", $categoria->getCat_descricao(), PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return 0;
    }

    function buscaDescricaoCategoriaProduto($cat_codigo) {
        $result = Connection::select("select root.Cat_descricao as root, sub.Cat_descricao as sub from categorias as root
inner JOIN categorias as sub on root.Cat_codigo = sub.Cat_parent
where sub.Cat_codigo = '$cat_codigo'"
                . " limit 1");
        if(count($result) > 0){
            return $result[0]['root'] . '~' . $result[0]['sub'];
        }
        return "";
    }

    function categoria_sendo_utilizada($cat_codigo){
        if(Connection::exists("select count(Cat_codigo) from categorias where Cat_parent = '$cat_codigo'")){
            return Connection::exists("select count(Pro_codigo) from produtos where Cat_codigo in (select Cat_codigo from categorias where Cat_parent = '$cat_codigo')");
        }else{
            return Connection::exists("select count(Pro_codigo) from produtos where Cat_codigo = '$cat_codigo'");
        }
        return false;
    }
}
