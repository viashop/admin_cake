<?php

use Lib\Tools;


class ShopEnvioMotoboy extends AppModel {

	public $name = 'ShopEnvioMotoboy';
    public $useTable = 'shop_envio_motoboy';
    public $useDbConfig = 'default';

    /**
	 * Lista faixa de CEPs para MotoBoy
	 * @return array
	 */
	public function getAll($id_shop='')
	{
		try {


            $conditions = array(

                'fields' => array(
                    'ShopEnvioMotoboy.*'
                ),
                'conditions' => array(
		          	'ShopEnvioMotoboy.id_shop_default' => $id_shop
                ),
                'order' => array('ShopEnvioMotoboy.regiao' => 'ASC')
            );

            return $this->find('all', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

	}


	/**
	 * Busca faixa de CEPs para MotoBoy
	 * @return array
	 */
	public function getValorFrete($id_shop='')
	{
		try {

			$cep = Tools::clean(Tools::getValue('cep'));
			$peso = round(floatval(Tools::getValue('peso')));

			$peso_final = 40;
			if ($peso <= 30) {
				$peso_final = 30;
			} else {
				if ($peso > $peso_final) {
					return false;
				}
			}

			$conditions = array(
				'fields' => array(
					'ShopEnvioMotoboy.regiao',
					'ShopEnvioMotoboy.valor',
					'ShopEnvioMotoboy.prazo_entrega'
				),
	            'conditions' => array(
	            'and' => array('? BETWEEN `ShopEnvioMotoboy`.`cep_inicio` AND `ShopEnvioMotoboy`.`cep_fim`' => array( $cep ),
	                	'ShopEnvioMotoboy.limite_peso' => intval($peso_final)
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

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

}
