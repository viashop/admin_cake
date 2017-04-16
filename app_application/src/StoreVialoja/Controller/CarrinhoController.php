<?php

App::uses('AppController', 'Controller');

class CarrinhoController extends AppController {

	public $layout = 'default-bootstrap';

	/**
	 * Visualização de produtos no carrinho
	 * @access public
	 * @param String $id_produto
	 * @param Array $conditions	*/

	public function index() {

		try {

		} catch (Exception $e) {

		}

		$this->set('title_for_layout', 'Produto xxx');

		define('CARRINHO_SHOP_LOJA', true);

	}

}