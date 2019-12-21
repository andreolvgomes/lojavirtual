<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once './extensions/cadTamanhos.extension.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Tamanho</h1>
            </legend>
        </div>
    </div>
    <div class="row col-md-6">
        <form name="cadastro" action="cadTamanhos.php" method="post">
            <div class="row">
                <input type="hidden" name="txtPro_codigo" value="<?= $tamanho->getPro_codigo(); ?>"/>
                <input type="hidden" name="txtTam_codigo" value="<?= $tamanho->getTam_codigo(); ?>"/>

                <div class="form-group col-md-8">
                    <label>Tamanho</label>
                    <input type="text" class="form-control" name="txtTam_tamanho" value="<?= $tamanho->getTam_tamanho(); ?>"/>
                </div>
                <div class="form-group col-md-4">
                    <label>Quantidade</label>
                    <input type="number" class="form-control" name="txtTam_quantidade" value="<?= $tamanho->getTam_quantidade(); ?>"/>
                </div>
            </div>
            <p>
                <a class="btn btn-danger" href="cadTamanhosTable.php"><span class="glyphicon glyphicon-remove"></span> Cancela</a>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Salva</button>
            </p>
        </form>
        <hr>
    </div>
</div>
<?php include 'includes/footer.php'; ?>