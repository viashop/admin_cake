<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 13/09/16 às 14:10
 */

namespace PHPOffice\PHPExcel\Something;
use Lib\Validate;
use Lib\Tools;

class SomeShippingCompany
{

    public function some($array)
    {

        foreach ($array as $key => $value) {

            if (!Validate::isValueBigger($value['peso_final'], $value['peso_inicial'])) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$key}, os VALOR do Peso Final não pode ser MENOR que o Peso Inicial.

                Por favor, corrija os valores \"{$value['peso_inicial']}\" e \"{$value['peso_final']}\". Depois envie o arquivo novamente.", E_USER_WARNING);

            }

            if (!Validate::isValueBigger(Tools::intVal($value['cep_fim']), Tools::intVal($value['cep_inicio']))) {

                throw new \InvalidArgumentException("ATENÇÃO: Erro na linha {$key}, os VALOR do Cep Final não pode ser MENOR que o Cep Inicial.

                Por favor, corrija os valores \"{$value['cep_inicio']}\" e \"{$value['cep_fim']}\". Depois envie o arquivo novamente.", E_USER_WARNING);

            }

        }

    }

}