<?php



class BannerPosicao extends AppModel {

	public $name = 'BannerPosicao';
	public $useDbConfig = 'default';
	public $useTable = 'banner_posicao';

	/**
     * Local de Publicação do Banner
     * @access public
     * @return array
     */
	public function getAll()
	{

		try {

			$conditions = array(
				'conditions' => array(
					'BannerPosicao.status' => 1
					),
				'order' => array('BannerPosicao.posicao' => 'ASC')
				);

			return $this->find('all', $conditions);

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	/**
     * Local de Publicação do Banner
     * @access public
     * @param String $id_shop variavel de sessão
	 * @return string
     */
	public function getLocalPublicacao($local='')
	{

		try {

			if ( empty($local) ) {
				throw new \LogicException("Valor obrigatório: Informe a variavel local ", 1);
			}

			$conditions = array(
				'conditions' => array(
						'BannerPosicao.local_publicacao' => $local
					)
				);

			return $this->find('all', $conditions );

		} catch (\PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		} catch (\LogicException $e) {

			\Exception\VialojaInvalidLogicException::errorHandler($e);

		}

	}

}
