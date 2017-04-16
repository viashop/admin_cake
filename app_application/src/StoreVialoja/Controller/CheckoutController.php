<?php

use Lib\Validate;
use Correios\Calculos\Ect\Prdt\ECTFormatos as ECTFormatos;
use Correios\Calculos\Ect\Prdt\ECTServicos as ECTServicos;
use Respect\Validation\Validator as v;
App::uses('AppController', 'Controller');

class CheckoutController extends AppController {

	public $layout = 'default-store';
	public $uses = array('ShopProduto', 'ShopEnvioCorreios', 'ShopEnvioMotoboy', 'ShopEnvioPessoalmente', 'ShopEnvioTransportadora', 'ShopEnvioPersonalizado', 'ShopCupomDesconto', 'ShopCarrinho', 'ShopCarrinhoProdutoDescricao', 'ShopCarrinhoProdutoAtributo', 'ShopFreteGratis');

	private $cookie_session_id;
	private $cep_destino, $total_peso, $altura, $largura, $comprimento;

	public function index()
	{

		self::getConfig();

	}

	private function getConfig() {

		$this->requestAction(
			array(
				'controller' => 'Configuracoes',
				'action' => 'init'
			)
		);

	}

	public function onepage() {

		define('ONEPAGE_SHOP_LOJA', true);
		self::getConfig();

	}

	public function sucesso() {

		define('CART_SHOP_LOJA', true);
		self::getConfig();

	}

	/**
	 * Checkout - Carrrinho de compras
	 * @access public
	 * @param String $id_produto
	 * @return string
	 */
	public function carrinho() {


		define('CART_SHOP_LOJA', true);
		self::getConfig();

		$this->Session->write('id_shop_default', ID_SHOP_DEFAULT);

		$id_produto = null;
		if (isset($this->request->params['pass']['2'])) {
			$id_produto = $this->request->params['pass']['2'];
		}

		/**
		 * Deleta produto do carrinho
		 */
		if (isset($this->request->params['pass']['0'])) {
			if ($this->request->params['pass']['0']=='remover') {
				self::deleteProdutoCarrinho();
			}
		}

		/**
         * Checa Key e Id do Produto
         */
		self::checaProdutoKey($id_produto);

		/**
         * Caso perca a sessão restaura o ID
         */
        self::recuperaIdCarrinho();


		/**
		 * Atualiza itens do carrinho
		 */

		if ($this->request->is('post')) {

			/**
			 * Atualiza e Limpa os Carrinho de compras
			 */
			if (Tools::getValue('update_cart_action') != '') {
				if (Tools::getValue('update_cart_action') == 'update_qty')
					self::updateProdutoCarrinho();
				if (Tools::getValue('update_cart_action') == 'empty_cart')
					self::limpaCarrinho();
			}

			/**
			 * Cadastra novo item e carrinho
			 */
			self::cadastraItemCarrrinho($id_produto);

		}

		/**
         * Lista os dados do Carrinho
         */
        $carrinho_lista = self::getCarrinhoLista();

        /**
         * Aplica cupom de desconto
         */
        if ($this->request->is('post')) {

        	if (Tools::getValue('cupom_desconto') == 'True') {

        		if (Tools::getValue('cupom_desconto') == 'True') {
        			self::cupomDescontoCode( $carrinho_lista );
        			return $this->redirect( $this->referer() );
        		}

			}

			/**
			 * Calcula e atualiza valores do Frete no Carrinho
			 */
			if (Tools::getValue('frete_carrinho_acao') != '') {

				if (Tools::getValue('frete_carrinho_acao') == 'calcular') {
					self::cadastraCepDestinoCarrinho();
					return $this->redirect( $this->referer() .'#frete' );
				}

				if (Tools::getValue('frete_carrinho_acao') == 'atualizar') {
					self::cadastraIdFormaEnvioFreteCarrinho();
					return $this->redirect( $this->referer() .'#total' );
				}

			}

        }

        /**
         * Deleta os cookies caso esteja vazio o carrinho
         */
        if ( isset($_COOKIE['__vialoja_cart']) || isset($_COOKIE['__vialoja_minicart']) ) {
        	if (count($carrinho_lista) <=0) {
	        	self::limpaCarrinho(true);
	        }
        }

        self::minicart();

        $this->set(compact('carrinho_lista'));

        $cupom_ativo = $this->ShopCupomDesconto->getCupomAtivo(ID_SHOP_DEFAULT);
        $this->set(compact('cupom_ativo'));

        foreach ($carrinho_lista as $key => $carrinho);

        $carrinho_cep = null;
        if (!empty($carrinho['ShopCarrinho']['cep'])) {
        	$carrinho_cep = $carrinho['ShopCarrinho']['cep'];
        	$this->cep_destino = $carrinho_cep;
        }

        $this->set(compact('carrinho_cep'));

        $carrinho_id_envio = null;
        if (!empty($carrinho['ShopCarrinho']['id_envio_default'])) {
        	$carrinho_id_envio = $carrinho['ShopCarrinho']['id_envio_default'];
        }

        $this->set(compact('carrinho_id_envio'));

    	if (isset($this->cep_destino) && !empty($this->cep_destino)) {

    		$envio_formas = $this->ShopEnvioCorreios->getAll( ID_SHOP_DEFAULT );

    		$arr_return_frete = self::freteCarrinhoCalcular($carrinho_lista, $envio_formas);
			$this->set(compact('arr_return_frete'));
			$this->set(compact('envio_formas'));

			extract(get_object_vars($this));
			$this->set(compact('total_peso'));

    	}

		$this->configCSRFGuard();

	}

	/**
	 * Deleta item do carrinho
	 * @return string
	 */
	private function deleteProdutoCarrinho()
	{

		try {

			$ajx = false;
			if ($this->request->is('ajax')) {
				$ajx = true;
			}

			if (!Validate::isMd5($this->request->params['pass']['3'])) {

				if ($ajx === true)
					return false;
				return $this->redirect($this->referer());
			}

			$conditions = array(
				'ShopCarrinhoProdutoDescricao.id_carrinho_descricao' => intval($this->request->params['pass']['2']),
				'ShopCarrinhoProdutoDescricao.key' => $this->request->params['pass']['3']
			);

			$this->ShopCarrinhoProdutoDescricao->deleteAll($conditions);

			if ($this->ShopCarrinhoProdutoDescricao->getAffectedRows()) {

				/**
				 * Lista os dados do Carrinho
				 */
				$carrinho_lista = self::getCarrinhoLista();

				if (count($carrinho_lista) <= 0) {
					self::limpaCarrinho(true);
				}

				$alert_flash = 'success';

			} else {

				$alert_flash = 'danger';
			}

			if ($ajx === false) {

				if ($alert_flash == 'success') {
					$this->Session->setFlash(__('Produto excluído com sucesso.'), 'alert-box', array('class' => 'success-msg'));
				} elseif ($alert_flash == 'danger') {
					$this->Session->setFlash(__('Não foi possivel excluir o produto, por favor tente novamente.'), 'alert-box', array('class' => 'error-msg'));
				}

				return $this->redirect($this->referer());

			}

		} catch (PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

	/**
	 * Lista os dados do carrinho
	 * @return array
	 */
	private function getCarrinhoLista()
	{

		try {

			$id_shop_default = null;
			$id_carrinho = null;

			if ($this->Session->read('id_shop_default')
				&& $this->Session->read('id_carrinho')
			) {

				$id_shop_default = $this->Session->read('id_shop_default');
				$id_carrinho = $this->Session->read('id_carrinho');

			} else {

				if (isset($_COOKIE['__vialoja_cart_shop'])) {
					$cart_shop = explode('|', $_COOKIE['__vialoja_cart_shop']);
					$id_shop_default = intval($cart_shop[0]);
					$id_carrinho = intval($cart_shop[1]);
				}

			}

			$conditions = array(

				'fields' => array(
					'ShopCarrinho.cep',
					'ShopCarrinho.id_envio_default',
					'ShopCarrinhoProdutoDescricao.id_carrinho_descricao',
					'ShopCarrinhoProdutoDescricao.id_produto_default',
					'ShopCarrinhoProdutoDescricao.qtde',
					'ShopCarrinhoProdutoDescricao.preco',
					'ShopCarrinhoProdutoDescricao.key',
					'ShopProduto.nome',
					'ShopProduto.peso',
					'ShopProduto.altura',
					'ShopProduto.largura',
					'ShopProduto.comprimento',
					'ShopProdutoImagem.nome_imagem',
					'ShopCupomDesconto.*'

				),

				'conditions' => array(
					'ShopCarrinho.id_shop_default' => $this->Session->read('id_shop_default'),
					'ShopCarrinho.id_carrinho' => $this->Session->read('id_carrinho'),
					//'ShopProdutoImagem.posicao' => 0,
					//'ShopProduto.parente_id' => 0,
					//'ShopProduto.ativo' => 'True',
					//'ShopProduto.lixo' => 'False',
					//'ShopProduto.nome !=' => '',
					//'ShopDominio.main' => 1,
					//'ShopDominio.ativo' => 1,
					//$this->produto_usado,
					//$this->produto_destaque
				),

				'group' => array('ShopCarrinhoProdutoDescricao.id_carrinho_descricao'),
				//'order' => $this->order,
				//'limit' => $this->limit,

				'joins' => array(

					array(
						'table' => 'shop_carrinho',
						'alias' => 'ShopCarrinho',
						'type' => 'INNER',
						'conditions' => array(
							'ShopCarrinho.id_carrinho = ShopCarrinhoProdutoDescricao.id_carrinho_default'
						)
					),

					array(
						'table' => 'shop_produto',
						'alias' => 'ShopProduto',
						'type' => 'INNER',
						'conditions' => array(
							'ShopProduto.id_produto = ShopCarrinhoProdutoDescricao.id_produto_default',
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
						'table' => 'shop_cupom_desconto',
						'alias' => 'ShopCupomDesconto',
						'type' => 'LEFT',
						'conditions' => array(
							'ShopCupomDesconto.id_cupom = ShopCarrinho.id_cupom_default'
						)
					),

				),

			);

			//pr( $this->ShopCarrinhoProdutoDescricao->find('all', $conditions) );
			//die;
			return $this->ShopCarrinhoProdutoDescricao->find('all', $conditions);

		} catch (PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

	/**
	 * Limpa o carrinho de compras
	 * @param  boolean $hideFlash desativa redirecionamento e mensagem
	 * @return string
	 */
	private function limpaCarrinho($hideFlash = false)
	{
		try {

			$conditions = array(
				'ShopCarrinho.id_carrinho' => $this->Session->read('id_carrinho')
			);

			$this->ShopCarrinho->deleteAll($conditions);
			$this->Session->delete('id_carrinho');

			$this->Session->delete('minicart_preco_total');
			$this->Session->delete('minicart_qtde_total');

			$this->cookieViaLoja()->deleteCookie('__vialoja_cart');
			$this->cookieViaLoja()->deleteCookie('__vialoja_cart_shop');
			$this->cookieViaLoja()->deleteCookie('__vialoja_minicart');

			if ($hideFlash === false) {

				if ($this->ShopCarrinho->getAffectedRows()) {
					$this->Session->setFlash(__('Dados excluídos com sucesso.'), 'alert-box', array('class' => 'success-msg'));
				} else {
					$this->Session->setFlash(__('Não foi possivel excluir os dados do carrinho.'), 'alert-box', array('class' => 'error-msg'));
				}

				return $this->redirect($this->referer());

			} else {

				return $this->redirect(array('controller' => $this->request->controller, 'action' => $this->request->action));

			}

		} catch (PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

	/**
	 * Checa a key do produto
	 * @param  string $id_produto ID do produto
	 * @return int
	 */
	private function checaProdutoKey($id_produto = '')
	{

		if (isset($this->request->params['pass']['4'])) {

			if (!Validate::isMd5($this->request->params['pass']['4'])) {
				return $this->redirect($this->referer());
			}

			$conditions = array(
				'conditions' => array(
					'ShopProduto.id_shop_default' => $this->Session->read('id_shop_default'),
					'ShopProduto.id_produto' => $id_produto,
					'ShopProduto.produto_key' => $this->request->params['pass']['4']
				)
			);

			if ($this->ShopProduto->find('count', $conditions) <= 0) {
				return $this->redirect($this->referer());
			}

		}

	}

	/**
	 * Recuperação de ID de carrinho
	 * @return int id do carrinho
	 */
	private function recuperaIdCarrinho()
	{

		if ($this->request->is('get')) {

			/**
			 * Caso perca a sessão restaura o ID
			 */
			if (!$this->Session->read('id_carrinho')) {

				if (isset($_COOKIE['__vialoja_cart']) && !empty($_COOKIE['__vialoja_cart'])) {

					$conditions = array(
						'conditions' => array(
							'ShopCarrinho.cookie_session_id' => $_COOKIE['__vialoja_cart']
						)
					);

					if ($this->ShopCarrinho->find('count', $conditions) > 0) {

						$dados = $this->ShopCarrinho->find('first', $conditions);
						$this->Session->write('id_carrinho', $dados['ShopCarrinho']['id_carrinho']);

					}

				}

			}

		}

	}

	/**
	 * Update no carrinho de compras
	 * @return string
	 */
	private function updateProdutoCarrinho()
	{
		try {

			$csrfGuard = new CSRFGuard();

			if ($csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

				$arr_cart = Tools::getValue('cart');

				foreach ($arr_cart as $key => $cart) {

					foreach ($cart as $qtde) {

						if (is_numeric($qtde)) {

							if ($qtde <= 0) {

								$conditions = array(
									'ShopCarrinhoProdutoDescricao.id_carrinho_descricao' => intval($key),
								);

								$this->ShopCarrinhoProdutoDescricao->deleteAll($conditions);

							} else {

								$fields = array(
									'ShopCarrinhoProdutoDescricao.qtde' => sprintf("'%s'", $qtde),
								);

								$conditions = array(
									'ShopCarrinhoProdutoDescricao.id_carrinho_descricao' => intval($key)
								);

								$ok = $this->ShopCarrinhoProdutoDescricao->updateAll($fields, $conditions);

							}

						}

					}

				}

				if (isset($ok) && is_bool($ok) && $ok === true) {
					$this->Session->setFlash(__('Dados dos carrinho alterados com sucesso.'), 'alert-box', array('class' => 'success-msg'));
				} else {
					$this->Session->setFlash(__('Não foi possivel alterar os dados do carrinho, por favor tente novamente.'), 'alert-box', array('class' => 'error-msg'));
				}

				return $this->redirect($this->referer());

			}

		} catch (PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}
	}

	/**
	 * Cadastra novo intem no carrinho de compras     *
	 * @return string
	 */
	private function cadastraItemCarrrinho($id_produto = '')
	{

		$datasource = $this->ShopCarrinho->getDataSource();

		try {

			$csrfGuard = new CSRFGuard();

			if ($csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

				if (isset($_COOKIE['__vialoja_cart']) && !empty($_COOKIE['__vialoja_cart'])) {
					$this->cookie_session_id = trim($_COOKIE['__vialoja_cart']);
				} else {
					$this->cookie_session_id = trim($this->Session->id());
					$this->cookieViaLoja()->setcookie('__vialoja_cart', $this->cookie_session_id, 60 * 60 * 24 * 7, env('HTTP_HOST'));
				}

				if (!Validate::isInt($this->request->params['pass']['2'])) {
					return $this->redirect($this->referer());
				}

				/**
				 * Add dados principais do carrinho
				 */
				self::carrinhoAdicionar();

				/**
				 * Cadastra o Produto do carrinho
				 * @var array
				 */
				$qtde = Tools::getValue('qty');

				$dados = self::getProdutoId($id_produto);
				$preco_cheio = $dados['ShopProduto']['preco_cheio'];
				$preco_promocional = $dados['ShopProduto']['preco_promocional'];

				$oferta = Validate::isValueBigger($preco_cheio, $preco_promocional);

				if (Validate::isValueBigger($preco_cheio, $preco_promocional) === true) {
					$preco = $preco_promocional;
				} else {
					$preco = $preco_cheio;
				}

				self::adicionarCarrinhoProdutoDescricao($id_produto, $preco, $qtde);

			}

			$datasource->commit();

		} catch (PDOException $e) {

			$datasource->rollback();

			$this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class' => 'error-msg'));

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (Exception $e) {

		}

	}

	/**
	 * Add carrinho
	 * @param string $value [description]
	 */
	private function carrinhoAdicionar()
	{

		/**
         * Verifica se existe um carrinho aberto
         * @var array
         */
        $conditions = array(
            'conditions' => array(
                'ShopCarrinho.cookie_session_id' => $this->cookie_session_id
            )
        );

        if ($this->ShopCarrinho->find('count', $conditions ) <=0 ) {

        	/**
        	 * Cadastra o carrinho
        	 * @var array
        	 */
			$data = array(
		        'id_shop_default' => $this->Session->read('id_shop_default'),
		        'cep' => $this->Session->read('cep_calcular_produto_ajax'),
		        'id_cliente_default' => $this->Session->read('id_cliente'),
		        'cookie_session_id' => $this->cookie_session_id,
		        'ip' => $this->request->clientIp(),
		    );

		    $this->ShopCarrinho->saveAll($data);

		    $last_insert_ID = $this->ShopCarrinho->getLastInsertID();

		    $this->cookieViaLoja()->setcookie('__vialoja_cart_shop', $last_insert_ID.'|'.ID_SHOP_DEFAULT, 60*60*24*7, env('HTTP_HOST'));

		    $this->Session->write('id_carrinho', $this->ShopCarrinho->getLastInsertID() );

		}

	}

	/**
	 * Recupera dados de Produto
	 * @param  string $id_produto ID do produto
	 * @return int
	 */
	private function getProdutoId($id_produto = '')
	{

		$conditions = array(
			'fields' => array(
				'ShopProduto.nome',
				'ShopProduto.preco_cheio',
				'ShopProduto.preco_promocional',
				'ShopProduto.quantidade',
			),
			'conditions' => array(
				'ShopProduto.id_shop_default' => $this->Session->read('id_shop_default'),
				'ShopProduto.id_produto' => $id_produto,
				'ShopProduto.produto_key' => $this->request->params['pass']['4']
			)
		);

		return $this->ShopProduto->find('first', $conditions);

	}

	/**
	 * Cadastra os dados do Produto no carrinho
	 * @param string $value [description]
	 */
	private function adicionarCarrinhoProdutoDescricao($id_produto='', $preco='', $qtde='')
	{

		if (!Validate::isPriceMinimum($preco)) {
			return false;
		}

		if (is_numeric($id_produto) && is_numeric($qtde) && $qtde > 0 ) {


			/**
	         * Verifica se existe o produto já existe no carrinho
	         * @var array
	         */
	        $conditions = array(
	        	'fields' => array(
	        		'ShopCarrinhoProdutoDescricao.qtde'
	        	),
	            'conditions' => array(
	                'ShopCarrinhoProdutoDescricao.id_carrinho_default' => $this->Session->read('id_carrinho'),
			        'ShopCarrinhoProdutoDescricao.id_produto_default' => $id_produto,
	            )
	        );

	        if ($this->ShopCarrinhoProdutoDescricao->find('count', $conditions) <= 0) {

				/**
				 * Cadastra o Produto do carrinho
				 * @var array
				 */
				$data = array(
			        'id_carrinho_default' => $this->Session->read('id_carrinho'),
			        'id_produto_default' => $id_produto,
			        'preco' => $preco,
			        'qtde' => $qtde,
			        'key' => Tools::uniqid()
			    );

			    $this->ShopCarrinhoProdutoDescricao->saveAll($data);

			    if ($this->ShopCarrinhoProdutoDescricao->getLastInsertID() > 0) {
			    	if ($this->Session->read('cep_calcular_produto_ajax')) {

				    	$this->Session->setFlash(__( sprintf('Produto inserido com cálculo de frete para a região "CEP %s".', $this->Session->read('cep_calcular_produto_ajax') ) ), 'alert-box', array('class'=>'notice-msg'));
				    	$this->Session->delete('cep_calcular_produto_ajax');

				    	$this->redirect(array('controller' => 'checkout', 'action' => 'carrinho'));

				    }

			    }

			} else {

				$dados = $this->ShopCarrinhoProdutoDescricao->find('first', $conditions);
				$qtde = $dados['ShopCarrinhoProdutoDescricao']['qtde'] + $qtde;

				$fields = array(
                    'ShopCarrinhoProdutoDescricao.preco' => sprintf("'%s'", $preco),
                    'ShopCarrinhoProdutoDescricao.qtde' => sprintf("'%s'", $qtde),
                );

                $conditions = array(
                    'id_carrinho_default' => $this->Session->read('id_carrinho'),
			        'id_produto_default' => $id_produto,
                );

                $this->ShopCarrinhoProdutoDescricao->updateAll($fields, $conditions);

                if ($this->ShopCarrinhoProdutoDescricao->getAffectedRows()) {
                	$this->redirect(Tools::geturl());
                }

			}

		}

	}

	/**
	 * Recupera dados de cupom
	 * @return array
	 */
	public function cupomDescontoCode($carrinho_lista = array())
	{

		if (Tools::getValue('cupom_code') != '') {

			$cupom_code = Tools::clean(Tools::getValue('cupom_code'));

			$dados = $this->ShopCupomDesconto->getCupomCode(ID_SHOP_DEFAULT, $cupom_code);

			if ($dados === false) {

				$this->Session->setFlash(__('Cupom de desconto "' . $cupom_code . '" inválido ou expirado.'), 'alert-box', array('class' => 'error-msg'));
				return $this->redirect($this->referer());

			} else {

				if ($dados['ShopCupomDesconto']['validade'] !== '0000-00-00') {

					$date = new \DateTime();
					if ($date->format('Y-m-d') > $dados['ShopCupomDesconto']['validade']) {
						$this->Session->setFlash(__('O cupom informado está vencido. Verifique a indicação de validade da promoção.'), 'alert-box', array('class' => 'error-msg'));
						return $this->redirect($this->referer());
					}

				}

				if ($dados['ShopCupomDesconto']['quantidade'] <= 0) {
					$this->Session->setFlash(__('Cupom de desconto "' . $cupom_code . '" inválido ou expirado.'), 'alert-box', array('class' => 'error-msg'));
					return $this->redirect($this->referer());
				}

				if (self::verificaValorMinimo($carrinho_lista, $dados['ShopCupomDesconto']['valor_minimo']) === false) {
					$this->Session->setFlash(__('Este cupom de desconto "' . $cupom_code . '" não obedece o critério de valor mínimo da compra.'), 'alert-box', array('class' => 'error-msg'));
					return $this->redirect($this->referer());
				}

				$datasource = $this->ShopCarrinho->getDataSource();

				try {

					$fields = array(
						'ShopCarrinho.id_cupom_default' => sprintf("'%s'", $dados['ShopCupomDesconto']['id_cupom'])
					);

					$conditions = array(
						'ShopCarrinho.id_carrinho' => $this->Session->read('id_carrinho')
					);

					$this->ShopCarrinho->updateAll($fields, $conditions);

					if ($this->ShopCarrinho->getAffectedRows()) {
						$this->Session->setFlash(__('Cupom de desconto "' . $cupom_code . '" aplicado com sucesso.'), 'alert-box', array('class' => 'success-msg'));
					}

					$datasource->commit();

				} catch (PDOException $e) {

					$datasource->rollback();

					$this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class' => 'error-msg'));

					\Exception\VialojaDatabaseException::errorHandler($e);

				}

			}

		} else {

			$this->Session->setFlash(__('O Cupom de desconto não pode ser vazio.'), 'alert-box', array('class' => 'error-msg'));

		}

	}

	/**
	 * Calcular valor minimo
	 * @param  array $carrinho_lista carrinho de compras
	 * @return true OR false;
	 */
	private function verificaValorMinimo($carrinho_lista = array(), $valor = '')
	{

		$subtotal = 0;
		$subtotal_produto = 0;
		$qtde = 0;
		$total_qtde = 0;

		foreach ($carrinho_lista as $key => $car) {
			$qtde = $car['ShopCarrinhoProdutoDescricao']['qtde'];
			$preco = $car['ShopCarrinhoProdutoDescricao']['preco'];
			$subtotal_produto = $preco * $qtde;
			$subtotal += $subtotal_produto;
		}

		if ($subtotal < $valor) {
			return false;
		} else {
			return true;
		}

	}

	/**
	 * Cadastra cep no carrinho de compras
	 * @return true || false
	 */
	private function cadastraCepDestinoCarrinho()
	{

		$datasource = $this->ShopCarrinho->getDataSource();

		try {

			if (Tools::getValue('cep_code') =='') {
				throw new Exception("Por favor, informe o CEP de destino.", 1);
			}

			if (!v::postalCode('BR')->validate( Tools::getValue('cep_code') ) ) {
				throw new Exception("Por favor, informe o CEP de destino corretamente.", 1);
			}

			$carrinho_cep = Tools::clean( Tools::getValue('cep_code') );

			$fields = array(
                'ShopCarrinho.cep' => sprintf("'%s'",  $carrinho_cep)
            );

            $conditions = array(
                'ShopCarrinho.id_carrinho' => $this->Session->read('id_carrinho')
            );

            $this->ShopCarrinho->updateAll($fields, $conditions);

            if ( $this->ShopCarrinho->getAffectedRows() ) {
            	$this->Session->setFlash(__('Por favor, selecione abaixo o tipo de frete para sua região.'), 'alert-box', array('class'=>'success-msg'));
            } else {
            	$this->Session->setFlash(__('Houve um erro no processamento do pedido, tente novamente.'), 'alert-box', array('class'=>'error-msg'));
            }

		    $datasource->commit();

		} catch (PDOException $e) {

			$datasource->rollback();

			$this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'error-msg'));

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (Exception $e) {
			return $this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'error-msg'));
		}

	}

	/**
	 * Calcula frete no carrinho de compras
	 * @return array
	 */
	public function cadastraIdFormaEnvioFreteCarrinho()
	{
		$datasource = $this->ShopCarrinho->getDataSource();

		try {

			if (Tools::getValue('forma_envio_id') =='') {
				throw new Exception("Por favor, escolha a forma de entrega.", 1);
			}

			$forma_envio_id = Tools::getValue('forma_envio_id');

			$fields = array(
                'ShopCarrinho.id_envio_default' => sprintf("'%s'", intval( $forma_envio_id[0] ) )
            );

            $conditions = array(
                'ShopCarrinho.id_carrinho' => $this->Session->read('id_carrinho')
            );

            $this->ShopCarrinho->updateAll($fields, $conditions);

            if ( !$this->ShopCarrinho->getAffectedRows() ) {
            	$this->Session->setFlash(__('Houve um erro no processamento do pedido, tente novamente.'), 'alert-box', array('class'=>'error-msg'));
            }

		    $datasource->commit();

		} catch (PDOException $e) {

			$datasource->rollback();

			$this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'error-msg'));

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (Exception $e) {
			return $this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'error-msg'));
		}

	}

	/**
	 * Mini cart carrinho de compras
	 * @param  boolean $ajax true
	 * @return array json
	 */
	public function minicart()
	{

		if ($this->request->is('ajax')) {
			$this->layout = false;
		}

		$carrinho_lista = self::getCarrinhoLista();

		$subtotal = 0;
		$subtotal_produto = 0;
		$qtde = 0;
		$total_qtde = 0;

		foreach ($carrinho_lista as $key => $car) {

			$qtde = $car['ShopCarrinhoProdutoDescricao']['qtde'];
			$preco = $car['ShopCarrinhoProdutoDescricao']['preco'];
			$subtotal_produto = $preco * $qtde;
			$subtotal += $subtotal_produto;
			$total_qtde += $qtde;

			$this->Session->write('minicart_preco_total', $subtotal);
			$this->Session->write('minicart_qtde_total', $total_qtde);

			$this->cookieViaLoja()->_setcookie('__vialoja_minicart', $total_qtde . '|' . $subtotal, 60 * 60 * 24 * 7, env('HTTP_HOST'));

		}

		$this->set(compact('carrinho_lista'));
		$this->set(compact('totalqtde'));
		$this->set(compact('subtotal'));

		self::htmlMobile($carrinho_lista, $total_qtde);

	}

	public function htmlMobile($carrinho_lista=array(), $total_qtde='')
	{

		$item = 'itens';
		$existe = 'Existem';
		if ($total_qtde == 1) {
		  	$item = 'item';
		  	$existe = 'Existe';
		}

		$html = '<div class="quick-access">
		        <div class="cart-inner">
		            <div class="quickaccess-toggle hidden-lg hidden-md">
		                <i class="fa fa-shopping-cart "></i>
		            </div>
		            <div class="inner-toggle">
		                <div class="content">
		                    <div class=" block-cart">
		                        <div class="block-content">
		                            <p class="block-subtitle">'.$item .' adicionado recentemente</p>
		                            <ol id="cart-sidebar" class="mini-products-list">';

		                                $subtotal=0;
		                                $subtotal_produto=0;

		                                foreach ($carrinho_lista as $key => $car) {

											$qtde = $car['ShopCarrinhoProdutoDescricao']['qtde'];
											$preco = $car['ShopCarrinhoProdutoDescricao']['preco'];
											$subtotal_produto = $preco * $qtde;
											$subtotal +=  $subtotal_produto;

											$url_img = CDN .'static/img/imagem-padrao/cart/produto-sem-imagem.gif';
											$nome_imagem = $car['ShopProdutoImagem']['nome_imagem'];
											$id_produto = $car['ShopCarrinhoProdutoDescricao']['id_produto_default'];

											if (!empty($nome_imagem)) {

											  $url_root = sprintf( '%s%d%sproduto%s%d%scart%s%s',
											      CDN_ROOT_UPLOAD,
											      $this->Session->read('id_shop_default'),
											      DS,
											      DS,
											      $id_produto,
											      DS,
											      DS,
											      $nome_imagem
											  );

											  if (is_file($url_root)) {

											      $url_img = sprintf( '%s%d/produto/%d/cart/%s',
											          CDN_UPLOAD,
											          $this->Session->read('id_shop_default'),
											          $id_produto,
											          $nome_imagem
											      );

											  }

											}


		                                $html .= '<li class="item">
		                                    <a href="'. FULL_BASE_URL .'/p/'. Tools::slug( $car['ShopProduto']['nome'] ) .'/'. $id_produto .'/" title="'. $car['ShopProduto']['nome'] .'" class="product-image"><img src="'. $url_img .'" width="75" height="75" alt="'. $car['ShopProduto']['nome'] .'" /></a>
		                                    <div class="product-details">';

		                                      /*
		                                        <a href="/checkout/carrinho/remover/id/'. $car['ShopCarrinhoProdutoDescricao']['id_carrinho_descricao'] . '/'. $car['ShopCarrinhoProdutoDescricao']['key'] . '/index.html" title="Remover este item" onclick="return confirm(\'Tem certeza de que deseja remover este item do carrinho de compras?\');" class="btn-remove">Remover este item</a>
		                                        <a href="/checkout/carrinho/configure/id/590/" title="Edit item" class="btn-edit">Edit item</a>

		                                        */


		                                        $html .= '<p class="product-name"><a href="'. FULL_BASE_URL .'/p/'. Tools::slug( $car['ShopProduto']['nome'] ) .'/'. $id_produto .'/">'. $car['ShopProduto']['nome'] .'</a></p>
		                                        <strong>'. $qtde .'</strong> x
		                                        <span class="price">R$ '. Tools::convertToDecimalBR( $car['ShopCarrinhoProdutoDescricao']['preco']) .'</span>
		                                        <div class="truncated">
		                                            <div class="truncated_full_value">
		                                                <dl class="item-options">
		                                                    <dt>Size</dt>
		                                                    <dd>
		                                                        M
		                                                    </dd>
		                                                </dl>
		                                            </div>
		                                            <a href="#" onclick="return false;" class="details">Detalhes</a>
		                                        </div>
		                                    </div>
		                                </li>';

		                              }

		                            $html .= '</ol>
		                            <script type="text/javascript">decorateList(\'cart-sidebar\', \'none-recursive\')</script>
		                            <div class="summary">
		                                <p class="amount">'.$existe.' '. $total_qtde .' '.$item .' no seu carrinho.</p>
		                                <p class="subtotal">
		                                    <span class="label">Carrinho Subtotal:</span> <span class="price">R$ '. Tools::convertToDecimalBR($subtotal) .'</span>
		                                </p>
		                            </div>
		                            <div class="actions">
		                                <button type="button" title="Finalizar Pedido" class="button" onclick="setLocation(\'/checkout/onepage/\')"><span><span>Finalizar</span></span></button>
		                                <a class="view-cart" href="/checkout/carrinho/" title="Visualizar carrinho">Carrinho</a>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>';

		$this->Session->write('html_mobile', $html);
	}

	/**
	 * Calcula frete no carrinho de compras
	 * @return array
	 */
	private function freteCarrinhoCalcular($carrinho_lista = '', $envio_formas = '')
	{

		$this->set(compact('arr_return_frete'));

		try {

			if (!v::postalCode('BR')->validate($this->cep_destino)) {
				throw new Exception('Por favor, informe o CEP de destino corretamente.', 1);
			}

			$preco_produto = 0;
			$res_frete = $this->ShopFreteGratis->verificaFreteGratis(ID_SHOP_DEFAULT, $this->cep_destino, $preco_produto);

			if ($res_frete === true) {
				$this->set('frete_gratis', true);
			} else {

				$arr_return_frete = array();

				self::calculaCubagemProduto($carrinho_lista);

				$simuladorFrete = new \Correios\Simulador\Frete();
				$arr_return_frete['envio_correios'] = $simuladorFrete->calcular($this->cep_destino, $this->total_peso, $this->altura, $this->largura, $this->comprimento, $envio_formas);

				/**
				 * Retorna valor do frete via motoboy
				 * @return array
				 */
				$envio_motoboy = $this->ShopEnvioMotoboy->getValorFrete(ID_SHOP_DEFAULT, $this->cep_destino, $this->total_peso);
				$arr_return_frete['envio_motoboy'] = $envio_motoboy;

				/**
				 * Retorna RetirarPessoalmente
				 * @return array
				 */
				$envio_pessoalmente = $this->ShopEnvioPessoalmente->getRetirarPessoalmente(ID_SHOP_DEFAULT, $this->cep_destino);
				$arr_return_frete['envio_pessoalmente'] = $envio_pessoalmente;

				/**
				 * Retorna valor do frete via transportadora
				 * @return array
				 */
				$envio_transportadora = $this->ShopEnvioTransportadora->readValorFreteTransportadora(ID_SHOP_DEFAULT, $this->cep_destino, $this->total_peso);
				$arr_return_frete['envio_transportadora'] = $envio_transportadora;

				/**
				 * Retorna valor do frete personalisado
				 * @return array
				 */
				$envio_personalizado = $this->ShopEnvioPersonalizado->getValorFrete(ID_SHOP_DEFAULT, $this->cep_destino, $this->total_peso);
				$arr_return_frete['envio_personalizado'] = $envio_personalizado;

				return $arr_return_frete;

			}

		} catch (Exception $e) {

			return $this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class' => 'error-msg'));

		}

	}

	/**
	 * Calcular cubagem de produto(s) no carrinho
	 * @param  array $carrinho_lista carrinho de compras
	 * @return [type]                [description]
	 */
	private function calculaCubagemProduto($produto_lista = array())
	{

		$qtde = 0;
		$peso = 0;
		$total_peso = 0;

		$total_cubagem = 0;
		$raiz_cubica = 0;

		foreach ($produto_lista as $key => $carrinho) {

			$peso = $carrinho['ShopProduto']['peso'];

			$qtde = $carrinho['ShopCarrinhoProdutoDescricao']['qtde'];
			$altura = $carrinho['ShopProduto']['altura'];
			$largura = $carrinho['ShopProduto']['largura'];
			$comprimento = $carrinho['ShopProduto']['comprimento'];

			echo 'QTDE ' . $qtde . '<br >';
			echo 'PESO ' . $peso . '<br >';
			$total_cubagem += ($altura * $largura * $comprimento * $qtde);
			echo 'TOTAL CUBAGEM ' . $total_cubagem . '<br /><br />';


			/*
            echo '<br />Qtde: '. $qtde;
            echo '<br />Produto Peso: '. $peso;
            echo '<br />Produto Altura: '. $altura;
            echo '<br />Produto largura: '. $largura;
            echo '<br />Produto Comprimento: '. $comprimento;
            echo '<br />--------------------------------------------------------';
            echo "<br /><br />Centimetro cubico por produto: " . $total_cubagem;
            echo "<br />Centimetro cubico total: " . $total_cubagem * $qtde;
            echo "<br /><br />Raiz cubica por produto: " . $raiz_cubica_produto . '<br />';
            echo "<strong>Raiz cubica total: <strong>" . $raiz_cubica . '<br />';

            */

			if ($qtde > 1) {
				$peso = $peso * $qtde;
			}

			$total_peso += $peso;

		}

		$raiz_cubica += round(pow($total_cubagem, (1 / 3)));
		$this->total_peso = round($total_peso); // em kilos

		if ($raiz_cubica < 16) {
			$this->comprimento = 16; // em centimetros
		} else {
			$this->comprimento = $raiz_cubica;
		}

		if ($raiz_cubica < 11) {
			$this->largura = 11; // em centimetros
		} else {
			$this->largura = $raiz_cubica;
		}

		$this->altura = round($total_cubagem / ($this->comprimento * $this->largura)); // em centimetros

		echo "Total qte $qtde <br />";
		echo "Total cubagem $total_cubagem <br />";
		echo "Total peso $this->total_peso <br />";
		echo "Total comprimento $this->comprimento <br />";
		echo "Total largura $this->largura <br />";
		echo "Total altura $this->altura <br />";


	}

	/**
     * Configurações de Segurança
     */
    private function configCSRFGuard()
    {

        $GLOBALS['CSRFGuardName'] = null;
		$GLOBALS['CSRFGuardToken'] = null;
		$CSRFGuardName = null;
		$CSRFGuardToken = null;

        /**
         *
         * verifica se é bot
         *
         **/
        if (!Validate::isBot()) {

            $CSRFGuard = new CSRFGuard();

            $CSRFGuardName = "CSRFGuard_".mt_rand(0,mt_getrandmax());
            $CSRFGuardToken = $CSRFGuard->csrfguard_generate_token($CSRFGuardName);

            $this->set(compact('CSRFGuardName'));
            $this->set(compact('CSRFGuardToken'));

        } else {

        	$this->set(compact('CSRFGuardName'));
            $this->set(compact('CSRFGuardToken'));

        }

    }

}
