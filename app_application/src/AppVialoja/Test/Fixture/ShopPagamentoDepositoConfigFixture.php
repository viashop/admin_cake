<?php
/**
 * ShopPagamentoDepositoConfigFixture
 *
 */
class ShopPagamentoDepositoConfigFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'shop_pagamento_deposito_config';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'id_shop_default' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'id_pagamento_deposito_default' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'numero_banco_default' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6, 'unsigned' => false),
		'agencia' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'numero_conta' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'poupanca' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'cpf_cnpj' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'favorecido' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'sh_shop_pagamento_deposito_config_fk_1_idx' => array('column' => 'id_pagamento_deposito_default', 'unique' => 0),
			'id_shop_default' => array('column' => 'id_shop_default', 'unique' => 0)
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
			'id_shop_default' => 1,
			'id_pagamento_deposito_default' => 1,
			'numero_banco_default' => 1,
			'agencia' => 'Lorem ipsum dolor sit amet',
			'numero_conta' => 'Lorem ipsum dolor sit amet',
			'poupanca' => 'Lorem ipsum dolor sit amet',
			'cpf_cnpj' => 'Lorem ipsum dolor sit amet',
			'favorecido' => 'Lorem ipsum dolor sit amet',
			'created' => '2015-04-02 15:27:48',
			'modified' => 1427999268
		),
	);

}
