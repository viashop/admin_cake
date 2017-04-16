<head>
	<meta charset="utf-8" />
	<title>ViaLoja.com - Um Shopping todo Seu!</title>
	<meta name="description" content="Shop powered by ViaLoja" />
	<meta name="generator" content="ViaLoja" />
	<meta name="robots" content="index,follow" />
	<meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="icon" type="image/vnd.microsoft.icon" href="<?php printf('//cdn%s/static/img/favicon/favicon.ico?v=1', env('HTTP_BASE')); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php printf('//cdn%s/static/img/favicon/favicon.ico?v=1', env('HTTP_BASE')); ?>" />
	<link rel="stylesheet" href="/themes/shopping/css/global.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/autoload/uniform.default.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/js/jquery/plugins/fancybox/jquery.fancybox.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/product_list.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockcart/blockcart.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockcategories/blockcategories.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockcurrencies/blockcurrencies.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blocklanguages/blocklanguages.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockcontact/blockcontact.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blocknewsletter/blocknewsletter.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/js/jquery/plugins/autocomplete/jquery.autocomplete.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blocksearch/blocksearch.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockuserinfo/blockuserinfo.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/homeslider/homeslider.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/modules/themeconfigurator/css/hooks.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockwishlist/blockwishlist.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/productcomments/productcomments.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/leomanagewidgets/assets/styles.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/paneltool.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/modules/leotempcp/assets/admin/colorpicker/css/colorpicker.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/leomenusidebar/leomenusidebar.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/leosliderlayer/css/typo.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/leoproductsearch/assets/leosearch.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/modules/leoproductsearch/assets/jquery.autocomplete_productsearch.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/leobootstrapmenu/megamenu.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/leocustomajax/leocustomajax.css" type="text/css" media="all" />
	<script type="text/javascript">
		var CUSTOMIZE_TEXTFIELD = 1;
		var FancyboxI18nClose = 'Fechar';
		var FancyboxI18nNext = 'Pr&oacute;ximo';
		var FancyboxI18nPrev = 'Anterior';
		var added_to_wishlist = 'Adicionado à sua Lista de presentes.';
		var ajax_allowed = true;
		var ajaxsearch = true;
		var baseDir = <?php echo sprintf("'//%s/';", env('HTTP_HOST') ) . PHP_EOL;  ?>
		var baseUri = <?php echo sprintf("'%s';", \Lib\Tools::getUrl() ) . PHP_EOL; ?>
		var blocksearch_type = 'top';
		var comparator_max_item = 3;
		var comparedProductsIds = [];
		var contentOnly = false;
		var customizationIdMessage = 'Personalização #';
		var delete_txt = 'Apagar';
		var displayList = false;
		var freeProductTranslation = 'Grátis!';
		var freeShippingTranslation = 'Frete grátis!';
		var generated_date = 1414099028;
		var homeslider_loop = 1;
		var homeslider_pause = 3000;
		var homeslider_speed = 500;
		var homeslider_width = 779;
		var id_lang = 5;
		var img_dir = <?php echo sprintf("'//%s/img/';", env('HTTP_HOST') ) . PHP_EOL; ?>
		var instantsearch = false;
		var isGuest = 0;
		var isLogged = 0;
		var loggin_required = 'Você precisa estar logado para gerenciar sua lista de desejos.';
		var max_item = 'You cannot add more than 3 product(s) to the product comparison';
		var min_item = 'Please select at least one product';
		var mywishlist_url = <?php echo sprintf("'//%s/cliente/conta/login';", env('HTTP_HOST') ) . PHP_EOL; ?>
		var page_name = 'index';
		var placeholder_blocknewsletter = 'Enter your e-mail';
		var priceDisplayMethod = 1;
		var priceDisplayPrecision = 2;
		var quickView = true;
		var removingLinkText = 'Retirar este produto do meu carrinho';
		var roundMode = 2;
		var search_url = '/s/produtos/';
		var static_token = 'c0b3b2573da6513d5d166afa8159f33b';
		var token = 'aa5cc7c5ab4b7ea2656433de3659a0c0';
		var usingSecureMode = false;
		var wishlistProductsIds = false;
	</script>
	<script type="text/javascript" src="/js/jquery/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/js/jquery/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="/js/jquery/plugins/jquery.easing.js"></script>
	<script type="text/javascript" src="/js/tools.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/global.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/autoload/10-bootstrap.min.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/autoload/15-jquery.total-storage.min.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/autoload/15-jquery.uniform-modified.js"></script>
	<script type="text/javascript" src="/js/jquery/plugins/fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/products-comparison.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/modules/blockcart/ajax-cart.js"></script>
	<script type="text/javascript" src="/js/jquery/plugins/jquery.scrollTo.js"></script>
	<script type="text/javascript" src="/js/jquery/plugins/jquery.serialScroll.js"></script>
	<script type="text/javascript" src="/js/jquery/plugins/bxslider/jquery.bxslider.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/tools/treeManagement.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/modules/blocknewsletter/blocknewsletter.js"></script>
	<script type="text/javascript" src="/js/jquery/plugins/autocomplete/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/modules/blocksearch/blocksearch.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/modules/homeslider/js/homeslider.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/modules/blockwishlist/js/ajax-wishlist.js"></script>
	<script type="text/javascript" src="/modules/leotempcp/assets/admin/colorpicker/js/colorpicker.js"></script>
	<script type="text/javascript" src="/modules/leotempcp/assets/admin/paneltool.js"></script>
	<script type="text/javascript" src="/modules/leosliderlayer/js/jquery.themepunch.plugins.min.js"></script>
	<script type="text/javascript" src="/modules/leosliderlayer/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="/modules/leoproductsearch/assets/jquery.autocomplete_productsearch.js"></script>
	<script type="text/javascript" src="/modules/leoproductsearch/assets/leosearch.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/index.js"></script>
	<script type="text/javascript" src="/modules/leocustomajax/leocustomajax.js"></script>
	<link rel="stylesheet" type="text/css" href="/themes/shopping/css/responsive.css"/>
	<link rel="stylesheet" type="text/css" href="/themes/shopping/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="/themes/shopping/css/customize/test33.css" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700' rel='stylesheet' type='text/css'>
	<!--[if IE 8]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
