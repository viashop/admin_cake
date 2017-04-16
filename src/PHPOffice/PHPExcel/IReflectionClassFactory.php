<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 12/09/16 às 14:52
 */

namespace PHPOffice\PHPExcel;

interface IReflectionClassFactory
{

    public function validateFile($file);
    public function validateHeader($cell);
    public function validateBody();

}