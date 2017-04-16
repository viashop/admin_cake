<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class FormasPagamentoController extends AppController {

	public $uses = array('ShopPagamento');

	private $conditions;
	private $arrayIds = array();
	private $intermediadores;

	public function getFormas() {

		try {

			/**
	         *
	         * Forma de pagamento
	         *
	         **/
	        $this->conditions = array(

	        	'fildes' => array(
	        		'ShopPagamento.id_config_pagamento'
	        	),

	            'conditions' => array(
	                'ShopPagamento.id_shop_default' => ID_SHOP_DEFAULT,
	                'ShopPagamento.ativo' => 1
	            )
	        );

	        $this->pagamentos = $this->ShopPagamento->find('all', $this->conditions);

	        foreach ($this->pagamentos as $this->pagamento) {
	            array_push($this->arrayIds, $this->pagamento['ShopPagamento']['id_config_pagamento']);
	        }

	        if (Validate::isNotNull($this->arrayIds)) {

	            $this->intermediadores = $this->requestAction(array(
	                'controller' => 'ConfiguracaoPagamento',
	                'action' => 'getPagamentoIN',
	                'arrayIds' => $this->arrayIds
	            ));

	            $GLOBALS['ConfiguracaoPagamento'] = $this->intermediadores;

	        } else {

	            $GLOBALS['ConfiguracaoPagamento'] = null;

	        }

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

}