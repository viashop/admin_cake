<?php

namespace Email\Notification\Controller\Support;


/**
 * Class ConfirmeEnvioCliente
 * @package Email\Notification\Controller\Support
 */
class ConfirmeEnvioCliente extends ConteudoEmail
{

    public function content()
    {

        return $this->theme( parent::conteudoEmailTable( __CLASS__ ) );

    }

}