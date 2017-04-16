<?php

namespace Email\Notification\Controller\Access;
use Email\Template\DadosEmail;


/**
 * Class EnviaEmailConvite
 * @package Email\Notification\Controller\Access
 */
class EnviaEmailConvite extends DadosEmail
{
    /**
     * Conteúdo do Assunto do email
     * @return string
     */
    public function content()
    {

    	//$this->senha = Tools::passwdCamuflar( $this->senha );

		$url_aceitar = sprintf('http://app%s/public/convite-aceitar/%s', env('HTTP_BASE'), $this->hash);
		$url_recusar = sprintf('http://app%s/public/convite-recusar/%s', env('HTTP_BASE'), $this->hash);

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
								Convite para {$this->lojaNome}
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

								Olá, o administrador da conta <span style=\"font-weight:bold;\">{$this->lojaNome}</span> convidou você para fazer parte da conta e ter acesso as informações dela.

								<br />
								<br />
								Você pode usar os botões abaixo para aceitar ou recusar o convite:
								<br />
								<br />
								<span>
									<div style=\"text-align:center;\">
										<a href=\"{$url_aceitar}\" style=\"font-weight:bold; font-size: 16px;\">Aceitar</a>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a href=\"{$url_recusar}\" style=\"font-weight:bold; font-size: 16px;\">Recusar</a>
									</div>
								</span>
								<!-- End of Content Text -->
								<br/>
								<br/>
								Se você não sabe do que se trata. Você pode desconsiderar este e-mail ou clicar no botão recusar.
								<br/>
								<br/>
								Abaixo, encontram-se informações sobre o horário e o endereço IP da máquina de onde partiu esta solicitação.
								<br/>
								<br/>
								<span style=\"font-weight:bold;\">Emitido:</span> ". strftime('%d de %B de %Y às ', strtotime('today')) . date('H:i:s') ."
								<br/>
								<span style=\"font-weight:bold;\">IP:</span> ". getenv("REMOTE_ADDR") ."
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