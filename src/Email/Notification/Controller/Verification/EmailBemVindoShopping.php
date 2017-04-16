<?php

namespace Email\Notification\Controller\Verification;
use Email\Template\DadosEmail;


/**
 * Class EmailBemVindoShopping
 * @package Email\Notification\Controller\Verification
 */
class EmailBemVindoShopping extends DadosEmail
{

    public function content()
    {

        $url_link = sprintf("%s/cliente/conta/validar/%s", VIALOJA_HTTP_HOST, $this->hash);

        $html = "Olá {$this->nome},

        É com muito prazer que lhe damos as boas vindas ao ViaLoja. Para completar o seu registo, por favor clique no seguinte link de ativação:

        <a href=\"{$url_link}\">{$url_link}</a>

        Por favor não hesite em contatar-nos pela nossa Central de Atendimento, para qualquer questão relecionada as Lojas participantes do Shopping.
        Divirta-se a utilizar o ViaLoja!

        Com os melhores cumprimentos.
        Central de Atendimento ViaLoja

        <a href=\"". VIALOJA_HTTP_HOST ."\">". VIALOJA_HTTP_HOST ."</a>";

        return $this->theme( Tools::nl2br( $html ) );

    }

}