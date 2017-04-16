<?php

use Respect\Validation\Validator as v;

/**
 * Class ShopProdutoVariacaoController
 */
class ShopProdutoVariacaoController extends AppController
{

    public $uses = array('ShopProdutoVariacao');

    /**
     * Recupera o nome Variação
     * Usado na Views Produto Editar
     * @return null
     */
    public function getNomeVariacao()
    {

        if (!v::numeric()->notBlank()->validate($this->params['named']['id_produto'])) {
            return null;
        }

        if (!v::numeric()->notBlank()->validate($this->params['named']['id_grade'])) {
            return null;
        }

        return $this->ShopProdutoVariacao->getNomeVariacao(
            $this->params['named']['id_produto'],
            $this->params['named']['id_grade']
        );

    }

    /**
     * Retorna o Total de Variação Viculada
     * Usado na Views Grade Editar
     * @return mixed
     */
    public function getTotalVariacaoVinculado()
    {

        if (!v::numeric()->notBlank()->validate($this->params['named']['id_grade_variacao'])) {

            return $this->ShopProdutoVariacao->getTotalVariacaoVinculado(
                $this->Session->read('id_shop'),
                $this->params['named']['id_grade_variacao']
            );

        }

    }

}
