<?php

App::uses('AppController', 'Controller');

class ConfiguracaoAtividadeController extends AppController
{

    public $uses = array('ConfiguracaoAtividade');

	private $conditions;
	private $result, $dados;
	private $selected;
	private $option = '';

    public function atividadeAll()
    {
        try {

            /**
             *
             * array filtro
             *
             **/
            $this->conditions = array(
                'fields' => array(
                    'ConfiguracaoAtividade.id_atividade',
                    'ConfiguracaoAtividade.nome'
                )
            );

            return $this->ConfiguracaoAtividade->find('all', $this->conditions);

        } catch (Exception $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    public function optionAll()
    {
        try {

            $this->conditions = array(
                'fields' => array(
                    'ConfiguracaoAtividade.id_atividade',
                    'ConfiguracaoAtividade.nome'
                )
            );

            $this->result = $this->ConfiguracaoAtividade->find('all', $this->conditions);

            foreach ($this->result as $this->dados) {

                if (isset($this->params['named']['cate'])
                    && is_numeric($this->params['named']['cate'])) {

                    if (!(strcmp($this->dados['ConfiguracaoAtividade']['id_atividade'], $this->params['named']['cate']))) {
                        $this->selected = ' selected="selected"';
                    } else {
                        $this->selected = '';
                    }

                } else {
                    $this->selected = '';
                }

                $this->option .= sprintf('<option value="%d"%s>%s</option>', $this->dados['ConfiguracaoAtividade']['id_atividade'], $this->selected, $this->dados['ConfiguracaoAtividade']['nome'] ) . PHP_EOL;
            }

            return $this->option;

        } catch (Exception $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    public function getNomeAtividade()
    {
        try {

            /**
             *
             * array filtro
             *
             **/
            $this->conditions = array(

                'fields' => array(
                    'ConfiguracaoAtividade.id_atividade',
                    'ConfiguracaoAtividade.nome'
                ),

                'conditions' => array(
                    'ConfiguracaoAtividade.id_atividade' => $this->params['named']['id']
                )
            );

            $this->result = $this->ConfiguracaoAtividade->find('first', $this->conditions);
            return $this->result['ConfiguracaoAtividade']['nome'];

        } catch (Exception $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

}
