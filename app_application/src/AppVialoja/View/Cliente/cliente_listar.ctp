<script type="text/javascript">
	$(document).ready(function(){
		$('#field_cpf').mask('99999999999999');
	});
</script>
<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/cliente/listar"><i class="icon-user icon-custom"></i>Clientes</a> <span class="bread-separator">-</span></li>
		<li><span>Listar clientes</span></li>
	</ul>
</div>
<div class="box clean" id="filtrar-pedido" style="overflow: visible;" >
	<form action="/admin/cliente/busca/listar" method="get">
		<div class="box-content form-horizontal">
			<fieldset class="filtro-busca">
				<div class="input-append">
					<input type="text" id="q" name="q" value="" class="span6" style="border-radius: 4px;" />
					<div class="btn-group">
						<button class="btn dropdown-toggle" data-toggle="dropdown" tabindex="-1" type="button">
						<span class="caret"></span>
						</button>
						<div class="dropdown-menu">
							<div class="control-group"><label for="field_nome">Nome </label><input type="text" id="field_nome" name="nome" value="" class="span4" /></div>
							<div class="control-group"><label for="field_email">Email </label><input type="text" id="field_email" name="email" value="" class="span4" /></div>
							<div class="control-group"><label for="field_cpf">CPF/CNPJ </label><input type="text" id="field_cpf" name="cpf" value="" class="span4" /></div>
							<div class="control-group">
								<label for="field_dt_de">Cadastrado em  </label>
								<input type="text" id="field_dt_de" name="dt_de" value="" class="span2 datepicker" data-date-format="dd/mm/yyyy" /><label for="field_dt_de" class="add-on"><i class="icon-calendar"></i></label>
								<label for="field_dt_ate" class="text-center">até</label>
								<input type="text" id="field_dt_ate" name="dt_ate" value="" class="span2 datepicker" data-date-format="dd/mm/yyyy" style="margin-right: 0;" /><label for="field_dt_ate" class="add-on last"><i class="icon-calendar"></i></label>
							</div>
							<div class="control-group">
								<label for="id_aniversario">Aniversário</label>
								<select name="aniversario" id="id_aniversario">
									<option value=""> - </option>
									<option value="hoje" >Hoje</option>
									<option value="1" >Janeiro</option>
									<option value="2" >Fevereiro</option>
									<option value="3" >Março</option>
									<option value="4" >Abril</option>
									<option value="5" >Maio</option>
									<option value="6" >Junho</option>
									<option value="7" >Julho</option>
									<option value="8" >Agosto</option>
									<option value="9" >Setembro</option>
									<option value="10" >Outubro</option>
									<option value="11" >Novembro</option>
									<option value="11" >Dezembro</option>
								</select>
							</div>
							<div class="actions"><button type="submit" class="btn btn-primary right">&nbsp;<i class="icon-search icon-white"></i>&nbsp;</button></div>
						</div>
					</div>
				</div>
				<input type='hidden' name='csrfmiddlewaretoken' value='qLTCDREldrgOeB1lAdJ5HURZb4dG8tW4' />
				<span class="action"><button type="submit" class="btn btn-primary right"><i class="icon-search icon-white"></i> Buscar</button></span>
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

<div class="row">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">
				<?php
				$total = $this->Paginator->counter(array('format' => '%count%'));

				if ($total ==1) {
					echo $this->Paginator->counter(array(
					        'format' => '%count% cliente no total - <small>Página %page% de %pages%</small>'
					));
				} else {
					echo $this->Paginator->counter(array(
					        'format' => '%count% clientes no total - <small>Página %page% de %pages%</small>'
					));
				}
				?>
			</h3>
			<div class="box-widget pull-right">
				<a href="<?php echo VIALOJA_PAINEL ?>/cliente/grupo/listar" class="btn btn-link" style="font-size: 13px; margin: 4px -10px 0 0;">Gerenciar grupos</a>
			</div>
		</div>
		<div class="box-content  table-content">
			<table class="table table-generic-list table-cliente">

				<?php

				if (count($clientes) <=0) {
					echo '<tr>
						<td width="1px"></td>
						<td colspan="2">
							Cliente não encontrado!
						</td>
						<td>
						</td>
					</tr>';
				}

				foreach ($clientes as $key => $cliente) {
				?>

				<tr>
					<td width="1px"></td>
					<td class="nome">
						<a href="<?php echo VIALOJA_PAINEL ?>/cliente/detalhar/<?php echo $cliente['Cliente']['id_cliente'];?>" target="_self" title="Editar cliente">
						<?php
						echo $cliente['Cliente']['nome'];
						?>
						</a>
					</td>
					<td class="email">
						<a href="<?php echo VIALOJA_PAINEL ?>/cliente/detalhar/<?php echo $cliente['Cliente']['id_cliente'];?>" target="_self" title="Editar cliente">
						<?php
						echo $cliente['Cliente']['email'];
						?>
						</a>
					</td>
					<td>
					</td>
				</tr>

				<?php
				}
				?>
			</table>
		</div>
	</div>

	<?php
	if ($total > $limite) {
	?>
	<div class="span8">
		<div class="pagination pagination-sm no-margin pull-right" style="margin: 0">
			<ul>
				<?php 
                    echo $this->Paginator->numbers( array( 'modulus' => '2', 'tag' => 'li', 'first'=>'Início', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a', 'last'=>'Último'  ) );
                ?>
			</ul>
		</div>
	</div>
	<?php
	}
	?>
</div>
