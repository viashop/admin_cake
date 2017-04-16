<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 19/10/16 às 09:42
 */

namespace AppVialoja\Interfaces\Model;

use Shop;

interface IShopDominioRedirect
{

    /**
     * Verifica se dominio esta para ser redirecionado
     * @param Shop $shop
     * @param \stdClass $std
     * @return bool
     */
    public function existsSubdominio(Shop $shop, \stdClass $std);

    /**
     * Exclui o subdominio
     * @param Shop $shop
     * @param \stdClass $std
     */
    public function removeSubdominio(Shop $shop, \stdClass $std);

}