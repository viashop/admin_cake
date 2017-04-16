<?php
define('VIALOJA_BASE', ltrim( env('HTTP_BASE'), '.') );
define('PAINEL_ADMIN_LOJA', sprintf('//%s/admin', env('HTTP_HOST') ) );

/* Configurações de acesso ao servidor */
define('SERVIDOR_HOST', 'svr2.ravehost.com.br');
define('SERVIDOR_USUARIO', 'vialojsd');
define('SERVIDOR_SENHA', '9j65yrqAS5');
define('SERVIDOR_ROOT_DOMAIN', 'vialoja.com.br');

define('EMAIL_AUTENTICACAO_GMAIL', 'dmlhbG9qYUBnbWFpbC5jb20='); //base64
define('HOST_AUTENTICACAO_GMAIL', 'c210cC5nbWFpbC5jb20='); //base64
define('PASS_AUTENTICACAO_GMAIL', 'd3NkYWRtOTg3Ki4q'); //base64

define('EMAIL_ADMIN', 'd3NkdWFydGVAb3V0bG9vay5jb20='); //base64
define('EMAIL_SUPORTE', 'c3Vwb3J0ZUB2aWFsb2phLmNvbS5icg=='); //base64
define('PASS_EMAIL_SUPORTE', ''); //base64

define('VIALOJA_COOKIE_KEY', '552880850458559764584');
define('VIALOJA_COOKIE_SALT', 'sU28zymwgByuij1A4MhgW');
define('VIALOJA_DATA_KEY', '692306192277659013156');
define('VIALOJA_DATA_SALT', 'ZAbvICaQEgnUpMETGzptY');

define('VIALOJA_RAZAO_SOCIAL', 'ViaLoja Shopping Virtual LTDA');

define('CONFIG_PHPMAILER_FROM', 'Y29udGF0b0B2aWFsb2phLmNvbS5icg=='); //base64
define('CONFIG_PHPMAILER_FROM_NAME', 'U3Vwb3J0ZSBWaWFMb2phIFNob3BwaW5n'); //base64
define('CONFIG_PHPMAILER_REPLY_TO', 'Y29udGF0b0B2aWFsb2phLmNvbS5icg=='); //base64
define('CONFIG_PHPMAILER_HOST', 'c210cC5zZW5kZ3JpZC5uZXQ='); //base64
define('CONFIG_PHPMAILER_USERNAME', 'dmlhbG9qYQ=='); //base64
define('CONFIG_PHPMAILER_PASSWORD', 'V3NkYWRtOTg3Ki4q'); //base64

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
