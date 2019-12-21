<?php
include 'includes/head.php';
include 'includes/navigation.php';

require_once 'persistence/daoEstados.class.php';
require_once 'persistence/daoUsuarios.class.php';

$daoestados = new DaoEstados();
$dao_usuarios = new DaoUsuarios();
$usuario = new Usuarios();

if (!$_POST) {
    $usuario = $dao_usuarios->select($usu_codigo)[0];
}
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($_POST) {
    $errors = array();
    $usuario = $dao_usuarios->select($_POST['txtUsu_codigo'])[0];
    $usuario->setUsu_nomecompleto($_POST['txtUsu_nomecompleto']);

    $usuario->setUsu_rua($_POST['txtUsu_rua']);
    $usuario->setUsu_bairro($_POST['txtUsu_bairro']);
    $usuario->setUsu_cep($_POST['txtUsu_cep']);
    $usuario->setUsu_email($_POST['txtUsu_email']);
    $usuario->setUsu_celular($_POST['txtUsu_celular']);
    $usuario->setUsu_telefone($_POST['txtUsu_telefone']);
    $usuario->setEst_sequencial($_POST['estado']);

    if (isset($_POST['cidade'])) {
        $usuario->setCid_sequencial($_POST['cidade']);
    }
//    var_dump($usuario->getUsu_telefone());

    if (empty($usuario->getUsu_nomecompleto())) {
        $errors[] = 'Informe o Nome';
    } else if (empty($usuario->getUsu_rua())) {
        $errors[] = 'Informe a Rua';
    } else if (empty($usuario->getUsu_bairro())) {
        $errors[] = 'Informe o Bairro';
    } else if (empty($usuario->getEst_sequencial())) {
        $errors[] = 'Escolha o Estado';
    } else if (empty($usuario->getUsu_cep())) {
        $errors[] = 'Informe a Cep';
    } else if (empty($usuario->getUsu_telefone())) {
        $errors[] = 'Informe o Telefone';
    } else if (empty($usuario->getCid_sequencial())) {
        $errors[] = 'Informe a Cidade';
    }
    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        $dao_usuarios->update($usuario);

        echo "<script>"
        . "jQuery('document').ready(function () {
                $(location).attr('href', 'finalizacao.php');
                });"
        . "</script>";
    }
}
?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">                        

                        <form enctype="multipart/form-data" action="#" class="checkout" method="post" name="checkout">
                            <input type="hidden" name="txtUsu_codigo" value="<?= $usuario->getUsu_codigo(); ?>">

                            <div class="col-md-12">
                                <h3 id="order_review_heading">DADOS DE ENTREGA</h3>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Nome Completo</label>
                                <input type="text" class="form-control" name="txtUsu_nomecompleto" value="<?= $usuario->getUsu_nomecompleto(); ?>">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="txtUsu_rua" value="<?= $usuario->getUsu_rua(); ?>">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Bairro</label>
                                <input type="text" class="form-control" name="txtUsu_bairro" value="<?= $usuario->getUsu_bairro(); ?>">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Estado</label>
                                <select class="form-control" id="estado" name="estado">
                                    <option></option>
                                    <?php foreach ($daoestados->select() as $estado): ?>
                                        <option value="<?= $estado->getEst_sequencial(); ?>" <?= ($usuario->getEst_sequencial() == $estado->getEst_sequencial()) ? 'selected' : ''; ?>><?= $estado->getEst_nome(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Cidade</label>
                                <select class="form-control" id="cidade" name="cidade"></select>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>CEP</label>
                                <input type="text" class="form-control" name="txtUsu_cep" value="<?= $usuario->getUsu_cep(); ?>">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input type="text" class="form-control" name="txtUsu_email" value="<?= $usuario->getUsu_email(); ?>">
                            </div>                            

                            <div class="col-md-6 form-group">
                                <label>Telefone Fixo</label>
                                <input type="text" class="form-control" name="txtUsu_telefone" value="<?= $usuario->getUsu_telefone(); ?>">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Celular</label>
                                <input type="text" class="form-control" name="txtUsu_celular" value="<?= $usuario->getUsu_celular(); ?>">
                            </div>

                            <div class="col-md-12">
                                <h3 id="order_review_heading">FORMA DE PAGAMENTO</h3>

                                <div id="order_review" style="position: relative;">
                                    <div id="payment">
                                        <ul class="payment_methods methods">
                                            <li class="payment_method_bacs">
                                                <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                                <label for="payment_method_bacs">Boleto  </label>
                                                <div class="payment_box payment_method_bacs">
                                                    <p>A mercadoria só será liberada depois do pagamentos do boleto, prazo de até 15 dias para tá efetuando o pagamento.</p>
                                                </div>
                                            </li>
                                            <li class="payment_method_paypal">
                                                <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                                                <label for="payment_method_paypal">Cartão(PayPal) <img alt="PayPal Acceptance Mark" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a title="What is PayPal?" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup', 'WIPaypal', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700');
                                                        return false;" class="about_paypal" href="https://www.paypal.com/gb/webapps/mpp/paypal-popup"></a>
                                                </label>
                                                <div class="payment_box payment_method_paypal">
                                                    <p>A mercadoria só será liberda depois da confirmação do pagamento pela operador do cartão de crédito.</p>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="form-row place-order">
                                            <input type="submit" data-value="Place order" value="Finalizar" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
                                            <!--<a class="btn btn-primary" href="finalizacao.php"><span class="glyphicon glyphicon-plus"></span> Finalizar</a>-->
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </form>                
                    </div>                       
                </div>                    
            </div>
        </div>
    </div>
</div>
<script>

    jQuery('select[name="estado"]').change(function () {
        get_Cidades();
    });

    jQuery('document').ready(function () {
        get_Cidades(<?= $usuario->getCid_sequencial(); ?>);
    });

    function get_Cidades(selected) {
        if (typeof selected === 'undefined') {
            var selected = '';
        }
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

<?php include 'includes/footer.php'; ?>