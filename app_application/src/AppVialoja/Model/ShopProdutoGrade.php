<?php

use Respect\Validation\Validator as v;


class ShopProdutoGrade extends AppModel {

	public $name = 'ShopProdutoGrade';
	public $useDbConfig = 'default';
	public $useTable = 'shop_produto_grade';

    /**
     * Add grade ao produto
     * @param string $id_grade
     * @param string $id_produto
     * @param bool|false $get_id
     * @return mixed
     */
    public function addGrade($id_grade='',$id_produto='', $get_id=false)
    {
        try {

			if (!v::numeric()->notBlank()->validate($id_grade)) {
                throw new \LogicException("Parâmetro ID_GRADE inválido", E_USER_NOTICE);
            }

            if (!v::numeric()->notBlank()->validate($id_produto)) {
                throw new \LogicException("Parâmetro Parent ID inválido", E_USER_NOTICE);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopProdutoGrade.id_grade_default' => $id_grade,
                    'ShopProdutoGrade.id_produto_default' => $id_produto
                )
            );

            if ($this->find('count', $conditions) <= 0) {

                $data = array(
                    'id_grade_default' => $id_grade,
                    'id_produto_default' => $id_produto
                );

                $this->saveAll($data);

				if ($get_id === true) {
					return $this->getLastInsertId();
				}

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }


    /**
     * Add grade ao produto via importação
     * @param string $id_grade
     * @param string $id_produto
     * @param bool|false $get_id
     * @return mixed
     */
    public function addGradeImportacao($id_grade='',$id_produto='')
    {
        try {

            if (!v::numeric()->notBlank()->validate($id_grade)) {
                throw new \LogicException("Parâmetro ID_GRADE inválido", E_USER_NOTICE);
            }

            if (!v::numeric()->notBlank()->validate($id_produto)) {
                throw new \LogicException("Parâmetro Parent ID inválido", E_USER_NOTICE);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopProdutoGrade.id_grade_default' => $id_grade,
                    'ShopProdutoGrade.id_produto_default' => $id_produto
                )
            );

            if ($this->find('count', $conditions) <= 0) {

                $data = array(
                    'id_grade_default' => $id_grade,
                    'id_produto_default' => $id_produto
                );

                $okSave = $this->saveAll($data);

                if (!v::type('bool')->validate($okSave)) {
                    throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
                }

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

}
