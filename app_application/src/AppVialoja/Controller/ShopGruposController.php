<?php



class ShopGruposController extends AppController {

	public $uses = array('ClienteGrupoShop');

	public function totalClienteGrupo()
	{
		try {

			if (empty($this->params['named']['id'])) {
                throw new \LogicException("Erro: O nome da marca é obrigatório.", E_USER_WARNING);
            }

			/**
			*
			* array filtro
			*
			**/
			$conditions = array(
		    	'fields' => array(
					    		'ClienteGrupoShop.id_grupo_default'
					    	),
		        'conditions' => array('ClienteGrupoShop.id_grupo_default' => $this->params['named']['id'] )
		    );

    		return $this->ClienteGrupoShop->find('count', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
