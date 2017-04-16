<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/listar"><i class="icon-th-large"></i> Organizar</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/listar"><i class="icon-bookmark"></i> Categorias</a> <span class="bread-separator">-</span></li>
        <li><span>Editar categoria</span></li>
    </ul>
</div>

<form action="<?php echo Router::url(); ?>" class="form-categoria form-horizontal" method="post">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">Editando categoria Sapato</h3>
		</div>
		<div class="box-content">

			<?php
            $error = null;
            if (isset($error_activity_shop)) {
                $error='error';
            }
            ?>
			<div class="control-group  <?php echo $error; ?>">
				<label class="control-label" for="id_activity">Atividade Principal</label>
				<div class="controls">
					<p class="help-block">Selecione o ramo de atividade para cadastrar a categoria, ela sera usada na indexação e organização de produtos na vitrine do Shopping ViaLoja.</p>					
					<select id="id_activity_shop" required name="activity_shop">

						<?php
						if (count($res_atividades) > 1 ) {
							echo '<option value="">Selecione a atividade</option>' . PHP_EOL;
						}

						foreach ($res_atividades as $key => $atividades) {

							$selected = null;
							if (\Lib\Validate::isPost()) {

								if (!(strcmp( $atividades['ConfiguracaoAtividade']['id_atividade'], 
									\Lib\Tools::getValue('activity_shop')))) {
	                                // Set the $checked string
	                                $selected = "selected='selected'";
	                            }

							} else {

								if (!(strcmp( $atividades['ConfiguracaoAtividade']['id_atividade'], 
									$categoria['ShopCategoria']['id_atividade']))) {
	                                // Set the $checked string
	                                $selected = "selected='selected'";
	                            }
							}

							echo sprintf('<option value="%d" %s>%s</option>', 
							$atividades['ConfiguracaoAtividade']['id_atividade'],
							$selected,
							$atividades['ConfiguracaoAtividade']['nome'] ) . PHP_EOL;
						}
						?>						
					</select>
					<?php
                    if (isset($error_activity_shop)) {
                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                    }
                    ?>
				</div>
			</div>
			<hr />

			<div class="control-group">
				<label class="control-label">Categoria ativa?</label>
				<div class="controls">
					<select class="input-small" id="id_ativa" name="ativa">
						<?php 
						if (\Lib\Validate::isPost()) {
						?>	
							<option value="True" <?php if (!(strcmp("True", \Lib\Tools::getValue("ativa")))) {echo 'selected="selected"';} ?>>Sim</option>
                        	<option value="False" <?php if (!(strcmp("False", \Lib\Tools::getValue("ativa")))) {echo 'selected="selected"';} ?>>Não</option>

						<?php
						} else {
						?>	

							<option value="True" <?php if (!(strcmp("True", $categoria['ShopCategoria']['ativa']))) {echo 'selected="selected"';} ?>>Sim</option>
	                        <option value="False" <?php if (!(strcmp("False", $categoria['ShopCategoria']['ativa']))) {echo 'selected="selected"';} ?>>Não</option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="control-group " >
				<label class="control-label">Categoria pai</label>
				<div class="controls" style="margin-bottom: 10px;">
					<p class="help-block">Selecione uma categoria pai para organizar suas categorias hierarquicamente. Sempre que você seleciona uma categoria pai, sua categoria se tornará filha dela, ou seja, sempre será mostrada ab    aixo da categoria pai. Por exemplo, uma categoria pai pode ser <strong>Acessórios</strong> e as categorias filhas podem ser <strong>Cintos, Gravatas ou Meias</strong>.</p>
					<span class="text">
					<strong>
						<?php
						$res_cat_pai_nome = $this->requestAction(array(
						    'controller' => 'ShopCategoria',
						    'action' => 'getCategoriaPaiNome',
						    'id_categoria' => $categoria['ShopCategoria']['id_categoria']
						));

						if (!empty($res_cat_pai_nome['ShopCategoria']['nome_categoria'])) {
							echo $res_cat_pai_nome['ShopCategoria']['nome_categoria'];
						} else {
							echo 'Esta é uma categoria principal';
						}

						?>
					</strong> &nbsp;&nbsp;&nbsp;<a data-toggle="modal" href="#modal-categoria-pai" class="btn btn-mini">Alterar categoria pai</a>
					</span>
				</div>
			</div>
			<hr />
			<?php
            $error = null;
            if (isset($error_nome)) {
                $error='error';
            }
            ?>
			<div class="control-group obrigatorio campo_nome <?php echo $error; ?>">
				<label class="control-label" for="id_nome">Nome</label>
				<div class="controls">
					<input class="campo_principal urlify" required id="id_nome" maxlength="255" name="nome" type="text" value="<?php 
 

						if (\Lib\Tools::getValue('nome') != '') {
							echo \Lib\Tools::getValue('nome');
						} else {
							echo $categoria['ShopCategoria']['nome_categoria'];
						} 

					?>" />
					<?php
                    if (isset($error_nome)) {
                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                    }
                    ?>
					<div class="control-seamless-editable">
						<span class="control">http://<?php echo $url_shop;?>/c/<span class="url-slug urlify"><?php 
 

						if (\Lib\Tools::getValue('apelido') != '') {
							echo \Lib\Tools::getValue('apelido');
						} else {
							echo $categoria['ShopCategoria']['url'];
						} 

					?></span>/<?php echo $categoria['ShopCategoria']['id_categoria'];?>/</span>
                    
						<i class="glyphicon glyphicon-pencil" id="url-edit" rel="tooltip" title="Edita o link da categoria na loja."></i>
						<i class="icon-remove" id="url-remove" rel="tooltip" title="Cancela as alterações feitas no link da categoria."></i>
						<input id="id_apelido" maxlength="255" name="apelido" type="text" value="<?php 
 

						if (\Lib\Tools::getValue('apelido') != '') {
							echo \Lib\Tools::getValue('apelido');
						} else {
							echo $categoria['ShopCategoria']['apelido'];
						} 

					?>" />
					</div>
				</div>
			</div>
			<div class="control-group percent hide" id="control-group-url">
				<div class="controls form-inline">
					<table class="table table-url">
						<tr>
							<td class="table-url-label" nowrap="nowrap">Nova URL:</td>
							<td class="table-url-path" nowrap="nowrap" width="100%"><input data-url-original="<?php echo $categoria['ShopCategoria']['url']; ?>" id="id_url" maxlength="255" name="url" value="<?php echo $categoria['ShopCategoria']['url']; ?>" type="text" /></td>
							<td class="table-url-validate-button" nowrap="nowrap"><button class="btn" type="button" id="url-validate" data-loading-text="Validando...">Validar</button></td>
						</tr>
					</table>
				</div>
			</div>
			<?php
            $error = null;
            if (isset($error_descricao_comp)) {
                $error='has-error';
            }
            ?>
			<div class="control-group <?php echo $error; ?>">
				<label class="control-label" for="id_descricao">Descrição</label>
				<div class="controls">
					<p class="help-block">A descrição da categoria será mostrada na página da categoria, logo abaixo do menu lateral. Este conteúdo é de extrema importância para os motores de busca entenderem do que se trata sua categoria.</p>
					<textarea cols="40" id="id_descricao" name="descricao" rows="3"><?php 

					if (\Lib\Tools::getValue('descricao') != '') {
						echo \Lib\Tools::getValue('descricao');
					} else {
						echo $categoria['ShopCategoria']['descricao'];
					}
					
					?></textarea>
					<?php
                    if (isset($error_descricao_comp)) {
                        echo '<ul class="errorlist"><li>Certifique-se de que o valor tenha no máximo 128 caracteres (ele possui '. $error_descricao_comp .').</li></ul>' . PHP_EOL;
                    }
                    ?>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-seo" style="margin: 30px 0;">
		<div class="box-header accordion-toggle" data-toggle="collapse" data-target="#area-seo">
			<h3>Otimização para buscadores (SEO)</h3>
			<div class="pull-right arrow-open"><i class="icon-chevron-down"></i></div>
		</div>
		<div class="box-content collapse" id="area-seo">
			<div class="accordion-inner form-horizontal">
				<div class="control-group percent ">
					<label class="control-label" for="id_title">
					Tag Title
					</label>
					<div class="controls">
						<input id="id_title" maxlength="255" name="title" type="text" value="<?php

						if (\Lib\Tools::getValue('title') !='') {
							echo \Lib\Tools::getValue('title');
						} else {
							echo $categoria['ShopCategoria']['title']; 
						}

						?>" />
					</div>
					<p class="pull-right contador bot" id="titleCont"></p>
				</div>
				<?php
	            $error = null;
	            if (isset($error_description_comp)) {
	                $error='has-error';
	            }
	            ?>
				<div class="control-group percent <?php echo $error; ?>">
					<label class="control-label" for="id_description">
					Meta Tag Description
					</label>
					<div class="controls">
						<textarea cols="40" id="id_description" name="description" rows="2"><?php

						if (\Lib\Tools::getValue('description') !='') {
							echo \Lib\Tools::getValue('description');
						} else {
							echo $categoria['ShopCategoria']['description']; 
						}

						?></textarea>
						<?php
	                    if (isset($error_description_comp)) {
	                        echo '<ul class="errorlist"><li>Certifique-se de que o valor tenha no máximo 128 caracteres (ele possui '. $error_descricao_comp .').</li></ul>' . PHP_EOL;
	                    }
	                    ?>
					</div>
					<p class="pull-right contador bot" id="descrCont"></p>
				</div>
			</div>
		</div>
	</div>
	<div class="pull-right">
		<button type="submit" class="btn btn-primary">
		<i class="icon-ok icon-white"></i> Salvar alterações
		</button>
		<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/criar" class="btn btn-small btn-secondary"><i class="icon-plus"></i> Criar nova categoria</a>
		<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
		<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
	</div>
</form>
<div class="modalContainer">
	<form action="/admin/catalogo/categoria/mover/<?php echo $categoria['ShopCategoria']['id_categoria'];?>" method="post">
		<div class="modal hide" id="modal-categoria-pai">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Mover categoria <small></small></h3>
			</div>
			<div class="modal-body">
				<div class="well form-horizontal">
					<div class="control-group move-category ">
						<label for="id_parent">Nova categoria pai:</label>
						<div class="controls">
							<select id="id_parent" name="parent">
								<option value="-">[ Raiz ]</option>
								<?php echo $option; ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Mover categoria</button>
				<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/editar/<?php echo $categoria['ShopCategoria']['id_categoria']; ?>" class="btn"><i class="icon-remove"></i> Cancelar</a>
			</div>
		</div>
	</form>
</div>
<div class="modalContainer">
	<div class="modal hide" id="modal-categoria-inativa">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h4>Desativar categoria <?php echo $categoria['ShopCategoria']['nome_categoria']; ?></h4>
		</div>
		<div class="modal-body">
			<p>Ao desativar a categoria <?php echo $categoria['ShopCategoria']['nome_categoria']; ?>, <strong>

				<?php
				//todas as suas 1 categorias filhas serão desativadas também.
				if (isset($total_filha)) {
					if ($total_filha <= 1) {
						echo 'uma categoria filha será desativada também';
					} else {
						echo "todas as suas {$total_filha} categorias filhas serão desativadas também";
					}
					# code...
				}
				?></strong>. Tem certeza que deseja continuar?</p>
			<p>Posteriormente, para reativar as categorias filhas será necessário acessar uma a uma e ativá-la manualmente.</p>
		</div>
		<div class="modal-footer">
			<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
			<button type="button" id="modal-categoria-inativa-prosseguir" class="btn btn-primary"><i class="icon-ok icon-white"></i> Sim, desativar a categoria e filhos</button>
			<button type="button" class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Não, cancelar</button>
		</div>
	</div>
</div>