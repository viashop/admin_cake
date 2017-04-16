<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/cliente/listar"><i class="icon-user icon-custom"></i>Clientes</a><span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/cliente/grupo/listar"><i class="icon-user icon-custom"></i>Grupos</a><span class="bread-separator">-</span></li>
		<li><span>Remover grupo</span></li>
	</ul>
</div>

<form class="horizontal-form" action="<?php echo Router::url(); ?>" method="post">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Removendo grupo</h3>
        </div>
        <div class="box-content">
            <?php
			$total = count($res_grupo);

			if ($total > 1) {
				echo 'Deseja realmente remover as grupos?' . PHP_EOL;
			} else {
				echo 'Deseja realmente remover a grupo?' . PHP_EOL;
			}
			?>
			
			<ol>
				<?php
				foreach ($res_grupo as $key => $grupo) {
					echo '<li><strong>'. $grupo['ClienteShopGrupo']['nome'] .'</strong></li>'. PHP_EOL;
					echo '<input type="hidden" name="grupos[]" value="'. $grupo['ClienteShopGrupo']['id_grupo'] .'" />' . PHP_EOL;
				}
				?>
				
			</ol>
			<input type="hidden" name="confirmacao" value="true" />
        </div> 

        <div class="form-actions">
            <button type="submit" class="btn btn-danger" id="processando"><i class="glyphicon glyphicon-ok"></i> 
                <?php
				if ($total > 1) {
					echo 'Remover grupos' . PHP_EOL;
				} else {
					echo 'Remover grupo' . PHP_EOL;
				}
				?>
                </button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/cliente/grupo/listar" class="btn btn-default"> <span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>

    </div>
</form>