<?php



class ShopModo extends AppModel {

    public $name = 'ShopModo';
    public $useTable = 'modo';
    public $primaryKey = 'id_emodo';
    public $useDbConfig = 'default';

    public function getAll()
	{
		try {

			return $this->find('all');

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
