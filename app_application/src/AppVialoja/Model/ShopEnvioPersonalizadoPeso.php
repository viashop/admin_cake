<?php

use Lib\Tools;


class ShopEnvioPersonalizadoPeso extends AppModel {

	public $name = 'ShopEnvioPersonalizadoPeso';
    public $useTable = 'shop_envio_personalizado_peso';
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
				'peso_inicio' => Tools::convertToDecimal(Tools::getValue('peso_inicio')),
				'peso_fim' => Tools::convertToDecimal(Tools::getValue('peso_fim')),
				'valor' => Tools::convertToDecimal(Tools::getValue('valor')),
			);

			if ($this->saveAll($data)) {

				if (self::cleanError($this->getLastInsertId()) === true) {
					return false;
				}
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


    /**
     * Remove BUG
     * @param string $id
     * @return bool
     */
	private function cleanError($id = '')
	{
		if (isset($id)) {

			$this->deleteAll(array(

				'ShopEnvioPersonalizadoPeso.id' => $id,
				'OR' => array(
					'ShopEnvioPersonalizadoPeso.peso_inicio' => 9999999.999,
					'ShopEnvioPersonalizadoPeso.peso_fim' => 9999999.999
				)

			));

			if ($this->getAffectedRows()) {
				return true;
			}

		}

	}

	public function pesoListar($id_personalizado='', $id_regiao='') {

		try {

			if(!is_numeric( $id_personalizado ) ) {
				throw new \LogicException('Informe o id personalizado do tipo INT');
			}

			if(!is_numeric( $id_regiao ) ) {
				throw new \LogicException('Informe o id regiao do tipo INT');
			}

			$conditions = array(

	            'fields' => array(
	                'ShopEnvioPersonalizadoPeso.*'
	            ),
	            'conditions' => array(
	                'ShopEnvioPersonalizadoPeso.id_envio_personalizado_default' => $id_personalizado,
					'ShopEnvioPersonalizadoPeso.id_personalizado_regiao_default' => $id_regiao,
	            )

	        );

	        return $this->find('all', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

	public function remover($id_personalizado='', $id_regiao='', $id_peso ='') {

		try {

			if(!is_numeric( $id_personalizado ) ) {
				throw new \LogicException('Informe o id personalizado do tipo INT');
			}

			if(!is_numeric( $id_regiao ) ) {
				throw new \LogicException('Informe o id regiao do tipo INT');
			}

			if(!is_numeric( $id_peso ) ) {
				throw new \LogicException('Informe o id peso do tipo INT');
			}

			$this->deleteAll(array(
                'ShopEnvioPersonalizadoPeso.id_envio_personalizado_default' => $id_personalizado,
				'ShopEnvioPersonalizadoPeso.id_personalizado_regiao_default' => $id_regiao,
                'ShopEnvioPersonalizadoPeso.id' => $id_peso
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
