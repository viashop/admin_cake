<?php

App::uses('Model', 'Model');

class ShopMarca extends AppModel {
	
    public $name = 'ShopMarca';
    public $useTable = 'shop_marca';
    public $primaryKey = 'id_marca';
    public $useDbConfig = 'default';
	
	public function getAll($id_shop='')
	{
		try {

			/**
             *
             * Marca listar
             *
             **/
            $conditions = array(
                'fields' => array(
                    'ShopMarca.id_marca',
                    'ShopMarca.nome',
                    'ShopMarca.logo',
                    'ShopMarca.apelido'
                ),
                'conditions' => array(
                    'ShopMarca.id_shop_default' => $id_shop,
                    'ShopMarca.ativo' => 'True',
                    'ShopMarca.logo !=' => ''
                ),
                'order' => 'rand()',
                'limit' => 18
          
            );
            
            return $this->find('all', $conditions);

		} catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);
            
        }

	}
	
}
