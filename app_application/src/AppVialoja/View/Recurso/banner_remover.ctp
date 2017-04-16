<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/listar"><i class="icon-th-large"></i> Banners</a> <span class="bread-separator">-</span></li>
		<li><span>Remover banner</span></li>
	</ul>
</div>

<form class="horizontal-form" action="<?php echo Router::url(); ?>" method="post">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Removendo banner</h3>
        </div>
        <div class="box-content">
            <?php
			$total = count($res_banner);

			if ($total > 1) {
				echo 'Deseja realmente remover os banners?' . PHP_EOL;
			} else {
				echo 'Deseja realmente remover os banner?' . PHP_EOL;
			}
			?>
			
			<ol>
				<?php
				foreach ($res_banner as $key => $banner) {
					echo '<li><strong>'. $banner['ShopBanner']['nome'] .'</strong></li>'. PHP_EOL;
					echo '<input type="hidden" name="banners[]" value="'. $banner['ShopBanner']['id_banner'] .'" />' . PHP_EOL;
				}
				?>
				
			</ol>
			<input type="hidden" name="confirmacao" value="true" />
        </div> 

        <div class="form-actions">
            <button type="submit" class="btn btn-danger" id="processando"><i class="glyphicon glyphicon-ok"></i> 
                <?php
				if ($total > 1) {
					echo 'Remover banners' . PHP_EOL;
				} else {
					echo 'Remover banner' . PHP_EOL;
				}
				?>
                </button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/listar" class="btn btn-default"> <span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>

    </div>
</form>