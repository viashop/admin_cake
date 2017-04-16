<?php
/**
*
* Define as constantes de url para Vialoja
*
**/

//define('VIALOJA_HTTP_HOST', sprintf('http://%s', env('HTTP_HOST') ) );
define('VIALOJA_HTTP_HOST', 'http://vialoja.com.br');
define('VIALOJA_HTTP_BASE', '.vialoja.com.br');
define('VIALOJA_SUPORTE_TXT_EMAIL', 'vialoja.com.br/suporte/');

define('VIALOJA_FORUM', 'http://forum' . VIALOJA_HTTP_BASE );
define('VIALOJA_SUPORTE', VIALOJA_HTTP_HOST . '/suporte/' );
define('VIALOJA_BLOG', 'http://blog' . VIALOJA_HTTP_BASE );
define('VIALOJA_ECOMMERCE', VIALOJA_HTTP_HOST . '/ecommerce/' );
define('VIALOJA_DESK', 'http://desk' . VIALOJA_HTTP_BASE );

define('VIALOJA_FALE_CONOSCO', VIALOJA_HTTP_HOST. '/fale-conosco/' );
define('VIALOJA_TERMO_USO', VIALOJA_HTTP_HOST. '/termos-de-uso/' );
define('VIALOJA_POLITICA_PRIVACIDADE', VIALOJA_HTTP_HOST . '/politica-de-privacidade/' );
define('VIALOJA_COOKIE', VIALOJA_HTTP_HOST . '/informacoes-sobre-cookies/' );

define('VIALOJA_APP', 'http://app' . VIALOJA_HTTP_BASE );

define('VIALOJA_APP_LOGIN', VIALOJA_APP . '/public/login/' );
define('VIALOJA_PAINEL', VIALOJA_APP . '/admin');
define('VIALOJA_PUBLIC', VIALOJA_APP . '/public');
define('VIALOJA_ADMIN', VIALOJA_APP . '/admin');
define('VIALOJA_TICKET', VIALOJA_APP .'/suporte/ticket');
define('VIALOJA_TICKET_CLIENTE', VIALOJA_APP .'/suporte/ticket/clientearea');

