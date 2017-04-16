<?php

use Lib\Tools;
use Respect\Validation\Validator as v;


class ShopProdutoController extends AppController {

	public $uses = array('ShopProduto', 'ShopUrlUso');
    private $nome_produto;
    private $ativo = 'False';
    private $sku;
    private $url;
    private $quantidade;
    private $situacao_sem_estoque;
    private $situacao_em_estoque;
    private $id_produto;
    private $status_parente_id;
    private $parente_id;
    private $limit = 25;
    private $busca = null;
    private $default =false;

	public function getProdutoImportar()
	{
		try {

            self::setNomeProdutoVariacaoImportacao();

			$conditions = array(

                'fields' => array(
                    'ShopProduto.id_produto',
                    'ShopProduto.tipo',
                    'ShopProduto.parente_id',
                    'ShopProduto.status_parente_id',
                    'ShopProduto.ativo',
                    'ShopProduto.sku',
                    'ShopProduto.nome',
                    'ShopProduto.gerenciado',
                    'ShopProduto.quantidade',
                    'ShopProduto.preco_custo',
                    'ShopProduto.preco_cheio',
                    'ShopProduto.preco_promocional',
                    'ShopProduto.peso',
                    'ShopProduto.altura',
                    'ShopProduto.largura',
                    'ShopProduto.comprimento'
                ),

                'conditions' => array(
                    'ShopProduto.nome !=' => '',
                    'ShopProduto.lixo' => 'False',
                    'ShopProduto.ativo' => 'True',
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                ),

                'order' => array('ShopProduto.nome' => 'ASC')
            );

            return $this->ShopProduto->find('all', $conditions);

		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

    /**
     * Insere o nome de produtos em variações para importação de dados
     * @return string
     */
    private function setNomeProdutoVariacaoImportacao()
    {
        try {

            $conditions = array(

                'fields' => array(
                    'ShopProduto.parente_id',
                ),

                'conditions' => array(
                    'ShopProduto.parente_id !=' => 0,
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                ),

                'group' => 'ShopProduto.parente_id',
            );

            $data = $this->ShopProduto->find('all', $conditions);

            foreach ($data as $key => $dados) {

                $conditions = array(

                    'fields' => array(
                        'ShopProduto.nome',
                    ),

                    'conditions' => array(
                        'ShopProduto.id_produto' => $dados['ShopProduto']['parente_id'],
                    )
                );

                $data2 = $this->ShopProduto->find('first', $conditions);

                $fields = array(
                    'ShopProduto.nome' => sprintf("'%s'", $data2['ShopProduto']['nome'])
                );

                $conditions = array(
                    'ShopProduto.parente_id' => $dados['ShopProduto']['parente_id'],
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                );

                $this->ShopProduto->updateAll($fields, $conditions);
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /**
     * Add dados do Produto
     * @access public
     * @param String $id_produto de produto
     * @return string
     */
    public function adicionarDadosProduto()
    {

        try {

            if (isset($this->params['named']['envio_submit'])
                && $this->params['named']['envio_submit'] == 'AUTOMATICO'
            ) {

                $this->ativo = 'False';
                $this->sku = 'produto-rascunho-' . date('Y-m-d-H-i-s');
                $this->situacao_em_estoque = null;

            } else {

                if (Tools::getValue('sku') != '') {

                    $this->ativo = Tools::clean(Tools::getValue('ativo'));
                    $this->sku = Tools::clean(Tools::cleanSKU(Tools::getValue('sku')));
                    $this->situacao_em_estoque = Tools::clean(Tools::getValue('situacao_em_estoque'));

                }

                if (Tools::clean(Tools::getValue('ativo') != 'False')
                    && Tools::clean(Tools::getValue('sku') == '')
                ) {

                    $this->sku = Tools::tokenGen();
                    $this->ativo = Tools::clean(Tools::getValue('ativo'));
                    $this->situacao_em_estoque = Tools::clean(Tools::getValue('situacao_em_estoque'));

                }
            }

            if (Tools::clean(Tools::getValue('url')) != '') {
                $this->url = Tools::clean(Tools::getValue('url'));
            } else {
                $this->url = date('Y-m-d-H-i-s');
            }

            $data = array(

                'id_shop_default' => $this->Session->read('id_shop'),
                'id_marca' => Tools::clean(Tools::getValue('marca')),
                'ativo' => $this->ativo,
                'tipo' => Tools::clean(Tools::getValue('tipo')),
                'usado' => Tools::clean(Tools::getValue('usado')),
                'destaque' => Tools::clean(Tools::getValue('destaque')),
                'nome' => Tools::clean(Tools::getValue('nome')),
                'apelido' => Tools::clean(Tools::getValue('apelido')),
                'url' => $this->url,
                'sku' => $this->sku,
                'ncm' => Tools::clean(Tools::getValue('ncm')),
                'preco_sob_consulta' => Tools::clean(Tools::getValue('sob_consulta')),
                'preco_custo' => Tools::convertToDecimal(Tools::getValue('custo')),
                'preco_cheio' => Tools::convertToDecimal(Tools::getValue('cheio')),
                'preco_promocional' => Tools::convertToDecimal(Tools::getValue('promocional')),
                'busca_marca' => Tools::clean(Tools::getValue('busca_marca')),
                'busca_categoria' => Tools::clean(Tools::getValue('busca_categoria')),
                'url_video_youtube' => Tools::clean(Tools::getValue('url_video_youtube')),
                'descricao_completa' => Tools::htmlentitiesUTF8(Tools::getValue('descricao_completa')),
                'title' => Tools::clean(Tools::getValue('title')),
                'description' => Tools::clean(Tools::getValue('description')),
                'peso' => Tools::convertToDecimal(Tools::getValue('peso')),
                'altura' => Tools::clean(Tools::getValue('altura')),
                'largura' => Tools::clean(Tools::getValue('largura')),
                'comprimento' => Tools::clean(Tools::getValue('comprimento')),
                'gerenciado' => Tools::clean(Tools::getValue('gerenciado')),
                'situacao_em_estoque' => $this->situacao_em_estoque,
                'quantidade' => Tools::clean(Tools::getValue('quantidade')),
                'situacao_sem_estoque' => Tools::clean(Tools::getValue('situacao_sem_estoque')),
                'renomear_imagem' => Tools::clean(Tools::getValue('renomear_imagem')),
                'produto_key' => Tools::uniqid(),
                'modified' => date('Y-m-d H:i:s')

            );

            $this->ok = $this->ShopProduto->saveAll($data);

            if (is_bool($this->ok) && $this->ok === true) {

                $this->id_produto = $this->ShopProduto->getInsertID();

                if (Tools::getValue('tipo') == 'atributo') {
                    self::updateStatusProdutoVariacao();
                }

                $data = array(
                    'id_referencia_produto' => $this->id_produto,
                    'base_url' => $this->Session->read('validar_base_url'),
                    'url' => Tools::clean(Tools::getValue('url'))
                );

                $this->ShopUrlUso->saveAll($data);

                return $this->id_produto;

            } else {

                throw new \RuntimeException();

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);
            throw new \Exception(ERROR_PROCESS, E_USER_WARNING);

        } catch (\RuntimeException $e) {

            throw new \Exception(ERROR_PROCESS, E_USER_WARNING);

        } catch (\LogicException $e) {

            exit('Error:' . $e->getMessage());

        }

    }

    public function updateStatusProdutoVariacao()
    {
        try {

            if (empty($this->id_produto)) {
                throw new \LogicException("Valor obrigatório: Informe o id_produto.", E_USER_WARNING);
            }

            if (!is_numeric($this->id_produto)) {
                throw new \LogicException("Valor obrigatório: Informe o id_produto INT.", E_USER_WARNING);
            }

            if (empty($this->ativo)) {
                throw new \LogicException("Valor obrigatório: Informe o ativo.", E_USER_WARNING);
            }

            $this->ShopProduto->updateAll(

                array('ShopProduto.status_parente_id' => sprintf("'%s'", $this->ativo)),
                array(
                    'ShopProduto.id_produto' => $this->id_produto,
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                )

            );

            $this->ShopProduto->updateAll(

                array('ShopProduto.status_parente_id' => sprintf("'%s'", $this->ativo)),
                array(
                    'ShopProduto.parente_id' => $this->id_produto,
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                )

            );

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Edita dados do Produto editDadosProduto
     * @access public
     * @param String $id_produto de produto
     * @return string
     */
    public function editarDadosProduto()
    {

        try {

            if (empty($this->params['named']['id_produto'])) {
                throw new \LogicException("Valor obrigatório: Informe o ID do Produto.", E_USER_WARNING);
            }

            if (!is_numeric($this->params['named']['id_produto'])) {
                throw new \LogicException("Valor obrigatório: Informe o ID do Produto INT.", E_USER_WARNING);
            }

            $this->id_produto = $this->params['named']['id_produto'];

            $this->ativo = 'False';
            $this->sku = 'produto-rascunho-' . date('Y-m-d-H-i-s');
            $this->situacao_em_estoque = null;

            if (Tools::getValue('sku') != '') {
                $this->ativo = Tools::clean(Tools::getValue('ativo'));
                $this->sku = Tools::clean(Tools::cleanSKU(Tools::getValue('sku')));
                $this->situacao_em_estoque = Tools::clean(Tools::getValue('situacao_em_estoque'));
            }

            if (Tools::clean(Tools::getValue('ativo') != 'False')
                && Tools::clean(Tools::getValue('sku') == '')
            ) {

                $this->sku = Tools::tokenGen();
                $this->ativo = Tools::clean(Tools::getValue('ativo'));

            }

            if (Tools::clean(Tools::getValue('url')) != '') {
                $this->url = Tools::clean(Tools::getValue('url'));
            } else {
                $this->url = date('Y-m-d-H-i-s');
            }

            /**
             *
             * Altera para categoria pai
             *
             **/

            if (Tools::getValue('gerenciado') != 'False') {
                $this->quantidade = Tools::clean(Tools::getValue('quantidade'));
                $this->situacao_sem_estoque = Tools::clean(Tools::getValue('situacao_sem_estoque'));
            }

            self::updateStatusProdutoVariacao();
            self::setNomeProdutoVariacao();

            $fields = array(

                'ShopProduto.id_marca' => sprintf("'%s'", Tools::clean(Tools::getValue('marca'))),
                'ShopProduto.ativo' => sprintf("'%s'", $this->ativo),
                'ShopProduto.tipo' => sprintf("'%s'", Tools::clean(Tools::getValue('tipo'))),
                'ShopProduto.usado' => sprintf("'%s'", Tools::clean(Tools::getValue('usado'))),
                'ShopProduto.destaque' => sprintf("'%s'", Tools::clean(Tools::getValue('destaque'))),
                'ShopProduto.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome'))),
                'ShopProduto.apelido' => sprintf("'%s'", Tools::clean(Tools::getValue('apelido'))),
                'ShopProduto.url' => sprintf("'%s'", $this->url),
                'ShopProduto.sku' => sprintf("'%s'", $this->sku),
                'ShopProduto.ncm' => sprintf("'%s'", Tools::clean(Tools::getValue('ncm'))),
                'ShopProduto.preco_sob_consulta' => sprintf("'%s'", Tools::clean(Tools::getValue('sob_consulta'))),
                'ShopProduto.preco_custo' => Tools::convertToDecimal(Tools::clean(Tools::getValue('custo'))),
                'ShopProduto.preco_cheio' => Tools::convertToDecimal(Tools::clean(Tools::getValue('cheio'))),
                'ShopProduto.preco_promocional' => Tools::convertToDecimal(Tools::clean(Tools::getValue('promocional'))),
                'ShopProduto.busca_marca' => sprintf("'%s'", Tools::clean(Tools::getValue('busca_marca'))),
                'ShopProduto.busca_categoria' => sprintf("'%s'", Tools::clean(Tools::getValue('busca_categoria'))),
                'ShopProduto.url_video_youtube' => sprintf("'%s'", Tools::clean(Tools::getValue('url_video_youtube'))),
                'ShopProduto.descricao_completa' => sprintf("'%s'", Tools::htmlentitiesUTF8(Tools::getValue('descricao_completa'))),
                'ShopProduto.title' => sprintf("'%s'", Tools::clean(Tools::getValue('title'))),
                'ShopProduto.description' => sprintf("'%s'", Tools::clean(Tools::getValue('description'))),
                'ShopProduto.peso' => Tools::convertToDecimal(Tools::clean(Tools::getValue('peso'))),
                'ShopProduto.altura' => sprintf("'%s'", Tools::clean(Tools::getValue('altura'))),
                'ShopProduto.largura' => sprintf("'%s'", Tools::clean(Tools::getValue('largura'))),
                'ShopProduto.comprimento' => sprintf("'%s'", Tools::clean(Tools::getValue('comprimento'))),
                'ShopProduto.gerenciado' => sprintf("'%s'", Tools::clean(Tools::getValue('gerenciado'))),
                'ShopProduto.situacao_em_estoque' => sprintf("'%s'", $this->situacao_em_estoque),
                'ShopProduto.quantidade' => sprintf("'%s'", $this->quantidade),
                'ShopProduto.situacao_sem_estoque' => sprintf("'%s'", $this->situacao_sem_estoque),
                'ShopProduto.renomear_imagem' => sprintf("'%s'", Tools::clean(Tools::getValue('renomear_imagem')))

            );

            $conditions = array(
                'ShopProduto.parente_id' => 0,
                'ShopProduto.id_produto' => $this->id_produto,
                'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
            );

            $this->ShopProduto->updateAll($fields, $conditions);

            $this->ShopUrlUso->deleteAll(array(
                'ShopUrlUso.base_url' => $this->Session->read('validar_base_url'),
                'ShopUrlUso.id_referencia_produto' => $this->id_produto
            ));

            $data = array(
                'id_referencia_produto' => $this->id_produto,
                'base_url' => $this->Session->read('validar_base_url'),
                'url' => Tools::clean(Tools::getValue('url'))
            );

            $this->ShopUrlUso->saveAll($data);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);
            throw new \Exception(ERROR_PROCESS, E_USER_WARNING);

        } catch (\LogicException $e) {

            exit('Error:' . $e->getMessage());

        }

    }

    public function setNomeProdutoVariacao()
    {

        try {

            if (empty($this->id_produto)) {
                throw new \LogicException("Valor obrigatório: Informe o id_produto.", E_USER_WARNING);
            }

            $conditions = array(

                'fields' => array(
                    'ShopProduto.parente_id',
                ),

                'conditions' => array(
                    'ShopProduto.id_produto' => $this->id_produto,
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            $data = $this->ShopProduto->find('first', $conditions);


            if (v::notEmpty()->validate($data)) {

                /**
                 * Update Nome
                 * @var array
                 */
                $conditions = array(

                    'fields' => array(
                        'ShopProduto.nome',
                    ),

                    'conditions' => array(
                        'ShopProduto.id_produto' => $data['ShopProduto']['parente_id'],
                    )
                );

                $data2 = $this->ShopProduto->find('first', $conditions);

                if (v::notEmpty()->validate($data2)) {

                    $this->ShopProduto->updateAll(

                        array('ShopProduto.nome' => sprintf("'%s'", $data2['ShopProduto']['nome'])),
                        array(
                            'ShopProduto.parente_id' => $data['ShopProduto']['parente_id'],
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                        )

                    );

                }

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Add dados do Produto filho
     * @access public
     * @param String $id_produto de produto
     * @return string
     */
    public function adicionarDadosProdutoFilho()
    {

        try {

            if (empty($this->params['named']['parente_id'])) {
                throw new \LogicException("Valor obrigatório: Informe o ID do Produto.", E_USER_WARNING);
            }

            if (!is_numeric($this->params['named']['parente_id'])) {
                throw new \LogicException("Valor obrigatório: Informe o ID do Produto INT.", E_USER_WARNING);
            }

            $this->parente_id = $this->params['named']['parente_id'];

            if (Tools::getValue('sku') != '') {
                $this->ativo = Tools::clean(Tools::getValue('ativo'));
                $this->sku = Tools::clean(Tools::cleanSKU(Tools::getValue('sku')));
                $this->situacao_em_estoque = Tools::clean(Tools::getValue('situacao_em_estoque'));
            }

            if (Tools::clean(Tools::getValue('ativo') != 'False')
                && Tools::clean(Tools::getValue('sku') == '')
            ) {

                $this->sku = Tools::tokenGen();
                $this->ativo = Tools::clean(Tools::getValue('ativo'));
                $this->situacao_em_estoque = Tools::clean(Tools::getValue('situacao_em_estoque'));

            }

            $this->sku = Tools::clean(Tools::cleanSKU(Tools::getValue('sku')));

            if ($this->sku == sprintf('%s-', Tools::getValue('sku_master'))) {
                $this->sku = sprintf('%s-%s', Tools::getValue('sku_master'), date('Y-m-d-H-i-s'));
            }

            $this->nome_produto = self::getNomeProdutoVariacao($this->parente_id);
            $this->status_parente_id = self::getStatusProduto($this->parente_id);

            $data = array(

                'id_shop_default' => $this->Session->read('id_shop'),
                'nome' => $this->nome_produto,
                'parente_id' => $this->parente_id,
                'status_parente_id' => $this->status_parente_id,
                'ativo' => $this->ativo,
                'sku' => $this->sku,
                'preco_sob_consulta' => Tools::clean(Tools::getValue('sob_consulta')),
                'preco_custo' => Tools::convertToDecimal(Tools::clean(Tools::getValue('custo'))),
                'preco_cheio' => Tools::convertToDecimal(Tools::clean(Tools::getValue('cheio'))),
                'preco_promocional' => Tools::convertToDecimal(Tools::clean(Tools::getValue('promocional'))),
                'peso' => Tools::convertToDecimal(Tools::clean(Tools::getValue('peso'))),
                'altura' => Tools::clean(Tools::getValue('altura')),
                'largura' => Tools::clean(Tools::getValue('largura')),
                'comprimento' => Tools::clean(Tools::getValue('comprimento')),
                'gerenciado' => Tools::clean(Tools::getValue('gerenciado')),
                'situacao_em_estoque' => $this->situacao_em_estoque,
                'quantidade' => Tools::clean(Tools::getValue('quantidade')),
                'situacao_sem_estoque' => Tools::clean(Tools::getValue('situacao_sem_estoque')),
                'produto_key' => Tools::uniqid(),
                'modified' => date('Y-m-d H:i:s')

            );

            $this->ok = $this->ShopProduto->saveAll($data);

            if (is_bool($this->ok) && $this->ok === true) {
                return $this->ShopProduto->getInsertID();
            } else {
                throw new \RuntimeException(ERROR_PROCESS);
            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);
            throw new \Exception(ERROR_PROCESS);

        } catch (\RuntimeException $e) {

            throw new \Exception(ERROR_PROCESS);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    private function getNomeProdutoVariacao($id_produto = null)
    {
        try {

            if (empty($id_produto)) {
                throw new \LogicException("Valor obrigatório: Informe o id_produto.", E_USER_WARNING);
            }

            $conditions = array(
                'fields' => array(
                    'ShopProduto.nome',
                ),
                'conditions' => array(
                    'ShopProduto.id_produto' => $id_produto,
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            $data = $this->ShopProduto->find('first', $conditions);

            if (v::notEmpty()->validate($data)) {

                $conditions = array(
                    'conditions' => array(
                        'ShopProduto.parente_id' => $id_produto
                    )
                );

                if ($this->ShopProduto->find('count', $conditions) > 0) {

                    $fields = array(
                        'ShopProduto.nome' => sprintf("'%s'", $data['ShopProduto']['nome'])
                    );

                    $conditions = array(
                        'ShopProduto.parente_id' => $id_produto,
                        'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                    );

                    $this->ShopProduto->updateAll($fields, $conditions);

                }

                return $data['ShopProduto']['nome'];

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    private function getStatusProduto($id_produto = null)
    {
        try {

            if (empty($id_produto)) {
                throw new \LogicException("Valor obrigatório: Informe o id_produto.", E_USER_WARNING);
            }

            $conditions = array(

                'fields' => array(
                    'ShopProduto.ativo'
                ),

                'conditions' => array(
                    'ShopProduto.id_produto' => $id_produto
                )
            );

            $data = $this->ShopProduto->find('first', $conditions);

            if (v::notEmpty()->validate($data)) {


                $conditions = array(

                    'conditions' => array(
                        'ShopProduto.parente_id' => $id_produto
                    )
                );

                if ($this->ShopProduto->find('count', $conditions) > 0) {

                    $this->ShopProduto->updateAll(

                        array('ShopProduto.status_parente_id' => sprintf("'%s'", $data['ShopProduto']['ativo'])),
                        array(
                            'ShopProduto.parente_id' => $id_produto,
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                        )

                    );

                }

            }

            return $data['ShopProduto']['ativo'];

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Edita dados do Produto editDadosProduto
     * @access public
     * @param String $id_produto de produto
     * @return string
     */
    public function editarDadosProdutoFilho()
    {

        try {

            $this->id_produto = Tools::clean(Tools::getValue('produto_id'));

            /**
             *
             * Altera para categoria pai
             *
             **/
            if (Tools::getValue('gerenciado') !== 'False') {

                $this->quantidade = Tools::clean(Tools::getValue('quantidade'));
                $this->situacao_em_estoque = Tools::clean(Tools::getValue('situacao_em_estoque'));
                $this->situacao_sem_estoque = Tools::clean(Tools::getValue('situacao_sem_estoque'));

            }

            $this->sku = Tools::clean(Tools::cleanSKU(Tools::getValue('sku')));

            if ($this->sku == sprintf('%s-', Tools::getValue('sku_master'))) {
                $this->sku = sprintf('%s-%s', Tools::getValue('sku_master'), date('Y-m-d-H-i-s'));
            }

            self::setNomeProdutoVariacao();

            if (Tools::getValue('parente_id_master') != '') {

                $this->status_parente_id = self::getStatusProduto(Tools::getValue('parente_id_master'));

            }

            $fields = array(

                'ShopProduto.ativo' => sprintf("'%s'", Tools::clean(Tools::getValue('ativo'))),
                'ShopProduto.status_parente_id' => sprintf("'%s'", $this->status_parente_id),
                'ShopProduto.sku' => sprintf("'%s'", $this->sku),
                'ShopProduto.ncm' => sprintf("'%s'", Tools::clean(Tools::getValue('ncm'))),
                'ShopProduto.preco_custo' => Tools::convertToDecimal(Tools::getValue('custo')),
                'ShopProduto.preco_cheio' => Tools::convertToDecimal(Tools::getValue('cheio')),
                'ShopProduto.preco_promocional' => Tools::convertToDecimal(Tools::getValue('promocional')),
                'ShopProduto.peso' => Tools::convertToDecimal(Tools::getValue('peso')),
                'ShopProduto.altura' => sprintf("'%s'", Tools::clean(Tools::getValue('altura'))),
                'ShopProduto.largura' => sprintf("'%s'", Tools::clean(Tools::getValue('largura'))),
                'ShopProduto.comprimento' => sprintf("'%s'", Tools::clean(Tools::getValue('comprimento'))),
                'ShopProduto.gerenciado' => sprintf("'%s'", Tools::clean(Tools::getValue('gerenciado'))),
                'ShopProduto.situacao_em_estoque' => sprintf("'%s'", $this->situacao_em_estoque),
                'ShopProduto.quantidade' => sprintf("'%s'", $this->quantidade),
                'ShopProduto.situacao_sem_estoque' => sprintf("'%s'", $this->situacao_sem_estoque)

            );

            $conditions = array(
                'ShopProduto.id_produto' => $this->id_produto,
                'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
            );

            $this->ok = $this->ShopProduto->updateAll($fields, $conditions);

            if (is_bool($this->ok) && $this->ok === true) {
                return true;
            } else {
                throw new \RuntimeException();
            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);
            return false;

        } catch (\RuntimeException $e) {

            return false;

        } catch (\LogicException $e) {

            exit('Error:' . $e->getMessage());

        }

    }

    /**
     * Buscar Produtos
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $busca termo da busca
     * @return string
     */
    public function buscaProduto()
    {

        try {

            if (Tools::getValue('busca') == '') {
                return null;
            }

            $this->busca = Tools::sanitizeFullText(Tools::getValue('busca'));
            $this->busca = str_replace('%', "-1", $this->busca);

            /**
             *
             * Busca simples com filtro
             *
             **/
            if (!empty($this->busca)) {

                $this->filter_or = array(
                    'ShopProduto.nome LIKE' => '%' . $this->busca . '%',
                    'ShopProduto.descricao_completa LIKE' => '%' . $this->busca . '%',
                    'ShopProduto.sku LIKE' => '%' . $this->busca . '%',
                    'ShopProduto.url LIKE' => '%' . $this->busca . '%'
                );

            }

            if (Tools::getValue('filtro') != '') {

                $this->filtro_ativo = Tools::getValue('filtro');

                if ($this->filtro_ativo == 'ativo') {

                    $this->filter_conditions = array(
                        'ShopProduto.parente_id' => 0,
                        'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopProduto.lixo' => 'False',
                        'ShopProduto.ativo' => 'True',
                        'OR' => $this->filter_or
                    );

                } elseif ($this->filtro_ativo == 'inativo') {

                    $this->filter_conditions = array(
                        'ShopProduto.parente_id' => 0,
                        'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopProduto.lixo' => 'False',
                        'ShopProduto.ativo' => 'False',
                        'OR' => $this->filter_or
                    );

                }

            } else {

                $this->filter_conditions = array(
                    'ShopProduto.parente_id' => 0,
                    'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopProduto.lixo' => 'False',
                    'OR' => $this->filter_or

                );

            }

            switch (Tools::getValue('listagem')):

                case 'ultimos_produtos':

                    $this->filter_order = array(
                        'ShopProduto.created' => 'DESC'
                    );
                    break;

                case 'destaque':

                    /**
                     *
                     * Filtra por destaques
                     *
                     **/

                    $this->filter_conditions = array(
                        'ShopProduto.parente_id' => 0,
                        'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                        'ShopProduto.lixo' => 'False',
                        'ShopProduto.destaque' => 'True',
                        'OR' => $this->filter_or
                    );


                    if (isset($this->filtro_ativo) && $this->filtro_ativo == 'ativo') {

                        $this->filter_conditions = array(
                            'ShopProduto.parente_id' => 0,
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopProduto.lixo' => 'False',
                            'ShopProduto.ativo' => 'True',
                            'ShopProduto.destaque' => 'True',
                            'OR' => $this->filter_or
                        );

                    } elseif (isset($this->filtro_ativo) && $this->filtro_ativo == 'inativo') {

                        $this->filter_conditions = array(
                            'ShopProduto.parente_id' => 0,
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopProduto.lixo' => 'False',
                            'ShopProduto.ativo' => 'False',
                            'ShopProduto.destaque' => 'True',
                            'OR' => $this->filter_or
                        );

                    }

                    $this->filter_order = array(
                        'ShopProduto.nome' => 'ASC'
                    );

                    break;

                case 'mais_vendidos':

                    if (isset($this->filtro_ativo) && $this->filtro_ativo == 'ativo') {

                        $this->filter_conditions = array(
                            'ShopProduto.parente_id' => 0,
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopProduto.lixo' => 'False',
                            'ShopProduto.ativo' => 'True',
                            'ShopProduto.total_vendido !=' => 0,
                            'OR' => $this->filter_or
                        );

                    } elseif (isset($this->filtro_ativo) && $this->filtro_ativo == 'inativo') {

                        $this->filter_conditions = array(
                            'ShopProduto.parente_id' => 0,
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopProduto.lixo' => 'False',
                            'ShopProduto.ativo' => 'False',
                            'ShopProduto.total_vendido !=' => 0,
                            'OR' => $this->filter_or
                        );

                    } else {

                        $this->filter_conditions = array(
                            'ShopProduto.parente_id' => 0,
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopProduto.lixo' => 'False',
                            'ShopProduto.total_vendido !=' => 0,
                            'OR' => $this->filter_or
                        );

                    }

                    $this->filter_order = array(
                        'ShopProduto.total_vendido' => 'DESC'
                    );
                    break;

                default:

                    $this->filter_order = array(
                        'ShopProduto.nome' => 'ASC'
                    );

                    $this->default = true;

            endswitch;

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
                    'ShopProdutoImagem.nome_imagem',

                ),

                'conditions' => $this->filter_conditions,
                'order' => $this->filter_order,
                'limit' => $this->limit,
                'group' => array('ShopProdutoImagem.id_produto_default'),

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

            //Pagina resultado

            $this->paginate = $conditions;

            $this->res_lista_produto = $this->paginate('ShopProduto');

            if (v::notEmpty()->validate($this->res_lista_produto)) {
                return $this->res_lista_produto;
            }

            if (isset($this->default) && $this->default === true) {
                $this->filter_order = 'titulo_relevancia DESC, relevancia DESC';
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
                    'ShopProdutoImagem.nome_imagem',
                    "MATCH (`nome`,`descricao_completa`) AGAINST ('$this->busca' IN BOOLEAN MODE) AS relevancia,  MATCH (`nome`) AGAINST ('$this->busca' IN BOOLEAN MODE) AS titulo_relevancia"

                ),

                'conditions' => " MATCH (`nome`,`descricao_completa`) AGAINST ('$this->busca' IN BOOLEAN MODE) AND `ShopProduto.id_shop_default` = '" . $this->Session->read('id_shop') . "' AND ShopProduto.parente_id = '0' AND ShopProduto.lixo = 'False'",
                'order' => $this->filter_order,
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

            $this->paginate = $conditions;
            //Pagina resultado
            $this->res_lista_produto = $this->paginate('ShopProduto');

            return $this->res_lista_produto;

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
