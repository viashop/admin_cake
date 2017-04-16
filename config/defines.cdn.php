<?php
/**
*
* Define as constantes de url para cdn
*
**/
define('CDN', '//cdn.vialoja.com.br/');
define('CDN_JS', CDN .'static/js/');
define('CDN_CSS', CDN .'static/css/');
define('CDN_IMG', CDN .'static/img/');
define('CDN_UPLOAD', CDN .'upload/');

/**
*
* Define as constantes de path para cdn
*
**/
define('CDN_ROOT', dirname(dirname(ROOT)) . DS .'public_html'.  DS . 'subdomain'. DS .'cdn'. DS);
define('CDN_ROOT_UPLOAD', dirname(dirname(ROOT)) . DS .'public_html'.  DS . 'subdomain'. DS .'cdn'. DS . 'upload' . DS);
define('CDN_ROOT_STATIC', CDN_ROOT .'static'. DS);
