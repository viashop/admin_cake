<style type="text/css">
    .table-url { border: none; margin: 0; }
    .table-url td { border: none; padding: 0 5px; vertical-align: middle; }
    .table-url td.table-url-domain { padding-right: 5px; }
    #control-group-url { padding: 10px; background: rgb(251, 251, 222); border-radius: 10px; margin-left: 180px; }
    #control-group-url label { font-weight: bold; float: none; }
    #control-group-url .controls { margin-left: 8px; }
    #control-group-url .help-text { margin: 10px 0 0 80px; }
    .control-seamless-editable i { cursor: pointer; }
    #url-remove { opacity: 0.3; }
    #url-remove:hover { opacity: 1; }
</style>
<script type="text/javascript" src="/admin/js/urlify.js"></script>
<script type="text/javascript">
    $(document).ready(function() {


        $('.form-categoria').submit(function() {

            var id_activity_shop = $('#id_activity_shop').val();

            if (id_activity_shop =="") {

                alert('Selecione o ramo de atividade para cadastrar a categoria, ela sera usada na indexação e organização de produtos na vitrine do Shopping ViaLoja.');
                return false;

            }

        });


        categorias_filhas = 0;
        permitir_desativar = false;
        $('.form-categoria').submit(function() {
            if (categorias_filhas && !permitir_desativar && ($('[name=ativa]').val() == 'False')) {
                $('#modal-categoria-inativa').modal('show');
                return false;
            }

            if (!url_editar_fechado) {
                $('#url-remove').click();
            }
        });

        $('#modal-categoria-inativa-prosseguir').click(function() {
            permitir_desativar = true;
            $('.form-categoria').submit();
        });

        // Ao preencher qualquer conteúdo no nome da categoria,
        // transforma o texto usando o URLify.
        $('#id_nome').keyup(function() {
            var self = $(this);

            var slug = URLify(self.val());
            $('#id_apelido').val(slug);

            // A criação do slug só é feita quando é possível
            // editar a URL pelo nome da categoria.
            if (!url_editar_pelo_nome) {
                return false;
            } else {
                var url = slug;
                $('.url-slug').text(url);
                $('#id_url').val(url);
            }
        });

        $('#id_url').keyup(function() {
            var self = $(this);

            var slug = URLify(self.val(), undefined, true);
            $('.url-slug').text(slug);
        });

        // Mostrando o formulário de edição da URL quando clicar no botão para
        // editar a URL.
        var acao_pagina = 'criar';
        var url_error = false;

        var url_editar_pelo_nome = acao_pagina == 'criar';
        var url_editar_fechado = url_error != true;
        var url_valida = url_error != true;

        var data_url_form = $('#id_url').data('url-form');
        var data_url_original = $('#id_url').data('url-original');

        if (!url_editar_fechado) {
            $('#url-remove').show();
            $('#url-edit').hide();
        } else {
            $('#url-remove').hide();
            $('#url-edit').show();
        }

        $('#url-edit').click(function() {
            $('#control-group-url').slideToggle();
            url_editar_fechado = !url_editar_fechado;

            $('#url-remove').show();

            if (url_editar_fechado) {
                validar_url()
                $('#url-edit').show();
            } else {
                $('#url-edit').hide();
            }

            return false;
        });

        var animar_url = function () {
            var item = $('.control-seamless-editable .control');
            bg_color = item.css('backgroundColor');
            bg_color_2 = '#90ba2c';

            change_color = function(color) {
                item.css('backgroundColor', color);
            }

            setTimeout('change_color(bg_color_2)', 500);
            setTimeout('change_color(bg_color)', 1000);
            setTimeout('change_color(bg_color_2)', 1500);
            setTimeout('change_color(bg_color)', 2000);
            setTimeout('change_color(bg_color_2)', 2500);
            setTimeout('change_color(bg_color)', 3000);
        }

        var mensagem_url_help_text = function(mensagem) {
            var parent = $('#control-group-url');

            if (!parent.find('.help-text').length) {
                var parent_controls = parent.find('.controls');
                $('<div class="help-text"></div>').appendTo(parent_controls);
            }

            parent.find('.help-text').html(mensagem);
        }

        var url_nao_preenchida = function() {
            var parent = $('#control-group-url');
            parent.removeClass('success').addClass('error');
            mensagem_url_help_text('É necessário preencher uma URL.');
        }

        var url_validada = function() {
            var parent = $('#control-group-url');
            parent.removeClass('error').addClass('success').find('.help-text').remove();
            $('#id_url').data('validada', true);
            url_valida = true;
            parent.slideUp();
            animar_url();
            $('#url-edit').show();
            url_editar_fechado = true;
        }

        var url_nao_validada = function() {
            var parent = $('#control-group-url');
            parent.removeClass('success').addClass('error');
            mensagem_url_help_text('A URL não é válida, tente novamente.');
            url_valida = false;
        }

        var validar_url = function() {
            var url = URLify($('#id_url').val());
            $('#id_url').val(url);

            $('#control-group-url .errorlist').remove();
            $('#url-validate').button('loading');

            if (!url) {
                $('#url-validate').button('reset');
                url_nao_preenchida();
            } else {
                var params = {url: url, csrfmiddlewaretoken: $('[name=csrfmiddlewaretoken]').val()};
                $.post('/admin/recurso/url/validar', params, function (data) {
                    $('#url-validate').button('reset');

                    if (data.sucesso) {
                        if (data.url_valida) {
                            url_validada();
                        } else {
                            url_nao_validada();
                        }
                    } else {
                        alert('Houve um erro ao tentar enviar os dados para validação. Por favor tente novamente.');
                    }
                }, 'json');
            }
        }

        $('#url-validate').click(validar_url);

        $('#url-remove').click(function() {
            var url_original = $('#id_url').data('url-original');

            $('#control-group-url').slideUp();

            $('#id_url').val('');
            $('.url-slug').html(url_original);

            if (!url_original) {
                $('#id_nome').keyup();
            }

            url_editar_fechado = true;
            url_valida = true;

            $('#url-remove').hide();
            $('#url-edit').show();
        });
    });
</script>