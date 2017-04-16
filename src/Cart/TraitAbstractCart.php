<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/09/16 às 05:23
 */

namespace Cart;


trait TraitAbstractCart
{
    private $id_shop;
    private $id_product;
    private $quantity;

    /**
     * @return integer
     */
    public function getIdShop()
    {
        return $this->id_shop;
    }

    /**
     * @param integer $id_shop
     * @return TraitAbstractCart
     */
    public function setIdShop($id_shop)
    {
        $this->id_shop = (integer)$id_shop;
        return $this;
    }

    /**
     * @return integer
     */
    public function getIdProduct()
    {
        return $this->id_product;
    }

    /**
     * @param integer $id_product
     * @return TraitAbstractCart
     */
    public function setIdProduct($id_product)
    {
        $this->id_product = (integer)$id_product;
        return $this;
    }

    /**
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param integer $quantity
     * @return TraitAbstractCart
     */
    public function setQuantity($quantity)
    {
        $this->quantity = (integer)$quantity;
        return $this;
    }

}