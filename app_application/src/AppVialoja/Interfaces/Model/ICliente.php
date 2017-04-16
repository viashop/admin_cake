<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 24/10/16 às 02:09
 */

namespace AppVialoja\Interfaces\Model;
use Shop;
use Cliente;
use Exception;

interface ICliente
{

    /**
     * Efetua login
     * @access public
     */
    public function emailExistsRetornaDados(Cliente $cliente);

    /**
     * Lista dados do Cliente
     * @param Cliente $cliente
     * @return array|null
     * @throws Exception
     */
    public function obterDadosIdCliente(Cliente $cliente);

    /**
     * Verifica ss existe o Token de Segurança
     * @param Cliente $cliente
     * @return array|null
     * @throws Exception
     */
    public function existsToken(Cliente $cliente);

    /**
     * Ativa a conta por meio de tokem
     * @param Cliente $cliente
     * @return array|null
     * @throws Exception
     */
    public function ativarContaViaToken(Cliente $cliente);

    /**
     * Obter dados de Conta por meio de token
     * @param Cliente $cliente
     * @return array|null
     * @throws Exception
     */
    public function obterDadosContaViaToken(Cliente $cliente);

    /**
     * Efetua login
     * @access public
     */
    public function emailExists(Cliente $cliente);

    /**
     * Listar Usuários
     * @param Shop $shop
     * @return array|null
     */
    public function listar(Shop $shop);

    /**
     * Remove Auto Login de conta
     * @param Cliente $cliente
     */
    public function removeAutoLogin(Cliente $cliente);

    /**
     * Add Nome e Senha via Wizard
     * @param Cliente $cliente
     * @return bool
     */
    public function addNomeSenhaWizard(Cliente $cliente);

    /**
     * Altera o Nível do Cliente para Administrar loja
     * @param Cliente $cliente
     * @return bool
     */
    public function alterarNivel(Shop $shop, Cliente $cliente);

    /**
     * Altera a Senha Via Recuperação via token
     * @param Cliente $cliente
     * @return bool
     */
    public function alteraSenhaViaRecuperacao(Cliente $cliente);

    /**
     * Cadastra os dados para o novo Usuário Administrativo loja
     * @param Shop $shop
     * @param Cliente $cliente
     * @return bool
     */
    public function addDadosConviteAceitar(Shop $shop, Cliente $cliente);

}