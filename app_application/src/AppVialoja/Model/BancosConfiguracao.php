<?php



class BancosConfiguracao extends AppModel {

    public $name = 'BancosConfiguracao';
    public $useDbConfig = 'default';
    public $useTable = 'bancos_configuracao';

    public function getAll()
    {
        try {

            return $this->find('all');

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
