<?php

namespace Email\Notification\Controller\Support;


/**
 * Class ConfirmeEnvioSuporte
 * @package Email\Notification\Controller\Support
 */
class ConfirmeEnvioSuporte extends ConteudoEmail
{

    public function content()
    {

        return $this->theme( parent::conteudoEmailTable( __CLASS__ ) );

    }

}