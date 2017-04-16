<?php

use Lib\Tools;
use Respect\Validation\Validator as v;
use Lib\Blowfish;


class ShopPagamentoDepositoController extends AppController {

	public $uses = array('ShopPagamentoDeposito');
	public $cipher;
	private $ativo;
	private $id_config_pagamento;
	private $email_comprovante;
	private $desconto;
	private $desconto_valor;
	private $informacao_complementar;
	private $aplicar_no_total;
	private $slug_pagamento;
	private $bool;
	private $ok;
    private $getInsertID;
	private $datasource;

	public function dadosUpAdd()
	{

		try {

			if (empty($this->params['named']['id_config_pagamento'])) {
				throw new \LogicException("Informe o ID de Configuração de Pagamento", E_USER_WARNING);
			}

			if (empty($this->params['named']['slug_pagamento'])) {
				throw new \LogicException("Informe a Slug de Configuração de Pagamento", E_USER_WARNING);
			}

			$this->id_config_pagamento = (int) $this->params['named']['id_config_pagamento'];
			$this->slug_pagamento = $this->params['named']['slug_pagamento'];

			$this->ativo = Tools::clean(Tools::getValue('ativo'));
			$this->email_comprovante = Tools::clean(Tools::getValue('email_comprovante'));
			$this->desconto = Tools::clean(Tools::getValue('desconto'));
			$this->desconto_valor = Tools::clean(Tools::getValue('desconto_valor'));
			$this->informacao_complementar = Tools::clean(Tools::getValue('informacao_complementar'));
			$this->aplicar_no_total = Tools::clean(Tools::getValue('aplicar_no_total'));

			if ($this->ativo == 'True') {

				if (empty($this->email_comprovante)) {

		    		$this->email_comprovante = $this->Session->read('cliente_email');

		    	} else {

					if (!v::email()->validate($this->email_comprovante)) {
			    		$this->Session->write('erro_email_comprovante', true);
			    		throw new \InvalidArgumentException();
			    	}

		    	}

		    } else {

		    	/**
				 * Desativa todos os pagamentos de deposito
				 */
				$this->requestAction(array(
		            'controller' => 'ShopPagamentoDepositoConfig',
		            'action' => 'downStatus'
		        ));

		    	if (!empty($this->email_comprovante)) {

					if (!v::email()->validate($this->email_comprovante)) {
			    		$this->Session->write('erro_email_comprovante', true);
			    		throw new \InvalidArgumentException();
			    	}

		    	}

		    }

			/**
             *
             * Cadastra as formas de pagamento
             *
             **/

		    $this->return = $this->requestAction(array(
	            'controller' => 'ShopPagamento',
	            'action' => 'upAddStatusPagamento',
	            'id_config_pagamento' => $this->id_config_pagamento,
	            'ativo' => $this->ativo
	        ));

		    if ($this->return !== false) {

		    	if (is_numeric($this->return)) {
		    		$this->getInsertID = $this->return;
		    	}

		    	$this->ok = self::upAddPagamentoDeposito();

		    }

            if (is_bool($this->ok) && $this->ok === true) {
            	$this->setMsgAlertSuccess('Forma de pagamento editada com sucesso.');
            	return true;
            } else {
                throw new \RuntimeException();
            }

		} catch (\PDOException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
			\Exception\VialojaDatabaseException::errorHandler($e);
			return false;

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError(ERROR_FILE_INVALID_ARGUMENT);
			return false;

		} catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
			return false;

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

	/**
	 * Castrada ou altera o pagamento via deposito
	 * @return array
	 */
	private function upAddPagamentoDeposito()
	{

		$this->cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);

		$this->datasource = $this->ShopPagamentoDeposito->getDataSource();

		try {

			$this->datasource->begin();

			if (isset($this->email_comprovante) && !empty($this->email_comprovante)) {
				$this->email_comprovante = $this->cipher->encrypt($this->email_comprovante);
			}

			if ($this->desconto != 'on') {
				$this->desconto = null;
			}

			if ($this->aplicar_no_total != 'on') {
				$this->aplicar_no_total = null;
			}

			$conditions = array(
				'conditions' => array(
		    		'ShopPagamentoDeposito.id_shop_default' => $this->Session->read('id_shop'),
	                'ShopPagamentoDeposito.id_config_pagamento' => $this->id_config_pagamento,

		    	)
		    );

		    if ($this->ShopPagamentoDeposito->find('count', $conditions) > 0 ) {

		    	$fields = array(

					'ShopPagamentoDeposito.email_comprovante' => sprintf("'%s'" , $this->email_comprovante),
					'ShopPagamentoDeposito.desconto' => sprintf("'%s'" , $this->desconto),
					'ShopPagamentoDeposito.desconto_valor' => Tools::convertToDecimal($this->desconto_valor),
					'ShopPagamentoDeposito.informacao_complementar' => sprintf("'%s'", Tools::htmlentitiesUTF8($this->informacao_complementar)),
					'ShopPagamentoDeposito.aplicar_no_total' => sprintf("'%s'", $this->aplicar_no_total),
                );

		    	$conditions = array(
                    'ShopPagamentoDeposito.id_config_pagamento' => $this->id_config_pagamento,
                    'ShopPagamentoDeposito.id_shop_default' => $this->Session->read('id_shop')
                );

                $this->bool = $this->ShopPagamentoDeposito->updateAll($fields, $conditions);

		    } else {

			    $data = array(
	                'id_shop_default' => $this->Session->read('id_shop'),
	                'id_config_pagamento' => $this->id_config_pagamento,
	                'id_pagamento_default' => $this->getInsertID,
					'email_comprovante' => $this->email_comprovante,
					'desconto' => $this->desconto,
					'desconto_valor' => Tools::convertToDecimal($this->desconto_valor),
					'informacao_complementar' => Tools::htmlentitiesUTF8($this->informacao_complementar),
					'aplicar_no_total' => $this->aplicar_no_total
	            );

	            $this->bool = $this->ShopPagamentoDeposito->saveAll($data);

	        }

			$this->datasource->commit();

			return $this->bool;

		} catch (\PDOException $e) {

			$this->datasource->rollback();
			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	/**
	 * Retorna o ID de pagamento
	 * @return array
	 */
	public function getIdPagamentoDeposito()
	{
		try {


			if (isset($this->params['named']['editar'])) {

				$fields = array(
					'ShopPagamentoDeposito.*'
				);

			} else{
				$fields = array(
					'ShopPagamentoDeposito.id',
					'ShopPagamentoDeposito.id_config_pagamento',
					'ShopPagamentoDeposito.id_pagamento_default'
				);
			}

			$conditions = array(

				'fields' => $fields,
				'conditions' => array(
		    		'ShopPagamentoDeposito.id_shop_default' => $this->Session->read('id_shop'),

		    	)
		    );

		    return $this->ShopPagamentoDeposito->find('first', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
