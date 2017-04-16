<?php



class ShopProdutoGradeController extends AppController {

	public $uses = array('ShopProdutoGrade');

    public function getTotalGradeVinculado()
    {

        try {

            if (isset($this->params['named']['id_grade'])){
                $this->params['named']['id_grade'];
            }

            $conditions = array(
                'conditions' => array(
                    'id_grade_default' => $this->params['named']['id_grade'],
                ),

                'joins' => array(

                    array(
                        'table' => 'shop_produto',
                        'alias' => 'ShopProduto',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopProduto.id_produto = ShopProdutoGrade.id_produto_default',
                            'ShopProduto.id_shop_default' => $this->Session->read('id_shop')
                        )
                    ),

                ),
            );

            return $this->ShopProdutoGrade->find('count', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
