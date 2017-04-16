<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/conta/uso"><i class="icon-charging icon-custom"></i> Meu plano</a> <span class="bread-separator">-</span></li>
		<li><span>Assinar plano</span></li>
	</ul>
</div>
<div class="row">
	<div class="box assinar-plano">
		<div class="box-header">
			<h3 class="pull-left">
				Alteração de plano
			</h3>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<div class="span8">
					<h3 class="titulo-plano">
						<small>Você está assinando o</small>
						Plano <?php echo $plano['PlanoShop']['id_plano']; ?>
					</h3>
					<ul class="sobre-plano">
						<li><i class="icon-check icon-big icon-custom"></i><span><?php 

						if ($plano['PlanoShop']['produtos'] =='ilimitado') {
							echo 'Produtos ilimitados';
						} else {
							echo  \Lib\Tools::formatTotal( $plano['PlanoShop']['produtos'] );
							echo ' produtos';
						}

						?> </span></li>
						<li><i class="icon-check icon-big icon-custom"></i><span><?php

						if ($plano['PlanoShop']['visitas'] =='ilimitado') {
							echo 'Visitas ilimitadas';
						} else {
							echo  \Lib\Tools::formatTotal( $plano['PlanoShop']['visitas'] );
							echo ' visitas';
						}	

						?></span></li>
						<li><i class="icon-check icon-big icon-custom"></i><span><?php


						if ($plano['PlanoShop']['trafego'] =='ilimitado') {
							echo 'Tráfego ilimitado';
						} else {
							echo  \Lib\Tools::formatTotal( $plano['PlanoShop']['trafego'] );
							echo ' GB tráfego';
						}

						?></span></li>
						<li><i class="icon-check icon-big icon-custom"></i><span>Page views ilimitados</span></li>
						<li><i class="icon-check icon-big icon-custom"></i><span><?php echo $plano['PlanoShop']['comissao']; ?>% Comissão sobre vendas</span></li>
					</ul>
				</div>
				<div class="span4">
					<div class="box-assinar pull-right">
						<h4><i class="icon-charging icon-big icon-white icon-custom"></i>Seu Pedido</h4>
						<div class="inner">
							<p>Valor da mensalidade com vigência de <b><?php 

								echo $data_mes_inicial; 
								echo ' até ';
								echo $data_mes_final;

							 ?></b> </p>
							<p>Após o pagamento deste valor o vencimento da sua fatura mensal será no dia <b><?php echo $data_d; ?> nos meses subsequentes.</b> </p>
						</div>
						<span class="valor-total">
						<span>Valor total:</span>
						<strong>R$ <?php echo \Lib\Tools::convertToDecimalBR($plano['PlanoShop']['valor']); ?></strong>
						</span>
					</div>
				</div>
			</div>
			<hr/>
			<form action="" method="post">
				<div class="actions text-align-right">
					<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
					<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
					<a href="<?php echo VIALOJA_PAINEL ?>/conta/cobranca" class="btn"><i class="icon-remove"></i> Cancelar</a>
					<button type="submit" class="btn btn-primary btn-big"><i class="icon icon-white icon-ok"></i> Gerar boleto para pagamento</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /Full width content box -->