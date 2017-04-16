<?php

use Respect\Validation\Validator as v;



/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 *
 * @see Respect/Validation
 * @link https://github.com/Respect/Validation/blob/master/docs/VALIDATORS.md Documentação
 * @example if(v::notEmpty()->validate($var))
 *
 */
class ShopProduto extends AppModel
{

    public $name = 'ShopProduto';
    public $useDbConfig = 'default';
    public $useTable = 'shop_produto';
    public $primaryKey = 'id_produto';

    private $id_shop;
    private $sku;
    private $id_marca;
    private $id_produto;


    /**
     * @param mixed $id_shop
     * @return ShopProduto
     */
    public function setIdShop($id_shop)
    {
        $this->id_shop = $id_shop;
        return $this;
    }

    /**
     * @param mixed $id_marca
     */
    public function setIdMarca($id_marca)
    {
        $this->id_marca = $id_marca;
        return $this;
    }

    /**
     * @param mixed $id_produto
     */
    public function setIdProduto($id_produto)
    {
        $this->id_produto = $id_produto;
        return $this;
    }


    /**
     * @param mixed $sku
     * @return ShopProduto
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }


    /**
     * Total Produto em Uso
     * @param Shop $shop
     * @return array|null
     */
    public function totalProdutoUso(Shop $shop)
    {
        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
            }

            if (empty($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop');
            }

            $conditions = array(
                'conditions' => array(
                    'ShopProduto.parente_id' => 0,
                    'ShopProduto.ativo' => 'True',
                    'ShopProduto.lixo' => 'False',
                    'ShopProduto.id_shop_default' => $shop->getIdShop()
                )
            );

            return $this->find('count', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Get o último produto
     * @return mixed
     */
    public function getUltimoID()
    {

        try {

            $dados = $this->find('first',
                array(
                    'fields' => array('ShopProduto.id_produto'),
                    'order' => array('ShopProduto.id_produto' => 'desc')
                )
            );

            return $dados['ShopProduto']['id_produto'];

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    /**
     * Pega o ID do Produto via SKU
     * @return bool
     */
    private function getIdProdutoSKU()
    {

        try {

            $conditions = array(
                'fields' => array(
                    'ShopProduto.id_produto'
                ),
                'conditions' => array(
                    'ShopProduto.sku' => $this->sku,
                    'ShopProduto.parente_id' => 0,
                    'ShopProduto.id_shop_default' => $this->id_shop
                )
            );

            if ($this->find('count', $conditions) > 0) {
                $data = $this->find('first', $conditions);
                return $data['ShopProduto']['id_produto'];
            } else {
                return false;
            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        }

    }


    /**
     * etorna o ID do produto pai
     * @param string $id_shop
     * @param string $sku
     * @return bool
     */
    public function getIdProdutoPaiViaSKU()
    {

        try {

            if (!v::numeric()->notBlank()->validate($this->id_shop)) {
                throw new \LogicException("Valor obrigatório: Informe o id_shop.", E_USER_NOTICE);
            }

            if (!v::stringType()->notEmpty()->validate($this->sku)) {
                throw new \LogicException("Valor obrigatório: Informe o sku.", E_USER_NOTICE);
            }

            $id_produto = self::getIdProdutoSKU();

            if (v::numeric()->positive()->validate($id_produto)) {

                $fields = array(
                    'ShopProduto.tipo' => sprintf("'%s'", 'atributo'),
                );

                $conditions = array(
                    'ShopProduto.id_produto' => $id_produto,
                    'ShopProduto.id_shop_default' => $this->id_shop
                );

                $upOK = $this->updateAll($fields, $conditions);

                if (v::type('bool')->validate($upOK)) {
                    return $id_produto;
                }

                throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);

            } else {
                return false;
            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }


    /**
     * Verifica se existe o Produto via Marca
     * @param string $id_shop
     * @param string $id_produto
     * @param string $id_marca
     * @return bool
     */
    private function verificaProdutoMarcaExiste()
    {

        try {

            $conditions = array(
                'conditions' => array(
                    'ShopProduto.id_shop_default' => $this->id_shop,
                    'ShopProduto.id_produto' => $this->id_produto,
                    'ShopProduto.id_marca !=' => $this->id_marca
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
     * Conta o total de produto via SKU
     * @return int
     */
    public function getTotalProdutoSKU()
    {

        try {

            if (!v::numeric()->notBlank()->validate($this->id_shop)) {
                throw new \LogicException("Valor obrigatório: Informe o id_shop.", E_USER_NOTICE);
            }

            if (!v::notBlank()->validate($this->sku)) {
                throw new \LogicException("Valor obrigatório: Informe o sku.", E_USER_NOTICE);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopProduto.sku' => $this->sku,
                    'ShopProduto.id_shop_default' => $this->id_shop
                )
            );

            return (int)$this->find('count', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

}
