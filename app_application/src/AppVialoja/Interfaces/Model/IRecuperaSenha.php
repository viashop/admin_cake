<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 24/10/16 às 15:37
 */

namespace AppVialoja\Interfaces\Model;

use Cliente;

interface IRecuperaSenha
{

    /**
     * Deletar Registro de Recuperação de Senha
     * @param int $id
     */
    public function deletarIDRecuperarSenha(Cliente $cliente);

    /**
     * Salvar novos dados para recuperar senha
     * @param \stdClass $std
     */
    public function salvarNovoPedidoDeRecuperacao(\stdClass $std);

    /**
     * Verifica se o Hash Existe
     * @param \stdClass $std
     */
    public function hashExists(\stdClass $std);

    /**
     * Altera o Status Hash
     * @param \stdClass $std
     */
    public function alteraStatusHash(\stdClass $std);


    /**
     * Verifica se o Hash Existe
     * @param \stdClass $std
     */
    public function obterIdCliente(\stdClass $std);
}