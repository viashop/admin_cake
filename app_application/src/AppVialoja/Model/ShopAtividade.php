<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/10/16 às 18:33
 */

use AppVialoja\Interfaces\Model\IShopAtividade;

class ShopAtividade extends AppModel implements IShopAtividade
{

    public $name = 'ShopAtividade';
    public $useTable = 'shop_atividade';
    public $primaryKey = 'id_atividade';
    public $useDbConfig = 'default';

    use \AppVialoja\Traits\Entity\TShopAtividade;

    /**
     * Add Atividades Loja
     * @param Shop $shop
     * @param ShopAtividade $atividade
     */
    public function addAtividade(Shop $shop, ShopAtividade $atividade)
    {

        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
            }

            if (!is_int($atividade->getIdAtividade())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdAtividade int', E_USER_NOTICE);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopAtividade.id_shop_default' => $shop->getIdShop(),
                    'ShopAtividade.id_atividade' => $atividade->getIdAtividade()
                )
            );

            if ($this->find('count', $conditions) <= 0) {

                $data = array(
                    'id_atividade' => $atividade->getIdAtividade(),
                    'id_shop_default' => $shop->getIdShop()
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

    /**
     * Deleta as os ids das ativadades se existir
     * @param Shop $shop
     */
    public function removerTodos(Shop $shop)
    {

        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
            }

            $conditions = array(
                'ShopAtividade.id_shop_default' => $shop->getIdShop()
            );

            if (!$this->deleteAll($conditions)) {
                throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Obter Configurações de Atividades
     * @param Shop $shop
     * @return array|null
     */
    public function listarTodasAtividadesJoin(Shop $shop)
    {

        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
            }

			$conditions = array(

                'fields' => array(
                    'ShopAtividade.id_atividade',
                    'ConfiguracaoAtividade.id_atividade',
                    'ConfiguracaoAtividade.nome'
                ),

                'conditions' => array(
                    'ShopAtividade.id_shop_default' => $shop->getIdShop()
                ),

                'order' => array(
                    'ConfiguracaoAtividade.nome' => 'ASC'
                ),

                'joins' => array(
                    array(
                        'table' => 'configuracao_atividade',
                        'alias' => 'ConfiguracaoAtividade',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopAtividade.id_atividade = ConfiguracaoAtividade.id_atividade'
                        )
                    ),

                ),

            );

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Retorna as Atividades em check
     * @param Shop $shop
     * @return mixed
     */
    public function allAtividadeSubQuery(Shop $shop)
    {
        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
            }

            $sql = ("SELECT
                  ConfiguracaoAtividade.id_atividade,
                  ConfiguracaoAtividade.nome,
                  ((SELECT 'checked' FROM shop_atividade AS ShopAtividade
                    WHERE ShopAtividade.id_shop_default = ?
                    AND ShopAtividade.id_atividade = ConfiguracaoAtividade.id_atividade)) AS checked
                    FROM configuracao_atividade AS ConfiguracaoAtividade");


            return $this->getDataSource()->fetchAll($sql, array($shop->getIdShop()));

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}
