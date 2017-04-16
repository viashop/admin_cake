<script type="text/javascript" src="/admin/js/ckeditor/ckeditor.js"></script>
<style type="text/css">
    h3 small { font-size: 12px; }
    .ativo {box-shadow:0 0 10px; }
    .tooltip {z-index: 50000;}
    .produto-destaque-icon-star { background: url('/admin/img/icon-star.png') no-repeat top; width: 16px; height: 16px; display: inline-block; }
    .produto-destaque-icon-star.off { background-image: url('/admin/img/icon-star-off.png'); }
    .imagem_grade {display: inline-block; margin:5px;}
    .imagem_grade img {max-width: 80px; margin: 5px; }
    .form-produto .label-produto-titulo { margin-bottom: 0; }
    .form-produto .label-produto-titulo > div { overflow: hidden; }
    .contador { font-size: 11px; margin-top: 10px; margin-bottom: 0; }
    .contador.bot { margin-top: 0; }
    #ProdutoGradeVariacaoImagem {text-align:center;}
    #EscolherCor {width:900px; margin-left:-450px;}
    .tipo-produto .titulo { float: none; margin-bottom: -30px; }
    .tipo-produto .box-content .items { margin: 40px auto 0; }
    .tipo-produto .box-content p.help-block { margin: 0 auto; }
    .tipo-produto .box-content ul { display: inline; margin: 30px 0 0 0; }
    .tipo-produto .box-content ul li { margin: 0; float: none; display: inline-block; width: 49.8% }
    .tipo-produto .box-content ul li:last-child { margin: 0; }
    .tipo-produto .box-content ul li label { padding: 90px 0 10px 0; text-align: center; border-radius: 5px; cursor: pointer; }
    .tipo-produto .box-content ul li label[for=id_tipo_0] { background: #EEE url('/admin/img/produto-simples.png') 50% 15px no-repeat; }
    .tipo-produto .box-content ul li label[for=id_tipo_1] { background: #EEE url('/admin/img/produto-com-opcoes.png') 50% 15px no-repeat; }
    .tipo-produto .box-content ul li label[for=id_tipo_2] { background: #EEE url('/admin/img/mercadolivre.png') 50% 15px no-repeat; }
    .tipo-produto .box-content ul li label.selecionado { background: #999; color: white; }
    .tipo-produto .box-content ul li input { vertical-align: top; margin-top: 2px; margin-right: 3px; }
    .tipo-produto.selecionado .box-content ul li label { background-image: none; padding-top: 10px; }
    .produto-destaque .box-content .items { margin: 40px auto 0; }
    .produto-destaque .box-content p.help-block { margin: 0 auto; }
    .produto-destaque .box-content ul { display: inline; margin: 30px 0 0 0; }
    .produto-destaque .box-content ul li { margin: 0; float: none; display: inline-block; width: 33% }
    .produto-destaque .box-content ul li:last-child { margin: 0; }
    .produto-destaque .box-content ul li label { padding: 110px 0 10px 0; text-align: center; border-radius: 5px; cursor: pointer; }
    .produto-destaque .box-content ul li label[for=id_tipo_0] { background: #EEE url('/admin/img/produto-simples.png') 50% 15px no-repeat; }
    .produto-destaque .box-content ul li label[for=id_tipo_1] { background: #EEE url('/admin/img/produto-com-opcoes.png') 50% 15px no-repeat; }
    .produto-destaque .box-content ul li label[for=id_tipo_2] { background: #EEE url('/admin/img/mercadolivre.png') 50% 15px no-repeat; }
    .produto-destaque .box-content ul li label.selecionado { background: #999; color: white; }
    .produto-destaque .box-content ul li input { vertical-align: top; margin-top: 2px; margin-right: 3px; }
    .produto-destaque.selecionado .box-content ul li label { background-image: none; padding-top: 10px; }
    #modal-categorias #categorias-secundarias .controls { height: 200px; overflow: auto; overflow-x: hidden; border: 1px solid #CCC; border-radius: 3px; }
    #modal-categorias #categorias-secundarias .controls ul { padding: 10px; margin: 0; }
    #modal-categorias #categorias-secundarias .help-block { padding-top: 10px; }
    #modal-categorias ul li.principal label { font-weight: bold; }
    #modal-categorias ul li.principal small { font-size: 11px; margin-left: 10px; }
    .table-url { border: none; margin: 0; }
    .table-url td { border: none; padding: 0 5px; vertical-align: middle; }
    .table-url td.table-url-domain { padding-right: 5px; }
    #control-group-url { padding: 10px; background: rgb(251, 251, 222); border-radius: 10px; }
    #control-group-url label { font-weight: bold; }
    #control-group-url .help-text { margin: 10px 0 0 80px; }
    .control-seamless-editable i { cursor: pointer; }
    #url-remove { opacity: 0.3; }
    #url-remove:hover { opacity: 1; }

    .text-tamanho-image { color: #999; position: absolute; top: 15px; left: 0; right: 0; font-size: 13px; display: none\9; }
    #categorias-secundarias ul>li input[type="checkbox"]{ margin-top: -2px; }
    .produto-atributo input[type="checkbox"]{ margin: -4px 3px; }            

</style>
<script src="http://static.mlstatic.com/org-img/sdk/mercadolibre-1.0.4.js"></script>
<script src="/admin/js/mercadolivre.js"></script>
<script type="text/javascript" src="/admin/js/urlify.js"></script>
<script type="text/javascript">

    window.save_button_hide = false;
    window.total_produtos_abertos = 0;
    window.valor_save_button = 250;
    
    
    /* Conta caracteres do input obj e monta texto para exibir no #tituloCont. */
    function contarCaracter(obj, warning, error, destino) {
        var len = obj.val().length;
    
        if(len === 0) {
            $(destino).html('0 caracteres');
        } else if (len === 1) {
            $(destino).html('1 caracter');
        } else {
            $(destino).html(len + ' caracteres');
        }
    
        if(len > warning && len <= error) {
            $(destino).addClass('text-warning').removeClass('text-error');
        } else if (len > error) {
            $(destino).addClass('text-error').removeClass('text-warning')
        } else {
            $(destino).removeClass('text-error text-warning');
        }
    }
    function contarPalavra(obj, warning, error, destino) {
        var number = 0;
        var matches = $(obj).val().split(",");
        number = matches.filter( function(word) { return word.length > 0}).length;
        if(number === 0) {
            $(destino).html('0 palavras');
        } else if (number === 1) {
            $(destino).html('1 palavra');
        } else {
            $(destino).html(number + ' palavras');
        }
        if(number > warning && number <= error) {
            $(destino).addClass('text-warning').removeClass('text-error');
        } else if (number > error) {
            $(destino).addClass('text-error').removeClass('text-warning')
        } else {
            $(destino).removeClass('text-error text-warning');
        }
    }
    
    function muda_gerenciado() {
        var gerenciado = $('[name=gerenciado]').val();
        if (gerenciado == 'True') {
            $('#bloco-estoque-gerenciado').slideDown()
                .find('input,select').removeAttr('disabled');
            $('#bloco-estoque-nao-gerenciado').slideUp()
                .find('input,select').attr('disabled', 'disabled');
        } else {
            $('#bloco-estoque-gerenciado').slideUp()
                .find('input,select').attr('disabled', 'disabled');
            $('#bloco-estoque-nao-gerenciado').slideDown()
                .find('input,select').removeAttr('disabled');
        }
    }
    
    function verificaCampoPreenchido() {
      var warning = 0;
      $('.box-dimension .control-group, .box-dimension-filho .control-group:visible').each(function() {
        if($(this).hasClass('warning')) {
          warning = 1;
        }
      });
      if(warning == 0) {
        $('.aviso_preenchimento').slideUp('fast');
      } else {
        $('.aviso_preenchimento').slideDown('fast');
      }
    }
    
    $(document).ready(function() {

        $('.url-barra').hide();

        $('.preco').maskMoney({ thousands:'.', decimal:',' });
        $('.preco').maskMoney({ thousands:'.', decimal:',' });
        $('.preco').maskMoney({ thousands:'.', decimal:',' });
        $('.medida').maskMoney({ thousands:'', decimal:'', precision: 1 });
        $('.peso').maskMoney({ thousands:'', decimal:',', precision: 3 });


        $(".price-box").on("change", ".preco-sob-consulta input", function() {
            var sobConsulta = this.checked;
            if (sobConsulta) {

                valor_save_button = 500;

                $(".price-controls").slideUp();
                $(".price-show").slideUp();
                $(".box-stock").slideUp();
            }
            else {
                $(".price-controls").slideDown();
                $(".price-show").slideDown();
                $(".box-stock").slideDown();
            }
        });

        $(".price-box").on("change", ".preco-sob-consulta input", function() {
            var sobConsulta = this.checked;
            if (sobConsulta) {
                $(".price-controls").slideUp();
                $(".price-show").slideUp();
                $(".box-stock").slideUp();
            }
            else {
                $(".price-controls").slideDown();
                $(".price-show").slideDown();
                $(".box-stock").slideDown();
            }
        });

    
        $('#id_url_video_youtube').on('input', function(event) {
            var valor = $(this).val();
            if (valor.length > 10) {
                $('.ver_video_youtube').fadeIn();
                $('.ver_video_youtube').attr('href', valor);
            } else {
                $('.ver_video_youtube').fadeOut();
            }
        }).trigger('input');
    
        $('.link_ext').tooltip();
        $('.link_ext').click(function(e) {
            window.open($(this).attr('href'));
            return false;
        });
    
        
    
        // grade variacao
        $('.gerar_codigo_grade_variacao').click(function(event) {
            event.preventDefault();
            var variacoes_deste_produto = $(this).parents('tr').find('.grade_variacao');
            var sku_produto = $('#id_sku').val();
            var codigo_produto = [];
            $.each(variacoes_deste_produto, function(o, variacao) {
                codigo_produto.push($(variacao).val().replace('/', '-'));
            });
            var resultado_nome = URLify(codigo_produto.join('-'));
            resultado_nome = sku_produto + '-' + resultado_nome;
            $(this).parents('table').find('#id_sku').val(resultado_nome);
    
        });
    
        // remover grade
        $('.remover_grade').click(function(event) {
            var url = $(this).attr('href');
            var nome_grade = $(this).data('nome-grade');
            event.preventDefault();
            $('#RemoverGrade .modal-body').find('.nome_grade').html(nome_grade);
            $('#RemoverGrade .modal-footer').find('a').attr('href', url);
            $('#RemoverGrade').modal('show');
        });
    
        // escolher cor
        $('.escolher-cor').click(function(event) {
            event.preventDefault();
            var grade_id = $(this).attr('data-grade-id');
            var produto_id = $(this).attr('data-produto-id');
            $('#EscolherCor').attr('data-grade-id', grade_id);
            $('#EscolherCor').attr('data-produto-id', produto_id);
            $('#EscolherCor').modal('show');
        });
    
        $('#EscolherCor').on('show', function(event) {
            var grade_id = $(this).attr('data-grade-id');
            var produto_id = $(this).attr('data-produto-id');
            var url = "/admin/catalogo/grade/cor";
            $.post(url, {grade_id: grade_id, produto_id: produto_id}, function(data) {
                $('#EscolherCor .modal-body').html(data);
                if(produto_id) {
    
                    $('.ativo').trigger('click');
    
                }
                // $('.opcao-cor').tooltip();
                // $('#EscolherCor .tooltip').css('z-index', 2080);
            });
        });
    
        $('#EscolherCor').on('click', '.opcao-cor', function(event) {
            event.preventDefault();
            var cor = $(this).data('cor');
            var nome = $(this).data('nome');
            $(this).parents('ul').find('.opcao-cor').removeClass('ativo');
            $(this).addClass('ativo');
            if ($(this).hasClass('principal')) {
                $('#EscolherCor .cor_principal').css('background-color', cor);
                $('#EscolherCor .cor_principal').data('cor', nome);
                $('#EscolherCor .nome_principal').html(nome);
            } else {
                $('#EscolherCor .cor_secundaria').data('cor', nome);
                $('#EscolherCor .cor_secundaria').css('background-color', cor);
                $('#EscolherCor .nome_secundario').html(nome);
            }
    
        });
    
        $('#EscolherCor .salvar_cor').click(function(event) {
            event.preventDefault();
            var cor_principal_div = $('#EscolherCor .cor_principal');
            var cor_secundaria_div = $('#EscolherCor .cor_secundaria');
            var cor_principal = null;
            var cor_secundaria = null;
            var nome_cor = [];
            var grade_id = $('#EscolherCor').attr('data-grade-id');
            var produto_id = $('#EscolherCor').attr('data-produto-id');
    
            if (cor_principal_div.length > 0) {
                cor_principal = cor_principal_div.data('cor');
                if (!cor_principal) {
                    alert('Escolha uma cor');
                    return false;
                }
                nome_cor.push(cor_principal);
            }
    
            if (cor_secundaria_div.length > 0) {
                cor_secundaria = cor_secundaria_div.data('cor');
                if (!cor_secundaria) {
                    alert('Escolha uma cor');
                    return false;
                }
                nome_cor.push(cor_secundaria);
            }
            var nome_cor = nome_cor.join('/');
            if(produto_id) {
                $('#EscolherCor').removeAttr('data-produto-id');
                $('.prod_' + produto_id  + '_grade_' + grade_id).val(nome_cor);
                $('.produto_'+produto_id+'_grade_variacao-' + grade_id).html(nome_cor);
            }else {
                $('#grade_variacao-' + grade_id).val(nome_cor);
                $('.grade_variacao-' + grade_id).html(nome_cor);
            }
            $('#EscolherCor').modal('hide');
        });
    
        // funciona
        var grades_com_imagens = [];
        $.each($('.pode-ter-imagens'), function(k, v) {
            var obj = $(v);
            var id = obj.attr('id');
            var grade_id = obj.attr('data-variacao-id')
    
            if ($.inArray(id, grades_com_imagens) < 0) {
                var botao = '<a href="#" class="alterar_imagem_grade" data-variacao-id="'+grade_id+'"><i class="icon-picture"></a>';
                obj.append(botao);
                grades_com_imagens.push(id);
            }
        });
        // produto grade imagem
        $('.alterar_imagem_grade').click(function(event) {
            event.preventDefault();
            var grade_id = $(this).attr('data-variacao-id');
            $('#ProdutoGradeVariacaoImagem').data('variacao-id', grade_id);
            $('#ProdutoGradeVariacaoImagem').modal('show');
        });
        $('#ProdutoGradeVariacaoImagem').on('show', function(event){
            var imagens = $('.image');
            var body = $(this).find('.modal-body');
            var url_imagens = '/admin/catalogo/produto/grade/imagem/listar';
            var variacao_id = $('#ProdutoGradeVariacaoImagem').data('variacao-id');
            $.get(url_imagens, {variacao_id: variacao_id, produto_id: ''}, function(data){
    
                $.each(imagens, function(k, imagem) {
                    var img = $(imagem).find('img').clone();
                    var id = $(imagem).data('id');
                    if (id) {
                        var a = $('<a href="#" class="imagem_grade">');
                        if($.inArray(id, data) > -1) {
                            a.addClass('ativo');
                        }
                        a.attr('data-id', id);
                        a.html(img);
                        body.append(a);
                    }
                });
            }, 'json')
        }).on('hide', function(event) {
            // lipmpando
            $(this).find('.modal-body').html('');
        });
    
        $('#ProdutoGradeVariacaoImagem').on('click', '.imagem_grade', function(event) {
            event.preventDefault();
            var imagem_id = $(this).data('id');
            var variacao_id = $('#ProdutoGradeVariacaoImagem').data('variacao-id');
            var produto_id = '';
            var that = $(this);
            if ($(this).hasClass('ativo')) {
                var url = '/admin/catalogo/produto/grade/imagem/desassociar';
            } else {
                var url = '/admin/catalogo/produto/grade/imagem/associar';
            }
            $.post(url, {imagem_id:imagem_id, produto_id: produto_id, variacao_id: variacao_id}, function(data) {
                if (data.status == 'sucesso') {
                    if (that.hasClass('ativo')) {
                        that.removeClass('ativo');
                    } else {
                        that.addClass('ativo');
                    }
                } else {
                    alert(data.mensagem);
                }
            }, 'json');
        });
    
        $('.form-produto').submit(function() {

            var preco_cheio = $('#id_cheio').val();
            var preco_promocional = $('#id_promocional').val();
			
			/*
            if (preco_cheio !== '') {
                if(!$('#id_sob_consulta').is(':checked') ) {
                    var id_custo = $('#id_custo').val();
                    if(id_custo === ''){
                        alert('Preço de custo do produto não pode ser vazio. Só é possível salvar as alterações do produto após corrigir este problema.');
                        return false;
                    }
                }
            }
			*/

            if (preco_cheio && preco_promocional) {

                float_preco_cheio = formatar_decimal(preco_cheio);
                float_preco_promocional = formatar_decimal(preco_promocional);
                if (float_preco_promocional >= float_preco_cheio) {
                    alert('O preço promocional não pode ser maior ou igual que o preço de venda. Só é possível salvar as alterações do produto após corrigir este problema.');
                    return false;
                }
            }
            $('.produto-form-atributo-criar, .produto-atributo-form').find(
                'input, textarea, select').attr('disabled', 'disabled');
    
            if (!url_editar_fechado) {
                $('#url-remove').click();
            }
        });
    
        $('#btn-show-table').click(function() {
            $('.block-fade, .block-show-table').hide();
            $('.hide-table').removeClass('hide-table');
            return false;
        });
    
        contarCaracter($('#id_nome'), 55, 60, $('#tituloCont'));
        contarCaracter($('#id_title'), 60, 70, $('#titleCont'));
        //contarPalavra($('#id_keyword'), 3, 6, $('#keywordCont'));
        contarCaracter($('#id_description'), 150, 160, $('#descrCont'));
    
        var url_editar_pelo_nome = true;
        $('#url-remove').hide();
    
        // Ao preencher qualquer conteúdo no nome do produto,
        // transforma o texto usando o URLify.
        $('#id_nome').keyup(function() {
            var self = $(this);
    
            contarCaracter(self, 55, 60, $('#tituloCont'));
    
            var slug = URLify(self.val());
            $('#id_apelido').val(slug);
    
            // A criação do slug só é feita quando é possível
            // editar a URL pelo nome do produto.
            if (!url_editar_pelo_nome) {
                return false;
            } else {
                var url = slug;
                $('.url-slug').text(url);
                $('.url-barra').show();
                $('#id_url').val(url);

                $('#url-remove').show();
            }
        });
    
        $('#id_title').keyup(function() {
            contarCaracter($(this), 60, 70, $('#titleCont'));
        });
        $('#id_keyword').keyup(function() {
            contarPalavra($(this), 3, 6, $('#keywordCont'));
        });
        $('#id_description').keyup(function() {
            contarCaracter($(this), 150, 160, $('#descrCont'));
        });
        $('#id_peso, #id_altura, #id_largura, #id_comprimento').keyup(function() {
          if($(this).val() != 0 && $(this).val() != "0,000") {
              $(this).parent().parent().parent().removeClass('warning');
          } else {
              $(this).parent().parent().parent().addClass('warning');
          }
          verificaCampoPreenchido();
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
                var params = {url: url};
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
    
    
        $('[name=gerenciado]').change(muda_gerenciado).change();
    
    
        bind_save_button = function(tipo_produto) {
            var saveButtonIsVisible = false;
            var botao_salvar = $('.btn-save');
            
            var icone = '<i class="icon-ok icon-white"></i>';
            if (tipo_produto == 'normal') {
                botao_salvar.html(icone + ' Salvar produto');
            } else {
                botao_salvar.html(icone + ' Continuar cadastro');
            }
            
            if ($('#saveButton .button-container').length) {
                $(window).scroll(function() {
                    if (($(window).scrollTop() + window.innerHeight) < (document.body.offsetHeight - valor_save_button) && !window.save_button_hide && window.total_produtos_abertos == 0) {
                        $('#saveButton').show();
                    } else {
                        $('#saveButton').hide();
                    }
                });
            }
        }
    
        if ($('[name=tipo]').length && !$('[name=tipo]:checked').length) {
            $('.tipo-produto').siblings().hide();
        } else {
            bind_save_button();
        }
    
        $('#EscolherCategoriaGlobal').on('click', '.categoria-global', function(event) {
            event.preventDefault();
            var categoria_global_id = $(this).data('categoria');
            $.get('/admin/recurso/categoria_global', {categoria_global_id: categoria_global_id} ,function(data) {
                $('#EscolherCategoriaGlobal > .modal-body').html(data);
            });
        });
        
        $('#EscolherCategoriaGlobal').on('click', '.ecolher-categoria-global', function(event) {
            var categoria_global_id = $(this).data('categoria');
            $.get('/admin/recurso/categoria_global/detalhar', {
                categoria_global_id: categoria_global_id,
                produto_id: produto_id_global
            } ,function(data) {
                $('.box-categoria-global > .box-content').html(data);
                $('.box-categoria-global > .box-content').show();
                $("#EscolherCategoriaGlobal").modal('hide');
            });
        });
    
       
        $('[name=tipo]').change(function() {
            var self = $('[name=tipo] option:selected');
            var tipo = self.val();                   
            
            if(tipo == "atributo") {
                valor_save_button = 800;

                $('.produto-atributo.box + .box, .box-stock, .box-seo').hide();
            } else {

                valor_save_button = 250;
                $('.produto-atributo.box + .box, .box-stock, .box-seo').show();
            }
            
            $('.produto-normal,.produto-atributo').hide().find('input, textarea, select').attr('disabled', 'disabled');
            $('.produto-' + tipo).show().find('input, textarea, select').removeAttr('disabled');
            bind_save_button(tipo);
        }).change();
    
        $('.form-produto-vincular-grade [type=submit]').click(function() {
            var self = $(this).parents('.form-produto-vincular-grade');
            var form_data = self.find("select, textarea, input").serializeArray();
            var url = self.data('action');
            var method = self.data('method');
    
            var form = $('<form action="' + url + '" method="' + method + '">');
            for (var i in form_data) {
                input = form_data[i];
                form.append($('<input type="hidden" name="' + input.name + '" value="' + input.value + '" />'));
            }
            form.appendTo($('body'));
            form.submit();
    
            return false;
        });
    
        // $('#visivel_facebook').click(visivel_facebook);
        // Desabilitando os controles que estão escondidos para evitar que sejam
        // enviados sem necessidade.
        $('.produto-form-atributo-criar, .produto-atributo-form').find(
            'input, textarea, select').attr('disabled', 'disabled');
    
        /*
         * Impedindo que a variação do produto seja enviada com enter, isso causa
         * conflito com o form do produto pai.
         */
        $('.produto-form-atributo-criar input, .produto-form-atributo-criar select, .produto-atributo-form input, .produto-atributo-form select').keypress(function(e){
            if ( e.which == 13 ) e.preventDefault();
        });
        $('#gerar-sku').click(function(event){
            event.preventDefault();
            var text = "";
            var possible = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
    
            for( var i=0; i < 9; i++ ) {
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            }
            $('#id_sku').val(text)
        });
        $('.remover_produto_filho').click(function(event) {
            if(confirm('Deseja realmente remover este atributo?')) {
                return true
            } else {
                event.preventDefault();
            }
        });
        $('.image-widget .image').tooltip({
            placement: 'top'
        });
        $('.image-widget .image:first-child').tooltip('destroy');
    
        $('#id_destaque').change(function() {
            if ($(this).attr('checked')) {
                $('.destaque-disclaimer').show();
                $('.produto-destaque-icon-star').removeClass('off');
            } else {
                $('.destaque-disclaimer').hide();
                $('.produto-destaque-icon-star').addClass('off');
            }
        }).change()
        // animação da HASH
        if (window.location.hash) {
            var hash = window.location.hash;
            scroll_para_elemento(hash);
        }
        
    
        if ($('#modal-categorias').length) {
            var mostrar_criar_categoria = function() {
                $('#body-criar-categoria').find('input, select').val('');
                $('#body-criar-categoria, #footer-criar-categoria').show();
                $('#body-selecionar-categoria, #footer-selecionar-categoria').hide();
                return false;
            }
    
            var esconder_criar_categoria = function() {
                // Reseta o formulário.
                $('#body-criar-categoria').find('input, select').val('');
                $('#body-criar-categoria, #footer-criar-categoria').hide();
                $('#body-selecionar-categoria, #footer-selecionar-categoria').show();
                return false;
            }
    
            var inserir_a_categoria = function(data) {
                // Insere a categoria na lista de categorias secundárias.
                var ul = $('#categorias-secundarias .controls ul');
                var margin = 'margin-left: ' + (parseInt(data.level) * 20) + 'px';
                var item = $('<li>').addClass('checkbox').attr({'style': margin}).append(
                    $('<label>').append(
                        $('<input>').attr({'type': 'checkbox',
                                           'name': 'categoria_secundaria[]',
                                           'data-level': '0',
                                           'value': data.categoria_id,
                                           'checked': 'checked'})
                    ).append(
                        data.nome
                    )
                );
                if (data.parent_id == null) {
                    ul.append(item);
                } else {
                    item.insertAfter(ul.find('[value=' + data.parent_id + ']').parents('li'));
                }
    
                // Insere a categoria nos formulários.
                var selects = $('[id=id_categorias]');
                // Insere a quantidade certa de "--"" para indentar a categoria.
                var dashes = Array(data.level + 1).join("-- ");
                var option = $('<option>').attr({'value': data.categoria_id}).html(dashes + data.nome);
                selects.each(function(index, element) {
                    select = $(element);
                    if (data.parent_id == null) {
                        option.insertBefore(select.find('.divider'));
                    } else {
                        var _find = '[value=' + data.parent_id + ']';
                        option.insertAfter(select.find(_find));
                    }
                    select.val(data.categoria_id);
                    select.change();
                });
                if (selects.find(':checked').length > 1) {
                    $('#modal-categorias #link-categorias-secundarias').click();
                }
            }
    
            $('#footer-criar-categoria button.button').click(esconder_criar_categoria);
    
            $('#footer-criar-categoria button.submit').click(function() {
                var nome = $('#body-criar-categoria [name=nome]').val();
                var params = {nome: nome};
    
                var categoria_pai = $('#body-criar-categoria [name=categorias]').val();
                if (parseInt(categoria_pai)) {
                    params.parent = categoria_pai;
                }
    
                // Cria a categoria.
                $.post('/admin/catalogo/categoria/criar_json', params, function(data) {
                    if (data.estado == 'SUCESSO') {
                        alert('Categoria criada com sucesso.');
                        // {"resposta": {"nome": "Bolsas", "categoria_id": 10977, "parent_id": null, "idioma_id": "pt-br", "conta_id": 1, "apelido": "bolsas", "descricao": ""}, "estado": "SUCESSO"}
                        inserir_a_categoria(data.resposta);
                        esconder_criar_categoria();
                    } else {
                        alert('Erro: ' + data.mensagem + '.');
                    }
                }, 'json');
            });
    
            var mostrar_categoria_pai = function() {
                $('.texto-categoria-principal').hide();
                $('#controle-categoria-pai').show();
                return false;
            }
    
            var esconder_categoria_pai = function() {
                $('.texto-categoria-principal').show();
                $('#controle-categoria-pai').hide();
                return false;
            }
    
            $('#selecionar-categoria-pai').click(mostrar_categoria_pai);
    
            $('#modal-categorias #id_categorias').append(
                $('<option>').attr({'disabled': 'disabled'}).addClass('divider')
            ).append(
                $('<optgroup label="Nova categoria">').append(
                    $('<option>').attr({'id': 'criar-nova-categoria', 'value': '0'}).html('Criar nova categoria')
                )
            );
    
            var categoria_principal_recem_selecionada_id = $('#modal-categorias #body-selecionar-categoria #id_categorias').val();
    
            var locked_by_item = function(item_locked, by_id) {
                // "Trava" um item por um outro item.
                itens_ids = item_locked.data('locked_ids');
                if (!itens_ids) {
                    itens_ids = {};
                }
                itens_ids[by_id] = true;
                item_locked.data('locked_ids', itens_ids);
            }
    
            var remove_lock = function(item_locked, by_id) {
                // "Trava" um item por um outro item.
                itens_ids = item_locked.data('locked_ids');
                if (!itens_ids) {
                    item_locked.data('locked_ids', {});
                } else {
                    if (by_id in itens_ids) {
                        delete itens_ids[by_id];
                    }
                    if (item_locked.val() in itens_ids && item_locked.val() != $('#modal-categorias #body-selecionar-categoria #id_categorias').val()) {
                        delete itens_ids[item_locked.val()];
                    }
                    item_locked.data('locked_ids', itens_ids);
                }
            }
    
            var update_locked_items = function() {
                var selected_value = $('#modal-categorias #body-selecionar-categoria #id_categorias').val();
                var locked_items = $('#modal-categorias #body-selecionar-categoria [type=checkbox]:disabled:not([value=' + selected_value + '])').toArray();
                locked_items = locked_items.reverse();
                for (var item in locked_items) {
                    item = $(locked_items[item]);
                    var locked_ids = Object.keys(item.data('locked_ids'));
                    var unlock = true;
                    for (var locked_id in locked_ids) {
                        locked_id = locked_ids[locked_id];
                        if ($('#modal-categorias #body-selecionar-categoria [type=checkbox][value=' + locked_id + ']').attr('checked')) {
                            unlock = false;
                        }
                    }
                    if (unlock) {
                        item.removeAttr('disabled').removeAttr('checked');
                    }
                }
            }
    
            $('#modal-categorias #body-selecionar-categoria #id_categorias').change(function() {
                var self = $(this);
                if (self.children().find('#criar-nova-categoria:selected').length) {
                    mostrar_criar_categoria();
                }
    
                var value = self.val();
                $('#modal-categorias input[type=checkbox][value=' + value + ']').removeAttr('disabled');
                $('#modal-categorias input[type=checkbox][value=' + categoria_principal_recem_selecionada_id + ']').removeAttr('disabled');
                var selected = $('#modal-categorias input[type=checkbox][value=' + value + ']');
                if (!selected.attr('checked')) {
                    $('#modal-categorias input[type=checkbox][value=' + categoria_principal_recem_selecionada_id + ']').removeAttr('checked');
                    categoria_principal_recem_selecionada_id = value;
                }
                selected.attr({disabled: 'disabled', checked: 'checked'}).change();
                selected.parents('ul').find('li').removeClass('principal').find('small').remove();
                selected.parents('li').addClass('principal').find('label').append($('<small>').text('Principal').addClass('label label-success'));
                update_locked_items();
            }).change();
    
            $('#modal-categorias #link-categorias-secundarias').click(function () {
                var self = $(this);
                if (self.hasClass('item-opened')) {
                    self.html('<i class="icon-chevron-right"></i> Adicionar mais categorias ao produto').addClass('item-closed').removeClass('item-opened');
                    var principal_id = $('#modal-categorias #body-selecionar-categoria #id_categorias').val();
                    $('#categorias-secundarias').hide().find(':checked:not([value=' + principal_id + '])').removeAttr('checked').removeAttr('disabled');
                    $('#modal-categorias #id_categorias').change();
                } else {
                    self.html('<i class="icon-chevron-down"></i> Remover categorias adicionais do produto').addClass('item-opened').removeClass('item-closed');
                    $('#categorias-secundarias').show();
                    $('#modal-categorias #id_categorias').change();
                }
                return false;
            });
    
            $('#abrir-modal-categorias').click(function () {
                $('#categorias-secundarias :checked').change()
                $('#modal-categorias').modal('show');
                return false;
            });
    
            $('#modal-categorias [name="categoria_secundaria[]"]').change(function () {
                var self = $(this);
                var item = self;
                var contador = 0;
                var nivel_atual = self.attr('data-level');
                if (self.attr('checked')) {
                    while (true) {
                        var nivel_item = item.attr('data-level');
                        if (nivel_atual > nivel_item || contador == 0) {
                            item.attr({'checked': 'checked'});
                            locked_by_item(item, self.val());
                            if (contador != 0) {
                                item.attr({'disabled': 'disabled'});
                            }
                            nivel_atual = nivel_item;
                        }
                        if (parseInt(nivel_item) === 0) {
                            break;
                        }
    
                        item = item.parents('li').prev().find('input');
    
                        if (contador > 100) {
                            break;
                        }
                        contador++;
                    }
                } else {
                    while (true) {
                        var nivel_item = item.attr('data-level');
                        if (nivel_atual > nivel_item && item.attr('disabled') && !item.parents('li').hasClass('principal')) {
                            remove_lock(item, self.val());
                            if (Object.keys(item.data('locked_ids')).length == 0) {
                                item.removeAttr('disabled');
                                item.removeAttr('checked');
                            }
                            nivel_atual = nivel_item;
                        }
                        if (parseInt(nivel_item) === 0) {
                            break;
                        }
    
                        item = item.parents('li').prev().find('input');
    
                        if (contador > 100) {
                            break;
                        }
                        contador++;
                    }
                }
                update_locked_items();
                return false;
            });
    
            var atualizar_seletor_categorias = function() {
                var categoria_principal = $('#modal-categorias #body-selecionar-categoria #id_categorias');
                var categoria_principal_id = categoria_principal.val();
                var categoria_principal_nome = categoria_principal.find(':selected').text();
                categoria_principal_nome = categoria_principal_nome.replace(/\-\- /g, ''); 
    
                var categorias_secundarias_itens = $('#modal-categorias #body-selecionar-categoria [name="categoria_secundaria[]"][disabled!=disabled]:checked');
                var categorias_secundarias_quantidade = categorias_secundarias_itens.length;
    
                if (categorias_secundarias_quantidade) {
                    var categorias_secundarias_texto = ' <small  style="font-size: 11px; color: #888">(+' + categorias_secundarias_quantidade + ' categoria' + ((categorias_secundarias_quantidade > 1) ? 's' : '') + ')</small>';
                } else {
                    var categorias_secundarias_texto = '';
                }
                
                categoria_principal_nome = categoria_principal_nome.replace('|', '');

                $('#selecao-categoria .dropdown-label').html(categoria_principal_nome + categorias_secundarias_texto);
                categoria_principal.change();
            }
    
            $('#modal-categorias form').submit(function () {
                var self = $(this);
                var params = self.serialize();
                $.post('/admin/catalogo/produto/editar/categoria/', params, function(data) {
                    if (data.estado == 'SUCESSO') {
                        atualizar_seletor_categorias();
                        $('#modal-categorias').modal('hide');
                    } else {
                        alert(data.mensagem);
                    }
                }, 'json');
                return false;
            });
    
            $('#modal-categorias.acao-criar #footer-selecionar-categoria [type=submit]').click(function(){
                // Esta função é usada quando o produto ainda não foi criado.
                // Ela deve injetar hidden inputs dentro do formulário do produto.
                var categoria_principal = $('#modal-categorias #body-selecionar-categoria #id_categorias');
                var categoria_principal_id = categoria_principal.val();
                var categorias = $('<input>').attr({'type': 'hidden', 'name': 'categorias[]'}).val(categoria_principal_id);
    
                var categorias_secundarias_itens = $('#modal-categorias #body-selecionar-categoria [name="categoria_secundaria[]"][disabled!=disabled]:checked');
                var categorias_secundarias = [];
                for (var i = 0; i < categorias_secundarias_itens.length; i++) {
                    var item = categorias_secundarias_itens.eq(i);
                    var input = $('<input>').attr({'type': 'hidden', 'name': 'categoria_secundaria[]'}).val(item.val());
                    categorias_secundarias.push(input);
                }
    
                $('#categorias_inputs').remove();
    
                $('.form-produto').append(
                    $('<div>').attr({'id': 'categorias_inputs'}).append(categorias).append(categorias_secundarias)
                );
    
                atualizar_seletor_categorias();
    
                $('#modal-categorias').modal('hide');
            });
        }
    
        var marcas = (function() {
            var arr_marcas = [];
            var marca_option = $('#id_marca option');
            var j = 0;
            for (var i = 0; i < marca_option.length; i++) {
              if (marca_option[i].value !== "") {
                arr_marcas[j] = {
                  "id": marca_option[i].value,
                  "nome": marca_option[i].text
                }
                j++;
              }
            }
            return arr_marcas;
        }) ();
    
        var categorias = (function() {
          var arr_categorias = [];
          var categoria_option = $('#modal-categorias #body-selecionar-categoria #id_categorias option');
          var j = 0;
          for (var i = 0; i < categoria_option.length; i++) {
            if (categoria_option[i].value !== "" && categoria_option[i].value !== "0") {
              arr_categorias[j] = {
                "id": categoria_option[i].value,
                "nome": categoria_option[i].text
              }
              j++;
            }
          }
          return arr_categorias;
        }) ();
    
    
        $('#buscaMarca').typeahead({
          source: function() {
            var r_marcas = [];
            for (var i = 0; i < marcas.length; i++) {
              r_marcas[i] = marcas[i].nome;
            }
            return r_marcas;
          },
          updater: function(item) {
            var id;
            for (var i = 0; i < marcas.length; i++) {
              if (marcas[i].nome === item) {
                id = marcas[i].id;
                break;
              }
            }
            $('#id_marca option[value=' + id + ']').attr('selected', 'selected');
            $('.marca ul.dropdown-options').find('li a[value=' + id + ']').click();
          }
        });
    
        $('#buscaCategoria').typeahead({
          source: function() {
            var r_categorias = [];
            for (var i = 0; i < categorias.length; i++) {
              r_categorias[i] = categorias[i].nome;
            }
            return r_categorias;
          },
          updater: function(item) {
            var id;
            var acao = "criar";
            var select_categoria = $('#modal-categorias #body-selecionar-categoria #id_categorias');
            var categoria_principal = select_categoria.val();
            for (var i = 0; i < categorias.length; i++) {
              if (categorias[i].nome === item) {
                id = categorias[i].id;
                break;
              }
            }
            if (categoria_principal) {
              $('#categorias-secundarias input[value='+ id + ']').click();
            } else {
              // Seta a primeira como categoria principal
              select_categoria.find('option[value=' + id + ']').attr('selected', 'selected');
            }
            atualizar_seletor_categorias();
            // salva as alterações.
            if (acao == 'editar'){
                $('#modal-categorias form').submit();
            } else {
                $('#modal-categorias.acao-criar #footer-selecionar-categoria [type=submit]').click();
            }
    
          }
        });
    });



    $(document).ready(function() {
       
        $('#id_renomear_imagem').change(function(){
            if($("#id_renomear_imagem").is(':checked')){
                var nome = $('#id_nome').val();
                if(nome == "" || nome.length <= 1){
                    alert( 'Por favor, Informe o nome do produto!' );      
                }                           
            }
        });
    });
    
    var scroll_para_elemento = function(elemento) {
        $('html, body').animate({
            scrollTop: $(elemento).offset.top - 45
        }, 1000);
    };
    
    var mostrar_criar_nova_variacao = function() {
        $('.produto-form-atributo-criar').find('input, textarea, select').removeAttr('disabled');
        $('#block-new').show();
    
        $('#saveButton').hide();
        window.save_button_hide = true;
        window.total_produtos_abertos++;
    
        return false;
    };
    
    var esconder_criar_nova_variacao = function() {
        $('.produto-form-atributo-criar').find('input, textarea, select').attr('disabled', 'disabled');
        $('#block-new').hide();
    
        window.total_produtos_abertos--;
        if (window.total_produtos_abertos == 0) {
            $('#saveButton').show();
            window.save_button_hide = false;
        }
        scroll_para_elemento('.produto-opcoes');
        return false;
    };
    
    var mostrar_editar_opcao = function(produto_id) {
        $('#block-prd-atr-' + produto_id + ' .produto-atributo-form').find('input, textarea, select').removeAttr('disabled');
        $('#block-prd-atr-' + produto_id + ', #block-line-prd-atr-' + produto_id).toggle();
    
        muda_gerenciado();
    
        $('#block-prd-atr-' + produto_id + ' .produto-atributo-form').find('[name=gerenciado]').change()
    
        $('#saveButton').hide();
        window.save_button_hide = true;
        window.total_produtos_abertos++;
    
        return false;
    };
    
    var duplicar_opcao = function(produto_id) {
        var linha = $('#block-prd-atr-' + produto_id);
        var nova_linha
        var campos = [
            'id_cheio', 'id_promocional', 'id_peso', 'id_altura', 'id_largura',
            'id_comprimento', 'id_gerenciado', 'id_situacao_em_estoque',
            'id_quantidade', 'id_situacao_sem_estoque']
    
        mostrar_criar_nova_variacao();
        var nova_linha = $('#block-new');
    
        for (var i in campos) {
            var campo = campos[i];
            var _id = '#' + campo;
            nova_linha.find(_id).val(linha.find(_id).val()).change()
        }
    
        return false;
    };
    
    var esconder_editar_opcao = function(produto_id) {
        $('#block-prd-atr-' + produto_id + ' .produto-atributo-form').find('input, textarea, select').attr('disabled', 'disabled');
        $('#block-prd-atr-' + produto_id + ', #block-line-prd-atr-' + produto_id).toggle();
    
        window.total_produtos_abertos--;
        if (window.total_produtos_abertos == 0) {
            $('#saveButton').show();
            window.save_button_hide = false;
        }
        scroll_para_elemento('.produto-opcoes');
        return false;
    };
    
    mostrar_alert_opcoes_produto = function (tipo, mensagem) {
        var tipos = ['success', 'error', 'info', 'warning'];
        if ($.inArray(tipo, tipos) < 0) {
            alert('Erro ao tentar mostrar alert do produto com variação. ' +
                  'O tipo "' + tipo + '" não existe.');
        }
        // Remove qualquer class anterior do alert.
        $.each(tipos, function(i, e) { $('.alert-opcoes-produto').removeClass('alert-' + e); });
        // Adiciona a nova classe e a mensagem.
        $('.alert-opcoes-produto').addClass('alert-' + tipo).html(mensagem).show();
        // Rola a tela para mostrar o alert.
        scroll_para_elemento('.alert-opcoes-produto');
    };
    
    esconder_alert_opcoes_produto = function () {
        $('.alert-opcoes-produto').hide().html('');
    };
    
    
</script>