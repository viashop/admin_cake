<?php
/**
 * ClienteGrupoShopFixture
 *
 */
class ClienteGrupoShopFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'cliente_grupo_shop';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'id_cliente_default' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'id_shop_default' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'id_grupo_default' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'status' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4, 'unsigned' => false),
		'timestamp' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'cliente' => array('column' => array('id_cliente_default', 'id_shop_default'), 'unique' => 1),
			'cl_cliente_grupo_shop_fk_1_idx' => array('column' => 'id_cliente_default', 'unique' => 0),
			'cl_cliente_grupo_shop_fk_2_idx' => array('column' => 'id_grupo_default', 'unique' => 0)
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
			'id' => 1,
			'id_cliente_default' => 1,
			'id_shop_default' => 1,
			'id_grupo_default' => 1,
			'status' => 1,
			'timestamp' => 1410750107
		),
	);

}
