<?php

namespace Email\Notification\Controller\Support;


/**
 * Class RespostaCliente
 * @package Email\Notification\Controller\Support
 */
class RespostaCliente extends ConteudoEmail
{

    public function content()
    {

        return $this->theme( parent::conteudoEmailTable( __CLASS__ ) );

    }

}