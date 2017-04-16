<?php

App::uses('AppController', 'Controller');

class MinhaContaController extends AppController {

	public $layout = 'default-bootstrap';

	public function index() {

		$this->set('title_for_layout', 'Login de acesso');

		define('MINHA_CONTA_SHOP_LOJA', true);

	}


	public function identity() {

		define('MINHA_CONTA_SHOP_LOJA', true);

	}

	public function order_history() {

		define('MINHA_CONTA_HISTORY_SHOP_LOJA', true);

	}

	public function order_slip() {

		define('MINHA_CONTA_SHOP_LOJA', true);
	}

	public function addresses() {

		define('MINHA_CONTA_SHOP_LOJA', true);

	}

	public function address() {

		define('MINHA_CONTA_SHOP_LOJA', true);

	}

	public function discount() {

		define('MINHA_CONTA_SHOP_LOJA', true);

	}

	public function mywishlist() {

		define('MINHA_CONTA_SHOP_LOJA', true);

	}

}