<?php

App::uses('AppController', 'Controller');

class ShopController extends AppController {

	public $uses = array('Shop', 'ShopDominio');
	private $conditions;

	/**
	 * Obter os dados do shop
	 * @access public
	 * @param String $id_shop
	 * @return string
	 */
	public function getDadosShop()
	{

		try {

			return $this->Shop->find('first', array(

                'fields' => array(
                    'Shop.logo',
                    'Shop.favicon',
                    'Shop.nome_loja',
                	'Shop.email',
                    'ShopDominio.dominio'
                ),

                'conditions' => array(
                    'Shop.id_shop' => ID_SHOP_DEFAULT
                ),

                'joins' => array(
                    array(
                        'table' => 'shop_dominio',
                        'alias' => 'ShopDominio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopDominio.id_shop_default = Shop.id_shop'
                        )
                    )
                )
            ));


		} catch (PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

	/**
	 * Obter os dados do shop
	 * @access public
	 * @param String $id_shop
	 * @return string
	 */
	public function getDadosContatoShop()
	{
		try {

			$this->conditions = array(

				'fields' => array(
					'Shop.loja_tipo',
					'Shop.nome_loja',
					'Shop.loja_nome_responsavel',
					'Shop.loja_razao_social',
					'Shop.loja_cnpj',
					'Shop.loja_cpf',
					'Shop.telefone',
					'Shop.email'
				),
				'conditions' => array(
					'Shop.id_shop' => ID_SHOP_DEFAULT
				)

			);

			return $this->Shop->find('first', $this->conditions);

		} catch (PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

}
