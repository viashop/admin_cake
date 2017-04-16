<?php

App::uses('Model', 'Model');

class ShopDominio extends AppModel {
    public $name = 'ShopDominio';
    public $useTable = 'shop_dominio';
    public $primaryKey = 'id_dominio';
    public $useDbConfig = 'default';
}
