<?php

use Lib\Validate;
App::uses('AppController', 'Controller');

class BoxProdutoHomeController extends AppController {

	public $uses = array('ShopProduto','ShopProdutoVisualizado');

	private $html = '';
	private $produto_usado;
	private $produto_destaque;
	private $order;
	private $time_id;
	private $cor_block_title;
	private $limit = 12;
	private $oferta = false;

	private $res_produto;
	private $produto;
	private $total;
	private $session_last;
	private $session_id;
	private $value;
	private $key, $i, $key_begin, $key_end;

	private $id_produto,$id_shop_default,$nome,$usado,$preco_promocional,$preco_cheio,$nome_imagem,$dominio;

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

		if ($this->params['named']['box_tipo'] == 'destaque') {
			$this->produto_destaque = array('ShopProduto.destaque' => 'True');

			$this->cor_block_title = '-destaques';

		} else {
			$this->produto_destaque = array('ShopProduto.destaque' => 'False');
		}

		if ($this->params['named']['box_tipo'] == 'recentes') {
			$this->order = 'ShopProduto.created DESC';
			$this->cor_block_title = '-recentes';
		}

		if ($this->params['named']['box_tipo'] == 'usado') {
			$this->produto_usado = array('ShopProduto.usado' => 'True');
			$this->cor_block_title = '-usados';

		} else {
			$this->produto_usado = null;
		}

		if ($this->params['named']['box_tipo'] == 'last_productview') {

			if (isset($_COOKIE['_last_productview'])) {

				$this->res_produto = self::join_produtos_visualizados();

			}

		} else {

			$this->res_produto = self::join_produtos();

		}

        if ( isset($this->res_produto) && Validate::isNotNull($this->res_produto) ) {

			$this->html = '<div class=" block productcarousel" id="module'. $this->time_id .'">
			<div class="block-title'. $this->cor_block_title .'">
				<h2>'. $this->params['named']['box_nome'] .'</h2>
				<div class="pretext"></div>
			</div>

			<div class="block-content">

				<div class="box-products carousel slide" id="productcarousel'. $this->time_id .'">'. PHP_EOL;;

					if (count($this->res_produto) > 4) {

						$this->html .= '<div class="carousel-controls">
							<a class="carousel-control left" href="#productcarousel'. $this->time_id .'"   data-slide="prev"><i class="fa fa-angle-right"></i></a>
							<a class="carousel-control right" href="#productcarousel'. $this->time_id .'"  data-slide="next"><i class="fa fa-angle-left"></i></a>
						</div>'. PHP_EOL;

					}

					$this->html .= '<div class="carousel-inner">'. PHP_EOL;

						$this->total = count($this->res_produto) / 4;

			        	for ($this->i=0; $this->i < $this->total ; $this->i++) {

			        		if ($this->i == 0) {
				        		$this->html .= '<div class="item first active products-grid no-margin">'. PHP_EOL;;
				        	} else {
				             	$this->html .= '<div class="item products-grid no-margin">'. PHP_EOL;;
				        	}

							$this->html .= '<div class="row products-row">'. PHP_EOL;;

							foreach ($this->res_produto as $this->key => $this->produto) {

								switch ($this->i) {
									case 0:
										$this->key_begin = 0;
										$this->key_end = 3;
										break;

									case 1:
										$this->key_begin = 4;
										$this->key_end = 7;
										break;

									default:
										$this->key_begin = 8;
										$this->key_end = 11;
										break;
								}

								if ($this->key >= $this->key_begin && $this->key <= $this->key_end) {

									$this->id_produto = $this->produto['ShopProduto']['id_produto'];
									$this->id_shop_default = $this->produto['ShopProduto']['id_shop_default'];
									$this->nome = $this->produto['ShopProduto']['nome'];
									$this->usado = $this->produto['ShopProduto']['usado'];
									$this->preco_promocional = $this->produto['ShopProduto']['preco_promocional'];
									$this->preco_cheio = $this->produto['ShopProduto']['preco_cheio'];
									$this->nome_imagem = $this->produto['ShopProdutoImagem']['nome_imagem'];

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
				            </div>'. PHP_EOL;

            			}

			$this->html .= '</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">
				jQuery(\'#productcarousel'. $this->time_id .'\').carousel({interval:false,auto:false,pause:\'hover\', cycle: true});
			</script>'. PHP_EOL;

			return $this->html;

		}

	}

	/**
	 * join dos ulltimos produtos visualizados
	 * @access private
	 * @return string
	 */
	private function join_produtos_visualizados()
	{

		try {

			$this->session_last = unserialize($_COOKIE['_last_productview']);
			$this->session_id = array();
			foreach ($this->session_last as $this->value) {
				array_push($this->session_id, $this->value);
			}

			return $this->ShopProdutoVisualizado->find('all', array(

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
	                'ShopProduto.parente_id' => 0,
	                'ShopProduto.ativo' => 'True',
	                'ShopProduto.lixo' => 'False',
	                'ShopProduto.produto_sex_shop' => 'False',
	                'ShopProduto.nome !=' => '',
	                'ShopDominio.main' => 1,
	                'ShopDominio.ativo' => 1,
	                'ShopProdutoImagem.posicao' => 0,
	                'ShopProdutoVisualizado.session_id' => $this->session_id,
	            ),

	            'group' => array('ShopProduto.id_produto'),
	            'order' =>  'ShopProdutoVisualizado.created DESC',
				'limit' => $this->limit,

	            'joins' => array(

	                array(
	                    'table' => 'shop_produto',
	                    'alias' => 'ShopProduto',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProduto.id_produto = ShopProdutoVisualizado.id_produto_default'
	                    )
	                ),

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
	                //$this->produto_usado,
	                //$this->produto_destaque
	            ),

	            'group' => array('ShopProduto.id_produto'),
	            'order' => $this->order,
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

		$this->oferta = Validate::isValueBigger($this->preco_cheio, $this->preco_promocional);

		$this->html .= '<div class="col-xs-12 col-lg-3 col-sm-4 col-4 _item first product-col  ">
			<div class="product-block">

				<div class="image swap">';

					if ($this->usado == 'True') {
						$this->html .= '<span class="new-icon"><span>Usado</span></span>';
					} else {

						if ($this->oferta === true) {
							$this->html .= '<span class="onsale"><span>Oferta</span></span>';
						}

					}

					$this->html .= '<a href="'. sprintf('%s/p/%s/%d/', FULL_BASE_URL, Tools::slug($this->nome) , $this->id_produto ) .'" title="'. $this->nome .'" class="product-image">
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
