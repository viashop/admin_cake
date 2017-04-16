<?php

use Lib\Tools;
use Lib\Validate;
use Respect\Validation\Validator as v;
use CSRF\CSRFGuard;
use WideImage\WideImage;

class CatalogoController extends AppController
{

    public $uses = array(
        'ShopMarca',
        'ShopDominio',
        'ShopAtividade',
        'ShopGradeVariacao',
        'ShopGrade',
        'ShopCategoria',
        'ShopUrlUso',
        'ShopProdutoImagem',
        'ShopProdutoGrade',
        'ShopProduto',
        'ShopProdutoCategoria',
        'PlanoShop',
        'Shop',
        'ShopProdutoVariacao',
        'ShopProdutoImagemAssociada'
    );

    public $components = array('Paginator');

    private $sku;
    private $parente_id;
    private $id_produto, $id_produto_up;
    private $id_imagem;
    private $url;
    private $logo;
    private $posicao;
    private $posicoes;
    private $nome;
    private $res_marca;
    private $cat;
    private $categoria_nome = array();
    private $res_categoria, $res_categoria_sec_all;
    private $marcas, $marca;
    private $id_atividade = null;
    private $img_data;
    private $mime;
    private $finfo;
    private $imagem_info;
    private $thickbox;
    private $large;
    private $home;
    private $medium;
    private $small;
    private $cart;
    private $limit = 25;
    private $json = array();
    private $res_variacao;
    private $datasource;

    public function produtoCkeditor()
    {


    }

    /**
     * Cadastrar Produto
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function produtoCriar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopProduto->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/
                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                }

                $this->sku = Tools::clean(Tools::cleanSKU(Tools::getValue('sku')));

                if (!v::notEmpty()->validate($this->sku)) {
                    $this->sku = Tools::tokenGen();
                }

                $conditions = array(
                    'conditions' => array(
                        'ShopProduto.sku' => $this->sku,
                        'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                    )
                );

                $total_sku = $this->ShopProduto->find('count', $conditions);

                if ($total_sku > 0) {
                    $this->sku = Tools::tokenGen();
                }

                $this->id_produto = self::enviaDadosProdutoViaRequestAction();
                $result = self::adicionaGradeAoProduto($this->id_produto);
                self::adicionaCategoriaAoProduto($this->id_produto);

                if ($total_sku > 0) {
                    throw new \Exception\VialojaOverflowException('Um produto com o código inserido já existe. Substituído por ' . $this->sku);
                } else {
                    $this->setMsgAlertSuccess('Produto criado com sucesso.');
                }

                if ($result === 'ERROR_COR_DUPLICADA') {
                    throw new \InvalidArgumentException('Escolha apenas 1 grade do tipo Cor', E_USER_WARNING);
                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\Exception\VialojaOverflowException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\Exception $e) {

                $this->setMsgAlertError($e->getMessage());

            } finally {

                return $this->redirect(
                    array(
                        'controller' => $this->request->controller,
                        'produto',
                        'editar',
                        $this->id_produto
                    )
                );

            }

        }

        $this->Session->write('validar_base_url', 'produto');

        /**
         *
         * Lista categoria Option
         *
         **/
        $option = $this->requestAction(
            array(
                'controller' => 'ShopCategoria',
                'action' => 'categoriaListaOption'
            )
        );

        $this->set(compact('option'));

        /** Marca listar **/
        if ($this->ShopMarca instanceof ShopMarca) {

            $res_marcas = $this->ShopMarca->setIdShop($this->Session->read('id_shop'))->getAllMarcas();
            $this->set(compact('res_marcas'));

        }

        $categoria_checkbox = $this->requestAction(
            array(
                'controller' => 'ShopCategoria',
                'action' => 'categoriaCheckboxProduto'
            )
        );

        $this->set(compact('categoria_checkbox'));

        $this->set('res_grade', self::result_grade_all());
        $this->set('url_shop', self::getDominio());

        /**
         *
         * Get o último produto
         *
         **/
        $result = $this->ShopProduto->getUltimoID();
        $this->set('proximo_id', $result + 1);


        $this->configCSRFGuard();

        $this->set('title_for_layout', 'Criar produto');

    }

    /**
     * Add dados do Produto
     * @access public
     * @param String $envio_submit de produto
     */
    private function enviaDadosProdutoViaRequestAction($envio_submit = null)
    {
        return $this->requestAction(
            array(
                'controller' => 'ShopProduto',
                'action' => 'adicionarDadosProduto',
                'envio_submit' => $envio_submit
            )
        );

    }

    /**
     * Add Marca ao Produto
     * @access public
     * @param String $id_produto de produto
     */
    private function adicionaGradeAoProduto($id_produto = null)
    {

        try {

            if (isset($id_produto) && is_numeric($id_produto)) {

                /**
                 *
                 * Add grade
                 *
                 **/
                if (isset($this->request->data['grade']) && is_array($this->request->data['grade'])) {

                    /**
                     *
                     * Remove grade
                     *
                     **/
                    $this->ShopProdutoGrade->deleteAll(array(
                        'id_produto_default' => $id_produto
                    ));

                    foreach ($this->request->data['grade'] as $key => $grade_id) {

                        /**
                         *
                         * Verifica se escolheu mais de uma cor
                         *
                         **/
                        if ($grade_id == 2) {
                            $grade_cor_2 = true;
                        }

                        if ($grade_id == 3) {
                            $grade_cor_3 = true;
                        }

                    }

                    if (isset($grade_cor_2) && isset($grade_cor_3)) {
                        return 'ERROR_COR_DUPLICADA';
                    }

                    foreach ($this->request->data['grade'] as $grade_id) {

                        $get_id = $this->ShopProdutoGrade->addGrade($grade_id, $id_produto, true);

                    }

                    if (isset($get_id) && $get_id > 0) {
                        return true;
                    }

                }

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    /**
     * Add Categorias Produto
     * @param null $id_produto
     * @return mixed
     */
    private function adicionaCategoriaAoProduto($id_produto = null)
    {

        return $this->requestAction(
            array(
                'controller' => 'ShopProdutoCategoria',
                'action' => 'adicionarCategoriaProduto',
                'id_produto' => $id_produto
            )
        );

    }

    /**
     * Retorna todos os dados da grade
     * @return array
     */
    private function result_grade_all()
    {
        return $this->ShopGrade->getGradeAll($this->Session->read('id_shop'));
    }

    /**
     * getDadosDominio
     * return String
     */
    private function getDominio()
    {
        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }
        return $this->ShopDominio->getDominioPrincipal($this->Shop);
    }

    /**
     * Buscar Produtos
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $q termo da busca
     *
     */
    public function produtoBuscar()
    {

        try {

            $busca = Tools::sanitizeFullText(Tools::getValue('q'));
            $this->set('q', $busca);
            $busca = str_replace('%', "-1", $busca);

            $filter_conditions = '';
            $filtro = Tools::getValue('filtro');

            if ($filtro != '') {

                if ($filtro == 'ativo') {
                    $filter_conditions = " AND ShopProduto.ativo = 'True'";
                } elseif ($filtro == 'inativo') {
                    $filter_conditions = " AND ShopProduto.ativo = 'False'";
                }

            }

            $default = false;

            switch (Tools::getValue('listagem')):

                case 'ultimos_produtos':

                    $filter_order = array(
                        'ShopProduto.created' => 'DESC'
                    );
                    break;

                case 'destaque':

                    /**
                     *
                     * Filtra por destaques
                     *
                     **/

                    $filter_order = array(
                        'ShopProduto.nome' => 'ASC'
                    );

                    break;

                case 'mais_vendidos':

                    $filter_order = array(
                        'ShopProduto.total_vendido' => 'DESC'
                    );
                    break;

                default:

                    $filter_order = array(
                        'ShopProduto.nome' => 'ASC'
                    );

                    $default = true;

            endswitch;


            if (isset($default) && $default === true) {
                $filter_order = 'titulo_relevancia DESC';
            }


            if (Tools::strlen($busca) <= 3) {

                /**
                 *
                 * Busca com like
                 *
                 **/
                $conditions = array(

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
                        'ShopProduto.gerenciado',
                        'ShopProdutoImagem.nome_imagem',

                    ),

                    'conditions' => " `ShopProduto.nome` LIKE '%{$busca}%' AND `ShopProduto.id_shop_default` = '{$this->Session->read('id_shop')}' AND ShopProduto.parente_id = '0' AND ShopProduto.lixo = 'False' {$filter_conditions}",
                    'order' => array('`ShopProduto.nome`' => 'ASC'),
                    'group' => array('ShopProdutoImagem.id_produto_default'),
                    'limit' => $this->limit,

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


                if (v::url()->contains('/p/')->validate($busca)) {

                    $url = parse_url($busca);
                    $busca_explode = explode('/', $url['path']);
                    $busca = trim($busca_explode[2]);

                }

                /**
                 *
                 * Busca com full text e relevancia
                 *
                 **/
                $conditions = array(

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
                        'ShopProduto.gerenciado',
                        'ShopProdutoImagem.nome_imagem',
                        "MATCH (nome, descricao_completa, url, sku) AGAINST ('{$busca}*' IN BOOLEAN MODE) AS titulo_relevancia"

                    ),

                    'conditions' => " MATCH (nome, descricao_completa, url, sku) AGAINST ('{$busca}*'
                    IN BOOLEAN MODE) AND `ShopProduto.id_shop_default` = '{$this->Session->read('id_shop')}'
                    AND ShopProduto.parente_id = '0' AND ShopProduto.lixo = 'False' {$filter_conditions}",
                    'order' => $filter_order,
                    'group' => array('ShopProdutoImagem.id_produto_default'),
                    'limit' => $this->limit,

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

            /**
             * Roda a consulta, já trazendo os resultados paginados
             */
            $this->paginate = $conditions;
            $res_lista_produto = $this->paginate('ShopProduto');
            $this->set(compact('res_lista_produto'));


        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        self::calcula_produto_uso();
        $this->set('title_for_layout', 'Listar produtos');


        $this->configCSRFGuard();

        $this->render('produto_listar');

    }

    /**
     * Calcula o Total de produto em uso
     */
    private function calcula_produto_uso($fnc_private = null)
    {

        try {

            if ($this->Shop instanceof Shop) {
                $this->Shop->setIdShop($this->Session->read('id_shop'));
            }

            $total_produto_plano = $this->PlanoShop->getTotalProduto($this->Session->read('id_shop'));
            $total_produto_uso = $this->ShopProduto->totalProdutoUso($this->Shop);

            if ($total_produto_plano == 'ilimitado') {
                $this->set('produto_ilimitado', true);
                $porcentagem_uso = 0;
            } else {
                $this->set('produto_ilimitado', false);
                $porcentagem_uso = Tools::percentageUse($total_produto_uso, $total_produto_plano);
            }

            if (isset($fnc) && $fnc_private == 'produtoImportar') {

                if ($total_produto_plano == 'ilimitado') {
                    $this->Session->write('limite_produto_importacao', $total_produto_plano);

                } else {

                    $total_liberado = (int)$total_produto_plano - $total_produto_uso;
                    $this->set(compact('total_liberado'));
                    $this->Session->write('limite_produto_importacao', $total_liberado);

                }

            } else {

                $total_liberado = $total_produto_uso;
                $this->set(compact('total_liberado'));

                if ($this->Session->read('total_produto_excluido')) {
                    $this->set('flash_produto_excluido', $this->Session->read('total_produto_excluido'));
                    $this->Session->delete('total_produto_excluido');
                }

                $this->set(compact('total_produto_uso', 'total_produto_plano', 'porcentagem_uso'));

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }


    /**
     * Lista os Produtos da Shop
     * @access public
     * @param String $id_shop
     *
     */
    public function produtoListar()
    {

        try {

            $conditions = array(

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
                    'ShopProduto.gerenciado',
                    'ShopProduto.quantidade',
                    'ShopProduto.reservado',
                    'ShopProdutoImagem.nome_imagem',
                    'ShopCategoria.nome_categoria',

                ),

                'conditions' => array(
                    'ShopProduto.parente_id' => 0,
                    'ShopProduto.lixo' => 'False',
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                ),

                'order' => array(
                    'ShopProduto.modified' => 'DESC'
                ),

                'group' => array(
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
                    'ShopProduto.gerenciado',
                    'ShopProduto.quantidade',
                    'ShopProduto.reservado',
                    'ShopProdutoImagem.nome_imagem',
                    'ShopCategoria.nome_categoria',                    
                    ),
                'limit' => $this->limit,

                'joins' => array(

                    array(
                        'table' => 'shop_produto_imagem',
                        'alias' => 'ShopProdutoImagem',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopProduto.id_produto = ShopProdutoImagem.id_produto_default',
                            'ShopProdutoImagem.posicao' => 0
                        )
                    ),

                    array(
                        'table' => 'shop_produto_categoria',
                        'alias' => 'ShopProdutoCategoria',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopProduto.id_produto = ShopProdutoCategoria.id_produto_default',
                        )
                    ),

                    array(
                        'table' => 'shop_categoria',
                        'alias' => 'ShopCategoria',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopCategoria.id_categoria = ShopProdutoCategoria.id_categoria_default',
                        )
                    ),

                ),

                'paramType' => 'querystring'
            );


            /**
             * Roda a consulta, já trazendo os resultados paginados
             */

            $this->paginate = $conditions;
            $res_lista_produto = $this->paginate('ShopProduto');
            $this->set(compact('res_lista_produto'));

            self::calcula_produto_uso();

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->set('title_for_layout', 'Listar produtos');


        $this->configCSRFGuard();

    }

    /**
     * Edita dados do Produto
     * @access public
     * @param String $id_produto de produto
     *
     */
    public function produtoEditar()
    {

        self::postProdutoEditar();

        try {

            if (empty($this->request->params['pass']['2'])) {
                throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
            }

            if (!is_numeric($this->request->params['pass']['2'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->Session->write('validar_base_url', 'produto');

            /**
             *
             * Total de produto Ativo
             *
             **/
            $conditions = array(

                /*
                'fields' => array(
                    'ShopProduto.id_produto'
                ),
                */
                'conditions' => array(
                    'ShopProduto.parente_id' => 0,
                    'ShopProduto.id_produto' => $this->request->params['pass']['2'],
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopProduto->find('count', $conditions) <= 0) {

                $this->setMsgAlertInfo('Nenhum produto foi encontrado!');
                self::redirecionaPaginaProduto('listar');

            }

            $produto = $this->ShopProduto->find('first', $conditions);
            $this->set(compact('produto'));
            define('ID_PRODUTO_DEFAULT', intval($this->request->params['pass']['2']));

            /**
             *
             * Join de produtos filhos
             *
             **/
            $res_produto_filho = $this->ShopProduto->find('all', array(

                'fields' => array(

                    'ShopProduto.id_produto',
                    'ShopProduto.ativo',
                    'ShopProduto.sku',
                    'ShopProduto.preco_sob_consulta',
                    'ShopProduto.preco_custo',
                    'ShopProduto.preco_cheio',
                    'ShopProduto.preco_promocional',
                    'ShopProduto.peso',
                    'ShopProduto.altura',
                    'ShopProduto.largura',
                    'ShopProduto.comprimento',
                    'ShopProduto.gerenciado',
                    'ShopProduto.situacao_em_estoque',
                    'ShopProduto.quantidade',
                    'ShopProduto.reservado',
                    'ShopProduto.situacao_sem_estoque',
                    'ShopProdutoVariacao.*',
                    'ShopGradeVariacao.*'
                ),
                'conditions' => array(
                    'ShopProduto.parente_id' => $this->request->params['pass']['2'],
                ),

                'group' => array('ShopProdutoVariacao.id_produto_default'), //fields to GROUP BY

                'joins' => array(
                    array('table' => 'shop_produto_variacao',
                        'alias' => 'ShopProdutoVariacao',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopProduto.id_produto = ShopProdutoVariacao.id_produto_default',
                        )
                    ),
                    array('table' => 'shop_grade_variacao',
                        'alias' => 'ShopGradeVariacao',
                        'type' => 'RIGHT',
                        'conditions' => array(
                            'ShopProdutoVariacao.id_grade_variacao_default = ShopGradeVariacao.id_variacao',
                        )
                    ),

                )

            ));

            $this->set(compact('res_produto_filho'));

            //Verifica images quebradas e Deleta o ID e o path da images
            $this->requestAction(
                array(
                    'controller' => 'ShopProdutoImagem',
                    'action' => 'verificaImagesQuebradas',
                    'id_produto' => $this->request->params['pass']['2']
                )
            );

            /**
             *
             * Recupera as imagens do produto
             *
             **/

            $conditions = array(

                /*
                'fields' => array(
                    'ShopProduto.id_produto'
                ),
                */

                'conditions' => array(
                    'ShopProdutoImagem.id_produto_default' => $this->request->params['pass']['2']
                ),
                'order' => array('ShopProdutoImagem.posicao' => 'ASC')
            );

            $res_produto_imagem = $this->ShopProdutoImagem->find('all', $conditions);
            $this->set(compact('res_produto_imagem'));

            /** Marca listar **/
            if ($this->ShopMarca instanceof ShopMarca) {

                $res_marcas = $this->ShopMarca->setIdShop($this->Session->read('id_shop'))->getAllMarcas();
                $this->set(compact('res_marcas'));

            }

            /**
             *
             * Lista as categorias produto
             *
             **/
            $categoria_checkbox = $this->requestAction(
                array(
                    'controller' => 'ShopCategoria',
                    'action' => 'categoriaCheckboxProduto',
                    'id_produto' => $this->request->params['pass']['2']
                )
            );

            $this->set('res_grade', self::result_grade_all());
            $this->set('url_shop', self::getDominio());

            $conditions = array(

                'fields' => array(
                    'ShopProdutoCategoria.id_categoria_default'
                ),

                'conditions' => array(
                    'ShopProdutoCategoria.id_produto_default' => $this->request->params['pass']['2']
                )

            );

            $dados = $this->ShopProdutoCategoria->find('first', $conditions);

            if (!empty($dados['ShopProdutoCategoria']['id_categoria_default'])) {
                $this->set('id_categoria_default', $dados['ShopProdutoCategoria']['id_categoria_default']);
            } else {
                $this->set('id_categoria_default', null);
            }

            /**
             *
             * Listar grade de produtos
             *
             **/
            $result = $this->ShopProdutoGrade->find('all', array(

                'fields' => array(
                    'ShopGrade.nome',
                    'ShopGrade.id_grade',
                ),

                'conditions' => array(
                    'ShopProdutoGrade.id_produto_default' => $this->request->params['pass']['2']
                ),

                'joins' => array(
                    array(
                        'table' => 'sh_shop_grade',
                        'alias' => 'ShopGrade',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopProdutoGrade.id_grade_default = ShopGrade.id_grade'
                        )
                    )
                )
            ));

            $this->set('res_grade', $result);
            $this->set('res_grade_default', self::result_grade_all());


            /**
             *
             * GET Categorias
             *
             **/

            $dados = $this->requestAction(array(
                'controller' => 'ShopProdutoCategoria',
                'action' => 'getIdCategoriaDefault',
                'id_produto' => $this->request->params['pass']['2']
            ));


            if (v::notEmpty()->validate($dados)) {

                if (isset($dados['ShopProdutoCategoria']['id_categoria_default'])) {

                    if ($this->ShopCategoria instanceof ShopCategoria) {

                        $this->res_categoria = $this->ShopCategoria->setIdShop($this->Session->read('id_shop'))
                            ->setIdCategoria($dados['ShopProdutoCategoria']['id_categoria_default'])
                            ->getNomeCategoriaArrayFirst();

                    }

                }

                $this->res_categoria_sec_all = $this->requestAction(array(
                    'controller' => 'ShopProdutoCategoria',
                    'action' => 'getIdProdCategoriaAll',
                    'id_produto' => $this->request->params['pass']['2']
                ));

            }

            $this->set('res_categoria', $this->res_categoria);
            $this->set('res_categoria_sec_all', $this->res_categoria_sec_all);


        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            self::redirecionaPaginaProduto('listar');

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());
            self::redirecionaPaginaProduto('listar');

        } catch (\InvalidArgumentException $e) {
            $this->setMsgAlertError($e->getMessage());
            self::redirecionaPaginaProduto('listar');
        }

        $this->set('title_for_layout', 'Editando produto: ' . sprintf("(#%d)", $this->request->params['pass']['2']));


        $this->configCSRFGuard();

    }

    /**
     * Post Edita dados do Produto
     * @access private
     * @param String $id_produto de produto
     *
     */
    private function postProdutoEditar()
    {

        if ($this->request->is('post')) {

            if (Tools::getValue('produto_variacoes') == 'True') {

                try {

                    $id_produto = intval(Tools::getValue('produto_id'));

                    $conditions = array(
                        'fields' => array(
                            'ShopProduto.sku'
                        ),
                        'conditions' => array(
                            'ShopProduto.sku' => Tools::clean(Tools::cleanSKU(Tools::getValue('sku'))),
                            'ShopProduto.id_produto !=' => $id_produto,
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                        )
                    );

                    if ($this->ShopProduto->find('count', $conditions) > 0) {

                        $this->json['campos_com_erro'] = ["sku"];
                        $this->json['estado'] = "ERRO";
                        $this->json['mensagem'] = "Código do produto (SKU): Um produto com o código SKU inserido já existe.";

                    } else {

                        $this->json['campos_com_erro'] = [];
                        $this->json['estado'] = 'SUCESSO';
                        $this->json['mensagem'] = 'Produto editado com sucesso.';
                        $this->json['campos_alterados'] = [];

                        self::editDadosProdutoFilho($id_produto);

                    }

                    header('Content-Type: application/json');
                    echo json_encode($this->json);
                    exit();

                } catch (\PDOException $e) {

                    \Exception\VialojaDatabaseException::errorHandler($e);

                }

            }

            if ($this->Session->read('add_produto_filho')) {

                $this->json['campos_com_erro'] = [];
                $this->json['estado'] = 'SUCESSO';
                $this->json['mensagem'] = 'Produto editado com sucesso.';
                $this->json['campos_alterados'] = [];

                header('Content-Type: application/json');
                echo stripslashes(json_encode($this->json));
                $this->Session->delete('add_produto_filho');
                exit();

            }

            if (isset($this->request->params['pass']['2'])) {

                if ($this->request->params['pass']['2'] == 'categoria') {

                    if (isset($this->request->params['pass']['3'])) {

                        self::adicionaCategoriaAoProduto($this->request->params['pass']['3']);
                        $this->json['estado'] = "SUCESSO";
                        $this->json['mensagem'] = "A categoria foi definida com sucesso.";

                    } else {
                        $this->json['estado'] = "ERRO";
                        $this->json['mensagem'] = "A categoria não pode ser definida.";
                    }

                    header('Content-Type: application/json');
                    echo stripslashes(json_encode($this->json));
                    exit();

                }

            }

            $this->datasource = $this->ShopProduto->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    if (isset($this->request->params['pass']['2'])) {

                        if (!is_numeric($this->request->params['pass']['2'])) {
                            throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                        }

                        $this->id_produto = $this->request->params['pass']['2'];

                        $conditions = array(
                            'fields' => array(
                                'ShopProduto.sku'
                            ),
                            'conditions' => array(
                                'ShopProduto.sku' => Tools::clean(Tools::cleanSKU(Tools::getValue('sku'))),
                                'ShopProduto.id_produto !=' => $this->id_produto,
                                'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                            )
                        );

                        $total_sku = $this->ShopProduto->find('count', $conditions);

                        if ($total_sku > 0) {
                            $this->sku = Tools::tokenGen();
                        }

                        self::editDadosProduto($this->id_produto);
                        $result = self::adicionaGradeAoProduto($this->id_produto);

                        if ($total_sku > 0) {
                            $this->setMsgAlertInfo('Um produto com o código inserido já existe. Substituído por ' . $this->sku);
                        } else {
                            $this->setMsgAlertSuccess('Produto editado com sucesso.');
                        }

                        if ($result === 'ERROR_COR_DUPLICADA') {
                            $this->setMsgAlertError('Escolha apenas 1 grade do tipo Cor');
                        }

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            }

        }

    }

    /**
     * Edita dados do Produto editDadosProduto
     * @access public
     * @param String $id_produto de produto
     *
     */
    private function editDadosProdutoFilho($id_produto = '')
    {

        $this->requestAction(
            array(
                'controller' => 'ShopProduto',
                'action' => 'editarDadosProdutoFilho',
                'id_produto' => $id_produto
            )
        );

    }

    /**
     * Edita dados do Produto editDadosProduto
     * @access public
     * @param String $id_produto de produto
     *
     */
    private function editDadosProduto($id_produto = null)
    {

        $this->requestAction(
            array(
                'controller' => 'ShopProduto',
                'action' => 'editarDadosProduto',
                'id_produto' => $id_produto
            )
        );

    }

    private function redirecionaPaginaProduto($value = 'listar')
    {
        return $this->redirect(array(
            'controller' => 'catalogo',
            'action' => 'produto',
            $value
        ));
    }

    /**
     * Remover produto filho
     * @access public
     * @param String $id_produto de produto
     *
     */
    public function produtoFilhoRemover()
    {

        try {

            $this->render(false);

            $id_produto = $this->request->params['pass']['3'];

            if (empty($id_produto)) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            if (!is_numeric($id_produto)) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->ShopProduto->id = $id_produto;
            if ($this->ShopProduto->exists()) {

                $ok = $this->ShopProduto->deleteAll(array(
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopProduto.id_produto' => $id_produto
                ));

                if (is_bool($ok) && $ok === true) {
                    $this->setMsgAlertSuccess('Variação de produto excluído com sucesso.');
                } else {
                    throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                }

            } else {
                throw new \NotFoundException("Variação de produto não encontrada.", E_USER_WARNING);
            }

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError($e->getMessage());

        } finally {

            if ($this->referer()) {
                return $this->redirect($this->referer());
            } else {

                self::redirecionaPaginaProduto('listar');

            }

        }

    }

    /**
     * Envia o produto para lixeira
     * @access public
     * @param String $id_produto de produto
     *
     */

    public function produtoRemover()
    {

        if (!$this->request->is('post')) {

            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaProduto('listar');

        }

        $this->datasource = $this->ShopProduto->getDataSource();

        try {

            $this->datasource->begin();

            if (isset($this->request->data['confirmacao'])) {

                if (!is_array($this->request->data['produtos'])) {
                    throw new \InvalidArgumentException(ERROR_PROCESS);
                }

                foreach ($this->request->data['produtos'] as $this->id_produto) {

                    if (!is_numeric($this->id_produto)) {
                        throw new \InvalidArgumentException(ERROR_PROCESS);
                    }

                    $conditions = array(
                        'conditions' => array(
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopProduto.id_produto' => $this->id_produto
                        )
                    );

                    if ($this->ShopProduto->find('count', $conditions) > 0) {

                        $this->ShopProduto->id = $this->id_produto;
                        $this->ShopProduto->saveField("lixo", "True");
                        $result = true;

                    }

                }

                $this->Session->write('total_produto_excluido', count($this->request->data['produtos']));

                if (!isset($result)) {
                    $this->setMsgAlertError(ERROR_PROCESS);
                }

                self::redirecionaPaginaProduto('listar');

            }

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/
            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            } else {

                if ((!isset($this->request->data['produtos'])) || (!v::notEmpty()->validate($this->request->data['produtos']))) {
                    throw new \NotFoundException('Por favor, selecione o(s) produto(s) que deseja enviar para lixeira.', E_USER_WARNING);
                }

                if (!is_array($this->request->data['produtos'])) {
                    throw new \InvalidArgumentException(ERROR_PROCESS);
                }

                $conditions = array(
                    'fields' => array(
                        'ShopProduto.id_produto',
                        'ShopProduto.nome'
                    ),
                    'conditions' => array(
                        'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopProduto.id_produto' => array_map('intval', $this->request->data['produtos'])
                    ),
                    'order' => array(
                        'ShopProduto.nome' => 'ASC'
                    )
                );

                $res_produto = $this->ShopProduto->find('all', $conditions);
                $this->set(compact('res_produto'));

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            self::redirecionaPaginaProduto('listar');

        } catch (\NotFoundException $e) {

            $this->setMsgAlertInfo($e->getMessage());
            self::redirecionaPaginaProduto('listar');

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());
            self::redirecionaPaginaProduto('listar');

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaProduto('listar');

        }


        $this->configCSRFGuard();

        $this->set('title_for_layout', 'Remover produto');


    }

    /**
     * Elimina produto da lixeira
     * @access public
     * @param String $id_produto de produto
     *
     */
    public function produtoRemoverLixeira()
    {

        if (!$this->request->is('post')) {
            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaProduto('lixeira');
        }

        $this->datasource = $this->ShopProduto->getDataSource();

        try {

            $this->datasource->begin();

            if (isset($this->request->data['confirmacao'])) {

                $diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'produto' . DS;

                foreach ($this->request->data['produtos'] as $this->id_produto) {

                    if (!is_numeric($this->id_produto)) {
                        throw new \InvalidArgumentException(ERROR_PROCESS);
                    }

                    $conditions = array(
                        'conditions' => array(
                            'ShopProduto.id_produto' => $this->id_produto,
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                        )
                    );

                    if ($this->ShopProduto->find('count', $conditions) > 0) {

                        /**
                         *
                         * Deleta produto filho - BEGIN
                         *
                         **/
                        $conditions = array(
                            'conditions' => array(
                                'ShopProduto.parente_id' => $this->id_produto,
                                'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                            )
                        );

                        if ($this->ShopProduto->find('count', $conditions) > 0) {

                            $this->ShopProduto->deleteAll(array(
                                'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                                'ShopProduto.parente_id' => $this->id_produto
                            ));

                        }

                        /**
                         *
                         * Deleta produto filho - END
                         *
                         **/
                        Tools::deleteDirectory($diretorio . $this->id_produto);
                    }

                }

                $this->Session->write('total_produto_excluido', count($this->request->data['produtos']));

                $ok = $this->ShopProduto->deleteAll(array(
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopProduto.id_produto' => $this->request->data['produtos']
                ));

                if (is_bool($ok) && $ok === true) {
                    // code...
                    self::redirecionaPaginaProduto('lixeira');

                } else {

                    $this->setMsgAlertError(ERROR_PROCESS);
                    self::redirecionaPaginaProduto('lixeira');

                }

            }

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/
            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            } else {

                if (!isset($this->request->data['produtos']) || empty($this->request->data['produtos'])) {
                    throw new \NotFoundException('Por favor, selecione o(s) produto(s) que deseja remover.', E_USER_WARNING);
                }

                if (!is_array($this->request->data['produtos'])) {
                    throw new \InvalidArgumentException(ERROR_PROCESS);
                }

                $conditions = array(
                    'fields' => array(
                        'ShopProduto.id_produto',
                        'ShopProduto.nome'
                    ),
                    'conditions' => array(
                        'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopProduto.id_produto' => array_map('intval', $this->request->data['produtos'])
                    ),
                    'order' => array(
                        'ShopProduto.nome' => 'ASC'
                    )
                );

                $res_produto = $this->ShopProduto->find('all', $conditions);
                $this->set(compact('res_produto'));

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            self::redirecionaPaginaProduto('lixeira');

        } catch (\NotFoundException $e) {

            $this->setMsgAlertInfo($e->getMessage());
            self::redirecionaPaginaProduto('lixeira');

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());
            self::redirecionaPaginaProduto('lixeira');

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaProduto('lixeira');

        }


        $this->configCSRFGuard();

        $this->set('title_for_layout', 'Remover produto');


    }

    /**
     * Lista produto da lixeira
     * @access public
     * @param String $id_shop id do Shop
     * @return array
     */
    public function produtoLixeira()
    {

        try {

            $conditions = array(

                'fields' => array(

                    'ShopProduto.id_produto',
                    'ShopProduto.id_shop_default',
                    'ShopProduto.tipo',
                    'ShopProduto.ativo',
                    'ShopProduto.usado',
                    'ShopProduto.destaque',
                    'ShopProduto.nome',
                    'ShopProduto.sku',
                    'ShopProduto.preco_sob_consulta',
                    'ShopProduto.preco_custo',
                    'ShopProduto.preco_cheio',
                    'ShopProduto.preco_promocional',
                    'ShopProduto.situacao_em_estoque',
                    'ShopProduto.quantidade',
                    'ShopProdutoImagem.nome_imagem',

                ),

                'conditions' => array(
                    'ShopProduto.parente_id' => 0,
                    'ShopProduto.lixo' => 'True',
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                ),

                'order' => array(
                    'ShopProduto.id_produto' => 'DESC'
                ),

                'group' => array('ShopProduto.id_produto'),
                'limit' => $this->limit,

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

            /**
             * Roda a consulta, já trazendo os resultados paginados
             */

            $this->paginate = $conditions;
            $res_lista_produto = $this->paginate('ShopProduto');
            $this->set(compact('res_lista_produto'));

            if ($this->Session->read('total_produto_excluido')) {
                $this->set('flash_produto_excluido', $this->Session->read('total_produto_excluido'));
                $this->Session->delete('total_produto_excluido');
            }

            if ($this->Session->read('total_produto_recuperado')) {
                $this->set('flash_produto_recuperado', $this->Session->read('total_produto_recuperado'));
                $this->Session->delete('total_produto_recuperado');
            }

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->set('title_for_layout', 'Lixeira de produtos');


        $this->configCSRFGuard();

    }

    /**
     * Recupera produto da lixeira
     * @access public
     * @param String $id_shop id do Shop
     * @param String $id_produto id do Produto
     * @return array
     */
    public function produtoLixeiraRecupera()
    {

        if (!$this->request->is('post')) {

            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaProduto('lixeira');

        }

        $this->datasource = $this->ShopProduto->getDataSource();

        try {

            $this->datasource->begin();

            if (isset($this->request->data['confirmacao'])) {

                foreach ($this->request->data['produtos'] as $this->id_produto) {

                    if (!is_numeric($this->id_produto)) {
                        throw new \InvalidArgumentException(ERROR_PROCESS);
                    }

                    $conditions = array(
                        'conditions' => array(
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopProduto.id_produto' => $this->id_produto
                        )
                    );

                    if ($this->ShopProduto->find('count', $conditions) > 0) {
                        $this->ShopProduto->id = $this->id_produto;
                        $this->ShopProduto->saveField("lixo", "False");
                        $result = true;
                    }

                }

                $this->Session->write('total_produto_recuperado', count($this->request->data['produtos']));

                if (isset($result)) {

                    self::redirecionaPaginaProduto('lixeira');

                } else {

                    $this->setMsgAlertError(ERROR_PROCESS);
                    self::redirecionaPaginaProduto('lixeira');

                }

            }

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/

            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            } else {

                if ((!isset($this->request->data['produtos'])) || (!v::notEmpty()->validate($this->request->data['produtos']))) {
                    throw new \NotFoundException('Por favor, selecione o(s) produto(s) que deseja recuperar.', E_USER_WARNING);
                }

                if (!is_array($this->request->data['produtos'])) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                $conditions = array(
                    'fields' => array(
                        'ShopProduto.id_produto',
                        'ShopProduto.nome'
                    ),
                    'conditions' => array(
                        'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopProduto.id_produto' => array_map('intval', $this->request->data['produtos'])
                    ),
                    'order' => array(
                        'ShopProduto.nome' => 'ASC'
                    )
                );

                $res_produto = $this->ShopProduto->find('all', $conditions);
                $this->set(compact('res_produto'));

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            self::redirecionaPaginaProduto('lixeira');

        } catch (\NotFoundException $e) {

            $this->setMsgAlertInfo($e->getMessage());
            self::redirecionaPaginaProduto('lixeira');

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());
            self::redirecionaPaginaProduto('lixeira');

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaProduto('lixeira');

        }


        $this->configCSRFGuard();

        $this->set('title_for_layout', 'Recuperar produto');

    }

    /**
     * Ordenar imagem de produto
     * @access public
     * @param String $id_produto de produto
     *
     */
    public function produtoOrdenarImagem()
    {

        $this->render(false);

        $this->datasource = $this->ShopProduto->getDataSource();

        try {

            $this->datasource->begin();

            if (!$this->request->is('ajax')) {
                return false;
            }

            if (!is_numeric($this->request->params['pass']['3'])) {
                return false;
            }

            $conditions = array(

                'fields' => array(
                    'ShopProduto.id_produto'
                ),

                'conditions' => array(
                    'ShopProduto.id_produto' => $this->request->params['pass']['3'],
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                )

            );

            if ($this->ShopProduto->find('count', $conditions) > 0) {

                if (isset($this->request->data['imagem_id'])) {
                    foreach ($this->request->data['imagem_id'] as $key => $imagem_id) {

                        if (!is_numeric($imagem_id)) {
                            return false;
                        }

                        $fields = array(
                            'ShopProdutoImagem.posicao' => sprintf("'%s'", $key)
                        );

                        $conditions = array(
                            'ShopProdutoImagem.id_produto_default' => $this->request->params['pass']['3'],
                            'ShopProdutoImagem.id_imagem' => $imagem_id
                        );

                        $this->ShopProdutoImagem->updateAll($fields, $conditions);
                    }

                }

            }

            $this->json['estado'] = "SUCESSO";
            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->json['estado'] = "ERRO";
            \Exception\VialojaDatabaseException::errorHandler($e);

        } finally {

            header('Content-Type: application/json');
            echo stripslashes(json_encode($this->json));
            exit();
        }

    }

    /**
     * Remove imagem de produto
     * @access public
     * @param String $id_produto de produto
     * @param String $id_imagem de produto
     *
     */
    public function produtoRemoverImagem()
    {

        $this->render(false);

        $this->datasource = $this->ShopProduto->getDataSource();

        try {

            $this->datasource->begin();

            if (!$this->request->is('ajax')) {
                return false;
            }

            if (!is_numeric($this->request->params['pass']['3'])) {
                return false;
            }

            if (!is_numeric($this->request->params['pass']['4'])) {
                return false;
            }

            $conditions = array(
                'fields' => array(
                    'ShopProduto.id_produto'
                ),
                'conditions' => array(
                    'ShopProduto.id_produto' => $this->request->params['pass']['3'],
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopProduto->find('count', $conditions) > 0) {

                $this->ShopProdutoImagem->id = $this->request->params['pass']['4'];
                if ($this->ShopProdutoImagem->exists()) {

                    $conditions = array(

                        'fields' => array(
                            'ShopProdutoImagem.id_produto_default',
                            'ShopProdutoImagem.nome_imagem'
                        ),

                        'conditions' => array(
                            'ShopProdutoImagem.id_imagem' => $this->request->params['pass']['4']
                        )

                    );

                    $dados = $this->ShopProdutoImagem->find('first', $conditions);

                    $diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'produto' . DS;

                    $pastas = array(
                        'cart',
                        'home',
                        'large',
                        'medium',
                        'small',
                        'thickbox'
                    );

                    foreach ($pastas as $key => $pasta) {
                        Tools::deleteFile($diretorio . $dados['ShopProdutoImagem']['id_produto_default'] . DS . $pasta . DS . $dados['ShopProdutoImagem']['nome_imagem']);
                    }

                    $this->ShopProdutoImagem->delete();
                }

                $this->json['estado'] = "SUCESSO";

            } else {

                $this->json['estado'] = "ERRO";

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->json['estado'] = "ERRO";
            \Exception\VialojaDatabaseException::errorHandler($e);

        } finally {

            header('Content-Type: application/json');
            echo stripslashes(json_encode($this->json));
            exit();

        }

    }

    /**
     * Imagem Upload
     * @access public
     * @param String $id_shop id do Shop
     * @param String $id_produto id do Produto
     * @param String $files arquivo
     *
     */
    public function produtoCriarImagem()
    {

        $this->render(false);

        if ((!$this->request->is('post')) || (!$this->request->is('ajax'))) {
            return false;
        }

        set_time_limit(0);

        $this->datasource = $this->ShopProdutoImagem->getDataSource();

        try {

            $this->datasource->begin();

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/

            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            } else {

                if (isset($_FILES['files']) && $_FILES['files']['name'] !== '') {

                    $diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'produto' . DS;

                    if (isset($this->request->params['pass']['3'])) {

                        $this->id_produto_up = intval(Tools::clean($this->request->params['pass']['3']));

                    } else {
                        /**
                         *
                         * Cadastra os dados do produtos
                         *
                         **/
                        $this->id_produto = self::enviaDadosProdutoViaRequestAction('AUTOMATICO');
                    }

                    if (isset($this->id_produto_up) && is_numeric($this->id_produto_up)) {
                        /**
                         *
                         * Altera os dados do produtos
                         *
                         **/
                        $this->id_produto = $this->id_produto_up;
                        self::editDadosProduto($this->id_produto);
                    }

                    self::adicionaGradeAoProduto($this->id_produto);

                    if (Tools::getValue('produto_editar') != 'true') {
                        self::adicionaCategoriaAoProduto($this->id_produto);
                    }


                    /**
                     *
                     * Add grade
                     *
                     **/
                    if (isset($this->request->data['grade']) && is_array($this->request->data['grade'])) {

                        /**
                         *
                         * Remove grade
                         *
                         **/
                        $this->ShopProdutoGrade->deleteAll(array(
                            'id_produto_default' => $this->id_produto
                        ));

                        foreach ($this->request->data['grade'] as $grade_id) {

                            $this->ShopProdutoGrade->addGrade($grade_id, $this->id_produto);

                        }

                    }

                    $diretorio = $diretorio . $this->id_produto . DS;

                    /**
                     *
                     * Classe que cria nova imagens da original
                     *
                     **/

                    $total = count($_FILES['files']['name']);

                    $this->img_data = array();

                    for ($i = 0; $i < $total; $i++) {

                        if (!Validate::isFileError($_FILES['files']['error'][$i])) {
                            self::headerImageErrorUpload();
                        }

                        if (!Validate::isMaxSize($_FILES['files']['size'][$i], 1)) {
                            self::headerImageErrorUpload();
                        }

                        if (!is_string($_FILES['files']['name'][$i])) {
                            self::headerImageErrorUpload();
                        }

                        if (!Validate::isTypeImage($_FILES['files']['type'][$i])) {
                            self::headerImageErrorUpload();
                        }

                        $img_temp = $_FILES['files']['tmp_name'][$i];
                        $img_name = $_FILES['files']['name'][$i];

                        /*
                        * Nova Verificação na imagem, agora pelo mime
						* Verifica profunda do arquivo MIME_TYPE
                        */

                        $this->finfo = new finfo(FILEINFO_MIME_TYPE);
                        $this->mime = $this->finfo->file($img_temp);

                        if (v::notEmpty()->validate($this->mime)) {

                            if (!Validate::isTypeImage($this->mime)) {
                                self::headerImageErrorUpload();
                            }

                        } else {

                            self::headerImageErrorUpload();

                        }

                        if (Tools::getValue('renomear_imagem') == 'True') {

                            $this->imagem_info = pathinfo($img_name);
                            $img_name = Tools::slug(Tools::getValue('nome')) . '.' . $this->imagem_info['extension'];

                        }

                        /**
                         *
                         * Aplica slug
                         *
                         **/
                        $this->thickbox = $diretorio . 'thickbox' . DS;
                        $img_name = Validate::checkNameFile($img_name, $this->thickbox);
                        Tools::createFolder($this->thickbox);

                        // thickbox_default Tamanho 800 x 800
                        move_uploaded_file($img_temp, $this->thickbox . $img_name);
                        $original = WideImage::load($this->thickbox . $img_name);
                        $original->resize(800, 800, 'inside')->saveToFile($this->thickbox . $img_name);

                        // large_default Tamanho 368 x 548
                        $this->large = $diretorio . 'large' . DS;
                        Tools::createFolder($this->large);
                        move_uploaded_file($img_temp, $this->large . $img_name);
                        $original->resize(368, 548, 'outside')->saveToFile($this->large . $img_name);

                        // home_default Tamanho 270 x 270
                        $this->home = $diretorio . 'home' . DS;
                        Tools::createFolder($this->home);
                        move_uploaded_file($img_temp, $this->home . $img_name);
                        $original->resize(270, 270, 'inside')->saveToFile($this->home . $img_name);

                        //* medium_default Tamanho 125 x 125
                        $this->medium = $diretorio . 'medium' . DS;
                        Tools::createFolder($this->medium);

                        move_uploaded_file($img_temp, $this->medium . $img_name);
                        $original->resize(125, 125, 'inside')->saveToFile($this->medium . $img_name);

                        // small_default Tamanho 98 x 98
                        $this->small = $diretorio . 'small' . DS;
                        Tools::createFolder($this->small);

                        move_uploaded_file($img_temp, $this->small . $img_name);
                        $original->resize(98, 98, 'inside')->saveToFile($this->small . $img_name);

                        // cart_default Tamanho 85 x 108
                        $this->cart = $diretorio . 'cart' . DS;
                        Tools::createFolder($this->cart);
                        move_uploaded_file($img_temp, $this->cart . $img_name);
                        $original->resize(85, 108, 'outside')->saveToFile($this->cart . $img_name);

                        $original->destroy();

                        $conditions = array(

                            'fields' => array(
                                'MAX(ShopProdutoImagem.posicao) as max_posicao'
                            ),
                            'conditions' => array(
                                'id_produto_default' => $this->id_produto
                            )

                        );

                        $this->posicao = $i;
                        if ($this->ShopProdutoImagem->find('count', $conditions) > 0) {
                            $this->posicao = $this->ShopProdutoImagem->find('first', $conditions);
                            $this->posicao = $this->posicao['0']['max_posicao'] + 1;
                        }

                        $data = array(
                            'id_produto_default' => $this->id_produto,
                            'nome_imagem' => $img_name,
                            'posicao' => $this->posicao
                        );

                        $this->ShopProdutoImagem->saveAll($data);

                        $this->id_imagem = $this->ShopProdutoImagem->getInsertID();

                        $data_from_db = array(
                            'id' => sprintf('%d', $this->id_imagem),
                            'caminho' => sprintf('%s', sprintf('upload/%d/produto/%s/large/%s', $this->Session->read('id_shop'), $this->id_produto, $img_name)),
                            'url_remover_json' => sprintf('%s', sprintf('/admin/catalogo/produto/remover/imagem/%d/%d', $this->id_produto, $this->id_imagem)),
                            'url_remover' => sprintf('%s', sprintf('/admin/catalogo/produto/remover/imagem/%d/%d', $this->id_produto, $this->id_imagem))
                        );

                        array_push($this->img_data, $data_from_db);

                    }

                }

                $this->json['action_url'] = sprintf('/admin/catalogo/produto/editar/%d', $this->id_produto);
                $this->json['sortable_url'] = sprintf('/admin/catalogo/produto/ordenar/imagem/%d', $this->id_produto);
                $this->json['img'] = $this->img_data;
                $this->json['input_url'] = sprintf('/admin/catalogo/produto/criar/imagem/%d', $this->id_produto);

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);
            return false;

        } catch (\InvalidArgumentException $e) {

            return false;

        } catch (\Exception $e) {

            return false;

        } finally {

            header('Content-Type: application/json');
            echo stripslashes(json_encode($this->json));
            exit();
        }

    }

    /**
     * Enviar email de aviso de fraude em imagem
     **/
    private function headerImageErrorUpload()
    {
        $this->json['img'] = false;
        header('Content-Type: application/json');
        echo stripslashes(json_encode($this->json));
        exit();

    }

    /**
     * Categoria ordenar
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function categoriaOrdenar()
    {

        $this->render(false);

        try {

            if ($this->request->is('post')) {

                if (!$this->request->is('ajax')) {
                    return false;
                }

                if (Tools::getValue('posicoes') != '') {

                    $this->posicoes = Tools::getValue('posicoes');
                    $this->posicao = explode(',', $this->posicoes);

                    $conditions = array(

                        'fields' => array(
                            'ShopCategoria.id_categoria'
                        ),
                        'conditions' => array(
                            'ShopCategoria.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopCategoria.id_categoria' => $this->posicao

                        ),
                        'order' => array(
                            'FIELD(ShopCategoria.id_categoria, ' . $this->posicoes . ') ASC'
                        )

                    );

                    $result = $this->ShopCategoria->find('all', $conditions);

                    foreach ($result AS $key => $pagina) {

                        $this->ShopCategoria->id = $pagina['ShopCategoria']['id_categoria'];
                        $this->ShopCategoria->saveField("posicao", $key);

                    }

                    $this->json['estado'] = "SUCESSO";
                    $this->json['mensagem'] = "As categorias foram ordenadas.";

                } else {

                    $this->json['estado'] = "ERRO";
                    $this->json['mensagem'] = ERROR_PROCESS;

                }

            }

        } catch (\PDOException $e) {

            $this->json['estado'] = "ERRO";
            $this->json['mensagem'] = ERROR_PROCESS;
            \Exception\VialojaDatabaseException::errorHandler($e);

        } finally {

            header('Content-Type: application/json');
            echo stripslashes(json_encode($this->json));
            exit();

        }

    }

    /**
     * Categoria criar via ajax json
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function categoriaCriar_json()
    {

        $this->render(false);

        $this->datasource = $this->ShopCategoria->getDataSource();

        try {

            $this->datasource->begin();

            if (!$this->request->is('post')) {
                throw new \InvalidArgumentException();
            }

            if (!$this->request->is('ajax')) {
                throw new \InvalidArgumentException();
            }

            /**
             *
             * Verifica se categoria já existe
             *
             **/
            $conditions = array(
                'conditions' => array(
                    'ShopCategoria.nome_categoria' => Tools::clean(Tools::getValue('nome')),
                    'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopCategoria->find('count', $conditions) > 0) {

                $this->json['estado'] = "ERRO";
                $this->json['mensagem'] = "Já existe uma categoria com este nome. Tente novamente com outro nome";

            } else {

                $this->nome = Tools::clean(Tools::getValue('nome'));

                if (empty($this->nome)) {
                    throw new \NotFoundException("Informe o nome da categoria e tente novamente", E_USER_WARNING);
                }

                $this->url = Tools::slug($this->nome);
                $this->parente_id = Tools::clean(Tools::getValue('parent'));

                /*
                 * Verifica a posição da categoria na pagina
                 */

                $conditions = array(

                    'fields' => array(
                        'MAX(ShopCategoria.posicao) as max_posicao'
                    ),
                    'conditions' => array(
                        'ShopCategoria.categoria_parent_id' => 0,
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                    ),
                    'order' => array(
                        'ShopCategoria.id_categoria' => 'DESC'
                    )

                );

                $this->posicao = 0;
                if ($this->ShopCategoria->find('count', $conditions) > 0) {
                    $this->posicao = $this->ShopCategoria->find('first', $conditions);
                    $this->posicao = $this->posicao['0']['max_posicao'] + 1;
                }

                /*
                 * Verifica a posição em nleft da categoria
                 */
                $conditions = array(

                    'fields' => array(
                        'ShopCategoria.nleft',
                        'ShopCategoria.id_atividade'
                    ),
                    'conditions' => array(
                        'id_categoria' => $this->parente_id
                    ),
                    'limit' => 1

                );

                $nleft = 0;
                if ($this->ShopCategoria->find('count', $conditions) > 0) {

                    $data_nleft = $this->ShopCategoria->find('first', $conditions);
                    $nleft = $data_nleft['ShopCategoria']['nleft'] + 1;
                    $this->id_atividade = $data_nleft['ShopCategoria']['id_atividade'];

                }

                if ($this->parente_id > 0) {

                    $data = array(
                        'id_shop_default' => $this->Session->read('id_shop'),
                        'id_atividade' => $this->id_atividade,
                        'categoria_parent_id' => $this->parente_id,
                        'nome_categoria' => $this->nome,
                        'apelido' => $this->url,
                        'url' => $this->url,
                        'posicao' => $this->posicao,
                        'nleft' => $nleft
                    );

                } else {

                    $data = array(
                        'id_shop_default' => $this->Session->read('id_shop'),
                        'nome_categoria' => $this->nome,
                        'apelido' => $this->url,
                        'url' => $this->url,
                        'posicao' => $this->posicao
                    );

                }

                $ok = $this->ShopCategoria->saveAll($data);
                if (is_bool($ok) && $ok === true) {

                    $data = array(
                        'id_referencia_categoria' => $this->ShopCategoria->getInsertID(),
                        'base_url' => 'root',
                        'url' => $this->url
                    );

                    $this->ShopUrlUso->saveAll($data);

                    $this->json['resposta'] = array(
                        'level' => $nleft + 1,
                        'nome' => $this->nome,
                        'categoria_id' => $this->ShopCategoria->getInsertID(),
                        'parent_id' => $this->parente_id,
                        'descricao' => 1,
                        'conta_id' => $this->Session->read('id_shop'),
                        'idioma_id' => sprintf('%s', "pt-br")
                    );

                    $this->json['estado'] = "SUCESSO";

                }

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->json['estado'] = "ERRO";
            $this->json['mensagem'] = ERROR_PROCESS;
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\NotFoundException $e) {

            $this->json['estado'] = "ERRO";
            $this->json['mensagem'] = $e->getMessage();

        } catch (\InvalidArgumentException $e) {

            $this->json['estado'] = "ERRO";
            $this->json['mensagem'] = ERROR_PROCESS;

        } finally {

            header('Content-Type: application/json');
            echo json_encode($this->json);
            exit();

        }

    }

    /**
     * Criar categoria shop
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function categoriaCriar()
    {

        self::postCategoriaCriar();

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

        $result = $this->requestAction(array(
            'controller' => 'ShopCategoria',
            'action' => 'categoriaListaOption'
            //'dominio' => $this->request->data['dominio']
        ));

        $this->set('option', $result);

        $this->set('url_shop', self::getDominio());

        $res_atividades = $this->ShopAtividade->listarTodasAtividadesJoin($this->Shop);
        $this->set(compact('res_atividades'));


        $this->configCSRFGuard();

        $this->set('title_for_layout', 'Criar categoria');

    }

    /**
     * Post Criar categoria shop
     * @access private
     * @param String $id_shop variavel de sessão
     *
     */
    private function postCategoriaCriar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopCategoria->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $error = false;
                    if (Tools::getValue('activity_shop') == '') {
                        $this->set('error_activity_shop', true);
                        $error = true;
                    }

                    if (Tools::getValue('nome') == '') {
                        $this->set('error_nome', true);
                        $error = true;
                    }

                    if (Tools::getValue('descricao') != '') {
                        if (strlen(Tools::getValue('descricao')) > 128) {
                            $this->set('error_descricao_comp', strlen(Tools::getValue('descricao')));
                            $error = true;
                        }
                    }

                    if (Tools::getValue('description') != '') {
                        if (strlen(Tools::getValue('description')) > 128) {
                            $this->set('error_description_comp', strlen(Tools::getValue('description')));
                            $error = true;
                        }
                    }

                    /*
                     * Cadastra se no db, se não houver erros
                     */
                    if ($error !== true) {


                        /**
                         *
                         * Verifica se categoria já existe
                         *
                         **/

                        $conditions = array(
                            'conditions' => array(
                                'ShopCategoria.nome_categoria' => Tools::clean(Tools::getValue('nome')),
                                'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                            )
                        );

                        if ($this->ShopCategoria->find('count', $conditions) > 0) {
                            throw new \Exception\VialojaOverflowException('Já existe uma categoria com este nome. Tente novamente.', E_USER_WARNING);
                        }

                        /*
                         * Verifica a posição da categoria na pagina
                         */

                        $conditions = array(

                            'fields' => array(
                                'MAX(ShopCategoria.posicao) as max_posicao'
                            ),
                            'conditions' => array(
                                'ShopCategoria.categoria_parent_id' => 0,
                                'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                            ),
                            'order' => array(
                                'ShopCategoria.id_categoria' => 'DESC'
                            )

                        );

                        $this->posicao = 0;
                        if ($this->ShopCategoria->find('count', $conditions) > 0) {

                            $this->posicao = $this->ShopCategoria->find('first', $conditions);
                            $this->posicao = $this->posicao['0']['max_posicao'] + 1;

                        }


                        /*
                         * Verifica a posição em nleft da categoria
                         */
                        $conditions = array(

                            'fields' => array(
                                'ShopCategoria.nleft'
                            ),
                            'conditions' => array(
                                'id_categoria' => Tools::clean(Tools::getValue('parent'))
                            )

                        );

                        $nleft = 0;
                        if ($this->ShopCategoria->find('count', $conditions) > 0) {
                            $data_nleft = $this->ShopCategoria->find('first', $conditions);
                            $nleft = $data_nleft['ShopCategoria']['nleft'] + 1;
                        }

                        $data = array(
                            'id_shop_default' => $this->Session->read('id_shop'),
                            'id_atividade' => Tools::clean(Tools::getValue('activity_shop')),
                            'categoria_parent_id' => Tools::clean(Tools::getValue('parent')),
                            'ativa' => Tools::clean(Tools::getValue('ativa')),
                            'nome_categoria' => Tools::clean(Tools::getValue('nome')),
                            'apelido' => Tools::clean(Tools::getValue('apelido')),
                            'url' => Tools::clean(Tools::getValue('url')),
                            'descricao' => Tools::clean(Tools::getValue('descricao')),
                            'posicao' => $this->posicao,
                            'nleft' => $nleft,
                            'title' => Tools::clean(Tools::getValue('title')),
                            'description' => Tools::clean(Tools::getValue('description'))
                        );

                        $ok = $this->ShopCategoria->saveAll($data);
                        if (is_bool($ok) && $ok === true) {

                            $data = array(
                                'id_referencia_categoria' => $this->ShopCategoria->getInsertID(),
                                'base_url' => 'root',
                                'url' => Tools::clean(Tools::getValue('url'))
                            );

                            $this->ShopUrlUso->saveAll($data);

                            $this->setMsgAlertSuccess('Categoria criada com sucesso!');
                            self::redirecionaPaginaCategoria('listar', $this->ShopCategoria->getInsertID());

                        } else {
                            throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                        }

                    } else {
                        throw new \RuntimeException("Por favor, verifique os erros encontrados.", E_USER_WARNING);
                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\Exception\VialojaOverflowException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);

            }

        }

    }

    private function redirecionaPaginaCategoria($value = 'listar', $id = '')
    {
        return $this->redirect(array(
            'controller' => 'catalogo',
            'action' => 'categoria',
            $value,
            $id
        ));
    }

    /**
     * Categoria Remover
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function categoriaRemover()
    {

        if (!$this->request->is('post')) {
            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaCategoria('listar');
        }

        $this->datasource = $this->ShopCategoria->getDataSource();

        try {

            $this->datasource->begin();

            if (isset($this->request->data['confirmacao'])) {

                /**
                 *
                 * Verifica se existe categorias filha
                 *
                 **/
                if (isset($this->request->data['categorias'])) {

                    foreach ($this->request->data['categorias'] AS $categoria_id) {

                        if (!is_numeric($categoria_id)) {
                            throw new \InvalidArgumentException(ERROR_PROCESS);
                        }

                        $conditions = array(

                            'fields' => array(
                                'ShopCategoria.id_categoria',
                                'ShopCategoria.categoria_parent_id'
                            ),

                            'conditions' => array(
                                'ShopCategoria.categoria_parent_id' => $categoria_id
                            )

                        );

                        if ($this->ShopCategoria->find('count', $conditions) > 0) {

                            $result = $this->ShopCategoria->find('all', $conditions);

                            foreach ($result as $key => $dados) {

                                $conditions2 = array(

                                    'fields' => array(
                                        'ShopCategoria.categoria_parent_id'
                                    ),

                                    'conditions' => array(
                                        'ShopCategoria.id_categoria' => $dados['ShopCategoria']['categoria_parent_id']
                                    )

                                );

                                $dados2 = $this->ShopCategoria->find('first', $conditions2);

                                /**
                                 *
                                 * Altera para categoria pai
                                 *
                                 **/
                                $fields = array(
                                    'ShopCategoria.categoria_parent_id' => sprintf("'%s'", $dados2['ShopCategoria']['categoria_parent_id']),
                                    'ShopCategoria.nleft' => 'ShopCategoria.nleft-1'
                                );

                                $conditions = array(
                                    'ShopCategoria.id_categoria' => $dados['ShopCategoria']['id_categoria'],
                                    'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                                );

                                $this->ShopCategoria->updateAll($fields, $conditions);

                                /**
                                 *
                                 * Recua nleft das categorias filhas ou pai afetadas
                                 *
                                 **/
                                $conditions3 = array(

                                    'fields' => array(
                                        'ShopCategoria.id_categoria'
                                    ),

                                    'conditions' => array(
                                        'ShopCategoria.id_categoria' => $dados['ShopCategoria']['id_categoria']
                                    )

                                );

                                $result = $this->ShopCategoria->find('all', $conditions3);

                                foreach ($result as $dados3) {

                                    $fields = array(
                                        'ShopCategoria.nleft' => 'ShopCategoria.nleft-1'
                                    );

                                    $conditions = array(
                                        'ShopCategoria.categoria_parent_id' => $dados3['ShopCategoria']['id_categoria'],
                                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                                    );

                                    $this->ShopCategoria->updateAll($fields, $conditions);

                                }

                            }

                        }

                    }

                }

                $ok = $this->ShopCategoria->deleteAll(array(
                    'ShopCategoria.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopCategoria.id_categoria' => array_map('intval', $this->request->data['categorias'])
                ));

                if (is_bool($ok) && $ok === true) {
                    /**
                     *
                     * Remove as url de validação
                     *
                     **/
                    $this->ShopUrlUso->deleteAll(array(
                        'ShopUrlUso.base_url' => 'root',
                        'ShopUrlUso.id_referencia_categoria' => array_map('intval', $this->request->data['categorias'])
                    ));

                    // code...
                    self::redirecionaPaginaCategoria('listar');

                } else {

                    $this->setMsgAlertSuccess(ERROR_PROCESS);
                    self::redirecionaPaginaCategoria('listar');

                }

            }

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/

            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            } else {

                if (!isset($this->request->data['categorias']) || empty($this->request->data['categorias'])) {
                    throw new \NotFoundException(ERROR_PROCESS);
                }

                if (!is_array($this->request->data['categorias'])) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                $conditions = array(
                    'fields' => array(
                        'ShopCategoria.id_categoria',
                        'ShopCategoria.nome_categoria'
                    ),
                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopCategoria.id_categoria' => array_map('intval', $this->request->data['categorias'])
                    ),
                    'order' => array(
                        'ShopCategoria.nome_categoria' => 'ASC'
                    )
                );

                $this->res_categoria = $this->ShopCategoria->find('all', $conditions);
                $this->set('res_categoria', $this->res_categoria);

                foreach ($this->res_categoria as $dados) {
                    array_push($this->categoria_nome, $dados['ShopCategoria']['nome_categoria']);
                }

                $this->Session->write('categoria_nome', $this->categoria_nome);

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            self::redirecionaPaginaCategoria('listar');

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);

        }


        $this->configCSRFGuard();

        $this->set('title_for_layout', 'Remover categoria');

    }

    /**
     * Categoria Listar
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function categoriaListar()
    {

        try {

            $conditions = array(
                'conditions' => array(
                    'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            $this->res_categoria = $this->ShopCategoria->find('count', $conditions);
            $this->set('count_categoria', $this->res_categoria);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $result = $this->requestAction(array(
            'controller' => 'ShopCategoria',
            'action' => 'categoriaListar'
        ));

        if ($this->Session->read('categoria_nome')) {
            $this->set('flash_categoria_nome', $this->Session->read('categoria_nome'));
            $this->Session->delete('categoria_nome');
        }

        $this->set('res_lista_categoria', $result);

        $this->set('title_for_layout', 'Listar categorias');


        $this->configCSRFGuard();

    }

    /**
     * Categoria Mover
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function categoriaMover()
    {

        if (!$this->request->is('post')) {
            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaCategoria('listar');
        }

        $this->datasource = $this->ShopCategoria->getDataSource();

        try {

            $this->datasource->begin();

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/
            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            } else {

                $id_categoria_nleft = Tools::clean($this->request->params['pass']['2']);

                if (!v::numeric()->notBlank()->validate($id_categoria_nleft)) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                if ($id_categoria_nleft === Tools::clean(Tools::getValue('parent'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                $conditions = array(
                    'fields' => array(
                        'ShopCategoria.categoria_parent_id',
                        'ShopCategoria.nleft'
                    ),

                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopCategoria.id_categoria' => $id_categoria_nleft
                    )
                );

                $this->cat = $this->ShopCategoria->find('first', $conditions);

                $categoria_id = self::categoriaNLeft($id_categoria_nleft);
                $array_id = array_filter(explode('#', $categoria_id));


                foreach ($array_id as $key => $cat_id) {

                    if ($key === 1) {

                        $fields = array(
                            'ShopCategoria.categoria_parent_id' => sprintf("'%s'", $this->cat['ShopCategoria']['categoria_parent_id']),
                            'ShopCategoria.nleft' => 'ShopCategoria.nleft-1'
                        );

                    } else {

                        $fields = array(
                            'ShopCategoria.nleft' => 'ShopCategoria.nleft-1'
                        );

                    }

                    $conditions = array(
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopCategoria.id_categoria' => $cat_id
                    );

                    $this->ShopCategoria->updateAll($fields, $conditions);

                }

                if (!v::numeric()->notBlank()->validate(Tools::clean(Tools::getValue('parent')))) {

                    $fields = array(
                        'ShopCategoria.categoria_parent_id' => '0',
                        'ShopCategoria.nleft' => '0'
                    );

                    $conditions = array(
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopCategoria.id_categoria' => $id_categoria_nleft
                    );

                    $ok = $this->ShopCategoria->updateAll($fields, $conditions);

                } else {

                    $conditions = array(
                        'fields' => array(
                            'ShopCategoria.nleft'
                        ),

                        'conditions' => array(
                            'ShopCategoria.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopCategoria.id_categoria' => Tools::clean(Tools::getValue('parent'))
                        )
                    );

                    $this->cat = $this->ShopCategoria->find('first', $conditions);

                    $fields = array(
                        'ShopCategoria.categoria_parent_id' => sprintf("'%s'", Tools::clean(Tools::getValue('parent'))),
                        'ShopCategoria.nleft' => sprintf("'%s'", $this->cat['ShopCategoria']['nleft'] + 1)
                    );

                    $conditions = array(
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopCategoria.id_categoria' => $id_categoria_nleft
                    );

                    $ok = $this->ShopCategoria->updateAll($fields, $conditions);

                }

                if (isset($ok) && is_bool($ok) && $ok === true) {
                    $this->setMsgAlertSuccess('Categoria editada com sucesso!');
                } else {
                    $this->setMsgAlertError(ERROR_PROCESS);
                }

                self::redirecionaPaginaCategoria('listar');


            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();

            $this->setMsgAlertError($e->getMessage());
            self::redirecionaPaginaCategoria('listar');

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->render(false);


        $this->configCSRFGuard();

    }

    /*
     * Lista as categoria no painel admin
     * @access public
     * @param String id_shop
     * @param String $data
     */

    public function categoriaNLeft($categoria_parent_id = 0)
    {

        try {

            // Construir a nossa lista de categorias de uma só vez
            static $cats;

            if (!is_array($cats)) {

                /*
                 * Verifica se a página já existe
                 */
                $conditions = array(

                    'fields' => array(
                        'ShopCategoria.id_categoria',
                        'ShopCategoria.categoria_parent_id'
                    ),
                    'conditions' => array(
                        'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                    )

                );

                if ($this->ShopCategoria->find('count', $conditions) <= 0) {
                    return false;
                }

                $result = $this->ShopCategoria->find('all', $conditions);

                $cats = array();
                foreach ($result as $key => $cat) {
                    array_push($cats, $cat);
                }

            }


            // Preencher uma lista de matriz itens
            $lista_itens = array();

            foreach ($cats as $cat) {

                // if não do tipo inteiro, seguir em frente
                if (( int )$cat['ShopCategoria']['categoria_parent_id'] !== ( int )$categoria_parent_id) {
                    continue;
                }

                $lista_itens[] = '#';
                // retorna o id
                $lista_itens[] = $cat['ShopCategoria']['id_categoria'];

                // recurse na lista de filhos
                $lista_itens[] = self::categoriaNLeft($cat['ShopCategoria']['id_categoria']);

            }

            // converter para uma string
            $lista_itens = implode('', $lista_itens);

            // if vazio, sem os itens da lista!
            if ('' == trim($lista_itens)) {
                return '';
            }

            return $lista_itens;

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    /**
     * Categoria Editar
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function categoriaEditar()
    {

        self::postCategoriaEditar();

        try {

            if ($this->Shop instanceof Shop) {
                $this->Shop->setIdShop($this->Session->read('id_shop'));
            }

            if (empty($this->request->params['pass']['2'])) {
                $this->setMsgAlertError(ERROR_PROCESS);
                self::redirecionaPaginaCategoria('listar');
            }

            if (!is_numeric($this->request->params['pass']['2'])) {
                $this->setMsgAlertError(ERROR_PROCESS);
                self::redirecionaPaginaCategoria('listar');
            }

            $result = $this->requestAction(array(
                'controller' => 'ShopCategoria',
                'action' => 'categoriaListaOption'
            ));

            $this->set('option', $result);

            $this->set('url_shop', self::getDominio());

            $conditions = array(
                'conditions' => array(
                    'ShopCategoria.id_categoria' => $this->request->params['pass']['2'],
                    'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopCategoria->find('count', $conditions) <= 0) {
                throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->set('categoria', $this->ShopCategoria->find('first', $conditions));

            /**
             *
             * Conta as categorias filhas
             *
             **/
            $dados = explode('#', self::categoriaNLeft($this->request->params['pass']['2']));
            $this->set('total_filha', count(array_filter($dados)));

            $res_atividades = $this->ShopAtividade->listarTodasAtividadesJoin($this->Shop);
            $this->set(compact('res_atividades'));

            /**
             *
             * Monta a atividade END
             *
             **/

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaCategoria('listar');

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaCategoria('listar');

        }


        $this->set('title_for_layout', 'Editar categoria');


        $this->configCSRFGuard();

    }

    /**
     * Post Categoria Editar
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function postCategoriaEditar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopMarca->getDataSource();

            try {

                $this->datasource->begin();

                if (empty($this->request->params['pass']['2'])) {
                    $this->setMsgAlertError(ERROR_PROCESS);
                    self::redirecionaPaginaCategoria('listar');
                }

                if (!is_numeric($this->request->params['pass']['2'])) {
                    $this->setMsgAlertError(ERROR_PROCESS);
                    self::redirecionaPaginaCategoria('listar');
                }

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/
                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $error = false;
                    if (Tools::getValue('activity_shop') == '') {
                        $this->set('error_activity_shop', true);
                        $error = true;
                    }

                    if (Tools::getValue('nome') == '') {
                        $this->set('error_nome', true);
                        $error = true;
                    }

                    if (Tools::getValue('descricao') != '') {
                        if (strlen(Tools::getValue('descricao')) > 128) {
                            $this->set('error_descricao_comp', strlen(Tools::getValue('descricao')));
                            $error = true;
                        }
                    }

                    if (Tools::getValue('description') != '') {
                        if (strlen(Tools::getValue('description')) > 128) {
                            $this->set('error_description_comp', strlen(Tools::getValue('description')));
                            $error = true;
                        }
                    }

                    /*
                     * Cadastra se no db, se não houver erros
                     */
                    if ($error !== true) {

                        /*
                         * Verifica se a categoria já existe
                         */
                        $conditions = array(
                            'conditions' => array(
                                'ShopCategoria.id_categoria !=' => $this->request->params['pass']['2'],
                                'ShopCategoria.nome_categoria' => Tools::clean(Tools::getValue('nome')),
                                'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                            )
                        );

                        if ($this->ShopCategoria->find('count', $conditions) > 0) {
                            throw new \Exception\VialojaOverflowException('Já existe uma categoria com este nome. Tente novamente.', E_USER_WARNING);
                        }

                        $fields = array(

                            'ShopCategoria.ativa' => sprintf("'%s'", Tools::clean(Tools::getValue('ativa'))),
                            'ShopCategoria.id_atividade' => sprintf("'%s'", Tools::clean(Tools::getValue('activity_shop'))),
                            'ShopCategoria.nome_categoria' => sprintf("'%s'", Tools::clean(Tools::getValue('nome'))),
                            'ShopCategoria.apelido' => sprintf("'%s'", Tools::clean(Tools::getValue('apelido'))),
                            'ShopCategoria.url' => sprintf("'%s'", Tools::clean(Tools::getValue('url'))),
                            'ShopCategoria.descricao' => sprintf("'%s'", Tools::clean(Tools::getValue('descricao'))),
                            'ShopCategoria.title' => sprintf("'%s'", Tools::clean(Tools::getValue('title'))),
                            'ShopCategoria.description' => sprintf("'%s'", Tools::clean(Tools::getValue('description')))

                        );

                        $conditions = array(
                            'ShopCategoria.id_categoria' => $this->request->params['pass']['2'],
                            'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                        );

                        $ok = $this->ShopCategoria->updateAll($fields, $conditions);

                        if (Tools::getValue('ativa') == 'False') {

                            $array_id = explode('#', self::categoriaNLeft($this->request->params['pass']['2']));

                            $fields = array(
                                'ShopCategoria.ativa' => sprintf("'%s'", Tools::clean(Tools::getValue('ativa')))
                            );

                            $conditions = array(
                                'ShopCategoria.id_categoria' => array_filter($array_id),
                                'ShopCategoria.id_shop_default' => $this->Session->read('id_shop')
                            );

                            $ok = $this->ShopCategoria->updateAll($fields, $conditions);

                        }

                        if (is_bool($ok) && $ok === true) {

                            $this->ShopUrlUso->deleteAll(array(
                                'ShopUrlUso.base_url' => 'root',
                                'ShopUrlUso.id_referencia_categoria' => $this->request->params['pass']['2']
                            ));

                            $data = array(
                                'id_referencia_categoria' => $this->request->params['pass']['2'],
                                'base_url' => 'root',
                                'url' => Tools::clean(Tools::getValue('url'))
                            );

                            $this->ShopUrlUso->saveAll($data);

                            $this->setMsgAlertSuccess('Categoria editada com sucesso!');
                            self::redirecionaPaginaCategoria('listar');

                        } else {
                            throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                        }

                    } else {

                        throw new \RuntimeException("Por favor, verifique os erros encontrados.", E_USER_WARNING);

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\Exception\VialojaOverflowException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);

            }

        }

    }

    /**
     * Lista marca
     * @access public
     * @param String $id_shop id do Shop
     *
     */
    public function marcaListar()
    {

        try {

            $conditions = array(
                'conditions' => array(
                    'ShopMarca.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array(
                    'ShopMarca.nome' => 'ASC'
                ),
                'limit' => $this->limit,
                'paramType' => 'querystring'
            );

            /**
             *
             * Paginação de conteúdo do tópicos
             *
             **/
            $this->paginate = $conditions;

            // Roda a consulta, já trazendo os resultados paginados
            $this->res_marca = $this->paginate('ShopMarca');

            $this->set('res_marca', $this->res_marca);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

        if ($this->Session->read('marca_nome')) {
            $this->set('flash_marca_nome', $this->Session->read('marca_nome'));
            $this->Session->delete('marca_nome');
        }

        $diretorio = CDN_UPLOAD . $this->Session->read('id_shop') . '/';
        $this->set('dir_marcas', $diretorio . 'marcas' . '/');

        $this->set('title_for_layout', 'Listar marcas');


        $this->configCSRFGuard();

    }

    /**
     * Criar marca via ajax
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function marcaCriar_json()
    {

        $this->render(false);

        if (!$this->request->is('post')) {
            return false;
        }

        if (!$this->request->is('ajax')) {
            return false;
        }

        $this->datasource = $this->ShopMarca->getDataSource();

        try {

            $this->datasource->begin();

            $conditions = array(
                'conditions' => array(
                    'ShopMarca.nome' => Tools::clean(Tools::getValue('nome')),
                    'ShopMarca.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopMarca->find('count', $conditions) <= 0) {

                $data = array(
                    'id_shop_default' => $this->Session->read('id_shop'),
                    'nome' => Tools::clean(Tools::getValue('nome')),
                    'apelido' => Tools::slug(Tools::clean(Tools::getValue('nome')))
                );

                if ($this->ShopMarca->saveAll($data)) {
                    $this->json['estado'] = 'SUCESSO';
                    $this->json['id'] = $this->ShopMarca->getLastInsertId();
                    $this->json['nome'] = Tools::clean(Tools::getValue('nome'));
                }

            } else {
                $this->json['estado'] = 'ERRO';
                $this->json['mensagem'] = 'Erro ao criar marca. Nome já existe.';
            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->json['estado'] = 'ERRO';
            $this->json['mensagem'] = ERROR_PROCESS;
            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);

        } finally {

            $this->json['resposta'] = $this->json;
            header('Content-Type: application/json');
            echo json_encode($this->json);
            exit();

        }

    }

    /**
     * Criar Marca
     * @access public
     * @param String $id_shop id do Shop
     *
     */
    public function marcaCriar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopMarca->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/
                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $error = false;
                    if (Tools::getValue('nome') == '') {
                        $this->set('error_nome', true);
                        $error = true;
                    }

                    if (Tools::getValue('descricao') != '') {
                        if (strlen(Tools::getValue('descricao')) > 128) {
                            $this->set('error_descricao_comp', strlen(Tools::getValue('descricao')));
                            $error = true;
                        }
                    }

                    /*
                     * Cadastra se no db, se não houver erros
                     */
                    if ($error !== true) {

                        $conditions = array(
                            'conditions' => array(
                                'ShopMarca.nome' => Tools::clean(Tools::getValue('nome')),
                                'ShopMarca.id_shop_default' => $this->Session->read('id_shop')
                            )
                        );

                        if ($this->ShopMarca->find('count', $conditions) > 0) {
                            throw new \Exception\VialojaOverflowException("Erro ao criar marca. Nome já existe.", E_USER_WARNING);
                        }

                        $this->logo = self::envia_logo_marcas();

                        if (Tools::getValue('nome') != "" || $this->logo !== null) {

                            $data = array(
                                'id_shop_default' => $this->Session->read('id_shop'),
                                'ativo' => Tools::clean(Tools::getValue('ativo')),
                                'destaque' => Tools::clean(Tools::getValue('destaque')),
                                'nome' => Tools::clean(Tools::getValue('nome')),
                                'apelido' => Tools::slug(Tools::clean(Tools::getValue('apelido'))),
                                'descricao' => Tools::clean(Tools::getValue('descricao')),
                                'logo' => $this->logo
                            );

                            if ($this->ShopMarca->saveAll($data)) {

                                $this->setMsgAlertSuccess('Marca criada com sucesso!');
                                self::redirecionaPaginaMarca('editar', $this->ShopMarca->getInsertID());

                            } else {
                                throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                            }

                        } else {
                            throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                        }

                    } else {
                        throw new \RuntimeException('Por favor, verifique o erro abaixo.', E_USER_WARNING);
                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\Exception\VialojaOverflowException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);

            }

        }

        $this->set('url_shop', self::getDominio());

        $this->set('title_for_layout', 'Criar marca');


        $this->configCSRFGuard();

    }

    /**
     * Upload de logotipo marca
     * @access private
     * @param Array $arquivo file
     * @param String $id_shop variavel de sessão
     *
     */
    private function envia_logo_marcas()
    {

        $arquivo = isset($_FILES['imagem']) ? $_FILES['imagem'] : false;

        if (empty($arquivo['name']) && empty($arquivo['tmp_name'])) {
            return null;
        }

        $diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'marcas' . DS;
        /**
         *
         * Verifica se o diretorio existe or cria
         *
         **/
        Tools::createFolder($diretorio);

        $img_name = $arquivo['name'];
        $img_temp = $arquivo['tmp_name'];

        if (!Validate::isMaxSize($arquivo['size'])) {
            throw new \InvalidArgumentException("O arquivo enviado é muito grande, envie arquivos de no máximo 2Mb.", E_USER_WARNING);
        }

        if (!Validate::isImage($arquivo)) {
            throw new \InvalidArgumentException("<b>Atenção! </b>Envie uma imagem válida. O arquivo enviado não é uma imagem ou está corrompido.", E_USER_WARNING);
        }

        $path_img = Validate::checkNameFile($img_name, $diretorio);

        if (isset($path_img)) {

            move_uploaded_file($img_temp, $diretorio . $path_img);
            $original = WideImage::load($diretorio . $path_img);
            $original->resize(150, 70, 'inside')->saveToFile($diretorio . $path_img);
            $original->destroy();

            return $path_img;

        } else {
            throw new \RuntimeException("<b>Atenção!</b> Não foi possivel efetuar o upload do arquivo, tente novamente!", E_USER_WARNING);
        }

    }

    private function redirecionaPaginaMarca($value = 'listar', $id = '')
    {

        return $this->redirect(array(
            'controller' => 'catalogo',
            'action' => 'marca',
            $value,
            $id
        ));

    }

    /**
     * Marca Editar
     * @access public
     * @param String $id_shop id do Shop
     * @param String $nome nome da marca
     * @param String $id damarca
     * @return array
     */
    public function marcaEditar()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopMarca->getDataSource();

            try {

                $this->datasource->begin();

                if (empty($this->request->params['pass']['2'])) {
                    throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
                }

                if (!is_numeric($this->request->params['pass']['2'])) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/
                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $error = false;
                    if (Tools::getValue('nome') == '') {
                        $this->set('error_nome', true);
                        $error = true;
                    }

                    if (Tools::getValue('descricao') != '') {
                        if (strlen(Tools::getValue('descricao')) > 128) {
                            $this->set('error_descricao_comp', strlen(Tools::getValue('descricao')));
                            $error = true;
                        }
                    }

                    /*
                     * Cadastra se no db, se não houver erros
                     */
                    if ($error !== true) {

                        $conditions = array(
                            'conditions' => array(
                                'ShopMarca.nome' => Tools::clean(Tools::getValue('nome')),
                                'ShopMarca.id_marca !=' => $this->request->params['pass']['2'],
                                'ShopMarca.id_shop_default' => $this->Session->read('id_shop')
                            )
                        );

                        if ($this->ShopMarca->find('count', $conditions) > 0) {
                            throw new \Exception\VialojaOverflowException("Erro ao criar marca. Nome já existe.", E_USER_WARNING);
                        }

                        $this->logo = self::envia_logo_marcas();

                        if (isset($this->logo) && is_string($this->logo)) {

                            $diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'marcas' . DS;

                            $conditions = array(
                                'conditions' => array(
                                    'ShopMarca.id_shop_default' => $this->Session->read('id_shop'),
                                    'ShopMarca.id_marca' => $this->request->params['pass']['2']
                                )
                            );

                            $this->marcas = $this->ShopMarca->find('all', $conditions);
                            foreach ($this->marcas as $this->marca) {

                                if (!empty($this->marca['ShopMarca']['logo'])) {
                                    Tools::deleteFile($diretorio . $this->marca['ShopMarca']['logo']);
                                }

                            }

                            $fields = array(

                                'ShopMarca.ativo' => sprintf("'%s'", Tools::clean(Tools::getValue('ativo'))),
                                'ShopMarca.destaque' => sprintf("'%s'", Tools::clean(Tools::getValue('destaque'))),
                                'ShopMarca.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome'))),
                                'ShopMarca.apelido' => sprintf("'%s'", Tools::slug(Tools::clean(Tools::getValue('apelido')))),
                                'ShopMarca.descricao' => sprintf("'%s'", Tools::clean(Tools::getValue('descricao'))),
                                'ShopMarca.logo' => sprintf("'%s'", $this->logo)

                            );

                        } else {

                            $fields = array(

                                'ShopMarca.ativo' => sprintf("'%s'", Tools::clean(Tools::getValue('ativo'))),
                                'ShopMarca.destaque' => sprintf("'%s'", Tools::clean(Tools::getValue('destaque'))),
                                'ShopMarca.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome'))),
                                'ShopMarca.apelido' => sprintf("'%s'", Tools::slug(Tools::clean(Tools::getValue('apelido')))),
                                'ShopMarca.descricao' => sprintf("'%s'", Tools::clean(Tools::getValue('descricao')))

                            );

                        }

                        $conditions = array(
                            'ShopMarca.id_marca' => $this->request->params['pass']['2'],
                            'ShopMarca.id_shop_default' => $this->Session->read('id_shop')
                        );

                        $ok = $this->ShopMarca->updateAll($fields, $conditions);

                        if (is_bool($ok) && $ok === true) {
                            $this->setMsgAlertSuccess('Marca editada com sucesso!');
                        } else {
                            throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                        }

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\NotFoundException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\Exception\VialojaOverflowException $e) {

                $this->setMsgAlertError($e->getMessage());
                return $this->redirect(Tools::getUrl());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);

            } finally {

                self::redirecionaPaginaMarca('listar');

            }

        }

        try {

            $conditions = array(
                'conditions' => array(
                    'ShopMarca.id_marca' => $this->request->params['pass']['2'],
                    'ShopMarca.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopMarca->find('count', $conditions) <= 0) {
                throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->set('res_marca', $this->ShopMarca->find('all', $conditions));

            $this->set('url_shop', self::getDominio());

            $diretorio = CDN_UPLOAD . $this->Session->read('id_shop') . '/';
            $this->set('dir_marcas', $diretorio . 'marcas' . '/');

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaMarca('listar');

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaMarca('listar');

        }

        $this->set('title_for_layout', 'Editar marca');


        $this->configCSRFGuard();

    }

    /**
     * Marca Remover
     * @access public
     * @param String $id_shop id do Shop
     * @param String $id da marca
     * @return array
     */
    public function marcaRemover()
    {

        if (!$this->request->is('post')) {
            $this->setMsgAlertError(ERROR_PROCESS);
            self::redirecionaPaginaMarca('listar');
        }

        $this->datasource = $this->ShopMarca->getDataSource();

        try {

            $this->datasource->begin();

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/
            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            } else {

                if (!isset($this->request->data['marcas']) || empty($this->request->data['marcas'])) {
                    throw new \NotFoundException(ERROR_PROCESS);
                }

                $conditions = array(
                    'fields' => array(
                        'ShopMarca.id_marca',
                        'ShopMarca.nome',
                        'ShopMarca.apelido'
                    ),
                    'conditions' => array(
                        'ShopMarca.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopMarca.id_marca' => array_map('intval', $this->request->data['marcas'])
                    ),
                    'order' => array(
                        'ShopMarca.nome' => 'ASC'
                    )
                );

                $this->res_marca = $this->ShopMarca->find('all', $conditions);

                $this->set('res_marca', $this->res_marca);

                if (isset($this->request->data['confirmacao'])) {

                    $this->marcas = array();
                    foreach ($this->res_marca as $this->marca) {
                        array_push($this->marcas, $this->marca['ShopMarca']['nome']);
                    }

                    $this->Session->write('marca_nome', $this->marcas);

                }

            }

            $this->datasource->commit();

            if (isset($this->request->data['confirmacao'])) {

                $diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'marcas' . DS;

                $conditions = array(
                    'conditions' => array(
                        'ShopMarca.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopMarca.id_marca' => array_map('intval', $this->request->data['marcas'])
                    )
                );

                $this->marcas = $this->ShopMarca->find('all', $conditions);
                foreach ($this->marcas as $this->marca) {
                    Tools::deleteFile($diretorio . $this->marca['ShopMarca']['logo']);
                }

                $ok = $this->ShopMarca->deleteAll(array(
                    'ShopMarca.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopMarca.id_marca' => $this->request->data['marcas']
                ));

                if (is_bool($ok) && $ok === true) {
                    self::redirecionaPaginaMarca('listar');
                } else {
                    $this->setMsgAlertError(ERROR_PROCESS);
                    self::redirecionaPaginaMarca('listar');
                }

            }

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            self::redirecionaPaginaMarca('listar');

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());
            self::redirecionaPaginaMarca('listar');

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());
            self::redirecionaPaginaMarca('listar');

        }


        $this->configCSRFGuard();

        $this->set('title_for_layout', 'Remover marca');

    }

    /**
     * Listar grade
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function gradeListar()
    {

        $this->set('res_grade', self::result_grade_all());
        $this->set('title_for_layout', 'Listar grades');

    }

    /**
     * Criar grade
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function gradeCriar()
    {

        if ($this->request->is('post')) {

            try {

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
                }

                $this->requestAction(
                    array(
                        'controller' => 'ShopGrade',
                        'action' => 'criarGrade'
                    )
                );

            } catch (\Exception $e) {

                $this->setMsgAlertError($e->getMessage());

            }

        }

        $this->set('title_for_layout', 'Criar grade');


        $this->configCSRFGuard();

    }

    /**
     * Remover grade
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $id da grade
     *
     */
    public function gradeRemover()
    {

        if ($this->request->is('post')) {

            try {

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
                }

                $this->requestAction(
                    array(
                        'controller' => 'ShopGrade',
                        'action' => 'removerGrade',
                        'id_grade' => intval($this->request->params['pass']['2'])
                    )
                );

            } catch (\Exception $e) {

                $this->setMsgAlertError($e->getMessage());

            } finally {

                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => 'grade',
                    'listar'
                ));

            }

        }

        self::result_dados_grade();

        $this->set('title_for_layout', 'Remover a grade');


        $this->configCSRFGuard();

    }

    /**
     * Retorna os dados da grade via ID
     * @return array
     */
    private function result_dados_grade()
    {

        try {

            $grade = $this->ShopGrade->getDadosGradeId($this->Session->read('id_shop'), $this->request->params['pass']['2']);
            $this->set(compact('grade'));

        } catch (\Exception $e) {

            $this->setMsgAlertError($e->getMessage());

            return $this->redirect(array(
                'controller' => $this->request->controller,
                'action' => 'grade',
                'listar'
            ));

        }

    }

    /**
     * Editar grade
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $id da grade
     *
     */
    public function gradeEditar()
    {

        if ($this->request->is('post')) {

            try {

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
                }

                $this->requestAction(
                    array(
                        'controller' => 'ShopGrade',
                        'action' => 'gradeEditar',
                        'id_grade' => intval($this->request->params['pass']['2'])
                    )
                );

            } catch (\Exception $e) {

                $this->setMsgAlertError($e->getMessage());
                $this->set('error_grade', true);

            }

        }

        try {

            $this->Session->write('referer', Tools::getUrl());

            self::result_dados_grade();

            $res_variacao = $this->ShopGradeVariacao->getVariacaoAll(intval($this->request->params['pass']['2']));
            $this->set(compact('res_variacao'));

            if (isset($this->request->query['next'])) {
                $this->Session->write('url_return', $this->request->query['next']);
            }

        } catch (\Exception $e) {

            $this->setMsgAlertError($e->getMessage());

        }

        $this->set('title_for_layout', 'Editar grade');


        $this->configCSRFGuard();

    }


    /**
     * Criar variação
     * @access public
     * @param String $id_shop variavel de sessão
     *
     */
    public function variacaoCriar()
    {

        if ($this->request->is('post')) {

            try {

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
                }

                if (!v::numeric()->notBlank()->validate($this->request->params['pass']['1'])) {
                    throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
                }

                $this->requestAction(
                    array(
                        'controller' => 'ShopGradeVariacao',
                        'action' => 'criarVariacao',
                        'id_grade' => intval($this->request->params['pass']['1'])
                    )
                );

            } catch (\Exception $e) {

                $this->setMsgAlertError($e->getMessage());

                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => 'grade',
                    $this->request->params['pass']['1'],
                    'variacao',
                    'criar'
                ));

            }

        }

        if ($this->Session->read('nome_variacao')) {
            $this->set('nome_variacao', $this->Session->read('nome_variacao'));
        }

        if ($this->Session->read('error_variacao')) {
            $this->set('error_variacao', true);
            $this->Session->delete('error_variacao');
        }

        $this->set('id_grade', $this->request->params['pass']['1']);


        $this->configCSRFGuard();

    }

    /**
     * Remover variação
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $id da variacao
     *
     */
    public function variacaoRemover()
    {

        self::result_variacao_id();

        if ($this->request->is('post')) {

            try {

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
                }

                $this->requestAction(
                    array(
                        'controller' => 'ShopGradeVariacao',
                        'action' => 'removerVariacao',
                        'id_grade' => intval($this->request->params['pass']['1']),
                        'id_variacao' => intval($this->request->params['pass']['4'])
                    )
                );

            } catch (\Exception $e) {
                $this->setMsgAlertError($e->getMessage());
            } finally {
                return $this->redirect($this->Session->read('referer'));
            }

        }

        extract(get_object_vars($this));
        $this->set(compact('res_variacao'));

        $this->set('title_for_layout', 'Remover opção da grade');


        $this->configCSRFGuard();

    }

    /**
     * Retorna Variação
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $id da variacao
     *
     */
    public function result_variacao_id()
    {

        try {

            $id_grade = intval($this->request->params['pass']['1']);
            $id_variacao = intval($this->request->params['pass']['4']);

            $this->res_variacao = $this->ShopGradeVariacao->getVariacaoId($id_grade, $id_variacao);

        } catch (\Exception $e) {
            $this->setMsgAlertError($e->getMessage());
            return $this->redirect($this->Session->read('referer'));
        }

    }

    /**
     * Editar variação
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $id da variacao
     *
     */
    public function variacaoEditar()
    {

        self::result_variacao_id();

        if ($this->request->is('post')) {

            try {

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
                }

                $this->requestAction(
                    array(
                        'controller' => 'ShopGradeVariacao',
                        'action' => 'editarVariacao',
                        'id_grade' => intval($this->request->params['pass']['1']),
                        'id_variacao' => intval($this->request->params['pass']['4'])
                    )
                );

            } catch (\Exception $e) {
                $this->setMsgAlertError($e->getMessage());
            } finally {
                $this->set('error_variacao', true);
                return $this->redirect($this->Session->read('referer'));
            }

        }

        extract(get_object_vars($this));
        $this->set(compact('res_variacao'));

        $this->set('title_for_layout', 'Editar variação');


        $this->configCSRFGuard();

    }


    /**
     * Upload de arquivo XLS
     * Atualização de dados de produtos por demanda
     */
    public function produtoImportarValidacao() {

        try {

            if (!$this->request->is('post')) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            $CSRFGuard = new CSRFGuard();
            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());
            return $this->redirect($this->referer());

        }

        try {

            /*
            if ($this->Session->read('limite_produto_importacao')) {
                if ($this->Session->read('limite_produto_importacao') <= 0) {
                    throw new \Exception\VialojaOverflowException('Limite importação ultrapassado para esta conta.', E_USER_WARNING);
                }
            } else {
                throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
            }*/


            if (v::identical(Tools::getValue('atualizar'))->validate('True')) {

                $this->requestAction(
                    array(
                        'controller' => 'ImportarProdutosAtualizar',
                        'action' => 'recebeDadosExcelXLSX'
                    )
                );

            } else {

                $this->requestAction(
                    array(
                        'controller' => 'ImportarProdutosAdicionar',
                        'action' => 'recebeDadosExcelXLSX'
                    )
                );

            }

        } catch (\Exception\VialojaOverflowException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError($e->getMessage());

        } finally {

            return $this->redirect($this->referer());

        }

    }

    /**
     * Upload de arquivo XLS
     * @access public
     * @param String $id_shop variavel de sessão
     * @param Array
     *
     */
    public function produtoImportar()
    {

        self::calcula_produto_uso(__FUNCTION__);


        $this->set('title_for_layout', 'Importar produtos');


        $this->configCSRFGuard();

    }

    /**
     * Grade Variacao
     * @return int
     */
    public function gradeCor()
    {

        $this->layout = 'ajax_cor';

        try {

            if (!$this->request->is('ajax')) {
                return false;
            }

            if (empty($this->request->data['grade_id'])) {
                return false;
            }

            if (!is_numeric($this->request->data['grade_id'])) {
                return false;
            }

            $result = $this->requestAction(
                array(
                    'controller' => 'ShopGradeVariacao',
                    'action' => 'getVariacaoNomeHex',
                    'grade_id' => $this->request->data['grade_id']
                )
            );

            $this->set('res_variacao_cor', $result);
            $this->set('grade_id', $this->request->data['grade_id']);

        } catch (\Exception $e) {
            return false;
        }

    }

    /**
     * Produto Varição Vincular
     * @access public
     * @param String $grade_variacao_id da grade io variação
     */
    public function produtoVariacaoVincular()
    {

        $this->render(false);

        if ($this->request->is('post')) {

            if (!$this->request->is('ajax')) {
                return false;
            }

            //{"estado": "ERRO", "mensagem": "A quantidade de varia\u00e7\u00f5es deve ser igual a quantidade de grades relacionadas ao produto: 8"}

            try {

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if ($CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    if (isset($this->request->params['pass']['4'])
                        && is_numeric($this->request->params['pass']['4'])
                    ) {

                        $error = true;

                        if (isset($this->request->data['grade_variacao_id'])
                            && is_array($this->request->data['grade_variacao_id'])
                        ) {
                            foreach ($this->request->data['grade_variacao_id'] as $key => $value) {
                                $value = trim($value);
                                if (empty($value))
                                    $error = true;
                                else
                                    $error = false;
                            }
                        }

                        if (isset($this->request->data['grade_variacao_id_cor'])
                            && is_array($this->request->data['grade_variacao_id_cor'])
                        ) {

                            foreach ($this->request->data['grade_variacao_id_cor'] as $key => $value) {
                                $value = trim($value);
                                if (empty($value))
                                    $error = true;
                                else
                                    $error = false;
                            }
                        }

                        if ($error !== false) {

                            $this->json['estado'] = "ERRO";
                            $this->json['mensagem'] = "Uma ou mais variações de grade não foram selecionadas";

                        } else {

                            $conditions = array(

                                'fields' => array(
                                    'ShopProduto.sku'
                                ),

                                'conditions' => array(
                                    'ShopProduto.sku' => Tools::clean(Tools::cleanSKU(Tools::getValue('sku'))),
                                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                                )
                            );

                            if ($this->ShopProduto->find('count', $conditions) > 0) {

                                $this->json['campos_com_erro'] = ["sku"];
                                $this->json['estado'] = "ERRO";
                                $this->json['mensagem'] = "Código do produto (SKU): Um produto com o código SKU inserido já existe.";

                            } else {

                                /**
                                 *
                                 * Add variação normal
                                 *
                                 **/

                                $this->id_produto = $this->request->params['pass']['4'];
                                $id_produto_filho = self::enviaDadosProdutoViaRequestActionFilho($this->id_produto);

                                if (isset($this->request->data['grade_variacao_id'])
                                    && is_array($this->request->data['grade_variacao_id'])
                                ) {

                                    foreach ($this->request->data['grade_variacao_id'] as $key => $variacao) {

                                        $getVariacao = $this->ShopGradeVariacao->getIdVariacao($this->request->data['grade_id'][$key], $variacao);

                                        # code...
                                        $data = array(
                                            'id_produto_default' => $id_produto_filho,
                                            'id_grade_default' => $this->request->data['grade_id'][$key],
                                            'id_grade_variacao_default' => $getVariacao,
                                            'nome' => $variacao
                                        );

                                        $this->ShopProdutoVariacao->saveAll($data);

                                    }

                                }

                                /**
                                 *
                                 * Add varição cor
                                 *
                                 **/

                                if (isset($this->request->data['grade_variacao_id_cor'])
                                    && is_array($this->request->data['grade_variacao_id_cor'])
                                ) {

                                    foreach ($this->request->data['grade_variacao_id_cor'] as $key => $variacao_id) {
                                        # code...
                                        $data = array(
                                            'id_produto_default' => $id_produto_filho,
                                            'id_grade_default' => Tools::getValue('grade_id_cor'),
                                            'id_grade_variacao_default' => $variacao_id,
                                            'nome' => Tools::getValue('grade_variacao_cor'),
                                            'cor' => 'True'
                                        );

                                        $this->ShopProdutoVariacao->saveAll($data);

                                    }

                                }

                                $this->Session->write('add_produto_filho', true);

                                $this->json['estado'] = "SUCESSO";
                                $this->json['mensagem'] = "Variação criada com sucesso.";
                                $this->json['id'] = $this->id_produto;

                            }

                        }

                    }

                }

            } catch (\PDOException $e) {

                $this->json['estado'] = "ERRO";
                $this->json['mensagem'] = ERROR_PROCESS;
                \Exception\VialojaDatabaseException::errorHandler($e);

            } finally {

                header('Content-Type: application/json');
                echo json_encode($this->json);
                exit();

            }

        }

    }

    /**
     * Add dados do Produto filho
     * @access public
     * @param Int $parente_id id_produto de produto
     */
    private function enviaDadosProdutoViaRequestActionFilho($parente_id = null)
    {

        return $this->requestAction(
            array(
                'controller' => 'ShopProduto',
                'action' => 'adicionarDadosProdutoFilho',
                'parente_id' => $parente_id
            )
        );

    }

    /**
     * Remover grade de produto
     * @access public
     * @param String $id_produto de produto
     * @param String $id_grade da grade
     *
     */
    public function produtoGradeRemover()
    {

        $this->render(false);
        try {

            $id_produto = $this->request->params['pass']['3'];
            $id_grade = $this->request->params['pass']['4'];

            if (is_numeric($id_produto) && is_numeric($id_grade)) {

                $ok = $this->ShopProdutoGrade->deleteAll(array(
                    'ShopProdutoGrade.id_grade_default' => $id_grade,
                    'ShopProdutoGrade.id_produto_default' => $id_produto
                ));

                if (is_bool($ok) && $ok === true) {
                    $this->setMsgAlertSuccess('Grade removida com sucesso.');
                } else {
                    throw new \RuntimeException(ERROR_PROCESS);
                }

            }


        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError($e->getMessage());

        } finally {

            if ($this->referer()) {
                return $this->redirect($this->referer());
            } else {
                self::redirecionaPaginaProduto('listar');
            }

        }

    }

    /**
     * Associa imagem ao produto
     * @access public
     * @param String $id_imagem id da imagem
     * @param String $id_produto de produto
     * @param String $id_varicao da varição
     *
     */
    public function produtoGradeImagem()
    {

        $this->render(false);

        $this->datasource = $this->ShopProdutoImagemAssociada->getDataSource();

        try {

            $this->datasource->begin();

            if ($this->request->is('get')) {

                if (isset($this->request->query['produto_id']) && isset($this->request->query['variacao_id']) ) {

                    $conditions = array(

                        'fields' => array(
                            'ShopProdutoImagemAssociada.id_imagem_default'
                        ),

                        'conditions' => array(
                            'ShopProdutoImagemAssociada.id_produto_default' => $this->request->query['produto_id'],
                            'ShopProdutoImagemAssociada.id_variacao_default' => $this->request->query['variacao_id']
                        )
                    );

                    $total = $this->ShopProdutoImagemAssociada->find('count', $conditions);

                    if ($total > 0) {

                        $result = $this->ShopProdutoImagemAssociada->find('all', $conditions);

                        foreach ($result as $key => $linha) {

                            if ($total == $key + 1) {

                                array_push($this->json, $linha['ShopProdutoImagemAssociada']['id_imagem_default']);

                            } else {

                                array_push($this->json, $linha['ShopProdutoImagemAssociada']['id_imagem_default']);

                            }

                        }

                    }

                }

                header('Content-Type: application/json');
                echo json_encode($this->json);
                exit();

            }

            if ($this->request->is('post')) {

                if (isset($this->request->params['pass']['3'])) {

                    $this->json['status'] = "sucesso";
                    if ($this->request->params['pass']['3'] == 'associar') {

                        $data = array(
                            'id_imagem_default' => Tools::clean(Tools::getValue('imagem_id')),
                            'id_produto_default' => Tools::clean(Tools::getValue('produto_id')),
                            'id_variacao_default' => Tools::clean(Tools::getValue('variacao_id'))
                        );

                        $this->ShopProdutoImagemAssociada->saveAll($data);
                        $this->json['mensagem'] = "Imagem associada com sucesso";

                    } elseif ($this->request->params['pass']['3'] == 'desassociar') {

                        $this->ShopProdutoImagemAssociada->deleteAll(array(
                            'ShopProdutoImagemAssociada.id_imagem_default' => Tools::clean(Tools::getValue('imagem_id')),
                            'ShopProdutoImagemAssociada.id_produto_default' => Tools::clean(Tools::getValue('produto_id')),
                            'ShopProdutoImagemAssociada.id_variacao_default' => Tools::clean(Tools::getValue('variacao_id'))
                        ));

                        $this->json['mensagem'] = "Imagem desassociada com sucesso";
                    }
                }
            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->json['mensagem'] = ERROR_PROCESS;
            \Exception\VialojaDatabaseException::errorHandler($e);

        } finally {

            header('Content-Type: application/json');
            echo json_encode($this->json);
            exit();

        }

    }


    /**
     * Vincular grade ao produto
     * @access public
     * @param String $id_produto de produto
     * @param String $id_grade da grade
     *
     */
    public function produtoGradeVincular()
    {

        $this->render(false);

        if (!$this->request->is('post')) {

            if ($this->referer()) {
                return $this->redirect($this->referer());
            } else {
                self::redirecionaPaginaProduto('listar');
            }

        }

        try {

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/
            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            } else {

                if (Tools::getValue('id_produto') != '') {

                    $result = self::adicionaGradeAoProduto(Tools::getValue('id_produto'));

                    if ($result === 'ERROR_COR_DUPLICADA') {
                        throw new \InvalidArgumentException("Escolha apenas 1 grade do tipo Cor", E_USER_WARNING);
                    }

                    if ($result === true) {
                        $this->setMsgAlertSuccess('Grade adicionada com sucesso.');
                    } else {
                        $this->setMsgAlertError('Não foi possível adicionar a grade ao produto.');
                    }

                    if (Tools::getValue('next') != '') {
                        return $this->redirect(Tools::getValue('next'));
                    } else {
                        return $this->redirect($this->referer());
                    }

                } else {
                    throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                }

            }

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError($e->getMessage());

        } finally {

            if ($this->referer()) {
                return $this->redirect($this->referer());
            } else {
                self::redirecionaPaginaProduto('listar');
            }

        }

    }

}
