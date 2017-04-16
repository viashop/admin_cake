<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 19/10/16 às 09:59
 */

namespace AppVialoja\Interfaces\Model;

use Shop;
use ShopDominio;

interface IShopDominio
{

    /**
     * Obter dados subdominio
     * @param Shop $shop
     * @return array|null
     */
    public function getIdFirstSubDominio(Shop $shop);

    /**
     * Obter dados dominio principal
     * @param Shop $shop
     * @return mixed
     */
    public function getDominioPrincipal(Shop $shop);

    /**
     * Obter dados dominio
     * @param Shop $shop
     * @return array|null
     */
    public function getAllDominio(Shop $shop);

    /**
     * Obter o VirtualUri dominio
     * @param Shop $shop
     * @return array|null
     */
    public function virtualUri(Shop $shop);

    /**
     * Obter o SubDominio dominio
     * @param Shop $shop
     * @param \stdClass $std
     * @return bool
     */
    public function obterResumoDominioTipo(Shop $shop, \stdClass $std);

    /**
     * Verifica se o Dominio já esta cadastrado
     * @param string $string
     * @return bool
     */
    public function exists($string = '');

    /**
     * Verifica o subdominio para excluir
     * @param Shop $shop
     * @return bool
     */
    public function removeSubdominio(Shop $shop);

    /**
     * Cadastra Subdominio
     * @param Shop $shop
     * @param ShopDominio $dominio
     * @return bool
     */
    public function cadastrarSubdominio(Shop $shop, ShopDominio $dominio);

}
