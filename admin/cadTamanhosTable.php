<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once '../persistence/daoTamanhos.class.php';
require_once '../persistence/daoProdutos.class.php';

$dao_tamanhos = new DaoTamanhos();
$dao_produtos = new DaoProdutos();
$total_rows = $dao_tamanhos->getCount();
$pro_codigo = '';
$is_janela_table = false;

if ($_GET) {
    if (isset($_GET['pro_codigo'])) {
        $pro_codigo = $_GET['pro_codigo'];
    }
    if (isset($_GET['janela'])) {
        $is_janela_table = $_GET['janela'] = 'table';
    }
}
$pro_descricao = $dao_produtos->select($pro_codigo)[0]->getPro_descricao();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Tamanhos</h1>
            </legend>
        </div>
    </div>
    <div class="row col-md-6">
        <p>
            <?php if ($is_janela_table) { ?>
                <a class="btn btn-default" href="cadProdutosTable.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
            <?php } else { ?>
                <a class="btn btn-default" href="cadProdutos.php?update=<?= $pro_codigo; ?>"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
            <?php } ?>            
            <a class="btn btn-primary" href="cadTamanhos.php?pro_codigo=<?= $pro_codigo; ?>"><span class="glyphicon glyphicon-plus"></span> Cadastrar Tamanho</a>            
        </p>
        <?php if ($total_rows > 0) { ?>
            <table class="table table-bordered table-condesed table-responsive">
                <thead>
                <th>Produto</th> <th>Tamanho</th> <th>Quantidade</th> <th>#</th>
                </thead>
                <tbody>
                    <?php foreach ($dao_tamanhos->select() as $tamanho): ?>
                        <tr>
                            <td><?= $pro_descricao; ?></td>
                            <td><?= $tamanho->getTam_tamanho(); ?></td>
                            <td><?= $tamanho->getTam_quantidade(); ?></td>
                            <td width='100px' class="text-center">
                                <a class='btn btn-warning btn-sm' href='cadTamanhos.php?update=<?= $tamanho->getTam_codigo(); ?>' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                                <a class='btn btn-danger btn-sm' href='cadTamanhosDelete.php?tam_codigo=<?= $tamanho->getTam_codigo(); ?>' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Atenção!</strong> Não há Tamanhos para visualizar. Clique em novo para cadastrar !
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>