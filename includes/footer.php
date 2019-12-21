<?php
require_once 'persistence/daoCategorias.class.php';
$dao_categorias = new DaoCategorias();
?>

<div class="footer-top-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="footer-about-us">
                    <h2><span>LOJA VIRTUAL</span></h2>
                    <p>Os e-Marketplaces consistem em plataformas eletrónicas onde as empresas, ora assumindo a posição de comprador, ora a de vendedor, se reúnem à volta de um mesmo objectivo: estabelecer laços comerciais entre si.</p>
                    <div class="footer-social">
                        <a href="http://www.facebook.com.br" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="https://twitter.com/?lang=pt-br" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="http://www.youtube.com.br" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="https://www.linkedin.com/portugues" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="https://br.pinterest.com/" target="_blank"><i class="fa fa-pinterest"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Navegação </h2>
                    <ul>
                        <li><a href="">Minha conta</a></li>
                        <li><a href="">Histórico</a></li>
                    </ul>                        
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Categorias</h2>
                    <ul>
                        <?php foreach ($dao_categorias->selectRoot() as $root): ?>
                            <li><a href="shopping.php?cat_codigo_root=<?= $root->getCat_codigo(); ?>"><?= $root->getCat_descricao(); ?></a></li>
                        <?php endforeach; ?>
                    </ul>                        
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="estoque_teste" name="estoque_teste">
</div>

<!-- Latest jQuery form server -->
<script src="https://code.jquery.com/jquery.min.js"></script>

<!-- Bootstrap JS form CDN -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<!-- jQuery sticky menu -->
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/jquery.sticky.js"></script>

<!-- jQuery easing -->
<script src="assets/js/jquery.easing.1.3.min.js"></script>

<!-- Main Script -->
<script src="assets/js/main.js"></script>

<script>    
    function add_carrinho(quantity, pro_codigo) {
//        jQuery.ajax({
//            url: "/lojavirtual/compra/add-item-carrinho.php",
//            type: "POST",
//            data: {quantity: quantity, pro_codigo: pro_codigo},
//            dataType: "json",
//            success: function (data) {
//                $("#car_qtitens").html(data.car_qtitens);
//                $("#car_qtitens_menu").html(data.car_qtitens);
//                $("#cart_total").html(data.car_total);
//            },
//            error: function () {
//                alert('Erro add-to-carrinho.php')
//            }
//        });
//
        jQuery.ajax({
            url: "/lojavirtual/compra/busca-quantidade-disponivel-produto.php",
            type: "POST",
            data: {pro_codigo: pro_codigo},
            dataType: "json",
            success: function (data) {
                if (data.pro_estoque == 0) {
                    swal("Produto indisponível em estoque !");
                } else if (quantity > data.pro_estoque) {
                    swal("Temos somente " + data.pro_estoque + " disponível !");
                } else {
                    jQuery.ajax({
                        url: "/lojavirtual/compra/add-item-carrinho.php",
                        type: "POST",
                        data: {quantity: quantity, pro_codigo: pro_codigo},
                        dataType: "json",
                        success: function (data) {
                            $("#car_qtitens").html(data.car_qtitens);
                            $("#car_qtitens_menu").html(data.car_qtitens);
                            $("#cart_total").html(data.car_total);
                        },
                        error: function () {
                            alert('Erro add-to-carrinho.php')
                        }
                    });
                }
            },
            error: function () {
                alert('Erro add-to-carrinho.php')
            }
        });
    }    
</script>
</body>
</html>
