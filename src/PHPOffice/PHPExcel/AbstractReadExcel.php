<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 13/09/16 às 15:28
 */

namespace PHPOffice\PHPExcel;

abstract class AbstractReadExcel
{

    protected $file;
    protected $classSomething;

    public function file($file)
    {
        $this->file = $file;
    }

    public function validateSomething($classSomething)
    {
        $this->classSomething = $classSomething;
    }

    abstract public function draw($className);

}