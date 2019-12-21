<?php

class Categorias {

    private $cat_codigo = '';
    private $cat_descricao = '';
    private $cat_parent = '';

    function getCat_codigo() {
        return $this->cat_codigo;
    }

    function getCat_descricao() {
        return $this->cat_descricao;
    }

    function getCat_parent() {
        return $this->cat_parent;
    }

    function setCat_codigo($cat_codigo) {
        $this->cat_codigo = $cat_codigo;
    }

    function setCat_descricao($cat_descricao) {
        $this->cat_descricao = $cat_descricao;
    }

    function setCat_parent($cat_parent) {
        $this->cat_parent = $cat_parent;
    }

}
