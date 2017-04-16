<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 28/09/16 às 15:36
 */

namespace Email\Config;

class SendMail extends AbstractPHPMailer implements ISendMail
{
    /**
     * Retorna o Metodo de Envio
     */
    public function sendMail()
    {
        return parent::sendMail();
    }

}