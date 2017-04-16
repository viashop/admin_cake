<?php
/**
 * @brief	Biblioteca Correios
 * @details	Classes e interfaces para integração com a API do Correios
 * @package Correios\Calculos\Ect
 */

namespace Correios\Calculos\Ect;
use Correios\Calculos\Http\HTTPConnection as HTTPConnection;
use Correios\Calculos\Http\HTTPCookieManager as HTTPCookieManager;
use Correios\Calculos\Ect\Prdt\Prdt as Prdt;

/**
 * @brief	Interface para APIs dos Correios (ECT)
 */

class ECT {
	/**
	 * @var	HTTPConnection
	 */
	private $httpConnection;

	/**
	 * @brief	Conexão HTTP
	 * @details	Recupera um objeto de conexão HTTP para ser utilizado
	 * nas chamadas às operações da API.
	 * @return	HTTPConnection
	 */
	public function getHTTPConnection() {
		$httpConnection = new HTTPConnection();
		$httpConnection->setCookieManager( new HTTPCookieManager() );

		return $httpConnection;
	}

	/**
	 * @brief	Objeto de integração para consultas de preços e prazos
	 * @return	Prdt
	 */
	public function prdt() {
		return new Prdt( $this );
	}
}