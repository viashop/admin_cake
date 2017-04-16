<?php

if ( defined('BANNER_VITRINE_COL') && BANNER_VITRINE_COL == 12 ): ?>
<div class="slideshow-left col-lg-12 col-sm-12 col-xs-12">	
<?php else: ?>	
<div class="slideshow-left col-lg-9 col-sm-9 col-xs-12">
<?php endif ?>


<?php if (\Lib\Validate::isNotNull($GLOBALS['res_vitrine_banners'])): ?>

	<?php foreach ($GLOBALS['res_vitrine_banners'] as $key => $banner): ?>

	<div class="category-info clearfix">

		<?php 

		if (isset($GLOBALS['banner_pagina_pub']) 
			&& $GLOBALS['banner_pagina_pub'] !=='pagina_inicial'): ?>

			<div class="page-title category-title">
				<h1>Desktops - Local: <?php echo $banner['ShopBanner']['pagina_publicacao'] ?></h1>
			</div>

		<?php endif ?>

		<p class="category-image">

			<?php if (!empty($banner['ShopBanner']['link'])): ?>

			<a title="<?php echo $banner['ShopBanner']['titulo']; ?>" href="<?php echo $banner['ShopBanner']['link']; ?>" target="<?php echo $banner['ShopBanner']['target']; ?>">
				<img src="<?php printf('%s%d/banner/%s', CDN_UPLOAD, ID_SHOP_DEFAULT, $banner['ShopBanner']['caminho']); ?>" alt="<?php echo $banner['ShopBanner']['titulo']; ?>" title="<?php echo $banner['ShopBanner']['titulo']; ?>" />
			</a>
			
			<?php else: ?>
				<img src="<?php printf('%s%d/banner/%s', CDN_UPLOAD, ID_SHOP_DEFAULT, $banner['ShopBanner']['caminho']); ?>" alt="<?php echo $banner['ShopBanner']['titulo']; ?>" title="<?php echo $banner['ShopBanner']['titulo']; ?>" />
			<?php endif ?>

		</p>
	</div>
		
	<?php endforeach ?>

<?php endif ?>

</div>