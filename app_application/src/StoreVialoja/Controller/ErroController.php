<?php

App::uses('AppController', 'Controller');

class ErroController extends AppController {

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

	}

}
