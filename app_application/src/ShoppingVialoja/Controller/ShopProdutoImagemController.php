<?php

App::uses('AppController', 'Controller');

class ShopProdutoImagemController extends AppController
{

    public $uses = array('ShopProdutoImagem');

    /**
     * Lista foto produto principal.
     * @access public
     * @param String $id
     * @param Array $conditions
     */
    public function getImagemPrincipal()
    {
        try {

            if (!Validate::isInt($this->params['named']['id'])) {
                throw new LogicException("Valor obrigatório: Informe o id ", 1);
            }

            $conditions = array(
                'fields' => array(
                    'ShopProdutoImagem.nome_imagem'
                ),
                'conditions' => array(
                    'ShopProdutoImagem.posicao' => 0,
                    'ShopProdutoImagem.id_produto_default' => $this->params['named']['id']
                ),
                'limit' => 1
            );

            $result = $this->ShopProdutoImagem->find('first', $conditions);

            if (Validate::isNotNull($result)) {
                return $result['ShopProdutoImagem']['nome_imagem'];
            } else {
                return false;
            }

        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }


	/**
     * Lista todas ascfotos produto.
     * @access public
     * @param String $id_produto
     * @retunr Array
     */
    public function getImagemAll()
    {
        try {

			if (!Validate::isInt($this->params['named']['id_produto'])) {
                throw new LogicException("Valor obrigatório: Informe o id produto ", 1);
            }

            $conditions = array(

                'fields' => array(
                    'ShopProdutoImagem.id_imagem',
                    'ShopProdutoImagem.id_produto_default',
                    'ShopProdutoImagem.nome_imagem',
                    'ShopProdutoImagem.posicao'
                ),
                'conditions' => array(
                    'ShopProdutoImagem.id_produto_default' => $this->params['named']['id_produto']

                ),
                'order' => array('ShopProdutoImagem.posicao' => 'ASC'),
				'limit' => 10
            );

            if ($this->ShopProdutoImagem->find('count', $conditions) > 0) {
				return $this->ShopProdutoImagem->find('all', $conditions);
            } else {
                return false;
            }

        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}
