<?php



class BannerLocal extends AppModel {

	public $name = 'BannerLocal';
	public $useDbConfig = 'default';
	public $useTable = 'banner_local';

	public function getAll()
	{
		try {

			return $this->find('all');

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
