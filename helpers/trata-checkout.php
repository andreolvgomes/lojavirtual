<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

if (login_logado()) {
    header('Location: ../checkout.php');
} else {
    $_SESSION['msg_sucesso'] = 'Faça login antes de prosseguir !!!';
    header('Location: ../admin/login.php?local=loja');
}
?>