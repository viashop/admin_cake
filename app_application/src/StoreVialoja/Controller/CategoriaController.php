<?php

App::uses('AppController', 'Controller');

class CategoriaController extends AppController {

	public $layout = 'default-store';

	private function getConfig() {

		$this->requestAction(
			array(
				'controller' => 'Configuracoes',
				'action' => 'init'
			)
		);

	}

	public function index() {

		define('CATEGORIA_SHOP_LOJA', true);

		if (Tools::getValue('mode') == 'list') {
			$this->render('list');
		}

		$this->getConfig();

	}

}