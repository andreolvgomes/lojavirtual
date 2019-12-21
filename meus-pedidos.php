<?php
include 'includes/head.php';
include 'includes/navigation.php';

$pedidos = $dao_carrinho->buscaPedidos($usu_codigo);
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
                    <h2>Meus Pedidos</h2>
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
            <?php if (count($pedidos) > 0) { ?>
                <table class="table table-hover">
                    <thead>
                    <th style="height: 50px">N Pedido</th> <th>Data</th> <th>Qt.Itens</th> <th>Total</th> <th>Status</th> <th class="text-center">Operações</th>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr style="height: 50px">
                                <td><?= $pedido['Car_codigo']; ?></td>
                                <td><?= $pedido['Car_datahora_checkout']; ?></td>
                                <td><?= $pedido['Car_qtitens']; ?></td>
                                <td><?= format_decimal_simbolo($pedido['Car_total']); ?></td>
                                <td><?= status_andamento_compra($pedido['Car_status_andamento']); ?></td>

                                <td class="text-center">
                                    <a href="meus-pedidos-acompanhamento.php?Car_codigo=<?= $pedido['Car_codigo']; ?>"><span class='glyphicon glyphicon-road' aria-hidden='true'> Andamento</a>
                                    <a href="meus-pedidos-detalhes.php?Car_codigo=<?= $pedido['Car_codigo']; ?>"><span class='glyphicon glyphicon-share-alt' aria-hidden='true'> Detalhes</a>
                                    <a href="boletophp/boleto_cef_sinco.php?car_codigo=<?= $pedido['Car_codigo']; ?>" target="blank"><span class='glyphicon glyphicon-print' aria-hidden='true'> Boleto</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                </table>
            <?php } else { ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <strong>Atenção!</strong> Não há Pedidos para você !
                </div>
            <?php } ?>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'; ?>