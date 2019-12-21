<?php

//require_once BASEURL . 'persistence/connection.class.php';

function novos() {
    $sql = "SELECT * FROM `produtos`
where Pro_imagens <> ''
order by Pro_datahora_cadastro desc
LIMIT 5";
    return Connection::select($sql);
}

function mais_vendidos() {
    $sql = "select * from (select Pro_codigo, sum(ite_quantidade) as quantidade_total from itenscarrinho
               inner join carrinho on itenscarrinho.Car_codigo = carrinho.Car_codigo
where itenscarrinho.Ite_cancela = 0 and carrinho.Car_compraefetuada = 1
group by Pro_codigo) as result
inner join produtos on result.pro_codigo = produtos.Pro_codigo
order by result.quantidade_total desc
limit 5";
    return Connection::select($sql);
}

function mais_visto_recente() {
    $sql = "SELECT * FROM `produtos`
where Pro_imagens <> '' and Pro_datahora_ultima_visualizacao <> ''
order by  Pro_datahora_ultima_visualizacao desc
LIMIT 5";
    return Connection::select($sql);
}

function mais_vendido_by_categoria($car_codigo) {
    $sql = "select * from (select Pro_codigo, sum(ite_quantidade) as quantidade_total from itenscarrinho
inner join carrinho on itenscarrinho.Car_codigo = carrinho.Car_codigo
where itenscarrinho.Ite_cancela = 0 and carrinho.Car_compraefetuada = 1
group by Pro_codigo) as result
inner join produtos on result.pro_codigo = produtos.Pro_codigo
where produtos.Cat_codigo = '$car_codigo'
order by result.quantidade_total desc
limit 5";

    return Connection::select($sql);
}

function mais_visto_recente_by_categoria($car_codigo) {
    $sql = "SELECT * FROM `produtos`
where Pro_imagens <> '' and Pro_datahora_ultima_visualizacao <> '' and Cat_codigo = '$car_codigo'
order by  Pro_datahora_ultima_visualizacao desc
LIMIT 5";
    return Connection::select($sql);
}

?>