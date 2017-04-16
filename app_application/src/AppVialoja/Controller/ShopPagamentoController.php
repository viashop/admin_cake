<?php



class ShopPagamentoController extends AppController {

	public $uses = array('ShopPagamento');
	private $datasource;

	/**
	 * Altera status de pagamento
	 * @return string
	 */
	public function upAddStatusPagamento()
	{

		$this->datasource = $this->ShopPagamento->getDataSource();

		try {

			$this->datasource->begin();

			if (empty($this->params['named']['id_config_pagamento'])) {
				throw new \LogicException("Informe o ID de Configuração de Pagamento", E_USER_WARNING);
			}

			/*
			if (empty($this->params['named']['ativo'])) {
				throw new \LogicException("Informe o status de Pagamento", E_USER_WARNING);
			}*/

			$id_config_pagamento = $this->params['named']['id_config_pagamento'];
			$ativo = $this->params['named']['ativo'];

			$conditions = array(
				'conditions' => array(
		    		'ShopPagamento.id_shop_default' => $this->Session->read('id_shop'),
	                'ShopPagamento.id_config_pagamento' => $id_config_pagamento

		    	)
		    );

            if ($this->ShopPagamento->find('count', $conditions)>0) {

            	$fields = array(
					'ShopPagamento.ativo' => sprintf("'%s'" , $ativo)
                );

		    	$conditions = array(
                    'ShopPagamento.id_config_pagamento' => $id_config_pagamento,
                    'ShopPagamento.id_shop_default' => $this->Session->read('id_shop')
                );

                $ok = $this->ShopPagamento->updateAll($fields, $conditions);
				$this->datasource->commit();

                if (is_bool($ok) && $ok === true) {
	            	return true;
	            } else {
	            	return false;
	            }

            } else {

            	$data = array(
	                'id_shop_default' => $this->Session->read('id_shop'),
	                'id_config_pagamento' => $id_config_pagamento,
					'ativo' => $ativo
	            );

	            $ok = $this->ShopPagamento->saveAll($data);
				$this->datasource->commit();

	            if (is_bool($ok) && $ok === true) {
	            	return $this->ShopPagamento->getInsertID();
	            } else {
	            	return false;
	            }

            }

		} catch (\PDOException $e) {

			$this->datasource->rollback();

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

	public function getStatusPagamento()
	{
		try {

			if (empty($this->params['named']['id_config_pagamento'])) {
				throw new \LogicException("Necessário o parametro ID de Pagamento", E_USER_WARNING);
			}

			if (is_numeric($this->params['named']['id_config_pagamento'])) {

				$conditions = array(

					'fields' => array(
			            'ShopPagamento.ativo'
					),

	                'conditions' => array(
	                    'ShopPagamento.id_shop_default'=> $this->Session->read('id_shop'),
		                'ShopPagamento.id_config_pagamento' => $this->params['named']['id_config_pagamento']
	                )
	            );

	            return $this->ShopPagamento->find('first', $conditions);

	        } else {

	        	return false;

	        }

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
