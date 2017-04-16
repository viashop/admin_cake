<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 27/09/16 às 15:36
 */

namespace AppVialoja\Interfaces;


interface IImportacaoTransportadoraController
{
    /**
     * Recebe a Planilha e faz a validações e cadastra
     */
    public function recebeDadosExcelXLSX();
}