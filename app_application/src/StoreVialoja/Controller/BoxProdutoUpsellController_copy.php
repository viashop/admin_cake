<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class BoxProdutoUpsellController extends AppController {

	public $uses = array('ShopProduto');

	private $html = '';
	private $produto_usado;
	private $produto_destaque;
	private $order;
	private $time_id;
	private $cor_block_title;
	private $limit;
	private $divisao = 3;
	private $oferta = false;

	private $total;

	private $id_produto,$id_shop_default,$nome,$usado,$preco_promocional,$preco_cheio,$nome_imagem,$dominio,$dominio_url,$ssl_ativo,$subdominio_plataforma,$preferencia_url;

	private $url_img;
	private $url_img_large;
	private $url_root;

	/**
	 * box de estrutura dos produtos
	 * @access public
	 * @return string
	 */
	public function box() {

		$this->time_id = Tools::uniqid();

		$this->order = 'rand()';

		$produto_destaque = array('ShopProduto.destaque' => 'True');
		$produto_usado = null;

		$res_produto = self::join_produtos();

        if ( isset($res_produto) && Validate::isNotNull($res_produto) ) {

        	$this->html .= '<!-- Carousel -->
			<div id="upsell" class="carousel slide" data-interval="false">
			    <div class="box-collateral box-up-sell">
			        <div class="block-title">
			            <strong>
			            <span>Produtos relacionados</span>
			            </strong>
			            <!-- Controls -->
			            <div class="carousel-controls" dir="ltr">';

						if (count($res_produto) > 3) {

							$this->html .= '<a class="carousel-control pull-right" href="#upsell" data-slide="next">
								<span class="cars-icon cars-next"><i class="fa fa-angle-right"></i></span>
							</a>
							<a class="carousel-control pull-left" href="#upsell" data-slide="prev">
								<span class="cars-icon cars-prev"><i class="fa fa-angle-left"></i></span>
							</a>';

						}

			            $this->html .= '</div>
			        </div>
			        <div class="carousel-inner">';

			        	$this->total = count($res_produto) / $this->divisao;

			        	for ($i=0; $i < $this->total ; $i++) {

			        		if ($i == 0) {
				        		$this->html .= '<div class="item active product-grid no-margin">';
				        	} else {
				             	$this->html .= '<div class="item product-grid no-margin">';
				        	}

							$this->html .= '<div class="row products-row">';

							foreach ($res_produto as $key => $produto) {

								switch ($i) {
									case 0:
										$key_begin = 0;
										$key_end = 2;
										break;

									case 1:
										$key_begin = 3;
										$key_end = 5;
										break;

									case 2:
										$key_begin = 6;
										$key_end = 8;
										break;

									default:
										$key_begin = 9;
										$key_end = 11;
										break;
								}

								//if ($key % 6 == 0) {
								if ($key >= $key_begin && $key <= $key_end) {

									$this->id_produto = $produto['ShopProduto']['id_produto'];
									$this->id_shop_default = $produto['ShopProduto']['id_shop_default'];
									$this->nome = $produto['ShopProduto']['nome'];
									$this->usado = $produto['ShopProduto']['usado'];
									$this->preco_promocional = $produto['ShopProduto']['preco_promocional'];
									$this->preco_cheio = $produto['ShopProduto']['preco_cheio'];
									$this->nome_imagem = $produto['ShopProdutoImagem']['nome_imagem'];
									$this->dominio = $produto['ShopDominio']['dominio'];
									$this->ssl_ativo = $produto['ShopDominio']['ssl_ativo'];
									$this->subdominio_plataforma = $produto['ShopDominio']['subdominio_plataforma'];
									$this->preferencia_url = $produto['Shop']['preferencia_url_dominio'];

									self::content_html_produto();

								}

							}

							$this->html .= '</div>

				                <script type="text/javascript"><!--
				                    jQuery(document).ready(function() {
				                        jQuery(\'.colorbox\').colorbox({
				                            overlayClose: true,
				                            opacity: 0.5,
				                            rel: false,
				                            onLoad:function(){
				                                jQuery("#cboxNext").remove(0);
				                                jQuery("#cboxPrevious").remove(0);
				                                jQuery("#cboxCurrent").remove(0);
				                            }
				                        });

				                    });
				                    //--></script>
				                <script type="text/javascript">
				                    jQuery(document).ready(function() {
				                        jQuery(".ves-colorbox").colorbox({
				                                width: \'60%\',
				                                height: \'80%\',
				                                overlayClose: true,
				                                opacity: 0.5,
				                                iframe: true,
				                        });

				                    });
				                </script>
				            </div>';

            			}

			$this->html .= '</div>
			    </div>
			</div>
			<script type="text/javascript">
			    jQuery(\'.carousel\').carousel({
			    	interval:6000,auto:true,pause:\'hover\', cycle: true
			    });
			</script>';

			return $this->html;

		}

	}


	/**
	 * join dos produtos
	 * @access private
	 * @return string
	 */
	public function join_produtos()
	{

		try {

			return $this->ShopProduto->find('all', array(

	            'fields' => array(
	                'ShopProduto.id_produto',
	                'ShopProduto.id_shop_default',
	                'ShopProduto.nome',
	                'ShopProduto.usado',
	                'ShopProduto.preco_promocional',
	                'ShopProduto.preco_cheio',
	                'ShopProdutoImagem.nome_imagem',
	                'ShopDominio.dominio',
	                'ShopDominio.ssl_ativo',
	                'ShopDominio.subdominio_plataforma',
	                'Shop.preferencia_url_dominio',
	            ),

	            'conditions' => array(
	                'Shop.id_shop' => ID_SHOP_DEFAULT,
	                'ShopProduto.parente_id' => 0,
	                'ShopProduto.ativo' => 'True',
	                'ShopProduto.lixo' => 'False',
	                'ShopProduto.nome !=' => '',
	                'ShopDominio.main' => 1,
	                'ShopDominio.ativo' => 1,
	                'ShopProdutoImagem.posicao' => 0
	                //$this->usado,
	                //$produto_destaque
	            ),

	            'group' => array('ShopProduto.id_produto'),
	            'order' =>  $this->order,
				'limit' => $this->limit,

	            'joins' => array(
	                array(
	                    'table' => 'shop_produto_imagem',
	                    'alias' => 'ShopProdutoImagem',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProduto.id_produto = ShopProdutoImagem.id_produto_default'
	                    )
	                ),

	                array(
	                    'table' => 'shop_dominio',
	                    'alias' => 'ShopDominio',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProduto.id_shop_default = ShopDominio.id_shop_default'
	                    )
	                ),

	                array(
	                    'table' => 'shop',
	                    'alias' => 'Shop',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProduto.id_shop_default = Shop.id_shop'
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
	private function content_html_produto()
	{

		$this->url_img       = CDN .'static/img/imagem-padrao/home/produto-sem-imagem.gif';
		$this->url_img_large = CDN .'static/img/imagem-padrao/large/produto-sem-imagem.gif';

		if (!empty($this->nome_imagem)) {

			$this->url_root = sprintf( '%s%d%sproduto%s%d%shome%s%s',
				CDN_ROOT_UPLOAD,
				$this->id_shop_default,
				DS,
				DS,
				$this->id_produto,
				DS,
				DS,
				$this->nome_imagem
			);

			if (is_file($this->url_root)) {

				$this->url_img = sprintf( '%s%d/produto/%d/home/%s',
					CDN_UPLOAD,
					$this->id_shop_default,
					$this->id_produto,
					$this->nome_imagem
				);

				$this->url_img_large = sprintf( '%s%d/produto/%d/large/%s',
					CDN_UPLOAD,
					$this->id_shop_default,
					$this->id_produto,
					$this->nome_imagem
				);

			}

		}

		//'off_www','on_www','undefined'

		if ($this->subdominio_plataforma == 'True') {

			if ($this->ssl_ativo=='True')
				$this->dominio_url = 'https://'. $this->dominio;
			else
				$this->dominio_url = 'http://'. $this->dominio;

		} else {

			if ($this->preco_promocional=='off_www') {

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

		$this->oferta = Validate::isValueBigger($this->preco_cheio, $this->preco_promocional);

		$this->html .= '<div class="col-xs-12 col-lg-4 col-sm-4 col-4 _item first product-col  ">
			<div class="product-block">

				<div class="image swap">';

					if ($this->usado == 'True') {
						$this->html .= '<span class="new-icon"><span>Usado</span></span>';
					} else {

						if ($this->oferta === true) {
							$this->html .= '<span class="onsale"><span>Oferta</span></span>';
						}

					}

					$this->html .= '<a href="'. sprintf('%s/p/%s/%d/', FULL_BASE_URL, Tools::slug($this->nome), $this->id_produto ) .'" title="'. $this->nome .'" class="product-image">
						<img src="'. $this->url_img .'" width="270" height="203" alt="'. $this->nome .'" />
					</a>

					<div class="product-colorbox">';

						/*
						<a class="ves-colorbox ves-quickview" href="'. sprintf('%s/p/%s/%d/', FULL_BASE_URL, Tools::slug($this->nome), $this->id_produto ) .'"><i class="fa fa-eye"></i></a>
						*/

						$this->html .= '<a href="'. $this->url_img_large .'" class="colorbox product-zoom ves-zoom" rel="colorbox" title="'. $this->nome .'"><i class="fa fa-search-plus"></i></a>
					</div>
				</div>

				<div class="product-info">

					<h2 class="product-name">
						<a href="'. sprintf('%s/p/%s/%d/', FULL_BASE_URL, Tools::slug($this->nome), $this->id_produto ) .'" title="'. $this->nome .'">'. Tools::formatList($this->nome,40) .'</a>
					</h2><br />';

					/*

					<!--
					<div class="rating">
						<div class="ratings">
							<div class="rating-box">
								<div class="rating" style="width:80%"></div>
							</div>
							<span class="amount"><a href="#" onclick="var t = opener ? opener.window : window; t.location.href=\'/review/product/list/id/167/\'; return false;">1 Review(s)</a></span>
						</div>
					</div>
					-->';

					*/

					$this->html .= '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price">';

					if ($this->oferta === true) {


						$this->html .= '<div class="price">

							<div class="price-box">

	    						<meta itemprop="priceCurrency" content="BRL" />

								<p class="old-price">
									<span class="price-label">Preço Regular</span>
									de
									<span itemprop="price" class="price" id="old-price-'. $this->id_produto .'_clone">
										R$ '. Tools::convertToDecimalBR( $this->preco_cheio ) .'
									</span>
								</p>

								<p class="special-price">
									<span class="price-label">Preço Especial</span>
									por
									<span itemprop="price" class="price" id="product-price-'. $this->id_produto .'_clone">
										R$ '. Tools::convertToDecimalBR( $this->preco_promocional ) .'
									</span>
								</p>

							</div>

						</div>';


					} elseif (isset($this->preco_cheio) && $this->preco_cheio > 0) {

						$this->html .='<meta itemprop="priceCurrency" content="BRL" />

						<div class="price">

							<div class="price-box">

	    						<meta itemprop="priceCurrency" content="BRL" />

								<p class="special-price">
									<span class="price-label">Preço Regular</span>
									<span itemprop="price" class="price" id="product-price-'. $this->id_produto .'_clone">
										R$ '. Tools::convertToDecimalBR( $this->preco_cheio ) .'
									</span>
								</p>

							</div>

						</div>';

					} else {

						$this->html .= '<div class="price">

							<div class="price-box">

	    						<meta itemprop="priceCurrency" content="BRL" />

								<p class="special-price">
									<span class="price-label">Preço Regular</span>
									<span itemprop="price" class="price" id="special-price-'. $this->id_produto .'_clone">
										Preço Sob Consulta
									</span>
								</p>

							</div>

						</div>';

					}

					$this->html .='</div>';

					/*
					<!--
					<div class="actions">
						<button type="button" title="Comprar" class="button btn-cart" onclick="addToCart(\'/checkout/carrinhoadd/uenc/aHR0cDovL3ZlbnVzZGVtby5jb20vbWFnZW50by9zdXBlcnN0b3JlLw,,/product/167/form_key/6R60L4AHyGWA6YxI/\')"><span><span><i class="fa fa-shopping-cart"></i> Comprar</span></span></button>
						<ul class="add-to-links">
							<li><a href="/wishlist/index/add/product/167/form_key/6R60L4AHyGWA6YxI/" class="link-wishlist"><i class="fa fa-heart"></i></a></li>
							<li><span class="separator">|</span> <a href="/catalog/product_compare/add/product/167/uenc/aHR0cDovL3ZlbnVzZGVtby5jb20vbWFnZW50by9zdXBlcnN0b3JlLw,,/form_key/6R60L4AHyGWA6YxI/" class="link-compare"><i class="fa fa-copy"></i></a></li>
						</ul>
					</div>
					-->
					*/

				$this->html .= '</div>
			</div>
		</div>';
	}

}
