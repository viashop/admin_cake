<?php
/**
 * @brief	Biblioteca Correios para cálculo de preços e prazos
 * @details	Classes e interfaces para integração com a API do Correios
 * @package Correios\Calculos\Ect\Prdt
 */

namespace Correios\Calculos\Ect\Prdt;

/**
 * @brief	Informações sobre preço e prazo cobrados para um serviço do Correios
 */

interface ECTFormatos {
	const FORMATO_CAIXA_PACOTE	= 1;
	const FORMATO_ROLO_PRISMA	= 2;
}