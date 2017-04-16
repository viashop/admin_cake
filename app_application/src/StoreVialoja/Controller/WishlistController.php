<?php

App::uses('AppController', 'Controller');

class WishlistController extends AppController {

	public $layout = 'default-store';

	public function index() {

		define('WHISLIST_INDEX_SHOP_LOJA', true);
		define('MY_ACCOUNT', true);

	}

}
