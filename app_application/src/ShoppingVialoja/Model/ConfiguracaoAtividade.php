<?php

App::uses('Model', 'Model');

class ConfiguracaoAtividade extends AppModel {

    public $name = 'ConfiguracaoAtividade';
    public $useTable = 'configuracao_atividade';
    public $primaryKey = 'id_atividade';
    public $useDbConfig = 'default';

    /**
     * Links Breadcrumb
     * @param  int $id_produto ID do produto
     * @return array
     */
    public function atividadePrincipalProduto($id_produto='')
    {
        try {

            return $this->find('first', array(
                
                'fields' => array(
                    'ConfiguracaoAtividade.id_atividade',
                    'ConfiguracaoAtividade.nome',
                ),

                'conditions' => array(
                    //'ShopProdutoCategoria.categoria_primaria' => 'True',
                    'ShopProdutoCategoria.id_produto_default' => $id_produto,
                ),

                //'group' => array('ShopProdutoCategoria.id_shop_default'),
                //'order' => 'ShopProdutoCategoria.created DESC',
                'limit' => 1,

                'joins' => array(

                    array(
                        'table' => 'shop_categoria',
                        'alias' => 'ShopCategoria',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ConfiguracaoAtividade.id_atividade = ShopCategoria.id_atividade'
                        )
                    ),

                    array(
                        'table' => 'shop_produto_categoria',
                        'alias' => 'ShopProdutoCategoria',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopCategoria.id_categoria = ShopProdutoCategoria.id_categoria_default'
                        )
                    )

                ),

            ));

            
        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);
            
        }
        
    }

}
