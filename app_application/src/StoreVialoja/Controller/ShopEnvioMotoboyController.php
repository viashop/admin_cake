<?php

App::uses('AppController', 'Controller');

class ShopEnvioMotoboyController extends AppController {

	public $uses = array('ShopEnvioMotoboy');

	/**
	 * Busca faixa de CEPs para MotoBoy
	 * @return array
	 */
	public function readValorFreteTransportadora()
	{
		try {

			if ( empty( $this->params['named']['id_shop']) ) {
				throw new LogicException("Valor obrigatório: Informe o id_shop ", 1);
			}

			if ( empty( $this->params['named']['cep'] ) ) {
				throw new LogicException("Valor obrigatório: Informe o cep ", 1);
			}

			if ( empty( $this->params['named']['peso'] ) ) {
				throw new LogicException("Valor obrigatório: Informe o peso ", 1);
			}

			$id_shop_default = intval( $this->params['named']['id_shop'] );
			$cep = Tools::clean( $this->params['named']['cep'] );
			$peso = round( $this->params['named']['peso'] );

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
	            'conditions' => array(
	            'and' => array(
	                '? BETWEEN `ShopEnvioMotoboy`.`cep_inicio` AND `ShopEnvioMotoboy`.`cep_fim`' => array( $cep ),
	                'ShopEnvioMotoboy.limite_peso' => $peso_final,
	                'ShopEnvioMotoboy.id_shop_default' => $id_shop_default
	                )
	            ),

	            'limit' => 1
			);

            return $this->ShopEnvioMotoboy->find('all', $conditions);

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (LogicException $e) {

			return false;

		}

	}

}
