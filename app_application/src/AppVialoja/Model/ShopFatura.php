<?php

/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 02:11
 */

use AppVialoja\Interfaces\Model\IShopFatura;

class ShopFatura extends AppModel implements IShopFatura
{

    public $name = 'ShopFatura';
    public $useTable = 'shop_fatura';
    public $primaryKey = 'id_fatura';
    public $useDbConfig = 'default';

    public function cicloContaPlano(Shop $shop)
    {
        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
            }

            if (empty($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop', E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'ShopFatura.id_fatura',
                    'ShopFatura.id_plano',
                    'ShopFatura.valor',
                    'ShopFatura.desconto',
                    'ShopFatura.referencia',
                    'ShopFatura.data_mes_inicial',
                    'ShopFatura.data_mes_final',
                    'ShopFatura.situacao'
                ),
                'conditions' => array(
                    'ShopFatura.id_shop_default' => $shop->getIdShop()
                ),
                'order' => array(
                    'ShopFatura.id_fatura' => 'DESC',
                    'ShopFatura.created' => 'DESC'
                ),
                'limit' => 1
            );

            return $this->find('first', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}
