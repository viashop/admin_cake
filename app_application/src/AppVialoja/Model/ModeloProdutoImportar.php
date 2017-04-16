<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 27/09/16 às 14:55
 */

use \AppVialoja\Interfaces\Model\IModeloProdutoImportar;

class ModeloProdutoImportar extends AppModel implements IModeloProdutoImportar
{

    public $name = 'ModeloProdutoImportar';
    public $useDbConfig = 'default';
    public $useTable = 'modelo_produto_importar';

    /**
     * Retorna todos os dados de Modelo
     * @return array|null
     */
    public function obterModeloImportar()
    {
        try {

            $conditions = array(
                'fields' => array(
                    'ModeloProdutoImportar.*',
                )
            );
            return $this->find('all', $conditions);

        } catch (\PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
        }
    }
}
