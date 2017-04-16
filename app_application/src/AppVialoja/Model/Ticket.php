<?php

use Lib\Validate;
use Respect\Validation\Validator as v;




/**
 * Class Ticket
 */
class Ticket extends AppModel
{

    /**
     * @var string
     */
    public $name = 'Ticket';
    /**
     * @var string
     */
    public $useTable = 'ticket';
    /**
     * @var string
     */
    public $useDbConfig = 'vialoja_suporte';


    /**
     * @var array
     */
    public $components = array('Paginator');


    /**
     * Pega o Id do Cliente via Hash
     * @param $hash
     * @return array|null
     */
    public function idTicketEmailRemetente($hash)
    {
        try {

            if (!Validate::isSha1($hash)) {
                throw new \LogicException('Hash SHA1 Inválido', E_USER_ERROR);
            }

            /**
             *
             * filtra o email do usuario via hash
             * para enviar aviso de email
             *
             **/
            $conditions = array(

                'fields' => array(
                    'Ticket.id_cliente'
                ),

                'conditions' => array(
                    'Ticket.remetente' => 0,
                    'Ticket.hash' => (string)$hash
                ),

                'order' => array(
                    'Ticket.id' => 'desc'
                ),

                'limit' => 1

            );

            /**
             *
             * retorna o array da table Ticket
             *
             **/
            return $this->find('first', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }


    /**
     * Filtra o Ticket
     * @param string $hash
     * @return array|null
     */
    public function filtroTicketHash($hash = '')
    {

        try {

            if (!Validate::isSha1($hash)) {
                throw new \LogicException('Hash SHA1 Inválido', E_USER_ERROR);
            }

            /**
             *
             * array filtro ticket
             *
             **/
            $conditions = array(
                'fields' => array(
                    'Ticket.id',
                    'Ticket.departamento_id',
                    'Ticket.id_shop_default',
                    'Ticket.id_cliente',
                    'Ticket.parente_id',
                    'Ticket.assunto',
                    'Ticket.status',
                    'Ticket.prioridade',
                    'Ticket.ler',
                    'Ticket.remetente',
                    'Ticket.mensagem',
                    'Ticket.ip',
                    'Ticket.hash',
                    'Ticket.created',
                    'Ticket.modified',
                    'TicketAnexo.id_ticket_default',
                    'TicketAnexo.anexo'
                ),
                'conditions' => array(
                    'Ticket.hash' => (string)$hash,
                    'Ticket.parente_id' => 0
                ),

                'joins' => array(
                    array('table' => 'ticket_anexo',
                        'alias' => 'TicketAnexo',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Ticket.id = TicketAnexo.id_ticket_default',
                        )
                    )

                ),

                'limit' => 1
            );

            return $this->find('first', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }


    /**
     * Resposta Ticket
     * @param $id
     * @return array|null
     */
    public function filtroTicketHashResposta($id)
    {
        try {

            if (!v::numeric()->notBlank()->validate($id)) {
                throw new \LogicException('Parametro do tipo numérico invalido', E_USER_ERROR);
            }

            /**
             *
             * array filtro ticket resposta
             *
             **/
            $conditions = array(
                'fields' => array(
                    'Ticket.id',
                    'Ticket.departamento_id',
                    'Ticket.id_shop_default',
                    'Ticket.id_cliente',
                    'Ticket.parente_id',
                    'Ticket.assunto',
                    'Ticket.status',
                    'Ticket.prioridade',
                    'Ticket.ler',
                    'Ticket.remetente',
                    'Ticket.mensagem',
                    'Ticket.ip',
                    'Ticket.hash',
                    'Ticket.created',
                    'Ticket.modified',
                    'TicketAnexo.id_ticket_default',
                    'TicketAnexo.anexo'
                ),
                'conditions' => array(
                    'Ticket.parente_id' => (int)$id
                ),
                'group' => array('Ticket.id'),

                'joins' => array(
                    array('table' => 'ticket_anexo',
                        'alias' => 'TicketAnexo',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Ticket.id = TicketAnexo.id_ticket_default',
                        )
                    )

                )

            );

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Altera o Status do Ticket
     *
     * 0 => Ticket enviado
     * 1 => Resposta do atendente
     * 2 => Resposta do cliente
     * 3 => Ticket fechado
     *
     * @param $status
     * @param $hash
     */
    public function alteraStatus($status, $hash)
    {
        try {

            if (!v::numeric()->notBlank()->validate($status)) {
                throw new \LogicException('Parametro do tipo numérico invalido', E_USER_ERROR);
            }

            if (!Validate::isSha1($hash)) {
                throw new \LogicException('Parametro do tipo SHA1 invalido', E_USER_ERROR);
            }

            $this->updateAll(
                array(
                    'Ticket.status' => $status
                ), array(
                    'Ticket.hash' => $hash
                )
            );

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }


    /**
     * @param string $id_shop id da Loja Shop
     * @return array|null
     */
    public function totalTicket($id_shop = '')
    {

        try {

            if (v::numeric()->notBlank()->validate($id_shop)) {

                $conditions = array(
                    'conditions' => array(
                        'Ticket.id_shop_default' => $id_shop,
                        'Ticket.parente_id' => 0,
                        'Ticket.status <= ' => 2
                    )
                );

            } else {

                $conditions = array(
                    'conditions' => array(
                        'Ticket.parente_id' => 0,
                        'Ticket.status <= ' => 2
                    )
                );

            }

            return $this->find('count', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
