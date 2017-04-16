<style type="text/css">
	.administrador{ font-size: 12px; margin-left: 20px;}
	input[type="checkbox"]{ margin-top: -2px;}
</style>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/usuario/listar"><i class="icon-users icon-custom"></i> Usuários</a> <span class="bread-separator">-</span></li>
		<li><span>Listar usuários</span></li>
	</ul>
</div>
<div class="row">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">
				<?php
				$total_cliente = count($result_cliente);
				echo $total_cliente;
				if ($total_cliente==1) {
					echo ' Usuário';
				} else {
					echo ' Usuários';
				}				
				?>				
			</h3>

			<div class="box-widget pull-right">			
				<a href="<?php echo VIALOJA_PAINEL ?>/loja/usuario/convidar" class="btn btn-small btn-primary"><i class="icon-plus icon-white"></i> Convidar usuario</a>		
			</div>
		</div>
		<div class="box-content table-content">
			<table class="table table-generic-list table-usuario">
				<?php			
				foreach ($result_cliente as $key => $cliente) {
				?>
				<tr class="inativo">
					<td class="nome">
						<a href="<?php echo VIALOJA_PAINEL ?>/loja/usuario/editar/<?php echo $cliente['Cliente']['id_cliente']; ?>"><?php echo $cliente['Cliente']['nome']; ?></a>

						<span class="administrador">

							<?php

							$checked ='checked="checked"';
							if ($cliente['Cliente']['nivel'] < 5 ) {
								$checked ='';
							}

							if ($cliente['Cliente']['nivel'] > 5) {

								printf('<input %s id="id_cliente_%d" name="funcao_shop[]" type="checkbox" value="%d" data-email="%s" data-guardname="%s" data-guardtoken="%s" disabled /> Equipe ViaLoja', $checked, $key, $cliente['Cliente']['id_cliente'], $cliente['Cliente']['email'], $CSRFGuardName, $CSRFGuardToken ) . PHP_EOL;

							} else {

								$disabled = '';
								if ($this->Session->read('id_cliente') == $cliente['Cliente']['id_cliente']) {

									$disabled='disabled';

								}

								printf('<input %s id="id_cliente_%d" name="funcao_shop[]" type="checkbox" value="%d" data-email="%s" data-guardname="%s" data-guardtoken="%s" %s /> Administrador', $checked, $key, $cliente['Cliente']['id_cliente'], $cliente['Cliente']['email'], $CSRFGuardName, $CSRFGuardToken, $disabled ) . PHP_EOL;


							}

							?>

						</span>
									
					</td>
					<td class="email">
						<a href="<?php echo VIALOJA_PAINEL ?>/loja/usuario/editar/<?php echo $cliente['Cliente']['id_cliente']; ?>"><?php echo $cliente['Cliente']['email']; ?></a>
					</td>
					<td class="ativo">
						<span class="status">
							<span class="icon-custom icon-white icon-power"></span>Ativo
						</span>
					</td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
	</div>

	<?php
	$total_convite = count($result_convite);

	if ($total_convite > 0) {
	?>
	<hr/>
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">
				<?php
				if ($total_convite  ==1 ) {
					echo $total_convite  . ' Usuário';
				} else {
					# code...
					echo $total_convite  . ' Usuários';
				}
				
				?> aguardando confirmação do convite
			</h3>
		</div>
		<div class="box-content table-content">
			<table class="table table-generic-list">
				<?php
				foreach ($result_convite as $key => $convite) {
				?>
				<tr>
					<td class="texto">
						<?php 
						echo $convite['ClienteConvite']['email'];
						if ($convite['ClienteConvite']['status'] != 0) {
							echo '<span style="margin-left:10px; color: red; font-size:13px;">Recusado</span>';
						}
						?>						
					</td>

					<?php if ($convite['ClienteConvite']['status'] != 0): ?>

					<td class="acoes text-align-right">
						<a class="btn btn-small btn-danger" onclick='return confirm("Tem certeza de que deseja remover o convite?");' href="/public/convite-recusar/<?php echo $convite['ClienteConvite']['token']; ?>"><i class="glyphicon glyphicon-remove"></i> Remover convite</a>
					</td>
						
					<?php else: ?>

					<td class="acoes text-align-right">
						<a class="btn btn-small" onclick='return confirm("Tem certeza de que deseja cancelar o convite?");' href="/public/convite-recusar/<?php echo $convite['ClienteConvite']['token']; ?>"><i class="icon-remove"></i> Cancelar convite</a>
					</td>
						
					<?php endif ?>

					
				</tr>
				<?php
				}
				?>
			</table>
		</div>
	</div>
	<?php
	}
	?>
</div>
