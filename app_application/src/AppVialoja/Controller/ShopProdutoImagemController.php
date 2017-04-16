<?php

use Lib\Tools;

class ShopProdutoImagemController extends AppController {

	public $uses = array('ShopProdutoImagem');

    private $id_produto;
    private $conditions;
    private $key;
    private $value;
    private $dir_root_image;
    private $diretorio;
    private $filename;
    private $filename_id;
    private $array = array();


    /**
     * Verifica Images Quebradas e deleta
     * @return string
     */
    public function verificaImagesQuebradas()
    {

        if (!empty($this->params['named']['id_produto'])) {

            $this->id_produto = $this->params['named']['id_produto'];

            $this->dir_root_image = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'produto' . DS;
            $this->diretorio = $this->dir_root_image . $this->id_produto . DS;

            $this->array[] = $this->diretorio . 'thickbox';
            $this->array[] = $this->diretorio . 'large';
            $this->array[] = $this->diretorio . 'home';
            $this->array[] = $this->diretorio . 'medium';
            $this->array[] = $this->diretorio . 'small';
            $this->array[] = $this->diretorio . 'cart';

            $this->conditions = array(

                'fields' => array(
                    'ShopProdutoImagem.nome_imagem',
                    'ShopProdutoImagem.id_imagem',

                ),
                'conditions' => array(
                    'ShopProdutoImagem.id_produto_default' => $this->id_produto
                )

            );


            $this->data = $this->ShopProdutoImagem->find('all', $this->conditions);

            foreach ($this->data as $img) {

                foreach ($this->array as $this->value) {

                    $this->filename = $this->value . DS . $img['ShopProdutoImagem']['nome_imagem'];

                    if (!file_exists($this->filename)) {

                        $this->filename_id = $img['ShopProdutoImagem']['id_imagem'];
                    }
                }

            }

            if (isset($this->filename_id) && is_numeric($this->filename_id)) {

                $this->conditions = array(

                    'fields' => array(
                        'ShopProdutoImagem.nome_imagem',

                    ),
                    'conditions' => array(
                        'ShopProdutoImagem.id_imagem' => $this->filename_id
                    )

                );


                $this->data = $this->ShopProdutoImagem->find('all', $this->conditions);

                foreach ($this->data as $img) {

                    foreach ($this->array as $this->value) {

                        $this->filename = $this->value . DS . $img['ShopProdutoImagem']['nome_imagem'];

                        $this->ShopProdutoImagem->id = $this->filename_id;

                        if ($this->ShopProdutoImagem->exists()) {
                            Tools::deleteFile($this->filename);
                            $this->ShopProdutoImagem->delete();
                        }

                    }

                }

                self::reordenarImagem();

                $this->setMsgAlertWarning('Atenção: Havia neste cadastro images quebradas, e foram removidas automaticamente pelo sistema.');

            }

        }

    }


    /**
     * Ordenar imagem de produto
     * @access public
     * @param String $id_produto de produto
     * @return string
     */
    private function reordenarImagem()
    {

        try {


            $this->conditions = array(

                'fields' => array(
                    'ShopProdutoImagem.id_imagem'
                ),

                'conditions' => array(
                    'ShopProdutoImagem.id_produto_default' => $this->id_produto
                ),

                'order' => array('ShopProdutoImagem.posicao' => 'ASC')

            );


            if ($this->ShopProdutoImagem->find('count', $this->conditions) > 0) {

                $this->data = $this->ShopProdutoImagem->find('all', $this->conditions);

                foreach ($this->data as $this->key => $this->value) {

                    $this->fields = array(
                        'ShopProdutoImagem.posicao' => sprintf("'%s'", $this->key)
                    );

                    $this->conditions = array(
                        'ShopProdutoImagem.id_produto_default' => $this->id_produto,
                        'ShopProdutoImagem.id_imagem' => $this->value['ShopProdutoImagem']['id_imagem']
                    );

                    $this->ShopProdutoImagem->updateAll($this->fields, $this->conditions);

                }

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
