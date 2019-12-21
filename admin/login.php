<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';
require_once BASEURL . 'persistence/daoUsuarios.class.php';

$dao_usuarios = new DaoUsuarios();
$usuario = new Usuarios();

$title_login = 'Acesso ao Sistema';
$login_client = false;
if (isset($_GET['local'])) {
    $login_client = $_GET['local'] == 'loja';
}

$usuario = new Usuarios();

if ($_POST) {
    $errors = array();

    $login_client = $_POST['local'] == '1';
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
            
            $usuario = new Usuarios();
            $usuario->setUsu_email($_POST['txtUse_email']);
            $usuario->setUsu_senha($_POST['txtUse_senha']);
        }
    }

    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        set_login($usuario->getUsu_codigo());
        $name = explode(' ', $usuario->getUsu_nomecompleto())[0];
        $_SESSION['msg_sucesso'] = "Olá " . $name . ", seja bem vindo !!";
        if ($login_client)
            header('Location: ../index.php');
        else
            header('Location: index.php');
    }
}
if ($login_client) {
    $title_login = "Acesso a Loja";
}
?>

<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">

        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="icon" href="../assets/ico.ico">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>

        <title>Login</title>
        <style>
            login-form{
                width: 450px;
                height: 60%;
                border: 1px solid #000;
                border-radius:15px;
                box-shadow: 7px 7px 15px rgba(0,0,0,8);    
                margin: 7% auto;
                padding: 15px;    
                background-color: #fff; 
            }
            body {
                /*background: url('http://i.imgur.com/Eor57Ae.jpg') no-repeat fixed center center;*/
                background-size: cover;
                font-family: Montserrat;
            }

            .logo {
                width: 213px;
                height: 36px;
                /*background: url('http://i.imgur.com/fd8Lcso.png') no-repeat;*/
                margin: 30px auto;
            }

            .login-block {
                width: 320px;
                padding: 20px;
                background: #fff;
                border-radius: 5px;
                border-top: 5px solid #1b9bff;
                margin: 0 auto;
            }

            .login-block h1 {
                text-align: center;
                color: #000;
                font-size: 18px;
                text-transform: uppercase;
                margin-top: 0;
                margin-bottom: 20px;
            }

            .login-block input {
                width: 100%;
                height: 42px;
                box-sizing: border-box;
                border-radius: 5px;
                border: 1px solid #ccc;
                margin-bottom: 20px;
                font-size: 14px;
                font-family: Montserrat;
                padding: 0 20px 0 50px;
                outline: none;
            }

            .login-block input#username {
                background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
                background-size: 16px 80px;
            }

            .login-block input#username:focus {
                background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
                background-size: 16px 80px;
            }

            .login-block input#password {
                background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
                background-size: 16px 80px;
            }

            .login-block input#password:focus {
                /*background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;*/
                background-size: 16px 80px;
            }

            .login-block input:active, .login-block input:focus {
                border: 1px solid #1b9bff;
            }

            .login-block button {
                width: 100%;
                height: 40px;
                background: #1b9bff;
                box-sizing: border-box;
                border-radius: 5px;
                border: 1px solid #1b9bff;
                color: #fff;
                font-weight: bold;
                text-transform: uppercase;
                font-size: 14px;
                font-family: Montserrat;
                outline: none;
                cursor: pointer;
            }

            .login-block input[submit] {
                width: 100%;
                height: 40px;
                background: #1b9bff;
                box-sizing: border-box;
                border-radius: 5px;
                border: 1px solid #e15960;
                color: #fff;
                font-weight: bold;
                text-transform: uppercase;
                font-size: 14px;
                font-family: Montserrat;
                outline: none;
                cursor: pointer;
            }

            .login-block button:hover {
                background: #1b9bff;
            }

        </style>
    </head>  

    <body>
        <form action="login.php" method="post">
            <input type="hidden" name="local" value="<?= $login_client; ?>">

            <div class="logo"></div>
            <div class="login-block" style="">                
                <h1><?= $title_login; ?></h1>
                <input type="text" name="txtUse_email" placeholder="E-mail" id="username" value="<?= $usuario->getUsu_email(); ?>"/>
                <input type="password" name="txtUse_senha" placeholder="Senha" id="password"  value="<?= $usuario->getUsu_senha(); ?>"/>
                <button>Logar</button>

                <div class="row">
                    <div class="col-md-6">
                        <a href="../index.php">Ir para Loja</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <?php if ($login_client): ?>
                            <a href="../register.php?local=compra">Registrar</a>
                        <?php endif; ?>
                    </div>                    
                </div>

<!--<input  type="submit" value="Logar" class="btn btn-danger">-->
            </div>
        </form>
    </body>

</html>