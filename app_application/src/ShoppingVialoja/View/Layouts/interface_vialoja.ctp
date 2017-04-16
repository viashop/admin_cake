<?php
if ($this->request->controller == 'contato') {

    $title = 'Fale Conosco';
    $description = 'Entre em contato com nosso suporte por e-mail para tirar dúvidas, resolver problemas e dar sugestões. Procuraremos lhe atender da melhor forma.';
    //$description = 'Entre em contato com nosso suporte por telefone ou e-mail para tirar dúvidas, resolver problemas e dar sugestões. Procuraremos lhe atender da melhor forma.';

} elseif ($this->request->controller == 'cookies') {

    $title = 'Informações sobre Cookie';
    $description = 'Informações importantes sobre como o site ViaLoja.com usa os cookies para fazer a sua experiência no site melhor.';

} elseif ($this->request->controller == 'privacidade') {

    $title = 'Política de Privacidade';
    $description = 'Conheça a Política de Privacidade do site ViaLoja.com, regras de proteção e confidencialidade de dados e informações sobre cadastro.';

} elseif ($this->request->controller == 'termos') {

    $title = 'Termos de Uso';
    $description = '';

} elseif ($this->request->controller == 'confirmar_email') {

    $title = 'Confirme seu E-mail';
    $description = '';

} elseif ($this->request->controller == 'loja_nao_encontrada_404') {

    $title = 'Erro 404 - A Loja não foi encontrada!';
    $description = 'A loja que vc esta procurando não existe mais ou foi removida!';

} else {

    $title = 'Loja Virtual Grátis';
    $description = 'Comece sua Loja Virtual gratuitamente
Sem propagandas, Sem comissões, Sem taxas e Sem complicações.';

}

$title .= ' - ViaLoja Shopping';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title; ?></title>
        <meta name="description" content="<?php echo $description; ?>" />
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="<?php echo $description; ?>" />
        <meta property="og:site_name" content="ViaLoja" />
        <meta property="og:url" content="index.html" />
        <meta property="og:image" content="<?php echo CDN_IMG . "vialoja/logo-social-vialoja.png" ?>" />
        <meta property="og:image:type" content="image/png" />
        <link rel="shortcut icon" href="<?php printf('//cdn%s/static/img/favicon/favicon.ico?v=1', env('HTTP_BASE')); ?>">
        <link rel="apple-touch-icon image_src" href="<?php printf('//cdn%s/static/img/favicon/favicon.png?v=1', env('HTTP_BASE')); ?>">
        <link rel="stylesheet" href="/interfaces/vialoja/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/interfaces/vialoja/static/css/vialoja.css" />
        <script src="//cdn.optimizely.com/js/1407201747.js"></script>
        <script type="text/javascript" src="/interfaces/vialoja/static/js/video.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js DOES NOT work if css is loaded through a CDN - needs to be local -->
        <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
        <![endif]-->
        <script type="text/javascript" src="/interfaces/vialoja/static/js/base1.js"></script>
        <script type="text/javascript" src="/interfaces/vialoja/static/js/home1.js"></script>
    </head>
    <body class="signup-page">
        <!-- HEADER BLOCK -->
        <div id="header" class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Alternar Navegação</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php printf('//%s', env('HTTP_HOST')); ?>"><img src="<?php echo CDN_IMG . "vialoja/logos/ladding-page/default-header.png" ?>"/> </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav visible-xs">
					
                        <li><a href="<?php printf('http://%s/contato.html', env('HTTP_HOST') ); ?>">Fale Conosco</a></li>
                        <li><a href="<?php echo VIALOJA_SBLOG; ?>" target="_blank">Blog</a></li>
                        <li><a href="<?php echo VIALOJA_FORUM; ?>" target="_blank">Fórum</a></li>

                        <?php if ( $this->request->controller !== 'confirmar_email'): ?>
                        <li><a href="<?php printf('http://conta%s', env('HTTP_BASE')); ?>" target="_blank">Login</a></li>
                        <?php endif ?>

                    </ul>
                    <div class="pull-right hidden-xs">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php printf('http://%s/contato.html', env('HTTP_HOST') ); ?>">Fale Conosco</a></li>
                            <li><a href="<?php printf('http://blog%s', env('HTTP_BASE')); ?>" target="_blank">Blog</a></li>
                            <li><a href="<?php printf('http://suporte%s', env('HTTP_BASE')); ?>" target="_blank">Suporte</a></li>
                        </ul>

                        <?php if ( $this->request->controller !== 'confirmar_email'): ?>
                           <a class="btn-line" href="<?php printf('http://conta%s', env('HTTP_BASE')); ?>" target="_blank">Login</a>     
                        <?php endif ?>
                        
                    </div>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </div>

        <!-- CONTENT BLOCK -->
        <?php
        echo $this->Session->flash();
        echo $this->fetch('content');
        ?>

        <!-- FOOTER -->
        <div id="footer" class="container">
            <img src="<?php echo CDN_IMG . "vialoja/logos/ladding-page/default-transparente-footer.png" ?>" alt="ViaLoja" title="ViaLoja" /><br />
            Copyright &copy; <?php echo date('Y'); ?> ViaLoja. Todos os direitos reservados.&nbsp;&nbsp;
            <a href="<?php printf('http://%s/page/fale-conosco/', env('HTTP_HOST') ); ?>">Fale conosco</a>&nbsp;&nbsp;
            <a href="<?php printf('http://%s/page/informacoes-sobre-cookie/', env('HTTP_HOST') ); ?>">Informação sobre Cookie</a>&nbsp;&nbsp;
            <a href="<?php printf('http://%s/page/politica-de-privacidade/', env('HTTP_HOST') ); ?>">Politica de Privacidade</a>&nbsp;&nbsp;
            <a href="<?php printf('http://%s/page/termos-de-uso/', env('HTTP_HOST') ); ?>">Termos de Uso</a>
        </div>

        <?php /* ?>
        <!-- ADROLL CODE -->
        <script type="text/javascript">
            adroll_adv_id = "1111111111111";
            adroll_pix_id = "1111111111111";
            (function () {
                var oldonload = window.onload;
                window.onload = function(){
                    __adroll_loaded=true;
                    var scr = document.createElement("script");
                    var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
                    scr.setAttribute('async', 'true');
                    scr.type = "text/javascript";
                    scr.src = host + "/j/roundtrip.js";
                    ((document.getElementsByTagName('head') || [null])[0] || document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
                    if(oldonload){oldonload()}
                };
            }());
        </script>


        



        <!-- FACEBOOK REMARKETING SNIPPET -->
        <script>(function() {
            var _fbq = window._fbq || (window._fbq = []);
            if (!_fbq.loaded) {
                var fbds = document.createElement('script');
                fbds.async = true;
                fbds.src = '///connect.facebook.net/en_US/fbds.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(fbds, s);
                _fbq.loaded = true;
            }
            _fbq.push(['addPixelId', '259210877621442']);
            })();
            window._fbq = window._fbq || [];
            window._fbq.push(['track', 'PixelInitialized', {}]);
        </script>

        <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=259210877621442&amp;ev=PixelInitialized" /></noscript>
        <script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"beacon-6.newrelic.com","queueTime":0,"licenseKey":"df333275d9","agent":"js-agent.newrelic.com/nr-476.min.js","transactionName":"ZQZXMBBVXEJQUkZYDlxMcxEMV0ZYXl8dWQ5GCVQWTEJbVEZCHEIIVQ1AFFg=","applicationID":"4106170","errorBeacon":"bam.nr-data.net","applicationTime":1}</script>

        */ ?>


        <?php //echo $this->element('sql_dump'); ?>
    </body>
</html>