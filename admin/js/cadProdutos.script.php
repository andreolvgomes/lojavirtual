<script>
    jQuery('document').ready(function () {
        get_child_options(<?= $produto->getCat_codigo(); ?>);
    });

    jQuery('select[name="selCategorias"]').change(function () {
        get_child_options();
    });

    function get_child_options(selected) {
        if (typeof selected === 'undefined') {
            var selected = '';
        }
        var cat_codigo = jQuery('#selCategorias').val();
        if (cat_codigo != '') {
            jQuery.ajax({
                url: '/lojavirtual/admin/parsers/carregaSubCategorias.php',
                type: 'post',
                data: {cat_codigo: cat_codigo, selected: selected},
                //data: {parent_id: parent_id},
                success: function (data) {
                    jQuery('#selSubCategorias').html(data);
                },
                error: function () {
                    alert('Erro carregaSubCategorias.php')
                }
            });
        }
    }
</script>