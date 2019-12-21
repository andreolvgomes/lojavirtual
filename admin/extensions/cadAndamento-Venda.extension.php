<?php

require_once BASEURL . 'persistence/daoEstados.class.php';
require_once BASEURL . 'persistence/daoCidades.class.php';
require_once BASEURL . 'persistence/daoCarrinho.class.php';
require_once BASEURL . 'persistence/daoAndamento_Venda.class.php';

$dao_andamento = new daoAndamento_Venda();
$dao_carrinho = new DaoCarrinho();
$andamento = new Andamento_venda();

$car_codigo = 0;

if ($_GET) {
    if (isset($_GET['car_codigo'])) {
        $car_codigo = $_GET['car_codigo'];
    }
    if (isset($_GET['delete'])) {
        $dao_andamento->delete($_GET['delete']);
    }
    if (isset($_GET['update'])) {
        $and_codigo = $_GET['update'];
        $andamento = $dao_andamento->select($and_codigo)[0];
    }
}
if ($_POST) {
    $errors = array();
    $car_codigo = $_POST['txtCar_codigo'];

    $andamento->setAnd_codigo($_POST['txtAnd_codigo']);
    if ($andamento->getAnd_codigo() > 0)
        $andamento = $dao_andamento->select($andamento->getAnd_codigo())[0];

    $andamento->setCar_codigo($car_codigo);
    $andamento->setAnd_detalhes($_POST['txtAnd_detalhes']);
    $andamento->setEst_sequencial($_POST['estado']);

    if (isset($_POST['cidade'])) {
        $andamento->setCid_sequencial($_POST['cidade']);
    }

    if (empty($andamento->getEst_sequencial())) {
        $errors[] = 'Escolha o Estado';
    } else if (empty($andamento->getCid_sequencial())) {
        $errors[] = 'Escolha a Cidade';
    } else if (empty($andamento->getAnd_detalhes())) {
        $errors[] = 'Informe o Detalhamento do Andamento';
    }

    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        if ($andamento->getAnd_codigo() > 0) {
            $dao_andamento->update($andamento);
        } else {
            $and_codigo_anterior = $dao_andamento->buscaLastAnd_codigo($car_codigo);
            $andamento->setAnd_codigo_anterior($and_codigo_anterior);
            $dao_andamento->insert($andamento);
        }
        if (isset($_POST['entrega_cooncluida'])) {
            $carrinho = $dao_carrinho->select($car_codigo)[0];
            $carrinho->setCar_status_andamento(2);
            $dao_carrinho->update($carrinho);
            header('Location: cadAntamento-VendaTable.php');
        }
        $andamento = new Andamento_venda();
    }
}

$venda = $dao_carrinho->buscaCarrinho($car_codigo);
?>