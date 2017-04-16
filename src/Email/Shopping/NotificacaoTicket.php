<?php

namespace Email\Shopping;
use Email\Shopping\Template as Template;
use Lib\Entity as Entity;

/**
 * Class NotificacaoTicket
 * @package Email\Shopping
 */
class NotificacaoTicket extends Entity {

    protected $text;
    protected $id;
    protected $hash;
    protected $nome;
    protected $nomeLoja;
    protected $linkLoja;
    protected $mensagem;
    protected $departamento;
    protected $prioridade;
    protected $status;
    protected $url;
    protected $msDetalhe;
    protected $funcao;
    protected $assunto;
    protected $resposta;
    protected $saudacaoAdmin = null;

    /** 
     * Informa o suporte sobre novo ticket
     * @access public
     * @return void
    */
    public function confirmeEnvioSuporte() {
            
        $this->funcao = __FUNCTION__;
        return Template::templateDefault($this->conteudoEmail(), $this->linkLoja);

    }

    /** 
     * Informa o usuario sobre o ticket foi enviado ao suporte
     * @access public
     * @return void
    */
    public function confirmeEnvioCliente() {
		
		$this->funcao = __FUNCTION__;
		return Template::templateDefault($this->conteudoEmail(), $this->linkLoja);

    }

    /** 
     * Informa o usuario sobre reposta do suporte
     * @access public
     * @return void
    */
    public function respostaAdmin() {

		$this->funcao = __FUNCTION__;
		return Template::templateDefault($this->conteudoEmail(), $this->linkLoja);

    }

    /** 
     * Informa ao suporte nova mensagem do usuario
     * @access public
     * @return void
    */
    public function respostaCliente() {

		$this->funcao = __FUNCTION__;
		return Template::templateDefault($this->conteudoEmail(), $this->linkLoja);

    }

    public function conteudoEmail()
    {
        
        if ($this->funcao == 'confirmeEnvioSuporte') {

            /**
            *
            * Envia confirmação novo ticket ao Admin
            *
            **/
            $this->saudacaoAdmin = ', o usuário';
            $this->assunto = 'Nova solicitação';
            $this->resposta = 'Abriu um novo Ticket.';
            $this->msDetalhe = 'Seguem os detalhes do ticket de solicitação:';

        } elseif ($this->funcao == 'confirmeEnvioCliente') {
            

            /**
            *
            * Envia confirmação novo ticket ao usuario
            *
            **/
            $this->saudacaoAdmin = '';
            $this->assunto  = 'Solicitação recebida';
            $this->resposta = 'Muito obrigado por entrar em contato com a ViaLoja Shopping.
                                <br />
                                Um de nossos atendentes responderá a sua demanda o mais breve possível.';

            $this->msDetalhe = 'Seguem os detalhes do seu ticket de solicitação:';

        } elseif ($this->funcao == 'respostaAdmin') {
            
            /**
            *
            * Resposta do admin para o usuario
            *
            **/
            $this->assunto = 'Ticket respondido';
            $this->resposta = 'Seu ticket foi respondido pelo nosso suporte, acesse o painel de controle para visualização do conteúdo.';
            $this->msDetalhe = 'Segue abaixo os detalhes para acompanhamento do chamado:';

        } elseif ($this->funcao == 'respostaCliente') {


            /**
            *
            * Resposta do usuario para o admin
            *
            **/
            $this->saudacaoAdmin = ', o usuário';
            $this->assunto = 'Ticket respondido';
            $this->resposta = 'Enviou uma nova interação, acesse o painel de controle para visualização do conteúdo.';
            $this->msDetalhe = 'Segue abaixo os detalhes para acompanhamento do chamado:';

        }


        $this->url = sprintf('http://%s/suporte/ticket/ticketid/%s', env('HTTP_HOST'), $this->hash);

        $this->text = '<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="width:100% !important; margin:0; padding:0; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
            <tr>
                <td bgcolor="#f7f7f7">                      
                    <!-- Tables Width -->
                    <table width="600" bgcolor="#f7f7f7" cellpadding="0" cellspacing="0" border="0" align="center" class="table">
                        <tr><td colspan="3" height="20" bgcolor="#f7f7f7"></td></tr>
                        <tr>
                            <td width="20"></td>
                            <!-- Title Here -->
                            <td width="560" valign="top" align="left" class="inside" style="font-size: 20px; color: #0080b7; font-weight: bold; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top;">
                                '. $this->assunto .'
                            </td>   
                            <!-- End of Title -->
                            
                            <td width="20"></td>
                        </tr>
                        <tr><td colspan="3" height="10" bgcolor="#f7f7f7"></td></tr>
                        <tr>
                            <td width="20"></td>
                            
                            <!-- Content Text Here -->
                            <td width="560" valign="top" align="left" class="inside" style="font-size: 13px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; line-height: 20px;">
                                <br />
                                Olá'. $this->saudacaoAdmin .' <span style="font-weight:bold;">'. $this->nome .'</span>, ('. $this->nomeLoja .')
                                <br />
                                <br />
                                '. $this->resposta .'
                                <br />
                                <br />
                                '. $this->msDetalhe .'
                                <br />
                                ------------------------------------------------------------------
                                <br />
                                <br />
                                <span style="font-weight:bold;">Ticket ID:</span> '. $this->id .'
                                <br />
                                <span style="font-weight:bold;">Assunto:</span> '. $this->mensagem .'
                                <br />
                                <span style="font-weight:bold;">Departamento:</span> '. $this->departamento .'
                                <br />
                                <span style="font-weight:bold;">Prioridade:</span> '. $this->prioridade .'
                                <br />
                                <span style="font-weight:bold;">Status do Ticket:</span> '. $this->status .'
                                <br />
                                <span style="font-weight:bold;">URL do Ticket:</span> <a href="'. $this->url .'">'. $this->url .'</a>
                                <br />
                                <br />
                                ------------------------------------------------------------------
                        
                            <td>
                        </tr>
                                    
                        <tr>
                            <td width="20"></td>
                            <td width="560" valign="top" align="left" class="inside" style="font-size: 12px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; line-height: 20px;">';
                                
                            if (isset($this->saudacaoAdmin)) {
                                $this->text .= '<br />
                                Obrigado por escolher a ViaLoja!
                                <br />
                                Estamos sempre contigo. Conte conosco!';
                            }

                            $this->text .= '<br />
                                <br />
                                Atenciosamente,<br />
                                Equipe ViaLoja
                            </td>
                        </tr>
                        
                        <tr><td colspan="3" height="15" bgcolor="#f7f7f7"></td></tr>
                    
                    </table>
                    <!-- End of Tables Width -->
                </td>
            </tr>
            <tr><td height="19" bgcolor="#f7f7f7"></td></tr>
            <tr><td height="1" bgcolor="#d7d7d7"></td></tr>
            <tr><td height="1" bgcolor="#ffffff"></td></tr>
        </table>    
        <!-- * End of Image 560x200 Module + Text Module * -->';

        return $this->text;

    }

}
