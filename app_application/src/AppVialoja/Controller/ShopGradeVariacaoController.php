<?php

use Lib\Tools;
use Respect\Validation\Validator as v;


class ShopGradeVariacaoController extends AppController
{

    public $uses = array('ShopGradeVariacao', 'ShopGrade');
    private $datasource;

    /**
     * Recupera as variações da grade
     * @access public
     */
    public function getVariacoesGrade()
    {
        try {

            if (empty($this->params['named']['id']) || !is_numeric($this->params['named']['id'])) {
                throw new \LogicException("Valor obrigatório: Informe o id ", E_USER_WARNING);
            }

            $conditions = array(
                'fields' => array(
                    'ShopGradeVariacao.nome'
                ),

                'conditions' => array(
                    'ShopGradeVariacao.id_grade_default' => $this->params['named']['id']
                )
            );

            $data = $this->ShopGradeVariacao->find('all', $conditions);

            if (v::notEmpty()->validate($data)) {

                $variacao = array();
                foreach ($data as $value) {
                    array_push($variacao, $value['ShopGradeVariacao']['nome']);
                }
                return $variacao;

            } else {
                return false;
            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Criar variação
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
    public function criarVariacao()
    {

        $this->datasource = $this->ShopGradeVariacao->getDataSource();

        try {

            $this->datasource->begin();

            if (empty($this->params['named']['id_grade'])) {
                throw new \NotFoundException(ERROR_PROCESS);
            }

            if (!is_numeric($this->params['named']['id_grade'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS);
            }

            if (Tools::getValue('nome') == '') {
                $this->Session->write('error_variacao', true);
                throw new \NotFoundException("Por favor, informe o nome da variação.", E_USER_WARNING);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopGradeVariacao.id_grade_default' => $this->params['named']['id_grade'],
                    'ShopGradeVariacao.nome' => Tools::clean(Tools::getValue('nome'))

                )
            );

            if ($this->ShopGradeVariacao->find('count', $conditions) > 0) {

                $this->Session->write('nome_variacao', Tools::clean(Tools::getValue('nome')));
                throw new \Exception\VialojaOverflowException('Uma variação com este nome já existe. Tente novamente!');

            }

            //
            $data = array(
                'id_grade_default' => $this->params['named']['id_grade'],
                'nome' => Tools::clean(Tools::getValue('nome'))
            );

            $ok = $this->ShopGradeVariacao->saveAll($data);
            if (is_bool($ok) && $ok === true) {

                $this->setMsgAlertSuccess('Variação da grade criada com sucesso!');

                if ($this->Session->read('referer')) {
                    return $this->redirect($this->Session->read('referer'));
                } else {
                    return $this->redirect(array(
                        'controller' => $this->request->controller,
                        'action' => 'grade',
                        'listar'
                    ));
                }

            } else {

                throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);
            throw new \Exception(ERROR_PROCESS);

        } catch (\NotFoundException $e) {

            throw new \Exception($e->getMessage());

        } catch (\InvalidArgumentException $e) {

            throw new \Exception($e->getMessage());

        } catch (\Exception\VialojaOverflowException $e) {

            throw new \Exception($e->getMessage());

        } catch (\RuntimeException $e) {

            throw new \Exception($e->getMessage());

        }

    }


    /**
     * Remover variação
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $id da variacao
     * @return string
     */
    public function removerVariacao()
    {

        $this->datasource = $this->ShopGradeVariacao->getDataSource();

        try {

            $this->datasource->begin();

            if (empty($this->params['named']['id_variacao'])) {
                throw new \NotFoundException(ERROR_PROCESS);
            }

            if (!is_numeric($this->params['named']['id_variacao'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS);
            }

            $this->ShopGradeVariacao->id = $this->params['named']['id_variacao'];

            if ($this->ShopGradeVariacao->exists()) {

                if ($this->ShopGradeVariacao->delete()) {

                    $this->setMsgAlertSuccess('Variação excluída com sucesso.');
                    return $this->redirect($this->Session->read('referer'));

                } else {
                   throw new \RuntimeException('Não foi possível excluir a variação.');
                }

            } else {
                throw new \NotFoundException('Esta variação não existe mais.');
            }

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);
            throw new \Exception(ERROR_PROCESS);

        } catch (\NotFoundException $e) {

            throw new \Exception($e->getMessage());

        } catch (\InvalidArgumentException $e) {

            throw new \Exception($e->getMessage());

        } catch (\RuntimeException $e) {

            throw new \Exception($e->getMessage());

        }

    }

    /**
     * Editar variação
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $id da variacao
     * @return string
     */
    public function editarVariacao()
    {

        $this->datasource = $this->ShopGradeVariacao->getDataSource();

        try {

            $this->datasource->begin();

            if (empty($this->params['named']['id_grade'])) {
                throw new \NotFoundException(ERROR_PROCESS);
            }

            if (!is_numeric($this->params['named']['id_grade'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS);
            }

            if (empty($this->params['named']['id_variacao'])) {
                throw new \NotFoundException(ERROR_PROCESS);
            }

            if (!is_numeric($this->params['named']['id_variacao'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS);
            }

            if (Tools::getValue('nome') == '') {
                throw new \NotFoundException("Informe nome da variação da grade!", E_USER_WARNING);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopGradeVariacao.nome' => Tools::clean(Tools::getValue('nome')),
                    'ShopGradeVariacao.id_grade_default' => $this->params['named']['id_grade'],
                    'ShopGradeVariacao.id_variacao !=' => $this->params['named']['id_variacao']
                )
            );

            if ($this->ShopGradeVariacao->find('count', $conditions) > 0) {
                throw new \Exception\VialojaOverflowException('Já existe uma variação com o mesmo nome. Tente outro nome.', E_USER_WARNING);
            }

            /**
             *
             * Altera o nome da grade
             *
             **/
            $this->fields = array(
                'ShopGradeVariacao.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome')))
            );

            $conditions = array(
                'ShopGradeVariacao.id_grade_default' => $this->params['named']['id_grade'],
                'ShopGradeVariacao.id_variacao' => $this->params['named']['id_variacao']
            );

            $ok = $this->ShopGradeVariacao->updateAll($this->fields, $conditions);

            if (is_bool($ok) && $ok === true) {

                $this->setMsgAlertSuccess('Variação da grade editada com sucesso!');
                return $this->redirect($this->Session->read('referer'));

            } else {
                throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);
            throw new \Exception(ERROR_PROCESS);

        } catch (\NotFoundException $e) {

            throw new \Exception($e->getMessage());

        } catch (\InvalidArgumentException $e) {

            throw new \Exception($e->getMessage());

        } catch (\Exception\VialojaOverflowException $e) {

            throw new \Exception($e->getMessage());

        } catch (\RuntimeException $e) {

            throw new \Exception($e->getMessage());

        }

    }

    public function getVariacaoNomeHex()
    {
        try {

            if (empty($this->params['named']['grade_id'])) {
                throw new \NotFoundException(ERROR_PROCESS);
            }

            if (!is_numeric($this->params['named']['grade_id'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS);
            }

            $this->ShopGrade->id = $this->params['named']['grade_id'];

            if ( $this->ShopGrade->exists()) {

                $conditions = array(

                    'fields' => array(
                        'ShopGradeVariacao.nome',
                        'ShopGradeVariacao.hex',
                        'ShopGradeVariacao.id_variacao'
                    ),

                    'conditions' => array(
                        'ShopGradeVariacao.id_grade_default' => $this->params['named']['grade_id'],
                    )
                );

                return $this->ShopGradeVariacao->find('all', $conditions);

            } else {
                throw new \NotFoundException('Variação da grade não encontrada.');
            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);
            throw new \Exception(ERROR_PROCESS);

        } catch (\NotFoundException $e) {

            throw new \Exception($e->getMessage());

        } catch (\InvalidArgumentException $e) {

            throw new \Exception($e->getMessage());

        }

    }

}
