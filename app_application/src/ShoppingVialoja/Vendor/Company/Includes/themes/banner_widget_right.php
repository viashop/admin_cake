<div class="row" >
	<div class="widget col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12 hidden-sp" >
		<div class="widget-html nopadding">
			<div>

				<?php foreach ($GLOBALS['BannerShopping']['res_managewidgets_left_all'] as $key => $banner): ?>

				<div class="box effect">
					<a href="<?php echo $banner['BannerShopping']['link']; ?>" title="<?php echo $banner['BannerShopping']['titulo']; ?>" target="<?php echo $banner['BannerShopping']['target']; ?>"> <img class="img-responsive" src="<?php echo CDN .'upload/ads/banner/managewidgets/'. $banner['BannerShopping']['caminho']; ?>" alt="<?php echo $banner['BannerShopping']['nome']; ?>" /> </a>
				</div>
			
				<?php endforeach ?>	

			</div>
		</div>
	</div>
</div>