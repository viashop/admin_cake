<?php

class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '123456',
		'database' => 'vialojac_shop',
		//'prefix' => '',
		'encoding' => 'utf8',
	);

	public $default_pg = array(
		'datasource' => 'Database/Postgres',
		'persistent' => false,
		'host' => 'localhost',
		'port' => '5432',
		'login' => 'postgres',
		'password' => '123456',
		'database' => 'vialoja',
		'schema' => 'public',
		'prefix' => '',
		//'encoding' => 'utf8',
	);



	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => 'password',
		'database' => 'test_database_name',
		'prefix' => '',
		'encoding' => 'utf8',
	);
}
