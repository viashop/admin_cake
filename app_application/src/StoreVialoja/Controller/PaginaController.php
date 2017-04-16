<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class PaginaController extends AppController {

	private $dados;

	public function index() {

		if (defined('VITRINE_SHOPPING_VIALOJA')) {

			$this->layout = 'default-vitrine-vialoja';

		} else {

			define('HOME_SHOP_LOJA', true);
			$this->layout = 'default-store';

			$this->requestAction(
				array(
					'controller' => 'Configuracoes',
					'action' => 'init'
				)
			);

		}

		$this->dados = $this->requestAction(
			array(
				'controller' => 'PaginasConteudo',
				'action' => 'getLinkId',
				'id' => $this->request->params['pass']['0']
			)
		);

		if (!Validate::isNotNull($this->dados)) {
			return $this->redirect('//'. env('HTTP_HOST') . '/erro/404' , 301, true);
		}

		$this->set('pag_titulo', $this->dados['ShopPagina']['titulo']);
		$this->set('pag_conteudo', Tools::htmlentitiesDecodeUTF8( $this->dados['ShopPagina']['conteudo']) );

	}

}
