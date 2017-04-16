<?php

use Respect\Validation\Validator as v;


class ShopBannerController extends AppController {

	public $uses = array('ShopBanner');

     /**
     * Localização do banner
     * @access private
     * @param String $local
     * @param String $id_shop
     * @return array
     */
	public function getIdBanner()
	{

        try {

            if (empty($this->params['named']['id'])) {
                throw new \LogicException("Valor obrigatório: Informe a variavel Id", E_USER_WARNING);
            }

            if (!v::numeric()->notBlank()->validate($this->params['named']['id'])) {
                throw new \LogicException("Valor obrigatório: Informe a variavel Id do tipo INT", E_USER_WARNING);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopBanner.id_shop_default' => $this->Session->read('id_shop'),
                    'ShopBanner.id_banner' => $this->params['named']['id']
                )
            );

            if ($this->ShopBanner->find('count', $conditions ) <= 0) {
                return false;
            } else {
                return $this->ShopBanner->find('all', $conditions );
            }


        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

	}

     /**
     * Localização do banner
     * @access private
     * @param String $local
     * @param String $id_shop
     * @return array
     */
    public function getAllLocal()
    {

        try {

            if (empty($this->params['named']['local'])) {
                throw new \LogicException("Valor obrigatório: Informe a variavel local ", E_USER_WARNING);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopBanner.local_publicacao' => $this->params['named']['local'],
                    'ShopBanner.id_shop_default' => $this->Session->read('id_shop')
                ),
                'order' => array('posicao' => 'ASC')
            );

            return $this->ShopBanner->find('all', $conditions );

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Conta o Total Localização do banner
     * @access private
     * @param String $local
     * @param String $id_shop
     * @return array
     */
    public function getAllLocalTotal()
    {

        try {

            if (empty($this->params['named']['local'])) {
                throw new \LogicException("Valor obrigatório: Informe a variavel local ", E_USER_WARNING);
            }

            $conditions = array(
                'conditions' => array(
                    'ShopBanner.local_publicacao' => $this->params['named']['local'],
                    'ShopBanner.id_shop_default' => $this->Session->read('id_shop')
                )
            );

            return $this->ShopBanner->find('count', $conditions );

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

}
