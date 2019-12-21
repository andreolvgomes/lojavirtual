<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once BASEURL . 'persistence/daoProdutos.class.php';
require_once BASEURL . 'persistence/daoItensCarrinho.class.php';

$dao_produtos = new DaoProdutos();
$dao_itens_carrinho = new DaoItensCarrinho();

$pedidos = $dao_carrinho->buscaPedidos($usu_codigo);
$dao_itens_carrinho = new DaoItensCarrinho();
$car_codigo_detalhes = $_GET['Car_codigo'];
$carrinho = $dao_carrinho->select($car_codigo_detalhes)[0];
$vl_frete = 25.00;
?>

<style>

    .cart_totals1 {
        /*float: right;*/
        margin-bottom: 50px;
        /*width: 40%;*/
    }
    .cart_totals1 table {
        border-bottom: 1px solid #ddd;
        border-right: 1px solid #ddd;
        width: 100%;
    }
    .cart_totals1 table th, .cart_totals1 table td {
        border-left: 1px solid #ddd;
        border-top: 1px solid #ddd;
        padding: 10px;
    }
    .cart_totals1 table th {
        background: none repeat scroll 0 0 #f4f4f4;
    }
</style>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Detalhes</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="cart_totals1">
    <!--        <table class="myTable myTable-highlight-all">-->
            <table>
                <thead>
                <th style="height: 50px"></th> <th>Produto</th> <th>Preço</th> <th>Qt</th> <th>Total</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($dao_itens_carrinho->selectItensCarrinho($car_codigo_detalhes) as $item) :
                        $produto = $dao_produtos->select($item->getPro_codigo())[0];
                        $image = explode(';', $produto->getPro_imagens())[0];
                        ?>
                        <tr class="cart_item">
                            <td class="product-thumbnail">
                                <a href="detalhes.php?pro_codigo=<?= $produto->getPro_codigo(); ?>"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="<?= $image; ?>"></a>
                            </td>
                            <td class="product-name">
                                <a href="detalhes.php?pro_codigo=<?= $produto->getPro_codigo(); ?>"><?= $produto->getPro_descricao(); ?></a> 
                            </td>
                            <td class="product-price">
                                <span class="amount"><?= format_decimal_simbolo($item->getIte_pvcompra()); ?></span> 
                            </td>
                            <td class="product-quantity">
                                <div class="quantity buttons_added">
                                    <label size="4" value="1" min="0" step="1"><?= $item->getIte_quantidade(); ?></label>
                                </div>
                            </td>
                            <td class="product-subtotal">
                                <span class="amount"><?= format_decimal_simbolo($item->getIte_pvcompra() * $item->getIte_quantidade()); ?></span> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>

        <div class="cart-collaterals">
            <div class="cart_totals">
                <h2>Total da Compra</h2>
                <table cellspacing="0">
                    <tbody>
                        <tr class="cart-subtotal">
                            <th>Total Produtos</th>
                            <td><span class="amount"><?= format_decimal_simbolo($carrinho->getCar_total()); ?></span></td>
                        </tr>
                        <tr class="shipping">
                            <th>Frete</th>
                            <td><?= format_decimal_simbolo($vl_frete); ?></td>
                        </tr>
                        <tr class="order-total">
                            <th>Total</th>
                            <td><strong><span class="amount"><?= format_decimal_simbolo($carrinho->getCar_total() + $vl_frete); ?></span></strong> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>