<?php
include 'includes/head.php';
include 'includes/navigation.php';

verifica_acesso_permitido('Admin');

require_once BASEURL . 'persistence/daoCarrinho.class.php';
require_once BASEURL . 'persistence/daoProdutos.class.php';

$dao_carrinho = new DaoCarrinho();
$dao_produtos = new DaoProdutos();

$title = "Aguardando Análise/Aprovação";
$value_select = 0;

if (isset($_GET)) {
    if (isset($_GET['car_codigo']) && isset($_GET['aprovada'])) {
        $carrinho = $dao_carrinho->select($_GET['car_codigo'])[0];
        if ($_GET['aprovada'] == 1) {
            $carrinho->setCar_status_andamento(1);
        } else {
            $carrinho->setCar_status_andamento(24);
            foreach ($dao_carrinho->buscaItensCarrinho($carrinho->getCar_codigo()) as $item) {
                $dao_produtos->AddPro_estoque($item['Pro_codigo'], $item['Ite_quantidade']);
            }
        }
        $dao_carrinho->update($carrinho);
    }
}
if (isset($_POST) && !empty($_POST)) {
    $value_select = $_POST['select_opcoes'];
    if ($value_select == 0) {
        $title = "Aguardando Análise/Aprovação";
    } else if ($value_select == 1) {
        $title = "Aprovadas";
    } else if ($value_select == 24) {
        $title = "Recusadas";
    }
}

$vendas_realizadas = $dao_carrinho->vendasAguardandoAprovacao($value_select);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1><?= $title; ?></h1>
            </legend>
        </div>
    </div>

    <div class="row">
        <form action="resultado-vendas-analise-aprovacao.php" method="POST">
            <div class="row">
                <div class="form-group col-md-4">
                    <select class="form-control" name="select_opcoes" id="myselect" onchange="this.form.submit()">
                        <option value="0" <?= ($value_select == 0) ? 'selected' : ''; ?>>Pendente Análise/Aprovação</option>
                        <option value="1" <?= ($value_select == 1) ? 'selected' : ''; ?>>Aprovadas</option>
                        <option value="24" <?= ($value_select == 24) ? 'selected' : ''; ?>>Recusadas</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <p>
                        <input class="btn btn-success" type="submit" value="Atualizar">
                    </p>
                </div>
            </div>
            <?php if (count($vendas_realizadas) > 0) { ?>
                <table class="table table-bordered table-condesed table-striped">
                    <thead>
                    <th>Nº Venda</th> <th>Cliente</th> <th>Dt/Checkout</th> <th>Qt. Itens</th> <th>Total Venda</th> <th>Destino</th>

                    <?php if ($value_select == 0) { ?>
                        <th>Aprovar/Recusar</th>
                    <?php } ?>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas_realizadas as $carrinho): ?>
                            <tr>
                                <td><?= $carrinho['Car_codigo']; ?></td>
                                <td><?= $carrinho['Usu_nomecompleto']; ?></td>
                                <td><?= $carrinho['Car_datahora_checkout']; ?></td>
                                <td><?= $carrinho['Car_qtitens']; ?></td>
                                <td><?= format_decimal_simbolo($carrinho['Car_total']); ?></td>
                                <td><?= $carrinho['destino']; ?></td>
                                <?php if ($value_select == 0) { ?>
                                    <td class="text-center">
                                        <a href="resultado-vendas-analise-aprovacao.php?car_codigo=<?= $carrinho['Car_codigo']; ?>&aprovada=1" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span></a>
                                        <a href="resultado-vendas-analise-aprovacao.php?car_codigo=<?= $carrinho['Car_codigo']; ?>&aprovada=0" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></a>
                                    </td>
                                <?php } ?>                                
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
        </form>
    </div>
</div>
<?php include 'includes/footer.php'; ?>