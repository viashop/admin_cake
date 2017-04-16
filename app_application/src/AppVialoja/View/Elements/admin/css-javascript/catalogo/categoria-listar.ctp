<script type="text/javascript" src="/admin/js/ordenacao.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

		$('#loading').hide();
		$('#modal-error').hide();

        ordenar = new Ordenar('.categorias', '.categorias > li', '.categorias > li > div a.title', '/admin/catalogo/categoria/ordenar');

        $('.btn-ordenar').click(function() {
            if($('body').hasClass('sortable-active')) {
                $('.categorias > li > ol').slideDown();
                ordenar.destroySortable();
            } else {
                $('body').addClass('sortable-active');
                $('.categorias > li > ol').slideUp();
                $('.box-header .pull-left .check-container').hide();
                $('#btnSalvar, #btnOrdenarAlfabetica, #btnVoltar').show();
                ordenar.sortable();
            }
        });

        $('#btnOrdenarAlfabetica').click(function() {
            ordenar.ordenaAlfabetica();
        });

        $('#btnSalvar').click(function() {
			$('#modal-loading').modal('show');
            $.loader();
            ordenar.salva(function(data) {
                if(data.estado == 'SUCESSO') {
                    $.removeLoader();
                    $('body').removeClass('sortable-active');
                    $('.categorias > li > ol').slideDown();
                    ordenar.destroySortable();
                    $('.box-header .pull-left .check-container').show();
                    $('#btnSalvar, #btnOrdenarAlfabetica, #btnVoltar').hide();
                } else {
                    $.removeLoader();
                    $('#modal-error .error-text').html('Houve um erro ao salvar as alterações. Tente novamente!');
                    //$('#modal-error .error-text').html(data.mensagem);
                    jQuery.removeLoader();
                    $('#modal-error').modal('show');
                }
            });
        });

        $('#btnVoltar').click(function() {
            location.reload();
        });
    });
</script>
<style type="text/css">
    .box .form-actions { padding-left: 20px; }
</style>