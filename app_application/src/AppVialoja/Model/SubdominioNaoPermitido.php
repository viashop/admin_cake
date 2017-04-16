<?php
/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 19/10/16 às 09:45
 */
use AppVialoja\Interfaces\Model\ISubdominioNaoPermitido;

class SubdominioNaoPermitido extends AppModel implements ISubdominioNaoPermitido
{

    public $name = 'SubominioNaoPermitido';
    public $useTable = 'subdominio_nao_permitido';
    public $useDbConfig = 'default';

	/**
	 * Verifica se o Subdominio é permitido
	 * @param string $string
	 * @return bool
	 */
    public function existsSubdominio($string='')
	{
		try {

   			$conditions = array(
		        'conditions' => array(
					'SubdominioNaoPermitido.subdominio' => (string)$string
				)
		    );

   			if ($this->find('count', $conditions) > 0) {
				return true;
			} else {
				return false;
			}

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}
