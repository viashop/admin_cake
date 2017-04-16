<?php

App::uses('AppModel', 'Model');

class CodigoCorreios extends AppModel {

	public $name = 'CodigoCorreios';
	public $useDbConfig = 'default';
	public $primaryKey = 'codigo';

	public function getNomeServico($codigo='')
	{	

		try {

			$conditions = array(
				'fields' => array(
					'CodigoCorreios.servico'
				),
	            'conditions' => array(
	                'CodigoCorreios.codigo' => $codigo
	            ),
	            'limit' => 1
	        );
		        
			$re = $this->find('first', $conditions);
			return $re['CodigoCorreios']['servico'];
        
	    } catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);
	        
	    }

	}

}
