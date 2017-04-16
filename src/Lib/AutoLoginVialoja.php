<?php

namespace Lib;

use DomainException;
use InvalidArgumentException;

class AutoLoginVialoja
{

	private $link;
	private $cipher;

    private $auto_session_id;
	private $valida_id_cliente;
    private $valida_url;
    private $valida_session_id;
    private $valida_ip;
    private $valida_user_agent;
    private $valida_url_referer;
    private $valida_url_destination;
    private $url_destination;

	public function __construct()
	{
		$this->cipher = new Blowfish(VIALOJA_COOKIE_KEY, VIALOJA_COOKIE_SALT);
	}

    /**
     * @return mixed
     */
    public function getUrlDestination()
    {
        return $this->url_destination;
    }

    /**
	 * @param mixed $url_destination
     */
	public function setUrlDestination($url_destination)
    {
		$this->url_destination = $url_destination;
    }

    /**
     * @return mixed
     */
    public function getAutoSessionId()
    {
        return $this->auto_session_id;
    }

	/**
	 * @param mixed $auto_session_id
	 */
	public function setAutoSessionId($auto_session_id)
	{
		$this->auto_session_id = $auto_session_id;
	}

	public function urlAutoLoginLoja() {

    	if (isset($_SESSION['id_cliente'])) {
    		return sprintf('auto-login-loja=%s', self::tokenUrlAutoLogin());
    	} else {
    		return false;
    	}

    }

    private  function tokenUrlAutoLogin()
    {

    	$this->link = sprintf('session_id=%s', session_id() );
    	$this->link .= sprintf('&ip=%s', $_SESSION['user_ip_security'] );
    	$this->link .= sprintf('&user_agent=%s', $_SESSION['user_agent'] );

    	if (isset($this->url_destination) && !empty($this->url_destination)) {
    		$this->link .= sprintf('&url_destination=%s', $this->url_destination );
    	} else {
    		$this->link .= sprintf('&url_destination=%s', VIALOJA_HTTP_BASE );
    	}

    	$this->link .= sprintf('&url_referer=%s', env('HTTP_HOST') );
    	$this->link .= sprintf('&id_cliente=%d', $_SESSION['id_cliente'] );

    	return rawurlencode( $this->cipher->encrypt( $this->link ) );

	}

	public function urlAutoLoginPainelAdmin()
	{

		if (isset($_SESSION['id_cliente'])) {
			return sprintf('//app%s/admin/?auto-login-painel=%s',
				VIALOJA_HTTP_BASE,
				self::tokenUrlAutoLogin()
			);
		} else {
			return sprintf('//app%s/admin', VIALOJA_HTTP_BASE);
		}

    }

    public function validaTokenUrlAutoLogin($token=null, $ip=null, $user_agent=null, $url_referer=null)
    {

        $this->valida_url =  $this->cipher->decrypt( (rawurldecode( $token ) ) );

		$this->valida_session_id = preg_replace( "/session_id=([a-fA-F0-9]{64,130}).*/i", "$1", $this->valida_url );

		preg_match_all( '/&ip=(.*)&user_agent=/ism', $this->valida_url, $this->valida_ip, PREG_SET_ORDER );

		if (isset($this->valida_ip[0][1])) {

			if (filter_var( $this->valida_ip[0][1], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false) {

				$this->valida_ip = $this->valida_ip[0][1];

			} elseif (filter_var( $this->valida_ip[0][1], FILTER_VALIDATE_IP ) !== false) {

				$this->valida_ip = $this->valida_ip[0][1];

			} else {

				throw new InvalidArgumentException();

			}

		}

		if ($this->valida_ip !== $ip) {
			throw new InvalidArgumentException();
		}

		$this->valida_user_agent = preg_replace( "/.+user_agent=([a-fA-F0-9]{32}).*/i", "$1", $this->valida_url );

		if ($this->valida_user_agent !== $user_agent) {
			die(ERROR_PROCESS);
		}

		$this->valida_url_destination = preg_replace( "/.+url_destination=([a-fA-F0-9])*/i", "$1", $this->valida_url );
		$this->valida_url_destination = explode('&', $this->valida_url_destination);
		$this->valida_url_destination = $this->valida_url_destination[0];

		if (env('HTTP_BASE') !== VIALOJA_HTTP_BASE) {

			if (strpos($this->valida_url_destination, DomainCheck::check(env('HTTP_HOST'))) === false) {
                die(ERROR_PROCESS);
            }

		}

		$this->valida_url_referer = preg_replace( "/.+url_referer=([a-fA-F0-9])*/i", "$1", $this->valida_url );
		$this->valida_url_referer = explode('&', $this->valida_url_referer);
		$this->valida_url_referer = $this->valida_url_referer[0];

        $this->valida_id_cliente = preg_replace( "/.+id_cliente=([0-9]{1,11}).*/i", "$1", $this->valida_url );

        $this->CookieViaLoja = new Cookie();
        $this->CookieViaLoja->_setcookie('__vialoja_user', $this->valida_id_cliente, 3600);

        self::setAutoSessionId($this->valida_session_id);

        if (strpos($this->valida_url_referer, VIALOJA_HTTP_BASE) === false) {
            throw new DomainException( $this->valida_url_referer );
        }

    }

}
