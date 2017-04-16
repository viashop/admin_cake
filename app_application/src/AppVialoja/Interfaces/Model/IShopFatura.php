<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 02:12
 */

namespace AppVialoja\Interfaces\Model;
use Shop;

interface IShopFatura
{
    public function cicloContaPlano(Shop $shop);
}