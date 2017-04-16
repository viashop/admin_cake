<?php

use Lib\Tools;



class ShopProdutoCategoriaController extends AppController
{

    public $uses = array('ShopProdutoCategoria');

    public function getIdCategoriaDefault()
    {
        try {

            if (empty($this->params['named']['id_produto'])) {
                throw new \LogicException("Valor obrigatório: Informe o id_produtos.", E_USER_WARNING);
            }

            /**
             *
             * Categoria nome
             *
             **/
            $conditions = array(
                'fields' => array(
                    'ShopProdutoCategoria.id_categoria_default'
                ),
                'conditions' => array(
                    'ShopProdutoCategoria.categoria_primaria' => 'True',
                    'ShopProdutoCategoria.id_produto_default' => $this->params['named']['id_produto']
                )
            );

            return $this->ShopProdutoCategoria->find('first', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }


    public function getIdProdCategoriaAll()
    {
        try {

            if (empty($this->params['named']['id_produto'])) {
                throw new \LogicException("Valor obrigatório: Informe o id_produto.", E_USER_WARNING);
            }

            /**
             *
             * Categoria nome
             *
             **/
            $conditions = array(
                'fields' => array(
                    'ShopProdutoCategoria.id_categoria_default'
                ),
                'conditions' => array(
                    'ShopProdutoCategoria.categoria_secudaria' => 'True',
                    'ShopProdutoCategoria.id_produto_default' => $this->params['named']['id_produto']
                )
            );

            return $this->ShopProdutoCategoria->find('all', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Add Categorias Produto
     * @access private
     * @param String $id_produto de produto
     * @return string
     */
    public function adicionarCategoriaProduto()
    {

        try {

            if (empty($this->params['named']['id_produto'])) {
                throw new \LogicException("Informe o ID do produto", E_USER_WARNING);
            }

            if (!is_numeric($this->params['named']['id_produto'])) {
                throw new \LogicException("Informe o ID do produto INT", E_USER_WARNING);
            }

            $id_produto = $this->params['named']['id_produto'];

            $this->ShopProdutoCategoria->deleteAll(array(
                'id_produto_default' => $id_produto
            ));

            if (Tools::getValue('categorias') != '' && is_array(Tools::getValue('categorias'))) {

                foreach (Tools::getValue('categorias') as $key => $categoria_id) {

                    $data = array(
                        'id_produto_default' => $id_produto,
                        'categoria_primaria' => 'True',
                        'id_categoria_default' => $categoria_id
                    );

                    $this->ShopProdutoCategoria->saveAll($data);
                    $parent_id = $this->ShopProdutoCategoria->getInsertID();

                    /**
                     *
                     * Parente ID categoria
                     *
                     **/
                    $this->requestAction(array(
                        'controller' => 'ShopCategoria',
                        'action' => 'getCategoriaParentId',
                        'categoria_id' => $categoria_id
                    ));

                    $categorias = array_unique($this->Session->read('id_categorias_produto'));

                    foreach ($categorias as $cat_id) {

                        if ($cat_id > 0) {

                            $data = array(
                                'id_produto_default' => $id_produto,
                                'id_categoria_default' => $cat_id,
                                'parent_id' => $parent_id
                            );

                            $this->ShopProdutoCategoria->saveAll($data);

                        }

                    }

                    $this->Session->delete('id_categorias_produto');

                }

            } else {

                if (Tools::getValue('categorias') != '') {

                    $categoria_id = Tools::getValue('categorias');

                    $data = array(
                        'id_produto_default' => $id_produto,
                        'categoria_primaria' => 'True',
                        'id_categoria_default' => $categoria_id
                    );

                    $this->ShopProdutoCategoria->saveAll($data);
                    $parent_id = $this->ShopProdutoCategoria->getInsertID();


                    /**
                     *
                     * Parente ID categoria
                     *
                     **/
                    $this->requestAction(array(
                        'controller' => 'ShopCategoria',
                        'action' => 'getCategoriaParentId',
                        'categoria_id' => $categoria_id
                    ));

                    $categorias = array_unique($this->Session->read('id_categorias_produto'));

                    foreach ($categorias as $key => $cat_id) {

                        if ($cat_id > 0) {

                            $data = array(
                                'id_produto_default' => $id_produto,
                                'id_categoria_default' => $cat_id,
                                'parent_id' => $parent_id
                            );

                            $this->ShopProdutoCategoria->saveAll($data);

                        }

                    }

                    $this->Session->delete('id_categorias_produto');

                }

            }

            if (Tools::getValue('categoria_secundaria') != '' && is_array(Tools::getValue('categoria_secundaria'))) {

                foreach (Tools::getValue('categoria_secundaria') as $key => $categoria_secundaria) {
                    // code...
                    $this->requestAction(array(
                        'controller' => 'ShopCategoria',
                        'action' => 'getCategoriaParentId',
                        'categoria_id' => $categoria_secundaria
                    ));

                    $data = array(
                        'id_produto_default' => $id_produto,
                        'id_categoria_default' => $categoria_secundaria,
                        'categoria_secudaria' => 'True'
                    );

                    $this->ShopProdutoCategoria->saveAll($data);
                    $parent_id = $this->ShopProdutoCategoria->getInsertID();

                    $categoria_secundaria = array_unique($this->Session->read('id_categorias_produto'));

                    foreach ($categoria_secundaria as $cat_id) {

                        if ($cat_id > 0) {

                            $data = array(
                                'id_produto_default' => $id_produto,
                                'id_categoria_default' => $cat_id,
                                'parent_id' => $parent_id
                            );

                            $this->ShopProdutoCategoria->saveAll($data);

                        }

                    }

                    $this->Session->delete('id_categorias_produto');

                }

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

}
