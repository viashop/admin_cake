<?php

use Lib\Tools;


class ShopEnvioPessoalmenteController extends AppController {

	public $uses = array('ShopEnvioPessoalmente');


	/**
	 * Cadastra faixa de CEPs para Pessoalmente
	 * @return array
	 */
	public function cadastra()
	{
		try {

			if (empty($this->params['named']['id_envio'])) {
				throw new \LogicException("Necessário o parametro ID de ShopEnvioPessoalmente", E_USER_WARNING);
			}

			$data = array(
				'id_envio_default' => $this->params['named']['id_envio'],
				'id_shop_default' => $this->Session->read('id_shop'),
				'ativo' => Tools::clean(Tools::getValue('ativo')),
				'regiao' => Tools::clean(Tools::getValue('regiao')),
				'cep_inicio' => Tools::clean(Tools::getValue('cep_inicio')),
				'cep_fim' => Tools::clean(Tools::getValue('cep_fim')),
			);

			return $this->ShopEnvioPessoalmente->saveAll($data);

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
	 * Remove faixa de CEPs para Pessoalmente
	 * @return bool
	 */
	public function deleta()
	{
		try {

			if (empty($this->params['named']['id'])) {
				throw new \LogicException("Necessário o parametro ID de ShopEnvioPessoalmente", E_USER_WARNING);
			}

			$conditions = array(
                'ShopEnvioPessoalmente.id' => $this->params['named']['id'],
            	'ShopEnvioPessoalmente.id_shop_default' => $this->Session->read('id_shop')
            );

			return $this->ShopEnvioPessoalmente->deleteAll($conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

	/**
	 * Lista faixa de CEPs para Pessoalmente
	 * @return array
	 */
	public function getAll()
	{
		try {

			if (empty($this->params['named']['id_envio'])) {
				throw new \LogicException("Necessário o parametro ID de ShopEnvioPessoalmente", E_USER_WARNING);
			}

            $conditions = array(

                'fields' => array(
                    'ShopEnvioPessoalmente.*'
                ),
                'conditions' => array(
		          	'ShopEnvioPessoalmente.id_envio_default' => $this->params['named']['id_envio'],
		          	'ShopEnvioPessoalmente.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array('ShopEnvioPessoalmente.regiao' => 'ASC')
            );

            return $this->ShopEnvioPessoalmente->find('all', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}


	/**
	 * Lista faixa de CEPs para Pessoalmente
	 * @return array
	 */
	public function getId()
	{
		try {

			if (empty($this->params['named']['id_envio'])) {
				throw new \LogicException("Necessário o parametro ID de ShopEnvioPessoalmente", E_USER_WARNING);
			}

            $conditions = array(

                'fields' => array(
                    'ShopEnvioPessoalmente.regiao'
                ),
                'conditions' => array(
		          	'ShopEnvioPessoalmente.id' => $this->params['named']['id'],
		          	'ShopEnvioPessoalmente.id_envio_default' => $this->params['named']['id_envio'],
		          	'ShopEnvioPessoalmente.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array('ShopEnvioPessoalmente.regiao' => 'ASC')
            );

            return $this->ShopEnvioPessoalmente->find('first', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
