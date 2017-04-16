<div class="std">
	<div id="ves-slideshow" class="ves-slideshow hidden-sm hidden-xs">
		<div class="row">
		
			<?php

			$GLOBALS['lista_categorias_left'] = null;		

			if (defined('FULL_BANNERES_SHOP')) {
				//slide
				App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'banner_inc'.DS.'slideshow-full');

				define('BANNER_VITRINE_HOME', 1);
			
			} else {

				if (\Lib\Validate::isNotNull( $GLOBALS['lista_categorias_left'] ) 
				&& \Lib\Validate::isNotNull( $GLOBALS['res_default_banners'] ) ) : 
				
				define('BANNER_VITRINE_HOME', 1);
				//Categoria
				App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'category-left');
				//slide
				App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'banner_inc'.DS.'slideshow-right');

				endif;
				
			}

			if (!defined('BANNER_VITRINE_HOME')) {

				if ( \Lib\Validate::isNotNull( $GLOBALS['lista_categorias_left'] ) ) {
					# code...
					App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'category-left');
				
				} else {

					define('FULL_BANNERES_SHOP', true);	
					define('BANNER_VITRINE_COL', 12);
					
				}										

				App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'banner_inc'.DS.'banner_vitrine');

			}
			?>
			
		</div>
	</div>
	
	<?php

	//Banner vitrine
	App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'banner_inc'.DS.'custom-block');
	?>
</div>