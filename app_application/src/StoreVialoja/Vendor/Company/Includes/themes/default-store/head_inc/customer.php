<head>
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Mobile viewport optimized: h5bp.com/viewport -->
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <?php 
    if (defined('CUSTOMER_LOGIN_SHOP_LOJA')) {

        echo '<title>Login ou Criar Conta</title>' . PHP_EOL;
        echo '<meta name="description" content="Default Description" />' . PHP_EOL;
        echo '<meta name="keywords" content="ViaLoja, Login E-commerce" />' . PHP_EOL;

    }

    if (defined('CUSTOMER_FORGOTPASSWORD_SHOP_LOJA')) {

        echo '<title>Esqueceu sua senha?</title>' . PHP_EOL;
        echo '<meta name="description" content="Default Description" />' . PHP_EOL;
        echo '<meta name="keywords" content="ViaLoja, Login E-commerce" />' . PHP_EOL;

    }

    if (defined('CUSTOMER_CREATE_SHOP_LOJA')) {

        echo '<title>Criar nova conta de cliente</title>' . PHP_EOL;
        echo '<meta name="description" content="Default Description" />' . PHP_EOL;
        echo '<meta name="keywords" content="ViaLoja, Login E-commerce" />' . PHP_EOL;

    }
    ?>
    
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="icon" href="/superstore/skin/frontend/default/ves_superstore/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/superstore/skin/frontend/default/ves_superstore/favicon.ico" type="image/x-icon" />
    <base href="/" />
    <!--[if lt IE 7]>
    <script type="text/javascript">
        //<![CDATA[
            var BLANK_URL = '/superstore/js/blank.html';
            var BLANK_IMG = '/superstore/js/spacer.gif';
        //]]>
    </script>
    <![endif]-->
    <script type="text/javascript">
        var ajaxCart = true;
    </script>
    <script type="text/javascript">
        var minicart_url = "/checkout/minicart/index/";
    </script>
    <link rel="stylesheet" type="text/css" href="/superstore/js/ves_layerslider/lush/css/lush.animations.min.css" />
    <link rel="stylesheet" type="text/css" href="/superstore/js/ves_layerslider/lush/css/lush.min.css" />
    <link rel="stylesheet" type="text/css" href="/superstore/js/ves_layerslider/lush/css/lush.items.min.css" />
    <link rel="stylesheet" type="text/css" href="/superstore/js/venustheme/ves_tempcp/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/js/venustheme/ves_tempcp/jquery/colorbox/colorbox.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/css/bootstrap.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/css/styles.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/base/default/css/widgets.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/ves_autosearch/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/ves_blog/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/base/default/ves_brand/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/ves_layerslider/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/ves_megamenu/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/ves_productcarousel/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/ves_productcarousel2/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/venustheme/ves_tempcp/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/ves_verticalmenu/style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/css/custom-font.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/css/font-awesome.min.css" media="all" />
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/css/print.css" media="print" />
    <script type="text/javascript" src="/superstore/js/prototype/prototype.js"></script>
    <script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/jquery/conflict.js"></script>
    <script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/jquery/ui/external/jquery.cookie.js"></script>
    <script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/jquery/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="/superstore/js/lib/ccard.js"></script>
    <script type="text/javascript" src="/superstore/js/prototype/validation.js"></script>
    <script type="text/javascript" src="/superstore/js/scriptaculous/builder.js"></script>
    <script type="text/javascript" src="/superstore/js/scriptaculous/effects.js"></script>
    <script type="text/javascript" src="/superstore/js/scriptaculous/dragdrop.js"></script>
    <script type="text/javascript" src="/superstore/js/scriptaculous/controls.js"></script>
    <script type="text/javascript" src="/superstore/js/scriptaculous/slider.js"></script>
    <script type="text/javascript" src="/superstore/js/varien/js.js"></script>
    <script type="text/javascript" src="/superstore/js/varien/form.js"></script>
    <script type="text/javascript" src="/superstore/js/varien/menu.js"></script>
    <script type="text/javascript" src="/superstore/js/mage/translate.js"></script>
    <script type="text/javascript" src="/superstore/js/mage/cookies.js"></script>
    <script type="text/javascript" src="/superstore/js/ves_layerslider/lush/js/jquery.easing.1.3.min.js"></script>
    <script type="text/javascript" src="/superstore/js/ves_layerslider/lush/js/jquery.lush.min.js"></script>
    <script type="text/javascript" src="/superstore/js/ves_parallax/jquery.parallax-1.1.3.js"></script>
    <script type="text/javascript" src="/superstore/js/mage/captcha.js"></script>
    <script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/jquery/colorbox/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/common.js"></script>
    <script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/jquery/tabs.js"></script>
    <script type="text/javascript" src="/superstore/skin/frontend/default/ves_superstore/javascript/common.js"></script>
    <!--[if lt IE 7]>
    <script type="text/javascript" src="/superstore/js/lib/ds-sleight.js"></script>
    <script type="text/javascript" src="/superstore/skin/frontend/base/default/js/ie6.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/css/styles-ie.css" media="all" />
    <![endif]-->
    <!--[if gt IE 6]>
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/css/styles-iefont.css" media="all" />
    <![endif]-->
    <script type="text/javascript">
        //<![CDATA[
        Mage.Cookies.path     = '/magento/superstore';
        Mage.Cookies.domain   = '.venusdemo.com';
        //]]>
    </script>
    <script type="text/javascript">
        //<![CDATA[
        optionalZipCountries = ["HK","IE","MO","PA"];
        //]]>
    </script>
    <script type="text/javascript">//<![CDATA[
        var Translator = new Translate([]);
        //]]>
    </script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"/>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"/>
    <style>
        body {font-family:Verdana, Geneva, sans-serif}
        h1, h2, h3, h4, h5, h6,
        .h1, .h2, .h3, .h4, .h5, .h6 {font-family:"Open Sans", sans-serif}
        body {font-family:"Open Sans", sans-serif}
    </style>
    <link rel="stylesheet" type="text/css" href="/superstore/skin/frontend/default/ves_superstore/css/paneltool.css" />
    <script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/jquery/colorpicker/js/colorpicker.js"></script>
    <link rel="stylesheet" type="text/css" href="/superstore/js/venustheme/ves_tempcp/jquery/colorpicker/css/colorpicker.css" />
    <!--link href='//fonts.googleapis.com/css?family=Roboto:400,300,100italic,100,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'-->
    <!--[if lt IE 9]>
    <script src="/superstore/js/venustheme/ves_tempcp/html5.js"></script>
    <script src="/superstore/js/venustheme/ves_tempcp/respond.min.js"></script>
    <![endif]-->
</head>

<?php 
if (defined('CUSTOMER_LOGIN_SHOP_LOJA')) {

    echo '<body id="offcanvas-container" class="  customer-account-login offcanvas-container layout-fullwidth fs13  ">' . PHP_EOL;

}

if (defined('CUSTOMER_FORGOTPASSWORD_SHOP_LOJA')) {

    echo '<body id="offcanvas-container" class="  customer-account-forgotpassword offcanvas-container layout-fullwidth fs13  ">' . PHP_EOL;

}

if (defined('CUSTOMER_CREATE_SHOP_LOJA')) {

    echo '<body id="offcanvas-container" class="  customer-account-create offcanvas-container layout-fullwidth fs13  ">' . PHP_EOL;

}
?>