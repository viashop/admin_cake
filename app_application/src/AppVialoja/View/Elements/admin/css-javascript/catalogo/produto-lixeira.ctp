<script type="text/javascript">
    $(document).ready(function() {
        $('.submit-form').click(function(event) {
            event.preventDefault();
            var formulario = $('#formulario-acao');
            if ($(this).hasClass('recuperar')) {
                formulario.attr('action', '/admin/catalogo/produto/lixeira/recupera');
            }
            formulario.submit();
        });
    });
</script>