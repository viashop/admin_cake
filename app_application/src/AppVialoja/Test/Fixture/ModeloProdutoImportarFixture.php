<?php
/**
 * ModeloProdutoImportarFixture
 *
 */
class ModeloProdutoImportarFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'modelo_produto_importar';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'sku' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sku_do_produto_pai' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ativo' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'condicao' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'nome_produto' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'descricao' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'disponibilidade_quando_nao_gerenciar_estoque' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'gerenciar_estoque' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'quantidade' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'disponibilidade_dos_produtos_em_estoque' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'disponibilidade_quando_acabar_produtos_em_estoque' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'preco_custo' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'preco_venda' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'preco_promocional' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'categoria_nivel_1' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'categoria_nivel_2' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'categoria_nivel_3' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'marca' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'peso_kg' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'altura_cm' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'largura_cm' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'profundidade_cm' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'link_para_a_foto_principal' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'link_para_foto_adicional_1' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'link_para_foto_adicional_2' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'link_para_foto_adicional_3' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'url_antiga_do_produto' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'link_do_video_no_youtube' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tamanho_de_tenis' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'produto_com_uma_cor' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tamanho_de_capacete' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tamanho_de_calca' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'produto_com_duas_cores' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'voltagem' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tamanho_de_camisa_camiseta' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'tamanho_de_anel_alianca' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'genero' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'sku' => 'Lorem ipsum dolor sit amet',
			'sku_do_produto_pai' => 'Lorem ipsum dolor sit amet',
			'ativo' => 'Lorem ipsum dolor sit amet',
			'condicao' => 'Lorem ipsum dolor sit amet',
			'nome_produto' => 'Lorem ipsum dolor sit amet',
			'descricao' => 'Lorem ipsum dolor sit amet',
			'disponibilidade_quando_nao_gerenciar_estoque' => 'Lorem ipsum dolor sit amet',
			'gerenciar_estoque' => 'Lorem ipsum dolor sit amet',
			'quantidade' => 'Lorem ipsum dolor sit amet',
			'disponibilidade_dos_produtos_em_estoque' => 'Lorem ipsum dolor sit amet',
			'disponibilidade_quando_acabar_produtos_em_estoque' => 'Lorem ipsum dolor sit amet',
			'preco_custo' => 'Lorem ipsum dolor sit amet',
			'preco_venda' => 'Lorem ipsum dolor sit amet',
			'preco_promocional' => 'Lorem ipsum dolor sit amet',
			'categoria_nivel_1' => 'Lorem ipsum dolor sit amet',
			'categoria_nivel_2' => 'Lorem ipsum dolor sit amet',
			'categoria_nivel_3' => 'Lorem ipsum dolor sit amet',
			'marca' => 'Lorem ipsum dolor sit amet',
			'peso_kg' => 'Lorem ipsum dolor sit amet',
			'altura_cm' => 'Lorem ipsum dolor sit amet',
			'largura_cm' => 'Lorem ipsum dolor sit amet',
			'profundidade_cm' => 'Lorem ipsum dolor sit amet',
			'link_para_a_foto_principal' => 'Lorem ipsum dolor sit amet',
			'link_para_foto_adicional_1' => 'Lorem ipsum dolor sit amet',
			'link_para_foto_adicional_2' => 'Lorem ipsum dolor sit amet',
			'link_para_foto_adicional_3' => 'Lorem ipsum dolor sit amet',
			'url_antiga_do_produto' => 'Lorem ipsum dolor sit amet',
			'link_do_video_no_youtube' => 'Lorem ipsum dolor sit amet',
			'tamanho_de_tenis' => 'Lorem ipsum dolor sit amet',
			'produto_com_uma_cor' => 'Lorem ipsum dolor sit amet',
			'tamanho_de_capacete' => 'Lorem ipsum dolor sit amet',
			'tamanho_de_calca' => 'Lorem ipsum dolor sit amet',
			'produto_com_duas_cores' => 'Lorem ipsum dolor sit amet',
			'voltagem' => 'Lorem ipsum dolor sit amet',
			'tamanho_de_camisa_camiseta' => 'Lorem ipsum dolor sit amet',
			'tamanho_de_anel_alianca' => 'Lorem ipsum dolor sit amet',
			'genero' => 'Lorem ipsum dolor sit amet'
		),
	);

}
