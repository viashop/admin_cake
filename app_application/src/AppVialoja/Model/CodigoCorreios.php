<?php



class CodigoCorreios extends AppModel {

	public $name = 'CodigoCorreios';
	public $useDbConfig = 'default';
	public $primaryKey = 'codigo';

	public function getNomeServico($codigo='')
	{

		try {

			$conditions = array(
				'fields' => array(
					'CodigoCorreios.servico'
				),
	            'conditions' => array(
	                'CodigoCorreios.codigo' => $codigo
	            ),
	            'limit' => 1
	        );

			$re = $this->find('first', $conditions);
			return $re['CodigoCorreios']['servico'];

	    } catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

	    }

	}

	/**
	 * Obter Código Correios
	 * @param int $id_envio
	 * @return mixed
	 */
	public function getCodigo(int $id_envio)
	{

		try {

			if (empty($id_envio)) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'id_envio');
			}

			$conditions = array(
				'fields' => array(
					'CodigoCorreios.codigo'
				),
				'conditions' => array(
					'CodigoCorreios.default' => 'True',
					'CodigoCorreios.id_envio' => $id_envio
				)
			);

			return $this->find('first', $conditions);

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

}
