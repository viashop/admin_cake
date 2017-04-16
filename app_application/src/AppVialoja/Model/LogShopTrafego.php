<?php

/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 16/10/16 às 23:23
 */
use AppVialoja\Interfaces\Model\ILogShopTrafego;

class LogShopTrafego extends AppModel implements ILogShopTrafego
{

	public $name = 'LogShopTrafego';
    public $useTable = 'log_shop_trafego';
    public $primaryKey = 'id_trafego';
    public $useDbConfig = 'default';

	/**
	 * Obter Total Tráfego
	 * @param Shop $shop
	 * @param \stdClass $std data_inicio
	 * @return array|null
	 */
	public function obterTotalTrafego(Shop $shop, \stdClass $std)
	{

		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
			}

			$conditions = array(

	            'fields' => array(
	                'sum(`bytes`) as SOMA_BYTES',

	            ),
	            'conditions' => array(
					'`LogShopTrafego`.`id_shop_default`' => $shop->getIdShop(),
	            	'and' => array(
						'`LogShopTrafego`.`timestamp` BETWEEN date_sub( ? , INTERVAL 30 DAY )
		            	AND NOW()' => array($std->data_inicio)
		            ),

	            )

	        );

	        return $this->find('first', $conditions);

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

}
