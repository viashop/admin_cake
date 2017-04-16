<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/09/16 às 07:27
 */

namespace Cart;

class CartContainer
{

    private $itens;
    private $key;
    private $item;
    private $value;
    private $product_id;
    private $quantity;
    private $v;

    use TraitAbstractCart;

    public function __construct()
    {
        //unset($_SESSION['cart']);
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

    }

    protected function createShopCart()
    {

        if (!isset($_SESSION['cart']['id_shop'][$this->getIdShop()])) {
            $_SESSION['cart']['id_shop'][$this->getIdShop()] = true;
        }

    }

    protected function removeShopCart()
    {

        try {

            if (empty($this->getIdShop()) && !is_numeric($this->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'id_product', E_USER_NOTICE);
            }

            if (isset($_SESSION['cart'])){

                if (array_key_exists('id_shop', $_SESSION['cart'])) {
                    if (isset($_SESSION['cart']['id_shop'][$this->getIdShop()])) {
                        unset($_SESSION['cart']['id_shop'][$this->getIdShop()]);
                    }
                }

            }

            if (empty($_SESSION['cart']['id_shop'])) {
                unset($_SESSION['cart']['id_shop']);
            }

        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    protected function addProductShopCart()
    {

        try {

            if (!isset($_SESSION['product'])) {
                $_SESSION['product'] = array();
            }

            if (empty($this->getIdProduct()) && !is_numeric($this->getIdProduct())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'id_product', E_USER_NOTICE);
            }

            $this->checkContainsTheArrayProduct();

            if (isset($this->product_id) && $this->product_id !== $this->getIdProduct()) {
                $_SESSION['product'][]['product_id'][$this->getIdProduct()] = $this->getQuantity();
                $_SESSION['cart']['id_shop'][$this->getIdShop()] = $_SESSION['product'];
            }

            if (empty($this->product_id)) {
                $_SESSION['product'][]['product_id'][$this->getIdProduct()] = $this->getQuantity();
                $_SESSION['cart']['id_shop'][$this->getIdShop()] = $_SESSION['product'];
            }

        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }


    protected function checkContainsTheArrayProduct()
    {

        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $this->itens);
            foreach ($this->itens as $this->key => $this->item);
            if (is_array($this->item))
                if ($this->key === $this->getIdShop())
                    foreach ($this->item as $this->value);
            foreach ($this->value as $this->v);
            foreach ($this->v as $this->product_id => $this->quantity);

        }

    }

}