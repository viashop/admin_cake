<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><i class="icon icon-tag"></i> <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/marca/listar">Marca</a> <span class="bread-separator">-</span></li>
		<li><span>Remover marca</span></li>
	</ul>
</div>

<form class="horizontal-form" action="<?php echo Router::url(); ?>" method="post">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Removendo marca</h3>
        </div>
        <div class="box-content">
            <?php
			$total = count($res_marca);

			if ($total > 1) {
				echo 'Deseja realmente remover as marcas?' . PHP_EOL;
			} else {
				echo 'Deseja realmente remover a marca?' . PHP_EOL;
			}
			?>
			
			<ol>
				<?php
				foreach ($res_marca as $key => $marca) {
					echo '<li><strong>'. $marca['ShopMarca']['nome'] .'</strong></li>'. PHP_EOL;
					echo '<input type="hidden" name="marcas[]" value="'. $marca['ShopMarca']['id_marca'] .'" />' . PHP_EOL;
				}
				?>
				
			</ol>
			<input type="hidden" name="confirmacao" value="true" />
        </div> 

        <div class="form-actions">
            <button type="submit" class="btn btn-danger" id="processando"><i class="glyphicon glyphicon-ok"></i> 
                <?php
				if ($total > 1) {
					echo 'Remover marcas' . PHP_EOL;
				} else {
					echo 'Remover marca' . PHP_EOL;
				}
				?>
                </button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/marca/listar" class="btn btn-default"> <span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>
    </div>
</form>