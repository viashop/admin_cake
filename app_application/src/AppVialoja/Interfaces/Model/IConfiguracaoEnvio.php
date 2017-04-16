<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 17/10/16 às 17:40
 */

namespace AppVialoja\Interfaces\Model;


interface IConfiguracaoEnvio
{

    public function obterTodasAsConfiguracoesDeEnvio();

    public function obterConfiguracoesDeEnvioComIN($arrayIds = '');

}