<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 13/09/16 às 01:20
 */

namespace PHPOffice\PHPExcel;

use Lib\Validate;
use Respect\Validation\Validator as v;

class ValidateFile
{

    public static function check($file, $maxsize=2)
    {

        if (!v::type('bool')->validate($file) && $file === false) {
            throw new \NotFoundException(ERROR_FILE_NOT_FOUND, E_USER_WARNING);
        }

        if (!v::intVal()->notEmpty()->validate($file['size'])) {
            throw new \NotFoundException(ERROR_FILE_INVALID, E_USER_WARNING);
        }

        if (!v::stringType()->notEmpty()->validate($file['type'])) {
            throw new \InvalidArgumentException(ERROR_FILE_INVALID_EXCEL, E_USER_WARNING);
        }

        if (!Validate::isFileExcel($file)) {
            throw new \InvalidArgumentException(ERROR_FILE_INVALID_EXCEL, E_USER_WARNING);
        }

        if (!Validate::isMaxSize($file['size'], $maxsize)) {
            throw new \InvalidArgumentException("O arquivo enviado é muito grande, envie arquivos de no máximo {$maxsize}MB.", E_USER_WARNING);
        }

    }

}