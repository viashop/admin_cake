<?php

/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 16/10/16 às 23:06
 */
use \AppVialoja\Interfaces\Model\ILogShopVisita;

class LogShopVisita extends AppModel implements ILogShopVisita
{

    public $name = 'LogShopVisita';
    public $useTable = 'log_shop_visita';
    public $primaryKey = 'id_visita';
    public $useDbConfig = 'default';

    /**
     * Obter Total Visita
     * @param Shop $shop
     * @param \stdClass $std data_inicio
     * @return array|null
     */
    public function obterTotalVisita(Shop $shop, \stdClass $std)
    {

        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
            }

            $conditions = array(

                'conditions' => array(
                    '`LogShopVisita`.`id_shop_default`' => $shop->getIdShop(),
                    'and' => array(
                        '`LogShopVisita`.`timestamp` BETWEEN date_sub( ? , INTERVAL 30 DAY )
		            	AND NOW()' => array($std->data_inicio)
                    ),

                )

            );

            return $this->find('count', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}
