
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
                <h3 class="pull-left">Forma de envio Motoboy</h3>
            </div>
            <div class="box-content">
                <div class="form-horizontal">
					<div class="control-group ">
						<label class="control-label" for="id_ativo">Ativado</label>
						<div class="controls">
							<select data-envio="motoboy" data-guardname="<?php echo $CSRFGuardName ?>" data-guardtoken="<?php echo $CSRFGuardToken ?>" class="input-small" id="id_ativo" name="ativo">
								 <option value="True"  <?php if (!(strcmp("True", $envio_ativo))) { echo 'selected="selected"';} ?>>Sim</option>
                       			 <option value="False" <?php if (!(strcmp("False", $envio_ativo))) { echo 'selected="selected"';} ?>>Não</option>
							</select>
						</div>
					</div>
					<div class="control-group ">
						<label class="control-label" for="id_limite_peso">Limite de peso</label>
						<div class="controls">
							<select class="span2" id="id_limite_peso" name="limite_peso">
								<option value="30" selected="selected">Até 30kg</option>
								<option value="40">Até 40kg</option>
							</select>
							<p class="help-block">Informe qual é o limite máximo de peso que o motoboy consegue levar até o cliente.</p>
						</div>
					</div>					
                </div>

                <p class="alert alert-block alert-info">
                    Nos campos abaixo você deve informar qual é a faixa de CEP que seu motoboy irá atender. Esta informação você consegue junto aos Correios <a href="http://www.buscacep.correios.com.br/" title="Procurar por faixas de cep" target="_blank">clicando aqui</a>. Para cidades pequenas que não exista um intervalo, apenas um CEP único, informe o mesmo CEP nos campos CEP inicial e CEP final.
                    
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
                    <div class="form-group ">
                        <label class="control-label span3" for="id_prazo_entrega">Prazo de entrega</label>
                        <div class="span2">
                            <select class="form-control" id="id_prazo_entrega" name="prazo_entrega">

                            	<?php
								$array_value = array(1,2,3,4,5,6,7,8,9,10,15,20,25,30,45,60,90);

								foreach ($array_value  as $key => $value) {

									switch ($value) {
									
										case 1:
											# code...
											echo '<option value="1">1 dia útil</option>' . PHP_EOL;
											break;
										
										default:
											printf('<option value="%d">%d dias úteis</option>', $value, $value) . PHP_EOL;
											break;
									}
				
								}
								?>
                            </select>
                        </div>


                    </div>
                    <div class="form-group ">
                        <label class="control-label span3" for="id_valor">Valor (R$)</label>
                        <div class="span2">
                            <input class="form-control" style="min-white" id="id_valor" name="valor" type="text" required />
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

	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">Faixas de CEP atendidas </h3>
		</div>
		<div class="box-content">
			
			<table class="table table-generic-list">
				<thead>
					<tr>
						<th>Cidade ou Região</th>
						<th>Faixa inicial</th>
						<th>Faixa final</th>
						<th>Prazo de entrega</th>
						<th>Limite Peso</th>
						<th>Valor</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>

					<?php
					foreach ($faixas as $key => $faixa) {
					?>
					<tr>
						<td><?php echo $faixa['ShopEnvioMotoboy']['regiao']; ?></td>
						<td><?php echo $faixa['ShopEnvioMotoboy']['cep_inicio']; ?></td>
						<td><?php echo $faixa['ShopEnvioMotoboy']['cep_fim']; ?></td>
						<td><?php


						$prazo = $faixa['ShopEnvioMotoboy']['prazo_entrega'];
						
						if ( $prazo <= 1) {
							printf('%s dia', $prazo);
						} else {
							printf('%s dias', $prazo);
						}
						

						?></td>
						<td><?php echo $faixa['ShopEnvioMotoboy']['limite_peso']; ?> Até Kg</td>
						<td>R$ <?php echo \Lib\Tools::convertToDecimalBR($faixa['ShopEnvioMotoboy']['valor']); ?></td>
						<td>
							<?php
							/*
							?>
							<a class="btn btn-xs btn-default" href="/admin/configuracao/envio/<?php echo $faixa['ShopEnvioMotoboy']['id_envio']; ?>/regiao/<?php echo $faixa['ShopEnvioMotoboy']['id']; ?>/remover">
	                        <span class="glyphicon glyphicon-edit"></span> Editar
	                        </a>
	                        <?php
							*/
							?>
	                        <a class="btn btn-xs btn-danger btn-mini" href="<?php echo $this->Html->url( null, true ); ?>/regiao/<?php echo $faixa['ShopEnvioMotoboy']['id']; ?>/remover" title="Remover">
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
	<?php
    }
	?>
</div>
