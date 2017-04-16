<?php

namespace Correios\Curl;

class CURL {
	
	public static function file_get_contents($url, $use_include_path = false, $stream_context = null, $curl_timeout = 5)
	{
		if ($stream_context == null && preg_match('/^https?:\/\//', $url))
			$stream_context = @stream_context_create(array('http' => array('timeout' => $curl_timeout)));
		if (in_array(ini_get('allow_url_fopen'), array('On', 'on', '1')) || !preg_match('/^https?:\/\//', $url))
			return @file_get_contents($url, $use_include_path, $stream_context);
		elseif (function_exists('curl_init'))
		{
			$curl = curl_init();
			
			/*
			 * Verificamos se o recurso CURL foi criado com êxito
			 */
			if ( is_resource( $curl ) ) {
				
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
				curl_setopt($curl, CURLOPT_TIMEOUT, $curl_timeout);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
				if ($stream_context != null) {
					$opts = stream_context_get_options($stream_context);
					if (isset($opts['http']['method']) && Tools::strtolower($opts['http']['method']) == 'post')
					{
						curl_setopt($curl, CURLOPT_POST, true);
						if (isset($opts['http']['content']))
						{
							parse_str($opts['http']['content'], $datas);
							curl_setopt($curl, CURLOPT_POSTFIELDS, $datas);
						}
					}
				}
				$content = curl_exec($curl);
				curl_close($curl);
				return $content;
			
			} else {
				return false;
			}
		}
		else
			return false;
	}
	
}
