<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 21/10/16 às 23:36
 */

namespace AppVialoja\Interfaces\Model;
use Shop;
use ClienteConvite;

interface IClienteConvite
{

    /**
     * Listar Usuário(s)
     * @param Shop $shop
     * @return array|null
     */
    public function listar(Shop $shop);

    /**
     * Deleta as os convites se existir
     * @param ClienteConvite $convite
     */
    public function deletar(ClienteConvite $convite);

    /**
     *  Recusar convite
     * @param ClienteConvite $convite
     */
    public function recusar(ClienteConvite $convite);

    /**
     * Verifica se existe Convite
     * @param ClienteConvite $convite
     * @return bool
     */
    public function existsConvite(ClienteConvite $convite);

    /**
     * Verifica se tem convite
     * @param ClienteConvite $convite
     * @return array|null
     */
    public function conviteDados(ClienteConvite $convite);

    /**
     * Deletar Convite
     * @param int $id
     */
    public function deletarId($id);

}