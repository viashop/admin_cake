<script type="text/javascript">
	$(document).ready(function() {
		$('#id_cep').mask('99999-999');
		$('#id_altura, #id_largura, #id_comprimento').maskMoney({ thousands:'', decimal:'', precision: 1 });
		$('#id_peso').maskMoney({ thousands:'', decimal:',', precision: 3 });
		$('#mostrar_outras_informacoes').change(function(event) {
			$('#outras_informacoes').fadeToggle();
		});
		// $('.calcular_frete').click(function(event) {
		//     event.preventDefault();
		//     var url = '/admin/configuracao/envio/calcular/transportador?cep='+ $('#cep').val() + '&peso=' + $('#peso').val();
		//     $.getJSON(url, function(data) {
		//         $('#simulacao_frete').html('');
		//         var linha = '<tr><td>:forma_envio:</td><td>:regiao:</td><td>:cep:</td><td>:peso:</td><td><strong>R$</strong> :valor_frete:</td><td><strong>:prazo:</strong> dias</td></tr>';
		//         $.each(data, function(key, value){
		//             if (value.id) {
		//                 var linha_atual = linha.replace(':forma_envio:', value.forma_envio);
		//                 linha_atual = linha_atual.replace(':regiao:', value.regiao);
		//                 linha_atual = linha_atual.replace(':valor_frete:', value.valor_frete);
		//                 linha_atual = linha_atual.replace(':peso:', value.faixa_peso);
		//                 linha_atual = linha_atual.replace(':cep:', value.faixa_cep);
		//                 linha_atual = linha_atual.replace(':prazo:', value.prazo);
		//                 $('#simulacao_frete').append(linha_atual);
		//             }
		//         });
		//     });
		// });
	});
</script>
<style type="text/css">
<!--
	
	input[type="checkbox"]{ margin: -4px 3px; }
	.spacing{ margin-left: 50px; }

-->
</style>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar"><i class="icon-road"></i> Formas de envio</a> <span class="bread-separator">-</span></li>
        <li><span>Simulação de frete</span></li>
    </ul>
</div>
 
<div class="box">
	<div class="box-header">
		<h3>
			Simulação <small>Simule aqui as suas configurações de frete.</small>
		</h3>
	</div>
	<div class="box-content">
		<div class="alert alert-info">
			Esta simulação permite que você verifique e valide as suas configuração das formas de envio. O resultado que aparece aqui nesta lista é o mesmo que o seu cliente verá quando fizer o cálculo do frete no carrinho de compras da sua loja. 
			<br />
			<strong>Obs.:</strong> Alguns erros podem ser exibidos no <strong>Simulador</strong> do <strong>Painel de Controle</strong>, mas será oculto para seu cliente.
		</div>
		<form action="<?php echo Router::url(); ?>" method="POST">
			<div class="row">
				<div class="form-group span2 alpha ">
					<label class="control-label">CEP</label>
					<div class="controls">
						<input class="form-control" id="id_cep" name="cep" type="text" value="<?php echo \Lib\Tools::getValue('cep'); ?>" />
					</div>
				</div>
				<div class="form-group span2 ">
					<label class="control-label">Peso</label>
					<div class="controls">
						<span class="input-append">
							<input class="form-control" id="id_peso" name="peso" type="text" value="<?php echo \Lib\Tools::getValue('peso'); ?>" />
							<span class="add-on">Kg</span>
						</span>
					</div>
				</div>
				<div class="none" id="outras_informacoes">
					<div class="form-group span2 spacing" >
						<label class="control-label">Altura</label>
						<div class="controls">
							<span class="input-append">
								<input class="medida form-control" id="id_altura" name="altura" type="text" value="0" />
								<span class="add-on">cm</span>
							</span>
						</div>
					</div>
					<div class="form-group span2 spacing">
						<label class="control-label">Largura</label>
						<div class="controls">
							<span class="input-append">
								<input class="medida form-control" id="id_largura" name="largura" type="text" value="0" />
								<span class="add-on">cm</span>
							</span>
						</div>
					</div>
					<div class="form-group span2 spacing">
						<label class="control-label">Comprimento</label>
						<div class="controls">
							<span class="input-append">
								<input class="medida form-control" id="id_comprimento" name="comprimento" type="text" value="0" />
								<span class="add-on">cm</span>
							</span>
						</div>
					</div>
				</div>
				<div class="form-group span2 pull-right">
					<label class="control-label">&nbsp;</label>
					<div class="controls">
						<button type="submit" class="btn btn-primary calcular_frete">
						<span class="glyphicon glyphicon-ok"></span> Calcular Frete
						</button>
						<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
						<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
					</div>
				</div>
			</div>
			<div class="clear">
				<label for="" class="checkbox">
				<input type="checkbox" name="checkbox" id="mostrar_outras_informacoes">
				Colocar medidas
				</label>
			</div>
		</form>
	</div>
	<div class="box-footer"></div>
</div>

<?php

use Respect\Validation\Validator as v;

if (count($arr_return_frete) > 0) {

	$envio_correios = \Lib\Tools::getArrayKeySpecific('envio_correios', $arr_return_frete);
	$envio_motoboy = \Lib\Tools::getArrayKeySpecific('envio_motoboy', $arr_return_frete);
	$envio_pessoalmente = \Lib\Tools::getArrayKeySpecific('envio_pessoalmente', $arr_return_frete);
	$envio_transportadora =  \Lib\Tools::getArrayKeySpecific('envio_transportadora', $arr_return_frete);
	$envio_personalizado =  \Lib\Tools::getArrayKeySpecific('envio_personalizado', $arr_return_frete);

?>

<div class="box">
	<div class="box-header">
		<h3>Formas de Envio</h3>
	</div>
	<div class="box-content">
		<table class="table">

			<tr>
				<th>Forma de Envio</th>
				<th>Preço</th>
				<th>Prazo</th>
			</tr>

			<?php

			if ( v::notEmpty()->validate($envio_formas) && count($envio_correios) > 0 ) {

				foreach ($envio_correios as $key => $servico) {

					foreach ($envio_formas as $key => $forma) {

						if ($forma['ShopEnvioCorreios']['codigo_servico'] == $servico->Codigo) {
							$taxa_tipo = $forma['ShopEnvioCorreios']['taxa_tipo'];
							$taxa_valor = $forma['ShopEnvioCorreios']['taxa_valor'];
							$prazo_adicional = $forma['ShopEnvioCorreios']['prazo_adicional'];
							$nome = $forma['CodigoCorreios']['nome'];
						}
						
					}

					echo '<tr>';

					if($servico->Erro == 0) {										

			        	printf('<td>%s</td>', $nome);

			        	if ($taxa_tipo == 'fixo') {
			        		$valor_final = floatval($servico->Valor) + $taxa_valor;
			        	} else {

			        		$valor = floatval( $servico->Valor );
							$percentual   = ( $taxa_valor / 100.0 );
							$valor_final += ( $percentual * $valor );

			        	}				        	

						printf('<td><strong>R$ </strong>%s</td>', \Lib\Tools::convertToDecimalBR( $valor_final ) );

						$prazo = $servico->PrazoEntrega + 1;
						if ($prazo_adicional > 0) {
							$prazo += $prazo_adicional;
						}

						if ( $prazo <= 1) {
							printf('<td>Dia da Postagem + %s dia útil</td>', $prazo);
						} else {
							printf('<td>Dia da Postagem + %s dias úteis</td>', $prazo);
						}						

			        } else {

			        	printf('<td>%s</td>', $nome);
			        	printf('<td colspan="2"><strong style="color:red">Erro:</strong> %s | <strong style="color:red">Código do erro:</strong> %s | <a href="http://www.correios.com.br/para-voce/correios-de-a-a-z/pdf/calculador-remoto-de-precos-e-prazos/manual-de-implementacao-do-calculo-remoto-de-precos-e-prazos" target="_BLANK">Link do manual</a></td>', $servico->MsgErro, $servico->Erro);

			        }

			        echo '</tr>';

			    }

			}

			if ( v::notEmpty()->validate($envio_motoboy) ) {

			    foreach ($envio_motoboy as $key => $envio) {

				    echo '<tr>';

		        	echo '<td>MotoBoy</td>';		        	

					printf('<td><strong>R$ </strong>%s</td>', \Lib\Tools::convertToDecimalBR( $envio['ShopEnvioMotoboy']['valor'] ) );
					
					$prazo = $envio['ShopEnvioMotoboy']['prazo_entrega'];
					if ( $prazo <= 1) {
						printf('<td>%s dia</td>', $prazo);
					} else {
						printf('<td>%s dias</td>', $prazo);
					}
					
					echo '</tr>';

				}

			}

			if ( v::notEmpty()->validate($envio_pessoalmente) ) {

			    foreach ($envio_pessoalmente as $retirada) {

				    echo '<tr>';
		        	echo '<td>Retirar Pessoalmente</span><br />

		        	<i style="font-size:12px;">- '. $retirada['ShopEnvioPessoalmente']['regiao'] .'
		        	</i></td>';	        	
					echo '<td>R$ 0,00</td>';						
					echo '<td>2 dias</td>';
					
					echo '</tr>';

				}

			}


			if ( v::notEmpty()->validate($envio_transportadora) ) {

				$calc_kg_adicional_personalizado = false;

				if (array_key_exists('calcular_kg_adicional', $envio_transportadora)){

					$calc_kg_adicional_personalizado = true;

				    foreach ($envio_transportadora as $key => $envio) {

				    	if ($key !== 'calcular_kg_adicional' && !empty($envio['ShopEnvioTransportadora']['peso_final'])) {

					    	$valor = 0;
				        	if ( !empty($envio['ShopEnvioTransportadora']['kg_adicional']) ) {

				        		$peso_final = $envio['ShopEnvioTransportadora']['peso_final'];
				        		$valor = $envio['ShopEnvioTransportadora']['valor'];
				        		$peso  = round( floatval( \Lib\Tools::getValue('peso') ) );
				        		$valor += ( $envio['ShopEnvioTransportadora']['kg_adicional'] * ( $peso - $peso_final ) );

				        	}

						    echo '<tr>';
				        	echo '<td>Transportadora<br />

				        	<i style="font-size:12px;">- '. $envio['ShopEnvioTransportadora']['regiao'] .'
				        	</i></td>';		        	

							printf('<td><strong>R$ </strong>%s</td>', \Lib\Tools::convertToDecimalBR( $valor ) );
							
							$prazo = $envio['ShopEnvioTransportadora']['prazo_entrega'];
							if ( $prazo <= 1) {
								printf('<td>%d dia</td>', $prazo);
							} else {
								printf('<td>%d dias</td>', $prazo);
							}
							
							echo '</tr>';

						}

					}

				}


				if ($calc_kg_adicional_personalizado === false ) {

					foreach ($envio_transportadora as $key => $envio) {

					    echo '<tr>';

			        	echo '<td>Transportadora<br />

			        	<i style="font-size:12px;">- '. $envio['ShopEnvioTransportadora']['regiao'] .'
			        	</i></td>';		        	

						printf('<td><strong>R$ </strong>%s</td>', \Lib\Tools::convertToDecimalBR( $envio['ShopEnvioTransportadora']['valor'] ) );
						
						$prazo = $envio['ShopEnvioTransportadora']['prazo_entrega'];
				
						if ( $prazo <= 1) {
							printf('<td>%d dia</td>', $prazo);
						} else {
							printf('<td>%d dias</td>', $prazo);
						}
						
						echo '</tr>';

					}

				}

			}

			//Fora da faixa de Cep, efetuar calculo por preco por kg adcional
			if ( v::notEmpty()->validate($envio_personalizado) ) {
		
				$calc_kg_adicional_personalizado = false;

				if (array_key_exists('calcular_kg_adicional', $envio_personalizado)){

					$calc_kg_adicional_personalizado = true;	

					foreach ($envio_personalizado as $key => $envio) {
					
						if ($key !== 'calcular_kg_adicional' && !empty($envio['ShopEnvioPersonalizadoPeso']['peso_fim'])) {

							echo '<tr>';

				        	echo '<td>'. $envio['ShopEnvioPersonalizado']['nome'] .'<br />

				        	<i style="font-size:12px;">- '. $envio['ShopEnvioPersonalizadoRegiao']['nome'] .'
				        	</i></td>';	

				        	$valor = 0;
				        	if ( !empty($envio['ShopEnvioPersonalizadoRegiao']['kg_adicional']) ) {

				        		$peso_fim = $envio['ShopEnvioPersonalizadoPeso']['peso_fim'];        		
				        		$valor = $envio['ShopEnvioPersonalizadoPeso']['valor'];        		
				        		$peso  = round( floatval( \Lib\Tools::getValue('peso') ) );
				        		$valor += ( $envio['ShopEnvioPersonalizadoRegiao']['kg_adicional'] * ( $peso - $peso_fim ) );

				        	}

				        	/**
				        	 * Acrescenta ao frete 
				        	 * definido em personalização
				        	 */
				        	if (!empty($envio['ShopEnvioPersonalizado']['taxa_valor'])) {

			        			if ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'fixo') {

			        				$valor += $envio['ShopEnvioPersonalizado']['taxa_valor'];

			        			} elseif ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'porcentagem') {

									$percentual = ( $envio['ShopEnvioPersonalizado']['taxa_valor'] / 100.0 );
									$valor += ( $percentual * $valor );

			        			}

				        	}

							/**
				        	 * Preço por KG adicional
				        	 * Valor que será pago por KG adicional que ultrapassar o limite de peso desta configuração
				        	 */				        	
							printf('<td><strong>R$ </strong>%s</td>', \Lib\Tools::convertToDecimalBR( $valor ) );


							/**
				        	 * Acrescenta ao frete 
				        	 * definido em personalização
				        	 */					
							$prazo_entrega = $envio['ShopEnvioPersonalizadoFaixa']['prazo_entrega'];

							if ($envio['ShopEnvioPersonalizado']['prazo_adicional'] > 0) {

								$prazo_entrega += $envio['ShopEnvioPersonalizado']['prazo_adicional'];

							}

							if ( $prazo_entrega <= 1) {
								printf('<td>%d dia</td>', $prazo_entrega);
							} else {
								printf('<td>%d dias</td>', $prazo_entrega);
							}
							
							echo '</tr>';

						}

						$envio_personalizado = null;

					}
					
				}

				//Dentro da Faixa de Peso
				if ($calc_kg_adicional_personalizado === false) {

				    foreach ($envio_personalizado as $key => $envio) {

					    echo '<tr>';

			        	echo '<td>'. $envio['ShopEnvioPersonalizado']['nome'] .'<br />

			        	<i style="font-size:12px;">- '. $envio['ShopEnvioPersonalizadoRegiao']['nome'] .'
			        	</i></td>';	

			        	$valor = $envio['ShopEnvioPersonalizadoPeso']['valor'];

			        	/**
			        	 * Acrescenta ao frete 
			        	 * definido em personalização
			        	 */
			        	if (!empty($envio['ShopEnvioPersonalizado']['taxa_valor'])) {

		        			if ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'fixo') {

		        				$valor += $envio['ShopEnvioPersonalizado']['taxa_valor'];

		        			} elseif ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'porcentagem') {

								$percentual = ( $envio['ShopEnvioPersonalizado']['taxa_valor'] / 100.0 );
								$valor += ( $percentual * $valor );

		        			}

			        	}

						printf('<td><strong>R$ </strong>%s</td>', \Lib\Tools::convertToDecimalBR( $valor ) );


						/**
			        	 * Acrescenta ao frete 
			        	 * definido em personalização
			        	 */					
						$prazo_entrega = $envio['ShopEnvioPersonalizadoFaixa']['prazo_entrega'];

						if ($envio['ShopEnvioPersonalizado']['prazo_adicional'] > 0) {

							$prazo_entrega += $envio['ShopEnvioPersonalizado']['prazo_adicional'];

						}

						if ( $prazo_entrega <= 1) {
							printf('<td>%d dia</td>', $prazo_entrega);
						} else {
							printf('<td>%d dias</td>', $prazo_entrega);
						}
						
						echo '</tr>';

					}

				}

			}
			?>

		</table>

		<div class="alert alert-info">
			<div class="row">
				<div class="span1"><i class="fa fa-info-circle fa-3x"></i></div>
		      	<div class="span11">Para fins de contagem do prazo de entrega, sábados, domingos e feriados não são considerados dias úteis. Postagens ocorridas aos sábados, domingos, feriados e depois do horário limite de postagem (DH), considerar o próximo dia útil como o "Dia da Postagem".</div>
			</div>
			
		</div>

	</div>
	<div class="box-footer"></div>
</div>
<?php 
}
?>