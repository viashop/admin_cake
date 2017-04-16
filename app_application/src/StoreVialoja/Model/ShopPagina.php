<?php

App::uses('Model', 'Model');

class ShopPagina extends AppModel {
    public $name = 'ShopPagina';
    public $useTable = 'shop_pagina';
    public $primaryKey = 'id_pagina';
    public $useDbConfig = 'default';


     public function getAllSitemap() {

		try {

			$conditions = array(
		        
		        'fields' => array(
		        	'ShopPagina.url',
		        ),	          
	            'conditions' => array(
	            	'ShopPagina.ativo' => 'True'
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
