<?php
include 'includes/head.php';
include 'includes/navigation.php';

verifica_acesso_permitido('Admin');

require_once BASEURL . 'persistence/daoCarrinho.class.php';
$dao_carrinho = new DaoCarrinho();
$vendas_aprovadas = $dao_carrinho->vendasAguardandoAprovadas();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Vendas</h1>
            </legend>
        </div>
    </div>

    <div class="row">
        <?php if (count($vendas_aprovadas) > 0) { ?>
            <table class="table table-bordered table-condesed table-striped">
                <thead>
                <th>Nº Venda</th> <th>Cliente</th> <th>Dt/Checkout</th> <th>Qt. Itens</th> <th>Total Venda</th> <th>Destino</th>
                <th>Andamento</th>
                </thead>
                <tbody>
                    <?php foreach ($vendas_aprovadas as $carrinho): ?>
                        <tr>
                            <td><?= $carrinho['Car_codigo']; ?></td>
                            <td><?= $carrinho['Usu_nomecompleto']; ?></td>
                            <td><?= $carrinho['Car_datahora_checkout']; ?></td>
                            <td><?= $carrinho['Car_qtitens']; ?></td>
                            <td><?= $carrinho['Car_total']; ?></td>
                            <td><?= $carrinho['destino']; ?></td>
                            <td class="text-center">
                                <a href="cadAndamento-Venda.php?car_codigo=<?= $carrinho['Car_codigo']; ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-indent-left"></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Atenção!</strong> Não há Resultados !
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>