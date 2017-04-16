<div class="slideshow-full col-lg-12 col-sm-12 col-xs-12">
	<!-- Lush Slider (autoload) -->
	<div class="std">
		<div id="ves-slideshow" class="ves-slideshow hidden-sm hidden-xs">
			<!-- Lush Slider (autoload) -->
			
			<div id="veslayerslider8" class="lush-slider  " style="">

				<!-- Slide 1 -->
				<?php
				$at = 100;
				foreach ($GLOBALS['res_full_banners'] as $key => $banner):

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
						data-slide-in="at 100 from top use swing during 500" 
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
				  jQuery('#veslayerslider8').lush({
				   
					// PLUGIN OPTIONS
					autostart: true // auto start plugin
					, baseWidth: 1170 // orignal slide widht
					, baseHeight: 484 // and original slide height (ratio ~2.5)
					,slider: {
					  customPrevClass: "fa fa-angle-left",
					  customNextClass: "fa fa-angle-right"
					}
				  });
				});
			</script>
		</div>
		
	</div>

</div>

			<script type="text/javascript">
		      $(function(){
				    $('#veslayerslider8 div').click(function(){
				        var id = $(this).attr('id');
				        alert(id);
				    });
				})
		    </script>