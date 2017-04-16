<?php

App::uses('AppController', 'Controller');

class TestController extends AppController {

	public $uses = array('Test');

	public function index() {

		$this->layout=false;
		$this->render(false);

		for ($i=0; $i <10 ; $i++) {
			$data = [
				'name' => "dsadas$i",
				'timestamp' => 'NOW()'
			];
			$this->Test->saveAll($data);
		}



	}

}