<?php

use Respect\Validation\Validator as v;


class PlanoShop extends AppModel
{

    public $name = 'PlanoShop';
    public $useTable = 'plano_shop';
    public $primaryKey = 'id_plano';
    public $useDbConfig = 'default';

    public function getAll($id_plano = '')
    {
        try {

            if (!is_numeric($id_plano)) {
                throw new \LogicException("Informe o ID do Plano do tipo INT", 1);
            }

            $conditions = array(
                'conditions' => array(
                    'PlanoShop.id_plano' => $id_plano
                )
            );

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    public function getFirstAll($id_plano = '')
    {
        try {

            if (!is_numeric($id_plano)) {
                throw new \LogicException("Informe o ID do Plano do tipo INT", 1);
            }

            $conditions = array(
                'conditions' => array(
                    'PlanoShop.id_plano' => $id_plano
                )
            );

            return $this->find('first', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    public function planoListar($lista = '')
    {

        try {

            if (!isset($lista)) {
                throw new \LogicException("Informe a o valor do tipo int", 1);
            }

            $conditions = array();

            switch ($lista) {
                case 1:
                    $conditions = array(
                        'conditions' => array(
                            "PlanoShop.id_plano" => array(1, 2, 3, 4),
                            'PlanoShop.ativo' => 1
                        )
                    );
                    break;

                case 2:
                    $conditions = array(
                        'conditions' => array(
                            "PlanoShop.id_plano" => array(5, 6, 7, 8),
                            'PlanoShop.ativo' => 1
                        )
                    );
                    break;

                case 3:
                    $conditions = array(
                        'conditions' => array(
                            "PlanoShop.id_plano" => array(9, 10),
                            'PlanoShop.ativo' => 1
                        )
                    );
                    break;
            }


            return $this->find('all', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Valor do Planto
     * @param string $id do plano
     * @return double valor do plano
     */
    public function valorPlano(Shop $shop)
    {

        try {

            if (!is_int($shop->getIdPlano())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
            }

            if (empty($shop->getIdPlano())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop', E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'PlanoShop.valor'
                ),
                'conditions' => array(
                    'PlanoShop.id_plano' => $shop->getIdPlano(),
                )
            );

            $dados = $this->find('first', $conditions);
            return $dados['PlanoShop']['valor'];

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    public function getTotalProduto($id_shop)
    {

        try {

            if (!v::numeric()->notBlank()->validate($id_shop)) {
                throw new \LogicException('Informe o ID do Shop', E_USER_ERROR);
            }

            $conditions = array(

                'fields' => array(
                    'PlanoShop.produtos'
                ),

                'conditions' => array(
                    'Shop.id_shop' => $id_shop
                ),

                'joins' => array(
                    array(
                        'table' => 'shop',
                        'alias' => 'Shop',
                        'type' => 'INNER',
                        'conditions' => array(
                            'PlanoShop.id_plano = Shop.id_plano'
                        )
                    )
                )
            );

			$dados = $this->find('first', $conditions);
			return $dados['PlanoShop']['produtos'];


		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

}
