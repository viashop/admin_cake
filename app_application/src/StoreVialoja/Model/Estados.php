<?php

App::uses('Model', 'Model');

class Estados extends AppModel {
    public $name = 'Estados';
    public $useTable = 'estados';
    public $primaryKey = 'id_estado';
    public $useDbConfig = 'default';
}
