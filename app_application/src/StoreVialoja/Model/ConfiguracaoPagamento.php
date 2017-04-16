<?php

App::uses('Model', 'Model');

class ConfiguracaoPagamento extends AppModel {
    public $name = 'ConfiguracaoPagamento';
    public $useTable = 'configuracao_pagamento';
    public $primaryKey = 'id_config_pagamento';
    public $useDbConfig = 'default';
}
