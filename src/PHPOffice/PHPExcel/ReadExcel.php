<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 12/09/16 às 14:56
 */

namespace PHPOffice\PHPExcel;

class ReadExcel extends AbstractReadExcel
{

    /**
     * Ler class via Reflection
     * @param $className
     * @return array
     */
    public function draw($className)
    {

        /**
         * Chama a Factory para fazer a Leitura das Classes
         * via ReflectionClass
         * @link http://php.net/manual/en/class.reflectionclass.php Manual
         * @see IReadExcel
         */
        $factory = new Factory($this->file, $this->classSomething);
        if ($factory instanceof IFactory) {

            $factory->draw($className);
            return $factory->factoryData();

        }

    }

}