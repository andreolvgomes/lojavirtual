<?php
include 'includes/head.php';
include 'includes/navigation.php';

verifica_acesso_permitido('Admin');
require_once BASEURL . 'persistence/daoCarrinho.class.php';

$dao_carrinho = new DaoCarrinho();
$clientes_que_mais_compram = $dao_carrinho->buscaClientesMaisCompra();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>10 Cliente que mais compra</h1>
            </legend>
        </div>
    </div>

    <div class="row">
        <?php if (count($clientes_que_mais_compram) > 0) { ?>
            <table class="table table-bordered table-condesed table-striped">
                <thead>
                <th>Nome Completo</th> <th>E-mail</th> <th>Qt.Compras</th>
                </thead>
                <tbody>
                    <?php foreach ($clientes_que_mais_compram as $cliente): ?>
                        <tr>
                            <td><?= $cliente['Usu_nomecompleto']; ?></td>
                            <td><?= $cliente['Usu_email']; ?></td>
                            <td><?= $cliente['quantidade_compras']; ?></td>
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