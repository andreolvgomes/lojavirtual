<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/helpers/init.php';

require_once BASEURL . 'persistence/daoEstados.class.php';
require_once BASEURL . 'persistence/daoCidades.class.php';
require_once BASEURL . 'admin/extensions/cadUsuarios.extension.php';

$daoestados = new DaoEstados();

$action = "cadUsuarios.php";
if ($acessado_a_partir_loja_compra) {
    $action = "register.php";
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <legend>
                <h1>Usuário</h1>
            </legend>
        </div>
    </div>
    <div class="row col-md-8">
        <form name="cadastro" action="<?= $action; ?>" method="post">
            <input type="hidden" value="<?= $usuario->getUsu_codigo(); ?>" name="txtUsu_codigo">
            <input type="hidden" value="<?= ($acessado_a_partir_loja_compra) ? 0 : 1; ?>" name="txtUsu_tipo">
            <input type="hidden" value="<?= $acessado_a_partir_loja_compra; ?>" name="txtAcessado_a_partir_loja_compra">
            <input type="hidden" value="<?= $usuario->getUsu_permicao(); ?>" name="txtUsu_permissao">

            <div class="form-group col-md-6">
                <label>Nome</label>
                <input type="text" class="form-control" name="txtUsu_nomecompleto" value="<?= $usuario->getUsu_nomecompleto(); ?>">
            </div>

            <div class="form-group col-md-6">
                <label>E-mail</label>
                <input type="email" class="form-control" name="txtUsu_email" value="<?= $usuario->getUsu_email(); ?>">
            </div>

            <div class="form-group col-md-6">
                <label>Senha</label>
                <input type="password" class="form-control" name="txtUsu_senha" value="<?= $usuario->getUsu_senha(); ?>">
            </div>

            <div class="form-group col-md-6">
                <label>Senha(Confirmação)</label>
                <input type="password" class="form-control" name="txtUsu_senhaConf" value="<?= $senha_confir; ?>">
            </div>
            <div class="form-group col-md-6">
                <label>Observação</label>
                <input type="text" class="form-control" name="txtUsu_observarcao" value="<?= $usuario->getUsu_observarcao(); ?>">
            </div>

            <?php if (!$acessado_a_partir_loja_compra): ?>
                <div class="form-group col-md-6">
                    <label>Permissão</label>
                    <select class="form-control" name="permissao">
                        <option>Client</option>                        
                        <option>User</option>
                        <option>Admin</option>
                    </select>
                </div>
            <?php endif; ?>

            <div class="form-group col-md-12">
                <h3>Endereço</h3>     
            </div>

            <div class="form-group col-md-6">
                <label>Estado</label>
                <select class="form-control" id="estado" name="estado">
                    <option></option>
                    <?php foreach ($daoestados->select() as $estado): ?>
                        <option value="<?= $estado->getEst_sequencial(); ?>" <?= ($usuario->getEst_sequencial() == $estado->getEst_sequencial()) ? 'selected' : ''; ?>><?= $estado->getEst_nome(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>cidade</label>
                <select class="form-control" id="cidade" name="cidade"></select>
            </div>

            <div class="form-group col-md-6">
                <label>Rua</label>
                <input type="text" class="form-control" name="txtUsu_rua" value="<?= $usuario->getUsu_rua(); ?>">
            </div>

            <div class="form-group col-md-6">
                <label>Numero</label>
                <input type="text" class="form-control" name="txtUsu_numero" value="<?= $usuario->getUsu_numero(); ?>">
            </div>

            <div class="form-group col-md-6">
                <label>Bairro</label>
                <input type="text" class="form-control" name="txtUsu_bairro" value="<?= $usuario->getUsu_bairro(); ?>">
            </div>

            <div class="form-group col-md-6">
                <label>Cep</label>
                <input type="text" class="form-control" name="txtUsu_cep" value="<?= $usuario->getUsu_cep(); ?>">
            </div>

            <div class="form-group col-md-12">
                <h3>Telefones</h3>
            </div>

            <div class="form-group col-md-6">
                <label>Telefone</label>
                <input type="text" class="form-control" name="txtUsu_telefone" value="<?= $usuario->getUsu_telefone(); ?>">
            </div>

            <div class="form-group col-md-6">
                <label>Celular</label>
                <input type="text" class="form-control" name="txtUsu_celular" value="<?= $usuario->getUsu_celular(); ?>">
            </div>

            <div class="form-group col-md-6">
                <?php if (!$acessado_a_partir_loja_compra): ?>
                    <a class="btn btn-danger" href="cadUsuariosTable.php"><span class="glyphicon glyphicon-remove"></span> Cancela</a>
                <?php endif; ?>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Salva</button>
            </div>
        </form>
    </div>
</div>
<script>
    cadastro.txtUsu_nomecompleto.focus();
    jQuery('select[name="estado"]').change(function () {
        get_Cidades();
    });

    jQuery('document').ready(function () {
        get_Cidades(<?= $usuario->getCid_sequencial(); ?>);
    });

    function get_Cidades(selected) {
        var est_sequencial = jQuery('#estado').val();
        if (est_sequencial != '') {
            jQuery.ajax({
                url: '/lojavirtual/admin/parsers/carregaCidades.php',
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
