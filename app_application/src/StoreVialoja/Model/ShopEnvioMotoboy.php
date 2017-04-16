<?php

App::uses('Model', 'Model');

class ShopEnvioMotoboy extends AppModel {

	public $name = 'ShopEnvioMotoboy';
    public $useTable = 'shop_envio_motoboy';
    public $useDbConfig = 'default';

    /**
	 * Busca faixa de CEPs para MotoBoy
	 * @return array
	 */
	public function readValorFreteTransportadora($id_shop='', $cep='', $peso='')
	{
		try {

			$cep = Tools::clean( $cep );
			$peso = round( Tools::convertToDecimal( $peso ) );

			if ($peso <= 30) {
				$peso_final = 30;	
			} elseif ($peso <= 40) {
				$peso_final = 40;	
			} else {
				if ($peso > 40 ) {
					return false;
				}
			}   

			$conditions = array(
				'fields' => array(
					'ShopEnvioMotoboy.regiao', 
					'ShopEnvioMotoboy.valor', 
					'ShopEnvioMotoboy.prazo_entrega',
					'ShopEnvioMotoboy.id_envio_default'
				),
	            'conditions' => array(
	            'and' => array('? BETWEEN `ShopEnvioMotoboy`.`cep_inicio` AND `ShopEnvioMotoboy`.`cep_fim`' => array( $cep ),
	                	'ShopEnvioMotoboy.limite_peso' => $peso_final
	                )
	            ),		            
	            'joins' => array(                 
         
                    array(
                        'table' => 'shop_envio',
                        'alias' => 'ShopEnvio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvio.id_envio = ShopEnvioMotoboy.id_envio_default',
                            'ShopEnvio.ativo' => 'True',
                            'ShopEnvio.id_shop_default' => $id_shop
                        )
                    ),
                  
                ),
	            'limit' => 1
			);     

            return $this->find('all', $conditions);

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

	}
}
