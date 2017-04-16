<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/10/16 às 20:24
 */
use AppVialoja\Interfaces\Model\IShopEndereco;

class ShopEndereco extends AppModel implements IShopEndereco
{

    public $name = 'ShopEndereco';
    public $useTable = 'shop_endereco';
    public $primaryKey = 'id_endereco';
    public $useDbConfig = 'default';

    use \AppVialoja\Traits\Entity\TShopEndereco;

    /**
     * Retorna dados de endereço
     * @param Shop $shop
     * @return array|null
     */
    public function getFirstAll(Shop $shop)
    {
        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopEndereco.id_shop_default' => $shop->getIdShop()
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
     * Cadastra Endereço Shop
     * @param Shop $shop
     * @param ShopEndereco $endereco
     */
    public function cadastrar(Shop $shop, ShopEndereco $endereco)
    {

        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopEndereco.id_shop_default' => $shop->getIdShop()
                )
            );

            if ($this->find('count', $conditions) > 0) {

                $fields = array(
                    'ShopEndereco.mostrar_endereco' => sprintf("'%s'", $endereco->getMostrarEndereco()),
                    'ShopEndereco.endereco' => sprintf("'%s'", $endereco->getEndereco()),
                    'ShopEndereco.cep' => sprintf("'%s'", $endereco->getCep()),
                    'ShopEndereco.id_estado' => $endereco->getIdEstado(),
                    'ShopEndereco.id_cidade' => $endereco->getIdCidade(),
                    'ShopEndereco.bairro' => sprintf("'%s'", $endereco->getBairro()),
                    'ShopEndereco.numero' => sprintf("'%s'", $endereco->getNumero()),
                    'ShopEndereco.complemento' => sprintf("'%s'", $endereco->getComplemento())
                );

                $conditions = array(
                    'ShopEndereco.id_shop_default' => $shop->getIdShop()
                );

                if (!$this->updateAll($fields, $conditions)) {
                    throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
                }

            } else {

                $data = array(
                    'id_shop_default' => $shop->getIdShop(),
                    'endereco' => $endereco->getEndereco(),
                    'cep' => $endereco->getCep(),
                    'id_cidade' => $endereco->getIdCidade(),
                    'id_estado' => $endereco->getIdEstado(),
                    'bairro' => $endereco->getBairro(),
                    'numero' => $endereco->getNumero(),
                    'complemento' => $endereco->getComplemento()
                );

                if (!$this->saveAll($data)) {
                    throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
                }

            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}
