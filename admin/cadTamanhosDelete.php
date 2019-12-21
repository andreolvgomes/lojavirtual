<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once '../persistence/daoTamanhos.class.php';
$dao_tamanhos = new DaoTamanhos();
$tam_codigo = '';
if ($_GET) {
    $tam_codigo = $_GET['tam_codigo'];
}
if ($_POST) {
    $dao_tamanhos->delete($_POST['txtTam_codigo']);
    $_SESSION['msg_sucesso'] = 'Exluído com sucesso !';
    header('Location: cadTamanhosTable.php');
}
?>

<div class="container">
    <div class="row">
        <h1>Excluir Tamanho</h1>
    </div>
    <div class="bg-danger" style="border-radius: 5px">
        <p style="padding: 10px;">Deseja realmente excluir ?</p>
    </div>
    <br>
    <form action="cadTamanhosDelete.php" method="post">
        <input type="hidden" value="<?= $tam_codigo; ?>" name="txtTam_codigo"/>
        <div class="form-actions">
            <a class="btn btn-danger" href="cadTamanhosTable.php"><span class="glyphicon glyphicon-remove"></span> Não</a>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Sim</button>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>