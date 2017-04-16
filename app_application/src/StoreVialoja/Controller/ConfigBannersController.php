<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class ConfigBannersController extends AppController {

	private $pagina_publicacao = 'pagina_inicial';
	private $parsed_url;

	public function actions()
	{

		$GLOBALS['res_full_banners'] = $this->requestAction(
			array(
				'controller' => 'ShopBanner',
				'action' => 'getBanners',
				'local_publicacao' => 'fullbanner',
				'pagina_publicacao' => 'pagina_inicial',
				'limit' => 8
			)
		);

		if (Validate::isNotNull($GLOBALS['res_full_banners'])) {

			define('FULL_BANNERES_SHOP', true);

		} else {

			$GLOBALS['res_default_banners'] = $this->requestAction(
				array(
					'controller' => 'ShopBanner',
					'action' => 'getBanners',
					'local_publicacao' => 'defaultbanner',
					'pagina_publicacao' => 'pagina_inicial',
					'limit' => 8
				)
			);

		}

		$GLOBALS['res_vitrine_banners'] = $this->requestAction(
			array(
				'controller' => 'ShopBanner',
				'action' => 'getBanners',
				'local_publicacao' => 'vitrine',
				'pagina_publicacao' => $this->pagina_pub(),
				'limit' => 1
			)
		);

		$GLOBALS['res_banners'] = $this->requestAction(
			array(
				'controller' => 'ShopBanner',
				'action' => 'getBanners',
				'local_publicacao' => 'banner',
				'pagina_publicacao' => $this->pagina_pub(),
				'limit' => 12
			)
		);

		$GLOBALS['res_tarja_banners'] = $this->requestAction(
			array(
				'controller' => 'ShopBanner',
				'action' => 'getBanners',
				'local_publicacao' => 'tarja',
				'pagina_publicacao' => $this->pagina_pub(),
				'limit' => 2
			)
		);

		$GLOBALS['res_mini_banners'] = $this->requestAction(
			array(
				'controller' => 'ShopBanner',
				'action' => 'getBanners',
				'local_publicacao' => 'minibanner',
				'pagina_publicacao' => $this->pagina_pub(),
				'limit' => 12
			)
		);

		$GLOBALS['banner_pagina_pub'] = $this->pagina_pub();

	}

	private function pagina_pub()
	{

		$this->parsed_url = parse_url(Tools::getUrl());

		/**
		 * Corrige url a notificação do facebook
		 */
		if (Tools::getValue('fb_comment_id') != '') {

			$this->parsed_url['query'] = $this->parsed_url['path'];
		}

        if ( isset( $this->parsed_url['query'] ) ) {

            if ( strpos($this->parsed_url['query'], '/p/') !== false ) {
                $this->pagina_publicacao = 'produto';
            }

        } elseif ( isset( $this->parsed_url['query'] ) ) {

            if ( strpos($this->parsed_url['query'], '/c/') !== false ) {
                $this->pagina_publicacao = 'categoria';
            }

        } elseif ( isset( $this->parsed_url['query'] ) ) {

            if ( strpos($this->parsed_url['query'], '/m/') !== false ) {
                $this->pagina_publicacao = 'marca';
            }

        } elseif ( isset( $this->parsed_url['query'] ) ) {

            if ( strpos($this->parsed_url['query'], '/busca/') !== false ) {
                $this->pagina_publicacao = 'busca';
            }

        } elseif ( isset( $this->parsed_url['query'] ) ) {

            if ( strpos($this->parsed_url['query'], '/t/') !== false ) {
                $this->pagina_publicacao = 'pagina';
            }

        }

        return $this->pagina_publicacao;

	}

}
