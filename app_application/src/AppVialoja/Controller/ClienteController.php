<?php

use Lib\Tools;
use Respect\Validation\Validator as v;
use CSRF\CSRFGuard;

class ClienteController extends AppController {

	public $uses = array(
		'Cliente',
        'ClienteShop',
        'ClienteShopGrupo',
        'ClienteEndereco',
        'Cidades'
	);

    public $helpers = array('PhpExcel');
    public $components = array('Paginator');

    private $error;
    private $limite = 25;
    private $errorException = false;
    private $datasource;

	/**
	 * Listar clientes do Shop
	 * @access public
	*/
	public function clienteListar() {

		try {

			$this->paginate = array(

                'fields' => array(
                    'Cliente.nome',
                    'Cliente.email',
                    'Cliente.id_cliente'
                ),

                'conditions' => array(
                    'ClienteShop.id_shop_default' => $this->Session->read('id_shop')
                ),

                'group' => array('ClienteShop.id_cliente_default'), //fields to GROUP BY
                'joins' => array(
                    array('table' => 'cliente',
                        'alias' => 'Cliente',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ClienteShop.id_cliente_default = Cliente.id_cliente',
                        )
                    )
                ),

                'limit' => $this->limite,
				'paramType' => 'querystring'

            );

            $clientes = $this->paginate('ClienteShop');
            $this->set( compact( 'clientes' ) );

            $this->set('limite', $this->limite);

		} catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
		}

		$this->set('title_for_layout', 'Listar clientes');


        $this->configCSRFGuard();

	}


    public function clienteBusca() {


        try {

            $busca = Tools::sanitizeFullText( Tools::getValue('q') );
            $busca = str_replace('%', "-1", $busca);

            if (!empty($busca)) {

                if (v::email()->validate($busca)) {
                    $filter_or = array(
                        'Cliente.email' => $busca,
                    );
                } else {
                    $filter_or = array(
                        'Cliente.nome LIKE' => '%'. $busca .'%',
                    );
                }

                $filter_conditions = array(
                    'ClienteShop.id_shop_default' => $this->Session->read('id_shop'),
                    'OR' => $filter_or
                );

            } else {


                /**
                 * Tratamento de busca pelo Nome
                 */
                $nome = Tools::sanitizeFullText( Tools::getValue('nome') );

                /**
                 * Tratamento de busca pelo Email
                 */
                $email = Tools::sanitizeFullText( Tools::getValue('email') );
                if (!v::email()->validate($email)) {
                    $email = null;
                }

                $cpf         = Tools::sanitizeFullText( Tools::getValue('cpf') );
                $dt_de       = Tools::sanitizeFullText( Tools::getValue('dt_de') );
                $dt_ate      = Tools::sanitizeFullText( Tools::getValue('dt_ate') );
                //$aniversario = Tools::sanitizeFullText( Tools::getValue('aniversario') );

                if ( !empty( $dt_de ) ) {
                    $dt_de = Tools::formatToDateDB( $dt_de );
                }

                if ( !empty( $dt_ate ) ) {
                    $dt_ate = Tools::formatToDateDB( $dt_ate );
                }

                $filter_conditions = array(

                    'ClienteShop.id_shop_default' => $this->Session->read('id_shop'),
                    'OR' => array(
                        'Cliente.nome'    => $nome,
                        'Cliente.email'   => $email,
                        'Cliente.cpf'     => $cpf,
                        "Cliente.created BETWEEN '". $dt_de ." 00:00:00' AND '". $dt_ate ." 23:59:59'"
                    )

                );

            }


            $this->paginate = array(

                'fields' => array(
                    'Cliente.nome',
                    'Cliente.email',
                    'Cliente.id_cliente'
                ),

                'conditions' => array(
                    'ClienteShop.id_shop_default' => $this->Session->read('id_shop'),
                    $filter_conditions,
                ),

                'group' => array('ClienteShop.id_cliente_default'), //fields to GROUP BY
                'joins' => array(
                    array('table' => 'cliente',
                        'alias' => 'Cliente',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ClienteShop.id_cliente_default = Cliente.id_cliente',
                        )
                    )
                ),

                'limit' => $this->limite,
                'paramType' => 'querystring'

            );

            $clientes = $this->paginate('ClienteShop');
            $this->set( compact( 'clientes' ) );

            $this->set('limite', $this->limite);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

        $this->set('title_for_layout', 'Busca por clientes');


        $this->configCSRFGuard();
        $this->render('cliente_listar');

        /*
        Array
                (
                    [q] => fsadf
                    [nome] =>
                    [email] =>
                    [cpf] =>
                    [dt_de] =>
                    [dt_ate] => 02/05/2016
                    [aniversario] =>
                    [csrfmiddlewaretoken] => qLTCDREldrgOeB1lAdJ5HURZb4dG8tW4
                )

        */


    }


    /**
     * Cliente Detalhar
    */
	public function clienteDetalhar()
    {

		try {

            if (!isset($this->request->params['pass']['1'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            if (!is_numeric($this->request->params['pass']['1'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            $dados_cliente = $this->ClienteShop->getFirstAll( $this->Session->read('id_shop'), $this->request->params['pass']['1'] );

            if ( $dados_cliente !== false ) {
                $this->set( compact( 'dados_cliente' ) );
            } else {
                throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
            }

            $shop_grupo  = $this->ClienteShopGrupo->getAll( $this->Session->read('id_shop') );
            $endereco    = $this->ClienteEndereco->getFirstAll( $this->request->params['pass']['1'] );

            $this->set( compact('shop_grupo') );
            $this->set( compact('endereco') );

            if (isset($endereco['ClienteEndereco']['id_cidade'])) {
                $cidade_estado = $this->Cidades->getCidadeEstadoClienteDetalhar( $endereco['ClienteEndereco']['id_cidade'] );
                $this->set( compact('cidade_estado') );
            }

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

		} catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

        } finally {

            if ($this->errorException !== false) {
                return $this->redirect( array('controller' => 'cliente', 'action' => 'listar') );
            }

        }

        $this->configCSRFGuard();

	}

    /**
     * Cliente Alterar Dados
    */
    public function clienteAlterar()
    {

        if ($this->request->is('post')) {


            try {

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {


                    if (!isset($this->request->params['pass'][1])) {
                        throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                    }

                    if ($this->request->params['pass'][1] =='grupo') {

                        $this->setMsgAlertSuccess('Grupo do cliente alterado com sucesso');
                        $this->redirect( $this->referer() );
                        //self::clienteAlterarGrupo();
                    }

                }

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            }

        }

    }

    /*
    private function clienteAlterarGrupos()
    {
        try {

            if (Tools::getValue('grupo_id') == '') {
                throw new \InvalidArgumentException("Informe o nome do grupo.", E_USER_WARNING);
            }

            $conditions = array(
                'conditions' => array(
                    'ClienteShopGrupo.nome' => Tools::clean(Tools::getValue('nome')),
                    'ClienteShopGrupo.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ClienteShopGrupo->find('count', $conditions ) > 0) {
                throw new \Exception\VialojaOverflowException('Já existe uma grupo com este nome. Tente novamente.', E_USER_WARNING);
            }

            $conditions = array(
                'conditions' => array(
                    'ClienteShopGrupo.nome' => Tools::clean(Tools::getValue('nome'))
                )
            );

            if ($this->ClienteShopGrupo->find('count', $conditions ) > 0) {
                throw new \Exception\VialojaOverflowException('Já existe um grupo com este nome. Tente novamente.', E_USER_WARNING);
            }

            $data = array(
                'id_shop_default' => $this->Session->read('id_shop'),
                'nome' => Tools::clean(Tools::getValue('nome'))
            );

            $ok = $this->ClienteShopGrupo->saveAll($data);

            if (is_bool($ok) && $ok === true) {

                $this->setMsgAlertSuccess('Grupo criado com sucesso!');
                return $this->redirect(array('controller' => $this->request->controller, 'action' => 'grupo', 'listar'));

            } else {
                throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
            }


        } catch (\Exception $e) {

        }

    }

    */


    /**
     * Listar grupo
    */
	public function grupoListar()
    {

		try {

			$this->limite = 30;

			$this->paginate = array(

                'fields' => array(
                    'ClienteShopGrupo.nome',
                    'ClienteShopGrupo.id_grupo'
                ),
                'conditions' => array(
                    'ClienteShopGrupo.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array('ClienteShopGrupo.nome' => 'ASC'),
                'limit' => $this->limite,
				'paramType' => 'querystring'

            );

            $grupos = $this->paginate('ClienteShopGrupo');

            $this->set( compact( 'grupos' ) );
            $this->set('limite', $this->limite);

            if ($this->Session->read('grupo_nome')) {
	            $this->set('flash_grupo_nome', $this->Session->read('grupo_nome'));
	            $this->Session->delete('grupo_nome');
	        }

		} catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            return $this->redirect( array('controller' => 'cliente', 'action' => 'listar') );

        }

		$this->set('title_for_layout', 'Listar grupos');


        $this->configCSRFGuard();

	}

    /**
     * Criar grupo
    */
	public function grupoCriar()
    {


		if ($this->request->is('post')) {

            $this->datasource = $this->ClienteShopGrupo->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    if (Tools::getValue('nome') == '') {
                        $this->set('error_nome', true);
                        throw new \InvalidArgumentException("Informe o nome do grupo.", E_USER_WARNING);
                    }

                    $conditions = array(
                        'conditions' => array(
                            'ClienteShopGrupo.nome' => Tools::clean(Tools::getValue('nome')),
                            'ClienteShopGrupo.id_shop_default' => $this->Session->read('id_shop')
                        )
                    );

                    if ($this->ClienteShopGrupo->find('count', $conditions ) > 0) {
                        throw new \Exception\VialojaOverflowException('Já existe uma grupo com este nome. Tente novamente.', E_USER_WARNING);
                    }

                    $conditions = array(
                        'conditions' => array(
                            'ClienteShopGrupo.nome' => Tools::clean(Tools::getValue('nome'))
                        )
                    );

                    if ($this->ClienteShopGrupo->find('count', $conditions ) > 0) {
                        throw new \Exception\VialojaOverflowException('Já existe um grupo com este nome. Tente novamente.', E_USER_WARNING);
                    }

                    $data = array(
                        'id_shop_default' => $this->Session->read('id_shop'),
                        'nome' => Tools::clean(Tools::getValue('nome'))
                    );

                    $ok = $this->ClienteShopGrupo->saveAll($data);

                    if (is_bool($ok) && $ok === true) {

                        $this->setMsgAlertSuccess('Grupo criado com sucesso!');
                        return $this->redirect(array('controller' => $this->request->controller, 'action' => 'grupo', 'listar'));

                    } else {
                        throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError($e->getMessage());
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->set('error_nome', true);
                $this->setMsgAlertError($e->getMessage());

            } catch (\Exception\VialojaOverflowException $e) {

                $this->set('error_nome', true);
                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->set('error_nome', true);
                $this->setMsgAlertError($e->getMessage());

            }

        }

		$this->set('title_for_layout', 'Criar grupo');


        $this->configCSRFGuard();

	}

    /**
     * Remover grupo
    */
	public function grupoRemover() {

		if ($this->request->is('post')) {

            $this->datasource = $this->ClienteShopGrupo->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    if ( Tools::getValue('grupos') == '' ) {
                        throw new \InvalidArgumentException(false, 1);
                    }

                    $conditions = array(

                        'fields' => array(
                            'ClienteShopGrupo.id_grupo',
                            'ClienteShopGrupo.nome'
                        ),

                        'conditions' => array(
                            'ClienteShopGrupo.id_shop_default' => $this->Session->read('id_shop'),
                            'ClienteShopGrupo.id_grupo' => Tools::getValue('grupos')
                        ),

                        'order' => array(
                            'ClienteShopGrupo.nome' => 'ASC'
                        )

                    );

                    $res_grupo = $this->ClienteShopGrupo->find('all', $conditions );

                    $this->set( compact( 'res_grupo' ) );

                    if ( Tools::getValue('confirmacao') !='' ) {

	                    $grupos = array();
	                    foreach ($res_grupo as $grupo) {
	                        array_push($grupos, $grupo['ClienteShopGrupo']['nome']);
	                    }

	                    $this->Session->write('grupo_nome', $grupos);

	                }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

               $this->setMsgAlertError($e->getMessage());

            }

            try {

                if ( Tools::getValue('confirmacao') !='' ) {

                    $ok = $this->ClienteShopGrupo->deleteAll(array(
                        'ClienteShopGrupo.id_shop_default' => $this->Session->read('id_shop'),
                        'ClienteShopGrupo.id_grupo' => Tools::getValue('grupos')
                    ));

                    if (is_bool($ok) && $ok === true) {

                        return $this->redirect(array('controller' => $this->request->controller, 'action' => 'grupo', 'listar'));

                    } else {

                        throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);

                    }

                }

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);
                $this->setMsgAlertError($e->getMessage());

            }


            $this->configCSRFGuard();

            $this->set('title_for_layout', 'Remover grupo');

        } else {

            $this->setMsgAlertError(ERROR_PROCESS);

        }

	}

    /**
     * Grupo Editar
     * @access public
     * @param String $id_shop
     */
    public function grupoEditar()
    {

        if ($this->request->is('post')) {
            self::postEditGrupoEditar();
        }

        try {

            if (empty($this->request->params['pass']['2'])) {
                throw new \NotFoundException(ERROR_PARAM_NOT_FOUND, 1);
            }

            $conditions = array(
                'conditions' => array(
                    'ClienteShopGrupo.id_grupo' => $this->request->params['pass']['2'],
                    'ClienteShopGrupo.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ClienteShopGrupo->find('count', $conditions) <= 0) {
                throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
            }

            $grupo = $this->ClienteShopGrupo->find('first', $conditions);
            $this->set(compact('grupo'));

        } catch (\PDOException $e) {

            $this->setMsgAlertError($e->getMessage());
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());

        }

        $this->set('title_for_layout', 'Editar grupo');


        $this->configCSRFGuard();

    }

    /**
     * Recebe Post dados para editar grupo
     * @access private
     * @param String $id_shop
    */
    private function postEditGrupoEditar()
    {

        $this->datasource = $this->ClienteShopGrupo->getDataSource();

        try {

            $this->datasource->begin();

            /**
             *
             * Verifica o token CSRFGuard
             *
             **/

            $CSRFGuard = new CSRFGuard();

            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            } else {

                $this->error = false;
                if (Tools::getValue('nome') == '') {
                    $this->set('error_nome', strlen(Tools::getValue('nome')));
                    $this->error = true;
                }

                if ($this->error !== true) {

                    $conditions = array(
                        'conditions' => array(
                            'ClienteShopGrupo.nome' => Tools::clean(Tools::getValue('nome')),
                            'ClienteShopGrupo.id_grupo !=' => $this->request->params['pass']['2'],
                            'ClienteShopGrupo.id_shop_default' => $this->Session->read('id_shop')
                        )
                    );

                    if ($this->ClienteShopGrupo->find('count', $conditions ) > 0) {
                        throw new \Exception\VialojaOverflowException("Erro ao criar grupo. Nome já existe.", E_USER_WARNING);
                    }

                    $fields = array(
                        'ClienteShopGrupo.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome')))
                    );

                    $conditions = array(
                        'ClienteShopGrupo.id_grupo' => $this->request->params['pass']['2'],
                        'ClienteShopGrupo.id_shop_default' => $this->Session->read('id_shop')
                    );

                    $ok = $this->ClienteShopGrupo->updateAll( $fields, $conditions );

                    if (is_bool($ok) && $ok === true) {

                        $this->setMsgAlertSuccess('Grupo editado com sucesso!');

                    } else {
                        throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                    }

                }

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->set('error_nome', true);
			$this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

            $this->set('error_nome', true);
            $this->setMsgAlertError($e->getMessage());

        } catch (\Exception\VialojaOverflowException $e) {

            $this->set('error_nome', true);
            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->set('error_nome', true);
            $this->setMsgAlertError($e->getMessage());

        }

    }

}
