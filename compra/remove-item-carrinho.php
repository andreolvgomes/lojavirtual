<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

require_once BASEURL . 'persistence/daoCarrinho.class.php';
require_once BASEURL . 'persistence/daoItensCarrinho.class.php';
require_once BASEURL . 'persistence/daoProdutos.class.php';

$dao_carrinho = new DaoCarrinho();
$dao_itens_carrinho = new DaoItensCarrinho();
$dao_produtos = new DaoProdutos();

$ite_nritem = $_GET['ite_nritem'];
$item = $dao_itens_carrinho->select($ite_nritem, $car_codigo)[0];

if ($dao_itens_carrinho->cancela($ite_nritem, $car_codigo)) {
    $carrinho = $dao_carrinho->select($car_codigo)[0];
    $carrinho->setCar_total($carrinho->getCar_total() - ($item->getIte_quantidade() * $item->getIte_pvcompra()));
    $carrinho->setCar_qtitens($carrinho->getCar_qtitens() - $item->getIte_quantidade());
    $dao_carrinho->update($carrinho);

    $produto = $dao_produtos->select($item->getPro_codigo())[0];
    $produto->setPro_estoque($produto->getPro_estoque() + $item->getIte_quantidade());
    $dao_produtos->update($produto);
}
header('Location: ../carrinho.php');
?>