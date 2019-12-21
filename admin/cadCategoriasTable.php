<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once '../persistence/daoCategorias.class.php';
$dao_categorias = new DaoCategorias();

$total_rows = $dao_categorias->getCount();
?>
<div class="container">
    <span id="msg_error"></span>
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Categorias</h1>
            </legend>
        </div>
    </div>
    <div class="row">
        <p>
            <a class="btn btn-primary" href="cadCategorias.php"><span class="glyphicon glyphicon-plus"></span> Cadastrar Categoria</a>
        </p>
        <?php if ($total_rows > 0) { ?>
            <table class="table table-bordered table-condesed table-responsive">
                <thead>
                <th>Categoria</th> <th>Local</th> <th>#</th>
                </thead>
                <tbody>
                    <?php foreach ($dao_categorias->selectRoot() as $categoria): ?>
                        <tr class="bg-primary">
                            <td><?= $categoria->getCat_descricao(); ?></td>
                            <td>Principal</td>
                            <td width='100px' class="text-center">
                                <a class='btn btn-warning btn-sm' href='cadCategorias.php?update=<?= $categoria->getCat_codigo(); ?>' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                                <a class='btn btn-danger btn-sm' href='cadCategoriasDelete.php?cat_codigo=<?= $categoria->getCat_codigo(); ?>' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                            </td>
                        </tr>
                        <?php
                        $count_parent = $dao_categorias->getCountParent($categoria->getCat_codigo());
                        if ($count_parent > 0) {
                            ?>
                            <?php foreach ($dao_categorias->selectParent($categoria->getCat_codigo()) as $parent): ?>
                                <tr>
                                    <td><?= $parent->getCat_descricao(); ?></td>
                                    <td>Sub/Categoria</td>
                                    <td width='100px' class="text-center">
                                        <a class='btn btn-warning btn-sm' href='cadCategorias.php?update=<?= $parent->getCat_codigo(); ?>' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                                        <a class='btn btn-danger btn-sm' href='cadCategoriasDelete.php?cat_codigo=<?= $parent->getCat_codigo(); ?>' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php } ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Atenção!</strong> Não há Categorias para visualizar. Clique em novo para cadastrar !
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>