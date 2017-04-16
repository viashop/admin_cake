<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 16/09/16 às 02:40
 */
namespace Exception;

use Symfony\Component\Config\Definition\Exception\Exception;

class VialojaInvalidLogicException extends \Exception
{

    public static function errorHandler($e)
    {
        /*$error = array(
            'error' => array(
                'file' => $e->getFile(),
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine()
            )
        );*/

        echo self::defaultLayoutError($e);
        die();

    }


    /**
     * Error standard layout, if the error handling controller has not been set.
     * @param $e
     * @return string
     */
    private static function defaultLayoutError($e)
    {
        if ($e instanceof \Exception) {

            $html = <<<ERROR
            <h1>{$e->getCode()} - Um erro de Lógica Ocorreu.</h1>
            <h2>{$e->getMessage()}</h2>
            <p>Arquivo: <b>{$e->getFile()}</b></p>
            <p>Linha: <b>{$e->getLine()}</b></p>
ERROR;

            return $html;

        }


    }

}