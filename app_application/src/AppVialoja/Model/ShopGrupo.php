<?php



class ShopGrupo extends AppModel {

	public $name = 'ShopGrupo';
	public $useDbConfig = 'default';
	public $useTable = 'shop_grupo';
	public $primaryKey = 'id_grupo';


	/**
     * Grupo Listar
     * @access public
     * @param String $id_shop
    */
	public function ShopGrupoListar($id_shop='')
    {

		try {

			$conditions = array(

                'fields' => array(
                    'ShopGrupo.nome',
                    'ShopGrupo.id_grupo'
                ),
                'conditions' => array(
                    'ShopGrupo.id_shop_default' => $id_shop
                ),
                'order' => array('ShopGrupo.nome' => 'ASC'),

            );

            return $this->find('all', $conditions );


		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

	}

}
