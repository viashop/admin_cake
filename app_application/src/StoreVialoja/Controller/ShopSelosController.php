<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class ShopSelosController extends AppController
{

	public $uses = array('ShopSelos');

    private $dados;
	/**
	 * Obter os dados de selos de certificação
	 * @access public
     * @return string
	 */
	public function getDadosSelos()
	{

		try {

			$this->dados = $this->ShopSelos->find('first', array(

				'fields' => array(
                    'ShopSelos.selo_ebit',
                    'ShopSelos.banner_ebit',
                    'ShopSelos.selo_google_safe',
                    'ShopSelos.selo_norton_secured',
                    'ShopSelos.selo_seomaster'
                ),
                'conditions' => array(
                    'ShopSelos.id_shop_default' => ID_SHOP_DEFAULT
                ),

            ));

            if (Validate::isNotNull($this->dados)) {

                $GLOBALS['ShopSelos']['selo_ebit'] = $this->dados['ShopSelos']['selo_ebit'];
                $GLOBALS['ShopSelos']['banner_ebit'] = $this->dados['ShopSelos']['banner_ebit'];
                $GLOBALS['ShopSelos']['selo_google_safe'] = $this->dados['ShopSelos']['selo_google_safe'];
                $GLOBALS['ShopSelos']['selo_norton_secured'] = $this->dados['ShopSelos']['selo_norton_secured'];
                $GLOBALS['ShopSelos']['selo_seomaster'] = $this->dados['ShopSelos']['selo_seomaster'];
                $GLOBALS['ShopSelos']['mostrar_txt_certificados'] = true;

            } else {

                $GLOBALS['ShopSelos']['selo_ebit'] = '';
                $GLOBALS['ShopSelos']['banner_ebit'] = '';
                $GLOBALS['ShopSelos']['selo_google_safe'] = '';
                $GLOBALS['ShopSelos']['selo_norton_secured'] = '';
                $GLOBALS['ShopSelos']['selo_seomaster'] = '';
            }

		} catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

}
