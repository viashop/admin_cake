<?php

App::uses('Model', 'Model');

class ShopDominioRedirect extends AppModel {
    public $name = 'ShopDominioRedirect';
    public $useTable = 'shop_dominio_redirect';
    public $primaryKey = 'id_dominio';
    public $useDbConfig = 'default';
}
