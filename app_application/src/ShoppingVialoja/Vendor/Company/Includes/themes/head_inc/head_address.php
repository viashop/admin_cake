<head>
	<meta charset="utf-8" />
	<title>Address - ViaLoja Shopping</title>
	<meta name="generator" content="ViaLoja" />
	<meta name="robots" content="index,follow" />
	<meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="icon" type="image/vnd.microsoft.icon" href="<?php printf('//cdn%s/static/img/favicon/favicon.ico?v=1', env('HTTP_BASE')); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php printf('//cdn%s/static/img/favicon/favicon.ico?v=1', env('HTTP_BASE')); ?>" />
	<link rel="stylesheet" href="/themes/shopping/css/global.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/autoload/uniform.default.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/js/jquery/plugins/fancybox/jquery.fancybox.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockcart/blockcart.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockcategories/blockcategories.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockcurrencies/blockcurrencies.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blocklanguages/blocklanguages.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockcontact/blockcontact.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blocknewsletter/blocknewsletter.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/js/jquery/plugins/autocomplete/jquery.autocomplete.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/product_list.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blocksearch/blocksearch.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/themes/shopping/css/modules/blockuserinfo/blockuserinfo.css" type="text/css" media="all" />
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
		var countries = {"21":{"id_country":"21","id_lang":"5","name":"United States","id_zone":"2","id_currency":"0","iso_code":"US","call_prefix":"1","active":"1","contains_states":"1","need_identification_number":"0","need_zip_code":"1","zip_code_format":"NNNNN","display_tax_label":"0","country":"United States","zone":"North America","states":[{"id_state":"1","id_country":"21","id_zone":"2","name":"Alabama","iso_code":"AL","tax_behavior":"0","active":"1"},{"id_state":"2","id_country":"21","id_zone":"2","name":"Alaska","iso_code":"AK","tax_behavior":"0","active":"1"},{"id_state":"3","id_country":"21","id_zone":"2","name":"Arizona","iso_code":"AZ","tax_behavior":"0","active":"1"},{"id_state":"4","id_country":"21","id_zone":"2","name":"Arkansas","iso_code":"AR","tax_behavior":"0","active":"1"},{"id_state":"5","id_country":"21","id_zone":"2","name":"California","iso_code":"CA","tax_behavior":"0","active":"1"},{"id_state":"6","id_country":"21","id_zone":"2","name":"Colorado","iso_code":"CO","tax_behavior":"0","active":"1"},{"id_state":"7","id_country":"21","id_zone":"2","name":"Connecticut","iso_code":"CT","tax_behavior":"0","active":"1"},{"id_state":"8","id_country":"21","id_zone":"2","name":"Delaware","iso_code":"DE","tax_behavior":"0","active":"1"},{"id_state":"53","id_country":"21","id_zone":"2","name":"District of Columbia","iso_code":"DC","tax_behavior":"0","active":"1"},{"id_state":"9","id_country":"21","id_zone":"2","name":"Florida","iso_code":"FL","tax_behavior":"0","active":"1"},{"id_state":"10","id_country":"21","id_zone":"2","name":"Georgia","iso_code":"GA","tax_behavior":"0","active":"1"},{"id_state":"11","id_country":"21","id_zone":"2","name":"Hawaii","iso_code":"HI","tax_behavior":"0","active":"1"},{"id_state":"12","id_country":"21","id_zone":"2","name":"Idaho","iso_code":"ID","tax_behavior":"0","active":"1"},{"id_state":"13","id_country":"21","id_zone":"2","name":"Illinois","iso_code":"IL","tax_behavior":"0","active":"1"},{"id_state":"14","id_country":"21","id_zone":"2","name":"Indiana","iso_code":"IN","tax_behavior":"0","active":"1"},{"id_state":"15","id_country":"21","id_zone":"2","name":"Iowa","iso_code":"IA","tax_behavior":"0","active":"1"},{"id_state":"16","id_country":"21","id_zone":"2","name":"Kansas","iso_code":"KS","tax_behavior":"0","active":"1"},{"id_state":"17","id_country":"21","id_zone":"2","name":"Kentucky","iso_code":"KY","tax_behavior":"0","active":"1"},{"id_state":"18","id_country":"21","id_zone":"2","name":"Louisiana","iso_code":"LA","tax_behavior":"0","active":"1"},{"id_state":"19","id_country":"21","id_zone":"2","name":"Maine","iso_code":"ME","tax_behavior":"0","active":"1"},{"id_state":"20","id_country":"21","id_zone":"2","name":"Maryland","iso_code":"MD","tax_behavior":"0","active":"1"},{"id_state":"21","id_country":"21","id_zone":"2","name":"Massachusetts","iso_code":"MA","tax_behavior":"0","active":"1"},{"id_state":"22","id_country":"21","id_zone":"2","name":"Michigan","iso_code":"MI","tax_behavior":"0","active":"1"},{"id_state":"23","id_country":"21","id_zone":"2","name":"Minnesota","iso_code":"MN","tax_behavior":"0","active":"1"},{"id_state":"24","id_country":"21","id_zone":"2","name":"Mississippi","iso_code":"MS","tax_behavior":"0","active":"1"},{"id_state":"25","id_country":"21","id_zone":"2","name":"Missouri","iso_code":"MO","tax_behavior":"0","active":"1"},{"id_state":"26","id_country":"21","id_zone":"2","name":"Montana","iso_code":"MT","tax_behavior":"0","active":"1"},{"id_state":"27","id_country":"21","id_zone":"2","name":"Nebraska","iso_code":"NE","tax_behavior":"0","active":"1"},{"id_state":"28","id_country":"21","id_zone":"2","name":"Nevada","iso_code":"NV","tax_behavior":"0","active":"1"},{"id_state":"29","id_country":"21","id_zone":"2","name":"New Hampshire","iso_code":"NH","tax_behavior":"0","active":"1"},{"id_state":"30","id_country":"21","id_zone":"2","name":"New Jersey","iso_code":"NJ","tax_behavior":"0","active":"1"},{"id_state":"31","id_country":"21","id_zone":"2","name":"New Mexico","iso_code":"NM","tax_behavior":"0","active":"1"},{"id_state":"32","id_country":"21","id_zone":"2","name":"New York","iso_code":"NY","tax_behavior":"0","active":"1"},{"id_state":"33","id_country":"21","id_zone":"2","name":"North Carolina","iso_code":"NC","tax_behavior":"0","active":"1"},{"id_state":"34","id_country":"21","id_zone":"2","name":"North Dakota","iso_code":"ND","tax_behavior":"0","active":"1"},{"id_state":"35","id_country":"21","id_zone":"2","name":"Ohio","iso_code":"OH","tax_behavior":"0","active":"1"},{"id_state":"36","id_country":"21","id_zone":"2","name":"Oklahoma","iso_code":"OK","tax_behavior":"0","active":"1"},{"id_state":"37","id_country":"21","id_zone":"2","name":"Oregon","iso_code":"OR","tax_behavior":"0","active":"1"},{"id_state":"38","id_country":"21","id_zone":"2","name":"Pennsylvania","iso_code":"PA","tax_behavior":"0","active":"1"},{"id_state":"51","id_country":"21","id_zone":"2","name":"Puerto Rico","iso_code":"PR","tax_behavior":"0","active":"1"},{"id_state":"39","id_country":"21","id_zone":"2","name":"Rhode Island","iso_code":"RI","tax_behavior":"0","active":"1"},{"id_state":"40","id_country":"21","id_zone":"2","name":"South Carolina","iso_code":"SC","tax_behavior":"0","active":"1"},{"id_state":"41","id_country":"21","id_zone":"2","name":"South Dakota","iso_code":"SD","tax_behavior":"0","active":"1"},{"id_state":"42","id_country":"21","id_zone":"2","name":"Tennessee","iso_code":"TN","tax_behavior":"0","active":"1"},{"id_state":"43","id_country":"21","id_zone":"2","name":"Texas","iso_code":"TX","tax_behavior":"0","active":"1"},{"id_state":"52","id_country":"21","id_zone":"2","name":"US Virgin Islands","iso_code":"VI","tax_behavior":"0","active":"1"},{"id_state":"44","id_country":"21","id_zone":"2","name":"Utah","iso_code":"UT","tax_behavior":"0","active":"1"},{"id_state":"45","id_country":"21","id_zone":"2","name":"Vermont","iso_code":"VT","tax_behavior":"0","active":"1"},{"id_state":"46","id_country":"21","id_zone":"2","name":"Virginia","iso_code":"VA","tax_behavior":"0","active":"1"},{"id_state":"47","id_country":"21","id_zone":"2","name":"Washington","iso_code":"WA","tax_behavior":"0","active":"1"},{"id_state":"48","id_country":"21","id_zone":"2","name":"West Virginia","iso_code":"WV","tax_behavior":"0","active":"1"},{"id_state":"49","id_country":"21","id_zone":"2","name":"Wisconsin","iso_code":"WI","tax_behavior":"0","active":"1"},{"id_state":"50","id_country":"21","id_zone":"2","name":"Wyoming","iso_code":"WY","tax_behavior":"0","active":"1"}]}};
		var customizationIdMessage = 'Personalização #';
		var delete_txt = 'Apagar';
		var displayList = false;
		var freeProductTranslation = 'Grátis!';
		var freeShippingTranslation = 'Frete grátis!';
		var generated_date = 1414456914;
		var idSelectedCountry = false;
		var idSelectedState = false;
		var id_lang = 5;
		var img_dir = '/themes/shopping/img/';
		var instantsearch = false;
		var isGuest = 0;
		var isLogged = 1;
		var loggin_required = 'Você precisa estar logado para gerenciar sua lista de desejos.';
		var max_item = 'You cannot add more than 3 product(s) to the product comparison';
		var min_item = 'Please select at least one product';
		var mywishlist_url = 'http://demo4leotheme.com/prestashop/shopping/br/module/blockwishlist/mywishlist';
		var page_name = 'address';
		var placeholder_blocknewsletter = 'Enter your e-mail';
		var priceDisplayMethod = 1;
		var priceDisplayPrecision = 2;
		var quickView = true;
		var removingLinkText = 'Retirar este produto do meu carrinho';
		var roundMode = 2;
		var search_url = 'http://demo4leotheme.com/prestashop/shopping/br/module/leoproductsearch/productsearch';
		var static_token = '76a0ad76a75dad2f86e01eb8a1e04e1c';
		var token = '76a0ad76a75dad2f86e01eb8a1e04e1c';
		var usingSecureMode = false;
		var vatnumber_ajax_call = true;
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
	<script type="text/javascript" src="/themes/shopping/js/tools/vatManagement.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/tools/statesManagement.js"></script>
	<script type="text/javascript" src="/js/validate.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/modules/blockcart/ajax-cart.js"></script>
	<script type="text/javascript" src="/js/jquery/plugins/jquery.scrollTo.js"></script>
	<script type="text/javascript" src="/js/jquery/plugins/jquery.serialScroll.js"></script>
	<script type="text/javascript" src="/js/jquery/plugins/bxslider/jquery.bxslider.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/tools/treeManagement.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/modules/blocknewsletter/blocknewsletter.js"></script>
	<script type="text/javascript" src="/js/jquery/plugins/autocomplete/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/modules/blocksearch/blocksearch.js"></script>
	<script type="text/javascript" src="/themes/shopping/js/modules/blockwishlist/js/ajax-wishlist.js"></script>
	<script type="text/javascript" src="/modules/leotempcp/assets/admin/colorpicker/js/colorpicker.js"></script>
	<script type="text/javascript" src="/modules/leotempcp/assets/admin/paneltool.js"></script>
	<script type="text/javascript" src="/modules/leosliderlayer/js/jquery.themepunch.plugins.min.js"></script>
	<script type="text/javascript" src="/modules/leosliderlayer/js/jquery.themepunch.revolution.min.js"></script>
	<script type="text/javascript" src="/modules/leoproductsearch/assets/jquery.autocomplete_productsearch.js"></script>
	<script type="text/javascript" src="/modules/leoproductsearch/assets/leosearch.js"></script>
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