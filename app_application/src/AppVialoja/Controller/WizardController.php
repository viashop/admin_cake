<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 20/10/16 às 16:47
 */

use Lib\Tools;
use Lib\Validate;
use Respect\Validation\Validator as v;
use CSRF\CSRFGuard;

/**
 * Class WizardController
 */
class WizardController extends AppController
{

    public $layout = 'wizard';
    /**
     * Chama as Models
     * @var array
     */
    public $uses = array(
        'Wizard',
        'ConfiguracaoAtividade',
        'ConfiguracaoPagamento',
        'ConfiguracaoEnvio',
        'Estados',
        'ShopAtividade',
        'Shop',
        'ShopDominio',
        'SubdominioNaoPermitido',
        'ShopDominioRedirect',
        'ShopEnvio',
        'ShopEndereco',
        'ShopEnvioCorreios',
        'ShopPagamento',
        'Cliente',
        'CodigoCorreios',
        'ShopModo'
    );

    private $datasource;
    private $error = false;


    /**
     * Progresso do Cadastro na Wizard
     * @return string
     */
    private function progress()
    {

        if (isset($this->request->pass['0']) && $this->request->pass['0'] !== 'passo-1') {

            if (v::notEmpty()->validate($this->Session->read('conta_auto_login'))) {

                if ($this->Session->read('conta_auto_login') === true) {

                    if ($this->Session->read('wizard_passo_config') == 1) {
                        return $this->redirect(Tools::urlPassoWizard(1));
                    }

                }

            }

        }

    }


    private function verificaContaAutoLogin()
    {

        if (!v::notEmpty()->validate($this->Session->read('conta_auto_login'))) {

            if ($this->Session->read('conta_auto_login') !== true) {

                /**
                 * Passo 1 completado
                 * Seta 2 para ok
                 **/
                self::updateWizardPasso(2);

                if (isset($this->request->pass['2']) && $this->request->pass['2'] == 'error') {
                    return $this->redirect(Tools::urlPassoWizard(2));
                } else {

                    if ($this->Session->read('conta_auto_login') !== false) {
                        $this->setMsgAlertSuccess('Parabéns! Seu email foi confirmado, digite sua senha para acessar o painel de controle.');
                    }
                    return $this->redirect(Tools::urlPassoWizard(2));

                }

            }

        }

    }

    public function passo1()
    {

        self::updateWizardPasso(1);
        self::verificaContaAutoLogin();
        self::progress();

        if ($this->request->is('post')) {

            try {

                /** Verifica o token CSRFGuard **/
                $CSRFGuard = new CSRFGuard();
                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                $this->set('nome', Tools::getValue('nome'));

                if (Tools::getValue('nome') =='') {
                    $this->set('erro_nome', 'Este campo é obrigatório.');
                    $this->error = true;
                } elseif (!v::stringType()->validate(Tools::getValue('nome'))) {
                    $this->set('erro_nome', 'Preencha este campo corretamente.');
                    $this->error = true;
                } elseif (Tools::strlen(Tools::getValue('nome')) <= 2) {
                    $this->set('erro_nome', 'Preencha este campo corretamente.');
                    $this->error = true;
                }

                if (Tools::getValue('senha') =='') {
                    $this->set('erro_senha', 'Este campo é obrigatório.');
                    $this->error = true;
                } elseif (!v::noWhitespace()->validate(Tools::getValue('senha'))) {
                    $this->set('erro_senha', 'Não é permitido espaço em branco na senha.');
                    $this->error = true;
                }

                if (Validate::weakPassword(Tools::getValue('senha')) === true) {
                    $msg = 'Erro: Sua senha foi detectada como insegura!';
                    $this->set('erro_senha', $msg);
                    $this->error = true;
                    $this->setMsgAlertError($msg);
                }

                if (!Validate::isPasswd(Tools::getValue('senha'))) {
                    $this->set('erro_senha', 'A senha deve conter no miníno 6 caracteres.');
                    $this->error = true;
                }

                if (Tools::getValue('confirmacao_senha') =='') {
                    $this->set('erro_confirme', 'Este campo é obrigatório.');
                    $this->error = true;
                }

                if (Tools::getValue('check') =='') {
                    $msg = 'É necessário aceitar os termos de serviço.';
                    $this->set('erro_check', $msg);
                    $this->error = true;
                    $this->setMsgAlertError($msg);
                } else {
                    $this->set('check', true);
                }

                if (Tools::getValue('senha') !== Tools::getValue('confirmacao_senha')) {
                    $msg = 'Erro: As senhas não são iguais.';
                    $this->set('erro_senha', $msg);
                    $this->error = true;
                    $this->setMsgAlertError($msg);
                }

                if ($this->error !== true) {

                    if ($this->Cliente instanceof Cliente) {

                        $nome = Tools::clean(Tools::getValue('nome'));
                        $this->Cliente->setIdCliente($this->Session->read('id_cliente'));
                        $this->Cliente->setNome($nome);
                        $this->Cliente->setSenha(\Lib\PasswordHasher::generate(Tools::getValue('senha')));

                        if ($this->Cliente->addNomeSenhaWizard($this->Cliente)) {

                            $this->Session->write('cliente_nome', $nome);
                            $this->Session->delete('conta_auto_login');

                            /**
                             * Passo 1 completado
                             * Seta 2 para ok
                             **/
                            self::updateWizardPasso(2);
                            return $this->redirect(Tools::urlPassoWizard(2));

                        }

                    }

                }

            } catch (\InvalidArgumentException $e) {
                $this->setMsgAlertError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->setMsgAlertError(ERROR_PROCESS);
            }
        }

        $this->set('title_for_layout', 'Configure seu acesso');
        $this->configCSRFGuard();

    }

    /**
     * Cadastra o subdomino para shop
     */
    private function addShopDominio()
    {

        $dominio = Tools::clean(Tools::strtolower(Tools::getValue('dominio')));

        if ($this->ShopDominio instanceof ShopDominio) {

            //Remove Subdominio
            $this->ShopDominio->removeSubdominio($this->Shop);

            //Remove Subdominio de Redirecionamento
            if ($this->ShopDominioRedirect instanceof ShopDominioRedirect) {
                $std = new \stdClass();
                $std->virtual_uri = $dominio;
                $this->ShopDominioRedirect->removeSubdominio($this->Shop, $std);
            }

            //Add Subdominio
            $this->ShopDominio->setDominio(sprintf('%s%s', $dominio, env('HTTP_BASE')));
            $this->ShopDominio->setDominioSsl(sprintf('%s%s', $dominio, env('HTTP_BASE')));
            $this->ShopDominio->setDominioManutencao(sprintf('%s-manutencao%s', $dominio, env('HTTP_BASE')));
            $this->ShopDominio->setVirtualUri($dominio);
            $this->ShopDominio->setMain(true);
            $this->ShopDominio->setSubdominioPlataforma('True');

            $datetime = new DateTime();
            $this->ShopDominio->setSubdominioAdd($datetime->format("Y-m-d h:i:s"));
            $this->ShopDominio->cadastrarSubdominio($this->Shop, $this->ShopDominio);

        }

    }

    private function verificaSubdomain()
    {

        $dominio = (string) trim( Tools::getValue('dominio') );

        if ($this->SubdominioNaoPermitido instanceof SubdominioNaoPermitido) {

            /** Verifica e dominio esta relacionado ao sistema **/
            if ($this->SubdominioNaoPermitido->existsSubdominio($dominio)) {
                throw new \Exception\VialojaInvalidSubdomainException();
            }

        }

        /** Verifica se dominio esta para ser redicionado **/
        if ($this->ShopDominioRedirect instanceof ShopDominioRedirect) {

            $std = new \stdClass();
            $std->virtual_uri = $dominio;
            if ($this->ShopDominioRedirect->existsSubdominio($this->Shop, $std)) {
                throw new \Exception\VialojaInvalidSubdomainException();
            }

        }

        if ($this->ShopDominio->existsSubdominio($dominio)) {
            throw new \Exception\VialojaInvalidSubdomainException();
        }

    }

    private function addShopEndereco()
    {
        $mostrar_endereco = (Tools::getValue('mostrar_endereco') == 'on') ? 'True' : 'False';

        if ($mostrar_endereco == 'True') {

            /** Cadastra o endereço de forma completa ***/
            if ($this->ShopEndereco instanceof ShopEndereco) {

                $this->ShopEndereco->setEndereco(Tools::clean(Tools::getValue('endereco')));
                $this->ShopEndereco->setCep(Tools::clean(Tools::getValue('cep')));
                $this->ShopEndereco->setBairro(Tools::clean(Tools::getValue('bairro')));
                $this->ShopEndereco->setNumero(Tools::clean(Tools::getValue('numero')));
                $this->ShopEndereco->setComplemento(Tools::clean(Tools::getValue('complemento')));
                $this->ShopEndereco->setMostrarEndereco($mostrar_endereco);
                $this->ShopEndereco->setIdCidade(intval(Tools::getValue('cidade')));
                $this->ShopEndereco->setIdEstado(intval(Tools::getValue('estado')));
                $this->ShopEndereco->cadastrar($this->Shop, $this->ShopEndereco);

            }

        }
    }

    private function addShopAtividade()
    {
        if ($this->ShopAtividade instanceof ShopAtividade) {

            $this->ShopAtividade->removerTodos($this->Shop);

            /** Cadastra as atividades escolhidas **/
            if (v::arrayVal()->notEmpty()->validate(Tools::getValue('atividades'))) {

                foreach (Tools::getValue('atividades') as $key => $id_atividade) {
                    $this->ShopAtividade->setIdAtividade(intval($id_atividade));
                    $this->ShopAtividade->addAtividade($this->Shop, $this->ShopAtividade);
                }

            }

        }

    }

    /*
     * Passos de Configurações na Wizard
     */
    public function passo2()
    {

        if ($this->Session->read('wizard_passo_config_flash') === true) {
            $this->setMsgAlertSuccess('Parabéns! Seu email foi confirmado. Configure sua loja.');
            $this->Session->delete('wizard_passo_config_flash');
        }

        self::progress();

        if ($this->request->is('post')) {

            $this->datasource = $this->Shop->getDataSource();

            try {

                $this->datasource->begin();

                /** Verifica o token CSRFGuard **/

                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                $mensagem = 'Este campo é obrigatório.';
                $mensagem_flash = 'Verifique os erros encontrados.';

                if (!v::stringType()->notEmpty()->validate(Tools::getValue('nome'))) {
                    $mensagem_flash = 'Informe o nome da loja virtual corretamente.';
                    $this->set('erro_nome', $mensagem);
                    $this->error = true;
                }

                if (!v::arrayVal()->notEmpty()->validate(Tools::getValue('atividades'))) {
                    $this->set('erro_atividades', $mensagem);
                    $this->error = true;
                }

                if (Tools::strlen(Tools::getValue('dominio')) < 3) {
                    $this->set('erro_dominio', $mensagem);
                    $this->error = true;
                }

                if (!Validate::isDomainName(Tools::getValue('dominio'))) {
                    $mensagem_flash = "Atenção: Endereço provisório da loja virtual é inválido.";
                    $this->set('erro_dominio', $mensagem);
                    $this->error = true;
                }

                if (Tools::strlen(Tools::getValue('dominio')) > 32) {
                    $this->set('erro_dominio', $mensagem);
                    $this->error = true;
                    $mensagem_flash = "Endereço provisório para loja virtual tem que conter entre 3 e 32 caracteres.";
                }

                if (Tools::getValue('email') =='') {
                    if (!v::email()->validate(Tools::getValue('email'))) {
                        $this->set('erro_email', $mensagem);
                        $this->error = true;
                    }
                }

                try {
                    self::verificaSubdomain();
                } catch (\Exception\VialojaInvalidSubdomainException $e) {
                    $this->set('erro_dominio', 'Não está disponível.');
                    $this->error = true;
                    $mensagem_flash = "O endereço escolhido para loja virtual não está disponível.";
                }

                if ($this->error === true) {
                    $this->setMsgAlertError('Atenção: ' . $mensagem_flash);
                }

                if ($this->error !== true) {

                    $this->Session->write('loja_nome', Tools::getValue('nome'));

                    if ($this->Shop instanceof Shop) {

                        $this->Shop->setIdShop($this->Session->read('id_shop'));

                        self::addShopEndereco();
                        self::addShopDominio();
                        self::addShopAtividade();

                        $copiar_dados = (Tools::getValue('copiar_dados') == 'on') ? 'True' : 'False';
                        $this->Shop->setNomeLoja(Tools::clean(Tools::getValue('nome')));
                        $this->Shop->setEmail(Tools::clean(Tools::getValue('email')));
                        $this->Shop->setTelefone(Tools::clean(Tools::getValue('telefone')));
                        $this->Shop->setModo(Tools::getValue('modo'));
                        $this->Shop->setCopiarDados($copiar_dados);
                        $this->Shop->addDadosWizard($this->Shop);

                    }

                    if ($this->datasource->commit()) {

                        /**
                         * Passo 2 completado
                         * Seta 3 para ok
                         **/
                        self::updateWizardPasso(3);

                        if (Tools::getValue('modo') != 'loja') {
                            return $this->redirect(Tools::urlPassoWizard(5));
                        }

                        return $this->redirect(Tools::urlPassoWizard(3));

                    }

                }

            } catch (\Exception\VialojaInvalidTransactionException $e) {
                $this->datasource->rollback();
                $this->setMsgAlertError($e->getMessage());
            } catch (\InvalidArgumentException $e) {
                $this->setMsgAlertError($e->getMessage());
            } catch (\BadFunctionCallException $e) {
                $this->setMsgAlertError($e->getMessage());
            } catch (\Exception $e) {
                $this->setMsgAlertError($e->getMessage());
            }

        }

        $modo = $this->ShopModo->getAll();
        $atividades = $this->ConfiguracaoAtividade->getAll();
        $estados = $this->Estados->getAll();
        $this->set(compact('modo', 'atividades', 'estados'));
        $this->set('title_for_layout', 'Configure sua loja');
        $this->configCSRFGuard();

    }

    /*
     * Passos de Configurações na Wizard
     */
    public function passo3()
    {

        self::progress();

        $this->set('title_for_layout', 'Escolha as formas de envio da sua loja');

        if ($this->request->is('post')) {

            $this->datasource = $this->ShopEnvioCorreios->getDataSource();

            try {

                $this->datasource->begin();

                /** Verifica o token CSRFGuard **/
                $CSRFGuard = new CSRFGuard();
                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                if (!v::notEmpty()->validate(Tools::getValue('cep'))) {
                    $this->set('erro_cep', 'Este campo é obrigatório.');
                    $this->error = true;
                } elseif (!v::postalCode('BR')->validate(Tools::getValue('cep'))) {
                    $this->set('erro_cep', 'Este CEP é inválido.');
                    $this->error = true;
                }

                if (!v::arrayVal()->notEmpty()->validate(Tools::getValue('id_envio'))) {
                    throw new \NotFoundException("Atenção: Informe o tipo de envio que deseja oferecer aos seus clientes", E_USER_WARNING);
                }

                if ($this->error !== true) {

                    if ($this->Shop instanceof Shop) {
                        $this->Shop->setIdShop($this->Session->read('id_shop'));
                    }

                    if ($this->ShopEnvio instanceof ShopEnvio) {


                        /** Deleta as formas de envio caso usuario volte **/
                        $this->ShopEnvio->deleteWizard($this->Shop);

                        /** Add ShopEnvio */
                        $this->ShopEnvio->setIdEnvio(Tools::getValue('id_envio'));
                        $this->ShopEnvio->setAtivo('True');
                        $this->ShopEnvio->addEnvioFormaWizard($this->Shop, $this->ShopEnvio);

                    }


                    foreach (Tools::getValue('id_envio') as $id_envio) {

                        if ($this->CodigoCorreios instanceof CodigoCorreios) {

                            $codigo = $this->CodigoCorreios->getCodigo($id_envio);

                            if (!empty($codigo['CodigoCorreios']['codigo'])) {

                                if ($this->ShopEnvioCorreios instanceof ShopEnvioCorreios) {

                                    if ($this->ShopEnvio instanceof ShopEnvio) {
                                        $this->ShopEnvio->setIdEnvio($id_envio);

                                        $this->ShopEnvioCorreios->setCepOrigem(Tools::getValue('cep'));
                                        $this->ShopEnvioCorreios->setCodigoServico($codigo['CodigoCorreios']['codigo']);
                                        $this->ShopEnvioCorreios->addEnvioWizard($this->Shop, $this->ShopEnvio, $this->ShopEnvioCorreios);

                                    }

                                }

                            }

                        }

                    }

                    /**
                     * Passo 3 completado
                     * Seta 4 para ok
                     **/
                    self::updateWizardPasso(4);

                    if ($this->datasource->commit()) {
                        return $this->redirect(Tools::urlPassoWizard(4));
                    }

                }

            } catch (\Exception\VialojaInvalidTransactionException $e) {

                $this->datasource->rollback();
                $this->setMsgAlertError($e->getMessage());

            } catch (\NotFoundException $e) {
                $this->setMsgAlertError($e->getMessage());
            } catch (\InvalidArgumentException $e) {
                $this->setMsgAlertError($e->getMessage());
            }

        }

        $envio_forma = $this->ConfiguracaoEnvio->obterTodasAsConfiguracoesDeEnvio();
        $this->set(compact('envio_forma'));

        $this->configCSRFGuard();

    }

    /*
     * Passos de Configurações na Wizard
     */
    public function passo4()
    {

        self::progress();

        if ($this->request->is('post')) {

            try {

                /** Verifica o token CSRFGuard **/

                $CSRFGuard = new CSRFGuard();
                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                if (!v::arrayVal()->notEmpty()->validate(Tools::getValue('id_pagamento'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                }

                if ($this->Shop instanceof Shop) {
                    $this->Shop->setIdShop($this->Session->read('id_shop'));
                }

                if ($this->ShopPagamento instanceof ShopPagamento) {
                    $std = new \stdClass();
                    $std->id_pagamento = Tools::getValue('id_pagamento');
                    $this->ShopPagamento->addPagamentoWizard($this->Shop, $std);
                }

                /**
                 * Passo 4 completado
                 * Seta 5 para ok
                 **/
                self::updateWizardPasso(5);

                return $this->redirect(Tools::urlPassoWizard(5));

            } catch (\PDOException $e) {
                \Exception\VialojaDatabaseException::errorHandler($e);
            } catch (\InvalidArgumentException $e) {
                $this->setMsgAlertError($e->getMessage());
            } catch (\Exception\VialojaInvalidTransactionException $e) {
                $this->setMsgAlertError($e->getMessage());
            }

        }

        $res_pagamentos = $this->ConfiguracaoPagamento->getPagamentoWizardAll();
        $this->set(compact('res_pagamentos'));
        $this->set('title_for_layout', 'Escolha as formas de pagamento disponíveis em sua loja');
        $this->configCSRFGuard();

    }

    /*
     * Passos de Configurações na Wizard
     */

    public function passo5()
    {

        self::progress();
        self::removeAutoLoginConta();

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

        $dados = $this->Shop->getDadosLogomarca($this->Shop);

        if (empty($dados['Shop']['nome_loja']) || empty($dados['ShopDominio']['dominio'])) {
            return $this->redirect(Tools::urlPassoWizard(1));
        }

        $nome_loja = $dados['Shop']['nome_loja'];
        $email = $dados['Shop']['email'];
        $logo = $dados['Shop']['logo'];
        $dominio = $dados['ShopDominio']['dominio'];
        $this->set(compact('nome_loja', 'email', 'logo', 'dominio'));

        /** Array int ShopEnvioCorreios **/
        if ($this->ShopEnvioCorreios instanceof ShopEnvioCorreios) {

            $arrayIds = $this->ShopEnvioCorreios->obterArrayIds($this->Shop);
            if (v::notEmpty()->validate($arrayIds)) {

                if ($this->ConfiguracaoEnvio instanceof ConfiguracaoEnvio) {
                    $formas_envio = $this->ConfiguracaoEnvio->obterConfiguracoesDeEnvioComIN($arrayIds);
                }

            } else {
                $formas_envio = null;
            }

            $this->set(compact('formas_envio'));

        }

        /** Array int ShopPagamento **/
        if ($this->ShopPagamento instanceof ShopPagamento) {

            $arrayIds = $this->ShopPagamento->obterArrayIds($this->Shop);
            if (v::notEmpty()->validate($arrayIds)) {

                if ($this->ConfiguracaoPagamento instanceof ConfiguracaoPagamento) {
                    $res_pagamentos = $this->ConfiguracaoPagamento->getPagamentoIN($arrayIds);
                }

            } else {
                $res_pagamentos = null;
            }

            $this->set(compact('res_pagamentos'));

        }

        $this->set('title_for_layout', 'Resumo do seu cadastro');

    }

    /**
     * Remove Auto Login
     * @return string
     */
    private function removeAutoLoginConta()
    {

        if ($this->Cliente instanceof Cliente) {
            $this->Cliente->setIdCliente($this->Session->read('id_cliente'));
            $this->Cliente->removeAutoLogin($this->Cliente);
        }

    }

    /**
     * Update tela de configuracao rápida
     * @param string $passo
     */
    public function updateWizardPasso($passo = '')
    {

        if (v::numeric()->notEmpty()->validate($passo)) {

            $this->cookieViaLoja()->_setcookie('__vialoja_step', $passo, 60 * 60 * 24 * 365);

            if ($this->Shop instanceof Shop) {
                $this->Shop->setIdShop($this->Session->read('id_shop'));
            }

            if ($this->Wizard instanceof Wizard) {
                $this->Wizard->setPasso($passo);
                $this->Wizard->updatePasso($this->Shop, $this->Wizard);
            }

        }

    }


    /**
     * Verifica Cookie Passos
     */
    public function verificaCookieStep()
    {

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

        if ($this->Wizard instanceof Wizard) {

            $passo = $this->Wizard->passoWizard($this->Shop);

            if (v::notEmpty()->validate($passo)) {

                $this->cookieViaLoja()->_setcookie('__vialoja_step', $passo['Wizard']['passo'], 60 * 60 * 24 * 365);

                $this->redirect(Tools::urlPassoWizard($passo['Wizard']['passo']));

                if ($passo['Wizard']['passo'] >= '5') {

                    $this->Session->write('passo_wizard_complete', true);

                    if (isset($this->request->query['urlReturn'])) {
                        if (v::videoUrl()->validate($this->request->query['urlReturn'])) {
                            return $this->redirect($this->request->query['urlReturn']);
                        } else {
                            $this->cookieViaLoja()->destroy();
                        }
                    }

                }

            } else {

                $this->Session->destroy();
                $this->cookieViaLoja()->destroy();

            }

        }

    }

}
