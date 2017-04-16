<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 26/09/16 às 18:27
 */

namespace AppVialoja\Traits\Controller;


trait TMessageFlash
{

    /**
     * Função de aviso em flash
     * Configurações de Alerta
     * @param $e
     */
    final public function setMsgAlertError($e)
    {
        self::msgClassFlashCSS($e, 'alert-error');
    }

    /**
     * Função de aviso em flash
     * Configurações de Alerta
     *
     * @param $e * mensagem de sucesso
     */
    final public function setMsgAlertSuccess($e)
    {
        self::msgClassFlashCSS($e, 'alert-success');
    }

    /**
     * Função de aviso em flash
     * Configurações de Alerta
     *
     * @param $e * mensagem de warning
     */
    final public function setMsgAlertWarning($e)
    {
        self::msgClassFlashCSS($e, 'alert-warning');
    }

    /**
     * Função de aviso em flash
     * Configurações de Alerta
     *
     * @param $e * mensagem de info
     */
    final public function setMsgAlertInfo($e)
    {
        self::msgClassFlashCSS($e, 'alert-info');
    }

    /**
     * Configurações de Alerta
     *
     * @param string $msg
     * @param string $class
     */
    private function msgClassFlashCSS($msg = '', $class = '')
    {
        if (!empty($msg)) {
            $this->Session->setFlash(__($msg), 'msg-flash'.DS.'alert-box', array(
                'class' => $class
            ));
        }
    }

}