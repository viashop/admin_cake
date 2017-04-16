<?php

App::uses('Model', 'Model');

class ShopEndereco extends AppModel {
    public $name = 'ShopEndereco';
    public $useTable = 'shop_endereco';
    public $primaryKey = 'id_endereco';
    public $useDbConfig = 'default';
}
