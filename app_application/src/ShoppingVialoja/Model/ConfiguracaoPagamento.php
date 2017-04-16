<?php

use Lib\Validate;
App::uses('Model', 'Model');

class ConfiguracaoPagamento extends AppModel {
	
    public $name = 'ConfiguracaoPagamento';
    public $useTable = 'configuracao_pagamento';
    public $primaryKey = 'id_config_pagamento';
    public $useDbConfig = 'default';
	
	/** 
	 * Lista todos os pagamentos ativos na plataforma
     * @access public
     * @return array
	*/
	public function getPagamentoJoinAll($id_shop='')
	{
		try {

			$conditions = array( 

                'fields' => array(
                    
                    'Shop.id_plano',
                    'ConfiguracaoPagamento.id_config_pagamento',
                    'ConfiguracaoPagamento.nome',
                    'ConfiguracaoPagamento.logo',
                    'ConfiguracaoPagamento.slug',
                    'ShopPagamento.ativo',
                    'ShopPagamentoFacilitador.id_config_pagamento',
                    'ShopPagamentoFacilitador.id_pagamento_default',
                    'ShopPagamentoFacilitador.usuario',
                    'ShopPagamentoFacilitador.token',
                    'ShopPagamentoDeposito.*',
                    'ShopPagamentoDepositoConfig.*',
                    'ShopPagamentoBoleto.*',
                    
                ),

                'conditions' => array(
                    'ConfiguracaoPagamento.ativo' => 1,
                ),
                
                'order' => array(
                    'ConfiguracaoPagamento.id_config_pagamento' => 'ASC'
                ),                
           
                'group' => array('ConfiguracaoPagamento.id_config_pagamento'),
                //'limit' => 25,

                'joins' => array(

                    array(
                        'table' => 'shop',
                        'alias' => 'Shop',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Shop.id_shop'  => $id_shop
                        )
                    ),

                    array(
                        'table' => 'shop_pagamento',
                        'alias' => 'ShopPagamento',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopPagamento.id_config_pagamento = ConfiguracaoPagamento.id_config_pagamento',
                            'ShopPagamento.id_shop_default = Shop.id_shop'
                        )
                    ),

                    array(
                        'table' => 'shop_pagamento_facilitador',
                        'alias' => 'ShopPagamentoFacilitador',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopPagamentoFacilitador.id_pagamento_default = ShopPagamento.id_pagamento'
                        )
                    ),

                    array(
                        'table' => 'shop_pagamento_deposito',
                        'alias' => 'ShopPagamentoDeposito',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopPagamentoDeposito.id_pagamento_default = ShopPagamento.id_pagamento'
                        )
                    ),

                    array(
                        'table' => 'shop_pagamento_deposito_config',
                        'alias' => 'ShopPagamentoDepositoConfig',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopPagamentoDepositoConfig.id_pagamento_deposito_default = ShopPagamentoDeposito.id',
                            'ShopPagamentoDepositoConfig.ativo' => "True"
                        )
                    ),

                    array(
                        'table' => 'shop_pagamento_boleto',
                        'alias' => 'ShopPagamentoBoleto',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'ShopPagamentoBoleto.id_pagamento_default = ShopPagamento.id_pagamento'
                        )
                    ),                   
                  
                ),

            );

			return $this->find('all', $conditions);			

		} catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

    /**
     * Recupera as formas as formas de pagamento do shop
     * @param string $arrayIds
     * @return array|null
     */
	public function getPagamentoIN($arrayIds='')
	{
		try {

			if (empty( $arrayIds ) ) {
				throw new LogicException("Valor obrigatório: Informe os arrayIds ", 1);
			}

			if (!is_array( $arrayIds ) ) {
				throw new LogicException("Valor obrigatório: Informe os arrayIds em Array()", 1);
			}

            $conditions = array(

				'conditions' => array(
						'ConfiguracaoPagamento.id_config_pagamento' => array_map('intval', $arrayIds )
					)

            );

			return $this->find('all', $conditions);

		} catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}
	
	
	/** 
	 * Recupera as formas as formas de pagamento do shop 
	 * @access public 
	 * @param String $arrayIds IDs do método de pagamento
     * @return array
	*/
	public function getPagamentoId( $id='' )
	{
		try {

			if (empty($id ) ) {
				throw new LogicException("Valor obrigatório: Informe o id ", 1);
			}

			if (!Validate::isInt( $id ) ) {
				throw new LogicException("Valor obrigatório: Valor tem que ser do tipo INT", 1);
			}

			if (isset($id)) {		

	            $conditions = array(
					'conditions' => array(
						'ConfiguracaoPagamento.id_config_pagamento' => $id
					)
	            );

				return $this->find('first', $conditions);

			}

		} catch (PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

		} catch (LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

	
}
