<?php

require_once '../helpers/init.php';
require_once BASEURL . 'persistence/daoCarrinho.class.php';
require_once BASEURL . 'persistence/daoProdutos.class.php';

if ($car_codigo > 0) {
    $dao_carrinho = new DaoCarrinho();
    $dao_produtos = new DaoProdutos();

    foreach ($dao_carrinho->buscaItensCarrinho($car_codigo) as $item) {
        $dao_produtos->AddPro_estoque($item['Pro_codigo'], $item['Ite_quantidade']);
    }
    Connection::execute("update carrinho set Car_desencalhado = 1 where Car_codigo = '$car_codigo'");
}

$car_codigo = 0;

$_SESSION['car_codigo'] = 0;
unset($_SESSION['car_codigo']);

$domain = (($_SERVER['HTTP_HOST'] != 'localhost') ? '.' . $_SERVER['HTTP_HOST'] : false);
setcookie(CART_COOKIE, $car_codigo, CART_COOKIE_EXPIRE, '/', $domain, false);

header('Location: ../index.php');
?>