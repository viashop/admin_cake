<?php

use Lib\Tools;


class ShopEnvioPersonalizado extends AppModel {

	public $name = 'ShopEnvioPersonalizado';
    public $useTable = 'shop_envio_personalizado';
    public $useDbConfig = 'default';

    public function envioListar($id_shop='') {

		try {

			if(!is_numeric($id_shop)){
				throw new \LogicException('Informe o id do tipo INT');
			}

			$conditions = array(

	            'fields' => array(
	                'ShopEnvioPersonalizado.id',
	                'ShopEnvioPersonalizado.nome',
	                'ShopEnvioPersonalizado.ativo',
	                'ShopEnvioPersonalizado.imagem'
	            ),
	            'conditions' => array(
	                'ShopEnvioPersonalizado.id_shop_default' => $id_shop
	            ),
	            'order' => array('ShopEnvioPersonalizado.nome' => 'ASC')

	        );

	        return $this->find('all', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

	public function getEnvioId($id_shop='', $id_envio='') {

		try {

			if(!is_numeric($id_shop)){
				throw new \LogicException('Informe o id do tipo INT');
			}

			if(!is_numeric($id_envio)){
				throw new \LogicException('Informe o id do tipo INT');
			}

			$conditions = array(

	            'fields' => array(
	                'ShopEnvioPersonalizado.id',
	                'ShopEnvioPersonalizado.ativo',
	                'ShopEnvioPersonalizado.nome',
	                'ShopEnvioPersonalizado.ativo',
	                'ShopEnvioPersonalizado.prazo_adicional',
	                'ShopEnvioPersonalizado.taxa_tipo',
	                'ShopEnvioPersonalizado.taxa_valor',
	                'ShopEnvioPersonalizado.imagem'
	            ),
	            'conditions' => array(
	                'ShopEnvioPersonalizado.id' => $id_envio,
	                'ShopEnvioPersonalizado.id_shop_default' => $id_shop
	            ),
	            'limit' => 1

	        );

	        return $this->find('first', $conditions);


		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}


	public function remover($id_shop='', $id_envio='') {

		try {

			if(!is_numeric($id_shop)){
				throw new \LogicException('Informe o id do tipo INT');
			}

			if(!is_numeric($id_envio)){
				throw new \LogicException('Informe o id do tipo INT');
			}

			$this->deleteAll(array(
                'ShopEnvioPersonalizado.id' => $id_envio,
            	'ShopEnvioPersonalizado.id_shop_default' => $id_shop
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


	/**
	 * Busca faixa de CEPs para Transportadora
	 * @return array
	 */
	public function getValorFrete($id_shop='')
	{
		try {

			$cep = Tools::clean(Tools::getValue('cep'));
			$peso = Tools::getValue('peso');

			$conditions = array(
				'fields' => array(
					'ShopEnvioPersonalizado.*',
					'ShopEnvioPersonalizadoRegiao.*',
					'ShopEnvioPersonalizadoFaixa.*',
					'ShopEnvioPersonalizadoPeso.*',
				),

	            'conditions' => array(

	            	'ShopEnvioPersonalizado.id_shop_default' => $id_shop,
	            	'ShopEnvioPersonalizado.ativo' => 'True',
		            'and' => array(
		            	'? BETWEEN `ShopEnvioPersonalizadoFaixa`.`cep_inicio`
		            	AND `ShopEnvioPersonalizadoFaixa`.`cep_fim`
		            	AND ? BETWEEN `ShopEnvioPersonalizadoPeso`.`peso_inicio`
		            	AND `ShopEnvioPersonalizadoPeso`.`peso_fim`' => array( $cep, Tools::convertToDecimal($peso) )
		            ),

	            ),

	            'joins' => array(

                    array(
                        'table' => 'shop_envio_personalizado_regiao',
                        'alias' => 'ShopEnvioPersonalizadoRegiao',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvioPersonalizadoRegiao.id_envio_personalizado_default = ShopEnvioPersonalizado.id'
                        )
                    ),

                    array(
                        'table' => 'shop_envio_personalizado_faixa',
                        'alias' => 'ShopEnvioPersonalizadoFaixa',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvioPersonalizadoFaixa.id_envio_personalizado_default = ShopEnvioPersonalizado.id',
                            'ShopEnvioPersonalizadoFaixa.id_personalizado_regiao_default = ShopEnvioPersonalizadoRegiao.id'
                        )
                    ),

                    array(
                        'table' => 'shop_envio_personalizado_peso',
                        'alias' => 'ShopEnvioPersonalizadoPeso',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvioPersonalizadoPeso.id_envio_personalizado_default = ShopEnvioPersonalizado.id',
                            'ShopEnvioPersonalizadoPeso.id_personalizado_regiao_default = ShopEnvioPersonalizadoRegiao.id'
                        )
                    ),

                ),

                'order' => array('ShopEnvioPersonalizadoFaixa.cep_inicio' => 'DESC', 'ShopEnvioPersonalizadoFaixa.cep_fim' => 'DESC'),
	            'limit' => 1

			);

			if ($this->find('count', $conditions) > 0) {
				return $this->find('all', $conditions);
			} else {
				return self::verificaCalculoKgAdicional($cep, $peso, $id_shop);
			}

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

	}


    /**
     * Verifica se é Calculo de frete Adicional
     * @param string $cep
     * @param string $peso
     * @param string $id_shop
     * @return array|bool
     */
	private function verificaCalculoKgAdicional($cep='', $peso='', $id_shop='')
	{
		try {

			$conditions = array(
				'fields' => array(
					'ShopEnvioPersonalizado.*',
					'ShopEnvioPersonalizadoRegiao.*',
					'ShopEnvioPersonalizadoFaixa.*',
					'ShopEnvioPersonalizadoPeso.*',
				),

	            'conditions' => array(

	            	'ShopEnvioPersonalizado.id_shop_default' => $id_shop,
	            	'ShopEnvioPersonalizado.ativo' => 'True',
		            'and' => array(
		            	'? BETWEEN `ShopEnvioPersonalizadoFaixa`.`cep_inicio`
		            	AND `ShopEnvioPersonalizadoFaixa`.`cep_fim`
		            	AND `ShopEnvioPersonalizadoPeso`.`peso_fim` <= ?' => array( $cep, Tools::convertToDecimal($peso) )
		            ),

	            ),

	            'joins' => array(

                    array(
                        'table' => 'shop_envio_personalizado_regiao',
                        'alias' => 'ShopEnvioPersonalizadoRegiao',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvioPersonalizadoRegiao.id_envio_personalizado_default = ShopEnvioPersonalizado.id'
                        )
                    ),

                    array(
                        'table' => 'shop_envio_personalizado_faixa',
                        'alias' => 'ShopEnvioPersonalizadoFaixa',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvioPersonalizadoFaixa.id_envio_personalizado_default = ShopEnvioPersonalizado.id',
                            'ShopEnvioPersonalizadoFaixa.id_personalizado_regiao_default = ShopEnvioPersonalizadoRegiao.id'
                        )
                    ),

                    array(
                        'table' => 'shop_envio_personalizado_peso',
                        'alias' => 'ShopEnvioPersonalizadoPeso',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvioPersonalizadoPeso.id_envio_personalizado_default = ShopEnvioPersonalizado.id',
                            'ShopEnvioPersonalizadoPeso.id_personalizado_regiao_default = ShopEnvioPersonalizadoRegiao.id'
                        )
                    ),

                ),

                'order' => array('ShopEnvioPersonalizadoPeso.peso_inicio' => 'DESC', 'ShopEnvioPersonalizadoPeso.peso_fim' => 'DESC'),
	            'limit' => 1

			);

			if ($this->find('count', $conditions)>0) {
				$array1 = $this->find('all', $conditions);
				$array2['calcular_kg_adicional'] = true;
				return ( array_merge( $array1, $array2 ) );
			} else {
				return false;
			}

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

}
