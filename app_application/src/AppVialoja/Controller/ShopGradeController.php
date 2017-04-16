<?php

use Lib\Tools;


class ShopGradeController extends AppController {

	public $uses = array('ShopGrade');
    private $datasource;

	/**
     * Criar grade
     * @access public
     * @param String $id_shop variavel de sessão
     * @return string
     */
	public function criarGrade()
	{

        $this->datasource = $this->ShopGrade->getDataSource();

        try {

            $this->datasource->begin();

            if (Tools::getValue('nome') == '') {
                $this->set('error_grade', true);
                throw new \NotFoundException("Informe o nome da grade.", E_USER_WARNING);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopGrade.nome' => Tools::clean(Tools::getValue('nome')),
                    'ShopGrade.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopGrade->find('count', $conditions) > 0) {
                throw new \Exception\VialojaOverflowException('Já existe uma grade com este nome. Tente novamente.', E_USER_WARNING);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopGrade.nome' => Tools::clean(Tools::getValue('nome')),
                    'ShopGrade.default' => 1
                )
            );

            if ($this->ShopGrade->find('count', $conditions) > 0) {
                throw new \Exception\VialojaOverflowException('Já existe uma grade com este nome. Tente novamente.', E_USER_WARNING);
            }

            $data = array(
                'id_shop_default' => $this->Session->read('id_shop'),
                'nome' => Tools::clean(Tools::getValue('nome'))
            );

            $this->ShopGrade->saveAll($data);

            if ($this->ShopGrade->getInsertID() > 0 ) {

                $this->setMsgAlertSuccess('Grade criada com sucesso!');

                if (Tools::getValue('next') != '') {

                    return $this->redirect(Tools::getValue('next'));

                } else {

                    return $this->redirect(array(
                        'controller' => 'catalogo',
                        'action' => 'grade',
                        'editar',
                        $this->ShopGrade->getInsertID()
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

        } catch (\Exception\VialojaOverflowException $e) {

        	throw new \Exception($e->getMessage());

        } catch (\RuntimeException $e) {

        	throw new \Exception($e->getMessage());

        }

	}


	/**
     * Remover grade
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $id da grade
     * @return string
     */
    public function removerGrade()
    {

        $this->datasource = $this->ShopGrade->getDataSource();

        try {

            $this->datasource->begin();

        	if (empty($this->params['named']['id_grade'])) {
        		throw new \NotFoundException(ERROR_PROCESS);
        	}

        	if (!is_numeric($this->params['named']['id_grade'])) {
        		throw new \InvalidArgumentException(ERROR_PROCESS);
        	}

            $this->ShopGrade->id = $this->params['named']['id_grade'];
            if ($this->ShopGrade->exists()) {

                $this->ShopGrade->deleteAll(array(
                    'ShopGrade.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopGrade.id_grade' => $this->params['named']['id_grade']
                ));

                if ($this->ShopGrade->getAffectedRows()>0) {

                    $this->setMsgAlertSuccess('Grade excluída com sucesso.');

                    return $this->redirect(array(
                        'controller' => 'catalogo',
                        'action' => 'grade',
                        'listar'
                    ));

                } else {
                    throw new \RuntimeException('Não foi possível excluir a grade.');
                }

            } else {
            	throw new \NotFoundException('Esta grade não existe mais.');
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

        } catch (\RuntimeException $e) {

        	throw new \Exception($e->getMessage());

        }

    }


    /**
     * Editar grade
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $id da grade
     * @return string
     */
    public function gradeEditar()
    {

        $this->datasource = $this->ShopGrade->getDataSource();

        try {

            $this->datasource->begin();

            if (Tools::getValue('nome') == '') {
                throw new \NotFoundException("Informe o nome da grade.", E_USER_WARNING);
            }

            if (empty($this->params['named']['id_grade'])) {
        		throw new \NotFoundException(ERROR_PROCESS);
        	}

        	if (!is_numeric($this->params['named']['id_grade'])) {
        		throw new \InvalidArgumentException(ERROR_PROCESS);
        	}

            $conditions = array(
                'conditions' => array(
                    'ShopGrade.nome' => Tools::clean(Tools::getValue('nome')),
                    'ShopGrade.id_grade !=' => $this->params['named']['id_grade'],
                    'ShopGrade.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopGrade->find('count', $conditions) > 0) {
                throw new \Exception\VialojaOverflowException('Já existe uma grade com o mesmo nome. Tente outro nome.', E_USER_WARNING);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopGrade.nome' => Tools::clean(Tools::getValue('nome')),
                    'ShopGrade.default' => 1
                )
            );

            if ($this->ShopGrade->find('count', $conditions) > 0) {
                throw new \Exception\VialojaOverflowException('Já existe uma grade com o mesmo nome. Tente outro nome.', E_USER_WARNING);
            }

            /**
             *
             * Altera o nome da grade
             *
             **/
            $fields = array(
                'ShopGrade.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome')))
            );

            $conditions = array(
                'ShopGrade.id_grade' => $this->params['named']['id_grade'],
                'ShopGrade.id_shop_default' => $this->Session->read('id_shop')
            );

            $this->ShopGrade->updateAll($fields, $conditions);

            if ($this->ShopGrade->getAffectedRows() > 0) {
                $this->setMsgAlertSuccess('Grade editada com sucesso!');
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

}
