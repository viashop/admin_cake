<?php

App::uses('AppModel', 'Model');

class ShopComparadorXml extends AppModel {

	public $name = 'ShopComparadorXml';
	public $useDbConfig = 'default';
	public $useTable = 'shop_comparador_xml';

	public function getIdToken($id_shop='',$token='', $nome='') {

		try {

			$conditions = array(
				'fields' => array(
					'ShopComparadorXml.id_comparador_default',
					'ShopComparadorXml.todos_os_produtos'
				),		                  
	            'conditions' => array(
	            	'ShopComparadorXml.id_shop_default' => $id_shop,
	            	'ShopComparadorXml.token' => $token,
	            	'ShopComparadorXml.nome' => $nome
	            )
	        );	

	        if ($this->find('count', $conditions) > 0 ) {
            	return $this->find('first', $conditions);
            }  else {
            	return false;
			}

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);
			
		}

	}

}
