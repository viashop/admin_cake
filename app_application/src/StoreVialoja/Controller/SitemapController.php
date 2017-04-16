<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

/**
 * http://tableless.com.br/tudo-que-voce-precisa-saber-sobre-sitemaps/
 */

class SitemapController extends AppController {

	const XML_NOT_FOUND = 'Arquivo de XML não encontrado.';
	public $layout = false;
	public $uses = array('ShopProduto', 'ShopCategoria','ShopPagina');
	private $dataXML;

	public function index() {

		$this->render(false);

		$this->requestAction(
			array(
				'controller' => 'Configuracoes',
				'action' => 'init'
			)
		);

		self::getDados();

	}

	private function getDados()
	{

		try {

			if (!isset($this->request->params['ext'])) {
	    		throw new Exception(ERROR_PROCESS, E_USER_NOTICE);
	    	}

		    if ($this->request->params['ext'] !== 'xml') {
		    	throw new Exception(ERROR_PROCESS, E_USER_NOTICE);
		    }

			$this->dataXML = self::getProduto();

			if (!Validate::isNotNull( $this->dataXML ) ) {
				throw new Exception(self::XML_NOT_FOUND, 1);
			}


			self::sitemap();

		} catch (Exception $e) {

			exit( $e->getMessage() );

		}
	}


	/**
     * Buscar Produtos Id do Shopping
     * @access private
	 * @return string
     */
    private function getProduto()
    {

        try {

        	$conditions = array(

                'fields' => array(
                    'ShopProduto.id_produto',
                    'ShopProduto.nome',
                    'ShopProduto.url',
                ),

                'conditions' => array(
                    'ShopProduto.ativo' => 'True',
                    'ShopProduto.lixo' => 'False',
                    'ShopProduto.parente_id' => 0,
                	'ShopProduto.id_shop_default' => ID_SHOP_DEFAULT
                ),

            );

            return $this->ShopProduto->find('all', $conditions);

        } catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    private function sitemap()
	{

		$this->render(false);

		header('Content-Type: text/xml');

		$xml = new DOMDocument( "1.0", "UTF-8" );

		$xml->preserveWhiteSpace = false;
		$xml->formatOutput = true;

		$base = $xml->appendChild($xml->createElement( 'urlset' ));

		$base->appendChild($xml->createAttribute('xmlns'))->appendChild($xml->createTextNode('http://www.sitemaps.org/schemas/sitemap/0.9'));

		self::sitemapBaseUrl($base,$xml);
		self::sitemapPagina($base,$xml);
		self::sitemapCategoria($base,$xml);

		foreach ($this->dataXML as $key => $data) {

			if (!empty($data['ShopProduto']['nome'])) {

				$url = $base->appendChild($xml->createElement( 'url' ));

				/**
				 * Url
				 */
				$url_produto_loja = sprintf('%s/p/%s/%d/', FULL_BASE_URL, $data['ShopProduto']['url'], $data['ShopProduto']['id_produto'] );

				$loc = $url->appendChild($xml->createElement( 'loc' ));
				$loc->appendChild($xml->createTextNode( $url_produto_loja ));

				$changefreq = $url->appendChild($xml->createElement( 'changefreq' ));
				$changefreq->appendChild($xml->createTextNode( 'always' ));

				$priority = $url->appendChild($xml->createElement( 'priority' ));
				$priority->appendChild($xml->createTextNode( '0.9' ));

			}

		}

		echo $xml->saveXML();
		exit();

	}

	private function sitemapBaseUrl($base,$xml)
	{

		$url = $base->appendChild($xml->createElement( 'url' ));

		$loc = $url->appendChild($xml->createElement( 'loc' ));
		$loc->appendChild($xml->createTextNode( FULL_BASE_URL ));

		$changefreq = $url->appendChild($xml->createElement( 'changefreq' ));
		$changefreq->appendChild($xml->createTextNode( 'always' ));

		$priority = $url->appendChild($xml->createElement( 'priority' ));
		$priority->appendChild($xml->createTextNode( '1.0' ));



	}

	public function sitemapPagina($base, $xml)
	{

		foreach ($this->ShopPagina->getAllSitemap() as $key => $categoria) {

			$url_pagina = sprintf('%s/t/%s/', FULL_BASE_URL, $categoria['ShopPagina']['url']);

			$url = $base->appendChild($xml->createElement( 'url' ));

			$loc = $url->appendChild($xml->createElement( 'loc' ));
			$loc->appendChild($xml->createTextNode($url_pagina));

			$changefreq = $url->appendChild($xml->createElement( 'changefreq' ));
			$changefreq->appendChild($xml->createTextNode( 'always' ));

			$priority = $url->appendChild($xml->createElement( 'priority' ));
			$priority->appendChild($xml->createTextNode('0.7'));

		}

	}

	public function sitemapCategoria($base, $xml)
	{

		foreach ($this->ShopCategoria->getAllSitemap() as $key => $categoria) {

			$url_categoria_loja = sprintf('%s/c/%s/%d/', FULL_BASE_URL, $categoria['ShopCategoria']['url'], $categoria['ShopCategoria']['id_categoria']);

			$url = $base->appendChild($xml->createElement( 'url' ));

			$loc = $url->appendChild($xml->createElement( 'loc' ));
			$loc->appendChild($xml->createTextNode($url_categoria_loja));

			$changefreq = $url->appendChild($xml->createElement( 'changefreq' ));
			$changefreq->appendChild($xml->createTextNode( 'always' ));

			$priority = $url->appendChild($xml->createElement( 'priority' ));
			$priority->appendChild($xml->createTextNode('0.8'));

		}

	}

}
