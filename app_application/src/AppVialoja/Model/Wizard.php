<?php

/**
 * @copyright Vialoja  (http://vialoja.com.br)
 * @author William Duarte <williamduarteoficial@gmail.com>
 * @version 1.0.1
 * Date: 16/10/16 às 18:11
 */
class Wizard extends AppModel {

    public $name = 'Wizard';
    public $useTable = 'wizard';
    public $primaryKey = 'id_shop_default';
    public $useDbConfig = 'default';

    use \AppVialoja\Traits\Entity\TWizard;

    /**
     * Verifica se o usuario já submeteu o formulario pelo passo 1
     * @param Shop $shop
     * @return array|null
     */
    public function passoWizard(Shop $shop)
    {
    	try {

            if (!is_int($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getPasso int');
            }

   			$conditions = array(
                'conditions' => array(
                    'Wizard.id_shop_default' => $shop->getIdShop()
                )
            );

            return $this->find('first', $conditions);

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

    /**
     * Update Passos de Cadastro na Wizard
     * @param Shop $shop
     * @param Wizard $wizard
     */
    public function updatePasso(Shop $shop, Wizard $wizard)
    {

        try {

            if (empty($shop->getIdShop())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getIdShop');
            }

            if (empty($wizard->getPasso())) {
                throw new \LogicException(ERROR_LOGIC_VAR . 'getPasso');
            }

            $conditions = array(
                'conditions' => array(
                    'Wizard.id_shop_default' => $shop->getIdShop(),
                    'Wizard.passo <=' => $wizard->getPasso()
                )
            );

            if ($this->find('count', $conditions) > 0) {

                $this->updateAll(array(
                    'Wizard.passo' => sprintf("'%s'", $wizard->getPasso())
                ), array(
                    'Wizard.id_shop_default' => $shop->getIdShop()
                ));

            }

        } catch (\PDOException $e) {

            \Exception\VialojaDatabaseException::errorHandler($e);

        } catch (\LogicException $e) {

            \Exception\VialojaInvalidLogicException::errorHandler($e);

        }

    }

}
