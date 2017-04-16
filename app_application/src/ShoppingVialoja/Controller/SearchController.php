<?php

App::uses('AppController', 'Controller');

class SearchController extends AppController {

    public $uses = array('ShopProduto');
	private $limit = 8;

	public function index() {

        if (Tools::getValue('ajaxSearch') !='') {

            //verificar se o pedido e via ajax, exit se não for
            if (!$this->request->is('ajax')) {
				return false;
			}

            $this->render(false);

            $result = self::search_produto( Tools::getValue('q') );

            $prod_data = array();

            foreach ($result as $key => $produto) {

                $id_produto = $produto['ShopProduto']['id_produto'];
                $nome_imagem = $produto['ShopProdutoImagem']['nome_imagem'];
                $nome_categoria = $produto['ShopCategoria']['nome_categoria'];
                $nome = $produto['ShopProduto']['nome'];
                $id_shop_default = $produto['Shop']['id_shop'];

                $image_padrao = CDN .'static/img/imagem-padrao/medium/produto-sem-imagem.gif';

                if (!empty($nome_imagem)) {

                    $url_root = sprintf( '%s%d%sproduto%s%d%shome%s%s',
                        CDN_ROOT_UPLOAD,
                        $id_shop_default,
                        DS,
                        DS,
                        $id_produto,
                        DS,
                        DS,
                        $nome_imagem
                    );

                    if (!is_file($url_root)) {

                        $url_img = $image_padrao;

                    } else {

                        $url_img = sprintf( '%s%d/produto/%d/cart/%s',
                            CDN_UPLOAD,
                            $id_shop_default,
                            $id_produto,
                            $nome_imagem
                        );

                    }

                } else {

                    $url_img = $image_padrao;

                }


                //$this->oferta = Validate::isValueBigger($this->preco_cheio, $this->preco_promocional);

                $url_produto_loja = sprintf('%s/p/%s/%s/%d/', FULL_BASE_URL, Tools::slug($nome_categoria),Tools::slug($nome), $id_produto  );

                $key = $key + 1;

                $data_from_db = array(
                    'id_product' => sprintf('%d', $id_produto),
                    'pname' => sprintf('%s', Tools::formatList($nome,80)),
                    'cname' => null,
                    'id_image' => sprintf('%s', $produto['ShopProdutoImagem']['id_imagem']),
                    'crewrite' => null,
                    'prewrite' => sprintf('%s', Tools::slug($nome)),
                    'position' => sprintf('%d', $key),
                    'image_link' => sprintf('%s', $url_img),
                    'product_link' => $url_produto_loja
                );

                array_push($prod_data, $data_from_db);

            }

            header('Content-Type: application/json');
            echo (json_encode($prod_data));
            die();

        }

		self::commons_inc();

        if (Tools::getValue('q') != '' ) {

			$res_produto = self::search_produto( Tools::getValue('q') );

            $this->set(compact('res_produto'));

        } else {

            return $this->redirect( '//'. env('HTTP_HOST')  );

        }

		define('INCLUDE_SEARCH', true);

	}

    private function search_produto($query)
    {

        try {

            $q = Tools::sanitizeFullText($query);
            $q = str_replace('%', "-1", $q);
            $this->set('q', $q);


            $id_atividade = null;
            $id_atividade_and = null;

            if (Tools::getValue('cate') !='') {

                $id_atividade = sprintf("ShopCategoria.id_atividade ='%d'", Tools::getValue('cate') );
                $id_atividade_and = sprintf("AND ShopCategoria.id_atividade = '%d'", Tools::getValue('cate') );

            }

            if (Tools::getValue('orderby') != ''){

                $orderby = Tools::getValue('orderby');
                $orderway = Tools::getValue('orderway');

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
                    $order = 'ShopProduto.peso '. $orderway;
                } else {
                    $order = 'rand()';
                }

            } else {

                if (Tools::strlen($q) <= 3) {
                    $order = 'ShopProduto.nome ASC';
                } else {
                    $order = 'titulo_relevancia DESC';
                }

            }

			if (isset($orderby) && $orderby == 'position') {

                if (Tools::strlen($q) <= 3) {
                    $filter_order = 'ShopProduto.nome ASC';
                } else {
                    $filter_order = 'titulo_relevancia DESC';
                }

			} else {
				$filter_order = $order;
			}

            $joins = array(

                array(

                    'table' => 'shop',
                    'alias' => 'Shop',
                    'type' => 'INNER',
                    'conditions' => array(
                        'ShopProduto.id_shop_default = Shop.id_shop'
                    )
                ),

                array(

                    'table' => 'shop_dominio',
                    'alias' => 'ShopDominio',
                    'type' => 'INNER',
                    'conditions' => array(
                        'ShopDominio.id_shop_default = Shop.id_shop'
                    )
                ),

                array(
                    'table' => 'shop_produto_categoria',
                    'alias' => 'ShopProdutoCategoria',
                    'type' => 'INNER',
                    'conditions' => array(
                        'ShopProduto.id_produto = ShopProdutoCategoria.id_produto_default'
                    )
                ),

                array(
                    'table' => 'shop_categoria',
                    'alias' => 'ShopCategoria',
                    'type' => 'INNER',
                    'conditions' => array(
                        'ShopCategoria.id_categoria = ShopProdutoCategoria.id_categoria_default'
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

            );

            if (Tools::strlen($q) <= 3) {


                /**
                 *
                 * Busca com full text e relevancia
                 *
                 **/
                $conditions = array(

                    'fields' => array(

                        'ShopProduto.id_produto',
                        'ShopProduto.id_shop_default',
                        'ShopProduto.nome',
                        'ShopProduto.usado',
                        'ShopProduto.preco_promocional',
                        'ShopProduto.preco_cheio',
                        'ShopProdutoImagem.nome_imagem',
                        'ShopProdutoImagem.id_imagem',
                        'Shop.id_shop',
                        'ShopCategoria.nome_categoria',
                        'ShopCategoria.id_atividade',
                        'ShopProdutoCategoria.id',
						'ShopCategoria.nome_categoria'

                    ),

                    //AND ShopCategoria.id_atividade > 0

                    'conditions' =>  " `ShopProduto.nome` LIKE '%{$q}%' AND ShopProduto.parente_id = 0 AND ShopProduto.lixo = 'False' AND ShopDominio.main = 1 AND ShopProduto.nome != '' AND ShopDominio.ativo = 1 AND ShopProdutoImagem.posicao = 0 {$id_atividade_and} AND ShopCategoria.id_atividade != 0 ",
                    'order'      => $filter_order,
                    'group' => array('ShopProdutoImagem.id_produto_default'),
                    'joins' => $joins,
                    'paramType' => 'querystring'

                );

            } else {

    			/**
    			 *
    			 * Busca com full text e relevancia
    			 *
    			 **/
    			$conditions = array(

    				'fields' => array(

    					'ShopProduto.id_produto',
    					'ShopProduto.id_shop_default',
    					'ShopProduto.nome',
    					'ShopProduto.usado',
    					'ShopProduto.preco_promocional',
    					'ShopProduto.preco_cheio',
    					'ShopProdutoImagem.nome_imagem',
    					'ShopProdutoImagem.id_imagem',
    					'Shop.id_shop',
						'ShopCategoria.nome_categoria',
    					"MATCH (`nome`) AGAINST ('{$q}*' IN BOOLEAN MODE) AS titulo_relevancia"

    				),

    				'conditions' => " MATCH (`nome`) AGAINST ('{$q}*' IN BOOLEAN MODE) AND ShopCategoria.id_atividade != '0' AND ShopProduto.parente_id = '0' AND ShopProduto.lixo = 'False' AND ShopDominio.main = '1' AND ShopProduto.nome != '' AND ShopDominio.ativo = 1 AND ShopProdutoImagem.posicao = 0 {$id_atividade_and}",
    				'order'      => $filter_order,
    				'group' => array('ShopProdutoImagem.id_produto_default'),
    				'limit'      => $this->limit,
    				'joins' => $joins,
                    'paramType' => 'querystring'

    			);

            }

			$this->paginate = $conditions;
			return $this->paginate('ShopProduto');

        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

	private function commons_inc()
    {

        $GLOBALS['ConfiguracaoAtividade']['res_atividades_option_all'] = $this->requestAction(array(
            'controller' => 'ConfiguracaoAtividade',
            'action' => 'optionAll',
            'cate' => Tools::getValue('cate')
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

}