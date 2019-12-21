<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';
require_once BASEURL . 'persistence/daoUsuarios.class.php';

$dao_usuarios = new DaoUsuarios();
$usuario = new Usuarios();
$senha_confir = '';
$acessado_a_partir_loja_compra = false;

if ($_GET) {
    if (isset($_GET['update'])) {
        $usuario = $dao_usuarios->select($_GET['update'])[0];
        $senha_confir = $usuario->getUsu_senha();
    }
    if (isset($_GET['local'])) {
        $acessado_a_partir_loja_compra = $_GET['local'] = '1';
    }
}
if ($_POST) {
    $errors = array();
    $acessado_a_partir_loja_compra = $_POST['txtAcessado_a_partir_loja_compra'] == 1;

    $usuario->setUsu_codigo($_POST['txtUsu_codigo']);
    $usuario->setUsu_nomecompleto($_POST['txtUsu_nomecompleto']);
    $usuario->setUsu_email($_POST['txtUsu_email']);
    $usuario->setUsu_senha($_POST['txtUsu_senha']);
    $senha_confir = $_POST['txtUsu_senhaConf'];
    $usuario->setUsu_observarcao($_POST['txtUsu_observarcao']);

    if (!$acessado_a_partir_loja_compra) {
        $usuario->setUsu_permicao($_POST['permissao']);
    } else {
        $usuario->setUsu_permicao('Client');
    }

    $usuario->setCid_sequencial($_POST['cidade']);
    $usuario->setEst_sequencial($_POST['estado']);
    $usuario->setUsu_rua($_POST['txtUsu_rua']);
    $usuario->setUsu_numero($_POST['txtUsu_numero']);
    $usuario->setUsu_bairro($_POST['txtUsu_bairro']);
    $usuario->setUsu_cep($_POST['txtUsu_cep']);
    $usuario->setUsu_telefone($_POST['txtUsu_telefone']);
    $usuario->setUsu_celular($_POST['txtUsu_celular']);
    $usuario->setUsu_tipo($_POST['txtUsu_tipo']);

    if (empty($usuario->getUsu_nomecompleto())) {
        $errors[] = 'Informe o Nome';
    } else if (empty($usuario->getUsu_email())) {
        $errors[] = 'Informe o E-mail';
    } else if (empty($usuario->getUsu_senha())) {
        $errors[] = 'Informe a Senha';
    } else if (empty($senha_confir)) {
        $errors[] = 'Informe a Senha de Confirmaçao';
    } else if ($senha_confir != $usuario->getUsu_senha()) {
        $errors[] = 'A senha e a confirmação devem ser igual';
    } else if ($dao_usuarios->existsUsu_email($usuario)) {
        $errors[] = 'E-mail já cadastrado';
    }
    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        if ($usuario->getUsu_codigo() > 0) {
            $dao_usuarios->update($usuario);
            $_SESSION['msg_sucesso'] = 'Usuário alterado com sucesso !';
        } else {
            $usuario = $dao_usuarios->insert($usuario);
            $_SESSION['msg_sucesso'] = 'Usuário cadastrado com sucesso !';
            if (!$acessado_a_partir_loja_compra) {
                header('Location: cadUsuariosTable.php');
            }
        }
    }
}
?>
