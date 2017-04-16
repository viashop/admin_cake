<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/listar"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
		<li><span>Remover produto</span></li>
	</ul>
</div>

<form class="horizontal-form" action="<?php echo Router::url(); ?>" method="post">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Removendo produto</h3>
        </div>
        <div class="box-content">
            <?php
			$total = count($res_produto);

			if ($total > 1) {
				echo 'Deseja realmente remover os produtos?' . PHP_EOL;
			} else {
				echo 'Deseja realmente remover o produto' . PHP_EOL;
			}
			?>
			
			<ol>
				<?php
				foreach ($res_produto as $key => $produto) {

					echo '<li>';
					if (!empty($produto['ShopProduto']['nome'])) {
						echo '<strong>'. $produto['ShopProduto']['nome'] .'</strong>'. PHP_EOL;
					} else {
						echo '<strong>None</strong>'. PHP_EOL;
					}

					echo '</li>';

					
					echo '<input type="hidden" name="produtos[]" value="'. $produto['ShopProduto']['id_produto'] .'" />' . PHP_EOL;
				}
				?>
				
			</ol>
			<input type="hidden" name="confirmacao" value="true" />
        </div> 

        <div class="form-actions">
            <button type="submit" class="btn btn-danger" id="processando"><i class="glyphicon glyphicon-ok"></i> 
                <?php
				if ($total > 1) {
					echo 'Remover produtos' . PHP_EOL;
				} else {
					echo 'Remover produto' . PHP_EOL;
				}
				?>
                </button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/lixeira" class="btn btn-default"> <span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>

    </div>
</form>