    function mudar_root(data) {
        if(!$('.breadcrumb-categorias-mercadolivre').is(':visible')) {
            $('.breadcrumb-categorias-mercadolivre').show();
        }
        $('.breadcrumb-categorias-mercadolivre').find('li').remove();
        $('.breadcrumb-categorias-mercadolivre').append('<li><a class="categoria" href="#">Início</a> <span class="divider">/</span></li>');
        $.each(data[2]['path_from_root'], function(key, value){
            $('.breadcrumb-categorias-mercadolivre').append('<li><a class="categoria" id="' + value.id + '" href="#">' + value.name + '</a> <span class="divider">/</span></li>');
        });
    }
    function get_categorias(categoria_id, callback){
        if(categoria_id) {
            MELI.get('/categories/' + categoria_id, {}, callback);
        }else{
            MELI.get('/sites/MLB/categories', {}, callback);
        }
    }
    function mudar_categoria(data){
        var lista = $('ul.categorias');
        lista.find('li').remove();
        if (data[2]['children_categories']){
            mudar_root(data);
            if(data[2]['children_categories'].length > 0){
                $('.informacoes').hide();
                $('#finalizar').addClass('disabled').removeAttr('data-dismiss');
                $.each(data[2]['children_categories'], function(key, value){
                    lista.append('<li><a class="categoria" id="' + value.id  + '" href="#">' + value.name + '</a></li>');
                });
                $("input[name='anunciar_por']").attr('disabled', 'disabled').attr('checked', false);
                $('.integracao-container .inner').slideUp();
            }else {
                $('.titulo-categoria').html(data[2]['name']);
                // $('.total-produtos').html(data[2]['total_items_in_this_category']);
                // console.log(data);
                $('#finalizar').data('categoria', data[2]['id']);
                $('.informacoes').show();
                $('#finalizar').removeClass('disabled').attr('data-dismiss','modal');
                $("input[name='anunciar_por']").removeAttr('disabled');
            }

        }else{
            $('.informacoes').hide();
            $('#finalizar').addClass('disabled').removeAttr('data-dismiss');
            $.each(data[2], function(key, value){
                lista.append('<li><a class="categoria" id="' + value.id  + '" href="#">' + value.name + '</a></li>');
            });
        }

    }

    function produto_atributos(data) {
        global_data = data;
        atributos = false;
        if (Object.keys(data.atributos).length > 0) {
            atributos = true;
            $('.atributos_categoria').show();
            $('.disabilitar-integracao').attr('disabled', 'disabled');
            $('.disabilitar-integracao').parents('.integracao-container').slideUp();
            if (data.required === true)  {
                $('.atributos_categoria .required').show();
            } else {
                $('.atributos_categoria .not-required').show();
            }
            $.each(data.atributos, function(atributo, dados) {
                var li = '<li><strong>:NOME:</strong></li>';
                li = li.replace(':NOME:', dados.nome);
                $('ul.atributos').append(li);
                if(dados.variacoes) {
                    var select_name = '<select id=":GRADE:" class="input-small" name="produto_grade_:GRADE:_pai_:PRODUTOIDPAI:_produto_id_:PRODUTOID:">';
                    select_name = select_name.replace(':GRADE:', atributo).replace(':GRADE:', atributo);
                    var select = select_name;
                    for (var id in dados.variacoes) {
                        var nome = dados.variacoes[id];
                        select += '<option value="'+ id + '" >' + nome + "</option>"
                    }
                    select += '</select>'
                    $('.grades').append("<div class='atributo span5'>" + select +  '</div>');
                } else {
                    var input_name = '<input id=":GRADE:" class="input-small" name="produto_grade_:GRADE:_pai_:PRODUTOIDPAI:_produto_id_:PRODUTOID:">';
                    input_name = input_name.replace(':GRADE:', atributo).replace(':GRADE:', atributo);
                    $('.grades').append("<div class='atributo span5'>" + input_name + '</div>');

                }
                if(dados.required == true) {
                    var label = '<label>' + dados.nome + '<span class="text-error">*</span>:</label>';
                } else {
                    var label = '<label>' + dados.nome + ':</label>';
                }
                // console.log(label);
                $('#'+atributo).before(label);
            });
        } else {
            $('.atributos_categoria').hide();
            $('.disabilitar-integracao').removeAttr('disabled');
            $('.disabilitar-integracao').parents('.integracao-container').slideDown();
        }
    }

    function finalizar(event){
        event.preventDefault();
        var categoria_id = $(this).data('categoria');
        var next = $(this).data('next');
        var target = $(this).data('target');
        var url_categoria_atributos = $(this).data('url');

        $.getJSON(url_categoria_atributos, {'categoria_id': categoria_id}, produto_atributos);

        var url = $(this).attr('href');
        $('.breadcrumb-categorias-mercadolivre li:last-child .divider').remove();
        $('#id_categoria').val(categoria_id);
        if (url[0] != '#') {
            $.post(url, {categoria_id: categoria_id}, function(data){
                var json = $.parseJSON(data);
                if (json.error) {
                    alert(json.erro);
                }else{
                    $('#modal-mercadolivre').modal('hide');
                    if(next) {
                        window.location = next;
                    }
                }
            });
        }
        $('[name=anunciar_por]').removeAttr('disabled');
        // $.post()
        // console.log(categoria_id);
        // var url = ''
        // $.post()

    }
    function alterar_categoria(event) {
        event.preventDefault();
        $(this).parent().hide();
    }
    function run(event) {
        event.preventDefault();
        var categoria_id = $(this).attr('id') || false;
        get_categorias(categoria_id, mudar_categoria);
    }
    $(document).ready(function(){
        if (typeof MELI === 'undefined') {
            if (console != undefined && console.log) {
                // console.log('MELI não foi encontrado.');
                return false;
            }
        }
        MELI.init({client_id: MERCADOLIVRE_CLIENT_ID});
        get_categorias(false, mudar_categoria);
        $('a.categoria').live('click', run);
        // $('a.finalizar').click(finalizar);
        $('#finalizar').click(finalizar);
    });
