<?php



class ShopComparadorXml extends AppModel {

	public $name = 'ShopComparadorXml';
	public $useDbConfig = 'default';
	public $useTable = 'shop_comparador_xml';

	public function getToken($id_shop='', $id_comparador='')
	{
		try {

			$conditions = array(
				'fields' => array(
					'ShopComparadorXml.token'
				),
                'conditions' => array(
                    'ShopComparadorXml.id_shop_default' => $id_shop,
                    'ShopComparadorXml.id_comparador_default' => $id_comparador
                )
            );

            if ($this->find('count', $conditions) > 0 ) {
            	return $this->find('first', $conditions);
            } else {
            	return false;
            }

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
