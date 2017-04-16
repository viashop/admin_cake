<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Lib\Cookie as Cookie;

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
    public $uses = array('Log');

    public $cookieViaLoja;

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
        Cookie::getInstance()->createCookieSession();

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

                    if (!self::session_timestamp() ) {
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
                env('HTTP_HOST'), rawurlencode( Tools::getUrl() ), rawurlencode( base64_encode( trim($msg) ) )
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

	private function session_timestamp()
    {

        if ( $this->Session->read('session_timestamp') ) {

            if ($this->Session->read('session_timestamp') < time() )
                return false;
            else {
                $this->Session->write('session_timestamp', time() + 3600);
				return true;
            }

        }

		return false;

    }
	
	/**
     * Configurações de Segurança
     */
    final public function configCSRFGuard()
    {

        /**
         *
         * verifica se é bot
         *
         **/
        if (!Validate::isBot()) {

            $CSRFGuard = new CSRFGuard();

            $CSRFGuardName = "CSRFGuard_".mt_rand(0,mt_getrandmax());
            $CSRFGuardToken = $CSRFGuard->csrfguard_generate_token($CSRFGuardName);

            $this->set('CSRFGuardName', $CSRFGuardName);
            $this->set('CSRFGuardToken', $CSRFGuardToken);
            $GLOBALS['CSRFGuardName'] = $CSRFGuardName;
            $GLOBALS['CSRFGuardToken'] = $CSRFGuardToken;

        } else {

            $this->set('CSRFGuardName', null);
            $this->set('CSRFGuardToken', null);
            $GLOBALS['CSRFGuardName'] = null;
            $GLOBALS['CSRFGuardToken'] = null;

        }

    }

}
