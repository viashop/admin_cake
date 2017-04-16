<?php



class CancelarShopRecuperacao extends AppModel {

    public $name = 'CancelarShopRecuperacao';
    public $useTable = 'cancelar_shop_recuperacao';
    public $useDbConfig = 'default';

    /**
	 * Log de visita
	 * @access public
	 * @param String $data
	*/
	public function insert($id_shop='',$token='')
	{

		try {

			if (isset($id_shop,$token)) {

				$this->deleteAll(array('id_shop_default' => $id_shop ));

				$data = array(
					'id_shop_default' => $id_shop,
					'token' => $token,
			    );

				if ($this->saveAll($data)) {
					return $this->getInsertID();
				}

			}

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	public function getToken($token='') {

		try {

			$conditions = array(
				'fields' => array(
					'CancelarShopRecuperacao.id_shop_default'
				),
	            'conditions' => array(
	            	'CancelarShopRecuperacao.token' => $token
	            )

	        );

	        if ($this->find('count', $conditions) > 0 ) {
            	return $this->find('first', $conditions);
            }  else {
            	return false;
            }

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
