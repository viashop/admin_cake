jQuery.loader = function(text) {
    $('html, body').animate({ scrollTop:0 }, 'fast');
    $('#loading').hide();
    if (text) {
        $('#loading .loading-text').html(text);
    }
    $('.modal-backdrop').remove();
    $('body').append('<div class="modal-backdrop in"></div>');
    $('#loading').show();
};
String.prototype.toTitleCase = function() {
    var i, str, lowers, uppers;
    str = this.replace(/\w\S*/g, function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });

    // Certain minor words should be left lowercase unless
    // they are the first or last words in the string
    lowers = 'Da,De,Do,Com'.split(',');
    for (i = 0; i < lowers.length; i++)
        str = str.replace(new RegExp('\\s' + lowers[i] + '\\s', 'g'),
            function(txt) {
                return txt.toLowerCase();
            });

    // Certain words such as initialisms or acronyms should be left uppercase
    uppers = ['Id'];
    for (i = 0; i < uppers.length; i++)
        str = str.replace(new RegExp('\\b' + uppers[i] + '\\b', 'g'),
            uppers[i].toUpperCase());

    return str;
};

$(document).ready(function() {
	// Fix click in the dropdown-fixed.
	$('.dropdown-fixed').click(function(e) {
		e.stopPropagation();
	});

	$('.dropdown-advanced').dropdownadvanced({
		debug: true,
		success: function(data, callback) {
			// $.post('/categoria/criar', data, function(response) {
			// 	callback(response.id, response.error);
			// });
			return callback(parseInt(Math.random() * 1000));
		}
	});
	var verificar_precos = function() {
		var preco_venda = $('.preco-venda input').val();
		var preco_promocional = $('.preco-promocional input').val();
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
	};

	$('.preco-venda input').live('keyup', function() {
		$('.price-full span').text(this.value);
		verificar_precos();
	}).keyup();

	$('.preco-promocional input').live('keyup', function() {
		$('.price-promotional span').text(this.value);
		verificar_precos();
	}).keyup();

	$('.scroll-not-propagate').bind('mousewheel', function(e, d) {
		var height = $(this).height();
		var scrollHeight = $(this).get(0).scrollHeight;
		if((this.scrollTop === (scrollHeight - height) && d < 0) || (this.scrollTop === 0 && d > 0)) {
			e.preventDefault();
		}
	});

	$('.menu-section .with-sub a').click(function() {
		if (!$(this).parent().hasClass('active')) {
			var active = $('.menu-section .with-sub.active');
			$('.menu-section .with-sub ul').slideUp();
			$('.menu-section .with-sub').not($(this).parent()).not(active).removeClass('active');
			$(this).parent().find('ul').slideDown(function() {
				active.removeClass('active');
			});
			$(this).parent().addClass('active');
		}
	});
    $('[rel=tooltip]').tooltip();
    /*$('.modo').change(function(event) {

        var modo = $('.modo:checked').val();
        $('.modos').hide();
        $('#modo-' + modo).fadeIn();
    }).change();*/

    // retirando o switchify por problemas de compatibilidade.
	// $('.fancy-switch').switchify();
	$("#fileUploadLogo").fileupload({
        dataType: 'json',
        send: function(e, data){
            // Esconde tudo e mostra a barra e o texto.
            $("#logoLoja .content").children().hide();
            $('#uploadProgressbar .bar').css('width','0%');
            $("#logoLoja .content").children(".upload").show();

        },
        done: function (e, data) {
            var arquivo = data.result.filename;
            var img = $("#imgLogo");
            var static_url = img.data("src");
            $("#logoLoja .content").children().hide();

            if (arquivo){
                img.attr("src", static_url + arquivo);
                img.removeClass("hide");
                img.show();
                $("#logoLoja").removeClass("dashed");
                $("#logoLoja .content").removeClass("no-logo");

            }else{
                $("#fileUploadLogo").show();
                $("#buttonUploadLogo").show();
                $("#logoLoja .content").children(".upload").hide();
                $("#logoLoja .content").append("<div class='alert alert-error'>" + data.result.logo + "</div>");
            }

        },
        progressall: function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#uploadProgressbar .bar').css(
            'width',
            progress + '%'
        );
    }
    });
    if(!$("#imgLogo").hasClass("hide")){
        $("#fileUploadLogo").hide();
        $("#buttonUploadLogo").hide();

    }
    $("#logoLoja").hover(function(){
        if(!$("#imgLogo").hasClass("hide")){
            $("#fileUploadLogo").show();
            $("#buttonUploadLogo").show();

        }
    },function(event){
        if(!$("#imgLogo").hasClass("hide")){
            $("#fileUploadLogo").hide();
            $("#buttonUploadLogo").hide();
        }
    });
    // Parte do wizard sobre os temas

    $("li.theme").click(function(event){
        var t = $(this).find("div.buttons > a.button-select");

        event.preventDefault();
        $(".theme-choice").find("li.theme").removeClass("active");
        $(".theme-choice").find("span.texto").html("Selecionar");
        $(".button-select").children("i").addClass("hide");

        $(t).parents("li.theme").addClass("active");
        $(t).find('span.texto').html('Selecionado');
        $(t).parent().children("input").attr("checked", "checked");
        $(t).children("i").removeClass("hide");
    });


    // $("div.buttons > a.button-select").click(function(event){
    //     event.preventDefault();
    //     $(".theme-choice").find("li.theme").removeClass("active");
    //     $(".theme-choice").find("span.texto").html("Selecionar");
    //     $(".button-select").children("i").addClass("hide");

    //     $(this).parents("li.theme").addClass("active");
    //     $(this).find('span.texto').html('Selecionado')
    //     $(this).parent().children("input").attr("checked", "checked");
    //     $(this).children("i").removeClass("hide");
    // });

    // $("div.list-item.with_radio").click(function(event){
    //     $('div.list-item').removeClass("active");
    //     $(this).addClass("active");
    // });

    // $("div.list-item.with_checkbox").click(function(event){
    //     if ($(this).hasClass("active")) {
    //         $(this).removeClass("active");
    //     } else {
    //         $(this).addClass("active");
    //     }
    // });

    $('div.list-item input').change(function() {
        var item = $(this).parents().filter('.list-item');

        // console.log($(this).is('input[type=radio]'));
        // console.log($(this).attr('type'));

        if ($(this).is('input[type=radio]')) {
            $('div.list-item').removeClass('active');
            $('div.list-item :checked').parents().filter('.list-item').addClass('active');
        } else {
            if ($(this).attr('checked')) {
                item.addClass('active');
            } else {
                item.removeClass('active');
            }
        }

    }).change();

    $('#id_dominio').keyup(function(event){
        $('.dominio-loja').html($(this).val());
    }).keyup();

    $('.tipo-pessoa').change(function(event){
        var val =  $('.tipo-pessoa:checked').val();
        if (val == 'PJ') {
            $('div.tipo-cpf').hide();
            $('div.tipo-cpf input').attr('disabled', 'disabled');
            $('div.tipo-cnpj').show();
            $('div.tipo-cnpj input').removeAttr('disabled');
        } else {
            $('div.tipo-cnpj').hide();
            $('div.tipo-cnpj input').attr('disabled', 'disabled');
            $('div.tipo-cpf').show();
            $('div.tipo-cpf input').removeAttr('disabled');
        }
    }).change();

    var get_cep = function(valor) {
        var url = 'http://cep.republicavirtual.com.br/web_cep.php?cep='+ valor +'&formato=json';
        $.getJSON(url, function(data){
            if ($('body').hasClass('envio')) {
                if (data.address) {
                    var cidade_estado = '<strong>Local:</strong> ' + data.district.toTitleCase() + ', ' + data.city.toTitleCase() + ' / ' + data.state;
                    $('.cidade_estado').html(cidade_estado).show();
                } else {
                    $('.cidade_estado').empty().hide();
                }
            } else {
                if(data.address){
                    $('.hide-before-cep').slideDown();
                    $.each(data, function(i, item){
                        if(i != 'address' && i !='address_type'){
                            if (i != 'state') data[i] = data[i].toTitleCase();
                            $('.' + i).val(data[i]);
                        }
                    });
                    var address = data.address_type + ' ' + data.address.split(/,\s+/g).reverse().join(' ');
                    $('#id_endereco').val(address.toTitleCase());
                    $('#id_numero').focus();
                }else{
                    $('.hide-before-cep').show();
                    $('.hide-before-cep').find('input').val('');
                    $('#id_endereco').focus();
                }
            }
        });
    };


    $('.wizard #id_cep').mask('99999-999', {
        completed: function(event){
            get_cep(this.val());
        }
    });

    $('.wizard #id_cep').change(function() {
        get_cep($(this).val());
    }).change();

    var telefone_selector = '#id_telefone, #id_telefone_celular, #id_telefone_comercial, #id_telefone_principal';
    $(telefone_selector).mask('(99) 9999-9999?9');
    $(telefone_selector).live("keyup",function() {
        var tmp = $(this).val();
        tmp = tmp.replace(/[^0-9]/g,'');
        var ddd = tmp.slice(0, 2);
        var servico_regex = new RegExp('0[0-9]00');
        var servico = servico_regex.exec(tmp.slice(0,4));
        var primeiro_numero_ddd = tmp.slice(0, 1);
        var primeiro_numero = tmp[2];
        // console.log('trigger');
        if (tmp.length == 11 && (primeiro_numero_ddd == '1' || primeiro_numero_ddd == '2') && primeiro_numero == '9') {
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
            $(this).mask("(99) 9999-9999");
        }
    }).keyup();

    $('.wizard #id_cpf').mask('999.999.999-99');
    $('.wizard #id_cnpj').mask('99.999.999/9999-99');
    if ($('.wizard #id_cep').length && $('.wizard #id_cep').val().length) {
        $('.hide-before-cep').show();
    }

    $('#id_mostrar_endereco').change(function() {
        if ($(this).attr('checked')) {
            $('.endereco').slideDown();
        } else {
            $('.endereco').slideUp();
        }
    }).change();

    if ($('[name=atividades]').length) {
        $('[name=atividades]').change(
            function() {
                if ($('[name=atividades]:checked').length >= 3) {
                    // Disabilita todos os inputs não checados.
                    $('[name=atividades]:not(:checked)')
                        .attr('disabled', 'disabled')
                        .parents('li')
                        .addClass('disabilitado');
                    $('#maximo-selecionado').show();
                } else {
                    $('[name=atividades]')
                        .removeAttr('disabled')
                        .parents('li')
                        .removeClass('disabilitado');
                    $('#maximo-selecionado').hide();
                }
            }
        ).change();
    }

});
