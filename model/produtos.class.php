<?php

class Produtos {

    private $pro_codigo = '';
    private $pro_descricao = '';
    private $pro_detalhes = '';
    private $pro_pvenda = '';
    private $pro_pvendatabela = '';
    private $pro_imagens = '';
    private $mar_codigo = '';
    private $pro_destaque = '';
    private $cat_codigo = '';
    private $pro_datahora_ultima_visualizacao;
    private $pro_estoque = 0;

    function getPro_codigo() {
        return $this->pro_codigo;
    }

    function getPro_descricao() {
        return $this->pro_descricao;
    }

    function getPro_detalhes() {
        return $this->pro_detalhes;
    }

    function getPro_pvenda() {
        return $this->pro_pvenda;
    }

    function getPro_pvendatabela() {
        return $this->pro_pvendatabela;
    }

    function getPro_imagens() {
        return $this->pro_imagens;
    }

    function getMar_codigo() {
        return $this->mar_codigo;
    }

    function getPro_destaque() {
        return $this->pro_destaque;
    }

    function getCat_codigo() {
        return $this->cat_codigo;
    }

    function setPro_codigo($pro_codigo) {
        $this->pro_codigo = $pro_codigo;
    }

    function setPro_descricao($pro_descricao) {
        $this->pro_descricao = $pro_descricao;
    }

    function setPro_detalhes($pro_detalhes) {
        $this->pro_detalhes = $pro_detalhes;
    }

    function setPro_pvenda($pro_pvenda) {
        $this->pro_pvenda = $pro_pvenda;
    }

    function setPro_pvendatabela($pro_pvendatabela) {
        $this->pro_pvendatabela = $pro_pvendatabela;
    }

    function setPro_imagens($pro_imagens) {
        $this->pro_imagens = $pro_imagens;
    }

    function setMar_codigo($mar_codigo) {
        $this->mar_codigo = $mar_codigo;
    }

    function setPro_destaque($pro_destaque) {
        $this->pro_destaque = $pro_destaque;
    }

    function setCat_codigo($cat_codigo) {
        $this->cat_codigo = $cat_codigo;
    }

    function getPro_datahora_ultima_visualizacao() {
        return $this->pro_datahora_ultima_visualizacao;
    }

    function setPro_datahora_ultima_visualizacao($pro_datahora_ultima_visualizacao) {
        $this->pro_datahora_ultima_visualizacao = $pro_datahora_ultima_visualizacao;
    }
    function getPro_estoque() {
        return $this->pro_estoque;
    }

    function setPro_estoque($pro_estoque) {
        $this->pro_estoque = $pro_estoque;
    }


}
