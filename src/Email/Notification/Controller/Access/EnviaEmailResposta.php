<?php

namespace Email\Notification\Controller\Access;
use Email\Template\DadosEmail;


/**
 * Class EnviaEmailResposta
 * @package Email\Notification\Controller\Access
 */
class EnviaEmailResposta extends DadosEmail
{


    /**
     * Conteúdo do Assunto do email
     * @return string
     */
    public function content()
    {

        //$this->senha = Tools::passwdCamuflar( $this->senha );

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
								Sua senha foi redefinida
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
								Olá <span style=\"font-weight:bold;\">{$this->nome}</span>, sua nova senha foi redefinida com sucesso.
								<br />
								<br />
								Segue abaixo as informações de acesso:
								<br />
								<br />
								<span style=\"font-weight:bold;\">Email:</span> {$this->email}
								<br/>
								<span style=\"font-weight:bold;\">Senha:</span> {$this->senha}
								<!-- End of Content Text -->
								<br/>
								<br/>
								Para fazer o login, acesse <a href=\"". VIALOJA_APP_LOGIN ."\">". VIALOJA_APP_LOGIN ."</a>
							</td>

							<td width=\"20\"></td>
						</tr>

						<tr>
							<td width=\"20\"></td>
							<td width=\"560\" valign=\"top\" align=\"left\" class=\"inside\" style=\"font-size: 12px; color: #525252; text-align: left; font-family: Helvetica, Arial, sans-serif; vertical-align: top;\">
								<br />
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

        return $this->theme($html);

    }

}