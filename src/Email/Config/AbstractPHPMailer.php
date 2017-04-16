<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 28/09/16 às 15:36
 *
 * @see \PHPMailer
 * @see https://github.com/PHPMailer/PHPMailer
 *
 * @see \Pimple\Container
 * @see https://github.com/silexphp/Pimple
 */

namespace Email\Config;
use Exception;

abstract class AbstractPHPMailer extends AbstractConfigMail
{

    protected $phpmailer;

    public function __construct()
    {

        $container = new \Pimple\Container();
        $container['PHPMailer'] = function () {
            return new \PHPMailer();
        };

        $this->phpmailer = $container['PHPMailer'];

    }

    /**
     * Configurações de Envio
     */
    protected function configurations()
    {

        if ($this->phpmailer instanceof \PHPMailer) {

            $this->phpmailer->setLanguage("br"); //Idioma
            $this->phpmailer->isSMTP();

            if (!empty($this->getCharSet())) {
                $this->phpmailer->CharSet = $this->getCharSet();
            } else {
                $this->phpmailer->CharSet = $this->default['charSet'];
            }

            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            if (!empty($this->getSmtpDebug())) {
                $this->phpmailer->SMTPDebug = $this->getSmtpDebug();
            } else {
                $this->phpmailer->SMTPDebug = $this->default['debug'];
            }

            //$this->phpmailer->SMTPDebug = 1;
            //Ask for HTML-friendly debug output
            $this->phpmailer->Debugoutput = 'html';

            //Set the hostname of the mail server
            if (!empty($this->getHost())) {
                $this->phpmailer->Host = $this->getHost();
            } else {
                $this->phpmailer->Host = base64_decode($this->default['host']);
            }

            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            if (!empty($this->getPort())) {
                $this->phpmailer->Port = $this->getPort();
            } else {
                $this->phpmailer->Port = $this->default['port'];
            }

            //Set the encryption system to use - ssl (deprecated) or tls
            if (!empty($this->getSmtpSecure())) {
                $this->phpmailer->SMTPSecure = $this->getSmtpSecure();
            } else {
                $this->phpmailer->SMTPSecure = $this->default['SMTPSecure'];
            }

            //Whether to use SMTP authentication
            if (!empty($this->getSmtpAuth())) {
                $this->phpmailer->SMTPAuth = $this->getSmtpAuth();
            } else {
                $this->phpmailer->SMTPAuth = $this->default['SMTPAuth'];
            }

            //Username to use for SMTP authentication - use full email address for gmail
            if (!empty($this->getUsername())) {
                $this->phpmailer->Username = $this->getUsername();
            } else {
                $this->phpmailer->Username = base64_decode($this->default['username']);
            }

            //Password to use for SMTP authentication
            if (!empty($this->getPassword())) {
                $this->phpmailer->Password = $this->getPassword();
            } else {
                $this->phpmailer->Password = base64_decode($this->default['password']);
            }

            // Defina o email e o nome que aparecerá como remetente no cabeçalho
            if (!empty($this->getFrom())) {
                $this->phpmailer->From = $this->getFrom();
            } else {
                $this->phpmailer->From = base64_decode($this->default['from']);
            }

            //nome de quem ta enviando, vai aparecer na coluna "De:"
            if (!empty($this->getFromName())) {
                $this->phpmailer->FromName = $this->getFromName();
            } else {
                $this->phpmailer->FromName = base64_decode($this->default['fromName']);
            }

            //Quem irá receber a resposta (quando a pessoal responder)
            if (!empty($this->getAddReplyTo())) {
                $this->phpmailer->clearReplyTos();
                $this->phpmailer->addReplyTo($this->getAddReplyTo());
            } else {
                $this->phpmailer->addReplyTo(base64_decode($this->default['addReplyTo']));
            }

            //formato do e-mail
            if (!empty($this->getIsHTML())) {
                $this->phpmailer->isHTML($this->getIsHTML());
            } else {
                $this->phpmailer->isHTML($this->default['isHTML']);
            }

            if (!empty($this->getAddBCC())) {
                $this->phpmailer->addBCC($this->getAddBCC(), $this->getSubject());
            } else {
                $this->phpmailer->addBCC($this->default['addBCC'], $this->subject); // Cópia Oculta
            }

            /**
             * Anexo Arquivo
             */
            if (!empty($this->getFile()) && count($this->getFile()) > 0) {

                $file = $this->getFile();

                if (!empty($file['tmp_name']) && !empty($file['name'])) {
                    $this->phpmailer->addAttachment($file['tmp_name'], $file['name']);
                }

            }

            /**
             * Endereço de Email
             */
            $this->phpmailer->addAddress($this->getAddress());

            /**
             * Assunto
             */
            $this->phpmailer->Subject = $this->getSubject();

            /**
             * Corpo da mensagem, pode usar tags html
             */
            $this->phpmailer->Body = $this->getMessage();

        }

    }

    /**
     * Envia o Email ao Destinatário
     * @return bool
     * @throws Exception
     */
    public function sendMail()
    {

        if ($this->phpmailer instanceof \PHPMailer) {

            self::configurations();

            /**
             * Envia o email usando o phpmailer
             */
            if (!$this->phpmailer->send()) {
                throw new \Exception("Houve um erro envio de email: " . $this->phpmailer->ErrorInfo);
            } else {

                $this->phpmailer->clearAllRecipients();
                $this->phpmailer->clearAttachments();
                return true;
            }

        } else {
            trigger_error('Erro: Class PHPMailer NOT FOUND', E_USER_NOTICE);
            exit;
        }

    }

}