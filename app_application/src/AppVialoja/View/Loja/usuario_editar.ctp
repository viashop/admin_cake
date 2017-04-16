<?php
foreach ($result_cliente as $key => $cliente);
?>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/usuario/listar"><i class="icon-users icon-custom"></i> Usuários</a> <span class="bread-separator">-</span></li>
		<li><span>Editar usuário</span></li>
	</ul>
</div>

<form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post">
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3>Editando </h3>
			</div>
			<div class="box-content">

				<?php
				if ($this->Session->read('id_cliente') == $cliente['Cliente']['id_cliente']) {
				?>

				<div class="control-group">
					<div class="controls">
						<span class="label">Este usuário é você.</span>
					</div>
				</div>

				<?php
				}
				?>
				<div class="control-group <?php if (isset($error_nome)) {
					echo 'error';
				}?>">
					<label class="control-label" for="id_nome">Nome</label>
					<div class="controls">
						<input class="input-large" id="id_nome" maxlength="128" name="nome" type="text" value="<?php 

						if (\Lib\Tools::getValue('nome') =='') {
							echo $cliente['Cliente']['nome']; 
						} else {
							echo \Lib\Tools::getValue('nome');
						}
						?>" />
					</div>
				</div>
				<div class="control-group <?php if (isset($error_email)) {
					echo 'error';
				}?>">
					<label class="control-label" for="id_email">Email</label>
					<div class="controls">
						<input class="input-xlarge" id="id_email" maxlength="200" name="email" type="text" value="<?php 

						if (\Lib\Tools::getValue('email') =='') {
							echo $cliente['Cliente']['email']; 
						} else {
							echo \Lib\Tools::getValue('email');
						}
						?>" />
					</div>
				</div>
				<?php
				if ($this->Session->read('id_cliente') !== $cliente['Cliente']['id_cliente']) {
				?>
				<div class="control-group">
                    <div class="controls">
                        <a class="btn btn-small btn-danger" href="/admin/loja/usuario/remover/<?php echo $cliente['Cliente']['id_cliente']; ?>"><i class="icon-white icon-trash"></i> Remover usuário</a>
                    </div>
                </div>
                <?php
				}
				?>
			</div>
			<div class="form-actions">
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
				<a href="<?php echo VIALOJA_PAINEL ?>/loja/usuario/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
			</div>
		</div>
	</div>
</form>
<!-- /Full width content box -->