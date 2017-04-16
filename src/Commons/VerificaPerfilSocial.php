<?php

namespace Commons;

class VerificaPerfilSocial
{

	public static function verificarUrl($link, $servico) {
	
		if (strpos($link, "http") === false) {
	        $link = "http://" . $link;
	    }
		
		$url = parse_url($link);
		
		if ($servico == 'facebook' ) {
			
			if (!preg_match("/(www\.)?facebook\.com/", $url["host"])) {
				//Not a facebook URL
				return false;
			}

			return true;	
			
		} elseif ($servico == 'twitter' ) {
			
			if (!preg_match("/(www\.)?twitter\.com/", $url["host"])) {
				//Not a twitter URL
				return false;
			}
			
			return true;
			
		} elseif ($servico == 'pinterest' ) {
			
			if (!preg_match("/(www\.)?pinterest\.com/", $url["host"])) {
				//Not a pinterest URL
				return false;
			}
			
			return true;
			
		} elseif ($servico == 'instagram' ) {
			
			if (!preg_match("/(www\.)?instagram\.com/", $url["host"])) {
				//Not a instagram URL
				return false;
			}
			
			return true;
			
		} elseif ($servico == 'google_plus' ) {
			
			if (!preg_match("/(www\.)?plus\.google\.com/", $url["host"])) {
				//Not a google_plus URL
				return false;
			}
			
			return true;
			
		} elseif ($servico == 'youtube' ) {
			
			if (!preg_match("/(www\.)?youtube\.com/", $url["host"])) {
				//Not a youtube URL
				return false;
			}
			
			return true;
			
		} else {
			
			return false;
			
		}	

	}

	public static function corrigirUrlRedeSocial($link, $servico) {

		if (strpos($link, "http") === false) {
			$link = "http://" . $link;
		}	
		
		$url = parse_url($link);
			
		if (preg_match("/(www\.)?facebook\.com/", $url["host"])) {
			
			return sprintf( 'https://www.facebook.com/%s', ltrim($url['path'],'/') );
			
		} elseif (preg_match("/(www\.)?twitter\.com/", $url["host"])) {
			
			return sprintf( 'https://twitter.com/%s', ltrim($url['path'],'/') );			
			
		} elseif (preg_match("/(www\.)?pinterest\.com/", $url["host"])) {

			return sprintf('https://www.pinterest.com/%s', ltrim($url['path'],'/') );			
			
		} elseif (preg_match("/(www\.)?instagram\.com/", $url["host"])) {

			return sprintf('http://instagram.com/%s', ltrim($url['path'],'/') );			
			
		} elseif (preg_match("/(www\.)?plus\.google\.com/", $url["host"])) {

			return sprintf('https://plus.google.com/%s', ltrim($url['path'],'/') );			
			
		} elseif (preg_match("/(www\.)?youtube\.com/", $url["host"])) {

			return sprintf('https://www.youtube.com/%s', ltrim($url['path'],'/') );
			
		} else {

			$link = str_replace("http://", "", $link);
			$link = ltrim($link,'/');

			if ($servico == 'facebook' ) {

				if (!empty($link))
					return sprintf( 'https://www.facebook.com/%s', ltrim($link,'/') );
					
			} elseif ($servico == 'twitter' ) {

				if (!empty($link))
					return sprintf( 'https://twitter.com/%s', ltrim($link,'/') );			
					
			} elseif ($servico == 'pinterest' ) {
				
				if (!empty($link))
					return sprintf('https://www.pinterest.com/%s', ltrim($link,'/') );
				
			} elseif ($servico == 'instagram' ) {

				if (!empty($link))
					return sprintf('http://instagram.com/%s', ltrim($link,'/') );			
				
			} elseif ($servico == 'google_plus' ) {
				
				if (!empty($link))
					return sprintf('https://plus.google.com/%s', ltrim($link,'/') );			
					
			} elseif ($servico == 'youtube' ) {
				
				if (!empty($link))
					return sprintf('https://www.youtube.com/%s', ltrim($link,'/') );
					
			} else {
				
				return false;
					
			}
			
		}

	}	

}
