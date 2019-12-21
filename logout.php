<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

$_SESSION['user'] = 0;
unset($_SESSION['user']);

header('Location: index.php');
?>