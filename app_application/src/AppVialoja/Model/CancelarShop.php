<?php

use Lib\Tools;


class CancelarShop extends AppModel {

    public $name = 'CancelarShop';
    public $useTable = 'cancelar_shop';
    public $useDbConfig = 'default';


    /**
	 * Log de visita
	 * @access public
	 * @param String $data
	*/
	public function insert($id_shop='',$id_cliente='', $status_ativo='')
	{

		try {

			if (isset($id_shop,$id_cliente,$status_ativo)) {

				$this->deleteAll(array('id_shop_default' => $id_shop ));

				$start = new DateTimeImmutable();
				$datetime = $start->modify('+15 day');

				$data = array(
					'id_shop_default' => $id_shop,
					'id_cliente' => $id_cliente,
					'status_ativo' => $status_ativo,
					'motivos' => Tools::clean(Tools::getValue('motivos')),
					'sugestao' => Tools::clean(Tools::getValue('sugestao')),
					'data_remover' => $datetime->format('Y-m-d')
			    );

				if ($this->saveAll($data)) {
					return $this->getInsertID();
				}

			}

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}


	public function getStatus($id_shop='') {

		try {

			$conditions = array(
				'fields' => array(
					'CancelarShop.id_shop_default',
					'CancelarShop.status_ativo',
				),
	            'conditions' => array(
	            	'CancelarShop.id_shop_default' => $id_shop
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
