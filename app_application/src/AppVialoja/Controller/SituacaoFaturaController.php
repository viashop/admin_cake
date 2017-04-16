<?php

use Respect\Validation\Validator as v;


class SituacaoFaturaController extends AppController
{

    public $uses = array('SituacaoFatura');

    /**
     * Rescupera dados do usuario via ID.
     * @access public
     */
    public function getSituacaoId()
    {
        try {

			if (empty($this->params['named']['id'])) {
                throw new \LogicException("Valor obrigatório: Informe o id.", E_USER_WARNING);
            }

            if (!v::numeric()->notBlank()->validate($this->params['named']['id'])) {
                throw new \LogicException("Valor obrigatório: Informe o id do tipo INT.", E_USER_WARNING);
            }

            /**
             *
             * array filtro
             *
             **/
            $conditions = array(
                'fields' => array(
                    'SituacaoFatura.situacao'
                ),
                'conditions' => array(
                    'SituacaoFatura.id_situacao' => $this->params['named']['id']
                )
            );

            $data = $this->SituacaoFatura->find('first', $conditions);
            return $data['SituacaoFatura']['situacao'];

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

		}

    }

}
