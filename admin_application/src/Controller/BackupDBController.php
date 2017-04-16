<?php
namespace App\Controller;

use App\Controller\AppController;
use Ifsnop\Mysqldump as IMysqldump;

class BackupDBController extends AppController
{

    public function index()
    {

        try {


            $dump = new IMysqldump\Mysqldump('mysql:host=localhost;dbname=odontofinan', 'odontofinan', '');
            
            $dump->start('storage/work/dump.sql');    

            $mail = new \PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output


            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'odontofinan';                 // SMTP username
            $mail->Password = 'odontofinan';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('odontofinan@', 'OdontoFinan Backup ' . date('dmYHis'));
           // Add a
            $mail->addAddress('odontofinan@', 'odontofinan');     // Add a

            $mail->addReplyTo('odontofinan@', 'odontofinan');

            $mail->addCC('@outlook.com');

            $mail->addAttachment('/var/www/vialoja/admin_application/tmp/dump.sql');         // Add name
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Backup Odontofinan.com.br';
            $mail->Body    = 'Segue em Anexo o Backup de Banco de Dados ' . date('d/m/Y');
            $mail->AltBody = 'Segue em Anexo o Backup de Banco de Dados';

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                //echo 'Message has been sent';
            }


        } catch (\Exception $e) {
            echo 'mysqldump-php error: ' . $e->getMessage();
        }


        $this->render(false);
    }

}
