<?php



class ShopEnvioTransportadoraController extends AppController {

	public $uses = array('ShopEnvioTransportadora');

	/**
	 * Remove faixa de CEPs para Transportadora
	 * @return bool
	 */
	public function deleta()
	{
		try {

			if (empty($this->params['named']['id'])) {
				throw new \LogicException("Necessário o parametro ID de ShopEnvioTransportadora", E_USER_WARNING);
			}

			$conditions = array(
                'ShopEnvioTransportadora.id' => $this->params['named']['id'],
            	'ShopEnvioTransportadora.id_shop_default' => $this->Session->read('id_shop')
            );

			return $this->ShopEnvioTransportadora->deleteAll($conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
