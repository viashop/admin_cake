<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 21/10/16 às 23:22
 */
use AppVialoja\Interfaces\Model\IClienteConvite;

class ClienteConvite extends AppModel implements IClienteConvite
{

	public $name = 'ClienteConvite';
	public $useDbConfig = 'default';
	public $useTable = 'cliente_convite';

	use \AppVialoja\Traits\Entity\TClienteConvite;

	/**
	 * Listar Usuário(s)
	 * @param Shop $shop
	 * @return array|null
	 */
	public function listar(Shop $shop) {

		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
			}

			$conditions = array(

	            'fields' => array(
	                'ClienteConvite.email',
	                'ClienteConvite.token',
	                'ClienteConvite.status'
	            ),
	            'conditions' => array(
	                'ClienteConvite.id_shop_default' => $shop->getIdShop()
	            )

	        );

	        return $this->find('all', $conditions);

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 * Deleta as os convites se existir
	 * @param ClienteConvite $convite
	 */
	public function deletar(ClienteConvite $convite) {

		try {

			if (!is_string($convite->getToken())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'token string');
			}

			$conditions = array(
				'ClienteConvite.token' => $convite->getToken()
			);

			if (!$this->deleteAll($conditions)) {
				throw new \RuntimeException();
			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 *  Recusar convite
	 * @param ClienteConvite $convite
	 */
	public function recusar(ClienteConvite $convite) {

		try {

			if (!is_string($convite->getToken())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'token string');
			}

			/** Update com recusado **/
			$fields = array(
				'ClienteConvite.status' => 1
			);

			$conditions = array(
				'ClienteConvite.status' => 0,
				'ClienteConvite.token' => $convite->getToken()
			);

			if (!$this->updateAll($fields, $conditions)) {
				throw new \RuntimeException();
			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 * Verifica se existe Convite
	 * @param ClienteConvite $convite
	 * @return bool
	 */
	public function existsConvite(ClienteConvite $convite) {

		try {

			if (!is_string($convite->getToken())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'token string');
			}

			$conditions = array(
				'conditions' => array(
					'ClienteConvite.status' => 0,
					'ClienteConvite.token' => $convite->getToken()
				)
			);

			if ($this->find('count', $conditions) <= 0)
				return false;
			return true;

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 * Verifica se tem convite
	 * @param ClienteConvite $convite
	 * @return array|null
	 */
	public function conviteDados(ClienteConvite $convite) {

		try {

			if (!is_string($convite->getToken())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'token string');
			}

			$conditions = array(
				'fields' => array(
					'ClienteConvite.id',
					'ClienteConvite.id_shop_default',
					'ClienteConvite.email'
				),
				'conditions' => array(
					'ClienteConvite.status' => 0,
					'ClienteConvite.token' => $convite->getToken()
				)
			);

			return $this->find('first', $conditions);

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 * Deletar Convite
	 * @param int $id
	 */
	public function deletarId($id)
	{
		try {

			$this->id = intval($id);
			if ($this->exists()) {
				$this->delete();
			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

}
