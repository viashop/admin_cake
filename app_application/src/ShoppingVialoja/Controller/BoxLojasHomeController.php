<?php

App::uses('AppController', 'Controller');

class BoxLojasHomeController extends AppController {

	public $uses = array('ShopProdutoVisualizado');

	private $limit = 8;
	private $html;
	private $logo, $id_shop, $nome_loja, $dominio, $dominio_url, $ssl_ativo, $subdominio_plataforma, $preferencia_url;

	/**
	 * box de estrutura dos produtos
	 * @access public
	 * @return string
	 */
	public function box() {

		if (isset($_COOKIE['_last_productview'])) {
			$result = self::join_ultimas_lojas();
		}

        if ( isset($result) && Validate::isNotNull($result) ) {

			$this->html = '<div class="widget col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12 icon-baby" >
	<div class="products_block exclusive leomanagerwidgets  block nopadding" >
		<h4 class="page-subheading">
			Últimas Lojas Visitadas
		</h4>
		<div class="block_content">
			<div class="carousel slide" id="ultimas_lojas_visitadas">';

				if (count($result)>4) {

					$this->html .= '<a class="carousel-control left" href="#ultimas_lojas_visitadas"   data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#ultimas_lojas_visitadas"  data-slide="next">&rsaquo;</a>';

				}

				$this->html .= '<div class="carousel-inner">';

							$total = count($result) / 4;

		        			for ($this->i=0; $this->i < $total; $this->i++) {

		        				if ($this->i==0) {

		        					$this->html .= '<div class="item active">';

		        				} else {

		        					$this->html .= '<div class="item ">';

		        				}

								$this->html .= '<div class="product_list grid">
									<div class="row nomargin">';


								foreach ($result as $key => $dados) {

									switch ($this->i) {
										case 0:
											$key_begin = 0;
											$key_end = 3;
											break;

										case 1:
											$key_begin = 4;
											$key_end = 7;
											break;

										default:
											$key_begin = 8;
											$key_end = 11;
											break;
									}

									if ($key >= $key_begin && $key <= $key_end) {

										$this->logo = $dados['Shop']['logo'];
										$this->id_shop = $dados['Shop']['id_shop'];
										$this->nome_loja = $dados['Shop']['nome_loja'];
										$this->dominio = $dados['ShopDominio']['dominio'];
										$this->ssl_ativo = $dados['ShopDominio']['ssl_ativo'];
										$this->subdominio_plataforma = $dados['ShopDominio']['subdominio_plataforma'];
										$this->preferencia_url = $dados['Shop']['preferencia_url_dominio'];

										self::content_html_loja();

									}


									$this->html .= '</div>
										</div>
									</div>';

								}

							}

							$this->html .= '</div>
						</div>
					</div>

				</div>';

				$this->html .= "<script type=\"text/javascript\">
					$(document).ready(function() {
						$('#ultimas_lojas_visitadas').each(function(){
							$(this).carousel({
								pause: 'hover',
								interval: 8000
							});
						});
					});
				</script>
			</div>";

			return $this->html;

		}

	}


	/**
	 * join das ultimas lojas visualizados
	 * sql ultimos produtos
	 * @access private
	 * @return string
	 */
	private function join_ultimas_lojas()
	{

		try {

			$session_last = unserialize($_COOKIE['_last_productview']);
			$session_id = array();
			foreach ($session_last as $value) {
				array_push($session_id, $value);
			}

			return $this->ShopProdutoVisualizado->find('all', array(

	            'fields' => array(
	                'Shop.logo',
	                'Shop.nome_loja',
	                'Shop.id_shop',
	                'Shop.preferencia_url_dominio',
	                'ShopDominio.dominio',
	                'ShopDominio.ssl_ativo',
	                'ShopDominio.subdominio_plataforma',
	            ),

	            'conditions' => array(
	                'ShopDominio.main' => 1,
	                'ShopDominio.ativo' => 1,
	                'ShopProdutoVisualizado.session_id' => $session_id,
	            ),

	            'group' => array('ShopProdutoVisualizado.id_shop_default'),
	            'order' => 'ShopProdutoVisualizado.created DESC',
				'limit' => $this->limit,

	            'joins' => array(

	                array(
	                    'table' => 'shop_dominio',
	                    'alias' => 'ShopDominio',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProdutoVisualizado.id_shop_default = ShopDominio.id_shop_default'
	                    )
	                ),

	                array(
	                    'table' => 'shop',
	                    'alias' => 'Shop',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProdutoVisualizado.id_shop_default = Shop.id_shop'
	                    )
	                )

	            ),

	        ));

		} catch (PDOException $e) {

			\Exception\VialojaDatabaseException::errorHandler($e);

		}

	}

	/**
	 * conteudo do box de visaulização
	 * @access private
	 * @return string
	 */
	private function content_html_loja()
	{

		$image_padrao = CDN .'static/img/loja-sem-logo.gif';

		if (!empty($this->logo)) {

			$url_root = sprintf( '%s%d%slogo%s%s',
				CDN_ROOT_UPLOAD,
				$this->id_shop,
				DS,
				DS,
				$this->logo
			);

			if (!is_file($url_root)) {

				$url_img = $image_padrao;

			} else {

				$url_img = sprintf( '%s%d/logo/%s',
					CDN_UPLOAD,
					$this->id_shop,
					$this->logo
				);

			}

		} else {

			$url_img = $image_padrao;

		}

		//'off_www','on_www','undefined'

		if ($this->subdominio_plataforma == 'True') {
			if ($this->ssl_ativo=='True')
				$this->dominio_url = 'https://'. $this->dominio;
			else
				$this->dominio_url = 'http://'. $this->dominio;
		} else {

			if ($this->preferencia_url=='off_www') {

				if ($this->ssl_ativo=='True')
					$this->dominio_url = 'https://'. $this->dominio;
				else
					$this->dominio_url = 'http://'. $this->dominio;

			} else {

				if ($this->ssl_ativo=='True')
					$this->dominio_url = 'https://www.'. $this->dominio;
				else
					$this->dominio_url = 'http://www.'. $this->dominio;
			}

		}

		$this->html .= '<div class="nopadding ajax_block_product product_block col-md-3 col-xs-6 col-sp-12 first_item">
			<div class="product-container text-center product-block">
				<div class="left-block">
					<div class="product-image-container image">
						<div class="leo-more-info" data-idproduct="13"></div>
						<a class="product_img_link" rel="nofollow" href="'. $this->dominio_url .'" title="'. $this->nome_loja .'" target="_BLANK" >
						   <img class="replace-2x img-responsive" src="'.$url_img.'" alt="'. $this->nome_loja .'" title="'. $this->nome_loja .'" />
						</a>

					</div>
				</div>
			</div>
		</div>';

	}

}
