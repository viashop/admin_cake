<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 19/10/16 às 09:39
 */
use AppVialoja\Interfaces\Model\IShopDominioRedirect;

class ShopDominioRedirect extends AppModel implements IShopDominioRedirect
{

    public $name = 'ShopDominioRedirect';
    public $useTable = 'shop_dominio_redirect';
    public $primaryKey = 'id_dominio';
    public $useDbConfig = 'default';

	/**
	 * Verifica se dominio esta para ser redirecionado
	 * @param Shop $shop
	 * @param \stdClass $std
	 * @return bool
	 */
	public function existsSubdominio(Shop $shop, \stdClass $std)
	{
		try {

   			$conditions = array(
		        'conditions' => array(
					'ShopDominioRedirect.virtual_uri' => (string)$std->virtual_uri,
					'ShopDominioRedirect.id_shop_default !=' => $shop->getIdShop()
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
	 * Exclui o subdominio
	 * @param Shop $shop
	 * @param \stdClass $std
	 */
	public function removeSubdominio(Shop $shop, \stdClass $std)
	{
		try {

			$conditions = array(
				'conditions' => array(
					'ShopDominioRedirect.virtual_uri' => (string)$std->virtual_uri,
					'ShopDominioRedirect.id_shop_default' => $shop->getIdShop()
				)
			);

			if ($this->find('count', $conditions) > 0) {

				$delOk = $this->deleteAll(
					array(
						'ShopDominioRedirect.virtual_uri' => (string)$std->virtual_uri,
						'ShopDominioRedirect.id_shop_default' => $shop->getIdShop()
					)
				);

				if (!$delOk) {
					throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
				}

				return true;

			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

}
