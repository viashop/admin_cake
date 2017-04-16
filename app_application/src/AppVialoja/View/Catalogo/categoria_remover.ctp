<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/listar"><i class="icon-th-large"></i> Organizar</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/listar"><i class="icon-bookmark"></i> Categorias</a> <span class="bread-separator">-</span></li>
		<li><span>Remover categoria</span></li>
	</ul>
</div>

<form class="horizontal-form" action="<?php echo Router::url(); ?>" method="post">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">Removendo categoria</h3>
		</div>
		<div class="box-content">
			<p>
				<?php
				$total = count($res_categoria);

				if ($total > 1) {
					echo 'Deseja realmente remover as categorias?' . PHP_EOL;
				} else {
					echo 'Deseja realmente remover a categoria?' . PHP_EOL;
				}
				?>
			</p>
			<ol>
				<?php
				foreach ($res_categoria as $key => $categoria) {
					echo '<li><strong>'. $categoria['ShopCategoria']['nome_categoria'] .'</strong></li>'. PHP_EOL;
					echo '<input type="hidden" name="categorias[]" value="'. $categoria['ShopCategoria']['id_categoria'] .'" />' . PHP_EOL;
				}
				?>
			</ol>
			<input type="hidden" name="confirmacao" value="true" />
		</div>


		<div class="form-actions">
			<button type="submit" class="btn btn-danger" id="processando"><i class="glyphicon glyphicon-ok"></i>
				<?php
				if ($total > 1) {
					echo 'Remover categorias' . PHP_EOL;
				} else {
					echo 'Remover categoria' . PHP_EOL;
				}
				?>
			</button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/listar" class="btn btn-default"> <span class="glyphicon glyphicon-remove"></span> Cancelar</a>
			<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
		</div>

	</div>
</form>
