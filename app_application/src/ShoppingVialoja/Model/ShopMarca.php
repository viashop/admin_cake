<?php

App::uses('Model', 'Model');

class ShopMarca extends AppModel {
    public $name = 'ShopMarca';
    public $useTable = 'shop_marca';
    public $primaryKey = 'id_marca';
    public $useDbConfig = 'default';

    public function getIdMarca($id_marca='',$id_shop='')
	{
		try {

            if (empty($id_marca)) {
                throw new LogicException("Erro: O ID da marca é obrigatório.", 1);                
            }

            if (empty($id_shop)) {
                throw new LogicException("Erro: O ID do shop é obrigatório.", 1);                
            }

            $this->conditions = array(
                'fields' => array(
                    'ShopMarca.nome'
                ),
                'conditions' => array(
                    'ShopMarca.id_marca' => $id_marca,
                    'ShopMarca.id_shop_default' => $id_shop
                )
            );
            
            return $this->find('first', $this->conditions);

		} catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

	}
	
}
