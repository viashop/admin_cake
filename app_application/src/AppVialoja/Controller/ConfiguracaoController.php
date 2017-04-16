<?php

use Lib\Tools;
use Lib\Validate;
use Respect\Validation\Validator as v;
use Lib\Blowfish;
use CSRF\CSRFGuard;

class ConfiguracaoController extends AppController {

	public $uses = array(
		'Shop',
		'ConfiguracaoPagamento',
		'ShopEnvio',
		'ShopEnvioPessoalmente',
		'ShopEnvioCorreios',
		'ConfiguracaoEnvio',
		'ShopPagamentoFacilitador',
		'ShopEnvioPersonalizado',
		'ShopEnvioPersonalizadoRegiao',
		'ShopEnvioPersonalizadoFaixa',
		'ShopEnvioPersonalizadoPeso',
		'CodigoCorreios',
		'Bancos',
		'BancosConfiguracao',
		'ShopEnvioTransportadora',
		'ShopEnvioMotoboy'
	);

	private $data;
	private $error = false;
	private $dados;
	private $res_banco;
	private $cpf_cnpj;
	private $status_pagamento;
	private $dados_pagamento;
	private $codigo_servico;
	private $codigo;
	private $json;
	private $datasource;

    /**
     * Configurações de pagamento
     */
	public function pagamento() {

		/**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

		try {

		} catch (\PDOException $e) {

		}

		$this->set('title_for_layout', 'Configurações da loja');


		$this->configCSRFGuard();

	}

	/**
	 * Calcula o preço do frete
	*/
	public function envioCalcular() {

		$arr_return_frete = array();


		if ($this->Shop instanceof Shop) {
			$this->Shop->setIdShop($this->Session->read('id_shop'));
		}

		//http://www.correios.com.br/para-voce/correios-de-a-a-z/pdf/calculador-remoto-de-precos-e-prazos/manual-de-implementacao-do-calculo-remoto-de-precos-e-prazos

		if ($this->request->is('post')) {

			try {

				if (Tools::getValue('cep') == '') {
					throw new \NotFoundException("Não foram encontradas formas de envio para o CEP informado.", E_USER_WARNING);
				}

				if (Tools::getValue('peso') == '') {
					throw new \NotFoundException("Informe o peso do produto", E_USER_WARNING);
				}

				try {

					/** Verifica o token CSRFGuard **/
	                $CSRFGuard = new CSRFGuard();

					if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
	                    throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
	                }

					if ($this->ShopEnvioCorreios instanceof ShopEnvioCorreios) {
						$envio_formas = $this->ShopEnvioCorreios->getAll($this->Shop);
					}

					$cep_destino = Tools::getValue('cep');
					$peso = Tools::getValue('peso');

					//checkbox
					if (Tools::getValue('checkbox') == 'on') {

						$comprimento = Tools::getValue('comprimento');
						$altura = Tools::getValue('altura');
						$largura = Tools::getValue('largura');

				    } else {

				    	$altura = 2;
				    	$largura = 11;
				    	$comprimento = 16;

					}

					$simuladorFrete = new \Correios\Simulador\Frete();
					$arr_return_frete['envio_correios'] =  $simuladorFrete->calcular($cep_destino, $peso,$altura,$largura,$comprimento,$envio_formas);
		            $this->set(compact('envio_formas'));

			    } catch (\Exception $e) {

			        $this->setMsgAlertError($e->getMessage());
			        $this->set('erro', $e->getMessage());

			    }

	    		/**
				 * Retorna valor do frete
				 * @return array
				 */
				$envio_motoboy = $this->ShopEnvioMotoboy->getValorFrete( $this->Session->read('id_shop') );
		        $arr_return_frete['envio_motoboy'] = $envio_motoboy;

		        /**
				 * Retorna RetirarPessoalmente
				 * @return array
				 */
				$envio_pessoalmente = $this->ShopEnvioPessoalmente->getRetirarPessoalmente( $this->Session->read('id_shop') );
		        $arr_return_frete['envio_pessoalmente'] = $envio_pessoalmente;

		        /**
				 * Retorna valor do frete via transportadora
				 * @return array
				 */
                if ($this->Shop instanceof Shop) {
                    $this->Shop->setIdShop($this->Session->read('id_shop'));
                }

				if ($this->ShopEnvioTransportadora instanceof ShopEnvioTransportadora) {

					$std = new \stdClass();
					$std->cep = Tools::clean(Tools::getValue('cep'));
					$std->peso = Tools::convertToDecimal(Tools::getValue('peso'));
					$arr_return_frete['envio_transportadora'] = $this->ShopEnvioTransportadora->readValorFreteTransportadora(
						$this->Shop,
						$this->ShopEnvioTransportadora,
						$std
					);

				}

		        /**
				 * Retorna valor do frete personalisado
				 * @return array
				 */
				$envio_personalizado = $this->ShopEnvioPersonalizado->getValorFrete( $this->Session->read('id_shop') );
		        $arr_return_frete['envio_personalizado'] = $envio_personalizado;

            } catch (\NotFoundException $e) {

		        $this->setMsgAlertError($e->getMessage());
		        $this->set('erro', $e->getMessage());

			}

		}

		$this->set('title_for_layout', 'Simulação de frete');
		$this->set(compact('arr_return_frete'));


		$this->configCSRFGuard();

	}

	/**
	 * Listas formas de envio
	*/
	public function envioListar() {

		try {

			$envio_forma = $this->ConfiguracaoEnvio->obterTodasAsConfiguracoesDeEnvio();
        	$this->set(compact('envio_forma'));

        	$conditions = array(
                'fields' => array(
                    'ShopEnvio.id_envio'
                ),
                'conditions' => array(
                    'ShopEnvio.ativo' => 'True',
                    'ShopEnvio.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            $formas_shop = $this->ShopEnvio->find('all', $conditions);

            $forma_envio_shop = array();
            foreach ($formas_shop as $forma) {
            	array_push($forma_envio_shop, $forma['ShopEnvio']['id_envio']);
            }

            $this->set(compact('forma_envio_shop'));

            $forma_envio_shop_personalizado = $this->ShopEnvioPersonalizado->envioListar( $this->Session->read('id_shop')  );
            $this->set(compact('forma_envio_shop_personalizado'));

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

		$diretorio = CDN_UPLOAD . $this->Session->read('id_shop') . '/';
		$this->set('imagem_envio_personalizado', $diretorio . 'envio-personalizado' . '/');

		$this->set('title_for_layout', 'Formas de envio');


		$this->configCSRFGuard();

	}

	/**
	 * Remove faixas de CEP para Motoboy
	 * @return string
	 */
	public function envioEditarMotoboyRegiao() {


		try {

			if (empty($this->request->params['pass']['5'])) {
				throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
			}

			if (!v::numeric()->notBlank()->validate($this->request->params['pass']['5'])) {
				throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
			}

			if ($this->request->is('post')) {

				$csrfGuard = new CSRFGuard();

				if (!$csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
					throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
				}

				$ok = $this->requestAction(array(
		            'controller' => 'ShopEnvioMotoboy',
		            'action' => 'deleta',
		            'id' => $this->request->params['pass']['5']
		        ));

	        	if (is_bool($ok) && $ok === true) {

	        		$this->setMsgAlertSuccess('A região e suas respectivas faixas de CEP e peso foram removidas com sucesso.');
					return $this->redirect(Tools::getValue('url_redirect'));

	        	} else {

	        		throw new \RuntimeException();

	        	}

	        }

		} catch (\NotFoundException $e) {

        	$this->setMsgAlertError($e->getMessage());
        	return $this->redirect($this->referer());

	    } catch (\InvalidArgumentException $e) {

	        $this->setMsgAlertError($e->getMessage());
			return $this->redirect(Tools::getValue('url_redirect'));

	    } catch (\RuntimeException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
			return $this->redirect(Tools::getValue('url_redirect'));

	    }

	    $faixa = $this->requestAction(array(
            'controller' => 'ShopEnvioMotoboy',
            'action' => 'getId',
            'id_envio' => $this->request->params['pass']['2'],
            'id' => $this->request->params['pass']['5']
        ));

        $this->set('regiao', $faixa['ShopEnvioMotoboy']['regiao']);

		$this->set('referer', $this->referer());
		$this->configCSRFGuard();
		$this->render('envio_remover_faixa_cep_regiao');

	}

	/**
	 * Remove faixas de CEP para Retira Pessoalmente
	 * @return string
	 */
	public function envioEditarPessoalmenteRegiao() {

		try {

			if (empty($this->request->params['pass']['5'])) {
				throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
			}

			if (!v::numeric()->notBlank()->validate($this->request->params['pass']['5'])) {
				throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
			}

			if ($this->request->is('post')) {


				$csrfGuard = new CSRFGuard();

				if (!$csrfGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
					throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
				}

				$ok = $this->requestAction(array(
		            'controller' => 'ShopEnvioPessoalmente',
		            'action' => 'deleta',
		            'id' => $this->request->params['pass']['5']
		        ));

	        	if (is_bool($ok) && $ok === true) {

	        		$this->setMsgAlertSuccess('A região e suas respectivas faixas de CEP e peso foram removidas com sucesso.');
					return $this->redirect(Tools::getValue('url_redirect'));

	        	} else {

	        		throw new \RuntimeException();

	        	}

	        }

		} catch (\NotFoundException $e) {

        	$this->setMsgAlertError($e->getMessage());
        	return $this->redirect($this->referer());

	    } catch (\InvalidArgumentException $e) {

	        $this->setMsgAlertError($e->getMessage());
			return $this->redirect(Tools::getValue('url_redirect'));

	    } catch (\RuntimeException $e) {

            $this->setMsgAlertError(ERROR_PROCESS);
			return $this->redirect(Tools::getValue('url_redirect'));

	    }

	    $faixa = $this->requestAction(array(
            'controller' => 'ShopEnvioPessoalmente',
            'action' => 'getId',
            'id_envio' => $this->request->params['pass']['2'],
            'id' => $this->request->params['pass']['5']
        ));

        $this->set('regiao', $faixa['ShopEnvioPessoalmente']['regiao']);

		$this->set('referer', $this->referer());
		$this->configCSRFGuard();
		$this->render('envio_remover_faixa_cep_regiao');


	}

	/**
	 * Edita as formas de envio
	*/
	public function envioEditar() {

		$this->set('title_for_layout', 'Configuração de forma de envio');

		$this->configCSRFGuard();

		try {

			if (!isset($this->request->params['pass']['3'])) {
	        	throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
	        }

	        if ($this->request->is('post')) {
                self::postEnvioEditar();
            }

		} catch (\Exception $e) {

			$this->setMsgAlertError($e->getMessage());
			return $this->redirect(array('controller' => $this->request->controller, 'action' => 'envio', 'listar'));

		}


		/**
		 * Status da foram de envio
		 * @var string
		 */
		$envio_ativo = self::checkEnvioStatus();
        $this->set(compact('envio_ativo'));

        switch ($this->request->params['pass']['3']) {

        		case 'sedex':
        		case 'e-sedex':
        		case 'pac':
        			self::getConfiguracoesCorreios();
        			$this->render('envio_correios');
        			break;

        		case 'motoboy':

					$faixas = $this->ShopEnvioMotoboy->getAll($this->Session->read('id_shop'));
		            $this->set(compact('faixas'));

        			$this->render('envio_motoboy');
        			break;

        		case 'transportadora':

					if (Tools::getValue('ativo') == 'True') {
	        			if ($this->request->is('post')) {
	        				self::importaTabelaTransportadora();
	        			}
	        		}

                    if ($this->Shop instanceof Shop) {
                        $this->Shop->setIdShop($this->Session->read('id_shop'));
                    }

					if ($this->ShopEnvioTransportadora instanceof ShopEnvioTransportadora) {
						$faixas = $this->ShopEnvioTransportadora->readTransportadoraGroupByFaixasCep($this->Shop);
					}

                    $this->set(compact('faixas'));

        			$id_envio = $this->request->params['pass']['2'];
        			$this->set(compact('id_envio'));

        			$this->render('envio_transportadora');
        			break;

        		case 'pessoalmente':
        			self::getConfiguracoesPessoalmente();
        			$this->render('envio_pessoalmente');
        			break;

        		default:
        			return $this->redirect(array('controller' => $this->request->controller, 'action' => 'envio', 'listar'));
        			break;
        	}

	}

	/**
	 * recebe Post formas de envio
	*/
	private function postEnvioEditar()
	{

		if (!$this->request->is('post')) {
            return $this->redirect( $this->referer() );
        }

		if (!isset($this->request->params['pass']['2'])) {
			throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
		}

		if (!is_numeric($this->request->params['pass']['2'])) {
			throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
		}

		if (Tools::getValue('ativo') == '') {
			throw new \Exception(ERROR_PROCESS, E_USER_WARNING);
		}


		if ($this->request->is('ajax')) {
			$ajax = true;
		}

		/**
		 * Add ou Altera Status
		 */
		$addEnvioForma = [
			'id_shop' => $this->Session->read('id_shop'),
			'id_envio' => $this->request->params['pass']['2'],
			'ativo' => Tools::getValue('ativo'),
			'ajax' => isset($ajax) ? true : false
		];

		$this->ShopEnvio->addEnvioForma($addEnvioForma);

		if ($this->request->is('ajax')) {

			if (v::numeric()->notBlank()->validate($this->ok)) {
				die('ok');
			} else {
				die('error');
			}

		}

		switch ($this->request->params['pass']['3']) {

    		case 'sedex':
    		case 'e-sedex':
    		case 'pac':
    			self::postConfiguracoesCorreios();
    			break;

    		case 'motoboy':
    			self::postConfiguracoesMotoboy();
    			break;

    		case 'transportadora':
    			self::postConfiguracoesTransportadora();
    			break;

    		case 'pessoalmente':
    			self::postConfiguracoesPessoalmente();
    			break;

    		default:
    			return $this->redirect(array('controller' => $this->request->controller, 'action' => 'envio', 'listar'));
    			break;
    	}

	}

	/**
	 * Cadastra dados Frete Correios
	 * @return string
	 */
	private function postConfiguracoesCorreios()
	{
		/**
		*
		* Add formas de envios correios
		*
		**/

		$this->datasource = $this->ShopEnvioCorreios->getDataSource();

		try {

			$this->datasource->begin();

			/**
			 *
			 * Verifica o token CSRFGuard
			 *
			 **/

			$CSRFGuard = new CSRFGuard();

			if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

				throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

			} else {

				$error = false;
				if (!v::postalCode('BR')->validate(Tools::getValue('cep_origem'))) {
					$error = true;
					$this->set('error_cep', true);
				}

				if (Tools::getValue('mao_propria') == 'on') {
					$mao_propria = 'S';
				} else {
					$mao_propria = 'N';
				}

				if (Tools::getValue('valor_declarado') == 'on') {
					$valor_declarado = 'S';
				} else {
					$valor_declarado = 'N';
				}

				if (Tools::getValue('aviso_recebimento') == 'on') {
					$aviso_recebimento = 'S';
				} else {
					$aviso_recebimento = 'N';
				}

				if ($error !== true) {

					$ok = $this->ShopEnvioCorreios->deleteAll(array(
                        'ShopEnvioCorreios.id_envio_default' => $this->request->params['pass']['2'],
		            	'ShopEnvioCorreios.id_shop_default' => $this->Session->read('id_shop')
                    ));

					if (Tools::getValue('com_contrato') == 'False') {

                    	$conditions = array(
			                'fields' => array(
			                    'CodigoCorreios.codigo'
			                ),
			                'conditions' => array(
			                    'CodigoCorreios.contrato' => 'False',
			                    'CodigoCorreios.default' => 'True',
			                    'CodigoCorreios.id_envio' => $this->request->params['pass']['2']
			                )
			            );

			            if ($this->CodigoCorreios->find('count', $conditions) > 0) {

			            	$this->codigo = $this->CodigoCorreios->find('first', $conditions);
			            	$this->codigo_servico = $this->codigo['CodigoCorreios']['codigo'];

			            } else {

							$this->codigo_servico = Tools::clean(Tools::getValue('codigo_servico'));

			            }

                    } else {

						$this->codigo_servico = Tools::clean(Tools::getValue('codigo_servico'));

                    }

                    if (isset($this->codigo_servico) && is_numeric($this->codigo_servico)) {

                    	$conditions = array(
	                        'conditions' => array(
	                            'ShopEnvioCorreios.id_envio_default' => $this->request->params['pass']['2'],
		                    	'ShopEnvioCorreios.id_shop_default' => $this->Session->read('id_shop')
	                        )
	                    );

	                    if ($this->ShopEnvioCorreios->find('count', $conditions) <= 0) {

	                    	$data = array(

								'cep_origem' => Tools::clean(Tools::getValue('cep_origem')),
								'prazo_adicional' => Tools::clean(Tools::getValue('prazo_adicional')),
								'taxa_tipo' => Tools::clean(Tools::getValue('taxa_tipo')),
								'taxa_valor' => Tools::convertToDecimal(Tools::getValue('taxa_valor')),
								'com_contrato' => Tools::clean(Tools::getValue('com_contrato')),
			                    'codigo_servico' => $this->codigo_servico,
								'codigo' => Tools::clean(Tools::getValue('codigo')),
								'senha' => Tools::clean(Tools::getValue('senha')),
			                    'mao_propria' => $mao_propria,
			                    'valor_declarado' => $valor_declarado,
			                    'aviso_recebimento' => $aviso_recebimento,
								'id_envio_default' => $this->request->params['pass']['2'],
								'id_shop_default' => $this->Session->read('id_shop')
							);

							$ok = $this->ShopEnvioCorreios->saveAll($data);

	                    }

		            }

		            if (is_bool($ok) && $ok === true) {

	                	$this->setMsgAlertSuccess('Forma de envio editada com sucesso.');
	                	return $this->redirect(array('controller' => $this->request->controller, 'action' => 'envio', 'listar'));

	                } else {

	                	throw new \RuntimeException();

	                }

	            }

			}

			$this->datasource->commit();

		} catch (\PDOException $e) {

			$this->datasource->rollback();
			$this->setMsgAlertError(ERROR_PROCESS);
			\Exception\VialojaDatabaseException::errorHandler($e);

	    } catch (\InvalidArgumentException $e) {

	        $this->setMsgAlertError($e->getMessage());

	    } catch (\RuntimeException $e) {

	        $this->setMsgAlertError(ERROR_PROCESS);

	    }

	}

	/**
	 * Cadastra dados Frete Motoboy
	 * @return string
	 */
	private function postConfiguracoesMotoboy()
	{
		try {

			$error = false;
			if (Tools::getValue('regiao') == '') {
				$error = true;
			}

			if (Tools::getValue('cep_inicio') == '') {
				$error = true;
			} else {

				if (!v::postalCode('BR')->validate(Tools::getValue('cep_inicio'))) {
					$error = true;
				}

				$cep_inicio = intval(Tools::getValue('cep_inicio'));
			}

			if (Tools::getValue('cep_fim') == '') {
				$error = true;
			} else {

				if (!v::postalCode('BR')->validate(Tools::getValue('cep_fim'))) {
					$error = true;
				}

				$cep_fim = intval(Tools::getValue('cep_fim'));
			}

			if (isset($cep_inicio) && isset($cep_fim)) {

				if ($cep_inicio > $cep_fim ) {
					$error = true;
					$this->setMsgAlertError('CEP inicial maior que o CEP final.');
				}

			}

			if (Tools::getValue('valor') == '') {
				$error = true;
			}

			if ($error !== true) {

				$ok = $this->requestAction(array(
		            'controller' => 'ShopEnvioMotoboy',
		            'action' => 'cadastra',
		            'id_envio' => $this->request->params['pass']['2']
		        ));

	            if (is_bool($ok) && $ok === true) {

                	$this->setMsgAlertSuccess('Faixa adicionada com sucesso.');

                } else {

                	throw new \RuntimeException('Não foi possível adicionar faixa de CEP.', E_USER_WARNING);

                }

            }

		} catch (\PDOException $e) {

			$this->datasource->rollback();;
	        $this->setMsgAlertError(ERROR_PROCESS);
			\Exception\VialojaDatabaseException::errorHandler($e);

	    } catch (\RuntimeException $e) {

	        $this->setMsgAlertError($e->getMessage());

	    }
	}

	/**
	 * Cadastra dados Frete Transportadora
	 * @return string
	 */
	private function postConfiguracoesTransportadora()
	{
		try {

		} catch (\PDOException $e) {

		}

	}

	/**
	 * Cadastra dados Frete Retirar Pessoalmente
	 * @return string
	 */
	private function postConfiguracoesPessoalmente()
	{
		try {

			$error = false;
			if (Tools::getValue('regiao') == '') {
				$error = true;
			}

			if (Tools::getValue('cep_inicio') == '') {
				$error = true;
			} else {

				if (!v::postalCode('BR')->validate(Tools::getValue('cep_inicio'))) {
					$error = true;
				}

				$cep_inicio = intval(Tools::getValue('cep_inicio'));
			}

			if (Tools::getValue('cep_fim') == '') {
				$error = true;
			} else {

				if (!v::postalCode('BR')->validate(Tools::getValue('cep_fim'))) {
					$error = true;
				}

				$cep_fim = intval(Tools::getValue('cep_fim'));
			}

			if (isset($cep_inicio) && isset($cep_fim)) {

				if ($cep_inicio > $cep_fim ) {
					$error = true;
					$this->setMsgAlertError('CEP inicial maior que o CEP final.');
				}

			}

			if ($error !== true) {

				$ok = $this->requestAction(array(
		            'controller' => 'ShopEnvioPessoalmente',
		            'action' => 'cadastra',
		            'id_envio' => $this->request->params['pass']['2']
		        ));

	            if (is_bool($ok) && $ok === true) {

                	$this->setMsgAlertSuccess('Faixa adicionada com sucesso.');

                } else {

                	throw new \RuntimeException('Não foi possível adicionar faixa de CEP.', E_USER_WARNING);

                }

            }

		} catch (\PDOException $e) {

			$this->datasource->rollback();;
	        $this->setMsgAlertError(ERROR_PROCESS);
			\Exception\VialojaDatabaseException::errorHandler($e);

	    } catch (\RuntimeException $e) {

	        $this->setMsgAlertError($e->getMessage());

	    }

	}

	/**
	 * Checa Status do Tipo de envio
	 * @return string True o False
	 */
	private function checkEnvioStatus()
	{

		try {

			$conditions = array(

				'fields' => array(
					'ShopEnvio.ativo'
				),

				'conditions' => array(
					'ShopEnvio.id_envio' => $this->request->params['pass']['2'],
					'ShopEnvio.id_shop_default' => $this->Session->read('id_shop')
				)
			);

			if ($this->ShopEnvio->find('count', $conditions) > 0) {
				$dados = $this->ShopEnvio->find('first', $conditions);
				return $dados['ShopEnvio']['ativo'];
			} else {
				return 'False';
			}

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	/**
	 * Retorna dados dos Correios Core e Shop
	 * @return array
	 */
	private function getConfiguracoesCorreios()
	{

		try {

			/**
			 *
			 * Mostra os dados para editar
			 *
			 **/
			$conditions = array(

				'fields' => array(
					'ShopEnvioCorreios.taxa_tipo',
					'ShopEnvioCorreios.taxa_valor',
					'ShopEnvioCorreios.com_contrato',
					'ShopEnvioCorreios.codigo',
					'ShopEnvioCorreios.senha',
					'ShopEnvioCorreios.mao_propria',
					'ShopEnvioCorreios.valor_declarado',
					'ShopEnvioCorreios.aviso_recebimento',
					'ShopEnvioCorreios.cep_origem',
					'ShopEnvioCorreios.prazo_adicional'
				),

				'conditions' => array(
					'ShopEnvioCorreios.id_envio_default' => $this->request->params['pass']['2'],
					'ShopEnvioCorreios.id_shop_default' => $this->Session->read('id_shop')
				)
			);

			$this->set('forma_envio_shop', $this->ShopEnvioCorreios->find('all', $conditions));

			/**
			 *
			 * Listar configurações de envio
			 *
			 **/
			$conditions = array(
				'fields' => array(
					'ConfiguracaoEnvio.logo',
					'ConfiguracaoEnvio.title'
				),
				'conditions' => array(
					'ConfiguracaoEnvio.id' => $this->request->params['pass']['2']
				)
			);

			$this->set('conf_envio', $this->ConfiguracaoEnvio->find('all', $conditions));

			/**
			 *
			 * Codigos dos correios
			 *
			 **/

			$conditions = array(
				'fields' => array(
					'CodigoCorreios.codigo',
					'CodigoCorreios.servico'
				),
				'conditions' => array(
					'CodigoCorreios.contrato' => 'True',
					'CodigoCorreios.id_envio' => $this->request->params['pass']['2']
				)
			);

			$this->set('code_contrato', $this->CodigoCorreios->find('all', $conditions));


		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	/**
	 * Envia tabela transportadora
	 * @return string
	 */
	private function importaTabelaTransportadora()
	{
        try {

            if (!isset($_FILES['arquivo'])) {
                throw new \InvalidArgumentException(ERROR_FILE_NOT_FOUND, E_USER_WARNING);
            }

            if (!isset($this->request->params['pass']['2'])) {
                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
            }

            $this->requestAction(array(
                'controller' => 'ImportacaoTransportadora',
                'action' => 'recebeDadosExcelXLSX',
                'id_envio_default' => $this->request->params['pass']['2']
            ));

        } catch (\InvalidArgumentException $e) {

            $this->setMsgAlertError($e->getMessage());

        } catch (\Exception $e) {

            $this->setMsgAlertError(ERROR_PROCESS);

        } finally {
            $this->redirect($this->referer());
        }

	}

	private function getConfiguracoesPessoalmente()
	{

		try {

			/**
			 * Lista os faixa de CEPs para Pessoalmente
			 * @var int id_envio
			 * @return array
			 */
			$faixas = $this->requestAction(array(
				'controller' => 'ShopEnvioPessoalmente',
				'action' => 'getAll',
				'id_envio' => $this->request->params['pass']['2']
			));

			$this->set(compact('faixas'));

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

    /**
     * Valida os dados do contrato com os correiso
     * @return bool
     */
	public function envioContratoValidar() {

		$this->layout = false;
		$this->render(false);

        try {

            if (!$this->request->is('post')) {
                throw new \InvalidArgumentException();
            }

            if (!$this->request->is('ajax')) {
                throw new \InvalidArgumentException();
            }


        } catch (\InvalidArgumentException $e) {
            return false;
        }



		try {

			if (Tools::getValue('codigo') == '') {
				throw new \NotFoundException("Você deve inserir o código administrativo.", E_USER_WARNING);
			}

			if (Tools::strlen(Tools::getValue('codigo')) !== 8) {
				throw new \InvalidArgumentException("Informe o código de 8 dígitos que consta no seu Cartão de Postagem.", E_USER_WARNING);
			}

			if (Tools::getValue('senha') == '') {
				throw new \NotFoundException("Você deve inserir a senha de acesso.", E_USER_WARNING);
			}

			if (Tools::strlen(Tools::getValue('senha')) !== 8) {
				throw new \InvalidArgumentException("Informe a senha de 8 dígitos. Caso não tenha alterado, a senha é formada pelos 8 primeiros dígitos do CNPJ da sua empresa.", E_USER_WARNING);
			}

			$ect = new \Correios\Calculos\Ect\ECT();
			$prdt = $ect->prdt();
			$prdt->setNVlAltura( 10 );
			$prdt->setNVlComprimento( 20 );
			$prdt->setNVlLargura( 20 );
			$prdt->setNCdFormato( ECTFormatos::FORMATO_CAIXA_PACOTE );
			$prdt->setNCdServico(Tools::getValue('servico'));
			$prdt->setSCepOrigem( '01310000' );
			$prdt->setSCepDestino( '01311000' );
			$prdt->setNVlPeso( 10 );
			$prdt->setNCdEmpresa(Tools::getValue('codigo'));
			$prdt->setSDsSenha(Tools::getValue('senha'));

		    if (count( $prdt->call() ) > 0 ) {

				foreach ( $prdt->call() as $servico ) {

					if($servico->Erro == 0) {

						$this->json['valido'] = true;
						$this->json['mensagem'] = 'Código administrativo e senha estão corretos.';

					} else {

						$this->json['valido'] = false;
						$this->json['mensagem'] = $servico->MsgErro;

					}

				}

				$this->json['estado'] = 'sucesso';

		    } else {
		    	throw new \RuntimeException(ERROR_PROCESS, E_USER_WARNING);
		    }

		} catch (\Exception $e) {

			$this->json['valido'] = false;
			$this->json['estado'] = 'sucesso';
			$this->json['mensagem'] = $e->getMessage();

		} finally {

			header('Content-Type: application/json');
            echo json_encode($this->json);
            exit();

		}

	}

	public function envioMotoboy() {

		$this->set('title_for_layout', 'Configuração de forma de envio');

	}

	public function envioTransportadora() {

		$this->set('title_for_layout', 'Configurar transportadora');

	}

	public function envioMotoboyRegiaoRemover() {

		$this->set('title_for_layout', 'Removendo região');

	}

	public function envioPersonalizadoCriar() {


		try {

			if ($this->request->is('post')) {

				/**
	             *
	             * Verifica o token CSRFGuard
	             *
	             **/
	            $CSRFGuard = new CSRFGuard();

				if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

	                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

	            }

                $erro = false;

                if (empty( $this->request->data['nome'] ) ) {

                    $erro = true;
                    $this->set('error_nome', true);

                }

                if (!empty( $this->request->data['taxa_valor'] ) ) {

					if (!Validate::isFloat($this->request->data['taxa_valor'])) {
                        $this->setMsgAlertError('Por favor, informe um valor válido.');
                        $erro = true;
                        $this->set('error_taxa_valor', true);
                    }

                }

	            if ($erro === false) {

	            	$this->requestAction(array(
			            'controller' => 'ShopEnvioPersonalizado',
			            'action' => 'cadastrar',
			        ));

	            }

			}

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());

		}

		$this->set('title_for_layout', 'Criando forma de envio Personalizado');
		$this->configCSRFGuard();

	}

	public function personalizadoRegiaoCriar() {

		self::getFormasEnvioPersonalizada();

		try {

			if ($this->request->is('post')) {

				/**
	             *
	             * Verifica o token CSRFGuard
	             *
	             **/
	            $CSRFGuard = new CSRFGuard();

				if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

	                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

	            }

	            $erro = false;
	            if (empty($this->request->data['nome'])) {
	            	$erro = true;
	            	$this->set('error_nome', true);
	            }

	            if (!empty($this->request->data['ad_valorem'])) {

	            	$ad_valorem = str_replace('%', '', $this->request->data['ad_valorem']);
	            	$ad_valorem = str_replace(',', '.', $ad_valorem);

					if (!Validate::isFloat($ad_valorem)) {
		            	$erro = true;
		            	$this->set('error_ad_valorem', true);
		            }

	            }

	            if (!empty($this->request->data['kg_adicional'])) {
					if (!Validate::isFloat($this->request->data['kg_adicional'])) {
		            	$erro = true;
		            	$this->set('error_kg_adicional', true);
		            }
	            }

	            if ($erro === true) {
		        	$this->setMsgAlertError(ERROR_FILE_INVALID_ARGUMENT);
		        }

	            if ($erro !== true) {

	            	$ok = $this->ShopEnvioPersonalizadoRegiao->cadastrar( $this->request->params['pass'][2] );

	            	if (isset($ok) && $ok==='23000') {
		        		$this->setMsgAlertError('Atenção: Região para o Frete Personalizado já existe, por favor escolha outro nome.');
		        	} else {
		        		if ($ok > 0) {
							$this->setMsgAlertSuccess('Região criada com sucesso.');
							return $this->redirect( array('controller' => 'configuracao', 'action' => 'envio', 'personalizado', $this->request->params['pass'][2], 'editar' ) );
						} else {
							$this->setMsgAlertError(ERROR_PROCESS);
						}
		        	}

	            }

			}

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());

		}

		$this->set('id_envio_personalizado', $this->request->params['pass'][2]);

		$this->set('title_for_layout', 'Criar região uma região para');
		$this->configCSRFGuard();

	}

	public function getFormasEnvioPersonalizada()
	{
		try {

			if (!isset($this->request->params['pass'][2])) {
				throw new \InvalidArgumentException(ERROR_PROCESS);
			}

			if (!is_numeric($this->request->params['pass'][2])) {
				throw new \InvalidArgumentException(ERROR_PROCESS);
			}

			$dados = $this->ShopEnvioPersonalizado->getEnvioId($this->Session->read('id_shop'), $this->request->params['pass'][2]);
			if (count($dados) <= 0) {
				throw new \NotFoundException('Forma de envio personalizada não encontrada!', E_USER_WARNING);
			}

			$this->dados = $dados;
			$this->set(compact('dados'));

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());
			$this->redirect($this->referer());

		} catch (\NotFoundException $e) {

			$this->setMsgAlertError($e->getMessage());
			$this->redirect($this->referer());

		}
	}

	public function personalizadoRegiaoEditar() {

		self::getFormasEnvioPersonalizada();

		try {

			if ($this->request->is('post')) {

				/**
	             *
	             * Verifica o token CSRFGuard
	             *
	             **/
	            $CSRFGuard = new CSRFGuard();

				if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

	                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

	            }

	            $erro = false;
	            if (empty($this->request->data['nome'])) {
	            	$erro = true;
	            	$this->set('error_nome', true);
	            }

	            if (!empty($this->request->data['ad_valorem'])) {

	            	$ad_valorem = str_replace('%', '', $this->request->data['ad_valorem']);
	            	$ad_valorem = str_replace(',', '.', $ad_valorem);

					if (!Validate::isFloat($ad_valorem)) {
		            	$erro = true;
		            	$this->set('error_ad_valorem', true);
		            }

	            }

	            if (!empty($this->request->data['kg_adicional'])) {
					if (!Validate::isFloat($this->request->data['kg_adicional'])) {
		            	$erro = true;
		            	$this->set('error_kg_adicional', true);
		            }
	            }

	            if ($erro === true) {
		        	$this->setMsgAlertError(ERROR_FILE_INVALID_ARGUMENT);
		        }

	            if ($erro !== true) {

	            	$ok = $this->ShopEnvioPersonalizadoRegiao->editar( $this->request->params['pass'][2], $this->request->params['pass'][4] );

	            	if (isset($ok) && $ok==='23000') {
		        		$this->setMsgAlertError('Atenção: Região para o Frete Personalizado já está em uso, por favor escolha outro nome.');
		        	} else {
		        		if ($ok > 0) {
							$this->setMsgAlertSuccess('Região editada com sucesso.');
							return $this->redirect( array('controller' => 'configuracao', 'action' => 'envio', 'personalizado', $this->request->params['pass'][2], 'editar' ) );
						} else {
							$this->setMsgAlertWarning(ERROR_UPDATE);
						}
		        	}

	            }

			}

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());

		}

		$nome_frete_personalizado = $this->dados['ShopEnvioPersonalizado']['nome'];
		$this->set(compact('nome_frete_personalizado'));

		$this->set('id_envio_personalizado', $this->request->params['pass'][2]);

		$regiao = $this->ShopEnvioPersonalizadoRegiao->regiaoId( $this->request->params['pass'][4] );
		$this->set( compact('regiao') );

		$this->set('title_for_layout', 'Editando região para '. $nome_frete_personalizado);
		$this->configCSRFGuard();

	}

	public function personalizadoRegiaoFaixaEditar() {

		self::getFormasEnvioPersonalizada();

		try {

			if ($this->request->is('post')) {

				/**
	             *
	             * Verifica o token CSRFGuard
	             *
	             **/
	            $CSRFGuard = new CSRFGuard();

				if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {
	                throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
	            }

				if (Tools::getValue('faixa_cep') == 'True') {
	            	self::personalizadoRegiaoFaixaCepCadastrar();
	            }

				if (Tools::getValue('faixa_peso') == 'True') {
	            	self::personalizadoRegiaoFaixaPesoCadastrar();
	            }

			}

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());

		}


		$nome_frete_personalizado = $this->dados['ShopEnvioPersonalizado']['nome'];
		$this->set(compact('nome_frete_personalizado'));

		$faixa_cep = $this->ShopEnvioPersonalizadoFaixa->faixaListar($this->request->params['pass'][2], $this->request->params['pass'][4]);
		$this->set( compact('faixa_cep') );

		$faixa_peso = $this->ShopEnvioPersonalizadoPeso->pesoListar($this->request->params['pass'][2], $this->request->params['pass'][4]);
		$this->set( compact('faixa_peso') );

		$regiao = $this->ShopEnvioPersonalizadoRegiao->regiaoId( $this->request->params['pass'][4] );
		$this->set( compact('regiao') );

		$this->set('title_for_layout', 'Editando faixa de CEP e Peso para '. $nome_frete_personalizado);
		$this->configCSRFGuard();

	}

	private function personalizadoRegiaoFaixaCepCadastrar()
	{

		$erro = false;
        if (!empty($this->request->data['cep_inicio'])) {
			if (!v::postalCode('BR')->validate($this->request->data['cep_inicio'])) {
            	$erro = true;
            	$this->set('error_cep_inicio', true);
            }
        } else {
        	$erro = true;
            $this->set('error_cep_inicio', true);
        }

        if (!empty($this->request->data['cep_fim'])) {

			if (!v::postalCode('BR')->validate($this->request->data['cep_fim'])) {
            	$erro = true;
            	$this->set('error_cep_fim', true);
            }

        } else {
        	$erro = true;
        	$this->set('error_cep_fim', true);
        }

		if (!v::numeric()->notBlank()->validate($this->request->data['prazo_entrega'])) {
        	$erro = true;
        	$this->set('error_prazo_entrega', true);
        }

        if (isset($this->request->data['cep_inicio'], $this->request->data['cep_fim'])) {

			if (intval($this->request->data['cep_inicio']) > intval($this->request->data['cep_fim'])) {
        		$erro = true;
        		$this->setMsgAlertError('CEP inicial maior que o CEP final.');
	            $this->set('error_cep_inicio', true);
	            $this->set('error_cep_fim', true);
        	}

        }

        if ($erro === true) {
        	$this->setMsgAlertError(ERROR_FILE_INVALID_ARGUMENT);
        }

        if ($erro !== true) {

        	$ok = $this->ShopEnvioPersonalizadoFaixa->cadastrar( $this->request->params['pass'][2], $this->request->params['pass'][4] );

        	if (isset($ok) && $ok==='23000') {
        		$this->setMsgAlertError('Atenção: Faixas de CEP, já encontra-se cadastradas.');
        	} else {
        		if ($ok > 0) {
					$this->setMsgAlertSuccess('Faixas CEP cadastradas com sucesso.');
				} else {
					$this->setMsgAlertError(ERROR_PROCESS);
				}
        	}

        } else {

        	$this->set(compact('erro'));

        }

	}

	/**
	 * Cadastrar faixa de Peso para região personalizada
	 * @return string
	 */
	private function personalizadoRegiaoFaixaPesoCadastrar()
	{

		$erro = false;
        if (empty($this->request->data['peso_inicio'])) {
			if (!v::postalCode('BR')->validate($this->request->data['peso_inicio'])) {
	            $erro = true;
	            $this->set('error_peso_inicio', true);
	        }
        }

        if (empty($this->request->data['peso_fim'])) {
        	$erro = true;
            $this->set('error_peso_fim', true);
        }

        if (empty($this->request->data['valor'])) {
        	$erro = true;
            $this->set('error_valor', true);
        }

       	if ($erro === true) {
        	$this->setMsgAlertError(ERROR_FILE_INVALID_ARGUMENT);
        }

        if (isset($this->request->data['peso_inicio'], $this->request->data['peso_fim'])) {

			if (intval($this->request->data['peso_inicio']) > intval($this->request->data['peso_fim'])) {
        		$erro = true;
        		$this->setMsgAlertError('PESO inicial maior que o PESO final.');
	            $this->set('error_peso_inicio', true);
	            $this->set('error_peso_fim', true);
        	}

        }

        if ($erro !== true) {

        	$ok = $this->ShopEnvioPersonalizadoPeso->cadastrar( $this->request->params['pass'][2], $this->request->params['pass'][4] );

        	if (isset($ok) && $ok==='23000') {
        		$this->setMsgAlertError('Atenção: Faixas de PESO, já encontra-se cadastradas.');
        	} else {
        		if ($ok > 0) {
					$this->setMsgAlertSuccess('Faixas de PESO cadastradas com sucesso.');
				} else {
					$this->setMsgAlertError(ERROR_PROCESS);
				}
        	}

        } else {
        	$this->set(compact('erro'));
        }

	}

	/**
	 * Remover faixa cep frete personalizado
	 * @return string
	 */
	public function personalizadoRegiaoFaixaCep()
	{

		$ok = $this->ShopEnvioPersonalizadoFaixa->remover(

			$this->request->params['pass'][2],
			$this->request->params['pass'][4],
			$this->request->params['pass'][7]

		);

		if ($ok === true) {
			$this->setMsgAlertSuccess('Faixa de CEP removida com sucesso.');
		} else {
			$this->setMsgAlertError(ERROR_PROCESS);
		}

		$this->redirect($this->referer());

	}

	/**
	 * Remover faixa peso frete personalizado
	 * @return string
	 */
	public function personalizadoRegiaoFaixaPeso()
	{

		$ok = $this->ShopEnvioPersonalizadoPeso->remover(

			$this->request->params['pass'][2],
			$this->request->params['pass'][4],
			$this->request->params['pass'][7]

		);

		if ($ok === true) {
			$this->setMsgAlertSuccess('Faixa de PESO removida com sucesso.');
		} else {
			$this->setMsgAlertError(ERROR_PROCESS);
		}

		$this->redirect($this->referer());

	}

	/**
	 * Cadastrar faixa de peso para região personalizada
	 * @return string
	 */
	public function personalizadoRegiaoPesoCadastrar()
	{

		$erro = false;
        if (!empty($this->request->data['peso_inicio'])) {
			if (!Validate::isFloat($this->request->data['peso_inicio'])) {
            	$erro = true;
            	$this->set('error_peso_inicio', true);
            }
        }

        if (!empty($this->request->data['peso_fim'])) {
			if (!Validate::isFloat($this->request->data['peso_fim'])) {
            	$erro = true;
            	$this->set('error_peso_fim', true);
            }
        }

        if (!empty($this->request->data['valor'])) {
			if (!Validate::isFloat($this->request->data['valor'])) {
            	$erro = true;
            	$this->set('error_valor', true);
            }
        }

        if (isset($this->request->data['peso_inicio'], $this->request->data['peso_fim'])) {

			if (intval($this->request->data['peso_inicio']) > intval($this->request->data['peso_fim'])) {
        		$this->setMsgAlertError('PESO inicial maior que o PESO final.');
        		$erro = true;
	            $this->set('error_peso_inicio', true);
	            $this->set('error_peso_fim', true);
        	}

        }

        if ($erro === true) {
        	$this->setMsgAlertError(ERROR_FILE_INVALID_ARGUMENT);
        }

        if ($erro !== true) {

        	$ok = $this->ShopEnvioPersonalizadoPeso->cadastrar( $this->request->params['pass'][2], $this->request->params['pass'][4] );

        	if ($ok > 0) {
				$this->setMsgAlertSuccess('Peso cadastradas com sucesso.');
				//return $this->redirect( array('controller' => 'configuracao', 'action' => 'envio', 'personalizado', $this->request->params['pass'][2], 'editar' ) );
			} else {
				$this->setMsgAlertError(ERROR_PROCESS);
			}

        }

	}

	public function envioPersonalizadoEditar() {

		self::getFormasEnvioPersonalizada();

		if ($this->request->is('post')) {

            $erro = false;

            if (empty( $this->request->data['nome'] ) ) {

                $erro = true;
                $this->set('error_nome', true);

            }

            if (!empty( $this->request->data['taxa_valor'] ) ) {

				if (!Validate::isFloat($this->request->data['taxa_valor'])) {
                    $this->setMsgAlertError('Por favor, informe um valor válido.');
                    $erro = true;
                    $this->set('error_taxa_valor', true);
                }

            }

            if ($erro === false) {

                $this->requestAction(array(
                    'controller' => 'ShopEnvioPersonalizado',
                    'action' => 'editar',
                    'id' => $this->request->params['pass'][2]
                ));

            }

		}

		$regiao_listar = $this->ShopEnvioPersonalizadoRegiao->regiaoListar($this->request->params['pass'][2]);
		$this->set( compact('regiao_listar') );

		$diretorio = CDN_UPLOAD . $this->Session->read('id_shop') . '/';
		$this->set('imagem_envio_personalizado', $diretorio . 'envio-personalizado' . '/');

		$this->set('title_for_layout', 'Configuração de forma de envio');
		$this->configCSRFGuard();

	}


    /**
     * Remover frete personalizado
     * @return \Cake\Network\Response|null
     */
	public function envioPersonalizadoRemover() {

		self::getFormasEnvioPersonalizada();

		try {

			if ($this->request->is('post')) {

				/**
		         *
		         * Verifica o token CSRFGuard
		         *
		         **/
		        $CSRFGuard = new CSRFGuard();

				if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

		            throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

		        }

		        $return = $this->ShopEnvioPersonalizado->remover($this->Session->read('id_shop'), $this->request->params['pass'][2]);

		        if ($return === true) {
		        	$this->setMsgAlertSuccess( 'Forma de envio personalizada removida com sucesso.' );
		        	return $this->redirect(array('controller' => $this->request->controller, 'action' => 'envio', 'listar'));
		        } else {
		        	$this->setMsgAlertError( ERROR_PROCESS );
		        }

			}

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError( $e->getMessage() );

		}


		$this->set('title_for_layout', 'Remover forma de pagamento personalizada');
		$this->configCSRFGuard();

	}

	/**
	 * Listar dados de pagamento
	 * @access public
	 * @return string
	 */
	public function pagamentoListar()
	{

		if ($this->Shop instanceof Shop) {
			$this->Shop->setIdShop($this->Session->read('id_shop'));
		}

		/**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

		/**
       	*
       	* Configurações e Plano
       	*
       	**/
		$dados = $this->Shop->getIdStatusPlanoShop($this->Shop);

        $this->set('id_plano', $dados['Shop']['id_plano']);

		$this->dados_pagamento = $this->ConfiguracaoPagamento->getPagamentoJoinAll( $this->Session->read('id_shop') );
        $this->set('res_pagamentos', $this->dados_pagamento);

		$this->set('title_for_layout', 'Listar formas de pagamento');



	}


	/**
	 * Editar dados de pagamento
	 * @access public
	 * @return string
	 */
	public function pagamentoEditar() {

		if ($this->Shop instanceof Shop) {
			$this->Shop->setIdShop($this->Session->read('id_shop'));
		}

		/**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

		$this->cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);
		$this->set('cipher', $this->cipher );

		$this->set('title_for_layout', 'Configurando formas de pagamento');

		$this->configCSRFGuard();

		try {

			if (empty($this->request->params['pass']['2'])) {
				throw new \NotFoundException(ERROR_PROCESS, E_USER_WARNING);
			}

			if (!is_numeric($this->request->params['pass']['2'])) {
				throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);
			}

			/**
			 * Remove as configurações de banco
			 */
			if (isset($this->params['pass']['3'], $this->params['pass']['4'])) {
				self::removerConfigDepositoBanco();
			}

			$this->dados_pagamento = $this->ConfiguracaoPagamento->getPagamentoId( $this->params['pass']['2'] );

			if ($this->dados_pagamento['ConfiguracaoPagamento']['slug'] =='pagamento_deposito') {

				/**
	        	 * Envia configuracoes de deposito bancario
	        	 */
	        	self::postConfigDeposito();

	        	$this->set('res_pagamento', $this->dados_pagamento);

	        	$this->status_pagamento = $this->requestAction(array(
		            'controller' => 'ShopPagamento',
		            'action' => 'getStatusPagamento',
		            'id_config_pagamento' => $this->params['pass']['2']
		        ));

	        	$this->set('status_pagamento', $this->status_pagamento);

				$this->res_banco = $this->Bancos->getBancosJoinAll( $this->Session->read('id_shop') );
	        	$this->set('res_bancos', $this->res_banco);

		        $dados_deposito = $this->requestAction(array(
		            'controller' => 'ShopPagamentoDeposito',
		            'action' => 'getIdPagamentoDeposito',
		            'editar' => true
		        ));

	        	$this->set(compact('dados_deposito'));

	        	$this->set('email_comprovante_usuario', $this->Session->read('cliente_email'));

			} else {

				self::postPagamentoFacilitador();

				$this->status_pagamento = $this->requestAction(array(
		            'controller' => 'ShopPagamento',
		            'action' => 'getStatusPagamento',
		            'id_config_pagamento' => $this->params['pass']['2']
		        ));

	        	$this->set('status_pagamento', $this->status_pagamento);

				$facilitador = $this->ShopPagamentoFacilitador->getIdPagamentoFacilitador($this->Session->read('id_shop'), $this->params['pass']['2'] );
		        $this->set(compact('facilitador'));

				$url_logo = $this->Shop->getDadosLogomarca($this->Shop);

				$this->set('url_notificacao', sprintf('http://%s/%s/notificacao', $url_logo['ShopDominio']['dominio'], Tools::strtolower($this->dados_pagamento['ConfiguracaoPagamento']['nome'])));

			}

			$this->render('editar_'. $this->dados_pagamento['ConfiguracaoPagamento']['slug']);

		} catch (\NotFoundException $e) {

			$this->setMsgAlertError($e->getMessage());
			return $this->redirect($this->referer());

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());
			return $this->redirect($this->referer());

	    } catch (\RuntimeException $e) {

	        $this->setMsgAlertError(ERROR_PROCESS);
	        return $this->redirect($this->referer());

	    }

	}

	/**
	 * Remove as configurações de banco
	 * @access private
	 * @return string
	 */
	private function removerConfigDepositoBanco()
	{
		try {

			if (!is_numeric($this->params['pass']['4'])) {
				throw new \InvalidArgumentException(ERROR_PROCESS);
			}

			/**
			 * Remove as configurações de pagamento do banco
			 */
			$this->requestAction(array(
				'controller' => 'ShopPagamentoDepositoConfig',
				'action' => 'delete',
				'numero_banco_default' => $this->params['pass']['4']
			));

		} catch (\InvalidArgumentException $e) {

			$this->setMsgAlertError($e->getMessage());

		} finally {

			return $this->redirect($this->referer());

		}

	}

	/**
	 * [postConfigDeposito description]
	 * @access private
	 * @return [type] [description]
	 */
	private function postConfigDeposito()
	{
		try {

			if ($this->request->is('post')) {

		        $CSRFGuard = new CSRFGuard();

				if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

					throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

				} else {

					$ok = $this->requestAction(array(
						'controller' => 'ShopPagamentoDeposito',
			            'action' => 'dadosUpAdd',
			            'id_config_pagamento' => $this->params['pass']['2'],
			            'slug_pagamento' => $this->dados_pagamento['ConfiguracaoPagamento']['slug']
			        ));

			        if ($ok !== true ) {

						if ($this->Session->read('erro_email_comprovante')) {

							$this->set('error_email_comprovante', true);
							$this->Session->delete('erro_email_comprovante');

			        	}

			        }

				}

			}

		} catch (\NotFoundException $e) {

			$this->setMsgAlertError($e->getMessage());

	    } catch (\InvalidArgumentException $e) {

	        $this->setMsgAlertError($e->getMessage());

	    } catch (\RuntimeException $e) {

	        $this->setMsgAlertError(ERROR_PROCESS);

		}

	}

	/**
	 * [postPagamentoFacilitador description]
	 * @access private
	 * @return [type] [description]
	 */
	private function postPagamentoFacilitador()
	{
		try {

			if ($this->request->is('post')) {


		        $CSRFGuard = new CSRFGuard();

				if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

					throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

				} else {

					$ok = $this->requestAction(array(
						'controller' => 'ShopPagamentoFacilitador',
			            'action' => 'dadosUpAdd',
			            'id_config_pagamento' => $this->params['pass']['2'],
			            'slug_pagamento' => $this->dados_pagamento['ConfiguracaoPagamento']['slug']
			        ));

			        if ($ok !== true ) {

						if ($this->Session->read('erro_facilitador_usuario')) {

							$this->set('error_usuario', true);
							$this->Session->delete('erro_facilitador_usuario');

			        	}

						if ($this->Session->read('erro_facilitador_token')) {

							$this->set('error_token', true);
							$this->Session->delete('erro_facilitador_token');

						}

						if ($this->Session->read('erro_facilitador_token_invalido')) {

							$this->set('token_invalido', true);
							$this->Session->delete('erro_facilitador_token_invalido');

						}

					}

				}

			}

	    } catch (\InvalidArgumentException $e) {

	        $this->setMsgAlertError($e->getMessage());

		} catch (\RuntimeException $e) {

			$this->setMsgAlertError(ERROR_PROCESS);

		}

	}

	/**
	 * Editar pagamentos de Banco
	 * @access public
	 * @return string
	 */
	public function pagamentoBancoEditar() {

		/**
         * Desabilita Views e layout de usuarios nivel menor que 5
         * Caso acesse diretamente pela url
         */
        if ( $this->Session->read('cliente_nivel') < 5 ) {

            $this->setMsgAlertError( ERROR_ACCESS_LEVEL );
            return $this->redirect( array('controller' => 'default', 'action' => 'index' ) );

        }

		$this->cipher = new Blowfish(VIALOJA_DATA_KEY, VIALOJA_DATA_SALT);
		$this->set('cipher', $this->cipher );

		$this->set('title_for_layout', 'Configurando bancos para depósito');

		try {

			if (!isset($this->params['pass']['3'])) {
				throw new \NotFoundException(ERROR_PROCESS);
			}

			if (!is_numeric($this->params['pass']['3'] )) {
				throw new \InvalidArgumentException(ERROR_PROCESS);
			}

			$this->res_banco = $this->Bancos->getIdBanco( $this->request->params['pass']['3'] );
        	$this->set( 'banco', $this->res_banco);


			if ($this->res_banco['Bancos']['numero'] =='104') {

	        	$this->set('res_bancos_config', $this->BancosConfiguracao->getAll());

	        }

	        /**
	         *
	         * Envia os dados de configuraçoes bancarias
	         */
	        self::postEditarDepositoConfig();

	        /**
	         * Lista os dados de configuraçoes bancarias
	         */
	        $config = $this->requestAction(array(
	            'controller' => 'ShopPagamentoDepositoConfig',
	            'action' => 'getIdConfig',
	            'config' => $this->res_banco
	        ));

	        $this->set(compact('config'));

	    } catch (\NotFoundException $e) {

	        $this->setMsgAlertError($e->getMessage());
	        return $this->redirect($this->referer());

	    } catch (\InvalidArgumentException $e) {

	        $this->setMsgAlertError(ERROR_PROCESS);
	        return $this->redirect($this->referer());

	    }

		$this->configCSRFGuard();

	}

	/**
	 * Editar configuraceos de Deposito
	 * @return string
	 */
	private function postEditarDepositoConfig()
	{
		try {

			if ($this->request->is('post')) {


		        $CSRFGuard = new CSRFGuard();

				if (!$CSRFGuard->csrfguard_validate_token(Tools::getValue('CSRFGuardName'), Tools::getValue('CSRFGuardToken'))) {

					throw new \InvalidArgumentException(ERROR_PROCESS, E_USER_WARNING);

				} else {

					$this->error = false;
					if (Tools::getValue('ativo') == 'True') {

						if (Tools::getValue('agencia') == '') {

							$this->error = true;
							$this->set('error_agencia', true);

						}

						if (Tools::getValue('numero_conta') == '') {

							$this->error = true;
							$this->set('error_numero_conta', true);

						}

						if (Tools::getValue('favorecido') == '') {

							$this->error = true;
							$this->set('error_favorecido', true);

						}

						if (Tools::getValue('cpf_cnpj') == '') {

							$this->error = true;
							$this->set('error_cpf_cnpj', true);

						} else {

							$this->cpf_cnpj = intval(Tools::getValue('cpf_cnpj'));

							if (Tools::strlen($this->cpf_cnpj) == 11) {

								if (!v::stringType()->validate(Tools::getValue('favorecido'))) {
									$this->error = true;
									$this->set('error_favorecido', true);
									$this->set('error_nome_favorecido', true);
								}

								if (!v::cpf()->validate($this->cpf_cnpj)) {

									$this->error = true;
									$this->set('error_cpf_cnpj', true);
									$this->set('error_cpf', true);
								}

							} elseif (Tools::strlen($this->cpf_cnpj) == 14) {

								if (!v::alnum()->validate(Tools::getValue('favorecido'))) {
									$this->error = true;
									$this->set('error_favorecido', true);
								}

								if (!v::cnpj()->validate($this->cpf_cnpj)) {
									$this->error = true;
									$this->set('error_cpf_cnpj', true);
									$this->set('error_cnpj', true);
								}

							}

						}

					}

			        if ($this->error === true) {

			        	$this->setMsgAlertError('Por favor, verifique os erros encontrados.');

			        } else {

			        	$ok = $this->requestAction(array(
				            'controller' => 'ShopPagamentoDepositoConfig',
				            'action' => 'dadosUpAdd',
				            'numero_banco_default' => $this->res_banco['Bancos']['numero']
				        ));

				        if (is_bool($ok) && $ok === true) {

			            	$this->setMsgAlertSuccess('Forma de pagamento editada com sucesso.');
			            	return $this->redirect(array('controller' => $this->request->controller, 'action' => 'pagamento', 'editar' , 5));

			            } else {

			                throw new \RuntimeException();

			            }

			        }

		        }

	        }

	    } catch (\InvalidArgumentException $e) {

	        $this->setMsgAlertError($e->getMessage());

	    } catch (\RuntimeException $e) {

	        $this->setMsgAlertError(ERROR_PROCESS);

	    }

	}

}
