<?php
/**
 * CodigoCorreioFixture
 *
 */
class CodigoCorreioFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'codigo' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'id_envio' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'servico' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'codigo', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'codigo' => 1,
			'id_envio' => 1,
			'servico' => 'Lorem ipsum dolor sit amet'
		),
	);

}
