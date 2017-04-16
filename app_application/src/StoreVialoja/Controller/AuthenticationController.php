<?php
class AuthenticationController extends AppController {

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

		$this->set('title_for_layout', 'Autenticação');

		define('AUTHENTICATION_SHOP_LOJA', true);

	}


	public function sign_in() {

		$this->set('title_for_layout', 'Auntenticação');

		define('SIGN_IN_SHOP_LOJA', true);

	}

	public function address() {

		$this->set('title_for_layout', 'Auntenticação');

		define('ADDRESS_SHOP_LOJA', true);

	}

}