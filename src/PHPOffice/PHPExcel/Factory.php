<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 12/09/16 às 14:56
 */

namespace PHPOffice\PHPExcel;
use Respect\Validation\Validator as v;

class Factory implements IFactory
{

    private $file;
    private $validateSomething;
    private $reflection;
    private $class;
    private $array = array();
    private $inputFileName;
    private $inputFileType;
    private $objPHPExcel;
    private $objReader;
    private $sheet;
    private $highestRow;
    private $highestColumn;
    private $row;
    private $col;
    private $cell;

    /**
     * ReadExcelFactory constructor.
     * @param array $file
     * @param $validateSomething
     */
    public function __construct(array $file, $validateSomething)
    {
        $this->file = $file;
        $this->validateSomething = $validateSomething;
    }

    private function isValidFile($file)
    {
        if ($this->class instanceof IReflectionClassFactory) {
            $this->class->validateFile($file);
        } else {
            trigger_error('Implements Interface IReflectionClassFactory', E_USER_NOTICE);
            exit();
        }

    }

    private function isValidHeader($cell)
    {
        if ($this->class instanceof IReflectionClassFactory) {
            $this->class->validateHeader($cell);
        } else {
            trigger_error('Implements Interface IReflectionClassFactory', E_USER_NOTICE);
            exit();
        }

    }

    private function isValidBody() {

        $rccol = $this->reflection->getMethod('col');
        $rccol->invoke($this->class, $this->col);

        $rcrow = $this->reflection->getMethod('row');
        $rcrow->invoke($this->class, $this->row);

        $rccell = $this->reflection->getMethod('cell');
        $rccell->invoke($this->class, $this->cell);

        if ($this->class instanceof IReflectionClassFactory) {
            return $this->class->validateBody();
        } else {
            trigger_error('Implements Interface IReflectionClassFactory', E_USER_NOTICE);
            exit();
        }

    }

    private function readFile()
    {

        $this->inputFileName = $this->file['tmp_name'];

        //  Read your Excel workbook
        try {
            $this->inputFileType = \PHPExcel_IOFactory::identify($this->inputFileName);
            $this->objReader = \PHPExcel_IOFactory::createReader($this->inputFileType);
            $this->objPHPExcel = $this->objReader->load($this->inputFileName);
        } catch (\Exception $e) {

            throw new \InvalidArgumentException(
                'Error no Carregamento do Arquivo"' . pathinfo($this->inputFileName, PATHINFO_BASENAME). '": ' . $e->getMessage()
            );

        }

        //  Get worksheet dimensions
        $this->sheet = $this->objPHPExcel->getSheet(0);
        $this->highestRow = $this->sheet->getHighestRow();
        $this->highestColumn = $this->sheet->getHighestColumn();

        //Percorrer cada linha da planilha, por sua vez
        for ($this->row = 1; $this->row <= $this->highestRow; $this->row++) {

            //Leia uma linha de dados em uma matriz
            $rowData = $this->sheet->rangeToArray('A' . $this->row . ':' . $this->highestColumn . $this->row, NULL, TRUE, FALSE);

            foreach ($rowData[0] as $this->col => $this->cell) {

                $this->col = $this->col + 1;

                if (v::identical($this->row)->validate(1)) {

                    $this->isValidHeader($this->cell);

                } else {

                    $this->array = $this->isValidBody();

                }

            }

        }

        if (!empty($this->validateSomething)) {
            self::something($this->validateSomething);
        }

    }

    private function something($something)
    {
        $something = (string)$something;
        $classSome = new $something;
        if (!class_exists($something)) {
            trigger_error('Error: Classe não encontrada: '. $something, E_USER_NOTICE);
            exit;
        }

        if (!method_exists($classSome,'some')) {
            trigger_error('Error: Function não encontrada: some', E_USER_NOTICE);
            exit;
        }

        $classSome->some($this->array);

    }

    /**
     * Leitura de Classes via ReflectionClass
     * @link http://php.net/manual/en/class.reflectionclass.php Manual
     * @param string $className url via namespace da classe
     */
    public function draw($className) {

        $className = (string)$className;

        $this->class = new $className;
        $this->reflection = new \ReflectionClass($className);

        $this->readFile();
        $this->isValidFile($this->file);

    }

    /**
     * Retorna o Array do XLSX
     * @return array
     */
    public function factoryData()
    {
        return $this->array;
    }

}