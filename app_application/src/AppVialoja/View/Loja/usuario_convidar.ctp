<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/usuario/listar"><i class="icon-users icon-custom"></i> Usuários</a> <span class="bread-separator">-</span></li>
		<li><span>Convidar usuário</span></li>
	</ul>
</div>
<form class="form-horizontal" action="/admin/loja/usuario/convidar" method="post">
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3>Convidar usuário</h3>
			</div>
			<div class="box-content">
				<p>
					Os usuários do sistema são adicionados através de convite. Coloque no campo abaixo
					o email do usuário que você quer adicionar na sua conta. Será enviado um email com
					todas as informações necessárias para o cadastro.
				</p>
				<div class="control-group <?php if (isset($error)){ echo 'error';}?>">
					<label class="control-label" for="id_email">Endereço de Email</label>
					<div class="controls">
						<input class="input-xlarge" id="id_email" maxlength="200" name="email" type="text" value="<?php echo \Lib\Tools::getValue('email'); ?>" />
						<p class="help-block">O email da pessoa que será convidada.</p>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
				<input type='hidden' name='loja_nome' value='<?php echo $loja_nome; ?>' />
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Convidar usuário</button>
				<a href="<?php echo VIALOJA_PAINEL ?>/loja/usuario/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
			</div>
		</div>
	</div>
</form>
<!-- /Full width content box -->
