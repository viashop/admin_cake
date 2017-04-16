<div class="alert alert-success">
	<a class="close" data-dismiss="alert">×</a>
	<h4>O código de rastreamento foi adicionado e o pedido foi marcado como enviado.</h4>
</div>
<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><i class="icon-dollar icon-custom"></i><a href="<?php echo VIALOJA_PAINEL ?>/pedido/listar">Vendas</a> <span class="bread-separator">-</span></li>
		<li><span>Detalhar venda</span></li>
	</ul>
</div>
<div class="row">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">Pedido de venda <strong>#1</strong></h3>
			<div class="pull-right">
				<h3>Criado em <strong>31/12/2013 02:11</strong></h3>
			</div>
		</div>
		<div class="box-content">
			<div class="row">
				<div class="well" style="width: 70%; float: left;">
					<form action="/admin/pedido/alterar_situacao/1" method="post" class="form-horizontal">
						<strong>Situação do pedido:</strong> &nbsp; &nbsp;
						<select name="situacao_id" class="input-large">
							<option value="2" >Aguardando Pagamento</option>
							<option value="7" >Pagamento devolvido</option>
							<option value="3" >Pagamento em análise</option>
							<option value="6" >Pagamento em disputa</option>
							<option value="8" >Pedido cancelado</option>
							<option value="9" >Pedido efetuado</option>
							<option value="15" >Pedido em separação</option>
							<option value="14" >Pedido entregue</option>
							<option value="11" selected="selected">Pedido enviado</option>
							<option value="4" >Pedido pago</option>
							<option value="13" >Pronto para retirada</option>
						</select>
						&nbsp;
						<input class="btn" type="submit" value="Alterar" />
						<input type='hidden' name='csrfmiddlewaretoken' value='IL8W9qyXSUrpjhqWKr27D0ktniJITbpN' />
					</form>
				</div>
				<div class="well pull-right">
					<a href="<?php echo VIALOJA_PAINEL ?>/pedido/imprimir/1" title="Impressão de pedido" class="btn btn-small btn-primary" target="_blank"><i class="icon-print icon-white"></i> Imprimir pedido</a>
				</div>
			</div>
			<!--
				<div class="situacao-pedido">
					<div class="situacao-pedido-aguardando active">Aguardando pagamento</div>
					<div class="situacao-pedido-aguardando">Pago</div>
					<div class="situacao-pedido-aguardando">Enviado</div>
				</div>
				-->
			<div class="row">
				<div style="width: 48.8%; float: left;">
					<div class="well form-horizontal" style="min-height: 32px">
						<div style="float: left; width: 90px; margin-right: 15px; margin-top: -8px; padding-right: 15px;border-right: 1px solid #DDD">
							<h6 style="font-size: 10px; margin: -2px 0 3px;">Pagamento via</h6>
							<img src="/admin/img/formas-de-pagamento/pagamento_digital-logo.png" />
						</div>
						<div style="padding-top: 5px">
							<b>Id da transação:</b>
							--
						</div>
					</div>
				</div>
				<div style="width: 48.8%; float: right;">
					<form action="/admin/pedido/envio_editar/1" method="post">
						<div class="well form-horizontal" style="min-height: 32px">
							<div style="float: left; width: 90px; margin-right: 15px; margin-top: -8px; padding-right: 15px;border-right: 1px solid #DDD">
								<h6 style="font-size: 10px; margin: -2px 0 3px;">Envio via</h6>
								<img src="/admin/img/formas-de-envio/sedex-logo.png" alt="SEDEX" />
							</div>
							<b>Rastreamento:</b> &nbsp;
							<div style="display: inline-block; width: 155px">
								<input type="text" name="objeto" value="12345678912345678912345678912345" style="width: 100px" />
								<input type="hidden" name="pedido_envio_id" value="89257" />
								<button title="Salvar código de rastreamento." class="btn btn-primary" style="padding-left: 5px; padding-right: 5px;"><i class="icon-ok icon-white"></i></button>
							</div>
							<a target="_blank" href="http://websro.correios.com.br/sro_bin/txect01$.Inexistente?P_LINGUA=001&amp;P_TIPO=002&amp;P_COD_LIS=12345678912345678912345678912345">
							Ver nos correios
							</a>
							<input type='hidden' name='csrfmiddlewaretoken' value='IL8W9qyXSUrpjhqWKr27D0ktniJITbpN' />
						</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div style="width: 48.8%; float: left;">
					<div class="well">
						<h3>Cliente <a href="cliente/detalhar/117354" class="btn btn-mini btn-info right">Ver detalhes do cliente</a></h3>
						<ul style="margin: 10px 0 20px 0">
							<h4>adas</h4>
							<li>Tipo de cliente: <strong>Padrão</strong></li>
							<li>CPF: <strong>336.578.592-25</strong></li>
							<li>RG: <strong></strong></li>
							<li>E-mail: <strong>wsduarte@outlook.com.br</strong></li>
							Telefone celular: <strong>(65) 9999-6966</strong><br/>
							Telefone residencial: <strong>-</strong><br/>
							Telefone comercial: <strong>-</strong><br/>
						</ul>
						<h4>Endereço de entrega e pagamento</h4>
						<p>
						<h4>Adas</h4>
						Sfsdaf Fsadf  Fsdafsd,
						631
						<br/>
						Centro -
						Diamantino /
						MT<br/>
						CEP: 78400000 - Brasil
						</p>
						<p>
						</p>
					</div>
				</div>
				<div style="width: 48.8%; float: right;">
					<div class="well">
						<h3>Produtos</h3>
						<table class="table">
							<tr>
								<th width="1%" style="white-space: nowrap;">Qtd.</th>
								<th>Nome</th>
								<th width="1%" style="white-space: nowrap;">Valor total</th>
							</tr>
							<tr>
								<td><span class="badge badge-info">1</span></td>
								<td>
									<div style="max-width: 64px; max-height: 64px; float: left; margin-right: 5px;">
										<img src="//cdn.awsli.com.br/31/produto/458249/i/0adaacadb1.jpg" alt="&#39;65 Super Reverb®" />
									</div>
									<strong>
									<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/editar/1150273">
									&#39;65 Super Reverb®
									</a>
									</strong><br/>
									<small>
									<span class="disp">Disponibilidade:
									<strong>
									Imediata
									</strong>
									</span>
									</small>
								</td>
								<td style="white-space: nowrap; text-align: right;">R$ 599,99</td>
							</tr>
							<tfoot>
								<tr>
									<td colspan="2" style="text-align: right;">
										<strong>Envio via SEDEX:</strong>
									</td>
									<td style="text-align: right;">
										R$ 15,40
									</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align: right;">
										<strong>Total:</strong>
									</td>
									<td style="text-align: right;">
										<strong>R$ 615,39</strong>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- .box-content -->
	</div>
	<!-- .box -->
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">Histórico do pedido</h3>
		</div>
		<div class="box-content table-generic-list">
			<table class="table">
				<thead>
					<tr>
						<th>Data</th>
						<th>Situação</th>
						<th>Alterado por</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>31/12/2013 02:11</td>
						<td>Pedido efetuado</td>
						<td>adas (cliente)</td>
					</tr>
					<tr>
						<td>06/01/2014 04:10</td>
						<td>Pedido cancelado</td>
						<td>Sistema (sistema)</td>
					</tr>
					<tr>
						<td>23/02/2014 18:18</td>
						<td>Pronto para retirada</td>
						<td>William Duarte (usuario)</td>
					</tr>
					<tr>
						<td>23/02/2014 18:19</td>
						<td>Pedido em separação</td>
						<td>William Duarte (usuario)</td>
					</tr>
					<tr>
						<td>03/04/2014 00:00</td>
						<td>Pagamento em análise</td>
						<td>William Duarte (usuario)</td>
					</tr>
					<tr>
						<td>03/04/2014 00:01</td>
						<td>Pedido enviado</td>
						<td>William Duarte (usuario)</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>