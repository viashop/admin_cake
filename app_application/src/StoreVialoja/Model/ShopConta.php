<?php

App::uses('Model', 'Model');

class ShopConta extends AppModel {
    public $name = 'ShopConta';
    public $useTable = 'shop_conta';
    public $primaryKey = 'id_conta';
    public $useDbConfig = 'default';
}
