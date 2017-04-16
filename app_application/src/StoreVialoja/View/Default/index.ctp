<!-- #begin - box index -->
<section id="columns" class="offcanvas-siderbars">
	<div class="container">
		<div class="row">
			<section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div id="content">
				
					<!-- # BEGIN - Box Categoria e Slide Show -->
					<?php
					App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'box-category-slideshow');
					?>
					<!-- # END - Box Categoria e Slide Show -->
					
					<!-- # BEGIN - Box de Produto em Abas -->
					<?php
					//App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'box-product-tabs');

					echo $this->requestAction(array(
						'controller' => 'BoxProdutoHome',
						'action' => 'box',
						'box_tipo' => 'destaque',
						'box_nome' => 'Produtos em Destaques',
					));
				

					?>
					<!-- # END - Box de Produto em Abas -->
					
					
					<!-- # BEGIN - Box Banner-->	
					<?php
					App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'banner_inc'.DS.'module_content');
					?>
					<!-- # BEGIN - Box Banner-->	
					
				</div>
			</section>
		</div>
	</div>
</section>			

<section id="ves-massbottom1" class="ves-massbottom">
	<div class="container">
		
		<?php
		/* Box produto destaque carousel */

		echo $this->requestAction(array(
			'controller' => 'BoxProdutoHome',
			'action' => 'box',
			'box_tipo' => 'oferta',
			//'box_tipo' => 'last_productview',
			'box_nome' => 'Produtos em Ofertas',
		));

		echo $this->requestAction(array(
			'controller' => 'BoxProdutoHome',
			'action' => 'box',
			'box_tipo' => 'usado',
			//'box_tipo' => 'last_productview',
			'box_nome' => 'Produtos Usados',
		));

		echo $this->requestAction(array(
			'controller' => 'BoxProdutoHome',
			'action' => 'box',
			'box_tipo' => 'recentes',
			//'box_tipo' => 'last_productview',
			'box_nome' => 'Os recém-chegados',
		));	

		/*
		echo $this->requestAction(array(
			'controller' => 'BoxProdutoHome',
			'action' => 'box',
			'box_tipo' => 'last_productview',
			'box_nome' => 'Últimos Produtos Vizualizados',
			'box_icon' => 'icon-appliances'
		));		
		*/
		
		//banner
		App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'banner_inc'.DS.'module-custombanner');
		?>
	</div>
</section>			
<!-- #end - box index -->