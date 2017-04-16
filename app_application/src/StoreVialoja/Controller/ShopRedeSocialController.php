<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class ShopRedeSocialController extends AppController
{

	public $uses = array('ShopRedeSocial');
    private $dados;
	/**
	 * Obter os dados de rede social
	 * @access public
	 * @param String $id_shop
     * @return string
	 */
	public function getDadosSocial()
	{

		try {

			$this->dados = $this->ShopRedeSocial->find('first', array(

				'fields' => array(

                    'ShopRedeSocial.facebook',
                    'ShopRedeSocial.twitter',
                    'ShopRedeSocial.pinterest',
                    'ShopRedeSocial.instagram',
                    'ShopRedeSocial.google_plus',
                	'ShopRedeSocial.youtube',
                	'ShopRedeSocial.skype',
                	'ShopRedeSocial.whatsapp'
                ),

                'conditions' => array(
                    'ShopRedeSocial.id_shop_default' => ID_SHOP_DEFAULT
                ),

            ));

            if (Validate::isNotNull($this->dados)) {

                $GLOBALS['ShopRedeSocial']['facebook'] = $this->dados['ShopRedeSocial']['facebook'];
                $GLOBALS['ShopRedeSocial']['twitter'] = $this->dados['ShopRedeSocial']['twitter'];
                $GLOBALS['ShopRedeSocial']['pinterest'] = $this->dados['ShopRedeSocial']['pinterest'];
                $GLOBALS['ShopRedeSocial']['instagram'] = $this->dados['ShopRedeSocial']['instagram'];
                $GLOBALS['ShopRedeSocial']['google_plus'] = $this->dados['ShopRedeSocial']['google_plus'];
                $GLOBALS['ShopRedeSocial']['youtube'] = $this->dados['ShopRedeSocial']['youtube'];
                $GLOBALS['ShopRedeSocial']['skype'] = $this->dados['ShopRedeSocial']['skype'];
                $GLOBALS['ShopRedeSocial']['whatsapp'] = $this->dados['ShopRedeSocial']['whatsapp'];

            } else {

                $GLOBALS['ShopRedeSocial']['facebook'] = '';
                $GLOBALS['ShopRedeSocial']['twitter'] = '';
                $GLOBALS['ShopRedeSocial']['pinterest'] = '';
                $GLOBALS['ShopRedeSocial']['instagram'] = '';
                $GLOBALS['ShopRedeSocial']['google_plus'] = '';
                $GLOBALS['ShopRedeSocial']['youtube'] = '';
                $GLOBALS['ShopRedeSocial']['skype'] = '';
                $GLOBALS['ShopRedeSocial']['whatsapp'] = '';

            }

		} catch (PDOException $e) {
            \Exception\VialojaDatabaseException::errorHandler($e);
		}

	}

}
