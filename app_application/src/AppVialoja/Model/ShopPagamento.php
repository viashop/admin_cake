<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 17:44
 */
use AppVialoja\Interfaces\Model\IShopPagamento;

class ShopPagamento extends AppModel implements IShopPagamento
{

	public $name = 'ShopPagamento';
    public $useTable = 'shop_pagamento';
    public $primaryKey = 'id_pagamento';
    public $useDbConfig = 'default';

    /**
     * Obter Arrays para usar em IN
     * @param Shop $shop
     * @return array
     */
    public function obterArrayIds(Shop $shop)
    {

        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
            }

            if (empty($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop');
            }

            $conditions = array(
                'conditions' => array(
                    'ShopPagamento.id_shop_default' => $shop->getIdShop()
                )
            );

            $pagamentos = $this->find('all', $conditions);
            $arrayIds = array();
            foreach ($pagamentos as $key => $pagamento) {
                array_push($arrayIds, $pagamento['ShopPagamento']['id_config_pagamento']);
            }

            return $arrayIds;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Add Forma pagamento Wizard
     * @param Shop $shop
     * @param \stdClass $std
     */
    public function addPagamentoWizard(Shop $shop, \stdClass $std)
    {

        $this->datasource = $this->getDataSource();

        try {

            $this->datasource->begin();

            if (empty($std->id_pagamento)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "id_pagamento type array", E_USER_NOTICE);
            }

            if (!is_array($std->id_pagamento)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "id_pagamento type array", E_USER_NOTICE);
            }

            $conditions = array(
                'ShopPagamento.id_shop_default' => $shop->getIdShop()
            );

            if (!$this->deleteAll($conditions)) {
                throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
            }

            foreach ($std->id_pagamento as $v) {

                $data = array(
                    'id_shop_default' => $shop->getIdShop(),
                    'id_config_pagamento' => $v,
                    'ativo' => 'True'
                );

                if (!$this->saveAll($data)) {
                    throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
                }

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {
            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}

