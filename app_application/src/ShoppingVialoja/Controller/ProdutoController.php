<?php

App::uses('AppController', 'Controller');

class ProdutoController extends AppController {

	public $uses = array('ShopProduto', 'ShopCategoria', 'ConfiguracaoPagamento', 'ShopProdutoImagem', 'ShopProdutoVisualizado', 'ShopProdutoHits', 'ShopMarca', 'ConfiguracaoAtividade');

	private $id_produto;
	private $id_shop_default;
	private $nome_imagem;

	/**
	 * Visualização de dados de produto
	 * @access public
	 * @param String $slug
	 * @param Array $conditions
	 */
	public function visualizar() {

		self::commons_inc();
		define('INCLUDE_PRODUTO', true);

		if (isset($this->request->params['pass']['2'])) {

			//self::getConfiguracoes();

			$this->id_produto =  intval( Tools::clean( $this->request->params['pass']['2'] ) );

			if (!is_numeric($this->id_produto)) {
				return $this->redirect( array('controller' => 'default', 'action' => 'index') );
			}

			/**
			*
			* verifica se é bot
			*
			**/
	        if (!Validate::isBot()) {

				/**
				*
				* Add id de produtos visualizados
				*
				**/
				//self::add_produto_id();

			}

			/**
			 * Recupera dados dos produtos
			 */
           	self::getIdProduto();


			 /**
            *
            * Recupera as images do produto
            *
            **/
			//self::get_images_produto();

        }

		$this->set('title_for_layout', 'Produto xxx');

	}

	private function commons_inc()
	{

		$GLOBALS['ConfiguracaoAtividade']['res_atividades_option_all'] = $this->requestAction(array(
			'controller' => 'ConfiguracaoAtividade',
			'action' => 'optionAll'
		));

		$GLOBALS['ConfiguracaoAtividade']['res_atividades_all'] = $this->requestAction(array(
			'controller' => 'ConfiguracaoAtividade',
			'action' => 'atividadeAll'
		));

		$GLOBALS['BannerShopping']['res_managewidgets_footer_all'] = $this->requestAction(array(
			'controller' => 'BannerShopping',
			'action' => 'getBanner',
			'local_publicacao' => 'managewidgets-footer',
		));

	}

	private function getIdProduto()
	{
		try {

            $conditions = array(

	            'fields' => array(
	                'ShopProduto.id_produto',
	                'ShopProduto.sku',
	                'ShopProduto.nome',
	                'ShopProduto.usado',
	                'ShopProduto.preco_promocional',
	                'ShopProduto.preco_cheio',
	                'ShopProduto.descricao_completa',
	                'ShopProduto.title',
	                'ShopProduto.description',
	                'ShopProduto.id_marca',
	                'ShopProduto.id_shop_default',
	                'ShopProduto.quantidade',
	                'ShopProduto.gerenciado',
	                'ShopProduto.situacao_em_estoque',
	                'ShopProduto.situacao_sem_estoque',
	                'ShopProdutoImagem.nome_imagem',
	                'ShopDominio.dominio',
	                'ShopDominio.ssl_ativo',
	                'ShopDominio.subdominio_plataforma',
	                'Shop.id_shop',
	                'Shop.preferencia_url_dominio',
	                'Shop.nome_loja',

	            ),

	            'conditions' => array(

	            	'ShopProduto.parente_id' => 0,
                    'ShopProduto.ativo' => 'True',
                    'ShopProduto.id_produto' => $this->id_produto,
	                'ShopProduto.lixo' => 'False',
	                'ShopProduto.produto_sex_shop' => 'False',
	                'ShopProduto.nome !=' => '',
	                'ShopDominio.main' => 1,
	                'ShopDominio.ativo' => 1,
	                'ShopProdutoImagem.posicao' => 0,
	                'ShopProdutoImagem.nome_imagem !=' => '',
	            ),

	            'group' => array('ShopProduto.id_produto'),
				'limit' => $this->limit,

	            'joins' => array(

	                array(
	                    'table' => 'shop_produto_imagem',
	                    'alias' => 'ShopProdutoImagem',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProduto.id_produto = ShopProdutoImagem.id_produto_default'
	                    )
	                ),

	                array(
	                    'table' => 'shop_dominio',
	                    'alias' => 'ShopDominio',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProduto.id_shop_default = ShopDominio.id_shop_default'
	                    )
	                ),

	                array(
	                    'table' => 'shop',
	                    'alias' => 'Shop',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProduto.id_shop_default = Shop.id_shop'
	                    )
	                )

	            ),

	        );

            if ($this->ShopProduto->find('count', $conditions) <=0 ) {

                return $this->redirect(['controller' => 'default', 'action' => 'error', '404']);

            }

            $dados = $this->ShopProduto->find('first', $conditions);

            $sku = $dados['ShopProduto']['sku'];
            $nome = $dados['ShopProduto']['nome'];
            $usado = $dados['ShopProduto']['usado'];
            $quantidade = $dados['ShopProduto']['quantidade'];
            $gerenciado = $dados['ShopProduto']['gerenciado'];
            $situacao_em_estoque = $dados['ShopProduto']['situacao_em_estoque'];
            $situacao_sem_estoque = $dados['ShopProduto']['situacao_sem_estoque'];
            $descricao_completa = strip_tags( Tools::htmlentitiesDecodeUTF8( $dados['ShopProduto']['descricao_completa'] ) );
            $descricao_completa = Tools::formatList($descricao_completa, 400);
            $title = $dados['ShopProduto']['title'];
            $description = $dados['ShopProduto']['description'];
            $marca = $dados['ShopProduto']['id_marca'];
            $this->id_shop_default = $dados['ShopProduto']['id_shop_default'];
            $preco_cheio = $dados['ShopProduto']['preco_cheio'];
            $preco_promocional = $dados['ShopProduto']['preco_promocional'];
            $dominio = $dados['ShopDominio']['dominio'];
            $subdominio_plataforma = $dados['ShopDominio']['subdominio_plataforma'];
            $ssl_ativo = $dados['ShopDominio']['ssl_ativo'];
            $preferencia_url = $dados['Shop']['preferencia_url_dominio'];
            $nome_loja = $dados['Shop']['nome_loja'];

            $oferta = Validate::isValueBigger($preco_cheio, $preco_promocional);

			//'off_www','on_www','undefined'

			if ($subdominio_plataforma == 'True') {
				if ($ssl_ativo == 'True')
					$dominio_url = 'https://'. $dominio;
				else
					$dominio_url = 'http://'. $dominio;
			} else {

				if ($preferencia_url=='off_www') {

					if ($ssl_ativo=='True')
						$dominio_url = 'https://'. $dominio;
					else
						$dominio_url = 'http://'. $dominio;

				} else {

					if ($ssl_ativo=='True')
						$dominio_url = 'https://www.'. $dominio;
					else
						$dominio_url = 'http://www.'. $dominio;
				}

			}

			$url_produto_canonical = sprintf('%s/p/%s/%d/', $dominio_url, Tools::slug($nome), $this->id_produto );

			if ($this->Session->read('id_cliente') ) {

				$this->class_auto_login->setUrlDestination($dominio);
				$url_produto_loja = sprintf('%s/p/%s/%d/?utm_source=ViaLoja&utm_medium=SEO&utm_content=visite_loja&utm_campaign=%s&%s', $dominio_url, Tools::slug($nome), $this->id_produto, $sku, $this->class_auto_login->urlAutoLoginLoja() );

			} else {
				$url_produto_loja = sprintf('%s/p/%s/%d/?utm_source=ViaLoja&utm_medium=SEO&utm_content=visite_loja&utm_campaign=%s', $dominio_url, Tools::slug($nome), $this->id_produto, $sku );
			}


			if (!empty($marca)) {

				$return = $this->ShopMarca->getIdMarca($marca, $this->id_shop_default);

				$marca = '';
				if (count($return)>0) {
					$marca = $return['ShopMarca']['nome'];
				}

			}


			$GLOBALS['quantidade_produto'] = $quantidade;
			$GLOBALS['tag_title'] = $nome;

			if (!empty($description)) {
				$GLOBALS['tag_description'] = $description;
			} else {
				$description = str_replace('...', '.', Tools::formatList($descricao_completa,160));
				$GLOBALS['tag_description'] = $description;
			}

			if (empty($title)) {
				$title = $nome;
			}

			$this->set(compact('nome'));
			$this->set(compact('usado'));
			$this->set(compact('preco_cheio'));
			$this->set(compact('preco_promocional'));
			$this->set(compact('descricao_completa'));
			$this->set(compact('description'));
			$this->set(compact('nome_loja'));
			$this->set(compact('url_produto_loja'));
			$this->set(compact('url_produto_canonical'));
			$this->set(compact('marca'));
			$this->set(compact('oferta'));
			$this->set(compact('quantidade'));
			$this->set(compact('gerenciado'));
			$this->set(compact('situacao_em_estoque'));
			$this->set(compact('situacao_sem_estoque'));


			$res_pagamentos = $this->ConfiguracaoPagamento->getPagamentoJoinAll( $this->id_shop_default );
        	$this->set(compact('res_pagamentos'));

			self::getImagemPrincipalProduto($nome);
			self::getImagemThumbsProduto($nome);

			$img_url = Tools::getImagemProduto('large', $this->nome_imagem, $this->id_shop_default, $this->id_produto);

			$GLOBALS['seo_og_metas'] = Tools::ogMetas($title, $url_produto_canonical, $description, $img_url);


			/**
			 * Recupera nome da Atividada principal
			 */
			$res_shop_breadcrumb = $this->ConfiguracaoAtividade->atividadePrincipalProduto($this->id_produto);

			$atividade_shop_breadcrumb_id = '';
			$atividade_shop_breadcrumb_nome = '';
			if (count($res_shop_breadcrumb)>0) {
				$atividade_shop_breadcrumb_id = $res_shop_breadcrumb['ConfiguracaoAtividade']['id_atividade'];
				$atividade_shop_breadcrumb_nome = $res_shop_breadcrumb['ConfiguracaoAtividade']['nome'];
			}

			$this->set(compact('atividade_shop_breadcrumb_id'));
			$this->set(compact('atividade_shop_breadcrumb_nome'));

			$categoria_loja_breadcrumb = $this->ShopCategoria->categoriaProdutoBreadcrumb(null, $atividade_shop_breadcrumb_nome, $atividade_shop_breadcrumb_id, $this->id_shop_default, $this->id_produto);

	        $this->set(compact('categoria_loja_breadcrumb'));


		} catch (PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
        }

	}

	/**
	 * Recupera o path da iamgem no db
	 * @param  int $id_produto ID do produto
	 * @return string
	 */
	private function getImagemPrincipalProduto($nome = '')
	{

		$this->nome_imagem = $this->ShopProdutoImagem->getImagemPrincipal($this->id_produto);

		$img_cart = Tools::getImagemProduto('cart', $this->nome_imagem, $this->id_shop_default, $this->id_produto);
		$img_large = Tools::getImagemProduto('large', $this->nome_imagem, $this->id_shop_default, $this->id_produto);
		$img_thickbox = Tools::getImagemProduto('thickbox', $this->nome_imagem, $this->id_shop_default, $this->id_produto);

		$this->set(compact('img_cart'));
		$this->set(compact('img_large'));
		$this->set(compact('img_thickbox'));

	}

	/**
	 * Recupera o path da iamgem no db
	 * @param  int $id_produto ID do produto
	 * @return string
	 */
	private function getImagemThumbsProduto($nome = '')
	{

		$res_imagem = $this->ShopProdutoImagem->getImagemSecundariasAll($this->id_produto);

		$array_thumbs_produto = [];

		foreach ($res_imagem as $key => $imagem) {

			if ($imagem['ShopProdutoImagem']['posicao'] > 0) {

				$img_cart = Tools::getImagemProduto('cart', $imagem['ShopProdutoImagem']['nome_imagem'], $this->id_shop_default, $this->id_produto);
				$img_large = Tools::getImagemProduto('large', $imagem['ShopProdutoImagem']['nome_imagem'], $this->id_shop_default, $this->id_produto);
				$img_thickbox = Tools::getImagemProduto('thickbox', $imagem['ShopProdutoImagem']['nome_imagem'], $this->id_shop_default, $this->id_produto);

				$array_1 = [
					'img_cart' => $img_cart,
					'img_large' => $img_large,
					'img_thickbox' => $img_thickbox,
					'posicao' => $imagem['ShopProdutoImagem']['posicao'],
					//'nome' => $nome,
				];

				array_push($array_thumbs_produto, $array_1);

			}


		}

		foreach ($res_imagem as $key => $imagem) {

			if ($imagem['ShopProdutoImagem']['posicao'] <= 0) {

				$img_cart = Tools::getImagemProduto('cart', $imagem['ShopProdutoImagem']['nome_imagem'], $this->id_shop_default, $this->id_produto);
				$img_large = Tools::getImagemProduto('large', $imagem['ShopProdutoImagem']['nome_imagem'], $this->id_shop_default, $this->id_produto);
				$img_thickbox = Tools::getImagemProduto('thickbox', $imagem['ShopProdutoImagem']['nome_imagem'], $this->id_shop_default, $this->id_produto);

				$array_2 = [
					'img_cart' => $img_cart,
					'img_large' => $img_large,
					'img_thickbox' => $img_thickbox,
					'posicao' => $imagem['ShopProdutoImagem']['posicao'],
					//'nome' => $nome,
				];

				array_push($array_thumbs_produto, $array_2);

			}


		}

		$this->set(compact('array_thumbs_produto'));

	}

	/**
	 * Start id de dominio Main
	 * Pega o ID do shop via dominio e armazena na Session id_shop_url
	 * @access private
	 * @param String $url
	 * @return string
	 */
	private function getConfiguracoes()
	{

		if (defined('VITRINE_SHOPPING_VIALOJA')) {

			$this->layout = 'default-vitrine-vialoja';

		} else {

			//define('HOME_SHOP_LOJA', true);
			$this->layout = 'default-store';

			$this->requestAction(
				array(
					'controller' => 'Configuracoes',
					'action' => 'init'
				)
			);

		}

	}

	/**
	 * Add id do produto em cookie para mostrar últimos visualizados
	 * @param int $id_produto Id do produto
	 */
	private function add_produto_id()
	{

		try {

			if (isset($this->id_produto)) {

				if (isset($_COOKIE['__vialoja'])) {

					if (!Validate::isSessionId($_COOKIE['__vialoja'])) {
						$session_id = $this->Session->id();
					} else {
						$session_id = $this->Session->id( $_COOKIE['__vialoja'] );
					}

				} else {
					$session_id = $this->Session->id();
				}

		        $this->cookieViaLoja()->_setcookieLastProductView($this->id_produto, $session_id);

		        $conditions = array(
			        'conditions' => array(
			        	'ShopProdutoVisualizado.id_produto_default' => $this->id_produto,
			        	'ShopProdutoVisualizado.id_shop_default'    => ID_SHOP_DEFAULT,
			        	'ShopProdutoVisualizado.session_id'         => $session_id
			        )
			    );

				if ($this->ShopProdutoVisualizado->find('count', $conditions) <= 0 ) {

				 	$this->data = array(
		                'id_produto_default'   => $this->id_produto,
						'id_shop_default'      => $this->id_shop_default,
						//'id_cliente_default' => $id_cliente_default,
						'session_id'  	  	   => $session_id,
		            );

		            $this->ShopProdutoVisualizado->save($this->data);

		        }

		        $this->ShopProdutoVisualizado->deleteAll(array(
                    'DATE(ShopProdutoVisualizado.created) <= DATE_SUB(CURDATE(), INTERVAL 45 DAY)'
                ));

				$conditions = array(
			        'conditions' => array(
			        	'ShopProdutoHits.id_produto_default' => $this->id_produto,
			        	'ShopProdutoHits.id_shop_default'    => $this->id_shop_default,
			        )
			    );

				if ($this->ShopProdutoHits->find('count', $conditions) <= 0 ) {

				 	$this->data = array(
		                'id_produto_default' => $this->id_produto,
						'id_shop_default'    => $this->id_shop_default,
		            );

		            $this->ShopProdutoHits->save($this->data);

		        } else {

		        	$fields = array(
                        'ShopProdutoHits.hits' => 'ShopProdutoHits.hits+1'
                    );

                    $conditions = array(
                        'id_produto_default' => $this->id_produto,
                    );

                    $this->ShopProdutoHits->updateAll($fields, $conditions);

		        }

		    }

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

}
