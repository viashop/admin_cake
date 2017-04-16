<?php

use Respect\Validation\Validator as v;

class CidadesController extends AppController
{

    public $uses = array('Cidades');

	private $arr = array();
	private $json;

    public function index()
    {

    }

	/**
	 * Retorna a cidade
	 * @return bool
	 */
    public function getCidadeId()
    {

        $this->render(false);

        try {

            if (!$this->request->is('post')) {
				return false;
			}

			if (!$this->request->is('ajax')) {
				return false;
			}

			if (!v::numeric()->notBlank()->validate($this->request->params['pass']['0'])) {
				throw new \LogicException('Informe ID do do estado tipo INT');
			}

			$conditions = array(

				'fields' => array(
					'Cidades.codigo_ibge',
					'Cidades.nome'
				),

				'conditions' => array(
					'Estados.codigo_ibge' => $this->request->params['pass']['0']
				),

				'order' => array(
					'Cidades.nome' => 'asc'
				),

				'joins' => array(

                    array(

                        'table' => 'estados',
                        'alias' => 'Estados',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Estados.id_estado = Cidades.estado_id'
                        )

                    ),

                ),

			);

			$result = $this->Cidades->find('all', $conditions);

			foreach ($result as $dados) {

				$data = array(
					'id_ibge' => sprintf('%s', $dados['Cidades']['codigo_ibge']),
					'nome' => sprintf('%s', $dados['Cidades']['nome'])
				);

				array_push($this->arr, $data);

			}

			$this->json['cidades'] = $this->arr;
			$this->json['uf']      = $this->request->params['pass']['0'];
			$this->json['estado']  = 'SUCESSO';

        } catch (\PDOException $e) {

			$this->json['estado']  = ERROR_PROCESS;
			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		} finally {

			header('Content-Type: application/json');
			echo json_encode($this->json);

			exit();

		}

    }

}
