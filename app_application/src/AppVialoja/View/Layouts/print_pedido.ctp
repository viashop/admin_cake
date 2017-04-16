<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt_BR" class="no-js">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="author" content="Loja Integrada">
        <meta name="language" content="pt-br">
        <title>Impressão pedido #1 - Loja Integrada</title>
        <?php
         echo $this->element('favicon');
        ?>
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <link rel="stylesheet" href="/admin/css/bootstrap.min.css" type="text/css">
        <!--<link rel="stylesheet" href="/admin/css/struct.css" type="text/css" media="screen">
            <link rel="stylesheet" href="/admin/css/custom.css" type="text/css" media="screen">-->
        <link rel="stylesheet" href="/admin/css/struct-impressao.css" type="text/css" media="all">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700" type="text/css">
        <script type="text/javascript">
            MEDIA_URL = '//cdn.awsli.com.br/';
            ADMIN_STATIC_URL = '';
            STATIC_URL = '';
            MERCADOLIVRE_CLIENT_ID = '289562525079213';
        </script>
        <script type="text/javascript" src="/admin/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="/admin/js/jquery-migrate-1.1.1.min.js"></script>
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/admin/js/excanvas.min.js"></script><![endif]-->
        <!--<script type="text/javascript" src="/admin/js/main.js"></script>-->
        <script type="text/javascript">
            apelido_conta = 'casaclanels';
            $(document).ready(function () {
                window.print();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
            });
        </script>

    </head>
    <body class="">
        <div id="globalContainerPrint">
            <?php echo $this->fetch('content'); ?>
        </div>
        <script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"beacon-5.newrelic.com","queueTime":0,"licenseKey":"294ddb18dc","agent":"js-agent.newrelic.com/nr-378.min.js","transactionName":"ZVZRZkYCXxYCBUZbW1wcdUdaAEUMDAgdXl1QQB1HQApdFlkIV0U=","applicationID":"2080144","errorBeacon":"jserror.newrelic.com","applicationTime":178}</script>
    </body>
</html>