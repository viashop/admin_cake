var formatar_decimal = function(valor) {
    /*
     * Transforma um decimal BR em float.
     * >>> formatar_decimal('15,00')
     * 15.00
     * >>> formatar_decimal('1.125,35')
     * 1125.35
     */

    // Retira qualquer ponto de milhar.
    valor = valor.replace('.', '');
    valor = valor.replace(',', '.');
    return parseFloat(valor);
};

var formatar_decimal_br = function(valor) {
    if (valor == 0) {
        return '0,00';
    }

    var valor = valor.toFixed(2);
    var valor_e_decimal = valor.split('.');
    var inteiro = valor_e_decimal[0];
    var decimal = valor_e_decimal[1];

    var vezes = inteiro.length / 3;
    var inicio = inteiro.length % 3;

    var novo_inteiro = [];
    var primeiro_ok = false;
    var contador = 0;

    $.each(inteiro.toString().split(''), function(i) {
        if (inicio === 0 && contador === 0) {
            primeiro_ok = true;
        }
        if (contador == inicio && primeiro_ok === false) {
            novo_inteiro.push('.');
            contador = 0;
            primeiro_ok = true;
        }
        if (contador !== 0 && contador % 3 === 0) {
            novo_inteiro.push('.');
        }
        novo_inteiro.push(inteiro[i]);
        contador++;
    });
    return novo_inteiro.join('') + ',' + decimal;
};

jQuery.loader = function(text, not_scroll) {
    if (!not_scroll) {
        $('html, body').animate({ scrollTop:0 }, 'fast');
    }
    $('#loading').hide();
    if (text) {
        $('#loading .loading-text').html(text);
    }
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop in"></div>');
    $('#loading').show();
};

jQuery.removeLoader = function() {
    $('#loading').hide();
    $('.modal-backdrop').remove();
};

$(document).ready(function() {
    $('html.no-js').removeClass('no-js').addClass('with-js');

    /*
     * Ao clicar no select_all, procura por todos os outros checkboxes na tabela
     * do pai, selecionando ou deselecionando todos eles.
     */
    $('.select_all').click(function(){
        rel = $(this).attr('rel');
        if (!rel) {
            checks = $(this).parents().filter('table').find('input[type=checkbox]').not('[disabled=disabled]');
        } else {
            checks = $(rel).find('input[type=checkbox]').not('[disabled=disabled]');
        }
        if ($(this).attr('checked')) {
            checks.attr('checked', 'checked');
        } else {
            checks.removeAttr('checked');
        }
    });

    // Fix click in the dropdown-fixed.
    $('.dropdown-fixed').click(function(e) {
        e.stopPropagation();
    });

    $('.marca.dropdown-advanced').dropdownadvanced({
        debug: true,
        success: function(data, callback) {
            post_data = {nome: data.value, csrfguardtoken: $('[name=csrfguardtoken]').val()};
            $.post('/admin/catalogo/marca/criar_json', post_data, function(res) {
                if (res.resposta.estado == 'ERRO') {
                    callback(null, res.resposta.mensagem);
                } else {
                    callback(res.resposta.id);
                }
            }, 'json');
        }
    });

    $('.categoria.dropdown-advanced').dropdownadvanced({
        debug: true,
        success: function(data, callback) {
            post_data = {
                nome: data.value,
                categoria_id_pai: '-', // Categoria na raiz
                csrfmiddlewaretoken: $('[name=csrfmiddlewaretoken]').val()
            };
            $.post('/admin/catalogo/categoria/criar_json', post_data, function(res) {
                if (res.resposta.estado == 'ERRO') {
                    callback(null, res.resposta.mensagem);
                } else {
                    callback(res.resposta.id);
                }
            }, 'json');
        }
    });

    var preco = function(obj) {
        var float_preco_venda;
        var preco_venda = obj.val();
        if (preco_venda) {
            float_preco_venda = formatar_decimal(preco_venda);
            preco_venda = formatar_decimal_br(float_preco_venda);
        }
        return [float_preco_venda, preco_venda];
    };

    var verificar_precos_produto_filho = function(self, pai) {
        self = $(self);
        var parent = self.parents().filter(pai);

        var input_cheio = $('#id_cheio', parent);
        var input_promocional = $('#id_promocional', parent);

        preco_venda_retorno = preco(input_cheio);
        float_preco_venda = preco_venda_retorno[0];
        preco_venda = preco_venda_retorno[1];

        preco_promocional_retorno = preco(input_promocional);
        float_preco_promocional = preco_promocional_retorno[0];
        preco_promocional = preco_promocional_retorno[1];

        error_msg = '<div class="clear alert alert-danger error-preco" style="margin-top:10px">:mensagem:</div>';
        if (float_preco_promocional >= float_preco_venda) {
            input_cheio.parents('.control-group').addClass('error');
            input_promocional.parents('.control-group').addClass('error');
            if (!$('.error-preco', parent).length) {
                msg = error_msg.replace(":mensagem:", "O preço promocional não pode ser maior ou igual que o preço de venda.");
                $(msg).appendTo(parent.find('.error-preco-wrapper'));
            }
        } else {
            input_cheio.parents('.control-group').removeClass('error');
            input_promocional.parents('.control-group').removeClass('error');
            $('.error-preco', parent).remove();
        }
    };

    var verificar_precos = function() {
        preco_venda_retorno = preco($('.preco-venda input'));
        float_preco_venda = preco_venda_retorno[0];
        preco_venda = preco_venda_retorno[0];

        preco_promocional_retorno = preco($('.preco-promocional input'));
        float_preco_promocional = preco_promocional_retorno[0];
        preco_promocional = preco_promocional_retorno[0];

        if (preco_venda) {
          $('.box-price-show').removeClass('alert alert-error');
          $('.box-price-show .alert-venda-empty').hide();
          if ((preco_venda && preco_promocional) || (!preco_venda && !preco_promocional)) {
              $('.price-full, .price-promotional').show();
              $('.price-full').addClass('strike');
              $('.price-only').hide();
          } else if (preco_venda && !preco_promocional) {
              $('.price-full, .price-promotional').hide();
              $('.price-only').show().find('span').text(preco_venda);
          } else if (!preco_venda && preco_promocional) {
              $('.price-full, .price-promotional').hide();
              $('.price-only').show().find('span').text(preco_promocional);
          }
  
          error_msg = '<div class="clear alert alert-danger error-preco" style="margin-top:10px">:mensagem:</div>';
          if (float_preco_promocional >= float_preco_venda) {
              $('.preco-promocional.control-group').addClass('error');
              $('.preco-venda.control-group').addClass('error');
              if (!$('.error-preco').length) {
                  msg = error_msg.replace(":mensagem:", "O preço promocional não pode ser maior ou igual que o preço de venda.");
                  $(msg).appendTo('.price-box');
              }
          } else {
              $('.preco-promocional.control-group').removeClass('error');
              $('.preco-venda.control-group').removeClass('error');
              $('.error-preco').remove();
          }
        } else {
            $('.box-price-show > *').hide();
            $('.box-price-show').addClass('alert alert-error');
            $('.box-price-show .alert-venda-empty').show();
        }
    };

    $('.preco-venda input').live('keyup', function() {
        var valor = '';
        if (this.value) {
            valor = formatar_decimal_br(formatar_decimal(this.value));
        }
        $('.price-full span').text(valor);
        verificar_precos();
    }).keyup();

    $('.preco-promocional input').live('keyup', function() {
        var valor = '';
        if (this.value) {
            valor = formatar_decimal_br(formatar_decimal(this.value));
        }
        $('.price-promotional span').text(valor);
        verificar_precos();
    }).keyup();

    $('.produto-atributo-form [name=cheio], ' +
      '.produto-atributo-form [name=promocional]').keyup(function () {
        verificar_precos_produto_filho(this, '.produto-atributo-form');
    });

    $('.produto-form-atributo-criar [name=cheio], ' +
      '.produto-form-atributo-criar [name=promocional]').keyup(function () {
        verificar_precos_produto_filho(this, '.produto-form-atributo-criar');
    });

    $('.scroll-not-propagate').bind('mousewheel', function(e, d) {
        var height = $(this).height();
        var scrollHeight = $(this).get(0).scrollHeight;
        if((this.scrollTop === (scrollHeight - height) && d < 0) || (this.scrollTop === 0 && d > 0)) {
            e.preventDefault();
        }
    });

    $('.menu-section .with-sub a').click(function(event) {
        if($(this).attr('href') == '#') {
            event.preventDefault();
        }
        if (!$(this).parents().hasClass('active')) {
            var active = $('.menu-section .with-sub.active');
            $('.menu-section .with-sub ul').slideUp();
            $('.menu-section .with-sub').not($(this).parent()).not(active).removeClass('active');
            $(this).parent().find('ul').slideDown(function() {
                active.removeClass('active');
            });
            $(this).parent().addClass('active');
        }
    });


    // retirando switchfy por problemas de compatiblidade.
    // $('.fancy-switch').switchify();
    function sortear_imagens() {
        $('.sortable').sortable(
            {
                update: function(event, ui) {
                    images = $('.sortable .image');
                    image_ids = {'imagem_id': []};
                    images.each(function(i, e) {
                        image_ids['imagem_id'].push($(e).data('id'));
                    });
                    var url = $('.sortable').data('url');
                    $.post(url, image_ids);
                },
                cancel: ".empty",
                items: ".image:not(.empty)",
                revert: 250,
                activate: function( event, ui ) {
                    $('.image:not(.empty, .ui-sortable-placeholder)').addClass('drop-area');
                    ui.helper.appendTo('.sortable');
                    $('.image-widget .image').tooltip('destroy');
                },
                beforeStop: function( event, ui ) {
                    $('.image:not(.empty)').removeClass('drop-area');
                    $('.image-widget .image').tooltip('hide');
                },
                tolerance: "pointer",
                cursorAt: { top: 40, left: 40 }
            }
        );
        $('.sortable').disableSelection();
    }

    function destruir_sortear_imagens() {
        $('.sortable').sortable('destroy');
    }
    if ($('.sortable').length) {
        sortear_imagens();
    }

    if ($('.urlify').length) {
        $('.urlify').keyup(function() {
            var slug = URLify($(this).val());
            var update = ($('.urlify').attr('rel') || '').split(',');
            for (var item in update) {
                var obj = $(update[item]);
                if (obj.is('input')) {
                    obj.val(slug);
                } else {
                    obj.text(slug);
                }
            }
        });
    }

    var bind_imagem_remover_click = function () {
        $('.imagem-remover').click(function() {
            url = $(this).data('url');
            t = $(this);

            $.get(url, function(res) {
                if (res.estado == 'ERRO') {
                    alert(res.mensagem);
                } else {
                    t.parent().remove();
                    completar_imagens_vazias();
                }
            }, 'json');
            return false;
        });
    };
    bind_imagem_remover_click();

    var completar_imagens_vazias = function () {
        total_imagens = $('.image-widget .image').length;
        total_imagens_vazias = $('.image-widget .image.empty').length;
        if (total_imagens < 4) {
            for (var i = 0; i < 4 - total_imagens; i++) {
                // Adicionando os itens vazios necessários.
                empty = $('<div>').addClass('image empty').html('<i class="icon-custom icon-image icon-big"></i>');
                $('.image-widget').append(empty);
            }
        }
        return true;
    };
    if ($('.image-widget .image').length) {
        completar_imagens_vazias();
    }

    if ($("#uploadImagemProduto").length && !$.browser.msie) {
        $(document).bind('dragover', function (e) {
            var dropZone = $('#dropzone'),
                timeout = window.dropZoneTimeout;
            if (!timeout) {
                dropZone.addClass('in');
                // só vamos colocar o overlay se a
                // dropzone estiver visisvel
                if ($('#dropzone:visible').length > 0) {
                    $('.black-overlay').stop().fadeIn(600);
                }
            } else {
                clearTimeout(timeout);
            }
            if (e.target === dropZone[0]) {
                dropZone.addClass('hover');
            } else {
                dropZone.removeClass('hover');
            }
            window.dropZoneTimeout = setTimeout(function () {
                window.dropZoneTimeout = null;
                dropZone.removeClass('in hover');
                $('.black-overlay').stop().fadeOut();
            }, 100);
        });
        $("#uploadImagemProduto").fileupload({
            dataType: 'json',
            singleFileUploads: false,
            dropZone: $('#dropzone, #uploadImagemProduto'),
            add: function(e, data) {
                var arquivo_nao_suportado = false;
                var tamanho_maximo = 1024 * 1024;
                $.each(data.files, function(index, file) {
                    var ext = file.name.split('.');
                    ext = ext[ext.length-1];
                    var arquivos_suportados = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];


                    if ($.inArray(ext.toLowerCase(), arquivos_suportados) == -1 || file.size > tamanho_maximo) {
                        // mostrar modal
                        $('#modal-arquivo-invalido').modal('show');
                        arquivo_nao_suportado = true;

                    }
                });
                if (!arquivo_nao_suportado) {
                    data.submit();
                }
            },
            send: function(e, data){
                // Esconde tudo e mostra a barra e o texto.
                // $('#uploadProgressbar').show();

                $('.upload-wrapper').show();
                $("div.image-widget").find(".upload").show();
            },
            done: function (e, data) {
                // var lista_imagens = $('#lista_imagens');
                // $('#uploadProgressbar').hide();
                $('.upload-wrapper').hide();
                // $("div.image-widget").find(".upload").hide();
                $('#uploadProgressbar .bar').css('width','0%');
                var arquivo = data.result.img ;
                // $(".btn-upload").hide();
                // $(".upload-text").hide();
                if(arquivo){
                    $(".form-produto").attr("action", data.result.action_url);
                    // mudando a url do input_url
                    $("#uploadImagemProduto").data('blueimpFileupload').options.url = data.result.input_url;
                    $('.image-widget.sortable').data('url', data.result.sortable_url);
                    $.each(arquivo, function(i, item){
                        $(".empty:last").remove();
                        var img_html = "<div class='image' data-id='" + item.id  +"' ><img src=\"" + MEDIA_URL + item.caminho +  "\" /><a href=\"" + item.url_remover + "\" class=\"imagem-remover\" data-url=\"" + item.url_remover_json + "\">x</a></div>";
                        if($('.empty').length) {
                            $('.empty:first').before(img_html);
                        } else {
                            $('.image-widget').append(img_html);
                        }
                    });
                    bind_imagem_remover_click();
                    destruir_sortear_imagens();
                    sortear_imagens();
                }

            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#uploadProgressbar .progress-bar').css('width', progress + '%').html(progress + '%');
            }
        });
    }

    $("div.buttons > a.button-select").click(function(event){
        event.preventDefault();
        $(".theme-choice").find("li.theme").removeClass("active");
        $(".button-select").children("i").addClass("hide");

        $(this).parents("li.theme").addClass("active");
        $(this).parent().children("input").attr("checked", "checked");
        $(this).children("i").removeClass("hide");
    });
    
    if($.mask) {
        $('#id_cep, .input-cep').mask('99999-999');

        $('#id_telefone_celular_default, .id_telefone_principal_default').mask('(99) 9999-9999');
        var telefone_selector = '#id_telefone, #id_telefone_celular, #id_telefone_comercial, #id_telefone_principal';
        $(telefone_selector).mask('(99) 9999-9999?9');
        $(telefone_selector).on("keyup",function() {
            var tmp = $(this).val();
            tmp = tmp.replace(/[^0-9]/g,'');
            var ddd = tmp.slice(0, 2);
            var servico_regex = new RegExp('0[0-9]00');
            var servico = servico_regex.exec(tmp.slice(0,4));
            var primeiro_numero_ddd = tmp.slice(0, 1);
            var primeiro_numero = tmp[2];
            if (tmp.length == 11 && primeiro_numero == '9') {
                $(this).unmask();
                $(this).val(tmp);
                $(this).mask("(99) 99999-999?9");
            }
             else if (servico && (tmp.length == 11 || tmp.length == 10)) {
                $(this).unmask();
                $(this).val(tmp);
                $(this).mask("9999-999999?9");
            }
            else if (tmp.length == 10 && (primeiro_numero_ddd == '1' || primeiro_numero_ddd == '2') && primeiro_numero == '9') {
                $(this).unmask();
                $(this).val(tmp);
                $(this).mask("(99) 9999-9999?9");
            } else if (tmp.length == 10) {
                $(this).unmask();
                $(this).val(tmp);
                $(this).mask("(99) 9999-9999?9");
            }
        }).keyup();
    }

    $('.datepicker').datepicker().on('changeDate', function(ev){ $(this).datepicker('hide').blur(); });

    $('select[name^=ativ]').addClass('select_ativo');
    $('select[name^=ativ]').find('[value=True]').css({'backgroundColor': 'green'});
    $('select[name^=ativ]').find('[value=False]').css({'backgroundColor': 'red'});
    $('select[name^=ativ]').change(function() {
        if ($(this).val() == "True") {
            $(this).css({'backgroundColor': 'green', 'color': '#FFFFFF'});
        } else {
            $(this).css({'backgroundColor': 'red', 'color': '#FFFFFF'});
        }
    }).change();

    $('[rel~=tooltip]').tooltip();
    $('.btn-loading').click(function(event) {
        if ($(this).data('loading-text')) {
            $.loader($(this).data('loading-text'));
        } else {
            $.loader('Carregando...');
        }
    });

    /**
     * Faz com que quando 3 atividades sejam selecionadas, todas as outras
     * ativiades fiquem desabilitadas.
     */
    if ($('[name="atividades[]"]').length) {
        $('[name="atividades[]"]').change(
            function() {
                if ($('[name="atividades[]"]:checked').length >= 3) {
                    // Disabilita todos os inputs não checados.
                    $('[name="atividades[]"]:not(:checked)')
                        .attr('disabled', 'disabled')
                        .parents('li')
                        .addClass('disabilitado');
                    $('#maximo-selecionado').show();
                    
                } else {

                    if ($('[name="atividades[]"]:checked').length >= 1) {
                        $('#minimo-selecionado').hide();
                    } else {
                         $('#minimo-selecionado').show();
                    }

                    $('[name="atividades[]"]')
                        .removeAttr('disabled')
                        .parents('li')
                        .removeClass('disabilitado');
                    $('#maximo-selecionado').hide();
                   
                }
            }
        ).change();
    }

    $('.collapse').on('hide', function () {
        $(this).parent().find('.arrow-open i').addClass('icon-chevron-down');
        $(this).parent().find('.arrow-open i').removeClass('icon-chevron-up');
    });
    $('.collapse').on('show', function () {
        $(this).parent().find('.arrow-open i').removeClass('icon-chevron-down');
        $(this).parent().find('.arrow-open i').addClass('icon-chevron-up');
    });
    $('.collapse').on('shown', function () {
        $('html, body').stop().animate({
          'scrollTop': ($(this).offset().top)-90
        }, 500);
    });
});

show_modal_error = function(msg) {
    $('#modal-error .error-text').html(msg);
    jQuery.removeLoader();
    $('#modal-error').modal('show');
};

show_modal_success = function(msg) {
    $('#modal-success .success-text').html(msg);
    jQuery.removeLoader();
    $('#modal-success').modal('show');
};

validar_dominio = function(dominio) {
    regex_dominio = /^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z-]{2,6}$/;
    if (dominio.match(regex_dominio)) {
        return true;
    } else {
        return false;
    }
};

validar_cartao_credito = function(val){
    var nondigits = new RegExp(/[^0-9]+/g);
    var number = val.replace(nondigits,'');
    var pos, digit, i, sub_total, sum = 0;
    var strlen = number.length;
    if (strlen < 13) {
        return false;
    }
    for (i=0;i<strlen;i++){
        pos = strlen - i;
        digit = parseInt(number.substring(pos - 1, pos), 10);
        if(i % 2 == 1){
            sub_total = digit * 2;
            if(sub_total > 9){
                sub_total = 1 + (sub_total - 10);
            }
        } else {
            sub_total = digit;
        }
        sum += sub_total;
    }
    if (sum > 0 && sum % 10 === 0) {
        return true;
    }
    return false;
};

/*
 * Plugin para montagem de modal para exibicao de video.
 *
 * $('.btn-video').video({
 *         id: 'wOA33FPrSdw', // Obrigatorio.
 *         title: '',         // Se deixar nao aparece o titulo.
 *         width: 500,        // Opcional. Padrao 560.
 *         height: 300        // Opcional. Padrao 315.
 *     });
 * });
 */
jQuery.fn.video = function(options) {
    this.each(function() {
        $(this).click(function() {
            var settings = $.extend({
                width: 510,
                height: 315,
                id: '',
                title: ''
            }, options );
  
            if (settings.id === '') {
                return false;
            }
  
            _constructor(settings);
        });
    });

    // Constroi Modal com iframe de video.
    _constructor = function(settings) {
        var iframe = '<iframe width="' + settings.width + '" height="' + settings.height + '" src="//www.youtube.com/embed/' + settings.id + '" frameborder="0" allowfullscreen></iframe>';
        
        if(!settings.title) {
            $('#modal-video .modal-header').hide();
            $('#modal-video .modal-footer').show();
        } else {
            $('#modal-video .modal-header h3').html(settings.title);
        }
        $('#modal-video .modal-body').html(iframe);
        $('#modal-video').css({
            width: settings.width + 30 + 'px'
        });
        $('#modal-video').modal('show');
        $('#modal-video').on('hidden', function() {
            _stop();
        });
    }

    _stop = function() {
        var src;
        src = $('#modal-video .modal-body iframe').attr(src);

        $('#modal-video .modal-body iframe').attr('src', '');
        $('#modal-video .modal-body iframe').attr('src', src);
    }
}

/* Load do RSS do blog e suporte no painel */
function formatar_data(dateObject) {
    var d = new Date(dateObject);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = day + "/" + month + "/" + year;
    return date;
};
function truncar_texto(texto,limite){
    if(texto.length>limite){
        limite--;
        last = texto.substr(limite-1,1);
        while(last!=' ' && limite > 0){
            limite--;
            last = texto.substr(limite-1,1);
        }
        last = texto.substr(limite-2,1);
        if(last == ',' || last == ';'  || last == ':'){
            texto = texto.substr(0,limite-2) + '...';
        } else if(last == '.' || last == '?' || last == '!'){
            texto = texto.substr(0,limite-1);
        } else {
             texto = texto.substr(0,limite-1) + '...';
        }
    }
    return texto;
}
var dataNovo=new Date();
dataNovo.setDate(dataNovo.getDate()-10);
function loaded_blog(result) {
    if (!result.error) {
        for (var i = 0; i < result.feed.entries.length; i++) {
            var entry = result.feed.entries[i];
            var dataPubli = new Date(entry.publishedDate);

			var media = entry['media:content'];
			

            var div = "<div class='media'><a class='pull-left' href='" + entry.link + "' target='_blank'><img class='media-object' src='" + media + "' /></a><div class='media-body'><a href='" + entry.link + "' target='_blank' title='" + entry.title + "'><h4 class='media-heading'><span class='text'>" + truncar_texto(entry.title, 100) + "</span>";
			
			/*
			
            var div = "<div class='media'><a class='pull-left' href='" + entry.link + "' target='_blank'><div class='media-body'><a href='" + entry.link + "' target='_blank' title='" + entry.title + "'><h4 class='media-heading'><span class='text'>" + truncar_texto(entry.title, 100) + "</span>";
			
			*/
			
			
			
            if (dataPubli > dataNovo) {
            div += "<span class='label label-success'>Novo</span>";
            }
            div += "<small> - " + formatar_data(dataPubli) + "</small></h4>" + truncar_texto(entry.contentSnippet, 120) + "</a></div></div>";
            $('.changelog-container .box-content').append(div);
        }
    }
}
function loaded_suporte(result) {
    if (!result.error) {
        for (var i = 0; i < result.feed.entries.length; i++) {
            var entry = result.feed.entries[i];
            var dataPubli = new Date(entry.publishedDate);
            // var img = $(entry.content).find('img:first');
            // console.log(img);
            // img = $(img[0]).attr('src');
            var div = "<div class='media'><div class='media-body'><a href='" + entry.link + "' target='_blank' title='" + entry.title + "'><h4 class='media-heading'><span class='text'>" + truncar_texto(entry.title, 100) + "</span>";
            if (dataPubli > dataNovo) {
            div += "<span class='label label-success'>Novo</span>";
            }
            div += "</h4>" + entry.contentSnippet + "</a></div></div>";
            $('.suporte-container .box-content').append(div);
        }
    }
}


/* Carousel Disposicoes */

$(document).ready(function() {

    $('#disposicoesCarousel').carousel({
      itemsPerPage: 2,
      itemsPerTransition: 2,
      easing: 'linear',
      pagination: false
    });

    $('#linhasColunaCarousel').carousel({
      itemsPerPage: 2,
      itemsPerTransition: 2,
      easing: 'linear',
      pagination: false
    });

    $('#padraoLojaCarousel, #padraoCabecalhoCarousel, #padraoRodapeCarousel').carousel({
      itemsPerPage: 3,
      itemsPerTransition: 3,
      easing: 'linear',
      pagination: false
    });

    $('.tip').tooltip();

    $('.editor-carousel .next').addClass('icon-chevron-right');
    $('.editor-carousel .prev').addClass('icon-chevron-left');

    $('#disposicoesCarousel ul li').click(function () {

      $('#disposicoesCarousel ul li').removeClass('active');
      $(this).addClass('active');
  
    });

    $('#accordionTema .accordion-group:first-child').addClass('active');    

    $('#accordionTema .accordion-group').click(function () {

      $('#accordionTema .accordion-group').removeClass('active');
      $(this).addClass('active');

    });
  
    $('#fundoLoja a, #fundoCabecalho a, #fundoRodape a').click(function (e) {

      e.preventDefault();
      $(this).tab('show');

    });

});

/* Notificacoes */

$(document).ready(function() {

  var qtd = $('.notificacao-item.nova').size();
  $('.notificacoes .contagem').text(qtd);

  $('.notificacao-item').click(function () {

    $(this).removeClass('nova');

    qtd = $('.notificacao-item.nova').size();
    $('.notificacoes .contagem').text(qtd);

    if (qtd <= 0) {

      $('.notificacoes .contagem').addClass('hide');
    }
    else {

      $('.notificacoes .contagem').removeClass('hide');
    } 
            
  });

  $('.notificacao-item a').click(function () {

    var nItem = $(this).attr('class');

    $('.notificacoes-menu li.' + nItem + ' a').click();

  });

  $('.notificacao-item .fechar').click(function(e) {

    e.stopPropagation();

    var qtdTotal = $('.notificacao-item').size();

    if (qtdTotal <= 0) {

      $('.notificacao-vazia').removeClass('hide');
    }

    $(this).closest('.notificacao-item').remove();

  });

  $('#listaNotificacao a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  });

  $('#modal-alerta').modal({
    show: false,
    backdrop: 'static'
  });

  $('#confirmarAlerta').click(function() {

    if ($(this).attr('checked')) {
      $('.fechar-alerta').removeClass('hide');
    }
    else {
      $('.fechar-alerta').addClass('hide');
    }

  });

    /* Pagina Detalhe de Pedidos */
    if($('.page-pedidos')) {
        $('.page-pedidos .confirm-envio-track').click(function (e) {
            $('.box-envio .action-btn').hide();
            $('.box-envio .action-form').show();
        });
        $('.page-pedidos .edit').click(function (e) {
            $('.box-envio .action-btn, .box-envio .done-div').hide();
            $('.box-envio .action-form, .box-envio .action-div').show();
        });
    };

    $('.toggle-menu .action').click(function() {
        var myDate = new Date();
        myDate.setFullYear(myDate.getFullYear() + 5);
        $('#leftCol').toggleClass('slim');
        $(this).find('i').toggleClass('icon-chevron-right icon-chevron-left');
        if($('#leftCol').hasClass("slim")) {
            document.cookie="slim_menu=1; expires=" + myDate + "; domain=" + window.location.host + "; path=/";
        } else {
            document.cookie="slim_menu=0; expires=" + myDate + "; domain=" + window.location.host + "; path=/";
        }
    });

});

/* Parceiros */

$(document).ready(function() {
    $('.parceiros-menu .tipo-parceiro').click(function () {
    	var tipo = $(this).data('parceiro');
    	if (!$(this).parent().hasClass('active')) {
            $('.parceiros-menu ul li').removeClass('active');
            $(this).parents('li').addClass('active');

            if ($(this).parent().hasClass('todos')) {
                $('.parceiro').removeClass('out');
            } else {
                $('.parceiro').removeClass('out');
            	$('.parceiro').not('.' + tipo).addClass('out');
            }
    	}
    });
});



$(document).ready(function (event) {

    $('input[name="funcao_shop[]"]').click(function() {

        var id = $(this).val();
        var email = $(this).attr('data-email');
        var guardName = $(this).attr('data-guardname');
        var guardToken = $(this).attr('data-guardtoken');

        $.ajax({
            type: "POST",
            url: "usuario/funcao/",
            data: {id_cliente:id, CSRFGuardName:guardName, CSRFGuardToken:guardToken, email:email} ,
            success: function(data) {

                if (data =='error') {
                    alert('É necessário pelo menos um Administrador.');   
                    location.reload();
                } else if(data =='error_exception'){
                    alert('Houve um erro no processamento do pedido.');   
                    location.reload();
                } else {
                    alert(data);
                    location.reload();
                }                             
                
            }
        });

    });


    /**
    *
    * Ativa serviços de Envio
    *
    **/

    $("#id_ativo").change(function(){

        var data_envio = $(this).attr('data-envio');
        var guardName = $(this).attr('data-guardname');
        var guardToken = $(this).attr('data-guardtoken');

        if (data_envio != "") {

            var ativo =  $(this).val(); 

            $.ajax({
                type: "POST",
                url: window.location.href,
                data: {data_envio:data_envio, ativo:ativo, CSRFGuardName:guardName, CSRFGuardToken:guardToken } ,
                success: function(data) {

                    if (data =='error') {

                        if (ativo === 'True') {
                            alert('Não foi possível ativar a forma de envio. Tente novamente!');   
                        } else {
                            alert('Não foi possível desativar a forma de envio. Tente novamente!');   
                        }
                        
                        location.reload();
						
                    } else if(data =='error_exception'){
						
                        alert('Houve um erro no processamento do pedido.');   
                        location.reload();
						
                    } else if(data =='ok'){

                        if (ativo === 'True') {
                            alert('Forma de envio ativada com sucesso.');
                        } else {
                            alert('Forma de envio desativada com sucesso.');
                        }
                        
                    }                             
                    
                }
            });

        }
        
    });


    //$('.center').html(data); 

    /*

    $('#conteudo').hide();
    $('#mostrar').click(function (event) {
        event.preventDefault();
        $("#conteudo").show("slow");
    });
    $('#ocultar').click(function (event) {
        event.preventDefault();
        $("#conteudo").hide("slow");
    });

    */
});

$(document).ready(function(){

    $("input.input-price").maskMoney({showSymbol:true, decimal:",", thousands:"."});
    $("input.input-desconto").maskMoney({showSymbol:true, decimal:",", thousands:"."});
    $("#id_valor").maskMoney({showSymbol:true, decimal:",", thousands:"."});
    
});
