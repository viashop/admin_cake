<?php

use Respect\Validation\Validator as v;
App::uses('AppController', 'Controller');

class MinhaContaController extends AppController {

    public $uses = array('Cliente');

	private $conditions;
	private $fields = 3;
	private $datasource;
	private $error = null;
	private $result;
	private $cpf, $cnpj;
	private $msg_atencao;
	private $id_sexo = 3;

	private $options;
	private $tipo_cadastro;
	private $nome;
	private $responsavel;
	private $email;
	private $senha;
	private $aliases;

	public function index() {

		self::commons_inc();

		define('INCLUDE_MINHA_CONTA', true);

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

        $GLOBALS['BannerShopping']['res_managewidgets_left_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'getBanner',
            'local_publicacao' => 'managewidgets-left',
        ));

        /*
        $GLOBALS['BannerShopping']['res_sliderlayer_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'getBanner',
            'local_publicacao' => 'sliderlayer',
        ));*/

        $GLOBALS['BannerShopping']['res_sliderlayer_all'] = $this->requestAction(array(
            'controller' => 'BannerShopping',
            'action' => 'ul_slide',
            'local_publicacao' => 'sliderlayer',
        ));


    }

    public function dados() {

        $this->cipher = new \Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);
        $this->set('cipher', $this->cipher);

        self::commons_inc();

        define('INCLUDE_MINHA_CONTA', true);

        if ($this->request->is('post')) {

            $this->datasource = $this->Cliente->getDataSource();

            try {

                /**
				 *
				 * Verifica o token CSRFGuard
				 *
				 **/

				$csrfGuard = new CSRFGuard();

				if (!$csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

					throw new Exception(ERROR_PROCESS, E_USER_NOTICE);

				} else {

                    $this->error = null;

                    if (Tools::getValue('tipo_cadastro') =='cpf') {

                        if (Tools::getValue('nome_completo') =='') {
                            $this->error .= '<br />Por favor, informe seu nome Completo.';
                        }

                        $this->cpf = Tools::getValue('cpf');

                        if ($this->cpf =='') {
                            $this->error .= '<br />Por favor, informe seu CPF.';
                        } elseif (!v::cpf()->validate($this->cpf)) {
                            $this->error .= '<br />Este CPF <strong>'. $this->cpf .'</strong> é inválido.';
                        }

                        if (Tools::getValue('sexo') =='') {
                            $this->error .= '<br />Por favor, selecione o sexo.';
                        }

                        if (Tools::getValue('data_nasc') =='') {
                            $this->error .= '<br />Por favor, informe sua data de nascimento.';
                        }

                        if (Tools::getValue('aliases') =='') {
                            $this->error .= '<br />Por favor, informe como gostaria de ser chamando.';
                        }

                    } else {

                        if (Tools::getValue('razao_social') =='') {
                            $this->error .= '<br />Por favor, informe a Razão Social.';
                        }

                        if (Tools::getValue('cnpj') =='') {
                            $this->error .= '<br />Por favor, informe seu o CNPJ.';
                        }

                        $this->cnpj = Tools::getValue('cnpj');

                        if ($this->cnpj =='') {
                            $this->error .= '<br />Por favor, informe seu CNPJ.';
                        } elseif (!v::cnpj()->validate($this->cnpj)) {
                            $this->error .= '<br />Este CNPJ <strong>'. $this->cnpj .'</strong> é inválido.';
                        }

                        if (Tools::getValue('info_tributo') =='') {
                            $this->error .= '<br />Por favor, Selecione a Informação tributária.';
                        }

                        if (Tools::getValue('ie') =='') {
                            $this->error .= '<br />Por favor, informe a Inscrição Estadual.';
                        }

                        if (Tools::getValue('responsavel') =='') {
                            $this->error .= '<br />Por favor, informe o nome do Responsável.';
                        }

                    }

                    if (Tools::getValue('email') =='') {

                        $this->error .= '<br />Por favor, informe seu e-mail corretamente.';

                    } elseif (!Validate::isEmail(Tools::clean(Tools::getValue('email')))) {

                        $this->error .= '<br />Por favor, informe o e-mail corretamente.';

                    } else {


                        /**
                         *
                         * verifico se o usuario ja existe
                         *
                         **/
                        $this->conditions = array(
                            'conditions' => array(
                                'Cliente.email' => Tools::clean(Tools::getValue('email')),
                                'Cliente.id_cliente !=' => $this->Session->read('id_cliente')
                            )
                        );

                        if ($this->Cliente->find('count', $this->conditions) !== 0) {

                            $this->error .= '<br />Uma conta usando esse endereço de e-mail já está em uso.';

                        }

                    }

                    if ( Tools::getValue('senha') !='' || Tools::getValue('confirmacao_senha') !='' ) {

                        if (strpos(Tools::getValue('senha'), ' ') !== false) {

                            $this->error .= '<br />Não é permitido espaço em branco na senha.';

                        }

                        if (Validate::weakPassword(Tools::getValue('senha')) === true) {

                            $this->error .= '<br />Sua senha foi detectada como insegura!';

                        }

                        if (!Validate::isPasswd(Tools::getValue('senha'))) {

                            $this->error .= '<br />A senha deve conter no miníno 6 caracteres.';

                        }

                        if (Tools::getValue('confirmacao_senha') =='') {

                            $this->error .= '<br />Por favor, confirme sua senha.';

                        }

                        if (Tools::getValue('check') =='') {

                            $this->error .= '<br />É necessário aceitar os termos de serviço.';

                        } else {

                            $this->set('check', true);
                        }

                        if (Tools::getValue('senha') !== Tools::getValue('confirmacao_senha')) {

                            $this->error .= '<br />As senhas não são iguais.';

                        }

                    }

                    if (count($this->error) > 0) {

                        $this->msg_atencao = '<span style="font-size:18px;"><strong>Atenção: Erros econtrados!</strong></span>';

                        throw new Exception($this->msg_atencao.$this->error, 1);

                    } else {

                        $this->options = [
                            'cost' => 7,
                            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
                        ];

                        $this->tipo_cadastro = Tools::clean(Tools::getValue('tipo_cadastro'));
                        $this->nome = Tools::clean(Tools::getValue('nome_completo'));
                        $this->responsavel = Tools::clean(Tools::getValue('responsavel'));
                        $this->email = Tools::clean(Tools::getValue('email'));
                        $this->senha = Tools::clean(Tools::getValue('senha'));
                        $this->aliases = Tools::clean(Tools::getValue('aliases'));

                        if (Tools::getValue('sexo') !='') {
                            $this->id_sexo = Tools::clean(Tools::getValue('sexo'));
                        }

                        $this->cnpj = null;
                        if ($this->tipo_cadastro=='cnpj') {
                            if (Tools::getValue('cnpj') !='') {
                                $this->cnpj = $this->cipher->encrypt(Tools::clean(Tools::getValue('cnpj')));
                            }
                        }

                        $this->cpf = null;
                        if ($this->tipo_cadastro=='cpf') {
                            if (Tools::getValue('cpf') !='') {
                                $this->cpf = $this->cipher->encrypt(Tools::clean(Tools::getValue('cpf')));
                            }
                        }

                        if (!empty($this->senha)) {

                            $this->fields = array(

                                'Cliente.tipo_cadastro' => sprintf("'%s'", Tools::clean(Tools::getValue('tipo_cadastro'))),
                                'Cliente.nome' => sprintf("'%s'", $this->nome),
                                'Cliente.razao_social' => sprintf("'%s'", Tools::clean(Tools::getValue('razao_social'))),
                                'Cliente.id_sexo' => sprintf("'%s'", $this->id_sexo),
                                'Cliente.cpf' => sprintf("'%s'", $this->cpf),
                                'Cliente.cnpj' => sprintf("'%s'", $this->cnpj),
                                'Cliente.info_tributo' => sprintf("'%s'", Tools::clean(Tools::getValue('info_tributo'))),
                                'Cliente.ie' => sprintf("'%s'", Tools::clean(Tools::getValue('ie'))),
                                'Cliente.data_nasc' => sprintf("'%s'", Tools::formatToDateDB(Tools::clean(Tools::getValue('data_nasc')))),
                                'Cliente.telefone_residencial' => sprintf("'%s'", Tools::clean(Tools::getValue('telefone_residencial'))),
                                'Cliente.telefone_celular' => sprintf("'%s'", Tools::clean(Tools::getValue('telefone_celular'))),
                                'Cliente.aliases' => sprintf("'%s'", Tools::clean(Tools::getValue('aliases'))),
                                'Cliente.responsavel' => sprintf("'%s'", $this->responsavel),
                                'Cliente.email' => sprintf("'%s'", $this->email),
                                'Cliente.senha' => sprintf("'%s'", password_hash($this->senha, PASSWORD_BCRYPT, $this->options)),
                                'Cliente.boletim_shopping' => sprintf("'%s'", Tools::clean(Tools::getValue('optin'))),
                                'Cliente.ip' => sprintf("'%s'", $this->request->clientIp())

                            );

                        } else {

                            $this->fields = array(

                                'Cliente.tipo_cadastro' => sprintf("'%s'", Tools::clean(Tools::getValue('tipo_cadastro'))),
                                'Cliente.nome' => sprintf("'%s'", $this->nome),
                                'Cliente.razao_social' => sprintf("'%s'", Tools::clean(Tools::getValue('razao_social'))),
                                'Cliente.id_sexo' => sprintf("'%s'", $this->id_sexo),
                                'Cliente.cpf' => sprintf("'%s'", $this->cpf),
                                'Cliente.cnpj' => sprintf("'%s'", $this->cnpj),
                                'Cliente.info_tributo' => sprintf("'%s'", Tools::clean(Tools::getValue('info_tributo'))),
                                'Cliente.ie' => sprintf("'%s'", Tools::clean(Tools::getValue('ie'))),
                                'Cliente.data_nasc' => sprintf("'%s'", Tools::formatToDateDB(Tools::clean(Tools::getValue('data_nasc')))),
                                'Cliente.telefone_residencial' => sprintf("'%s'", Tools::clean(Tools::getValue('telefone_residencial'))),
                                'Cliente.telefone_celular' => sprintf("'%s'", Tools::clean(Tools::getValue('telefone_celular'))),
                                'Cliente.aliases' => sprintf("'%s'", Tools::clean(Tools::getValue('aliases'))),
                                'Cliente.responsavel' => sprintf("'%s'", $this->responsavel),
                                'Cliente.email' => sprintf("'%s'", $this->email),
                                'Cliente.boletim_shopping' => sprintf("'%s'", Tools::clean(Tools::getValue('optin'))),
                                'Cliente.ip' => sprintf("'%s'", $this->request->clientIp())

                            );

                        }

                        $this->conditions = array(
                            'Cliente.id_cliente' => $this->Session->read('id_cliente')
                        );

                        $this->Cliente->updateAll($this->fields, $this->conditions);

                        if ($this->Cliente->getAffectedRows()) {

                            $this->Session->setFlash(__('Dados alterados com sucesso.'), 'alert-box', array('class'=>'alert-success'));

                        } else {

							throw new Exception(ERROR_PROCESS);

						}

                    }

                }

                $this->datasource->commit();

            } catch (PDOException $e) {

                $this->datasource->rollback();

                $this->Session->setFlash(__(ERROR_PROCESS), 'alert-box', array('class'=>'alert-danger'));

                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (Exception $e) {

                $this->Session->setFlash(__($e->getMessage()), 'alert-box', array('class'=>'alert-danger'));

            }

        }

        try {

            $this->conditions = array(

                'fields' => array(

                    'Cliente.id_cliente',
                    'Cliente.id_shop_grupo',
                    'Cliente.id_shop',
                    'Cliente.id_grupo',
                    'Cliente.id_default_grupo',
                    'Cliente.tipo_cadastro',
                    'Cliente.id_sexo',
                    'Cliente.nome',
                    'Cliente.email',
                    'Cliente.nivel',
                    'Cliente.ativo',
                    'Cliente.cpf',
                    'Cliente.cnpj',
                    'Cliente.razao_social',
                    'Cliente.info_tributo',
                    'Cliente.telefone_residencial',
                    'Cliente.telefone_celular',
                    'Cliente.data_nasc',
                    'Cliente.ie',
                    'Cliente.responsavel',
                    'Cliente.aliases',
                    'Cliente.receber_ofertas_shopping',
                    'Cliente.security_key'

                ),

                'conditions' => array(
                    'Cliente.id_cliente' => $this->Session->read('id_cliente')
                )

            );

            $this->result = $this->Cliente->find('first', $this->conditions);

            $this->set('dados', $this->result);

        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->configCSRFGuard();

    }

	public function addresses() {

		self::commons_inc();
        define('INCLUDE_MINHA_CONTA', true);

	}

}
