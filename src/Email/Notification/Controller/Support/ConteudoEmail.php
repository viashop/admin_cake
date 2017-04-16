<?php

namespace Email\Notification\Controller\Support;
use Email\Template\EntityDataMailTicket;


/**
 * Class ConteudoEmail
 * @package Email\Notification\Controller\Support
 */
class ConteudoEmail extends EntityDataMailTicket
{


    /**
     * Conteudo email de Tickets
     *
     * @param $nome_class
     * @return string
     */
    public function conteudoEmailTable($nome_class)
    {


        if ( strpos( $nome_class, 'ConfirmeEnvioSuporte' ) !== false ) {

            /**
            *
            * Envia confirmação novo ticket ao Admin
            *
            **/
            $saudacaoAdmin = ', o usuário';
            $assunto = 'Nova solicitação';
            $resposta = 'Abriu um novo Ticket.';
            $msDetalhe = 'Segue os detalhes do ticket de solicitação:';

        } elseif ( strpos( $nome_class, 'ConfirmeEnvioCliente' ) !== false ) {


            /**
            *
            * Envia confirmação novo ticket ao usuario
            *
            **/
            $saudacaoAdmin = '';
            $assunto  = 'Solicitação recebida';
            $resposta = 'Muito obrigado por entrar em contato com a ViaLoja Shopping.
                         <br />
                         Um de nossos atendentes responderá a sua demanda o mais breve possível.';

            $msDetalhe = 'Segue os detalhes do seu ticket de solicitação:';

        } elseif ( strpos( $nome_class, 'RespostaAdmin' ) !== false ) {

            /**
            *
            * Resposta do admin para o usuario
            *
            **/
            $assunto = 'Ticket respondido';
            $resposta = 'Seu ticket foi respondido pelo nosso suporte, acesse o painel de controle para visualização do conteúdo.';
            $msDetalhe = 'Segue abaixo os detalhes para acompanhamento do chamado:';

        } elseif ( strpos( $nome_class, 'RespostaCliente' ) !== false ) {


            /**
            *
            * Resposta do usuario para o admin
            *
            **/
            $saudacaoAdmin = ', o usuário';
            $assunto = 'Ticket respondido';
            $resposta = 'Enviou uma nova interação, acesse o painel de controle para visualização do conteúdo.';
            $msDetalhe = 'Segue abaixo os detalhes para acompanhamento do chamado:';

        }

        $url_link = sprintf('%s/suporte/ticket/ticketid/%s', VIALOJA_APP, $this->hash);

        $html = "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" style=\"width:100% !important; margin:0; padding:0; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;\">
            <tr>
                <td bgcolor=\"#f7f7f7\">
                    <!-- Tables Width -->
                    <table width=\"600\" bgcolor=\"#f7f7f7\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"table\">
                        <tr><td colspan=\"3\" height=\"20\" bgcolor=\"#f7f7f7\"></td></tr>
                        <tr>
                            <td width=\"20\"></td>
                            <!-- Title Here -->
                            <td width=\"560\" valign=\"top\" align=\"left\" class=\"inside\" style=\"font-size: 20px; color: #0080b7; font-weight: bold; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top;\">
                                {$assunto}
                            </td>
                            <!-- End of Title -->

                            <td width=\"20\"></td>
                        </tr>
                        <tr><td colspan=\"3\" height=\"10\" bgcolor=\"#f7f7f7\"></td></tr>
                        <tr>
                            <td width=\"20\"></td>

                            <!-- Content Text Here -->
                            <td width=\"560\" valign=\"top\" align=\"left\" class=\"inside\" style=\"font-size: 13px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; line-height: 20px;\">
                                <br />
                                Olá{$saudacaoAdmin} <span style=\"font-weight:bold;\">{$this->nome}</span>, ({$this->nomeLoja})
                                <br />
                                <br />
                                {$resposta}
                                <br />
                                <br />
                                {$msDetalhe}
                                <br />
                                ------------------------------------------------------------------
                                <br />
                                <br />
                                <span style=\"font-weight:bold;\">Ticket ID:</span> {$this->id}
                                <br />
                                <span style=\"font-weight:bold;\">Assunto:</span> {$this->mensagem}
                                <br />
                                <span style=\"font-weight:bold;\">Departamento:</span> {$this->departamento}
                                <br />
                                <span style=\"font-weight:bold;\">Prioridade:</span> {$this->prioridade}
                                <br />
                                <span style=\"font-weight:bold;\">Status do Ticket:</span> {$this->status}
                                <br />
                                <span style=\"font-weight:bold;\">URL do Ticket:</span> <a href=\"{$url_link}\">{$url_link}</a>
                                <br />
                                <br />
                                ------------------------------------------------------------------

                            <td>
                        </tr>

                        <tr>
                            <td width=\"20\"></td>
                            <td width=\"560\" valign=\"top\" align=\"left\" class=\"inside\" style=\"font-size: 12px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; line-height: 20px;\">";

                            if (isset($saudacaoAdmin)) {
                                $html .= "<br />
                                Obrigado por escolher a ViaLoja!
                                <br />
                                Estamos sempre contigo. Conte conosco!";
                            }

                            $html .= "<br />
                                <br />
                                Atenciosamente,<br />
                                Equipe ViaLoja
                            </td>
                        </tr>

                        <tr><td colspan=\"3\" height=\"15\" bgcolor=\"#f7f7f7\"></td></tr>

                    </table>
                    <!-- End of Tables Width -->
                </td>
            </tr>
            <tr><td height=\"19\" bgcolor=\"#f7f7f7\"></td></tr>
            <tr><td height=\"1\" bgcolor=\"#d7d7d7\"></td></tr>
            <tr><td height=\"1\" bgcolor=\"#ffffff\"></td></tr>
        </table>
        <!-- * End of Image 560x200 Module + Text Module * -->";

        return $html;

    }

}