<?php
/**
* https://www.owasp.org/index.php/PHP_CSRF_Guard
*/
namespace CSRF;

/**
 * Class CSRFGuard
 * @package CSRF
 */
class CSRFGuard implements isCSRFGuard {

    /**
     * @param $key
     * @param $value
     */
    public function store_in_session($key,$value)
	{
		if (isset($_SESSION))
		{
			$_SESSION[$key]=$value;
		}
	}

    /**
     * @param $key
     */
    public function unset_session($key)
	{
		$_SESSION[$key]=' ';
		unset($_SESSION[$key]);
	}

    /**
     * @param $key
     * @return bool
     */
    public function get_from_session($key)
	{
		if (isset($_SESSION[$key]))
		{
			return $_SESSION[$key];
		}
		else {  return false; }
	}

    /**
     * @param $unique_form_name
     * @return string
     */
    public function csrfguard_generate_token($unique_form_name)
	{
		if (function_exists("hash_algos") and in_array("sha512",hash_algos()))
		{
			$token=hash("sha512",mt_rand(0,mt_getrandmax()));
		}
		else
		{
			$token=' ';
			for ($i=0;$i<128;++$i)
			{
				$r=mt_rand(0,35);
				if ($r<26)
				{
					$c=chr(ord('a')+$r);
				}
				else
				{ 
					$c=chr(ord('0')+$r-26);
				} 
				$token.=$c;
			}
		}
		$this->store_in_session($unique_form_name,$token);
		return $token;
	}

    /**
     * @param $unique_form_name
     * @param $token_value
     * @return bool
     */
    public function csrfguard_validate_token($unique_form_name,$token_value)
	{
		$token=$this->get_from_session($unique_form_name);

		if ($token===false)
		{
			return false;
		}
		elseif ($token===$token_value)
		{
			$result=true;
		}
		else
		{ 
			$result=false;
		} 

		return $result;
	}
}
