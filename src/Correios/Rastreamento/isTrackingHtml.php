<?php
/**
 * @brief	Rastreamento dos Correios
 * @details	Classes e interfaces para leitura de HTML dos Correios
 * @package Correios\Rastreamento
 */

namespace Correios\Rastreamento;

/**
 * @brief	Interface para APIs dos Correios (ECT)
 */

interface isTrackingHtml {
    /**
     * @param bool $code
     * @return mixed
     */
    public function setCodeTrack($code=false);

    /**
     * @return mixed
     */
    public function getHtmlTrack();
}
