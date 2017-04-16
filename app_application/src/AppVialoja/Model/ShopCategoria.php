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
 */
class ShopCategoria extends AppModel
{

    public $name = 'ShopCategoria';
    public $useTable = 'shop_categoria';
    public $primaryKey = 'id_categoria';
    public $useDbConfig = 'default';

    private $id_shop;
    private $id_categoria;
    private $categoria_parent_id = 0;
    private $nome_categoria;

    /**
     * @param mixed $id_shop
     * @return ShopCategoria
     */
    public function setIdShop($id_shop)
    {
        $this->id_shop = $id_shop;
        return $this;
    }

    /**
     * @param mixed $id_categoria
     * @return ShopCategoria
     */
    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
        return $this;
    }


    /**
     * @param int $categoria_parent_id
     * @return ShopCategoria
     */
    public function setCategoriaParentId($categoria_parent_id)
    {
        $this->categoria_parent_id = $categoria_parent_id;
        return $this;
    }

    /**
     * @param mixed $nome_categoria
     * @return ShopCategoria
     */
    public function setNomeCategoria($nome_categoria)
    {
        $this->nome_categoria = $nome_categoria;
        return $this;
    }

    /**
     * Verifica se exista uma categoria filha
     * @return bool
     */
    public function isParentCategoria()
    {
        try {

            if (!v::numeric()->notBlank()->validate($this->categoria_parent_id)) {
                throw new \LogicException(ERROR_LOGIC_VAR. "categoria_parent_id do tipo INT.", E_USER_NOTICE);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopCategoria.categoria_parent_id' => $this->categoria_parent_id
                ),
                'limit' => 1

            );

            if ($this->find('count', $conditions) > 0)
                return true;
            return false;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Corrige a Flag de Posições NLeft na Tabela
     */
    public function corrigePosicaoNLeft()
    {
        try {

            if (!v::numeric()->notBlank()->validate($this->id_categoria)) {
                throw new \LogicException(ERROR_LOGIC_VAR. "ID do tipo INT.", E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'ShopCategoria.categoria_parent_id'
                ),

                'conditions' => array(
                    'ShopCategoria.id_categoria' => $this->id_categoria
                )
            );

            $cat_parent = $this->find('first', $conditions);

            $conditions = array(
                'fields' => array(
                    'ShopCategoria.nleft'
                ),
                'conditions' => array(
                    'ShopCategoria.id_categoria' => $cat_parent['ShopCategoria']['categoria_parent_id']
                )
            );

            $dados = $this->find('first', $conditions);

            $fields = array(
                'ShopCategoria.nleft' => sprintf("'%s'", $dados['ShopCategoria']['nleft'] + 1)
            );

            $conditions = array(
                'ShopCategoria.id_categoria' => $this->id_categoria
            );

            $this->updateAll($fields, $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }


    /**
     * Get Nome da Categoria
     * @return array
     */
    public function getNomeCategoriaArrayFirst()
    {
        try {

            if (!v::numeric()->notBlank()->validate($this->id_categoria)) {
                throw new \LogicException(ERROR_LOGIC_VAR. "ID do tipo INT.", E_USER_NOTICE);
            }

            if (!v::numeric()->notBlank()->validate($this->id_shop)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "id_shop.", E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'ShopCategoria.nome_categoria'
                ),
                'conditions' => array(
                    'ShopCategoria.id_categoria' => $this->id_categoria,
                    'ShopCategoria.id_shop_default' => $this->id_shop
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
     * Retorna o ID da Categoria pego via nome
     *
     * @internal AppModel $this->find('count', $conditions)
     * @internal AppModel $this->find('first', $conditions)
     * @return bool|int
     */
    public function getIdCategoria()
    {
        try {

            if (!v::numeric()->notBlank()->validate($this->id_shop)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "id_shop.", E_USER_NOTICE);
            }

            if (!v::notEmpty()->validate($this->nome_categoria)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "nome_categoria.", E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'ShopCategoria.id_categoria'
                ),
                'conditions' => array(
                    'ShopCategoria.id_shop_default' => $this->id_shop,
                    'ShopCategoria.nome_categoria' => $this->nome_categoria
                ),
                'limit' => 1
            );

            if (!empty($this->categoria_parent_id) && v::numeric()->notBlank()->validate($this->categoria_parent_id)) {
                $conditions['conditions']['ShopCategoria.categoria_parent_id'] = $this->categoria_parent_id;
            }

            if ($this->find('count', $conditions) > 0) {
                $dados = $this->find('first', $conditions);
                return $dados['ShopCategoria']['id_categoria'];
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Retorna a Posição da Categoria
     *
     * @internal AppModel $this->find('count', $conditions)
     * @internal AppModel $this->find('first', $conditions)
     * @return bool|int
     */
    private function getNleftImportacao()
    {
        try {

            $conditions = array(
                'fields' => array(
                    'ShopCategoria.nleft',
                ),
                'conditions' => array(
                    'id_shop_default' => $this->id_shop,
                    'id_categoria' => $this->categoria_parent_id
                ),
            );

            if ($this->find('count', $conditions) > 0) {
                $dados = $this->find('first', $conditions);
                return $dados['ShopCategoria']['nleft'] + 1;
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /**
     * Salva dados de importação
     *
     * @see private function getNleftImportacao()
     * @internal Tools::slug($this->nome_categoria)
     *
     * @internal AppModel saveAll($data)
     * @internal AppModel getInsertID()
     * @internal AppModel $this->find('count', $conditions)
     * @return bool|int
     */
    private function salvaDadosImportacao()
    {

        try {

            $conditions = array(
                'conditions' => array(
                    'ShopCategoria.id_shop_default' => $this->id_shop,
                    'ShopCategoria.nome_categoria' => $this->nome_categoria
                )
            );

            if ($this->find('count', $conditions) <= 0) {

                $data = array(
                    'id_shop_default' => (int)$this->id_shop,
                    'categoria_parent_id' => (int)$this->categoria_parent_id,
                    'nome_categoria' => (string)$this->nome_categoria,
                    'apelido' => (string)Tools::slug($this->nome_categoria),
                    'url' => (string)Tools::slug($this->nome_categoria),
                    'nleft' => (int)self::getNleftImportacao()
                );

                $salveOk = $this->saveAll($data);

                if (v::type('bool')->validate($salveOk)) {
                    return $this->getInsertID();
                }

                throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Add Categoria de Produto enviado via XLS
     * @see private function getIdCategoria()
     * @see private function salvaDadosImportacao()
     * @return bool|int
     */
    public function adicionaCategoriaViaImportacao()
    {

        try {

            if (!v::numeric()->notBlank()->validate($this->id_shop)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "id_shop.", E_USER_NOTICE);
            }

            if (!v::notEmpty()->validate($this->nome_categoria)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "nome_categoria.", E_USER_NOTICE);
            }

            if (!is_numeric($this->categoria_parent_id)) {
                throw new \LogicException(ERROR_LOGIC_VAR . "categoria_parent_id do tipo INT.", E_USER_NOTICE);
            }

            $id_categoria = self::getIdCategoria();
            if ($id_categoria === null) {
                $id_categoria = self::salvaDadosImportacao();
            }
            return $id_categoria;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}
