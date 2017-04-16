<?php

App::uses('Model', 'Model');

class ShopEnvioPessoalmente extends AppModel {
	
	public $name = 'ShopEnvioPessoalmente';
    public $useTable = 'shop_envio_pessoalmente';
    public $useDbConfig = 'default';
	
	/**
	 * Busca faixa de CEPs para Pessoalmente
	 * @return array
	 */
	public function getRetirarPessoalmente($id_shop='', $cep='')
	{
		try {
		
			$conditions = array(

				'fields' => array(
					'ShopEnvioPessoalmente.regiao',
					'ShopEnvioPessoalmente.id_envio_default'
				),
	            'conditions' => array(
		            'and' => array('? BETWEEN `ShopEnvioPessoalmente`.`cep_inicio` AND `ShopEnvioPessoalmente`.`cep_fim`' => array( $cep ) )
		        ),
	            'joins' => array(                 
         
                    array(
                        'table' => 'shop_envio',
                        'alias' => 'ShopEnvio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvio.id_envio = ShopEnvioPessoalmente.id_envio_default',
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
