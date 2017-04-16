<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 27/09/16 às 14:55
 */

use Respect\Validation\Validator as v;
use AppVialoja\Interfaces\Model\IShop;

class Shop extends AppModel implements IShop
{

    use \AppVialoja\Traits\Entity\TShop;

    public $name = 'Shop';
    public $useTable = 'shop';
    public $primaryKey = 'id_shop';
    public $useDbConfig = 'default';

	public function getIdTheme($id_shop='')
	{

		try {

			if(!is_numeric($id_shop)){
				throw new \LogicException('Informe o id do tipo INT');
			}

			$conditions = array(
				'fields' => array(
					'Shop.id_theme'
				),
				'conditions' => array(
					'Shop.id_shop' => $id_shop
				)
			);

			$dados = $this->find('first', $conditions);
			return $dados['Shop']['id_theme'];

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}


	/**
	 * Obter os dados do shop first
	 * @access public
	 * @param String $id_shop
	 * @return string
	 */
	public function getFirstAll($id_shop='')
	{
		try {

			if(!is_numeric($id_shop)){
				throw new \LogicException('Informe o id do tipo INT');
			}

			$conditions = array(
				'conditions' => array(
					'Shop.id_shop' => $id_shop
				)
			);

			return $this->find('first', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}


	/**
	 * Obter os dados do shop
	 * @access public
	 * @param String $id_shop
	 * @return string
	 */
	public function getAll($id_shop='')
	{
		try {

			if(!is_numeric($id_shop)){
				throw new \LogicException('Informe o id do tipo INT');
			}

			$conditions = array(
				'conditions' => array(
					'Shop.id_shop' => $id_shop
				)
			);

			return $this->find('all', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}



	/**
	 * Obter status e Id do Shop
	 * @access public
	 * @param String $id_shop
	 * @return string
	 */
	public function getIdStatusPlanoShop(Shop $shop)
	{
		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
			}

			$conditions = array(
				'fields' => array(
                    'Shop.id_plano',
                    'Shop.ativo',
                    'Shop.ativar_novos_planos',
                ),
            	'conditions' => array(
					'Shop.id_shop' => $shop->getIdShop()
                )
            );

            return $this->find('first', $conditions);

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

	/**
	 * Desativa o Shopping
	 */
	public function cancelarConta($id_shop='')
	{
		try {

			if (isset($id_shop)) {

	            $this->updateAll(

	                array(
		                'Shop.conta_cancelada' => "'True'",
		                'Shop.ativo' => 0,
		            ),
	                array(
	                    'Shop.id_shop' => $id_shop
	                )

	            );

	        }

		} catch (\Exception $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}


	/**
	 * Ativa a Shopping
	 */
	public function ativaContaCancelada($id_shop='', $status='')
	{
		try {

			if (isset($id_shop,$status)) {

	            $this->updateAll(
	                array(
		                'Shop.conta_cancelada' => "'False'",
		                'Shop.ativo' => $status,
		            ),
	                array(
	                    'Shop.id_shop' => $id_shop
	                )
	            );

	            if ($this->getAffectedRows()>0) {
	            	return true;
	            } else {

	            	$conditions = array(
		            	'conditions' => array(
		                    'Shop.id_shop' => $id_shop,
		                    'Shop.conta_cancelada' => 'False',
		                )
		            );

		            return $this->find('count', $conditions);
	            }

	        }

		} catch (\Exception $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	/**
     * Retorna o nome da loja
     * @param  int $id_shop Indentificação da loja
     * @return string
     */
    public function nomeLoja(Shop $shop)
    {
        try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int');
			}


			$conditions = array(
                'fields' => array(
                    'Shop.nome_loja'
                ),
                'conditions' => array(
                    'Shop.id_shop' => $shop->getIdShop()
                )
            );

            $dados = $this->find('first', $conditions);
            return $dados['Shop']['nome_loja'];

        } catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

    }

    /**
     * Retorna o status da Conta
     * @param  int $id_shop Indentificação da loja
     * @return string
     */
    public function getStatusContaCancelada($id_shop='')
    {
        try {

            $conditions = array(
                'fields' => array(
                    'Shop.conta_cancelada'
                ),
                'conditions' => array(
                    'Shop.id_shop' => $id_shop
                )
            );

            if ($this->find('count', $conditions) > 0) {
            	return $this->find('first', $conditions);
            } else {
            	return false;
            }

        } catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        }

    }


    /**
	 * Cadastra o ID do shop e faz um update na tabela usuario
	 * @access public
	 * @param String $id_cliente
	 * @return string
	 */
	public function cadastraShopId($id_cliente)
	{

		try {

			if (empty($id_cliente ) ) {
				throw new \LogicException("Obrigatório ID do cliente", 1);
			}

			if (!v::numeric()->notBlank()->validate($id_cliente)) {
				throw new \LogicException("Obrigatório ID do cliente do tipo INT", 1);
			}

			/**
			*
			* filter cadastro grupo admin
			*
			**/
			$conditions = array(
		        'conditions' => array('Shop.id_cliente' => $id_cliente)
		    );

			/**
			*
			* Verifica se já tem cadastro de admin
			*
			**/
			if ($this->find('count', $conditions) <= 0) {

				$data = array(
			        'id_cliente' => $id_cliente
			    );

				$ok = $this->saveAll($data);
				if (is_bool($ok) && $ok === true) {
					return true;
				} else {
					return false;
				}

			} else {
				return true;
			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 * Obter as logomarcas
	 * @param Shop $shop
	 * @return array|null
	 */
	public function getDadosLogomarca(Shop $shop)
	{
		try {

			$conditions = array(

                'fields' => array(
                    'Shop.logo',
                    'Shop.logo_social',
                    'Shop.background',
                    'Shop.favicon',
                    'Shop.nome_loja',
                	'Shop.email',
                    'ShopDominio.dominio'
                ),

                'conditions' => array(
					'Shop.id_shop' => $shop->getIdShop()
                ),

                'joins' => array(
                    array(
                        'table' => 'shop_dominio',
                        'alias' => 'ShopDominio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopDominio.id_shop_default = Shop.id_shop'
                        )
                    )
                )
            );

			return $this->find('first', $conditions );

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}


	/**
	 * Obter as logomarcas
	 * @access public
	 * @param String $id_shop
	 * @return string
	 */
	public function configuracaoPlanoShop(Shop $shop)
	{
		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
			}

			if (empty($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop', E_USER_NOTICE);
			}

			return $this->find('first', array(

                'fields' => array(
                    'Shop.*',
                    'PlanoShop.*',
                ),
            	'conditions' => array(
					'Shop.id_shop' => $shop->getIdShop(),
                ),

                'joins' => array(
                    array(
                        'table' => 'plano_shop',
                        'alias' => 'PlanoShop',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Shop.id_plano = PlanoShop.id_plano'
                        )
                    )
                )
            ));

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 * Obter nome do Shop
	 * @access public
	 * @param String $id_shop
	 * @return string
	 */
	public function getNomeLojaShop($id_shop='')
	{
		try {

			if ( empty( $id_shop ) ) {
				throw new \LogicException('Informe o ID do shop');
			}

			$dados = $this->find('first', array(
				'fields' => array(
                    'Shop.nome_loja'
                ),
            	'conditions' => array(
                    'Shop.id_shop' => $id_shop
                )
            ));

			if (v::notEmpty()->validate($dados)) {
            	return $dados['Shop']['nome_loja'];
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
	 * Obter o path da imagem
	 * @param Shop $shop
	 * @param \stdClass $std
	 * @return array|null
	 */
    public function getPathImagem(Shop $shop, \stdClass $std)
    {
        try {

            if (isset($std->column_path)) {
                $field = 'Shop.'. $std->column_path;
            } else {
                $field = 'Shop.'. $std->column_path;
            }

            $conditions = array(
                'fields' => array(
                    $field
                ),
                'conditions' => array(
                    'Shop.id_shop' => $shop->getIdShop()
                )
            );

            return $this->find('first', $conditions);

        } catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
        }

    }


	/**
	 * Remover o path da imagem
	 * @param Shop $shop
	 * @param \stdClass $std
	 */
	public function removePathImage(Shop $shop, \stdClass $std)
	{
		try {

			$fields = [
				"Shop.{$std->column_path}"  => null
			];

			$conditions = [
				'Shop.id_shop' => $shop->getIdShop()
			];

			if (!$this->updateAll($fields, $conditions)) {
				return true;
			} else {
				return false;
			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

	/**
	 * Update novo path da imagem
	 * @param Shop $shop
	 * @param \stdClass $std
	 */
	public function updateNewPathImage(Shop $shop, \stdClass $std)
	{
		try {

			$fields = [
				"Shop.{$std->column_path}"  => sprintf("'%s'", $std->img_name)
			];

			$conditions = [
				'Shop.id_shop' => $shop->getIdShop()
			];

			if (!$this->updateAll($fields, $conditions)) {
				return true;
			} else {
				return false;
			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}


	/**
	 * Cadastra o path da imagem via Wizard
	 * @param Shop $shop
	 * @param \stdClass $std
	 */
	public function updatePathImagemWizard(Shop $shop, \stdClass $std)
	{
		try {

			$fields = [
				'Shop.logo' => sprintf("'%s'", $std->img_name)
			];

			$conditions = [
				'Shop.id_shop' => $shop->getIdShop()
			];

			if (!$this->updateAll($fields, $conditions)) {
				throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
			}

			return true;

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

	/**
	 * Adiciona dados via Wizard
	 * @param Shop $shop
	 */
	public function addDadosWizard(Shop $shop)
	{

		try {

			if (!is_int($shop->getIdShop())) {
				throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop int', E_USER_NOTICE);
			}

			$fields = array(
				'Shop.nome_loja' => sprintf("'%s'", $shop->getNomeLoja()),
				'Shop.email' => sprintf("'%s'", $shop->getEmail()),
				'Shop.telefone' => sprintf("'%s'", $shop->getTelefone()),
				'Shop.modo' => sprintf("'%s'", $shop->getModo()),
				'Shop.copiar_dados' => sprintf("'%s'", $shop->getCopiarDados())
			);

			$conditions = array('Shop.id_shop' => $shop->getIdShop());

			if (!$this->updateAll($fields, $conditions)) {
				throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_NOTICE);
			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

}
