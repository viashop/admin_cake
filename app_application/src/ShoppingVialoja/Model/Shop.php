<?php

App::uses('Model', 'Model');

class Shop extends AppModel {
    public $name = 'Shop';
    public $useTable = 'shop';
    public $primaryKey = 'id_shop';
    public $useDbConfig = 'default';
}
