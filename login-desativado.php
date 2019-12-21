<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';
require_once BASEURL . 'login.extension.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>

        <link rel="stylesheet" href="assets/css/reset-login1.css">
        <link rel="stylesheet" href="assets/css/styles-login1.css">

        <link rel="stylesheet" href="assets/css/bootstrap.css">

        <link rel="icon" href="assets/ico.ico">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

        <style>
            body{
                margin-top: 30px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="card"></div>
            <div class="card">
                <h1 class="title">Login</h1>
                <form action="login.php" method="post">

                    <div class="input-container">
                        <input type="text" id="Username" name="txtUse_email" value="<?= $usuario->getUsu_email(); ?>"/>
                        <label for="Username">E-mail</label>
                        <div class="bar"></div>
                    </div>

                    <div class="input-container">
                        <input type="password" id="Password" name="txtUse_senha" value="<?= $usuario->getUsu_senha(); ?>"/>
                        <label for="Password">Senha</label>
                        <div class="bar"></div>
                    </div>
               
                    <div class="form-group">
                             <div class="button-container">
                        <button><span>Logar</span></button>                        
                    </div>
                        <a href="register.php?local=compra">Registrar</a>
                    </div>
                </form>
            </div>
        </div>

        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="assets/js/index-login1.js"></script>
    </body>
</html>
