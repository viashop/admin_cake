<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 02:32
 */

namespace AppVialoja\Interfaces\Model;

use Shop;

interface ILogShopTrafego
{
    /**
     * Obter Total Tráfego
     * @param Shop $shop
     * @param \stdClass $std data_inicio
     * @return array|null
     */
    public function obterTotalTrafego(Shop $shop, \stdClass $std);
}