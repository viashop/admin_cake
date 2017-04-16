<?php

use Lib\Tools;


class ShopEnvioPersonalizadoFaixa extends AppModel {

	public $name = 'ShopEnvioPersonalizadoFaixa';
    public $useTable = 'shop_envio_personalizado_faixa';
    public $useDbConfig = 'default';

    public function cadastrar($id_personalizado='', $id_regiao='') {

		try {

			if(!is_numeric( $id_personalizado ) ) {
				throw new \LogicException('Informe o id personalizado do tipo INT');
			}

			if(!is_numeric( $id_regiao ) ) {
				throw new \LogicException('Informe o id regiao do tipo INT');
			}

			$data = array(
				'id_envio_personalizado_default' => $id_personalizado,
				'id_personalizado_regiao_default' => $id_regiao,
				'cep_inicio' => Tools::clean(Tools::getValue('cep_inicio')),
				'cep_fim' => Tools::clean(Tools::getValue('cep_fim')),
				'prazo_entrega' => Tools::clean(Tools::getValue('prazo_entrega')),
			);

			if ($this->saveAll($data)) {
				return true;
			} else {
				return false;
			}

		} catch (\PDOException $e) {


			if (isset($e->errorInfo[0]) && $e->errorInfo[0] === '23000') {
				return $e->errorInfo[0];
			} else {

				\Exception\VialojaDatabaseException::errorHandler($e);
				return false;

			}

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}


	public function faixaListar($id_personalizado='', $id_regiao='') {

		try {

			if(!is_numeric( $id_personalizado ) ) {
				throw new \LogicException('Informe o id personalizado do tipo INT');
			}

			if(!is_numeric( $id_regiao ) ) {
				throw new \LogicException('Informe o id regiao do tipo INT');
			}

			$conditions = array(

	            'fields' => array(
	                'ShopEnvioPersonalizadoFaixa.*'
	            ),
	            'conditions' => array(
	                'ShopEnvioPersonalizadoFaixa.id_envio_personalizado_default' => $id_personalizado,
					'ShopEnvioPersonalizadoFaixa.id_personalizado_regiao_default' => $id_regiao,
	            )

	        );

	        return $this->find('all', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}


	public function remover($id_personalizado='', $id_regiao='', $id_faixa ='') {

		try {

			if(!is_numeric( $id_personalizado ) ) {
				throw new \LogicException('Informe o id personalizado do tipo INT');
			}

			if(!is_numeric( $id_regiao ) ) {
				throw new \LogicException('Informe o id regiao do tipo INT');
			}

			if(!is_numeric( $id_faixa ) ) {
				throw new \LogicException('Informe o id peso do tipo INT');
			}

			$this->deleteAll(array(
                'ShopEnvioPersonalizadoFaixa.id_envio_personalizado_default' => $id_personalizado,
				'ShopEnvioPersonalizadoFaixa.id_personalizado_regiao_default' => $id_regiao,
                'ShopEnvioPersonalizadoFaixa.id' => $id_faixa
            ));

            if ($this->getAffectedRows()) {
            	return true;
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
