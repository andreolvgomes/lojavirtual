<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';
require_once BASEURL . 'persistence/connection.class.php';

$pro_codigo = $_POST['pro_codigo'];
$query = Connection::select("select Pro_estoque from produtos where Pro_codigo = '$pro_codigo'")[0];
$pro_estoque = $query['Pro_estoque'];
die(json_encode(array('pro_estoque' => $pro_estoque)));
?>