 <script>
    $(document).ready(function() {

        $('#id_cep_fim, #id_cep_inicio').mask('99999-999');
        $('#id_peso_fim, #id_peso_inicio').maskMoney({ thousands:'', decimal:',', precision: 3 , allowZero: true});
        $('#id_valor').maskMoney({ thousands:'.', decimal:',' , allowZero: true});
        $('.mostrar-ajuda').click(function(event) {
            event.preventDefault();
            var target = $(this).attr('href');
            $(target).slideToggle();
        });

        $('#id_cep_inicio, #id_cep_fim').change(function(event) {
            
            var cep_inicio = $('#id_cep_inicio').val();
            var cep_fim = $('#id_cep_fim').val();            

            if (cep_inicio && cep_fim) {
                if (cep_inicio > cep_fim) {
                    $('#id_cep_inicio, #id_cep_fim').parents('.form-group').addClass('has-error');
                    alert('CEP inicial maior que o CEP final.');
                } else {
                    $('#id_cep_inicio, #id_cep_fim').parents('.form-group').removeClass('has-error');
                }
            }

        });


        $('#id_valor').click(function(event) {    
       
            var peso_inicio = $('#id_peso_inicio').val();
            var peso_fim = $('#id_peso_fim').val();

            if (peso_inicio && peso_fim) {

                if (peso_inicio > peso_fim) {
                    $('#id_peso_inicio, #id_peso_fim').parents('.form-group').addClass('has-error');
                    alert('PESO inicial maior que o PESO final.');
                } else {
                    $('#id_peso_inicio, #id_peso_fim').parents('.form-group').removeClass('has-error');
                }

            }

        });   
 

    });
</script>

<?php if (\Lib\Validate::isPost() && (isset($erro) && $erro === true) ): ?>
	
<script type="text/javascript">
    $(document).ready(function (event) {
        
        $('#id_peso_inicio').val('<?php echo \Lib\Tools::getValue("cep_inicio"); ?>');
        $('#id_cep_fim').val('<?php echo \Lib\Tools::getValue("cep_fim"); ?>');
        $('#id_prazo_entrega').val('<?php echo \Lib\Tools::getValue("prazo_entrega"); ?>');

        $('#id_peso_inicio').val('<?php echo \Lib\Tools::getValue("peso_inicio"); ?>');
        $('#id_peso_fim').val('<?php echo \Lib\Tools::getValue("peso_fim"); ?>');
        $('#id_valor').val('<?php echo \Lib\Tools::getValue("valor"); ?>');

    });
</script>

<?php endif ?>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar"><i class="icon-road"></i> Formas de envio</a> <span class="bread-separator">-</span></li>
        <li><span>Editando região</span></li>
    </ul>
</div>

<?php if ( (count($faixa_cep) > 0 ) && (count($faixa_peso) <= 0 ) ): ?> 
	
<div class="alert alert-warning">
    <a href="#" class="close" onclick="$(this).parent().fadeOut();return false;">&times;</a>
    <h4>Atenção!</h4>
    <span style="font-size:14px">Para que a região funcione, por favor defina as faixas de PESO.</span>
</div>

<?php endif ?>


<?php if ( (count($faixa_peso) > 0 ) && (count($faixa_cep) <= 0 ) ): ?> 
	
<div class="alert alert-warning">
    <a href="#" class="close" onclick="$(this).parent().fadeOut();return false;">&times;</a>
    <h4>Atenção!</h4>
    <span style="font-size:14px">Para que a região funcione, por favor defina as faixas de CEP.</span>
</div>

<?php endif ?>

<p><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/personalizado/<?php echo $this->request->params['pass'][2] ?>/editar" class="btn btn-mini btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Voltar para a configuração da <?php echo $nome_frete_personalizado; ?></a></p>
<div class="box">
	<div class="box-header">
		<h3>Forma de envio <?php echo $nome_frete_personalizado; ?>, região <?php echo $regiao['ShopEnvioPersonalizadoRegiao']['pais'] .' - '. $regiao['ShopEnvioPersonalizadoRegiao']['nome'] ?></h3>
	</div>
	<div class="box-content table-content">
		<table class="table table-generic-list">
			<tr>
				<th width="40%">Nome</th>
				<th width="20%">
					<span rel="tooltip" title="Ad valorem é uma taxa usada pelas transportadoras para agregar seguro na mercadoria que não está assegurada quando não está em tráfego. É definida em porcentagem do valor total dos produtos enviados.">
					Ad Valorem
					</span>
				</th>
				<th width="20%">
					<span rel="tooltip" title="Valor do quilograma adicional que será cobrado caso o peso calculado exceda o valor máximo definido nas faixas de peso.">
					Kg adicional
					</span>
				</th>
			</tr>
			<tr>
				<td><?php echo $regiao['ShopEnvioPersonalizadoRegiao']['pais']  .' - '. $regiao['ShopEnvioPersonalizadoRegiao']['nome'] ?></td>
				<td><?php 

				if ($regiao['ShopEnvioPersonalizadoRegiao']['ad_valorem'] >0) {
					echo \Lib\Tools::convertToDecimalBR( $regiao['ShopEnvioPersonalizadoRegiao']['ad_valorem'] ) . '%';
				} else {
					echo '-';
				}
				?></td>
				<td><?php

				if ($regiao['ShopEnvioPersonalizadoRegiao']['kg_adicional'] >0) {
					echo 'R$ '. \Lib\Tools::convertToDecimalBR( $regiao['ShopEnvioPersonalizadoRegiao']['kg_adicional'] );
				} else {
					echo '-';
				}

				 ?></td>
			</tr>
		</table>
	</div>
</div>
<div class="box">
	<div class="box-header">
		<h3>Editando faixa de CEP e Peso para <?php echo $nome_frete_personalizado; ?></h3>
	</div>
	<div class="box-content faixa_cep_peso">
		<h4>Faixas de CEP atendidas</h4>
		<form action="<?php echo Router::url(); ?>" id="form_cep" name="form_cep" method="post">
			<div class="row">
				<?php
	            $error = null;
	            if (isset($error_cep_inicio)) {
	                $error='has-error';
	            }
	            ?>
				<div class="col-sm-2 alpha form-group <?php echo $error ?>">
					<label class="control-label">CEP inicial</label>
					<div class="controls">
						<input class="form-control" id="id_cep_inicio" name="cep_inicio" type="text" />
						<?php
	                    if (isset($error_cep_inicio)) {
	                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
	                    }
	                    ?>
					</div>
				</div>

				<?php
	            $error = null;
	            if (isset($error_cep_fim)) {
	                $error='has-error';
	            }
	            ?>
				<div class="col-sm-2 alpha form-group <?php echo $error ?>">
					<label class="control-label">CEP final</label>
					<div class="controls">
						<input class="form-control" id="id_cep_fim" name="cep_fim" type="text" />
						<?php
	                    if (isset($error_cep_fim)) {
	                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
	                    }
	                    ?>
					</div>
				</div>

				<?php
	            $error = null;
	            if (isset($error_prazo_entrega)) {
	                $error='has-error';
	            }
	            ?>
				<div class="col-sm-2 form-group <?php echo $error ?>">
					<label class="control-label">Prazo de entrega</label>
					<div class="controls">
						<select class="form-control" id="id_prazo_entrega" name="prazo_entrega">
							<option value="0">0 dias</option>
							<option value="1">1 dia</option>
							<option value="2">2 dias</option>
							<option value="3">3 dias</option>
							<option value="4">4 dias</option>
							<option value="5">5 dias</option>
							<option value="6">6 dias</option>
							<option value="7">7 dias</option>
							<option value="8">8 dias</option>
							<option value="9">9 dias</option>
							<option value="10">10 dias</option>
							<option value="15">15 dias</option>
							<option value="20">20 dias</option>
							<option value="25">25 dias</option>
							<option value="30">30 dias</option>
							<option value="45">45 dias</option>
							<option value="60">60 dias</option>
						</select>
						<?php
	                    if (isset($error_prazo_entrega)) {
	                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
	                    }
	                    ?>
					</div>
				</div>
				<div class="col-sm-3 alpha form-group">
					<label class="control-label">&nbsp;</label>
					<div class="controls">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Adicionar faixa de CEP</button>
						<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
                		<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                		<input type='hidden' name='faixa_cep' value='True' />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">&nbsp;</label>
					<div class="controls">
						<a href="#ajuda-frete" class="btn btn-default mostrar-ajuda">
						<span class="glyphicon glyphicon-info-sign"></span>
						ajuda
						</a>
					</div>
				</div>
			</div>
			<div class="alert alert-warning none" id='ajuda-frete'>
				<h4>Exemplo</h4>
				<p>
					Ao colocar CEP inicial <strong>01000-000</strong> e CEP final <strong>09999-999</strong> você
					esta definindo que vai atender o estado de São Paulo.<br />
					<strong>
					Não sabe a faixa de CEP? <a href="<?php echo $this->Html->url( null, true ); ?>#modal-ajudar-cep" data-toggle="modal">clique aqui.</a>
					</strong>
				</p>
			</div>
		</form>

        <?php if (count($faixa_cep) > 0): ?> 

		<table class="table">
			<thead>
				<tr>
					<th>CEP inicial</th>
					<th>CEP final</th>
					<th>Prazo de entrega</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

                <?php foreach ($faixa_cep as $key => $faixa): ?>                    
                
				<tr>
					<td><?php echo $faixa['ShopEnvioPersonalizadoFaixa']['cep_inicio'] ?></td>
					<td><?php echo $faixa['ShopEnvioPersonalizadoFaixa']['cep_fim'] ?></td>
					<td><?php 

                    echo $faixa['ShopEnvioPersonalizadoFaixa']['prazo_entrega'];
                    if ($faixa['ShopEnvioPersonalizadoFaixa']['prazo_entrega'] == 1) {
                        echo ' dia';
                    } else {
                        echo ' dias';
                    }

                    ?></td>
					<td><a class="btn btn-danger btn-mini" href="/admin/configuracao/envio/personalizado/<?php echo $this->request->params['pass'][2] ?>/regiao/<?php echo $this->request->params['pass'][4] ?>/faixa/cep/<?php echo $faixa['ShopEnvioPersonalizadoFaixa']['id'] ?>/editar" onclick='return confirm("Tem a certeza que deseja remover?");'><span class="glyphicon glyphicon-trash"></span> Remover</a></td>
				</tr>

                <?php endforeach ?>
			</tbody>
		</table>

        <?php else: ?>

        Nenhuma faixa de CEP.
            
        <?php endif ?>

		<hr />
		<h4>Faixa de peso</h4>
		<form action="<?php echo Router::url(); ?>" id="form_peso" name="form_peso" method="post">
			<div class="row">

				<?php
	            $error = null;
	            if (isset($error_peso_inicio)) {
	                $error='has-error';
	            }
	            ?>
				<div class="col-sm-2 alpha form-group <?php echo $error ?>">
					<label class="control-label">Peso inicial (KG)</label>
					<div class="controls">
						<input class="form-control" id="id_peso_inicio" name="peso_inicio" type="text" />
						<?php
	                    if (isset($error_peso_inicio)) {
	                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
	                    }
	                    ?>
					</div>
				</div>

				<?php
	            $error = null;
	            if (isset($error_peso_fim)) {
	                $error='has-error';
	            }
	            ?>
				<div class="col-sm-2 alpha form-group <?php echo $error ?>">
					<label class="control-label">Peso final (KG)</label>
					<div class="controls">
						<input class="form-control" id="id_peso_fim" name="peso_fim" type="text" />
						<?php
	                    if (isset($error_peso_fim)) {
	                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
	                    }
	                    ?>
					</div>
				</div>

				<?php
	            $error = null;
	            if (isset($error_valor)) {
	                $error='has-error';
	            }
	            ?>
				<div class="col-sm-2 alpha form-group <?php echo $error ?>">
					<label class="control-label">Valor (R$)</label>
					<div class="controls">
						<input class="form-control" id="id_valor" name="valor" type="text" />
						<?php
	                    if (isset($error_valor)) {
	                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
	                    }
	                    ?>
					</div>
				</div>
				<div class="col-sm-3 alpha form-group">
					<label class="control-label">&nbsp;</label>
					<div class="controls">
						<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Adicionar faixa de peso</button>
						<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
                		<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                		<input type='hidden' name='faixa_peso' value='True' />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">&nbsp;</label>
					<div class="controls">
						<a href="#ajuda-peso" class="btn btn-default mostrar-ajuda">
						<span class="glyphicon glyphicon-info-sign"></span>
						ajuda
						</a>
					</div>
				</div>

				<br />
				<p class="help-block">Os pesos iniciais e finais são definidos em quilograma e podem ser inseridos com casas decimais. Por exemplo, caso queira inserir 300 gramas, use o valor "0,300".</p>

			</div>
			
			<div class="alert alert-info none" id='ajuda-peso'>
				<h4>Exemplo</h4>
				<p>
					Ao denifir que de <strong>4</strong> a <strong>10</strong> kilos o preço será
					<strong>R$ 22,99</strong> todas as faixas de CEP definidas acima terão o preço de
					envio de <strong>R$ 22,99</strong> caso o produto tenha de <strong>4</strong> a <strong>10</strong> kilos.
				</p>
			</div>
		</form>

        <?php if (count($faixa_peso) > 0): ?>      

		<table class="table">
			<thead>
				<tr>
					<th>Peso inicial</th>
					<th>Peso final</th>
					<th>Valor</th>
					<th></th>
				</tr>
			</thead>
			<tbody>

                <?php foreach ($faixa_peso as $key => $peso): ?>  
				<tr>                   

					<td><?php echo \Lib\Tools::convertToDecimalBR( $peso['ShopEnvioPersonalizadoPeso']['peso_inicio'], 3) ?> Kg</td>
					<td><?php echo \Lib\Tools::convertToDecimalBR( $peso['ShopEnvioPersonalizadoPeso']['peso_fim'], 3) ?> Kg</td>
					<td>R$ <?php echo \Lib\Tools::convertToDecimalBR( $peso['ShopEnvioPersonalizadoPeso']['valor'] ) ?></td>
					<td><a class="btn btn-danger btn-mini" href="/admin/configuracao/envio/personalizado/<?php echo $this->request->params['pass'][2] ?>/regiao/<?php echo $this->request->params['pass'][4] ?>/faixa/peso/<?php echo $peso['ShopEnvioPersonalizadoPeso']['id'] ?>/editar" onclick='return confirm("Tem a certeza que deseja remover?");'><span class="glyphicon glyphicon-trash"></span> Remover</a></td>


                </tr>

                <?php endforeach ?>

			</tbody>
		</table>

        <?php else: ?>

        Nenhuma faixa de PESO.
            
        <?php endif ?>

	</div>
</div>


<div class="modal fade" id="modal-ajudar-cep">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Ajuda faixas de CEP</h4>
			</div>
			<div class="modal-body">
				<p>
					Aqui estão algumas das principais faixas de CEP, mas se quiser mais
					visite o <a target="_blank" href="http://www.buscacep.correios.com.br/servicos/dnec/menuAction.do?Metodo=menuFaixaCep">site dos correios.</a>
				</p>
				<table class="table">
					<thead>
						<tr>
							<th>Estado</th>
							<th>CEP Inicial</th>
							<th>CEP Final</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Acre - AC    </td>
							<td>69900-000</td>
							<td>69999-999</td>
						</tr>
						<tr>
							<td>Alagoas - AL </td>
							<td>57000-000</td>
							<td>57999-999</td>
						</tr>
						<tr>
							<td>Amazonas - AM 1  </td>
							<td>69000-000</td>
							<td>69299-999</td>
						</tr>
						<tr>
							<td>Amazonas - AM 2  </td>
							<td>69400-000</td>
							<td>69899-999</td>
						</tr>
						<tr>
							<td>Amapá - AP   </td>
							<td>68900-000</td>
							<td>68999-999</td>
						</tr>
						<tr>
							<td>Bahia - BA   </td>
							<td>40000-000</td>
							<td>48999-999</td>
						</tr>
						<tr>
							<td>Ceará - CE   </td>
							<td>60000-000</td>
							<td>63999-999</td>
						</tr>
						<tr>
							<td>Distrito Federal - DF 1  </td>
							<td>70000-000</td>
							<td>72799-999</td>
						</tr>
						<tr>
							<td>Distrito Federal - DF 2  </td>
							<td>73000-000</td>
							<td>73699-999</td>
						</tr>
						<tr>
							<td>Espírito Santo - ES  </td>
							<td>29000-000</td>
							<td>29999-999</td>
						</tr>
						<tr>
							<td>Goiás - GO 1 </td>
							<td>72800-000</td>
							<td>72999-999</td>
						</tr>
						<tr>
							<td>Goiás - GO 2 </td>
							<td>73700-000</td>
							<td>76799-999</td>
						</tr>
						<tr>
							<td>Maranhão - MA    </td>
							<td>65000-000</td>
							<td>65999-999</td>
						</tr>
						<tr>
							<td>Minas Gerais - MG    </td>
							<td>30000-000</td>
							<td>39999-999</td>
						</tr>
						<tr>
							<td>Mato Grosso do Sul - MS  </td>
							<td>79000-000</td>
							<td>79999-999</td>
						</tr>
						<tr>
							<td>Mato Grosso - MT </td>
							<td>78000-000</td>
							<td>78899-999</td>
						</tr>
						<tr>
							<td>Pará - PA    </td>
							<td>66000-000</td>
							<td>68899-999</td>
						</tr>
						<tr>
							<td>Paraíba - PB </td>
							<td>58000-000</td>
							<td>58999-999</td>
						</tr>
						<tr>
							<td>Pernambuco - PE  </td>
							<td>50000-000</td>
							<td>56999-999</td>
						</tr>
						<tr>
							<td>Piauí - PI   </td>
							<td>64000-000</td>
							<td>64999-999</td>
						</tr>
						<tr>
							<td>Paraná - PR  </td>
							<td>80000-000</td>
							<td>87999-999</td>
						</tr>
						<tr>
							<td>Rio de Janeiro - RJ  </td>
							<td>20000-000</td>
							<td>28999-999</td>
						</tr>
						<tr>
							<td>Rio Grande do Norte - RN </td>
							<td>59000-000</td>
							<td>59999-999</td>
						</tr>
						<tr>
							<td>Rondônia - RO    </td>
							<td>76800-000</td>
							<td>76999-999</td>
						</tr>
						<tr>
							<td>Roraima - RR </td>
							<td>69300-000</td>
							<td>69399-999</td>
						</tr>
						<tr>
							<td>Rio Grande do Sul - RS   </td>
							<td>90000-000</td>
							<td>99999-999</td>
						</tr>
						<tr>
							<td>Santa Catarina - SC  </td>
							<td>88000-000</td>
							<td>89999-999</td>
						</tr>
						<tr>
							<td>Sergipe - SE </td>
							<td>49000-000</td>
							<td>49999-999</td>
						</tr>
						<tr>
							<td>São Paulo - SP   </td>
							<td>01000-000</td>
							<td>09999-999</td>
						</tr>
						<tr>
							<td>Tocantins - TO</td>
							<td>77000-000</td>
							<td>77999-999</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-primary" data-dismiss="modal">Entendi</a>
			</div>
		</div>
	</div>
</div>