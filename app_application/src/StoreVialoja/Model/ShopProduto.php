<?php
App::uses('AppModel', 'Model');
/**
 * ShopProduto Model
 *
 */
class ShopProduto extends AppModel {

	public $name = 'ShopProduto';
	public $useDbConfig = 'default';
	public $useTable = 'shop_produto';
	public $primaryKey = 'id_produto';

}
