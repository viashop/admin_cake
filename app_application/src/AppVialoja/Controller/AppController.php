<?php

use Lib\Tools;
use Lib\Validate;
use Respect\Validation\Validator as v;
use Lib\Cookie as Cookie;
use Lib\AutoLoginVialoja;


/**
 * Class AppController
 */
class AppController extends Controller
{

    use \AppVialoja\Traits\Controller\TConfigCSRFGuard;
    use \AppVialoja\Traits\Controller\TMessageFlash;

    /**
     * Sessions Cake
     * @var array
     */
    public $components = array('Session');
    /**
     * Instancia a Classe de Log
     * @var array
     */
    public $uses = array('Log');

    public $auto_login_dominio;
    private $url_referer;

    /**
     * Inicia o sistema
     * @access public
     */
    public function beforeFilter()
    {

        try {

            self::initApp();
            //self::habilitaEventScheduler();
            self::securityAdmin();

        } catch (\Exception $e) {

        }

    }

    /**
     * Carrega as principais classes e configurações do sistema
     */
    private function initApp()
    {

        //Ativa a sessão para subdominios
        if (isset($_COOKIE['__vialoja'])) {

            if (!Validate::isSessionId($_COOKIE['__vialoja'])) {
                self::sessionDestroyRedirectDefault();
            }

        }

        //self::cookieViaLoja();
        if (Tools::getValue('auto-login-painel') != '') {
            if (!$this->Session->read('id_cliente')) {
                self::getAllAutoLogin(); //Verifica login entre dominios
            }
        } else {
            Cookie::getInstance()->createCookieSession();
        }
		
        //Add mais 1 hora ao coookie
        if (isset($_COOKIE['__vialoja_user']) && !empty($_COOKIE['__vialoja_user'])) {
            self::cookieViaLoja()->setcookie('__vialoja_user', $_COOKIE['__vialoja_user'], 60 * 60 * 3);
        }

        if ($this->request->webroot == '/public/') {
            if (!isset($this->request->params['pass'][0]) && empty($this->request->params['pass'][0])) {
                //return $this->redirect( FULL_BASE_URL . '/public/login/' );
            }
        }

    }

    private function sessionDestroyRedirectDefault()
    {
        self::cookieDestroy();

        $redirect = sprintf(
            '%s/public/login/?service=%s&passive=true&continue=false&message=%s&logoff=true',
            FULL_BASE_URL,
            $this->request->controller,
            base64_encode('Você foi desconectado com segurança!')
        );

        return $this->redirect($redirect);

    }

    /**
     * Destroy os dados da sessão e cookies
     * @return string
     */
    private function cookieDestroy()
    {

        self::initApp();
        $this->Session->destroy();
        self::cookieViaLoja()->destroy();

    }

    /**
     * Estacia a Classe Cookie
     */
    final public function cookieViaLoja()
    {
        $cookieViaLoja = new Cookie();
        return $cookieViaLoja;
    }

    /**
     * Recebe Login entre dominios
     * Informações de ip, browser, id, url de referência
     *
     */
    private function getAllAutoLogin()
    {

        $auto_login = new AutoLoginVialoja();

        try {

            $auto_login->validaTokenUrlAutoLogin(
                Tools::getValue('auto-login-painel'),
                $this->request->clientIp(),
                $this->Session->userAgent(),
                $this->request->referer()
            );

        } catch (\InvalidArgumentException $e) {

            self::sessionDestroyRedirectDefault();

        } catch (\DomainException $e) {

            $this->auto_login_dominio = $e->getMessage();

        } finally {

            if ($auto_login->getAutoSessionId()) {

                $this->Session->id($auto_login->getAutoSessionId());
                Cookie::getInstance()->createCookieSession();

                if ($this->Session->id() === $auto_login->getAutoSessionId()) {

                    if (!isset($this->auto_login_dominio)) {
                        $url_auto_login = explode('?', Tools::getUrl());
                        return $this->redirect($url_auto_login[0]);
                    }

                }

            }

        }

    }

    /**
     * Restrições ao Painel de Controle
     */
    private function securityAdmin()
    {

        self::exitUser();

        if ($this->request->webroot === '/admin/'
            || $this->request->controller === 'ticket'
            || strpos($this->referer(), $this->url_referer) !== false ) {

            try {

                if ($this->Session->read('id_cliente')) {

                    if (!self::session_timestamp()) {
                        throw new \InvalidArgumentException("Sessão expirada por inatividade.<br/>Por favor, entre com seu login e senha novamente.", E_USER_WARNING);
                    }

                }

                if (!isset($_COOKIE['__vialoja_user']) || !v::notEmpty()->validate($_COOKIE['__vialoja_user'])) {
                    throw new \InvalidArgumentException("Você deve estar autenticado para acessar esta página.", E_USER_WARNING);
                } else {

                    if (!$this->request->is('ajax') && !$this->request->is('post')) {

                        self::verificacao_cookie_step_painel();
                        self::verificacao_cookie_step_wizard();

                    }

                    /**
                     *
                     * Verifica e sera o cookie __vialoja_user
                     *
                     **/
                    if (self::checkCoookieUser($this->Session->read('id_cliente')) !== true) {
                        throw new \InvalidArgumentException("Por favor, entre com seu login e senha novamente.", E_USER_WARNING);
                    }

                    /**
                     *
                     * Checa o user agent e ip
                     *
                     **/
                    self::tokenSecurity();
                    /**
                     *
                     * Verifica as configurações de acesso e segurança.
                     *
                     **/
                    if (Validate::isSha1($this->Session->read('cliente_security_key'))) {

                        /**
                         *
                         * Verificação de auto login
                         *
                         **/

						 /*
                        if ($this->Session->read('conta_auto_login')) {
                            $conta_auto_login = true;
                        }*/

                        if (!v::notEmpty()->validate($this->Session->read('id_shop'))
                            || $this->Session->read('cliente_nivel') <= 1 ) {

                            throw new \InvalidArgumentException("Access não autorizado.", E_USER_WARNING);

                        }

                    } else {
                        throw new \InvalidArgumentException("Você deve estar autenticado para acessar esta página.", E_USER_WARNING);
                    }

                    self::checkIsSha1();

                }

            } catch (\InvalidArgumentException $e) {

                self::redirectLogin($e->getMessage());

            }

        }

    }

    private function exitUser()
    {
        self::logout();
        self::logoff();
    }

    private function logout()
    {
        if ($this->request->controller == 'logout') {
            self::sessionDestroyRedirectDefault();
        }
    }

    /**
     * Permite sair com segurança e excluir o convite de usuário fora do painel
     */
    private function logoff()
    {

        if (isset($this->request->query['logoff'])) {
            $this->url_referer = Tools::uniqid();
        } else {

            $this->url_referer = '/admin/loja/usuario/listar';
        }

    }

    private function session_timestamp()
    {

        if ($this->Session->read('session_timestamp')) {

            if ($this->Session->read('session_timestamp') < time())
                return false;
            else {
                $this->Session->write('session_timestamp', time() + 60 * 60 * 3);
                return true;
            }
        }

        return false;

    }

    /**
     * Verifica de Cookie
     */
    private function verificacao_cookie_step_painel()
    {

        if (isset($_COOKIE['__vialoja_step'])) {
            if (strpos($this->request->controller, 'wizard') === false)
                if (!$this->Session->read('passo_wizard_complete'))
                    if (self::cookieViaLoja()->getCookie('__vialoja_step') < 5)
                        return $this->redirect(Tools::urlPassoWizard(self::cookieViaLoja()->getCookie('__vialoja_step')));

        }

    }

    /**
     * Verifica Coookie
     */
    private function verificacao_cookie_step_wizard()
    {

        if ($this->request->controller !== 'default') {

            if (!$this->Session->read('passo_wizard_complete'))
                if (!isset($_COOKIE['__vialoja_step']))
                    self::redirectStep();

        }

    }

    /**
     * Redirecionamento de Verifica Coookie
     */
    private function redirectStep()
    {

        return $this->redirect(
            array(
                'controller' => 'Wizard',
                'action' => 'verificaCookieStep',
                "?" => array(
                    "urlReturn" => Tools::getUrl()
                )
            )
        );

    }

    /**
     * Verifica o Cookie __vialoja_user
     *
     * @param int|null|null $id
     * @return bool
     */
    private function checkCoookieUser($id = null)
    {

        if (is_numeric($id)) {
            if (self::cookieViaLoja()->getCookie('__vialoja_user') === $id) {
                return true;
            }
        }
        return false;

    }

    /**
     * Monta a url de retorno para login
     * @access private
     */
    private function redirectLogin($msg = null)
    {

        $redirect = sprintf(
            '%s/public/login/?service=%s&passive=error&continue=%s&message=%s',
            FULL_BASE_URL,
            $this->request->controller,
            Tools::getUrl(),
            base64_encode($msg)
        );

        self::cookieDestroy();
        /**
         *
         * seta a mensagem na div alert
         *
         **/
        return $this->redirect($redirect);

    }

    /**
     * Checa o token de segurança
     */
    private function tokenSecurity()
    {
        if ($this->Session->read('token_security_login') !== Tools::tokenSecurityLogin()) {
            self::redirectLogin("Por favor, entre com seu login e senha novamente.");
        }
    }

    /**
     *
     */
    private function checkIsSha1()
    {
        /**
         *
         * Verifica as configurações de acesso e segurança.
         *
         **/
        if (Validate::isSha1($this->Session->read('cliente_security_key'))) {

            /**
             *
             * Verificação de auto login
             *
             **/

            /*
           if ($this->Session->read('conta_auto_login')) {
               $conta_auto_login = true;
           }*/

            if (!v::notEmpty()->validate($this->Session->read('id_shop'))
                || $this->Session->read('cliente_nivel') <= 1) {

                throw new \InvalidArgumentException("Acesso não autorizado.", E_USER_WARNING);

            }

        } else {
            throw new \InvalidArgumentException("Você deve estar autenticado para acessar esta página.", E_USER_WARNING);
        }

    }


    /**
     * Habilitar função em Cronjobs
     * Habilita eventos BD
     */
//    private function habilitaEventScheduler()
//    {
//
//        $db = ConnectionManager::getDataSource("default");
//        $res = $db->query('select @@event_scheduler');
//
//        foreach ($res as $re):
//            foreach ($re as $events):
//                foreach ($events as $event):
//                    /*verificando*/
//                    if ($event !== 'ON'):
//                        /*habilitando*/
//                        $db->query('SET GLOBAL event_scheduler = ON');
//                    endif;
//                endforeach;
//            endforeach;
//        endforeach;
//
//    }

}
