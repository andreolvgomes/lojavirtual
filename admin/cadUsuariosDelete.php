<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once '../persistence/daoUsuarios.class.php';
$dao_usuarios = new DaoUsuarios();
$usu_codigo = 0;
if ($_GET) {
    $usu_codigo = $_GET['usu_codigo'];
}
if ($_POST) {
    $usu_codigo = $_POST['txtUsu_codigo'];
    if ($dao_usuarios->usuario_sendo_utilizado($usu_codigo)) {
        $_SESSION['msg_erro'] = "Impssível excluir, Usuário já está sendo utilizado !";
    } else {
        $dao_usuarios->delete($usu_codigo, true);
        $_SESSION['msg_sucesso'] = 'Exluído com sucesso !';
    }
    header('Location: cadUsuariosTable.php');
}
?>

<div class="container">
    <div class="row">
        <h1>Excluir Usuário</h1>
    </div>
    <div class="bg-danger" style="border-radius: 5px">
        <p style="padding: 10px;">Deseja realmente excluir ?</p>
    </div>
    <br>
    <form action="cadUsuariosDelete.php" method="post">
        <input type="hidden" value="<?= $usu_codigo; ?>" name="txtUsu_codigo"/>
        <div class="form-actions">
            <a class="btn btn-danger" href="cadUsuariosTable.php"><span class="glyphicon glyphicon-remove"></span> Não</a>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Sim</button>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>