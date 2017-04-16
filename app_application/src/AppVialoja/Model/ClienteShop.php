<?php



class ClienteShop extends AppModel {

	public $name = 'ClienteShop';
	public $useDbConfig = 'default';
	public $useTable = 'cliente_shop';

	public function getFirstAll($id_shop ='', $id_cliente='')
	{
		try {

			$conditions = array(

                'fields' => array(
                    'Cliente.id_cliente',
                    'Cliente.id_shop_grupo',
                    'Cliente.id_shop',
                    'Cliente.id_grupo',
                    'Cliente.id_default_grupo',
                    'Cliente.tipo_cadastro',
                    'Cliente.nome',
                    'Cliente.email',
                    'Cliente.nivel',
                    'Cliente.ativo',
                    'Cliente.cpf',
                    'Cliente.cnpj',
                    'Cliente.razao_social',
                    'Cliente.info_tributo',
                    'Cliente.telefone_celular',
                    'Cliente.telefone_residencial',
                    'Cliente.telefone_comercial',
                    'Cliente.data_nasc',
                    'Cliente.ie',
                    'Cliente.responsavel',
                    'Cliente.aliases',
                    'Sexo.sexo',
                ),
                'conditions' => array(
                    'ClienteShop.id_shop_default' => $id_shop,
                    'ClienteShop.id_cliente_default' => $id_cliente
                ),
                'group' => array('ClienteShop.id_cliente_default'), //fields to GROUP BY
                'joins' => array(
                    array('table' => 'cliente',
                        'alias' => 'Cliente',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ClienteShop.id_cliente_default = Cliente.id_cliente',
                        )
                    ),
                    array('table' => 'sexo',
                        'alias' => 'Sexo',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Sexo.id = Cliente.id_sexo',
                        )
                    )
                ),
                'limit' => 1
            );

            if ( $this->find('count', $conditions ) > 0) {

                return $this->find('first', $conditions );

            } else {

            	return false;

            }
			
		} catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
