<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/09/16 às 15:38
 */

class TesteCartController extends AppController {

    public $layout = false;

    public function index() {

        try {

            $cart = new \Cart\Cart();

            if ($cart instanceof \Cart\Cart) {


                $cart->





//                $cart->setIdShop(4156366);
//                $cart->removeShop();
//
//                $cart->setIdShop(4156339);
//                $cart->createCart();
//
//                //$cart->setIdProduct(3056302920);
//                $cart->setIdProduct(mt_rand());
//                $cart->setQuantity(mt_rand(1,5));
//                $cart->addProduct();
//
//                pr($cart->draw());

            }



        } catch (\Exception $e) {
        }



        $this->render(false);
    }


}