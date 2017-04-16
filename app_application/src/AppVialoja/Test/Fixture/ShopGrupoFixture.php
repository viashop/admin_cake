<?php
/**
 * ClienteShopGrupoFixture
 *
 */
class ClienteShopGrupoFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'shop_grupo';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_grupo' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'id_shop_default' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'nome' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id_grupo', 'unique' => 1),
			'nome' => array('column' => array('id_shop_default', 'nome'), 'unique' => 1),
			'cl_shop_grupo_fk_1_idx' => array('column' => 'id_shop_default', 'unique' => 0)
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
			'id_grupo' => 1,
			'id_shop_default' => 1,
			'nome' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-09-15 00:01:05',
			'modified' => 1410750065
		),
	);

}
