<?php

App::uses('Model', 'Model');

class ShopCarrinho extends AppModel {
    public $name = 'ShopCarrinho';
    public $useTable = 'shop_carrinho';
    public $primaryKey = 'id_carrinho';
    public $useDbConfig = 'default';
}
