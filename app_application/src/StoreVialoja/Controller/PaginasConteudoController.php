<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class PaginasConteudoController extends AppController {

	public $uses = array('ShopPagina');

	private $conditions;

    public function getLinksPaginasHeader() {

        try {

            $this->conditions = array(
                'fields' => array(
                    'ShopPagina.titulo',
                    'ShopPagina.url'
                ),
                'conditions' => array(
                    'ShopPagina.id_shop_default' => ID_SHOP_DEFAULT,
                    'ShopPagina.ativo' => 'True'
                ),
                'order' => array(
                    'ShopPagina.posicao' => 'ASC'
                )
            );

            $GLOBALS['res_liks_paginas_header'] = $this->ShopPagina->find('all', $this->conditions);

        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

	public function getLinksPaginasFooter() {

		try {

            $this->conditions = array(
                'fields' => array(
                    'ShopPagina.titulo',
                    'ShopPagina.url'
                ),
                'conditions' => array(
                    'ShopPagina.id_shop_default' => ID_SHOP_DEFAULT,
                    'ShopPagina.ativo' => 'True'
                ),
                'order' => array(
                    'ShopPagina.posicao' => 'ASC'
                ),
                'limit' => 10
            );

            $GLOBALS['res_liks_paginas_footer'] = $this->ShopPagina->find('all', $this->conditions);

        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

    public function getLinkId() {

        try {

            if ( !Validate::isUrl( $this->params['named']['id']) ) {
                throw new Exception("Valor obrigatório: Informe a url ", 1);
            }

            $this->conditions = array(
                'fields' => array(
                    'ShopPagina.id_pagina',
                    'ShopPagina.titulo',
                    'ShopPagina.conteudo'
                ),
                'conditions' => array(
                    'ShopPagina.id_shop_default' => ID_SHOP_DEFAULT,
                    'ShopPagina.url' => Tools::clean( $this->params['named']['id'] )
                ),
                'limit' => 1
            );

            return $this->ShopPagina->find('first', $this->conditions);

        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}