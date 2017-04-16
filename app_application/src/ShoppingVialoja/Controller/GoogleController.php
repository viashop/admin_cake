<?php

App::uses('AppController', 'Controller');

class GoogleController extends AppController {

	public $layout = false;

	public function siteVerification() {

		$this->render(false);
		$arquivo = APP . 'webroot'. DS . ltrim( strip_tags( $_SERVER['REQUEST_URI'] ) , '/' );
		if (file_exists($arquivo )) {
			echo Tools::file_get_contents($arquivo );
		} else {
			echo 'Arquivo não encontrado!';
		}

	}

}
