<?php

App::uses('AppController', 'Controller');

class BoxProdutoHomeController extends AppController {

	public $uses = array('ShopProduto','ShopProdutoVisualizado');

	private $html;
	private $produto_usado;
	private $produto_destaque;
	private $url_root, $image_padrao, $url_img;
	private $order;
	private $time_id;
	private $limit = 12;
	private $res_produto;
	private $url_produto_loja;
	private $oferta = false;
	private $produto;
	private $total;
	private $nome_categoria;

	private $session_last;
	private $session_id;
	private $value;
	private $key, $i, $key_begin, $key_end;

	private $id_produto,$id_shop_default,$nome,$usado,$preco_promocional,$preco_cheio,$nome_imagem;

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
		} else {
			$this->produto_destaque = array('ShopProduto.destaque' => 'False');
		}

		if ($this->params['named']['box_tipo'] == 'recentes') {
			$this->order = 'ShopProduto.created DESC';
		}

		if ($this->params['named']['box_tipo'] == 'usado') {
			$this->box_usado = array('ShopProduto.usado' => 'True');
		} else {
			$this->box_usado = null;
		}

		if ($this->params['named']['box_tipo'] == 'last_productview') {

			if (isset($_COOKIE['_last_productview'])) {

				$this->res_produto = self::join_produtos_visualizados();

			}

		} else {

			$this->res_produto = self::join_produtos();

		}

        if ( isset($this->res_produto) && Validate::isNotNull($this->res_produto) ) {

			$this->html = '<div class="widget col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12 '. $this->params['named']['box_icon'] .'" >
				<div class="products_block exclusive leomanagerwidgets  block nopadding" >
					<h4 class="page-subheading">
						'. $this->params['named']['box_nome'] .'
					</h4>
					<div class="block_content">
						<div class="carousel slide" id="produtocarousel'. $this->time_id .'">';

							if (count($this->res_produto)>4) {
								# code...

								$this->html .= '<a class="carousel-control left" href="#produtocarousel'. $this->time_id .'"   data-slide="prev">&lsaquo;</a>
								<a class="carousel-control right" href="#produtocarousel'. $this->time_id .'"  data-slide="next">&rsaquo;</a>';

							}

							$this->html .= '<div class="carousel-inner">';

								$this->total = count($this->res_produto) / 4;

			        			for ($this->i=0; $this->i < $this->total ; $this->i++) {

			        				if ($this->i==0) {

			        					$this->html .= '<div class="item active">';

			        				} else {

			        					$this->html .= '<div class="item ">';

			        				}

			        				$this->html .= '<div class="product_list grid">
											<div class="row nomargin">';

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
											$this->nome_categoria = $this->produto['ShopCategoria']['nome_categoria'];

											self::content_html_produto();

										}

									}

									$this->html .= '</div>
									</div>
								</div>';


							}

							$this->html .= '</div>
						</div>
					</div>

				</div>';

				$this->html .= "<script type=\"text/javascript\">
					$(document).ready(function() {
						$('#produtocarousel". $this->time_id ."').each(function(){
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
					'ShopCategoria.nome_categoria'
	            ),

	            'conditions' => array(
	                'ShopProduto.parente_id' => 0,
	                'ShopProduto.ativo' => 'True',
	                'ShopProduto.lixo' => 'False',
	                'ShopProduto.nome !=' => '',
	                'ShopDominio.main' => 1,
	                'ShopDominio.ativo' => 1,
	                'ShopProdutoImagem.posicao' => 0,
					'ShopProdutoVisualizado.session_id' => $this->session_id,
	            ),

	            'group' => array('ShopProduto.id_produto'),
				'order' => 'ShopProdutoVisualizado.created DESC',
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
					),

					array(
	                    'table' => 'shop_produto_categoria',
	                    'alias' => 'ShopProdutoCategoria',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProduto.id_produto = ShopProdutoCategoria.id_produto_default'
	                    )
	                ),

	                array(
	                    'table' => 'shop_categoria',
	                    'alias' => 'ShopCategoria',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopCategoria.id_categoria = ShopProdutoCategoria.id_categoria_default'
	                    )
	                ),

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
	private function join_produtos()
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
					'ShopCategoria.nome_categoria'
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
					'ShopCategoria.id_atividade !=' => 0,
					$this->produto_usado,
					$this->produto_destaque
	            ),

	            'group' => array('ShopProduto.id_produto'),
				'order' => $this->order,
				'limit' => $this->limit,

				'joins' => array(

	                array(

						'table' => 'shop',
						'alias' => 'Shop',
	                    'type' => 'INNER',
	                    'conditions' => array(
							'ShopProduto.id_shop_default = Shop.id_shop'
	                    )
	                ),

	                array(

	                    'table' => 'shop_dominio',
	                    'alias' => 'ShopDominio',
	                    'type' => 'INNER',
	                    'conditions' => array(
							'ShopDominio.id_shop_default = Shop.id_shop'
	                    )
	                ),

	                array(
	                    'table' => 'shop_produto_categoria',
	                    'alias' => 'ShopProdutoCategoria',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopProduto.id_produto = ShopProdutoCategoria.id_produto_default'
	                    )
	                ),

	                array(
	                    'table' => 'shop_categoria',
	                    'alias' => 'ShopCategoria',
	                    'type' => 'INNER',
	                    'conditions' => array(
	                        'ShopCategoria.id_categoria = ShopProdutoCategoria.id_categoria_default'
	                    )
	                ),

					array(

						'table' => 'shop_produto_imagem',
						'alias' => 'ShopProdutoImagem',
						'type' => 'INNER',
						'conditions' => array(
							'ShopProduto.id_produto = ShopProdutoImagem.id_produto_default'
						)
					)

				)

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

		$this->url_img = CDN .'static/img/imagem-padrao/home/produto-sem-imagem.gif';

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

			}

		}

		$this->oferta = Validate::isValueBigger($this->preco_cheio, $this->preco_promocional);

		$this->url_produto_loja = sprintf('%s/p/%s/%s/%d/', FULL_BASE_URL, Tools::slug($this->nome_categoria), Tools::slug($this->nome), $this->id_produto );

		$this->html .= '<div class="nopadding ajax_block_product product_block col-md-3 col-xs-6 col-sp-12 first_item">
			<div class="product-container text-center product-block" itemscope itemtype="http://schema.org/Product">
				<div class="left-block">
					<div class="product-image-container image">
						<div class="leo-more-info" data-idproduct="'. $this->id_produto .'"></div>
						<a class="product_img_link"	href="'. $this->url_produto_loja .'" title="'. $this->nome .'" itemprop="url">
						<img class="replace-2x img-responsive" src="'. $this->url_img .'" alt="'. $this->nome .'" title="'. $this->nome .'" height="250" itemprop="image"  />
						<span class="product-additional" data-idproduct="'. $this->id_produto .'"></span>
						</a>';

						/*

						**Frame

						<a class="quick-view btn-outline-inverse btn" href="//'. env('HTTP_HOST') .'/produto_frame/'. $this->id_produto .'-'. Tools::slug($this->nome) .'" rel="//'. env('HTTP_HOST') .'/produto_frame/'. $this->id_produto .'-'. Tools::slug($this->nome) .'" title="Visualização rápida" >
						<i class="fa fa-plus"></i>
						</a>

						*/

						$this->html .= '<span class="sale-box">';

						if ($this->usado=='True') {
							$this->html .= '<span class="sale-label product-label-used">USADO</span>';
						} else {
							$this->html .= '<span class="sale-label product-label">NOVO</span>';
						}

						$this->html .= '</span>

					</div>
				</div>
				<div class="right-block">
					<div class="product-meta">

						<!--
						<div class="comments_note product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
							<div class="star_content">
								<div class="star star_on"></div>
								<div class="star star_on"></div>
								<div class="star"></div>
								<div class="star"></div>
								<div class="star"></div>
								<meta itemprop="worstRating" content = "0" />
								<meta itemprop="ratingValue" content = "0" />
								<meta itemprop="bestRating" content = "5" />
							</div>
							<span class="nb-comments"><span itemprop="reviewCount">0</span> Comentário (s)</span>
						</div>
						-->


						<h5 itemprop="name" class="name">
							<a class="product-name" href="'. $this->url_produto_loja .'" title="'. $this->nome .'" itemprop="url" >
							'. Tools::formatList($this->nome,40) .'
							</a>
						</h5>
						<p class="product-desc" itemprop="description">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse commodo eu est eget eleifend. Donec luctus metus nulla, ac fringilla quam convallis sed. Cras aliquet lorem nunc, non dapibus tortor consequat auctor. In hac habitasse platea dictumst. Quisque felis ante
						</p>
						<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">';


							if ($this->oferta === true ) {

								$this->html .='<meta itemprop="priceCurrency" content="BRL" />
								de
								<span class="old-price product-price">
									 R$ '. Tools::convertToDecimalBR( $this->preco_cheio ) .'
								</span>

								<span class="price-percent-reduction">-'. Tools::discountPercentageValue($this->preco_cheio,$this->preco_promocional) .'%</span>
								<br />
								<br />
								por
								<span itemprop="price" class="price product-price">

									R$ '. Tools::convertToDecimalBR( $this->preco_promocional ) .'

								</span>';

							} elseif (isset($this->preco_cheio) && $this->preco_cheio > 0) {

								if(!Validate::isPriceMinimum($this->preco_cheio)){

									$this->html .='<span itemprop="price" class="old-price product-price" style="color:#F2434A">
										 Preço Sob Consulta
									</span>';

								} else {

									$this->html .='<meta itemprop="priceCurrency" content="BRL" />

									<span itemprop="price" class="price product-price">
										 R$ '. Tools::convertToDecimalBR( $this->preco_cheio ) .'
									</span>';

								}

							} else {

								$this->html .='<span itemprop="price" class="old-price product-price" style="color:#F2434A">
									 Preço Sob Consulta
								</span>';

							}


						$this->html .='</div>
						<div class="product-flags">
						</div>
						<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
							<span class="out-of-stock">
								<link itemprop="availability" href="http://schema.org/OutOfStock" />
								Fora do Estoque
							</span>
						</div>
						<div class="functional-buttons clearfix">

							<!--
							<div class="cart" style="display: none;">
								<div class="ajax_add_to_cart_button btn disabled btn-outline" title="Fora do Estoque" >
									<i class="fa fa-shopping-cart"></i>
									<span>Fora do Estoque</span>
								</div>
							</div>
							-->

							<div class="cart" style="display: none;">
								<a class="button ajax_add_to_cart_button btn btn-outline" href="order8636.html?add=1&amp;id_product=16&amp;token=c0b3b2573da6513d5d166afa8159f33b" rel="nofollow" title="Adicionar ao carrinho" data-id-product="16">
								<i class="fa fa-shopping-cart"></i>
								<span>Adicionar ao carrinho</span>
								</a>
							</div>

							<div class="wishlist" style="display: none;">
								<a class="btn-tooltip btn btn-outline-inverse addToWishlist wishlistProd_'. $this->id_produto .'" href="#" onclick="WishlistCart(\'wishlist_block_list\', \'add\', \''. $this->id_produto .'\', false, 1); return false;" data-toggle="tooltip" title="Adicionar à Lista de presentes">
								<i class="fa fa-heart"></i>
								<span>Adicionar à Lista de presentes</span>
								</a>
							</div>
							<div class="compare" style="display: none;">
								<a class="add_to_compare compare btn btn-outline-inverse" href="'. $this->url_produto_loja .'" data-id-product="'. $this->id_produto .'" title="Adicionar para comparar" >
								<i class="fa fa-files-o"></i>
								<span>Adicionar para comparar</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- .product-container> -->
		</div>';
	}

}