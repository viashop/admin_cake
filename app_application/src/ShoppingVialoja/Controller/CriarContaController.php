<?php

App::uses('AppController', 'Controller');

class CriarContaController extends AppController {

	public function carrinho() {

		define('INCLUDE_CHECKOUT', true);

	}

	public function endereco() {

		define('INCLUDE_CHECKOUT', true);

	}

	public function frete() {

		define('INCLUDE_CHECKOUT', true);

	}

	public function forma_pagamento() {

		define('INCLUDE_CHECKOUT', true);

	}

	public function transferencia_bancaria() {

		define('INCLUDE_CHECKOUT', true);

	}

	public function cheque() {

		define('INCLUDE_CHECKOUT', true);

	}

}