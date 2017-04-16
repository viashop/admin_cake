<?php
/**
 * ShopProdutoFixture
 *
 */
class ShopProdutoFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'shop_produto';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id_produto' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'id_shop_default' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'nome' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'apelido' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sku' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'custo' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'cheio' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'promocional' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '10,2', 'unsigned' => false),
		'busca_marca' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'marca' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'busca_categoria' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'url_video_youtube' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descricao_completa' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'peso' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '10,3', 'unsigned' => false),
		'altura' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'largura' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'comprimento' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'situacao_em_estoque' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'quantidade' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'situacao_sem_estoque' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id_produto', 'unique' => 1),
			'sh_shop_produto_fk_1_idx' => array('column' => 'id_shop_default', 'unique' => 0),
			'marca' => array('column' => 'marca', 'unique' => 0),
			'ativo' => array('column' => 'ativo', 'unique' => 0)
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
			'id_produto' => 1,
			'id_shop_default' => 1,
			'nome' => 'Lorem ipsum dolor sit amet',
			'apelido' => 'Lorem ipsum dolor sit amet',
			'url' => 'Lorem ipsum dolor sit amet',
			'sku' => 'Lorem ipsum dolor sit amet',
			'custo' => 1,
			'cheio' => 1,
			'promocional' => 1,
			'busca_marca' => 'Lorem ipsum dolor sit amet',
			'marca' => 1,
			'busca_categoria' => 'Lorem ipsum dolor sit amet',
			'url_video_youtube' => 'Lorem ipsum dolor sit amet',
			'descricao_completa' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'title' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'peso' => '',
			'altura' => 1,
			'largura' => 1,
			'comprimento' => 1,
			'situacao_em_estoque' => 1,
			'quantidade' => 1,
			'situacao_sem_estoque' => 1,
			'created' => '2014-07-28 16:21:07',
			'modified' => '2014-07-28 16:21:07'
		),
	);

}
