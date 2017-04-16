<?php

namespace Exception;
use Exception\VialojaExceptionCore as VialojaExceptionCore;
use Lib\ConfigPHPMailer as ConfigPHPMailer;
use DateTime;

class VialojaApiCPanelException extends \Exception
{

	public static function displayError($m,$l,$f)
	{
		
		echo "Um erro na API do CPanel ocorreu.<br />";
		echo "Número da linha: ". $l."<br />";
		echo "Nome Do Arquivo: ". $f."<br />";
		echo "Descrição do erro: ". $m;
		die;

		if (strpos($e, 'curl_exec') !== false) {

			if (strpos($e, 'host') !== false) {		
				$error = '<b>Host</b> de acesso a API CPanel inválido.';
			} elseif (strpos($e, 'Failed') !== false) {				
				$error = '<b>Username</b> de acesso a API CPanel inválido.';
			} elseif (strpos($e, 'Access denied') !== false) {				
				$error = '<b>Password</b> de acesso a API CPanel inválido.';
			} else {
				$error = 'Houve um erro nas configurações da API do CPanel.<br />' . PHP_EOL;
				$error .= $e;
			}
			
			$date = new DateTime( date('Y-m-d H:i:s')  );                           
			$configEmail = new \ConfigPHPMailer();
			
			$messagem = "Error: {$error} -- Date: ". $date->format( 'Y-m-d H:i:s' );

			$configEmail->setHost( base64_decode( HOST_AUTENTICACAO_GMAIL ) );
			$configEmail->setPort(587);
			$configEmail->setSmtpSecure('tls');
			$configEmail->setSmtpAuth (true);
			$configEmail->setUsername( base64_decode( EMAIL_AUTENTICACAO_GMAIL ) );
			$configEmail->setFrom('noreply@vialoja.com.br');
			$configEmail->setPassword( base64_decode( PASS_AUTENTICACAO_GMAIL ) );		
			$configEmail->setFromName('ViaLoja Shopping');
			$configEmail->setEndereco('tecnologia@vialoja.com.br');
			$configEmail->setAddBCC('wsduarte@outlook.com');
			$configEmail->setAssunto('[Urgente] Error: API CPanel');
			$configEmail->setMensagem($messagem);
			$configEmail->enviarEmail();

			$fp = fopen( ROOT . DS . "logApiCPanelError.txt", "a");
			$escreve = fwrite($fp, $messagem . "\n\r");
			fclose($fp);
			
			return true;
			
		}
		
	}

}
