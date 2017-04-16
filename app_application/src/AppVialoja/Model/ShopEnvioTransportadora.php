<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 07/09/16 às 16:46
 */

use AppVialoja\Interfaces\Model\IShopEnvioTransportadora;

class ShopEnvioTransportadora extends AppModel implements IShopEnvioTransportadora
{

    use \AppVialoja\Traits\Entity\TShopEnvioTransportadora;

    public $name = 'ShopEnvioTransportadora';
    public $useTable = 'shop_envio_transportadora';
    public $useDbConfig = 'default';

    /**
     * Retorna todos os Dados da Tabela transportes
     * @param Shop $shop
     * @return array|null
     */
    public function readTransportadora(Shop $shop)
    {
        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'id_shop int', E_USER_NOTICE);
            }

            $conditions = [
                'fields' => [
                    'ShopEnvioTransportadora.*',
                ],
                'conditions' => [
                    'ShopEnvioTransportadora.id_shop_default' => $shop->getIdShop()
                ],
            ];

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Validação de Dados da interface
     * @param Shop $shop
     * @param ShopEnvio $envio
     * @param ShopEnvioTransportadora $trans
     */
    private function isValidCreate(Shop $shop, ShopEnvio $envio, ShopEnvioTransportadora $trans)
    {

        if (!is_int($shop->getIdShop())) {
            throw new \LogicException(ERROR_LOGIC_VAR . 'id_shop', E_USER_NOTICE);
        }

        if (!is_int($envio->getIdEnvio())) {
            throw new \LogicException(ERROR_LOGIC_VAR . 'id_envio', E_USER_NOTICE);
        }

        if (empty($trans->getRegiao())) {
            throw new \LogicException(ERROR_LOGIC_VAR . 'regiao', E_USER_NOTICE);
        }

        if (empty($trans->getCepInicio())) {
            throw new \LogicException(ERROR_LOGIC_VAR . 'cep_inicio', E_USER_NOTICE);
        }

        if (empty($trans->getCepFim())) {
            throw new \LogicException(ERROR_LOGIC_VAR . 'cep_fim', E_USER_NOTICE);
        }

        if (!is_float($trans->getPesoInicial())) {
            throw new \LogicException(ERROR_LOGIC_VAR . 'peso_inicial', E_USER_NOTICE);
        }

        if (!is_float($trans->getPesoFinal())) {
            throw new \LogicException(ERROR_LOGIC_VAR . 'peso_final', E_USER_NOTICE);
        }

        if (!is_float($trans->getValor())) {
            throw new \LogicException(ERROR_LOGIC_VAR . 'valor', E_USER_NOTICE);
        }

        if (!intval($trans->getPrazoEntrega())) {
            throw new \LogicException(ERROR_LOGIC_VAR . 'prazo_entrega', E_USER_NOTICE);
        }

    }

    /**
     * Cadastrar Dados Transportadora
     * @param Shop $shop
     * @param ShopEnvio $envio
     * @param ShopEnvioTransportadora $trans
     */
    public function createTransportadora(Shop $shop, ShopEnvio $envio, ShopEnvioTransportadora $trans)
    {

        try {

            self::isValidCreate($shop, $envio, $trans);

            $data = [
                'id_shop_default' => $shop->getIdShop(),
                'id_envio_default' => $envio->getIdEnvio(),
                'regiao' => $trans->getRegiao(),
                'cep_inicio' => $trans->getCepInicio(),
                'cep_fim' => $trans->getCepFim(),
                'peso_inicial' => $trans->getPesoInicial(),
                'peso_final' => $trans->getPesoFinal(),
                'valor' => $trans->getValor(),
                'prazo_entrega' => $trans->getPrazoEntrega(),
                'ad_valorem' => $trans->getAdValorem(),
                'kg_adicional' => $trans->getKgAdicional()
            ];

            if (!$this->saveAll($data)) {
                throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
            }

        } catch (\PDOException $e) {

            if (isset($e->errorInfo[0]) && $e->errorInfo[0] !== '23000') {
                \Exception\VialojaDatabaseException::errorHandler($e);
            }

        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Lista faixa de CEPs para Transportadora Agrupando cep_inicio e cep_fim
     * @param Shop $shop
     * @return array|null
     */
    public function readTransportadoraGroupByFaixasCep(Shop $shop)
    {
        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'id_shop', E_USER_NOTICE);
            }

            $conditions = [

                'fields' => [
                    'ShopEnvioTransportadora.*'
                ],
                'conditions' => [
                    'ShopEnvioTransportadora.id_shop_default' => $shop->getIdShop()
                ],
                'group' => [
                    'ShopEnvioTransportadora.cep_inicio',
                    'ShopEnvioTransportadora.cep_fim'
                ],
                'order' => ['ShopEnvioTransportadora.id' => 'ASC']
            ];

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Remove todos os Dados da Tabela transportes
     * @param Shop $shop
     */
    public function deleteTransportadora(Shop $shop)
    {
        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'id_shop', E_USER_NOTICE);
            }

            $conditions = [
                'ShopEnvioTransportadora.id_shop_default' => $shop->getIdShop()
            ];

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
     * Calcula Kg Adicional
     * @param Shop $shop
     * @param \stdClass $std
     * @return array|bool
     */
    private function readCalcularKgAdicional(Shop $shop, \stdClass $std)
    {
        try {

            $conditions = array(
                'fields' => array(
                    'ShopEnvioTransportadora.regiao',
                    'ShopEnvioTransportadora.valor',
                    'ShopEnvioTransportadora.prazo_entrega',
                    'ShopEnvioTransportadora.peso_final',
                    'ShopEnvioTransportadora.kg_adicional'
                ),
                'conditions' => array(
                    'and' => array('? BETWEEN ShopEnvioTransportadora.cep_inicio 
                    AND ShopEnvioTransportadora.cep_fim 
                    AND ShopEnvioTransportadora.peso_final <= ?' => array($std->cep, $std->peso)),
                ),
                'joins' => array(
                    array(
                        'table' => 'shop_envio',
                        'alias' => 'ShopEnvio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvio.id_envio = ShopEnvioTransportadora.id_envio_default',
                            'ShopEnvio.ativo' => 'True',
                            'ShopEnvio.id_shop_default' => $shop->getIdShop()
                        )
                    ),

                ),
                'order' => array(
                    'ShopEnvioTransportadora.peso_inicial' => 'DESC',
                    'ShopEnvioTransportadora.peso_final' => 'DESC'
                ),
                'limit' => 1

            );

            if ($this->find('count', $conditions) > 0) {
                $array1 = $this->find('all', $conditions);
                $array2['calcular_kg_adicional'] = true;
                return (array_merge($array1, $array2));
            } else {
                return false;
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }

    }

    /**
     * Retorna os valor do Frete para Transportadora
     * @param Shop $shop
     * @param ShopEnvioTransportadora $trans
     * @param \stdClass $std cep and peso
     * @return array|bool|null
     */
    public function readValorFreteTransportadora(Shop $shop, ShopEnvioTransportadora $trans, \stdClass $std)
    {
        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'id_shop', E_USER_NOTICE);
            }

            if (!is_string($std->cep)) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'cep', E_USER_NOTICE);
            }

            if (!is_float($std->peso)) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'peso', E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'ShopEnvioTransportadora.regiao',
                    'ShopEnvioTransportadora.valor',
                    'ShopEnvioTransportadora.prazo_entrega'
                ),
                'conditions' => array(
                    'and' => array('? BETWEEN ShopEnvioTransportadora.cep_inicio 
                    AND ShopEnvioTransportadora.cep_fim 
                    AND ? BETWEEN ShopEnvioTransportadora.peso_inicial 
                    AND ShopEnvioTransportadora.peso_final' => array($std->cep, $std->peso)),
                ),
                'joins' => array(
                    array(
                        'table' => 'shop_envio',
                        'alias' => 'ShopEnvio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvio.id_envio = ShopEnvioTransportadora.id_envio_default',
                            'ShopEnvio.ativo' => 'True',
                            'ShopEnvio.id_shop_default' => $shop->getIdShop()
                        )
                    ),

                ),
                'order' => array(
                    'ShopEnvioTransportadora.cep_inicio' => 'DESC',
                    'ShopEnvioTransportadora.cep_fim' => 'DESC'
                ),
                'limit' => 1

            );

            if ($this->find('count', $conditions) > 0) {
                return $this->find('all', $conditions);
            } else {
                return self::readCalcularKgAdicional($shop, $std);
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}
