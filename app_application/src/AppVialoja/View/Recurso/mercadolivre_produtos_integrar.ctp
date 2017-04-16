<script src="/admin/js/mercadolibre-1.0.4.js"></script>
<script type="text/javascript" src='/admin/js/mercadolivre.js'></script>
<script type='text/javascript'>
	function formatar_grades(grades) {
		saida = '';
		var grade = ' <small><strong>:GRADE:</strong>: :VARIACAO:</small>,<br />';
		$.each(grades, function(k, v) {
			var grade_variacao = grade.replace(':GRADE:', k);
			grade_variacao = grade_variacao.replace(':VARIACAO:', v);
			saida = saida + grade_variacao;
		});
		return saida;
	}
	function formatar_nome_produto(p, grades) {
		saida = p.nome;
		var grade = ' :GRADE: :VARIACAO:';
		$.each(grades, function(k, v) {
			var grade_variacao = grade.replace(':GRADE:', k);
			grade_variacao = grade_variacao.replace(':VARIACAO:', v);
			saida = saida + grade_variacao;
		});
		return saida;
	
	}
	function adicionar_produto(p) {
		// console.log('Adicionando produto...');
		var template_produto = '\
				<tr>\
					<td>:NOME: </td>\
					<td>R$ :PRECO:<input class="produto_integrar" type="hidden" value=":PRODUTOID:" name="produto_id_:PRODUTOID:" /></td>\
					<td>\
						<input value=":QUANTIDADE:" type="text" name="produto_quantidade_:PRODUTOID:" class="input-price input-qtd" />\
					</td>\
					<td>\
						<div class="input-prepend">\
							<span class="add-on">R$</span>\
							<input value=":PRECO:" type="text" name="produto_preco_:PRODUTOID:" class="input-price" />\
						</div>\
						<a href="#" class="remover_produto pull-right" ><i class="icon-trash"></i></a>\
					</td>\
				</tr>';
		template_produto = template_produto.replace(/:PRECO:/g, formatar_decimal_br(p.venda));
		template_produto = template_produto.replace(/:PRODUTOID:/g, p.id);
		template_produto = template_produto.replace(/:NOME:/g, p.nome);
		template_produto = template_produto.replace(/:QUANTIDADE:/g, p.estoque);
		$('table.integrar_produtos').append(template_produto);
	}
	function adicionar_produto_pai(p) {
		var template_produto_pai = '\
				<tr class="produto-pai">\
					<td><h5>:NOME: </h5></td>\
					<td></td>\
					<td></td>\
					<td>\
					<a href="#" data-paiid=":PRODUTOPAIID:" class="remover_produto produto_pai pull-right" ><i class="icon-trash"></i></a>\
					</td>\
				</tr>';
		var nome = p.nome;
		var template_pai = template_produto_pai.replace(":NOME:", nome);
		template_pai = template_pai.replace(':PRODUTOPAIID:', p.id);
		$('table.integrar_produtos').append(template_pai);
	}
	
	function adicionar_produto_filho(dados, pai) {
		var template_produto_filho = '\
				<tr class="produto_filho_de_:PRODUTOPAIID:">\
					<td>\
						:NOME:\
						<div class="variacoes">:GRADES:</div>\
					</td>\
					<td>R$ :PRECO:<input class="produto_integrar" type="hidden" value=":PRODUTOID:" name="produto_id_:PRODUTOID:" /></td>\
					<td>\
						<input value=":QUANTIDADE:" type="text" name="produto_quantidade_:PRODUTOID:" class="input-price input-qtd" />\
					</td>\
					<td>\
						<div class="input-prepend">\
							<span class="add-on">R$</span>\
							<input value=":PRECO:" type="text" name="produto_preco_:PRODUTOID:" class="input-price" />\
						</div>\
						<a href="#" class="remover_produto produto_filho pull-right" ><i class="icon-trash"></i></a>\
					</td>\
				</tr>';
	
			template_produto_filho = template_produto_filho.replace(/:PRECO:/g, formatar_decimal_br(dados.venda));
			template_produto_filho = template_produto_filho.replace(/:PRODUTOID:/g, dados.id);
			template_produto_filho = template_produto_filho.replace(/:NOME:/g, formatar_grades(dados.grade));
			template_produto_filho = template_produto_filho.replace(/:QUANTIDADE:/g, dados.estoque);
			template_produto_filho = template_produto_filho.replace(/:PRODUTOPAIID:/g, pai.id);
			var grades = $('.grades').html().replace(/:PRODUTOID:/g, dados.id);
			grades = grades.replace(/:PRODUTOIDPAI:/g, pai.id);
			template_produto_filho = template_produto_filho.replace(':GRADES:', grades);
	
			$('table.integrar_produtos').append(template_produto_filho);
	}
	
	$(document).ready(function(){
		$('.produtos-resultado').on('click', '.remover_produto', function(event) {
			event.preventDefault();
			var msg = 'Tem certeza que deseja remover o produto?';
			if ($(this).hasClass('produto_pai')) {
				var pai_id = $(this).data('paiid');
				if (confirm(msg)) {
					$(this).parents('tr').remove();
				};
				$(this).parents('tr').remove()
				$('.produto_filho_de_'+pai_id).remove();
			} else {
				if (confirm(msg)) {
					$(this).parents('tr').remove();
				};
			}
	
	
		});
		$('.lista-categorias-loja').on('click', '.remover_categoria', function(event) {
			event.preventDefault();
			var msg = 'Tem certeza que deseja remover a categoria?';
			if (confirm(msg)) {
				$(this).parents('li').remove();
			}
	
	
	
		});
		$('#template').change(function(event){
			var descricao = $(this).find('option:selected').data('descricao');
			var url = $(this).find('option:selected').data('url');
	
			//atualizando o link do visualizar.
			$('#visualizar_tema').attr('href', url);
			$('#template_descricao').html(descricao);
			$('#tutorial').click(function(event){
				$('.tutorial').stop().slideToggle('normal');
			});
		}).change();
		$('.configuracoes_avancadas').click(function(event) {
			$('tr.avancado').slideToggle('slow');
		});
	
		$('[name=anunciar_por]').change(function () {
			$('[class*=por] .inner').slideUp();
			$('[class*=por] input[type=text]').val('').attr('disabled', 'disabled');
			$(this).parent().parent().find('.inner').slideDown();
			$(this).parent().parent().find('input[type=text]').removeAttr('disabled');
		});
		$('#integrar_produtos').submit(function(event) {
			var anunciar_por = $('[name=anunciar_por]:checked');
			var categoria_id = $('#id_categoria').val();
	
			var produto_integrar = $('.produto_integrar');
			var categoria_integrar = $('.categoria_integrar');
	
	
			if (categoria_id == '') {
				alert('Por favor escolha uma categoria no Mercadolivre');
				return false;
			}
	
			if (anunciar_por.length <= 0) {
				alert('Por favor selecione um tipo de anúncio');
				return false;
			}
			if (anunciar_por.val() == 'produto' && produto_integrar.length == 0) {
				alert('Por favor adicione um produto para integração');
				return false;
			}
	
			if (anunciar_por.val() == 'categoria' && categoria_integrar.length == 0) {
				alert('Por favor adicione uma categoria para integração');
				return false;
			}
	
			return true;
		});
		// Pesquisar produtos
		$('#buscar_produto').typeahead({
			source: function (query, process) {
				return $.getJSON(
					'/admin/catalogo/produto/buscar.json',
					{ q: query },
					function (data) {
						var newData = [];
						$.each(data, function() {
							template = '\
							<div>\
								<div class="nome_produto">::PRODUTO::</div> \
								<span class="codigo_produto hide">::CODIGO::</span> \
								<small>::SKU::</small>\
							</div>'
							template = template.replace('::PRODUTO::', this.nome);
							template = template.replace('::CODIGO::', this.id);
							template = template.replace('::SKU::', this.sku);
							newData.push(template);
						});
						return process(newData);
				});
			},
			updater: function(item) {
				var produto_id = $(item).find('.codigo_produto').html();
				var nome_produto = $(item).find('.nome_produto').html();
				$.getJSON(
					'/admin/catalogo/produto/detalhar.json',
					{produto_id: produto_id},
					function (data) {
						$('#salvar-produto').show();
						$('#salvar-produto').data('json', data);
					}
				);
				return nome_produto;
	
			},
			highlighter: function(item) {
				return item;
			}
		});
		$('a.adicionar_categoria').click(function(event) {
			event.preventDefault();
			var categoria_id = $('select.adicionar_categoria').val();
			var template_categoria = '\
						<li class="control-list-price">\
							<span class="c-left">:ARVORE: (:TOTALPRODUTOSNORMAL:) :PRODUTOATRIBUTOS:</span>\
							<div class="pull-right">\
								<label for="">Aplicar desconto no MercadoLivre de</label>\
								<a href="#" class="remover_categoria" ><i class="icon-trash"></i></a>\
								<div class="input-append">\
									<input type="text" name="categoria_desconto_:CATEGORIAID:" class="input-price categoria_integrar" />\
									<span class="add-on">%</span>\
								</div>\
							</div>\
						</li>';
	
			$.getJSON(
				'/admin/catalogo/categoria/detalhar.json',
				{categoria_id: categoria_id },
				function (data) {
					template_categoria = template_categoria.replace(/:ARVORE:/g, data.arvore);
					template_categoria = template_categoria.replace(/:TOTALPRODUTOSNORMAL:/g, data.total_produtos_normal);
					template_categoria = template_categoria.replace(/:CATEGORIAID:/g, data.id);
					if (data.total_produtos_normal > 0) {
						if(data.total_produtos_normal > 1) {
							var mensagem = '<small>serão integrados ' + data.total_produtos_normal + ' produtos de ' + data.total_produtos + '.</small>';
						}else {
							var mensagem = '<small>sera integrado ' + data.total_produtos_normal + ' produto de ' + data.total_produtos + '.</small>';
						}
					template_categoria = template_categoria.replace(/:PRODUTOATRIBUTOS:/g, mensagem);
					$('.lista-categorias-loja').append(template_categoria);
					}else {
						alert('A categoria não possui produtos');
					}
	
				})
	
		});
		function formatar_grades(grades) {
			saida = '';
			var grade = ' <small><strong>:GRADE:</strong>: :VARIACAO:</small><br />';
			$.each(grades, function(k, v) {
				var grade_variacao = grade.replace(':GRADE:', k);
				grade_variacao = grade_variacao.replace(':VARIACAO:', v);
				saida = saida + grade_variacao;
			});
			return saida;
		}
	
	
		$('#salvar-produto').click(function(event) {
			event.preventDefault();
			var p = $(this).data('json');
			if (Object.keys(p.filhos).length > 0) {
				// if (!atributos) {
				//     alert('Categoria não suporta produtos com atributos.');
				// }
				// console.log('Filho....');
				var nome = p.nome;
				if(atributos) {
					adicionar_produto_pai(p);
					$.each(p.filhos, function(filho, dados) {
						// console.log(dados);
						adicionar_produto_filho(dados, p);
					});
				}else {
					if (p.preco_varia) {
						$.each(p.filhos, function(filho, dados) {
							dados.nome = formatar_nome_produto(p, dados.grade)
							adicionar_produto(dados);
						});
					} else {
						adicionar_produto(p);
					}
				}
	
				// $.each(p.filhos, function(filho, dados) {
				// });
			} else {
				if (atributos) {
					alert('A categoria necessita de atributos e o produto é do tipo sem atributos')
					return false;
				}
	
				adicionar_produto(p);
			}
			// limpando os dados!
			$('#buscar_produto').val('');
			$(this).data('json', '')
	
			$('.integrar_produtos .input-qtd').on('input', function() {
				if($(this).val() == 0){
					$(this).addClass('error-input');
				} else {
					$(this).removeClass('error-input');
					$(this).val($(this).val().replace(/[^0-9]/g, ''));
				}
			}).trigger('input');
			if ($(this).val().length == 0) {
				$('#salvar-produto').hide();
			}
		});
		$('#buscar_produto').keyup(function () {
			if ($(this).val().length == 0) {
				$('#salvar-produto').hide();
			}
		});
	});
</script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><span>Detalhes produto</span></li>
	</ul>
</div>
<div class="box mercadolivre mercadolivre-produtos-detalhes">
	<div class="box-header">
		<h3>Integração de produtos</h3>
	</div>
	<form id="integrar_produtos" class="form-horizontal" method="POST">
		<div class="box-content">
			<div class="alert">
				<h4>Atenção</h4>
				<p>
					Produtos com estoque zerado ou indisponível não serão integrados com o
					Mercadolivre.
				</p>
			</div>
			<p>
				Para facilitar a integração dos produtos entre sua loja e o MercadoLivre, este procedimento precisa ser feito em LOTE por categoria de produto,
				possibilitando um cadastro rápido e eficiente.
			</p>
			<hr/>
			<h2>1 - Defina configurações para anúncio no MercadoLivre</h2>
			<br />
			<div class="control-group">
				<label class="control-label">
				Tipo de produto
				</label>
				<div class="controls">
					<select class="input-medium" id="id_tipo_produto" name="tipo_produto">
						<option value="new">Novo</option>
						<option value="used">Usado</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
				Tipo de anúncio
				</label>
				<div class="controls">
					<select class="input-medium" id="id_tipo_anuncio" name="tipo_anuncio">
						<option value="bronze">Bronze</option>
						<option value="silver">Prata</option>
						<option value="gold">Ouro</option>
						<option value="gold_premium">Diamante</option>
					</select>
					<a href="#modal-tabelaML" title="Dúvida?" data-toggle="modal"><i class="icon-info-sign"></i></a>
				</div>
			</div>
			<hr />
			<h2>2 - Categoria no MercadoLivre</h2>
			<p class="muted subtitle">Selecione abaixo em qual categoria do MercadoLivre seus produtos devem ser integrados.</p>
			<ul class="breadcrumb breadcrumb-categorias-mercadolivre hide"></ul>
			<div class="text-align-center">
				<a data-target_ml="id_categoria" href="#modal-mercadolivre" class="btn btn-primary" data-toggle="modal">Escolher categoria no MercadoLivre</a>
				<input id="id_categoria" name="categoria" type="hidden" />
			</div>
			<br />
			<div class="well atributos_categoria alert-info hide">
				<h4>
					Atributos
				</h4>
				<p class="required hide">
					A categoria escolhida necessita de atributos para os produtos
				</p>
				<p class="not-required hide">
					A categoria escolhida oferece a possibilidade de atributos
					para os produtos
				</p>
				<div class="usar_atributos">
					<strong>
					Somente a exportação por produtos é suportada.
					</strong>
					<ul class="atributos">
					</ul>
				</div>
			</div>
			<hr/>
			<h2>3 - Defina os produtos da loja que serão anunciados no MercadoLivre</h2>
			<div class="por-loja integracao-container">
				<div class="control-list-price">
					<label class="radio pull-left">
					<input type="radio" name="anunciar_por" value="todaloja" class="disabilitar-integracao integracao" disabled="disabled" /> Anunciar toda a sua loja no MercadoLivre
					</label>
					<div class="pull-right">
						<label for="desconto_mercadolivre">Aplicar desconto no MercadoLivre de</label>
						<div class="input-append">
							<input class="input-mini" id="id_desconto_mercadolivre" max="100" min="-100" name="desconto_mercadolivre" type="number" />
							<span class="add-on">%</span>
						</div>
					</div>
				</div>
				<hr/>
			</div>
			<div class="por-categoria integracao-container">
				<div class="control-group">
					<label class="radio"><input type="radio" name="anunciar_por" value="categoria" class="ativar-categoria disabilitar-integracao integracao" disabled="disabled" /> Anunciar categoria da loja</label>
					<div class="inner hide">
						<ul class="lista-categorias-loja">
						</ul>
						<div class="categoria-acao">
							<select class="span6 adicionar_categoria">
								<option value="166128">
									Sapato
								</option>
								<option value="217183">
									- Tenis
								</option>
								<option value="166131">
									- Preto
								</option>
								<option value="217184">
									Cintos
								</option>
								<option value="217185">
									- Couro
								</option>
							</select>
							<a href="#" class="btn btn-small adicionar_categoria">Adicionar categoria</a>
						</div>
					</div>
				</div>
				<hr/>
			</div>
			<div class="por-produto integracao-container">
				<label class="radio"><input type="radio" name="anunciar_por" value="produto" class="ativar-produto" disabled="disabled"/> Anunciar por produto</label>
				<div class="inner hide">
					<div class="control-group">
						<input type="text" name="buscar_produto" id="buscar_produto" class="span5" data-provide="typeahead" autocomplete="off" placeholder="Digite o código do produto ou nome" />
						<a href="" title="" id="salvar-produto" class="hide btn btn-success btn-small"><i class="icon-plus icon-white"></i></a>
					</div>
					<div class="produtos-resultado">
						<table class="table table-striped integrar_produtos">
							<thead>
								<th>Produto</th>
								<th style="min-width: 65px;">Preço</th>
								<th style="min-width: 190px;">Quantidade no Mercadolivre</th>
								<th style="min-width: 150px;">Preço no Mercadolivre</th>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="form-actions">
			<input type="submit" value="Integrar produtos" class="btn btn-primary" />
			<a href="<?php echo VIALOJA_PAINEL ?>/recurso/mercadolivre" title="" class="btn">Cancelar</a>
		</div>
		<input type='hidden' name='csrfmiddlewaretoken' value='3ZBO88GAgG5TIPlw3PQrPuWte7csLAv3' />
	</form>
</div>
<div class="modal hide fade" id="modal-tabelaML" style="width: 665px;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Tabela anúncios MercadoLivre</h3>
	</div>
	<div class="modal-body">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Anúncio</th>
					<th>Exposição</th>
					<th>Estoque máximo</th>
					<th>Duração</th>
					<th>Tarifa por anúncio</th>
					<th>Tarifa por venda</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Bronze</td>
					<td>Baixa</td>
					<td>999</td>
					<td>60 dias</td>
					<td>0%</td>
					<td>10%</td>
				</tr>
				<tr>
					<td>Prata</td>
					<td>Média</td>
					<td>999</td>
					<td>60 dias</td>
					<td>1%</td>
					<td>6.5%</td>
				</tr>
				<tr>
					<td>Ouro</td>
					<td>Alta</td>
					<td>999</td>
					<td>60 dias</td>
					<td>3%</td>
					<td>6.5%</td>
				</tr>
				<tr>
					<td>Diamante</td>
					<td>Máxima</td>
					<td>999</td>
					<td>60 dias</td>
					<td>5%</td>
					<td>6.5%</td>
				</tr>
			</tbody>
		</table>
		<p>Veja tabela completada no MercadoLivre <a href="http://www.mercadolivre.com.br/seguro_tarifas.html" target="_blank">clicando aqui</a>.</p>
	</div>
</div>
<div id='modal-mercadolivre' class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Categoria MercadoLivre</h3>
	</div>
	<div class="modal-body">
		<ul class="breadcrumb breadcrumb-categorias-mercadolivre hide"></ul>
		<ul class='categorias nav nav-tabs nav-stacked'></ul>
		<div class='informacoes hide'>
			<h1 class='titulo-categoria' style="margin: -20px 0 15px;">Titulo</h1>
		</div>
	</div>
	<div class="modal-footer">
		<a id="finalizar" data-url="/admin/recurso/mercadolivre/categoria/atributos" href="#" data-dismiss="modal" class="btn btn-primary btn-big disabled">Escolher Categoria</a>
	</div>
</div>
<div class="grades hide"></div>
