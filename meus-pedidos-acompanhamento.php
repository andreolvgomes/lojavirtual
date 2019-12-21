<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once BASEURL . 'persistence/daoAndamento_Venda.class.php';
$dao_andamento = new daoAndamento_Venda();
$car_codigo_detalhes = $_GET['Car_codigo'];
$acompanhamentos = $dao_andamento->buscaRapido($car_codigo_detalhes);
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
                    <h2>Acompanhamento</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <?php if (count($acompanhamentos) > 0) { ?>
            <p>
                <a class="btn btn-success" href="meus-pedidos-acompanhamento.php?Car_codigo=<?= $car_codigo_detalhes; ?>"><span class="glyphicon glyphicon-refresh"></span> Atualizar</a>
            </p>
            <div class="cart_totals1">
                <table>
                    <thead>
                    <th style="height: 50px">ID</th> <th>Data/Hora</th> <th>Anterior</th> <th>Atual</th>
                    </thead>
                    <tbody>
                        <?php foreach ($acompanhamentos as $and): ?>
                            <tr>
                                <td><?= $and['And_codigo']; ?></td>                        
                                <td><?= $and['And_datahora']; ?></td>

                                <td><?= $and['And_detalhes_ant']; ?></td>
                                <td><?= $and['And_detalhes_atual']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                </table> 
            </div>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Atenção!</strong> Não há Resultados !
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>