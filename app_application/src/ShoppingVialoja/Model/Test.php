<?php

App::uses('Model', 'Model');

class Test extends AppModel {
    public $name = 'Test';
    public $useTable = 'test';
    public $primaryKey = 'id';
    public $useDbConfig = 'test';
}
