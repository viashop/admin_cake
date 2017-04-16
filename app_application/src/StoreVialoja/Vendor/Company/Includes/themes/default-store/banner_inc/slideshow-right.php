<div class="slideshow-right col-lg-9 col-sm-9 col-xs-12">
	<!-- Lush Slider (autoload) -->
	<div id="veslayerslider1" class="lush-slider  " style="">

		<!-- Slide 1 -->
		<?php
		$at = 100;
		foreach ($GLOBALS['res_default_banners'] as $key => $banner):

		if ($key>0) {
			$at = $at+500*$key;
		}
		?>				
			
		<div class="lush" data-deadtime="0">

			
			<?php if (!empty($banner['ShopBanner']['link'])): ?>						
				
			<img src="<?php printf('%s%d/banner/%s', CDN_UPLOAD, ID_SHOP_DEFAULT, $banner['ShopBanner']['caminho']); ?>"
				data-slide-in="at <?php echo $at ?> from <?php echo \Lib\Tools::positionSlide() ?> use swing during 500"
				data-slide-out="at 10000 to <?php echo \Lib\Tools::positionSlide() ?> use swing during 500 "
				style="top: 0; left: 0; width:1170px; height:484px;" alt="<?php echo $banner['ShopBanner']['titulo']; ?>" />

			<a title="<?php echo $banner['ShopBanner']['titulo']; ?>" href="<?php echo $banner['ShopBanner']['link']; ?>" target="<?php echo $banner['ShopBanner']['target']; ?>">
				<div class=""
				data-slide-in="at <?php echo $at ?> from top use swing during 500" 
				data-slide-out="at 10000 to bottom use swing during 500 " 
				style="width:1170px; height:484px;"></div>
			</a>
			
			<?php else: ?>					

			<img src="<?php printf('%s%d/banner/%s', CDN_UPLOAD, ID_SHOP_DEFAULT, $banner['ShopBanner']['caminho']); ?>"
				data-slide-in="at <?php echo $at ?> from <?php echo \Lib\Tools::positionSlide() ?> use swing during 500"
				data-slide-out="at 10000 to <?php echo \Lib\Tools::positionSlide() ?> use swing during 500 "
				style="top: 0; left: 0; width:1170px; height:484px;" alt="<?php echo $banner['ShopBanner']['titulo']; ?>" />

			<?php endif ?>

		</div>				

		<?php endforeach ?>
		
	</div>
	<!-- /Lush Slider -->
	<script type="text/javascript">
		jQuery(document).ready(function(){
		 // make sure to add the correct class for the mode
		 jQuery('#veslayerslider1').lush({
		  
		  // PLUGIN OPTIONS
		  autostart: true // auto start plugin
		  , baseWidth: 873 // orignal slide widht
		  , baseHeight: 484 // and original slide height (ratio ~2.5)
		 });
		});
	</script>

</div>