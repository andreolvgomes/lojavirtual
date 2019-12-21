<?php
include 'includes/head.php';
include 'includes/navigation.php';

verifica_acesso_permitido('Admin');

require_once BASEURL . 'persistence/daoCarrinho.class.php';
require_once BASEURL . 'persistence/daoProdutos.class.php';

$dao_carrinho = new DaoCarrinho();
$dao_produtos = new DaoProdutos();

if (isset($_GET)) {
    if (isset($_GET['car_codigo'])) {
        $car_codigo = $_GET['car_codigo'];
        foreach ($dao_carrinho->buscaItensCarrinho($car_codigo) as $item) {
            $dao_produtos->AddPro_estoque($item['Pro_codigo'], $item['Ite_quantidade']);
        }
        Connection::execute("update carrinho set Car_desencalhado = 1 where Car_codigo = '$car_codigo'");
    }
}

$vendas_encalhada = $dao_carrinho->vendasEncalhada();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Vendas Encalhadas</h1>
            </legend>
        </div>
    </div>

    <div class="row">
        <form action="resultado-desencalhar-venda.php" method="post">
            <p>
                <input class="btn btn-success" type="submit" value="Atualizar">
            </p>
            <?php if (count($vendas_encalhada) > 0) { ?>
                <table class="table table-bordered table-condesed table-striped">
                    <thead>
                    <th>Nº Venda</th> <th>Dt/Abertura</th> <th>Dt/Ultima Interação</th> <th>Qt. Itens</th> <th>Total Venda</th> <th>Desencalhar</th>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas_encalhada as $carrinho): ?>
                            <tr>
                                <td><?= $carrinho['Car_codigo']; ?></td>
                                <td><?= $carrinho['Car_datahora_abertura']; ?></td>
                                <td><?= $carrinho['Car_datahora_ultima_modificacao']; ?></td>
                                <td><?= $carrinho['Car_qtitens']; ?></td>
                                <td><?= format_decimal_simbolo($carrinho['Car_total']); ?></td>
                                <td class="text-center">
                                    <a href="resultado-desencalhar-venda.php?car_codigo=<?= $carrinho['Car_codigo']; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-saved"></span></a>
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
        </form>
    </div>
</div>
<?php include 'includes/footer.php'; ?>