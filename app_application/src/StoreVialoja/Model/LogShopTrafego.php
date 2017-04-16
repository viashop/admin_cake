<?php

App::uses('AppModel', 'Model');

class LogShopTrafego extends AppModel {

	public $name = 'LogShopTrafego';
    public $useTable = 'log_shop_trafego';
    public $primaryKey = 'id_trafego';
    public $useDbConfig = 'default';

    /** 
	 * Log de trafego visita
	 * @access public
	 * @param Array $id_visita
	 * @param String $data 
	*/
	public function insert($id_shop='', $bytes='',$referer='',$user_agent='',$url='',$ip='')
	{		

		try {

			if (isset($id_shop, $bytes)) {

				$data = array(
					'id_shop_default' => $id_shop,
					'bytes' => $bytes,
					'http_referer' => $referer,
					'http_user_agent' => $user_agent,
					'url' => $url,
					'ip' => $ip,
					'time_unique' => date('YmdHis')
			    );

				$this->saveAll($data);

			}
			
		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
