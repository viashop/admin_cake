<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 25/09/16 às 03:22
 */

namespace PHPOffice\PHPExcel;

interface IFactory
{
    public function draw($className);
    public function factoryData();
}