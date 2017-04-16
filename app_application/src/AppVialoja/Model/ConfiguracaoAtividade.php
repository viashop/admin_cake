<?php



class ConfiguracaoAtividade extends AppModel {

    public $name = 'ConfiguracaoAtividade';
    public $useTable = 'configuracao_atividade';
    public $primaryKey = 'id_atividade';
    public $useDbConfig = 'default';

    public function getAll()
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

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
