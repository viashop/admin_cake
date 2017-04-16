<?php

App::uses('AppController', 'Controller');

class SearchController extends AppController {

    public $uses = array('ShopProduto');
    public $layout = 'default-store';

	private $limit = 25;
    private $res_lista_produto;

	private $conditions;

    public function result() {

        try {

            define('SEARCH_SHOP_LOJA', true);

            $this->getConfig();

        } catch (Exception $e) {

        }

    }

    private function getConfig()
    {

        $this->requestAction(
            array(
                'controller' => 'Configuracoes',
                'action' => 'init'
            )
        );

    }

	public function index() {


        if ($this->request->is('ajax')) {
            $this->render(false);
            die();
        }

        if (Tools::getValue('ajaxSearch') !='') {

            if (!$this->request->is('ajax')) {
                return false;
            }

            $this->render(false);

            $result = $this->search_produto( Tools::getValue('q') );

            $prod_data = array();

            foreach ($result as $key => $produto) {

                $id_produto = $produto['ShopProduto']['id_produto'];
                $nome_foto = $produto['ShopProdutoImagem']['nome_imagem'];
                $nome = $produto['ShopProduto']['nome'];
                $subdominio_plataforma = $produto['ShopDominio']['subdominio_plataforma'];
                $id_shop_default = $produto['Shop']['id_shop'];

                $image_padrao = CDN .'static/img/imagem-padrao/medium/produto-sem-imagem.gif';

                if (!empty($nome_foto)) {

                    $url_root = sprintf( '%s%d%sproduto%s%d%shome%s%s',
                        CDN_ROOT_UPLOAD,
                        $id_shop_default,
                        DS,
                        DS,
                        $id_produto,
                        DS,
                        DS,
                        $nome_foto
                    );

                    if (!is_file($url_root)) {

                        $url_img = $image_padrao;

                    } else {

                        $url_img = sprintf( '%s%d/produto/%d/cart/%s',
                            CDN_UPLOAD,
                            $id_shop_default,
                            $id_produto,
                            $nome_foto
                        );

                    }

                } else {

                    $url_img = $image_padrao;

                }

                $key = $key+1;

                $produto_link = sprintf('%s/p/%s/%d/', FULL_BASE_URL, Tools::slug($nome), $id_produto );

                $data_from_db = array(
                    'id_product' => sprintf('%d', $id_produto),
                    'pname' => sprintf('%s', Tools::formatList($nome,80)),
                    'cname' => null,
                    'id_image' => sprintf('%s', $produto['ShopProdutoImagem']['id_imagem']),
                    'crewrite' => null,
                    'prewrite' => sprintf('%s', Tools::slug($nome)),
                    'position' => sprintf('%d', $key),
                    'image_link' => sprintf('%s', $url_img),
                    'product_link' => $produto_link
                );

                array_push($prod_data, $data_from_db);

            }

            header('Content-Type: application/json');
            echo (json_encode($prod_data));
            die();

        }


		$this->commons_inc();


        if (Tools::getValue('q') != '' ) {
            # code...
            $result = $this->search_produto( Tools::getValue('q') );

            $this->set('res_produto', $result);

        } else {

            return $this->redirect( FULL_BASE_URL  );

        }

		define('INCLUDE_SEARCH', true);

	}

	/**
     * Buscar Produtos
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $q termo da busca
     * @return string
     */
    public function search_produto()
    {

        try {

            $this->busca = Tools::sanitizeFullText( Tools::getValue('q') );
            $this->set('q', $this->busca);
            $this->busca = str_replace('%', "-1", $this->busca);


            if (Tools::strlen($this->busca) <= 3) {

                /**
                 *
                 * Busca com full text e relevancia
                 *
                 **/
                $this->conditions = array(

                    'fields' => array(

                        'ShopProduto.id_produto',
                        'ShopProduto.id_shop_default',
                        'ShopProduto.tipo',
                        'ShopProduto.ativo',
                        'ShopProduto.usado',
                        'ShopProduto.destaque',
                        'ShopProduto.nome',
                        'ShopProduto.sku',
                        'ShopProduto.ncm',
                        'ShopProduto.preco_sob_consulta',
                        'ShopProduto.preco_custo',
                        'ShopProduto.preco_cheio',
                        'ShopProduto.preco_promocional',
                        'ShopProduto.situacao_em_estoque',
                        'ShopProduto.quantidade',
                        'ShopProduto.reservado',
                        'ShopProdutoImagem.nome_imagem',

                    ),

                    'conditions' =>  " `ShopProduto.nome` LIKE '%{$this->busca}%' AND `ShopProduto.id_shop_default` = '{$this->Session->read('id_shop')}' AND ShopProduto.parente_id = '0' AND ShopProduto.lixo = 'False'",
                    'order'      => array('`ShopProduto.nome`' => 'ASC'),
                    'group' => array('ShopProdutoImagem.id_produto_default'),
                    'limit'      => $this->limit,

                    'joins' => array(

                        array(
                            'table' => 'shop_produto_imagem',
                            'alias' => 'ShopProdutoImagem',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'ShopProduto.id_produto = ShopProdutoImagem.id_produto_default'
                            )
                        ),

                    ),

                    'paramType' => 'querystring'

                );


            } else {

                /**
                 *
                 * Busca com full text e relevancia
                 *
                 **/
                $this->conditions = array(

                    'fields' => array(

                        'ShopProduto.id_produto',
                        'ShopProduto.id_shop_default',
                        'ShopProduto.tipo',
                        'ShopProduto.ativo',
                        'ShopProduto.usado',
                        'ShopProduto.destaque',
                        'ShopProduto.nome',
                        'ShopProduto.sku',
                        'ShopProduto.ncm',
                        'ShopProduto.preco_sob_consulta',
                        'ShopProduto.preco_custo',
                        'ShopProduto.preco_cheio',
                        'ShopProduto.preco_promocional',
                        'ShopProduto.situacao_em_estoque',
                        'ShopProduto.quantidade',
                        'ShopProduto.reservado',
                        'ShopProdutoImagem.nome_imagem',
                        "MATCH (`nome`,`descricao_completa`) AGAINST ('{$this->busca}*' IN BOOLEAN MODE) AS relevancia,  MATCH (`nome`) AGAINST ('{$this->busca}*' IN BOOLEAN MODE) AS titulo_relevancia"

                    ),

                    'conditions' =>  " MATCH (`nome`,`descricao_completa`) AGAINST ('{$this->busca}*' IN BOOLEAN MODE) AND `ShopProduto.id_shop_default` = '{$this->Session->read('id_shop')}' AND ShopProduto.parente_id = '0' AND ShopProduto.lixo = 'False'",
                    'order'      => 'titulo_relevancia DESC, relevancia DESC',
                    'group' => array('ShopProdutoImagem.id_produto_default'),
                    'limit'      => $this->limit,

                    'joins' => array(

                        array(
                            'table' => 'shop_produto_imagem',
                            'alias' => 'ShopProdutoImagem',
                            'type' => 'LEFT',
                            'conditions' => array(
                                'ShopProduto.id_produto = ShopProdutoImagem.id_produto_default'
                            )
                        ),

                    ),

                    'paramType' => 'querystring'

                );

            }

            //Pagina resultado
            $this->paginate = $this->conditions;
            $this->res_lista_produto = $this->paginate('ShopProduto');

            $this->set('res_lista_produto', $this->res_lista_produto);

        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        self::calcula_produto_uso();
        $this->set('title_for_layout', 'Listar produtos');


        $this->configCSRFGuard();

        $this->render('produto_listar');

    }

	public function commons_inc()
    {

        $GLOBALS['res_atividades_option_all'] = $this->requestAction(array(
            'controller' => 'ConfiguracaoAtividade',
            'action' => 'optionAll',
            'cate' => Tools::getValue('cate')
        ));

        $GLOBALS['res_atividades_all'] = $this->requestAction(array(
            'controller' => 'ConfiguracaoAtividade',
            'action' => 'atividadeAll'
        ));

        $GLOBALS['res_managewidgets_footer_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'getBanner',
            'local_publicacao' => 'managewidgets-footer',
        ));

    }

    public function search_produtos($query)
    {

        try {

            $q = Tools::sanitizeFullText($query);

            $q = str_replace('%', "-1", $q);
            $this->set('q', $q);
            $limit = 12;

            die($q);

            if (Tools::getValue('cate') != '') {

                $id_atividade = sprintf("ShopCategoria.id_atividade ='%d'", Tools::getValue('cate'));
                $id_atividade_and = sprintf("AND ShopCategoria.id_atividade = '%d'", Tools::getValue('cate'));

                $join_categoria = array(
                    'table' => 'shop_categoria',
                    'alias' => 'ShopCategoria',
                    'type' => 'INNER',
                    'conditions' => array(
                        'ShopCategoria.id_categoria = ShopProdutoCategoria.id_categoria_default'
                    )
                );

                $join_produto_categoria = array(
                    'table' => 'shop_produto_categoria',
                    'alias' => 'ShopProdutoCategoria',
                    'type' => 'INNER',
                    'conditions' => array(
                        'ShopProduto.id_produto = ShopProdutoCategoria.id_produto_default'
                    )
                );

            } else {
                $id_atividade = null;
                $id_atividade_and = null;
                $join_categoria = null;
                $join_produto_categoria = null;
            }


            if (isset($this->request->query['orderby'])) {

                $orderby = $this->request->query['orderby'];

                if ($this->request->query['orderway'] == 'asc') {
                    $orderway = 'ASC';
                } else {
                    $orderway = 'DESC';
                }

                if ($orderby == 'preco') {

                    $order = 'ShopProduto.preco_cheio ' . $orderway;

                } elseif ($orderby == 'nome') {

                    $order = 'ShopProduto.nome ' . $orderway;

                } elseif ($orderby == 'quantidade') {

                    $order = 'ShopProduto.quantidade ' . $orderway;

                } elseif ($orderby == 'referencia') {

                    $order = 'ShopProduto.sku ' . $orderway;

                } else {
                    $order = 'rand()';
                }

            } else {
                $order = 'titulo_relevancia DESC';
            }

            if (isset($orderby) && $orderby == 'position') {
                $filter_order = 'titulo_relevancia DESC';
            } else {
                $filter_order = $order;
            }

            /**
             *
             * Busca com full text e relevancia
             *
             **/
            $this->conditions = array(

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
                    "MATCH (`nome`) AGAINST ('$q' IN BOOLEAN MODE) AS titulo_relevancia"

                ),

                'conditions' => " MATCH (`nome`) AGAINST ('{$q}*' IN BOOLEAN MODE) AND ShopProduto.parente_id = '0' AND ShopProduto.lixo = 'False' AND ShopDominio.main = '1' AND ShopProduto.nome != '' AND ShopDominio.ativo = '1' AND ShopProdutoImagem.posicao = '0' {$id_atividade_and}",
                'order' => $filter_order,
                'group' => array('ShopProdutoImagem.id_produto_default'),
                'limit' => $limit,

                'joins' => array(

                    $join_produto_categoria,
                    $join_categoria,

                    array(

                        'table' => 'shop_produto_imagem',
                        'alias' => 'ShopProdutoImagem',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopProduto.id_produto = ShopProdutoImagem.id_produto_default'
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

                ),

            );

            $this->paginate = $this->conditions;

            //Pagina resultado
            return $this->paginate('ShopProduto');

        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
