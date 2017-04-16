<?php



class ClienteShopGrupo extends AppModel {

	public $name = 'ClienteShopGrupo';
	public $useDbConfig = 'default';
	public $useTable = 'cliente_shop_grupo';
	public $primaryKey = 'id_grupo';


	/**
     * Grupo Listar
     * @access public
     * @param String $id_shop
    */
	public function getAll($id_shop='')
    {

		try {

			$conditions = array(

                'fields' => array(
                    'ClienteShopGrupo.nome',
                    'ClienteShopGrupo.id_grupo'
                ),
                'conditions' => array(
                    'ClienteShopGrupo.id_shop_default' => $id_shop
                ),
                'order' => array('ClienteShopGrupo.nome' => 'ASC'),

            );

            return $this->find('all', $conditions );


		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

}
