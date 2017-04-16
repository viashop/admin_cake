<?php

App::uses('AppController', 'Controller');

class ConfirmarEmailController extends AppController {

	public function index() {

		$this->set('user_email', $this->cookieViaLoja()->getCookie('userEmail'));

		$this->layout = 'interface_vialoja';

	}

}