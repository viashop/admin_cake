<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/cliente/listar"><i class="icon-user icon-custom"></i>Clientes</a><span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/cliente/grupo/listar"><i class="icon-user icon-custom"></i>Grupos</a><span class="bread-separator">-</span></li>
		<li><span>Criar grupo</span></li>
	</ul>
</div>

<form action="<?php echo Router::url(); ?>" method="post" class="form-horizontal">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">Criando grupo</h3>
		</div>
		<div class="box-content">
			<?php
            $error = null;
            if (isset($error_nome)) {
                $error='error';
            }
            ?>
			<div class="control-group <?php echo $error; ?>">
				<label class="control-label" for="id_nome">Nome do grupo</label>
				<div class="controls">
					<input class="campo_principal" id="id_nome" maxlength="128" name="nome" type="text" value="<?php

						if (\Lib\Tools::getValue('nome') !='' ) {
							echo \Lib\Tools::getValue('nome');
						}

					 ?>" />
				</div>				
			</div>
			<div class="pull-right">
				<button type="submit" class="btn btn-primary">
				<i class="icon-ok icon-white"></i> Criar grupo
				</button>
				<a href="<?php echo VIALOJA_PAINEL ?>/cliente/grupo/listar" class="btn"><i class="icon icon-remove"></i> Cancelar</a>
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
			</div>
			<div class="clear"></div>
		</div>
	</div>
</form>
