<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 19/10/16 às 09:45
 */

namespace AppVialoja\Interfaces\Model;


interface ISubdominioNaoPermitido
{

    /**
     * Verifica se o Subdominio é permitido
     * @param string $string
     * @return bool
     */
    public function existsSubdominio($string = '');

}