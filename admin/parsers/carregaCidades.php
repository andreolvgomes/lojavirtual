<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lojavirtual/persistence/daoCidades.class.php';
$est_sequencial = $_POST['est_sequencial'];
$selected = $_POST['selected'];
$daoCidades = new daoCidades();
ob_start();
?>
<option value=""></option>
<?php foreach ($daoCidades->selectCidadeEstados($est_sequencial) as $cidade): ?>
    <option value="<?= $cidade->getCid_sequencial() ?>" <?= ($selected == $cidade->getCid_sequencial()) ? 'selected' : ''; ?> > <?= $cidade->getCid_nome() ?> </option>
<?php endforeach; ?>
<?php echo ob_get_clean(); ?>