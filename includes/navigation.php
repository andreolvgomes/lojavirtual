<?php
require_once 'helpers/init.php';

require_once BASEURL . 'persistence/daoCategorias.class.php';
require_once BASEURL . 'persistence/daoCarrinho.class.php';

$dao_categorias = new DaoCategorias();
$dao_carrinho = new DaoCarrinho();

$carrinho = new Carrinho();
if ($car_codigo > 0) {
    $carrinho = $dao_carrinho->select($car_codigo)[0];
}
?>

<script>
    $(function () {
        var nav = $('#wrap');
        $(window).scroll(function () {
            if ($(this).scrollTop() > 175) {
                nav.addClass("menu-fixo");

                document.getElementById("menu-carrinho").style.visibility = "visible";
                document.getElementById("car_qtitens_menu").style.visibility = "visible";
            } else {
                nav.removeClass("menu-fixo");

                document.getElementById("menu-carrinho").style.visibility = "hidden";
                document.getElementById("car_qtitens_menu").style.visibility = "hidden";
            }
        });
    });

    jQuery('document').ready(function () {
        document.getElementById("menu-carrinho").style.visibility = "hidden";
        document.getElementById("car_qtitens_menu").style.visibility = "hidden";
    });
</script>

<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-left">
                <div class="user-menu">
                    <ul>
                        <?php if (login_logado()): ?>
                            <li><a href="meus-pedidos.php"><i class="glyphicon glyphicon-list-alt"></i> Meus Pedidos</a></li>
                            <li><a href="register.php?update=<?= $usu_codigo; ?>&local=compra"><i class="glyphicon glyphicon-user"></i> Minha Conta</a></li>
                        <?php endif; ?>                       
                    </ul>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <div class="user-menu">
                    <ul>
                        <?php
                        if (!login_logado()) {
                            echo "<li><a href=\"register.php?local=compra\"><i class=\"glyphicon glyphicon-pencil\"></i> Registrar</a></li>";
                            echo "<li><a href=\"admin/login.php?local=loja\"><i class=\"glyphicon glyphicon-user\"></i> Login</a></li>";
                        } else {
                            echo "<li><a href=\"logout.php\"><i class=\"glyphicon glyphicon-off\"></i> Logout</a></li>";
                        }
                        ?>                        
                        <li><a href="compra/zera-carrinho.php"><i class="glyphicon glyphicon-remove-circle"></i> Limpar Carrinho</a></li>
                        <li><a href="admin/index.php"><i class="glyphicon glyphicon-home"></i> Admin</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="index.php"><span>LOJA VIRTUAL</span></a></h1>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="carrinho.php">Carrinho - <span class="cart-amunt" id="cart_total"><?= format_decimal_simbolo($carrinho->getCar_total()); ?></span> 
                        <i class="fa fa-shopping-cart"></i>
                        <span class="product-count" id="car_qtitens"><?= $carrinho->getCar_qtitens(); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="wrap" class="mainmenu-area">
    <span id="modal_errors" class="bg-danger"></span>
    <header>
        <div class="inner relative" >
            <a class="logo" href="index.php"><img src="images/logo.png" alt="fresh design web"></a>
            <span class="product-count" style="margin-top: 45px" id="car_qtitens_menu"><?= $carrinho->getCar_qtitens(); ?></span>

            <a id="menu-toggle" class="button dark" href="#"><i class="icon-reorder"></i></a>

            <nav id="navigation">
                <ul id="main-menu">
                    <li class="current-menu-item"><a href="index.php">Destaque</a></li>
                    <li><a href="shopping.php">Shopping</a></li>

                    <?php foreach ($dao_categorias->selectRoot() as $root): ?>
                        <li class="parent">
                            <a href="#"><?= $root->getCat_descricao(); ?></a>
                            <ul class="sub-menu">
                                <?php foreach ($dao_categorias->selectParent($root->getCat_codigo()) as $parent) : ?>
                                    <li><a href="categorias.php?cat_codigo=<?= $parent->getCat_codigo(); ?>"><?= $parent->getCat_descricao(); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                    <li id="menu-carrinho"><a href="carrinho.php">Carrinho <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                </ul>
            </nav>
            <div class="clear"></div>
        </div>
    </header>
</div>