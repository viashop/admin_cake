<?php
if (count($GLOBALS['res_marcaAll'])>0) {

	$html = '<div id="ves-brandcarousel" class="block ves-brandcarousel">
		<div class="block-title">
			<strong>
				<span>Nossas Marcas</span>
			</strong>	
		</div>
		<div class="block-content">
			<div id="brandcarousel5" class="carousel slide vescarousel hidden-xs">
				<div class="carousel-inner">'. PHP_EOL;

					$countMarca = count($GLOBALS['res_marcaAll']);

					foreach ($GLOBALS['res_marcaAll'] as $key => $marca) {

						if ($key==0) {
							$html .= '<div class="row item active">'. PHP_EOL;
						} elseif ($key % 6 == 0) {						
							$html .= '</div><!-- fecha '. $key .'-->
							<div class="row item">'. PHP_EOL;
						}

						$html .= '<div class="col-lg-2 col-xs-6 col-sm-2">
							<div class="item-inner">
								<a href="' . sprintf('%s/m/%s/%d/', FULL_BASE_URL, $marca['ShopMarca']['apelido'], $marca['ShopMarca']['id_marca'] ) .'">
									<img src="'. sprintf('%s%d/marcas/%s', CDN_UPLOAD, ID_SHOP_DEFAULT, $marca['ShopMarca']['logo']) .'" alt="'. $marca['ShopMarca']['nome'] .'" class="img-responsive" />
								</a>
							</div>
						</div>';			

						if ($countMarca == $key+1) {
							$html .= '</div><!-- fecha '. $key .'-->'. PHP_EOL;								
						}							

					}

				$html .= '</div>'. PHP_EOL;

				if ($countMarca > 6 ) {

					$html .= '<div class="carousel-controls">
						<a class="carousel-control left fa fa-angle-left" href="#brandcarousel5" rel="nofollow" data-slide="prev"></a>
						<a class="carousel-control right fa fa-angle-right" href="#brandcarousel5" rel="nofollow" data-slide="next"></a>
					</div>' . PHP_EOL;

				}

			$html .= '</div>
		</div>
	</div>

	<script type="text/javascript">
	<!--
	jQuery(\'#brandcarousel5\').carousel({interval:false});
	-->
	</script>';

	echo $html;

}
