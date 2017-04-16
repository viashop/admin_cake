<?php



class ShopFreteGratisController extends AppController {

	public $uses = array('ShopFreteGratis');

	public function checkFrete()
	{

		try {

			$conditions = array(
		    	'fields' => array(
		    		'ShopFreteGratis.regiao_name',
		    		'ShopFreteGratis.regiao_valor'
		    	),
		        'conditions' => array('ShopFreteGratis.regiao_name' => $this->params['named']['name'] )
		    );

			if ( $this->ShopFreteGratis->find('count', $conditions ) > 0) {
				return $this->ShopFreteGratis->find('all', $conditions);
			} else {
				return false;
			}

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
