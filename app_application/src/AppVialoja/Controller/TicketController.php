<?php

use Lib\Tools;
use Lib\Validate;
use Respect\Validation\Validator as v;
use Lib\Blowfish;
use CSRF\CSRFGuard;
use WideImage\WideImage;


class TicketController extends AppController
{

    public $layout = 'painel_suporte';

    public $uses = array(
        'Cliente',
        'Ticket',
        'TicketAnegitxo',
        'ShopDominio',
        'Shop'
    );

    private $error = false;
    private $result;
    private $ok;
    private $key;
    private $configMail;
    private $dados;
    private $cipher;
    private $mensagem;
    private $diretorio;
    private $arr_arquivo;
    private $arquivo;
    private $anexo;
    private $original;
    private $ms_file;
    private $img_name;
    private $img_temp;
    private $path_extension;
    private $path;
    private $id;
    private $assunto;
    private $departamento;
    private $prioridade;
    private $status = 0;
    private $hash;
    private $remetente;
    private $ticket_parente_id;
    private $id_shop_default;
    private $datasource;

    /**
     * Pagina inicial.
     * @access public
     */
    public function index()
    {

        /**
         * Valida dominio de login entre dominios
         */
        if (isset($this->auto_login_dominio)) {

            $this->requestAction(
                array(
                    'controller' => 'ShopDominio',
                    'action' => 'validaDominioAutoLogin',
                    'controller_redirect' => $this->request->controller,
                    'dominio' => base64_encode($this->auto_login_dominio)
                )
            );

        }

    }

    /**
     * Get Nome do Cliente
     * @return mixed
     */
    public function obterNomeClienteTicketId()
    {
        return $this->Cliente->obterNomeCliente($this->params['named']['id']);
    }

    /**
     * Lista os tickets do usuario.
     * @access public
     */
    public function clientearea()
    {

        /**
         * Restinge usuario
         */
        self::restricaoArea();

        $this->set('title_for_layout', 'Cliente Área');


        try {

            $this->paginate = array(
                'fields' => array(
                    'Ticket.id',
                    'Ticket.id_shop_default',
                    'Ticket.departamento_id',
                    'Ticket.created',
                    'Ticket.ler',
                    'Ticket.assunto',
                    'Ticket.status',
                    'Ticket.prioridade',
                    'Ticket.hash',
                    '(CASE Ticket.status WHEN \'2\' THEN 1 WHEN \'1\' THEN 2 ELSE 0 END ) AS status'
                ),
                'conditions' => array(
                    'Ticket.id_shop_default' => $this->Session->read('id_shop'),
                    'Ticket.parente_id' => 0
                ),
                'order' => array(
                    'status' => 'asc',
                    'Ticket.created' => 'asc'
                ),
                'limit' => 15,
                'paramType' => 'querystring'
            );


            // Roda a consulta, já trazendo os resultados paginados
            $results = $this->paginate('Ticket');
            $this->set( compact('results'));

            $total = $this->Ticket->totalTicket($this->Session->read('id_shop'));
            $this->set(compact('total'));

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->configCSRFGuard();

    }

    /**
     * Restrição de pagina por nivel de usuário.
     * @access private
     * @return  string
     */
    private function restricaoArea()
    {

        if (isset($this->request->action) && $this->request->action !== 'clientearea') {

            if ($this->Session->read('cliente_nivel') <= 5) {
                return $this->redirect(array('controller' => $this->request->controller, 'action' => 'clientearea'));
            }

        }

    }

    /**
     * Lista os tickets.
     * @access public
     */
    public function adminarea()
    {

        /**
         * Restinge usuario
         */
        self::restricaoArea();

        $this->set('title_for_layout', 'Admin Área');


        try {

            define('ADMIN_AREA_SUPORTE', true);
            /**
             *
             * array filtro
             *
             **/
            if (isset($this->request->query['st'])) {

                $conditions = array(
                    'Ticket.parente_id' => 0,
                    'Ticket.status' => $this->request->query['st']
                );

                if ($this->request->query['st'] == 4) {

                    $conditions = array(
                        'Ticket.parente_id' => 0,
                        'Ticket.status != ' => 3
                    );

                }

            } elseif (isset($this->request->query['q'])) {

                $conditions = array(
                    'Ticket.parente_id' => 0,
                    'OR' => array(
                        'Ticket.assunto LIKE' => sprintf("'%'", Tools::clean($this->request->query['q'])),
                        'Ticket.mensagem LIKE' => sprintf("'%'", Tools::clean($this->request->query['q']))
                    )
                );

            } else {

                $conditions = array(
                    'Ticket.parente_id' => 0
                );

            }

            $conditions = array(
                'fields' => array(
                    'Ticket.id',
                    'Ticket.id_shop_default',
                    'Ticket.departamento_id',
                    'Ticket.created',
                    'Ticket.ler',
                    'Ticket.assunto',
                    'Ticket.status',
                    'Ticket.prioridade',
                    'Ticket.hash',
                    '(CASE Ticket.status WHEN \'2\' THEN 1 WHEN \'1\' THEN 2 ELSE 0 END ) AS status'

                ),
                'conditions' => $conditions,
                'order' => array(
                    'status' => 'asc',
                    'Ticket.created' => 'asc'
                ),
                'limit' => 25,
                'paramType' => 'querystring'
            );

            $this->paginate = $conditions;

            // Roda a consulta, já trazendo os resultados paginados
            $this->result = $this->paginate('Ticket');


            // Envia os dados pra view
            $this->set('results', $this->result);

            $total = $this->Ticket->totalTicket();
            $this->set(compact('total'));

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

        $this->configCSRFGuard();

    }

    /**
     * Cadastra o ticket de suporte.
     * @access public
     */
    public function enviarticket()
    {

        define('CKEDITOR', true);

        $this->set('title_for_layout', 'Enviar ticket');


        if ($this->request->is('get')) {

            $this->mensagem = '<b>Atenção!</b> O prazo de resposta é de até 24 horas, podendo demorar mais se o ticket necessitar da atenção de um administrador ou de outros setores, como o setor
	 		de pagamentos ou de desenvolvedores.';

            $this->setMsgAlertInfo($this->mensagem);

        }

        if ($this->request->is('post')) {

            $this->datasource = $this->Ticket->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/
                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
                    throw new \InvalidArgumentException(ERROR_PROCESS);
                }

                if (!v::numeric()->notBlank()->validate($this->request->data['departamento_id'])) {
                    throw new \InvalidArgumentException("<b>Atenção!</b> Informe o departamento do responsável.");
                }

                if (!v::notEmpty()->validate($this->request->data['assunto'])) {
                    throw new \NotFoundException("<b>Atenção!</b> Informe o assunto do ticket.");
                }

                if (!v::alnum()->notEmpty()->validate($this->request->data['assunto'])) {
                    throw new \InvalidArgumentException("<b>Atenção!</b> Informe somente texto no assunto do ticket.");
                }

                if (Tools::strlen($this->request->data['assunto']) < 3) {
                    throw new \InvalidArgumentException("<b>Atenção!</b> O assunto do seu ticket deve ter mais de 2 caracteres.");
                }

                if (!v::numeric()->notBlank()->validate($this->request->data['prioridade'])) {
                    throw new \InvalidArgumentException("<b>Atenção!</b> Informe a prioridade do ticket.");
                }

                if (!v::notEmpty()->validate($this->request->data['mensagem'])) {
                    throw new \NotFoundException("<b>Atenção!</b> Informe a mensagem do ticket.");
                }

                $this->hash = sha1(Tools::uniqid());
                /**
                 *
                 * array filtro
                 *
                 **/
                $conditions = array(
                    'conditions' => array(
                        'Ticket.hash' => $this->hash
                    )
                );

                /**
                 *
                 * verifico se o Ticket existe
                 *
                 **/
                if ($this->Ticket->find('count', $conditions) > 0) {
                    throw new \Exception\VialojaOverflowException("<b>Atenção!</b> Ticket duplicado, para visualizar este ticket <a href='". VIALOJA_APP ."/ticket/clientearea'>clique aqui.</a>");
                }

                /**
                 *
                 * Salva ticket no db
                 *
                 **/
                $data = array(
                    'departamento_id' => $this->request->data['departamento_id'],
                    'id_shop_default' => $this->Session->read('id_shop'),
                    'id_cliente' => $this->Session->read('id_cliente'),
                    'prioridade' => $this->request->data['prioridade'],
                    'assunto' => $this->request->data['assunto'],
                    'mensagem' => Tools::htmlentitiesUTF8($this->request->data['mensagem']),
                    'ip' => $this->request->clientIp(),
                    'hash' => $this->hash
                );

                $this->ok = $this->Ticket->saveAll($data);

                if ($this->Ticket->getLastInsertId() > 0) {

                    $this->mensagem = 'Seu ticket foi criado com sucesso.
            		Foi enviado para você um e-mail com as informações de seu ticket.
            		<br />Se desejar, você pode visualizar este ticket agora.
            		<a href="'. VIALOJA_APP .'/suporte/ticket/ticketid/' . $this->hash . '">Clique aqui para visualizar!</a>';

                    $this->setMsgAlertSuccess($this->mensagem);

                    /**
                     * Variaveis para aviso por email
                     **/
                    $this->id = $this->Ticket->getLastInsertId();
                    $this->assunto = $this->request->data['assunto'];
                    $this->departamento = $this->request->data['departamento_id'];
                    $this->prioridade = $this->request->data['prioridade'];
                    $this->status = 0;

                    $this->arr_arquivo = isset($this->request->data['Ticket']['file']) ? $this->request->data['Ticket']['file'] : null;

                    foreach ($this->arr_arquivo as $this->key => $this->arquivo) {

                        if ($this->key < 5) {

                            /**
                             * Upload anexo
                             **/
                            $this->anexo = self::uploadAnexo($this->Session->read('id_shop'));

                            $data = array(
                                'id_ticket_default' => $this->Ticket->getLastInsertId(),
                                'anexo' => $this->anexo,
                            );

                            if (isset($this->anexo)) {
                                $this->TicketAnexo->saveAll($data);
                            }

                        }

                    }

                    /**
                     * Envia o email de aviso
                     */
                    self::avisoEmail();

                }

                if (is_bool($this->ok) && $this->ok === false) {
                    throw new \RuntimeException(ERROR_PROCESS);
                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();

                $this->setMsgAlertError(ERROR_PROCESS);

                $this->error = true;

                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\NotFoundException $e) {

                $this->error = true;

            } catch (\InvalidArgumentException $e) {

                $this->error = true;

            } catch (\Exception\VialojaOverflowException $e) {

                $this->error = true;

            } catch (\RuntimeException $e) {

                $this->error = true;

            } catch (\LogicException $e) {

                \Exception\VialojaInvalidLogicException::errorHandler($e);

            } finally {

                if ($this->error === true) {

                    $this->arr_arquivo = isset($this->request->data['Ticket']['file']) ? $this->request->data['Ticket']['file'] : null;

                    foreach ($this->arr_arquivo as $this->arquivo) {

                        if (isset($this->arquivo['name']) && v::notEmpty()->validate($this->arquivo['name'])) {
                            $this->ms_file = '<br /><br /><b>Por favor, selecione o anexo novamente.</b>';
                        }

                    }

                    $this->set('erro', true);

                }

            }

        }

        $this->configCSRFGuard();

    }


    /**
     * Visualiza o ticket de suporte.
     * @access public
     */
    public function ticketid()
    {

        define('CKEDITOR', true);

        $this->set('title_for_layout', 'Ticket de suporte');


        $this->cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);

        try {

            /**
             *
             * Mensagem de informação
             *
             **/
            if ($this->request->is('get')) {

                $this->mensagem = '<b>Atenção!</b> O prazo de resposta é de até 24 horas,
		 		podendo demorar mais se o ticket necessitar da atenção
		 		de um administrador ou de outros setores, como o setor
		 		de pagamentos ou de desenvolvedores.';

                $this->setMsgAlertInfo($this->mensagem);

            }

            /**
             *
             * Mostra os dados via get
             *
             **/
            if (!Validate::isSha1($this->request->params['pass']['0'])) {
                throw new \InvalidArgumentException("Esta é uma chave inválida!");
            }

            $this->dados = $this->Ticket->filtroTicketHash($this->request->params['pass']['0']);

            if (!v::notEmpty()->validate($this->dados)) {

                $this->setMsgAlertError('Ticket não encontado!');

                if ($this->Session->read('cliente_nivel') <= 5) {
                    return $this->redirect(array('controller' => $this->request->controller, 'action' => 'clientearea'));
                } else {
                    return $this->redirect(array('controller' => $this->request->controller, 'action' => 'adminarea'));
                }

            }

            $this->set('id', $this->dados['Ticket']['id']);
            $this->set('departamento_id', $this->dados['Ticket']['departamento_id']);
            $this->set('id_cliente', $this->dados['Ticket']['id_cliente']);
            $this->set('created', $this->dados['Ticket']['created']);
            $this->set('assunto', $this->dados['Ticket']['assunto']);
            $this->set('status', $this->dados['Ticket']['status']);
            $this->set('prioridade', $this->dados['Ticket']['prioridade']);
            $this->set('mensagem', $this->dados['Ticket']['mensagem']);
            $this->set('id_ticket_default', $this->dados['TicketAnexo']['id_ticket_default']);
            $this->set('anexo', $this->dados['TicketAnexo']['anexo']);
            $this->set('ip', $this->dados['Ticket']['ip']);
            $this->set('parente_id', $this->cipher->encrypt($this->dados['Ticket']['id']));
            $this->set('id_shop_default', $this->cipher->encrypt($this->dados['Ticket']['id_shop_default']));

            $resposta_ticket = $this->Ticket->filtroTicketHashResposta($this->dados['Ticket']['id']);

            $this->set(compact('resposta_ticket'));

            /**
             * Pega os dados do usuario
             */
            $this->result = $this->Cliente->getIdCliente($this->dados['Ticket']['id_cliente']);

            $this->set('nome', $this->result['Cliente']['nome']);

            $this->set('nome_dominio', $this->ShopDominio->getDominioPrincipal($this->dados['Ticket']['id_shop_default']));

        } catch (\PDOException $e) {

            $this->set('erro', true);
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\InvalidArgumentException $e) {

            /**
             * seta a mensagem na div alert
             **/
            $this->setMsgAlertError($e->getMessage());

        } finally {

            $this->set('erro', true);
        }

        /**
         * Recebe os dados via post
         */
        self::getPostTicketid();

        $this->configCSRFGuard();

    }


    /**
     * Pega Posts enviados da URL TicketID
     *
     * $this->remetente = 1 para reposta do atendente, padrao é 0 para cliente
     *
     * $this->status = 0 => Ticket enviado
     * $this->status = 1 => Resposta do atendente
     * $this->status = 2 => Resposta do cliente
     * $this->status = 3 => Ticket fechado
     *
     **/
    public function getPostTicketid()
    {

        if ($this->request->is('post')) {

            $this->datasource = $this->Ticket->getDataSource();

            try {

                $this->datasource->begin();

                /**
                 *
                 * Verifica o token CSRFGuard
                 *
                 **/
                $CSRFGuard = new CSRFGuard();

                if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

                    throw new \InvalidArgumentException(ERROR_PROCESS);
                }

                if (isset($this->request->data['fechar_ticket'])) {

                    /**
                     *
                     * Fecha o ticket
                     *
                     **/
                    $this->Ticket->alteraStatus(3, $this->request->pass[0]);

                    if (is_bool($this->ok) && $this->ok === true) {

                        /**
                         *
                         * seta a mensagem na div alert
                         *
                         **/
                        $this->mensagem = '<b>Atenção!</b> Ticket encerrado com sucesso, qualquer necessidade fique a vontade para reabrir ou abrir um novo.';

                        $this->setMsgAlertSuccess($this->mensagem);

                    } else {

                        throw new \RuntimeException('<b>Atenção!</b> Houve um erro ao tentar fechar o Ticket, por favor tente novamente.');

                    }

                } else {

                    if ($this->Session->read('cliente_nivel') > 3) {

                        $this->remetente = 1;
                        if (isset($this->request->data['status'])) {
                            $this->status = $this->request->data['status']; //Reposta do atendente = 1
                        } else {
                            $this->status = 1; //Reposta do atendente = 1
                        }

                    } else {
                        $this->remetente = 0;
                        $this->status = 2; //Reposta do cliente =2
                    }

                    if (!v::notEmpty()->validate($this->request->data['mensagem'])) {
                        throw new \NotFoundException("<b>Atenção!</b> Informe a mensagem do ticket!");
                    }

                    $this->ticket_parente_id = $this->cipher->decrypt($this->request->data['parente_id']);
                    $this->id_shop_default = $this->cipher->decrypt($this->request->data['id_shop_default']);

                    /**
                     * Altera o status
                     **/
                    $this->Ticket->alteraStatus($this->status, $this->request->pass[0]);

                    /**
                     * Salva ticket no db
                     **/
                    $data = array(
                        'departamento_id' => $this->request->data['departamento_id'],
                        'parente_id' => $this->ticket_parente_id,
                        'id_shop_default' => $this->id_shop_default,
                        'id_cliente' => $this->Session->read('id_cliente'),
                        'remetente' => $this->remetente,
                        'mensagem' => Tools::htmlentitiesUTF8($this->request->data['mensagem']),
                        'ip' => $this->request->clientIp(),
                        'hash' => $this->request->pass[0]
                    );

                    $this->ok = $this->Ticket->saveAll($data);

                    if ($this->Ticket->getLastInsertId() > 0) {

                        $this->mensagem = 'Seu ticket foi enviado com sucesso.';

                        $this->setMsgAlertSuccess($this->mensagem);

                        /**
                         * Variaveis para aviso por email
                         **/
                        $this->id = $this->ticket_parente_id;
                        $this->assunto = $this->request->data['assunto'];
                        $this->departamento = $this->request->data['departamento_id'];
                        $this->prioridade = $this->request->data['prioridade'];
                        $this->hash = $this->request->pass[0];

                        $this->arr_arquivo = isset($this->request->data['Ticket']['file']) ? $this->request->data['Ticket']['file'] : null;

                        foreach ($this->arr_arquivo as $this->key => $this->arquivo) {

                            if ($this->key < 5) {

                                /**
                                 * Upload anexo
                                 **/
                                $this->anexo = self::uploadAnexo($this->id_shop_default);

                                $data = array(
                                    'id_ticket_default' => $this->Ticket->getLastInsertId(),
                                    'anexo' => $this->anexo,
                                );

                                if (isset($this->anexo)) {
                                    $this->TicketAnexo->saveAll($data);
                                }

                            }

                        }

                        /**
                         * Envia o email
                         */
                        self::avisoEmail();

                    }

                    if (is_bool($this->ok) && $this->ok === false) {
                        throw new \RuntimeException(ERROR_PROCESS);
                    }

                }

                $this->datasource->commit();

            } catch (\PDOException $e) {

                $this->datasource->rollback();

                $this->error = true;

                $this->setMsgAlertError(ERROR_PROCESS);

                \Exception\VialojaDatabaseException::errorHandler($e);

            } catch (\NotFoundException $e) {

                $this->error = true;

            } catch (\InvalidArgumentException $e) {

                $this->error = true;

            } catch (\RuntimeException $e) {

                $this->error = true;

            } catch (\LogicException $e) {

                \Exception\VialojaInvalidLogicException::errorHandler($e);

            } finally {

                if ($this->error === true) {

                    $this->arr_arquivo = isset($this->request->data['Ticket']['file']) ? $this->request->data['Ticket']['file'] : null;

                    foreach ($this->arr_arquivo as $this->arquivo) {

                        if (isset($this->arquivo['name']) && v::notEmpty()->validate($this->arquivo['name'])) {
                            $this->ms_file = '<br /><br /><b>Por favor, selecione o anexo novamente.</b>';
                        }

                    }

                    $this->set('erro', true);

                }

            }

        }

    }

    /**
     * Recupera Anexo do TICKET
     * Usado na Views
     */
    public function ticketAnexoGetAll() {

        try {

            if (!v::numeric()->notBlank()->validate($this->params['named']['id'])) {
                throw new \LogicException("Valor obrigatório: Informe o id do tipo INT", E_USER_WARNING);
            }

            $conditions = array(
                'fields' => array(
                    'Ticket.id_shop_default',
                    'TicketAnexo.anexo'
                ),
                'conditions' => array(
                    'TicketAnexo.id_ticket_default' => $this->params['named']['id']
                ),

                'joins' => array(
                    array('table' => 'ticket',
                        'alias' => 'Ticket',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Ticket.id = TicketAnexo.id_ticket_default',
                        )
                    )

                ),

            );

            return $this->TicketAnexo->find('all', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Enviao email do ticket de suporte.
     * @access private
     */
    private function avisoEmail()
    {

        $this->result = $this->Ticket->idTicketEmailRemetente($this->hash);

        $this->dados = $this->Cliente->getIdCliente($this->dados['Ticket']['id_cliente']);
        $this->loja_nome = $this->Shop->getNomeLojaShop($this->dados['Cliente']['id_shop']);

        $this->configMail = new \Email\Config\SendMail();

        /**
         * configurações de email suporte
         **/
        $this->configMail->setFrom(base64_decode(EMAIL_SUPORTE));
        //$this->configMail->setUsername( base64_decode( EMAIL_SUPORTE ) );
        //$this->configMail->setPassword( base64_decode( PASS_EMAIL_SUPORTE ) );


        if ($this->request->action == 'enviarticket') {

            /**
             * Envia um email de aviso para o Usuário
             */
            $cEnvioCliente = new \Email\Notification\Controller\Support\ConfirmeEnvioCliente();

            /**
             * Abstração de Metodos da Classe EntityDataMailTicket
             */
            $cEnvioCliente = self::getSettersAbstratc($cEnvioCliente);

            $this->configMail->setAddress(base64_decode(EMAIL_ADMIN))
                ->setSubject(sprintf('NOVO [Ticket ID %s] %s', $this->id, $this->assunto))
                ->setMessage($cEnvioCliente->content())
                ->sendMail();

            /**
             * Envia um email de aviso para o suporte
             */
            $cEnvioSuporte = new \Email\Notification\Controller\Support\ConfirmeEnvioSuporte();

            /**
             * Abstração de Metodos da Classe EntityDataMailTicket
             */
            $cEnvioSuporte = self::getSettersAbstratc($cEnvioSuporte);

            $this->configMail->setAddress($this->Session->read('cliente_email'))
                ->setSubject(sprintf('[Ticket ID %s] %s', $this->id, $this->assunto))
                ->setMessage($cEnvioSuporte->content())
                ->sendMail();


        } elseif ($this->request->action == 'ticketid') {

            if ($this->Session->read('cliente_nivel') <= 5) {

                /**
                 * Informa o ao usuário que o ticket foi respondido pelo suporte
                 **/
                $resp_admin = new \Email\Notification\Controller\Support\RespostaAdmin();

                /**
                 * Abstração de Metodos da Classe EntityDataMailTicket
                 */
                $resp_admin = self::getSettersAbstratc($resp_admin);

                $this->configMail->setAddress($this->dados['Cliente']['email'])
                    ->setSubject(sprintf('[Ticket ID %s] %s', $this->id, $this->assunto))
                    ->setMessage($resp_admin->content())
                    ->sendMail();

            } else {

                /**
                 * Informa o ao suporte que o ticket foi respondido pelo o usuário
                 */
                $resp_cliente = new \Email\Notification\Controller\Support\RespostaCliente();

                /**
                 * Abstração de Metodos da Classe EntityDataMailTicket
                 */
                $resp_cliente = self::getSettersAbstratc($resp_cliente);

                $this->configMail->setAddress(base64_decode(EMAIL_ADMIN))
                    ->setSubject(sprintf('RESPONDIDO [Ticket ID %s] %s', $this->id, $this->assunto))
                    ->setMessage($resp_cliente->content())
                    ->sendMail();


            }

        }

    }


    /**
     * Abstrai os Metodos para uso de envio de dados Para o Email
     *
     * @param $obj
     * @return mixed
     */
    private function getSettersAbstratc($obj)
    {

        $obj = (object)$obj;

        $obj->setHash($this->hash)
            ->setId($this->id)
            ->setMensagem($this->assunto)
            ->setNome($this->dados['Cliente']['nome']);

        if (isset($this->loja_nome)) {
            $obj->setNomeLoja($this->loja_nome);
        } else {
            $obj->setNomeLoja('None');
        }

        $obj->setDepartamento(Tools::getDepartamentoTicket($this->departamento))
            ->setPrioridade(Tools::getPrioridadeTicket($this->prioridade))
            ->setStatus(Tools::getStatusTicket($this->status, true));

        return $obj;

    }

    /**
     * Move o arquivo para a pasta de destino.
     * @access private
     * @param null $id_shop_default
     * @return null
     */
    private function uploadAnexo($id_shop_default = null)
    {

        if (!v::notEmpty()->validate($this->arquivo['name'])) {
            return null;
        }

        if (!v::numeric()->notBlank()->validate($id_shop_default)) {
            throw new \LogicException("Informe o ID do Shop", E_USER_ERROR);
        }

        $this->diretorio = CDN_ROOT_UPLOAD . $id_shop_default . DS . 'anexos' . DS . 'suporte' . DS . 'ticket' . DS;

        /**
         *
         * Verifica se o diretorio existe or cria
         *
         **/
        Tools::createFolder($this->diretorio);

        $this->img_name = $this->arquivo['name'];
        $this->img_temp = $this->arquivo['tmp_name'];

        if (!Validate::isMaxSize($this->arquivo['size'], 2)) {
            return false;
        }

        if (!Validate::isImage($this->arquivo)) {
            throw new \InvalidArgumentException("<b>Atenção!</b> Há um erro neste arquivo $this->img_name não foi possível efetuar o upload.");
        }

        $this->path_extension = pathinfo($this->img_name, PATHINFO_EXTENSION);
        $this->path = Validate::checkNameFile($this->img_name, $this->diretorio);

        if (isset($this->path)) {

            move_uploaded_file($this->img_temp, $this->diretorio . $this->path);
            $this->original = WideImage::load($this->diretorio . $this->path);
            $this->original->resize(1280, 960, 'outside')->saveToFile($this->diretorio . $this->path);
            $this->original->resize(32, 32, 'outside')->saveToFile($this->diretorio . 'thumb-' . $this->path);
            $this->original->destroy();

            return $this->path;

        } else {
            return null;
        }

    }

}
