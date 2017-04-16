<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 28/09/16 às 15:36
 */

namespace Email\Config;
use Exception\VialojaInvalidLogicException;
use LogicException;

/**
 * Class AbstractConfigMail
 * @package Email\Config
 */
abstract class AbstractConfigMail
{

    /**
     * @var array
     */
    public $default = array(

        'from' => CONFIG_PHPMAILER_FROM,
        'fromName' => CONFIG_PHPMAILER_FROM_NAME,
        'addBCC' => null,
        'addReplyTo' => CONFIG_PHPMAILER_REPLY_TO,
        'messageId' => true,
        'subject' => null,
        'message' => null,
        'isHTML' => true,
        'SMTPSecure' => 'tls',
        'SMTPAuth' => true,
        'host' => CONFIG_PHPMAILER_HOST,
        'port' => 587,
        'username' => CONFIG_PHPMAILER_USERNAME,
        'password' => CONFIG_PHPMAILER_PASSWORD,
        'charSet' => 'utf-8',

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        'debug' => 0
    );


    protected $charSet;
    protected $smtpDebug;
    protected $host;
    protected $port;
    protected $smtpSecure;
    protected $smtpAuth;
    protected $username;
    protected $password;
    protected $addReplyTo;
    protected $isHTML;
    protected $template;
    protected $layout;
    protected $addBCC;
    protected $file;
    protected $from;
    protected $fromName;
    protected $subject;
    protected $message;
    protected $address;

    /**
     * @return mixed
     */
    public function getCharSet()
    {
        return $this->charSet;
    }

    /**
     * @param mixed $charSet
     * @return $this
     */
    public function setCharSet($charSet)
    {
        $this->charSet = $charSet;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmtpDebug()
    {
        return $this->smtpDebug;
    }

    /**
     * @param mixed $smtpDebug
     * @return $this
     */
    public function setSmtpDebug($smtpDebug)
    {
        $this->smtpDebug = $smtpDebug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmtpSecure()
    {
        return $this->smtpSecure;
    }

    /**
     * @param mixed $smtpSecure
     * @return $this
     */
    public function setSmtpSecure($smtpSecure)
    {
        $this->smtpSecure = $smtpSecure;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSmtpAuth()
    {
        return $this->smtpAuth;
    }

    /**
     * @param mixed $smtpAuth
     * @return $this
     */
    public function setSmtpAuth($smtpAuth)
    {
        $this->smtpAuth = $smtpAuth;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddReplyTo()
    {
        return $this->addReplyTo;
    }

    /**
     * @param mixed $addReplyTo
     * @return $this
     */
    public function setAddReplyTo($addReplyTo)
    {
        $this->addReplyTo = $addReplyTo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsHTML()
    {
        return $this->isHTML;
    }

    /**
     * @param mixed $isHTML
     * @return $this
     */
    public function setIsHTML($isHTML)
    {
        $this->isHTML = $isHTML;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $layout
     * @return $this
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddBCC()
    {
        return $this->addBCC;
    }

    /**
     * @param mixed $addBCC
     * @return $this
     */
    public function setAddBCC($addBCC)
    {
        $this->addBCC = $addBCC;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param array $file
     * @return $this
     */
    public function setFile(array $file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @param mixed $fromName
     * @return $this
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject(string $subject)
    {

        $this->subject = $subject;

        try {

            if (empty($this->subject)) {
                throw new LogicException(ERROR_LOGIC_VAR .'Subject', E_USER_ERROR);
            }

        } catch (\LogicException $e) {
            VialojaInvalidLogicException::errorHandler($e);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        try {

            if (empty($this->message)) {
                throw new LogicException(ERROR_LOGIC_VAR .'Message', E_USER_ERROR);
            }

        } catch (\LogicException $e) {
            VialojaInvalidLogicException::errorHandler($e);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return $this
     */
    public function setAddress(string $address)
    {

        $this->address = $address;

        try {

            if (empty($this->address)) {
                throw new LogicException(ERROR_LOGIC_VAR .'Address', E_USER_ERROR);
            }

        } catch (\LogicException $e) {
            VialojaInvalidLogicException::errorHandler($e);
        }

        return $this;
    }

    abstract public function sendMail();

}
