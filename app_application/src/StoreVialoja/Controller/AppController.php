<?php

use Lib\Cookie as Cookie;
use Lib\AutoLoginVialoja as AutoLoginVialoja;
use Lib\Validate;

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package     app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array('Session');
    //public $uses = array('Log');

    public $cookieViaLoja;
    public $class_auto_login;
    public $url_auto_login;


    /**
     * Carrega as principais classes e configurações do sistema
     * @return string
     */
    private function initApp()
    { 

        //Ativa a sessão para subdominios
        if (isset($_COOKIE['__vialoja'])) {

            if (!Validate::isSessionId($_COOKIE['__vialoja'])) {
                self::sessionDestroyRedirectDefault();
            }        
            
        }

        //Criando Cookie para carregar subdominos 
        $this->cookieViaLoja = new Cookie();
        if (Tools::getValue('auto-login-loja') !='') {
            if (!$this->Session->read('id_cliente') ) {
                self::getAllAutoLogin(); //Verifica login entre dominios
            }
        } else {
            Cookie::getInstance()->createCookieSession();            
        }    

        if ( $this->Session->read('id_cliente') ) {
            $this->class_auto_login = new AutoLoginVialoja();
            $GLOBALS['class_auto_login'] = $this->class_auto_login;
        }

    }

    /** 
     * Inicia o sistema
     * @access public 
    */
    public function beforeFilter() {

        self::initApp();        

        if ( $this->request->controller == 'logout') {

            self::sessionDestroyRedirectDefault();
    
        }  

        if ( $this->request->controller === 'minha_conta') {

            try {

                if ( $this->Session->read('id_cliente') ) {
                    if ( !isset($_COOKIE['__vialoja_user']) || !Validate::isNotNull( $_COOKIE['__vialoja_user'] ) ) {
                        throw new InvalidArgumentException("Sessão expirada por inatividade.<br/>Por favor, entre com seu login e senha novamente.", 1);
                    }
                }

                if ( !isset($_COOKIE['__vialoja_user']) || !Validate::isNotNull( $_COOKIE['__vialoja_user'] ) ) {
                    throw new InvalidArgumentException("Você deve estar autenticado para acessar esta página.", 1);
                } else {

                    /**
                    *
                    * Verifica e sera o cookie __vialoja_user
                    *
                    **/
                    
                    if ($this->checkCoookieUser($this->Session->read('id_cliente')) !== true) {
                        throw new InvalidArgumentException("Por favor, entre com seu login e senha novamente.", 1);
                    }

                    /**
                    *
                    * Checa o user agent e ip
                    *
                    **/
                    self::checkUserIP();
                    self::checkUserAgent();

                    /**
                    *
                    * Verifica as configurações de acesso e segurança.
                    *
                    **/
                    if ( Validate::isSha1( $this->Session->read('cliente_security_key') ) ) {
                        
                        if ( $this->Session->read('cliente_nivel') <= 0 ) {                            
                            throw new InvalidArgumentException("Access não autorizado.", 1);
                        }

                    } else {
                        throw new InvalidArgumentException("Você deve estar autenticado para acessar esta página.", 1);
                    }

                }
            
            } catch (InvalidArgumentException $e) {
                $this->redirectLogin( $e->getMessage() );               
            }

        }

    }

   /**
     * Checa IP
     * @access public
     * @param Array $session
     */
    private function checkUserIP()
    {
        if ($this->Session->read('user_ip_security') !== $this->request->clientIp()) {
            self::redirectLogin("O seu endereço de IP não coincide com esta sessão.");
        }
    }
    

    /**
     * Checa o User Agente
     * @access public
     * @param Array $session
     */
    private function checkUserAgent()
    {
        if ($this->Session->read('user_agent') !== $this->Session->userAgent()) {
            self::redirectLogin("Por favor, entre com seu login e senha novamente.");
        }
    }

    /** 
     * Monta a url de retorno para login
     * @access public 
     * @param Array $msg
    */
    public function redirectLogin($msg=null)
    {
            
        self::cookieDestroy();
        /**
        *
        * seta a mensagem na div alert
        *
        **/
        return $this->redirect( 
            sprintf( 
                '//%s/cliente/conta/login/?utm_passive=false&utm_referrer=%s&utm_message=%s', 
                env('HTTP_HOST'), rawurlencode( Tools::getUrl() ), base64_encode( trim($msg) )
            )
        );

    }

    /** 
     * Verifica o Cookie __vialoja_user
     * @access public 
     * @param cliente_id id do usuario
     * @return true e false
    */
    public function checkCoookieUser($id=null)
    {

        if (is_numeric($id)) {
            if ($this->cookieViaLoja()->getCookie('__vialoja_user')===$id) {
                return true;
            }
        }
        return false;

    }


     /**
     * Destroy os dados da sessão e cookies
      * @return string
     */
    private function cookieDestroy()
    {
        
        self::initApp();
        $this->Session->destroy();
        $this->cookieViaLoja()->destroy();

    }


    /** 
     * Log de usuario, guarda informações do login para auditoria
     * Informações de ip, browser, id, url de referência
     * @access public
     * @param Array $id_shop
     * @param String $data 
    */
    public function logShop()
    {
        $this->requestAction(
            array(
                'controller' => 'Log',
                'action' => 'logShop',
                'id_cliente' => $this->Session->read('id_cliente'),
                'id_shop' => $this->Session->read('id_shop')
            ) 
        );
    }

    public function afterFilter() {

        /*
        if ($this->response->statusCode() == '404')
        {
            return $this->redirect(array(
                'controller' => 'default',
                'action' => 'error', 404),404
            );
        }
        
       
   
        $reflection = new ReflectionClass("Validate"); // Cria uma nova reflection
        $methods    = $reflection->getMethods();  // Obtém os métodos

        foreach ($methods as $method) {
            print $method->getName() . '<br/>';
        }

        die;
        */

    }


    /**
     * Recebe Login entre dominios
     * Informações de ip, browser, id, url de referência
     * @access private
     * @param Array $_GET
     */
    public function getAllAutoLogin()
    {

        $this->auto_login = new AutoLoginVialoja();

        try {

            $this->auto_login->validaTokenUrlAutoLogin(
                Tools::getValue('auto-login-loja'),
                $this->request->clientIp(), 
                $this->Session->userAgent(), 
                $this->request->referer()
            );

        } catch (InvalidArgumentException $e) {

            self::sessionDestroyRedirectDefault();

        } catch (DomainException $e) {


        } finally {

            if ( $this->auto_login->getAutoSessionId() ) {

                $this->Session->id($this->auto_login->getAutoSessionId());

                Cookie::getInstance()->createCookieSession();

                if ($this->Session->id() === $this->auto_login->getAutoSessionId()) {
                    $this->url_auto_login = explode('?', Tools::getUrl());
                    return $this->redirect( $this->url_auto_login[0] );
                    exit();
                }

            }

        }

    }

    private function sessionDestroyRedirectDefault()
    {
        self::cookieDestroy();
        /**
         *
         * seta a mensagem na div alert
         *
         **/
        return $this->redirect( sprintf( '//%s/cliente/conta/login/?logoff=true', env('HTTP_HOST') ) );
    }
    
}
