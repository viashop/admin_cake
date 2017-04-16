<?php

App::uses('AppController', 'Controller');
use Lib\ConfigEmail as ConfigEmail;

class FaleConoscoController extends AppController {

    private $mail;
    private $config;
    private $error = false;
    private $arquivo;
    private $html;
    private $nome;

	public function index() {

		self::commons_inc();
		define('INCLUDE_FALE_CONOSCO', true);

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

                    $this->error=false;
                    if (Tools::getValue('nome') == '') {
                        $this->error = true;
                    }

                    if (Tools::getValue('email') == '') {
                        $this->error = true;
                    }

                    if (!Validate::isEmail( Tools::getValue('email') )) {
                        $this->error = true;
                    }

                    if (Tools::getValue('mensagem') == '') {
                        $this->error = true;
                    }

                    if (Tools::getValue('assunto') == '') {
                        $this->error = true;
                    }

                    $this->arquivo = isset($_FILES['fileUpload']) ? $_FILES['fileUpload'] : false;

                    if (isset($this->arquivo['tmp_name'], $this->arquivo['name'])
                        && !empty($this->arquivo['tmp_name']) && !empty($this->arquivo['name']) ) {

                        if (isset($this->arquivo['error']) && $this->arquivo['error'] !==0) {
                            $this->error = true;
                            throw new Exception("<b>Atenção:</b> Arquivo contém erros, por favor tente outro.", 1);
                        }

                        if (!Validate::isMaxSize($this->arquivo['size'])) {
                            $this->error = true;
                            throw new Exception("<b>Atenção:</b> Envie somente imagens e no máximo 2mb.", 1);
                        }

                        if (!Validate::isImage( $this->arquivo )) {
                            $this->error = true;
                            throw new Exception("<b>Atenção:</b> Arquivos permitidos: .jpg, .gif, .jpeg, .png e no máximo 2mb.", 1);
                        }

                    }

                    if ($this->error !== true) {

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

                        $this->nome = Tools::getValue('nome');

                        $this->mail->From = Tools::getValue('email');
                        $this->mail->FromName = 'Contato - '. Tools::getValue('nome');

                        $this->mail->AddReplyTo( Tools::getValue('email') );

                        $this->mail->addAddress('contato@vialoja.com.br');
                        //$this->mail->addAddress(Tools::getValue('email'));

                        $this->mail->Subject = 'Contato - ViaLoja Shopping';

                        $this->html = '<body>
                                    <p style="font-size: 16px">Contato - ViaLoja Shopping</p>
                                    <p><strong>Nome:</strong> '. $this->nome .'</p>
                                    <p><strong>E-mail:</strong> '. Tools::getValue('email') .'</p>
                                    <p><strong>Assunto:</strong> '. Tools::getValue('assunto') .'</p>';

                                    if (Tools::getValue('referencia') !='') {
                                        $this->html .= '<p><strong>Referência do pedido:</strong>  '. Tools::getValue('referencia') .'<br>';
                                    }

                                    $this->html .= '<p><strong>Mensagem:</strong>  '. nl2br( Tools::getValue('mensagem') ) .'<br>

                                    <hr>
                                    <p><strong>Data:</strong> '. date('d/m/Y H:i:s') .'</p>
                                    <p><strong>IP :</strong> '. $this->request->clientIp() .'<br>
                                    </p>

                                </body>';

                        $this->mail->AltBody = $this->html;
                        $this->mail->Body = $this->html;

                        if (isset($this->arquivo['tmp_name'], $this->arquivo['name'])) {
                            $this->mail->AddAttachment($this->arquivo['tmp_name'], $this->arquivo['name']);
                        }

                        /**
                         * Envia o email usando o phpmailer
                         */
                        if (!$this->mail->Send()) {
                            throw new Exception( "Houve um erro envio de email: ". $this->mail->ErrorInfo );
                        } else {

                            $this->Session->setFlash(__('Seu contato foi enviado com sucesso!'), 'alert-box', array(
                                'class' => 'alert-success'
                            ));

                            $this->mail->ClearAllRecipients();
                            $this->mail->ClearAttachments();
                        }

                    } else {

                        throw new Exception("<b>Atenção:</b> Um ou mais campos estão vazios ou não foram selecionados!", 1);

                    }


                }

            } catch (Exception $e) {

                /**
                 *
                 * seta a mensagem na div alert
                 *
                 **/
                $this->Session->setFlash(__($e->getMessage()), 'alert-box', array(
                    'class' => 'alert-danger'
                ));

            }

        }

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

        $GLOBALS['BannerShopping']['res_managewidgets_footer_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'getBanner',
            'local_publicacao' => 'managewidgets-footer',
        ));

    }

}