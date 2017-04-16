<?php

namespace Email\Notification\Controller\Contact;
use Email\Template\DadosEmail;


/**
 * Class ContatoLoja
 * @package Email\Notification\Controller\Contact
 */
class ContatoLoja extends DadosEmail
{

    /**
     * @return string
     */
    public function contentSimple()
    {

        //ENVIA O EMAIL PARA O SITE
        $html = "
		<html>
            <body>
                <span style='color: #003399; font-size: 18px; font: arial, verdana, helvetica;'>

                Contato no site - ". env('HTTP_HOST') ."

                </span>
                <br /><br />

                <b>". mb_strtoupper( $this->nomeResponsavel ) ."</b><br />
                Este e-mail foi enviado através de formulário do site, para entrar em contato com o cliente, use os dados abaixo:<br /><br />
                ----------------------------------------------------------<br />

                Nome: <b>{$this->nome}</b><br /><br />
                Email: <b>{$this->email}</b><br /><br />
                Telefone: <b>{$this->telefone}</b><br /><br />
                Pedido: <b>{$this->pedido}</b><br /><br />
                Descrição: <b>". nl2br( $this->mensagem ) ."</b><br /><br />

                ----------------------------------------------------------<br /><br />

                <span style='color: #666; font-size: 11px; font: arial, verdana, helvetica;'>

                    Atenciosamente,<br />
                    Equipe ViaLoja.com<br />
                    IP de origem: ". getenv("REMOTE_ADDR") ."<br />
                    Emitido: ". strftime('%d de %B de %Y às ', strtotime('today')) . date('H:i:s') ."

                </span>
            </body>
		</html>";

        return $this->simple($html);

    }

}
