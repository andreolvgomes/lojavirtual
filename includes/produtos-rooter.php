<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';
require_once '../persistence/connection.class.php';

$query = $_GET['query'];
$sql = "";
if ($query == 1) {
    $sql = "SELECT * FROM `produtos`
where Pro_imagens <> ''
order by Pro_datahora_cadastro desc
LIMIT 5";
} else if ($query = 2) {
    $sql = "SELECT * FROM `produtos`
where Pro_imagens <> ''
order by  Pro_datahora_ultima_visualizacao desc
LIMIT 5";
} else if ($query = 3) {
    $sql = "select * from (select Pro_codigo, sum(ite_quantidade) as quantidade_total from itenscarrinho
               inner join carrinho on itenscarrinho.Car_codigo = carrinho.Car_codigo
				where itenscarrinho.Ite_cancela = 0 and carrinho.Car_compraefetuada = 1
				group by Pro_codigo) as result
inner join produtos on result.pro_codigo = produtos.Pro_codigo
order by result.quantidade_total desc
limit 5";
}

$produtos = Connection::select($sql);

foreach ($produtos as $produto):
    $image = explode(';', $produto['Pro_imagens'])[0];
    ?>
    <div class="single-wid-product">
        <a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><img src="<?= $image; ?>" alt="" class="product-thumb"></a>
        <h2><a href="detalhes.php?pro_codigo=<?= $produto['Pro_codigo']; ?>"><?= $produto['Pro_descricao']; ?></a></h2>
        <div class="product-wid-rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="product-wid-price">
            <ins><?= format_decimal_simbolo($produto['Pro_pvenda']); ?></ins> <del><?= format_decimal_simbolo($produto['Pro_pvendatabela']); ?></del>
        </div>                            
    </div>
<?php endforeach; ?>
?>