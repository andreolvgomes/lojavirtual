<?php
include 'includes/head.php';
include 'includes/navigation.php';

verifica_acesso_permitido('Admin');

require_once BASEURL . 'persistence/daoProdutos.class.php';
require_once BASEURL . 'persistence/daoCategorias.class.php';

$dao_produtos = new DaoProdutos();
$dao_categorias = new DaoCategorias();
$produtos_em_falta = $dao_produtos->buscaResultadoProdutosEmFalta();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Produtos em falta no Estoque</h1>
            </legend>
        </div>
    </div>

    <div class="row">
        <?php if (count($produtos_em_falta) > 0) { ?>
            <table class="table table-bordered table-condesed table-striped">
                <thead>
                <th>Código</th> <th>Descrição</th> <th>Preço Venda</th> <th>Preço Oferta</th> <th>Marca</th> <th>Categoria</th> <th>Estoque</th>
                </thead>
                <tbody>
                    <?php foreach ($produtos_em_falta as $produto): ?>
                        <tr>
                            <td><?= $produto['Pro_codigo']; ?></td>
                            <td><?= $produto['Pro_descricao']; ?></td>
                            <td><?= format_decimal_simbolo($produto['Pro_pvenda']); ?></td>
                            <td><?= format_decimal_simbolo($produto['Pro_pvendatabela']); ?></td>
                            <td><?= $produto['Mar_descricao']; ?></td>
                            <td><?= $dao_categorias->buscaDescricaoCategoriaProduto($produto['Cat_codigo']); ?></td>
                            <td><?= format_decimal($produto['Pro_estoque']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Atenção!</strong> Não há Resultados !
            </div>
        <?php } ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>