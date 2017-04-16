<?php

App::uses('AppModel', 'Model');

class LogShopVisita extends AppModel {

	public $name = 'LogShopVisitas';
    public $useTable = 'log_shop_visita';
    public $primaryKey = 'id_visita';
    public $useDbConfig = 'default';


    /** 
	 * Log de visita
	 * @access public
	 * @param String $data 
	*/
	public function insert($id_shop='',$session_id='',$referer='',$agent='',$ip='')
	{		

		try {

			if (isset($id_shop,$session_id,$agent,$ip)) {

				$data = array(

					'id_shop_default' => $id_shop,
					'session_id' => $session_id,
					'http_referer' => $referer,
					'http_user_agent' => $agent,
					'ip' => $ip

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
