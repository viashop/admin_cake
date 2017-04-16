<?php

App::uses('Model', 'Model');

class ShopEnvioTransportadora extends AppModel {

	public $name = 'ShopEnvioTransportadora';
    public $useTable = 'shop_envio_transportadora';
    public $useDbConfig = 'default';
	
	/**
	 * Busca faixa de CEPs para Transportadora
	 * @return array
	 */
	public function getValorFrete($id_shop='', $cep='', $peso='')
	{
		try {

			$cep = Tools::clean( $cep );
			$peso = Tools::convertToDecimal( $peso );

			$conditions = array(
				'fields' => array(
					'ShopEnvioTransportadora.regiao', 
					'ShopEnvioTransportadora.valor', 
					'ShopEnvioTransportadora.prazo_entrega',
					'ShopEnvioTransportadora.id_envio_default'
				),
	            'conditions' => array(
		            'and' => array('? BETWEEN `ShopEnvioTransportadora`.`cep_inicio` AND `ShopEnvioTransportadora`.`cep_fim` AND ? BETWEEN `ShopEnvioTransportadora`.`peso_inicial` AND `ShopEnvioTransportadora`.`peso_final`' => array( $cep, $peso ) ),
	            ),		            
	            'joins' => array(         
                    array(
                        'table' => 'shop_envio',
                        'alias' => 'ShopEnvio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvio.id_envio = ShopEnvioTransportadora.id_envio_default',
                            'ShopEnvio.ativo' => 'True',
                            'ShopEnvio.id_shop_default' => $id_shop
                        )
                    ),
                  
                ),
                'order' => array('ShopEnvioTransportadora.cep_inicio' => 'DESC', 'ShopEnvioTransportadora.cep_fim' => 'DESC'),
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
	 * Busca faixa de CEPs para Transportadora
	 * @return array
	 */
	private function verificaCalculoKgAdicional($cep='', $peso='', $id_shop='')
	{
		try {

			$conditions = array(
				'fields' => array(
					'ShopEnvioTransportadora.regiao', 
					'ShopEnvioTransportadora.valor', 
					'ShopEnvioTransportadora.prazo_entrega',
					'ShopEnvioTransportadora.peso_final',
					'ShopEnvioTransportadora.kg_adicional'
				),
	            'conditions' => array(
		            'and' => array('? BETWEEN `ShopEnvioTransportadora`.`cep_inicio` AND `ShopEnvioTransportadora`.`cep_fim` AND `ShopEnvioTransportadora`.`peso_final` <= ?' => array( $cep, $peso ) ),
	            ),		            
	            'joins' => array(         
                    array(
                        'table' => 'shop_envio',
                        'alias' => 'ShopEnvio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvio.id_envio = ShopEnvioTransportadora.id_envio_default',
                            'ShopEnvio.ativo' => 'True',
                            'ShopEnvio.id_shop_default' => $id_shop
                        )
                    ),
                  
                ),
                'order' => array('ShopEnvioTransportadora.peso_inicial' => 'DESC', 'ShopEnvioTransportadora.peso_final' => 'DESC'),
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
