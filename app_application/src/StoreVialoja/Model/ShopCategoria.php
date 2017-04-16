<?php

App::uses('Model', 'Model');

class ShopCategoria extends AppModel {
    public $name = 'ShopCategoria';
    public $useTable = 'shop_categoria';
    public $primaryKey = 'id_categoria';
    public $useDbConfig = 'default';


    public function getAllSitemap() {

		try {

			$conditions = array(
		        
		        'fields' => array(
		        	'ShopCategoria.id_categoria',
		        	'ShopCategoria.nome_categoria',
		        	'ShopCategoria.url',
		        ),	          
	            'conditions' => array(
	            	'ShopCategoria.ativa' => 'True'
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
