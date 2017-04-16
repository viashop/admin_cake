<?php
foreach ($res_fatura as $key => $fatura);
?>
<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar"><i class="icon-briefcase"></i> Minha loja</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/conta/uso"><i class="icon-charging icon-custom"></i> Meu plano</a> <span class="bread-separator">-</span></li>
		<li><span>Pagar uma cobrança</span></li>
	</ul>
</div>
<div class="row">
	<form action="<?php echo Router::url(); ?>" method="post">
		<div class="box">
			<div class="box-header">
				<h3>Pagar cobrança</h3>
			</div>
			<div class="box-content">
				<div class="row-fluid">
					<div class="span9">
						<p>
							Identificador único da cobrança: <strong><?php echo $fatura['ShopFatura']['id_fatura'];?></strong><br/>
							Número de referência da cobrança: <strong><?php echo $fatura['ShopFatura']['referencia'];?></strong>
						</p>
					</div>
					<div class="span3">
						<p class="text-align-right">
							<small style="line-height: 1.2em;">
							Caso queira cancelar esta cobrança <br/>
							para emitir outra, use o botão abaixo:
							</small>
							<a style="margin-top: 10px" href="/admin/conta/cancelar/<?php echo $fatura['ShopFatura']['id_fatura'];?>" class="btn btn-small btn-danger"><i class="icon-white icon-remove"></i> Cancelar cobrança</a>
						</p>
					</div>
				</div>
				<hr/>
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th width="30%"><small>Descrição</small></th>
							<th><small>Data de referência</small></th>
							<th><small>Processamento</small></th>
							<th class="text-align-right"><small>Desconto</small></th>
							<th class="text-align-right"><small>Valor</small></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1.</td>
							<td>Plano <?php echo $fatura['ShopFatura']['id_plano'];?></td>
							<td>de <?php 
                                    echo \Lib\Tools::formatToDate( $fatura['ShopFatura']['data_mes_inicial'] );
                                    ?> até <?php 
                                    echo \Lib\Tools::formatToDate($fatura['ShopFatura']['data_mes_final']);
                                    ?></td>
							<td><?php 
                                    echo \Lib\Tools::formatToDate( $fatura['ShopFatura']['created'] );
                                    ?></td>
							<td class="text-align-right"><?php 

                                    if (isset($fatura['ShopFatura']['desconto']) 
                                        && !empty($fatura['ShopFatura']['desconto'])) {
                                        echo 'R$ ' . \Lib\Tools::convertToDecimalBR($fatura['ShopFatura']['desconto']);
                                    } else {
                                        echo '-';
                                    }
                                    ?></td>
							<td class="text-align-right">R$ <?php 

                                    if (isset($fatura['ShopFatura']['valor']) 
                                        && !empty($fatura['ShopFatura']['valor'])) {
                                        echo \Lib\Tools::convertToDecimalBR($fatura['ShopFatura']['valor']);
                                    } else {
                                        echo '-';
                                    }
                                    ?></td>
						</tr>
					</tbody>
				</table>
				<h3 class="pull-right" style="margin-top: -20px">
					<small>Valor total:</small> R$ <?php 

					$valor_total = $fatura['ShopFatura']['valor'];
					if (isset($fatura['ShopFatura']['desconto'])) {
						$valor_total = ($fatura['ShopFatura']['valor'] - $fatura['ShopFatura']['desconto']);
					}

					echo \Lib\Tools::convertToDecimalBR($valor_total);

					?>
				</h3>
				<div class="clear"></div>
				<hr/>
				<div class="text-align-center">
					<p>
						<a href="http://boleto.vialoja.com.br/?b=<?php echo $fatura['ShopFatura']['token']; ?>" class="btn btn-large btn-primary" target="_new"><i class="icon-print icon-white"></i> Imprimir boleto</a>

						<img src="/admin/img/formas-de-pagamento/pagseguro-pagamento.jpg">
					</p>
					<p><small>A compensação do Boleto bancário pode demorar até 3 dias úteis.</small></p>
				</div>
				<iframe src="http://boleto.vialoja.com.br/?b=<?php echo $fatura['ShopFatura']['token']; ?>" frameborder="0" width="100%" height="900px" style="border: 5px solid #EEE; padding: 20px; width: 830px;"></iframe>
			</div>
		</div>
	</form>
	<!-- /Full width content box -->
</div>