<?php

/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 18/10/16 às 00:31
 */
use AppVialoja\Interfaces\Model\IShopEnvioCorreios;

class ShopEnvioCorreios extends AppModel implements IShopEnvioCorreios
{

	public $name = 'ShopEnvioCorreios';
    public $useTable = 'shop_envio_correios';
    public $useDbConfig = 'default';

    use \AppVialoja\Traits\Entity\TShopEnvioCorreios;

    /**
     * Obter todos os Dados
     * @param Shop $shop
     * @return array|null
     */
    public function getAll(Shop $shop)
	{
		try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
            }

			$conditions = array(

                'fields' => array(

                    'ShopEnvioCorreios.taxa_tipo',
                    'ShopEnvioCorreios.taxa_valor',
                    'ShopEnvioCorreios.com_contrato',
                    'ShopEnvioCorreios.codigo_servico',
                    'ShopEnvioCorreios.codigo',
                    'ShopEnvioCorreios.senha',
                    'ShopEnvioCorreios.mao_propria',
                    'ShopEnvioCorreios.valor_declarado',
                    'ShopEnvioCorreios.aviso_recebimento',
                    'ShopEnvioCorreios.ativo',
                    'ShopEnvioCorreios.cep_origem',
                    'ShopEnvioCorreios.prazo_adicional',
                    'ShopEnvio.ativo',
                    'CodigoCorreios.nome',
                    'ShopEnvio.ativo'

                ),

                'conditions' => array(
                    'ShopEnvioCorreios.id_shop_default' => $shop->getIdShop(),
                    'ShopEnvioCorreios.codigo_servico !=' => '',
                    'ShopEnvio.ativo' => 'True',
                ),

                'joins' => array(

                    array(
                        'table' => 'shop_envio',
                        'alias' => 'ShopEnvio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopEnvio.id_envio = ShopEnvioCorreios.id_envio_default'
                        )
                    ),

                    array(
                        'table' => 'codigo_correios',
                        'alias' => 'CodigoCorreios',
                        'type' => 'INNER',
                        'conditions' => array(
                            'CodigoCorreios.codigo = ShopEnvioCorreios.codigo_servico'
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
     * Obter Arrays para usar em IN
     * @param Shop $shop
     * @return array
     */
    public function obterArrayIds(Shop $shop)
    {
        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
            }

            $conditions = array(
                'conditions' => array(
                    'ShopEnvioCorreios.id_shop_default' => $shop->getIdShop()
                )
            );

            $envios = $this->find('all', $conditions);

            $arrayIds = array();
            foreach ($envios as $envio) {
                array_push($arrayIds, $envio['ShopEnvioCorreios']['id_envio_default']);
            }

            return $arrayIds;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Cadastra o tipo de frete de origem das encomendas
     * @param Shop $shop
     * @param ShopEnvio $envio
     * @param ShopEnvioCorreios $correios
     */
    public function addEnvioWizard(Shop $shop, ShopEnvio $envio, ShopEnvioCorreios $correios)
    {
        try {

            $data = array(
                'id_shop_default' => $shop->getIdShop(),
                'id_envio_default' => $envio->getIdEnvio(),
                'cep_origem' => $correios->getCepOrigem(),
                'codigo_servico' => $correios->getCodigoServico()
            );

            if (!$this->saveAll($data)) {
                throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}
