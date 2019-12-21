<?php
include 'includes/head.php';
include 'includes/navigation.php';

verifica_acesso_permitido('Admin');

require_once 'extensions/cadAndamento-Venda.extension.php';

$daoestados = new DaoEstados();
$andamentos = $dao_andamento->buscaRapido($car_codigo);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Andamento</h1>
            </legend>
            <legend>
                <div class="row">
                    <div class="col-md-6">
                        <h4><?= $venda['Usu_nomecompleto']; ?></h4>
                        <h4>Nº <?= $venda['Car_codigo']; ?></h4>
                    </div>
                    <div class="col-md-6">
                        <h4><?= $venda['Car_datahora_checkout']; ?></h4>
                        <h4><?= format_decimal_simbolo($venda['Car_total']); ?></h4>
                    </div>
                </div>
            </legend>
        </div>
    </div>

    <div class="row col-md-5">
        <form action="cadAndamento-Venda.php" method="post">
            <input type="hidden" name="txtCar_codigo" value="<?= $car_codigo; ?>">
            <input type="hidden" name="txtAnd_codigo" value="<?= $andamento->getAnd_codigo(); ?>">

            <div class="form-group col-md-6">
                <label>Estado</label>
                <select class="form-control" id="estado" name="estado">
                    <option></option>
                    <?php foreach ($daoestados->select() as $estado): ?>
                        <option <?= ($andamento->getEst_sequencial() == $estado->getEst_sequencial()) ? 'selected' : ''; ?> value="<?= $estado->getEst_sequencial(); ?>"><?= $estado->getEst_nome(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>Cidade</label>
                <select class="form-control" id="cidade" name="cidade"></select>
            </div>

            <div class="form-group col-md-12">
                <label>Detalhes</label>
                <textarea name="txtAnd_detalhes" class="form-control"><?= $andamento->getAnd_detalhes(); ?></textarea>
            </div>

            <div class="form-group col-md-12">
                <input type="checkbox" name="entrega_cooncluida">  Entrega Concluída<br>
            </div>

            <div class="form-group col-md-6">
                <?php if ($andamento->getAnd_codigo() == 0) { ?>
                    <a class="btn btn-danger" href="cadAntamento-VendaTable.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
                <?php } else { ?>
                    <a class="btn btn-danger" href="cadAndamento-Venda.php?car_codigo=<?= $car_codigo; ?>"><span class="glyphicon glyphicon-remove"></span> Cancela</a>
                <?php }
                ?>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Salva</button>
            </div>
        </form>
    </div>

    <div class="row col-md-7">
        <?php if (count($andamentos) > 0) { ?>
            <table class="table col-md-12 table-bordered table-condesed table-responsive">
                <thead>
                <th>ID</th> <th>Data/Hora</th> <th>Anterior</th> <th>Atual</th> <th>#</th>
                </thead>
                <tbody>
                    <?php foreach ($andamentos as $and): ?>
                        <tr>
                            <td><?= $and['And_codigo']; ?></td>                        
                            <td><?= $and['And_datahora']; ?></td>

                            <td><?= $and['And_detalhes_ant']; ?></td>
                            <td><?= $and['And_detalhes_atual']; ?></td>

                            <td width='100px' class="text-center">
                                <a class='btn btn-warning btn-sm' href='cadAndamento-Venda.php?update=<?= $and['And_codigo']; ?>&car_codigo=<?= $car_codigo; ?>' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                                <!--<a class='btn btn-danger btn-sm' href='cadAndamento-Venda.php?delete=<?= $and['And_codigo']; ?>&car_codigo=<?= $car_codigo; ?>' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>-->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Atenção!</strong> Não há andamentos !
            </div>
        <?php } ?>
    </div>
</div>

<script>
    jQuery('select[name="estado"]').change(function () {
        get_Cidades();
    });

    jQuery('document').ready(function () {
        get_Cidades(<?= $andamento->getCid_sequencial(); ?>);
    });

    function get_Cidades(selected) {
        var est_sequencial = jQuery('#estado').val();
        if (est_sequencial != '') {
            jQuery.ajax({
                url: 'parsers/carregaCidades.php',
                type: 'post',
                data: {est_sequencial: est_sequencial, selected: selected},
                success: function (data) {
                    jQuery('#cidade').html(data);
                },
                error: function () {
                    alert('Erro carregaCidades.php')
                }
            });
        }
    }
</script>
<?php include 'includes/footer.php'; ?>