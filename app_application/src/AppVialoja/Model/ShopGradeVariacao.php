<?php

use Respect\Validation\Validator as v;


/**
 * Class ShopGradeVariacao
 */
class ShopGradeVariacao extends AppModel {

    public $name = 'ShopGradeVariacao';
    public $useTable = 'shop_grade_variacao';
    public $primaryKey = 'id_variacao';
    public $useDbConfig = 'default';

    public function getVariacaoId( $id_grade='', $id_variacao='' )
    {

        try {

            if (!v::numeric()->notBlank()->validate($id_grade)) {
                throw new \InvalidArgumentException(ERROR_PROCESS);
            }

            if (!v::numeric()->notBlank()->validate($id_variacao)) {
                throw new \InvalidArgumentException(ERROR_PROCESS);
            }

            $conditions = array(

                'fields' => array(
                    'ShopGradeVariacao.id_variacao',
                    'ShopGradeVariacao.nome'

                ),
                'conditions' => array(
                    'ShopGradeVariacao.id_grade_default' => $id_grade,
                    'ShopGradeVariacao.id_variacao' => $id_variacao
                )
            );

            if ($this->find('count', $conditions) <= 0) {
                throw new \NotFoundException('Variação não encontrada!');
            }

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

            throw new \Exception($e->getMessage());

        }

    }

    /**
     * Recupera as variações da grade
     * @param string $id_grade
     * @param string $nome
     * @return bool
     */
    public function getIdVariacao($id_grade='', $nome='')
    {
        try {

            if (!v::numeric()->notBlank()->validate($id_grade)) {
                throw new \LogicException("Parâmetro Variacao ID inválido", 1);
            }

            if (!v::stringType()->notEmpty()->validate($nome)) {
                throw new \LogicException("Parâmetro Variacao Nome inválido", 1);
            }

            $conditions = array(
                'fields' => array(
                    'ShopGradeVariacao.id_variacao'
                ),
                'conditions' => array(
                    'ShopGradeVariacao.id_grade_default' => $id_grade,
                    'ShopGradeVariacao.nome' => $nome
                )
            );

            if ($this->find('count', $conditions) <= 0 ) {
                return false;
            }

            $dados = $this->find('first', $conditions);
            return $dados['ShopGradeVariacao']['id_variacao'];

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Lista as variações da grade
     * @param string $id_grade
     * @return array|null
     * @throws Exception
     */
    public function getVariacaoAll($id_grade='')
    {
        try {

            if (!v::numeric()->notBlank()->validate($id_grade)) {
                throw new \InvalidArgumentException(ERROR_PROCESS);
            }

            $conditions = array(

                'fields' => array(
                    'ShopGradeVariacao.id_variacao',
                    'ShopGradeVariacao.nome'
                ),

                'conditions' => array(
                    'ShopGradeVariacao.id_grade_default' => $id_grade
                ),

                'order' => array(
                    'ShopGradeVariacao.created' => 'DESC'
                )
            );

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

            throw new \Exception($e->getMessage());

        }

    }

}
