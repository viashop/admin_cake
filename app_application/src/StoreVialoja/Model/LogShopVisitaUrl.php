<?php

App::uses('AppModel', 'Model');

class LogShopVisitaUrl extends AppModel {

	public $name = 'LogShopVisitaUrl';
    public $useTable = 'log_shop_visita_url';
    public $primaryKey = 'id_url';
    public $useDbConfig = 'default';

    /** 
	 * Log de visita
	 * @access public
	 * @param Array $id_visita
	 * @param String $data 
	*/
	public function insert($id_visita='',$url='', $referer='')
	{		

		try {

			if (isset($id_visita, $url)) {

				$data = array(
					'id_visita_default' => $id_visita,
					'url' => $url,
					'referer' => $referer
			    );

				if ($this->saveAll($data)) {
					return $this->getInsertID();
				}
			}
			
		} catch (PDOException $e) {

			if (isset($e->errorInfo[0]) && $e->errorInfo[0] !== '23000') {
				\Exception\VialojaDatabaseException::errorHandler($e);
			}

		}

	}

}
