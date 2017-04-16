<?php



class Comparador extends AppModel {

	public $name = 'Comparador';
	public $useDbConfig = 'default';
	public $useTable = 'comparador';

	public function getAll() {

		try {

			$conditions = array(

	            'conditions' => array(
	            	'Comparador.ativo' => 'True'
	            )

	        );

	        if ($this->find('count', $conditions) > 0 ) {
            	return $this->find('all', $conditions);
            }  else {
            	return false;
            }

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
