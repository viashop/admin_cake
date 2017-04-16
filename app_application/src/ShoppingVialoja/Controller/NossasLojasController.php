<?php

App::uses('AppController', 'Controller');

class NossasLojasController extends AppController {

	public function index() {

		define('INCLUDE_NOSSAS_LOJAS', true);

	}

}