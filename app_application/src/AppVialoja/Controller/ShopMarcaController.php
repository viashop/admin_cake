<?php



class ShopMarcaController extends AppController {

	public $uses = array('ShopMarca');


	public function getIdMarca()
	{
		try {

            if (empty($this->params['named']['id'])) {
                throw new \LogicException("Erro: O ID da marca é obrigatório.", E_USER_WARNING);
            }

            $conditions = array(
                'fields' => array(
                    'ShopMarca.nome'
                ),
                'conditions' => array(
                    'ShopMarca.id_marca' => $this->params['named']['id'],
                    'ShopMarca.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            return $this->ShopMarca->find('first', $conditions);

		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

	}

}
