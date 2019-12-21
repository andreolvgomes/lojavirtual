<?php
include 'includes/head.php';

require_once BASEURL . 'persistence/daoCarrinho.class.php';

$dao_carrinho = new DaoCarrinho();
$carrinho = $dao_carrinho->select($car_codigo)[0];
$carrinho->setCar_compraefetuada(1);
$carrinho->setCar_statuspgto(1);
$date = date("Y-m-d H:i:s");
$carrinho->setCar_datahora_checkout($date);
$carrinho->setUsu_codigo($usu_codigo);

$dao_carrinho->update($carrinho);

$car_codigo_bkp = $car_codigo;
$car_codigo = 0;

$_SESSION['car_codigo'] = 0;
unset($_SESSION['car_codigo']);

include 'includes/navigation.php';
?>

<script>
    swal("Good job!", "You clicked the button!", "success");
</script>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Venda efetuada com sucesso !!!</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <h1>Obrigado por comprar em nossa Loja, volte sempre !!!</h1>

        <form>
            <a href="boletophp/boleto_cef_sinco.php?car_codigo=<?= $car_codigo_bkp; ?>" target="blank">Emitir Boleto</a>
        </form>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
<script>
    swal("Compra realizada com sucesso", "Obrigado, volte sempre ! Acompanhe seu pedido clicando no link \"Meus Pedidos\" localizada na parte superior !", "success");
</script>