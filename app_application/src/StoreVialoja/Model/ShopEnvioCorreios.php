<?php

App::uses('Model', 'Model');

class ShopEnvioCorreios extends AppModel {
	
	public $name = 'ShopEnvioCorreios';
    public $useTable = 'shop_envio_correios';
    public $useDbConfig = 'default';
	
	public function getAll($id_shop='')
	{
		try {

			$conditions = array( 

                'fields' => array(
                    
                    'ShopEnvioCorreios.taxa_tipo',
                    'ShopEnvioCorreios.taxa_valor',
                    'ShopEnvioCorreios.com_contrato',
                    'ShopEnvioCorreios.codigo_servico',
                    'ShopEnvioCorreios.codigo',
                    'ShopEnvioCorreios.senha',
                    'ShopEnvioCorreios.mao_propria',
                    'ShopEnvioCorreios.valor_declarado',
                    'ShopEnvioCorreios.aviso_recebimento',
                    'ShopEnvioCorreios.ativo',
                    'ShopEnvioCorreios.cep_origem',
                    'ShopEnvioCorreios.prazo_adicional',
                    'ShopEnvioCorreios.id_envio_default',
                    'ShopEnvio.ativo',  
                    'CodigoCorreios.nome',
                    
                ),

                'conditions' => array(
                    'ShopEnvioCorreios.id_shop_default' => $id_shop,
                    'ShopEnvioCorreios.codigo_servico !=' => '',
                    'ShopEnvio.ativo' => 'True',
                ),

                'joins' => array(

                    array(
                        'table' => 'shop_envio',
                        'alias' => 'ShopEnvio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvio.id_envio = ShopEnvioCorreios.id_envio_default'
                        )
                    ),

                    array(
                        'table' => 'codigo_correios',
                        'alias' => 'CodigoCorreios',
                        'type' => 'INNER',
                        'conditions' => array(
                            'CodigoCorreios.codigo = ShopEnvioCorreios.codigo_servico'
                        )
                    ),
                  
                ),

            );

			return $this->find('all', $conditions);	
			
		} catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

}
