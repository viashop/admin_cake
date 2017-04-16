<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 15:48
 */

namespace AppVialoja\Interfaces\Model;
use Shop;
use ShopEnvio;
use ShopEnvioCorreios;

interface IShopEnvioCorreios
{

    /**
     * Obter todos os Dados
     * @param Shop $shop
     * @return array|null
     */
    public function getAll(Shop $shop);

    /**
     * Obter Arrays para usar em IN
     * @param Shop $shop
     * @return array
     */
    public function obterArrayIds(Shop $shop);

    /**
     * Cadastra o tipo de frete de origem das encomendas
     * @param Shop $shop
     * @param ShopEnvio $envio
     * @param ShopEnvioCorreios $correios
     */
    public function addEnvioWizard(Shop $shop, ShopEnvio $envio, ShopEnvioCorreios $correios);

}