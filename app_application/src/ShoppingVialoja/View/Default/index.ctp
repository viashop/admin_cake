<section id="columns" class="columns-container">

	<?php
    echo $this->Session->flash();
    ?>

	<div class="container">
		<div class="row">
			<div id="top_column" class="center_column col-xs-12 col-sm-12 col-md-12">
			</div>
		</div>
		<div class="row">
			<!-- Center -->						
			
			<section id="center_column" class="col-md-9">
				<?php
				//Busca com categoria
				App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'slideshow');
				?>
				<div class="clearfix">
					<div class="row" >
						
						<?php
						//Busca com categoria
						//App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'box_index'. DS .'mais_quentes_tab-index');


						try {

							echo $this->requestAction(array(
				                'controller' => 'BoxProdutoHome',
				                'action' => 'box',
				                'box_tipo' => 'destaque',
				                'box_nome' => 'Produtos em Destaques',
				                'box_icon' => 'icon-fashion'
				            ));
							
						} catch (Exception $e) {
							
						}

						try {

							echo $this->requestAction(array(
				                'controller' => 'BoxProdutoHome',
				                'action' => 'box',
				                'box_tipo' => 'oferta',
				                'box_nome' => 'Produtos em Ofertas',
				                'box_icon' => 'icon-baby'
				            ));
							
						} catch (Exception $e) {
							
						}

						try {

							echo $this->requestAction(array(
				                'controller' => 'BoxProdutoHome',
				                'action' => 'box',
				                'box_tipo' => 'usado',
				                'box_nome' => 'Produtos usados',
				                'box_icon' => 'icon-appliances'
				            ));
							
						} catch (Exception $e) {
							
						}

						try {

							echo $this->requestAction(array(
				                'controller' => 'BoxProdutoHome',
				                'action' => 'box',
				                'box_tipo' => 'recentes',
				                'box_nome' => 'Os recém-chegados',
				                'box_icon' => 'icon-appliances'
				            ));
							
						} catch (Exception $e) {
							
						}

						try {

							echo $this->requestAction(array(
				                'controller' => 'BoxProdutoHome',
				                'action' => 'box',
				                'box_tipo' => 'last_productview',
				                'box_nome' => 'Últimos Produtos Vizualizados',
				                'box_icon' => 'icon-appliances'
				            ));
							
						} catch (Exception $e) {
							
						}

						try {

							echo $this->requestAction(array(
				                'controller' => 'BoxLojasHome',
				                'action' => 'box',
				                'box_nome' => 'ÚLTIMAS LOJAS VISITADAS',
				                'box_icon' => 'icon-appliances'
				            ));
							
						} catch (Exception $e) {

							
						}

						?>
						
					</div>
				</div>
			</section>


			<!-- Right -->
			<section id="right_column" class="column sidebar col-md-3">
				<!-- MODULE Block best sellers -->
				<?php
				//Mais vendidos


				/*

				//Desativados o mais visualizados				

				try {

					echo $this->requestAction(array(
		                'controller' => 'ShopProdutoHits',
		                'action' => 'mais_visualizados'
		            ));
					
				} catch (Exception $e) {

					
				}

				*/

				//App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'menu_mais_vendidos');

				?>
				<!-- /MODULE Block best sellers --><!-- Block categories module -->
				<?php
				
				//Categorias
				//App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'menu_categorias');
				?>

				<!-- /Block categories module -->
				<?php
				//Banners
				App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'banner_widget_right');
				?>
		
			</section>
		</div>
	</div>
</section>