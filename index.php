<?php
include 'includes/head.php';
include 'includes/navigation.php';
//include 'includes/slide.php';
include './slider/slider-bainer.php';

require_once 'persistence/daoProdutos.class.php';
$dao_produtos = new DaoProdutos();
$produtos = $dao_produtos->select();
?>

<!--<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Produtos em Destaque</h2>
                </div>
            </div>
        </div>
    </div>
</div>-->

<div class="maincontent-area" style="margin-top: 30px">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <?php
        $categorias_root = $dao_produtos->buscaCategoriasRoot();
        foreach ($categorias_root as $root):
            $produtos_cat = $dao_produtos->buscaProdutosCategoriaRoot($root['Cat_codigo']);
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title"><?= $root['Cat_descricao']; ?></h2>
                        <div class="product-carousel" style="margin-top: -50">                        
                            <?php
                            foreach ($produtos_cat as $produto):
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
        <?php endforeach; ?>

    </div>
</div> <!-- End main content area -->

<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <h2 class="section-title">Marcas com quais Trabalhamos</h2>
                    <div class="brand-list">
                        <img src="img/logo_apple.jpg" alt="">
                        <img src="img/logo_hp.jpg" alt="">
                        <img src="img/logo_lg.jpg" alt="">
                        <img src="img/logo_microsoft.jpg" alt="">
                        <img src="img/logo_samsung.jpg" alt="">
                        <img src="img/logo_cce.jpg" alt="">
                        <img src="img/logo_toshiba.jpg" alt="">
                        <img src="img/logo_dell.jpg" alt="">

                        <img src="img/services_logo__1.jpg" alt="">
                        <img src="img/services_logo__2.jpg" alt="">
                        <img src="img/services_logo__3.jpg" alt="">
                        <img src="img/services_logo__4.jpg" alt="">
                        <img src="img/services_logo__1.jpg" alt="">
                        <img src="img/services_logo__2.jpg" alt="">
                        <img src="img/services_logo__3.jpg" alt="">
                        <img src="img/services_logo__4.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top 5 Mais vendidos</h2>
                    <?php
                    foreach (mais_vendidos() as $produto):
                        $image = explode(';', $produto['Pro_imagens'])[0];
                        ?>
                        <div class="single-wid-product">
                            <a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><img src="<?= $image; ?>" alt="" class="product-thumb"></a>
                            <h2><a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><?= $produto['Pro_descricao']; ?></a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins><?= format_decimal_simbolo($produto['Pro_pvendatabela']); ?></ins> <del><?= format_decimal_simbolo($produto['Pro_pvenda']); ?></del>
                            </div>                            
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top 5 Vistos Recentemente</h2>
                    <?php
                    foreach (mais_visto_recente() as $produto):
                        $image = explode(';', $produto['Pro_imagens'])[0];
                        ?>
                        <div class="single-wid-product">
                            <a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><img src="<?= $image; ?>" alt="" class="product-thumb"></a>
                            <h2><a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><?= $produto['Pro_descricao']; ?></a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins><?= format_decimal_simbolo($produto['Pro_pvendatabela']); ?></ins> <del><?= format_decimal_simbolo($produto['Pro_pvenda']); ?></del>
                            </div>                            
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top 5 Novos</h2>
                    <?php
                    foreach (novos() as $produto):
                        $image = explode(';', $produto['Pro_imagens'])[0];
                        ?>
                        <div class="single-wid-product">
                            <a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><img src="<?= $image; ?>" alt="" class="product-thumb"></a>
                            <h2><a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><?= $produto['Pro_descricao']; ?></a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins><?= format_decimal_simbolo($produto['Pro_pvendatabela']); ?></ins> <del><?= format_decimal_simbolo($produto['Pro_pvenda']); ?></del>
                            </div>                            
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End product widget area -->

<?php include 'includes/footer.php'; ?>