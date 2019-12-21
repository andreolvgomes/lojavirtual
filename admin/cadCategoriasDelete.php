<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once '../persistence/daoCategorias.class.php';
$dao_categorias = new DaoCategorias();
$categoria = new Categorias();
$count_parent = false;

if ($_GET) {
    $categoria = $dao_categorias->select($_GET['cat_codigo'])[0];
    $count_parent = $dao_categorias->getCountParent($categoria->getCat_codigo());
}
if ($_POST) {
    $cat_codigo = $_POST['txtCat_codigo'];
    if ($dao_categorias->categoria_sendo_utilizada($cat_codigo)) {
        $_SESSION['msg_erro'] = 'Impossível excluir, Categoria já está sendo utilizada !';
    } else {
        $dao_categorias->delete($cat_codigo, true);
        $_SESSION['msg_sucesso'] = 'Exluído com sucesso !';
    }
    header('Location: cadCategoriasTable.php');
}
?>

<div class="container">
    <div class="row">
        <h1>Excluir Categoria</h1>
    </div>
    <div class="bg-danger" style="border-radius: 5px">
        <p style="padding: 10px;">Deseja realmente excluir ?</p>
        <?php if ($count_parent > 0): ?>
            <p class="bg-primary" style="padding: 10px;">Esta Categoria possui várias SubCategorias, ao excluir esta todas as SubCategorias também serão exluídas, deseja realmente continuar ?</p>
        <?php endif; ?>
    </div>
    <br>
    <form action="cadCategoriasDelete.php" method="post">
        <input type="hidden" value="<?= $categoria->getCat_codigo(); ?>" name="txtCat_codigo"/>
        <div class="form-actions">
            <a class="btn btn-danger" href="cadCategoriasTable.php"><span class="glyphicon glyphicon-remove"></span> Não</a>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Sim</button>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>