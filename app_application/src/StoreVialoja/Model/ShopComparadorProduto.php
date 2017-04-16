<?php

App::uses('AppModel', 'Model');

class ShopComparadorProduto extends AppModel {

	public $name = 'ShopComparadorProduto';
	public $useDbConfig = 'default';
	public $useTable = 'shop_comparador_produto';

	public function getArrayIdProduto($id_shop='',$id_comparador='') {

		try {

	
			$conditions = array(
				'fields' => array(
					'ShopComparadorProduto.id_produto_default'
				),		                  
	            'conditions' => array(
	            	'ShopComparadorProduto.id_shop_default' => $id_shop,
	            	'ShopComparadorProduto.id_comparador_default' => $id_comparador
	            )
	        );	

	        if ($this->find('count', $conditions) > 0 ) {
            	return $this->find('all', $conditions);
            }  else {
            	return false;
			}

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);
			
		}

	}

}
