<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 07/09/16 às 17:55
 */

namespace AppVialoja\Interfaces\Model;
use Shop;
use ShopEnvio;
use ShopEnvioTransportadora;

interface IShopEnvioTransportadora
{

    /**
     * Retorna todos os Dados da Tabela transportes
     * @param Shop $shop
     * @return array|null
     */
    public function readTransportadora(Shop $shop);

    /**
     * Cadastrar Dados Transportadora
     * @param Shop $shop
     * @param ShopEnvio $envio
     * @param ShopEnvioTransportadora $trans
     */
    public function createTransportadora(Shop $shop, ShopEnvio $envio, ShopEnvioTransportadora $trans);

    /**
     * Lista faixa de CEPs para Transportadora Agrupando cep_inicio e cep_fim
     * @param Shop $shop
     * @return array|null
     */
    public function readTransportadoraGroupByFaixasCep(Shop $shop);

    /**
     * Remove todos os Dados da Tabela transportes
     * @param Shop $shop
     */
    public function deleteTransportadora(Shop $shop);

    /**
     * Retorna os valor do Frete para Transportadora
     * @param Shop $shop
     * @param ShopEnvioTransportadora $trans
     * @param \stdClass $std cep and peso
     * @return array|bool|null
     */
    public function readValorFreteTransportadora(Shop $shop, ShopEnvioTransportadora $trans, \stdClass $std);

}