<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/persistence/connection.class.php';
include 'includes/head.php';
include 'includes/navigation.php';

include_once '../persistence/daoMarcas.class.php';

$dao_marcas = new DaoMarcas();

$mar_codigo = 0;
$mar_descricao = '';
$is_update = false;

//http://www.aldeiarpg.com/t12328-poo-basico-separando-codigo-html-do-php
//echo rand(1000, 1000000000);

if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $mar_codigo = $_GET['delete'];
    if ($dao_marcas->marca_utilizada($mar_codigo)) {
        $_SESSION['msg_erro'] = "Impossível excluir, Marca já está sendo utilizada !";
    } else {
        $dao_marcas->delete($mar_codigo);
    }
    header('Location: cadMarcas.php');
}
if (isset($_GET['update']) && !empty($_GET['update'])) {
    $mar_codigo = $_GET['update'];
    $marca = $dao_marcas->select($mar_codigo)[0];
    $mar_descricao = $marca->getMar_descricao();
    $is_update = true;
}
if ($_POST) {
    $mar_descricao = $_POST['txtMar_descricao'];
    $mar_codigo = $_POST['txtMar_coidgo'];
    $is_update = ($mar_codigo > 0);

    $marca = new Marcas();
    $marca->setMar_descricao($mar_descricao);
    $marca->setMar_codigo($mar_codigo);
    $errors = array();

    if (empty($marca->getMar_descricao())) {
        $errors[] = 'Informe a Descrição da Marca';
    }
    if ($is_update) {
        if ($dao_marcas->existeByMar_codigo($marca)) {
            $errors[] = $marca->getMar_descricao() . ' já está cadastrada';
        }
    } else {
        if ($dao_marcas->existeByMar_descricao($marca)) {
            $errors[] = 'Marca ' . $marca->getMar_descricao() . ' já está cadastrada';
        }
    }
    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        if ($is_update) {
            $dao_marcas->update($marca);
        } else {
            $dao_marcas->insert($marca);
        }
        header('Location: cadMarcas.php');
    }
}

$total_rows = $dao_marcas->getCount();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Marcas</h1>
            </legend>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
            <form action="cadMarcas.php" method="post">
                <input type="hidden" name="txtMar_coidgo" value="<?= $mar_codigo; ?>">

                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" class="form-control" name="txtMar_descricao" value="<?= $mar_descricao; ?>"/>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-danger btn-block" href="cadMarcas.php"><span class="glyphicon glyphicon-remove"></span> Cancela</a>
                        </div>
                        <div class="col-md-6">                            
                            <button type="submit" class="btn btn-primary  btn-block"><span class="glyphicon glyphicon-floppy-saved"></span> Salva</button>
                        </div>
                    </div>
                </div>
            </form>               
            <div class="form-group">
                <?php if ($total_rows > 0) { ?>
                    <table  class="table table-bordered table-hover table-striped">
                        <thead>
                        <th>#</th> <th>Descrição</th> <th class="text-center">Ação</th>
                        </thead>
                        <tbody>
                            <?php foreach ($dao_marcas->select() as $marca): ?>
                                <tr>
                                    <td><?= $marca->getMar_codigo(); ?></td>
                                    <td><?= $marca->getMar_descricao(); ?></td>

                                    <td width='100px' class="text-center">
                                        <a class='btn btn-warning btn-sm' href='cadMarcas.php?update=<?= $marca->getMar_codigo(); ?>' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                                        <a class='btn btn-danger btn-sm' href='cadMarcas.php?delete=<?= $marca->getMar_codigo(); ?>' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong>Atenção!</strong> Não há Marcas para visualizar.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>