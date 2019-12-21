<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/persistence/daoCategorias.class.php';

$cat_codigo = $_POST['cat_codigo'];
$selected = $_POST['selected'];

$dao_categorias = new DaoCategorias();
ob_start();
?>

<option value=""></option>
<!--<option value="<?= $cat_codigo; ?>"><?= $cat_codigo; ?></option>-->
<?php foreach ($dao_categorias->selectParent($cat_codigo) as $categoria): ?>
    <option value="<?= $categoria->getCat_codigo(); ?>" <?= ($selected == $categoria->getCat_codigo()) ? 'selected' : ''; ?> ><?= $categoria->getCat_descricao(); ?></option>
<?php endforeach; ?>
<?php echo ob_get_clean(); ?>
