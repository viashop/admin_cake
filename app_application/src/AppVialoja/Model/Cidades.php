<?php



class Cidades extends AppModel {

  public $name = 'Cidades';
  public $useTable = 'cidades';
  public $primaryKey = 'codigo_ibge';
  public $useDbConfig = 'default';

  public function getCidadeEstadoClienteDetalhar($codigo='')
	{
		try {

            $conditions = array(

                'fields' => array(
                    'Cidades.nome',
                    'Estados.sigla',
                    'Estados.nome'
                ),

                'conditions' => array(
                    'Cidades.codigo_ibge' => $codigo
                ),

                'order' => array(
                    'Cidades.nome' => 'asc'
                ),

                'joins' => array(

                    array(
                        'table' => 'estados',
                        'alias' => 'Estados',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Estados.id_estado = Cidades.estado_id'
                        )

                    ),

                ),

            );

            return $this->find('first', $conditions);

		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
