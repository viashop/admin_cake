<?php

use Lib\Tools;
use Respect\Validation\Validator as v;
use Lib\Blowfish;


class ShopPagamentoFacilitadorController extends AppController {

	public $uses = array('ShopPagamentoFacilitador');

	private $id_config_pagamento;
	private $ativo = 'False';
    private $usuario;
    private $token;
    private $valor_minimo_aceitavel;
    private $valor_minimo_parcela;
    private $mostrar_parcelamento;
    private $maximo_parcelas;
    private $parcelas_sem_juros;
    private $li_msg;
    private $slug_pagamento;
    private $return;
    private $bool;
    private $ok;
    private $getInsertID;
	private $datasource;

    /**
     * Cadastra ou altera dados de Pagament0
	 * @return string
     */
	public function dadosUpAdd()
	{
		try {

			if (empty($this->params['named']['id_config_pagamento'])) {
				throw new \LogicException("Informe o ID de Configuração de Pagamento", E_USER_WARNING);
			}

			if (empty($this->params['named']['slug_pagamento'])) {
				throw new \LogicException("Informe a Slug de Configuração de Pagamento", E_USER_WARNING);
			}

			$this->id_config_pagamento = $this->params['named']['id_config_pagamento'];
			$this->slug_pagamento = $this->params['named']['slug_pagamento'];

			$this->ativo = Tools::clean(Tools::getValue('ativo'));
			$this->usuario = Tools::clean(Tools::getValue('usuario'));
			$this->token = Tools::clean(Tools::getValue('token'));
			$this->valor_minimo_aceitavel = Tools::clean(Tools::getValue('valor_minimo_aceitavel'));
			$this->valor_minimo_parcela = Tools::clean(Tools::getValue('valor_minimo_parcela'));
			$this->mostrar_parcelamento = Tools::clean(Tools::getValue('mostrar_parcelamento'));
			$this->maximo_parcelas = Tools::clean(Tools::getValue('maximo_parcelas'));
			$this->parcelas_sem_juros = Tools::clean(Tools::getValue('parcelas_sem_juros'));
			$this->li_msg = Tools::clean(Tools::getValue('li_msg'));

		    if ($this->ativo == 'True') {

		    	switch ($this->slug_pagamento) {
		    		case 'pagamento_paypal':

		    			if (empty($this->usuario)) {
				    		$this->Session->write('erro_facilitador_usuario', true);
				    		throw new \InvalidArgumentException();
						} elseif (!v::email()->validate($this->usuario)) {
				    		$this->Session->write('erro_facilitador_usuario', true);
				    		throw new \InvalidArgumentException();
				    	}

		    			break;

		    		case 'pagamento_pagseguro':
		    		case 'pagamento_pagamento_digital':

		    				if (empty($this->usuario) && empty($this->token)) {
					    		$this->Session->write('erro_facilitador_usuario', true);
					    		$this->Session->write('erro_facilitador_token', true);
					    		throw new \InvalidArgumentException();
					    	}

			    			if (empty($this->usuario)) {
					    		$this->Session->write('erro_facilitador_usuario', true);
					    		throw new \InvalidArgumentException();
							} elseif (!v::email()->validate($this->usuario)) {
					    		$this->Session->write('erro_facilitador_usuario', true);
					    		throw new \InvalidArgumentException();
					    	}

					    	if (empty($this->token)) {
					    		$this->Session->write('erro_facilitador_token', true);
					    		throw new \InvalidArgumentException();
					    	}

					    	if (isset($this->token) && !empty($this->token)) {
								if (Tools::strlen($this->token) != 32) {
					    			$this->Session->write('erro_facilitador_token', true);
					    			$this->Session->write('erro_facilitador_token_invalido', true);
					    			throw new \InvalidArgumentException();
					    		}
					    	}

		    				break;

		    		case 'pagamento_mercado_pago':

		    				if (empty($this->usuario) && empty($this->token)) {
					    		$this->Session->write('erro_facilitador_usuario', true);
					    		$this->Session->write('erro_facilitador_token', true);
					    		throw new \InvalidArgumentException();
					    	}

			    			if (empty($this->usuario)) {
					    		$this->Session->write('erro_facilitador_usuario', true);
					    		throw new \InvalidArgumentException();
							} elseif (!v::numeric()->notBlank()->validate($this->usuario)) {
					    		$this->Session->write('erro_facilitador_usuario', true);
					    		throw new \InvalidArgumentException();
					    	}

		    				if (isset($this->token) && !empty($this->token)) {
								if (Tools::strlen($this->token) != 32) {
					    			$this->Session->write('erro_facilitador_token', true);
					    			$this->Session->write('erro_facilitador_token_invalido', true);
					    			throw new \InvalidArgumentException();
					    		}
					    	}

		    				break;

		    		default:
		    			#code
		    			break;
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

		    	$this->ok = self::upAddFacilitadorPagamento();

		    }

            if (is_bool($this->ok) && $this->ok === true) {

            	$this->setMsgAlertSuccess('Forma de pagamento editada com sucesso.');
            	return true;

            } else {
                throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
            }

        } catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);
			return false;

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError(ERROR_FILE_INVALID_ARGUMENT);
			return false;

		} catch (\LogicException $e) {

			exit('Errors: '. $e->getMessage());

		}

	}


	/**
	 * Castrada ou altera o facilitador de pagamento
	 * @return array
	 */
	private function upAddFacilitadorPagamento()
	{

		$this->cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);

		$this->datasource = $this->ShopPagamentoFacilitador->getDataSource();

		try {

			$this->datasource->begin();

			if (isset($this->usuario) && !empty($this->usuario)) {
				$this->usuario = $this->cipher->encrypt($this->usuario);
			}

			if (isset($this->token) && !empty($this->token)) {
				$this->token = $this->cipher->encrypt($this->token);
			}

			$conditions = array(
				'conditions' => array(
		    		'ShopPagamentoFacilitador.id_shop_default' => $this->Session->read('id_shop'),
	                'ShopPagamentoFacilitador.id_config_pagamento' => $this->id_config_pagamento,

		    	)
		    );

		    if ($this->ShopPagamentoFacilitador->find('count', $conditions)>0) {

		    	$fields = array(

					'ShopPagamentoFacilitador.usuario' => sprintf("'%s'" , $this->usuario),
					'ShopPagamentoFacilitador.token' => sprintf("'%s'" , $this->token),
					'ShopPagamentoFacilitador.valor_minimo_aceitavel' => Tools::convertToDecimal($this->valor_minimo_aceitavel),
					'ShopPagamentoFacilitador.valor_minimo_parcela' => Tools::convertToDecimal($this->valor_minimo_parcela),
					'ShopPagamentoFacilitador.mostrar_parcelamento'  => sprintf("'%s'", $this->mostrar_parcelamento),
					'ShopPagamentoFacilitador.maximo_parcelas' => sprintf("'%s'", $this->maximo_parcelas),
					'ShopPagamentoFacilitador.parcelas_sem_juros' => sprintf("'%s'", $this->parcelas_sem_juros),
					'ShopPagamentoFacilitador.li_msg' => sprintf("'%s'", $this->li_msg)
                );

		    	$conditions = array(
                    'ShopPagamentoFacilitador.id_config_pagamento' => $this->id_config_pagamento,
                    'ShopPagamentoFacilitador.id_shop_default' => $this->Session->read('id_shop')
                );

                $this->bool = $this->ShopPagamentoFacilitador->updateAll($fields, $conditions);

		    } else {

			    $data = array(
	                'id_shop_default' => $this->Session->read('id_shop'),
	                'id_config_pagamento' => $this->id_config_pagamento,
	                'id_pagamento_default' => $this->getInsertID,
					'usuario' => $this->usuario,
					'token' => $this->token,
					'valor_minimo_aceitavel' => $this->valor_minimo_aceitavel,
					'valor_minimo_parcela' => $this->valor_minimo_parcela,
					'mostrar_parcelamento'  => $this->mostrar_parcelamento,
					'maximo_parcelas' => $this->maximo_parcelas,
					'parcelas_sem_juros' => $this->parcelas_sem_juros,
					'li_msg' => $this->li_msg

	            );

	            $this->bool = $this->ShopPagamentoFacilitador->saveAll($data);

	        }

			$this->datasource->commit();

			return $this->bool;

		} catch (\PDOException $e) {

			$this->datasource->rollback();

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
