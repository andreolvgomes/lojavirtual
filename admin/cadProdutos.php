<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once 'extensions/cadProdutos.extension.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Produto</h1>
            </legend>
        </div>
    </div>
    <form name="cadastro" action="cadProdutos.php" method="post" enctype="multipart/form-data">
        <div class="row">

            <input type="hidden" name="txtPro_codigo" value="<?= $produto->getPro_codigo(); ?>"/>

            <div class="form-group col-md-4">
                <label>Descrição</label>
                <input type="text" class="form-control" name="txtPro_descricao" value="<?= $produto->getPro_descricao(); ?>"/>
            </div>
            <div class="form-group col-md-4">
                <label>Preço de Venda</label>
                <input type="number" min="0" class="form-control" name="txtPro_pvenda" value="<?= $produto->getPro_pvenda(); ?>"/>
            </div>
            <div class="form-group col-md-4">
                <label>Preço Oferta</label>
                <input type="number" min="0" class="form-control" name="txtPro_pvendatabela" value="<?= $produto->getPro_pvendatabela(); ?>"/>
            </div>
            <div class="form-group col-md-4">
                <label>Marca</label>
                <select class="form-control" name="selMarcas">
                    <option></option>
                    <?php foreach ($dao_marcas->select() as $marca): ?>
                        <option value="<?= $marca->getMar_codigo(); ?>" <?= ($produto->getMar_codigo() == $marca->getMar_codigo()) ? 'selected' : ''; ?>><?= $marca->getMar_descricao(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Categoria</label>
                <select class="form-control" id="selCategorias" name="selCategorias">
                    <option></option>
                    <?php foreach ($dao_categorias->selectRoot() as $categoria): ?>
                        <option value="<?= $categoria->getCat_codigo(); ?>" <?= ($categoria->getCat_codigo() == $cat_codigo_root) ? 'selected' : ''; ?>><?= $categoria->getCat_descricao(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Sub/Categoria</label>
                <select class="form-control" name="selSubCategorias" id="selSubCategorias">
                </select>
            </div>
            <div class="row col-md-12">
                <div class="form-group col-md-4">
                    <label>Estoque</label>
                    <input type="number" min="0" class="form-control" name="txtPro_estoque" value="<?= $produto->getPro_estoque(); ?>"/>
                </div>
            </div>
            <div class="col-md-8">
                <label>Detalhes</label>
                <textarea type="text" class="form-control" name="txtPro_detalhes"><?= $produto->getPro_detalhes(); ?></textarea>
            </div>

            <div class="col-md-4 text-right">
                <br>
                <?php if ($produto->getPro_codigo() > 0) { ?>
                        <!--<a class="btn btn-default" href="cadTamanhosTable.php?pro_codigo=<?= $produto->getPro_codigo(); ?>"><span class="glyphicon glyphicon-text-height"></span> Tamanhos</a>-->
                <?php } ?>
                <a class="btn btn-danger" href="cadProdutosTable.php"><span class="glyphicon glyphicon-remove"></span> Cancela</a>
                <button type="submit" class="btn btn-primary" onclick="return valida()"><span class="glyphicon glyphicon-floppy-saved"></span> Salva</button>                            
            </div>

            <div class="col-md-8">
                <?php if ($produto->getPro_imagens() == ''): ?>
                    <input type="file" name="photo[]" id="photo" multiple>
                <?php else: ?> 
                    <?php
                    $imgi = 1;
                    $images = explode(';', $produto->getPro_imagens());
                    ?>
                    <?php foreach ($images as $image): ?>
                        <div class="col-md-2 text-center">
                            <br>
                            <img src="<?= $image; ?>" alt="saved image" style="width: 100px; height: 100px; text-align: center;"/><br>
                            <a href="cadProdutos.php?delete_image=1&pro_codigo=<?= $produto->getPro_codigo(); ?>&imgi=<?= $imgi ?>" class="text-danger">Excluir</a>
                        </div>
                        <?php
                        $imgi++;
                    endforeach;
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<script>
    cadastro.txtCat_descricao.focus();
</script>

<?php
include 'js/cadProdutos.script.php';
include 'includes/footer.php';
?>
