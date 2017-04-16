<!DOCTYPE HTML>
<!--[if lt IE 7]> 
<html class="no-js lt-ie9 lt-ie8 lt-ie7 " lang="br">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8 ie7" lang="br">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9 ie8" lang="br">
<![endif]-->
<!--[if gt IE 8]> 
<html class="no-js ie9" lang="br">
<![endif]-->
<html lang="pt_BR"  class="" >
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />

	<?php

	if (defined('INCLUDE_DEFAULT')) {
		# code...

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_index');
		// <!-- head -->
		echo PHP_EOL .'<body id="index" class="index hide-left-column lang_br fullwidth">' . PHP_EOL;

	}

	if (defined('INCLUDE_CATEGORIA')) {
		# code...

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_categoria');
		// <!-- head -->
		echo PHP_EOL .'<body id="best-sales" class="best-sales hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;

	}


	if (defined('INCLUDE_CLIENTE')) {
		# code...

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_cliente');
		// <!-- head -->
		echo PHP_EOL .'<body id="authentication" class="authentication hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;

		//echo PHP_EOL .'<body id="password" class="password hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;

	}

	if (defined('INCLUDE_MAPA_SITE')) {

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_mapa_site');

		echo PHP_EOL .'<body id="sitemap" class="sitemap hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;
	}

	if (defined('INCLUDE_NOSSAS_LOJAS')) {

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_nossas_lojas');

		echo PHP_EOL .'<body id="supplier" class="supplier hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;
	}

	if (defined('INCLUDE_CHECKOUT')) {

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_checkout');

		echo PHP_EOL .'<body id="order" class="order hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;
	}

	if (defined('INCLUDE_ADDRESS')) {

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_address');

		echo PHP_EOL .'<body id="address" class="address hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;
	}

	if (defined('INCLUDE_MINHA_CONTA')) {

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_minha_conta');

		echo PHP_EOL .'<body id="my-account" class="my-account hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;
	}

	if (defined('INCLUDE_PRODUTO')) {

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_produto');

		echo PHP_EOL .'<body id="product" class="product product-2 product-blouse category-7 category-blouses hide-left-column lang_br fullwidth">' . PHP_EOL;
	}

	if (defined('INCLUDE_ERROR')) {

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_error');

		echo PHP_EOL .'<body id="pagenotfound" class="pagenotfound hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;
	}

	if (defined('INCLUDE_SEARCH')) {

		App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_search');

		echo PHP_EOL .'<body id="best-sales" class="best-sales hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;
	}

    if (defined('INCLUDE_FALE_CONOSCO')) {

        App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'head_inc'. DS .'head_fale_conosco');

        echo PHP_EOL .'<body id="contact" class="contact hide-left-column hide-right-column lang_br fullwidth">' . PHP_EOL;
    }

	?>

		<section id="page" data-column="col-xs-12 col-sm-6 col-md-3" data-type="grid">
			<!-- Header -->
			<?php
			App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'header');
	
			//Busca com categoria
			App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'mainnav');
			?>		

			<!-- Content -->
			<?php
			echo $this->Session->flash();
            echo $this->fetch('content');
            ?>
			
			<!-- Footer -->			
			<?php
			App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'footer');
			?>
			<!-- .footer-container -->
		</section>
		<!-- #page -->
		<?php //echo $this->element('sql_dump'); ?>
	</body>
</html>