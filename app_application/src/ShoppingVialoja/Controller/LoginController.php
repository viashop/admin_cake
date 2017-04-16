<?php

App::uses('AppController', 'Controller');

class LoginController extends AppController {

	public $layout = false;

	public function index() {

		return $this->redirect( sprintf('//conta%s/public/login', env('HTTP_BASE') ) );

	}

}
