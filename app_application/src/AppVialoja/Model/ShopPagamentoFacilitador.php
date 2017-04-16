<?php



class ShopPagamentoFacilitador extends AppModel {

	public $name = 'ShopPagamentoFacilitador';
	public $useDbConfig = 'default';
	public $useTable = 'shop_pagamento_facilitador';

	public function getIdPagamentoFacilitador($id_shop='', $id_facilitador='')
	{
		try {

			if (empty($id_shop)) {
				throw new \LogicException("Informe o SHOP_ID da loja", 1);
			}

			if (empty($id_facilitador)) {
				throw new \LogicException("Informe o ID do Facilitador", 1);
			}

			$conditions = array(

				'fields' => array(

		            'ShopPagamentoFacilitador.id_config_pagamento',
		            'ShopPagamentoFacilitador.id_pagamento_default',
		            'ShopPagamentoFacilitador.usuario',
		            'ShopPagamentoFacilitador.token',
		            'ShopPagamentoFacilitador.valor_minimo_aceitavel',
		            'ShopPagamentoFacilitador.valor_minimo_parcela',
		            'ShopPagamentoFacilitador.mostrar_parcelamento',
		            'ShopPagamentoFacilitador.maximo_parcelas',
		            'ShopPagamentoFacilitador.parcelas_sem_juros',
		            'ShopPagamentoFacilitador.li_msg',
				),

                'conditions' => array(
                    'ShopPagamentoFacilitador.id_shop_default'=> $id_shop,
	                'ShopPagamentoFacilitador.id_config_pagamento' => intval( $id_facilitador )
                )

            );

            return $this->find('first', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
