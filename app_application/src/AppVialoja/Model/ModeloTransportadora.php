<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 27/09/16 às 14:47
 */

use AppVialoja\Interfaces\Model\IModeloTransportadora;

class ModeloTransportadora extends AppModel implements IModeloTransportadora
{

    public $name = 'ModeloTransportadora';
    public $useTable = 'modelo_transportadora';
    public $useDbConfig = 'default';

    /**
     * Retorna dados
     * @return array|null
     */
    public function getAll()
    {
        try {

            $conditions = array(

                'fields' => array(
                    'ModeloTransportadora.*',
                )
            );

            return $this->find('all', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }
    }
}
