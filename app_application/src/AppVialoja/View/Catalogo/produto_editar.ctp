<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/listar"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
		<li><span>Editar produto</span></li>
	</ul>
</div>
<form class="form-produto" enctype="multipart/form-data" action="<?php echo Router::url(); ?>" method="post">
	<div class="form-edit-wrapper">
	</div>
	<div class="box add-main">
		<div class="box-header">
			<h3>
				Informações principais
				<a href="<?php echo 'http://suporte'. env('HTTP_BASE'); ?>" title="Artigo Produto com variações" target="_blank" class="link_ext produto-atributo">
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

				<?php
				$total_imagem = count($res_produto_imagem);
				if ($total_imagem > 0 ):
				?>

				<div class="image-widget sortable" data-url="/admin/catalogo/produto/ordenar/imagem/<?php echo $produto['ShopProduto']['id_produto']; ?>">

					<?php
					foreach ($res_produto_imagem as $key => $imagem):
					?>

					<div class="image" data-id="<?php echo $imagem['ShopProdutoImagem']['id_imagem']; ?>" rel="tooltip" title="Arraste para reordenar">

						<img src="<?php echo sprintf('%s%d/produto/%s/large/%s', CDN_UPLOAD, $this->Session->read('id_shop'), $imagem['ShopProdutoImagem']['id_produto_default'], $imagem['ShopProdutoImagem']['nome_imagem']); ?>" />

						<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/remover/imagem/<?php echo $imagem['ShopProdutoImagem']['id_produto_default']; ?>/<?php echo $imagem['ShopProdutoImagem']['id_imagem']; ?>" class="imagem-remover" title="Excluir" alt="Excluir" data-url="/admin/catalogo/produto/remover/imagem/<?php echo $imagem['ShopProdutoImagem']['id_produto_default']; ?>/<?php echo $imagem['ShopProdutoImagem']['id_imagem']; ?>">x</a>
					</div>

					<?php
					endforeach;
					?>
				</div>

				<?php
				else:
				?>

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

				<?php 
				endif;
				?>

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

					<input id='uploadImagemProduto'  type="file" name="files[]" data-url="/admin/catalogo/produto/criar/imagem/<?php echo $produto['ShopProduto']['id_produto']; ?>" multiple="multiple" accept="image/*" />
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
								<option value="True" <?php if (!(strcmp("True", $produto['ShopProduto']['ativo']))) {echo 'selected="selected"';} ?>>Sim</option>
								<option value="False" <?php if (!(strcmp("False", $produto['ShopProduto']['ativo']))) {echo 'selected="selected"';} ?>>Não</option>
							</select>
						</div>
					</div>
					<div class="control-group" style="margin-bottom: 0;">
						<label class="control-label" style="float: left; width: 150px; line-height: 30px;">Produto com variação?</label>
						<div class="controls">
							<select class="input-small" disabled="True" id="id_tipo">
								<option <?php if (!(strcmp("normal", $produto['ShopProduto']['tipo']))) {echo 'selected="selected"';} ?>>Não</option>
								<option <?php if (!(strcmp("atributo", $produto['ShopProduto']['tipo']))) {echo 'selected="selected"';} ?>>Sim</option>
							</select>
							<input type="hidden" name="tipo" value="<?php echo $produto['ShopProduto']['tipo']; ?>">
						</div>
					</div>
					<div class="control-group pull-right" style="margin-bottom: 0;">
						<div class="controls">
							<select class="input-large" id="id_usado" name="usado">
								<option value="False" <?php if (!(strcmp("False", $produto['ShopProduto']['usado']))) {echo 'selected="selected"';} ?>>Produto Novo</option>
								<option value="True" <?php if (!(strcmp("True", $produto['ShopProduto']['usado']))) {echo 'selected="selected"';} ?>>Produto Usado</option>
							</select>
						</div>
					</div>
					<div class="control-group"i style="margin-bottom: -5px;">
						<label class="control-label" style="float: left; width: 150px; line-height: 30px;">Produto em destaque?</label>
						<div class="controls">
							<select class="input-small" id="id_destaque" name="destaque">
								<option value="True" <?php if (!(strcmp("True", $produto['ShopProduto']['destaque']))) {echo 'selected="selected"';} ?>>Sim</option>
								<option value="False" <?php if (!(strcmp("False", $produto['ShopProduto']['destaque']))) {echo 'selected="selected"';} ?>>Não</option>
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
						<input class="big" id="id_nome" maxlength="255" name="nome" type="text" value="<?php echo $produto['ShopProduto']['nome']; ?>" />
					</div>
					<div class="control-seamless-editable">
						<span class="control">http://<?php echo $url_shop; ?>/p/<span class="url-slug urlify"><?php echo $produto['ShopProduto']['url']; ?></span>/<?php echo $produto['ShopProduto']['id_produto']; ?>/</span>
						<i class="icon-custom icon-pencil" id="url-edit" rel="tooltip" title="Edita o link do produto na loja."></i>
						<i class="icon-remove" id="url-remove" rel="tooltip" title="Cancela as alterações feitas no link do produto."></i>
						<input id="id_apelido" maxlength="255" name="apelido" type="text" value="<?php echo $produto['ShopProduto']['apelido']; ?>" />
					</div>
				</div>
				<div class="control-group percent hide" id="control-group-url">
					<div class="controls form-inline">
						<table class="table table-url">
							<tr>
								<td class="table-url-label" nowrap="nowrap">Nova URL:</td>
								<td class="table-url-path" nowrap="nowrap" width="100%"><input data-url-original="<?php echo $produto['ShopProduto']['url']; ?>" id="id_url" maxlength="255" name="url" placeholder="Digite a nova URL" type="text" value="<?php echo $produto['ShopProduto']['url']; ?>" /></td>
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
									<input style="padding-left:10px; min-width:240px;" id="id_sku" required maxlength="255" name="sku" type="text" value="<?php echo $produto['ShopProduto']['sku']; ?>" />
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
		                        <input class="span2" id="id_ncm" maxlength="10" name="ncm" type="text" value="<?php echo $produto['ShopProduto']['ncm']; ?>" />
		                    </div>
		                </div>
				
					</div>
				
				</div>

				<?php 
				if ($produto['ShopProduto']['tipo'] == 'atributo') {
				?>

				<div class="price-box">
					<hr/>
					<div class="alert alert-info" style="margin-bottom: 0">
						<i class="icon-info-sign"></i> O preço do produto com variações é definido em cada variação adicionada.
					</div>
				</div>

				<?php 
				} else {
				?>
			
				<div class="price-box">
					<hr/>
					<div class="control-group">
                        <div class="controls ">
                            <label class="checkbox preco-sob-consulta" for="id_sob_consulta">
                            <input id="id_sob_consulta" name="sob_consulta" type="checkbox" value="True" <?php if (!(strcmp("True", $produto['ShopProduto']['preco_sob_consulta']))) {echo 'checked="checked"';} ?> />
                            Preço sob consulta
                            </label>
                        </div>
                    </div>
					<div class="price-controls flex-control three <?php if (!(strcmp("True", $produto['ShopProduto']['preco_sob_consulta']))) {echo 'hide';} ?>">
						<div class="muted preco-custo control-group ">
							<label class="control-label" for="id_custo">Preço de custo</label>
							<div class="controls">
								<div class="input-prepend">
									<span class="add-on">R$</span><input class="preco" id="id_custo" name="custo" type="text" <?php
									if ($produto['ShopProduto']['preco_custo'] > 0) {
										printf( 'value="%s"', \Lib\Tools::convertToDecimalBR($produto['ShopProduto']['preco_custo']));
									}
									?> />
								</div>
							</div>
						</div>
						<div class="preco-venda control-group ">
							<label class="control-label" for="id_cheio">Preço de venda</label>
							<div class="controls">
								<div class="input-prepend main-color">
									<span class="add-on">R$</span><input class="preco" id="id_cheio" name="cheio" type="text" <?php
									if ($produto['ShopProduto']['preco_cheio'] > 0) {
										printf( 'value="%s"', \Lib\Tools::convertToDecimalBR($produto['ShopProduto']['preco_cheio']));
									}
									?> />
								</div>
							</div>
						</div>
						<div class="preco-promocional control-group last ">
							<label class="control-label" for="id_promocional">Preço promocional</label>
							<div class="controls">
								<div class="input-prepend secundary-color">
									<span class="add-on">R$</span><input class="preco" id="id_promocional" name="promocional" type="text" <?php
									if ($produto['ShopProduto']['preco_promocional'] > 0) {
										printf( 'value="%s"', \Lib\Tools::convertToDecimalBR($produto['ShopProduto']['preco_promocional']));
									}
									?> />
								</div>
							</div>
						</div>
					</div>
					<div class="price-show <?php if (!(strcmp("True", $produto['ShopProduto']['preco_sob_consulta']))) {echo 'hide';} ?>">
						<!--<label class="pull-left">Preço na loja</label>-->
						<div class="box-price-show pull-right">
							<div class="price-only hide">R$ <span></span></div>
							<span class="price-full strike">de R$ <span></span></span>
							<span class="price-promotional">por R$ <span></span></span>
							<div class="alert-venda-empty" style="text-align: center; font-weight: bold;">Preencha o preço de venda do produto</div>
						</div>
					</div>
				</div>

				<?php 
				}
				?>

			</div>
		</div>
	</div>
	<div class="alert alert-opcoes-produto hide"></div>

	<?php 
	if ($produto['ShopProduto']['tipo'] == 'atributo') {
	?>

	<!-- Grage #grade -->
	
	<div class='box' id="grade-variacao">
		<div class="box-header">
			<h3>Variações do produto</h3>
			<a id="opcoes-produto"></a>
			<div class="pull-right">
				<a href="<?php echo 'http://suporte'. env('HTTP_BASE'); ?>/produto-com-opcoes" class="btn btn-small" target="_blank"><i class="icon-question-sign"></i> Ajuda sobre variações de produto</a>
			</div>
		</div>

		<?php
		if (count($res_grade) <=0 ) {
		?>

		<div class='box-content'>
            <div class="form-produto-vincular-grade" data-action="/admin/catalogo/produto/grade/vincular/<?php echo $produto['ShopProduto']['id_produto']; ?>" data-method="post">
                <div class="alert alert-info">
                    <h4>Adicionar grades ao produto</h4>
                    <p>Abaixo estão listas todas as grades que você pode adicionar ao produto. Adicione as grades de acordo com as variações que você deseja que seu cliente escolha.</p>
                </div>

                <div class="form-group">
                    <label style="margin: 0 0 10px 0;" class="control-label"><strong>Adicionar as grades:</strong></label>

                    <div class="control-group grades">
						<ul id="id_grade">
							<?php
							foreach ($res_grade_default as $key => $grade) {
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
                <div class="form-group">
                    <div class="controls">
                        <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
						<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                        <input type='hidden' name='id_produto' value='<?php echo $produto['ShopProduto']['id_produto']; ?>"' />
                        <input type="hidden" name="next" value="/catalogo/produto/editar/<?php echo $produto['ShopProduto']['id_produto']; ?>" />
                        <button class="btn btn-small btn-primary" type="submit"><i class="icon-ok icon-white"></i> Adicionar as grades selecionadas ao produto</button>
                        <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/criar/?next=/catalogo/produto/editar/<?php echo $produto['ShopProduto']['id_produto']; ?>/#opcoes-produto" class="btn btn-small"><i class="icon-plus"></i> Criar uma nova grade</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
		} else {
		?>

		<div class='box-content'>
			<table class="table table-condensed produto-opcoes">

				<thead>
                    <tr>                        

						<?php
						foreach ($res_grade as $key => $grade):
						$GradeId = $grade['ShopGrade']['id_grade'];

						if ($GradeId==1) {
							$color_bg = '#06AEB6';
						} elseif ($GradeId==2) {
							$color_bg = '#009310';
						} elseif ($GradeId==3) {
							$color_bg = '#A006B6';
						} else {
							$color_bg = '#000000';
						}

						?>
                        
                        <th class="footable-visible" style="white-space: nowrap; width: 15%; color: <?php echo $color_bg;?>;">
                            <?php echo $grade['ShopGrade']['nome']; ?>
                            
                                <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/grade/remover/<?php echo $produto['ShopProduto']['id_produto']; ?>/<?php echo $GradeId; ?>" class="remover_grade" data-nome-grade="<?php echo $grade['ShopGrade']['nome']; ?>" title="Remover grade <?php echo $grade['ShopGrade']['nome']; ?>"><i class="icon-trash"></i></a>
                            
                        </th>

                        <?php
                        endforeach;
                        ?>                  
                        
                        <th class="footable-visible" data-hide="phone" style="white-space: nowrap;">Código</th>
                        <th class="footable-visible" style="white-space: nowrap;">Preço</th>
                        <th class="footable-visible" data-hide="phone" style="white-space: nowrap;">Estoque</th>
                        <th class="footable-visible footable-last-column" data-hide="phone" style="white-space: nowrap;"></th>
                    </tr>
                </thead>

                <!--
				<thead>
					<tr>
						<th style="white-space: nowrap; width: 15%; color: #06AEB6">
							Produto com duas cores
						</th>
						<th style="white-space: nowrap;">Código</th>
						<th style="white-space: nowrap;">Preço</th>
						<th style="white-space: nowrap;">Estoque</th>
						<th style="white-space: nowrap;"></th>
					</tr>
				</thead>
				-->
				<tbody>

					<?php
					if (empty($res_produto_filho)):
					?>

					<tr>
	                    <td colspan="<?php echo count($res_grade)+3;?>">
	                        <div class="text-align-center" style="padding: 10px 0;">
	                            <h4>Ainda não há variações adicionadas para este produto.</h4>
	                            Para adicionar uma nova opção de produto, utilize o botão abaixo.
	                        </div>
	                    </td>
	                </tr>

	                <?php
	            	else:

	            	foreach ($res_produto_filho as $key => $filho):

	                ?>

					<tr id="block-line-prd-atr-<?php echo $filho['ShopProduto']['id_produto']; ?>" class="ativo">

						<?php
						foreach ($res_grade as $key => $str_grade){
	
						?>	

						<td class="pode-ter-imagens" id="grade_<?php echo $filho['ShopGradeVariacao']['id_variacao']; ?>"  data-variacao-id="<?php echo $filho['ShopGradeVariacao']['id_variacao']; ?>">
							<strong class="produto-grade-variacao-<?php echo $filho['ShopProdutoVariacao']['id_grade_default']; ?>-<?php echo $filho['ShopGradeVariacao']['id_variacao']; ?>" style="color: #06AEB6">
							<?php 

							if (isset($filho['ShopGradeVariacao']['id_variacao']) >0) {

								echo $this->requestAction(
					                array(
					                    'controller' => 'ShopProdutoVariacao',
					                    'action' => 'getNomeVariacao',
					                    'id_produto' => $filho['ShopProduto']['id_produto'],
					                    'id_grade' => $str_grade['ShopGrade']['id_grade']
					                )
					            );

							}
				            ?>
							</strong>
						</td>

						<?php
						}
						?>

				
						<td><span class="produto-sku"><?php echo $filho['ShopProduto']['sku']; ?></span></td>
						<td>
							<span class="produto-preco-cheio">

								<?php
								if ($filho['ShopProduto']['preco_promocional'] > 0 ):

									echo '<s>de R$ ';
									echo \Lib\Tools::convertToDecimalBR($filho['ShopProduto']['preco_cheio']);
									echo '</s> por R$ ';
									echo \Lib\Tools::convertToDecimalBR($filho['ShopProduto']['preco_promocional']);

								elseif ($filho['ShopProduto']['preco_cheio'] > 0 ):

									echo 'R$ '. \Lib\Tools::convertToDecimalBR($filho['ShopProduto']['preco_cheio']);

								else :
									echo '-';
								endif;
								?>
							</span>
						</td>
						<td>

							<span class="produto-quantidade text-align-center">
								<?php
								if ($filho['ShopProduto']['quantidade'] > 0 ) {
									echo $filho['ShopProduto']['quantidade'];
								} else {
									echo '-';
								}
								?>
							</span>
							
						</td>
						<td nowrap="nowrap" style="width: 1%;">
							<a class="btn btn-mini editar_produto_filho" onclick="mostrar_editar_opcao(<?php echo $filho['ShopProduto']['id_produto']; ?>); return false;" href="#" rel="tooltip" title="Editar esta variação."><i class="icon-edit"></i></a>
							<a class="btn btn-mini remover_produto_filho" href="/admin/catalogo/produto/filho/remover/<?php echo $filho['ShopProduto']['id_produto']; ?>" rel="tooltip" title="Remover esta variação."><i class="icon-trash"></i></a>
							<a class="btn btn-mini duplicar_produto_filho" onclick="duplicar_opcao(<?php echo $filho['ShopProduto']['id_produto']; ?>); return false;" href="#" rel="tooltip" title="Duplicar esta variação."><i class="icon-retweet"></i></a>
							<span class="status none">
								<?php
								if ($filho['ShopProduto']['ativo'] == 'True') {
									echo '<span class="label label-success">Ativo</span>' . PHP_EOL;
								} else {
									echo '<span class="label label-danger">Inativo</span>' . PHP_EOL;
								}
								?>
								
							</span>
						</td>
					</tr>
					<tr class="hide no-hover" id="block-prd-atr-<?php echo $filho['ShopProduto']['id_produto']; ?>">
						<td colspan="6" style="padding-bottom: 20px;">
							<div data-action="/admin/catalogo/produto/editar/<?php echo $filho['ShopProduto']['id_produto']; ?>" data-method="post" class="produto-atributo-form">
								<input type="hidden" name="produto_id" value="<?php echo $filho['ShopProduto']['id_produto']; ?>" />
								<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
								<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
								<table style="background: #EEE">
									<tr>
										<td style="min-width: 5px;">&nbsp;</td>
										<td >
											<div class="control-group" rel="tooltip" data-original-title="Escreva aqui o valor da opção de Produto com duas cores que o seu cliente irá escolher. Por exemplo: Azul, Amarelo, P, M, G, 110v ou 220v.">
												<label style="color: #06AEB6" for="prd_atr_<?php echo $filho['ShopProduto']['id_produto']; ?>_"><strong>Produto com duas cores</strong></label>

												<input type="hidden" class="input-medium grade_variacao prod_<?php echo $filho['ShopProduto']['id_produto']; ?>_grade_<?php echo $filho['ShopProdutoVariacao']['id_grade_default']; ?>" id="prd_atr_<?php echo $filho['ShopProduto']['id_produto']; ?>_<?php echo $filho['ShopProdutoVariacao']['id_grade_default']; ?>_<?php echo $filho['ShopGradeVariacao']['id_variacao']; ?>" type="text" name="grade_variacao" value="<?php echo $filho['ShopProdutoVariacao']['nome']; ?>"  />	

												<?php
												/*

												<input type="hidden" class="input-medium grade_variacao prod_<?php echo $filho['ShopProduto']['id_produto']; ?>_grade_<?php echo $filho['ShopProdutoVariacao']['id_grade_default']; ?>" id="prd_atr_<?php echo $filho['ShopProduto']['id_produto']; ?>_<?php echo $filho['ShopProdutoVariacao']['id_grade_default']; ?>_<?php echo $filho['ShopGradeVariacao']['id_variacao']; ?>" type="text" name="prod_grade_id" value="<?php echo $filho['ShopProdutoVariacao']['id_grade_default']; ?>"  />

												<input type="hidden" class="input-medium grade_variacao prod_<?php echo $filho['ShopProduto']['id_produto']; ?>_grade_<?php echo $filho['ShopProdutoVariacao']['id_grade_default']; ?>" id="prd_atr_<?php echo $filho['ShopProduto']['id_produto']; ?>_<?php echo $filho['ShopProdutoVariacao']['id_grade_default']; ?>_<?php echo $filho['ShopGradeVariacao']['id_variacao']; ?>" type="text" name="prod_grade_variacao_id" value="<?php echo $filho['ShopGradeVariacao']['id_variacao']; ?>"  />

												*/ ?>

												<a href="#" class="escolher-cor" data-grade-id="<?php echo $filho['ShopProdutoVariacao']['id_grade_default']; ?>" data-produto-id="<?php echo $filho['ShopProduto']['id_produto']; ?>"><?php echo $filho['ShopProdutoVariacao']['nome']; ?></a>


												<input type="hidden" type="text" name="grade_id_teste" value="<?php echo $filho['ShopProdutoVariacao']['id_grade_default']; ?>"  />

												<input type="hidden" type="text" name="variacao_id_teste" value="<?php echo $filho['ShopGradeVariacao']['id_variacao']; ?>"  />

											</div>
										</td>
										<td style="min-width: 30px;">&nbsp;</td>
									</tr>


								</table>
								<div style="background: #EEE; padding: 10px 20px 10px 20px">
									<div class="alert hide"></div>
									<div class="row">
										<div class="row">
											<div class="control-group">
												<label for="id_ativo" class="control-label">Variação ativa?</label>
												<div class="controls">
													<select class="input-small" id="id_ativo" name="ativo">
														<option value="True" <?php if (!(strcmp("True", $filho['ShopProduto']['ativo']))) {echo 'selected="selected"';} ?>>Sim</option>
														<option value="False" <?php if (!(strcmp("False", $filho['ShopProduto']['ativo']))) {echo 'selected="selected"';} ?>>Não</option>
													</select>
												</div>
											</div>
										</div>
										<div class="span3 alpha" style="float: left; width: 350px;">
											<div class="control-group form-inline">
												<label class="control-label">Código</label>
												<div class="controls">
													<input id="id_sku" maxlength="255" name="sku" type="text" value="<?php echo $filho['ShopProduto']['sku']; ?>" style="width: 180px;"  />
													<a href="#" class="btn gerar_codigo_grade_variacao">
													<i class="icon-refresh"></i>
													Gerar código
													</a>
												</div>
											</div>
										</div>

										<div class="span6" style="float: left; width: 600px; margin-left:-1px;">


											<div class="span3 alpha" style="float: left; width:30%;">
												<div class="control-group">
													<label class="control-label">Preço de custo</label>
													<div class="controls">
														<div class="input-prepend">
															<span class="add-on">R$</span>
															<input class="preco" style="width: 55%;" id="id_custo" name="custo" type="text" <?php
														if ($filho['ShopProduto']['preco_custo'] > 0) {
															printf( 'value="%s"', \Lib\Tools::convertToDecimalBR($filho['ShopProduto']['preco_custo']));
														}
														?> />
														</div>
													</div>
												</div>
											</div>
											<div class="span3 alpha" style="float: left; width:30%;">
												<div class="control-group">
													<label class="control-label">Preço de venda</label>
													<div class="controls">
														<div class="input-prepend main-color">
															<span class="add-on">R$</span>
															<input class="preco" style="width: 55%;" id="id_cheio" name="cheio" type="text" <?php
														if ($filho['ShopProduto']['preco_cheio'] > 0) {
															printf( 'value="%s"', \Lib\Tools::convertToDecimalBR($filho['ShopProduto']['preco_cheio']));
														}
														?> />
														</div>
													</div>
												</div>
											</div>
											<div class="span3 omega" style="float: left; width:30%;">
												<div class="control-group">
													<label class="control-label">Preço promocional</label>
													<div class="controls">
														<div class="input-prepend secundary-color">
															<span class="add-on">R$</span>
															<input class="preco" style="width: 55%;" id="id_promocional" name="promocional" type="text" <?php
														if ($filho['ShopProduto']['preco_promocional'] > 0) {
															printf( 'value="%s"', \Lib\Tools::convertToDecimalBR($filho['ShopProduto']['preco_promocional']));
														}
														?>  />
														</div>
													</div>
												</div>
											</div>
											<div class="error-preco-wrapper"></div>
										</div>
									</div>
									<div class="row box-dimension-filho">
										<div class="span3 alpha" style="float: left; width: 20%;">
											<div class="control-group <?php if ($filho['ShopProduto']['peso'] <= 0 ) { echo 'warning'; } ?>">
												<label class="control-label">Peso</label>
												<div class="controls">
													<div class="input-append">
														<input class="peso" id="id_peso" name="peso" type="text" value="<?php

														if ($filho['ShopProduto']['peso'] > 0) {
															echo str_replace('.', ',', $filho['ShopProduto']['peso']);
														}

														?>" /><span class="add-on">Kg</span>
													</div>
												</div>
											</div>
										</div>


										<div class="span3" style="float: left; width: 20%;">
											<div class="control-group <?php if ($filho['ShopProduto']['altura'] <= 0 ) { echo 'warning'; } ?>">
												<label class="control-label">Altura</label>
												<div class="input-append">
													<input class="medida" id="id_altura" name="altura" type="text" value="<?php

														if ($filho['ShopProduto']['altura'] > 0 ) {
															echo $filho['ShopProduto']['altura'];
														}					

													 ?>" /><span class="add-on">cm</span>
												</div>
											</div>
										</div>

										<div class="span3" style="float: left; width: 20%;">
											<div class="control-group <?php if ($filho['ShopProduto']['largura'] <= 0 ) { echo 'warning'; } ?>">
												<label class="control-label">Largura</label>
												<div class="controls">
													<div class="input-append">
													<input class="medida" id="id_largura" name="largura" type="text" value="<?php 

														if ($filho['ShopProduto']['largura'] > 0 ) {
															echo $filho['ShopProduto']['largura'];
														}

														?>" /><span class="add-on">cm</span>
												</div>
												</div>
											</div>
										</div>

										<div class="span3 omega" style="float: left; width: 20%;">
											<div class="control-group <?php if ($filho['ShopProduto']['comprimento'] <= 0 ) { echo 'warning'; } ?>">
												<label class="control-label">Comprimento</label>
												<div class="input-append">
													<input class="medida" id="id_comprimento" name="comprimento" type="text" value="<?php

														if ($filho['ShopProduto']['comprimento'] > 0 ) {
															echo $filho['ShopProduto']['comprimento'];
														}

														?>" /><span class="add-on">cm</span>
												</div>
											</div>
										</div>
										<div class="alert alert-info aviso_preenchimento" style="clear: left; margin-bottom: 0;">
											<i class="icon-warning-sign" style="margin: 2px 3px 0 0;"></i> Para o cálculo correto do envio todos os valores acima devem ser preenchidos.
										</div>
									</div>
									<div class="row form-horizontal" style="margin-top: 20px">
										<div class="control-group">
											<p>
												Gerenciar o estoque pela plataforma?
												<select class="input-small" id="id_gerenciado" name="gerenciado">

													<option value="True" <?php if (!(strcmp("True", $filho['ShopProduto']['gerenciado']))) {echo 'selected="selected"';} ?>>Sim</option>
													<option value="False" <?php if (!(strcmp("False", $filho['ShopProduto']['gerenciado']))) {echo 'selected="selected"';} ?>>Não</option>

												</select>
											</p>
											<div >
												<p>
													Qual a disponibilidade dos produtos?
													<select class="span4" id="id_situacao_em_estoque" name="situacao_em_estoque">

														<?php

														echo \Commons\SituacaoProdutoEstoque::optionEmEstoque($filho['ShopProduto']['situacao_em_estoque']);
														
														?>

													</select>
												</p>
											</div>
											<div id="bloco-estoque-gerenciado" class="hide">
												<p>
													Quantidade de produtos em estoque
													<input class="span3" id="id_quantidade" name="quantidade" type="text" value="<?php echo $filho['ShopProduto']['quantidade']; ?>" />
												</p>
												<p>
													Quando o produto acabar em estoque
													<select class="span5" id="id_situacao_sem_estoque" name="situacao_sem_estoque">
														<?php
														echo \Commons\SituacaoProdutoEstoque::optionSemEstoque($produto['ShopProduto']['situacao_sem_estoque']);
														?>
													</select>
												</p>
												<hr/>

												<p class="text-align-center">
													<strong id="estoque-itens-reservados"><?php

														echo $filho['ShopProduto']['reservado'];
														
														?></strong>
													unidades deste produto estão reservados, restando
													<strong id="estoque-itens-disponiveis"><?php

														echo ( $filho['ShopProduto']['quantidade'] - $filho['ShopProduto']['reservado'] );
														?></strong>
													para venda.
												</p>
												<hr/>
											</div>
										</div>
										<div class="row">
											<div class="control-group">
												<div class="">

													<input type='hidden' name='produto_variacoes' value='True' />

													<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
													<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

													<input type='hidden' name='sku_master' value='<?php echo $produto['ShopProduto']['sku']; ?>' />

													<input type='hidden' name='parente_id_master' value='<?php echo $produto['ShopProduto']['id_produto']; ?>' />

													<button class="btn btn-medium btn-primary" type="submit"><i class="icon-ok icon-white"></i> Salvar alterações</button> ou <a href="#" onclick="esconder_editar_opcao(<?php echo $filho['ShopProduto']['id_produto']; ?>); return false;">Cancelar</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>

					<?php
					endforeach; // Fim foreach atributo

					endif;
					?>

					<tr class="hide no-hover" id="block-new">
						<td colspan="9" style="padding-bottom: 20px;">
							<div data-action="/admin/catalogo/produto/criar" data-method="post" class="produto-form-atributo-criar">

								<table style="background: #EEE">
									<tr>

										<?php

										foreach ($res_grade as $key => $grade):									
										$GradeId = $grade['ShopGrade']['id_grade'];

										if ($GradeId == 1 || $GradeId > 3) {

											if ($GradeId==1) {
												$color_bg = '#06AEB6';
											} else {
												$color_bg = '#000000';
											}
										
										?>
										<input type="hidden" value="<?php echo $GradeId; ?>" name="grade_id[]">

										<td style="min-width: 5px;">&nbsp;</td>
										<td width="125">
											<div class="form-group" rel="tooltip" data-original-title="Escolha aqui o valor da opção de Gênero que o seu cliente irá escolher. Por exemplo: Azul, Amarelo, P, M, G, 110v ou 220v.">
					                            <label class="control-label" style="color: <?php echo $color_bg; ?>" for="prd_atr__<?php echo $GradeId; ?>"><strong><?php echo $grade['ShopGrade']['nome']; ?></strong></label>


				                            	<?php

				                            	$dados = $this->requestAction(
									                array(
									                    'controller' => 'ShopGradeVariacao',
									                    'action' => 'getVariacoesGrade',
									                    'id' => $GradeId
									                )
									            );

									            if (count($dados)<=0) {									            
									            ?>

					                            <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/editar/<?php echo $GradeId; ?>/?next=/admin/catalogo/produto/editar/<?php echo $produto['ShopProduto']['id_produto']; ?>/#opcoes-produto">Criar variações</a>


					                            <?php
					                        	} else {
					                            ?>

					                            <select class="grade_variacao form-control" rel="grade-<?php echo $GradeId; ?>" name="grade_variacao_id[]" id="grade_variacao-<?php echo $GradeId; ?>">

					                            	<?php
										            foreach ($dados as $key => $variacao) {
										           
											            printf('<option value="%s">%s</option>', $variacao, $variacao ) . PHP_EOL;

					                            	}
					                            	?>
					                                
					                            </select>

					                            <?php
					                        	}
					                            ?>
					                            
					                        </div>
										</td>
										<td style="min-width: 20px;">&nbsp;</td>

										<?php
										} elseif ($GradeId == 2 || $GradeId == 3) {				
										?>

										<td style="min-width: 5px;">&nbsp;</td>
										<td >
											<div class="form-group" rel="tooltip" data-original-title="Escolha aqui o valor da opção de Produto com uma cor que o seu cliente irá escolher. Por exemplo: Azul, Amarelo, P, M, G, 110v ou 220v.">

												<?php
												if ($GradeId==2) {
													$color_bg = '#009310';
												} else {
													$color_bg = '#A006B6';
												}
												?>

					                            <label class="control-label" style="color: <?php echo $color_bg; ?>" for="prd_atr__<?php echo $GradeId; ?>"><strong><?php echo $grade['ShopGrade']['nome']; ?></strong></label>
					                            
					                            <a href="#" class="btn btn-default btn-xs escolher-cor" data-grade-id="<?php echo $GradeId; ?>">
					                                <i class="icon-th"></i> Escolher cor
					                            </a>
					                            <p>
					                                <small class="grade_variacao-<?php echo $GradeId; ?> text-muted"></small>
					                            </p>
					                            <input id="grade_variacao-<?php echo $GradeId; ?>" type="hidden" value="" name="grade_variacao_cor" class="grade_variacao">


					                            <!-- BEGIN - COR -->
												<input id="grade_variacao_id1" type="hidden" value="" name="grade_variacao_id_cor[]" class="grade_variacao_id1">

												<input type="hidden" value="<?php echo $GradeId; ?>" name="grade_id_cor">

												<?php
												if ($GradeId==3) {
												?>

												<input id="grade_variacao_id2" type="hidden" value="" name="grade_variacao_id_cor[]" class="grade_variacao_id2">

												<?php
												}
												?>
												
												<!-- END - COR -->
					                            
					                        </div>
										</td>
										<td style="min-width: 20px;">&nbsp;</td>

										<?php
										}

										endforeach;
										?>

									</tr>

								</table>
								<div style="background: #EEE; padding: 10px 20px 10px 20px">
									<div class="alert hide"></div>
									<div class="row">
										<div class="row">
											<div class="control-group">
												<label for="id_ativo" class="control-label">Variação ativa?</label>
												<div class="controls">
													<select class="input-small" id="id_ativo" name="ativo">
														<option value="True">Sim</option>
														<option value="False">Não</option>
													</select>
												</div>
											</div>
										</div>

										<div class="span3 alpha" style="float: left; width: 350px;">
											<div class="control-group form-inline">
												<label class="control-label">Código</label>
												<div class="controls">
													<input id="id_sku" maxlength="255" name="sku" type="text" />
													<a href="#" class="btn gerar_codigo_grade_variacao">
													<i class="icon-refresh"></i>
													Gerar código
													</a>
												</div>
											</div>
										</div>

										<div class="span6" style="float: left; width: 600px; margin-left:-1px;">

											<div class="span3 alpha" style="float: left; width:30%;">
												<div class="control-group">
													<label class="control-label">Preço de custo</label>
													<div class="controls">
														<div class="input-prepend">
															<span class="add-on">R$</span>
															<input class="preco" style="width: 55%;" id="id_custo" name="custo" type="text" />
														</div>
													</div>
												</div>
											</div>
											<div class="span3 alpha" style="float: left; width:30%;">
												<div class="control-group">
													<label class="control-label">Preço de venda</label>
													<div class="controls">
														<div class="input-prepend main-color">
															<span class="add-on">R$</span>
															<input class="preco" style="width: 55%;" id="id_cheio" name="cheio" type="text" />
														</div>
													</div>
												</div>
											</div>
											<div class="span3 omega" style="float: left; width:30%;">
												<div class="control-group">
													<label class="control-label">Preço promocional</label>
													<div class="controls">
														<div class="input-prepend secundary-color">
															<span class="add-on">R$</span>
															<input class="preco" style="width: 55%;" id="id_promocional" name="promocional" type="text" />
														</div>
													</div>
												</div>
											</div>
											<div class="error-preco-wrapper"></div>
										</div>

									</div>

									<div class="row box-dimension-filho">
										<div class="span3 alpha" style="float: left; width: 20%;">
											<div class="control-group warning">
												<label class="control-label">Peso</label>
												<div class="controls">
													<div class="input-append">
														<input class="peso" id="id_peso" name="peso" type="text" />
														<span class="add-on">Kg</span>
													</div>
												</div>
											</div>
										</div>
										<div class="span3" style="float: left; width: 20%;">
											<div class="control-group warning">
												<label class="control-label">Altura</label>
												<div class="controls">
													<div class="input-append">
														<input class="medida" id="id_altura" name="altura" type="text" />
														<span class="add-on">cm</span>
													</div>
												</div>
											</div>
										</div>
										<div class="span3" style="float: left; width: 20%;">
											<div class="control-group warning">
												<label class="control-label">Largura</label>
												<div class="controls">
													<div class="input-append">
														<input class="medida" id="id_largura" name="largura" type="text" />
														<span class="add-on">cm</span>
													</div>
												</div>
											</div>
										</div>
										<div class="span3 omega" style="float: left; width: 20%;">
											<div class="control-group warning">
												<label class="control-label">Comprimento</label>
												<div class="controls">
													<div class="input-append">
														<input class="medida" id="id_comprimento" name="comprimento" type="text" />
														<span class="add-on">cm</span>
													</div>
												</div>
											</div>
										</div>
										<div class="alert alert-info aviso_preenchimento" style="clear: left; margin-bottom: 0;">
											<i class="icon-warning-sign" style="margin: 2px 3px 0 0;"></i> Para o cálculo correto do envio todos os valores acima devem ser preenchidos.
										</div>
									</div>
									<div class="row form-horizontal" style="margin-top: 20px">
										<div class="control-group">
											<p>
												Gerenciar o estoque pela plataforma?
												<select class="input-small" id="id_gerenciado" name="gerenciado">
											
													<option value="True">Sim</option>
													<option value="False" selected="selected">Não</option>

												</select>
											</p>
											<div >
												<p>
													Qual a disponibilidade dos produtos?
													<select class="span4" id="id_situacao_em_estoque" name="situacao_em_estoque">

														<?php

														echo \Commons\SituacaoProdutoEstoque::optionEmEstoque($produto['ShopProduto']['situacao_em_estoque']);
														
														?>

													</select>
												</p>
											</div>
											<div id="bloco-estoque-gerenciado" class="hide">
												<p>
													Quantidade de produtos em estoque
													<input class="span3" id="id_quantidade" name="quantidade" type="text" />
												</p>
												<p>
													Quando o produto acabar em estoque
													<select class="span5" id="id_situacao_sem_estoque" name="situacao_sem_estoque">
														<?php
														echo \Commons\SituacaoProdutoEstoque::optionSemEstoque($produto['ShopProduto']['situacao_sem_estoque']);
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
												<hr/>
											</div>
										</div>
										<div class="row">
											<div class="control-group">
												<div class="">
													<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
													<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
													<input type='hidden' name='sku_master' value='<?php echo $produto['ShopProduto']['sku']; ?>' />
													<input type='hidden' name='parente_id_master' value='<?php echo $produto['ShopProduto']['id_produto']; ?>' />
													<button class="btn btn-medium btn-primary" type="submit"><i class="icon-ok icon-white"></i> Salvar</button> ou <a href="#" onclick="esconder_criar_nova_variacao(); return false;">Cancelar</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<br/>
			<a class="btn btn-small" href="#" onclick="mostrar_criar_nova_variacao(); return false;"><i class="icon-plus"></i> Adicionar uma nova variação</a>
		</div>

		<?php
		}
		?>

	</div>

	<?php
	} //Fim Grade
	?>

	<!-- Fim: Grade #grade -->
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
                                        if (count($res_marcas) > 0) {
                                        	echo '<option value="">Selecione um marca</option>'. PHP_EOL;
                                        } else {
                                        	echo '<option value="">- Vazio -</option>'. PHP_EOL;
                                        }


										foreach ($res_marcas as $key => $marca) {

											if (!(strcmp($marca['ShopMarca']['id_marca'], $produto['ShopProduto']['id_marca']))) {
												echo sprintf('<option value="%d" selected="selected">%s</option>', 
												$marca['ShopMarca']['id_marca'], 
												$marca['ShopMarca']['nome']) . PHP_EOL;	
											} else {
												echo sprintf('<option value="%d">%s</option>', 
												$marca['ShopMarca']['id_marca'], 
												$marca['ShopMarca']['nome']) . PHP_EOL;
											}
											
										}
										?>									
                                    </select>
									<div class="btn-group hide">
										<!--
										<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="dropdown-label">Selecione uma marca</span></a>
									    -->

										<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="dropdown-label"><?php

											if (!empty($produto['ShopProduto']['id_marca']) && is_numeric($produto['ShopProduto']['id_marca'])) {
												# code...

												$res_marca = $this->requestAction(array(
									                'controller' => 'ShopMarca',
									                'action' => 'getIdMarca',
									                'id' => $produto['ShopProduto']['id_marca']
									            ));

									            if (empty($res_marca['ShopMarca']['nome'])) {
									            	echo 'Selecione um marca';
									            } else {
									           		echo $res_marca['ShopMarca']['nome'];
									            }            

											} else {
												echo '- Vazio -';
											}


										?></span></a>

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
													<button class="btn btn-small btn-primary dropdown-btn-submit"><i class="icon-ok icon-white"></i> Salvar</button>
													ou <span class="dropdown-btn-cancel">Cancelar</span>
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
										<a href="#" id="abrir-modal-categorias" class="btn dropdown-toggle" data-toggle="dropdown"><span class="dropdown-label"><?php

										if (isset($res_categoria['ShopCategoria']['nome_categoria'])) {
											# code...
											echo $res_categoria['ShopCategoria']['nome_categoria'];	
										} else {
											echo 'Selecione uma categoria';
										}


										if ( isset($res_categoria_sec_all) && count($res_categoria_sec_all) > 0) {
											$total_cat_sec = count($res_categoria_sec_all);

											echo '<small style="font-size: 11px; color: #888">';
											if ($total_cat_sec==1) {
												# code...
												echo ' (+1 categoria)</small>';
											} else {
												# code...
												echo ' (+'. $total_cat_sec .' categorias)</small>';
											}
											
										}								 

										?>

									</span></a>
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
						<input class="input-xxlarge" id="id_url_video_youtube" name="url_video_youtube" type="text" value="<?php echo $produto['ShopProduto']['url_video_youtube']; ?>" />
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
					<textarea class="ckeditor" cols="40" id="id_descricao_completa" name="descricao_completa" rows="10"><?php echo $produto['ShopProduto']['descricao_completa']; ?></textarea>
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
						<input id="id_title" maxlength="255" name="title" type="text" value="<?php echo $produto['ShopProduto']['title']; ?>" />
					</div>
					<p class="pull-right contador bot" id="titleCont"></p>
				</div>
				<div class="control-group percent ">
					<label class="control-label" for="id_description">
					Meta Tag Description
					</label>
					<div class="controls">
						<textarea cols="40" id="id_description" name="description" rows="2"><?php echo $produto['ShopProduto']['description']; ?></textarea>
					</div>
					<p class="pull-right contador bot" id="descrCont"></p>
				</div>
			</div>
		</div>
	</div>

	<?php 
	if ($produto['ShopProduto']['tipo'] == 'normal') {
	?>
	<!-- BEGIN Correios -->
	<div class="box ">
		<div class="box-header">
			<h3>Peso e dimensões <small style="margin-left: 10px;">Os valores devem ser preenchidos considerando o pacote que será enviado, ou seja, embalagem com produto</small></h3>
		</div>
		<div class="box-content">
			<div class="box-dimension flex-control four">
				<div class="control-group box-weight <?php if (floatval($produto['ShopProduto']['peso']) <= 0 ) { echo 'warning'; } ?>">
					<label class="control-label" for="id_peso">Peso <i class="icon-custom icon-weight icon-big"></i></label>
					<div class="controls">
						<div class="input-append">
							<input class="peso" id="id_peso" name="peso" type="text" value="<?php

							if (floatval($produto['ShopProduto']['peso']) > 0) {
								echo \Lib\Tools::convertToDecimalBR($produto['ShopProduto']['peso'],3);
							}

							?>" /><span class="add-on">Kg</span>
						</div>
					</div>
				</div>
				<div class="control-group box-height <?php if ($produto['ShopProduto']['altura'] <= 0 ) { echo 'warning'; } ?>">
					<label class="control-label" for="id_altura">Altura <i class="icon-custom icon-height"></i></label>
					<div class="controls">
						<div class="input-append">
							<input class="medida" id="id_altura" name="altura" type="text" value="<?php

								if ($produto['ShopProduto']['altura'] > 0 ) {
									echo $produto['ShopProduto']['altura'];
								}					

							 ?>" /><span class="add-on">cm</span>
						</div>
					</div>
				</div>
				<div class="control-group box-width <?php if ($produto['ShopProduto']['largura'] <= 0 ) { echo 'warning'; } ?>">
					<label class="control-label" for="id_largura">Largura <i class="icon-custom icon-width"></i></label>
					<div class="controls">
						<div class="input-append">
							<input class="medida" id="id_largura" name="largura" type="text" value="<?php 

								if ($produto['ShopProduto']['largura'] > 0 ) {
									echo $produto['ShopProduto']['largura'];
								}

								?>" /><span class="add-on">cm</span>
						</div>
					</div>
				</div>
				<div class="control-group box-depth last <?php if ($produto['ShopProduto']['comprimento'] <= 0 ) { echo 'warning'; } ?>">
					<label class="control-label" for="id_comprimento">Comprimento <i class="icon-custom icon-depth"></i></label>
					<div class="controls">
						<div class="input-append">
							<input class="medida" id="id_comprimento" name="comprimento" type="text" value="<?php

								if ($produto['ShopProduto']['comprimento'] > 0 ) {
									echo $produto['ShopProduto']['comprimento'];
								}

								?>" /><span class="add-on">cm</span>
						</div>
					</div>
				</div>
			</div>

			<?php
			if ((floatval($produto['ShopProduto']['peso']) <= 0) || 
				($produto['ShopProduto']['altura'] <= 0 ) ||
				($produto['ShopProduto']['largura'] <= 0 ) ||
				($produto['ShopProduto']['comprimento'] <= 0 )) {
			?>

			<div class="alert alert-info aviso_preenchimento" style="margin: 10px 0 0;">
				<i class="icon-warning-sign" style="margin: 2px 3px 0 0;"></i> Para o cálculo correto do envio todos os valores devem ser preenchidos.
			</div>

			<?php
			}
			?>
		</div>
	</div>

	<!-- END Peso e dimensões -->
	<!-- BEGIN Estoque -->

	<div class="box box-stock">
		<div class="box-header">
			<h3>Estoque</h3>
		</div>
		<div class="box-content form-horizontal">
			<div class="">
				<p>
					<label class="control-label" for="id_gerenciado" style="width: 230px; padding-right: 10px;">Gerenciar o estoque deste produto?</label>
					<select class="input-small" id="id_gerenciado" name="gerenciado">
						<option value="True" <?php if (!(strcmp("True", $produto['ShopProduto']['gerenciado']))) {echo 'selected="selected"';} ?>>Sim</option>
						<option value="False" <?php if (!(strcmp("False", $produto['ShopProduto']['gerenciado']))) {echo 'selected="selected"';} ?>>Não</option>
					</select>
				</p>
				<div id="bloco-estoque-nao-gerenciado" class="">
					<p>
						<label class="control-label" for="id_situacao_em_estoque" style="width: 230px; padding-right: 10px;">Qual a disponibilidade dos produtos?</label>
						<select class="span4" id="id_situacao_em_estoque" name="situacao_em_estoque">

							<?php

							echo \Commons\SituacaoProdutoEstoque::optionEmEstoque($produto['ShopProduto']['situacao_em_estoque']);
							
							?>
							
						</select>
					</p>
				</div>
				<div id="bloco-estoque-gerenciado" class="hide-">
					<p>
						<label class="control-label" for="id_quantidade" style="width: 230px; padding-right: 10px;">Quantidade de produtos em estoque</label>
						<input class="span3" id="id_quantidade" name="quantidade" type="text" value="<?php echo $produto['ShopProduto']['quantidade']; ?>" /> com
						<select class="span4" id="id_situacao_em_estoque" name="situacao_em_estoque">

							<?php

							echo \Commons\SituacaoProdutoEstoque::optionEmEstoque($produto['ShopProduto']['situacao_em_estoque']);
							
							?>

						</select>
					</p>
					<p>
						<label class="control-label" for="id_situacao_sem_estoque" style="width: 230px; padding-right: 10px;">Quando o produto acabar em estoque</label>
						<select class="span5" id="id_situacao_sem_estoque" name="situacao_sem_estoque">

							<?php
							echo \Commons\SituacaoProdutoEstoque::optionSemEstoque($produto['ShopProduto']['situacao_sem_estoque']);
							?>

						</select>
					</p>
					<hr/>

					<p class="text-align-center">
						<strong id="estoque-itens-reservados"><?php

							echo $produto['ShopProduto']['reservado'];
							
							?></strong>
						unidades deste produto estão reservados, restando
						<strong id="estoque-itens-disponiveis"><?php

								echo ( $produto['ShopProduto']['quantidade'] - $produto['ShopProduto']['reservado'] );
							?></strong>
						para venda.
					</p>

				</div>
			</div>
		</div>
	</div>
	<!-- END estoque -->

	<?php
	} else {
	?>

	<div class="box box-stock">
		<div class="box-header">
			<h3>Estoque</h3>
		</div>
		<div class="box-content form-horizontal">
			<div class="">
				<div class="alert alert-info" style="margin-bottom: 0">
					<i class="icon-info-sign"></i> O estoque do produto com variações é definido em cada opção do produto.
				</div>
			</div>
		</div>
	</div>

	<?php
	}
	?>

	<?php

	/**
	*
	* Verifica se o produto já foi indexado no Google
	*
	**/
	

	/*
	<div class="pull-left muted">
		<div class="box-content">
			<small class="pull-left">
			&nbsp;Produto indexado em: 1 mês, 1 semana.
			</small>
		</div>
	</div>

	*/

	?>
	<div class="pull-right">
		<a href="<?php echo sprintf('http://%s/p/%s/%d/', $url_shop, $produto['ShopProduto']['url'], $produto['ShopProduto']['id_produto'] ); ?>" target="_blank" class="btn btn-mini" style="margin-right: 10px;"><i class="icon-eye-open"></i> Visualizar produto na loja</a>
		<button type="submit" class="btn btn-large btn-primary btn-save"><i class="icon-ok icon-white"></i> Salvar alterações</button>
	</div>
	<div id="saveButton">
		<div class="container">
			<div class="button-container">
				<button type="submit" class="btn btn-save btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
			</div>
		</div>
	</div>
	<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
	<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
	<input type="hidden" name="produto_editar" value="true" />

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
<div id="modal-categorias" class="modal hide acao-editar">
	<form action="/admin/catalogo/produto/editar/categoria/" method="post">
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

						$option = $this->requestAction(array(
			                'controller' => 'ShopCategoria',
			                'action' => 'categoriaListaOption',
			                'id_categoria_default' => $id_categoria_default
			            ));			            
						
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
	</form>
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

<?php
/*
<div class="modal hide fade" id="EscolherCategoriaGlobal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Escolher tipo de produto</h3>
	</div>
	<div class="modal-body">
		<ul class="nav nav-tabs nav-stacked">
			<li><a href="#" class="categoria-global" data-categoria="1">Imóvel</a></li>
			<li><a href="#" class="categoria-global" data-categoria="3">DVD ou Blu-Ray</a></li>
			<li><a href="#" class="categoria-global" data-categoria="4">Livro</a></li>
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
*/?>

<div id="loading" class="modal hide">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="loading-text">Carregando...</h3>
                <img src="/admin/img/ajax-loader.gif" alt="Loading" />
            </div>
        </div>
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
