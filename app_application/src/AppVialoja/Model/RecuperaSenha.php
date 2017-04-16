<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 24/10/16 às 15:037
 */
use AppVialoja\Interfaces\Model\IRecuperaSenha;

class RecuperaSenha extends AppModel implements IRecuperaSenha
{

    public $name = 'RecuperaSenha';
    public $useTable = 'cliente_recuperar';
    public $primaryKey = 'id_cliente';
    public $useDbConfig = 'default';

    /**
     * Deletar Registro de Recuperação de Senha
     * @param int $id
     */
    public function deletarIDRecuperarSenha(Cliente $cliente)
    {
        try {

            if (!is_int($cliente->getIdCliente())) {
                throw new \LogicException(ERROR_LOGIC_VAR . "getIdCliente", E_USER_NOTICE);
            }
            $this->id = $cliente->getIdCliente();
            if ($this->exists()) {
                $this->delete();
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Salvar novos dados para recuperar senha
     * @param \stdClass $std
     */
    public function salvarNovoPedidoDeRecuperacao(\stdClass $std)
    {
        try {

            $data = array(
                'id_cliente' => $std->id_cliente,
                'hash' => $std->hash,
                'ip' => $std->ip
            );

            if (!$this->saveAll($data)) {
                return false;
            }

            return $this->getLastInsertID();

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Verifica se o Hash Existe
     * @param \stdClass $std
     */
    public function hashExists(\stdClass $std)
    {
        try {

            $conditions = array(
                'conditions' => array(
                    'status' => 0,
                    'RecuperaSenha.hash' => $std->hash
                )
            );

            if ($this->find('count', $conditions) <= 0) {
                return false;
            }

            return true;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Altera o Status Hash
     * @param \stdClass $std
     */
    public function alteraStatusHash(\stdClass $std)
    {
        try {

            $ok = $this->updateAll(array(
                'RecuperaSenha.status' => 1
            ), array(
                'RecuperaSenha.hash' => $std->hash,
                'RecuperaSenha.created <=' => $std->created
            ));

            if (!$ok) {
                throw new \RuntimeException();
            }

            return true;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }


    /**
     * Verifica se o Hash Existe
     * @param \stdClass $std
     */
    public function obterIdCliente(\stdClass $std)
    {
        try {

            $conditions = array(
                'fields' => array(
                    'RecuperaSenha.id_cliente'
                ),
                'conditions' => array(
                    'RecuperaSenha.hash' => $std->hash,
                    'status' => 0
                )
            );

            if ($this->find('count', $conditions) > 0) {
                return $this->find('first', $conditions);
            }

            return false;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}
