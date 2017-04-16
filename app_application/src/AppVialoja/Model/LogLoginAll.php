<?php

class LogLoginAll extends AppModel {

    public $name = 'LogLoginAll';
    public $useTable = 'log_login_all';
    public $useDbConfig = 'default';

    public function limpar() {
	    $this->query('TRUNCATE `vl_log_login_all`');
	}

}
