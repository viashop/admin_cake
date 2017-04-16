
<style type="text/css">
.show-grid:hover {background-color:#d4d3d5;}
    #geral_preview {
    position:absolute;
    width:300px;
    padding:0;
    margin-left:520px;
}

#geral_preview.affix { position: fixed; top: 45px; margin-left: 520px; }
#geral_preview .inner {
    position:relative;
    background:#a3cdff;
    border:1px dashed #00387a;
    height:246px;
}

#geral_preview .header {
    height:40px;
    background:#bdffb8;
    border:1px dashed #30752a;
}
#geral_preview .footer {
    height:50px;
    background:#f4b3ff;
    border:1px dashed #52065e;
}
#geral_preview .col {
    color:white;
    overflow:hidden;
    text-align: center;
    background:#d64949;
}

#geral_preview .col-left {
    height:150px;
    float:left;
    left:0;
    width:15%;
}
#geral_preview .col-none {
    height:15px;
    padding-bottom:5px;
    width:100%;
}
#geral_preview .col-right {
    height:150px;
    float:right;
    right:0;
    width:15%;
}

.slider {
    margin: 0 auto;
    text-align:center;
}
.border-radius {
    border-radius:10px;
    -moz-border-radius:10px;
    -webkit-border-radius:10px;

}
.produto {
    width:25px;
    height:25px;
    background:#99ffa3;
    margin:5px;
}

.produtos ul {
    margin: 0 -5px;
    overflow:hidden;
    margin:0 auto;
}
.produtos ul li {
    float:left;
}
.produtos ul li h4 {
    line-height: 25px;
    text-align: center;
    background:white;
    height:25px;
    margin:5px;
}
.four-prods li {
    width:25%;
}
.two-prods li {
    width:50%;
}
.three-prods li {
    width:33.3%;
}
.five-prods li {
    width:20%;
}

.header-wrapper {
    background: #51a1cf;
}
.footer-wrapper {
    background:#51a1cf;
}
.uploaded_image {
    overflow: hidden;
    float:left;
    max-width: 150px;
    max-height: 150px;
}
.uploaded_image a {
    float:left;
    display: block;
    margin:5px;
}
.uploaded_image a:hover {
    opacity:0.8;
}
.botao-dropdown {
    height:20px;
}
.input-append, .input-prepend {
    white-space: normal;
}

</style>
<script type="text/javascript">
    function resize(object) {
        object.
        animate({width: 230}, 1000).
        animate({width: 310}, 1000);

    }
    function atualizar_slide(input) {
        if (input.value) {
            var value = input.value;
            var total = input.value / 4;
        } else {
            var value = input.val();
            var total = input.val() / 4;
        }
        if (input.value > 1060) {
            alert('Valor máximo de largura é de 1060px');
            input.value = 1060;
            return false;
        }else if (input.value < 840) {
            alert('Valor minimo de largura é de 840px');
            input.value = 840;
            return false;
        }
        $('h5.status').html('Fixo: ' + value + 'px')
        $('.slider').css('width', total);

    }
    function atualizar_layout(layout) {
        if (layout == 'full') {
            $('h5.status').html('Página inteira');
            $('.slider').css('width', '99%');

        }else if (layout == 'elastico'){
            resize($('#geral_preview .inner'));
            $('h5.status').html('Elástico');
            $('.slider').css('width', '90%');
        }
    }

    $(document).ready(function() {

        /* Abre ultima aba antes de salvar. */
        if (document.location.hash) {
          var hash = document.location.hash;
          if ($(hash).length) {
            $('a[href="' + hash + '"]').click();
          }
        }

        $('.collapse').on('show', function() {
          var action = $('#formConfigTema').attr('action').replace(/#.*$/, '');
          action = action + '#' + this.id;
          $('#formConfigTema').attr('action', action);
        });


        $('.escolher_padrao').click(function(event) {
            event.preventDefault();
            var li = $(this);
            if (!li.hasClass('active')) {
                li.parents('ul').find('li').removeClass('active');
                li.parents('ul').find('input').removeAttr('checked');
                li.addClass('active');
                li.find('input').attr('checked', 'checked');
            } else {
                li.parents('ul').find('li').removeClass('active');
                li.parents('ul').find('input').removeAttr('checked');
            }
        });

        $('.remover_padrao').click(function(event) {
            event.preventDefault();
            var pai = $(this).parents('.control-group');
            pai.find('input').removeAttr('checked');
            pai.find('.active').removeClass('active');
        });
        $('#id_tipo_listagem').change(function(event) {

            if($(this).val() == 'alfabetica') {
                $('#quantidade').slideUp();
                $('#quantidade_fixa').slideDown();
            } else {
                $('#quantidade').slideDown();
                $('#quantidade_fixa').slideUp();
            }
        }).change();
        $('a[data-toggle=tooltip]').tooltip();
        $('.alterar_disposicao').click(function(event) {
            event.preventDefault();
            $('.alterar_disposicao input').removeAttr('checked');
            $(this).find('input').attr('checked', 'checked').change();


        });
        // disposições
        $('#id_cabecalho').change(function(event) {
            var valor = $(this).val();
            var cabecalho = $('.disposicao_cabecalho');
            var base_url = cabecalho.data('base-url');
            cabecalho.attr('src', base_url  + valor + '.png');
        }).change();

        $('#id_coluna').change(function(event) {
            var valor = $(this).val();
            $('.coluna').remove();
            var coluna = '<div class="coluna span3 show-grid alpha" title="Coluna lateral">Coluna lateral</div>';
            var conteudo = $('.preview .conteudo');
            var produto_coluna = $('#id_produto_coluna');
            if (valor == 'esquerda') {
                conteudo.removeClass('span12').addClass('span9');
                conteudo.before(coluna);
                produto_coluna.parents('.control-group').slideDown();

            } else if (valor == 'direita') {
                conteudo.removeClass('span12').addClass('span9');
                conteudo.after(coluna);
                produto_coluna.parents('.control-group').slideDown();
            } else {
                conteudo.removeClass('span9').addClass('span12');
                produto_coluna.parents('.control-group').slideUp();
            }
        }).change();

        $('[name=disposicao]').change(function(event) {
            var url = 'loja/tema/visualizar/disposicao';
            var disposicao_id = $(this).val();
            $.get(url, {disposicao: disposicao_id}, function(data) {
                var content = $(data);
                var banner = content.find('.banner').html();
                var conteudo = content.find('.conteudo').html();
                $('.preview .conteudo').html(conteudo);
                $('.preview .banner').html(banner);
            }, 'html');
        });
        
        $('.mudar_tema').click(function(event) {
            event.preventDefault();
            var tema_id = $('#id_tema').val();
            var url = 'loja/tema/alterar';
            var next = 'loja/tema/editar';
            var location = url + '?tema_id='  + tema_id + '&next=' + next;
            window.location = location;
        });

        $('.conteudo').on('click', '.show-grid', function(event) {
            var componente = $(this).data('componente');
            var url = "/admin/loja/tema/editar/componente";

            $.get(url, {componente:componente}, function(data) {
                $('#configuracoes_modal .modal-body').html(data);
                $('#configuracoes_modal').modal('show');
            });
        });

        $('.salvar_configuracao').click(function(event) {
            event.preventDefault();
            var form = $('#configuracoes_modal').find('form');
            var url = form.attr('action');
            var dados = form.serialize();
            $.post(url, dados, function(data) {
                if(data.status == 'sucesso') {
                    $('#configuracoes_modal').modal('hide');
                } else{
                    alert(data.mensagem);
                }
            }, 'JSON');
            // $('#configuracoes_modal').find('form').submit();
        });
        $('#id_menu').change(function(event) {
            var valor = $(this).attr('checked');
            var menu = $('.menu');
            if(valor == 'checked') {
                menu.fadeIn();
            }else {
                menu.fadeOut();
            }
        }).change();

        $('#id_tamanho').change(function(event) {
            var tamanho = $('option:selected', this).html();
            tamanho = tamanho.toLowerCase();
            var valor;
            if(tamanho == 'grande') {
                valor = '100%';
            } else if (tamanho == 'médio') {
                valor = '1180px';
            } else {
                valor = '980px';
            }
            $('.tamanho_preview span').html(valor);
        }).change();

        $.each($('.escolher_cor'), function(key, value) {
            $(value).attr('tabindex', '-1');
            var cor = $(value).val();
            var id = $(value).attr('id');
            $('#'+id).after('<span class="btn btn-small remover_cor"><i class="icon-trash"></i></span>');
            $('#'+id).before('<span class="add-on"><i class="amostra_cor" style="background-color:' + cor + ';"></i></span>');
            var container = $(this).data('container');
            if (container) {
                $('.' + container ).css('background-color', cor);
            }
        });
        $('.escolher_cor').colorpicker().on('changeColor', function(event) {
            var container = $(this).data('container');
            $('.' + container ).css('background-color', event.color.toHex());
            $(this).parent().find('.amostra_cor').css('background-color', event.color.toHex());
        });
        $('#id_tipo_layout').change(function(event){
            if ($(this).val() == 'fixo') {
                atualizar_slide($('#id_width_layout_fixo'));
                $('.width_layout_fixo').stop().slideDown();
            }else{
                atualizar_layout($(this).val());
                $('.width_layout_fixo').slideUp();
            }
        }).change();
        $('#id_cantos_arrendondados').change(function(event) {
            if($(this).attr('checked')) {
                $('.content, .header, .footer').addClass('border-radius');
            }else {
                $('.content, .header, .footer').removeClass('border-radius');

            }
        }).change();
        $('#id_tipo_coluna').change(function(event) {
            $('.col').hide();
            $('.' + $(this).val()).show();
        }).change();
        $('.visualizar_imagem').click(function(event) {
            var url = $(this).parents('.controls').find('input').val();
            event.preventDefault();
            $.fancybox.open([
                {href: url}
            ]);
        });
        // $('.visualizar_imagem').fancybox({
        //     fitToView   : true,
        //     width       : '85%',
        //     height      : '70%',
        //     autoSize    : true,
        //     closeClick  : false,
        //     openEffect  : 'none',
        //     closeEffect : 'none'
        // });
        $('#id_produtos_linha').change(function(event) {
            var lista = ['zero', 'one', 'two', 'three', 'four', 'five'];
            var coluna = $(this).val();
            $('#produtos').removeClass();
            $('#produtos').addClass(lista[coluna] + '-prods');
        }).change();
        $('.imagem_background').change(function(event) {
            if($(this).val().length > 10) {
                $(this).closest('.configuracao').children('.imagem_opcoes').slideDown();
            } else {
                $(this).closest('.configuracao').children('.imagem_opcoes').slideUp();
            }
        }).change();
        $('.remover_cor').click(function(event) {
            event.preventDefault();
            $(this).parent().find('input').val('');
            var container = $(this).parent().find('input').data('container');
            var cor_original = $(this).parent().find('input').data('cor-original');
            $('.' + container ).css('background-color', cor_original);
            $(this).parent().find('.amostra_cor').css('background-color', '#eeeeee');
        });
        $('.escolher_imagens').click(function(event) {
            event.preventDefault();
            var id = $(this).attr('href');
            var target = $(this).parents('.controls').find('input').attr('id');
            $('#arquivo').data('target', target);
            $.getJSON('recurso/galeria/listar.json', function(data) {
                $('ul.imagens').html('');
                $.each(data, function(k, v) {
                    var imagem = '<li class="uploaded_image"><a href="#" data-url="' + data[k].caminho + '" data-target="' + target + '" class="mudar_imagem" ><img src="' + data[k].icone + '" /></a></li>';
                    $('ul.imagens').append(imagem);
                });
                $(id).modal('show');
            });
        });
        $('#imagens-upload').on('click','.mudar_imagem', function(event) {
            event.preventDefault();
            var target = $(this).data('target');
            var url = $(this).data('url');
            $('#imagens-upload').modal('hide');
            $('#' + target).val(url);
            $('#' + target).closest('.configuracao').children('.imagem_opcoes').slideDown();
        });
        $("#arquivo").fileupload({
            // dataType: 'json',
            singleFileUploads: false,
            // dropZone: $('#dropzone, #uploadImagemProduto'),
            add: function(e, data) {
                $('#imagens-upload').find('.progress').show();
                data.submit();
            },
            done: function (e, data) {
                $('#imagens-upload').find('.progress').hide();
                $('#imagens-upload').find('.progress').find('.bar').css('width','0%');
                var target = $('#arquivo').data('target');
                $('#' + target).val(data.result);
                $('#' + target).closest('.configuracao').children('.imagem_opcoes').slideDown();
                $('#imagens-upload').modal('hide');
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#imagens-upload').find('.progress').find('.bar').css('width', progress + '%');
            }


        });
        $('.remover_imagem').click(function(event) {
            event.preventDefault();
            $(this).parents('.control-group').find('input').val('');
            $(this).closest('.configuracao').find('.imagem_opcoes').slideUp();
        });

        $('[data-toggle=popover]').popover({'trigger': 'hover'});

        // $('.escolher_cor').hover(function(event) {
        //     var id = $(this).data('container');
        //     $('.' + id).css('background-color','#fff');
        // }, function(event) {
        //     var id = $(this).data('container');
        //     $('.' + id).css('background-color','#000');
        // });
        // $('#id_color_1, #id_color_2, #id_color_3, #id_color_4').colorpicker().on('changeColor', function(event) {
        //     $(this).parent().find('.add-on > i').css('background-color', event.color.toHex());
        // });
        // $('#id_geral__background_cor, #id_cabecalho__background_cor, #id_rodape__background_cor, #id_corpo__background_cor, #id_conteudo__background_cor').colorpicker().on('changeColor', function(event) {
        //     $(this).parent().find('.add-on > i').css('background-color', event.color.toHex());
        // });

        $('select[name=ativo]').addClass('select_ativo');
        $('select[name=ativo]').find('[value=True]').css({'backgroundColor': 'green'});
        $('select[name=ativo]').find('[value=False]').css({'backgroundColor': 'red'});
        $('select[name=ativo]').change(function() {
            if ($(this).val() == "True") {
                $(this).css({'backgroundColor': 'green', 'color': '#FFFFFF'});
            } else {
                $(this).css({'backgroundColor': 'red', 'color': '#FFFFFF'});
            }
        }).change();
        $('.botao-dropdown').click(function(event){
            if ($(this).parents('.controls').find('input').val().length > 10) {
                $(this).parent().find('.opcao-condicional').show();
            }else {
                $(this).parent().find('.opcao-condicional').hide();
            }
        });
    });
</script>



<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/tema/alterar"><i class="icon-window icon-custom"></i> Aparência</a> <span class="bread-separator">-</span></li>
		<li><span>Configurar tema</span></li>
	</ul>
</div>
<div class="box">
	<div class="box-header">
		<h3>Layout da Loja</h3>
		<div class="box-widget pull-right ">
			<select name="tema" id="id_tema" style="margin-top:6px;">
				<option value="2" >
					Estrutura antiga - Tema padrão
				</option>
				<option value="3" >
					Estrutura antiga - Clothe Store
				</option>
				<option value="4" >
					Estrutura antiga - Mobile Store
				</option>
				<option value="5" selected="selected">
					Estrutura Nova
				</option>
			</select>
			<a href="#" class="btn btn-primary mudar_tema" style="margin-top:-3px;">OK</a>
		</div>
	</div>
	<div class="box-content tema-editar">
		<form action="/admin/loja/tema/editar/disposicao#disposicaoLayout" method="POST" id="formConfigTema">
			<div class="row row-fluid">
				<div class="span4">
					<div class="configurar-estrutura">
						<h1>Configurar o Tema</h1>
						<div class="accordion" id="accordionTema">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#disposicaoLayout" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTema">
									Disposição do layout
									</a>
								</div>
								<div id="disposicaoLayout" class="accordion-body collapse in">
									<div class="accordion-inner">
										<div class="control-group">
											<label class="label-control">
											Tamanho do Layout
											</label>
											<div class="controls">
												<select id="id_tamanho" name="tamanho">
													<option value="tema-pequeno">Pequeno</option>
													<option value="" selected="selected">Médio</option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="label-control">
											Disposição do logotipo
											</label>
											<div class="controls">
												<select id="id_cabecalho" name="cabecalho">
													<option value="logo-no-centro">Logo no Centro</option>
													<option value="logo-na-esquerda" selected="selected">Logo a Esquerda</option>
												</select>
											</div>
										</div>
										<div class="control-group editor-carousel">
											<label class="label-control">
											Disposição dos ítens da loja<i data-toggle="tooltip" title="Acompanhe ao lado a disposição de como os itens podem ficar em sua loja" class="icon-question-sign tip"></i>
											</label>
											<div id="disposicoesCarousel">
												<ul>
													<li id="disposicao001" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao01.gif" title="Disposicao 01" />
														<span>Disposição 01</span>
														<input id="disposicao_001" type="radio" name="disposicao" value="001" >
														</a>
													</li>
													<li id="disposicao002" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao02.gif" title="Disposicao 02" />
														<span>Disposição 02</span>
														<input id="disposicao_002" type="radio" name="disposicao" value="002" >
														</a>
													</li>
													<li id="disposicao003" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao03.gif" title="Disposicao 03" />
														<span>Disposição 03</span>
														<input id="disposicao_003" type="radio" name="disposicao" value="003" >
														</a>
													</li>
													<li id="disposicao004" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao04.gif" title="Disposicao 04" />
														<span>Disposição 04</span>
														<input id="disposicao_004" type="radio" name="disposicao" value="004" >
														</a>
													</li>
													<li id="disposicao005" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao05.gif" title="Disposicao 05" />
														<span>Disposição 05</span>
														<input id="disposicao_005" type="radio" name="disposicao" value="005" >
														</a>
													</li>
													<li id="disposicao006" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao06.gif" title="Disposicao 06" />
														<span>Disposição 06</span>
														<input id="disposicao_006" type="radio" name="disposicao" value="006" >
														</a>
													</li>
													<li id="disposicao007" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao07.gif" title="Disposicao 07" />
														<span>Disposição 07</span>
														<input id="disposicao_007" type="radio" name="disposicao" value="007" >
														</a>
													</li>
													<li id="disposicao008" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao08.gif" title="Disposicao 08" />
														<span>Disposição 08</span>
														<input id="disposicao_008" type="radio" name="disposicao" value="008" >
														</a>
													</li>
													<li id="disposicao009" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao09.gif" title="Disposicao 09" />
														<span>Disposição 09</span>
														<input id="disposicao_009" type="radio" name="disposicao" value="009" >
														</a>
													</li>
													<li id="disposicao010" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao10.gif" title="Disposicao 10" />
														<span>Disposição 10</span>
														<input id="disposicao_010" type="radio" name="disposicao" value="010" >
														</a>
													</li>
													<li id="disposicao011" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao11.gif" title="Disposicao 11" />
														<span>Disposição 11</span>
														<input id="disposicao_011" type="radio" name="disposicao" value="011" >
														</a>
													</li>
													<li id="disposicao012" >
														<a href="#" class="alterar_disposicao"><img src="/admin/img/disposicoes/disposicao12.gif" title="Disposicao 12" />
														<span>Disposição 12</span>
														<input id="disposicao_012" type="radio" name="disposicao" value="012" >
														</a>
													</li>
												</ul>
											</div>
										</div>
										<div class="control-group">
											<label class="label-control">
											Disposição da coluna lateral
											</label>
											<div class="controls">
												<select id="id_coluna" name="coluna">
													<option value="esquerda" selected="selected">Do lado esquerdo</option>
													<option value="direita">Do lado direito</option>
													<option value="sem">Sem coluna</option>
												</select>
											</div>
										</div>
										<h4 class="divisor">Opcionais</h4>
										<div class="control-group hide">
											<label class="label-control checkbox">
											Coluna na página de produto?
											<input id="id_produto_coluna" name="produto_coluna" type="checkbox" />
											</label>
										</div>
										<div class="control-group">
											<label class="checkbox">
											Mostrar menu superior?
											<input checked="checked" id="id_menu" name="menu" type="checkbox" />
											</label>
										</div>
										<div class="control-group">
											<label class="checkbox">
											Expandir menu lateral somente quando passar o mouse?
											<input checked="checked" id="id_menu_lateral_expandido" name="menu_lateral_expandido" type="checkbox" />
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#coresLayout" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTema">
									Cor Principal
									</a>
								</div>
								<div id="coresLayout" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="control-group">
											<label class="label-control">
											Escolha a cor principal da sua loja<br>
											<small class="muted">A cor principal é a cor predominante no seu tema, ela sera aplicada nas áreas de destaque como títulos, links, preços, tags, ícones e botões principais. </small>
											</label>
											<div class="controls input-prepend input-append color">
												<input class="escolher_cor input-mini" id="id_cor_principal" maxlength="32" name="cor_principal" type="text" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#estiloLayout" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTema">
									Estilo do Tema
									</a>
								</div>
								<div id="estiloLayout" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="control-group">
											<label class="label-control">
											Cor da área de conteúdo (conteiner)<br>
											<small class="muted">Defina se o fundo do seu tema tera cores claras, escuras ou a área de conteúdo sera transparente. </small>
											</label>
											<div class="controls">
												<select id="id_tipo_tema" name="tipo_tema">
													<option value="" selected="selected">Cores claras</option>
													<option value="tema-escuro">Cores escuras</option>
													<option value="tema-transparente">Transparente</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#backgroundsLayout" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTema">
									Backgrounds
									</a>
								</div>
								<div id="backgroundsLayout" class="accordion-body collapse">
									<div class="accordion-inner">
										<h4 class="divisor primeiro">Plano de fundo para toda a loja</h4>
										<ul class="nav nav-tabs" id="fundoLoja">
											<li class="active"><a href="#padraoLoja" data-toggle="tab">Padrão</a></li>
											<li class=""><a href="#corLoja" data-toggle="tab">Cor</a></li>
											<li class=""><a href="#imagemLoja" data-toggle="tab">Imagem</a></li>
										</ul>
										<div class="tab-content">
											<div class="control-group tab-pane active editor-carousel" id="padraoLoja">
												<label class="label-control">Padrão para o fundo <a href="#" class="remover_padrao" data-toggle="tooltip" title="Remover padrão" rel="tooltip"><i class="icon-trash"></i></a></label>
												<div id="padraoLojaCarousel" class="padroes-carousel">
													<ul>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao01-thumb.jpg" title="padrao 01" />
															<input type="radio" value="01" name="padrao_imagem" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao02-thumb.jpg" title="padrao 01" />
															<input type="radio" value="02" name="padrao_imagem" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao03-thumb.jpg" title="padrao 01" />
															<input type="radio" value="03" name="padrao_imagem" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao04-thumb.jpg" title="padrao 01" />
															<input type="radio" value="04" name="padrao_imagem" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao05-thumb.jpg" title="padrao 01" />
															<input type="radio" value="05" name="padrao_imagem" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao06-thumb.jpg" title="padrao 01" />
															<input type="radio" value="06" name="padrao_imagem" >
															</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="control-group tab-pane  " id="corLoja">
												<label class="control-label">Cor para o fundo</label>
												<div class="controls">
													<div class="input-prepend input-append color">
														<input class="escolher_cor input-mini" id="id_body_cor" maxlength="32" name="body_cor" type="text" />
													</div>
												</div>
											</div>
											<div class="control-group tab-pane subir-imagem " id="imagemLoja">
												<label class="control-label">Subir imagem para o fundo</label>
												<div class="controls">
													<div class="input-append">
														<input class="input-medium imagem_background" id="id_body_imagem" maxlength="256" name="body_imagem" type="text" />
														<div class="dropdown pull-right">
															<a href="#" data-toggle="dropdown" class="btn dropdown-toggle botao-dropdown"><span class="icon-upload"></span></a>
															<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
																<li>
																	<a href="#imagens-upload" class="escolher_imagens">
																	<i class="icon-picture"></i>
																	Escolher imagem
																	</a>
																</li>
																<li class="opcao-condicional">
																	<a href="#" class="visualizar_imagem">
																	<i class="icon-eye-open"></i>
																	Visualizar imagem
																	</a>
																</li>
																<li class="divider opcao-condicional"></li>
																<li class="opcao-condicional">
																	<a tabindex="-1" href="#" class="remover_imagem">
																	<i class="icon-trash"></i>
																	Remover imagem
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<div class="bg-parametros">
													<div class="controls">
														<label class="control-label">Repetir:</label>
														<select class="span8" id="id_body_repeat" name="body_repeat">
															<option value="repeat">Repetir</option>
															<option value="no-repeat">Não repetir</option>
															<option value="repeat-y">Vertialmente</option>
															<option value="repeat-x">Horizontalmente</option>
														</select>
													</div>
													<div class="controls">
														<label class="control-label">Posição:</label>
														<select class="span8" id="id_body_posicao" name="body_posicao">
															<option value="center">Centro</option>
															<option value="left">Esquerda</option>
															<option value="right">Direita</option>
														</select>
													</div>
													<div class="controls">
														<label class="control-label">Tipo:</label>
														<select class="span8" id="id_body_attachment" name="body_attachment">
															<option value="None">Scroll</option>
															<option value="fixed">Fixed</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<h4 class="divisor">Plano de fundo para o cabeçalho</h4>
										<ul class="nav nav-tabs" id="fundoCabecalho">
											<li class="active"><a href="#padraoCabecalho" data-toggle="tab">Padrão</a></li>
											<li class=""><a href="#corCabecalho" data-toggle="tab">Cor</a></li>
											<li class=""><a href="#imagemCabecalho" data-toggle="tab">Imagem</a></li>
										</ul>
										<div class="tab-content">
											<div class="control-group tab-pane editor-carousel active" id="padraoCabecalho">
												<label class="label-control">Padrão para o fundo <a href="#" class="remover_padrao" title="Remover padrão" rel="tooltip"><i class="icon-trash"></i></a></label>
												<div id="padraoCabecalhoCarousel" class="padroes-carousel">
													<ul>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao01-thumb.jpg" title="padrao 01" />
															<input type="radio" value="01" name="padrao_imagem_cabecalho" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao02-thumb.jpg" title="padrao 01" />
															<input type="radio" value="02" name="padrao_imagem_cabecalho" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao03-thumb.jpg" title="padrao 01" />
															<input type="radio" value="03" name="padrao_imagem_cabecalho" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao04-thumb.jpg" title="padrao 01" />
															<input type="radio" value="04" name="padrao_imagem_cabecalho" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao05-thumb.jpg" title="padrao 01" />
															<input type="radio" value="05" name="padrao_imagem_cabecalho" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao06-thumb.jpg" title="padrao 01" />
															<input type="radio" value="06" name="padrao_imagem_cabecalho" >
															</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="control-group tab-pane  " id="corCabecalho">
												<label class="control-label">Cor para o fundo</label>
												<div class="controls">
													<div class="input-prepend input-append color">
														<input class="escolher_cor input-mini" data-container="header-wrapper" data-cor-original="#FFFFFF" id="id_cabecalho_cor" maxlength="32" name="cabecalho_cor" type="text" />
													</div>
												</div>
											</div>
											<div class="control-group tab-pane subir-imagem " id="imagemCabecalho">
												<label class="control-label">Imagem para o fundo</label>
												<div class="controls">
													<div class=" input-append">
														<input class="input-medium imagem_background" id="id_cabecalho_imagem" maxlength="256" name="cabecalho_imagem" type="text" />
														<div class="dropdown pull-right">
															<a href="#" data-toggle="dropdown" class="btn dropdown-toggle botao-dropdown"><span class="icon-upload"></span></a>
															<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
																<li>
																	<a href="#imagens-upload" class="escolher_imagens">
																	<i class="icon-picture"></i>
																	Escolher imagem
																	</a>
																</li>
																<li class="opcao-condicional">
																	<a href="#" class="visualizar_imagem">
																	<i class="icon-eye-open"></i>
																	Visualizar imagem
																	</a>
																</li>
																<li class="divider opcao-condicional"></li>
																<li class="opcao-condicional">
																	<a tabindex="-1" href="#" class="remover_imagem">
																	<i class="icon-trash"></i>
																	Remover imagem
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<div class="bg-parametros">
													<div class="controls">
														<label class="control-label">Repetir:</label>
														<select class="span8" id="id_cabecalho_repeat" name="cabecalho_repeat">
															<option value="repeat">Repetir</option>
															<option value="no-repeat">Não repetir</option>
															<option value="repeat-y">Vertialmente</option>
															<option value="repeat-x">Horizontalmente</option>
														</select>
													</div>
													<div class="controls">
														<label class="control-label">Posição:</label>
														<select class="span8" id="id_cabecalho_posicao" name="cabecalho_posicao">
															<option value="center">Centro</option>
															<option value="left">Esquerda</option>
															<option value="right">Direita</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<h4 class="divisor">Plano de fundo para o rodapé</h4>
										<ul class="nav nav-tabs" id="fundoRodape">
											<li class="active"><a href="#padraoRodape" data-toggle="tab">Padrão</a></li>
											<li class=""><a href="#corRodape" data-toggle="tab">Cor</a></li>
											<li class=""><a href="#imagemRodape" data-toggle="tab">Imagem</a></li>
										</ul>
										<div class="tab-content">
											<div class="control-group tab-pane editor-carousel active" id="padraoRodape">
												<label class="label-control">Padrão para o fundo <a href="#" class="remover_padrao" title="Remover padrão" rel="tooltip"><i class="icon-trash"></i></a></label>
												<div id="padraoRodapeCarousel" class="padroes-carousel">
													<ul>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao01-thumb.jpg" title="padrao 01" />
															<input type="radio" value="01" name="padrao_imagem_rodape" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao02-thumb.jpg" title="padrao 01" />
															<input type="radio" value="02" name="padrao_imagem_rodape" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao03-thumb.jpg" title="padrao 01" />
															<input type="radio" value="03" name="padrao_imagem_rodape" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao04-thumb.jpg" title="padrao 01" />
															<input type="radio" value="04" name="padrao_imagem_rodape" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao05-thumb.jpg" title="padrao 01" />
															<input type="radio" value="05" name="padrao_imagem_rodape" >
															</a>
														</li>
														<li class="escolher_padrao " >
															<a href="#" >
															<img src="/admin/img/padroes/padrao06-thumb.jpg" title="padrao 01" />
															<input type="radio" value="06" name="padrao_imagem_rodape" >
															</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="control-group tab-pane  " id="corRodape">
												<label class="control-label">Cor para o fundo</label>
												<div class="controls">
													<div class="input-prepend input-append color">
														<input class="escolher_cor input-mini" id="id_rodape_cor" maxlength="32" name="rodape_cor" type="text" />
													</div>
												</div>
											</div>
											<div class="control-group tab-pane  subir-imagem" id="imagemRodape">
												<label class="control-label">Imagem para o fundo</label>
												<div class="controls">
													<div class=" input-append">
														<input class="input-medium imagem_background" id="id_rodape_imagem" maxlength="256" name="rodape_imagem" type="text" />
														<div class="dropdown pull-right">
															<a href="#" data-toggle="dropdown" class="btn dropdown-toggle botao-dropdown"><span class="icon-upload"></span></a>
															<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
																<li>
																	<a href="#imagens-upload" class="escolher_imagens">
																	<i class="icon-picture"></i>
																	Escolher imagem
																	</a>
																</li>
																<li class="opcao-condicional">
																	<a href="#" class="visualizar_imagem">
																	<i class="icon-eye-open"></i>
																	Visualizar imagem
																	</a>
																</li>
																<li class="divider opcao-condicional"></li>
																<li class="opcao-condicional">
																	<a tabindex="-1" href="#" class="remover_imagem">
																	<i class="icon-trash"></i>
																	Remover imagem
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<div class="bg-parametros">
													<div class="controls">
														<label class="control-label">Repetir:</label>
														<select class="span8" id="id_rodape_repeat" name="rodape_repeat">
															<option value="repeat">Repetir</option>
															<option value="no-repeat">Não repetir</option>
															<option value="repeat-y">Vertialmente</option>
															<option value="repeat-x">Horizontalmente</option>
														</select>
													</div>
													<div class="controls">
														<label class="control-label">Posição:</label>
														<select class="span8" id="id_rodape_posicao" name="rodape_posicao">
															<option value="center">Centro</option>
															<option value="left">Esquerda</option>
															<option value="right">Direita</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#fontesLayout" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTema">
									Fontes
									</a>
								</div>
								<div id="fontesLayout" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="control-group">
											<label class="label-control">
											Fonte primária<br>
											<small class="muted">Fonte padrão de toda loja</small>
											</label>
											<div class="controls">
												<select id="id_fonte_principal" name="fonte_principal">
													<option value="Arial">Arial</option>
													<option value="Open Sans">Open Sans</option>
													<option value="Georgia">Georgia</option>
													<option value="Verdana">Verdana</option>
													<option value="Times New Roman">Times New Roman</option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="label-control">
											Fonte dos títulos<br>
											<small class="muted">Fonte dos títulos, preços e destaques da loja</small>
											</label>
											<div class="controls">
												<select id="id_fonte_titulo" name="fonte_titulo">
													<option value="Open Sans">Open Sans</option>
													<option value="Oswald">Oswald</option>
													<option value="PT Sans">PT Sans</option>
													<option value="Raleway">Raleway</option>
													<option value="Roboto">Roboto</option>
												</select>
											</div>
										</div>
										<ul class="font-peso">
											<li>
												<label class="radio" style="font-weight: 300">
												<input type="radio" name="fonte_titulo_weight" value="300">300 Light
												</label>
											</li>
											<li>
												<label class="radio" style="font-weight: 400">
												<input type="radio" name="fonte_titulo_weight" value="400">400 Normal
												</label>
											</li>
											<li>
												<label class="radio" style="font-weight: 600">
												<input type="radio" name="fonte_titulo_weight" value="600">600 Semi-bold
												</label>
											</li>
											<li>
												<label class="radio" style="font-weight: 700">
												<input type="radio" name="fonte_titulo_weight" value="700">700 Bold
												</label>
											</li>
										</ul>
										<div class="control-group">
											<label class="checkbox" for="id_fonte_titulo_maiuscula"> Fonte Maiuscula
											<input id="id_fonte_titulo_maiuscula" name="fonte_titulo_maiuscula" type="checkbox" />
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="accordion-group">
								<div class="accordion-heading">
									<a href="#listagemLayout" class="accordion-toggle" data-toggle="collapse" data-parent="#accordionTema">
									Listagem de Produtos
									</a>
								</div>
								<div id="listagemLayout" class="accordion-body collapse">
									<div class="accordion-inner">
										<div class="control-group">
											<label class="label-control">
											Qtd de produtos por linha:
											</label>
											<div class="controls">
												<select class="input-mini" id="id_produtos_linha" name="produtos_linha">
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4" selected="selected">4</option>
												</select>
											</div>
										</div>
										<div class="control-group">
											<label class="label-control">
											Tipo listagem:
											</label>
											<div class="controls">
												<select id="id_tipo_listagem" name="tipo_listagem">
													<option value="ultimos_produtos">Últimos produtos adicionados</option>
													<option value="destaque">Produtos em destaque</option>
													<option value="alfabetica" selected="selected">Produtos em ordem alfabética.</option>
												</select>
											</div>
										</div>
										<div class="control-group" id="quantidade">
											<label class="label-control">
											Quantidade
											</label>
											<div class="controls">
												<select class="input-mini" id="id_quantidade_destaque" name="quantidade_destaque">
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
													<option value="13">13</option>
													<option value="14">14</option>
													<option value="15">15</option>
													<option value="16">16</option>
													<option value="17">17</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="21">21</option>
													<option value="22">22</option>
													<option value="23">23</option>
													<option value="24" selected="selected">24</option>
													<option value="25">25</option>
													<option value="26">26</option>
													<option value="27">27</option>
													<option value="28">28</option>
													<option value="29">29</option>
													<option value="30">30</option>
													<option value="31">31</option>
													<option value="32">32</option>
													<option value="33">33</option>
													<option value="34">34</option>
													<option value="35">35</option>
													<option value="36">36</option>
													<option value="37">37</option>
													<option value="38">38</option>
													<option value="39">39</option>
													<option value="40">40</option>
												</select>
											</div>
										</div>
										<div id="quantidade_fixa">
											<small>
											<strong>(limite de 100 produtos)</strong>
											</small>
										</div>
										<div class="control-group">
											<label class="label-control">
											</label>
											<div class="controls">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<button class="btn btn-primary" type="submit">Salvar</button>
					</div>
				</div>
				<div class="span8">
					<div class="tamanho_preview">
						<span class="muted tema-tamannho">
						940px
						</span>
					</div>
					<div class="preview">
						<div class="menu show-grid" title="Menu Superior">
							<span>Menu Superior</span>
						</div>
						<div class="banner"></div>
						<div class="row-fluid">
							<div class="conteudo span9"></div>
						</div>
					</div>
				</div>
				<input type='hidden' name='csrfmiddlewaretoken' value='0WUtP1uSRD8TIph2ljNAIS1h9xxAWGOc' />
		</form>
		</div>
		<div class="box-footer"></div>
	</div>
	<div id="imagens-upload" class="modal hide">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Imagens</h3>
		</div>
		<div class="modal-body">
			<div class="control-group">
				<label for="arquivo" class="label-control">
				Fazer Upload Imagem
				</label>
			</div>
			<input type="file" name="arquivo" id="arquivo" data-url="/admin/recurso/galeria/upload.json" />
			<div class="progress hide">
				<div class="bar" style="width: 0;"></div>
			</div>
			<h3>
				Imagens do sistema
			</h3>
			<ul class="imagens"></ul>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
		</div>
	</div>
	<div id="configuracoes_modal" class="modal hide">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Configurações</h3>
		</div>
		<div class="modal-body">
		</div>
		<div class="modal-footer">
			<a href="#" class="btn btn-primary salvar_configuracao">
			<i class="icon-ok icon-white"></i>
			Salvar
			</a>
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
		</div>
	</div>
</div>
