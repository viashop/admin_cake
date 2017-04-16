
<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/conta/uso"><i class="icon-charging icon-custom"></i> Meu plano</a> <span class="bread-separator">-</span></li>
		<li><span>Estatística de uso da sua conta</span></li>
	</ul>
</div>

<div class="row">
	<div class="box dados-consumo">
		<div class="box-header">
			<h3>Dados de consumo</h3>
		</div>

		<div class="box-content">
			<div class="row-fluid plano">
				<div class="span6">
					<h1>Plano <?php echo $id_plano; ?> <small> R$ <?php echo \Lib\Tools::convertToDecimalBR( $valor_plano ); ?></small></h1>
				</div>
				<div class="span6">
					<a class="btn pull-right" href="#planos" title="Alterar plano da sua loja."><i class="icon-edit"></i> Alterar plano</a>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="linha situacao">
						<strong><i class="icon-custom icon-engine"></i>Situação da loja:</strong>

						<?php if (isset($ativo_plano) && $ativo_plano === '1' ): ?>

						<span class="label label-success pull-right">Ativa</span>
							
						<?php else: ?>

						<span class="label label-danger pull-right">Inativa</span>
							
						<?php endif ?>
						
					</div>
					<div class="linha">
						<strong><i class="icon-dollar icon-custom"></i>Mensalidade</strong>
						<span class="pull-right">R$ <?php echo \Lib\Tools::convertToDecimalBR( $valor_plano ); ?></span>
					</div>
					<div class="linha">
						<strong><i class="icon-notification icon-custom"></i>Ciclo do plano</strong>
						<span class="pull-right"> <?php echo \Lib\Tools::formatToDate( $ciclo['ShopFatura']['data_mes_inicial'] ) . ' a '. \Lib\Tools::formatToDate( $ciclo['ShopFatura']['data_mes_final'] ); ?>
					</div>
				</div>
				<div class="span6">
					<div class="linha consumos">
						<ul class="consumo-status">
							<li>
								<div class="item-consumo produtos">
									<i class="icon-produtos icon-custom"></i>
									<span class="info text-right">
									<strong><?php echo \Lib\Tools::formatTotal( $total_produto_ativo ); ?> de <?php

									if ($config['PlanoShop']['produtos'] == 'ilimitado') {
										echo "ilimitado";
									} else {
										echo \Lib\Tools::formatTotal( $config['PlanoShop']['produtos'] );
									}

									?></strong>
									<span>Produtos ativos</span>
									</span>

									<?php if ($config['PlanoShop']['produtos'] == 'ilimitado'): ?>

									<span class="percent">0%</span>	
										
									<?php else:
			
									$porcentagem_produto = \Lib\Tools::percentageUse($total_produto_ativo, $config['PlanoShop']['produtos']);
									
									?>
									<span class="percent"><?php echo round($porcentagem_produto, 1); ?>%</span>
										
									<?php endif ?>
									
								</div>
							</li>
							<li>
								<div class="item-consumo trafego">
									<i class="icon-trafego icon-custom"></i>
									<span class="info text-right">
									<strong>
									<?php if (isset($soma_uso_trafego)): ?>

										<?php 
										if ($soma_uso_trafego<=0) {
											echo '0 Byte';
										} else {
											echo \Lib\Tools::calcByte( $soma_uso_trafego );
										}

										?>
										
									<?php endif ?>
									</strong>
									<span>
										<?php if ($id_plano == 10): ?>

										Tráfego ilimitado
											
										<?php else: ?>

										Tráfego total <?php echo \Lib\Tools::convertToDecimalBR($config['PlanoShop']['trafego'], 1); ?> GB
											
										<?php endif ?>
										
									</span>
									<?php

									$porcentagem_trafego = \Lib\Tools::percentageUse($soma_uso_trafego, $config['PlanoShop']['bytes']);
									
									?>

									<span class="percent"><?php echo round($porcentagem_trafego, 1); ?>%</span>
								</div>
							</li>
						</ul>
					</div>

					<div class="linha">
						<div class="titulo-linha">
							<strong><i class="icon-graph icon-custom"></i>Gráfico de visitantes no ciclo atual</strong>
							<span class="pull-right"><?php echo \Lib\Tools::formatTotal( $total_visita ); ?> de <?php

							if ($config['PlanoShop']['visitas'] == 'ilimitado') {
								
								echo  ' visitas ilimitadas';

							} else {
								echo \Lib\Tools::formatTotal( $config['PlanoShop']['visitas'] );
								echo  ' visitas';
							}	

							?>
							</span>
						</div>
						<?php

						if ($config['PlanoShop']['visitas'] == 'ilimitado') {
							$porcentagem_visita = 0;
						} else {
							$porcentagem_visita = \Lib\Tools::percentageUse($total_visita, $config['PlanoShop']['visitas']);
						}
						
						?>
						<div class="alpha graph-visitas" style="margin-right: 0;">
							<div class="progress" data-original-title="<?php echo $porcentagem_visita; ?>%">
								<div class="bar bar-success" style="width: <?php echo $porcentagem_visita; ?>%;"></div>
							</div>
							<div class="tooltip fade top in" style="width: 35px; top: -39px; left: 25%; margin-left: -25px;">
								<div class="tooltip-arrow"></div>
								<div class="tooltip-inner"><?php echo $porcentagem_visita; ?>%</div>
							</div>
						</div>
					</div>
					<!-- linha -->
				</div>
			</div>
		</div>
	</div>
	<div class="status-conta" id="planos">
		<h1>Planos disponíveis</h1>
		
		<?php echo $lista_tabela_planos1; ?>
		<?php echo $lista_tabela_planos2; ?>
		<?php echo $lista_tabela_planos3; ?>

		<div class="row-fluid">
			<div class="span6 offset6 plano-maior">
				<div class="alpha">
					<h5>Precisa de um plano maior?</h5>
					<p>Entre em contato conosco.</p>
				</div>
				<div>
					<a href="" target="_blank" class="btn">Solicitar novo plano</a>
				</div>
			</div>
		</div>
	</div>
	<div class="box status-conta" id="faq">
		<div class="box-header">
			<h3 class="pull-left">Perguntas frequentes</h3>
		</div>
		<div class="box-content">
			<div class="pergunta">
				<h5>1. O plano gratuito é realmente de graça?</h5>
				<p>
					Sim, ele permitirá que sua loja efetue vendas e obtenha lucro sem precisar investir nada.
				</p>
			</div>
			<hr>
			<div class="pergunta">
				<h5>2. O que acontecerá quando eu atingir o limite do plano?</h5>
				<p>
					Você receberá um email de aviso quando chegar em 80% do limite, receberá outros emails quando chegar em 85%, 90%, 95% e um último quando atingir o limite máximo. Se a sua loja atingir o limite do plano ela será suspensa e o seu cliente verá uma mensagem de "loja em manutenção". Para que sua loja não fique indisponível você deverá assinar um plano maior, caso não deseja assinar um plano maior a sua loja ficará suspensa até a finalização do ciclo atual da cobrança.
				</p>
			</div>
			<hr>
			<div class="pergunta">
				<h5>3. Como funciona a assinatura de um plano pago?</h5>
				<p>
					A assinatura de qualquer plano implica em renovação mensal automática até
					que o cancelamento da conta seja efetuado. O pagamento do plano dependará
					da forma de pagamento que foi selecionada ao preencher os
					<a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar">dados de cobrança</a>.
					Assim que o pagamento do plano for identificado, os limites do novo plano
					serão aplicados na sua conta, estes limites ficarão disponíveis durante o
					período de validade da cobrança e serão renovados quando o pagamento do
					próximo ciclo for identificado.
				</p>
			</div>
			<hr>
			<div class="pergunta">
				<h5>4. Como será cobrada a mensalidade dos planos pagos?</h5>
				<p>
					A mensalidade será cobrada através de boleto bancário ou cartão de crédito, a forma de pagamento deve ser configurada na página <a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar">dados de cobrança</a>.
				</p>
				<p>
					<em>Ao assinar um plano usando cartão de crédito você está autorizando que o valor do plano escolhido seja debitado automaticamente do seu cartão de crédito e autoriza também que o valor seja debitado mensalmente até que assine o plano gratuito ou efetue o cancelamento da sua conta.</em>
				</p>
				<p>
					<em>Ao assinar um plano usando boleto bancário você receberá um boleto automaticamente no momento da assinatura do plano, com vencimento de 1 dia útil para frente, e receberá mensalmente os boletos no seu email para efetuar o pagamento mensal do plano, estes boletos também estarão disponíveis no painel de controle da sua loja.</em>
				</p>
			</div>
			<hr>
			<div class="pergunta">
				<h5>5. Posso migrar de plano a qualquer momento?</h5>
				<p>
					Sim, durante as migrações de plano você pagará o valor do novo plano subtraido o valor proporcional aos dias que não foram usados no plano anterior.
				</p>
			</div>
			<hr>
			<div class="pergunta">
				<h5>6. Qual a vantagem de estar em um plano gratuito?</h5>
				<p>
					O lojista se beneficiará de características avançadas podendo direcionar seus investimos para marketing e outros fins. O plano gratuito também é a melhor forma de iniciar um negócio sem a necessidade de investimento inicial com a plataforma da sua loja virtual.
				</p>
			</div>
			<hr>
			<div class="pergunta">
				<h5>7. Qual a vantagem de migrar para um plano pago?</h5>
				<p>
					Basicamente para aumentar capacidade de visitas e produtos quando sua loja começar a ter mais movimento. Além disso os planos pagos permitem que você aceite a forma de pagamento Depósito bancário onde o seu cliente deposita o valor diretamente na sua conta e você gerencia a venda.
				</p>
			</div>
			<hr>
			<div class="pergunta">
				<h5>8. Posso cancelar o meu plano quando quiser?</h5>
				<p>
					Sim, você pode cancelar assim que desejar, porém o valor do plano que foi pago não é reembolsável (Ex: loja cancelou no dia 20 e já pagou até o dia 30. Não haverá devolução dessa diferença de 10 dias).
				</p>
			</div>
		</div>
	</div>

	<?php if ($this->Session->read('cliente_nivel') == 5 ): ?>

	<div class="box status-conta">
		<div class="box-header">
			<h3 class="pull-left">Cancelar conta</h3>
		</div>
		<div class="box-content">
			<p>
				Deseja cancelar a sua conta? &nbsp;
				<a class="btn btn-small" href="/admin/loja/cancelar/conta">Sim, quero cancelar a minha conta</a>
			</p>
		</div>
	</div>

	<?php endif ?>

</div>
<!-- /Full width content box -->
