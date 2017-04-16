<?php

use Lib\Tools;
use Respect\Validation\Validator as v;
use Commons\DescontoFatura as DescontoFatura;
use Lib\Blowfish;
use CSRF\CSRFGuard;

class ContaController extends AppController
{

    public $uses = array(
        'Estados',
        'ShopFatura',
        'ShopConta',
        'ShopFaturaReferencia',
        'Shop',
        'ShopFaturaCredito',
        'PlanoShop',
        'ShopDominio',
        'LogShopTrafego',
        'LogShopVisita',
        'ShopProduto'
    );

	public $components = array('Paginator');

    private $cipher;
    private $data;
    private $shop;
    private $result;
    private $plano;
    private $fatura;
    private $credito_fatura = null;
    private $credito_fatura_futuro;
    private $resultado_calculo;
    private $ok;
    private $url;

    private $error_session = false;
    private $errorException = false;

    /**
     *
     * Strings Data vencimento plano
     *
     **/
    private $data_d;
    private $data_mes_inicial;
    private $data_mes_final;

    private $data_compra, $data_vencimento, $valor_fatura_atual;
    private $planos_lista, $res_fatura, $id_plano;

    /**
     * Editar dados para cobranca
     * @access public
     * @param String $id_cliente
     * @return string
     */
    public function editar()
    {

        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

        $this->cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);
        $this->set('cipher', $this->cipher);

        if ($this->request->is('post')) {

            try {

                /**
				 *
				 * Verifica o token CSRFGuard
				 *
				 **/

				$CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

					throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

				} else {


                    /**
                     *
                     * Cadastra os dados para cobrança
                     *
                     **/
                    $this->error_session     = false;
                    $this->error_dados_conta = false;

                    if (empty($this->request->data['email_nota_fiscal']) || empty($this->request->data['nome_responsavel']) || empty($this->request->data['email_nota_fiscal']) || empty($this->request->data['endereco_cep']) || empty($this->request->data['endereco_logradouro']) || empty($this->request->data['nome_responsavel']) || empty($this->request->data['endereco_bairro']) || empty($this->request->data['endereco_cidade'])) {

                        if (empty($this->request->data['email_nota_fiscal'])) {
                            $this->set('error_email', true);
                        }

                        if (empty($this->request->data['nome_responsavel'])) {
                            $this->set('error_nome_responsavel', true);
                        }

                        if (empty($this->request->data['endereco_cep'])) {
                            $this->set('error_cep', true);
                        }

                        if (empty($this->request->data['endereco_logradouro'])) {
                            $this->set('error_logradouro', true);
                        }

                        if (empty($this->request->data['endereco_bairro'])) {
                            $this->set('error_bairro', true);
                        }

                        if (empty($this->request->data['endereco_cidade'])) {
                            $this->set('error_cidade', true);
                        }

                        $this->set('error_dados_conta', true);
                        $this->error_session     = true;
                        $this->error_dados_conta = true;

                    }

                    if (isset($this->request->data['endereco_estado']) && $this->request->data['endereco_estado'] == "--") {

                        $this->set('error_estado', true);
                        $this->set('error_dados_conta', true);
                        $this->error_dados_conta = true;
                        $this->error_session     = true;

                    }

                    if (isset($this->request->data['email_nota_fiscal'])) {

                        if (!v::email()->validate($this->request->data['email_nota_fiscal'])) {
                            $this->set('error_email', true);
                            $this->set('error_dados_conta', true);
                            $this->error_dados_conta = true;
                            $this->error_session     = true;
                        }

                    }

                    if (Tools::getValue('tipo') == "PF") {

                        if (isset($this->request->data['cpf'])) {

                            if (!v::cpf()->validate($this->request->data['cpf'])) {
                                $this->set('error_cpf', true);
                                $this->set('error_cpf_invalido', true);
                                $this->set('error_dados_conta', true);
                                $this->error_dados_conta = true;
                                $this->error_session     = true;
                            }

                        }

                    } elseif (Tools::getValue('tipo') == "PJ") {

                        if (isset($this->request->data['cnpj'])) {

                            if (!v::stringType()->notEmpty()->validate($this->request->data['razao_social'])) {
                                $this->set('error_razao_social', true);
                                $this->set('error_dados_conta', true);
                                $this->error_dados_conta = true;
                                $this->error_session     = true;
                            }

                            if (!v::cnpj()->validate($this->request->data['cnpj'])) {
                                $this->set('error_cnpj', true);
                                $this->set('error_cnpj_invalido', true);
                                $this->set('error_dados_conta', true);
                                $this->error_dados_conta = true;
                                $this->error_session     = true;
                            }

                        }

                    }

                    if (Tools::getValue('forma_pagamento') == "cartao_credito") {

                        $this->set('error_forma_pagamento', true);
                        $this->error_dados_conta = true;
                        $this->error_session     = true;

                    }

                    /**
                     *
                     * Ativa pagamento com cartão de crédito
                     *
                     **/


                    /*
                    if(Tools::getValue('forma_pagamento') =="cartao_credito") {

                    if (empty($this->request->data['numero'])) {
                    $this->set('error_numero', true);
                    $this->error_dados_conta = true;
                    $this->error_session = true;

                    } else {


                    v::creditCard()->validate('5376 7473 9720 8720'); // true

                    v::creditCard('American Express')->validate('340316193809364'); // true
                    v::creditCard('Diners Club')->validate('30351042633884'); // true
                    v::creditCard('Discover')->validate('6011000990139424'); // true
                    v::creditCard('JCB')->validate('3566002020360505'); // true
                    v::creditCard('Master')->validate('5376747397208720'); // true
                    v::creditCard('Visa')->validate('4024007153361885'); // true

                    if (!v::creditCard()->validate($this->request->data['numero'])) {
                    $this->set('error_numero', true);
                    $this->set('error_numero_invalido', true);
                    $this->error_dados_conta = true;
                    $this->error_session = true;

                    }
                    }

                    if (empty($this->request->data['nome'])) {

                    $this->set('error_nome', true);
                    $this->error_dados_conta = true;
                    $this->error_session = true;

                    }

                    if (empty($this->request->data['cvv'])) {

                    $this->set('error_cvv', true);
                    $this->error_dados_conta = true;
                    $this->error_session = true;

                    }


                    }

                    */


                    if ($this->error_dados_conta !== true) {

                        $this->ok = $this->requestAction(
                            array(
                                'controller' => 'ShopConta',
                                'action' => 'recebeDados'
                            )
                        );

                        if (is_bool($this->ok) && $this->ok === true) {

                            if (isset($this->request->query['continue'])) {

                                //$this->setMsgAlertSuccess('Os dados foram editados com sucesso.');
                                $this->url = explode('/', $this->request->query['continue']);
                                return $this->redirect(array(
                                    'controller' => $this->request->controller,
                                    'action' => $this->url[2],
                                    $this->url[3],
                                    $this->url[4]
                                ));

                            } else {

                                $this->setMsgAlertSuccess('Os dados foram editados com sucesso.');

                                return $this->redirect(array(
                                    'controller' => $this->request->controller,
                                    'action' => 'editar'
                                ));

                            }

                        } else {

                            throw new \RuntimeException();

                        }

                    }

                }

            } catch (\RuntimeException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);
                $this->errorException = true;

            } finally {

                if ($this->errorException !== true) {
                     return $this->redirect(array(
                        'controller' => $this->request->controller,
                        'action' => 'editar'
                    ));
                }

            }

        }

		$dados = $this->ShopConta->getFirstAll($this->Session->read('id_shop'));
		$estados = $this->Estados->getAll();

        $this->set(compact('dados'));
        $this->set(compact('estados'));

        $this->set('title_for_layout', 'Dados para cobrança');


        $this->configCSRFGuard();

    }


    public function assinar()
    {
        $this->set('title_for_layout', 'Assinar plano Plano 2');
    }

    public function cobranca()
    {

        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

        try {

            /**
             *
             * filtro
             *
             **/
            $conditions = array(
                'fields' => array(
                    'ShopFatura.id_fatura',
                    'ShopFatura.id_plano',
                    'ShopFatura.valor',
                    'ShopFatura.desconto',
                    'ShopFatura.referencia',
                    'ShopFatura.data_mes_inicial',
                    'ShopFatura.data_mes_final',
                    'ShopFatura.situacao'
                ),
                'conditions' => array(
                    'ShopFatura.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array(
                    'ShopFatura.id_fatura' => 'DESC',
                    'ShopFatura.created' => 'DESC'
                ),
                'limit' => 25,
				'paramType' => 'querystring'
            );


            /**
             *
             * Paginação de conteúdo do tópicos
             *
             **/
            $this->paginate = $conditions;

            // Roda a consulta, já trazendo os resultados paginados
            $res_fatura = $this->paginate('ShopFatura');
            $this->set(compact('res_fatura'));

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->set('shop', $this->Shop->getFirstAll( $this->Session->read('id_shop') ) );
        $this->set('verifica_cobranca', self::verificaCobranca());
        $this->set('title_for_layout', 'Dados de fatura');

    }

    private function verificaCobranca()
    {
        try {

            $conditions = array(
                'fields' => array(
                    'ShopFatura.data_mes_final'
                ),

                'conditions' => array(
                    "ShopFatura.id_plano !=" => 1,
                    'ShopFatura.situacao' => 2,
                    'ShopFatura.id_shop_default' => $this->Session->read('id_shop')
                )

            );

            $this->result = $this->ShopFatura->find('all', $conditions);

            foreach ($this->result as $dados) {

                $date = new \DateTime(date('Y-m-d'));

                if ($date->format('Y-m-d') > $dados['ShopFatura']['data_mes_final']) {

                    return 'VENCIDO';

                } else {

                    $date = new \DateTime($dados['ShopFatura']['data_mes_final']);
                    $date2 = new \DateTime(date('Y-m-d'));
                    $diff  = $date->diff($date2);

                    if ($diff->days <= 3) {
                        return 'A_VENCER';
                    }

                }

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    public function cancelar()
    {

        if ($this->request->is('post')) {

            try {

                /**
				 *
				 * Verifica o token CSRFGuard
				 *
				 **/
				$CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

				} else {

                    if (!v::numeric()->notBlank()->validate($this->request->params['pass']['0'])) {
                        throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
                    }

                    $this->ShopFatura->id = $this->request->params['pass']['0'];

                    if ($this->ShopFatura->exists()) {

                        $situacao = 4;
                        if ($this->Session->read('fatura_gerada') == 'MANUAL') {
                            $situacao = 3;
                        }

                        $this->Session->delete('fatura_gerada');

                        $this->ok = $this->ShopFatura->updateAll(array(
                            'ShopFatura.situacao' => $situacao
                        ), array(
                            'ShopFatura.id_shop_default' => $this->Session->read('id_shop'),
                            'ShopFatura.id_fatura' => $this->request->params['pass']['0']
                        ));

                        if (is_bool($this->ok) && $this->ok === true) {

                            if ($situacao == 4) {

                                $this->setMsgAlertWarning('Atenção: Não foi possível cancelar a fatura "ID ' . $this->request->params['pass']['0'] . '" neste momento, ela será colocada "em supenso", mas não se preocupe, após escolha de um novo plano e a confirmação de pagamento,
                                    a fatura será automaticamente cancelada pelo sistema, caso tenha alguma dúvida entre em contato conosco.');

                            } else {

                                $this->setMsgAlertSuccess('A cobrança foi cancelada com sucesso. Caso este boleto seja pago o sistema não identificará o pagamento automaticamente, caso tenha alguma dúvida entre em contato conosco.');

                            }

                            return $this->redirect(array(
                                'controller' => $this->request->controller,
                                'action' => 'cobranca'
                            ));

                        } else {

                            throw new \RuntimeException('Não foi possível excluir a cobrança. Por favor, tente novamente mais tarde!');

                        }

                    }

                }

            } catch (\PDOException $e) {

                $this->setMsgAlertError(ERROR_PROCESS);
                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\RuntimeException $e) {

                 $this->setMsgAlertError( $e->getMessage() );

            } finally {

                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => $this->request->action
                ));


            }

        }

        try {

            if (!v::numeric()->notBlank()->validate($this->request->params['pass']['0'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            /**
             *
             * filtro
             *
             **/
            $conditions = array(

                'fields' => array(
                    'ShopFatura.id_fatura',
                    'ShopFatura.fatura_gerada'
                ),

                'conditions' => array(
                    'ShopFatura.id_fatura' => $this->request->params['pass']['0'],
                    'ShopFatura.id_shop_default' => $this->Session->read('id_shop')
                ),

                'order' => array(
                    'ShopFatura.id_fatura' => 'DESC',
                    'ShopFatura.created' => 'DESC'
                )
            );

            if ($this->ShopFatura->find('count', $conditions) <= 0) {
                throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->fatura = $this->ShopFatura->find('first', $conditions);
            $this->set('id_fatura', $this->fatura['ShopFatura']['id_fatura']);
            $this->Session->write('fatura_gerada', $this->fatura['ShopFatura']['fatura_gerada']);

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
            $this->errorException = true;

        } catch (\NotFoundException $e) {

            $this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());
            $this->errorException = true;

        } finally {

            if ($this->errorException !== false) {

                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => 'uso'
                ));

            }

        }

        $this->set('title_for_layout', 'Cancelar uma cobrança');

        $this->configCSRFGuard();


    }

    public function pagar()
    {

        try {


            if (!v::numeric()->notBlank()->validate($this->request->params['pass']['0'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            /**
             *
             * filtro
             *
             **/
            $conditions = array(
                'fields' => array(
                    'ShopFatura.id_fatura',
                    'ShopFatura.id_plano',
                    'ShopFatura.valor',
                    'ShopFatura.desconto',
                    'ShopFatura.referencia',
                    'ShopFatura.data_mes_inicial',
                    'ShopFatura.data_mes_final',
                    'ShopFatura.situacao',
                    'ShopFatura.token',
                    'ShopFatura.created'
                ),
                'conditions' => array(
                    'ShopFatura.id_fatura' => $this->request->params['pass']['0'],
                    'ShopFatura.id_shop_default' => $this->Session->read('id_shop')
                ),

                'order' => array(
                    'ShopFatura.id_fatura' => 'DESC',
                    'ShopFatura.created' => 'DESC'
                )
            );

            if ($this->ShopFatura->find('count', $conditions) <= 0) {
                throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->set('res_fatura', $this->ShopFatura->find('all', $conditions));

        } catch (\PDOException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);

            return $this->redirect(array(
                'controller' => $this->request->controller,
                'action' => 'uso'
            ));

        }

        $this->set('title_for_layout', 'Pagar Cobrança');


    }

    public function uso()
    {

        /**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {
            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );
        }

        if ($this->Shop instanceof Shop) {
            $this->Shop->setIdShop($this->Session->read('id_shop'));
        }

        /** Configurações e Plano **/
        $config = $this->Shop->configuracaoPlanoShop($this->Shop);
        $this->set(compact('config'));

        /** Retorna o ciclo de pagamento **/
        $ciclo = $this->ShopFatura->cicloContaPlano($this->Shop);
        $this->set(compact('ciclo'));

        /** Recupera Valor e o ID do plano Atual **/
        $dados = $this->Shop->getIdStatusPlanoShop($this->Shop);
        $this->id_plano = $dados['Shop']['id_plano'];
        $this->Shop->setIdPlano($this->id_plano);
        $ativo_plano = $dados['Shop']['ativo'];
        $valor_plano = $this->PlanoShop->valorPlano($this->Shop);
        $this->set('id_plano', $this->id_plano);
        $this->set(compact('valor_plano', 'ativo_plano'));

        /** Total de produto Ativo ***/
        $total_produto_ativo = $this->ShopProduto->totalProdutoUso($this->Shop);
        $this->set(compact('total_produto_ativo'));

        $std = new \stdClass();
        $std->domain = 'subdominio';
        $res = $this->ShopDominio->obterResumoDominioTipo($this->Shop, $std);
        $subdominio = $res['ShopDominio']['dominio'];
        $this->set(compact('subdominio'));

        $std = new \stdClass();
        $std->domain = 'dominio';
        $res = $this->ShopDominio->obterResumoDominioTipo($this->Shop, $std);
        $dominio = $res['ShopDominio']['dominio'];
        $this->set(compact('dominio'));

        $std = new \stdClass();
        $std->data_inicio = $ciclo['ShopFatura']['data_mes_inicial'];
        $total = $this->LogShopTrafego->obterTotalTrafego($this->Shop, $std);
        $soma_uso_trafego = $total['0']['SOMA_BYTES'];
        $total_visita = $this->LogShopVisita->obterTotalVisita($this->Shop, $std);
        $this->set(compact('soma_uso_trafego', 'total_visita'));

        try {

            /**
             *
             * filtro
             *
             **/
            $conditions = array(
                'fields' => array(
                    'ShopFatura.id_fatura',
                    'ShopFatura.id_plano'
                ),
                'conditions' => array(
                    'ShopFatura.id_plano >' => 1,
                    'ShopFatura.situacao' => 2,
                    'ShopFatura.id_plano !=' => $this->shop['Shop']['id_plano'],
                    'ShopFatura.id_shop_default' => $this->Session->read('id_shop')
                ),

                'order' => array(
                    'ShopFatura.id_fatura' => 'DESC',
                    'ShopFatura.created' => 'DESC'
                ),
                'limit' => 1
            );

            $this->res_fatura = $this->ShopFatura->find('all', $conditions);

            $this->planos_lista = $this->PlanoShop->planoListar(1);
            $lista_tabela_planos1 = self::tabelaUso();
            $this->set( compact('lista_tabela_planos1') );

            $this->planos_lista = $this->PlanoShop->planoListar(2);
            $lista_tabela_planos2 = self::tabelaUso();
            $this->set( compact('lista_tabela_planos2') );

            $this->set( 'lista_tabela_planos3', null );
            if ($dados['Shop']['ativar_novos_planos'] == 'S') {
                $this->planos_lista = $this->PlanoShop->planoListar(3);
                $lista_tabela_planos3 = self::tabelaUso();
                $this->set( compact('lista_tabela_planos3') );
            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }


    private function tabelaUso()
    {

        $html = '<table class="table tabela-planos">';
        $html .= '<thead>';
        $html .= '<tr>';
 
        foreach ($this->planos_lista as $key => $plano) {

            foreach ($this->res_fatura as $fatura) ;

            $ativo= null;
            if ( $plano['PlanoShop']['id_plano'] == $this->id_plano) {
                $ativo = 'class="plano-ativo"';
            }
        
            $html .= '<th width="16.6%" '. $ativo .'>';
            $html .= '<span class="plano-nome">Plano '. $plano['PlanoShop']['id_plano'];

            if ($plano['PlanoShop']['id_plano'] <= 1) {

                $html .= '<span style="color:#F4FA58"> (GRÁTIS)</span>';
            }
                
            $html .= '</span>';

            if (!empty($plano['PlanoShop']['de_valor'])) {

                $html .= '<span class="plano-valor">';
                $html .= '<s>R$ ' . Tools::convertToDecimalBR($plano['PlanoShop']['de_valor']) . '</s>';
                $html .= '<small class="muted">R$</small> ' . Tools::convertToDecimalBR($plano['PlanoShop']['por_valor']);
 
            } else {

                $html .= '<span class="plano-valor">';
                $html .= '<small class="muted">R$</small> ' . Tools::convertToDecimalBR($plano['PlanoShop']['valor']);

            }
                
            $html .= '<small class="muted">/ mês</small>';
            $html .= '</span>';
            $html .= '</th>';

        }
            
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';


        //Inicio da linha
        $html .= '<tr>';

        foreach ($this->planos_lista as $key => $plano) {

            if ($plano['PlanoShop']['equipe_marketing'] == 'S') {
                $equipe = 'Equipe de Marketing';
                $icon = 'icon-ok';
            } else {
                $equipe = '<del> Equipe de Marketing</del>';
                $icon = 'icon-remove';
            }

            $html .= '<td>';
            $html .= '<i class="'. $icon .'" style="color:blue"></i> '. $equipe .' &nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Equipe de especialistas que vai ajudar na criação, análise e otimização de campanhas on-line, para que sua Loja Virtual possa vender sempre mais."></i>'; 
            $html .= '</td>';            

        }

        //Inicio da linha
        $html .= '<tr>';

        foreach ($this->planos_lista as $key => $plano) {

            if ($plano['PlanoShop']['produtos'] == 'ilimitado' ) {

                $html .= '<td><i class="icon-ok"></i> Produtos ilimitados &nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Limite de produtos ativos."></i></td>';
            
            } else {

                $html .= '<td><i class="icon-ok"></i> ' . Tools::formatTotal($plano['PlanoShop']['produtos']) . ' produtos &nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Limite de produtos ativos."></i></td>';
            
            }

        }

        $html .= '</tr>';


        //Inicio da linha
        $html .= '<tr>';
     
        foreach ($this->planos_lista as $key => $plano) {

            if ($plano['PlanoShop']['visitas'] == 'ilimitado' ) {
                
                $html .= '<td><i class="icon-ok"></i> Visitas ilimitadas &nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Limite de visitas mensal."></i></td>';
            
            } else {

                $html .= '<td><i class="icon-ok"></i> ' . Tools::formatTotal($plano['PlanoShop']['visitas']) . ' visitas &nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Limite de visitas mensal."></i></td>';

            }

        }

        $html .= '</tr>';

        //Inicio da linha
        $html .= '<tr>';

        foreach ($this->planos_lista as $key => $plano) {

            if ($plano['PlanoShop']['trafego'] >= 1024) {
                $html .= '<td><i class="icon-ok"></i> Tráfego ilimitado &nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Limite de transferência de dados mensal."></i></td>';
            } else {

                $html .= '<td><i class="icon-ok"></i> ' . Tools::convertToDecimalBR($plano['PlanoShop']['trafego'], 1) . ' GB tráfego &nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Limite de transferência de dados mensal."></i></td>';

            }

        }

        $html .= '</tr>';

        //Inicio da linha
        $html .= '<tr>';

        foreach ($this->planos_lista as $key => $plano) {

            $html .= '<td>';
            $html .= '<i class="icon-ok"></i> '. str_pad($plano['PlanoShop']['id_plano'], 2, "0", STR_PAD_LEFT);

            if ($plano['PlanoShop']['id_plano'] <= 1):
                $html .= ' Usuário';
            else:
                $html .= ' Usuários';
            endif;

            $html .= '&nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Usuários com acesso ao Painel de Controle."></i>';
            $html .= '</td>';

        }

        $html .= '</tr>';

        //Inicio da linha
        $html .= '<tr>';

        foreach ($this->planos_lista as $key => $plano) {

            $html .= '<td>';
            $html .= '<i class="icon-ok"></i> Fórum de Ajuda &nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Este é um fórum de discussão de usuário para usuário."></i>'; 
            $html .= '</td>';

        }

        $html .= '</tr>';

        //Inicio da linha
        $html .= '<tr>';

        foreach ($this->planos_lista as $key => $plano) {

            $html .= '<td>';
            $html .= '<i class="icon-ok"></i> Domínio próprio &nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Ative um domínio próprio (ex: www.suaempresa.com.br) para sua loja virtual e aumente a credibilidade."></i>'; 
            $html .= '</td>';

        }

        $html .= '</tr>';

        //Inicio da linha
        $html .= '<tr>';

        foreach ($this->planos_lista as $key => $plano) {

            if ($plano['PlanoShop']['equipe_suporte'] == 'S') {
                $equipe = 'Suporte Técnico';
                $icon = 'icon-ok';
            } else {
                $equipe = '<del> Suporte Técnico</del>';
                $icon = 'icon-remove';
            }

            $html .= '<td>';
            $html .= '<i class="'. $icon .'"></i> '. $equipe.' &nbsp;<i class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Time de especialistas para solucionar dúvidas durante a evolução da sua Loja Virtual."></i>'; 
            $html .= '</td>';

        }

        $html .= '</tr>';

        $html .= '</tbody>';
        $html .= '<tfoot>';
        $html .= '<tr>';

        foreach ($this->planos_lista as $key => $plano) {

            foreach ($this->res_fatura as $fatura) ;

            if ( $plano['PlanoShop']['id_plano'] == $this->id_plano) {

                $html .= '<td>';
                $html .= '<button class="btn disabled" disabled="disabled"> Plano atual</button>';
                $html .= '</td>';

            } elseif (isset( $fatura['ShopFatura']['id_plano'] ) && $plano['PlanoShop']['id_plano'] == $fatura['ShopFatura']['id_plano']) {

                $html .= '<td>';
                $html .= '<p class="alert">Existe uma cobrança emitida para este plano<br>
                       *O plano só será ativado após a identificação do pagamento.</p>';
                $html .= '<hr>';
                $html .= '<a href="/admin/conta/pagar/'. $fatura['ShopFatura']['id_fatura'] .'" class="btn btn-small btn-primary"><i class="icon-barcode icon-white"></i> Ver cobrança</a>';
                $html .= '<a href="/admin/conta/cancelar/'. $fatura['ShopFatura']['id_fatura'] .'" class="btn btn-small btn-danger"><i class="icon-remove icon-white"></i> Cancelar cobrança</a>';
                $html .= '</td>';
  
            } else {

                $html .= '<td>';
                $html .= '<a href="/admin/conta/plano/assinar/'. $plano['PlanoShop']['id_plano'] .'" class="btn btn-primary">Assinar</a>';
                $html .= '</td>';

            }

        }

        $html .= '</tr>';
        $html .= '</tfoot>';
        $html .= '</table>';

        return $html;

    }

    /**
     * Assinar Plano de loja virtual
     * @access public
     * @param String $id_shop
     * @return string
     */
    public function plano()
    {

        $date = new \DateTime(date('Y-m-d'));
        $date->add(new \DateInterval('P1M'));

        $this->set('data_mes_inicial', date('d/m/Y'));
        $this->data_mes_inicial = date('Y-m-d');

        if (date('d') == 30 || date('d') == 31) {

            $date->sub(new \DateInterval('P1D'));
            $cal_days_in_month = cal_days_in_month(CAL_GREGORIAN, $date->format('m'), $date->format('Y'));
            $this->set('data_mes_final', $date->format($cal_days_in_month . '/m/Y'));
            $this->data_mes_final = $date->format('Y-m-' . $cal_days_in_month);

            $date = new \DateTime($this->data_mes_final);
            $date->add(new \DateInterval('P1D'));

            $this->data_d = $date->format('d');
            $this->set('data_d', $this->data_d);

        } else {

            if ($date->format('L') == true && date('d-m') == '29-02') {

                /**
                 *
                 * Ano bisexto os dias subsequentes é dia 28
                 *
                 **/
                $date = new \DateTime($date->format('Y-m-d'));
                $date->sub(new \DateInterval('P1D'));
                $this->set('data_mes_final', $date->format('d/m/Y'));
                $this->data_mes_final = $date->format('Y-m-d');

                $this->data_d = $date->format('d');
                $this->set('data_d', $this->data_d);

            } else {

                $this->data_d = date('d');
                $this->set('data_d', $this->data_d);

                $date = new \DateTime($date->format('Y-m-d'));
                $date->sub(new \DateInterval('P1D'));

                $this->set('data_mes_final', $date->format('d/m/Y'));
                $this->data_mes_final = $date->format('Y-m-d');

            }

        }

        if ($this->request->is('post')) {

            try {

				$dados = $this->Shop->getFirstAll( $this->Session->read('id_shop') );


                /**
                 *
                 * Cancela a ultima fatura em aberto
                 *
                 **/
                $this->ShopFatura->updateAll(array(
                    'ShopFatura.situacao' => 3
                ), array(
                    'ShopFatura.situacao <=' => 2,
                    'ShopFatura.fatura_gerada' => 'MANUAL',
                    'ShopFatura.id_shop_default' => $this->Session->read('id_shop')
                ));

                /**
                 *
                 * Cancela a ultima fatura em aberto
                 *
                 **/
                $this->ShopFatura->updateAll(array(
                    'ShopFatura.situacao' => 5
                ), array(
                    'ShopFatura.id_plano' => $dados['Shop']['id_plano'],
                    'ShopFatura.situacao' => 2,
                    'ShopFatura.fatura_gerada' => 'AUTOMATICA',
                    'ShopFatura.id_shop_default' => $this->Session->read('id_shop')
                ));

				$this->plano = $this->PlanoShop->getFirstAll( $this->request->params['pass']['1'] );

                /**
                 *
                 * Calcula desconto fatura
                 *
                 **/
                $this->resultado_calculo = self::calcula_desconto($this->plano['PlanoShop']['valor']);

                if ($this->resultado_calculo < 0) {

                    //Insert crédito
                    $this->credito_fatura_futuro = abs($this->resultado_calculo);
                    $this->Session->write('credito_fatura', $this->credito_fatura_futuro);

                    $this->data = array(
                        'id_shop_default' => $this->Session->read('id_shop'),
                        'valor' => $this->credito_fatura_futuro
                    );

                    $this->ShopFaturaCredito->saveAll($this->data);

                } else {

                    $this->credito_fatura = ($this->plano['PlanoShop']['valor'] - $this->resultado_calculo);

                    if ($this->credito_fatura <= 0) {
                        $this->credito_fatura = null;
                    }

                }

                /**
                 *
                 * Gera id de referencia
                 *
                 **/
                $this->ShopFaturaReferencia->save(array(
                    'id_shop_default' => $this->Session->read('id_shop')
                ));

                $this->data = array(

                    'id_shop_default' => $this->Session->read('id_shop'),
                    'id_plano' => $this->plano['PlanoShop']['id_plano'],
                    'referencia' => $this->ShopFaturaReferencia->getInsertID(),
                    'valor' => $this->plano['PlanoShop']['valor'],
                    'desconto' => $this->credito_fatura,
                    'situacao' => 2,
                    'data_dia' => $this->data_d,
                    'data_mes_inicial' => $this->data_mes_inicial,
                    'data_mes_final' => $this->data_mes_final,
                    'periodicidade' => 'MENSAL',
                    'fatura_gerada' => 'MANUAL',
                    'token' => Tools::uniqid()

                );

                $this->ShopFatura->saveAll($this->data);

                if ($this->ShopFatura->getInsertID() > 0) {

                    return $this->redirect(array(
                        'controller' => $this->request->controller,
                        'action' => 'pagar',
                        $this->ShopFatura->getInsertID()
                    ));

                }

            } catch (\PDOException $e) {
                \Exception\VialojaDatabaseException::errorHandler($e);
            }

        }

        try {

            $conditions = array(
                'conditions' => array(
                    'ShopConta.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            if ($this->ShopConta->find('count', $conditions) <= 0) {

                $this->setMsgAlertWarning('Preencha os dados de cobrança abaixo para que o plano possa ser alterado.');

                return $this->redirect(array(
                    'controller' => $this->request->controller,
                    'action' => 'editar',
                    '?' => array(
                        'continue' => '/' . $this->request->controller . '/' . $this->action . '/' . $this->request->params['pass']['0'] . '/' . $this->request->params['pass']['1']
                    )

                ));

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

		if(!isset($this->request->params['pass']['1']) ){
			return $this->redirect( $this->referer() );
		}

		$plano = $this->PlanoShop->getFirstAll( $this->request->params['pass']['1'] );
        $this->set(compact('plano'));


        $this->configCSRFGuard();

    }

    private function calcula_desconto($valor_plano_novo = '')
    {

        try {

            /**
             *
             * filtro
             *
             **/
            $conditions = array(
                'fields' => array(
                    'ShopFatura.id_plano',
                    'ShopFatura.data_mes_inicial',
                    'ShopFatura.data_mes_final',
                    'ShopFatura.valor'
                ),
                'conditions' => array(
                    'ShopFatura.situacao' => 5,
                    'ShopFatura.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array(
                    'ShopFatura.id_fatura' => 'DESC',
                    'ShopFatura.created' => 'DESC'
                ),
                'limit' => 1
            );

            $dados = $this->ShopFatura->find('first', $conditions);

            $this->data_compra = $dados['ShopFatura']['data_mes_inicial'];
            $this->data_vencimento = $dados['ShopFatura']['data_mes_final'];
            $this->valor_fatura_atual = $dados['ShopFatura']['valor'];

            $calcula = new DescontoFatura();
            $calcula->setDataCompra($this->data_compra);
            $calcula->setDataVencimento($this->data_vencimento);
            $calcula->setValorPlanoAtual($this->valor_fatura_atual);
            $calcula->setValorPlanoNovo($valor_plano_novo);

            return $calcula->calcular();

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
