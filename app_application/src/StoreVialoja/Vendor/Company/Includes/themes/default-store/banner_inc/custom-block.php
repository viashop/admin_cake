<?php if (\Lib\Validate::isNotNull( $GLOBALS['res_banners'] )): ?>
<div>
	<div class="custom-block custom-img hidden-xs">
		<div class="row">

			<?php foreach ($GLOBALS['res_banners'] as $key => $banner): ?>

			<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">

				<?php if (!empty($banner['ShopBanner']['link'])): ?>						
						
				<a title="<?php echo $banner['ShopBanner']['titulo']; ?>" href="<?php echo $banner['ShopBanner']['link']; ?>" target="<?php echo $banner['ShopBanner']['target']; ?>"> 
					<img src="<?php printf('%s%d/banner/%s', CDN_UPLOAD, ID_SHOP_DEFAULT, $banner['ShopBanner']['caminho']); ?>" alt="<?php echo $banner['ShopBanner']['titulo']; ?>" />
				</a>
					
				<?php else: ?>

				<img src="<?php printf('%s%d/banner/%s', CDN_UPLOAD, ID_SHOP_DEFAULT, $banner['ShopBanner']['caminho']); ?>" alt="<?php echo $banner['ShopBanner']['titulo']; ?>" />
					
				<?php endif ?>

			</div>

			<?php endforeach ?>

		</div>
	</div>
</div>
<?php endif ?>