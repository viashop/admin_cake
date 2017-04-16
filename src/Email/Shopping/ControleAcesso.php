<?php

namespace Email\Shopping;
use Email\Shopping\Template as Template;
use Lib\Entity as Entity;

/**
 * Class ControleAcesso
 * @package Email\Shopping
 */
class ControleAcesso extends Entity {

	protected $text;
    protected $nome;
    protected $lojaNome;
    protected $email;
    protected $senha;
    protected $hash;
    protected $urlLink;
    protected $linkLoja;
    protected $data;
    protected $ip;
    protected $aceitar;
    protected $recusar;	

    /**
     * Envia email para troca de senha
     * @param $hash
     * @param $nome
     * @access public
     * @return void
     */
    public function enviaEmailHash()
    {
	
		$this->urlLink = 'http://app'. env('HTTP_BASE') .'/public/senha-redefinir/'. $this->hash;

		$this->text = '<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="width:100% !important; margin:0; padding:0; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
			<tr>
				<td bgcolor="#f7f7f7">                      
					<!-- Tables Width -->
					<table width="600" bgcolor="#f7f7f7" cellpadding="0" cellspacing="0" border="0" align="center" class="table">
						<tr><td colspan="3" height="20" bgcolor="#f7f7f7"></td></tr>
						<tr>
							<td width="20"></td>
							
							<!-- Title Here -->
							<td width="560" valign="top" align="left" class="inside" style="font-size: 20px; color: #0080b7; font-weight: bold; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; margin-top:100px; ">
								Redefinição de senha
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
							Olá <span style="font-weight:bold;">'. $this->nome .'</span>, este email está sendo enviado pois alguém, possivelmente você, clicou no link "esqueci a minha senha".
							<br />
							<br />
							Para iniciar a redefinição da sua senha, clique no botão abaixo:
							<br />
							<br />

							<td>
						</tr>
						<tr>
							<td width="20"></td>
							<td width="560" valign="top" align="left" class="inside" style="font-size: 13px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top;">
								
								<!--[if mso]>
								<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="'. $this->urlLink .'" style="height:40px;v-text-anchor:middle;width:300px;" class="button" arcsize="10%" stroke="f" fillcolor="#8CB82B">
								<w:anchorlock/>
									<center style="color:#ffffff;font-family:sans-serif;font-size:16px;font-weight:bold;" class="button">
									  <span style="color:#ffffff;">Redefinir senha</span>
									</center>
								</v:roundrect>
								<![endif]-->
								<![if !mso]>
								<table cellspacing="0" cellpadding="0"> <tr> 
								  <td align="center" width="300" height="40" bgcolor="#8CB82B" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;" class="button">
									<a href="'. $this->urlLink .'" style="color: #ffffff; font-size:16px; font-weight: bold; font-family:sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block;">
									  Redefinir senha
									</a>
								  </td> 
								</tr>
								</table> 
								<![endif]>

							</td>
						</tr>
						<tr>
							<td width="20"></td>

							<td width="560" valign="top" align="left" class="inside" style="font-size: 11px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; ">
								<br/>
								Se não for possível redefinir sua senha clicando no botão acima, clique no link abaixo ou copie-o e cole-o na barra de endereços de seu navegador.
								<br/>
								<br/>
								
								<a href="'. $this->urlLink .'" style="font-size: 13px; font-family: Helvetica, Arial, sans-serif;">'. $this->urlLink .'</a>
							
							</td>
						</tr>
						<tr>
							<td width="20"></td>
							<td width="560" valign="top" align="left" class="inside" style="font-size: 13px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; line-height: 20px;">
								<br/>
								<br/>
								Se você não esqueceu sua senha, nem clicou no link "esqueci a minha senha", por favor desconsidere este e-mail.
								<br/>
								<br/>
								Esta confirmação deve ser feita em 24 horas, caso contrário o link acima não mais será válido. Passado o prazo de 24 horas, uma nova solicitação deverá ser refeita.
								<br/>
								<br/>
								Abaixo, encontram-se informações sobre o horário e o endereço IP da máquina de onde partiu esta solicitação.
								<br/>
								<br/>   
								<span style="font-weight:bold;">Data:</span> '. $this->data .'
								<br/>
								<span style="font-weight:bold;">IP:</span> '. $this->ip .'                          
							</td>
							<!-- End of Content Text -->
							
							<td width="20"></td>
						</tr>
							
						<tr>
							<td width="20"></td>
							<td width="560" valign="top" align="left" class="inside" style="font-size: 12px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top;">
								<br />
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

		return Template::templateDefault($this->text, $this->linkLoja);

    }

    /**
     * Envia resposta que a senha foi alteradaa
     * @param $hash
     * @param $nome
     * @param $email
     * @access public
     * @return void
     */
    public function enviaEmailResposta()
    {
    		
		//$this->senha = Tools::passwdCamuflar( $this->senha );
		$this->urlLink = 'http://app'. env('HTTP_BASE');

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
								Sua senha foi redefinida
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
								Olá <span style="font-weight:bold;">'. $this->nome .'</span>, sua nova senha foi redefinida com sucesso.
								<br />
								<br />
								Segue abaixo as informações de acesso:
								<br />
								<br />
								<span style="font-weight:bold;">Email:</span> '. $this->email .'
								<br/>
								<span style="font-weight:bold;">Senha:</span> '. $this->senha .'             
								<!-- End of Content Text -->
								<br/>
								<br/>
								Para fazer o login, acesse <a href="'. VIALOJA_APP_LOGIN .'">'. VIALOJA_APP_LOGIN .'</a>
							</td>    
								
							<td width="20"></td>
						</tr>
						
						<tr>
							<td width="20"></td>
							<td width="560" valign="top" align="left" class="inside" style="font-size: 12px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top;">
								<br />
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

		return Template::templateDefault($this->text, $this->linkLoja);

    }

    /**
     * Envia resposta que a senha foi alteradaa
     * @param $hash
     * @param $nome
     * @param $email
     * @access public
     * @return void
     */
    public function enviaEmailConvite()
    {
            
		//$this->senha = Tools::passwdCamuflar( $this->senha );
		$this->urlLink = 'http://app' . env('HTTP_BASE');

		$this->aceitar = $this->urlLink . '/public/convite-aceitar/'. $this->hash;
		$this->recusar = $this->urlLink . '/public/convite-recusar/'. $this->hash;

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
								Convite para '. $this->lojaNome .'
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

								Olá, o administrador da conta <span style="font-weight:bold;">'. $this->lojaNome .'</span> convidou você para fazer parte da conta e ter acesso as informações dela.

								<br />
								<br />
								Você pode usar os botões abaixo para aceitar ou recusar o convite:
								<br />
								<br />
								<span>
									<div style="text-align:center;">
										<a href="'. $this->aceitar .'" style="font-weight:bold; font-size: 16px;">Aceitar</a>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="'. $this->recusar .'" style="font-weight:bold; font-size: 16px;">Recusar</a> 
									</div>                                                                       
								</span>         
								<!-- End of Content Text -->
								<br/>
								<br/>
								Se você não sabe do que se trata. Você pode desconsiderar este e-mail ou clicar no botão recusar.
							</td>    
								
							<td width="20"></td>
						</tr>
						
						<tr>
							<td width="20"></td>
							<td width="560" valign="top" align="left" class="inside" style="font-size: 12px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top;">
								<br />
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

		return Template::templateDefault($this->text, $this->linkLoja);

    }



     /**
     * Envia email de reativação de conta
     * @param $hash
     * @param $email
     * @access public
     * @return void
     */
    public function enviaEmailReativarContaLoja()
    {
	
		$this->urlLink = 'http://app' . env('HTTP_BASE');

		$this->urlLink = $this->urlLink . '/public/conta-loja-reativar/'. $this->hash;

		$this->text = '<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="width:100% !important; margin:0; padding:0; border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
			<tr>
				<td bgcolor="#f7f7f7">                      
					<!-- Tables Width -->
					<table width="600" bgcolor="#f7f7f7" cellpadding="0" cellspacing="0" border="0" align="center" class="table">
						<tr><td colspan="3" height="20" bgcolor="#f7f7f7"></td></tr>
						<tr>
							<td width="20"></td>
							
							<!-- Title Here -->
							<td width="560" valign="top" align="left" class="inside" style="font-size: 20px; color: #0080b7; font-weight: bold; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; margin-top:100px; ">
								Reativação de Conta‏
							</td>   
							<!-- End of Title -->
							
							<td width="20"></td>
						</tr>
						<tr><td colspan="3" height="10" bgcolor="#f7f7f7"></td></tr>
						<tr>
							<td width="20"></td>
							
							<!-- Content Text Here -->
							<td width="560" valign="top" align="left" class="inside" style="font-size: 13px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; line-height: 20px;">
							Para reativar a conta, clique no botão abaixo:
							<br />
							<br />

							<td>
						</tr>
						<tr>
							<td width="20"></td>
							<td width="560" valign="top" align="left" class="inside" style="font-size: 13px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top;">
								
								<!--[if mso]>
								<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="'. $this->urlLink .'" style="height:40px;v-text-anchor:middle;width:300px;" class="button" arcsize="10%" stroke="f" fillcolor="#8CB82B">
								<w:anchorlock/>
									<center style="color:#ffffff;font-family:sans-serif;font-size:16px;font-weight:bold;" class="button">
									  <span style="color:#ffffff;">REATIVAR CONTA</span>
									</center>
								</v:roundrect>
								<![endif]-->
								<![if !mso]>
								<table cellspacing="0" cellpadding="0"> <tr> 
								  <td align="center" width="300" height="40" bgcolor="#8CB82B" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;" class="button">
									<a href="'. $this->urlLink .'" style="color: #ffffff; font-size:16px; font-weight: bold; font-family:sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block;">
									  Reativar Conta
									</a>
								  </td> 
								</tr>
								</table> 
								<![endif]>

							</td>
						</tr>
						<tr>
							<td width="20"></td>

							<td width="560" valign="top" align="left" class="inside" style="font-size: 11px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; ">
								<br/>
								Se não for possível reativar sua conta clicando no botão acima, clique no link abaixo ou copie-o e cole-o na barra de endereços de seu navegador.
								<br/>
								<br/>
								
								<a href="'. $this->urlLink .'" style="font-size: 13px; font-family: Helvetica, Arial, sans-serif;">'. $this->urlLink .'</a>
							
							</td>
						</tr>
						<tr>
							<td width="20"></td>
							<td width="560" valign="top" align="left" class="inside" style="font-size: 13px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top; line-height: 20px;">
								<br/>
								<br/>
								Se você não pediu para reativar sua conta, nem clicou no link "REATIVAR CONTA", por favor desconsidere este e-mail.
								<br/>
								<br/>
								Abaixo, encontram-se informações sobre o horário e o endereço IP da máquina de onde partiu esta solicitação.
								<br/>
								<br/>   
								<span style="font-weight:bold;">Data:</span> '. $this->data .'
								<br/>
								<span style="font-weight:bold;">IP:</span> '. $this->ip .'                          
							</td>
							<!-- End of Content Text -->
							
							<td width="20"></td>
						</tr>
							
						<tr>
							<td width="20"></td>
							<td width="560" valign="top" align="left" class="inside" style="font-size: 12px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top;">
								<br />
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

		return Template::templateDefault($this->text, $this->linkLoja);

    }

}
