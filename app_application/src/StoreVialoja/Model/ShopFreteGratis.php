<?php

use Lib\Validate;
App::uses('Model', 'Model');

class ShopFreteGratis extends AppModel {

    public $name = 'ShopFreteGratis';
    public $useTable = 'shop_frete_gratis';
    public $primaryKey = 'id_frete';
    public $useDbConfig = 'default';

	/**
	 * Verificação de frete gratuito para regiões
	 * @return true para frete gratis
	 * @return false frete pago
	 * 
	 */
	public function verificaFreteGratis($id_shop='', $codigo_cep='', $preco_produto='')
	{
		try {

			if (!is_numeric($id_shop)) {
				throw new LogicException("Erro: Informe o ID da Loja", 1);				
			}

			$conditions = array(
                'fields' => array(
                    'ShopFreteGratis.regiao_name',
                    'ShopFreteGratis.regiao_valor'
                ),
                'conditions' => array(
                    'ShopFreteGratis.id_shop_default' => $id_shop
                )
            );
            
            $res_frete = $this->find('all', $conditions);

            if (Validate::isNotNull($res_frete)) {

            	$cep = isset($codigo_cep) ? !empty($codigo_cep) : null;

				$ufCep = new \Correios\Endereco\BuscaCep();
				$ufCep->retornaUFCep( intval( $cep ) );

            	$regiao = new \Commons\RegiaoBrasilFreteGratis();
            	$regiao_nome = $regiao->regiaoEstado( $ufCep->getUf() );

            	foreach ($res_frete as $frete) {

					if ($frete['ShopFreteGratis']['regiao_name'] == $regiao_nome) {
						if ($preco_produto > $frete['ShopFreteGratis']['regiao_valor'])
							return true;
						else
							return false;
					}

				}           

			} else {
				return false;
			}
			
		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);
			
		} catch (LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);
			
		}

	}

}
