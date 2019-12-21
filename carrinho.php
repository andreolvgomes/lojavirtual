<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once BASEURL . 'persistence/daoProdutos.class.php';
require_once BASEURL . 'persistence/daoItensCarrinho.class.php';

$disponivel = 1;
if ($_GET) {
    if (isset($_GET['disponivel'])) {
        $disponivel = $_GET['disponivel'];
    }
}
$dao_itens_carrinho = new DaoItensCarrinho();
$dao_produtos = new DaoProdutos();
$vl_frete = 25.00;
$produtos = $dao_produtos->select();
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Carrinho de Compra</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->

<?php if ($carrinho->getCar_qtitens() <= 0) { ?>
    <div class="container">
        <h1 class="text-center" style="font-size: 50px; margin-top: 60px; margin-bottom: 60px">-:) Carrinho vazio !!</h1>
    </div>
<?php } else { ?>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Postagens Recentes</h2>
                        <ul>
                            <?php
                            foreach (novos() as $produto):
                                $image = explode(';', $produto['Pro_imagens'])[0];
                                ?>
                                <li><a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><?= $produto['Pro_descricao']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart myTable-highlight-all">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">&nbsp;</th>

                                            <th class="product-name">Produto</th>
                                            <th class="product-price">Preço</th>
                                            <th class="product-quantity">Quantidade</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($dao_itens_carrinho->selectItensCarrinho($car_codigo) as $item) :
                                            $produto = $dao_produtos->select($item->getPro_codigo())[0];
                                            $image = explode(';', $produto->getPro_imagens())[0];
                                            ?>
                                            <tr class="cart_item">
                                                <td class="product-remove">
                                                    <a title="Remove this item" class="remove" href="compra/remove-item-carrinho.php?ite_nritem=<?= $item->getIte_nritem(); ?>">×</a> 
                                                </td>
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
                                                        <a class="minus" href="compra/remove-quantity-carrinho.php?remove=1&ite_nritem=<?= $item->getIte_nritem(); ?>"><span class="glyphicon glyphicon-minus"></span></a>
                                                        <label size="4" value="1" min="0" step="1"><?= $item->getIte_quantidade(); ?></label>
                                                        <!--<input type="number" size="4" class="input-text qty text" value="<?= $item->getIte_quantidade(); ?>" name="quantity" id="quantity" min="1" step="1">-->                                                        
                                                        <a class="minus" href="compra/remove-quantity-carrinho.php?add=1&ite_nritem=<?= $item->getIte_nritem(); ?>"><span class="glyphicon glyphicon-plus"></span></a>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal">
                                                    <span class="amount"><?= format_decimal_simbolo($item->getIte_pvcompra() * $item->getIte_quantidade()); ?></span> 
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </form>

                            <a class="btn btn-primary" href="helpers/trata-checkout.php"><span class="glyphicon glyphicon-plus"></span> Efetuar Compra</a>

                            <div class="cart-collaterals">
                                <div class="cart_totals">
                                    <h2 class="sidebar-title">Total do Carrinho</h2>
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
                </div>

                <div class="related-products-wrapper">
                    <h2 class="related-products-title">Produtos que você pode se interessar</h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="latest-product">
                                    <div class="product-carousel">
                                        <?php
                                        $produtos = $dao_produtos->buscaProdutosDeInteresse($car_codigo);
                                        foreach ($produtos as $produto):
                                            $image = explode(';', $produto['Pro_imagens'])[0];
                                            ?>
                                            <div class="single-product">
                                                <div class="product-f-image">
                                                    <img src="<?= $image; ?>" alt="">
                                                    <div class="product-hover">
                                                        <?php if ($produto['Pro_estoque'] > 0) { ?>
                                                            <a class="add-to-cart-link" onclick="add_carrinho(1, <?= $produto['Pro_codigo']; ?>)"><i class="fa fa-shopping-cart"></i> Add Carrinho</a>
                                                            <a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>" class="view-details-link"><i class="fa fa-link"></i> Detalhes</a>
                                                        <?php } else { ?>
                                                            <div class="alert alert-dismissable alert-danger">
                                                                Indisponível
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <h2><a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><?= $produto['Pro_descricao']; ?></a></h2>

                                                <div class="product-carousel-price">
                                                    <ins><?= format_decimal_simbolo($produto['Pro_pvendatabela']); ?></ins> / <del><?= format_decimal_simbolo($produto['Pro_pvenda']); ?></del>
                                                </div> 
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    function quantity_change() {
        var x = document.getElementById("#quantity").val();
        alert(x);
    }
    jQuery('document').ready(function () {
        valida_quantidade(<?= $disponivel; ?>);
    });

    function valida_quantidade(disponivel) {
        if (disponivel == 0) {
            swal("Produto esgotado em estoque !");
        }
    }
</script>
<?php include 'includes/footer.php'; ?>