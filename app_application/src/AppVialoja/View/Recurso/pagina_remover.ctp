<form class="horizontal-form" action="<?php echo Router::url(); ?>" method="post">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Removendo página</h3>
        </div>
        <div class="box-content">
            <p>
        	<?php
				$total = count($res_pagina);

				if ($total > 1) {
					echo 'Deseja realmente remover as paginas?' . PHP_EOL;
				} else {
					echo 'Deseja realmente remover a pagina?' . PHP_EOL;
				}
				?>
			</p>
            <ul>
			<?php
			foreach ($res_pagina as $key => $pagina) {
				echo '<li><strong>'. $pagina['ShopPagina']['titulo'] .'</strong></li>'. PHP_EOL;
				echo '<input type="hidden" name="paginas[]" value="'. $pagina['ShopPagina']['id_pagina'] .'" />' . PHP_EOL;
			}
			?>				
			</ul>
			<input type="hidden" name="confirmacao" value="true" />
        </div>

        <div class="form-actions">
			<button type="submit" class="btn btn-danger" id="processando"><i class="glyphicon glyphicon-ok"></i> 
				<?php
				if ($total > 1) {
					echo 'Remover paginas' . PHP_EOL;
				} else {
					echo 'Remover pagina' . PHP_EOL;
				}
				?>
				</button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/recurso/pagina/listar" class="btn btn-default"> Cancelar</a>
			<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
		</div>

    </div>
</form>
