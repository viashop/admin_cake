<?php

App::uses('AppController', 'Controller');

class LojaNaoEncontrada404Controller extends AppController {

	public function index() {

		$this->layout = 'interface_vialoja';

	}

}