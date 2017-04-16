<?php

App::uses('AppController', 'Controller');

class LandingController extends AppController {

	public $uses = array('Cliente');
	public $layout = false;
	
	private $enviaEmail;
	private $configMail;

	public function criar() {

		$this->render(false);

		try {

			if (!$this->request->is('post')) {
				throw new InvalidArgumentException(true);
			}

			if (Tools::getValue('check_optin_1') !='') {
				throw new InvalidArgumentException(true);
			}

			if (Tools::getValue('check_optin_2') !='') {
				throw new InvalidArgumentException(true);
			}

			if (strpos($this->request->referer(), env('HTTP_HOST')) === false) {
				throw new InvalidArgumentException(true);
			}

			self::addCadastroSemSenha();

		} catch (InvalidArgumentException $e) {

			$this->redirect( FULL_BASE_URL .  '/d/loja-virtual-gratis/');

		}

	}

	/**
     * Cadastrar novo usuario
     * @access private
     * @param Array $cliente
     * @param String $data
     */
    private function addCadastroSemSenha()
    {

        $datasource = $this->Cliente->getDataSource();

        try {

         	$email = Tools::clean(Tools::getValue('email'));

            if ( empty($email) ) {

            	throw new InvalidArgumentException("Por favor informe o email corretamente.", 1);

            } elseif ( !Validate::isEmail( $email ) ) {

                throw new InvalidArgumentException("O e-mail informado é inválido.", 1);

            }


            /**
             *
             * verifica se já é lojista ou usuario admin da loja
             *
             **/
            $conditions = array(
                'conditions' => array(
                    'Cliente.email' => $email,
                    'Cliente.ativo' => 1,
                    'Cliente.nivel >=' => 4
                )
            );

            if ($this->Cliente->find('count', $conditions) !== 0) {

				$userEmail = $this->cookieViaLoja()->getCookie('userEmail');

				if (Validate::isEmail( $userEmail )) {


                    if ($this->Cliente instanceof Cliente) {

                        $this->Cliente->setEmail($this->userEmail);
                        $login = $this->Cliente->emailExistsRetornaDados($this->Cliente);

                    }


                    if (Validate::isNotNull($login)) {

                    	$this->cookieViaLoja()->_setcookie('__vialoja_user', $login['Cliente']['id_cliente'], 60*60*24*365);

                        /**
                         *
                         * Cria as sessoes e redireciona o usuario
                         *
                         **/
                        $this->Session->write('id_cliente', $login['Cliente']['id_cliente']);
                        $this->Session->write('id_shop_grupo', $login['Cliente']['id_shop_grupo']);
                        $this->Session->write('id_shop', $login['Cliente']['id_shop']);
                        $this->Session->write('id_default_grupo', $login['Cliente']['id_default_grupo']);
                        $this->Session->write('cliente_nivel', $login['Cliente']['nivel']);
                        $this->Session->write('cliente_email', $login['Cliente']['email']);
                        $this->Session->write('cliente_security_key', $login['Cliente']['security_key']);
                        $this->Session->write('user_agent', $this->Session->userAgent());
                        $this->Session->write('user_ip_security', $this->request->clientIp());
	                	$this->Session->write('email_auto_login', true);

		               	$this->Session->setFlash(__('Já temos um cadastro com seu e-mail. Por favor preencha sua identificação de acesso.'), 'alert-box', array(
		                    'class' => 'alert-warning'
		                ));

                        return $this->redirect( sprintf('//app%s/admin/wizard/passo-1/configure-usuario', env('HTTP_BASE') ) );

                    }

				} else {

	                throw new OverflowException("Já temos um cadastro com seu e-mail. Experimente fazer o login", 1);

				}

            }


            /**
             *
             * verifica se já e lojista ou usuario admin da loja
             *
             **/
            $conditions = array(
                'conditions' => array(
                    'Cliente.email' => $email,
                    'Cliente.ativo' => 0,
                    'Cliente.black_list' => 'true'
                )
            );

            if ($this->Cliente->find('count', $conditions) !== 0) {

                throw new OverflowException("Já temos um cadastro com seu e-mail. Experimente fazer o login.", 1);

            }


            /**
             *
             * verifica se o cadastro ainda não foi ativo e deleta
             *
             **/
            $conditions = array(
                'conditions' => array(
                    'Cliente.email' => $email,
                    'Cliente.ativo' => 0,
                )
            );

            if ($this->Cliente->find('count', $conditions) > 0) {

                $this->Cliente->deleteAll(
                	array(
						'Cliente.email' => $email,
                        'Cliente.ativo' => 0
					)
                );

            }

            /**
            *
            * Cadastra e envia o email
            *
            **/
            $hash  = sha1(Tools::uniqid());
            $this->Session->write('userEmail', $email);
            $this->Session->write('tokenEmail', $hash);

            $this->data = array(
                'nivel' => 5,
                'email' => $email,
                'nome' => Tools::clean(Tools::getValue('nome')),
                'ip' => $this->request->clientIp(),
                'security_key' => $hash,
                'email_auto_login' => 'True'
            );

            if ($this->Cliente->saveAll($this->data)) {

                $this->enviaEmail = new \Email\Notification\Controller\Verification\VerificarEnderecoEmailAutoLogin();
                $this->enviaEmail->setHash($hash)
                		         ->setEmail($email);

                /**
                 *
                 * inclui as configurações da classe phpmailer
                 *
                 **/

                $this->configMail = new \Email\Config\SendMail();

                $this->configMail->setFromName('ViaLoja Shopping')
                            	 ->setAddress($email)
                            	 ->setSubject('Confirmação de e-mail?')
                            	 ->setMessage($this->enviaEmail->content());


                if ($this->configMail->sendMail() !== false) {

					$this->cookieViaLoja()->_setcookie('userEmail', $email, 60*60*24*365);

					return $this->redirect( FULL_BASE_URL . '/d/loja-virtual-gratis-obrigado/');

                }

            }

            $datasource->commit();

        } catch (PDOException $e) {

            $datasource->rollback();

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (InvalidArgumentException $e) {

        	return $this->redirect( '//app'. env('HTTP_BASE') .'/public/criar-conta-loja-virtual/'. $this->params['action'] .'&passive=error&continue=false&message=' . rawurlencode(trim( $e->getMessage() ) ) );

        } catch (OverflowException $e) {

      		return $this->redirect( '//app'. env('HTTP_BASE') .'/public/login/?service='. $this->params['action'] .'&passive=error&continue=false&message=' . rawurlencode(trim( $e->getMessage() ) ) );

        }

    }

}