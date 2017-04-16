<?php

App::uses('AppController', 'Controller');

class ReenviarEmailConfirmacaoController extends AppController {

	public $layout = false;

	private $configMail;
	private $enviaEmail;

	public function index()
	{

		$this->render(false);

		if (!$this->request->is('post')) {
			return false;
		}

		if (!$this->request->is('ajax')) {
			return false;
		}

		if (Tools::getValue('email') !== '') {

			@ignore_user_abort(true);

			$this->enviaEmail = new \Email\Notification\Controller\Verification\VerificarEnderecoEmailAutoLogin();

			$email = Tools::getValue('email');
			$token = Tools::getValue('token');

			$this->enviaEmail->setHash($token);
			$this->enviaEmail->setEmail($email);

			/**
			 *
			 * inclui as configurações da classe phpmailer
			 *
			 **/
			$this->configMail = new \Email\Config\SendMail();

			$this->configMail->setFromName('ViaLoja Shopping')
							 ->setAddress($email)
							 ->setSubject('Confirmação de e-mail‏')
							 ->setMessage($this->enviaEmail->content());

			/**
			 *
			 * enviar email
			 *
			 **/
			if ($this->configMail->sendMail() !== false) {
				echo $email;
			}

		}

	}

}
