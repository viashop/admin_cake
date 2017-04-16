<?php

use Lib\Tools;
use Lib\ManipulateXmlapi as ManipulateXmlapi;


class ShopDominioController extends AppController {

	public $uses = array(
		'Theme',
		'Shop',
		'ShopDominio',
		'ShopDominioRedirect',
		'SubdominioNaoPermitido'
	);

	public $layout = false;
	private $data_dominio;
	private $virtual_uri;
	private $dominio;
	private $dominio_inicial_confirme;
	private $url_txt_redirect;
	private $url_auto_login;
	private $getInsertID;
	private $subdominio;

	/**
	 * @access private
	 * @param Array $manipulate configurações do Cpanel
	 */
	private $manipulate;
	private $diretorio_theme;
	private $datasource;

	/**
	 * Obter o Id Theme dominio
	 * @access private
	 * @param String $id_shop
	 * @return int
	 */
	/*
	private function getIdThemeShop()
	{
		return $this->Shop->getIdTheme( $this->Session->read('id_shop') );
	}
	*/

	/**
	 * Obter o nome de dominio Main
	 * @access public
	 * @param String $id_shop
	 * @param String $dominio
	 * @return string
	 */

	public function getUrlDominioShop()
	{
		try {

			$conditions = array(
				'fields' => array(
					'ShopDominio.dominio'
				),
				'conditions' => array(
					'ShopDominio.main' => 1,
					'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
				)
			);

			$data = $this->ShopDominio->find('first', $conditions);
			return $data['ShopDominio']['dominio'];

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}
	}

	/**
	 * Obter o nome de dominio Main
	 * @access public
	 * @param String $id_shop
	 * @param String $dominio
	 * @return string
	 */
	public function getDadosDominioAll()
	{
		try {

			$conditions = array(
				/*
				'fields' => array(
						'ShopDominio.id_dominio',
						'ShopDominio.main',
						'ShopDominio.dominio'
				),
				*/
				'conditions' => array(
					'ShopDominio.subdominio_plataforma' => 'False',
					'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
				),
				'order' => array('ShopDominio.main' => 'DESC')
			);

			return $this->ShopDominio->find('all', $conditions);

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		}

	}


	/**
	 * Atenção Esta função já foi refatorada, seguir padrão pronto em
	 * WizardController  private function addSubDominio()
	 * Models :
	 * ShopDominio
	 * public function removeSubdominio(Shop $shop)
	 * public function cadastrarSubdominio(Shop $shop, ShopDominio $dominio)
	 * ShopDominioRedirect
	 * public function removeSubdominio(Shop $shop, \stdClass $std)
	 *
	 * Altera o subdomino para shop
	 * @access public
	 * @param String $dominio
	 * @return string
	 */
	public function alterarSubDominio()
	{

		/**
		 * Atenção Esta função já foi refatorada, seguir padrão pronto em
		 * WizardController  private function addSubDominio()
		 * Models :
		 * ShopDominio
		 * public function removeSubdominio(Shop $shop)
		 * public function cadastrarSubdominio(Shop $shop, ShopDominio $dominio)
		 * ShopDominioRedirect
		 * public function removeSubdominio(Shop $shop, \stdClass $std)
		 */

		$this->datasource = $this->ShopDominio->getDataSource();

		try {

			$this->datasource->begin();

			$this->dominio = Tools::getValue('dominio_apelido');

			if (empty($this->dominio)) {
                throw new \LogicException("Valor obrigatório: Informe o dominio.", E_USER_WARNING);
            }

			$this->dominio = Tools::clean(Tools::strtolower($this->dominio));

			self::removeSubdominio();
			self::removeSubdominioRedirect();
			self::cadastrarSubdominio();

			$this->datasource->commit();
			return false;

		} catch (\PDOException $e) {

			$this->datasource->rollback();
			\Exception\VialojaDatabaseException::errorHandler($e);
			return false;

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

	private function removeSubdominio()
	{

		/**
		 *
		 * Verifica o subdominio para excluir
		 *
		 **/
		$conditions = array(
			'conditions' => array(
				'ShopDominio.subdominio_plataforma' => 'True',
				'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
			)
		);

		if ($this->ShopDominio->find('count', $conditions) > 0) {

			$this->ShopDominio->deleteAll(
				array(
					'ShopDominio.subdominio_plataforma' => 'True',
					'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
				)
			);

		}

	}



	/**
	 * Altera o subdomino para shop
	 * @access public
	 * @param String $id_shop
	 * @param String $dominio
	 * @return string
	 */
//	public function alterarSubDominio()
//	{
//
//		$this->datasource = $this->ShopDominio->getDataSource();
//
//		try {
//
//			$this->datasource->begin();
//
//			$this->dominio = Tools::getValue('dominio_apelido');
//
//			if (empty($this->dominio)) {
//                throw new \LogicException("Valor obrigatório: Informe o dominio.", E_USER_WARNING);
//            }
//
//            $this->dominio = Tools::clean( Tools::strtolower( $this->dominio ) );
//
//
//			$conditions = array(
//				'fields' => array(
//					'Theme.diretorio'
//				),
//		        'conditions' => array(
//		        	'Theme.id_theme' => self::getIdThemeShop()
//		        )
//		    );
//
//			$this->dir_theme = $this->Theme->find('first', $conditions);
//
//			//Verifica o subdominio para excluir
//
//			$conditions = array(
//					'fields' => array(
//						'ShopDominio.virtual_uri',
//						'ShopDominio.subdominio_add'
//					),
//			        'conditions' => array(
//			        	'ShopDominio.subdominio_plataforma' => 'True',
//			        	'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
//			        )
//			    );
//
//			if ($this->ShopDominio->find('count', $conditions) > 0 ) {
//
//	        	$this->data_url = $this->ShopDominio->find('first', $conditions);
//
//				if (!empty($this->data_url['ShopDominio']['virtual_uri'])) {
//
//					$this->parket = self::removeParketRelacionadoSubdomain(
//						$this->data_url['ShopDominio']['virtual_uri']
//					);
//
//					$this->date = new \DateTime(date('Y-m-d H:i:s'));
//	        		$this->date->sub(new \DateInterval('P7D'));
//
//					if ($this->data_url['ShopDominio']['subdominio_add'] > $this->date->format('Y-m-d H:i:s')) {
//
//						self::excluirSubdominio(
//							$this->data_url['ShopDominio']['virtual_uri'], $this->dir_theme['Theme']['diretorio']
//						);
//
//					}
//
//				}
//
//				if (self::addSubdominio($this->dominio, $this->dir_theme['Theme']['diretorio']) === true
//					&& $this->parket !== false ) {
//
//					$this->ShopDominio->updateAll(
//						array(
//							'ShopDominio.dominio' => sprintf("'%s'", $this->dominio . env('HTTP_BASE') ),
//							'ShopDominio.dominio_ssl' => sprintf("'%s'", $this->dominio . env('HTTP_BASE') ),
//	                		'ShopDominio.virtual_uri' => sprintf("'%s'", $this->dominio ),
//	                		'ShopDominio.main' => true,
//							'ShopDominio.subdominio_add' =>  sprintf("'%s'", date('Y-m-d H:i:s') )
//						),
//			     		array(
//		     				'ShopDominio.subdominio_plataforma' => 'True',
//		     				'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
//		     			)
//	     			);
//
//					//Verifica se existe dominio para alternativo
//
//					$conditions = array(
//
//						'fields' => array(
//							'ShopDominio.id_dominio',
//							'ShopDominio.dominio'
//						),
//						'conditions' => array(
//							'ShopDominio.subdominio_plataforma' => 'False',
//							'ShopDominio.add_cpanel' => 1,
//							'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
//						)
//
//					);
//
//					if ($this->ShopDominio->find('count', $conditions) > 0 ) {
//
//						$this->result_dominio = $this->ShopDominio->find('all', $conditions);
//
//						foreach ($this->result_dominio as $this->dominio) {
//
//							if (!self::addDominioParket($this->dominio, $this->dominio['ShopDominio']['dominio'])) {
//
//								$this->ShopDominio->updateAll(
//									array('ShopDominio.add_cpanel' => "'0'"),
//									array('ShopDominio.id_dominio' => $this->dominio['ShopDominio']['id_dominio'])
//								);
//
//							}
//
//						}
//
//					}
//
//					$this->datasource->commit();
//
//					return true;
//
//				} else {
//
//					return false;
//				}
//
//			} else {
//				die('bug');
//			}
//
//		} catch (\PDOException $e) {
//
//			$this->datasource->rollback();
//			\Exception\VialojaDatabaseException::errorHandler($e);
//			return false;
//
//		} catch (\Exception $e) {
//
//			self::connectionCpanel($e);
//			throw new \BadFunctionCallException(ERROR_API_CPANEL);
//
//		} catch (\LogicException $e) {
//
//			\Exception\VialojaInvalidLogicException::errorHandler($e);
//
//		}
//
//	}



//	private function removeParketRelacionadoSubdomain($virtual_uri=null) {
//
//
//		try {
//
//			//Verifica se existe dominio para alternativo
//
//			$conditions = array(
//				'fields' => array(
//					'ShopDominio.id_dominio',
//					'ShopDominio.dominio'
//				),
//				'conditions' => array(
//					'ShopDominio.subdominio_plataforma' => 'False',
//					'ShopDominio.add_cpanel' => 1,
//					'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
//				)
//
//			);
//
//			if ($this->ShopDominio->find('count', $conditions) > 0 ) {
//
//				$this->result_dominio = $this->ShopDominio->find('all', $conditions);
//
//				foreach ($this->result_dominio as $this->dominio) {
//
//					$this->manipulate = self::manipulateCpanel();
//					$this->manipulate->setNameSubDomain($virtual_uri);
//					$this->manipulate->setNameDomain($this->dominio['ShopDominio']['dominio']);
//					$this->manipulate->delDomainParket();
//
//				}
//
//			}
//
//			return true;
//
//		} catch (\PDOException $e) {
//
//			\Exception\VialojaDatabaseException::errorHandler($e);
//			return false;
//
//		} catch (\Exception $e) {
//
//			self::connectionCpanel($e);
//			throw new \BadFunctionCallException(ERROR_API_CPANEL);
//
//		}
//
//
//	}



	/**
	 * Cadastra o subdomino para shop
	 * @access public
	 * @param String $id_shop
	 * @param String $dominio
	 * @return string
	 */


//	public function dominioWizard()
//	{
//
//		$this->datasource = $this->ShopDominio->getDataSource();
//
//		try {
//
//			$this->datasource->begin();
//
//			$this->dominio = Tools::getValue('dominio');
//
//			if ( empty( $this->dominio ) ) {
//                throw new \LogicException("Valor obrigatório: Informe o dominio.", E_USER_WARNING);
//            }
//
//			$this->dominio = Tools::clean( Tools::strtolower( $this->dominio ) );
//
//
//			## Verifica o theme
//			## Padrão inicial id= 1
//
//			$conditions = array(
//				'fields' => array(
//					'Theme.diretorio'
//				),
//		        'conditions' => array(
//		        	'Theme.id_theme' => self::getIdThemeShop()
//		        )
//		    );
//
//			$this->dir_theme = $this->Theme->find('first', $conditions);
//
//
//			## Verifica o subdominio para excluir
//
//			$conditions = array(
//				'fields' => array(
//					'ShopDominio.virtual_uri',
//					'ShopDominio.subdominio_add',
//					'ShopDominio.created'
//					),
//		        'conditions' => array(
//		        	'ShopDominio.subdominio_plataforma' => 'True',
//		        	'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
//		        )
//		    );
//
//			if ($this->ShopDominio->find('count', $conditions) > 0 ) {
//
//				$this->ShopDominio->deleteAll(
//					array(
//						'ShopDominio.subdominio_plataforma' => 'False',
//						'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
//					)
//				);
//
//	        	$this->data_url = $this->ShopDominio->find('first', $conditions);
//
//				if (!empty($this->data_url['ShopDominio']['virtual_uri'])) {
//
//					$this->date = new \DateTime(date('Y-m-d H:i:s'));
//					$this->date->sub(new \DateInterval('P1D'));
//
//					if ($this->data_url['ShopDominio']['subdominio_add'] > $this->date->format('Y-m-d H:i:s')) {
//						self::excluirSubdominio(
//							$this->data_url['ShopDominio']['virtual_uri'],
//							$this->dir_theme['Theme']['diretorio']
//						);
//					}
//
//					$this->date = new \DateTime(date('Y-m-d H:i:s'));
//	        		$this->date->sub(new \DateInterval('P7D'));
//
//					if ($this->data_url['ShopDominio']['created'] > $this->date->format('Y-m-d H:i:s')) {
//						self::excluirSubdominio(
//							$this->data_url['ShopDominio']['virtual_uri'],
//							$this->dir_theme['Theme']['diretorio']
//						);
//					}
//
//				}
//
//				if (self::addSubdominio($this->dominio, $this->dir_theme['Theme']['diretorio']) === true) {
//
//					$this->ShopDominio->updateAll(
//						array(
//							'ShopDominio.dominio' => sprintf("'%s'", $this->dominio . env('HTTP_BASE') ),
//							'ShopDominio.dominio_ssl' => sprintf("'%s'", $this->dominio . env('HTTP_BASE')),
//	                		'ShopDominio.virtual_uri' => sprintf("'%s'", $this->dominio ),
//	                		'ShopDominio.main' => true,
//							'ShopDominio.subdominio_add' =>  sprintf("'%s'", date('Y-m-d H:i:s') )
//						),
//			     		array(
//		     				'ShopDominio.subdominio_plataforma' => 'True',
//		     				'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
//		     			)
//	     			);
//
//					$this->datasource->commit();
//
//					return true;
//
//				} else {
//					return false;
//				}
//
//			} else {
//
//			 	if (self::addSubdominio($this->dominio, $this->dir_theme['Theme']['diretorio']) === true) {
//
//			 		$this->data_dominio = array(
//		                'dominio' => $this->dominio . env('HTTP_BASE'),
//		                'dominio_ssl' => $this->dominio . env('HTTP_BASE'),
//		                'virtual_uri' => $this->dominio,
//		                'main' => true,
//			            'subdominio_plataforma' => 'True',
//			            'subdominio_add' => date('Y-m-d H:i:s'),
//		                'id_shop_default' => $this->Session->read('id_shop')
//		            );
//
//			 		$this->ok = $this->ShopDominio->saveAll($this->data_dominio);
//					$this->datasource->commit();
//
//					if (is_bool($this->ok) && $this->ok === true) {
//						return true;
//					} else {
//					   return false;
//					}
//
//			 	} else {
//			 		return false;
//			 	}
//
//			}
//
//		} catch (\PDOException $e) {
//
//			$this->datasource->rollback();
//			\Exception\VialojaDatabaseException::errorHandler($e);
//			return false;
//
//		} catch (\Exception $e) {
//
//			self::connectionCpanel($e);
//			throw new \BadFunctionCallException(ERROR_API_CPANEL);
//
//		} catch (\LogicException $e) {
//
//			\Exception\VialojaInvalidLogicException::errorHandler($e);
//
//		}
//
//	}

	private function removeSubdominioRedirect()
	{

		/**
		*
		* Verifica o subdominio para excluir
		*
		**/
		$conditions = array(
	        'conditions' => array(
				'ShopDominioRedirect.virtual_uri' => $this->dominio,
				'ShopDominioRedirect.id_shop_default' => $this->Session->read('id_shop')
	        )
	    );

		if ($this->ShopDominioRedirect->find('count', $conditions) > 0) {

			$delOk = $this->ShopDominioRedirect->deleteAll(
				array(
					'ShopDominioRedirect.virtual_uri' => $this->dominio,
					'ShopDominioRedirect.id_shop_default' => $this->Session->read('id_shop')
				)
			);

			if (!$delOk) {
				throw new \Exception\VialojaInvalidTransactionException(ERROR_TRANSACTIONS, E_USER_WARNING);
			}

		}

	}

	/**
	 * Altera o subdomino para shop
	 * @access public
	 * @param String $dominio
	 * @return string
	 */
	private function cadastrarSubdominio()
	{

		$data_dominio = array(
			'dominio' => sprintf('%s%s', $this->dominio, env('HTTP_BASE')),
			'dominio_ssl' => sprintf('%s%s', $this->dominio, env('HTTP_BASE')),
			'dominio_manutencao' => sprintf('%s-manutencao%s', $this->dominio, env('HTTP_BASE')),
			'virtual_uri' => $this->dominio,
			'main' => true,
			'subdominio_plataforma' => 'True',
			'subdominio_add' => date('Y-m-d H:i:s'),
			'id_shop_default' => $this->Session->read('id_shop')
		);

		$this->ShopDominio->saveAll($data_dominio);

		if ($this->ShopDominio->getLastInsertId() > 0) {
			return true;
		}

	}

	/**
	 * Cadastra o domino proprio para shop
	 * @access public
	 * @param String $id_shop
	 * @param String $dominio
	 * @return true
	 */
	public function addDominioInicial()
	{

		$this->datasource = $this->ShopDominio->getDataSource();

		try {

			$this->datasource->begin();

			$this->dominio = Tools::getValue('dominio');
			$this->dominio_inicial_confirme = Tools::getValue('dominio_inicial_confirme');

			if (empty($this->dominio)) {
				throw new \LogicException("Valor obrigatório: Informe o dominio.", E_USER_WARNING);
			}

			if (empty($this->dominio_inicial_confirme)) {
				throw new \LogicException("Valor obrigatório: Informe o dominio_inicial_confirme.", E_USER_WARNING);
			}

			if ($this->Shop instanceof Shop) {
				$this->Shop->setIdShop($this->Session->read('id_shop'));
			}

			$this->dominio = Tools::strtolower($this->dominio);
			$this->dominio_inicial_confirme = Tools::strtolower($this->dominio_inicial_confirme);

			$this->ShopDominio->updateAll(
				array(
					'ShopDominio.main' => 0
				),
				array(
					'ShopDominio.subdominio_plataforma' => 'True',
					'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
				)
			);

			/**
			 *
			 * Verifica o subdominio para excluir
			 *
			 **/
			$conditions = array(
				'fields' => array(
					'ShopDominio.dominio'
				),
				'conditions' => array(
					'ShopDominio.subdominio_plataforma' => 'False',
					'ShopDominio.main' => 1,
					'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
				)

			);

			if ($this->ShopDominio->find('count', $conditions) <= 0) {

				$this->data_dominio = array(
					'dominio' => $this->dominio,
					'dominio_ssl' => $this->dominio,
					'virtual_uri' => $this->dominio,
					'main' => true,
					'id_shop_default' => $this->Session->read('id_shop'),
					//'created' => date('Y-m-d H:i:s')
				);

			} else {

				$this->data_dominio = array(
					'dominio' => $this->dominio,
					'dominio_ssl' => $this->dominio,
					'id_shop_default' => $this->Session->read('id_shop'),
					//'created' => date('Y-m-d H:i:s')
				);

			}

			/**
			 *
			 * Cadastrar pelo cron ou ajax os dominios
			 *
			 **/
			if ($this->ShopDominio->saveAll($this->data_dominio)) {

				$this->getInsertID = $this->ShopDominio->getInsertID();

				$this->subdominio = $this->ShopDominio->getIdFirstSubDominio($this->Shop);

				if ($this->dominio_inicial_confirme == 'true') {

					if (self::addDominioParket($this->subdominio['ShopDominio']['virtual_uri'], $this->dominio)) {

						$this->ShopDominio->updateAll(
							array(
								'ShopDominio.add_cpanel' => "'1'",
								'ShopDominio.date_add_cpanel' => sprintf("'%s'", date('Y-m-d H:i:s'))
							),
							array(
								'ShopDominio.id_dominio' => $this->getInsertID,
								'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
							)
						);

						$this->datasource->commit();

					}

				}

				return $this->getInsertID;

			} else {
				return false;
			}

		} catch (\PDOException $e) {

			$this->datasource->rollback();
			\Exception\VialojaDatabaseException::errorHandler($e);
			return false;


		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		} catch (\Exception $e) {

			self::connectionCpanel($e);
			throw new \BadFunctionCallException(ERROR_API_CPANEL);

		}
	}

	/**
	 * Cadastra o domínio suplementares
	 * @access private
	 * @param String $dominio nome de domínio
	 * @return string
	 */
	private function addDominioParket($virtual_uri=null, $dominio=null)
	{

		try {

			if (empty($virtual_uri)) {
				throw new \LogicException("Informe o virtual_uri", E_USER_WARNING);
			}

			if (empty($dominio)) {
				throw new \LogicException("Informe o domínio", E_USER_WARNING);
			}

			$this->manipulate = self::manipulateCpanel();
			$this->manipulate->setNameSubDomain($virtual_uri);
			$this->manipulate->setNameDomain($dominio);
			$this->manipulate->addDomainParket();

			if ($this->manipulate->status === true){
				return true;
			} else {
				return false;
			}

		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		} catch (\Exception $e) {

			self::connectionCpanel($e);
			throw new \BadFunctionCallException(ERROR_API_CPANEL);

		}

	}

	/**
	 * Cadastra o subdomínio
	 * @access private
	 * @param String $dominio nome de subdomínio
	 * @return string
	 */
	private function manipulateCpanel()
	{
		try {

			if (!defined('SERVIDOR_HOST')) {
				throw new \LogicException("Constante CPANEL Não definida: HOST", E_USER_WARNING);
			}

			if (!defined('SERVIDOR_USUARIO')) {
				throw new \LogicException("Constante CPANEL Não definida: USUARIO", E_USER_WARNING);
			}

			if (!defined('SERVIDOR_SENHA')) {
				throw new \LogicException("Constante CPANEL Não definida: SENHA", E_USER_WARNING);
			}

			return new ManipulateXmlapi(SERVIDOR_HOST, SERVIDOR_USUARIO, SERVIDOR_SENHA);

		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	*
	*
	*
	*/
	private function connectionCpanel($e) {

		\Exception\VialojaApiCPanelException::displayError($e->getMessage(), __LINE__, __FILE__);

	}

	/**
	 * Define o Dominio principal
	 * @access public
	 * @param String $id_shop
	 * @param String $dominio
	 * @return true
	 */
	public function definirDominioPrincipal()
	{

		try {

			if (empty($this->params['named']['virtual_uri'])) {
				throw new \LogicException("Valor obrigatório: Informe o virtual_uri.", E_USER_WARNING);
			}

			if (empty($this->params['named']['dominio'])) {
				throw new \LogicException("Valor obrigatório: Informe o dominio.", E_USER_WARNING);
			}

			$this->virtual_uri = Tools::clean(Tools::strtolower($this->params['named']['virtual_uri']));
			$this->dominio = Tools::clean(Tools::strtolower(base64_decode($this->params['named']['dominio'])));


			/**
			 *
			 * Verifica primeiro se dominio esta para ser redicionado
			 *
			 **/
			$conditions = array(
				'conditions' => array(
					'ShopDominio.add_cpanel' => 1,
					'ShopDominio.id_dominio' => $this->params['named']['id_dominio'],
					'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
				)
			);

			if ($this->ShopDominio->find('count', $conditions) <= 0) {

				if (self::addDominioParket($this->virtual_uri, $this->dominio)) {

					$this->ShopDominio->updateAll(
						array(
							'ShopDominio.add_cpanel' => true,
							'ShopDominio.date_add_cpanel' => sprintf("'%s'", date('Y-m-d H:i:s'))
						),
						array(
							'ShopDominio.id_dominio' => $this->params['named']['id_dominio'],
							'ShopDominio.id_shop_default' => $this->Session->read('id_shop')
						)
					);

				}

			}

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);
			return false;

		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		} catch (\Exception $e) {

			self::connectionCpanel($e);
			throw new \BadFunctionCallException(ERROR_API_CPANEL);

		}

	}

	/**
	 * Checa se a disponibilidade de endereço loja virtual
	 * @access public
	 * @param String $dominio nome de subdomínio
	 * @return string
	 */
	public function disponibilidadeDomain()
	{
		try {

			if ($this->Shop instanceof Shop) {
				$this->Shop->setIdShop($this->Session->read('id_shop'));
			}

			$dominio = Tools::getValue('dominio');

			if (Tools::getValue('dominio_apelido') != '') {
				$dominio = Tools::getValue('dominio_apelido');
			}

			if (empty($dominio)) {
				return false;
			}

			$dominio = Tools::clean(Tools::strtolower($dominio));

			/** Verifica e dominio esta relacionado ao sistema **/
			if ($this->SubdominioNaoPermitido->existsSubdominio($dominio)) {
				return true;
			}


			/** Verifica se dominio esta para ser redicionado **/

			$std = new \stdClass();
			$std->virtual_uri = $dominio;
			if ($this->ShopDominioRedirect->existsSubdominio($this->Shop, $std)) {
				return true;
			}

			if ($this->ShopDominio->existsSubdominio($dominio)) {
				return true;
			}

			return false;

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 * Checa se a disponibilidade de endereço loja virtual via ajax
	 */
	public function checaDominioAjax()
	{

		$this->layout = false;
		$this->render(false);

		try {

			if ($this->request->is('post')) {

				if (!$this->request->is('ajax')) {
					echo 'False';
				}

				$dominio = Tools::getValue('dominio');

				if (empty($dominio)) {
					echo 'False';
				}

				$dominio = Tools::clean(Tools::strtolower($dominio));

				if ($this->Shop instanceof Shop) {
					$this->Shop->setIdShop($this->Session->read('id_shop'));
				}

				/** Verifica e dominio esta relacionado ao sistema **/
				if ($this->SubdominioNaoPermitido->existsSubdominio($dominio)) {
					echo 'True';
				}

				/** Verifica se dominio esta para ser redicionado **/
				$std = new \stdClass();
				$std->virtual_uri = $dominio;
				if ($this->ShopDominioRedirect->existsSubdominio($this->Shop, $std)) {
					echo 'True';
				}

				/**
				 *
				 * Verifica se dominio já esta cadastrado
				 *
				 **/
				if ($this->ShopDominio->existsSubdominio($dominio)) {
					echo 'True';
				} else {
					echo 'False';
				}

			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} finally{
			return exit();
		}

	}

	/**
	 * Remove o domínio estacionado
	 * @access public
	 * @param String $dominio nome de domínio
	 * @return string
	 */
	public function delDominio()
	{
		try {

			if (empty($this->params['named']['dominio'])) {
				throw new \LogicException("Informe o dominio", E_USER_WARNING);
			}

			$this->manipulate = self::manipulateCpanel();
			$this->manipulate->setNameSubDomain(trim($this->params['named']['virtual_uri']));
			$this->manipulate->setNameDomain(trim(base64_decode($this->params['named']['dominio'])));
			$this->manipulate->delDomainParket();

			if ($this->manipulate->status === true) {
				return true;
			} else {
				return false;
			}

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		} catch (\Exception $e) {

			self::connectionCpanel($e);
			throw new \BadFunctionCallException(ERROR_API_CPANEL);

		}

	}

	/**
	 * Verifica domino Válido para auto login
	 * @access public
	 * @param String $url
	 * @return string
	 */
	public function validaDominioAutoLogin()
	{
		try {

			if (empty($this->params['named']['dominio'])) {
				throw new \LogicException("Informe o dominio.", E_USER_WARNING);
			}

			if (empty($this->params['named']['controller_redirect'])) {
				throw new \LogicException("Informe o controller_redirect.", E_USER_WARNING);
			}

			$conditions = array(
				'conditions' => array(
					'ShopDominio.main' => 1,
					'ShopDominio.dominio' => Tools::clean(base64_decode($this->params['named']['dominio']))
				)
			);

			if ($this->ShopDominio->find('count', $conditions) > 0) {

				$this->url_auto_login = explode('?', Tools::getUrl());
				return $this->redirect($this->url_auto_login[0]);

			} else {

				$this->Session->destroy();
				$this->cookieViaLoja()->destroy();

				$this->url_txt_redirect = sprintf(
					'//app%s/public/login?service=%s&passive=false&continue=%s&message=%s',
					env('HTTP_BASE'), trim($this->params['named']['controller_redirect']),
					rawurlencode(Tools::getUrl()),
					base64_encode(trim('Por favor, entre com seu login e senha novamente.'))
				);

				return $this->redirect($this->url_txt_redirect);

			}

		} catch (\PDOException $e) {
			\Exception\VialojaDatabaseException::errorHandler($e);
		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		}

	}

	/**
	 * Cadastra o subdomínio
	 * @access private
	 * @param String $dominio nome de subdomínio
	 * @return string
	 */
	private function addSubdominio($dominio = null, $theme = null)
	{

		try {

			if (empty($dominio)) {
				throw new \LogicException("Necessário informar o domínio.", E_USER_WARNING);
			}

			if (empty($theme)) {
				throw new \LogicException("Informe o diretório do theme.", E_USER_WARNING);
			}

			$this->diretorio_theme = THEMES_LOJA_SHOPPING_API . $theme;

			$this->manipulate = self::manipulateCpanel();
			$this->manipulate->setNameDomain(SERVIDOR_ROOT_DOMAIN);
			$this->manipulate->setNameSubDomain($dominio);
			$this->manipulate->setDirectory($this->diretorio_theme);
			$this->manipulate->addSubDomain();

			if ($this->manipulate->status === true) {
				return true;
			} else {
				return false;
			}

		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		} catch (\Exception $e) {

			self::connectionCpanel($e);
			throw new \BadFunctionCallException(ERROR_API_CPANEL);

		}

	}

	/**
	 * Remove o subdomínio
	 * @access private
	 * @param String $dominio nome de subdomínio
	 * @return string
	 */
	private function excluirSubdominio($dominio = null, $theme = null)
	{

		try {

			if (empty($dominio)) {
				throw new \LogicException("Necessário informar o domínio", E_USER_WARNING);
			}

			if (empty($theme)) {
				throw new \LogicException("Informe o diretório do theme", E_USER_WARNING);
			}

			$this->diretorio_theme = THEMES_LOJA_SHOPPING_API . $theme;

			$this->manipulate = self::manipulateCpanel();
			$this->manipulate->setNameDomain(SERVIDOR_ROOT_DOMAIN);
			$this->manipulate->setNameSubDomain($dominio);
			$this->manipulate->setDirectory($this->diretorio_theme);
			$this->manipulate->delSubDomain();

			if ($this->manipulate->status === true) {
				return true;
			} else {
				return false;
			}

		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		} catch (\Exception $e) {

			self::connectionCpanel($e);
			throw new \BadFunctionCallException(ERROR_API_CPANEL);

		}

	}

	/**
	 * Remove o subdomínio
	 * @access private
	 * @param String $dominio nome de subdomínio
	 * @return string
	 */
	private function alteraDiretorioSubdominio($dominio = null, $theme = null)
	{

		try {

			if (empty($dominio)) {
				throw new \LogicException("Necessário informar o domínio", E_USER_WARNING);
			}

			if (empty($theme)) {
				throw new \LogicException("Informe o diretório do theme", E_USER_WARNING);
			}

			$this->diretorio_theme = THEMES_LOJA_SHOPPING_API . $theme;

			$this->manipulate = self::manipulateCpanel();
			$this->manipulate->setNameDomain(SERVIDOR_ROOT_DOMAIN);
			$this->manipulate->setNameSubDomain($dominio);
			$this->manipulate->setDirectory($this->diretorio_theme);
			$this->manipulate->changeSubDomain();

			if ($this->manipulate->status === true){
				return true;
			} else {
				return false;
			}

		} catch (\LogicException $e) {
			\Exception\VialojaInvalidLogicException::errorHandler($e);
		} catch (\Exception $e) {

			self::connectionCpanel($e);
			throw new \BadFunctionCallException(ERROR_API_CPANEL);

		}

	}

}
