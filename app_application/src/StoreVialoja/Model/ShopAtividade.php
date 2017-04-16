<?php

App::uses('Model', 'Model');

class ShopAtividade extends AppModel {
    public $name = 'ShopAtividade';
    public $useTable = 'shop_atividade';
    public $primaryKey = 'id_atividade';
    public $useDbConfig = 'default';
}
