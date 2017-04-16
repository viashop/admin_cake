<?php

App::uses('AppController', 'Controller');

class MapaSiteController extends AppController {

	public function index() {

		define('INCLUDE_MAPA_SITE', true);

	}

}