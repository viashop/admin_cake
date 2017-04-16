<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/10/16 às 20:28
 */

namespace AppVialoja\Interfaces\Model;

use Shop;
use ShopEndereco;

interface IShopEndereco
{

    /**
     * Retorna dados de endereço
     * @param Shop $shop
     * @return array|null
     */
    public function getFirstAll(Shop $shop);

    /**
     * Cadastra Endereço Shop
     * @param Shop $shop
     * @param ShopEndereco $endereco
     */
    public function cadastrar(Shop $shop, ShopEndereco $endereco);

}