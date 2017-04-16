<?php

use Lib\Validate;
use Lib\Blowfish;
App::uses('AppController', 'Controller');

class ShopDominioController extends AppController {

	public $uses = array('Shop', 'ShopDominio', 'ShopDominioRedirect');

	private $url;
	private $result;
	private $conditions;
	private $dominio;
	private $filter;
	private $cipher;

	/**
	 * Obter o id de dominio Main
	 * @access public
	 * @param String $id_shop
	 * @param String $dominio
	 * @return string
	 */
	public function getDadosDominioMain()
	{

		try {

			$this->dominio = env('HTTP_HOST');

			if (strpos($this->dominio, 'www.') !== false) {
				$this->dominio = self::limpa(env('HTTP_HOST'));
			}

			$this->result = $this->Shop->find('first', array(

                'fields' => array(
                    'Shop.id_shop',
                    'Shop.logo',
                    'Shop.favicon',
                    'Shop.nome_loja',
                    'Shop.descricao',
                	'Shop.email',
                	'Shop.telefone',
                	'Shop.descricao',
                	'Shop.blog',
                	'Shop.id_plano',
                	'Shop.loja_tipo',
                	'Shop.loja_nome_responsavel',
                    'Shop.loja_razao_social',
                    'Shop.loja_cpf',
                    'Shop.loja_cnpj',
                    'Shop.comentarios_produtos',
                	'Shop.preferencia_url_dominio',
                	'ShopDominio.ssl_ativo',
                	'ShopDominio.subdominio_plataforma',
                    'ShopDominio.dominio'
                ),

                'conditions' => array(
                    'ShopDominio.main' => 1,
					'ShopDominio.dominio' => $this->dominio
                ),

                'joins' => array(
                    array(
                        'table' => 'shop_dominio',
                        'alias' => 'ShopDominio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopDominio.id_shop_default = Shop.id_shop'
                        )

                    )

                )

            ));


            if ( !Validate::isNotNull($this->result) ) {
            	return $this->redirect(ERRO_404_LOJA_SHOP, 301, true);
            }

            /*
            if ($this->result['ShopDominio']['ssl_ativo'] == 'True') {
				$protocolo = 'https://';
			} else {
				$protocolo = 'http://';
			}
			*/


			if ($this->result['ShopDominio']['subdominio_plataforma'] == 'True') {

				if (strpos(env('HTTP_HOST'), 'www.') !== false) {

					if (defined('VITRINE_SHOP_LOJA')) {
						$this->url = self::protocolo() . self::limpa( env('HTTP_HOST') );
	        		} else {
	            		$this->url = self::protocolo() . self::limpa(Tools::getUrl());
	            	}

	        		return $this->redirect($this->url , 301, true);

	        	}

            } elseif ($this->result['Shop']['preferencia_url_dominio'] == 'on_www') {

            	if (strpos(env('HTTP_HOST'), 'www.') === false) {

            		if (defined('VITRINE_SHOP_LOJA')) {
						$this->url = self::protocolo() .'www.'. self::limpa( env('HTTP_HOST') );
            		} else {
	            		$this->url = self::protocolo() .'www.'. self::limpa(Tools::getUrl());
	            	}

            		return $this->redirect($this->url , 301, true);

				}

            } elseif ($this->result['Shop']['preferencia_url_dominio'] == 'off_www') {

            	if (strpos(env('HTTP_HOST'), 'www.') !== false) {

            		if (defined('VITRINE_SHOP_LOJA')) {
						$this->url = self::protocolo() . self::limpa( env('HTTP_HOST') );
            		} else {
	            		$this->url = self::protocolo() . self::limpa(Tools::getUrl());
	            	}

	            	return $this->redirect($this->url , 301, true);

				}

            }

        	$this->cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);
        	$this->set('cipher', $this->cipher);

			$GLOBALS['Shop']['id_loja_shop'] = $this->result['Shop']['id_shop'];
			$GLOBALS['Shop']['nome_loja_shop'] = $this->result['Shop']['nome_loja'];
			$GLOBALS['Shop']['logo_loja_shop'] = $this->result['Shop']['logo'];
			$GLOBALS['Shop']['telefone'] = $this->result['Shop']['telefone'];
			$GLOBALS['Shop']['email']    = $this->result['Shop']['email'];
			$GLOBALS['Shop']['descricao']  = $this->result['Shop']['descricao'];
			$GLOBALS['Shop']['blog']  = $this->result['Shop']['blog'];
			$GLOBALS['Shop']['id_plano']  = $this->result['Shop']['id_plano'];
			$GLOBALS['Shop']['loja_tipo']  = $this->result['Shop']['loja_tipo'];
			$GLOBALS['Shop']['loja_nome_responsavel'] = $this->result['Shop']['loja_nome_responsavel'];
			$GLOBALS['Shop']['loja_razao_social'] = $this->result['Shop']['loja_razao_social'];
			$GLOBALS['Shop']['comentarios_produtos'] = $this->result['Shop']['comentarios_produtos'];
			$GLOBALS['Shop']['loja_cpf'] = $this->cipher->decrypt( $this->result['Shop']['loja_cpf'] );
			$GLOBALS['Shop']['loja_cnpj'] = $this->cipher->decrypt( $this->result['Shop']['loja_cnpj'] );

            define('CDN_LOJA', CDN_UPLOAD . $this->result['Shop']['id_shop'] .'/');
			define('CDN_ROOT_LOJA', CDN_ROOT_UPLOAD . $this->result['Shop']['id_shop'] . DS);

			define('ID_SHOP_DEFAULT', $this->result['Shop']['id_shop']);
			define('TITLE_SHOP_HOME', Tools::formatList( $this->result['Shop']['nome_loja'] . ' - ' . ucfirst(strtolower($this->result['ShopDominio']['dominio'])), 90));
			define('DESCRIPTION_SHOP', Tools::formatList( $this->result['Shop']['descricao'], 250) );

			if (file_exists(sprintf('%sfavicon%s%s', CDN_ROOT_LOJA, DS, $this->result['Shop']['favicon']))) {
				define('FAVICON_SHOP', sprintf('%sfavicon/%s', CDN_LOJA, $this->result['Shop']['favicon']));
			} else {
				define('FAVICON_SHOP', null);
			}

			if (file_exists(sprintf('%slogo%s%s', CDN_ROOT_LOJA, DS, $this->result['Shop']['logo']))) {
				define('LOGO_SHOP', sprintf('%slogo/%s', CDN_LOJA, $this->result['Shop']['logo']));
			} else {
				define('LOGO_SHOP', null);
			}

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	private function limpa($url)
	{

		$url = str_replace('https://', '', $url);
		$url = str_replace('http://', '', $url);
		return str_replace('www.', '', $url);

	}

	private function protocolo()
	{

		//Pega Url de Origem
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
			return 'https://';
		} else {
			return 'http://';
		}

	}

	public function redirectUrl($url=null)
	{

		try {

			$this->conditions = array(

				'fields' => array(
					'ShopDominioRedirect.id_shop_default'
				),

				'conditions' => array(
					'ShopDominioRedirect.dominio' => $url
				)

			);

			if ($this->ShopDominioRedirect->find('count', $this->conditions) > 0) {

				$this->filter = $this->ShopDominioRedirect->find('first', array(

	                'fields' => array(
	                   	'Shop.preferencia_url_dominio',
	                    'ShopDominio.dominio'
	                ),

	                'conditions' => array(
	                    'ShopDominio.main' => 1,
						'ShopDominio.id_shop_default' => $this->filter['ShopDominioRedirect']['id_shop_default']
	                ),

	                'joins' => array(
	                    array(
	                        'table' => 'shop_dominio',
	                        'alias' => 'ShopDominio',
	                        'type' => 'INNER',
	                        'conditions' => array(
	                            'ShopDominio.id_shop_default = Shop.id_shop'
	                        )

	                    )

	                )

	            ));

				if ($this->result['Shop']['preferencia_url_dominio'] == 'on_www') {

					if (defined('VITRINE_SHOP_LOJA')) {
						$this->url = self::protocolo() .'www.'. $this->result['ShopDominio']['dominio'];
            		} else {
            			$this->url = self::protocolo() . 'www.'. self::replaceUrl($this->result['ShopDominio']['dominio']);
            		}

            		return $this->redirect($this->url, 301, true);

				} elseif ($this->result['Shop']['preferencia_url_dominio'] == 'off_www') {

					if (defined('VITRINE_SHOP_LOJA')) {
						$this->url = self::protocolo() . $this->result['ShopDominio']['dominio'];
            		} else {
            			$this->url = self::protocolo() . self::replaceUrl($this->result['ShopDominio']['dominio']);
            		}

            		return $this->redirect($this->url, 301, true);

				} else {

					if (defined('VITRINE_SHOP_LOJA')) {
						$this->redirect = self::protocolo() . $this->result['ShopDominio']['dominio'];
            		} else {
            			$this->url = self::protocolo() . self::replaceUrl($this->result['ShopDominio']['dominio']);
            		}

            		return $this->redirect($this->url, 301, true);

				}

				exit();

			}

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	private function replaceUrl($dominio=null)
	{

		if (isset($dominio)) {
			return str_replace(
				self::limpa( env('HTTP_HOST') ),
				$dominio,
				self::limpa( Tools::getUrl() )
			);
		} else {
			return false;
		}

	}

}
