<?php

App::uses('AppController', 'Controller');

class ConfiguracoesController extends AppController {

	public function init()
	{

		try {


			/* Chama os dados e configurações de dominio da loja*/
			$this->requestAction(
				array(
					'controller' => 'ShopDominio',
					'action' => 'getDadosDominioMain'
				)
			);

			if (!defined('ID_SHOP_DEFAULT')) {
				throw new Exception("ERROR_CONN", 1);
			}


			/* Chama as configurações da Header*/

			/*
			$this->requestAction(
				array(
					'controller' => 'ConfigHeader',
					'action' => 'actions',
				)
			);
			*/

			$this->requestAction(
				array(
					'controller' => 'PaginasConteudo',
					'action' => 'getLinksPaginasHeader',
				)
			);


			$this->requestAction(
				array(
					'controller' => 'ConfigBanners',
					'action' => 'actions',
				)
			);


			$this->requestAction(
				array(
					'controller' => 'ConfigCategorias',
					'action' => 'actions',
				)
			);

			/* Chama as configurações da footer*/
			$this->requestAction(
				array(
					'controller' => 'ConfigFooter',
					'action' => 'actions',
				)
			);

		} catch (Exception $e) {

			echo $e->getMessage();

		}

	}

}
