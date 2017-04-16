<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class ShopMarcaController extends AppController {

	public $uses = array('ShopMarca');

    private $conditions;

	public function getIdMarca()
	{
		try {

            if (!Validate::isInt($this->params['named']['id'])) {
                return false;
            }

			/**
             *
             * Marca nome
             *
             **/
            $this->conditions = array(
                'fields' => array(
                    'ShopMarca.id_marca',
                    'ShopMarca.nome',
                    'ShopMarca.apelido',
                    'ShopMarca.logo'
                ),
                'conditions' => array(
                    'ShopMarca.id_marca' => $this->params['named']['id'],
                )
            );

            return $this->ShopMarca->find('first', $this->conditions);

		} catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

	}

}
