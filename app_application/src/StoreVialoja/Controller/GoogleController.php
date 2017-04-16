<?php

App::uses('AppController', 'Controller');

class GoogleController extends AppController {

	public $layout = false;
	public $uses = array('Shop');

	public function siteVerification() {

		$this->render(false);

		$arquivo = ltrim( strip_tags( $_SERVER['REQUEST_URI'] ) , '/' );
		$diretorio = CDN_ROOT_UPLOAD . self::getIdShopDominio() . DS . 'arquivos'. DS . $arquivo;
		if (file_exists($diretorio)) {
			echo Tools::file_get_contents($diretorio);
		} else {
			echo 'Arquivo não encontrado!';
		}

	}

	private function getIdShopDominio()
	{

		try {

			$dominio = env('HTTP_HOST');

			if (strpos($dominio, 'www.') !== false) {
				$dominio = self::limpa(env('HTTP_HOST'));
			}

			$conditions = array(

                'fields' => array(
                    'Shop.id_shop',
                ),

                'conditions' => array(
                    'ShopDominio.main' => 1,
					'ShopDominio.dominio' => $dominio
                ),

                'joins' => array(
                    array(
                        'table' => 'shop_dominio',
                        'alias' => 'ShopDominio',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ShopDominio.id_shop_default = Shop.id_shop'
                        )

                    )

                )

            );

            $res = $this->Shop->find('first', $conditions);
            return $res['Shop']['id_shop'];

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	private function limpa($url)
	{

		$url = str_replace('https://', '', $url);
		$url = str_replace('http://', '', $url);
		return str_replace('www.', '', $url);

	}

}
