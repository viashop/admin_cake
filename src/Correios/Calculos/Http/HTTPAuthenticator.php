<?php
/**
 * @brief	Protocolo HTTP
 * @details	Classes e interfaces relacionadas com o protocolo HTTP
 * @package Correios.Http
 */

namespace Correios\Calculos\Http;
use Correios\Calculos\Http\HTTPRequest as HTTPRequest;

/**
 * @brief	Interface para definição de um autenticador HTTP.
 */

interface HTTPAuthenticator {
	/**
	 * @brief	Autentica uma requisição HTTP.
	 * @param	HTTPRequest $httpRequest
	 */
	public function authenticate( HTTPRequest $httpRequest );
}