<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/listar"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
		<li><span>Criar produto</span></li>
	</ul>
</div>
<form class="form-produto" enctype="multipart/form-data"  action="<?php echo Router::url(); ?>" method="post">
	<div class="box add-main">
		<div class="box-header">
			<h3>
				Informações principais
				<a href="'http://suporte'. env('HTTP_BASE'); ?>" title="Artigo Produto com variações" target="_blank" class="link_ext produto-atributo">
				<i class="icon-share"></i>
				</a>
			</h3>
		</div>
		<div class="box-inner">
			<div class="box-content wrapper-dropzone">
				<div id="dropzone">
					<h1 class="muted">
						<strong>Solte o arquivo aqui para fazer upload...</strong>
					</h1>
					<div class="image" ></div>
				</div>
				<div class="image-widget sortable">
					<div class="image empty image-produto">
						<i class="icon-custom icon-image icon-big"></i>
					</div>
					<div class="image empty">
						<i class="icon-custom icon-image icon-big"></i>
					</div>
					<div class="image empty">
						<i class="icon-custom icon-image icon-big"></i>
					</div>
					<div class="image empty">
						<i class="icon-custom icon-image icon-big"></i>
					</div>
				</div>

				<div class="upload-wrapper hide" style="margin: 10px 0; width: 290px;">
                    <span class="upload mensagem" style="font-size: 11px; margin-bottom: 5px; display: block;">Upload das imagens em progresso...</span>
                    <div class="progress" id="uploadProgressbar">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                            0%
                        </div>
                    </div>
                </div>

				<div class="clear"></div>
				<div class="image-upload-widget" style="background: #FAFAFA; border: 1px solid #EEE; border-radius: 3px; width: 269px; padding: 10px 10px 3px 10px;">
					<small style="font-size: 13px; display: block; padding-bottom: 5px;">
					Você pode adicionar até <strong>10</strong> imagens <br />com tamanho máximo de <strong>1MB</strong> cada
					</small>

					<small style="font-size: 11px; color: #C9280C;  display: block; padding-bottom: 5px;">
						Tamanho ideal para imagens é de <strong>800 x 800 pixels.</strong>
					</small>

                    <small style="font-size: 12px; display: block; padding-bottom: 5px;">

                        <input id="id_renomear_imagem" name="renomear_imagem" type="checkbox" value="True" style=" margin-top:-2px;" />
						<strong>Renomear</strong> imagens pelo nome do produto?

					</small>					

					<input id='uploadImagemProduto'  type="file" name="files[]" data-url="/admin/catalogo/produto/criar/imagem/" multiple="multiple" accept="image/*" />
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="box-inner">
			<div class="box-content">
				<div class="alert" style="padding: 15px 15px 10px; color:black;">
					<div class="control-group pull-right" style="margin-bottom: 0;">
						<label class="control-label" style="float: left; width: 120px; line-height: 30px;">Produto ativado?</label>
						<div class="controls" style="float: left;">
							<select class="input-small" id="id_ativo" name="ativo">
								<option value="True">Sim</option>
								<option value="False">Não</option>
							</select>
						</div>
					</div>
					<div class="control-group" style="margin-bottom: 0;">
						<label class="control-label" style="float: left; width: 150px; line-height: 30px;">Produto com variação?</label>
						<div class="controls">
							<select class="input-small" id="id_tipo" name="tipo">
								<option value="normal">Não</option>
								<option value="atributo">Sim</option>
							</select>
						</div>
					</div>
					<div class="control-group pull-right" style="margin-bottom: 0;">
						<div class="controls">
							<select class="input-large" id="id_usado" name="usado">
								<option value="False">Produto Novo</option>
								<option value="True">Produto Usado</option>
							</select>
						</div>
					</div>
					<div class="control-group"i style="margin-bottom: -5px;">
						<label class="control-label" style="float: left; width: 150px; line-height: 30px;">Produto em destaque?</label>
						<div class="controls">
							<select class="input-small" id="id_destaque" name="destaque">
								<option value="True">Sim</option>
								<option value="False" selected="selected">Não</option>
							</select>
						</div>
					</div>
				</div>
				<div class="control-group highlight percent label-produto-titulo">
					<div>
						<label class="control-label pull-left" for="id_nome">
						Nome do produto
						</label>
						<p class="pull-right contador" id="tituloCont"></p>
					</div>
				</div>
				<div class="control-group highlight percent ">
					<div class="controls">
						<input class="big" id="id_nome" maxlength="255" name="nome" type="text" />
					</div>
					<div class="control-seamless-editable">
						<span class="control">http://<?php echo $url_shop; ?>/p/<span class="url-slug urlify"></span><span class="url-barra">/<?php echo $proximo_id; ?>/</span></span>
						<i class="icon-custom icon-pencil" id="url-edit" rel="tooltip" title="Edita o link do produto na loja."></i>
						<i class="icon-remove" id="url-remove" rel="tooltip" title="Cancela as alterações feitas no link do produto."></i>
						<input id="id_apelido" maxlength="255" name="apelido" type="text" />
					</div>
				</div>
				<div class="control-group percent hide" id="control-group-url">
					<div class="controls form-inline">
						<table class="table table-url">
							<tr>
								<td class="table-url-label" nowrap="nowrap">Nova URL:</td>
								<td class="table-url-path" nowrap="nowrap" width="100%"><input id="id_url" maxlength="255" name="url" type="text" /></td>
								<td class="table-url-validate-button" nowrap="nowrap"><button class="btn" type="button" id="url-validate" data-loading-text="Validando...">Validar</button></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="flex-control">
				
					<div class="flex-control ">
						<?php
		                $error = null;
		                if (isset($error_sku)) {
		                    $error='error';
		                }
		                ?>
						<div class="control-group percent <?php echo $error; ?>">
							<label class="control-label" for="id_sku">Código do produto (SKU)</label>
							<div class="controls form-inline">
								<div class="" style="width: 35%; display: inline-block; margin-bottom: 10px;">
									<input style="padding-left:10px; min-width:240px;" id="id_sku" required maxlength="255" name="sku" type="text" />
								</div>
								&nbsp;
								<a class="btn" style="margin-left:80px;" href="#" id="gerar-sku" title="Gerar o sku automaticamente."><i class="icon-refresh"></i> Gerar código</a>
							</div>
							<p class="help-block">Este é o código de identificação única do produto.</p>
							<?php
	                        if (isset($error_sku)) {
	                            echo '<p class="help-block">Este campo é obrigatório.</p>' . PHP_EOL;
	                        }
	                        ?>
						</div>

						<div class="control-group ">
		                    <label class="control-label">NCM</label>
		                    <div class="" style="margin-bottom: 5px;">
		                        <input class="span2" id="id_ncm" maxlength="10" name="ncm" type="text" />
		                    </div>
		                </div>
				
					</div>
				
				</div>
				<div class="price-box produto-atributo hide">
					<hr/>
					<div class="alert alert-info" style="margin-bottom: 0">
						<i class="icon-info-sign"></i> O preço do produto com variações é definido em cada variação adicionada.
					</div>
				</div>
				<div class="price-box produto-normal">
					<hr/>
					<div class="control-group">
                        <div class="controls ">
                            <label class="checkbox preco-sob-consulta" for="id_sob_consulta">
                            <input  id="id_sob_consulta" name="sob_consulta" type="checkbox" value="True" />
                            Preço sob consulta
                            </label>
                        </div>
                    </div>
					<div class="price-controls flex-control three">
						<div class="muted preco-custo control-group ">
							<label class="control-label" for="id_custo">Preço de custo</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on">R$</span><input class="preco" id="id_custo" name="custo" type="text" />
								</div>
							</div>
						</div>
						<div class="preco-venda control-group ">
							<label class="control-label" for="id_cheio">Preço de venda</label>
							<div class="controls">
								<div class="input-prepend main-color">
									<span class="add-on">R$</span><input class="preco" id="id_cheio" name="cheio" type="text" />
								</div>
							</div>
						</div>
						<div class="preco-promocional control-group last ">
							<label class="control-label" for="id_promocional">Preço promocional</label>
							<div class="controls">
								<div class="input-prepend secundary-color">
									<span class="add-on">R$</span><input class="preco" id="id_promocional" name="promocional" type="text" />
								</div>
							</div>
						</div>
					</div>
					<div class="price-show">
						<!--<label class="pull-left">Preço na loja</label>-->
						<div class="box-price-show pull-right">
							<div class="price-only hide">R$ <span></span></div>
							<span class="price-full strike">de R$ <span></span></span>
							<span class="price-promotional">por R$ <span></span></span>
							<div class="alert-venda-empty" style="text-align: center; font-weight: bold;">Preencha o preço de venda do produto</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="produto-atributo box box-stock">
		<div class="box-header">
			<h3>Variações do produto</h3>
		</div>
		<div class="box-content form-horizontal">
			<div class="alert alert-info">
				<p>Escolha abaixo quais são os tipos de variação que seu produto pode ter. Adicione todas as variações de uma única vez, por exemplo, se este produto é uma camiseta que varia tamanho e cor, selecione abaixo "Produto com uma cor" e "Tamanho de camisa/camiseta", depois clique em "Continuar cadastro".</p>
			</div>
			<div class="control-group">
				<ul id="id_grade">
					<?php
					foreach ($res_grade as $key => $grade) {
						echo sprintf('<li>
							<label for="id_grade_%d">
							<input id="id_grade_%d" name="grade[]" type="checkbox" value="%d" /> %s</label>
						</li>',
						$key,
						$key,
						$grade['ShopGrade']['id_grade'],
						$grade['ShopGrade']['nome']) . PHP_EOL;
					}
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box-header">
			<h3>Informações gerais</h3>
		</div>
		<div class="box-content">
			<div class="row-fluid marca-categoria">
				<div class="span6 alpha">
					<div class="control-group ">
						<label class="control-label" for="buscaMarca">Marca</label>
						<div class="row-fluid">
							<div class="span6">
								<div class="input-append">
									<input type="text" name="busca_marca" id="buscaMarca" class="input-buscar" placeholder="Fazer busca" autocomplete="off" />
									<span class="add-on"><i class="icon-search"></i></span>
								</div>
							</div>
							<div class="span6 ">
								<div class="controls">
									<select id="id_marca" name="marca">
										<?php
                                        echo '<option value="">- Vazio -</option>'. PHP_EOL;
										foreach ($res_marcas as $key => $marca) {
											echo sprintf('<option value="%d">%s</option>', 
												$marca['ShopMarca']['id_marca'], 
												$marca['ShopMarca']['nome']) . PHP_EOL;
										}
										?>
									</select>
									<div class="btn-group hide">
										<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="dropdown-label">Selecione uma marca</span></a>
										<div class="marca dropdown-menu dropdown-fixed dropdown-advanced" rel="marca">
											<div class="dropdown-advanced-select-area">
												<ul class="dropdown-options scroll-not-propagate scrollable"></ul>
												<div class="divider"></div>
												<ul class="dropdown-action">
													<li><a href="#" class="dropdown-btn-add-new"><i class="icon-plus"></i> Criar nova marca</a></li>
													<li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/marca/listar"><i class="icon-tools icon-custom"></i> Gerenciar marcas</a></li>
												</ul>
											</div>

											<div class="dropdown-add-new hide">
												<label>Nome</label>
												<input type="text" class="dropdown-input-add-new-name" value="" />
												<div class="pull-right">
													<button title="Salvar" class="btn btn-small btn-primary dropdown-btn-submit"><i class="icon-ok icon-white"></i> Salvar</button>
													ou <span class="dropdown-btn-cancel" title="Cancelar">Cancelar</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- row-fluid -->
					</div>
				</div>
				<div class="span6 omega" id="selecao-categoria">
					<div class="control-group ">
						<label class="control-label" for="buscaCategoria">Categoria</label>
						<div class="row-fluid">
							<div class="span6">
								<div class="input-append">
									<input type="text" name="busca_categoria" id="buscaCategoria" class="input-buscar" placeholder="Fazer busca" autocomplete="off" />
									<span class="add-on"><i class="icon-search"></i></span>
								</div>
							</div>
							<div class="span6 ">
								<div class="controls">
									<div class="btn-group">
										<a href="#" id="abrir-modal-categorias" class="btn dropdown-toggle" data-toggle="dropdown"><span class="dropdown-label">Selecione uma categoria</span></a>
									</div>
								</div>
							</div>
						</div>
						<!-- row-fluid -->
					</div>
				</div>
			</div>
			<!-- row-fluid -->
			<hr class="clear" />
			<div class="control-group ">
				<label class="control-label id_url_video_youtube" for="id_url_video_youtube">URL do vídeo do produto no Youtube</label>
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-custom icon-video" style="margin-top: 2px;"></i></span>
						<input class="input-xxlarge" id="id_url_video_youtube" name="url_video_youtube" type="text" />
						<a href="#" class="btn btn-primary hide ver_video_youtube pull-right" target="_blank">
						<i class="icon-white icon-eye-open"></i>
						Ver
						</a>
					</div>
				</div>
			</div>
			<hr/>
			<div class="control-group ">
				<label class="control-label id_descricao_completa">Informações do Produto ( Descrição )</label>
				<div class="controls">
					<textarea class="ckeditor" cols="40" id="id_descricao_completa" name="descricao_completa" rows="10"></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-seo" style="margin: 30px 0;">
		<div class="box-header accordion-toggle" data-toggle="collapse" data-target="#area-seo">
			<h3>Otimização para buscadores (SEO)</h3>
			<a href="https://static.googleusercontent.com/external_content/untrusted_dlcp/www.google.com/pt-BR//intl/pt-BR/webmasters/docs/guia-otimizacao-para-mecanismos-de-pesquisa-pt-br.pdf" target="_blank" class="link_ext label" data-toggle="tooltip" title="Guia do Google para Iniciantes"><i class="icon-question-sign icon-white"></i> Guia</a>
			<div class="pull-right arrow-open"><i class="icon-chevron-down"></i></div>
		</div>
		<div class="box-content collapse" id="area-seo">
			<div class="accordion-inner form-horizontal">
				<div class="control-group percent ">
					<label class="control-label" for="id_title">
					Tag Title
					</label>
					<div class="controls">
						<input id="id_title" maxlength="255" name="title" type="text" />
					</div>
					<p class="pull-right contador bot" id="titleCont"></p>
				</div>
				<div class="control-group percent ">
					<label class="control-label" for="id_description">
					Meta Tag Description
					</label>
					<div class="controls">
						<textarea cols="40" id="id_description" name="description" rows="2"></textarea>
					</div>
					<p class="pull-right contador bot" id="descrCont"></p>
				</div>
			</div>
		</div>
	</div>

	<!-- BEGIN Correios-->
	<div class="box produto-normal">
		<div class="box-header">
			<h3>Peso e dimensões <small style="margin-left: 10px;">Os valores devem ser preenchidos considerando o pacote que será enviado, ou seja, embalagem com produto</small></h3>
		</div>
		<div class="box-content">
			<div class="box-dimension flex-control four">
				<div class="control-group box-weight  warning">
					<label class="control-label" for="id_peso">Peso <i class="icon-custom icon-weight icon-big"></i></label>
					<div class="controls">
						<div class="input-append">
							<input class="peso" id="id_peso" name="peso" type="text" /><span class="add-on">Kg</span>
						</div>
					</div>
				</div>
				<div class="control-group box-height warning">
					<label class="control-label" for="id_altura">Altura <i class="icon-custom icon-height"></i></label>
					<div class="controls">
						<div class="input-append">
							<input class="medida" id="id_altura" name="altura" type="text" /><span class="add-on">cm</span>
						</div>
					</div>
				</div>
				<div class="control-group box-width  warning">
					<label class="control-label" for="id_largura">Largura <i class="icon-custom icon-width"></i></label>
					<div class="controls">
						<div class="input-append">
							<input class="medida" id="id_largura" name="largura" type="text" /><span class="add-on">cm</span>
						</div>
					</div>
				</div>
				<div class="control-group box-depth last  warning">
					<label class="control-label" for="id_comprimento">Comprimento <i class="icon-custom icon-depth"></i></label>
					<div class="controls">
						<div class="input-append">
							<input class="medida" id="id_comprimento" name="comprimento" type="text" /><span class="add-on">cm</span>
						</div>
					</div>
				</div>
			</div>
			<div class="alert alert-info aviso_preenchimento" style="margin: 10px 0 0;">
				<i class="icon-warning-sign" style="margin: 2px 3px 0 0;"></i> Para o cálculo correto do envio todos os valores devem ser preenchidos.
			</div>
		</div>
	</div>

	<!-- END Peso e dimensões -->
	<!-- BEGIN Estoque -->

	<div class="box box-stock">
		<div class="box-header">
			<h3>Estoque</h3>
		</div>
		<div class="box-content form-horizontal">
			<div class="produto-normal">
				<p>
					<label class="control-label" for="id_gerenciado" style="width: 230px; padding-right: 10px;">Gerenciar o estoque deste produto?</label>
					<select class="input-small" id="id_gerenciado" name="gerenciado">
						<option value="True">Sim</option>
						<option value="False" selected="selected">Não</option>
					</select>
				</p>
				<div id="bloco-estoque-nao-gerenciado" class="">
					<p>
						<label class="control-label" for="id_situacao_em_estoque" style="width: 230px; padding-right: 10px;">Qual a disponibilidade dos produtos?</label>
						<select class="span4" id="id_situacao_em_estoque" name="situacao_em_estoque">

							<?php
							$array_value = array(0,1,2,3,4,5,6,7,8,9,10,15,20,25,30,45,60,90);

							foreach ($array_value  as $key => $value) {

								switch ($value) {
									case 0:
										# code...
										echo '<option value="0" selected="selected">Disponibilidade imediata</option>'. PHP_EOL;
										break;
									
									case 1:
										# code...
										echo '<option value="1">Disponibilidade para 1 dia útil</option>' . PHP_EOL;
										break;
									
									default:
										printf('<option value="%d">Disponibilidade para %d dias úteis</option>', $value, $value) . PHP_EOL;
										break;
								}
			
							}
							?>
						
						</select>
					</p>
				</div>
				<div id="bloco-estoque-gerenciado" class="hide">
					<p>
						<label class="control-label" for="id_quantidade" style="width: 230px; padding-right: 10px;">Quantidade de produtos em estoque</label>
						<input class="span2" id="id_quantidade" name="quantidade" type="text" /> com
						<select class="span4" id="id_situacao_em_estoque" name="situacao_em_estoque">
							<?php

							foreach ($array_value  as $key => $value) {

								switch ($value) {
									case 0:
										# code...
										echo '<option value="0" selected="selected">Disponibilidade imediata</option>'. PHP_EOL;
										break;
									
									case 1:
										# code...
										echo '<option value="1">Disponibilidade para 1 dia útil</option>' . PHP_EOL;
										break;
									
									default:
										printf('<option value="%d">Disponibilidade para %d dias úteis</option>', $value, $value) . PHP_EOL;
										break;
								}
			
							}
							?>
						</select>
					</p>
					<p>
						<label class="control-label" for="id_situacao_sem_estoque" style="width: 230px; padding-right: 10px;">Quando o produto acabar em estoque</label>
						<select class="span5" id="id_situacao_sem_estoque" name="situacao_sem_estoque">
							<option value="-1">Tornar o produto indisponível</option>
			
							<?php

							foreach ($array_value  as $key => $value) {

								switch ($value) {
									case '-1':
										# code...
										echo '<option value="-1" selected="selected">Tornar o produto indisponível</option>'. PHP_EOL;
										break;
									
									case 0:
										# code...
										echo '<option value="0" selected="selected">Continuar vendendo normalmente</option>'. PHP_EOL;
										break;
									
									case 1:
										# code...
										echo '<option value="1">Mudar a disponibilidade para 1 dia útil</option>' . PHP_EOL;
										break;
									
									default:
										printf('<option value="%d">Mudar a disponibilidade para %d dias úteis</option>', $value, $value) . PHP_EOL;
										break;
								}
			
							}
							?>
						</select>
					</p>
					<hr/>
					<p class="text-align-center">
						<strong id="estoque-itens-reservados">0</strong>
						unidades deste produto estão reservados, restando
						<strong id="estoque-itens-disponiveis">0</strong>
						para venda.
					</p>
				</div>
			</div>
			<div class="produto-atributo hide">
				<div class="alert alert-info" style="margin-bottom: 0">
					<i class="icon-info-sign"></i> O estoque do produto com variações é definido em cada opção do produto.
				</div>
			</div>
		</div>
	</div>

	<!-- END estoque -->

	<div class="pull-right">
		<button type="submit" class="btn btn-large btn-primary btn-save"><i class="icon-ok icon-white"></i> Salvar alterações</button>
	</div>
	<div id="saveButton">
		<div class="container">
			<div class="button-container">
				<button type="submit" class="btn btn-save btn-primary"><i class="icon-ok icon-white"></i> Criar</button>
			</div>
		</div>
	</div>
	<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
	<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
</form>
<div id='modal-arquivo-invalido' class="modal hide">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Tipo de Arquivo inválido</h3>
	</div>
	<div class="modal-body">
		<p>
			Tipos de Arquivos aceitos:
		</p>
		<ul class="nav nav-pills nav-stacked">
			<li>
				<i class="icon-picture"></i>
				JPG
			</li>
			<li>
				<i class="icon-picture"></i>
				PNG
			</li>
			<li>
				<i class="icon-picture"></i>
				GIF
			</li>
			<li>
				<hr />
				<p>(tamanho máximo: <strong>1MB</strong>)</p>
			</li>
		</ul>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true">Ok</button>
	</div>
</div>
<div id="modal-categorias" class="modal hide acao-criar">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4>Categorias</h4>
	</div>
	<div class="modal-body hide" id="body-criar-categoria">
		<div class="control-group">
			<label class="control-label"><strong>Nome da categoria</strong></label>
			<div class="controls">
				<input type="text" name="nome" value="" class="span6" />
			</div>
		</div>
		<p class="texto-categoria-principal">Esta categoria será uma <strong>categoria principal</strong>. <a href="#" id="selecionar-categoria-pai">Mudar para categoria filha</a>.</p>
		<div class="control-group hide" id="controle-categoria-pai">
			<label class="control-label"><strong>Selecione a categoria pai</strong></label>
			<div class="controls">
				<select class="input-xxlarge" id="id_categorias" name="categorias">
					<?php
					echo '<option value="">-  Vazio -</option>'. PHP_EOL;
					echo $option;						
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="modal-body" id="body-selecionar-categoria">
		<p>
			Selecione a categoria que este produto pertence.
		</p>
		<div class="control-group">
			<label class="control-label" for="id_categorias"><strong>Categoria principal</strong></label>
			<div class="controls">
				<select class="input-xxlarge" id="id_categorias" name="categorias">
					<?php
					echo '<option value="">-  Vazio -</option>'. PHP_EOL;
					echo $option;						
					?>
				</select>
			</div>
			<a href="#" id="link-categorias-secundarias" class="item-closed">
			<i class="icon-chevron-right"></i> Adicionar mais categorias ao produto
			</a>
		</div>
		<div class="control-group hide" id="categorias-secundarias">
			<label class="control-label"><strong>Categorias secundárias</strong></label>
			<div class="controls">
				<ul>
					<?php
					echo $categoria_checkbox;
					?>
				</ul>
			</div>
			<p class="help-block">As categorias secundárias são categorias adicionais onde o produto também estará listado.</p>
		</div>
	</div>
	<div class="modal-footer" id="footer-selecionar-categoria">
		<button type="button" class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
		<button type="submit" class="btn btn-success" aria-hidden="true"><i class="icon-ok icon-white"></i> Salvar alterações</button>
	</div>
	<div class="modal-footer hide" id="footer-criar-categoria">
		<button type="button" class="button btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
		<button type="button" class="submit btn btn-success" aria-hidden="true"><i class="icon-ok icon-white"></i> Criar categoria</button>
	</div>
</div>
<div class="modal hide fade" id="ProdutoGradeVariacaoImagem">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Imagens</h3>
	</div>
	<div class="modal-body">
		<p>
		</p>
	</div>
	<div class="modal-footer">
		<a href="#" data-dismiss="modal" class="btn btn-primary">
		<i class="icon-ok icon-white"></i>
		Salvar alterações
		</a>
	</div>
</div>
<div class="modal hide fade" id="RemoverGrade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Remover Grade</h3>
	</div>
	<div class="modal-body">
		<p>
			Realmente deseja remover a grade <strong class='nome_grade'></strong> do produto?
		</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="button btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
		<a href="#" class="btn btn-primary">
		<i class="icon-ok icon-white"></i>
		Remover
		</a>
	</div>
</div>
<div class="modal hide fade" id="EscolherCor">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Escolher cor</h3>
	</div>
	<div class="modal-body">
	</div>
	<div class="modal-footer">
		<button type="button" class="button btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
		<a href="#" class="btn btn-primary salvar_cor">
		<i class="icon-ok icon-white"></i>
		Salvar
		</a>
	</div>
</div>
<div class="modal hide fade" id="EscolherCategoriaGlobal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Escolher tipo de produto</h3>
	</div>
	<div class="modal-body">
		<ul class="nav nav-tabs nav-stacked">
		</ul>
	</div>
	<div class="modal-footer">
		<button type="button" class="button btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
		<a href="#" class="btn btn-primary salvar_cor">
		<i class="icon-ok icon-white"></i>
		Salvar
		</a>
	</div>
</div>
<script type="text/javascript">
	var images = new Array();
	function preload() {
		for (i = 0; i < preload.arguments.length; i++) {
			images[i] = new Image();
			images[i].src = preload.arguments[i];
		}
	}
	preload("/admin/img/upload-icon.png");
	preload("/admin/img/upload-icon-muted.png");
</script>
