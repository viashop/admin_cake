<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 02:29
 */

namespace AppVialoja\Interfaces\Model;

use Shop;

interface ILogShopVisita
{
    /**
     * Obter Total Visita
     * @param Shop $shop
     * @param \stdClass $std data_inicio
     */
    public function obterTotalVisita(Shop $shop, \stdClass $std);
}