<script>
    cadastro.txtUsu_nomecompleto.focus();
     jQuery('select[name="estado"]').change(function () {
        get_Cidades();
    });
    
    function get_Cidades(selected){
    var est_sequencial = jQuery('#estado').val();
    if(est_sequencial !=''){
          jQuery.ajax({
                url:'/lojavirtual/admin/parsers/carregaCidades.php',
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
