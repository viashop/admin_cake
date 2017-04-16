<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 25/09/16 às 00:45
 */

namespace Cart;


interface CartInterface
{
    public function addShopCart($id_shop);
    public function removeShopCart($id_shop);
    public function addProductCart($id_product);
    public function removeProductCart($id_product);
    public function quantityProductCart($id_product);
    public function recalculateCart();
}