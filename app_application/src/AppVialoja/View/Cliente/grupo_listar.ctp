<script type="text/javascript">
	$(document).ready(function(){
		$('#field_cpf').mask('99999999999999');
	});
</script>

<?php
if (isset($flash_grupo_nome) && !empty($flash_grupo_nome)) {
    foreach ($flash_grupo_nome as $key => $value) {
       echo '<div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <h4>Grupo "'. $value .'" removido com sucesso!</h4>
        </div>';
    }
}
?>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/cliente/listar"><i class="icon-user icon-custom"></i>Clientes</a><span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/cliente/grupo/listar"><i class="icon-user icon-custom"></i>Grupos</a><span class="bread-separator">-</span></li>
		<li><span>Listar grupos</span></li>
	</ul>
</div>
<form action="/admin/cliente/grupo/remover" method="post">
	<div class="row">
		<div class="box">
			<div class="box-header">
				<span class="check-container pull-left">
				<input type="checkbox" class="select_all" rel=".table">
				</span>
				<h3 class="pull-left">
					<?php
					$total = $this->Paginator->counter(array('format' => '%count%'));

					echo $total+1;
					if ($total==0) {
						echo ' grupo';
					} else {
						echo ' grupos';
					}
					?>
				</h3>
				<div class="box-widget pull-right">
					<a href="<?php echo VIALOJA_PAINEL ?>/cliente/grupo/criar" class="btn btn-small btn-primary"><i class="icon-white icon-plus"></i> Criar grupo</a>
				</div>
			</div>
			<div class="box-content table-content">
				<table class="table table-generic-list table-grupo">
					<?php
					foreach ($grupos as $key => $grupo) {
					?>
					<tr>
						<td class="check_box">
							<input type="checkbox" name="grupos[]" value="<?php echo $grupo['ClienteShopGrupo']['id_grupo']; ?>" />
						</td>
						<td class="nome">
							<a href="<?php echo VIALOJA_PAINEL ?>/cliente/grupo/editar/<?php echo $grupo['ClienteShopGrupo']['id_grupo']; ?>" target="_self" title="Editar grupo" class="title">
							<?php echo $grupo['ClienteShopGrupo']['nome']; ?>
							</a>
						</td>
						<td class="ativo">
							<?php

							$total_cliente = $this->requestAction(array(
					            'controller' => 'ShopGrupos',
					            'action' => 'totalClienteGrupo',
					            'id' => $grupo['ClienteShopGrupo']['id_grupo']
					        ));

							if ($total_cliente <= 0) {
								echo '-';								
							} elseif ($total_cliente == 1) {
								echo $total_cliente . ' cliente';
							} else {
								echo $total_cliente . ' clientes';
							}

							?>
						</td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td class="check_box">
						</td>
						<td class="nome">
							Padrão
						</td>
						<td class="ativo">
							<span class="label label-success">Padrão</span>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
		<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
		<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Remover selecionados</button>
	</div>
</form>

<?php
if ($total > $limite) {
?>
<div class="span8">
	<div class="pagination pagination-sm no-margin pull-right" style="margin: 0">
		<ul>
			<?php 
                echo $this->Paginator->numbers( array( 'modulus' => '2', 'tag' => 'li', 'first'=>'Início', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a', 'last'=>'Último'  ) );
            ?>
		</ul>
	</div>
</div>
<?php
}
?>