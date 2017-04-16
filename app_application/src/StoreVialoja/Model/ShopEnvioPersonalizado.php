<?php

App::uses('Model', 'Model');

class ShopEnvioPersonalizado extends AppModel {

	public $name = 'ShopEnvioPersonalizado';
    public $useTable = 'shop_envio_personalizado';
    public $useDbConfig = 'default';

	
	/**
	 * Busca faixa de CEPs para Transportadora
	 * @return array
	 */
	public function readValorFreteTransportadora($id_shop='', $cep='', $peso='')
	{
		try {

			$cep = Tools::clean( $cep );
			$peso = Tools::convertToDecimal( $peso );

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
		            	'? BETWEEN `ShopEnvioPersonalizadoFaixa`.`cep_inicio` AND `ShopEnvioPersonalizadoFaixa`.`cep_fim` AND ? BETWEEN `ShopEnvioPersonalizadoPeso`.`peso_inicio` AND `ShopEnvioPersonalizadoPeso`.`peso_fim`' => array( $cep, $peso ) 
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

		} catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

	}


	/**
	 * Verifica se é Calculo de frete Adicional
	 * @return array
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
		            	'? BETWEEN `ShopEnvioPersonalizadoFaixa`.`cep_inicio` AND `ShopEnvioPersonalizadoFaixa`.`cep_fim` AND `ShopEnvioPersonalizadoPeso`.`peso_fim` <= ?' => array( $cep, $peso ) 
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

		} catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

}
