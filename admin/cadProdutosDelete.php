<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once '../persistence/daoProdutos.class.php';
$pro_codigo = '';

if ($_GET) {
    if ($_GET['pro_codigo']) {
        $pro_codigo = $_GET['pro_codigo'];
    }
}
if ($_POST) {
    $dao_produtos = new DaoProdutos();
    $pro_codigo = $_POST['txtPro_codigo'];
    if ($dao_produtos->produto_sendo_utilizado($pro_codigo)) {
        $_SESSION['msg_erro'] = "Impossível excluir, Produto já está sendo utilizado !";
    } else {
        $produto = $dao_produtos->select($pro_codigo)[0];

        // delete all images
        if (!empty($produto->getPro_imagens())) {
            $images = explode(';', $produto->getPro_imagens());
            for ($index = 0; $index < count($images); $index++) {
                $image_path = $_SERVER['DOCUMENT_ROOT'] . $images[$index];
                unlink($image_path);
                unset($image_path);
                unset($images[$index]);
            }
        }

        $dao_produtos->delete($produto->getPro_codigo());
    }
    header('Location: cadProdutosTable.php');
}
?>

<div class="container offset1">
    <div class="row">
        <h1>Excluir Produto</h1>
    </div>
    <div class="bg-danger" style="border-radius: 5px">
        <p style="padding: 10px;">Deseja realmente excluir ?</p>
    </div>
    <br>
    <form action="cadProdutosDelete.php" method="post">
        <input type="hidden" value="<?= $pro_codigo; ?>" name="txtPro_codigo"/>
        <div class="form-actions">
            <a class="btn btn-danger" href="cadProdutosTable.php"><span class="glyphicon glyphicon-remove"></span> Não</a>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Sim</button>
        </div>
    </form>
</div>
<?php include 'includes/footer.php'; ?>