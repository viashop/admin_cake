<?php

App::uses('AppController', 'Controller');

class CepController extends AppController {

	public $uses = array('ShopEnvio', 'ShopEnvioCorreios', 'ShopEnvioMotoboy', 'ShopEnvioPessoalmente', 'ShopEnvioTransportadora', 'ShopEnvioPersonalizado', 'ConfiguracaoEnvio', 'CodigoCorreios', 'ShopFreteGratis');

	public $layout = false;

	/**
	 * Calcula o preço do frete
	 * @access public
	 * @param String $cep_destino
	 * @param Array $conditions
	*/
	public function calcular() {

		if (!$this->request->is('ajax')) {
			return false;
		}

		$id_shop_default = intval(Tools::getValue('loja'));
		$cep_destino  = Tools::getValue('cep');
		$peso = Tools::getValue('peso');
		$altura = Tools::getValue('altura');
		$largura = Tools::getValue('largura');
		$comprimento = Tools::getValue('comprimento');
		$preco_produto = (string) Tools::getValue('preco');

		$this->Session->write('cep_calcular_produto_ajax', $cep_destino);

		$arr_return_frete = array();

		try {

			$res_frete = $this->ShopFreteGratis->verificaFreteGratis($id_shop_default, $cep_destino, $preco_produto);

			if ($res_frete===true) {
				$this->set('frete_gratis', true);
			} else {

				$envio_formas = $this->ShopEnvioCorreios->getAll( $id_shop_default );
				$simuladorFrete = new \Correios\Simulador\Frete();
				$arr_return_frete['envio_correios'] = $simuladorFrete->calcular($cep_destino,$peso,$altura,$largura,$comprimento,$envio_formas);

			}

		} catch (Exception $e) {

			$this->set('erro', $e->getMessage());

		}

        /**
		 * Retorna valor do frete via motoboy
		 * @return array
		 */
		$envio_motoboy = $this->ShopEnvioMotoboy->getValorFrete( $id_shop_default, $cep_destino, $peso );
        $arr_return_frete['envio_motoboy'] = $envio_motoboy;

        /**
		 * Retorna RetirarPessoalmente
		 * @return array
		 */
		$envio_pessoalmente = $this->ShopEnvioPessoalmente->getRetirarPessoalmente( $id_shop_default, $cep_destino );
        $arr_return_frete['envio_pessoalmente'] = $envio_pessoalmente;

        /**
		 * Retorna valor do frete via transportadora
		 * @return array
		 */
		$envio_transportadora = $this->ShopEnvioTransportadora->readValorFreteTransportadora( $id_shop_default, $cep_destino, $peso );
        $arr_return_frete['envio_transportadora'] = $envio_transportadora;

        /**
		 * Retorna valor do frete personalisado
		 * @return array
		 */
		$envio_personalizado = $this->ShopEnvioPersonalizado->getValorFrete( $id_shop_default, $cep_destino, $peso );
        $arr_return_frete['envio_personalizado'] = $envio_personalizado;

    	$this->set(compact('id_shop_default'));
        $this->set(compact('arr_return_frete'));
        $this->set(compact('envio_formas'));

	}

}
