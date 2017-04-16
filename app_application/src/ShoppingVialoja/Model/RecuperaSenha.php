<?php

App::uses('Model', 'Model');

class RecuperaSenha extends AppModel {
	
    public $name = 'RecuperaSenha';
    public $useTable = 'cliente_recuperar';
    public $primaryKey = 'id_cliente';
    public $useDbConfig = 'default';

}
