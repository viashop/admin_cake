<?php

use Respect\Validation\Validator as v;


class ShopProdutoVariacao extends AppModel {

	public $name = 'ShopProdutoVariacao';
	public $useDbConfig = 'default';
	public $useTable = 'shop_produto_variacao';

	/**
	 * Recupera o nome Variação
	 * @param $id_produto
	 * @param $id_grade
	 * @return null | string
	 */
	public function getNomeVariacao($id_produto,$id_grade)
	{
		try {

			if (!v::numeric()->notBlank()->validate($id_produto)) {
				throw new \LogicException("Parâmetro ID_PRODUTO inválido", E_USER_NOTICE);
			}

			if (!v::numeric()->notBlank()->validate($id_grade)) {
				throw new \LogicException("Parâmetro ID_GRADE inválido", E_USER_NOTICE);
			}

			/**
			 *
			 * array filtro
			 *
			 **/
			$conditions = array(
				'fields' => array(
					'ShopProdutoVariacao.nome'
				),

				'conditions' => array(
					'ShopProdutoVariacao.id_produto_default' => $id_produto,
					'ShopProdutoVariacao.id_grade_default' => $id_grade
				)
			);

			if ($this->find('count', $conditions) <= 0) {
				return null;
			}

			$data = $this->find('first', $conditions);
			return $data['ShopProdutoVariacao']['nome'];

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}


	/**
	 * Total de Variação Vinculada
	 * @param $id_shop
	 * @param $id_grade_variacao
	 * @return array|null
	 */
	public function getTotalVariacaoVinculado($id_shop, $id_grade_variacao)
	{

		try {

			if (!v::numeric()->notBlank()->validate($id_shop)) {
				throw new LogicException('Informe o id_shop', E_USER_NOTICE);
			}

			if (!v::numeric()->notBlank()->validate($id_grade_variacao)) {
				throw new LogicException('Informe o id_grade_variacao', E_USER_NOTICE);
			}

			$conditions = array(
				'conditions' => array(
					'id_grade_variacao_default' => $id_grade_variacao,
				),

				'joins' => array(

					array(
						'table' => 'shop_produto',
						'alias' => 'ShopProduto',
						'type' => 'INNER',
						'conditions' => array(
							'ShopProduto.id_produto = ShopProdutoVariacao.id_produto_default',
							'ShopProduto.id_shop_default' => $id_shop
						)
					),

				),
			);

			return $this->find('count', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}


	/**
	 * Adiciona Variação de Produto
	 *
	 * @param string $id_produto
	 * @param string $id_grade
	 * @param string $variacao_id
	 * @param string $nome
	 * @param string $cor
	 */
	public function addProdutoVariacaoViaImportacao($id_produto='',$id_grade='',$variacao_id='', $nome='', $cor = 'False')
	{

		try {

			if (!v::numeric()->notBlank()->validate($id_produto)) {
				throw new \LogicException("Parâmetro ID_PRODUTO inválido", E_USER_NOTICE);
			}

			if (!v::numeric()->notBlank()->validate($id_grade)) {
				throw new \LogicException("Parâmetro ID_GRADE inválido", E_USER_NOTICE);
			}

			if (!v::numeric()->notBlank()->validate($variacao_id)) {
				throw new \LogicException("Parâmetro ID_VARIACAO inválido", E_USER_NOTICE);
			}

			if (!v::stringType()->notEmpty()->validate($nome)) {
				throw new \LogicException("Parâmetro Nome inválido", E_USER_NOTICE);
			}

			$conditions = array(

				'conditions' => array(

					'ShopProdutoVariacao.id_produto_default' => $id_produto,
					'ShopProdutoVariacao.id_grade_default' => $id_grade,
					'ShopProdutoVariacao.id_grade_variacao_default' => $variacao_id,
					'ShopProdutoVariacao.nome' => $nome

				)

			);

			if ($this->find('count', $conditions) <= 0) {

				$cor = isset($cor) && $cor == 'True' ? $cor : 'False';

				$data = array(
					'id_produto_default' => $id_produto,
					'id_grade_default' => $id_grade,
					'id_grade_variacao_default' => $variacao_id,
					'nome' => $nome,
					'cor' => $cor
				);

				$this->saveAll($data);

			}


		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
