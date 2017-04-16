<?php

App::uses('AppController', 'Controller');

class ConfiguracaoAtividadeController extends AppController
{

    public $uses = array('ConfiguracaoAtividade');

    public function atividadeAll()
    {
        try {

            /**
             *
             * array filtro
             *
             **/
            $conditions = array(
                'fields' => array(
                    'ConfiguracaoAtividade.id_atividade',
                    'ConfiguracaoAtividade.nome'
                )
            );

            return $this->ConfiguracaoAtividade->find('all', $conditions);

        } catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    public function optionAll()
    {
        try {

            $conditions = array(
                'fields' => array(
                    'ConfiguracaoAtividade.id_atividade',
                    'ConfiguracaoAtividade.nome'
                )
            );

            $option = '';
            $result =  $this->ConfiguracaoAtividade->find('all', $conditions);

            foreach ($result as $dados) {

                if (isset($this->params['named']['cate'])
                    && is_numeric($this->params['named']['cate'])) {

                    if (!(strcmp($dados['ConfiguracaoAtividade']['id_atividade'], $this->params['named']['cate']))) {
                        $selected = ' selected="selected"';
                    } else {
                        $selected = '';
                    }

                } else {
                    $selected = '';
                }

                $option .= sprintf('<option value="%d"%s>%s</option>', $dados['ConfiguracaoAtividade']['id_atividade'], $selected, $dados['ConfiguracaoAtividade']['nome'] ) . PHP_EOL;
            }

            return $option;

        } catch (PDOException $e) {
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
            $conditions = array(

                'fields' => array(
                    'ConfiguracaoAtividade.id_atividade',
                    'ConfiguracaoAtividade.nome'
                ),

                'conditions' => array(
                    'ConfiguracaoAtividade.id_atividade' => $this->params['named']['id']
                )
            );

            return $this->ConfiguracaoAtividade->find('first', $conditions);


        } catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
