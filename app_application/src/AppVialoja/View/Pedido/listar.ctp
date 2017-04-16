<script type="text/javascript">
	$(document).ready(function(){
		$('#show-filtrar-pedido').click(function() {
			$('#filtrar-pedido').slideToggle();
		});
	});
</script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><i class="icon-dollar icon-custom"></i><a href="<?php echo VIALOJA_PAINEL ?>/pedido/listar">Vendas</a> <span class="bread-separator">-</span></li>
		<li><span>Listar vendas</span></li>
	</ul>
</div>
<div class="row">
	<div class="box" id="filtrar-pedido" style="overflow: visible;">
		<form action="/admin/pedido/listar" method="get" class="form-vertical">
			<div class="box-header">
				<h3 class="pull-left">Filtrar pedidos</h3>
			</div>
			<div class="box-content form-horizontal">
				<fieldset class="filtro-busca">
					<div class="input-append">
						<input type="text" id="q" name="q" value="" class="span6" />
						<div class="btn-group">
							<button class="btn dropdown-toggle" data-toggle="dropdown" tabindex="-1" type="button">
							<span class="caret"></span>
							</button>
							<div class="dropdown-menu">
								<div class="control-group"><label for="pedido_numero">Número </label><input type="text" id="pedido_numero" name="pedido_numero" value="" class="span4" /></div>
								<div class="control-group">
									<label for="data_criacao">Data do pedido</label>
									<input type="text" id="data_inicio" name="data_inicio" value=""  class="span2 datepicker" data-date="" data-date-format="dd/mm/yyyy" /><label for="data_criacao" class="add-on"><i class="icon-calendar"></i></label> 
									<label for="data_criacao_ate" class="text-center">até</label>
									<input type="text" id="data_fim" name="data_fim" value="02/04/2014" class="span2 datepicker" data-date-format="dd/mm/yyyy" style="margin-right: 0;" /><label for="data_fim" class="add-on last"><i class="icon-calendar"></i></label>
								</div>
								<div class="control-group"><label for="email">Email </label><input type="text" id="email" name="email" value="" class="span4" /></div>
								<div class="control-group">
									<label for="situacao">Situação </label>
									<select name="situacao" id="situacao">
										<option value="" selected="selected">--</option>
										<option value="2" >Aguardando Pagamento</option>
										<option value="7" >Pagamento devolvido</option>
										<option value="3" >Pagamento em análise</option>
										<option value="6" >Pagamento em disputa</option>
										<option value="8" >Pedido cancelado</option>
										<option value="9" >Pedido efetuado</option>
										<option value="15" >Pedido em separação</option>
										<option value="14" >Pedido entregue</option>
										<option value="11" >Pedido enviado</option>
										<option value="4" >Pedido pago</option>
										<option value="13" >Pronto para retirada</option>
									</select>
								</div>
								<div class="control-group">
									<label for="forma_pagamento">Pagamento </label>
									<select name="forma_pagamento" id="forma_pagamento">
										<option value=""  selected="selected">--</option>
										<option  value="2">Bcash</option>
										<option  value="8">Boleto Bancário</option>
										<option  value="7">Depósito Bancário</option>
										<option  value="4">MercadoPago</option>
										<option  value="1">PagSeguro</option>
										<option  value="3">PayPal</option>
									</select>
								</div>
								<div class="control-group">
									<label for="id_cep">CEP </label>
									<input type="text" id="id_cep" name="cep" style="width:65px" value="" />
								</div>
								<div class="control-group">
									<label for="id_cep">Rastreamento </label>
									<input type="text" id="id_codigo_rastreio" name="codigo_rastreio" value="" />
								</div>
								<div class="actions"><button type="submit" class="btn btn-primary right">&nbsp;<i class="icon-search icon-white"></i>&nbsp;</button></div>
							</div>
						</div>
					</div>
					<input type='hidden' name='csrfmiddlewaretoken' value='IL8W9qyXSUrpjhqWKr27D0ktniJITbpN' />
					<span class="action">
					<button type="submit" class="btn btn-primary right"><i class="icon-search icon-white"></i> Buscar</button>
					</span>
					<script>
						$(function() {
							// Fix input element click problem
							$('.dropdown-menu').click(function(e) {
								e.stopPropagation();
							});
						});
					</script>
				</fieldset>
			</div>
		</form>
	</div>
	<div class="box" style="overflow: visible;">
		<div class="box-header">
			<h3 class="pull-left">
				Listando 1 pedido <small style="margin-left: 10px;">Página 1 de 1</small>
			</h3>
		</div>
		<div class="box-content table-content">
			<table class="table table-generic-list table-striped table-hover">
				<tr>
					<th width="30" style="padding-left: 15px;">#</th>
					<th width="90">Status</th>
					<th>Data</th>
					<th width="190">Cliente</th>
					<th width="110">Pagamento</th>
					<th>Envio</th>
					<th>Total</th>
					<th width="100">&nbsp;</th>
				</tr>
				<tr>
					<td style="padding-left: 15px;"><a href="<?php echo VIALOJA_PAINEL ?>/pedido/detalhar/1">1</a></td>
					<td>
						<span class="label label-success" >
						Em Separação
						</span>
					</td>
					<td>31/12/13 02:11</td>
					<td>adas</td>
					<td>
						Bcash
					</td>
					<td>
						<span>SEDEX</span>
					</td>
					<td class="text-success" style="white-space: nowrap;"><strong>
						R$ 615,39
						</strong>
					</td>
					<td>
						<div class="btn-group pull-right">
							<a href="<?php echo VIALOJA_PAINEL ?>/pedido/detalhar/1" title="Detalhar pedido" class="btn btn-mini">Ver pedido</a>
							<a href="javascript:;" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>&nbsp;
							</a>
							<ul class="dropdown-menu pull-right">

								<li><a href="<?php echo VIALOJA_PAINEL ?>/pedido/detalhar/1" title="Visualizar pedido" target="_blank">Visualizar pedido</a></li>
								<li><a href="<?php echo VIALOJA_PAINEL ?>/pedido/imprimir/1" title="Imprimir pedido" target="_blank">Imprimir pedido</a></li>
							</ul>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>