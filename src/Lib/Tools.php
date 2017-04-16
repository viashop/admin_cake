<?php

namespace Lib;

class Tools
{

	protected static $file_exists_cache = array();
	protected static $_forceCompile;
	protected static $_caching;

	/*/

	public static function geradorParcela($str){

		/**
		*
		* Gera datas
		* http://forum.imasters.com.br/topic/524713-strtotime-nao-esta-funcionando-corretamente/
		*
		**\/


		//http://forum.imasters.com.br/topic/524606-array-shift-foreach/
		//http://forum.imasters.com.br/topic/524244-gerar-array-com-datas/
		$datas = new \DatePeriod(new DateTime('2014-01-20'), new DateInterval('P30D'), new DateTime('2014-12-20'));

		foreach($datas as $data) {
			echo $data->format('d/m/Y'),'<br>';
		}


		$datas = new \DatePeriod(new DateTime('2014-01-20'), new DateInterval('P1M'), 10);

		foreach($datas as $data) {
			echo $data->format('d/m/Y'),'<br>';
		}

	}

	/*
	public function getImageWebSite($value='')
	{
		//http://henriquebarcelos.in/blog/2011/12/06/pegando-imagens-de-uma-url-externa-como-no-facebook/

		$contents = file_get_contents('http://www.site.com/pagina');
		preg_match_all('#(<img(.*?)/?>)#', $contents, $images);
		var_dump($images);
	}
	*/

	public static function hideIncludeCart()
	{

		$hide_links = array('/checkout/');

		foreach($hide_links as $url)
		{
			if(strpos(Tools::getUrl(),$url)!==false)
				return true;
			return false;
		}

	}

	/**
	 * Get Url Coorrente
	 * @return string
	 */
	public static function getUrl() {

		Tools::requestUri();
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return trim($pageURL);
	}

	/**
	 * Retorna o HTTP_BASE
	 * Exemplo .site.com.br
	 * @return string
	 */
	public static function getHttpBase()
	{
		return sprintf('.%s', DomainCheck::check(Tools::getServerName()));
	}

	public static function requestUri()
	{
		if (!isset($_SERVER['REQUEST_URI']) || empty($_SERVER['REQUEST_URI'])) {
			if (!isset($_SERVER['SCRIPT_NAME']) && isset($_SERVER['SCRIPT_FILENAME']))
				$_SERVER['SCRIPT_NAME'] = $_SERVER['SCRIPT_FILENAME'];
			if (isset($_SERVER['SCRIPT_NAME'])) {
				if (basename($_SERVER['SCRIPT_NAME']) == 'index.php' && empty($_SERVER['QUERY_STRING']))
					$_SERVER['REQUEST_URI'] = dirname($_SERVER['SCRIPT_NAME']) . '/';
				else {
					$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
					if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
						$_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
				}
			}
		}

	}


	/**
	 * getProtocol return the set protocol according to configuration (http[s])
	 * @param bool $use_ssl true if require ssl
	 * @return String (http|https)
	 */
	public static function getProtocol($use_ssl = null)
	{
		return (!is_null($use_ssl) && $use_ssl ? 'https://' : 'http://');
	}

	/**
	 * Get the server variable SERVER_NAME
	 *
	 * @return string server name
	 */
	public static function getServerName()
	{
		if (isset($_SERVER['HTTP_X_FORWARDED_SERVER']) && $_SERVER['HTTP_X_FORWARDED_SERVER'])
			return $_SERVER['HTTP_X_FORWARDED_SERVER'];
		return $_SERVER['SERVER_NAME'];
	}

	/**
	 * Get the server variable REMOTE_ADDR, or the first ip of HTTP_X_FORWARDED_FOR (when using proxy)
	 *
	 * @return string $remote_addr ip of client
	 */
	public static function getRemoteAddr()
	{
		// This condition is necessary when using CDN, don't remove it.
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && (!isset($_SERVER['REMOTE_ADDR']) || preg_match('/^127\..*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^172\.16.*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^192\.168\.*/i', trim($_SERVER['REMOTE_ADDR'])) || preg_match('/^10\..*/i', trim($_SERVER['REMOTE_ADDR'])))) {
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')) {
				$ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				return $ips[0];
			} else
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		return $_SERVER['REMOTE_ADDR'];
	}

	//Primeiro nome

	/**
	 * Calcula em porcentagem o valor de desconto
	 *
	 * @param double $pa valor antingo
	 * @param double $pn valor novo
	 * @return double
	 */
	public static function discountPercentageValue($pa, $pn)
	{

		if (isset($pa, $pn)) {
			$ps = $pa - $pn;
			return round($ps / $pa * 100, 1);
		} else {
			return null;
		}

	}

	public static function positionSlide()
	{
		$input = array("left", "right", "top", "bottom");
		$rand_keys = array_rand($input, 2);

		return $input[$rand_keys[0]];
	}

	public static function firstName($str){
		if (!empty($str)) {
			$str = Tools::strtolower($str);
			$str = Tools::ucfirst($str);
			return current( str_word_count($str , 2) );
		} else {
			return false;
		}
	}

	public static function strtolower($str)
	{
		if (is_array($str))
			return false;
		if (function_exists('mb_strtolower'))
			return mb_strtolower($str, 'utf-8');
		return strtolower($str);
	}

	public static function ucfirst($str)
	{
		return Tools::strtoupper(Tools::substr($str, 0, 1)) . Tools::substr($str, 1);
	}

	public static function strtoupper($str)
	{
		if (is_array($str))
			return false;
		if (function_exists('mb_strtoupper'))
			return mb_strtoupper($str, 'utf-8');
		return strtoupper($str);
	}

	public static function substr($str, $start, $length = false, $encoding = 'utf-8')
	{
		if (is_array($str))
			return false;
		if (function_exists('mb_substr'))
			return mb_substr($str, (int)$start, ($length === false ? Tools::strlen($str) : (int)$length), $encoding);
		return substr($str, $start, ($length === false ? Tools::strlen($str) : (int)$length));
	}

	public static function strlen($str, $encoding = 'UTF-8')
	{
		if (is_array($str))
			return false;
		$str = html_entity_decode($str, ENT_COMPAT, 'UTF-8');
		if (function_exists('mb_strlen'))
			return mb_strlen($str, $encoding);
		return strlen($str);
	}

	public static function dateRange($first, $last, $step = '+1 day', $format = 'd/m/Y')
	{

		/**
		 * http://forum.imasters.com.br/topic/472065-conversao-de-datas-com-expressoes-regulares/?p=1874281
		 */

		$dates = array();
		$current = strtotime($first);
		$last = strtotime($last);

		while ($current <= $last) {

			$dates[] = date($format, $current);
			$current = strtotime($step, $current);
		}

	    return $dates;

	    /*
		$first = '2014-02-28';
		$last  = '2018-01-01';

		echo '<pre>';
		print_r(dateRange($first, $last, '+1 month', 'd/m/Y' ));
	    */
	}

	public static function cleanSKU($value)
	{
		return preg_replace('/[^0-9a-z-]/i', '', $value);
	}

	public static function percentageUse($ativo, $total)
	{
		if (isset($ativo,$total)) {

			$ativo = intval($ativo);
			$total = intval($total);
			return ($ativo / $total) * 100;

		} else {
			return null;
		}

	}

	/**
	 * Converte para Integer
	 * @param int $value
	 * @return int
	 */
	public static function intVal($value)
	{
		return (int) preg_replace('/[^0-9]/i', '', $value);
	}

	/**
	 * Adiciona zero a esquera em decimais
	 * @access public
	 * @return int
	*/
	public static function  leftZero($value)
	{
		return str_pad($value, 2, "0", STR_PAD_LEFT);
	}

	/**
	 * Valor unico para moeda para inserir no db
	 * @access public
	 * @return float
	 */
	public static function formatTotal($valor)
	{
		if (!is_numeric($valor)) {
			$valor = str_replace(".", "", $valor);//retirar pontos e virgulas
			$valor = str_replace(",", ".", $valor);
		}
		return number_format($valor, 0, ',', '.');
	}

	/**
	 * Formata a data do tipo date
	 * @access public
	 * @return string
	*/
	public static function formatToDate($data) {

		return strftime('%d/%m/%Y', strtotime($data));
	}

	/**
	 * Formata a data para DB
	 * @param $data
	 * @access public
	 * @return string
	*/
	public static function formatToDateDB($data)
	{

		return implode('-', array_reverse(explode('/', $data)));
	}

//	public static function getSubDomain($value = '')
//	{
//		/*
//		/* redefine HTTP_HOST if empty (em alguns servidores web...) *\/
//		if (!isset($_SERVER['HTTP_HOST']) || empty($_SERVER['HTTP_HOST'])){
//			$_SERVER['HTTP_HOST'] = @getenv('HTTP_HOST');
//		}
//		*/
//
//		$parsed_url = parse_url(env('HTTP_HOST')); //Dinamico
//
//
//		if (strpos($parsed_url['path'], 'www.') !== false) {
//			$parsed_url['path'] = str_replace('www.', '', $parsed_url['path']);
//		}
//
//
//		//var_dump(explode('.', $parsed_url['path']));
//
//	}

	/*
	public static function criaLinks($texto)
	{
	    $texto = preg_replace('@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@', '<a href="$1" target="blank">$1</a>', $texto);
	    $texto = str_replace("href=\"www.","href=\"http://www.",$texto);
	    $texto = str_replace('href="', 'href="http://', $texto);
	    $texto = str_replace('http://http://', 'http://', $texto);
	    return $texto;
	}
	*/

	/**
	 * Valor unico para hash
	 * @access public
	 * @return string
	 */
	public static function uniqid()
	{
		return md5(uniqid(rand(), true));
	}

	/**
	 * Higieniza string
	 * @access public
	 * @param String $string
	 * @return string
	 */
	public static function clean($string = null)
	{
		$string = filter_var($string, FILTER_SANITIZE_STRING);
		return trim($string);
	}

	/**
	 * Higieniza para busca em fulltext
	 * @access public
	 * @param String $string
	 * @return string
	 */
	public static function sanitizeFullText($string = null)
	{
		$array = Array("\n\r", "  ");

		$string = filter_var($string, FILTER_SANITIZE_STRING);
		$string = str_replace($array, '', $string);

		return trim(html_entity_decode($string));
	}

	/**
	 * Highlight colore o termo da busca
	 * @access public
	 * @param String $text
	 * @param String $words
	 * @return String
	 */
	public static function highlight($text, $words, $color = '#daa732')
	{
		preg_match_all('~\w+~', $words, $m);
		if (!$m)
			return $text;
		$re = '~\\b(' . implode('|', $m[0]) . ')\\b~';
		return preg_replace($re, '<span style="color: ' . $color . ';">$0</span>', $text);
	}

	/**
	 * Seleciona parte do conteúdo de acordo com a palavra chave
	 * @access public
	 * @param String $keywords
	 * @param String $str
	 * @return String
	 */
	public static function highlightDescription($str = null, $keywords = null, $wordspan = 20)
	{

		/**
		 *
		 * http://stackoverflow.com/questions/4081372/highlight-keywords-in-a-paragraph
		 *
		 **/

		/*
		$remove = array(' a ', ' e ', ' i ', ' o ', ' u ', ' da ', ' dos ');
		$keywords = str_replace($remove, " ", $keywords);

		$keywords = explode( ' ', $keywords );
		$vetor = array();
		foreach($keywords as $key => $value){

			$vetor[$key] = $value;

		}

		$keywords = $vetor;
		*/

		$textFormatList = $str;

		$keywords = explode(' ', $keywords);
		$keywords = array(array_pop($keywords));

		$keywordsPattern = implode('|', array_map(function ($val) {
			return preg_quote($val, '/');
		}, $keywords));
		$matches = preg_split("/($keywordsPattern)/ui", $str, -1, PREG_SPLIT_DELIM_CAPTURE);
		for ($i = 0, $n = count($matches); $i < $n; ++$i) {
			if ($i % 2 == 0) {
				$words = preg_split('/(\s+)/u', $matches[$i], -1, PREG_SPLIT_DELIM_CAPTURE);
				if (count($words) > ($wordspan + 1) * 2) {
					$matches[$i] = '…';
					if ($i > 0) {
						$matches[$i] = implode('', array_slice($words, 0, ($wordspan + 1) * 2)) . $matches[$i];
					}
					if ($i < $n - 1) {
						$matches[$i] .= implode('', array_slice($words, -($wordspan + 1) * 2));
					}
				}
			} else {
				$matches[$i] = '<b>' . $matches[$i] . '</b>';
			}
		}

		$max_chars = $wordspan;

		$value = implode('', $matches);

		if ($max_chars != -1) {
			if (strlen(trim($value)) > $max_chars) {
				$value = substr($value, 0, $max_chars);
			}
		}

		if (Tools::strlen($value) <= 3) {
			return Tools::formatList(filter_var($textFormatList, FILTER_SANITIZE_STRING), $wordspan);
		} else {
			return filter_var($value, FILTER_SANITIZE_STRING);
		}

	}


	//Confere se a senha contem dados do nome


    /**
     * Formata texto para descrição
     * @param $value
     * @param int $max_chars
     * @return mixed|string
     */
	public static function formatList($value, $max_chars = 200)
	{
		$is_bigger = false;

		$value = ucfirst($value);
		$value = strip_tags($value);
		$value = stripslashes($value);

		if ($max_chars != -1) {
			if (strlen(trim($value)) > $max_chars) {
				$value = substr($value, 0, $max_chars);
				$is_bigger = true;
			}
		}
		$value = str_replace(array("<", ">"), array("&lt;", "&gt;"), $value);
		if ($value == "") {
			$value = "&nbsp;";
		}
		if ($is_bigger) {
			$value .= "...";
		}
		return $value;
	}


	//Confere se a senha contem dados do email

	/**
	 * Higieniza editores swing
	 * @access public
	 * @param String $string
	 * @return String
	 */
	public static function sanitizeEditor($string)
	{
		$string = str_replace("follow", "nofollow", $string);
		$string = str_replace("_self", "_blank", $string);
		$string = str_replace("_parent", "_blank", $string);
		$string = str_replace("_top", "_blank", $string);
		$string = str_replace("framename", "_blank", $string);
		if (strpos($string, "<a href=") !== false) {
			$string = str_replace('<a href=', '<a target="_blank" rel="nofollow" href=', $string);
		}

		return Tools::htmlentitiesUTF8($string);
	}

	public static function htmlentitiesUTF8($string, $type = ENT_QUOTES)
	{
		if (is_array($string))
			return array_map(array('Tools', 'htmlentitiesUTF8'), $string);

		return htmlentities((string)$string, $type, 'utf-8');
	}

	/**
	 * Formata data para ticket e forum
	 * @access public
	 * @param String $date
	 * @param String $time
	 * @return String
	 */
	public static function formatDateForum($date = null, $time = null)
	{

		/*
		setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
		date_default_timezone_set( 'America/Sao_Paulo' );
		*/

		/*
        As seguintes conversões especificadoras são conhecidas no formato de string:

        %a - dia da semana abreviado de acordo com a localidade
        %A - nome da semana completo de acordo com a localidade
        %b - nome do mês abreviado de acordo com a localidade
        %B - nome do mês completo de acordo com a localidade
        %c - representação da data e hora preferida pela a localidade
        %C - número do século (o ano dividido por 100 e truncado para um inteiro, de 00 até 99)
        %d - dia do mês como um número decimal (de 01 até 31)
        %D - mesmo que %m/%d/%y
        %e - dia do mês como um número decimal, um simples dígito é precedido por espaço (de ' 1' até '31')
        %g - como %G, mas sem o século.
        %G - o 4-dígito do ano correspodendo as ISO week number (see %V). Este tem o mesmo formato e valor que %Y, exceto que se o ISO week number pertence ao prévio ou próximo ano, aquele ano é usado ao invés deste.
        %h - mesmo que %b
        %H - hora como um número decimal usando um relógio de 24-horas (de 00 até 23)
        %I - hora como um número decimal usando um relógio de 12-hoas (de 01 até 12)
        %j - dia do ano como número decimal (de 001 até 366)
        %m - mês como número decimal (de 01 até 12)
        %M - minuto como número decimal
        %n - caracter novalinha
        %p - um dos dois 'am' ou 'pm' de acordo com o valor da hora dada, ou as strings correspondentes para a localidade
        %r - hora em a.m. e p.m. notação
        %R - hora em notação de 24 horas
        %S - segundo como um número decimal
        %t - caracter tab
        %T - hora corrente, igual a %H:%M:%S
        %u - dia da semana como número decimal [1,7], com 1 representando Segunda-feira
        %U - dia da semana do ano corrente como número decimal, começando com o primeiro domingo como o primeiro dia da primeira semana
        %V - O número da semana corrente ISO 8601:1988 do ano corrente como um número decimal, de 01 até 53, onde semana 1 é a primeira semana que tem pelo menos 4 dias no ano corrente, e com segunda-feira como o primeiro dia da semana. (Use %G ou %g para o componente anual que corresponde ao dia da semana para o para o timestamp especificado.)
        %W - dia da semana do ano corrente como número decimal, começando com o a segunda-feira como o primeiro dia da primera semana
        %w - dia da semana como número decimal, domingo sendo 0
        %x - representação preferida para a data para a localidade corrente sem a hora
        %X - representação preferida para a hora para a localidade corrente sem a data
        %y - ano como número decimal sem o século (de 00 até 99)
        %Y - ano como número decimal incluindo o século
        %Z ou %z - time zone, nome ou abreviação (dependendo do sistema operacional)
        %% - a literal '%' character
        */
		if (isset($time) && !isset($date)) {
			//App::uses('FormatarTempo', 'Lib');
			return FormatarTempo::formatar($time);
		} else {

			$date = new \DateTime($date);

			if (!isset($time)) {
				return strftime('%d %B %Y', strtotime($date->format('Y-m-d')));
			} else {
				if (date('Ymd') !== $date->format('Ymd')):
					return strftime('%d %B %Y', strtotime($date->format('Y-m-d')));
				else:
					//App::uses('FormatarTempo', 'Lib');
					return FormatarTempo::formatar($time);
				endif;
			}
		}
	}

	public static function passwordItsName($pass = null, $name = null)
	{
		$name = explode(' ', mb_strtolower($name, 'utf8'));
		$array = $name;
		$key = array_search(mb_strtolower($pass, 'utf8'), $array);
		if (isset($key) && is_numeric($key)) {
			return true;
		} else {
			return false;
		}
	}

	public static function passwordItsEmail($pass=null,$email=null)
	{

		if($pass===$email){
			return true;
		} else {

			$email = explode('@', mb_strtolower( $email, 'utf8') );
			$array = $email;
			$key = array_search(mb_strtolower($pass, 'utf8'), $array);
			if( isset($key) && is_numeric($key)){
				return true;
			} else {
				return false;
			}

		}
	}

	/**
	 * Verifica se o diretório existe, senão ele cria.
	 * @access public
	 * @param String $dir
	*/
	public static function createFolder($dir)
	{

		App::uses('Folder', 'Utility');
		$dir_chmod = dirname($dir);
		echo dirname(dirname(dirname(__FILE__)));

		if (!is_dir($dir_chmod)) {
			mkdir($dir_chmod, 0755, true);
		}

		die;

		$folder = new Folder();

		$folder->chmod($dir_chmod, 0777, true);

		echo $dir;

		if (!is_dir($dir)) {
			$folder->create($dir, 0777, true);
		}

	}

	/**
	 * Monta Slug Arquivo
	 * @access public
	 * @param String $file
	 * @return slug do arquivo
	*/
	public static function slugFile($file = null)
	{

		if (!isset($file)) {
			return false;
		} else {

			$file_info = pathinfo($file);
			return Tools::slug($file_info['filename']) . '.' . $file_info['extension'];

		}

	}

	/**
	 * Trata o nome removendo espaços, acentos e caracteres em maiúsculo.
	 * @param $string
	 * @return string
	 */
	public static function slug($string)
	{
		return strtolower(FriendlyURL::slug($string, '-'));
	}


	/**
	 * Senha camuflar
	 * @param null $value
	 */
	public static function passwdCamuflar($value = null)
	{
		$total = strlen($value);
		for ($i = 0; $i <= $total; $i++) {
			print '*';
		}
	}

	/**
	 * Random password generator
	*
	* @param integer $length Desired length (optional)
	* @param string $flag Output type (NUMERIC, ALPHANUMERIC, NO_NUMERIC)
	* @return string password
	*/
	public static function passwdGen($length = 8, $flag = 'ALPHANUMERIC')
	{
		switch ($flag)
		{
			case 'NUMERIC':
				$str = '0123456789';
				break;
			case 'NO_NUMERIC':
				$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			default:
				$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
		}

		for ($i = 0, $passwd = ''; $i < $length; $i++)
			$passwd .= Tools::substr($str, mt_rand(0, Tools::strlen($str) - 1), 1);
		return $passwd;
	}

	/**
	 * Random SKU generator
	*
	 * @param integer $length Desired length (optional)
	 * @param string $flag Output type (NUMERIC, ALPHANUMERIC, NO_NUMERIC)
	 * @return string password
	*/
	public static function tokenGen($length = 9, $flag = 'ALPHANUMERIC')
	{
		switch ($flag) {
			case 'NUMERIC':
				$str = '0123456789';
				break;
			case 'NO_NUMERIC':
				$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			default:
				$str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
		}

		for ($i = 0, $token = ''; $i < $length; $i++)
			$token .= Tools::substr($str, mt_rand(0, Tools::strlen($str) - 1), 1);
		return mb_strtoupper($token, 'utf-8');
	}

	/**
	* Get a value from $_POST / $_GET
	* if unavailable, take a default value
	*
	* @param string $key Value key
	* @param mixed $default_value (optional)
	* @return mixed Value
	*/
	public static function getValue($key, $default_value = false)
	{
		if (!isset($key) || empty($key) || !is_string($key))
			return false;
		$ret = (isset($_POST[$key]) ? $_POST[$key] : (isset($_GET[$key]) ? $_GET[$key] : $default_value));

		if (is_string($ret) === true)
			$ret = urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret)));
		return !is_string($ret)? $ret : stripslashes($ret);
	}

	public static function getIsset($key)
	{
		if (!isset($key) || empty($key) || !is_string($key))
			return false;
		return isset($_POST[$key]) ? true : (isset($_GET[$key]) ? true : false);
	}

	public static function utf8_converter($array)
	{
		array_walk_recursive($array, function (&$item, $key) {
			if (!mb_detect_encoding($item, 'utf-8', true)) {
				$item = utf8_encode($item);
			}
		});

		return $array;
	}

	public static function htmlentitiesDecodeUTF8($string)
	{
		if (is_array($string))
		{
			$string = array_map(array('Tools', 'htmlentitiesDecodeUTF8'), $string);
			return (string)array_shift($string);
		}
		return html_entity_decode((string)$string, ENT_QUOTES, 'utf-8');
	}

	/**
	 * Delete directory and subdirectories
	 *
	 * @param string $dirname Directory name
	 */
	public static function deleteDirectory($dirname, $delete_self = true)
	{
		$dirname = rtrim($dirname, '/') . '/';
		if (file_exists($dirname))
			if ($files = scandir($dirname)) {
				foreach ($files as $file)

					if ($file != '.' && $file != '..' && $file != '.svn') {
						if (is_dir($dirname . $file))
							Tools::deleteDirectory($dirname . $file, true);
						elseif (file_exists($dirname . $file))
							unlink($dirname . $file);
					}
				if ($delete_self)
					if (!rmdir($dirname))
						return false;
				return true;
			}
		return false;
	}

	/**
	 * Delete file
	*
	 * @param string File path
	 * @param array  Excluded files
	 */
	public static function deleteFile($file, $exclude_files = array())
	{
		if (isset($exclude_files) && !is_array($exclude_files))
			$exclude_files = array($exclude_files);

		if (file_exists($file) && is_file($file) && array_search(basename($file), $exclude_files) === FALSE)
			unlink($file);
	}

	/*Copied from CakePHP String utility file*/

	/**
	 * Check if submit has been posted
	 *
	 * @param string $submit submit name
	 */
	public static function isSubmit($submit)
	{
		return (
			isset($_POST[$submit]) || isset($_POST[$submit . '_x']) || isset($_POST[$submit . '_y'])
			|| isset($_GET[$submit]) || isset($_GET[$submit . '_x']) || isset($_GET[$submit . '_y'])
		);
	}

	public static function strrpos($str, $find, $offset = 0, $encoding = 'utf-8')
	{
		if (function_exists('mb_strrpos'))
			return mb_strrpos($str, $find, $offset, $encoding);
		return strrpos($str, $find, $offset);
	}

	public static function dateDays()
	{
		$tab = array();
		for ($i = 1; $i != 32; $i++)
			$tab[] = $i;
		return $tab;
	}

	public static function dateMonths()
	{
		$tab = array();
		for ($i = 1; $i != 13; $i++)
			$tab[$i] = date('F', mktime(0, 0, 0, $i, date('m'), date('Y')));
		return $tab;
	}

	public static function dateFrom($date)
	{
		$tab = explode(' ', $date);
		if (!isset($tab[1]))
			$date .= ' ' . Tools::hourGenerate(0, 0, 0);
		return $date;
	}

	public static function hourGenerate($hours, $minutes, $seconds)
	{
		return implode(':', array($hours, $minutes, $seconds));
	}

	public static function dateTo($date)
	{
		$tab = explode(' ', $date);
		if (!isset($tab[1]))
			$date .= ' ' . Tools::hourGenerate(23, 59, 59);
		return $date;
	}

	public static function ucwords($str)
	{
		if (function_exists('mb_convert_case'))
			return mb_convert_case($str, MB_CASE_TITLE);
		return ucwords(strtolower($str));
	}

	public static function isEmpty($field)
	{
		return ($field === '' || $field === null);
	}

	/**
	 * returns the rounded value down of $value to specified precision
	 *
	 * @param float $value
	 * @param int $precision
	 * @return float
	 */
	public static function ceilf($value, $precision = 0)
	{
		$precision_factor = $precision == 0 ? 1 : pow(10, $precision);
		$tmp = $value * $precision_factor;
		$tmp2 = (string)$tmp;
		// If the current value has already the desired precision
		if (strpos($tmp2, '.') === false)
			return ($value);
		if ($tmp2[strlen($tmp2) - 1] == 0)
			return $value;
		return ceil($tmp) / $precision_factor;
	}

	/**
	 * returns the rounded value up of $value to specified precision
	 *
	 * @param float $value
	 * @param int $precision
	 * @return float
	 */
	public static function floorf($value, $precision = 0)
	{
		$precision_factor = $precision == 0 ? 1 : pow(10, $precision);
		$tmp = $value * $precision_factor;
		$tmp2 = (string)$tmp;
		// If the current value has already the desired precision
		if (strpos($tmp2, '.') === false)
			return ($value);
		if ($tmp2[strlen($tmp2) - 1] == 0)
			return $value;
		return floor($tmp) / $precision_factor;
	}

	/**
	 * file_exists() wrapper with cache to speedup performance
	 *
	 * @param string $filename File name
	 * @return boolean Cached result of file_exists($filename)
	 */
	public static function file_exists_cache($filename)
	{
		if (!isset(self::$file_exists_cache[$filename]))
			self::$file_exists_cache[$filename] = file_exists($filename);
		return self::$file_exists_cache[$filename];
	}

	/**
	 * file_exists() wrapper with a call to clearstatcache prior
	 *
	 * @param string $filename File name
	 * @return boolean Cached result of file_exists($filename)
	 */
	public static function file_exists_no_cache($filename)
	{
		clearstatcache();
		return file_exists($filename);
	}

	public static function simplexml_load_file($url, $class_name = null)
	{
		return @simplexml_load_string(Tools::file_get_contents($url), $class_name);
	}

	public static function file_get_contents($url, $use_include_path = false, $stream_context = null, $curl_timeout = 5)
	{
		if ($stream_context == null && preg_match('/^https?:\/\//', $url))
			$stream_context = @stream_context_create(array('http' => array('timeout' => $curl_timeout)));
		if (in_array(ini_get('allow_url_fopen'), array('On', 'on', '1')) || !preg_match('/^https?:\/\//', $url))
			return @file_get_contents($url, $use_include_path, $stream_context);
		elseif (function_exists('curl_init')) {
			$curl = curl_init();

			/*
			 * Verificamos se o recurso CURL foi criado com êxito
			 */
			if (is_resource($curl)) {

				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
				curl_setopt($curl, CURLOPT_TIMEOUT, $curl_timeout);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
				if ($stream_context != null) {
					$opts = stream_context_get_options($stream_context);
					if (isset($opts['http']['method']) && Tools::strtolower($opts['http']['method']) == 'post') {
						curl_setopt($curl, CURLOPT_POST, true);
						if (isset($opts['http']['content'])) {
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
		} else
			return false;
	}

	public static function copy($source, $destination, $stream_context = null)
	{
		if (is_null($stream_context) && !preg_match('/^https?:\/\//', $source))
			return @copy($source, $destination);
		return @file_put_contents($destination, Tools::file_get_contents($source, false, $stream_context));
	}

	/**
	 * Translates a string with underscores into camel case (e.g. first_name -> firstName)
	 * @prototype string public static function toCamelCase(string $str[, bool $capitalise_first_char = false])
	 */
	public static function toCamelCase($str, $catapitalise_first_char = false)
	{
		$str = Tools::strtolower($str);
		if ($catapitalise_first_char)
			$str = Tools::ucfirst($str);
		return preg_replace_callback('/_+([a-z])/', create_function('$c', 'return strtoupper($c[1]);'), $str);
	}

	/**
	 * Transform a CamelCase string to underscore_case string
	 *
	 * @param string $string
	 * @return string
	 */
	public static function toUnderscoreCase($string)
	{
		// 'CMSCategories' => 'cms_categories'
		// 'RangePrice' => 'range_price'
		return strtolower(trim(preg_replace('/([A-Z][a-z])/', '_$1', $string), '_'));
	}

	/**
	 * Get the current url prefix protocol (https/http)
	 *
	 * @return string protocol
	 */
	public static function getCurrentUrlProtocolPrefix()
	{
		if (Tools::usingSecureMode())
			return 'https://';
		else
			return 'http://';
	}

	/**
	 * Check if the current page use SSL connection on not
	 *
	 * @return bool uses SSL
	 */
	public static function usingSecureMode()
	{
		if (isset($_SERVER['HTTPS']))
			return in_array(Tools::strtolower($_SERVER['HTTPS']), array(1, 'on'));
		// $_SERVER['SSL'] exists only in some specific configuration
		if (isset($_SERVER['SSL']))
			return in_array(Tools::strtolower($_SERVER['SSL']), array(1, 'on'));
		// $_SERVER['REDIRECT_HTTPS'] exists only in some specific configuration
		if (isset($_SERVER['REDIRECT_HTTPS']))
			return in_array(Tools::strtolower($_SERVER['REDIRECT_HTTPS']), array(1, 'on'));
		if (isset($_SERVER['HTTP_SSL']))
			return in_array(Tools::strtolower($_SERVER['HTTP_SSL']), array(1, 'on'));

		return false;
	}

	/**
	 * Concat $begin and $end, add ? or & between strings
	 *
	 * @since 1.5.0
	 * @param string $begin
	 * @param string $end
	 * @return string
	 */
	public static function url($begin, $end)
	{
		return $begin . ((strpos($begin, '?') !== false) ? '&' : '?') . $end;
	}

	/**
	 * Convert \n and \r\n and \r to <br />
	 *
	 * @param string $string String to transform
	 * @return string New string
	 */
	public static function nl2br($str)
	{
		return str_replace(array("\r\n", "\r", "\n"), '<br />', $str);
	}


	/**
	 * Get max file upload size considering server settings and optional max value
	 *
	 * @param int $max_size optional max file size
	 * @return int max file size in bytes
	 */
	public static function getMaxUploadSize($max_size = 0)
	{
		$post_max_size = Tools::convertBytes(ini_get('post_max_size'));
		$upload_max_filesize = Tools::convertBytes(ini_get('upload_max_filesize'));
		if ($max_size > 0)
			$result = min($post_max_size, $upload_max_filesize, $max_size);
		else
			$result = min($post_max_size, $upload_max_filesize);
		return $result;
	}

	/**
	 * Convert a shorthand byte value from a PHP configuration directive to an integer value
	 * @param string $value value to convert
	 * @return int
	 */
	public static function convertBytes($value)
	{
		if (is_numeric($value))
			return $value;
		else {
			$value_length = strlen($value);
			$qty = (int)substr($value, 0, $value_length - 1);
			$unit = strtolower(substr($value, $value_length - 1));
			switch ($unit) {
				case 'k':
					$qty *= 1024;
					break;
				case 'm':
					$qty *= 1048576;
					break;
				case 'g':
					$qty *= 1073741824;
					break;
			}
			return $qty;
		}
	}

	/**
	 * @params string $path Path to scan
	 * @params string $ext Extention to filter files
	 * @params string $dir Add this to prefix output for example /path/dir/*
	 *
	 * @return array List of file found
	 * @since 1.5.0
	 */
	public static function scandir($path, $ext = 'php', $dir = '', $recursive = false)
	{
		$path = rtrim(rtrim($path, '\\'), '/') . '/';
		$real_path = rtrim(rtrim($path . $dir, '\\'), '/') . '/';
		$files = scandir($real_path);
		if (!$files)
			return array();

		$filtered_files = array();

		$real_ext = false;
		if (!empty($ext))
			$real_ext = '.' . $ext;
		$real_ext_length = strlen($real_ext);

		$subdir = ($dir) ? $dir . '/' : '';
		foreach ($files as $file) {
			if (!$real_ext || (strpos($file, $real_ext) && strpos($file, $real_ext) == (strlen($file) - $real_ext_length)))
				$filtered_files[] = $subdir . $file;

			if ($recursive && $file[0] != '.' && is_dir($real_path . $file))
				foreach (Tools::scandir($path, $ext, $subdir . $file, $recursive) as $subfile)
					$filtered_files[] = $subfile;
		}
		return $filtered_files;
	}


	public static function modRewriteActive()
	{
		if (Tools::apacheModExists('mod_rewrite'))
			return true;
		if ((isset($_SERVER['HTTP_MOD_REWRITE']) && strtolower($_SERVER['HTTP_MOD_REWRITE']) == 'on') || strtolower(getenv('HTTP_MOD_REWRITE')) == 'on')
			return true;
		return false;
	}


	public static function unSerialize($serialized, $object = false)
	{
		if (is_string($serialized) && (strpos($serialized, 'O:') === false || !preg_match('/(^|;|{|})O:[0-9]+:"/', $serialized)) && !$object || $object)
			return @unserialize($serialized);

		return false;
	}

	/**
	 * Reproduce array_unique working before php version 5.2.9
	 * @param array $array
	 * @return array
	 */
	public static function arrayUnique($array)
	{
		if (version_compare(phpversion(), '5.2.9', '<'))
			return array_unique($array);
		else
			return array_unique($array, SORT_REGULAR);
	}


	/**
	 * Delete a substring from another one starting from the right
	 * @param string $str
	 * @param string $str_search
	 * @return string
	 */
	public static function rtrimString($str, $str_search)
	{
		$length_str = strlen($str_search);
		if (strlen($str) >= $length_str && substr($str, -$length_str) == $str_search)
			$str = substr($str, 0, -$length_str);
		return $str;
	}

	/**
	 * Get the directory size
	 * @param $directory directory
	 * @return int
	 */
	public static function dirSize($directory)
	{
		$size = 0;
		foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory)) as $file) {
			$size += $file->getSize();
		}
		return $size;
	}

	/**
	 * Format a number into a human readable format
	 * e.g. 24962496 => 23.81M
	 * @param     $size
	 * @param int $precision
	 *
	 * @return string
	 */
	public static function formatBytes($size, $precision = 2)
	{
		if (!$size)
			return '0';
		$base = log($size) / log(1024);
		$suffixes = array('', 'k', 'M', 'G', 'T');

		return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
	}

	public static function boolVal($value)
	{
		if (empty($value))
			$value = false;
		return (bool)$value;
	}

	/**
	 * Get all key from specific in a multidimensional array
	 *
	* @param $str string
	* @param $arr array
	* @return null|string|array
	*/
	public static function getArrayKeySpecific($str, array $arr){

		if (count($arr)<=0)
			return false;

		if (!is_array($arr))
			return false;

		if (array_key_exists($str, $arr))
		    foreach ($arr as $key => $array)
		        if ($key===$str)
		            return $array;
		        return false;
		return false;
	}


	public static function strposa($haystack, $needle, $offset=0) {
	    if(!is_array($needle)) $needle = array($needle);
	    foreach($needle as $query) {
	        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
	    }
	    return false;

	    /*

		$string = 'http://www.facebook.com/';
        $array  = array('facebook.com',
                        'twitter.com',
                        'pinterest.com',
                        'instagram.com',
                        'plus.google.com',
                        'youtube.com');

        var_dump(Tools::strposa($string, $array));


	    */


	}

	/**
	 * Funcao mascara
	 * @param  [type] $val  [description]
	 * @param  [type] $mask [description]
	 * @return [type]       [description]
	 */
	public static function mask($val, $mask)
	{
		/**
		 * http://blog.clares.com.br/php-mascara-cnpj-cpf-data-e-qualquer-outra-coisa/
		 */

		/**
		 *
		 *  $cnpj = "11222333000199";
		 *    $cpf = "00100200300";
		 *    $cep = "08665110";
		 *    $data = "10102010";
		 *    echo mask($cnpj,'##.###.###/####-##');
		 *    echo mask($cpf,'###.###.###-##');
		 *    echo mask($cep,'#####-###');
		 *    echo mask($data,'##/##/####');
		 *
		 */

		$maskared = '';
		$k = 0;
		for ($i = 0; $i <= strlen($mask) - 1; $i++) {
			if ($mask[$i] == '#') {
				if (isset($val[$k]))
					$maskared .= $val[$k++];

			} else {

				if (isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		}

		return $maskared;
	}

	/**
	 * Total de comentários do facebook
	 * @access public
	 * @return string
	 */
	public static function totalComentariosUrlFacebook()
	{

		$url = explode('?', Tools::getUrl());
		return '(<fb:comments-count href="' . $url[0] . '"></fb:comments-count>)';

	}

	/**
	 * Total de comentários do facebook
	 * @access public
	 * @return string
	 */
	public static function boxComentarioFacebook()
	{

		$url = explode('?', Tools::getUrl());
		return '<div class="fb-comments" data-href="' . $url[0] . '" data-numposts="5" data-colorscheme="light"></div>';

	}

	/**
	 * Pega a id do Youtube
	 * @param string $url
	 */
	public static function YoutubeID($url)
	{
		if (strlen($url) > 11) {
			if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
				return $match[1];
			} else
				return false;
		}
		return $url;
	}

	/**
	 * Recupera a imagem do produto no servidor
	 * @param string $diretorio nome do diretorio
	 * @param string $nome nome da imagem
	 * @param int $id_shop ID da loja
	 * @param int $id_produto id produto
	 * @return string url da imagem
	 */
	public static function getImagemProduto($diretorio = '', $nome = '', $id_shop = '', $id_produto = '')
	{

		$root_img = sprintf('%s%d/produto/%d/%s/%s',
			CDN_ROOT_UPLOAD,
			$id_shop,
			$id_produto,
			$diretorio,
			$nome
		);

		if (!file_exists($root_img)) {

			return sprintf('%sstatic/img/imagem-padrao/%s/produto-sem-imagem.gif', CDN, $diretorio);

		} else {

			return sprintf('%s%d/produto/%d/%s/%s',
				CDN_UPLOAD,
				$id_shop,
				$id_produto,
				$diretorio,
				$nome
			);

		}

	}

	/**
	 * Gera as tags de otimização
	 * @param string $title titulo da página
	 * @param string $url principal
	 * @param string $description descrição
	 * @param string $url_image imagem padrão
	 * @param string $site_name nome do site
	 * @return string metas
	 */
	public static function ogMetas($title='', $url='', $description='', $url_image='', $site_name='ViaLoja Shopping')
	{

		if (!empty($title)) {
			$title = str_replace('...', '', Tools::formatList($title, 70));
		}

		if (!empty($description)) {
			$description = str_replace('...', '.', Tools::formatList($description,160));
		}

		$html = '<meta property="og:title" content="' . $title . ' - ' . $site_name . '" />' . PHP_EOL;
	    $html .= '<meta property="og:url" content="'. $url .'" />' . PHP_EOL;
	    $html .= '<meta property="og:type" content="product" />' . PHP_EOL;
	    $html .= '<meta property="og:site_name" content="'. $site_name .'" />' . PHP_EOL;
		$html .= '<meta property="og:description" content="' . $description . '" />' . PHP_EOL;
		$html .= '<meta property="og:email" content="" />' . PHP_EOL;
		$html .= '<meta property="og:phone_number" content="" />' . PHP_EOL;
		$html .= '<meta property="og:street-address" content="" />' . PHP_EOL;
		$html .= '<meta property="og:locality" content="" />' . PHP_EOL;
		$html .= '<meta property="og:country-name" content="" />' . PHP_EOL;
	    $html .= '<meta property="og:postal-code" content="" />' . PHP_EOL;
    	$html .= '<meta property="og:image" content="'. $url_image .'" />' . PHP_EOL;
    	$html .= '<link rel="canonical" href="'. $url .'" />' . PHP_EOL;
    	return $html;
	}

	public static function calcByte($byte)
	{

	    if ($byte >= 1099511627776) {
	        $valor = Tools::convertToDecimalBR( round( ( $byte / 1099511627776 ), 1), 1 ) . " TB";
	    } elseif ($byte >= 1073741824) {
	        $valor = Tools::convertToDecimalBR( round( ( $byte / 1073741824 ), 1), 1 )  . " GB";
	    } elseif ($byte >= 1048576) {
	        $valor = Tools::convertToDecimalBR( round( ( $byte / 1048576 ), 1), 1 ) . " MB";
	    } elseif ($byte >= 1024) {
	        $valor = Tools::convertToDecimalBR( round( ( $byte / 1024 ), 1), 1 ) . " Kbytes";
	    } else {
	        $valor = Tools::convertToDecimalBR( round( $byte, 0), 1 ) . " Bytes";
	    }

	    return $valor;

	}

	/**
	 * Converte valores float, double e decimal para padrão brasileiro
	 * @param $valor
	 * @param int $casa total de casas apos a virgula
	 * @return string
     */
	public static function convertToDecimalBR($valor, $casa=2)
	{
		return number_format($valor, $casa, ',', '.');
	}

    /** Converte para Decimais do tipo float
     * @param $valor
     * @return float
     */
	public static function convertToDecimal($valor)
	{

		if (!is_numeric($valor)) {

			$valor = preg_replace('/[^0-9,-.]/i', '', $valor);
			$source = array('.', ',');
			$replace = array('', '.');
			$valor = str_replace($source, $replace, $valor);

		}
		return (float)$valor;
	}

	/**
	 * Passos do Usuário na Wizard
	 * @param  string $passo ID da url
	 * @return string url da Wizard
	 */
	public static function urlPassoWizard($passo='')
	{

		switch ( intval( $passo ) ) {

			case '1':
				return FULL_BASE_URL .'/admin/wizard/passo-1/configure-seu-acesso';
				break;

			case '2':
				return FULL_BASE_URL .'/admin/wizard/passo-2/configure-sua-loja';
				break;

			case '3':
				return FULL_BASE_URL .'/admin/wizard/passo-3/escolha-as-formas-de-envio-da-sua-loja';
				break;

			case '4':
				return FULL_BASE_URL .'/admin/wizard/passo-4/escolha-a-forma-de-pagamento-da-sua-loja';
				break;

			case '5':
				return FULL_BASE_URL .'/admin/wizard/passo-5/resumo';
				break;

		}

	}


	public static function getBrowser()
	{
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		$bname = 'Unknown';
		$platform = 'Unknown';
		$version= "";

		//First get the platform?
		if (preg_match('/linux/i', $u_agent)) {
			$platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
			$platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $u_agent)) {
			$platform = 'windows';
		}

		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}
		elseif(preg_match('/Firefox/i',$u_agent))
		{
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$u_agent))
		{
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$u_agent))
		{
			$bname = 'Apple Safari';
			$ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$u_agent))
		{
			$bname = 'Opera';
			$ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$u_agent))
		{
			$bname = 'Netscape';
			$ub = "Netscape";
		}

		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
			')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $u_agent, $matches)) {
			// we have no matching number just continue
		}

		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}
			else {
				$version= $matches['version'][1];
			}
		}
		else {
			$version= $matches['version'][0];
		}

		// check if we have a number
		if ($version==null || $version=="") {$version="?";}

		return array(
			'userAgent' => $u_agent,
			'name'      => $bname,
			'version'   => $version,
			'platform'  => $platform,
			'pattern'    => $pattern
		);

	}

	public static function tokenSecurityLogin()
	{

		$ip = filter_var(Tools::getRemoteAddr(), FILTER_VALIDATE_IP);
		$browser = Tools::getBrowser();
		if (!empty($ip) && isset($browser)) {
			return sha1( $browser['userAgent'] . $ip );
		} else {
			return false;
		}

	}

}
