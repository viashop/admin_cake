<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

/**
 * http://board.phpbuilder.com/showthread.php?10372041-Creating-XML-node-with-CDATA
 */

class XmlController extends AppController {

	const XML_NOT_FOUND = 'Arquivo de XML não encontrado.';
	public $layout = false;
	public $uses = array('Shop', 'ShopProduto', 'ShopComparadorXml', 'ShopComparadorProduto');
	private $dataXML;
	private $parente_id = 0;
	private $sku;
	private $nome;
	private $id_produto;
	private $preco_cheio;
	private $preco_promocional;
	private $situacao_em_estoque;
	private $gerenciado;
	private $quantidade;
	private $atributo = false;

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

	    	if (!isset($this->request->params['pass']['1'])) {
	    		throw new Exception(ERROR_PROCESS, E_USER_NOTICE);
	    	}

			$dados = $this->ShopComparadorXml->getIdToken( ID_SHOP_DEFAULT, $this->request->params['pass']['0'], $this->request->params['pass']['1'] );

			if (!Validate::isNotNull($dados)) {
				throw new Exception(self::XML_NOT_FOUND, 1);
			}

			if ($dados['ShopComparadorXml']['todos_os_produtos'] !== 'True') {

				$dados1 = $this->ShopComparadorProduto->getArrayIdProduto( ID_SHOP_DEFAULT, $dados['ShopComparadorXml']['id_comparador_default'] );

				if (!Validate::isNotNull($dados1)) {
					throw new Exception(self::XML_NOT_FOUND, 1);
				}

				$arrayId = array();
				foreach ($dados1 as $key => $dados) {
					array_push( $arrayId, $dados['ShopComparadorProduto']['id_produto_default'] );
				}

				$this->dataXML = self::getProduto( $arrayId );

			} else {

				$this->dataXML = self::getProduto();

			}

			if (!Validate::isNotNull( $this->dataXML ) ) {
				throw new Exception(self::XML_NOT_FOUND, 1);
			}

			self::getXml();

		} catch (Exception $e) {

			exit( $e->getMessage() );

		}
	}

	/**
     * Buscar Produtos via Array ou Id do Shopping
     * @access private
     * @param Const ID_SHOP_DEFAULT variavel de sessão
     * @param Array $arrayId ids de produro
	 * @return string
     */
    private function getProduto($arrayId='')
    {

        try {


        	if (is_array( $arrayId ) ) {

                /**
        		 * Anunciar apenas os produtos da lista
        		 */
                $conditionsArray = array(

                    'ShopProduto.ativo' => 'True',
                    'ShopProduto.lixo' => 'False',
                	'ShopProduto.id_shop_default' => ID_SHOP_DEFAULT,
                	'OR' => array(
                		'ShopProduto.id_produto' => $arrayId,
                		'ShopProduto.parente_id' => $arrayId
                	)

                );

        	} else {

        		/**
        		 * Anunciar todos os produtos da Loja
        		 */
        		$conditionsArray = array(

                    'ShopProduto.ativo' => 'True',
                    'ShopProduto.lixo' => 'False',
                	'ShopProduto.id_shop_default' => ID_SHOP_DEFAULT
                );

        	}

        	$conditions = array(

                'fields' => array(

                    'ShopProduto.sku',
                    'ShopProduto.preco_sob_consulta',
                    'ShopProduto.id_produto',
                    'ShopProduto.parente_id',
                    'ShopProduto.nome',
                    'ShopProduto.usado',
                    'ShopProduto.preco_cheio',
                    'ShopProduto.preco_promocional',
                    'ShopProduto.description',
                    'ShopProduto.url',
                    'ShopProduto.situacao_em_estoque',
                    'ShopProduto.gerenciado',
                    'ShopProduto.quantidade',
                    'ShopProdutoImagem.nome_imagem',
                    'ShopCategoria.nome_categoria',
                    'ShopMarca.nome',

                ),

                'conditions' => $conditionsArray,

                'group' => array('ShopProduto.id_produto', 'ShopProduto.parente_id'),
                'order' => array('ShopProduto.nome' => 'ASC', 'ShopProduto.parente_id' => 'DESC', 'ShopProduto.gerenciado' => 'ASC', 'ShopProduto.quantidade' => 'DESC'),

                'joins' => array(

                    array(
                        'table' => 'shop_marca',
                        'alias' => 'ShopMarca',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopProduto.id_shop_default = ShopMarca.id_shop_default',
                            'ShopProduto.id_marca = ShopMarca.id_marca',
                        )
                    ),

                    array(
                        'table' => 'shop_produto_imagem',
                        'alias' => 'ShopProdutoImagem',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopProduto.id_produto = ShopProdutoImagem.id_produto_default',
                            'ShopProdutoImagem.posicao' => 0
                        )
                    ),

                    array(
                        'table' => 'shop_produto_categoria',
                        'alias' => 'ShopProdutoCategoria',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopProduto.id_produto = ShopProdutoCategoria.id_produto_default',
                        )
                    ),

                    array(
                        'table' => 'shop_categoria',
                        'alias' => 'ShopCategoria',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopCategoria.id_categoria = ShopProdutoCategoria.id_categoria_default',
                        )
                    ),

                ),

            );

            return $this->ShopProduto->find('all', $conditions);


        } catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

	/**
	 * Gerar XML
	 * @return array
	 */
	public function getXml()
	{

		switch ($this->request->params['pass']['1']) {

			case 'buscape':
				self::xmlBuscape();
				break;

			case 'google-merchant':
				self::googleMerchant();
				break;

			case 'muccashop':
				self::xmlMuccaShop();
				break;

			default:
				throw new Exception(ERROR_PROCESS, E_USER_NOTICE);
				break;
		}

	}

	private function xmlBuscape()
	{

		//http://developer.buscape.com.br/portal/developer/tutoriais/como-montar-o-xml-para-carga-de-produtos.html

		$this->render(false);

		header('Content-Type: text/xml');
		$xml = new DOMDocument( "1.0", "UTF-8" );

		$xml->preserveWhiteSpace = false;
		$xml->formatOutput = true;

		$base = $xml->appendChild($xml->createElement( 'buscape' ));
		$produtos = $base->appendChild($xml->createElement( 'produtos' ));

		foreach ($this->dataXML as $key => $data) {

			if ($this->atributo !== true) {

				$this->sku = $data['ShopProduto']['sku'];
				$this->nome = $data['ShopProduto']['nome'];
				$this->preco_cheio = $data['ShopProduto']['preco_cheio'];
				$this->preco_promocional = $data['ShopProduto']['preco_promocional'];
				$this->situacao_em_estoque = $data['ShopProduto']['situacao_em_estoque'];
				$this->gerenciado = $data['ShopProduto']['gerenciado'];
				$this->quantidade = $data['ShopProduto']['quantidade'];
				$this->id_produto = $data['ShopProduto']['id_produto'];

			}

			if ($data['ShopProduto']['parente_id'] > 0) {

				$this->sku = $data['ShopProduto']['sku'];
				$this->nome = $data['ShopProduto']['nome'];
				$this->preco_cheio = $data['ShopProduto']['preco_cheio'];
				$this->preco_promocional = $data['ShopProduto']['preco_promocional'];
				$this->situacao_em_estoque = $data['ShopProduto']['situacao_em_estoque'];
				$this->gerenciado = $data['ShopProduto']['gerenciado'];
				$this->quantidade = $data['ShopProduto']['quantidade'];
				$this->id_produto = $data['ShopProduto']['parente_id'];
				$this->atributo = true;

			}

			if ($data['ShopProduto']['parente_id'] <= 0) {

				if (!empty($this->nome) ) {

					$produto = $produtos->appendChild($xml->createElement( 'produto' ));

					/**
					 * Nome produto
					 */
					$titulo = $produto->appendChild($xml->createElement( 'titulo' ));
					$titulo->appendChild($xml->createCDATASection( $this->nome ));

					if (!empty($data['ShopProduto']['description'])) {
						$descricao = $produto->appendChild($xml->createElement( 'descricao' ));
						$descricao->appendChild($xml->createCDATASection( $data['ShopProduto']['description'] ));
					}

					//Buscape
					$canal_buscape = $produto->appendChild($xml->createElement( 'canal_buscape' ));

					/**
					 * Url
					 */

					$url_produto_loja = sprintf('%s/p/%s/%d/?utm_source=Buscape&utm_medium=XML&utm_campaign=%s', FULL_BASE_URL, $data['ShopProduto']['url'], $this->id_produto, $data['ShopProduto']['sku'] );

					$canal_url = $canal_buscape->appendChild($xml->createElement( 'canal_url' ));
					$canal_url->appendChild($xml->createCDATASection( $url_produto_loja ));

					$valores = $canal_buscape->appendChild($xml->createElement( 'valores' ));
					$valor = $valores->appendChild($xml->createElement( 'valor' ));

					$forma_de_pagamento = $valor->appendChild($xml->createElement( 'forma_de_pagamento' ));
					$forma_de_pagamento->appendChild($xml->createTextNode( 'boleto' ));

					$parcelamento = $valor->appendChild($xml->createElement( 'parcelamento' ));
					$parcelamento->appendChild($xml->createTextNode( '1x R$ 149,00' ));

					$canal_preco = $valor->appendChild($xml->createElement( 'canal_preco' ));
					$canal_preco->appendChild($xml->createTextNode( 'R$ '. Tools::convertToDecimalBR( $this->preco_cheio ) ) );


					//Lomadee
					$canal_lomadee = $produto->appendChild($xml->createElement( 'canal_lomadee' ));

					/**
					 * Url
					 */



					$url_produto_loja = sprintf('%s/p/%s/%d/?utm_source=Lomadee&utm_medium=XML&utm_campaign=%s', FULL_BASE_URL, $data['ShopProduto']['url'], $this->id_produto, $data['ShopProduto']['sku'] );

					$canal_url = $canal_lomadee->appendChild($xml->createElement( 'canal_url' ));
					$canal_url->appendChild($xml->createCDATASection( $url_produto_loja ));


					$valores = $canal_lomadee->appendChild($xml->createElement( 'valores' ));
					$valor = $valores->appendChild($xml->createElement( 'valor' ));

					$forma_de_pagamento = $valor->appendChild($xml->createElement( 'forma_de_pagamento' ));
					$forma_de_pagamento->appendChild($xml->createTextNode( 'boleto' ));

					$parcelamento = $valor->appendChild($xml->createElement( 'parcelamento' ));
					$parcelamento->appendChild($xml->createTextNode( '1x R$ 149,00' ));

					if (Validate::isValueBigger($this->preco_cheio,$this->preco_promocional)) {

						/**
						 * Valor Promo
						 */
						if (!empty($this->preco_promocional)) {
							$valor_promo = $produto->appendChild($xml->createElement( 'valor_promo' ));
							$valor_promo->appendChild($xml->createCDATASection( Tools::convertToDecimalBR( $this->preco_promocional ) ));
						}

					} else {

						$canal_preco = $valor->appendChild($xml->createElement( 'canal_preco' ));
						$canal_preco->appendChild($xml->createTextNode( 'R$ '. Tools::convertToDecimalBR( $this->preco_cheio ) ) );

					}

					$id_oferta = $produto->appendChild($xml->createElement( 'id_oferta' ));
					$id_oferta->appendChild($xml->createCDATASection( $this->sku ));

					/**
					 * Url Imagem
					 */
					if (!empty($data['ShopProdutoImagem']['nome_imagem'])) {

						$url_img = sprintf( '%s%d/produto/%d/home/%s',
							FULL_BASE_URL,
							ID_SHOP_DEFAULT,
							$this->id_produto,
							$data['ShopProdutoImagem']['nome_imagem']
						);

						$imagens = $produto->appendChild($xml->createElement( 'imagens' ));
						$imagem = $imagens->appendChild($xml->createElement( 'imagem' ));
						$imagem->appendChild($xml->createTextNode( $url_img ));

					}

					/**
					 * Nome categoria
					 */
					if (!empty($data['ShopCategoria']['nome_categoria'])) {
						$categoria = $produto->appendChild($xml->createElement( 'categoria' ));
						$categoria->appendChild($xml->createCDATASection( $data['ShopCategoria']['nome_categoria'] ));
					}

					/**
					 * Especificações
					 */
					if (!empty($data['ShopMarca']['nome'])) {

						$especificacoes = $produto->appendChild($xml->createElement( 'especificacoes' ));
						$especificacao = $especificacoes->appendChild($xml->createElement( 'especificacao' ));

						$nome = $especificacao->appendChild($xml->createElement( 'nome' ));
						$nome->appendChild($xml->createTextNode( 'Marca' ));

						$valor = $especificacao->appendChild($xml->createElement( 'valor' ));
						$valor->appendChild($xml->createCDATASection( $data['ShopMarca']['nome'] ));

					}

					$disponibilidade = $produto->appendChild($xml->createElement( 'disponibilidade' ));

					if ($this->gerenciado == 'True' ) {

						if ($this->quantidade <= 0 ) {

							$disponibilidade->appendChild($xml->createCDATASection( 'Indisponível' ));

						} else {

		    		        $disponibilidade->appendChild($xml->createTextNode( $this->quantidade ));

		    		    }

					} else {

						if ($this->situacao_em_estoque <= 0 ) {

							$disponibilidade->appendChild($xml->createCDATASection( 'Imediata' ));

						} else {

							$disponibilidade->appendChild($xml->createCDATASection( 'Indisponível' ));
						}

					}

				}

			}

			if ($data['ShopProduto']['parente_id'] <= 0) {

				$this->sku = null;
				$this->nome = null;
				$this->id_produto = null;
				$this->preco_cheio = null;
				$this->preco_promocional = null;
				$this->situacao_em_estoque = null;
				$this->gerenciado = null;
				$this->quantidade = null;
				$this->atributo = null;

			}

		}

		echo $xml->saveXML();
		exit();


	}


	/**
	 * Gera XML Google
	 * @return array
	 */
	public function googleMerchant()
	{

		$this->render(false);

		header('Content-Type: text/xml');

		$xml = new DOMDocument( "1.0", "UTF-8" );

		$shop = $this->Shop->getNomeDescricaoXML( ID_SHOP_DEFAULT );

		$xml->preserveWhiteSpace = false;
		$xml->formatOutput = true;

		// root rss
		$base = $xml->appendChild($xml->createElement( 'rss' ));

		$base->appendChild($xml->createAttribute('xmlns:g'))->appendChild($xml->createTextNode('http://base.google.com/ns/1.0'));

		// version
		$version = '2.0';
		$base->appendChild($xml->createAttribute('version'))->appendChild($xml->createTextNode($version));

		$channel = $base->appendChild($xml->createElement( 'channel' ));

		$title = $channel->appendChild($xml->createElement( 'title' ));
		$title->appendChild($xml->createTextNode( $shop['Shop']['nome_loja'] ));

		$link = $channel->appendChild($xml->createElement( 'link' ));
		$link->appendChild($xml->createTextNode( FULL_BASE_URL ));

		$description = $channel->appendChild($xml->createElement( 'description' ));
		$description->appendChild($xml->createCDATASection( $shop['Shop']['descricao'] ));


		foreach ($this->dataXML as $key => $data) {

			if ($this->atributo !== true) {

				$this->sku = $data['ShopProduto']['sku'];
				$this->nome = $data['ShopProduto']['nome'];
				$this->preco_cheio = $data['ShopProduto']['preco_cheio'];
				$this->preco_promocional = $data['ShopProduto']['preco_promocional'];
				$this->id_produto = $data['ShopProduto']['id_produto'];

			}

			if ($data['ShopProduto']['parente_id'] > 0) {

				$this->sku = $data['ShopProduto']['sku'];
				$this->nome = $data['ShopProduto']['nome'];
				$this->preco_cheio = $data['ShopProduto']['preco_cheio'];
				$this->preco_promocional = $data['ShopProduto']['preco_promocional'];
				$this->id_produto = $data['ShopProduto']['parente_id'];
				$this->atributo = true;

			}

			if ($data['ShopProduto']['parente_id'] <= 0) {

				if (!empty($this->nome)) {

					if ( $data['ShopProduto']['parente_id'] <= 0 ) {
						$this->id_produto = $data['ShopProduto']['id_produto'];
					} else {
						$this->id_produto = $data['ShopProduto']['parente_id'];
					}

					$iten = $channel->appendChild($xml->createElement( 'iten' ));

					$title = $iten->appendChild($xml->createElement( 'title' ));
					$title->appendChild($xml->createCDATASection( $this->nome ));

					/**
					 * Url
					 */
					$url_produto_loja = sprintf('%s/p/%s/%d/?utm_source=GoogleMerchant&utm_medium=XML&utm_campaign=%s', FULL_BASE_URL, $data['ShopProduto']['url'], $this->id_produto, $data['ShopProduto']['sku'] );

					$link = $iten->appendChild($xml->createElement( 'link' ));
					$link->appendChild($xml->createCDATASection( $url_produto_loja ));

					/**
					 * Description
					 */
					if (!empty($data['ShopProduto']['description'])) {

						$description = $iten->appendChild($xml->createElement( 'description' ));
						$description->appendChild($xml->createCDATASection( $data['ShopProduto']['description'] ));

					}

					/**
					 * Url Imagem
					 */
					if (!empty($data['ShopProdutoImagem']['nome_imagem'])) {

						if (!empty($data['ShopProdutoImagem']['nome_imagem'])) {

							$url_img = sprintf( '%s%d/produto/%d/home/%s',
								FULL_BASE_URL,
								ID_SHOP_DEFAULT,
								$this->id_produto,
								$data['ShopProdutoImagem']['nome_imagem']
							);

						}

						$image_link = $iten->appendChild($xml->createElement( 'g:image_link' ));
						$image_link->appendChild($xml->createCDATASection( $url_img ));

					}

					/**
					 * Valor
					 */
					$price = $iten->appendChild($xml->createElement( 'g:price' ));
					if (isset($this->preco_cheio) && $this->preco_cheio>0) {
						$price->appendChild($xml->createTextNode( $this->preco_cheio .' BRL' ));
					} else {
						$price->appendChild($xml->createTextNode( 'None BRL' ));
					}

					if (Validate::isValueBigger($this->preco_cheio,$this->preco_promocional)) {

						/**
						 * Valor Promo
						 */
						if (!empty($this->preco_promocional)) {

							$sale_price = $iten->appendChild($xml->createElement( 'g:sale_price' ));
							$sale_price->appendChild($xml->createTextNode( $this->preco_promocional .' BRL' ));

						}

					}

					/**
					 * Begin - Parcelamento
					 */

					$installment = $iten->appendChild( $xml->createElement( 'g:installment' ) );

					$months = $installment->appendChild($xml->createElement( 'g:months' ));
					$months->appendChild( $xml->createTextNode(6) );

					$amount = $installment->appendChild($xml->createElement( 'g:amount' ));
					$amount->appendChild( $xml->createTextNode('50 BRL') );

					/*
					 * END - Parcelamento
					 */
					$condition = $iten->appendChild($xml->createElement( 'g:condition' ));
					if ($data['ShopProduto']['usado'] === 'True') {
						$condition->appendChild($xml->createTextNode( 'used' ));;
					} else {
						$condition->appendChild($xml->createTextNode( 'new' ));
					}

					$availability = $iten->appendChild($xml->createElement( 'g:availability' ));

					if ($this->gerenciado == 'True' ) {

						if ($this->quantidade == '0') {

		    		        $availability->appendChild($xml->createCDATASection( 'out of stock' ));

						} else {

							$availability->appendChild($xml->createCDATASection( 'in stock' ));// out of stock

		    		    }

					} else {

						$availability->appendChild($xml->createCDATASection( 'in stock' ));// out of stock

					}

					$id = $iten->appendChild($xml->createElement( 'g:id' ));
					$id->appendChild($xml->createCDATASection( $this->sku ));

					$mpn = $iten->appendChild($xml->createElement( 'g:mpn' ));
					$mpn->appendChild($xml->createCDATASection( $this->sku ));

					/**
					 * Marca
					 */
					$brand = $iten->appendChild($xml->createElement( 'g:brand' ));
					if (!empty($data['ShopMarca']['nome'])) {

						$brand->appendChild($xml->createCDATASection( $data['ShopMarca']['nome'] ));

					} else {

						$brand->appendChild($xml->createCDATASection( 'None' ));

					}

					$product_type = $iten->appendChild($xml->createElement( 'g:product_type' ));
					if (!empty($data['ShopCategoria']['nome_categoria'])) {
						$product_type->appendChild($xml->createCDATASection( $data['ShopCategoria']['nome_categoria'] ));
					} else {
						$product_type->appendChild($xml->createCDATASection( 'Sem Categoria' ));
					}

					$online_only = $iten->appendChild($xml->createElement( 'g:online_only' ));
					$online_only->appendChild( $xml->createTextNode('y') );

				}

			}

			if ($data['ShopProduto']['parente_id'] <= 0) {

				$this->sku = null;
				$this->nome = null;
				$this->id_produto = null;
				$this->preco_cheio = null;
				$this->preco_promocional = null;
				$this->atributo = null;

			}

		}

		echo $xml->saveXML();
		exit();

	}

    private function xmlMuccaShop()
	{

		//http://loja.muccashop.com.br/manualdoxml/

		$this->render(false);

		header('Content-Type: text/xml');
		$xml = new DOMDocument( "1.0", "UTF-8" );

		$xml->preserveWhiteSpace = false;
		$xml->formatOutput = true;

		$base = $xml->appendChild($xml->createElement( 'loja' ));

		foreach ($this->dataXML as $key => $data) {

			if ($this->atributo !== true) {

				$this->sku = $data['ShopProduto']['sku'];
				$this->nome = $data['ShopProduto']['nome'];
				$this->preco_cheio = $data['ShopProduto']['preco_cheio'];
				$this->preco_promocional = $data['ShopProduto']['preco_promocional'];
				$this->id_produto = $data['ShopProduto']['id_produto'];

			}

			if ($data['ShopProduto']['parente_id'] > 0) {

				$this->sku = $data['ShopProduto']['sku'];
				$this->nome = $data['ShopProduto']['nome'];
				$this->preco_cheio = $data['ShopProduto']['preco_cheio'];
				$this->preco_promocional = $data['ShopProduto']['preco_promocional'];
				$this->id_produto = $data['ShopProduto']['parente_id'];
				$this->atributo = true;

			}

			if ($data['ShopProduto']['parente_id'] <= 0) {

				if (!empty($this->nome) && $this->preco_cheio > 0) {

					if ( $data['ShopProduto']['parente_id'] <= 0 ) {
						$this->id_produto = $data['ShopProduto']['id_produto'];
					} else {
						$this->id_produto = $data['ShopProduto']['parente_id'];
					}

					$produto = $base->appendChild($xml->createElement( 'produto' ));

					/**
					 * Url
					 */

					$url_produto_loja = sprintf('%s/p/%s/%d/?utm_source=MuccaShop&utm_medium=XML&utm_campaign=%s', FULL_BASE_URL, $data['ShopProduto']['url'], $this->id_produto, $data['ShopProduto']['sku'] );

					$link = $produto->appendChild($xml->createElement( 'link' ));
					$link->appendChild($xml->createCDATASection( $url_produto_loja ));

					/**
					 * Url Imagem
					 */
					if (!empty($data['ShopProdutoImagem']['nome_imagem'])) {

						if (!empty($data['ShopProdutoImagem']['nome_imagem'])) {

							$url_img = sprintf( '%s%d/produto/%d/home/%s',
								FULL_BASE_URL,
								ID_SHOP_DEFAULT,
								$this->id_produto,
								$data['ShopProdutoImagem']['nome_imagem']
							);

						}

						$imagem = $produto->appendChild($xml->createElement( 'imagem' ));
						$imagem->appendChild($xml->createCDATASection( $url_img ));

					}

					/**
					 * Nome produto
					 */
					$nome = $produto->appendChild($xml->createElement( 'nome' ));
					$nome->appendChild($xml->createCDATASection( $this->nome ));

					/**
					 * Nome categoria
					 */
					if (!empty($data['ShopCategoria']['nome_categoria'])) {
						$categoria = $produto->appendChild($xml->createElement( 'categoria' ));
						$categoria->appendChild($xml->createCDATASection( $data['ShopCategoria']['nome_categoria'] ));
					}

					/**
					 * Description
					 */
					if (!empty($data['ShopProduto']['description'])) {
						$description = $produto->appendChild($xml->createElement( 'description' ));
						$description->appendChild($xml->createCDATASection( $data['ShopProduto']['description'] ));
					}

					/**
					 * Valor
					 */
					$valor = $produto->appendChild($xml->createElement( 'valor' ));
					$valor->appendChild($xml->createCDATASection( Tools::convertToDecimalBR( $this->preco_cheio ) ) );

					if (Validate::isValueBigger($this->preco_cheio,$this->preco_promocional)) {

						/**
						 * Valor Promo
						 */
						if (!empty($this->preco_promocional)) {
							$valor_promo = $produto->appendChild($xml->createElement( 'valor_promo' ));
							$valor_promo->appendChild($xml->createCDATASection( Tools::convertToDecimalBR( $this->preco_promocional ) ));
						}

					}

					/**
					 * Parcelamento Valor
					 */
					//$parcelamento = $produto->appendChild($xml->createElement( 'parcelamento' ));
					//$parcelamento->appendChild($xml->createCDATASection( '2x R$47,95' ) );

					/**
					 * Marca
					 */
					if (!empty($data['ShopMarca']['nome'])) {
						$marca = $produto->appendChild($xml->createElement( 'marca' ));
						$marca->appendChild($xml->createCDATASection( $data['ShopMarca']['nome'] ));
					}

				}

			}

			if ($data['ShopProduto']['parente_id'] <= 0) {

				$this->sku = null;
				$this->nome = null;
				$this->id_produto = null;
				$this->preco_cheio = null;
				$this->preco_promocional = null;
				$this->atributo = null;

			}

		}

		echo $xml->saveXML();
		exit();

	}

}
