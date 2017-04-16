<?php

namespace Lib;

/**
* Request URI para Router
*/
class RouterUri
{

	public static function getUri()
	{
		$url = Tools::clean( $_SERVER['REQUEST_URI'] );
		$url = rtrim( $url, '/');
		$url =  explode( '/',  $url);
		return $url;
	}

}
