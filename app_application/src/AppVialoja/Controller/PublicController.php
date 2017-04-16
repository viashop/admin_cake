<?php

/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 21/10/16 às 19:39
 */

use Lib\Tools;
use Lib\Validate;
use Respect\Validation\Validator as v;
use CSRF\CSRFGuard;
use Email\Notification\Controller\Access\EmailEsqueceuSenha;


class PublicController extends AppController
{

    public $layout = 'public';
    public $name = 'Public';
    public $components = array('RequestHandler');

    /**
     * Chama as Models
     * @var array
     */
    public $uses = array(
        'Cliente',
        'Shop',
        'Wizard',
        'RecuperaSenha',
        'ClienteConvite',
        'CancelarShopRecuperacao',
        'CancelarShop'
    );

    private $id_cliente;
    private $nome;
    private $email;
    private $senha;
    private $confirmacao_senha;
    private $service;
    private $message;
    private $hash;
    private $login;
    private $dados_cliente;
    private $dados_cliente_re;
    private $ok;
    private $convite;
    private $configMail;
    private $userEmail;
    private $passo;


    /**
     * Inicialização
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        if (isset($this->request->query['elo'])) {
            if (isset($_COOKIE['__vialoja_user'])) {
                return $this->redirect(FULL_BASE_URL . '/admin');
            }
        }

        $this->set('title_for_layout', 'Fazer login das contas');

    }

    /**
     * Trata Retorno de URLs
     * @return \Cake\Network\Response|null
     */
    private function sessionFlasUrlLogin()
    {

        if (Tools::getValue('service') != '') {

            $this->service = Tools::clean(Tools::getValue('service'));
            $this->message = base64_decode( Tools::clean(Tools::getValue('message')) );

            if (Tools::getValue('logoff') == 'true') {
                $this->Session->setFlash(__($this->message), 'flash_notification_public_success');
                return $this->redirect(sprintf('%s/public/login/', FULL_BASE_URL));
            }

            if (Tools::getValue('passive') == 'error') {

                if (Tools::getValue('continue') != 'false') {
                    $this->Session->write('url_retorno', Tools::getValue('continue'));
                }

                if (Tools::getValue('passive') == 'error') {
                    $this->Session->setFlash(__($this->message), 'flash_notification_public_error');
                    return $this->redirect(sprintf('%s/public/login/', FULL_BASE_URL));
                }

            }

        }

    }

    /**
     * pdate tela de configuracao rápida
     * @param string $passo
     */
    private function updateWizardPasso($passo = '')
    {

        $this->cookieViaLoja()->_setcookie('__vialoja_step', $passo, 60 * 60 * 24 * 365);

        if ($this->Shop instanceof Shop) {

            $this->Shop->setIdShop($this->Session->read('id_shop'));

            if ($this->Wizard instanceof Wizard) {
                $this->Wizard->setPasso($passo);
                $this->Wizard->updatePasso($this->Shop, $this->Wizard);
            }

        }

    }

    /**
     * Auto Login
     * @param  boolean $email email de verificação
     */
    private function verificaCookieAutoLogin($email = false)
    {

        if (isset($_COOKIE['__vialoja_user']) && !empty($_COOKIE['__vialoja_user'])) {
            return $this->redirect(FULL_BASE_URL . '/admin');
        }

        $this->email = Tools::clean($email);

        if (!isset($_COOKIE['userEmail']) || !isset($this->email)) {
            return false;
        }

        if (isset($this->email)) {
            $this->userEmail = $this->email;
        } else {
            $this->userEmail = $this->cookieViaLoja()->getCookie('userEmail');
        }

        if (v::email()->validate($this->userEmail)) {
            return false;
        }

        if ($this->Cliente instanceof Cliente) {

            $this->Cliente->setEmail($this->email);
            $this->login = $this->Cliente->emailExistsRetornaDados($this->userEmail);

        }

        session_regenerate_id();

        /** Cria as sessoes e redireciona o usuario **/
        $this->Session->write('id_cliente', $this->login['Cliente']['id_cliente']);
        $this->Session->write('id_shop', $this->login['Cliente']['id_shop']);
        $this->Session->write('cliente_nivel', $this->login['Cliente']['nivel']);
        $this->Session->write('cliente_email', $this->login['Cliente']['email']);
        $this->Session->write('cliente_nome', $this->login['Cliente']['nome']);
        $this->Session->write('cliente_security_key', $this->login['Cliente']['security_key']);
        $this->Session->write('token_security_login', Tools::tokenSecurityLogin());
        $this->Session->write('conta_auto_login', true);
        $this->Session->write('session_timestamp', time() + 60 * 60 * 3);

        $this->cookieViaLoja()->_setcookie('__vialoja_user', $this->login['Cliente']['id_cliente'], 60 * 60 * 24 * 365);

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->login['Cliente']['id_shop']);
        }

        if ($this->Wizard instanceof Wizard) {

            $this->passo = $this->Wizard->passoWizard($this->Shop);

            if ($this->passo['Wizard']['passo'] >= 5) {
                $this->Session->write('passo_wizard_complete', true);
                $this->cookieViaLoja()->_setcookie('__vialoja_step', 5, 60 * 60 * 24 * 365);
            } else {
                $this->Session->write('wizard_passo_config', $this->passo['Wizard']['passo']);
                $this->cookieViaLoja()->_setcookie('__vialoja_step', $this->passo['Wizard']['passo'], 60 * 60 * 24 * 365);
            }

            if ($this->passo['Wizard']['passo'] == 1) {

                if (isset($this->login['Cliente']['senha']) && !empty($this->login['Cliente']['senha'])) {

                    $this->Session->write('wizard_passo_config', 2);
                    $this->Session->write('wizard_passo_config_flash', true);

                    self::updateWizardPasso(2);
                    return $this->redirect(Tools::urlPassoWizard(2));

                }

                if (isset($this->login['Cliente']['nome']) && !empty($this->login['Cliente']['nome'])) {
                    $this->setMsgAlertSuccess('Parabéns! Seu email foi confirmado. Escolha uma senha para prosseguir.');
                } else {
                    $this->setMsgAlertSuccess('Parabéns! Seu email foi confirmado. Digite seu nome e escolha uma senha para prosseguir.');
                }

                return $this->redirect(Tools::urlPassoWizard(1));

            }

        }

        $this->Session->write('wizard_passo_config_flash', true);
        $this->setMsgAlertSuccess('Parabéns! Seu email foi confirmado. Configure sua loja.');

        return $this->redirect(Tools::urlPassoWizard(2));

    }

    /**
     * Redireciona login para atualizar Sessao de CSRF
     * @return \Cake\Network\Response|null
     */
    private function redirectLogin()
    {
        $redirect = sprintf(
            '%s/public/login/?service=%s&passive=error&continue=false&message=%s',
            FULL_BASE_URL,
            $this->request->controller,
            base64_encode($this->message)
        );

        return $this->redirect($redirect);

    }

    /**
     * Login de usuario
     * @access public
     */
    public function login()
    {

        self::verificaCookieAutoLogin();
        self::sessionFlasUrlLogin();

        if ($this->request->is('post')) {

            $this->email = Tools::clean(Tools::getValue('email'));
            $this->senha = Tools::clean(Tools::getValue('senha'));

            try {

                /** Verifica o token CSRFGuard ***/
                $CSRFGuard = new CSRFGuard();
                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                if (empty($this->email)) {
                    throw new \InvalidArgumentException('Informe seu email!');
                } elseif (!v::email()->validate($this->email)) {
                    throw new \InvalidArgumentException('Informe seu email corretamente.');
                }

                if (empty($this->senha)) {
                    throw new \InvalidArgumentException('Informe sua senha!');
                } elseif (!Validate::isPasswd($this->senha)) {
                    throw new \InvalidArgumentException('A senha deve conter no miníno 6 caracteres.');
                }

                if (empty($this->email) && empty($this->senha)) {
                    throw new \InvalidArgumentException('Por favor, Informe seus dados de acesso.');
                }

                if ($this->Cliente instanceof Cliente) {
                    $this->Cliente->setEmail($this->email);
                    $this->Session->write('email_login', $this->email);
                    $this->login = $this->Cliente->emailExistsRetornaDados($this->Cliente);
                }

                /** Confere a senha digitada pelo usuário **/
                $this->hash = $this->login['Cliente']['senha'];
                if (!password_verify($this->senha, $this->hash)) {
                    throw new \DomainException("O e-mail ou a senha inseridos estão incorretos.", E_USER_WARNING);
                }

                /** Verifica se o usuário esta ativado, 1 para ativo **/
                if ($this->login['Cliente']['ativo'] <= 0) {

                    throw new \DomainException("Você ainda não confirmou seu email.
                                        Se você ainda não recebeu o email de confirmação,
                                        <a href='" . FULL_BASE_URL .
                        "/public/reenviar-email-confirmacao/?email=" .
                        base64_encode($this->email) . "'>reenvie o email agora.</a>",
                        E_USER_WARNING
                    );

                }

                session_regenerate_id();

                /**
                 * Verifica se a conta foi cancelada
                 */
                if ($this->login['Cliente']['id_shop'] > 0) {

                    $reStatus = $this->Shop->getStatusContaCancelada($this->login['Cliente']['id_shop']);

                    if ($reStatus === true) {

                        if ($reStatus['Shop']['conta_cancelada'] == 'True') {
                            throw new \DomainException(
                                "Sua conta foi cancelada caso queira reativar a conta clique em reativar conta,
                                         <a href='" . FULL_BASE_URL . "/public/reativar-conta-loja/?email=" .
                                base64_encode($this->email) . "'>Reativar Conta.</a>",
                                E_USER_WARNING
                            );
                        }

                    }

                }

                /** Cria as sessoes e redireciona o usuario **/
                $this->Session->write('id_cliente', $this->login['Cliente']['id_cliente']);
                $this->Session->write('id_shop', $this->login['Cliente']['id_shop']);
                $this->Session->write('cliente_nivel', $this->login['Cliente']['nivel']);
                $this->Session->write('cliente_nome', $this->login['Cliente']['nome']);
                $this->Session->write('cliente_email', $this->login['Cliente']['email']);
                $this->Session->write('cliente_security_key', $this->login['Cliente']['security_key']);
                $this->Session->write('token_security_login', Tools::tokenSecurityLogin());
                $this->Session->write('conta_auto_login', false);
                $this->Session->write('session_timestamp', time() + 60 * 60 * 3);

                $this->cookieViaLoja()->_setcookie('__vialoja_user', $this->login['Cliente']['id_cliente'], 60 * 60 * 24 * 365);

                if ($this->Shop instanceof Shop) {

                    $this->Shop->setIdShop($this->login['Cliente']['id_shop']);
                    $nome_loja = $this->Shop->nomeLoja($this->Shop);
                    $this->Session->write('loja_nome', $nome_loja);

                }

                if ($this->Wizard instanceof Wizard) {
                    $this->passo = $this->Wizard->passoWizard($this->Shop);

                    if ($this->passo['Wizard']['passo'] >= 5) {
                        $this->Session->write('passo_wizard_complete', true);
                        $this->cookieViaLoja()->_setcookie('__vialoja_step', 5, 60 * 60 * 24 * 365);
                    } else {
                        $this->Session->write('wizard_passo_config', $this->passo['Wizard']['passo']);
                        $this->cookieViaLoja()->_setcookie('__vialoja_step', $this->passo['Wizard']['passo'], 60 * 60 * 24 * 365);
                    }
                }

                if ($this->Session->read('url_retorno')) {
                    return $this->redirect(urldecode($this->Session->read('url_retorno')));
                } else {
                    return $this->redirect(FULL_BASE_URL . '/admin');
                }

            } catch (\DomainException $e) {
                $this->Session->destroy();
                $this->cookieViaLoja()->destroy();
                $this->message = $e->getMessage();
            } catch (\InvalidArgumentException $e) {
                $this->message = $e->getMessage();
            } catch (\RuntimeException $e) {
                $this->message = ERROR_PROCESS;
            } catch (\Exception $e) {
                $this->message = $e->getMessage();
            } finally {
                $email = $this->Session->read('email_login');
                $this->set(compact('email'));
                self::redirectLogin();
            }

        }

        $this->set('title_for_layout', 'Fazer login das contas');
        $this->set('description_for_layout', 'Entre com Login e Senha para acessar sua Conta, e gerencie sua Loja Virtual.');
        $this->configCSRFGuard();

    }


    /**
     * Cadastrar novo usuario via LP
     * @access private
     */
    private function criarContaLojaVirtualLandingPage()
    {

        if ($this->request->is('post')) {

            $this->nome = Tools::clean(Tools::getValue('nome'));
            $this->email = Tools::clean(Tools::getValue('email'));

            try {

                if (empty($this->email)) {
                    throw new \InvalidArgumentException('Preencha o Email corretamente.');
                } elseif (!v::email()->validate($this->email)) {
                    throw new \InvalidArgumentException('Este e-mail é inválido.');
                }

                /** Verifico se o usuario ja existe **/
                $conditions = array(
                    'conditions' => array(
                        'Cliente.email' => $this->email,
                        array('not' => array('Cliente.id_shop' => null))
                    )
                );

                if ($this->Cliente->find('count', $conditions) !== 0) {
                    throw new \Exception\VialojaOverflowException(
                        "Já temos um cadastro com seu e-mail. Experimente fazer
                        <a href='" . FULL_BASE_URL . "/public/login/'>o login.</a>",
                        E_USER_WARNING
                    );
                }

                /** verifico se o usuario ja existe **/
                $conditions2 = array(
                    'conditions' => array(
                        'Cliente.email' => $this->email
                    )
                );

                $this->hash = sha1(Tools::uniqid());

                if ($this->Cliente->find('count', $conditions2) <= 0) {

                    $data = array(
                        'nome' => $this->nome,
                        'nivel' => 5,
                        'email' => $this->email,
                        'ip' => $this->request->clientIp(),
                        'security_key' => $this->hash
                    );

                    $this->ok = $this->Cliente->saveAll($data);

                } else {

                    $arrayUpgrade = array(
                        'nome' => $this->nome,
                        'security_key' => $this->hash,
                        'nivel' => 5,
                        'url_upgrade' => Tools::getUrl(),
                        'ip' => $this->request->clientIp()
                    );

                    // Update
                    $fields = array(
                        'Cliente.id_shop' => $this->convite['ClienteConvite']['id_shop_default'],
                        'Cliente.nivel' => 5,
                        'Cliente.security_key' => sprintf("'%s'", $this->hash),
                        'Cliente.up_nivel_validar' => sprintf("'%s'", addslashes(json_encode($arrayUpgrade))),
                    );

                    $conditions_up = array(
                        'Cliente.email' => $this->email
                    );

                    $this->ok = $this->Cliente->updateAll($fields, $conditions_up);

                }

                if (is_bool($this->ok) && $this->ok === true) {

                    if (isset($arrayUpgrade)) {
                        if (is_array($arrayUpgrade)) {
                            $sendMail = new  \Email\Notification\Controller\Verification\VerificarEnderecoEmailCadastrado();
                        }
                    } else {
                        $sendMail = new \Email\Notification\Controller\Verification\VerificarEnderecoEmailAutoLogin();
                    }

                    /*
                     * Dados de Email
                     */
                    $sendMail->setHash($this->hash)
                        ->setNome($this->nome)
                        ->setEmail($this->email);

                    /**
                     * inclui as configurações da classe phpmailer
                     */
                    $this->configMail = new \Email\Config\SendMail();

                    $this->configMail->setFromName('ViaLoja Shopping')
                        ->setAddress($this->email)
                        ->setSubject('Confirmação de e-mail‏');

                    if ($this->configMail->sendMail()) {
                        /** Renderiza a view de reposta **/
                        $this->render('criar_conta_loja_virtual_reposta');
                    }

                }

            } catch (\InvalidArgumentException $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
            } catch (\Exception\VialojaOverflowException $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
            } catch (\RuntimeException $e) {
                $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');
            } finally {
                $this->set('nome', $this->nome);
                $this->set('email', $this->email);
            }

        }

    }


    /**
     * Cadastrar novo usuario via LP (Nome e Email)
     * @access private
     */
    private function criarContaLojaVirtualPublic()
    {

        if ($this->request->is('post')) {

            $this->nome = Tools::clean(Tools::getValue('nome'));
            $this->email = Tools::clean(Tools::getValue('email'));
            $this->senha = Tools::clean(Tools::getValue('senha'));
            $this->confirmacao_senha = Tools::clean(Tools::getValue('confirmacao_senha'));


            try {

                /** Verifica o token CSRFGuard **/
                $CSRFGuard = new CSRFGuard();
                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                if (!v::stringType()->notEmpty()->validate($this->nome)) {
                    throw new \InvalidArgumentException('Preencha o Nome corretamente.', E_USER_WARNING);
                }

                if (!v::email()->notEmpty()->validate($this->email)) {
                    throw new \InvalidArgumentException('Este e-mail é inválido.', E_USER_WARNING);
                }

                if (empty($this->senha)) {
                    throw new \InvalidArgumentException('Preencha a Senha corretamente.', E_USER_WARNING);
                } elseif (!v::noWhitespace()->validate($this->senha)) {
                    throw new \InvalidArgumentException('Não é permitido espaço em branco na Senha.', E_USER_WARNING);
                }

                if (Validate::weakPassword($this->senha) === true) {
                    throw new \InvalidArgumentException("Sua Senha foi detectada como insegura!", E_USER_WARNING);
                }

                if (!Validate::isPasswd($this->senha)) {
                    throw new \InvalidArgumentException('A senha deve conter no miníno 6 caracteres.', E_USER_WARNING);
                }

                if (empty($this->confirmacao_senha)) {
                    throw new \InvalidArgumentException('Confirme sua Senha corretamente.', E_USER_WARNING);
                }

                if (!v::identical($this->senha)->validate($this->confirmacao_senha)) {
                    throw new \InvalidArgumentException("Erro: As Senhas não são iguais.", E_USER_WARNING);
                }

                /** Verifica se o usuario ja existe **/
                $conditions = array(
                    'conditions' => array(
                        'Cliente.email' => $this->email,
                        array('not' => array('Cliente.id_shop' => null))
                    )
                );

                if ($this->Cliente->find('count', $conditions) !== 0) {
                    throw new \Exception\VialojaOverflowException(
                        "Já temos um cadastro com seu e-mail. Experimente fazer
                            <a href='" . FULL_BASE_URL . "/public/login/'>o login.</a>", E_USER_WARNING);
                }

                /** Verifico se o usuario ja existe **/
                $conditions2 = array(
                    'conditions' => array(
                        'Cliente.email' => $this->email
                    )
                );

                $this->senha = \Lib\PasswordHasher::generate($this->senha);

                if ($this->Cliente->find('count', $conditions2) <= 0) {

                    $data = array(
                        'nome' => $this->nome,
                        'nivel' => 5,
                        'email' => $this->email,
                        'senha' => $this->senha,
                        'ip' => $this->request->clientIp(),
                        'security_key' => $this->hash
                    );

                    $this->ok = $this->Cliente->saveAll($data);

                } else {

                    $arrayUpgrade = array(
                        'nome' => $this->nome,
                        'senha' => $this->senha,
                        'security_key' => $this->hash,
                        'nivel' => 5,
                        'url_upgrade' => Tools::getUrl(),
                        'ip' => $this->request->clientIp()
                    );

                    // Update
                    $fields = array(
                        'Cliente.id_shop' => $this->convite['ClienteConvite']['id_shop_default'],
                        'Cliente.nivel' => 5,
                        'Cliente.security_key' => sprintf("'%s'", $this->hash),
                        'Cliente.up_nivel_validar' => sprintf("'%s'", addslashes(json_encode($arrayUpgrade))),
                    );

                    $conditions_up = array(
                        'Cliente.email' => $this->email
                    );

                    $this->ok = $this->Cliente->updateAll($fields, $conditions_up);

                }

                if (is_bool($this->ok) && $this->ok === true) {

                    $sendMail = new \Email\Shopping\VerificaEnderecoEmail();

                    /**
                     *
                     * inclui as configurações da classe phpmailer
                     *
                     **/
                    if (isset($arrayUpgrade)) {
                        if (is_array($arrayUpgrade)) {
                            $this->configMail = new \Email\Notification\Controller\Verification\VerificarEnderecoEmailCadastrado();
                        }
                    } else {
                        $this->configMail = new \Email\Notification\Controller\Verification\VerificarEnderecoEmail();
                    }

                    $sendMail->setHash($this->hash)
                        ->setNome($this->nome)
                        ->setEmail($this->email)
                        ->setSenha($this->senha);

                    $this->configMail = new \Email\Config\SendMail();

                    $this->configMail->setFromName('ViaLoja Shopping')
                        ->setAddress($this->email)
                        ->setSubject('Confirmação de e-mail‏');

                    if ($this->configMail->sendMail() !== false) {

                        //$this->set("email", $this->email);
                        $this->render('criar_conta_loja_virtual_reposta');

                    }

                }


            } catch (\InvalidArgumentException $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
            } catch (\Exception\VialojaOverflowException $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
            } catch (\RuntimeException $e) {
                $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');
            } finally {
                $this->set('nome', $this->nome);
                $this->set('email', $this->email);
            }

        }

    }

    /**
     * Cadastrar novo usuario
     * @access public
     */
    public function criarContaLojaVirtual()
    {

        $this->set('title_for_layout', 'Criar conta Loja Virtual');

        if (v::identical('/d/loja-virtual-gratis/')->validate(Tools::getValue('_wp_http_referer'))) {
            self::criarContaLojaVirtualLandingPage();
        } else {
            self::criarContaLojaVirtualPublic();
        }

        $this->configCSRFGuard();

    }

    /**
     * Iniciação de recuperação da sua senha
     * @throws Exception
     */
    public function esqueceuSenha()
    {

        $this->configCSRFGuard();
        $this->set('title_for_layout', 'Esqueceu sua senha?');
        $this->set('description_for_layout', 'Para iniciar a recuperação da sua senha, preencha o endereço de email cadastrado e aguarde as instruções que serão enviadas por email.');

        if ($this->request->is('post')) {

            $this->email = Tools::clean(Tools::getValue('email'));

            try {

                /** Verifica o token CSRFGuard **/
                $CSRFGuard = new CSRFGuard();
                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                if (empty($this->email)) {
                    throw new \NotFoundException("Informe o email cadastrado.", E_USER_WARNING);
                } elseif (!v::email()->validate($this->email)) {
                    throw new \InvalidArgumentException("Este e-mail é inválido.", E_USER_WARNING);
                }

                if ($this->Cliente instanceof Cliente) {

                    $this->Cliente->setEmail($this->email);
                    $dados = $this->Cliente->emailExistsRetornaDados($this->Cliente);

                    $this->set('email', $this->email);
                    $this->hash = sha1(Tools::uniqid());

                    /** Deleta caso exista um hash antigo do usuario **/
                    if ($this->RecuperaSenha instanceof RecuperaSenha) {

                        $this->Cliente->setIdCliente($this->convite['ClienteConvite']['id']);
                        $this->RecuperaSenha->deletarIDRecuperarSenha($this->Cliente);

                        $std = new \stdClass();
                        $std->id_cliente = (int)$dados['Cliente']['id_cliente'];
                        $std->hash = $this->hash;
                        $std->ip = $this->request->clientIp();
                        if ($this->RecuperaSenha->salvarNovoPedidoDeRecuperacao($std) !== false) {

                            $sendMail = new EmailEsqueceuSenha();

                            if ($sendMail instanceof EmailEsqueceuSenha) {

                                $sendOk = $sendMail->setNome($dados['Cliente']['nome'])
                                    ->setEmail($this->email)
                                    ->setHash($this->hash)
                                    ->setFromName('ViaLoja Shopping')
                                    ->setAddress($this->email)
                                    ->setSubject('Redefinição de senha')
                                    ->setMessage($sendMail->draw())
                                    ->sendMail();

                                if (!v::type('bool')->validate($sendOk)) {
                                    throw new \RuntimeException(
                                        "Não foi possivel efetuar a operação tente novamente.",
                                        E_USER_WARNING
                                    );
                                }

                            }

                            $this->set('title_for_layout', 'Recuperação iniciada');
                            $this->render('esqueceu_senha_resposta');

                        }

                    }

                }

            } catch (\PDOException $e) {
                $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');
                \Exception\VialojaDatabaseException::errorHandler($e);
            } catch (\NotFoundException $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
            } catch (\InvalidArgumentException $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
            } catch (\Exception\VialojaEmailNotFoundException $e) {
                $this->Session->setFlash(__('Nenhuma conta foi encontrada com esse endereço de e-mail.'), 'flash_notification_public_error');
            } catch (\Exception\VialojaOverflowException $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
            } catch (\RuntimeException $e) {
                $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');
            }

        }

    }

    /**
     * Reativar loja shop
     * @access public
     */
    public function reativarContaLoja()
    {

        if ($this->request->is('get')) {

            try {

                $email = Tools::getValue('email');
                $this->set(compact('email'));

                if (!v::email()->validate($email)) {
                    throw new \Exception("Este e-mail é inválido.", E_USER_WARNING);
                }

                $sendMail = new \Email\Notification\Controller\Access\EnviaEmailReativarContaLoja();
                $token = md5(Tools::uniqid() . $email);

                $sendMail->setEmail($email)
                    ->setHash($token);

                $this->configMail = new \Email\Config\SendMail();

                $this->configMail->setFromName('ViaLoja Shopping')
                    ->setAddress($email)
                    ->setSubject('Reativar Conta‏')
                    ->setMessage($sendMail->content());

                if ($this->configMail->sendMail() !== true) {
                    throw new \RuntimeException("Não foi possivel efetuar a operação tente novamente.", E_USER_WARNING);
                }

                if ($this->Cliente instanceof Cliente) {

                    $this->Cliente->setEmail($this->email);
                    $this->login = $this->Cliente->emailExistsRetornaDados($email);

                }

                $this->CancelarShopRecuperacao->insert($re['Cliente']['id_shop'], $token);

            } catch (\Exception $e) {

                return $this->redirect(FULL_BASE_URL . '/public/login/?service=' . $this->params['action'] . '&passive=error&continue=false&message=' . rawbase64_encode(strip_tags(trim($e->getMessage()))));

            }

        }

        $this->set('title_for_layout', 'Reativar conta');
        $this->render('reativar_conta_loja_reposta');

    }

    public function contaLojaReativar()
    {

        try {

            if (!$this->request->is('get')) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            if (!isset($this->request->params['pass']['1'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            if (!Validate::isMd5($this->request->params['pass']['1'])) {
                throw new \InvalidArgumentException('Esta é uma chave inválida!', E_USER_WARNING);
            }

            $re = $this->CancelarShopRecuperacao->getToken($this->request->params['pass']['1']);

            if ($re === false) {
                throw new \InvalidArgumentException('Chave não encontrada ou expirado!', E_USER_WARNING);
            }

            if (is_numeric($re['CancelarShopRecuperacao']['id_shop_default'])) {

                $status = $this->CancelarShop->getStatus($re['CancelarShopRecuperacao']['id_shop_default']);
                $ok = $this->Shop->ativaContaCancelada($status['CancelarShop']['id_shop_default'], $status['CancelarShop']['status_ativo']);

                if ($ok === true) {
                    return $this->redirect(FULL_BASE_URL . '/public/reativar-conta-finalizada/');
                }

                if ($ok === 1) {
                    return $this->redirect(FULL_BASE_URL . '/public/reativar-conta-finalizada/');
                }

                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

            }

        } catch (\InvalidArgumentException $e) {
            return $this->redirect(FULL_BASE_URL . '/public/login/?service=' . $this->params['action'] . '&passive=error&continue=false&message=' . rawbase64_encode(strip_tags(trim($e->getMessage()))));
        }

        $this->layout = false;
        $this->render(false);

    }

    /**
     * Conta reativada
     * @return string
     */
    public function reativarContaFinalizada()
    {
        $this->set('title_for_layout', 'Reativar conta');
    }

    /**
     * Updade de Senha via Post
     * @return boolean
     */
    private function getPostUsuarioSenhaRedefinir()
    {

        try {

            $this->senha = Tools::clean(Tools::getValue('senha'));
            $this->confirmacao_senha = Tools::clean(Tools::getValue('confirmacao_senha'));

            /** Verifica o token CSRFGuard **/
            $CSRFGuard = new CSRFGuard();
            if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            if (Validate::weakPassword($this->senha) === true) {
                throw new \InvalidArgumentException("Sua senha foi detectada como insegura!", E_USER_WARNING);
            }

            if (!Validate::isPasswd($this->senha)) {
                throw new \InvalidArgumentException('A senha deve conter no miníno 6 caracteres.', E_USER_WARNING);
            }

            if (!v::noWhitespace()->validate($this->senha)) {
                throw new \InvalidArgumentException('Não é permitido espaço em branco na senha.', E_USER_WARNING);
            }

            if (!v::identical($this->senha)->validate($this->confirmacao_senha)) {
                throw new \InvalidArgumentException("Erro: As senhas não são iguais.", E_USER_WARNING);
            }

            if ($this->RecuperaSenha instanceof RecuperaSenha) {

                $std = new \stdClass();
                $std->hash = $this->hash;
                $dados = $this->RecuperaSenha->obterIdCliente($std);

                if ($this->Cliente instanceof Cliente) {

                    $this->Cliente->setIdCliente($dados['RecuperaSenha']['id_cliente']);
                    $dados_cliente = $this->Cliente->obterDadosIdCliente($this->Cliente);

                    if (Tools::passwordItsName($this->senha, $dados_cliente['Cliente']['nome'])) {
                        throw new \InvalidArgumentException(
                            "A senha não pode conter dados do nome.",
                            E_USER_WARNING
                        );
                    }

                    if (Tools::passwordItsEmail($this->senha, $dados_cliente['Cliente']['email'])) {
                        throw new \InvalidArgumentException(
                            "A senha não pode conter dados do email.",
                            E_USER_WARNING
                        );
                    }

                    $this->Cliente->setSenha(\Lib\PasswordHasher::generate($this->senha));
                    $this->Cliente->setIp($this->request->clientIp());

                    if ($this->Cliente->alteraSenhaViaRecuperacao($this->Cliente)) {

                        /**Deleta o pedido de recuperação de senha **/
                        $this->RecuperaSenha->deletarIDRecuperarSenha($this->Cliente);

                        $sendMail = new \Email\Notification\Controller\Access\EnviaEmailResposta();

                        $sendMail->setNome($dados_cliente['Cliente']['nome'])
                            ->setEmail($dados_cliente['Cliente']['email'])
                            ->setSenha($this->senha);


                        $this->configMail = new \Email\Config\SendMail();

                        $this->configMail->setFromName('ViaLoja Shopping')
                            ->setAddress($dados_cliente['Cliente']['email'])
                            ->setSubject('Dados atualizados no Shopping ViaLoja')
                            ->setMessage($sendMail->content());

                        if ($this->configMail->sendMail() !== false) {

                            /** Renderiza a view de reposta **/

                            $this->set('title_for_layout', 'Senha redefinida com sucesso');
                            $this->set('email', $dados_cliente['Cliente']['email']);
                            $this->render('senha_redefinir_reposta');

                        }

                    }

                }

            }

        } catch (\InvalidArgumentException $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
        } catch (\Exception\VialojaOverflowException $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
        } catch (\Exception\VialojaNotFoundException $e) {
            $this->Session->setFlash(__('Este Cliente Não encontrado.'), 'flash_notification_public_error');
        } catch (\RuntimeException $e) {
            $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');
        }

    }

    /**
     * Redefinir senha
     * @access public
     */
    public function senhaRedefinir()
    {

        try {

            $this->hash = Tools::clean($this->params['pass'][1]);

            if (empty($this->hash)) {
                throw new \NotFoundException("Informe uma chave válida!", E_USER_WARNING);
            }

            if (!Validate::isSha1($this->hash)) {
                throw new \InvalidArgumentException("Esta é uma chave inválida!", E_USER_WARNING);
            }

            if ($this->request->is('post')) {
                self::getPostUsuarioSenhaRedefinir();
            }

            if ($this->RecuperaSenha instanceof RecuperaSenha) {

                /** verifico se o hash existe**/
                $std = new \stdClass();
                $std->hash = $this->hash;
                if (!$this->RecuperaSenha->hashExists($std)) {
                    throw new \NotFoundException(
                        "Chave não encontrada ou expirado, por favor
                        <a href='" . FULL_BASE_URL . "/public/esqueceu-a-senha/'>clique aqui</a>
                         para gerar uma nova chave.",
                        E_USER_WARNING
                    );
                }

                if ($this->request->is('get')) {

                    /** Verifica se o hash tem mais de 24 desativa **/
                    $date = new \DateTime(date('Y-m-d H:i:s'));
                    $date->sub(new \DateInterval('P1D'));
                    $std = new \stdClass();
                    $std->hash = $this->hash;
                    $std->created = $date->format('Y-m-d H:i:s');
                    $this->RecuperaSenha->alteraStatusHash($std);

                }

            }

        } catch (\NotFoundException $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error_recuperacao_senha');
        } catch (\InvalidArgumentException $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
        } catch (\RuntimeException $e) {
            $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');
        }

        $this->set('title_for_layout', 'Redefinição de senha');
        $this->configCSRFGuard();

    }

    /**
     * Confirma e-mail de usuario
     * @access public
     */
    public function emailConfirmar()
    {

        if ($this->request->is('get')) {

            if ($this->Session->read('id_cliente')) {

                //Destriuir Dados de acesso anterior
                $this->Session->destroy();
                $this->cookieViaLoja()->destroy();
                return $this->redirect(Tools::getUrl());

            }

            try {

                $this->hash = Tools::clean($this->request->params['pass']['1']);

                if (empty($this->hash)) {
                    throw new \NotFoundException("Informe uma chave de ativação enviada no e-mail.", E_USER_WARNING);
                }

                if (!Validate::isSha1($this->hash)) {
                    throw new \InvalidArgumentException("A chave para confirmação de email não é válida, por favor tente novamente, ou <a href='/public/reenviar-email-confirmacao/?email=" . base64_encode($this->email) . "'>Clique Aqui</a> para gerar uma nova chave.", E_USER_WARNING);
                }

                if ($this->Cliente instanceof Cliente) {

                    $this->Cliente->setSecurityKey($this->hash);

                    if (!$this->Cliente->existsToken($this->Cliente)) {
                        throw new \InvalidArgumentException("A chave para confirmação de email não foi encontrada.", E_USER_WARNING);
                    }

                    $this->Cliente->ativarContaViaToken($this->Cliente);
                    $dados = $this->Cliente->obterDadosContaViaToken($this->Cliente);

                    if ($dados['Cliente']['conta_auto_login'] === 'True') {

                        $this->cookieViaLoja()->_setcookie('userEmail', $dados['Cliente']['email'], 3600 * 60 * 24 * 365);

                        /** Cadastra novo id para o shop ***/
                        if (!$this->Shop->cadastraShopId($dados['Cliente']['id_cliente'])) {
                            throw new \RuntimeException();
                        }

                        self::verificaCookieAutoLogin($dados['Cliente']['email']);

                    } elseif ($dados['Cliente']['ativo'] > 0) {

                        $message = 'Seu email já foi confirmado. Digite seu Email e Senha para acessar o painel de controle.';

                        return $this->redirect(
                            FULL_BASE_URL . '/public/login/?service=' .
                            $this->params['action'] . '&passive=success&continue=false&message=' .
                            base64_encode($message)
                        );

                    }

                }

            } catch (\NotFoundException $e) {
                $this->message = $e->getMessage();
            } catch (\InvalidArgumentException $e) {
                $this->message = $e->getMessage();
            } catch (\Exception\VialojaOverflowException $e) {
                $this->message = $e->getMessage();
            } catch (\RuntimeException $e) {
                $this->message = ERROR_PROCESS;
            } finally {
                return $this->redirect(
                    FULL_BASE_URL . '/public/login/?service=' .
                    $this->params['action'] .
                    '&passive=error&continue=false&message=' .
                    base64_encode(trim(strip_tags($this->message, '<a>')))
                );
            }

        }

    }

    /**
     * Reenvia o email de confirmacao
     * @access public
     */
    public function reenviarEmailConfirmacao()
    {

        try {

            $this->set('title_for_layout', 'Reenviar mensagem de confirmação');

            if ($this->request->is('post')) {

                /** Verifica o token CSRFGuard **/
                $CSRFGuard = new CSRFGuard();
                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                $this->email = Tools::clean(Tools::getValue('email'));

                if (!v::email()->notEmpty()->validate($this->email)) {
                    throw new \InvalidArgumentException('Este email é inválido', E_USER_WARNING);
                }

                if ($this->Cliente instanceof Cliente) {

                    $this->Cliente->setEmail($this->email);
                    $reenviar = $this->Cliente->emailExistsRetornaDados($this->Cliente);

                    $sendMail = new \Email\Shopping\VerificaEnderecoEmail();

                    $sendMail->setHash($reenviar['Cliente']['security_key'])
                        ->setNome($reenviar['Cliente']['nome'])
                        ->setEmail($reenviar['Cliente']['email']);

                    if ($this->Session->read('senha_cadastro')) {
                        $sendMail->setSenha($this->Session->read('senha_cadastro'));
                    } else {
                        $sendMail->setSenha('******');
                    }

                    /** inclui as configurações da classe phpmailer **/
                    $this->configMail = new \Email\Config\SendMail();

                    if ($this->configMail instanceof \Email\Config\SendMail) {

                        $this->configMail->setFromName('ViaLoja Shopping')
                            ->setAddress($reenviar['Cliente']['email'])
                            ->setSubject('Reevio de confirmação de email')
                            ->setMessage($sendMail->content());

                        if ($this->configMail->sendMail() !== false) {

                            $this->set('title_for_layout', 'Reenviar mensagem de confirmação');
                            $this->render('criar_conta_loja_virtual_reposta');

                        }

                    }

                }

            }

            if ($this->request->is('get')) {
                $this->set('email', $this->email);
            }

        } catch (\NotFoundException $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
        } catch (\InvalidArgumentException $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
        } catch (\Exception\VialojaEmailNotFoundException $e) {
            $this->Session->setFlash(__('O e-mail inserido não foi encontrado. Verifique abaixo se o e-mail foi digitado corretamente.'), 'flash_notification_public_error');
        } catch (\Exception\VialojaOverflowException $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
        } catch (\RuntimeException $e) {
            $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');
        }

        $this->configCSRFGuard();

    }

    /**
     * Add Sessions
     */
    private function setSessionConvite()
    {

        session_regenerate_id();
        $this->Session->write('id_cliente', $this->id_cliente);
        $this->Session->write('id_shop', $this->convite['ClienteConvite']['id_shop_default']);
        $this->Session->write('cliente_nivel', 4);
        $this->Session->write('cliente_nome', $this->nome);
        $this->Session->write('cliente_email', $this->convite['ClienteConvite']['email']);
        $this->Session->write('cliente_security_key', $this->hash);
        $this->Session->write('token_security_login', Tools::tokenSecurityLogin());
        $this->Session->write('conta_auto_login', false);
        $this->Session->write('session_timestamp', time() + 60 * 60 * 3);

        $this->cookieViaLoja()->_setcookie('__vialoja_user', $this->id_cliente, 60 * 60 * 24 * 365);

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->convite['ClienteConvite']['id_shop_default']);


            $nome_loja = $this->Shop->nomeLoja($this->Shop);
            $this->Session->write('loja_nome', $nome_loja);
            $this->setMsgAlertSuccess("Sua conta no ViaLoja Shopping foi associada a Loja {$nome_loja}");


        }

        if ($this->Wizard instanceof Wizard) {

            $this->passo = $this->Wizard->passoWizard($this->Shop);

            if ($this->passo['Wizard']['passo'] >= 5) {
                $this->Session->write('passo_wizard_complete', true);
                $this->cookieViaLoja()->_setcookie('__vialoja_step', 5, 60 * 60 * 24 * 365);
            } else {
                $this->Session->write('wizard_passo_config', $this->passo['Wizard']['passo']);
                $this->cookieViaLoja()->_setcookie('__vialoja_step', $this->passo['Wizard']['passo'], 60 * 60 * 24 * 365);
            }
        }

        if ($this->ClienteConvite instanceof ClienteConvite) {
            $this->ClienteConvite->deletarId($this->convite['ClienteConvite']['id']);
        }


        return $this->redirect(FULL_BASE_URL . '/admin');


//        $sendMail = new \Email\Shopping\VerificaEnderecoEmail();
//
//        $sendMail->setHash($this->hash);
//        $sendMail->setNome($this->convite['ClienteConvite']['nome']);
//        $sendMail->setEmail($this->convite['ClienteConvite']['email']);
//        $sendMail->setSenha($this->convite['ClienteConvite']['senha'];
//
//        /**
//         *
//         * inclui as configurações da classe phpmailer
//         *
//         **/
//        $this->configMail = new SendMail;
//
//        $this->configMail->setFromName('ViaLoja Shopping');
//        $this->configMail->setAddress($this->email);
//        $this->configMail->setSubject('Confirmação de e-mail');
//        $this->configMail->setMessage($sendMail->verificarEnderecoEmail());

//        /**
//         *
//         * enviar email
//         *
//         **/
//
//
//        if ($this->configMail->sendMail() !== false) {
//
//            /**
//             *
//             * Renderiza a view de reposta
//             *
//             **\/
//            $this->render('assinar_resposta');
//            $this->set("email", $this->email);
//
//        }

    }

    /**
     *  Recebe Post Convite Aceitar
     * @return array Session
     */
    private function getPostConviteAceitar()
    {

        if ($this->request->is('post')) {

            $this->nome = Tools::clean(Tools::getValue('nome'));
            $this->email = Tools::clean(Tools::getValue('email'));
            $this->senha = Tools::clean(Tools::getValue('senha'));
            $this->confirmacao_senha = Tools::clean(Tools::getValue('confirmacao_senha'));

            $this->set('nome', $this->nome);

            try {

                /** Verifica o token CSRFGuard **/
                $CSRFGuard = new CSRFGuard();
                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                if (!v::stringType()->notEmpty()->validate($this->nome)) {
                    throw new \InvalidArgumentException("Preencha o Nome corretamente.", E_USER_WARNING);
                }

                if (!v::email()->notEmpty()->validate($this->convite['ClienteConvite']['email'])) {
                    throw new \InvalidArgumentException("Preencha o Email corretamente.", E_USER_WARNING);
                }

                if (empty($this->senha)) {
                    throw new \InvalidArgumentException("Preencha a Senha corretamente.", E_USER_WARNING);
                } elseif (!v::noWhitespace()->validate($this->senha)) {
                    throw new \InvalidArgumentException("Não é permitido espaço em branco na Senha.", E_USER_WARNING);
                }

                if (Validate::weakPassword($this->senha) === true) {
                    throw new \InvalidArgumentException("Sua Senha foi detectada como insegura!", E_USER_WARNING);
                }

                if (!Validate::isPasswd($this->senha)) {
                    throw new \InvalidArgumentException("A senha deve conter no miníno 6 caracteres.", E_USER_WARNING);
                }

                if (empty($this->confirmacao_senha)) {
                    throw new \InvalidArgumentException("Confirme sua Senha corretamente.", E_USER_WARNING);
                }

                if (!v::identical($this->senha)->validate($this->confirmacao_senha)) {
                    throw new \InvalidArgumentException("Erro: As Senhas não são iguais.", E_USER_WARNING);
                }

                $this->hash = sha1(Tools::uniqid());
                $this->Session->write('senha_cadastro', $this->senha);

                if ($this->Cliente instanceof Cliente) {

                    /** Verifica se já tem o emal cadastrado **/
                    $this->Cliente->setEmail($this->convite['ClienteConvite']['email']);

                    if (!$this->Cliente->emailExists($this->Cliente)) {

                        if ($this->Shop instanceof Shop) {
                            $this->Shop->setIdShop($this->convite['ClienteConvite']['id_shop_default']);
                        }

                        $this->Cliente->setNome($this->nome);
                        $this->Cliente->setNivel(1);
                        $this->Cliente->setAtivo(4);
                        $this->Cliente->setSenha(\Lib\PasswordHasher::generate($this->senha));
                        $this->Cliente->setIp($this->request->clientIp());
                        $this->Cliente->setSecurityKey($this->hash);

                        if ($this->Cliente->addDadosConviteAceitar($this->Shop, $this->Cliente)) {
                            self::setSessionConvite();
                        } else {
                            throw new \RuntimeException();
                        }

                    }

                }

            } catch (\NotFoundException $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
            } catch (\InvalidArgumentException $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
            } catch (\Exception\VialojaOverflowException $e) {
                $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
            } catch (\RuntimeException $e) {
                $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');
            }

        }

    }

    /**
     * Verifica Cadastro já existe!
     * @param $convite
     * @return bool
     * @throws Exception
     */
    private function existsConviteCadastrado($convite)
    {

        if ($this->Cliente instanceof Cliente) {

            $this->Cliente->setEmail($convite['ClienteConvite']['email']);
            $dados = $this->Cliente->emailExistsRetornaDados($this->Cliente);

            if (!v::arrayVal()->notEmpty()->validate($dados)) {
                return false;
            }

            if ($this->Shop instanceof Shop) {
                $this->Shop->setIdShop($convite['ClienteConvite']['id_shop_default']);
            }

            $this->Cliente->setIdCliente($dados['Cliente']['id_cliente']);
            if (!$this->Cliente->alterarNivel($this->Shop, $this->Cliente)) {
                return false;
            }

            $this->nome = $dados['Cliente']['nome'];
            $this->id_cliente = $dados['Cliente']['id_cliente'];
            $this->hash = $dados['Cliente']['security_key'];

            self::setSessionConvite();

        }

    }

    /**
     * Aceita o convite do admistrador da loja
     */
    public function conviteAceitar()
    {

        try {

            if (empty($this->request->params['pass']['1'])) {
                throw new \InvalidArgumentException("Informe a chave de acesso.", E_USER_WARNING);
            }

            if (!Validate::isSha256($this->request->params['pass']['1'])) {
                throw new \InvalidArgumentException("Esta não é uma chave válida.", E_USER_WARNING);
            }

            if ($this->ClienteConvite instanceof ClienteConvite) {

                $this->ClienteConvite->setToken((string)$this->request->params['pass']['1']);

                if (!$this->ClienteConvite->existsConvite($this->ClienteConvite)) {
                    throw new \NotFoundException("Convite não foi encontrado.", E_USER_WARNING);
                }

                $this->convite = $this->ClienteConvite->conviteDados($this->ClienteConvite);

            }

            if (!self::existsConviteCadastrado($this->convite)) {
                throw new \Exception();
            }

            self::getPostConviteAceitar();

            if ($this->request->is('get')) {

                if (!empty($this->convite['ClienteConvite']['email'])) {
                    $this->set('email', $this->convite['ClienteConvite']['email']);
                } else {
                    $this->set('email', null);
                }

            }

            $this->set('sucesso_convite_aceitar', 'Convite aceito! Por favor, preencha os campos.');

        } catch (\NotFoundException $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
        } catch (\InvalidArgumentException $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
        } catch (\Exception\VialojaOverflowException $e) {
            $this->Session->setFlash(__($e->getMessage()), 'flash_notification_public_error');
        } catch (\RuntimeException $e) {
            $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');
        } catch (\Exception $e) {
            $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');
        }

        $this->set('title_for_layout', 'Criar Conta Gerenciar Loja Virtual');
        $this->configCSRFGuard();
        $this->render('criar_conta_loja_virtual_associada');

    }

    /**
     * Recusa o convite do admistrador da loja
     * @return \Cake\Network\Response|null
     */
    public function conviteRecusar()
    {

        try {

            if (empty($this->request->params['pass']['1'])) {
                throw new \InvalidArgumentException("Informe a chave de acesso.", E_USER_WARNING);
            }

            if (!Validate::isSha256($this->request->params['pass']['1'])) {
                throw new \InvalidArgumentException("Esta não é uma chave válida.", E_USER_WARNING);
            }

            if ($this->ClienteConvite instanceof ClienteConvite) {

                $this->ClienteConvite->setToken((string)$this->request->params['pass']['1']);

                if (!$this->ClienteConvite->existsConvite($this->ClienteConvite)) {
                    throw new \NotFoundException("Convite não foi encontrado.", E_USER_WARNING);
                }

                if (v::contains('/admin/')->validate($this->referer())) {

                    $this->ClienteConvite->deletar($this->ClienteConvite);
                    $this->setMsgAlertSuccess('Convite foi removido com sucesso.');
                    return $this->redirect($this->referer());

                }

                $this->ClienteConvite->recusar($this->ClienteConvite);

            }

            $this->Session->setFlash(__('Convite foi recusado com sucesso.'), 'flash_notification_public_success');

        } catch (\NotFoundException $e) {

            if (v::contains('/admin/')->validate($this->referer())) {
                $this->setMsgAlertError($e->getMessage());
                return $this->redirect($this->referer());
            }

            $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');

        } catch (\InvalidArgumentException $e) {

            if (v::contains('/admin/')->validate($this->referer())) {
                $this->setMsgAlertError($e->getMessage());
                return $this->redirect($this->referer());
            }

            $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');

        } catch (\RuntimeException $e) {

            if (v::contains('/admin/')->validate($this->referer())) {
                $this->setMsgAlertError(ERROR_PROCESS);
                return $this->redirect($this->referer());
            }

            $this->Session->setFlash(__(ERROR_PROCESS), 'flash_notification_public_error');

        }

        $this->set('title_for_layout', 'Remover Convite - Conta Loja Virtual');
        $this->configCSRFGuard();
        $this->render('criar_conta_loja_virtual');

    }

}