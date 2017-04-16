<?php

use Lib\Tools;


class ShopEnvioPersonalizadoRegiao extends AppModel {

	public $name = 'ShopEnvioPersonalizadoRegiao';
    public $useTable = 'shop_envio_personalizado_regiao';
    public $useDbConfig = 'default';

	public function cadastrar($id_personalizado='') {

		try {

			if(!is_numeric( $id_personalizado ) ) {
				throw new \LogicException('Informe o id do tipo INT');
			}

			if (Tools::getValue('nome') == '') {
				throw new \LogicException('Informe o nome da região');
			}

			$data = array(
				'id_envio_personalizado_default' => $id_personalizado,
				'pais' => Tools::clean(Tools::getValue('pais')),
				'nome' => Tools::clean(Tools::getValue('nome')),
				'ad_valorem' => Tools::convertToDecimal(Tools::getValue('ad_valorem')),
				'kg_adicional' => Tools::convertToDecimal(Tools::getValue('kg_adicional'))
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


	public function editar($id_envio='', $id='') {

		try {

			if(!is_numeric( $id_envio ) ) {
				throw new \LogicException('Informe o id_envio do tipo INT');
			}

			if(!is_numeric( $id ) ) {
				throw new \LogicException('Informe o id do tipo INT');
			}

			if (Tools::getValue('nome') == '') {
				throw new \LogicException('Informe o nome da região');
			}

			$fields = array(
				'ShopEnvioPersonalizadoRegiao.pais' => sprintf("'%s'", Tools::clean(Tools::getValue('pais'))),
				'ShopEnvioPersonalizadoRegiao.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome'))),
				'ShopEnvioPersonalizadoRegiao.ad_valorem' => Tools::convertToDecimal(Tools::getValue('ad_valorem')),
				'ShopEnvioPersonalizadoRegiao.kg_adicional' => Tools::convertToDecimal(Tools::getValue('kg_adicional'))
			);

			$conditions = array(
			    'ShopEnvioPersonalizadoRegiao.id' => $id,
			    'ShopEnvioPersonalizadoRegiao.id_envio_personalizado_default' => $id_envio
			);

			$this->updateAll($fields, $conditions);
			if ( $this->getAffectedRows() > 0)
				return true;
			else
				return false;

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


	public function regiaoListar($id_personalizado='') {

		try {

			if(!is_numeric($id_personalizado)) {
				throw new \LogicException('Informe o id do tipo INT');
			}

			$conditions = array(

	            'fields' => array(
	                'ShopEnvioPersonalizadoRegiao.*'
	            ),
	            'conditions' => array(
	                'ShopEnvioPersonalizadoRegiao.id_envio_personalizado_default' => $id_personalizado
	            ),

	            'order' => array('ShopEnvioPersonalizadoRegiao.pais' => 'ASC', 'ShopEnvioPersonalizadoRegiao.nome' => 'ASC')

	        );

	        return $this->find('all', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}


	public function regiaoId($id_regiao='') {

		try {

			if(!is_numeric($id_regiao)) {
				throw new \LogicException('Informe o id do tipo INT');
			}

			$conditions = array(

	            'fields' => array(
	                'ShopEnvioPersonalizadoRegiao.*'
	            ),
	            'conditions' => array(
	                'ShopEnvioPersonalizadoRegiao.id' => $id_regiao
	            ),

	        );

	        return $this->find('first', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
