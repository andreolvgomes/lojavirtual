<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once 'extensions/cadCategorias.extension.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Categoria</h1>
            </legend>
        </div>
    </div>
    <div class="row">
        <form name="cadastro" class="col-md-4" action="cadCategorias.php" method="post">
            <input type="hidden" name="txtCat_codigo" value="<?= $categoria->getCat_codigo(); ?>">
            <div class="form-group">
                <label>Tipo Categorias</label>
                <select class="form-control" name="root" id="root">
                    <option></option>
                    <option value="0" selected>Principal</option>
                    <?php foreach ($dao_categorias->selectRoot() as $root): ?>
                        <option value="<?= $root->getCat_codigo(); ?>" <?= ($categoria->getCat_parent() == $root->getCat_codigo()) ? 'selected' : ''; ?>><?= $root->getCat_descricao(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <input type="text" class="form-control" name="txtCat_descricao" value="<?= $categoria->getCat_descricao(); ?>">
            </div>
            <div class="form-group">
                <a class="btn btn-danger" href="cadCategoriasTable.php"><span class="glyphicon glyphicon-remove"></span> Cancela</a>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Salva</button>
            </div>
        </form>

        <div class="col-md-6">
        </div>
    </div>
</div>

<script>
    cadastro.txtCat_descricao.focus();
</script>

<?php include 'includes/footer.php'; ?>