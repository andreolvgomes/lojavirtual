<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once '../persistence/daoProdutos.class.php';
require_once '../persistence/daoCategorias.class.php';
require_once '../persistence/daoMarcas.class.php';

$dao_produtos = new DaoProdutos();
$dao_categorias = new DaoCategorias();
$dao_marcas = new DaoMarcas();

$total_rows = $dao_produtos->getCount();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Produtos</h1>
            </legend>
        </div>
    </div>
    <div class="row">
        <p>
            <a class="btn btn-primary" href="cadProdutos.php"><span class="glyphicon glyphicon-plus"></span> Cadastrar Produto</a>
        </p>
        <?php if ($total_rows > 0) { ?>
            <table class="table table-bordered table-condesed table-striped">
                <thead>
                <th>Código</th> <th>Descrição</th> <th>Preço Venda</th> <th>Preço Oferta</th> <th>Marca</th> <th>Estoque</th> <th>Categoria</th> <th class="text-center">#</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($dao_produtos->select() as $produto):
                        $categoria = $dao_categorias->select($produto->getCat_codigo())[0];
                        $desc_category = '';
                        $mar_descricao = $dao_marcas->select($produto->getMar_codigo())[0]->getMar_descricao();
                        if ($categoria->getCat_parent() > 0) {
                            $desc_category = $dao_categorias->select($categoria->getCat_parent())[0]->getCat_descricao();
                            $desc_category .= '~';
                        }
                        $desc_category .= $categoria->getCat_descricao();
                        ?>
                        <tr>
                            <td><?= $produto->getPro_codigo(); ?></td>
                            <td><?= $produto->getPro_descricao(); ?></td>
                            <td><?= format_decimal_simbolo($produto->getPro_pvenda()); ?></td>
                            <td><?= format_decimal_simbolo($produto->getPro_pvendatabela()); ?></td>
                            <td><?= $mar_descricao; ?></td>
                            <td><?= format_decimal($produto->getPro_estoque()); ?></td>
                            <td><?= $desc_category; ?></td>
                            <td class="text-center">
                                <!--<a class="btn btn-default btn-sm" href="cadTamanhosTable.php?pro_codigo=<?= $produto->getPro_codigo(); ?>&janela=table"><span class="glyphicon glyphicon-text-height"></span></a>-->
                                <a href="cadProdutos.php?update=<?= $produto->getPro_codigo(); ?>" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="cadProdutosDelete.php?pro_codigo=<?= $produto->getPro_codigo(); ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Atenção!</strong> Não há Produtos para visualizar. Clique em novo para cadastrar !
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>