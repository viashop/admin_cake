<?php

use Lib\Tools;


class ShopEnvioMotoboyController extends AppController {

	public $uses = array('ShopEnvioMotoboy');

	/**
	 * Cadastra faixa de CEPs para MotoBoy
	 * @return array
	 */
	public function cadastra()
	{
		try {

			if (empty($this->params['named']['id_envio'])) {
				throw new \LogicException("Necessário o parametro ID de ShopMotoboy", E_USER_WARNING);
			}

			$data = array(
				'id_envio_default' => $this->params['named']['id_envio'],
				'id_shop_default' => $this->Session->read('id_shop'),
				'ativo' => Tools::clean(Tools::getValue('ativo')),
				'limite_peso' => Tools::clean(Tools::getValue('limite_peso')),
				'regiao' => Tools::clean(Tools::getValue('regiao')),
				'cep_inicio' => Tools::clean(Tools::getValue('cep_inicio')),
				'cep_fim' => Tools::clean(Tools::getValue('cep_fim')),
				'prazo_entrega' => Tools::clean(Tools::getValue('prazo_entrega')),
				'valor' => Tools::convertToDecimal(Tools::getValue('valor'))
			);

			return $this->ShopEnvioMotoboy->saveAll($data);

		} catch (\PDOException $e) {

			if (isset($e->errorInfo[0]) && $e->errorInfo[0] === '23000') {
				throw new \RuntimeException("Esta faixa de CEP já encontra-se cadastrada.", E_USER_WARNING);
			}

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

	/**
	 * Remove faixa de CEPs para MotoBoy
	 * @return bool
	 */
	public function deleta()
	{
		try {

			if (empty($this->params['named']['id'])) {
				throw new \LogicException("Necessário o parametro ID de ShopMotoboy", E_USER_WARNING);
			}

			$conditions = array(
                'ShopEnvioMotoboy.id' => $this->params['named']['id'],
            	'ShopEnvioMotoboy.id_shop_default' => $this->Session->read('id_shop')
            );

			return $this->ShopEnvioMotoboy->deleteAll($conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}


	/**
	 * Lista faixa de CEPs para Motoboy
	 * @return array
	 */
	public function getId()
	{
		try {

			if (empty($this->params['named']['id_envio'])) {
				throw new \LogicException("Necessário o parametro ID de ShopEnvioMotoboy", E_USER_WARNING);
			}

            $conditions = array(

                'fields' => array(
                    'ShopEnvioMotoboy.regiao'
                ),
                'conditions' => array(
		          	'ShopEnvioMotoboy.id' => $this->params['named']['id'],
		          	'ShopEnvioMotoboy.id_envio_default' => $this->params['named']['id_envio'],
		          	'ShopEnvioMotoboy.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array('ShopEnvioMotoboy.regiao' => 'ASC')
            );

            return $this->ShopEnvioMotoboy->find('first', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
