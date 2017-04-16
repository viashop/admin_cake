<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class ShopEnderecoController extends AppController {

	public $uses = array('ShopEndereco');

    private $conditions;

	public function enderecoAll()
	{

		try {

			$this->conditions = array(

                'fields' => array(
                    'ShopEndereco.endereco',
                    'ShopEndereco.cep',
                    'ShopEndereco.bairro',
                    'ShopEndereco.numero',
                    'ShopEndereco.complemento',
                    'ShopEndereco.mostrar_endereco',
                    'Cidades.nome',
                    'Estados.nome',
                    'Estados.sigla'
                ),

                'conditions' => array(
					'ShopEndereco.id_shop_default' => ID_SHOP_DEFAULT
				),
                'joins' => array(

                    array('table' => 'estados',
                        'alias' => 'Estados',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Estados.id_estado = ShopEndereco.id_estado',
                        )
                    ),

                    array('table' => 'cidades',
                        'alias' => 'Cidades',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Cidades.id = ShopEndereco.id_cidade',
                        )
                    ),

                )

            );

			$this->result = $this->ShopEndereco->find('first', $this->conditions);

			if(Validate::isNotNull($this->result)) {
				return $this->result;
			} else {
				return null;
			}

		} catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
