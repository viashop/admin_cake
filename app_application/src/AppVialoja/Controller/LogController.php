<?php

use Lib\Tools;
use Respect\Validation\Validator as v;


class LogController extends AppController
{

	public $uses = array('LogLoginAll', 'LogLogin',	'LogShop');

	private $data;
	private $email;
	private $datasource;

	/**
	 * Pega todos os dados enviados via login
	 * @access public
	*/
	public function loginAll()
	{

		$this->datasource = $this->LogLoginAll->getDataSource();

		try {

			$this->datasource->begin();

			if (empty( $this->params['named']['email']) ) {
				throw new \NotFoundException("Valor obrigatório: Informe o parametro email", E_USER_WARNING);
			}

			$this->email = base64_decode($this->params['named']['email']);

			if (!v::email()->validate($this->email)) {
				throw new \InvalidArgumentException("Valor obrigatório: Informe o parametro email corretamente.", E_USER_WARNING);
			}

			$this->data = array(
		        'ip' => $this->request->clientIp(),
		        'email' => $this->email,
		        'url_referer' => $this->request->referer(),
		        'user_agent' => $this->request->header('User-Agent'),
		    );

		    $this->LogLoginAll->saveAll($this->data);

			$this->datasource->commit();

		} catch (\PDOException $e) {

			$this->datasource->rollback();
			\Exception\VialojaDatabaseException::errorHandler($e);
			return false;

		} catch (\NotFoundException $e) {

			return false;

		} catch (\InvalidArgumentException $e) {

			return false;

		}

	}

	/**
	 * Log de usuario, guara informações do login para auditoria
	 * Informações de ip, browser, id, url de referência
	 * @access public
	*/
	public function login()
	{

		$this->datasource = $this->LogLogin->getDataSource();

		try {

			$this->datasource->begin();

			if (empty( $this->params['named']['email']) ) {
				throw new \NotFoundException("Valor obrigatório: Informe o parametro email", E_USER_WARNING);
			}

			$this->email = base64_decode($this->params['named']['email']);

			if (!v::email()->validate($this->email)) {
				throw new \InvalidArgumentException("Valor obrigatório: Informe o parametro email corretamente.", E_USER_WARNING);
			}

			if ($this->Session->read('id_cliente')) {

				$this->data = array(
			        'id_cliente' => $this->Session->read('id_cliente'),
			        'ip' => $this->request->clientIp(),
			        'email' => $this->email,
			        'url_referer' => $this->request->referer(),
			        'user_agent' => $this->request->header('User-Agent'),
			        'status' => $this->params['named']['status']
			    );

			} else {

				$this->data = array(
			        'ip' => $this->request->clientIp(),
			        'email' => $this->email,
			        'url_referer' => $this->request->referer(),
			        'user_agent' => $this->request->header('User-Agent'),
			        'status' => $this->params['named']['status']
			    );
			}

			$this->LogLogin->saveAll($this->data);

			$this->datasource->commit();

		} catch (\PDOException $e) {

			$this->datasource->rollback();
			\Exception\VialojaDatabaseException::errorHandler($e);
			return false;

		} catch (\NotFoundException $e) {

			return false;

		} catch (\InvalidArgumentException $e) {

			return false;

		}

	}


	/**
	 * Log de usuario, guarda informações do login para auditoria
	 * Informações de ip, browser, id, url de referência
	 * @access public
	*/
	public function logShop()
	{

		$this->datasource = $this->LogShop->getDataSource();

		try {

			$this->datasource->begin();

			$this->data = array(
		        'id_cliente' => $this->Session->read('id_cliente'),
		        'id_shop' => $this->Session->read('id_shop'),
		        'ip' => $this->request->clientIp(),
				'url' => Tools::getUrl(),
		        'url_referer' => $this->request->referer(),
		        'user_agent' => $this->request->header('User-Agent')
		    );

			$this->LogShop->saveAll($this->data);

			$this->datasource->commit();

		} catch (\PDOException $e) {

			$this->datasource->rollback();
			\Exception\VialojaDatabaseException::errorHandler($e);
			return false;

		}

	}

}
