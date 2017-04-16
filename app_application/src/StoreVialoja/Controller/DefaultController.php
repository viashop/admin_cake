<?php

App::uses('AppController', 'Controller');

class DefaultController extends AppController {

	public function index() {

		if ($this->request->is('ajax')) {
			$this->render(false);
			die();
		}

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
