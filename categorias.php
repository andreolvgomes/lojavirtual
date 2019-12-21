<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once 'persistence/daoProdutos.class.php';
require_once 'persistence/daoCategorias.class.php';

$dao_produtos = new DaoProdutos();
$dao_categorias = new DaoCategorias();

$categoria = new Categorias();
$descricao_top = 'Não há Produtos nesta Categoria';
if ($_GET) {
    if (isset($_GET['cat_codigo'])) {
        $categoria = $dao_categorias->select($_GET['cat_codigo'])[0];
    }
}
$produtos = $dao_produtos->produtosCategoria($categoria->getCat_codigo());

if (count($produtos) > 0) {
    $root = $dao_categorias->rootToParent($categoria->getCat_parent());
    $descricao_top = $root->getCat_descricao() . ' / ' . $categoria->getCat_descricao();
}
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2><?= $descricao_top; ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php
            foreach ($produtos as $produto):
                $image = explode(';', $produto->getPro_imagens())[0];
                ?>
                <div class="col-md-3 col-sm-6" style="height: 500px">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <?php if ($produto->getPro_estoque() <= 0) { ?>
                                <div class="alert alert-dismissable alert-danger">
                                    Indisponível
                                </div>
                            <?php } ?>
                            <img src="<?= $image; ?>" alt="">
                        </div>
                        <h2><a href="detalhes.php?pro_codigo=<?= $produto->getPro_codigo(); ?>"><?= $produto->getPro_descricao(); ?></a></h2>
                        <div class="product-carousel-price">
                            <ins><?= format_decimal_simbolo($produto->getPro_pvendatabela()); ?></ins> / <del><?= format_decimal_simbolo($produto->getPro_pvenda()); ?></del>
                        </div>  

                        <div class="product-option-shop">
                            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" onclick="add_carrinho(1, <?= $produto->getPro_codigo(); ?>)">Adicionar ao Carrinho</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!--        <div class="row">
                    <div class="col-md-12">
                        <div class="product-pagination text-center">
                            <nav>
                                <ul class="pagination">
                                    <li>
                                        <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li>
                                        <a href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>                        
                        </div>
                    </div>
                </div>-->
    </div>
</div>

<?php include 'includes/footer.php'; ?>