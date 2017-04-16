<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 24/10/16 às 02:09
 */
use AppVialoja\Interfaces\Model\ICliente;
use Respect\Validation\Validator as v;

class Cliente extends AppModel implements ICliente
{

    public $name = 'Cliente';
    public $useTable = 'cliente';
    public $primaryKey = 'id_cliente';
    public $useDbConfig = 'default';

    use \AppVialoja\Traits\Entity\TCliente;

    /**
     * Efetua login
     * @access public
     */
    public function emailExistsRetornaDados(Cliente $cliente)
    {

        try {

            if (empty($cliente->getEmail())) {
                throw new \LogicException("Valide as configurações do e-mail.", E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'Cliente.id_cliente',
                    'Cliente.id_shop_grupo',
                    'Cliente.id_shop',
                    'Cliente.id_default_grupo',
                    'Cliente.nome',
                    'Cliente.email',
                    'Cliente.nivel',
                    'Cliente.senha',
                    'Cliente.ativo',
                    'Cliente.security_key'
                ),
                'conditions' => array(
                    'Cliente.email' => $cliente->getEmail()
                )
            );

            if ($this->find('count', $conditions) <= 0) {
                throw new \Exception\VialojaEmailNotFoundException();
            }

            return $this->find('first', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\NotFoundException $e) {
            throw new \Exception($e->getMessage(), E_USER_WARNING);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Lista dados do Cliente
     * @param Cliente $cliente
     * @return array|null
     * @throws Exception
     */
    public function obterDadosIdCliente(Cliente $cliente)
    {

        try {

            if (empty($cliente->getIdCliente())) {
                throw new \LogicException(ERROR_LOGIC_VAR . "getIdCliente", E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'Cliente.*'
                ),
                'conditions' => array(
                    'Cliente.id_cliente' => $cliente->getIdCliente()
                )
            );

            if ($this->find('count', $conditions) <= 0) {
                throw new \Exception\VialojaNotFoundException();
            }

            return $this->find('first', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\NotFoundException $e) {
            throw new \Exception($e->getMessage(), E_USER_WARNING);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Verifica ss existe o Token de Segurança
     * @param Cliente $cliente
     * @return array|null
     * @throws Exception
     */
    public function existsToken(Cliente $cliente)
    {

        try {

            if (empty($cliente->getSecurityKey())) {
                throw new \LogicException(ERROR_LOGIC_VAR . "SecurityKey", E_USER_NOTICE);
            }

            $conditions = array(
                'conditions' => array(
                    'Cliente.email' => $cliente->getSecurityKey()
                )
            );

            if ($this->find('count', $conditions) <= 0) {
                return false;
            }

            return true;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\NotFoundException $e) {
            throw new \Exception($e->getMessage(), E_USER_WARNING);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Ativa a conta por meio de tokem
     * @param Cliente $cliente
     * @return array|null
     * @throws Exception
     */
    public function ativarContaViaToken(Cliente $cliente)
    {

        try {

            if (empty($cliente->getSecurityKey())) {
                throw new \LogicException(ERROR_LOGIC_VAR . "SecurityKey", E_USER_NOTICE);
            }

            $ok = $this->updateAll(
                array(
                    'Cliente.ativo' => true
                ),
                array(
                    'Cliente.security_key' => $cliente->getSecurityKey()
                )
            );

            if (!$ok) {
                throw new \RuntimeException();
            }

            return true;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\NotFoundException $e) {
            throw new \Exception($e->getMessage(), E_USER_WARNING);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Obter dados de Conta por meio de token
     * @param Cliente $cliente
     * @return array|null
     * @throws Exception
     */
    public function obterDadosContaViaToken(Cliente $cliente)
    {

        try {

            if (empty($cliente->getSecurityKey())) {
                throw new \LogicException(ERROR_LOGIC_VAR . "SecurityKey", E_USER_NOTICE);
            }

            $conditions = array(
                'fields' => array(
                    'Cliente.id_cliente',
                    'Cliente.email',
                    'Cliente.nivel',
                    'Cliente.ativo',
                    'Cliente.conta_auto_login'
                ),
                'conditions' => array(
                    'Cliente.security_key' => $cliente->getSecurityKey()
                )
            );

            return $this->Cliente->find('first', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\NotFoundException $e) {
            throw new \Exception($e->getMessage(), E_USER_WARNING);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Efetua login
     * @access public
     */
    public function emailExists(Cliente $cliente)
    {

        try {

            if (empty($cliente->getEmail())) {
                throw new \LogicException("Valide as configurações do e-mail.", E_USER_NOTICE);
            }

            $conditions = array(
                'conditions' => array(
                    'Cliente.email' => $cliente->getEmail()
                )
            );

            if ($this->find('count', $conditions) <= 0) {
                return false;
            }

            return true;

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\NotFoundException $e) {
            throw new \Exception($e->getMessage(), E_USER_WARNING);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Listar Usuários
     * @param Shop $shop
     * @return array|null
     */
    public function listar(Shop $shop)
    {
        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
            }

            $conditions = array(

                'fields' => array(
                    'Cliente.id_cliente',
                    'Cliente.nome',
                    'Cliente.nivel',
                    'Cliente.email'
                ),
                'conditions' => array(
                    'Cliente.id_shop' => $shop->getIdShop()
                ),
                'order' => array('Cliente.nivel' => 'DESC')
            );

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Remove Auto Login de conta
     * @param Cliente $cliente
     */
    public function removeAutoLogin(Cliente $cliente)
    {

        try {

            if (!is_int($cliente->getIdCliente())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdCliente int');
            }

            $fields = array(
                'Cliente.conta_auto_login' => sprintf("'%s'", 'False')
            );

            $conditions = array(
                "Cliente.id_cliente" => $cliente->getIdCliente()
            );

            $ok = $this->updateAll($fields, $conditions);
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
     * Add Nome e Senha via Wizard
     * @param Cliente $cliente
     * @return bool
     */
    public function addNomeSenhaWizard(Cliente $cliente)
    {

        try {

            if (!is_int($cliente->getIdCliente())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdCliente int');
            }

            $fields = array(
                'Cliente.nome' => sprintf("'%s'", $cliente->getNome()),
                'Cliente.senha' => sprintf("'%s'", $cliente->getSenha())
            );

            $conditions = array(
                'Cliente.id_cliente' => $cliente->getIdCliente()
            );

            $this->updateAll($fields, $conditions);
            if ($this->getAffectedRows() > 0) {
                return true;
            } else {
                return false;
            }


        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Altera o Nível do Cliente para Administrar loja
     * @param Cliente $cliente
     * @return bool
     */
    public function alterarNivel(Shop $shop, Cliente $cliente)
    {

        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
            }

            if (!is_int($cliente->getIdCliente())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdCliente int');
            }

            $fields = array(
                'Cliente.id_shop' => $shop->getIdShop(),
                'Cliente.nivel' => 4
            );

            $conditions = array(
                'Cliente.id_cliente' => $cliente->getIdCliente()
            );

            $this->updateAll($fields, $conditions);
            if ($this->getAffectedRows() > 0) {
                return true;
            } else {
                return false;
            }

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

    /**
     * Altera a Senha Via Recuperação via token
     * @param Cliente $cliente
     * @return bool
     */
    public function alteraSenhaViaRecuperacao(Cliente $cliente)
    {

        try {

            if (!is_int($cliente->getIdCliente())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdCliente int');
            }

            $fields = array(
                'Cliente.senha' => sprintf("'%s'", $cliente->getSenha()),
                'Cliente.ultima_troca_senha' => 'NOW()',
                'Cliente.ip' => sprintf("'%s'", $cliente->getIp())
            );

            $conditions = array(
                'Cliente.id_cliente' => $cliente->getIdCliente()
            );

            $ok = $this->updateAll($fields, $conditions);

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
     * Cadastra os dados para o novo Usuário Administrativo loja
     * @param Shop $shop
     * @param Cliente $cliente
     * @return bool
     */
    public function addDadosConviteAceitar(Shop $shop, Cliente $cliente)
    {

        try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
            }

            $data = array(
                'id_shop' => $shop->getIdShop(),
                'nome' => $cliente->getNome(),
                'nivel' => $cliente->getNivel(),
                'ativo' => $cliente->getAtivo(),
                'email' => $cliente->getEmail(),
                'senha' => $cliente->getSenha(),
                'ip' => $cliente->getIp(),
                'security_key' => $cliente->getSecurityKey()
            );

            if (!$this->saveAll($data)) {
                return false;
            }

            return $this->getLastInsertId();

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        } catch (\LogicException $e) {
            \Exception\VialojaInvalidLogicException::errorHandler($e);
        }

    }

}
