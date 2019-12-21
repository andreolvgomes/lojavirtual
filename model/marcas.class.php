<?php


class Marcas {
   private  $mar_codigo;
   private  $mar_descricao;
   
   function getMar_codigo() {
       return $this->mar_codigo;
   }

   function getMar_descricao() {
       return $this->mar_descricao;
   }

   function setMar_codigo($mar_codigo) {
       $this->mar_codigo = $mar_codigo;
   }

   function setMar_descricao($mar_descricao) {
       $this->mar_descricao = $mar_descricao;
   }


   
}
