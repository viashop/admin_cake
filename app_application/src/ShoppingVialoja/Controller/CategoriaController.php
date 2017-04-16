<?php

App::uses('AppController', 'Controller');

class CategoriaController extends AppController {

    public $uses = array('ShopProdutoCategoria', 'ShopCategoria');

	public function index() {

		self::commons_inc();

        if (isset($this->request->params['pass']['1'])
            && $this->request->params['pass']['1']) {

            $res_produto = self::categoria_produto( $this->request->params['pass']['1'] );
            $this->set(compact('res_produto'));

            $GLOBALS['request'] = $this->request->params['pass']['1'];

			$dados = $this->requestAction(array(
                'controller' => 'ConfiguracaoAtividade',
                'action' => 'getNomeAtividade',
                'id' => (int) $this->request->params['pass']['1']
            ));

            $GLOBALS['ConfiguracaoAtividade']['nome_atividade'] = $dados['ConfiguracaoAtividade']['nome'];

        } else {

            return $this->redirect( '//'. env('HTTP_HOST')  );

        }

		define('INCLUDE_CATEGORIA', true);

	}

    private function commons_inc()
    {

        $GLOBALS['ConfiguracaoAtividade']['res_atividades_option_all'] = $this->requestAction(array(
            'controller' => 'ConfiguracaoAtividade',
            'action' => 'optionAll'
        ));

        $GLOBALS['ConfiguracaoAtividade']['res_atividades_all'] = $this->requestAction(array(
            'controller' => 'ConfiguracaoAtividade',
            'action' => 'atividadeAll'
        ));

        $GLOBALS['BannerShopping']['res_managewidgets_footer_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'getBanner',
            'local_publicacao' => 'managewidgets-footer',
        ));

    }

    private function categoria_produto($id='')
    {

        try {

            $id = intval($id);

            if (isset($id) && is_numeric($id)) {

                if (Tools::getValue('orderby') !=''){

                    $orderby = $Tools::getValue('orderby');
                    $orderway = $Tools::getValue('orderway');

                    if ($orderway == 'asc') {
                        $orderway = 'ASC';
                    } else {
                        $orderway = 'DESC';
                    }

                    if ($orderby == 'preco') {

                        $order = 'ShopProduto.preco_cheio '. $orderway;

                    } elseif ($orderby == 'nome') {

                        $order = 'ShopProduto.nome '. $orderway;

                    } elseif ($orderby == 'quantidade') {

                        $order = 'ShopProduto.quantidade '. $orderway;

                    } elseif ($orderby == 'referencia') {

                        $order = 'ShopProduto.sku '. $orderway;

                    } else {
                        $order = 'rand()';
                    }

                } else {
                    $order = 'rand()';
                }

                $conditions = array(

                    'fields' => array(
                        'ShopProduto.id_produto',
                        'ShopProduto.id_shop_default',
                        'ShopProduto.nome',
                        'ShopProduto.usado',
                        'ShopProduto.preco_promocional',
                        'ShopProduto.preco_cheio',
                        'ShopProdutoImagem.nome_imagem',
                        'Shop.id_shop'
                    ),

                    'conditions' => array(
                        'ShopProduto.parente_id' => 0,
                        'ShopProduto.ativo' => 'True',
                        'ShopProduto.lixo' => 'False',
                        'ShopProduto.nome !=' => '',
                        'ShopDominio.main' => 1,
                        'ShopDominio.ativo' => 1,
                        'ShopProdutoImagem.posicao' => 0,
                        'ShopCategoria.id_atividade' => $id,
                    ),

                    'group' => array('ShopProduto.id_produto'),
                    'order' =>  $order,
                    'limit' => 12,

                    'joins' => array(

                        array(
                            'table' => 'shop_categoria',
                            'alias' => 'ShopCategoria',
                            'type' => 'INNER',
                            'conditions' => array(
                                'ShopCategoria.id_categoria = ShopProdutoCategoria.id_categoria_default'
                            )
                        ),

                        array(
                            'table' => 'shop_produto',
                            'alias' => 'ShopProduto',
                            'type' => 'INNER',
                            'conditions' => array(
                                'ShopProduto.id_produto = ShopProdutoCategoria.id_produto_default'
                            )
                        ),

                        array(
                            'table' => 'shop_dominio',
                            'alias' => 'ShopDominio',
                            'type' => 'INNER',
                            'conditions' => array(
                                'ShopProduto.id_shop_default = ShopDominio.id_shop_default'
                            )
                        ),

                        array(
                            'table' => 'shop',
                            'alias' => 'Shop',
                            'type' => 'INNER',
                            'conditions' => array(
                                'ShopProduto.id_shop_default = Shop.id_shop'
                            )
                        ),

                        array(
                            'table' => 'shop_produto_imagem',
                            'alias' => 'ShopProdutoImagem',
                            'type' => 'INNER',
                            'conditions' => array(
                                'ShopProduto.id_produto = ShopProdutoImagem.id_produto_default'
                            )
                        )

                    ),

                );

                $this->paginate = $conditions;

                 // Roda a consulta, já trazendo os resultados paginados
                return $this->paginate('ShopProdutoCategoria');




            }

        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

}