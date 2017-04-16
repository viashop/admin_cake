<?php
App::uses('AppModel', 'Model');
/**
 * ShopProdutoImagemAssociada Model
 *
 */
class ShopProdutoImagemAssociada extends AppModel {

	public $name = 'ShopProdutoImagemAssociada';
	public $useDbConfig = 'default';
	public $useTable = 'shop_produto_imagem_associada';
	public $primaryKey = 'id_imagem_default';

}
