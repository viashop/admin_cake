<?php

use Respect\Validation\Validator as v;



/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 *
 * @see Respect/Validation
 * @link https://github.com/Respect/Validation/blob/master/docs/VALIDATORS.md Documentação
 * @example if(v::notEmpty()->validate($var))
 */
class ShopProdutoCategoria extends AppModel
{

    public $name = 'ShopProdutoCategoria';
    public $useTable = 'shop_produto_categoria';
    public $useDbConfig = 'default';

    private $id_produto;
    private $id_categoria;

    /**
     * @param mixed $id_produto
     * @return ShopProdutoCategoria
     */
    public function setIdProduto($id_produto)
    {
        $this->id_produto = $id_produto;
        return $this;
    }

    /**
     * @param mixed $id_categoria
     * @return ShopProdutoCategoria
     */
    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
        return $this;
    }

    /**
     * Conta o Total Produto Categoria
     */
    private function getTotalNumRows()
    {
        try {

            $conditions = array(
                'conditions' => array(
                    'ShopProdutoCategoria.id_produto_default' => $this->id_produto,
                    'ShopProdutoCategoria.categoria_primaria' => 'True',
                    'ShopProdutoCategoria.id_categoria_default' => $this->id_categoria
                ),
                'limit' => 1
            );

            return $this->find('count', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /**
     * Adciona categoria via importacao
     */
    public function addCategoriaProdutoViaImportacao()
    {

        try {

            if (!v::numeric()->notBlank()->validate($this->id_produto)) {
                throw new \LogicException("Informe o ID do produto", E_USER_NOTICE);
            }

            if (!v::numeric()->notBlank()->validate($this->id_categoria)) {
                throw new \LogicException("Informe a id_categoria", E_USER_NOTICE);
            }

            if (self::getTotalNumRows() <= 0) {

                $data = array(
                    'id_produto_default' => $this->id_produto,
                    'categoria_primaria' => 'True',
                    'id_categoria_default' => $this->id_categoria
                );

                $saveOK = $this->saveAll($data);

                if (!v::type('bool')->validate($saveOK)) {
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
