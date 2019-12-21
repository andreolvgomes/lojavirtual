<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once 'persistence/daoProdutos.class.php';

$dao_produtos = new DaoProdutos();
$produto_detalhes = new Produtos();
$first_image = '';
$images = array();

if ($_GET) {
    if (isset($_GET['pro_codigo'])) {
        $produto_detalhes = $dao_produtos->select($_GET['pro_codigo'])[0];
        $date = date("Y-m-d H:i:s");
        $produto_detalhes->setPro_datahora_ultima_visualizacao($date);
        $dao_produtos->update($produto_detalhes);

        $images = explode(';', $produto_detalhes->getPro_imagens());
        $first_image = $images[0];
    }
}

$mais_vendido_da_categoria = mais_vendido_by_categoria($produto_detalhes->getCat_codigo());
$mais_visto_da_categoria = mais_visto_recente_by_categoria($produto_detalhes->getCat_codigo());

$mais_vendido_da_categoria_count = count($mais_vendido_da_categoria);
$mais_visto_da_categoria_count = count($mais_visto_da_categoria);
?>

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
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <?php if ($mais_vendido_da_categoria_count > 0): ?>
                        <h2 class="sidebar-title">Mais Vendido</h2>
                        <ul>
                            <?php
                            foreach ($mais_vendido_da_categoria as $produto):
                                $image = explode(';', $produto['Pro_imagens'])[0];
                                ?>
                                <li><a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><?= $produto['Pro_descricao']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <br><br>
                    <?php endif; ?>
                    <?php if ($mais_visto_da_categoria_count > 0): ?>
                        <h2 class="sidebar-title">Mais Procurado</h2>
                        <ul>
                            <?php
                            foreach ($mais_visto_da_categoria as $produto):
                                $image = explode(';', $produto['Pro_imagens'])[0];
                                ?>
                                <li><a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><?= $produto['Pro_descricao']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img src="<?= $first_image; ?>" alt="">
                                </div>

                                <div class="product-gallery">
                                    <?php foreach ($images as $path): ?>
                                        <img src="<?= $path; ?>" alt="">
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <?php if ($produto_detalhes->getPro_estoque() <= 0) { ?>
                                    <div class="alert alert-dismissable alert-danger">
                                        Indisponível
                                    </div>
                                <?php } ?>

                                <h2 class="product-name"><?= $produto_detalhes->getPro_descricao(); ?></h2>
                                <div class="product-inner-price">
                                    <ins><?= format_decimal_simbolo($produto_detalhes->getPro_pvenda()); ?></ins> <del><?= format_decimal_simbolo($produto_detalhes->getPro_pvendatabela()); ?></del>
                                </div>    

                                <div class="cart">
                                    <div class="quantity">
                                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" id="quantity" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button" onclick="add_item()" type="submit">Add Carrinho</button>
                                </div>
                                <br>
                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Descrição</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Rever</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <p><?= $produto_detalhes->getPro_detalhes(); ?></p>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>                    
            </div>

            <br>

            <div class="related-products-wrapper">
                <h2 class="related-products-title">Produtos Relacionados</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="latest-product">
                                <div class="product-carousel">
                                    <?php
                                    $produtos = $dao_produtos->buscaProdutosByCategoria($produto_detalhes->getCat_codigo());
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

<script>
    function add_item() {
        quantity = document.getElementById('quantity').value;
        //alert(quantity);
        add_carrinho(quantity, <?= $produto_detalhes->getPro_codigo(); ?>);
    }
</script>

<?php include 'includes/footer.php'; ?>