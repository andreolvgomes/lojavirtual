<?php

require_once '../persistence/daoCategorias.class.php';
$dao_categorias = new DaoCategorias();

$categoria = new Categorias();

if ($_GET) {
    if (isset($_GET['update'])) {
        $categoria = $dao_categorias->select($_GET['update'])[0];
    }
}
if ($_POST) {
    $errors = array();
    $categoria->setCat_codigo($_POST['txtCat_codigo']);
    $categoria->setCat_descricao($_POST['txtCat_descricao']);
    $categoria->setCat_parent($_POST['root']);

    if ($categoria->getCat_parent() == '') {
        $errors[] = 'Escolha o tipo de categoria !';
    }
    if (empty($categoria->getCat_descricao())) {
        $errors[] = 'Informe a descrição da Categoria !';
    }
    if ($categoria->getCat_codigo() > 0) {
        if ($dao_categorias->existsUpdateExists($categoria)) {
            $errors[] = 'Já existe outra Categoria com mesmo nome !';
        }
    }
    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        if ($categoria->getCat_codigo() > 0) {
            $dao_categorias->update($categoria);
            $_SESSION['msg_sucesso'] = 'Categoria alterada com sucesso !';
        } else {
            $dao_categorias->insert($categoria);
            $_SESSION['msg_sucesso'] = 'Categoria salva com sucesso !';
        }
        header('Location: cadCategoriasTable.php');
    }
}
?>