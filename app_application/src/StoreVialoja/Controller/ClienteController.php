<?php

App::uses('AppController', 'Controller');

class ClienteController extends AppController {

	public $layout = 'default-store';

	private function getConfig() {

		$this->requestAction(
			array(
				'controller' => 'Configuracoes',
				'action' => 'init'
			)
		);

	}

	public function conta() {

		define('WHISLIST_INDEX_SHOP_LOJA', true);
		define('MY_ACCOUNT', true);

		self::getConfig();

	}

	public function login() {

		define('CUSTOMER_LOGIN_SHOP_LOJA', true);
		self::getConfig();

	}

	public function esqueceu_a_senha() {

		define('CUSTOMER_FORGOTPASSWORD_SHOP_LOJA', true);
		self::getConfig();

	}

	public function criar() {

		define('CUSTOMER_CREATE_SHOP_LOJA', true);
		self::getConfig();

	}

	public function editar() {

		define('WHISLIST_INDEX_SHOP_LOJA', true);
		define('MY_ACCOUNT', true);
		self::getConfig();

	}

	public function novo() {

		define('WHISLIST_INDEX_SHOP_LOJA', true);
		define('MY_ACCOUNT', true);
		self::getConfig();

	}

	public function minha_lista_de_desejos() {

		define('WHISLIST_INDEX_SHOP_LOJA', true);
		define('MY_ACCOUNT', true);
		self::getConfig();

	}

}
