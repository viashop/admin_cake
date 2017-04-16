<?php

App::uses('AppController', 'Controller');

class ConfiguracaoPagamentoController extends AppController {

	public $uses = array('ConfiguracaoPagamento');

	private $conditions;

	/**
	 * Retorna todos os dados
	 * @access public
	 * @return data
	*/
	public function getPagamentoAll()
	{
		try {
			return $this->ConfiguracaoPagamento->find('all');
		} catch (Exception $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
        }

	}

	/**
	 * Retorna todos em wizard
	 * @access public
	 * @return data
	*/
	public function getPagamentoWizard()
	{
		try {

			/**
             *
             * array filtro
             *
             **/
            $this->conditions = array(
				'conditions' => array('ConfiguracaoPagamento.ativo_wizard' => 1)
            );

			return $this->ConfiguracaoPagamento->find('all', $this->conditions);

		} catch (Exception $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
        }

	}

	/**
	 * Recupera as formas as formas de pagamento do shop
	 * @access public
	 * @param String $arrayIds IDs de envio
	 * @return data
	*/
	public function getPagamentoIN()
	{
		try {

			/**
             *
             * array filtro
             *
             **/

			if (is_array($this->params['named']['arrayIds'])) {

	            $this->conditions = array(

					'conditions' => array(
							'ConfiguracaoPagamento.id_config_pagamento' => array_map('intval', $this->params['named']['arrayIds'] )
						)

	            );

				return $this->ConfiguracaoPagamento->find('all', $this->conditions);

			}

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

}
