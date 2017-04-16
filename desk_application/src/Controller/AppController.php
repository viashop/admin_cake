<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Lib\Cookie;
use Lib\Validate;
use Lib\Tools;
use Respect\Validation\Validator as v;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        self::initApp();
        self::securityAdmin();

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

        Cookie::getInstance()->createCookieSession();

        //Add mais 1 hora ao coookie
        if (isset($_COOKIE['__vialoja_user']) && !empty($_COOKIE['__vialoja_user'])) {
            self::cookieViaLoja()->setcookie('__vialoja_user', $_COOKIE['__vialoja_user'], 60 * 60 * 3);
        }

    }

    private function sessionDestroyRedirectDefault()
    {
        self::cookieDestroy();
        /** seta a mensagem na div alert **/
        return $this->redirect(sprintf('//app%s/public/login/?logoff=true', Tools::getHttpBase()));
    }

    /**
     * Destroy os dados da sessão e cookies
     * @return string
     */
    private function cookieDestroy()
    {
        self::initApp();
        $this->request->session()->destroy();
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
     * Restrições ao Painel de Controle
     */
    private function securityAdmin()
    {

        try {

            if ($this->request->session()->read('id_cliente')) {

                if (!self::session_timestamp()) {
                    throw new \InvalidArgumentException("Sessão expirada por inatividade.<br/>Por favor, entre com seu login e senha novamente.", E_USER_WARNING);
                }

            }

            if (!isset($_COOKIE['__vialoja_user']) || !v::notEmpty()->validate($_COOKIE['__vialoja_user'])) {
                throw new \InvalidArgumentException("Você deve estar autenticado para acessar esta página.", E_USER_WARNING);
            } else {

                /**
                 *
                 * Verifica e sera o cookie __vialoja_user
                 *
                 **/
                if (self::checkCoookieUser($this->request->session()->read('id_cliente')) !== true) {
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
                if (Validate::isSha1($this->request->session()->read('cliente_security_key'))) {

                    if (!v::notEmpty()->validate($this->request->session()->read('id_shop'))
                        || $this->request->session()->read('cliente_nivel') <= 1 ) {

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

    private function session_timestamp()
    {

        if ($this->request->session()->read('session_timestamp')) {

            if ($this->request->session()->read('session_timestamp') < time())
                return false;
            else {
                $this->request->session()->write('session_timestamp', time() + 60 * 60 * 3);
                return true;
            }

        }
        return false;
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
            '//app%s/public/login/?service=%s&passive=false&continue=%s&message=%s',
            Tools::getHttpBase(),
            $this->request->controller,
            Tools::getUrl(),
            $msg
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
        if ($this->request->session()->read('token_security_login') !== Tools::tokenSecurityLogin()) {
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
        if (Validate::isSha1($this->request->session()->read('cliente_security_key'))) {

            if (!v::notEmpty()->validate($this->request->session()->read('id_shop'))
                || $this->request->session()->read('cliente_nivel') <= 1) {

                throw new \InvalidArgumentException("Acesso não autorizado.", E_USER_WARNING);

            }

        } else {
            throw new \InvalidArgumentException("Você deve estar autenticado para acessar esta página.", E_USER_WARNING);
        }

    }



    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
