<?php

require_once BASEURL . 'persistence/daoUsuarios.class.php';

$dao_usuarios = new DaoUsuarios();
$usuario = new Usuarios();

if ($_POST) {
    $errors = array();

    $usuario->setUsu_email($_POST['txtUse_email']);
    $usuario->setUsu_senha($_POST['txtUse_senha']);

    if (empty($usuario->getUsu_email())) {
        $errors[] = 'Informe o e-mail !';
    } else if (empty($usuario->getUsu_senha())) {
        $errors[] = 'Informe a senha !';
    } else {
        $usuario = $dao_usuarios->buscaUser($usuario->getUsu_email(), $usuario->getUsu_senha());
        if ($usuario->getUsu_codigo() == 0) {
            $errors[] = 'Usuário ou Senha inválido !';
        }
    }

    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        set_login($usuario->getUsu_codigo());
        header('Location: index.php');
    }
}
?>