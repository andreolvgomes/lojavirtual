<?php

require_once '../persistence/daoProdutos.class.php';
require_once '../persistence/daoMarcas.class.php';
require_once '../persistence/daoCategorias.class.php';

$dao_marcas = new DaoMarcas();
$dao_produtos = new DaoProdutos();
$dao_categorias = new DaoCategorias();

$produto = new Produtos();
$pro_imagens = '';
$cat_codigo_root = 0;
$uploadPath = array();

if ($_GET) {
    if (isset($_GET['update'])) {
        $produto = $dao_produtos->select($_GET['update'])[0];
        $cat_codigo_root = $dao_categorias->select($produto->getCat_codigo())[0]->getCat_parent();
    }
    if (isset($_GET['delete_image'])) {
        $produto = $dao_produtos->select($_GET['pro_codigo'])[0];
        $imgi = $_GET['imgi'] - 1;
        $images = explode(';', $produto->getPro_imagens());
        $image_path = $_SERVER['DOCUMENT_ROOT'] . $images[$imgi];

        // destroi as variáveis
        unlink($image_path);
        unset($image_path);
        unset($images[$imgi]);

        $produto->setPro_imagens(implode(';', $images));

        $dao_produtos->update($produto);
        header("Location: cadProdutos.php?update=" . $produto->getPro_codigo());
    }
}

if ($_POST) {
    $errors = array();

    $produto->setPro_codigo($_POST['txtPro_codigo']);
    $produto->setPro_descricao($_POST['txtPro_descricao']);
    $produto->setPro_pvenda($_POST['txtPro_pvenda']);
    $produto->setPro_pvendatabela($_POST['txtPro_pvendatabela']);
    $produto->setPro_detalhes($_POST['txtPro_detalhes']);
    $produto->setMar_codigo($_POST['selMarcas']);
    $produto->setPro_estoque($_POST['txtPro_estoque']);

    $photo_count = 0;
    if (isset($_FILES['photo'])) {
        $photo_count = count($_FILES['photo']['name']);
    }
    if (empty($produto->getPro_descricao())) {
        $errors[] = 'Informe a Descrição';
    } else if (empty($produto->getPro_pvenda())) {
        $errors[] = 'Informe o Preço de Venda';
    } else if (empty($produto->getPro_pvendatabela())) {
        $errors[] = 'Informe o Preço de Oferta';
    } else if (empty($produto->getMar_codigo())) {
        $errors[] = 'Escolha uma Marca';
    } else if (empty($_POST['selCategorias'])) {
        $errors[] = 'Escolha uma Categoria';
    } else if (empty($_POST['selSubCategorias'])) {
        $errors[] = 'Escolha uma SubCategoria';
    } else if ($photo_count > 0) {
        $is_valid = $_FILES['photo']['name'][0];
        if (empty($is_valid))
            $photo_count = 0;
        $allowed = array('png', 'jpg', 'jpeg', 'gif');
        for ($i = 0; $i < $photo_count; $i++) {
            $name = $_FILES['photo']['name'][$i];
            $nameArray = explode('.', $name);
            $fileName = $nameArray[0];
            $fileExt = $nameArray[1];
            $mime = explode('/', $_FILES['photo']['type'][$i]);
            $mimeType = $mime[0];
            $mimeExt = $mime[1];
            $tmpLoc[] = $_FILES['photo']['tmp_name'][$i];
            $fileSize = $_FILES['photo']['size'][$i];
            $uploadName = md5(microtime()) . $i . '.' . $fileExt;
            $uploadPath[] = BASEURL . 'image_upload/produto_' . $uploadName;
            if ($i != 0) {
                $pro_imagens .= ';';
            }
            $pro_imagens .= '/lojavirtual/image_upload/produto_' . $uploadName;
            if ($mimeType != 'image') {
                $errors[] = 'Imagem inválida';
            }
            if (!in_array($fileExt, $allowed)) {
                $errors[] = 'Imagem inválida, diferente de png, jpg, jpeg ou gif';
            }
            if ($fileSize > 15000000) {
                $errors[] = 'Imagem muito grande, maior que 25mb';
            }
            if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
                $errors[] = 'Imagem inválida';
            }
        }
    } else {
        if ($produto->getPro_codigo() > 0) {
            $cod = $produto->getPro_codigo();
            $pro_imagens = Connection::select("select Pro_imagens from produtos where Pro_codigo = '$cod'")[0]['Pro_imagens'];
        }
    }
    $produto->setPro_imagens($pro_imagens);

    if (!empty($errors)) {
        echo display_errors($errors);
    } else {
        if ($photo_count > 0) {
            for ($i = 0; $i < $photo_count; $i++) {
                move_uploaded_file($tmpLoc[$i], $uploadPath[$i]);
            }
        }
        $produto->setCat_codigo($_POST['selSubCategorias']);
        if ($produto->getPro_codigo() > 0) {
            if ($dao_produtos->update($produto)) {
                $_SESSION['msg_sucesso'] = 'Produto alterado com sucesso !';
                header('Location: cadProdutosTable.php');
            }
        } else {
            if ($dao_produtos->insert($produto)) {
                $_SESSION['msg_sucesso'] = 'Produto salvo com sucesso !';
                header('Location: cadProdutosTable.php');
            }
        }
    }
}
?>