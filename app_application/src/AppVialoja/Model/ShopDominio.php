<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 19/10/16 às 09:54
 */
use AppVialoja\Interfaces\Model\IShopDominio;

class ShopDominio extends AppModel implements IShopDominio
{

    public $name = 'ShopDominio';
    public $useTable = 'shop_dominio';
    public $primaryKey = 'id_dominio';
    public $useDbConfig = 'default';

	use \AppVialoja\Traits\Entity\TShopDominio;

	/**
	 * Obter dados subdominio
	 * @param Shop $shop
	 * @return array|null
	 */
	public function getIdFirstSubDominio(Shop $shop)
	{
		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
			}

			$conditions = array(
				'fields' => array(
					'ShopDominio.id_dominio',
					'ShopDominio.dominio',
					'ShopDominio.virtual_uri'
				),
				'conditions' => array(
					'ShopDominio.subdominio_plataforma' => 'True',
					'ShopDominio.id_shop_default' => $shop->getIdShop()
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
	 * Obter dados dominio principal
	 * @param Shop $shop
	 * @return mixed
	 */
	public function getDominioPrincipal(Shop $shop)
	{
		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
			}

			$conditions = array(

				'fields' => array(
					'ShopDominio.dominio'
				),
				'conditions' => array(
					'ShopDominio.main' => 1,
					'ShopDominio.id_shop_default' => $shop->getIdShop()
				)
			);

			$res = $this->find('first', $conditions);
			return $res['ShopDominio']['dominio'];

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}


	/**
	 * Obter dados dominio
	 * @param Shop $shop
	 * @return array|null
	 */
	public function getAllDominio(Shop $shop)
	{

		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
			}

			$conditions = array(
				'conditions' => array(
					'ShopDominio.main' => 1,
					'ShopDominio.id_shop_default' => $shop->getIdShop()
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
	 * Obter o VirtualUri dominio
	 * @param Shop $shop
	 * @return array|null
	 */
	public function virtualUri(Shop $shop)
	{

		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
			}

			$conditions = array(
				'fields' => array(
					'ShopDominio.virtual_uri'
				),
				'conditions' => array(
					'ShopDominio.main' => 1,
					'ShopDominio.id_shop_default' => $shop->getIdShop()
				)
			);

			if ($this->find('count', $conditions) > 0) {
				return $this->find('first', $conditions);
			} else {
				throw new \LogicException("Domínio padrão não encontrado. ID SHOP:" . $shop->getIdShop(), E_USER_NOTICE);
			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

	/**
	 * Obter o SubDominio dominio
	 * @param Shop $shop
	 * @param \stdClass $std
	 * @return bool
	 */
	public function obterResumoDominioTipo(Shop $shop, \stdClass $std)
	{

		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
			}

			if ($std->domain == 'subdominio') {

				$conditions = array(
					'fields' => array(
						'ShopDominio.dominio'
					),
					'conditions' => array(
						'ShopDominio.subdominio_plataforma' => 'True',
						'ShopDominio.id_shop_default' => $shop->getIdShop()
					)
				);

			} elseif ($std->domain == 'dominio') {

				$conditions = array(

					'fields' => array(
						'ShopDominio.dominio'
					),
					'conditions' => array(
						'ShopDominio.main' => 1,
						'ShopDominio.subdominio_plataforma' => 'False',
						'ShopDominio.id_shop_default' => $shop->getIdShop()
					)
				);

			}

			if(isset($conditions) && is_array($conditions)) {
				if ($this->find('count',$conditions) > 0) {
					return $this->find('first', $conditions);
				}
			}

			return false;

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 * Verifica se o Dominio já esta cadastrado
	 * @param string $string
	 * @return bool
	 */
	public function existsSubdominio($string='')
	{
		try {

   			$conditions = array(
		        'conditions' => array(
					'ShopDominio.virtual_uri' => (string)$string
				)
		    );

			if ($this->find('count', $conditions) > 0)
				return true;
			return false;

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

	/**
	 * Verifica o subdominio para excluir
	 * @param Shop $shop
	 * @return bool
	 */
	public function removeSubdominio(Shop $shop)
	{

		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
			}

			$conditions = array(
				'conditions' => array(
					'ShopDominio.subdominio_plataforma' => 'True',
					'ShopDominio.id_shop_default' => $shop->getIdShop()
				)
			);

			if ($this->find('count', $conditions) > 0) {

				$delOk = $this->deleteAll(
					array(
						'ShopDominio.subdominio_plataforma' => 'True',
						'ShopDominio.id_shop_default' => $shop->getIdShop()
					)
				);

				if (!$delOk) {
					throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
				}

				return true;

			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 * Cadastra Subdominio
	 * @param Shop $shop
	 * @param ShopDominio $dominio
	 * @return bool
	 */
	public function cadastrarSubdominio(Shop $shop, ShopDominio $dominio)
	{

		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
			}

			$data = array(
				'dominio' => $dominio->getDominio(),
				'dominio_ssl' => $dominio->getDominioSsl(),
				'dominio_manutencao' => $dominio->getDominioManutencao(),
				'virtual_uri' => $dominio->getVirtualUri(),
				'main' => $dominio->getMain(),
				'subdominio_plataforma' => $dominio->getSubdominioPlataforma(),
				'subdominio_add' => $dominio->getSubdominioAdd(),
				'id_shop_default' => $shop->getIdShop()
			);

			$this->saveAll($data);

			if ($this->getLastInsertId() > 0) {
				return true;
			}

			throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);


		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

}
