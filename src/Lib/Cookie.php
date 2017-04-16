<?php

namespace Lib;

class Cookie
{

	public static $instance = null;
	protected $content;
	protected $time;
	protected $name;
	protected $expire;
	protected $host;
	protected $domain;
	protected $path = '/';
	protected $cipher;
	protected $security = 0;

    /**
     *
     */
    public function __construct(){

		$this->cipher = new Blowfish(VIALOJA_COOKIE_KEY, VIALOJA_COOKIE_SALT);

		if(isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on'){
			//$this->security = true;
		}

	}

	/**
	 * Get current instance of cookie (singleton)
	 *
	 * @return Cookie
	 */
	public static function getInstance()
	{
		if (!self::$instance)
			self::$instance = new Cookie();
		return self::$instance;
	}

	/**
	 * Cookie de produtos visualizados
	 * @param  int $id ID do produto
	 * @param  int $session_id sessão od usuario
	 * @return void
	 */
	public function _setcookieLastProductView($id=null, $session_id)
	{


		if (isset($id, $session_id)) {

			$info[$session_id]=$session_id;

			if (isset($_COOKIE['_last_productview'])) {
				$data = array_unique(unserialize($_COOKIE['_last_productview']));
				foreach($data as $key => $value){
					$info[$key]=$value;
				}
			}

			return setcookie('_last_productview',
				serialize($info),
				time()+60*60*24*45,
				$this->path, Tools::getHttpBase(),
				$this->security, true
			);

		}

	}


    /**
     * Destroy cookies
     */
    public function destroy()
	{

		foreach($_COOKIE AS $key => $ck){

			setcookie($key, $ck, time() - 60*60*24*365, $this->path, Tools::getHttpBase(), 0, true);
			setcookie($key, $ck, time() - 60*60*24*365, $this->path, Tools::getServerName(), 0, true);
			if (isset($this->security) && $this->security !==0) {
				setcookie($key, $ck, time() - 60*60*24*365, $this->path, Tools::getHttpBase(), $this->security, true);
				setcookie($key, $ck, time() - 60*60*24*365, $this->path, Tools::getServerName(), $this->security, true);
			}

		}

	}

	/**
	 * Get cookie content
	 */
	public function update($nullValues = false)
	{
		if (isset($_COOKIE[$this->name]))
		{

		}
	}

	/**
	 * Setcookie according to php version
	 */
	public function setcookie($cookie=null, $content=null, $expire=null, $host=null )
	{
		if ($cookie !== null) {

			$this->name = $cookie;
			$this->expire = $expire;
			$this->content = $content;
			$this->time = time() + $this->expire;

		} else {
			$this->content = 0;
		}

		if ($host===null) {
			$this->host = Tools::getHttpBase();
		} else {
			$this->host = $host;
		}

		return setcookie($this->name, $this->content, $this->time, $this->path, $this->host, $this->security, true);
	}

	/**
	 * Setcookie according to php version
	 */
	public function _setcookie($cookie=null, $content=null, $expire=null, $host=null )
	{
		if ($cookie !== null) {

			$this->name = $cookie;
			$this->expire = $expire;
			$this->content = $this->cipher->encrypt( $content );
			$this->time = time() + $this->expire;

		} else {
			$this->content = 0;
		}

		if ($host===null) {
			$this->host = Tools::getHttpBase();
		} else {
			$this->host = $host;
		}

		return setcookie($this->name, $this->content, $this->time, $this->path, $this->host, $this->security, true);
	}

    /**
     * @param $cookie
     * @return mixed|null
     */
    public function getCookie($cookie)
	{
		return isset($_COOKIE[$cookie]) ?
		filter_var( $this->cipher->decrypt($_COOKIE[$cookie] ), FILTER_SANITIZE_STRING ) : null;
	}

    /**
     * @param null $cookie
     * @return bool
     */
    public function deleteCookie($cookie=null)
	{
		if (isset($_COOKIE[$cookie])) {
		    unset($_COOKIE[$cookie]);
		    setcookie($cookie, null, time() - 60*60*24*365, $this->path, Tools::getServerName(), 0, true);
			if (isset($this->security) && $this->security !==0) {
				setcookie($cookie, null, time() - 60*60*24*365, $this->path, Tools::getServerName(), $this->security, true);
			}
		    return true;
		} else {
		    return false;
		}
	}


	/**
	 * Cria cookie de sessão e only
	 * @access public
	 * @param String $name Define um nome de sessão personalizado
	 * @param String $secure Defina como true se utilizando https
	 * @param String $lifetime Validate do cookie
	 * @return void
	*/
	public function createCookieSession( $session_name = '__vialoja', $autologin = null ) {


		// app/config/my_session.php
		//
		// Reverte o valor e força checagem do referrer mesmo quando
		// Security.level for medium
		ini_restore('session.referer_check');

		// Cookies agora são destruídos quando o navegador é fechado,
		// não persiste a informação por dias e é o padrão para nível
		// de segurança em low ou medium
		ini_set('session.cookie_lifetime', 0);

		// Cookie path agora é '/', mesmo se sua aplicação estiver
		// em um subdiretório no domínio
		ini_set('session.cookie_path', ini_get('session.cookie_path'));

		// Cookies de sessão agora são persistidos para todos
		// os subdomínios
		ini_set('session.cookie_domain', Tools::getHttpBase());


		$secure = isset($_SERVER['HTTPS']); // Defina como true se utilizando https.
		$httponly = true; // Isso interrompe javascript ser capaz de acessar o id da sessão.

		ini_set('session.use_only_cookies', 1); // Força sessões para usar apenas cookies.
		ini_set ('session.hash_function', 'sha256'); //
		ini_set ('session.entropy_length', 256);
		/**
		 * Segurança em 128 byts
		 * ini_set ('session.hash_function', 'sha512');
		 * ini_set ('session.entropy_length', 512);
		 */
		ini_set('session.gc_probability', 1);

		/**
		 * 4 - 40 character string
		 *
		 * 5 - 32 character string
		 *
		 * 6 - 27 character string
		 */
		ini_set('session.hash_bits_per_character', 4); //Aumenta o tamanho do hash da sessão
		$cookieParams = session_get_cookie_params(); // Obtém os cookies atuais via params.

		$cookieParams["lifetime"] = false; //Validate do cookie Sessão
		$cookieParams["path"] = ini_get('session.cookie_path');
		$cookieParams["domain"] = Tools::getHttpBase();

		session_set_cookie_params(
			$cookieParams["lifetime"],
			$cookieParams["path"],
			$cookieParams["domain"],
			$secure,
			$httponly
		);

		session_name($session_name); //Define o nome de sessão ao estabelecido acima.

		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

	}
}
