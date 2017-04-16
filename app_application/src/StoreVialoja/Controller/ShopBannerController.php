<?php

App::uses('AppController', 'Controller');

class ShopBannerController extends AppController {

	public $uses = array('ShopBanner');
    private $pagina_publicacao;
    private $conditions;

    public function getBanners()
    {

        try {

            if ($this->params['named']['pagina_publicacao'] !== 'todas') {
               $this->pagina_publicacao = $this->params['named']['pagina_publicacao'];
            } else {
               $this->pagina_publicacao = 'todas';
            }

            $this->conditions = array(

                'fields' => array(
                    'ShopBanner.titulo',
                    'ShopBanner.caminho',
                    'ShopBanner.pagina_publicacao',
                    'ShopBanner.link',
                    'ShopBanner.target'
                ),

                'conditions' => array(
                    'ShopBanner.id_shop_default' => ID_SHOP_DEFAULT,
                    'ShopBanner.local_publicacao' => $this->params['named']['local_publicacao'],
                    'ShopBanner.pagina_publicacao' => $this->pagina_publicacao,
                    'ShopBanner.ativo' => 'True'
                ),

                'order' => array('posicao' => 'ASC'),
                'limit' => $this->params['named']['limit']

            );

            return $this->ShopBanner->find('all', $this->conditions );

        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
