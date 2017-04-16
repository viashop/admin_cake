<?php

App::uses('AppController', 'Controller');

class ConfiguracaoEnvioController extends AppController
{

    public $uses = array('ConfiguracaoEnvio');

	private $conditions;

    /**
     * Retorna todos os dados
     * @access public
     * @return data
     */
    public function obterTodasAsConfiguracoesDeEnvio()
    {
        try {

            $this->conditions = array(
                'conditions' => array(
                    'ConfiguracaoEnvio.ativo' => 1
                )
            );

            return $this->ConfiguracaoEnvio->find('all', $this->conditions);

        } catch (Exception $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /**
     * Recupera as formas de envio via IN
     * @access public
     * @param String $arrayIds IDs de envio
     * @return data
     */
    public function obterConfiguracoesDeEnvioComIN()
    {
        try {

            /**
             *
             * array filtro
             *
             **/

            if (is_array($this->params['named']['arrayIds'])) {

                $this->conditions = array(

                    'conditions' => array(
                        'ConfiguracaoEnvio.id' => array_map('intval', $this->params['named']['arrayIds'] )
                    )

                );

                return $this->ConfiguracaoEnvio->find('all', $this->conditions);

            }

        } catch (Exception $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

}
