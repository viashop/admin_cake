<?php

App::uses('AppController', 'Controller');

class ShopDominioController extends AppController {

	public $uses = array('Shop', 'ShopDominio');

	/**
	 * Obter o nome de dominio Main
	 * @access public
	 * @param String $id_shop
	 * @param String $dominio
	 * @return string
	 */

	public function getDadosDominioMain()
	{
		try {

			$conditions = array(
				/*
				'fields' => array(
						'ShopDominio.id_dominio',
						'ShopDominio.main',
						'ShopDominio.dominio'
				),
				*/
				'conditions' => array(

					'ShopDominio.main' => 1,
					'ShopDominio.id_shop_default' => $this->params['named']['id_shop']

				)
			);

			return $this->ShopDominio->find('first', $conditions);

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}
	}


	/**
	 * Obter o nome de dominio Main
	 * @access public
	 * @param String $id_shop
	 * @param String $dominio
	 * @return string
	 */
	public function getDadosSubDominio()
	{
		try {

			$conditions = array(

				'fields' => array(
						'ShopDominio.id_dominio',
						'ShopDominio.dominio',
						'ShopDominio.virtual_uri'
				),

				'conditions' => array(

					'ShopDominio.subdominio_plataforma' => 'True',
					'ShopDominio.id_shop_default' => $this->params['named']['id_shop']

				)
			);

			return $this->ShopDominio->find('all', $conditions);

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}


	public function getIdThemeShop($id_shop)
	{
		try {

			$conditions = array(

				'fields' => array(
						'Shop.id_theme'
				),
				'conditions' => array(
					'Shop.id_shop' => $id_shop
				)
			);

			$dados = $this->Shop->find('first', $conditions);
			return $dados['Shop']['id_theme'];

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}
	}

	/**
	 * Obter o nome de dominio Main
	 * @access public
	 * @param String $id_shop
	 * @param String $dominio
	 * @return string
	 */
	public function getDadosDominioAll()
	{
		try {

			$conditions = array(
				/*
				'fields' => array(
						'ShopDominio.id_dominio',
						'ShopDominio.main',
						'ShopDominio.dominio'
				),
				*/
				'conditions' => array(

					'ShopDominio.subdominio_plataforma' => 'False',
					'ShopDominio.id_shop_default' => $this->params['named']['id_shop']

				),

				'order' => array('ShopDominio.main' => 'DESC')
			);

			return $this->ShopDominio->find('all', $conditions);

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
