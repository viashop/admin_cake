<?php

App::uses('AppController', 'Controller');
use Lib\ConfigEmail as ConfigEmail;

class ContatoController extends AppController {

	public function index() {

		if ($this->request->is('post')) {

			try {

                /**
                 * Anti Spam Boot
                 * Enviado via class hidden
                 */

                if (Tools::getValue('url_default') !='') {
                    throw new Exception(ERROR_PROCESS, E_USER_NOTICE);
                }

                if (Tools::getValue('name') !='') {
                    throw new Exception(ERROR_PROCESS, E_USER_NOTICE);
                }

                if (Tools::getValue('check') !='') {
                    throw new Exception(ERROR_PROCESS, E_USER_NOTICE);
                }

                /**
				 *
				 * Verifica o token CSRFGuard
				 *
				 **/

				$csrfGuard = new CSRFGuard();

				if (!$csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

					throw new Exception(ERROR_PROCESS, E_USER_NOTICE);

				} else {

					if (file_exists(PHPMAILER_VIALOJA . 'PHPMailerAutoload.php')) {
						include_once PHPMAILER_VIALOJA .'PHPMailerAutoload.php';
					} else {
						exit('Error: PHPMailerAutoload não encontrado');
					}

                    $this->mail = new \PHPMailer();
                    $this->mail->SetLanguage("br"); //Idioma
                    $this->mail->IsSMTP();

                    $this->config = new ConfigEmail();

                    $this->mail->CharSet = $this->config->default['charset'];

                    // 0 = off (for production use)
                    // 1 = client messages
                    // 2 = client and server messages
                    $this->mail->SMTPDebug = 0;
                    $this->mail->Debugoutput = 'html';
                    $this->mail->Priority = 3;

                    $this->mail->Host = $this->config->default['host'];
                    $this->mail->Port = $this->config->default['port'];
                    $this->mail->SMTPSecure = $this->config->default['SMTPSecure'];
                    $this->mail->SMTPAuth = $this->config->default['SMTPAuth'];

                    $this->mail->Username = $this->config->default['username'];
                    $this->mail->Password = $this->config->default['password'];

                    $nome = Tools::getValue('nome');
                    $email = Tools::getValue('email');
                    $mensagem = Tools::getValue('message');

                    $this->mail->From = $email;
                    $this->mail->FromName = 'Contato - '. $nome;

                    $this->mail->AddReplyTo( $email );

                    $this->mail->addAddress('contato@vialoja.com.br');
                    //$this->mail->addAddress(Tools::getValue('email'));

                    $this->mail->Subject = 'Contato - ViaLoja Shopping';

                    $html = '<body style="font-size: 14px">
                                <p style="font-size: 16px">Contato - ViaLoja Shopping</p>
                                <p><strong>Nome:</strong> '. $nome .'</p>
                                <p><strong>E-mail:</strong> '. $email .'</p>';

                                $html .= '<p><strong>Mensagem:</strong>  '. nl2br( $mensagem ) .'<br>

                                <hr size="1">
                                <p style="font-size: 12px"><strong>Data:</strong> '. date('d/m/Y H:i:s') .'</p>
                                <p style="font-size: 12px"><strong>IP :</strong> '. $this->request->clientIp() .'<br>
                                </p>

                            </body>';

                    $this->mail->AltBody = $html;
                    $this->mail->Body = $html;


                    /**
                     * Envia o email usando o phpmailer
                     */
                    if (!$this->mail->Send()) {
                        throw new Exception( "Houve um erro envio de email: ". $this->mail->ErrorInfo );
                    }

					$this->mail->ClearAllRecipients();
					$this->mail->ClearAttachments();

					exit();

                }

            } catch (Exception $e) {

				return false;

            }

		}

		if ($this->request->is('get')) {
			$this->layout = 'interface_vialoja';
		}

        $this->configCSRFGuard();

	}

}
