<?php

App::uses('AppController', 'Controller');

class BannerShoppingController extends AppController {

	public $uses = array('BannerShopping');

	public function getBannerParente($id=null)
	{
		try {

			$conditions = array(

				'fields' => array(
					'BannerShopping.id',
					'BannerShopping.link',
					'BannerShopping.target',
					'BannerShopping.titulo',
					'BannerShopping.caminho',
					'BannerShopping.nome',
					'BannerShopping.texto',
					'BannerShopping.data_x',
					'BannerShopping.data_y'
				),

				'conditions' => array(

					'BannerShopping.parente_id' => $id

				),

				//'order' => 'rand()'
				'order' => array('BannerShopping.posicao' => 'ASC')

			);

			return $this->BannerShopping->find('all', $conditions);

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	public function ul_slide()
	{

		$result = self::getBanner($this->params['named']['local_publicacao']);

		$html = '<ul>';

		foreach ($result as $dados){

			$html .= '<li data-masterspeed="300" data-transition="random" data-slotamount="7" data-thumb="'. CDN .'static/img/banner/sliderlayer/slideshow.png" style="background-color:#fff2e6">
			<img src="'. CDN .'upload/ads/banner/sliderlayer/slideshow.png" alt=""/>
			<div class="caption fade easeOutExpo"
				data-x="0"
				data-y="0"
				data-speed="300"
				data-start="400"
				data-easing="easeOutExpo">
				<a href="'. $dados['BannerShopping']['link'] .'" target="'. $dados['BannerShopping']['target'] .'" title="'. $dados['BannerShopping']['titulo'] .'">
					<img src="'. CDN .'upload/ads/banner/sliderlayer/'. $dados['BannerShopping']['caminho'] .'" alt="'. $dados['BannerShopping']['nome'] .'"/>
				</a>
			</div>';

			/*

			$parente = self::getBannerParente($dados['BannerShopping']['id']);

			foreach ($parente as $key => $banner_p){

				$start = 400;
				$start = $start + ( 800 * $key );


				$html .= '<div class="caption fade easeOutExpo"
				data-x="'. $banner_p['BannerShopping']['data_x'] .'"
				data-y="'. $banner_p['BannerShopping']['data_y'] .'"
				data-speed="300"
				data-start="'. $start .'"
				data-easing="easeOutExpo">';
				$html .= '<a href="'. $banner_p['BannerShopping']['link'] .'"><img src="'. CDN .'upload/ads/banner/sliderlayer/'. $banner_p['BannerShopping']['caminho'] .'" alt=""/></a>';



				/*
				if (!empty($banner_p['BannerShopping']['texto'])) {


				$html .='<div class="caption fade easeOutExpo"
					data-x="79"
					data-y="139"
					data-speed="300"
					data-start="800"
					data-easing="easeOutExpo"style="font-size:48px;background-color:transparent;color:#ffffff">
					Summer Hat
				</div>

				<div class="caption big_white sft easeOutExpo"
					data-x="214"
					data-y="96"
					data-speed="300"
					data-start="1200"
					data-easing="easeOutExpo"style="background-color:transparent">
					The Perfect
				</div>

				<div class="caption medium_text sfb easeOutExpo"
					data-x="115"
					data-y="194"
					data-speed="300"
					data-start="1600"
					data-easing="easeOutExpo"style="font-size:18px;color:#ffffff">
					Universally Flattering
				</div>';

				}
				*\/




				$html .= '</div>';

			}

			*/


			$html .= '</li>';

		}

		$html .= '</ul>';

		return $html;

	}

	/**
	 * Slide
	 * @access public
	 * @return string
	 */

	public function getBanner($local = null)
	{
		try {

			if (!isset($local)) {
				$local = $this->params['named']['local_publicacao'];
			}

			$conditions = array(

				'fields' => array(
					'BannerShopping.id',
					'BannerShopping.link',
					'BannerShopping.target',
					'BannerShopping.titulo',
					'BannerShopping.caminho',
					'BannerShopping.nome'
				),

				'conditions' => array(

					'BannerShopping.ativo' => 'True',
					'BannerShopping.local_publicacao' => $local

				),

				//'order' => 'rand()'
				'order' => array('BannerShopping.posicao' => 'ASC')

			);

			return $this->BannerShopping->find('all', $conditions);

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

}