<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';
require_once BASEURL . 'persistence/daoCarrinho.class.php';
require_once BASEURL . 'persistence/daoItensCarrinho.class.php';
require_once BASEURL . 'persistence/daoProdutos.class.php';

$dao_carrinho = new DaoCarrinho();
$dao_itens_carrinho = new DaoItensCarrinho();
$dao_produtos = new DaoProdutos();

$domain = (($_SERVER['HTTP_HOST'] != 'localhost') ? '.' . $_SERVER['HTTP_HOST'] : false);

$quantity = $_POST['quantity'];
$produto = $dao_produtos->select($_POST['pro_codigo'])[0];

$carrinho = new Carrinho();

if ($car_codigo > 0) {
    $carrinho = $dao_carrinho->select($car_codigo)[0];
    $carrinho->setCar_qtitens($carrinho->getCar_qtitens() + $quantity);
    $carrinho->setCar_total($carrinho->getCar_total() + ($produto->getPro_pvendatabela() * $quantity));
    $dao_carrinho->update($carrinho);

    setcookie(CART_COOKIE, '', 1, '/', $domain, false);
} else {
    $carrinho->setCar_total($produto->getPro_pvendatabela() * $quantity);
    $carrinho->setCar_qtitens($quantity);
    $carrinho = $dao_carrinho->insert($carrinho);
}
setcookie(CART_COOKIE, $carrinho->getCar_codigo(), CART_COOKIE_EXPIRE, '/', $domain, false);
set_carrinho($carrinho->getCar_codigo());

//$_SESSION['car_codigo'] = $carrinho->getCar_codigo();
/// add item
$item_carrinho = $dao_itens_carrinho->selectItem($car_codigo, $produto->getPro_codigo());
if ($item_carrinho->getIte_nritem() > 0) {
    $item_carrinho->setIte_quantidade($item_carrinho->getIte_quantidade() + $quantity);
    $dao_itens_carrinho->update($item_carrinho);
} else {
    $item_carrinho = new ItensCarrinho();
    $item_carrinho->setCar_codigo($carrinho->getCar_codigo());
    $item_carrinho->setPro_codigo($produto->getPro_codigo());
    $item_carrinho->setIte_quantidade($quantity);
    $item_carrinho->setIte_pvcompra($produto->getPro_pvendatabela());
    $item_carrinho->setTam_codigo(2424);
    $dao_itens_carrinho->insert($item_carrinho);
}
$produto->setPro_estoque($produto->getPro_estoque() - $quantity);
$dao_produtos->update($produto);
die(json_encode(array('car_qtitens' => $carrinho->getCar_qtitens(), 'car_total' => format_decimal_simbolo($carrinho->getCar_total()))));
//die(json_encode(array('items' => $total_items))); //output json 
//ob_start();
//echo ob_get_clean();
?>