<?php

App::uses('AppController', 'Controller');

class CookiesController extends AppController {

	public function index() {

		$this->layout = 'interface_vialoja';

		$host = str_replace('www.', '', env('HTTP_HOST') );

		$this->set('host', $host);

	}

}