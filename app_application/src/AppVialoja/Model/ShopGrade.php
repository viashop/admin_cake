<?php

use Respect\Validation\Validator as v;


/**
 * Class ShopGrade
 */
class ShopGrade extends AppModel {

    public $name = 'ShopGrade';
    public $useTable = 'shop_grade';
    public $primaryKey = 'id_grade';
    public $useDbConfig = 'default';

	public function getGradeId($nome='')
	{
		try {

			if (!v::stringType()->notEmpty()->validate($nome)) {
                throw new \LogicException("Valor obrigatório: Informe o nome.", 1);
            }

			$conditions = array(
				'fields' => array(
					'ShopGrade.id_grade'
				),
                'conditions' => array(
                    'ShopGrade.nome' => $nome
                )
            );

            if ($this->find('count', $conditions) <= 0) {
                return false;
            }

            $data = $this->find('first', $conditions);
            return (int)$data['ShopGrade']['id_grade'];

		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

    /**
     * Recupera dados de Grade
     * @param string $id_shop
     * @param string $id_grade
     * @return array|null
     * @throws Exception
     */
	public function getDadosGradeId($id_shop='',$id_grade='')
	{
		try {

			if (!v::numeric()->notBlank()->validate($id_grade)) {
        		throw new \InvalidArgumentException(ERROR_PROCESS);
        	}

            $conditions = array(

                'fields' => array(
                    'ShopGrade.id_grade',
                    'ShopGrade.nome'
                ),
                'conditions' => array(
                    'ShopGrade.id_grade' => $id_grade,
                    'ShopGrade.id_shop_default' => $id_shop,
                    'ShopGrade.default' => null
                )

            );

            if ($this->find('count', $conditions) <= 0) {
                throw new \NotFoundException("Grade não encontrada!", 1);
            }

            return $this->find('first', $conditions);

		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

        	throw new \Exception($e->getMessage());

        }

	}

	public function getGradeAll($id_shop='')
	{

		try {

			$conditions = array(

                'fields' => array(
                    'ShopGrade.id_grade',
                    'ShopGrade.id_shop_default',
                    'ShopGrade.nome',
                    'ShopGrade.tipo',
                    'ShopGrade.default'
                ),

                'conditions' => array(
                    'OR' => array(
                        'ShopGrade.default' => 1,
                        'ShopGrade.id_shop_default' => $id_shop
                    )
                )
            );

            return $this->find('all', $conditions);

		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

}
