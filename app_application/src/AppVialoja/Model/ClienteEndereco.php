<?php



class ClienteEndereco extends AppModel {

    public $name = 'ClienteEndereco';
    public $useTable = 'cliente_endereco';
    public $primaryKey = 'id_endereco';
    public $useDbConfig = 'default';

    public function getFirstAll( $id_cliente='' )
    {
        try {

            $conditions = array(
                'conditions' => array(
                    'ClienteEndereco.id_cliente_default' => $id_cliente
                )
            );

            return $this->find('first', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

}
