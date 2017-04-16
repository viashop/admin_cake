
<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/cupom/listar"><i class="icon-dollar icon-custom"></i>Cupons de desconto</a> <span class="bread-separator">-</span></li>
        <li><span>Remover cupom</span></li>
    </ul>
</div>


<form class="horizontal-form" action="<?php echo Router::url(); ?>" method="post">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">Removendo cupom</h3>
		</div>
		<div class="box-content">

			<?php
			$total = count($res_cupom);

			if ($total > 1) {
				echo 'Deseja realmente remover os cupons?' . PHP_EOL;
			} else {
				echo 'Deseja realmente remover o cupom?' . PHP_EOL;
			}
			?>

			<ul>
				<?php

				foreach ($res_cupom as $key => $cupom) {
				?>
				<li>
					<p>
						<strong><?php echo $cupom['ShopCupomDesconto']['codigo']; ?></strong>
						<small class="muted">
						(<?php echo $cupom['ShopCupomDesconto']['descricao']; ?>)
						</small>
					</p>
				</li>
				<input type="hidden" name="cupons[]" value="<?php echo $cupom['ShopCupomDesconto']['id_cupom']; ?>" />
				<?php
				}
				?>
			</ul>
			<input type="hidden" name="confirmacao" value="true" />
		</div>

		<div class="form-actions">
            <button type="submit" class="btn btn-danger" id="processando"><i class="glyphicon glyphicon-ok"></i> 
                <?php
				if ($total > 1) {
					echo 'Remover cupons' . PHP_EOL;
				} else {
					echo 'Remover cupom' . PHP_EOL;
				}
				?>
                </button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/recurso/cupom/listar" class="btn btn-default"> <span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>

	</div>
</form>