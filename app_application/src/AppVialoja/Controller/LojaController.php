<?php

use Lib\Tools;
use Lib\Validate;
use Respect\Validation\Validator as v;
use CSRF\CSRFGuard;
use Commons\VerificaPerfilSocial;
use Lib\Blowfish;


class LojaController extends AppController
{

    const MSG_GOOGLE = 'O arquivo enviado não parece ser o recomendado para a verificação do Google.';
    public $uses = array(
        'Shop',
        'ShopSelos',
        'ShopDominio',
        'ShopRedeSocial',
        'ShopEndereco',
        'ShopAtividade',
        'ShopConfiguracoesGoogle',
        'ShopTemaCustomizacao',
        'ClienteConvite',
        'Cliente',
        'Estados',
        'CancelarShop'
    );

    private $ok;
    private $error = false;
    private $getInsertID;
    private $dominio;
    private $subdominio;
    private $diretorio;
    private $arquivo;
    private $file;
    private $configMail;
    private $enviaEmail;
    private $google_verification_file;
    private $error_session;
    private $error_dados_endereco;
    private $error_dados_loja;
    private $error_email;
	private $nivel;

    private $error_atividade;
    private $erro_encontrado;
    private $mensagem;
    private $url_perfil;
    private $servico;
    private $array;
    private $error_nome;
    private $selo_google_safe;
    private $selo_norton_secured;
    private $selo_seomaster;
    private $facebook,$twitter,$pinterest,$instagram,$google_plus,$youtube;
    private $token,$email;
	private $json;
    private $datasource;

    /**
     * Lista usuario administrativo
     * @access public
     * @param String $data
     */
    public function usuarioListar()
    {

        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }


        if ($this->Shop instanceof Shop) {

            $this->Shop->setIdShop($this->Session->read('id_shop'));

            if ($this->Cliente instanceof Cliente) {
                $result_cliente = $this->Cliente->listar($this->Shop);
            }

            if ($this->ClienteConvite instanceof ClienteConvite) {
                $result_convite = $this->ClienteConvite->listar($this->Shop);
            }

            $this->set(compact('result_cliente', 'result_convite'));

        }


        $this->set('title_for_layout', 'Listar usuários');
        $this->configCSRFGuard();

    }

    /**
     * Editar usuario administrativo
     * @access public
     * @param String $data
     */
    public function usuarioEditar()
    {

        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }


        if ($this->Session->read('id_cliente') !== $this->request['pass']['2'] ) {
            $this->setMsgAlertInfo('Não é possível editar dados de acesso de outro usuário.');
        }

        if (!is_numeric($this->request['pass']['2'])) {
            return $this->redirect($this->referer());
        }

        if ($this->request->is('post')) {

            $this->datasource = $this->Cliente->getDataSource();

            try {

                $this->datasource->begin();

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $this->error = false;
                    if (Tools::getValue('nome') == '') {

                        $this->set('error_nome', true);
                        $this->setMsgAlertError('O nome não pode ser vazio.');
                        $this->error_nome = $this->error = true;

                    }

                    if (!v::email()->validate(Tools::getValue('email'))) {

                        $this->setMsgAlertError('Este e-mail é inválido.');
                        $this->error_email = $this->error = true;
                        $this->set('error_email', true);

                    }

                    if (isset($this->error_email) && isset($this->error_nome)) {

                        $this->setMsgAlertError('Nome não pode ser vázio e o e-mail é inválido.');
                        $this->error = true;
                        $this->set('error_email', true);

                    }

                    if ($this->Session->read('id_cliente') !== $this->request['pass']['2'] ) {

                        $this->setMsgAlertError('Ops! Não é possível editar dados de acesso de outro usuário.');
                        $this->error = true;

                    }

                    $conditions = array(

                        'fields' => array(
                            'Cliente.email'
                        ),

                        'conditions' => array(
                            'Cliente.email' => Tools::clean(Tools::getValue('email')),
                            'Cliente.id_shop !=' => $this->Session->read('id_shop')
                        )

                    );

                    if ($this->Cliente->find('count', $conditions) > 0 ) {

                        $this->setMsgAlertError('Este email ' . Tools::clean(Tools::getValue('email')) . ' já está em uso por outro usuário.');

                        $this->error_email = $this->error = true;
                        $this->set('error_email', true);

                    }

                    if ($this->error !==true ) {

                        # code...
                        $fields = array(
                            'Cliente.nome' => sprintf("'%s'", Tools::clean(Tools::getValue('nome'))),
                            'Cliente.email' => sprintf("'%s'", Tools::clean(Tools::getValue('email')))
                        );

                        $this->ok = $this->Cliente->updateAll(
                            $fields,
                            array(
                                'Cliente.id_shop' => $this->Session->read('id_shop'),
                                'Cliente.id_cliente' => $this->Session->read('id_cliente')
                            )
                        );

                        if (is_bool($this->ok) && $this->ok === true) {

                            $this->setMsgAlertSuccess('Dados de usuário editado com sucesso.');

                            self::redirecionaUsuarioListar();

                        } else {

                            throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);

                        }

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError($e->getMessage());

            }

        }

        try {

            $conditions = array(

                'fields' => array(
                    'Cliente.id_cliente',
                    'Cliente.nome',
                    'Cliente.nivel',
                    'Cliente.email'
                ),

                'conditions' => array(
                    'Cliente.id_shop' => $this->Session->read('id_shop'),
                    'Cliente.id_cliente' => $this->request['pass']['2']
                ),

            );

            $result_cliente = $this->Cliente->find('all', $conditions);
            $this->set(compact('result_cliente'));

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->set('title_for_layout', 'Editar usuário');


        $this->configCSRFGuard();

    }

    private function redirecionaUsuarioListar()
    {
        return $this->redirect(array(
            'controller' => $this->request->controller,
            'action' => 'usuario',
            'listar'
        ));

    }

    /**
     * Editar usuario administrativo
     * @access public
     * @param String $data
     */
    public function usuarioFuncao()
    {

        $this->layout=false;
        $this->render(false);

        if (!$this->request->is('post')) {
            return false;
        }

        if (!$this->request->is('ajax')) {
            return false;
        }

        $this->datasource = $this->Cliente->getDataSource();

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

                $conditions = array(
                    //'fields' => array('Cliente.nivel'),
                    'conditions' => array(
                        'Cliente.id_shop' => $this->Session->read('id_shop'),
                        'Cliente.id_cliente' => Tools::getValue('id_cliente')
                    )
                );

                $dados = $this->Cliente->find('first', $conditions);

                if ( $dados['Cliente']['nivel'] == '5') {
                    $this->nivel = 4;
                } else {
                    $this->nivel = 5;
                }

                # code...
                $fields = array(
                    'Cliente.nivel' => $this->nivel,
                );

                $this->ok = $this->Cliente->updateAll(
                    $fields,
                    array(
                        'Cliente.id_shop' => $this->Session->read('id_shop'),
                        'Cliente.id_cliente' => Tools::getValue('id_cliente')
                    )
                );

                if (is_bool($this->ok) && $this->ok===true) {

                    $conditions = array(
                        'conditions' => array(
                            'Cliente.id_shop' => $this->Session->read('id_shop'),
                            'Cliente.nivel' => 5
                        )
                    );

                    if ( $this->Cliente->find('count', $conditions) <= 0) {

                        # code...
                        $fields = array(
                            'Cliente.nivel' => 5,
                        );

                        $this->ok = $this->Cliente->updateAll(
                            $fields,
                            array(
                                'Cliente.id_shop' => $this->Session->read('id_shop'),
                                'Cliente.id_cliente' => Tools::getValue('id_cliente')
                            )
                        );

                        exit( 'error' );

                    } else {
                        exit('Os direitos de acesso de ' . Tools::getValue('email') . ' foram alterados.');
                    }

                } else {

                    throw new \RuntimeException();

                }

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

            exit( 'error_exception' );

        } catch (\RuntimeException $e) {

            exit( 'error_exception' );

        } finally {

            exit( 'error_exception' );

        }

    }

    /**
     * Convidar usuario administrativo
     * @access public
     * @param Array $this->email
     * @param String $data
     */
    public function usuarioConvidar()
    {

        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

        if ($this->request->is('post')) {

            $this->datasource = $this->ClienteConvite->getDataSource();

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

                    $this->email = Tools::clean(Tools::getValue('email'));

                    if (!v::email()->validate($this->email)) {
                       throw new \InvalidArgumentException("Este e-mail é inválido.", E_USER_WARNING);
                    }

                    /**
                     * Verifica se o email do convite já esta em uso por outra loja
                     */
                    $conditions = array(
                        'conditions' => array(
                            'Cliente.email' => $this->email,
                            'Cliente.nivel >' => 1,
                            'Cliente.id_shop !=' => $this->Session->read('id_shop'),
                        )
                    );

                    if ($this->Cliente->find('count', $conditions) > 0) {

                        throw new \Exception\VialojaOverflowException('Este e-mail '. $this->email .' já está associado a uma outra loja.', E_USER_WARNING);
                    }


                    /**
                     * Verifica se o email do convite já esta em uso pela loja
                     */
                    $conditions = array(
                        'conditions' => array(
                            'Cliente.email' => $this->email,
                            'Cliente.id_shop' => $this->Session->read('id_shop'),
                            'Cliente.nivel >' => 1
                        )
                    );

                    if ($this->Cliente->find('count', $conditions) > 0) {

                        throw new \Exception\VialojaOverflowException('Este e-mail '. $this->email .' já está associado a sua loja.', E_USER_WARNING);
                    }

                    /**
                     * Verifica se o email do convite já foi cadastrado
                     */
                    $conditions = array(
                        'conditions' => array(
                            'ClienteConvite.id_shop_default' => $this->Session->read('id_shop'),
                            'ClienteConvite.email' => $this->email,
                        )
                    );

                    if ($this->ClienteConvite->find('count', $conditions) > 0) {

                        throw new \Exception\VialojaOverflowException('Convite para este e-mail "'. $this->email .'" já foi enviado. Por favor aguarde confirmação.<br /> Para efetuar uma nova tentativa, remova o convite anterior da lista abaixo.');

                    }

                    $this->token = hash('sha256', Tools::uniqid());

                    $data = array(

                        'id_shop_default' => $this->Session->read('id_shop'),
                        'id_cliente_default' => $this->Session->read('id_cliente'),
                        'email' => $this->email,
                        'token' => $this->token,
                        'ip' => $this->request->clientIp(),

                    );

                    if ($this->ClienteConvite->saveAll($data)) {

                        $this->getLastInsertId = $this->ClienteConvite->getLastInsertId();

                        $this->enviaEmail = new \Email\Notification\Controller\Access\EnviaEmailConvite();
                        $this->enviaEmail->setHash($this->token)
										 ->setLojaNome(Tools::clean(Tools::getValue('loja_nome')));


						$this->configMail = new \Email\Config\SendMail();

						$this->configMail->setFromName('ViaLoja Shopping')
						                 ->setAddress($this->email)
                                         ->setSubject('Convite para ViaLoja Shopping')
                                         ->setMessage( $this->enviaEmail->content() );

                        if ($this->configMail->sendMail() !== false) {

                            $this->setMsgAlertSuccess('Convite enviado com sucesso.');

                        } else {

                            $this->ClienteConvite->id = $this->getLastInsertId;
                            if ($this->ClienteConvite->exists()) {
                                $this->ClienteConvite->delete();
                            }

                            throw new \RuntimeException('Houve um erro ao tentar criar o convite, por favor tente novamente.', E_USER_WARNING);

                        }

                    } else {

                        throw new \RuntimeException('Houve um erro ao tentar criar o convite, por favor tente novamente.', E_USER_WARNING);

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\Exception\VialojaOverflowException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError($e->getMessage());

            } finally {

                $this->set('error', true);

                self::redirecionaUsuarioListar();

            }

        }

        if ($this->Shop instanceof Shop) {

            $this->Shop->setIdShop($this->login['Cliente']['id_shop']);
            $loja_nome = $this->Shop->nomeLoja($this->Shop);
            $this->set(compact('loja_nome'));

        }

        $this->configCSRFGuard();

        $this->set('title_for_layout', 'Convidar usuário');

    }

    /**
     * Remover usuário administrativo
     * @access public
     * @param String $data
     */
    public function usuarioRemover()
    {

        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }


        try {

            if ($this->request->is('post')) {

                $fields = array(
                    'Cliente.nivel' => '1',
                    'Cliente.id_shop' => null
                );

                $this->ok = $this->Cliente->updateAll(
                    $fields,
                    array(
                        'Cliente.id_shop' => $this->Session->read('id_shop'),
                        'Cliente.id_cliente' => intval( $this->request['pass']['2'] )
                    )
                );

                if (is_bool($this->ok) && $this->ok === true) {

                    $this->setMsgAlertSuccess('O usuário foi removido com sucesso.');
                    self::redirecionaUsuarioListar();

                } else {

                    throw new \RuntimeException('Não foi possível remover o usuário, tente novamente.');

                }

            }

            $conditions = array(
                'fields' => array(
                    'Cliente.id_cliente',
                    'Cliente.nome'
                ),
                'conditions' => array(
                    'Cliente.id_shop' => $this->Session->read('id_shop'),
                    'Cliente.id_cliente' => $this->request['pass']['2']
                )
            );

            if ($this->Cliente->find('count', $conditions) <=0) {

                throw new \NotFoundException('O usuário não foi encontrado.');

            }

            $dados = $this->Cliente->find('first', $conditions);

            $this->set('nome', $dados['Cliente']['nome']);
            $this->set('id', $dados['Cliente']['id_cliente']);

            $this->set('title_for_layout', 'Removendo usuário ' . $dados['Cliente']['nome']);


        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);
            $this->error_exception = true;

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());
            $this->error_exception = true;

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError($e->getMessage());
            $this->error_exception = true;

        } finally {

            if ($this->error_exception===true) {

                self::redirecionaUsuarioListar();

            }

        }


        $this->configCSRFGuard();

    }

    public function cssEditar()
    {

        $this->set('title_for_layout', 'Editar CSS');

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopTemaCustomizacao->getDataSource();

            try {

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                } else {

                    $this->ShopTemaCustomizacao->deleteAll(array('id_shop_default' => $this->Session->read('id_shop') ));

                    $data = array(
                        'css' => Tools::htmlentitiesUTF8(Tools::getValue('css')),
                        'id_shop_default' => $this->Session->read('id_shop')
                    );

                    $this->ShopTemaCustomizacao->saveAll($data);

                    if ($this->ShopTemaCustomizacao->id > 0) {
                        $this->setMsgAlertSuccess('Tema editado com sucesso.');
                    } else {
                        $this->setMsgAlertError(ERROR_PROCESS . ' Tente novamente!');
                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            }

        }

        try {

            $conditions = array(

                'fields' => array(
                    'ShopTemaCustomizacao.css',
                ),
                'conditions' => array(
                    'ShopTemaCustomizacao.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopTemaCustomizacao->find('count', $conditions)) {
                $dados = $this->ShopTemaCustomizacao->find('first', $conditions);
                $this->set('css', Tools::htmlentitiesDecodeUTF8($dados['ShopTemaCustomizacao']['css']));
            } else {
                $this->set('css', null);
            }

            $this->set('url_shop', self::getDominio());

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }


        $this->configCSRFGuard();

    }

    /**
     * getDadosDominio
     * return String
     */
    private function getDominio()
    {
        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }
        return $this->ShopDominio->getDominioPrincipal($this->Shop);
    }

    public function temaEditar()
    {




    }

    public function dadosEditar()
    {


        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }


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

                    /**
                     *
                     * Cadastra o endereço de forma completa
                     *
                     **/
                    $this->error_session        = false;
                    $this->error_dados_endereco = false;

                    if ($this->request->data['mostrar_endereco'] == 'True') {

                        if (empty($this->request->data['cep']) || empty($this->request->data['endereco']) || empty($this->request->data['numero']) || empty($this->request->data['bairro']) || empty($this->request->data['complemento']) || empty($this->request->data['cidade'])) {

                            if (empty($this->request->data['cep'])) {
                                $this->set('error_cep', true);
                            }

                            if (empty($this->request->data['endereco'])) {
                                $this->set('error_endereco', true);
                            }

                            if (empty($this->request->data['numero'])) {
                                $this->set('error_numero', true);
                            }

                            if (empty($this->request->data['bairro'])) {
                                $this->set('error_bairro', true);
                            }

                            if (empty($this->request->data['complemento'])) {
                                $this->set('error_complemento', true);
                            }

                            if (empty($this->request->data['cidade'])) {
                                $this->set('error_cidade', true);
                            }

                            $this->set('error_dados_endereco', true);
                            $this->error_session        = true;
                            $this->error_dados_endereco = true;

                        }

                        if (isset($this->request->data['estado']) && $this->request->data['estado'] == "--") {

                            $this->set('error_estado', true);
                            $this->set('error_dados_endereco', true);
                            $this->error_dados_endereco = true;
                            $this->error_session        = true;

                        }

                    }

                    if ($this->error_dados_endereco !== true) {

            
                        if ($this->Shop instanceof Shop) {

                            $this->Shop->setIdShop($this->Session->read('id_shop'));


                             /** Cadastra o endereço de forma completa ***/
                            if ($this->ShopEndereco instanceof ShopEndereco) {

                                $this->ShopEndereco->setEndereco(Tools::clean(Tools::getValue('endereco')));
                                $this->ShopEndereco->setCep(Tools::clean(Tools::getValue('cep')));
                                $this->ShopEndereco->setBairro(Tools::clean(Tools::getValue('bairro')));
                                $this->ShopEndereco->setNumero(Tools::clean(Tools::getValue('numero')));
                                $this->ShopEndereco->setComplemento(Tools::clean(Tools::getValue('complemento')));
                                $this->ShopEndereco->setMostrarEndereco(Tools::getValue('mostrar_endereco'));
                                $this->ShopEndereco->setIdCidade(intval(Tools::getValue('cidade')));
                                $this->ShopEndereco->setIdEstado(intval(Tools::getValue('estado')));
                                $this->ShopEndereco->cadastrar($this->Shop, $this->ShopEndereco);

                            }

                        }

                    }


                    $this->error_dados_loja = false;
                    if (isset($this->request->data['email'])) {

                        if (!v::email()->validate($this->request->data['email'])) {

                            $this->set('error_email', true);
                            $this->set('error_dados_loja', true);
                            $this->error_dados_loja = true;
                            $this->error_session    = true;

                        }

                    }

                    if (Tools::getValue('loja_tipo') == "PF") {

                        if (isset($this->request->data['loja_cpf'])) {

                            if (!v::cpf()->validate($this->request->data['loja_cpf'])) {
                                $this->set('error_cpf', true);
                                $this->set('error_dados_loja', true);
                                $this->error_dados_loja = true;
                                $this->error_session    = true;
                            }

                        }

                    } elseif (Tools::getValue('loja_tipo') == "PJ") {
                        if (isset($this->request->data['loja_cnpj'])) {

                            if (!v::cnpj()->validate($this->request->data['loja_cnpj'])) {
                                $this->set('error_cnpj', true);
                                $this->set('error_dados_loja', true);
                                $this->error_dados_loja = true;
                                $this->error_session    = true;
                            }

                        }

                    }

                    if (empty($this->request->data['nome_loja']) || empty($this->request->data['descricao'])) {

                        if (empty($this->request->data['nome_loja'])) {
                            $this->set('error_nome_loja', true);
                        }

                        if (empty($this->request->data['descricao'])) {
                            $this->set('error_descricao', true);
                        }

                        $this->set('error_dados_loja', true);
                        $this->error_session    = true;
                        $this->error_dados_loja = true;

                    }

                    if ($this->error_dados_loja !== true) {

                        $cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);

                        $this->Shop->updateAll(

                            array(

                                'Shop.nome_loja' => sprintf("'%s'", Tools::clean(Tools::getValue('nome_loja'))),
                                'Shop.descricao' => sprintf("'%s'", Tools::clean(Tools::getValue('descricao'))),
                                'Shop.loja_tipo' => sprintf("'%s'", Tools::clean(Tools::getValue('loja_tipo'))),
                                'Shop.loja_nome_responsavel' => sprintf("'%s'", Tools::clean(Tools::getValue('loja_nome_responsavel'))),
                                'Shop.loja_razao_social' => sprintf("'%s'", Tools::clean(Tools::getValue('loja_razao_social'))),
                                'Shop.loja_cpf' => sprintf("'%s'", $cipher->encrypt(Tools::clean(Tools::getValue('loja_cpf')))),
                                'Shop.loja_cnpj' => sprintf("'%s'", $cipher->encrypt(Tools::clean(Tools::getValue('loja_cnpj')))),
                                'Shop.telefone' => sprintf("'%s'", Tools::clean(Tools::getValue('telefone'))),
                                'Shop.email' => sprintf("'%s'", Tools::clean(Tools::getValue('email'))),
                                'Shop.blog' => sprintf("'%s'", filter_var(Tools::clean(Tools::getValue('blog')), FILTER_SANITIZE_URL))

                            ),

                            array('Shop.id_shop' => $this->Session->read('id_shop'))

                        );

                    }

                    $this->error_atividade = false;
                    if (!isset($this->request->data['atividades']) || !is_array($this->request->data['atividades'])) {
                        $this->error_atividade = true;
                        $this->error_session   = true;
                    }

                    if ($this->error_atividade !== true) {

                        if ($this->ShopAtividade instanceof ShopAtividade) {

                            $this->ShopAtividade->removerTodos($this->Shop);

                            /** Cadastra as atividades escolhidas **/
                            if (v::arrayVal()->notEmpty()->validate($this->request->data['atividades'])) {

                                foreach ($this->request->data['atividades'] as $key => $id_atividade) {

                                    $this->ShopAtividade->setIdAtividade($id_atividade);
                                    $this->ShopAtividade->addAtividade($this->Shop, $this->ShopAtividade);

                                }

                            }

                        }

                    } else {

                        $this->set('error_atividade', true);
                    }

                    if ($this->error_session !== true) {

                        $this->setMsgAlertSuccess('Loja editada com sucesso.');

                        return $this->redirect(array(
                            'controller' => $this->request->controller,
                            'action' => 'dados',
                            'editar'
                        ));

                    } else {

                        $this->setMsgAlertError('Houve erro(s) ao tentar salvar. Verifique o(s) erro(s) abaixo.');

                    }

                }

            } catch (PDOException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => 'dados',
                    'editar'
                ));

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());
                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => 'dados',
                    'editar'
                ));

            }

        }

        $endereco = $this->ShopEndereco->getFirstAll($this->Shop);
        $this->set(compact('endereco'));

        $config = $this->Shop->getFirstAll( $this->Session->read('id_shop') );
        $this->set( compact('config') );

        $atividades_shop = $this->ShopAtividade->allAtividadeSubQuery($this->Shop);
        $this->set(compact('atividades_shop'));

        $estados = $this->Estados->getAll();
        $this->set( compact('estados') );

        $cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);
        $this->set( compact('cipher') );

        $this->set('title_for_layout', 'Editando dados da loja');


        $this->configCSRFGuard();

    }

    public function configuracaoEditar()
    {

        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

			$this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

        if ($this->request->is('post')) {

            $this->datasource = $this->Shop->getDataSource();

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

                    $this->erro_encontrado = false;

                    if (isset($this->request->data['dominio_apelido']) && !empty($this->request->data['dominio_apelido'])) {

                        $res = $this->requestAction(array(
                            'controller' => 'ShopDominio',
                            'action' => 'disponibilidadeDomain'
                        ));

                        if ($res !== NULL) {

                            $this->erro_encontrado = true;
                            $this->mensagem = sprintf("Atenção: O subdominio \"%s\" já em uso, por favor insira outro.", $this->request->data['dominio_apelido']);

                            $this->setMsgAlertError($this->mensagem);
                        }

                        $this->requestAction(array(
                            'controller' => 'ShopDominio',
                            'action' => 'alterarSubDominio'
                        ));

                    }

                    if ($this->erro_encontrado === false) {

                        if (!empty($this->request->data['numero_minimo_pedido'])) {

                            $fields = array(

                                'Shop.manutencao' => sprintf("'%s'", Tools::clean(Tools::getValue('manutencao'))),
                                'Shop.habilitar_mobile' => sprintf("'%s'", Tools::clean(Tools::getValue('habilitar_mobile'))),
                                'Shop.modo' => sprintf("'%s'", Tools::clean(Tools::getValue('modo'))),
                                'Shop.numero_pedido' => sprintf("'%s'", Tools::clean(Tools::getValue('numero_minimo_pedido'))),
                                'Shop.pedido_valor_minimo' => sprintf("'%s'", Tools::clean(Tools::getValue('pedido_valor_minimo'))),
                                'Shop.valor_produto_restrito' => sprintf("'%s'", Tools::clean(Tools::getValue('valor_produto_restrito'))),
                                'Shop.gerenciar_cliente' => sprintf("'%s'", Tools::clean(Tools::getValue('gerenciar_cliente'))),
                                'Shop.preferencia_url_dominio' => sprintf("'%s'", Tools::clean(Tools::getValue('preferencia_url_dominio'))),
                                'Shop.comentarios_produtos' => sprintf("'%s'", Tools::clean(Tools::getValue('comentarios_produtos')))

                            );

                        } else {

                            $fields = array(

                                'Shop.manutencao' => sprintf("'%s'", Tools::clean(Tools::getValue('manutencao'))),
                                'Shop.habilitar_mobile' => sprintf("'%s'", Tools::clean(Tools::getValue('habilitar_mobile'))),
                                'Shop.modo' => sprintf("'%s'", Tools::clean(Tools::getValue('modo'))),
                                'Shop.pedido_valor_minimo' => sprintf("'%s'", Tools::clean(Tools::getValue('pedido_valor_minimo'))),
                                'Shop.valor_produto_restrito' => sprintf("'%s'", Tools::clean(Tools::getValue('valor_produto_restrito'))),
                                'Shop.gerenciar_cliente' => sprintf("'%s'", Tools::clean(Tools::getValue('gerenciar_cliente'))),
                                'Shop.preferencia_url_dominio' => sprintf("'%s'", Tools::clean(Tools::getValue('preferencia_url_dominio'))),
                                'Shop.comentarios_produtos' => sprintf("'%s'", Tools::clean(Tools::getValue('comentarios_produtos')))

                            );

                        }

                        $this->ok = $this->Shop->updateAll($fields, array(
                            'Shop.id_shop' => $this->Session->read('id_shop')
                        ));

                        if (is_bool($this->ok) && $this->ok === true) {

							$this->setMsgAlertSuccess('A configuração foi salva com sucesso.');

                        } else {

							$this->setMsgAlertError('Houve um erro ao tentar salvar as configurações.');

                        }

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();;
				$this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

			} catch (\InvalidArgumentException $e) {

				$this->setMsgAlertError($e->getMessage());

			} catch (\BadFunctionCallException $e) {

				$this->setMsgAlertError($e->getMessage());

			} catch (\RuntimeException $e) {

				$this->setMsgAlertError(ERROR_PROCESS);

			}

        }

        try {

            $conditions = array(

                'fields' => array(
                    'Shop.manutencao',
                    'Shop.numero_pedido',
                    'Shop.pedido_valor_minimo',
                    'Shop.valor_produto_restrito',
                    'Shop.gerenciar_cliente',
                    'Shop.comentarios_produtos',
                    'Shop.habilitar_mobile',
                    'Shop.modo',
                    'Shop.preferencia_url_dominio'
                ),

                'conditions' => array(
                    'Shop.id_shop' => $this->Session->read('id_shop')
                )
            );

            $config = $this->Shop->find('first', $conditions);
            $this->set(compact('config'));


        }
        catch (\PDOException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        }


        /**
         *
         * Lista os dominios cadastrados
         *
         **/

		$result_dominio = $this->requestAction(array(
			'controller' => 'ShopDominio',
			'action' => 'getDadosDominioAll'
		));

		$this->set(compact('result_dominio'));


        $this->configCSRFGuard();

        $this->set('title_for_layout', 'Configurações da loja');

    }

    public function googleEditar()
    {


        if ($this->request->is('post')) {

            $this->datasource = $this->ShopConfiguracoesGoogle->getDataSource();

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

                    $this->ShopConfiguracoesGoogle->id = $this->Session->read('id_shop');

                    if (!$this->ShopConfiguracoesGoogle->exists()) {

                        $data = array(
                            'id_shop_default' => $this->Session->read('id_shop')
                        );

                        $this->ShopConfiguracoesGoogle->saveAll($data);

                    }

                    /**
                     *
                     * Verifica se o diretorio existe or cria
                     *
                     **/
                    if (isset($_FILES['google_verification_file']) && !empty($_FILES['google_verification_file'])) {

                        $this->diretorio = CDN_ROOT_UPLOAD . $this->Session->read('id_shop') . DS . 'arquivos'. DS;

                        $this->arquivo = isset($_FILES['google_verification_file']) ? $_FILES['google_verification_file'] : false;

                        if (isset($this->arquivo['name']) && $this->arquivo['error'] <= 0) {

                            if ($this->arquivo['size'] > 60) {
                                throw new \InvalidArgumentException("O arquivo enviado é muito grande para ser um arquivo de verificação do Google.", E_USER_WARNING);
                            }

                            if ($this->arquivo['type'] !== 'text/html') {
                                throw new \InvalidArgumentException(self::MSG_GOOGLE, 1);
                            }

                            if (!Validate::isFileValidAuthorized($this->arquivo)) {
								throw new \InvalidArgumentException(self::MSG_GOOGLE, 1);
							}

                            if (!Validate::isGoogleVerification($this->arquivo['name'])) {
                                throw new \InvalidArgumentException(self::MSG_GOOGLE, 1);
                            }


                            /**
                             *
                             * Deleta o arquivo antigo se existir
                             *
                             **/

                            $conditions = array(

                                'fields' => array(
                                    'ShopConfiguracoesGoogle.google_verification_file'
                                ),

                                'conditions' => array(
                                    'ShopConfiguracoesGoogle.id_shop_default' => $this->Session->read('id_shop')
                                )
                            );

                            $this->file = $this->ShopConfiguracoesGoogle->find('first', $conditions);

                            if (!empty($this->file['ShopConfiguracoesGoogle']['google_verification_file'])) {
                                Tools::deleteFile($this->diretorio . $this->file['ShopConfiguracoesGoogle']['google_verification_file']);
                            }

                            Tools::createFolder($this->diretorio);

                            if (move_uploaded_file($this->arquivo['tmp_name'], $this->diretorio . $this->arquivo['name'])) {
                                $this->google_verification_file = $this->arquivo['name'];
                            }

                        }

                    }

                    if (isset($this->google_verification_file)) {

                        $fields = array(

                            'ShopConfiguracoesGoogle.google_analytics_code' => sprintf("'%s'", $this->request->data['google_analytics_code']),
                            'ShopConfiguracoesGoogle.google_verification_file' => sprintf("'%s'", $this->google_verification_file),
                            'ShopConfiguracoesGoogle.google_adwords_code' => sprintf("'%s'", Tools::htmlentitiesUTF8($this->request->data['google_adwords_code'])),
                            'ShopConfiguracoesGoogle.google_adwords_remarketing_code' => sprintf("'%s'", Tools::htmlentitiesUTF8($this->request->data['google_adwords_remarketing_code']))

                        );

                    } else {

                        $fields = array(

                            'ShopConfiguracoesGoogle.google_analytics_code' => sprintf("'%s'", $this->request->data['google_analytics_code']),
                            'ShopConfiguracoesGoogle.google_adwords_code' => sprintf("'%s'", Tools::htmlentitiesUTF8($this->request->data['google_adwords_code'])),
                            'ShopConfiguracoesGoogle.google_adwords_remarketing_code' => sprintf("'%s'", Tools::htmlentitiesUTF8($this->request->data['google_adwords_remarketing_code']))

                        );

                    }

                    $this->ok = $this->ShopConfiguracoesGoogle->updateAll($fields, array(
                        'ShopConfiguracoesGoogle.id_shop_default' => $this->Session->read('id_shop')
                    ));

                    if (is_bool($this->ok) && $this->ok ===true) {

                        $this->setMsgAlertSuccess('Configurações editadas com sucesso.');

                    } else {

                        if (isset($this->arquivo['name'])) {

                            if (file_exists($this->diretorio . $this->arquivo['name'])) {
                                Tools::deleteFile($this->diretorio . $this->arquivo['name']);
                            }

                        }

                        throw new \RuntimeException('Não foi possível editar as configurações.', E_USER_WARNING);

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError($e->getMessage());

            }

        }

        try {

            $conditions = array(
                'conditions' => array(
                    'ShopConfiguracoesGoogle.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            $config_google = $this->ShopConfiguracoesGoogle->find('all', $conditions);
            $this->set(compact('config_google'));

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

        $this->set('dominio', self::getDominio());

        $this->set('title_for_layout', 'Certificado Digital de Segurança');


        $this->configCSRFGuard();

    }

    public function redesSociais()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopRedeSocial->getDataSource();

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

                    /**
                     *
                     * array filtro
                     *
                     **/
                    $conditions = array(

                        "ShopRedeSocial.id_shop_default" => $this->Session->read('id_shop')

                    );

                    $this->ShopRedeSocial->deleteAll($conditions);

                    if (Tools::getValue('facebook') || Tools::getValue('twitter') || Tools::getValue('pinterest') || Tools::getValue('instagram') || Tools::getValue('google_plus') || Tools::getValue('youtube') || Tools::getValue('skype') || Tools::getValue('whatsapp')) {

                        $this->facebook = VerificaPerfilSocial::corrigirUrlRedeSocial(Tools::getValue('facebook'), 'facebook');
                        $this->twitter = VerificaPerfilSocial::corrigirUrlRedeSocial(Tools::getValue('twitter'), 'twitter');
                        $this->pinterest = VerificaPerfilSocial::corrigirUrlRedeSocial(Tools::getValue('pinterest'), 'pinterest');
                        $this->instagram = VerificaPerfilSocial::corrigirUrlRedeSocial(Tools::getValue('instagram'), 'instagram');
                        $this->google_plus = VerificaPerfilSocial::corrigirUrlRedeSocial(Tools::getValue('google_plus'), 'google_plus');
                        $this->youtube = VerificaPerfilSocial::corrigirUrlRedeSocial(Tools::getValue('youtube'), 'youtube');

                        $data = array(

                            'id_shop_default' => $this->Session->read('id_shop'),
                            'facebook' => Tools::clean($this->facebook),
                            'twitter' => Tools::clean($this->twitter),
                            'pinterest' => Tools::clean($this->pinterest),
                            'instagram' => Tools::clean($this->instagram),
                            'google_plus' => Tools::clean($this->google_plus),
                            'youtube' => Tools::clean($this->youtube),
                            'skype' => Tools::clean(Tools::getValue('skype')),
                            'whatsapp' => Tools::clean(Tools::getValue('whatsapp'))

                        );

                        if ($this->ShopRedeSocial->saveAll($data)) {

                            $this->setMsgAlertSuccess('Informações de redes sociais salvas com sucesso.');

                        } else {

                            throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                        }

                    } else {

                        $this->setMsgAlertSuccess('Informações de redes sociais salvas com sucesso.');

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError($e->getMessage());

            }

        }

        try {

            $conditions = array(
                'conditions' => array(
                    'ShopRedeSocial.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            $rede_social = $this->ShopRedeSocial->find('all', $conditions);
            $this->set(compact('rede_social'));

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->set('title_for_layout', 'Redes Sociais');


        $this->configCSRFGuard();

    }

    /*

    public function certificado()
    {

        $this->set('title_for_layout', 'Certificado Digital de Segurança');



    }*/

    public function redes_sociaisVerificar()
    {

        $this->layout = false;
        $this->render(false);

        $this->json['status'] = "VALIDO";

        $this->url_perfil = Tools::getValue('url_perfil');
        $this->servico = Tools::getValue('servico');

        if ($this->servico == 'skype') {

            if (!v::alnum()->noWhitespace()->validate($this->url_perfil)) {
                $this->json['status'] = "INVALIDO";
            }

        } elseif ($this->servico == 'whatsapp') {

            if (!Validate::isPhoneNumber($this->url_perfil)) {
                $this->json['status'] = "INVALIDO";
            }

        } else {

           if (strpos($this->url_perfil, "http") !== false) {

                if ( VerificaPerfilSocial::verificarUrl($this->url_perfil,$this->servico) === false) {
                    $this->json['status'] = "INVALIDO";
                }

            } else {

                $this->array = array(
                    'facebook.com',
                    'twitter.com',
                    'pinterest.com',
                    'instagram.com',
                    'plus.google.com',
                    'youtube.com'
                );

               if (Tools::strposa($this->url_perfil, $this->array) === true) {

                    if ( VerificaPerfilSocial::verificarUrl($this->url_perfil,$this->servico) === false) {

                        $this->json['status'] = "INVALIDO";

                    }

                } else {

                   if (!v::alnum()->noWhitespace()->validate($this->url_perfil)) {

                        $this->json['status'] = "INVALIDO";

                    }

                }

            }

        }

        header('Content-Type: application/json');
        echo stripslashes( json_encode( $this->json ) );
        exit();

    }

    public function selos()
    {

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopSelos->getDataSource();

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

                    /**
                     *
                     * array filtro
                     *
                     **/
                    $conditions = array(

                        "ShopSelos.id_shop_default" => $this->Session->read('id_shop')

                    );

                    $this->ShopSelos->deleteAll($conditions);

                    $this->error = true;
                    if (!empty($this->request->data['selo_ebit'])) {
                        $this->error = false;
                    }

                    if (!empty($this->request->data['banner_ebit'])) {
                        $this->error = false;
                    }

                    $this->selo_google_safe = 'off';
                    if (isset($this->request->data['selo_google_safe'])) {
                        $this->selo_google_safe = 'on';
                        $this->error             = false;
                    }

                    $this->selo_norton_secured = 'off';
                    if (isset($this->request->data['selo_norton_secured'])) {
                        $this->selo_norton_secured = 'on';
                        $this->error                = false;
                    }


                    /**
                     *
                     * Por padrão na loja a variavel sempre sera on
                     *
                     **/

                    $this->selo_seomaster = 'on';
                    if (!isset($this->request->data['selo_seomaster'])) {
                        $this->selo_seomaster = 'off';
                        $this->error           = false;
                    }

                    if ($this->error === false) {

                        $data = array(

                            'id_shop_default' => $this->Session->read('id_shop'),
                            'selo_ebit' => Tools::htmlentitiesUTF8($this->request->data['selo_ebit']),
                            'banner_ebit' => Tools::htmlentitiesUTF8($this->request->data['banner_ebit']),
                            'selo_google_safe' => $this->selo_google_safe,
                            'selo_norton_secured' => $this->selo_norton_secured,
                            'selo_seomaster' => $this->selo_seomaster

                        );

                        if ($this->ShopSelos->saveAll($data)) {
                            $this->setMsgAlertSuccess('Informações salvas com sucesso.');
                        } else {
                            throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                        }

                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);

            }

        }

        try {

            $conditions = array(
                'fields' => array(
                    'ShopSelos.selo_ebit',
                    'ShopSelos.banner_ebit',
                    'ShopSelos.selo_google_safe',
                    'ShopSelos.selo_norton_secured',
                    'ShopSelos.selo_seomaster'
                ),
                'conditions' => array(

                    'ShopSelos.id_shop_default' => $this->Session->read('id_shop')

                )
            );

            $selos = $this->ShopSelos->find('all', $conditions);
            $this->set(compact('selos'));

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

        $dominio = $this->ShopDominio->getAllDominio($this->Shop);
        $this->set(compact('dominio'));

        $this->set('title_for_layout', 'Selos');


        $this->configCSRFGuard();

    }

    public function editar()
    {

        $this->set('title_for_layout', 'Estatística de uso da sua conta');



    }

     /**
     * Altera a logomarca da loja em painel
     * @access public
     * @param String $id_shop variavel de sessão
      * @return string
     */
    public function alterarLogo()
    {

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

        $this->set('title_for_layout', 'Alterar logo e ícone da página');

        $dados = $this->Shop->getDadosLogomarca($this->Shop);

        $diretorio = CDN_UPLOAD . $this->Session->read('id_shop') . '/';

        $this->set('logo', $dados['Shop']['logo']);
        $this->set('dir_logo', sprintf('%slogo/', $diretorio) );
        $this->set('erro_logo', $this->Session->read('erro_logo') );

        $this->set('logo_social', $dados['Shop']['logo_social']);
        $this->set('dir_logo_social', sprintf('%slogo_social/', $diretorio) );
        $this->set('erro_logo_social', $this->Session->read('erro_logo_social') );

        $this->set('background', $dados['Shop']['background']);
        $this->set('dir_background', sprintf('%sbackground/', $diretorio) );
        $this->set('erro_background', $this->Session->read('erro_background') );

        $this->set('favicon', $dados['Shop']['favicon']);
        $this->set('dir_favicon', sprintf('%sfavicon/', $diretorio) );
        $this->set('erro_favicon', $this->Session->read('erro_favicon') );

        $this->Session->delete('erro_logo');
        $this->Session->delete('erro_logo_scocial');
        $this->Session->delete('erro_background');
        $this->Session->delete('erro_favicon');


        $this->configCSRFGuard();

    }

    /**
     * Adicionar dominio
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $this->dominio variavel de sessão
     * @return string
     */
    public function dominioAdicionar()
    {

        $this->render(false);

        $this->datasource = $this->ShopDominio->getDataSource();

        try {

            $this->getInsertID = $this->requestAction(array(
                'controller' => 'ShopDominio',
                'action' => 'addDominioInicial'
            ));

            if ($this->getInsertID > 0) {

                $conditions = array(

                    'conditions' => array(
                        'ShopDominio.main' => 1,
                        'ShopDominio.id_dominio' => $this->getInsertID,
                        'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
                    )

                );

                if ($this->ShopDominio->find('count', $conditions) !== 0) {

                    $this->setMsgAlertSuccess(sprintf('O domínio %s foi adicionado com sucesso.', $this->request->data['dominio']));

                    $this->json['status']                = "SUCESSO";
                    $this->json['url_definir_principal'] = "/admin/loja/configuracao/editar";

                } else {

                    $this->json['status']                = "SUCESSO";
                    $this->json['url_definir_principal'] = "/admin/loja/configuracao/dominio/principal/" . $this->getInsertID;
                    $this->json['url_remover']           = "/admin/loja/configuracao/dominio/remover/" . $this->getInsertID;
                    $this->json['mensagem']              = "Domínio adicionado com sucesso.";
                    $this->json['id']                    = $this->getInsertID;

                }

            } else {

                $conditions = array(

                    'conditions' => array(
                        'ShopDominio.dominio' => trim($this->request->data['dominio']),
                        'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
                    )

                );

                $this->json['status'] = "ERRO";

                if ($this->ShopDominio->find('count', $conditions) > 0) {
                    $this->json['mensagem'] = 'Este domínio já foi cadastrado,
					entre caso dúvida, entre contato com o nosso suporte técnico <a href=\"mailto:suporte@vialoja.com.br\" target=\"_blank\">clicando aqui</a>.';
                } else {

                    $conditions = array(

                        'fields' => array(
                            'ShopDominio.dominio'
                        ),

                        'conditions' => array(
                            'ShopDominio.dominio' => trim($this->request->data['dominio'])
                        )

                    );

                    if ($this->ShopDominio->find('count', $conditions) !== 0) {

                        $this->json['mensagem'] = 'Este domínio já foi cadastrado por outro lojista, se você
						é dono deste domínio entre em contato com o nosso suporte técnico <a href=\"mailto:suporte@vialoja.com.br\" target=\"_blank\">clicando aqui</a>.';

                    }

                }

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->json['mensagem'] = ERROR_PROCESS;

        } finally {

            header('Content-Type: application/json');
            echo json_encode($this->json);
            exit();
        }

    }

    /**
     * Remove o dominio
     * @access public
     * @param String $id_shop variavel de sessão
     * @param String $this->dominio variavel
     * @return string
     */
    public function dominioRemover()
    {

        $this->render(false);

        $this->datasource = $this->ShopDominio->getDataSource();

        try {

            if (!is_numeric($this->request['pass']['3'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            if ($this->Shop instanceof Shop) {
                $this->Shop->setIdShop($this->Session->read('id_shop'));
            }

            /**
             *
             * Verifica o subdominio para excluir
             *
             **/
            $conditions = array(

                'fields' => array(
                    'ShopDominio.dominio'
                ),
                'conditions' => array(
                    'ShopDominio.id_dominio' => $this->request['pass']['3'],
                    'ShopDominio.add_cpanel' => 1,
                    'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
                )

            );

            if ($this->ShopDominio->find('count', $conditions) !== 0) {

                $this->dominio = $this->ShopDominio->find('first', $conditions);

                $this->subdominio = $this->ShopDominio->getIdFirstSubDominio($this->Shop);

                $ok = $this->requestAction(array(
                    'controller' => 'ShopDominio',
                    'action' => 'delDominio',
                    'virtual_uri' => $this->subdominio['ShopDominio']['virtual_uri'],
                    'dominio' => base64_encode($this->dominio['ShopDominio']['dominio'])
                ));

                if ($ok === true) {

                    $this->ShopDominio->id = $this->request['pass']['3'];

                    if ($this->ShopDominio->delete()) {
                        $this->setMsgAlertSuccess(sprintf('O domínio %s foi removido com sucesso.', $this->dominio['ShopDominio']['dominio']));
                    } else {
                        throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                    }

                } else {
                    throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                }

            } else {

                /**
                 *
                 * Verifica o subdominio para excluir
                 *
                 **/
                $conditions = array(

                    'fields' => array(
                        'ShopDominio.dominio'
                    ),

                    'conditions' => array(
                        'ShopDominio.id_dominio' => $this->request['pass']['3'],
                        'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
                    )

                );

                $this->dominio = $this->ShopDominio->find('first', $conditions);

                $this->ShopDominio->id = intval($this->request['pass']['3']);
                if ($this->ShopDominio->delete()) {

                    $this->setMsgAlertSuccess(sprintf('O domínio %s foi removido com sucesso.', $this->dominio['ShopDominio']['dominio']));

                } else {
                    throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
                }

            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError($e->getMessage());

        } finally {

            return $this->redirect(array(
                'controller' => $this->request->controller,
                'action' => 'configuracao',
                'editar'
            ));

        }

    }

    public function dominioPrincipal()
    {

        $this->render(false);

        $this->datasource = $this->ShopDominio->getDataSource();

        try {

            if (!is_numeric($this->request['pass']['3'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            if ($this->Shop instanceof Shop) {
                $this->Shop->setIdShop($this->Session->read('id_shop'));
            }


            /**
             *
             * Verifica o subdominio para excluir
             *
             **/
            $conditions = array(

                'fields' => array(
                    'ShopDominio.dominio'
                ),

                'conditions' => array(
                    'ShopDominio.id_dominio' => $this->request['pass']['3'],
                    'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
                )

            );

            if ($this->ShopDominio->find('count', $conditions) !== 0) {

                $dados = $this->ShopDominio->find('first', $conditions);

                $this->ShopDominio->updateAll(array(
                    'ShopDominio.main' => 0
                ), array(
                    'ShopDominio.subdominio_plataforma' => 'False',
                    'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
                ));

                $this->ShopDominio->updateAll(array(
                    'ShopDominio.main' => 1
                ), array(
                    'ShopDominio.id_dominio' => $this->request['pass']['3'],
                    'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
                ));

                $this->subdominio = $this->ShopDominio->getIdFirstSubDominio($this->Shop);

                $this->requestAction(array(
                    'controller' => 'ShopDominio',
                    'action' => 'definirDominioPrincipal',
                    'virtual_uri' => $this->subdominio['ShopDominio']['virtual_uri'],
                    'dominio' => base64_encode($dados['ShopDominio']['dominio']),
                    'id_dominio' => $this->request['pass']['3']
                ));

                $this->setMsgAlertSuccess(sprintf('O domínio %s foi definido como principal.', $dados['ShopDominio']['dominio']));

            } else {
                throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->datasource->commit();

        } catch (\PDOException $e) {

            $this->datasource->rollback();
            $this->setMsgAlertError(ERROR_PROCESS);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\RuntimeException $e) {

            $this->setMsgAlertError($e->getMessage());

        } finally {

            return $this->redirect(array(
                'controller' => $this->request->controller,
                'action' => 'configuracao',
                'editar'
            ));

        }

    }

    /**
     * Cancelar conta
     */
    public function cancelarConta() {

        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

        if ($this->request->is('post')) {

            try {

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

                }

                if (Tools::getValue('motivos') == '') {
                    throw new \InvalidArgumentException('Você Deve Informar Um Motivo.', E_USER_WARNING);
                }


                if ($this->Shop instanceof Shop) {
                    $this->Shop->setIdShop($this->Session->read('id_shop'));
                }

                $dados = $this->Shop->getIdStatusPlanoShop($this->Shop);
                $status_ativo = $dados['Shop']['ativo'];
                $res = $this->CancelarShop->insert( $this->Session->read('id_shop'), $this->Session->read('id_cliente'), $status_ativo);

                if ( $res > 0 ) {

                    $this->Shop->cancelarConta( $this->Session->read('id_shop') );

                    return $this->redirect( array('controller' => $this->request->controller, 'action' => 'cancelar','conta','cancelada' ));

                } else {

                    throw new \RuntimeException();

                }


            } catch (\InvalidArgumentException $e) {

                $this->setMsgAlertError($e->getMessage());

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);

            }

        }

        $this->configCSRFGuard();


    }

    public function contaCancelada() {

        $this->Session->destroy();
        $this->cookieViaLoja()->destroy();
        $this->layout=false;

    }

}
