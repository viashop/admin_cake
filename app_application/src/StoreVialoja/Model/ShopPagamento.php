<?php

App::uses('Model', 'Model');

class ShopPagamento extends AppModel {
	public $name = 'ShopPagamento';
    public $useTable = 'shop_pagamento';
    public $primaryKey = 'id_pagamento';
    public $useDbConfig = 'default';
}
