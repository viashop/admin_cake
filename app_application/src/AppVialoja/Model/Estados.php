<?php



class Estados extends AppModel {

    public $name = 'Estados';
    public $useTable = 'estados';
    public $primaryKey = 'codigo_ibge';
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
