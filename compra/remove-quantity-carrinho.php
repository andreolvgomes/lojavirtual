<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

require_once BASEURL . 'persistence/daoCarrinho.class.php';
require_once BASEURL . 'persistence/daoItensCarrinho.class.php';
require_once BASEURL . 'persistence/daoProdutos.class.php';

$dao_carrinho = new DaoCarrinho();
$dao_itens_carrinho = new DaoItensCarrinho();
$dao_produtos = new DaoProdutos();

$ite_nritem = $_GET['ite_nritem'];
$is_add = false;
$quantity = 1;

if (isset($_GET['add'])) {
    $is_add = true;
} else if (isset($_GET['remove'])) {
    $is_add = false;
}

$item = $dao_itens_carrinho->select($ite_nritem, $car_codigo)[0];
$produto = $dao_produtos->select($item->getPro_codigo())[0];
$carrinho = $dao_carrinho->select($car_codigo)[0];

$disponivel = 1;

if ($is_add) {
    $pro_codigo = $_POST['pro_codigo'];
    $query = Connection::select("select Pro_estoque from produtos where Pro_codigo = '$pro_codigo'")[0];
    $pro_estoque = $query['Pro_estoque'];

    if ($produto->getPro_estoque() <= 0) {
        $disponivel = 0;
    } else {
        $carrinho->setCar_total($carrinho->getCar_total() + ($quantity * $item->getIte_pvcompra()));
        $carrinho->setCar_qtitens($carrinho->getCar_qtitens() + $quantity);

        $item->setIte_quantidade($item->getIte_quantidade() + $quantity);
        $produto->setPro_estoque($produto->getPro_estoque() - $quantity);
        $dao_produtos->update($produto);
    }
} else {
    $carrinho->setCar_total($carrinho->getCar_total() - ($quantity * $item->getIte_pvcompra()));
    $carrinho->setCar_qtitens($carrinho->getCar_qtitens() - $quantity);

    $item->setIte_quantidade($item->getIte_quantidade() - $quantity);
    $produto->setPro_estoque($produto->getPro_estoque() + $quantity);
    $dao_produtos->update($produto);
}
if ($item->getIte_quantidade() <= 0) {
    header('Location: remove-item-carrinho.php?ite_nritem=' . $ite_nritem);
} else {
    if ($disponivel == 1) {
        $dao_itens_carrinho->update($item);
        $dao_carrinho->update($carrinho);
    }
    header('Location: ../carrinho.php?disponivel=' . $disponivel);
}
?>