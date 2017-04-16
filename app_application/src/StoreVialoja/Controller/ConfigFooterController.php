<?php

App::uses('AppController', 'Controller');

class ConfigFooterController extends AppController {

	public $uses = array('ShopMarca');

	public function actions() {

		$GLOBALS['res_marcaAll'] = $this->ShopMarca->getAll(ID_SHOP_DEFAULT);

        $this->requestAction(
			array(
				'controller' => 'ShopRedeSocial',
				'action' => 'getDadosSocial',
			)
		);

		$this->requestAction(
			array(
				'controller' => 'PaginasConteudo',
				'action' => 'getLinksPaginasFooter',
			)
		);

		$this->requestAction(
			array(
				'controller' => 'FormasPagamento',
				'action' => 'getFormas',
			)
		);

		$this->requestAction(
			array(
				'controller' => 'ShopSelos',
				'action' => 'getDadosSelos',
			)
		);

	}

}
