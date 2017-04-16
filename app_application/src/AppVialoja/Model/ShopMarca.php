<?php

use Lib\Tools;
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
class ShopMarca extends AppModel
{

    public $name = 'ShopMarca';
    public $useTable = 'shop_marca';
    public $primaryKey = 'id_marca';
    public $useDbConfig = 'default';

    private $id_shop;
    private $nome;

    /**
     * @param mixed $id_shop
     * @return ShopMarca
     */
    public function setIdShop($id_shop)
    {
        $this->id_shop = $id_shop;
        return $this;
    }

    /**
     * @param mixed $nome
     * @return ShopMarca
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getIdMarca()
    {
        try {

            if (!v::notEmpty()->validate($this->id_shop)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "id_shop", E_USER_NOTICE);
            }

            if (!v::notEmpty()->validate($this->nome)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "nome", E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'ShopMarca.id_marca'
                ),
                'conditions' => array(
                    'ShopMarca.id_shop_default' => $this->id_shop,
                    'ShopMarca.nome' => $this->nome
                )
            );

            if ($this->find('count', $conditions) > 0) {
                $dados = $this->find('first', $conditions);
                return $dados['ShopMarca']['id_marca'];
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Retorna todas as Marcas
     * @return array|null
     */
    public function getAllMarcas()
    {
        try {

            if (!v::notEmpty()->validate($this->id_shop)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "id_shop", E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'ShopMarca.id_marca',
                    'ShopMarca.nome'
                ),
                'conditions' => array(
                    'ShopMarca.nome !=' => '',
                    'ShopMarca.id_shop_default' => $this->id_shop
                ),
                'order' => array(
                    'ShopMarca.nome' => 'ASC'
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
     * Verfica se a Marca já foi cadastrada
     * @return int
     */
    private function getTotalNumRows()
    {
        try {

            $conditions = array(
                'conditions' => array(
                    'ShopMarca.nome' => $this->nome,
                    'ShopMarca.id_shop_default' => $this->id_shop
                ),
                'limit' => 1
            );

            return $this->find('count', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /**
     * Add Marca de Produto enviado via XLS
     */
    public function adicionaMarcaViaImportacao()
    {

        try {

            if (!v::notEmpty()->validate($this->id_shop)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "id_shop", E_USER_NOTICE);
            }

            if (!v::notEmpty()->validate($this->nome)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "nome", E_USER_NOTICE);
            }

            if (self::getTotalNumRows() <= 0) {

                $data = array(
                    'id_shop_default' => (int)$this->id_shop,
                    'nome' => $this->nome,
                    'apelido' => Tools::slug($this->nome),
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
