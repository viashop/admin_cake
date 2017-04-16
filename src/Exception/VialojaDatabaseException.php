<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 16/09/16 às 02:40
 */
namespace Exception;

class VialojaDatabaseException extends CodeErrorPDOMySQLtoException
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

        echo '<pre>';
        print_r($e->errorInfo);
        echo '</pre>';
        echo "<br><hr>";
        echo $e->queryString;
        echo "<hr><br>";
        echo "<br><hr>";
        pr($e);
        echo "<hr><br>";
        die();

    }


    /**
     * Error standard layout, if the error handling controller has not been set.
     * @param $e
     * @return string
     */
    private function defaultLayoutError($e)
    {

        $error_mysql = parent::getError($e->errorInfo[1]);

        $html = <<<ERROR
            <h1>{$e->getCode()} - Um ERRO de Banco de Dados com Ocorreu.</h1>
            <h2>{$e->getMessage()}</h2>
            <p>Arquivo: <b>{$e->getFile()}</b></p>
            <p>Linha: <b>{$e->getLine()}</b></p>
            <p><b>Mensagem de erro:</b> <a href='https://www.google.com.br/search?q={$error_mysql}' target='_blank'>{$error_mysql}</a></p>
            <p>Linha: <b>{$e->errorInfo[1]}</b></p>
ERROR;
        return $html;
    }


//    private function code($e)
//    {
//
//        echo $e->getCode() . EOL;
//        echo $e->getFile() . EOL;
//        echo $e->getMessage() . EOL;
//        echo $e->getLine() . EOL;
//
//        echo "<hr>";
//
//
//        echo '<pre>';
//        print_r($e->errorInfo);
//        echo '</pre>';
//        echo "<br><hr>";
//        echo $e->queryString;
//        echo "<hr><br>";
//
//        $error_mysql = new CodeErrorPDOMySQL($e->errorInfo[1]);
//        $string = "<b>UM ERRO DE PDO EXECEPTION OCORREU.</b><br /><br />";
//        $string .= "<b>Mensagem de erro:</b> <a href=\"https://www.google.com.br/search?q={$error_mysql}\" target='_blank'>{$error_mysql}</a> ";
//        $string .= "<br /><b>Tipo de erro:</b> " . $e->errorInfo[1];
//
//        echo $string;
//        echo "<hr>";
//
//        //Dados para debug via email
//        /*
//        $log = print_r($e, true);
//        echo '<pre>';
//        echo $log;
//        echo '</pre>';
//        */
//
//    }

}
