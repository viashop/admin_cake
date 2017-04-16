<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 27/09/16 às 14:55
 * @see Respect/Validation
 * @link https://github.com/Respect/Validation/blob/master/docs/VALIDATORS.md Documentação
 * @example if(v::notEmpty()->validate($var))
 */

use Respect\Validation\Validator as v;

class ShopEnvio extends AppModel
{

    use \AppVialoja\Traits\Entity\TShopEnvio;

	public $name = 'ShopEnvio';
    public $useTable = 'shop_envio';
    public $useDbConfig = 'default';

    private $id_shop;
    private $id_envio;
    private $ativo;
    private $ok;
    private $ajax = false;

    /**
     * Recebe dados para Gravar no Banco
     * @param array $array
     * @see private function saveData($v='')
     */
    public function addEnvioFormaWizard(Shop $shop, ShopEnvio $envio)
    {

        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
            }

            if (!is_array($envio->getIdEnvio())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdEnvio Array');
            }

            $this->id_shop = $shop->getIdShop();
            $this->ativo = $shop->getAtivo();

            foreach ($envio->getIdEnvio() as $v) {
                self::saveData($v);
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Deleta as formas de envio caso usuario volte
     * @param Shop $shop
     */
    public function deleteWizard(Shop $shop)
    {

        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
            }

            $conditions = array(
                'ShopEnvio.id_shop_default' => $shop->getIdShop()
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
     * Recebe dados para Gravar no Banco
     * @param array $array
     * @see private function saveData($v='')
     */
    public function addEnvioForma($array=array())
    {
        try {

            $this->id_shop = $array['id_shop'];
            $this->id_envio = $array['id_envio'];
            $this->ativo = $array['ativo'];

            if (v::type('bool')->validate($array['ajax']) && $array['ajax'] === true) {
                $this->ajax = true;
            }

            if (!v::numeric()->notBlank()->validate($this->id_shop)) {
                throw new \LogicException("Valor obrigatório: Informe a @var id_shop corretamente.", E_USER_NOTICE);
            }

            if (!v::notBlank()->validate($this->id_envio)) {
                throw new \LogicException("Valor obrigatório: Informe a @var id_envio corretamente.", E_USER_NOTICE);
            }

            if (!v::notBlank()->validate($this->ativo)) {
                throw new \LogicException("Valor obrigatório: Informe a @var ativo corretamente.", E_USER_NOTICE);
            }

            if (v::arrayVal()->notBlank()->validate($this->id_envio)) {
                foreach ($this->id_envio as $v) {
                    self::saveData((int)$v);
                }
            } else {
                self::saveData((int)$this->id_envio);
            }

        } catch (\PDOException $e) {

            if ($this->request->is('ajax')) {
                echo 'error_exception';
            }
            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Salva as informações no DB
     * @param string $v
     * @see private function isAjax()
     * @internal saveAll($data)
     * @internal updateAll($fields, $conditions)
     * @internal find('count', $conditions)
     */
    private function saveData($v)
    {

        $conditions = array(
            'conditions' => array(
                'ShopEnvio.id_shop_default' => $this->id_shop,
                'ShopEnvio.id_envio' => $v
            )
        );

        if ($this->find('count', $conditions) <= 0) {

            $data = array(
                'id_shop_default' => $this->id_shop,
                'id_envio' => $v
            );

            if (!$this->saveAll($data)) {
                throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
            }

            $this->ok = $this->getInsertID();

        } else {

            $fields = array(
                'ShopEnvio.ativo' => sprintf("'%s'", $this->ativo)
            );

            $conditions = array(
                'ShopEnvio.id_envio' => $v,
                'ShopEnvio.id_shop_default' => $this->id_shop
            );

            if (!$this->updateAll($fields, $conditions)) {
                throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
            }

            $this->ok = $this->getAffectedRows();

        }

        self::isAjax();

    }

    /**
     * Verifica se o Arquivo foi enviado via ajax
     */
    private function isAjax()
    {
        if ($this->ajax === true) {
            if (v::numeric()->notBlank()->validate($this->ok)) {
                die('ok');
            } else {
                die('error');
            }
        }
    }

}
