<?php

App::uses('AppController', 'Controller');

class LoginController extends AppController {

	public $layout = 'default-bootstrap';

	/**
	 * Visualização de dados de produto
	 * @access public
	 * @param String $slug
	 * @param Array $conditions	*/
	public function index() {

		try {

		} catch (Exception $e) {

		}


		$this->set('title_for_layout', 'Login de acesso');

		define('LOGIN_SHOP_LOJA', true);

	}

}