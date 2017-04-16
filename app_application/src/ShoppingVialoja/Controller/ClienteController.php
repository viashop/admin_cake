<?php

use Respect\Validation\Validator as v;
App::uses('AppController', 'Controller');

class ClienteController extends AppController {

	public $uses = array('Cliente', 'RecuperaSenha', 'Shop');

    private $conditions;
    private $data;
    private $datasource;
	private $column, $param;
    private $error = null;
    private $tipo_cadastro;
    private $nome_completo;
    private $nome;
    private $responsavel;
    private $senha;
    private $aliases;
    private $cnpj;
    private $razao_social;
    private $info_tributo;
    private $ie;
    private $sexo;
    private $id_sexo;
    private $data_nasc;
    private $cpf;
    private $obj;
    private $objRe;
    private $telefone_residencial;
    private $telefone_celular;
    private $optin;
    private $msg_atencao;
    private $email;
    private $hash;
    private $cipher;
    private $erro_encontrado = null;
    private $url_retorno;
    private $login;
    private $shop;
    private $options;
    private $mensagem;
    private $configMail;
    private $enviaEmail;

    /**
     * Cria conta
     * @access public
     * @param Array $this->email
     * @param String $data
     */
    public function criar() {

        self::commons_inc();

        define('INCLUDE_CLIENTE', true);

        if ($this->request->is('post')) {

            $this->datasource = $this->Cliente->getDataSource();

            try {

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $csrfGuard = new CSRFGuard();

                if (!$csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new Exception(ERROR_PROCESS, E_USER_NOTICE);

                } else {

                    $this->tipo_cadastro = Tools::getValue('tipo_cadastro');
                    $this->nome_completo = Tools::clean(Tools::getValue('nome_completo'));
                    $this->responsavel = Tools::clean(Tools::getValue('responsavel'));
                    $this->email = Tools::clean(Tools::getValue('email'));
                    $this->senha = Tools::clean(Tools::getValue('senha'));
                    $this->confirmacao_senha = Tools::clean(Tools::getValue('confirmacao_senha'));
                    $this->aliases = Tools::clean(Tools::getValue('aliases'));

                    $this->telefone_residencial = Tools::clean(Tools::getValue('telefone_residencial'));
                    $this->telefone_celular = Tools::clean(Tools::getValue('telefone_celular'));

                    $this->optin = Tools::clean(Tools::getValue('optin'));

                    if ($this->tipo_cadastro =='cpf') {

                        $this->sexo = Tools::clean(Tools::getValue('sexo'));
                        $this->data_nasc = Tools::clean(Tools::getValue('data_nasc'));
                        $this->cpf = Tools::clean(Tools::getValue('cpf'));

                        if ($this->nome_completo =='') {
                            $this->error .= '<br />Por favor, informe seu nome Completo.';
                        }

                        if ($this->cpf =='') {
                            $this->error .= '<br />Por favor, informe seu CPF.';
                        } elseif (!v::cpf()->validate($this->cpf)) {
                            $this->error .= '<br />Este CPF <strong>'. $this->cpf .'</strong> é inválido.';
                        }

                        if ($this->sexo =='') {
                            $this->error .= '<br />Por favor, selecione o sexo.';
                        }

                        if ($this->data_nasc =='') {
                            $this->error .= '<br />Por favor, informe sua data de nascimento.';
                        }

                        if ($this->aliases =='') {
                            $this->error .= '<br />Por favor, informe como gostaria de ser chamando.';
                        }

                    } else {

                        $this->cnpj = Tools::clean(Tools::getValue('cnpj'));
                        $this->razao_social = Tools::clean(Tools::getValue('razao_social'));
                        $this->info_tributo = Tools::clean(Tools::getValue('info_tributo'));
                        $this->ie = Tools::clean(Tools::getValue('ie'));

                        if ($this->razao_social =='') {
                            $this->error .= '<br />Por favor, informe a Razão Social.';
                        }

                        if ($this->cnpj =='') {
                            $this->error .= '<br />Por favor, informe seu o CNPJ.';
                        }

                        if ($this->cnpj =='') {
                            $this->error .= '<br />Por favor, informe seu CNPJ.';
                        } elseif (!v::cnpj()->validate($this->cnpj)) {
                            $this->error .= '<br />Este CNPJ <strong>'. $this->cnpj .'</strong> é inválido.';
                        }

                        if ($this->info_tributo =='') {
                            $this->error .= '<br />Por favor, Selecione a Informação tributária.';
                        }

                        if ($this->ie =='') {
                            $this->error .= '<br />Por favor, informe a Inscrição Estadual.';
                        }

                        if ($this->responsavel =='') {
                            $this->error .= '<br />Por favor, informe o nome do Responsável.';
                        }

                    }

                    if ($this->email =='') {
                        $this->error .= '<br />Por favor, informe seu e-mail corretamente.';
                    } elseif (!Validate::isEmail($this->email)) {
                        $this->error .= '<br />Por favor, informe o e-mail corretamente.';
                    } else {

                        /**
                         *
                         * verifico se o usuario ja existe
                         *
                         **/
                        $this->conditions = array(
                            'conditions' => array(
                                'Cliente.email' => $this->email
                            )
                        );

                        if ($this->Cliente->find('count', $this->conditions) !== 0) {

                            $this->error .= '<br />Uma conta usando esse endereço de e-mail já foi registrado.';

                        }

                    }

                    if ($this->senha =='') {

                        $this->error .= '<br />Por favor, informe a sua senha.';

                    } elseif (strpos($this->senha, ' ') !== false) {

                        $this->error .= '<br />Não é permitido espaço em branco na senha.';

                    }

                    if (Validate::weakPassword($this->senha) === true) {

                        $this->error .= '<br />Sua senha foi detectada como insegura!';

                    }

                    if (!Validate::isPasswd($this->senha)) {

                        $this->error .= '<br />A senha deve conter no miníno 6 caracteres.';

                    }

                    if ($this->confirmacao_senha =='') {

                        $this->error .= '<br />Por favor, confirme sua senha.';

                    }

                    if (Tools::getValue('check') =='') {
                        $this->error .= '<br />É necessário aceitar os termos de serviço.';
                    } else {
                        $this->set('check', true);
                    }

                    if ($this->senha !== $this->confirmacao_senha) {
                        $this->error .= '<br />As senhas não são iguais.';
                    }

                    if (count($this->error) > 0) {

                        $this->msg_atencao = '<span style="font-size:18px;"><strong>Atenção: Erros econtrados!</strong></span>';

                        throw new Exception($this->msg_atencao.$this->error, 1);

                    } else {

                        $this->hash  = sha1(Tools::uniqid());

                        if ($this->sexo !='') {
                            $this->id_sexo = $this->sexo;
                        } else {
                            $this->id_sexo = 3;
                        }

                        $this->cipher = new \Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);
                        $this->set('cipher', $this->cipher);

                        $this->data = array(

                            'tipo_cadastro' => $this->tipo_cadastro,
                            'nome' => $this->nome_completo,
                            'razao_social' => $this->razao_social,
                            'id_sexo' => $this->id_sexo,
                            'cpf' => $this->cipher->encrypt($this->cpf),
                            'cnpj' => $this->cipher->encrypt($this->cnpj),
                            'info_tributo' => $this->info_tributo,
                            'ie' => $this->ie,
                            'data_nasc' => Tools::formatToDateDB($this->data_nasc),
                            'telefone_residencial' => $this->telefone_residencial,
                            'telefone_celular' => $this->telefone_celular,
                            'aliases' => $this->aliases,
                            'responsavel' => $this->responsavel,
                            'email' => $this->email,
                            'senha' => \Lib\PasswordHasher::generate($this->senha),
                            'ativo' => 1,
                            'security_key' => $this->hash,
                            'boletim_shopping' => $this->optin,
                            'ip' => $this->request->clientIp()

                        );

                        $this->Cliente->saveAll($this->data);

                        if ($this->Cliente->getAffectedRows()) {

                            ignore_user_abort();
                            session_regenerate_id();


                            /**
                             *
                             * Cria as sessoes e redireciona o usuario
                             *
                             **/
                            if ($this->tipo_cadastro =='cnpj') {
                                $this->nome_completo = $this->responsavel;
                            } else {
                                $this->nome_completo = $this->aliases;
                            }


                            $this->Session->write('id_cliente', $this->Cliente->getLastInsertId());
                            $this->Session->write('cliente_nivel', 1);
                            $this->Session->write('cliente_nome', $this->nome_completo);
                            $this->Session->write('cliente_email', $this->email);
                            $this->Session->write('cliente_security_key', $this->hash);
                            $this->Session->write('user_agent', $this->Session->userAgent());
                            $this->Session->write('user_ip_security', $this->request->clientIp());
                            $this->Session->write('email_auto_login', true);
							$this->Session->write('session_timestamp', time() + 60*60*3);

                            $this->cookieViaLoja()->_setcookie('__vialoja_user', $this->login['Cliente']['id_cliente'], 60*60*24*365);

                            $this->Session->setFlash(__('Sua conta foi criada.'), 'alert-box', array('class'=>'alert-success'));

                            /*
                            $this->enviaEmail = new \Email\Shopping\VerificaEnderecoEmail();

                            $this->enviaEmail->setNome($this->nome_completo);
                            $this->enviaEmail->setEmail($this->email);
                            $this->enviaEmail->setSenha($this->senha);
                            $this->enviaEmail->setHash($this->hash);

                            /**
                             *
                             * inclui as configurações da classe phpmailer
                             *
                             **/

                            /*

                            $configMail = new SendMail;

                            $configMail->setFromName('ViaLoja Shopping');
                            //$configMail->setAddress('wsduarte@outlook.com');
                            $configMail->setAddress($this->email);
                            $configMail->setSubject('Bem vindo a ViaLoja‏');
                            $configMail->setMessage( $this->enviaEmail->emailBemVindoShopping() );

                            /**
                             *
                             * enviar email
                             *
                             **\/
                            if ($configMail->sendMail() !== false) {


                            }
                            */

                            return $this->redirect( sprintf( '//%s/minha-conta', env('HTTP_HOST') ) );

                        }

                    }

                }

                $this->datasource->commit();


            } catch (PDOException $e) {

                $this->datasource->rollback();

				$this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'alert-danger'));
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (Exception $e) {

                $this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'alert-danger'));

            }

        }

        $this->set('email', $this->cookieViaLoja()->getCookie('userEmail') );

        $this->configCSRFGuard();

    }

    private function commons_inc()
    {

        $GLOBALS['ConfiguracaoAtividade']['res_atividades_option_all'] = $this->requestAction(array(
            'controller' => 'ConfiguracaoAtividade',
            'action' => 'optionAll'
        ));


        $GLOBALS['ConfiguracaoAtividade']['res_atividades_all'] = $this->requestAction(array(
            'controller' => 'ConfiguracaoAtividade',
            'action' => 'atividadeAll'
        ));

        /*
        $GLOBALS['BannerShopping']['res_managewidgets_footer_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'getBanner',
            'local_publicacao' => 'managewidgets-footer',
        ));

        */

    }

    /**
     * Login de usuario
     * @access public
     * @param Array $login
     * @param String $data
     */
    public function login()
    {

        if (Tools::getValue('back') =='criar_conta') {
            self::checa();
            exit();
        }

        self::commons_inc();

        define('INCLUDE_CLIENTE', true);

        if (isset($this->request->query['logoff'])) {
            $this->Session->setFlash(__('Você foi desconectado com segurança!'), 'alert-box', array('class'=>'alert-success'));
            return $this->redirect( sprintf( '//%s/cliente/conta/login', env('HTTP_HOST') ) );
        }

        if (isset($this->request->query['service'])) {

            if (isset($this->request->query['passive'])
                && $this->request->query['passive'] === 'false') {

                if (isset($this->request->query['message'])) {
                    $this->Session->setFlash(__(base64_decode($this->request->query['message'])), 'alert-box', array(
                        'class' => 'alert-danger'
                    ));
                }

                return $this->redirect(

                    sprintf('//%s/cliente/conta/login/?utm_passive=false&utm_referrer=%s',
                        env('HTTP_BASE'),
                        $this->request->query['service'],
                        rawurlencode( $this->request->query['utm_referrer'])
                    )

                );

            }

        }

        $this->set('title_for_layout', 'Fazer login das contas');

        if ($this->request->is('post')) {

            $this->email = Tools::clean(Tools::getValue('email'));
            $this->senha = Tools::clean(Tools::getValue('senha'));

            try {

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/

                $csrfGuard = new CSRFGuard();

                if (!$csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new Exception(ERROR_PROCESS, E_USER_NOTICE);

                } else {

                    $this->mensagem = 'Este campo é obrigatório.';
                    $this->set('email', $this->email);

                    if (empty($this->email)) {

                        $this->error = $this->mensagem;
                        $this->erro_encontrado = true;

                    } elseif (!Validate::isEmail($this->email)) {

                        $this->error = 'Este e-mail é inválido.';
                        $this->erro_encontrado = true;

                    } elseif ($this->senha =='') {

                        $this->error = $this->mensagem;
                        $this->erro_encontrado = true;

                    } elseif (!Validate::isPasswd($this->senha)) {

                        $this->error = 'A senha deve conter no miníno 6 caracteres.';
                        $this->erro_encontrado = true;

                    }

                    if (!isset($this->erro_encontrado)) {

                        /**
                         *
                         * filtro
                         *
                         **/
                        $this->conditions = array(
                            'conditions' => array(
                                'Cliente.email' => $this->email
                            )
                        );

                        /**
                         *
                         * Verifica se o usuario existe
                         *
                         **/

                        if ($this->Cliente->find('count', $this->conditions) <= 0) {
                            throw new Exception("O e-mail ou a senha inseridos estão incorretos.", 1);
                        }

                        /**
                         *
                         * Efetua o login via email
                         * Funcionando somente via email no momento
                         * @param email, cpf ou cnpj
                         * @return Array
                         **/
                        $this->login = $this->requestAction(array(
                            'controller' => 'Cliente',
                            'action' => 'loginCliente',
                            'email' => base64_encode($this->email)
                        ));


                        /**
                         *
                         * confere a senha digitada pelo usuário
                         *
                         **/
                        $this->hash = $this->login['Cliente']['senha'];

                        if (password_verify($this->senha, $this->hash)) {


                            /**
                             *
                             * Verifica se o usuário esta ativado, 1 para ativo
                             *
                             **/
                            if ($this->login['Cliente']['ativo'] <= 0) {

                                /*


                                throw new Exception("Você ainda não confirmou seu email.
                                                     Se você ainda não recebeu o email de confirmação,
                                                     <a href='/public/reenviar_email_confirmacao?email=" . urlencode($this->email) . "'>reenvie o email agora.</a>", 1);
                                */

                            } else {

                                session_regenerate_id();


                                /**
                                 *
                                 * Cria as sessoes e redireciona o usuario
                                 *
                                 **/
                                $this->Session->write('id_cliente', $this->login['Cliente']['id_cliente']);
                                $this->Session->write('id_shop_grupo', $this->login['Cliente']['id_shop_grupo']);
                                $this->Session->write('id_shop', $this->login['Cliente']['id_shop']);
                                $this->Session->write('id_default_grupo', (int)$this->login['Cliente']['id_default_grupo']);
                                $this->Session->write('cliente_nivel', (int)$this->login['Cliente']['nivel']);
                                $this->Session->write('cliente_nome', $this->login['Cliente']['nome']);
                                $this->Session->write('cliente_email', $this->login['Cliente']['email']);
                                $this->Session->write('cliente_security_key', $this->login['Cliente']['security_key']);
                                $this->Session->write('user_agent', $this->Session->userAgent());
                                $this->Session->write('user_ip_security', $this->request->clientIp());
								$this->Session->write('session_timestamp', time() + 60*60*3);

                                $this->cookieViaLoja()->_setcookie('__vialoja_user', $this->login['Cliente']['id_cliente'], 60*60*24*365);

                                if (Validate::isNotNull($this->login['Cliente']['id_shop'])) {

                                    $this->conditions = array(
                                        'fields' => array(
                                            'Shop.nome_loja'
                                        ),
                                        'conditions' => array(
                                            'Shop.id_shop' => $this->login['Cliente']['id_shop']
                                        )
                                    );

                                    $this->shop = $this->Shop->find('first', $this->conditions);

                                    $this->Session->write('loja_nome', $this->shop['Shop']['nome_loja']);

                                }

                                if (isset($this->request->query['utm_referrer'])) {

                                    $this->url_retorno = rawurldecode($this->request->query['utm_referrer']);
                                    if (Validate::isUrl($this->url_retorno)) {
                                        return $this->redirect($this->url_retorno);
                                    } else {
                                        return $this->redirect( '//'. env('HTTP_HOST') );
                                    }

                                } else {

                                    return $this->redirect( '//'. env('HTTP_HOST') );
                                }

                            }

                        } else {
                            throw new Exception("O e-mail ou a senha inseridos estão incorretos.", 1);
                        }

                    } else {

                        throw new Exception($this->error, 1);

                    }

                }

            } catch (PDOException $e) {

                \Exception\VialojaDatabaseException::errorHandler($e);

                $this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'alert-danger'));

            } catch (Exception $e) {

                $this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'alert-danger'));

            } finally {

				$this->set('email', $this->email);

			}

        }

        if ( isset($_COOKIE['PROVSID']) ) {
            return $this->redirect(array(
                'controller' => 'minha-conta'
            ));
        }

        if ($this->request->is('get')) {

            if (Tools::getValue('utm_message') !='') {

                $this->Session->setFlash(__( base64_decode( rawurldecode( Tools::getValue('utm_message') ) ) ), 'alert-box', array(
                    'class' => 'alert-danger'
                ));

            }

        }

        $this->configCSRFGuard();

    }

    /**
     * Checa email de usuário
     * @access public
     * @param String $email
     * @param Array $this ->conditions
     */
    public function checa()
    {


        $this->layout = false;
        $this->render(false);

        if (!$this->request->is('post')) {
            return false;
        }

        //verificar se o pedido e via ajax, exit se não for
        if (!$this->request->is('ajax')) {
            return false;
        }

        try {

            if (isset($this->request->data['email_create'])) {

                if (!Validate::isEmail($this->request->data['email_create'])) {
                    throw new Exception("Endereço de e-mail inválido.", 1);
                }

                /**
                 *
                 * verifico se o usuario ja existe
                 *
                 **/
                $this->conditions = array(
                    'conditions' => array(
                        'Cliente.email' => $this->request->data['email_create']
                    )
                );

                if ($this->Cliente->find('count', $this->conditions) <= 0) {

                    $this->cookieViaLoja()->_setcookie('userEmail', $this->request->data['email_create'], 60 * 60 * 24 * 365);

                    echo '{"hasError":false}';

                } else {

                    throw new Exception("Uma conta usando esse endereço de e-mail já foi registrado. Por favor, insira uma senha válida no formulário ao lado.", 1);

                }

            }

        } catch (PDOException $e) {

            echo '{"hasError":true,"errors":["' . $e->getMessage() . '"]}';

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (Exception $e) {

            echo '{"hasError":true,"errors":["' . $e->getMessage() . '"]}';

        }

    }

	/**
     * Recupera a senha
     * @access public
     * @param Array $cliente
     * @param String $data
     */
    public function esqueceu_a_senha() {

        $this->set('title_for_layout', 'Esqueceu sua senha?');

        self::commons_inc();
		define('INCLUDE_CLIENTE', true);

        if ($this->request->is('post')) {

            try {

                /**
				 *
				 * Verifica o token CSRFGuard
				 *
				 **/

				$csrfGuard = new CSRFGuard();

				if (!$csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

					throw new Exception(ERROR_PROCESS, E_USER_NOTICE);

				} else {

                    if (empty($this->request->data['email'])) {

                        $this->set('erro', 'Este campo é obrigatório.');

                    } elseif (!Validate::isEmail($this->request->data['email'])) {

                        $this->set('erro', 'Este e-mail é inválido.');

                    } else {

                        /**
                         *
                         * array filtro
                         *
                         **/
                        $this->conditions = array(
                            'fields' => array(
                                'Cliente.id_cliente',
                                'Cliente.email',
                                'Cliente.nome'
                            ),
                            'conditions' => array(
                                'Cliente.email' => $this->request->data['email']
                            )
                        );


                        /**
                         *
                         * verifico se o usuario existe
                         *
                         **/
                        if ($this->Cliente->find('count', $this->conditions) <= 0) {
                            throw new Exception("Não existe nenhuma conta registrada para este endereço de e-mail.", 1);
                        }


                        $this->set('email', $this->request->data['email']);

                        /**
                         *
                         * retorna o array da table recupera_senha
                         *
                         **/
                        $this->obj = $this->Cliente->find('first', $this->conditions);

                        $this->hash = sha1(Tools::uniqid());

                        /**
                         *
                         * Deleta caso exista um hash antigo do usuario
                         *
                         **/
                        $this->RecuperaSenha->delete(array(
                            'RecuperaSenha.id' => $this->obj['Cliente']['id_cliente']
                        ));

                        /**
                         *
                         * Incluir no db os dados para recuperar a senha
                         *
                         **/
                        $this->data = array(
                            'id_cliente' => $this->obj['Cliente']['id_cliente'],
                            'hash' => $this->hash,
                            'ip' => $this->request->clientIp()
                        );

                        if ($this->RecuperaSenha->saveAll($this->data)) {

                            $this->enviaEmail = new \Email\Notification\Controller\Access\EmailEsqueceuSenha();

                            $this->enviaEmail->setNome($this->obj['Cliente']['nome'])
                                             ->setEmail($this->request->data['email'])
                                             ->setHash($this->hash);


                            $this->configMail = new \Email\Config\SendMail();

                            $this->configMail->setFromName('ViaLoja Shopping')
                                             ->setAddress($this->request->data['email'])
                                             ->setSubject('Redefinição de senha')
                                             ->setMessage( $this->enviaEmail->content() );


                            if ($this->configMail->sendMail() !== true) {

                                throw new Exception("Ocorreu um erro ao enviar o e-mail.", 1);

                            } else {

                                $this->set('title_for_layout', 'Recuperação iniciada');

                                /**
                                 *
                                 * Renderiza a view de reposta
                                 *
                                 **/
                                $this->render('esqueceu_a_senha_resposta');

                            }

                        }

                    }

                }

            } catch (PDOException $e) {

               $this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'alert-danger'));

                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (Exception $e) {

                /**
                 *
                 * seta a mensagem na div alert
                 *
                 **/
                $this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'alert-danger'));

            }

        }

        $this->configCSRFGuard();

    }

	public function multi_shipping() {

		define('INCLUDE_CLIENTE', true);

	}

	public function address() {

		define('INCLUDE_ADDRESS', true);

	}

   /**
     * Redifinição de senha
     * @access public
     * @param Array $cliente
     * @param String $data
     */
    public function usuario_senha_redefinir()
    {

        self::commons_inc();
        define('INCLUDE_CLIENTE', true);

        $this->set('title_for_layout', 'Redefinição de senha');

        /**
         *
         * Confere o token passado via url
         *
         **/

        try {

            if (empty($this->request->query['hash'])) {
                throw new Exception("Informe uma chave válida!", 1);
            }

            if (!Validate::isSha1($this->request->query['hash'])) {
                throw new Exception("Esta é uma chave inválida!", 1);
            }

            /**
             *
             * array filtro
             *
             **/
            $this->conditions = array(
                'fields' => array(
                    'RecuperaSenha.id_cliente'
                ),
                'conditions' => array(
                    'RecuperaSenha.hash' => $this->request->query['hash'],
                    'status' => 0
                )
            );

             /**
             *
             * verifico se o hash existe
             *
             **/

            if ($this->RecuperaSenha->find('count', $this->conditions) <= 0) {
                throw new Exception("Chave não encontrada ou expirado, por favor <a href='/cliente/esqueceu-a-senha' rel='nofollow' style='color:#009BCB;' title='Clique para gerar uma nova senha'>clique aqui</a> para gerar uma nova chave.", 1);
            }

            /**
             *
             * Verifica se o hash tem mais de 24 desativa
             *
             **/
            $this->date = new \DateTime(date('Y-m-d H:i:s'));
            $this->date->sub(new DateInterval('P1D'));

            $this->RecuperaSenha->updateAll(array(
                'RecuperaSenha.status' => 1
            ), array(
                'RecuperaSenha.hash' => $this->request->query['hash'],
                'RecuperaSenha.created <=' => $this->date->format('Y-m-d H:i:s')
            ));

        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

	        $this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'alert-danger'));

		} catch (Exception $e) {

            /**
             *
             * seta a mensagem na div alert
             *
             **/
            $this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'alert-danger'));

        }


        /**
         *
         * Verifica se o formulario foi enviado.
         *
         **/
        if ($this->request->is('post')) {

            $this->datasource = $this->Cliente->getDataSource();

            try {


                $this->datasource->begin();

                /**
				 *
				 * Verifica o token CSRFGuard
				 *
				 **/

				$csrfGuard = new CSRFGuard();

				if (!$csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

					throw new Exception(ERROR_PROCESS, E_USER_NOTICE);

				} else {

                    if ($this->RecuperaSenha->find('count', $this->conditions) <= 0) {
                        throw new Exception("Chave não encontrada ou expirado, por favor <a href='/cliente/esqueceu-a-senha' rel='nofollow' style='color:#009BCB;' title='Clique para gerar uma nova senha'>clique aqui</a> para gerar uma nova chave.", 1);
                    }

                    if (Tools::getValue('senha') =='') {
                        $this->set('erro', 'Este campo é obrigatório.');
                        $this->erro_encontrado = true;
                    }

                    if (Validate::weakPassword(Tools::getValue('senha')) === true) {
                        throw new Exception("Sua senha foi detectada como insegura!", 1);
                    }

                    if (!Validate::isPasswd(Tools::getValue('senha'))) {
                        $this->set('erro', 'A senha deve conter no miníno 6 caracteres.');
                        $this->erro_encontrado = true;
                    }

                    if (Tools::getValue('confirmacao_senha') == '') {
                        $this->set('erro', 'Este campo é obrigatório.');
                        $this->erro_encontrado = true;
                    }

                    if (strpos(Tools::getValue('senha'), ' ') !== false) {
                        $this->set('erro', 'Não é permitido espaço em branco na senha.');
                        $this->erro_encontrado = true;
                    }

                    if (Tools::getValue('senha') !== Tools::getValue('confirmacao_senha')) {
                        throw new Exception("Erro: As senhas não são iguais.", 1);
                    }

                    /**
                     *
                     * retorna o array da table recupera_senha
                     *
                     **/
                    $this->objRe = $this->RecuperaSenha->find('first', $this->conditions);

                    /**
                     *
                     * array filtro
                     *
                     **/
                    $this->conditions = array(
                        'fields' => array(
                            'Cliente.email',
                            'Cliente.nome'
                        ),
                        'conditions' => array(
                            'Cliente.id_cliente' => $this->objRe['RecuperaSenha']['id_cliente']
                        )
                    );

                    /**
                     *
                     * select get email enviar para envio de resposta
                     *
                     **/
                    $this->obj = $this->Cliente->find('first', $this->conditions);

                    /**
                     *
                     * dados para email
                     *
                     **/
                    $this->nome  = $this->obj['Cliente']['nome'];
                    $this->email = $this->obj['Cliente']['email'];
                    $this->set('email', $this->email);
                    $this->senha = Tools::getValue('senha');

                    if (Tools::passwordItsName($this->senha, $this->nome)) {
                        throw new Exception("A senha não pode conter dados do nome.", 1);
                    }

                    if (Tools::passwordItsEmail($this->senha, $this->email)) {
                        throw new Exception("A senha não pode conter dados do email.", 1);
                    }

                    if (!isset($this->erro_encontrado)) {


                        $this->data = array(
                            'senha' => \Lib\PasswordHasher::generate(Tools::getValue('senha')),
                            'ultima_troca_senha' => date('Y-m-d H:i:s'),
                            'ip' => $this->request->clientIp()
                        );

                        $this->Cliente->id = $this->objRe['RecuperaSenha']['id_cliente'];

                        if (!$this->Cliente->exists()) {
                            throw new Exception("Usuário não encontrado.", 1);
                        }

                        $this->Cliente->saveAll($this->data);

                        if ($this->Cliente->getAffectedRows()) {

                            /**
                             *
                             * Deleta o hash de recuperação de senha
                             *
                             **/
                            $this->RecuperaSenha->deleteAll(array(
                                'RecuperaSenha.hash' => $this->request->query['hash']
                            ));

                            $this->enviaEmail = new \Email\Notification\Controller\Access\EnviaEmailResposta();

                            $this->enviaEmail->setNome($this->nome)
                                             ->setEmail($this->email)
                                             ->setSenha($this->senha);

                            $this->configMail = new \Email\Config\SendMail();

                            $this->configMail->setFromName('ViaLoja Shopping')
                                             ->setAddress($this->obj['Cliente']['email'])
                                             ->setSubject('Dados atualizados no Shopping ViaLoja')
                                             ->setMessage($this->enviaEmail->content());

                            if ($this->configMail->sendMail() !== false) {

                                $this->set('title_for_layout', 'Senha redefinida com sucesso');

                                /**
                                 *
                                 * Renderiza a view de reposta
                                 *
                                 **/
                                $this->render('usuario_senha_redefinir_resposta');

                            }

                        } else {
							throw new Exception(ERROR_PROCESS);
						}

                    } else {

                        //throw new Exception("Houve um erro ao tentar efetuar a operação.", 1);

                    }

                    /*
                    $id = $this->obj['RecuperaSenha']['id_cliente'];
                    echo  $id;

                    $this->Cliente->updateAll(array('Cliente.senha' => $this->obj['RecuperaSenha']['id_cliente']),
                    array('Cliente.id_cliente' => $id));
                    */


                    $this->datasource->commit();

                }

            } catch (PDOException $e) {

                $this->datasource->rollback();

                $this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'alert-danger'));

                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (Exception $e) {

                $this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'alert-danger'));

            }

        }

        $this->configCSRFGuard();

    }

	/**
	 * Efetua login
	 * @access public
	 * @param String $email
	 * @param String $senha
	 * @param Array $this->conditions
	*/
	public function loginCliente()
	{

		try {

			/**
			*
			* Return Array da tabela usuario e grupoadmin
			*
			**/
			if (isset($this->params['named']['email'])){
				$this->param = base64_decode($this->params['named']['email']);
			}

			if (Validate::isEmail($this->param)) {
				$this->column = 'Cliente.email';
			}

			/*
			if (v::cpf()->validate($this->param)) {
				$campo = 'cpf';
			}

			if (v::cnpj()->validate($this->param)) {
				$campo = 'cnpj';
			}
			*/

			/**
			*
			* array filtro
			*
			**/
			$this->conditions = array(
		    	'fields' => array(
					    		'Cliente.id_cliente',
								'Cliente.id_shop_grupo',
								'Cliente.id_shop',
								'Cliente.id_default_grupo',
								'Cliente.nome',
								'Cliente.email',
								'Cliente.nivel',
								'Cliente.senha',
								'Cliente.ativo',
								'Cliente.security_key'
					    	),
		        'conditions' => array( $this->column => $this->param )
		    );


			/**
    		*
    		* verifico se o usuario existe
    		*
    		**/

    		if ($this->Cliente->find('count', $this->conditions) > 0) {
    			return $this->Cliente->find('first', $this->conditions);
    		} else {
    			return false;
    		}

		} catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

    public function validar() {

        $this->layout = false;
        $this->render(false);

        try {

            /**
             *
             * Confere o token passado via url
             *
             **/
            if ($this->request->is('get')) {

				if (empty($this->request->pass['2'])) {
					throw new Exception("Informe uma chave de ativação enviada no e-mail.", 1);
				}

				if (!Validate::isSha1($this->request->pass['2'])) {
					throw new Exception("A chave para confirmação de email não é válida,
				por favor tente novamente.", 1);

				}

				/**
				 *
				 * array filtro
				 *
				 **/
				$this->conditions = array(
					'conditions' => array(
						'Cliente.security_key' => $this->request->pass['2']
					)
				);

				if ($this->Cliente->find('count', $this->conditions) <= 0) {

					throw new Exception("A chave para confirmação de email não é válida,
				por favor tente novamente.", 1);

				}

				$this->Cliente->updateAll(
					array( 'Cliente.ativo' => true ),
					array(
						'Cliente.security_key' => $this->request->pass['2']
					)
				);

				if ($this->Cliente->getAffectedRows()) {

					$this->Session->setFlash(__('Conta verificada com sucesso.'), 'alert-box', array(
						'class' => 'alert-success'
					));

				} else {

					$this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array(
						'class' => 'alert-success'
					));

				}

				return $this->redirect(
					array(
						'controller' => 'cliente',
						'action' => 'conta', 'login'
					)
				);

            }

        } catch (PDOException $e) {


            \Exception\VialojaDatabaseException::errorHandler($e);
			$this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'alert-danger'));

			return $this->redirect(
				array(
					'controller' => 'minha-conta'
				)
			);

        } catch (Exception $e) {

            $this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'alert-danger'));

            return $this->redirect(
				array(
					'controller' => 'minha-conta'
				)
			);

        }

    }

}
