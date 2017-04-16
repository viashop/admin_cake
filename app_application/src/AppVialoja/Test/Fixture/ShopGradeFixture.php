<?php
/**
 * ShopGradeFixture
 *
 */
class ShopGradeFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'shop_grade';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_grade' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'id_shop_default' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'nome' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tipo' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'default' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id_grade', 'unique' => 1),
			'nome_Unique' => array('column' => array('id_shop_default', 'nome'), 'unique' => 1),
			'sh_shop_grade_fk_1_idx' => array('column' => 'id_shop_default', 'unique' => 0)
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
			'id_grade' => 1,
			'id_shop_default' => 1,
			'nome' => 'Lorem ipsum dolor sit amet',
			'tipo' => 'Lorem ipsum dolor sit amet',
			'default' => 1,
			'created' => '2015-04-18 23:15:47',
			'modified' => 1429409747
		),
	);

}
