<script type="text/javascript" src="/admin/js/ckeditor/ckeditor.js"></script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/pagina/listar"><i class="icon-page icon-custom"></i> Páginas</a> <span class="bread-separator">-</span></li>
		<li><span>Criar página</span></li>
	</ul>
</div>
<form action="<?php echo Router::url(); ?>" method="post" class="form-horizontal form-pagina">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">Criando página</h3>
		</div>
		<div class="box-content">
			<div class="control-group">
				<label class="control-label">Página ativa?</label>
				<div class="controls">
					<select class="input-small" id="id_ativo" name="ativo">
						<option value="True" <?php if (!(strcmp("True", \Lib\Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Sim</option>
                        <option value="False" <?php if (!(strcmp("False", \Lib\Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Não</option>
					</select>
				</div>
			</div>
			<?php
            $error = null;
            if (isset($error_titulo)) {
                $error='error';
            }
            ?>
			<div class="control-group obrigatorio campo_titulo <?php echo $error; ?>">
				<label class="control-label" for="id_titulo">Título da página</label>
				<div class="controls">
					<input class="campo_principal urlify" id="id_titulo" maxlength="100" name="titulo" rel=".url-slug,#id_url" type="text" value="<?php echo \Lib\Tools::getValue("titulo"); ?>" required />
					<div class="control-seamless-editable">
						<span class="control">http://<?php echo $url_shop; ?>/pagina/<span class="url-slug">-</span>.html</span>
						<!--<i class="icon-custom icon-pencil"></i>-->
						<input id="id_url" name="url" type="text" />
						<?php
			            if (isset($error_titulo)) {
			                echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
			            }
			            ?>
					</div>
				</div>
			</div>
			<?php
            $error = null;
            if (isset($error_conteudo)) {
                $error='error';
            }
            ?>
			<div class="control-group <?php echo $error; ?>">
				<label class="control-label">Conteúdo da página</label>
				<div class="controls">
					<textarea class="ckeditor" cols="40" id="id_conteudo" name="conteudo" rows="15"><?php echo \Lib\Tools::getValue("conteudo"); ?></textarea>

					<?php
		            if (isset($error_conteudo)) {
		                echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
		            }
		            ?>
					
				</div>
				<p class="help-block"></p>
			</div>
			<div class="pull-right">
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Criar página</button>
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>
