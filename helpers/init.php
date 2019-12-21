<?php

define('BASEURL', $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/');
define('CART_COOKIE', 'id_meu_carrinho');
define('CART_COOKIE_EXPIRE', time() + (86400 * 30));

require_once BASEURL . 'persistence/connection.class.php';

require_once 'common.php';
require_once BASEURL . 'persistence/connection.class.php';
require_once BASEURL . 'persistence/daoUsuarios.class.php';
require_once 'sugestoes-produtos-compra.php';

session_start();

if (isset($_SESSION['msg_sucesso'])) {
    $msg = '<div class="alert alert-dismissable alert-success">';
    $msg .= '<button type="button" data-dismiss="alert" class="close">×</button>';
    $msg .= $_SESSION['msg_sucesso'];
    $msg .='</div>';
    echo $msg;
    unset($_SESSION['msg_sucesso']);
}

if (isset($_SESSION['msg_erro'])) {
    $msg = '<div class="alert alert-dismissable alert-danger">';
    $msg .= '<button type="button" data-dismiss="alert" class="close">×</button>';
    $msg .= $_SESSION['msg_erro'];
    $msg .='</div>';
    echo $msg;
    unset($_SESSION['msg_erro']);
}

//carrinho
//
$car_codigo = 0;

function set_carrinho($car_codigo) {
    $_SESSION['car_codigo'] = $car_codigo;
}

if (isset($_SESSION['car_codigo'])) {
    $car_codigo = $_SESSION['car_codigo'];
}

if (isset($_SESSION['car_codigo'])) {
    if ($car_codigo > 0) {
        $car_desencalhado = Connection::select("select Car_desencalhado from carrinho where car_codigo = '$car_codigo'")[0]['Car_desencalhado'];
        if ($car_desencalhado != 0) {            
            $_SESSION['car_codigo'] = 0;
            unset($_SESSION['car_codigo']);

            $domain = (($_SERVER['HTTP_HOST'] != 'localhost') ? '.' . $_SERVER['HTTP_HOST'] : false);
            setcookie(CART_COOKIE, $car_codigo, CART_COOKIE_EXPIRE, '/', $domain, false);
            $_SESSION['msg_sucesso'] = 'Carrinho de Compra zerado pelo Administrador da Loja';
        }
    }
}

function is_carrinho() {
    if (isset($_SESSION['car_codigo']) && $_SESSION['car_codigo'] > 0) {
        return true;
    }
    return false;
}

function rediciona_page($page) {
//    echo '<script type="text/javascript">
//$(location).attr(\'href\',' . $page . ');
//</script>';
    if (!empty($page)) {
        echo '<script>window.location.replace(' . $page . ');</script>';
    }
}

// usuário
//
$dao_usuario = new DaoUsuarios();
$usuario = new Usuarios();
$usu_codigo = 0;

if (isset($_SESSION['user'])) {
    $usu_codigo = $_SESSION['user'];
    $usuario = $dao_usuario->select($usu_codigo)[0];
}

function set_login($usu_codigo) {
    $_SESSION['user'] = $usu_codigo;
}

function verifica_acesso_permitido($permissao = '') {
    if (!login_logado()) {
        $_SESSION['msg_erro'] = 'Primeiro entre com suas Credênciais !';
        echo '<script>window.location.replace("login.php");</script>';
        return false;
    }
    global $usuario;
    if ($usuario->getUsu_permicao() == 'Client' || empty($usuario->getUsu_permicao())) {
        $_SESSION['msg_erro'] = 'Usuário nível Cliente não tem permissão para Acessar a Administração do Site !';
        echo '<script>window.location.replace("login.php");</script>';
        return false;
    }
    if (!empty($permissao)) {
        if ($usuario->getUsu_permicao() != $permissao) {
            $_SESSION['msg_erro'] = 'Infelizmente você não tem permissão !';
            echo '<script>window.location.replace("index.php");</script>';
            return false;
        }
    }
    return true;
}

//usuário admin
//usuário cliente
function login_logado() {
    if (isset($_SESSION['user']) && $_SESSION['user'] > 0) {
        return true;
    }
    return false;
}

?>