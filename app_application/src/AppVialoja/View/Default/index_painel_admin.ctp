<?php
$this->element('admin/css-javascript/home');
?>
<div class="box dashboard-items">

	<div class="box-content">
		<div class="alert alert-warning">
		    <h3>
				Verifique as cobranças da sua conta
		    </h3>
		    <p>Verifique as cobranças da sua conta clicando no botão abaixo.</p>
		    <a class="btn btn-small" href="/admin/conta/cobranca"><i class="icon-list"></i> Ver todas as cobranças</a>
		</div>
	</div>

	<div class="box-content">
		<div class="alert alert-info">
		    <div class="row-fluid status-pedidos">
                <div class="span3">
                    <div class="item-pedidos total">
                        <a href="<?php echo VIALOJA_PAINEL ?>/pedido/listar">
                        <span>
                        <i class="icon-custom icon-pedidos"></i>
                        <strong>1</strong>
                        </span>
                        <span>
                        Pedido feito nos últimos 30 dias
                        </span>
                        </a>
                    </div>
                </div>
                <div class="span3">
                    <div class="item-pedidos aprovados">
                        <a href="<?php echo VIALOJA_PAINEL ?>/pedido/listar">
                        <span>
                        <i class="icon-custom icon-aprovados"></i>
                        <strong>-</strong>
                        </span>
                        <span>
                        Nenhum pedido aprovado nos últimos 30 dias
                        </span>
                        </a>
                    </div>
                </div>
                <div class="span3">
                    <div class="item-pedidos pendentes">
                        <a href="<?php echo VIALOJA_PAINEL ?>/pedido/listar">
                        <span>
                        <i class="icon-custom icon-pendentes"></i>
                        <strong>-</strong>
                        </span>
                        <span>
                        Nenhum pedido pendente nos últimos 30 dias.
                        </span>
                        </a>
                    </div>
                </div>
                <div class="span3">
                    <div class="item-pedidos cancelados">
                        <a href="<?php echo VIALOJA_PAINEL ?>/pedido/listar">
                        <span>
                        <i class="icon-custom icon-cancelados"></i>
                        <strong>100%</strong>
                        </span>
                        <span>
                        <b>1</b> pedido cancelado nos últimos 30 dias
                        </span>
                        </a>
                    </div>
                </div>
            </div>
                    
		</div>
	</div>

		    

	<div class="box-header">
		<h1>Painel de controle <span> Seja bem vindo <?php echo $this->Session->read('cliente_nome');?></span></h1>
	</div>
	<div class="box-content">
		<ul class="itens">
			<li>
				<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/listar">

					<?php
						echo $this->Html->image('icons/icon-product.png',
							array('alt' => 'Clientes', 'border' => '0')
						);
					?>
					<span>Produtos</span></a>
			</li>
			<li>
				<a href="<?php echo VIALOJA_PAINEL ?>/pedido/listar">

					<?php
						echo $this->Html->image('icons/icon-sell.png',
							array('alt' => 'Clientes', 'border' => '0')
						);
					?>
					<span>Vendas</span></a>
			</li>
			<li>
				<a href="cliente/listar">
					<?php
						echo $this->Html->image('icons/icon-client.png',
							array('alt' => 'Clientes', 'border' => '0')
						);
					?>
					<span>Clientes</span></a>
			</li>
			<li>
				<a href="<?php echo VIALOJA_PAINEL ?>/loja/configuracao/editar">

					<?php
						echo $this->Html->image('icons/icon-cog.png',
							array('alt' => 'Configurações', 'border' => '0')
						);
					?>
					<span>Configurações</span>
				</a>
			</li>
		</ul>
	</div>	

</div>
<div class="box primeiro_login">
	<div class="box-content alert-info">
		<img src="/admin/img/img_edit_layout.png" class="img-polaroid" style="border-color: #DDD;" />
		<p class="lead">Modifique o visual da sua loja e crie algo único!</p>
		<p>Você possui diversas opções de personalização para o visual da sua loja. Se não tiver experiência, utilize o "configurador de tema". Se tiver conhecimento de CSS, poderá utilizar o editor de código diretamente.</p>
		<a href="<?php echo VIALOJA_PAINEL ?>/loja/tema/editar" class="btn"><i class="icon-picture icon"></i> Configurar visual da sua loja</a>
	</div>
</div>
<div class="box dados-consumo">
	<div class="box-header">
		<h3>Plano</h3>
	</div>
	<div class="box-content">
		<div class="row-fluid">
			<div class="span6">
				<div class="linha situacao">
					<strong><i class="icon-page icon-custom"></i> Contratado</strong>
					<span class="pull-right">
					<span>Plano <?php echo $id_plano; ?>&nbsp; </span>

					<?php
					if ($id_plano <= 1) {
						echo '<span class="label label-warning">Grátis</span>'. PHP_EOL;
					}
					?>
					
					<a class="btn btn-mini" href="/admin/conta/uso#planos" title="Alterar plano da sua loja."><i class="icon-edit"></i> Alterar plano</a>
					</span>
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
								<strong>
								<?php

								echo \Lib\Tools::formatTotal( $total_produto_ativo );
								echo ' de ';

								if ($config['PlanoShop']['produtos'] == 'ilimitado') {

									echo 'ilimitado';
									$porcentagem_produto =0;

								} else {

									$porcentagem_produto = \Lib\Tools::percentageUse($total_produto_ativo, $config['PlanoShop']['produtos']);
									echo \Lib\Tools::formatTotal( $config['PlanoShop']['produtos'] );
								}

								?>
								</strong>
								<span>Produtos ativos</span>
								</span>
								<?php
								
								?>
								<span class="percent"><?php echo round($porcentagem_produto, 1); ?>%</span>
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
									<?php if ($id_plano>=10): ?>

									Tráfego ilimitado</span>
										
									<?php else: ?>

									Tráfego total <?php echo number_format($config['PlanoShop']['trafego'], 1, ',', ' '); ; ?> GB </span>
										
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
<div class="box plano-resumo">
	<div class="box-header">
		<h2>Resumo</h2>
	</div>
	<div class="box-content">
		<div class="row">
			<div class="alpha span2">
				<strong>Situação da loja</strong>
			</div>
			<div class="span4">

				<?php
				if ($config['Shop']['ativo'] == '1') {
					echo '<span class="label label-success">Ativa</span>' . PHP_EOL;
				} else {
					echo '<span class="label label-error">Inativa</span>' . PHP_EOL;
				}
				
				?>

			</div>
			<div class="span2">
				<strong>Tipo</strong>
			</div>
			<div class="span4">
				<a class="btn btn-mini pull-right" href="/admin/loja/configuracao/editar" title=""><i class="icon-wrench"></i></a>

				<?php
				$label_loja = null;
				$label_catalogo = null;
				$label_orcamento = null;

				if  ( strpos($config['Shop']['modo'], "loja") !== false ) {
					$label_loja = 'label';
				} elseif  ( strpos($config['Shop']['modo'], "catalogo") !== false ) {
					$label_catalogo = 'label';
				} elseif  ( strpos($config['Shop']['modo'], "orcamento") !== false ) {
					$label_orcamento = 'label';					
				}
				?>
				<span class="muted <?php echo $label_loja; ?>">Loja virtual</span>
				<span class="muted <?php echo $label_catalogo; ?>">Catálogo</span>
				<span class="muted <?php echo $label_orcamento; ?>">Orçamento</span>
		
			</div>
		</div>
		<div class="row">
			<div class="alpha span2">
				<strong>Sub-domínio</strong>
			</div>
			<div class="span4">

				<?php if (isset($subdominio)): ?>

				<a href="<?php echo 'http://'. $subdominio; ?>" target="_blank" class="link"><?php echo 'http://'. $subdominio; ?></a>
					
				<?php endif ?>

			</div>
			<div class="span2">
				<strong>Domínio próprio</strong>
			</div>
			<div class="span4">
			
				<?php if (isset($dominio) && !empty($dominio)): ?>

				<a class="btn btn-mini pull-right" href="/admin/loja/configuracao/editar#dominio-proprio" title=""><i class="icon-wrench"></i></a>

				<a href="<?php echo 'http://'. $dominio; ?>" target="_blank" class="link"><?php echo 'http://'. $dominio; ?></a>
					
				<?php else: ?>

				<a class="btn btn-mini" href="/admin/loja/configuracao/editar#dominio-proprio" title="Configurar dados da loja"><i class="icon-cog"></i> Configurar o domínio</a>&nbsp;				
					
				<?php endif ?>
				
			</div>
		</div>

		<?php /* ?>
		<div class="row">
			<div class="alpha span2">
				<strong>Certificado SSL</strong>
			</div>
			
			<div class="span4">
				<a class="btn btn-mini" href="/admin/loja/certificado" title="Solicitar certificado"><i class="icon-lock"></i> Adquirir certificado</a>


				 &nbsp; &nbsp;
                    <a href="#" target="_blank" class="link">Qual a importância?</a>
			</div>
		</div>

		<?php */ ?>
	</div>
</div>
<?php
/*

<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script>
	function OnLoad() {
		var feed = new google.feeds.Feed("http://blog.vialoja.com.br/feed/");
		feed.setNumEntries(5);
		feed.load(loaded_blog);
	}
	google.load("feeds", "1");
	google.setOnLoadCallback(OnLoad);
</script>
<div class="row changelog-itens">
	<div class="box changelog-container alpha">
		<div class="box-header">
			<h2 class="pull-left">Direto do BLOG</h2>
			<div class="box-widget pull-right">
				<a href="http://blog.vialoja.com.br/" target="_blank" class="btn btn-link" style="font-size: 13px; margin: 4px -10px 0 0;">Ver mais</a>
			</div>
		</div>
		<div class="box-content"></div>
	</div>
</div>
<div class="box box-videos">
	<div class="box-header">
		<h3>
			Acompanhe nossos vídeos
			<small>
			<a href="http://www.youtube.com.br/UniversidadeIngles" title="Visite nosso canal" target="_blank">
			<i class="icon-custom icon-video"></i>Visite nosso canal
			</a>
			</small>
		</h3>
	</div>
	<div class="box-content">
		<ul id="listaVideos">
		</ul>
	</div>

</div>
*/
?>

