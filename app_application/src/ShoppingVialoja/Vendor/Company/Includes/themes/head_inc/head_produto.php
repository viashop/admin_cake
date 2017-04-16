<head>
    <meta charset="utf-8" />
    <?php if (!empty($GLOBALS['tag_title'])): ?>
        <title><?php echo $GLOBALS['tag_title'] ?> na ViaLoja</title>
    <?php else: ?>
        <title>ViaLoja Shopping</title>
    <?php endif ?>
    <meta name="description" content="<?php echo $GLOBALS['tag_description'] ?>" />
    <meta name="generator" content="ViaLoja" />
    <meta name="robots" content="index,follow" />
    <meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="icon" type="image/vnd.microsoft.icon" href="<?php printf('//cdn%s/static/img/favicon/favicon.ico?v=1', env('HTTP_BASE')); ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php printf('//cdn%s/static/img/favicon/favicon.ico?v=1', env('HTTP_BASE')); ?>" />
    <link rel="stylesheet" href="/themes/shopping/css/global.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/themes/shopping/css/autoload/uniform.default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/js/jquery/plugins/fancybox/jquery.fancybox.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/themes/shopping/css/product.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/themes/shopping/css/print.css" type="text/css" media="print" />
    <link rel="stylesheet" href="/js/jquery/plugins/jqzoom/jquery.jqzoom.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/modules/socialsharing/css/socialsharing.css" type="text/css" media="all" />
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
    <link rel="stylesheet" href="/modules/sendtoafriend/sendtoafriend.css" type="text/css" media="all" />
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
        var PS_CATALOG_MODE = false;
        var added_to_wishlist = 'Adicionado à sua Lista de presentes.';
        var ajax_allowed = true;
        var ajaxsearch = true;
        var allowBuyWhenOutOfStock = false;
        var attribute_anchor_separator = '-';
        var attributesCombinations = [];
        var availableLaterValue = '';
        var availableNowValue = 'In stock';
        var baseDir = <?php echo sprintf("'//%s/';", env('HTTP_HOST') ) . PHP_EOL;  ?>
        var baseUri = <?php echo sprintf("'%s';", \Lib\Tools::getUrl() ) . PHP_EOL; ?>
        var blocksearch_type = 'top';
        var combinationImages = [];
        var combinations = [];
        var combinationsFromController = [];
        var comparator_max_item = 3;
        var comparedProductsIds = [];
        var confirm_report_message = 'Sem comentários no momento.';
        var contentOnly = false;
        var currencyBlank = 0;
        var currencyFormat = 1;
        var currencyRate = 1;
        var currencySign = '$';
        var currentDate = '2014-10-30 08:03:41';
        var customerGroupWithoutTax = true;
        var customizationFields = false;
        var customizationIdMessage = 'Personalização #';
        var default_eco_tax = 0;
        var delete_txt = 'Apagar';
        var displayDiscountPrice = '0';
        var displayList = false;
        var displayPrice = 1;
        var doesntExist = 'O produto não existe neste modelo. Por favor escolha outro.';
        var doesntExistNoMore = 'Este produto está esgotado';
        var doesntExistNoMoreBut = 'com esses atributos, mas está disponível com outros';
        var ecotaxTax_rate = 0;
        var fieldRequired = 'Por favor, preencha todos os campos obrigatórios, em seguida salve a personalização.';
        var freeProductTranslation = 'Grátis!';
        var freeShippingTranslation = 'Frete grátis!';
        var generated_date = 1414670620;
        var group_reduction = 0;
        var idDefaultImage = 7;
        var id_lang = 5;
        var id_product = 2;
        var img_dir = '/themes/shopping/img/';
        var img_prod_dir = '/img/p/';
        var img_ps_dir = '/img/';
        var instantsearch = false;
        var isGuest = 0;
        var isLogged = 0;
        var jqZoomEnabled = true;
        var loggin_required = 'Você precisa estar logado para gerenciar sua lista de desejos.';
        var maxQuantityToAllowDisplayOfLastQuantityMessage = 3;
        var max_item = 'You cannot add more than 3 product(s) to the product comparison';
        var min_item = 'Please select at least one product';
        var minimalQuantity = 1;
        var moderation_active = true;
        var mywishlist_url = '';
        var noTaxForThisProduct = true;
        var oosHookJsCodeFunctions = [];
        var page_name = 'product';
        var placeholder_blocknewsletter = 'Enter your e-mail';
        var priceDisplayMethod = 1;
        var priceDisplayPrecision = 2;
        var productAvailableForOrder = true;
        var productBasePriceTaxExcl = '';
        var productBasePriceTaxExcluded = '';
        var productHasAttributes = true;
        var productPrice =  '';
        var productPriceTaxExcluded = '';
        var productPriceWithoutReduction = '';
        var productReference =  '';
        var productShowPrice = true;
        var productUnitPriceRatio = 0;
        var product_fileButtonHtml = 'Escolha Arquivo';
        var product_fileDefaultHtml = 'Nenhum arquivo selecionado';
        var product_specific_price = [];
        var productcomment_added = 'Seu comentário foi adicionado com sucesso!';
        var productcomment_added_moderation = 'Seu comentário foi adicionado com sucesso e ficará disponível assim que for aprovado pelo moderador.';
        var productcomment_ok = 'OK';
        var productcomment_title = 'Novo comentário';
        var productcomments_controller_url = '';
        var productcomments_url_rewrite = true;
        var quantitiesDisplayAllowed = true;
        var quantityAvailable = 1798;
        var quickView = true;
        var reduction_percent = 0;
        var reduction_price = 0;
        var removingLinkText = 'Retirar este produto do meu carrinho';
        var roundMode = 2;
        var search_url = '/s/produtos/';
        var secure_key = 'f65e9f9325df9513afcd10365dce298e';
        var specific_currency = false;
        var specific_price = 0;
        var static_token = 'c0b3b2573da6513d5d166afa8159f33b';
        var stf_msg_error = 'Seu e-mail não pode ser enviado. Por favor verifique o endereço de e-mail e tente novamente.';
        var stf_msg_required = 'Você não preencheu os campos necessários';
        var stf_msg_success = 'Seu e-mail foi enviado com sucesso';
        var stf_msg_title = 'Enviar a um amigo';
        var stf_secure_key = '3014c24e7cb124e388904abd4d3e65cb';
        var stock_management = 100;
        var taxRate = 0;
        var token = 'c0b3b2573da6513d5d166afa8159f33b';
        var upToTxt = 'Até';
        var uploading_in_progress = 'Upload em andamento, por favor aguarde ...';
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
    <script type="text/javascript" src="/js/jquery/plugins/jquery.idTabs.js"></script>
    <script type="text/javascript" src="/js/jquery/plugins/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="/js/jquery/plugins/jquery.serialScroll.js"></script>
    <script type="text/javascript" src="/js/jquery/plugins/bxslider/jquery.bxslider.js"></script>
    <script type="text/javascript" src="/themes/shopping/js/product.js"></script>
    <script type="text/javascript" src="/js/jquery/plugins/jqzoom/jquery.jqzoom.js"></script>
    <script type="text/javascript" src="/modules/socialsharing/js/socialsharing.js"></script>
    <script type="text/javascript" src="/themes/shopping/js/modules/blockcart/ajax-cart.js"></script>
    <script type="text/javascript" src="/themes/shopping/js/tools/treeManagement.js"></script>
    <script type="text/javascript" src="/themes/shopping/js/modules/blocknewsletter/blocknewsletter.js"></script>
    <script type="text/javascript" src="/js/jquery/plugins/autocomplete/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="/themes/shopping/js/modules/blocksearch/blocksearch.js"></script>
    <script type="text/javascript" src="/themes/shopping/js/modules/blockwishlist/js/ajax-wishlist.js"></script>
    <script type="text/javascript" src="/modules/productcomments/js/jquery.rating.pack.js"></script>
    <script type="text/javascript" src="/themes/shopping/js/modules/sendtoafriend/sendtoafriend.js"></script>
    <script type="text/javascript" src="/modules/leotempcp/assets/admin/colorpicker/js/colorpicker.js"></script>
    <script type="text/javascript" src="/modules/leotempcp/assets/admin/paneltool.js"></script>
    <script type="text/javascript" src="/modules/leosliderlayer/js/jquery.themepunch.plugins.min.js"></script>
    <script type="text/javascript" src="/modules/leosliderlayer/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="/modules/leoproductsearch/assets/jquery.autocomplete_productsearch.js"></script>
    <script type="text/javascript" src="/modules/leoproductsearch/assets/leosearch.js"></script>
    <script type="text/javascript" src="/modules/productcomments/js/jquery.textareaCounter.plugin.js"></script>
    <script type="text/javascript" src="/themes/shopping/js/modules/productcomments/js/productcomments.js"></script>
    <script type="text/javascript" src="/modules/leocustomajax/leocustomajax.js"></script>
    <link rel="stylesheet" type="text/css" href="/themes/shopping/css/responsive.css"/>
    <link rel="stylesheet" type="text/css" href="/themes/shopping/css/font-awesome.min.css"/>
    
    <?php echo $GLOBALS['seo_og_metas']; ?>

    <link rel="stylesheet" href="/themes/shopping/css/customize/test33.css" type="text/css" media="all" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700' rel='stylesheet' type='text/css'>
    <!--[if IE 8]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
        $(document).ready(function() {

            $('#reduction_percent').show();
            $('#reduction_percent_display').show();

            $('#old_price').show();
            $('#old_price_display').show();
            $('#availability_statut').show();

            
        });
    </script>

</head>