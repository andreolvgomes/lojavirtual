<?php
include 'includes/head.php';
include 'includes/navigation.php';

verifica_acesso_permitido();
?>

<link rel="stylesheet" href="../assets/css/demo.css">
<link rel="stylesheet" href="../assets/css/footer-distributed-with-address-and-phones.css">

<div class="container">
    <!--<h1 class="text-center">Administração</h1>-->
</div>

<script src="../assets/js/jquery.backstretch.min.js"></script>

<style>
    .backstretch img {
        opacity: 0.1;
        filter: alpha(opacity=10);
    }  
</style>
<script>
    $.backstretch([
        "backgrounds/1.jpg"
                , "backgrounds/2.jpg"
                , "backgrounds/3.png"
                , "backgrounds/4.jpg"
    ], {duration: 3000, fade: 1000});
//    ], {duration: 3000, fade: 750});
</script>

