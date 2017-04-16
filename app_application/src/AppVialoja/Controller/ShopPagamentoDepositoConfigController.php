<?php

use Lib\Tools;
use Lib\Blowfish;
use Respect\Validation\Validator as v;


class ShopPagamentoDepositoConfigController extends AppController {

	public $uses = array('ShopPagamentoDepositoConfig');

	private $numero_banco_default;
	private $ativo;
	private $agencia;
	private $numero_conta;
	private $operacao;
	private $poupanca;
	private $cpf_cnpj;
	private $favorecido;
	private $ok;
	private $cipher;
	private $datasource;

	public function getIdConfig()
	{
		try {

			if (empty($this->params['named']['config'])) {
				throw new \LogicException("Valor obrigatório: Informe o config do Banco.", E_USER_WARNING);
			}

			$config = $this->params['named']['config'];

			$conditions = array(

				'fields' => array(

					'ShopPagamentoDepositoConfig.id',
		            'ShopPagamentoDepositoConfig.id_pagamento_deposito_default',
		            'ShopPagamentoDepositoConfig.numero_banco_default',
		            'ShopPagamentoDepositoConfig.ativo',
		            'ShopPagamentoDepositoConfig.agencia',
		            'ShopPagamentoDepositoConfig.numero_conta',
		            'ShopPagamentoDepositoConfig.operacao',
		            'ShopPagamentoDepositoConfig.poupanca',
		            'ShopPagamentoDepositoConfig.cpf_cnpj',
		            'ShopPagamentoDepositoConfig.favorecido',

				),

                'conditions' => array(
                    'ShopPagamentoDepositoConfig.id_shop_default'=> $this->Session->read('id_shop'),
	                'ShopPagamentoDepositoConfig.numero_banco_default' => $config['Bancos']['numero']
                )
            );

            return $this->ShopPagamentoDepositoConfig->find('first', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			exit('Error: ' . $e->getMessage());

		}

	}

	public function dadosUpAdd()
	{

		$this->cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);

		$this->datasource = $this->ShopPagamentoDepositoConfig->getDataSource();

		try {

			$this->datasource->begin();

			if (empty($this->params['named']['numero_banco_default'])) {
				throw new \LogicException("Valor obrigatório: Informe o numero_banco_default.", E_USER_WARNING);
			}

			$this->numero_banco_default = $this->params['named']['numero_banco_default'];

			$this->ativo = Tools::clean(Tools::getValue('ativo'));
			$this->agencia = Tools::clean(Tools::getValue('agencia'));
			$this->numero_conta = Tools::clean(Tools::getValue('numero_conta'));
			$this->operacao = Tools::clean(Tools::getValue('operacao'));
			$this->poupanca = Tools::clean(Tools::getValue('poupanca'));
			$this->cpf_cnpj = intval(Tools::clean(Tools::getValue('cpf_cnpj')));
			$this->favorecido = Tools::clean(Tools::getValue('favorecido'));


			if (isset($this->agencia) && !empty($this->agencia)) {
				$this->agencia = $this->cipher->encrypt($this->agencia);
			} else {
				$this->agencia = null;
			}

			if (isset($this->numero_conta) && !empty($this->numero_conta)) {
				$this->numero_conta = $this->cipher->encrypt($this->numero_conta);
			} else {
				$this->numero_conta = null;
			}

			if ( isset($this->favorecido) && !empty($this->favorecido)) {
				$this->favorecido = $this->cipher->encrypt($this->favorecido);
			} else {
				$this->favorecido = null;
			}

			if (Tools::strlen($this->cpf_cnpj) == 11) {
				if (!v::cpf()->validate($this->cpf_cnpj)) {
					$this->cpf_cnpj = null;
				} else {
					$this->cpf_cnpj = Tools::mask($this->cpf_cnpj, '###.###.###-##');
					$this->cpf_cnpj = $this->cipher->encrypt($this->cpf_cnpj);
				}

			} elseif (Tools::strlen($this->cpf_cnpj) == 14) {
				if (!v::cnpj()->validate($this->cpf_cnpj)) {
					$this->cpf_cnpj = null;
				} else {
					$this->cpf_cnpj = Tools::mask($this->cpf_cnpj, '##.###.###/####-##');
					$this->cpf_cnpj = $this->cipher->encrypt($this->cpf_cnpj);
				}
			}

			$dados = $this->requestAction(array(
	            'controller' => 'ShopPagamentoDeposito',
	            'action' => 'getIdPagamentoDeposito'
	        ));

			/*
	       	$this->ShopPagamentoDepositoConfig->deleteAll(array(
                'ShopPagamentoDepositoConfig.id_shop_default'               => $this->Session->read('id_shop'),
                'ShopPagamentoDepositoConfig.id_pagamento_deposito_default' => $dados['ShopPagamentoDeposito']['id'],
                'ShopPagamentoDepositoConfig.numero_banco_default'          => $this->numero_banco_default
            ));
            */

	       	$conditions = array(
                'conditions' => array(
                    'ShopPagamentoDepositoConfig.id_shop_default'               => $this->Session->read('id_shop'),
	                'ShopPagamentoDepositoConfig.id_pagamento_deposito_default' => $dados['ShopPagamentoDeposito']['id'],
	                'ShopPagamentoDepositoConfig.numero_banco_default'          => $this->numero_banco_default
                )
            );

            if ($this->ShopPagamentoDepositoConfig->find('count', $conditions) > 0 ) {

            	if (isset($this->cpf_cnpj)) {

            		$fields = array(

						'ShopPagamentoDepositoConfig.ativo'        => sprintf("'%s'", $this->ativo),
						'ShopPagamentoDepositoConfig.agencia'      => sprintf("'%s'", $this->agencia),
						'ShopPagamentoDepositoConfig.numero_conta' => sprintf("'%s'", $this->numero_conta),
						'ShopPagamentoDepositoConfig.operacao'     => sprintf("'%s'", $this->operacao),
						'ShopPagamentoDepositoConfig.poupanca'     => sprintf("'%s'", $this->poupanca),
						'ShopPagamentoDepositoConfig.cpf_cnpj'     => sprintf("'%s'", $this->cpf_cnpj),
						'ShopPagamentoDepositoConfig.favorecido'   => sprintf("'%s'", $this->favorecido)

		            );

            	} else {

			       	$fields = array(

						'ShopPagamentoDepositoConfig.ativo'        => sprintf("'%s'", $this->ativo),
						'ShopPagamentoDepositoConfig.agencia'      => sprintf("'%s'", $this->agencia),
						'ShopPagamentoDepositoConfig.numero_conta' => sprintf("'%s'", $this->numero_conta),
						'ShopPagamentoDepositoConfig.operacao'     => sprintf("'%s'", $this->operacao),
						'ShopPagamentoDepositoConfig.poupanca'     => sprintf("'%s'", $this->poupanca),
						'ShopPagamentoDepositoConfig.favorecido'   => sprintf("'%s'", $this->favorecido)

		            );

				}

	            $conditions = array(
	                'ShopPagamentoDepositoConfig.id_shop_default'               => $this->Session->read('id_shop'),
	                'ShopPagamentoDepositoConfig.id_pagamento_deposito_default' => $dados['ShopPagamentoDeposito']['id'],
	                'ShopPagamentoDepositoConfig.numero_banco_default'          => $this->numero_banco_default
	            );

	            $this->ok = $this->ShopPagamentoDepositoConfig->updateAll($fields, $conditions);

	        } else {

				$data = array(
	                'id_shop_default'               => $this->Session->read('id_shop'),
	                'id_pagamento_deposito_default' => $dados['ShopPagamentoDeposito']['id'],
	                'numero_banco_default'          => $this->numero_banco_default,
					'ativo'                         => $this->ativo,
					'agencia'                       => $this->agencia,
					'numero_conta'                  => $this->numero_conta,
					'operacao'                      => $this->operacao,
					'poupanca'                      => $this->poupanca,
					'cpf_cnpj'                      => $this->cpf_cnpj,
					'favorecido'                    => $this->favorecido
	            );

	            $this->ok = $this->ShopPagamentoDepositoConfig->saveAll($data);

	        }

			$this->datasource->commit();

            if (is_bool($this->ok) && $this->ok === true) {
            	return true;
            } else {
               return false;
            }

		} catch (\PDOException $e) {

			$this->datasource->rollback();
			\Exception\VialojaDatabaseException::errorHandler($e);
			return false;

		} catch (\LogicException $e) {

			exit('Error: ' . $e->getMessage());

		}

	}

	/**
	 * Remoção de banco
	 * @return string
	 */
	public function delete() {

		$this->datasource = $this->ShopPagamentoDepositoConfig->getDataSource();

	    try {

			$this->datasource->begin();

	    	if (empty($this->params['named']['numero_banco_default'])) {
		        throw new \LogicException("Valor obrigatório: Informe o numero_banco_default.", E_USER_WARNING);
		    }

	    	$this->ok = $this->ShopPagamentoDepositoConfig->deleteAll(array(
	                'ShopPagamentoDepositoConfig.id_shop_default' => $this->Session->read('id_shop'),
	                'ShopPagamentoDepositoConfig.numero_banco_default' => $this->params['named']['numero_banco_default']
	            ));

		    if (is_bool($this->ok) && $this->ok === true) {
		    	$this->setMsgAlertSuccess('Banco removido com sucesso!');
		    } else {
		    	throw new \RuntimeException();
		    }

			$this->datasource->commit();

	    } catch (\PDOException $e) {

			$this->datasource->rollback();
	    	$this->setMsgAlertError(ERROR_PROCESS);
			\Exception\VialojaDatabaseException::errorHandler($e);

	    } catch (\RuntimeException $e) {

	    	$this->setMsgAlertError(ERROR_PROCESS);

	    } catch (\LogicException $e) {

			exit('Error: ' . $e->getMessage());

		}

	}

	public function downStatus()
	{

		$this->datasource = $this->ShopPagamentoDepositoConfig->getDataSource();

		try {

			$this->datasource->begin();

            $this->ok = $this->ShopPagamentoDepositoConfig->updateAll(
			    array('ShopPagamentoDepositoConfig.ativo' => "'False'"),
			    array('ShopPagamentoDepositoConfig.id_shop_default' => $this->Session->read('id_shop'))
			);

	    	if (is_bool($this->ok) && $this->ok === true) {
            	return true;
            }

			$this->datasource->commit();

		} catch (\PDOException $e) {

			$this->datasource->rollback();

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
