<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 26/09/16 às 18:20
 */

namespace AppVialoja\Traits\Controller;
use Lib\Validate;
use CSRF\CSRFGuard;


trait TConfigCSRFGuard
{

    /**
     * Configurações de Segurança
     */
    final public function configCSRFGuard()
    {

        /**
         *
         * verifica se é bot
         *
         **/
        if (!Validate::isBot()) {

            $CSRFGuard = new CSRFGuard();
            $CSRFGuardName = "CSRFGuard_" . mt_rand(0, mt_getrandmax());
            $CSRFGuardToken = $CSRFGuard->csrfguard_generate_token($CSRFGuardName);
            $this->set(compact('CSRFGuardName'));
            $this->set(compact('CSRFGuardToken'));

        } else {

            $CSRFGuardToken = $CSRFGuardName = null;
            $this->set(compact('CSRFGuardName'));
            $this->set(compact('CSRFGuardToken'));

        }

    }

}