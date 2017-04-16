<?php

namespace Email\Notification\Controller\Support;


/**
 * Class RespostaAdmin
 * @package Email\Notification\Controller\Support
 */
class RespostaAdmin extends ConteudoEmail
{

    public function content()
    {

        return $this->theme( parent::conteudoEmailTable( __CLASS__ ) );

    }

}