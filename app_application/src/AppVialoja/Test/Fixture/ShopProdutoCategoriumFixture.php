<?php
/**
 * ShopProdutoCategoriumFixture
 *
 */
class ShopProdutoCategoriumFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_categoria' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'id_produto' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'posicao' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => true),
		'id_shop_default' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => array('id_categoria', 'id_produto'), 'unique' => 1),
			'id_produto' => array('column' => 'id_produto', 'unique' => 0),
			'sh_shop_produto_categoria_fk_1_idx' => array('column' => 'id_shop_default', 'unique' => 0),
			'sh_shop_produto_categoria_fk_2_idx' => array('column' => 'id_produto', 'unique' => 0)
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
			'id_categoria' => 1,
			'id_produto' => 1,
			'posicao' => 1,
			'id_shop_default' => 1,
			'created' => '2014-07-28 16:24:51'
		),
	);

}
