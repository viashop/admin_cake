
<script type="text/javascript">
	$(document).ready(function(){
		$('#id_cep_inicio, #id_cep_fim').mask('99999-999');
		$('#id_cep_inicio, #id_cep_fim').change(function(event) {
			var inicio = $('#id_cep_inicio').val();
			var fim = $('#id_cep_fim').val();
			if (inicio && fim) {
				if (inicio > fim) {
					$('#id_cep_inicio, #id_cep_fim').parents('.control-group').addClass('error');
					alert('CEP inicial maior que o CEP final.')
				} else {
					$('#id_cep_inicio, #id_cep_fim').parents('.control-group').removeClass('error');
				}
			}
		});
	});
</script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar"><i class="icon-road"></i> Formas de envio</a> <span class="bread-separator">-</span></li>
		<li><span>Configuração de forma de envio</span></li>
	</ul>
</div>
<div class="row envio-motoboy-editar">

	<form action="<?php echo Router::url(); ?>" method="post">
        <div class="box">
            <div class="box-header">
                <h3 class="pull-left">Forma de envio Retirar Pessoalmente</h3>
            </div>
            <div class="box-content">
                <div class="form-horizontal">
                    <div class="form-horizontal">
						<div class="control-group ">
							<label class="control-label" for="id_ativo">Ativado</label>
							<div class="controls">
								<select class="input-small" id="id_ativo" name="ativo">
									 <option value="True" <?php if (!(strcmp("True", $envio_ativo))) { echo 'selected="selected"';} ?>>Sim</option>
                           			 <option value="False" <?php if (!(strcmp("False", $envio_ativo))) { echo 'selected="selected"';} ?>>Não</option>
								</select>
							</div>
						</div>
	
					</div>
                </div>

                <p class="alert alert-block alert-info">
                     Nos campos abaixo você deve informar qual é a faixa de CEP que a forma de envio Retirar pessoalmente irá atender. Você pode obter as faixas de CEP junto aos Correios <a href="http://www.buscacep.correios.com.br/" title="Procurar por faixas de cep" target="_blank">clicando aqui</a>. Para cidades pequenas que não exista um intervalo, apenas um CEP único, informe o mesmo CEP nos campos CEP inicial e CEP final. 
                </p>
                <h4>Adicionar faixa de CEP</h4>
                <div class="form-horizontal">
                    <div class="form-group ">
                        <label class="control-label span3" for="id_regiao">Região atendida</label>
                        <div class="span6">
                            <input class="form-control" id="id_regiao" name="regiao" placeholder="Ex.: São Paulo Capital" type="text" required  />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label span3" for="id_cep_inicio">CEP inicial</label>
                        <div class="span3">
                            <input class="form-control" id="id_cep_inicio" name="cep_inicio" type="text" required  />
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label span3" for="id_cep_fim">CEP final</label>
                        <div class="span3">
                            <input class="form-control" id="id_cep_fim" name="cep_fim" type="text" required  />
                        </div>
                    </div>
   

                </div>
            </div>
           	<div class="form-actions">
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />


				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Adicionar faixa</button>

				<!--<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>-->

				<a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
			</div>
        </div>
    </form>

    <?php
    if (isset($faixas) && count($faixas) > 0) {
	?>

	<form action="" method="post">
		<div class="box">
			<div class="box-header">
				<h3 class="pull-left">Faixas de CEP atendidas </h3>
			</div>
			<div class="box-content">
				
				<table class="table table-generic-list">
					<thead>
						<tr>
							<th>Cidade ou Região</th>
							<th>CEP inicial</th>
							<th>CEP final</th>
							<th class="col-xs-1">&nbsp;</th>
	
						</tr>
					</thead>
					<tbody>

						<?php
						foreach ($faixas as $key => $faixa) {
						?>
						<tr>
							<td><?php echo $faixa['ShopEnvioPessoalmente']['regiao']; ?></td>
							<td><?php echo $faixa['ShopEnvioPessoalmente']['cep_inicio']; ?></td>
							<td><?php echo $faixa['ShopEnvioPessoalmente']['cep_fim']; ?></td>

							<td>
								<?php
								/*
								?>
								<a class="btn btn-xs btn-default" href="/admin/configuracao/envio/<?php echo $faixa['ShopEnvioPessoalmente']['id_envio']; ?>/regiao/<?php echo $faixa['ShopEnvioPessoalmente']['id']; ?>/remover">
		                        <span class="glyphicon glyphicon-edit"></span> Editar
		                        </a>
		                        <?php
								*/
								?>
	

		                        <a class="btn btn-xs btn-danger btn-mini" href="<?php echo $this->Html->url( null, true ); ?>/regiao/<?php echo $faixa['ShopEnvioPessoalmente']['id']; ?>/remover" title="Remover">
		                        <span class="glyphicon glyphicon-remove"></span> Remover
		                        </a>

							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>

		</div>
	</form>

	<?php
    }
	?>
</div>
