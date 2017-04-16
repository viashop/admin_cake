<script type="text/javascript">
	$(document).ready(function() {

		$('.submit_form').click(function(event) {
			event.preventDefault();
			var action_url = $(this).data('action-url');
			var form_pai = $(this).parents('form');
			form_pai.attr('action', action_url);
			if ($(this).hasClass('new_window')) {
				form_pai.attr('target', '_blank');
			} else {
				form_pai.attr('target', '_self');
			}
			form_pai.submit();
		});
		$('.data-inicio').datepicker({format: 'dd/mm/yyyy'});
		$('.data-fim').datepicker({format: 'dd/mm/yyyy'});
	});
</script>
<style type="text/css">
	.form-horizontal .control-label { width: 225px; }
	.form-horizontal .controls { margin-left: 235px; }
	.btn.btn-small.dropdown-toggle { height: 26px; }
	.btn.btn-small.dropdown-toggle .caret { margin-top: 2px; }
	#relatorio { padding-bottom:50px;  }
</style>

<div class="box" id="por_data">
	<div class="box-header">
		<h3>
			Relatório disponíveis
		</h3>
	</div>
	<div class="box-content" id="relatorio">
		<form action="/admin/relatorio/vendas/por_data" method="POST" class="form-horizontal">
			<div class="control-group">
				<label for="timedelta01" class="control-label">
				Relatório de vendas
				</label>
				<div class="controls">
					<select name="timedelta" id="timedelta01" class="span3">
						<option value="7">Últimos 7 dias</option>
						<option value="15">Últimos 15 dias</option>
						<option value="30">Últimos 30 dias</option>
						<option value="30">Últimos 60 dias</option>
						<option value="90">Últimos 90 dias</option>
					</select>
					<div class="btn-group help-inline">
						<button data-action-url="/admin/relatorio/vendas/por_data" class="btn btn-small submit_form new_window">Visualizar</button>
						<button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a href="#" data-action-url="/admin/relatorio/vendas/por_data" class="submit_form new_window" >
								<i class="icon-eye-open"></i>
								Visualizar dados
								</a>
							</li>
							<li>
								<a href="#" data-action-url="/admin/relatorio/vendas/por_data/baixar" class="submit_form" >
								<i class="icon-download"></i>
								Baixar dados
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<input type='hidden' name='csrfmiddlewaretoken' value='qLTCDREldrgOeB1lAdJ5HURZb4dG8tW4' />
		</form>
		<form action="#" method="POST" class="form-horizontal" >
			<div class="control-group">
				<label for="timedelta02" class="control-label">
				Relatorio de produtos mais vendidos
				</label>
				<div class="controls">
					<select name="timedelta" id="timedelta02" class="span3">
						<option value="30">Último 30 dias</option>
						<option value="60">Últimos 60 dias</option>
						<option value="90">Últimos 90 dias</option>
					</select>
					<div class="btn-group help-inline">
						<button data-action-url="/admin/relatorio/vendas/por_produto" class="btn btn-small submit_form new_window">Visualizar</button>
						<button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a href="#" data-action-url="/admin/relatorio/vendas/por_produto" class="submit_form new_window">
								<i class="icon-eye-open"></i>
								Visualizar dados
								</a>
							</li>
							<li>
								<a href="#" data-action-url="/admin/relatorio/vendas/por_produto/baixar" class="submit_form">
								<i class="icon-download"></i>
								Baixar dados
								</a>
							</li>
						</ul>

					</div>
				</div>
			</div>

			<input type='hidden' name='csrfmiddlewaretoken' value='qLTCDREldrgOeB1lAdJ5HURZb4dG8tW4' />
		</form>
	</div>
	<div class="box-footer"></div>
</div>