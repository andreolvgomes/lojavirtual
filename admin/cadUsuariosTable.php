<?php
include 'includes/head.php';
include 'includes/navigation.php';

verifica_acesso_permitido('Admin');

require_once '../persistence/daoUsuarios.class.php';
$dao_usuarios = new DaoUsuarios();
$total_rows = $dao_usuarios->getCount();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Usuários</h1>
            </legend>
        </div>
    </div>
    <div class="row">
        <p>
            <a class="btn btn-primary" href="cadUsuarios.php"><span class="glyphicon glyphicon-plus"></span> Cadastrar Usuário</a>
        </p>
        <?php if ($total_rows > 0) { ?>
            <table  class="table table-bordered table-hover table-striped">
                <thead>
                <th>Nome</th> <th>E-mail</th> <th>Observação</th> <th class="text-center">Permissão</th> <th>Ação</th>
                </thead>
                <tbody>
                    <?php foreach ($dao_usuarios->select() as $usuario): ?>
                        <tr>
                            <td><?= $usuario->getUsu_nomecompleto(); ?></td>
                            <td><?= $usuario->getUsu_email(); ?></td>
                            <td><?= $usuario->getUsu_observarcao(); ?></td>
                            <td><?= $usuario->getUsu_permicao(); ?></td>
                            
                            <td width='100px' class="text-center">
                                <a class='btn btn-warning btn-sm' href='cadUsuarios.php?update=<?= $usuario->getUsu_codigo(); ?>' role='button'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>
                                <a class='btn btn-danger btn-sm' href='cadUsuariosDelete.php?usu_codigo=<?= $usuario->getUsu_codigo(); ?>' role='button'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Atenção!</strong> Não há Usuários para visualizar. Clique em novo para cadastrar !
            </div>
        <?php } ?>
    </div>
</div>
<?php include 'includes/footer.php'; ?>