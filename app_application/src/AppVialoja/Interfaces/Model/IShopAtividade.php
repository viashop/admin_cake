<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/10/16 às 18:33
 */

namespace AppVialoja\Interfaces\Model;

use Shop;
use ShopAtividade;

interface IShopAtividade
{

    /**
     * Add Atividades Loja
     * @param Shop $shop
     * @param ShopAtividade $atividade
     */
    public function addAtividade(Shop $shop, ShopAtividade $atividade);

    /**
     * Deleta as os ids das ativadades se existir
     * @param Shop $shop
     */
    public function removerTodos(Shop $shop);

    /**
     * Obter Configurações de Atividades
     * @param Shop $shop
     * @return array|null
     */
    public function listarTodasAtividadesJoin(Shop $shop);

}