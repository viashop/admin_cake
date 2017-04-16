<?php

use Lib\Validate;
use Lib\Tools;
use Lib\Blowfish;
use CSRF\CSRFGuard;

App::uses('AppController', 'Controller');

class ContatoController extends AppController {

	private $endereco;
	private $dados;

	private $nome, $email, $telefone, $pedido, $mensagem;
	private $loja_nome_responsavel, $nome_loja, $email_loja;
	private $arquivo;
	private $enviaEmail;
	private $configMail;

	private $csrfGuard;
    private $csrfGuardName;
    private $csrfGuardToken;

	public function index() {

		if (defined('VITRINE_SHOPPING_VIALOJA')) {

			$this->layout = 'default-vitrine-vialoja';

		} else {

			define('HOME_SHOP_LOJA', true);
			$this->layout = 'default-store';

			$this->requestAction(
				array(
					'controller' => 'Configuracoes',
					'action' => 'init'
				)
			);

			$this->endereco = $this->requestAction(
				array(
					'controller' => 'ShopEndereco',
					'action' => 'enderecoAll'
				)
			);

			$this->set('endereco', $this->endereco['ShopEndereco']['endereco']);
			$this->set('cep', $this->endereco['ShopEndereco']['cep']);
			$this->set('bairro', $this->endereco['ShopEndereco']['bairro']);
			$this->set('numero', $this->endereco['ShopEndereco']['numero']);
			$this->set('complemento', $this->endereco['ShopEndereco']['complemento']);
			$this->set('mostrar_endereco', $this->endereco['ShopEndereco']['mostrar_endereco']);

			$this->set('cidade_nome', $this->endereco['Cidades']['nome']);
			$this->set('estado_nome', $this->endereco['Estados']['nome']);
			$this->set('estado_sigla', $this->endereco['Estados']['sigla']);

			$this->dados = $this->requestAction(
				array(
					'controller' => 'shop',
					'action' => 'getDadosContatoShop'
				)
			);

        	$this->cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);
        	$this->set('cipher', $this->cipher);

			$this->set('loja_tipo', $this->dados['Shop']['loja_tipo']);
			$this->set('nome_loja', $this->dados['Shop']['nome_loja']);
			$this->set('loja_nome_responsavel', $this->dados['Shop']['loja_nome_responsavel']);
			$this->set('loja_cnpj', $this->cipher->decrypt( $this->dados['Shop']['loja_cnpj']));
			$this->set('loja_cpf', $this->cipher->decrypt( $this->dados['Shop']['loja_cpf']));
			$this->set('telefone', $this->dados['Shop']['telefone']);
			$this->set('email', $this->dados['Shop']['email']);

			if ($this->request->is('post')) {

				try {

					/**
					 * Anti Spam Boot
					 * Enviado via class hidden
					 */
					if (Tools::getValue('url_default') !='') {
						return $this->redirect( array('controller' => 'erro') );
					}

					if (Tools::getValue('name') !='') {
						return $this->redirect( array('controller' => 'erro') );
					}

					if (Tools::getValue('check') !='') {
						return $this->redirect( array('controller' => 'erro') );
					}

					/**
					 *
					 * Verifica o token CSRFGuard
					 *
					 **/

					$this->csrfGuard = new CSRFGuard();

					if (!$this->csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

						throw new Exception(ERROR_PROCESS, E_USER_NOTICE);

					} else {

						$this->nome = Tools::getValue('nome');
	                    $this->email = Tools::getValue('email');
	                    $this->telefone = Tools::getValue('telefone');
	                    $this->pedido = Tools::getValue('pedido');
	                    $this->mensagem = Tools::getValue('mensagem');

	                    $this->loja_nome_responsavel = $this->dados['Shop']['loja_nome_responsavel'];
						$this->nome_loja = $this->dados['Shop']['nome_loja'];
						$this->email_loja = $this->dados['Shop']['email'];

						if (empty($this->nome)) {
							throw new Exception("Por favor, informe corretamente seu nome.", 1);
						}

						if (!Validate::isEmail( $this->email )) {
							throw new Exception("Por favor, informe corretamente seu e-mail.", 1);
						}

						if (!Validate::isPhoneNumber($this->telefone)) {
							throw new Exception("Por favor, informe corretamente seu o telefone", 1);
						}

						if (empty($this->pedido)) {
							throw new Exception("Por favor, informe corretamente o número do pedido.", 1);
						}

						if (empty($this->mensagem)) {
							throw new Exception("Por favor, informe corretamente a mensagem.", 1);
						}

						

						$this->arquivo = isset($_FILES['fileUpload']) ? $_FILES['fileUpload'] : false;

	                    if (isset($this->arquivo['tmp_name'], $this->arquivo['name'])
	                        && !empty($this->arquivo['tmp_name']) && !empty($this->arquivo['name']) ) {

	                        if (isset($this->arquivo['error']) && $this->arquivo['error'] !==0) {
	                            throw new Exception("<b>Atenção:</b> Arquivo contém erros, por favor tente outro.", 1);
	                        }

	                        if (!Validate::isMaxSize($this->arquivo['size'])) {
	                            throw new Exception("<b>Atenção:</b> Envie somente imagens e no máximo 2mb.", 1);
	                        }

	                        if (!Validate::isImage( $this->arquivo )) {
	                            throw new Exception("<b>Atenção:</b> Arquivos permitidos: .jpg, .gif, .jpeg, .png e no máximo 2mb.", 1);
	                        }

	                    }						
						
						$this->enviaEmail = new \Email\Notification\Controller\Contact\ContatoLoja();
						
						$this->enviaEmail->setNomeResponsavel($this->loja_nome_responsavel)
									  	 ->setNome($this->nome)
									  	 ->setEmail($this->email)
										 ->setTelefone($this->telefone)
										 ->setPedido($this->pedido)
										 ->setMensagem($this->mensagem);
						

						$this->configMail = new \Email\Config\SendMail();
						
						$this->configMail->setFromName('Contato - '. Tools::firstName($this->nome))
										 ->setAddress($this->email_loja)
										 ->setSubject("Contato no site - ". env('HTTP_HOST'))
										 ->setAddReplyTo($this->email)
										 ->setMessage($this->enviaEmail->contentSimple())
										 ->setFile($this->arquivo);

                        if ($this->configMail->sendMail() === true) {
							$this->Session->setFlash(__('E-mail enviado com sucesso para: '.Tools::strtoupper($this->nome_loja).''), 'alert-box', array('class'=>'success-msg'));
						} else {
							$this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'error-msg'));
						}

					}

		        } catch (Exception $e) {

					$this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'error-msg'));

				}

			}

		}

		$this->configCSRFGuard();

	}

	/**
     * Configurações de Segurança
     */
    public function configCSRFGuard()
    {

        /**
         *
         * verifica se é bot
         *
         **/
        if (!Validate::isBot()) {

            $this->CSRFGuard = new CSRFGuard();

            $this->CSRFGuardName = "CSRFGuard_".mt_rand(0,mt_getrandmax());
            $this->CSRFGuardToken = $this->CSRFGuard->csrfguard_generate_token($this->CSRFGuardName);

            $this->set('CSRFGuardName', $this->CSRFGuardName);
            $this->set('CSRFGuardToken', $this->CSRFGuardToken);

        } else {

            $this->set('CSRFGuardName', null);
            $this->set('CSRFGuardToken', null);

        }

    }

}
