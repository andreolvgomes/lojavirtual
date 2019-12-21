<?php

require_once '../persistence/daoTamanhos.class.php';

$dao_tamanhos = new DaoTamanhos();
$tamanho = new Tamanhos();
$total_rows = $dao_tamanhos->getCount();
$errors = array();

if ($_GET) {
    if (isset($_GET['pro_codigo'])) {
        $tamanho->setPro_codigo($_GET['pro_codigo']);
    }
    if (isset($_GET['update'])) {
        $tamanho = $dao_tamanhos->select($_GET['update'])[0];
    }    
}
if ($_POST) {
    $tamanho->setPro_codigo($_POST['txtPro_codigo']);
    $tamanho->setTam_codigo($_POST['txtTam_codigo']);
    $tamanho->setTam_tamanho($_POST['txtTam_tamanho']);
    $tamanho->setTam_quantidade($_POST['txtTam_quantidade']);

    if (empty($tamanho->getTam_tamanho())) {
        $errors[] = 'Informe o descrição do tamanho';
    } else if (empty($tamanho->getTam_quantidade())) {
        $errors[] = 'Informe a quantidade';
    }
    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        if ($tamanho->getTam_codigo() > 0) {
            $dao_tamanhos->update($tamanho);
            $_SESSION['msg_sucesso'] = 'Tamanho alterado com sucesso';
        } else {
            $dao_tamanhos->insert($tamanho);
            $_SESSION['msg_sucesso'] = 'Tamanho cadatrado com sucesso';
        }
        header('Location: cadTamanhosTable.php');
    }
}
?>