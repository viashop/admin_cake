<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class LogController extends AppController {

	public $uses = array('LogShopVisita', 'LogShopVisitaUrl','LogShopTrafego');

	public function shopVisitaAdd() {

		if (!Validate::isBot()) {

			if (!$this->Session->read('log_id_visita')) {

				$res_id = $this->LogShopVisita->insert(

					ID_SHOP_DEFAULT,
					$this->Session->id(),
					$this->request->referer(),
					$this->request->header('User-Agent'),
					$this->request->clientIp()

				);

				$this->Session->write('log_id_visita', $res_id);

			}

			if ($this->Session->read('log_id_visita')) {

				$this->LogShopVisitaUrl->insert(
					$this->Session->read('log_id_visita'),
					Tools::getUrl(),
					$this->request->referer()
				);

			}


		}


		if ( isset( $this->params['named']['trafego_bytes'] ) ) {

			if ( is_numeric( $this->params['named']['trafego_bytes'] ) ) {

				$this->LogShopTrafego->insert(
					ID_SHOP_DEFAULT,
					$this->params['named']['trafego_bytes'],
					$this->request->referer(),
					$this->request->header('User-Agent'),
					Tools::getUrl(),
					$this->request->clientIp()
				);

			}

		}

	}

}