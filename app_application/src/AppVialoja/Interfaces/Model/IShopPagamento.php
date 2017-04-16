<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 17:48
 */

namespace AppVialoja\Interfaces\Model;

use Shop;

interface IShopPagamento
{

    /**
     * Obter Arrays para usar em IN
     * @param Shop $shop
     * @return array
     */
    public function obterArrayIds(Shop $shop);

    /**
     * Add Forma pagamento Wizard
     * @param Shop $shop
     * @param \stdClass $std
     */
    public function addPagamentoWizard(Shop $shop, \stdClass $std);

}