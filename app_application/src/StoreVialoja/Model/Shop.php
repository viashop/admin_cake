<?php

App::uses('Model', 'Model');

class Shop extends AppModel {
    public $name = 'Shop';
    public $useTable = 'shop';
    public $primaryKey = 'id_shop';
    public $useDbConfig = 'default';


    
    /**
     * Retorna o nome e descirção da loja
     * @param  int $id_shop Indentificação da loja
     * @return string
     */
    public function getNomeDescricaoXML($id_shop='')
    {
        try {

            $conditions = array(
                'fields' => array(
                    'Shop.nome_loja',
                    'Shop.descricao'
                ),
                'conditions' => array(
                    'Shop.id_shop' => $id_shop
                )
            );

            return $this->find('first', $conditions);

        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }
}
