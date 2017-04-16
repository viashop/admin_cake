<?php



class ShopConta extends AppModel {

    public $name = 'ShopConta';
    public $useTable = 'shop_conta';
    public $primaryKey = 'id_conta';
    public $useDbConfig = 'default';


    public function getFirstAll($id_shop='')
	{
		try {

			if(!is_numeric($id_shop)){
				throw new \LogicException('Informe o id do tipo INT');
			}

			$conditions = array(
                'conditions' => array(
                    'ShopConta.id_shop_default' => $id_shop
                )
            );

            return $this->find('first', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
