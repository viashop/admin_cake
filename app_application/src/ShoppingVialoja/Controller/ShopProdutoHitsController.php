<?php

App::uses('AppController', 'Controller');

class ShopProdutoHitsController extends AppController {

	public $uses = array('ShopProdutoHits');

	public $layout = false;
	private $limit = 6;

	public function mais_visualizados() {

		$html = '<div id="best-sellers_block_right" class="block products_block nopadding block-highlighted">
			<h4 class="title_block">
				<a href="/mais-visualizados" title="Ver os mais vendidos">Mais visualizados</a>
			</h4>
			<div class="block_content products-block">
				<ul class="products products-block">';

				$res_produto = self::join_produtos_mais_visualizados();

				foreach ($res_produto as $produto) {

					$preco_promocional = $produto['ShopProduto']['preco_promocional'];
					$preco_cheio = $produto['ShopProduto']['preco_cheio'];
					$id_produto = $produto['ShopProduto']['id_produto'];
					$nome_imagem = $produto['ShopProdutoImagem']['nome_imagem'];
					$nome = $produto['ShopProduto']['nome'];
					$id_shop_default = $produto['Shop']['id_shop'];

					$image_padrao = CDN .'static/img/imagem-padrao/cart/produto-sem-imagem.gif';

					if (!empty($nome_imagem)) {

						$url_root = sprintf( '%s%d%sproduto%s%d%scart%s%s',
							CDN_ROOT_UPLOAD,
							$id_shop_default,
							DS,
							DS,
							$id_produto,
							DS,
							DS,
							$nome_imagem
						);

						if (!is_file($url_root)) {

							$url_img = $image_padrao;

						} else {

							$url_img = sprintf( '%s%d/produto/%d/cart/%s',
								CDN_UPLOAD,
								$id_shop_default,
								$id_produto,
								$nome_imagem
							);

						}

					} else {

						$url_img = $image_padrao;

					}

					$oferta = Validate::isValueBigger($preco_cheio, $preco_promocional);

					$this->url_produto_loja = sprintf('%s/p/%s/%d/', FULL_BASE_URL, Tools::slug($nome), $id_produto );

					$oferta = Validate::isValueBigger($preco_cheio, $preco_promocional);

					$html .= '<li class="clearfix media">
						<div class="product-block">
							<div class="product-container media" itemscope itemtype="http://schema.org/Product">
								<a class="products-block-image img pull-left" href="'. $this->url_produto_loja .'" title="'. $nome .'"><img class="replace-2x img-responsive" src="'. $url_img .'" alt="'. $nome .'" />
								</a>
								<div class="media-body">
									<div class="product-content">';

										/*
										<div class="comments_note product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
											<div class="star_content">
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<meta itemprop="worstRating" content = "0" />
												<meta itemprop="ratingValue" content = "0" />
												<meta itemprop="bestRating" content = "5" />
											</div>
											<span class="nb-comments"><span itemprop="reviewCount">0</span> Comentário (s)</span>
										</div>
										*/

										$html .= '<h5 class="name media-heading">
											<a class="product-name" href="'. $this->url_produto_loja .'" title="'. $nome .'">
											'. Tools::formatList($nome,18) .'</a>
										</h5>';

										if ($oferta === true ) {

											$html .='<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
												<span class="old-price product-price">
													R$ '. Tools::convertToDecimalBR( $preco_cheio ) .'
												</span>
												<br />
												<span itemprop="price" class="product-price">
													R$ '. Tools::convertToDecimalBR( $preco_promocional ) .'
												</span>
												<meta itemprop="priceCurrency" content="BRL" />
											</div>';


										} elseif (isset($preco_cheio) && $preco_cheio > 0) {

											if(!Validate::isPriceMinimum($preco_cheio)){

												$html .='<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

													<span itemprop="price" class="old-price product-price" style="color:#F2434A">
														Preço Sob Consulta
													</span>
												</div>';

											} else {

												$html .='<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
													<span itemprop="price" class="product-price">
														R$ '. Tools::convertToDecimalBR( $preco_cheio ) .'
													</span>
													<meta itemprop="priceCurrency" content="BRL" />
												</div>';

											}

										} else {

											$html .='<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

												<span itemprop="price" class="old-price product-price" style="color:#F2434A">
													Preço Sob Consulta
												</span>
											</div>';

										}


									$html .='</div>
								</div>
							</div>
						</div>
					</li>';

				}

				$html .= '</ul>
				<div class="lnk">
					<a href="/mais-visualizados" title="Todos os mais visualizados"  class="btn btn-outline button button-small btn-sm"><span>Todos os mais visualizados</span></a>
				</div>
			</div>
		</div>';

		return $html;
	}

	private function join_produtos_mais_visualizados()
	{

		try {

			return $this->ShopProdutoHits->find('all', array(

				'fields' => array(
					'ShopProduto.id_produto',
					'ShopProduto.nome',
					'ShopProduto.usado',
					'ShopProduto.preco_promocional',
					'ShopProduto.preco_cheio',
					'ShopProdutoImagem.nome_imagem',
					'Shop.id_shop'
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
					'ShopProdutoImagem.nome_imagem !=""',
				),

				'group' => array('ShopProduto.id_produto'),
				'order' => 'ShopProdutoHits.hits DESC',
				'limit' => $this->limit,

				'joins' => array(

					array(
						'table' => 'shop_produto',
						'alias' => 'ShopProduto',
						'type' => 'INNER',
						'conditions' => array(
							'ShopProduto.id_produto = ShopProdutoHits.id_produto_default'
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

	public function mais_vendidos() {

		$html = '<div id="best-sellers_block_right" class="block products_block nopadding block-highlighted">
			<h4 class="title_block">
				<a href="best-sales.html" title="Ver produtos mais vendidos">Mais vendidos</a>
			</h4>
			<div class="block_content products-block">
				<ul class="products products-block">
					<li class="clearfix media">
						<div class="product-block">
							<div class="product-container media" itemscope itemtype="http://schema.org/Product">
								<a class="products-block-image img pull-left" href="tshirts/1-faded-short-sleeve-tshirts.html" title=""><img class="replace-2x img-responsive" src="/1-small_default/faded-short-sleeve-tshirts.jpg" alt="Faded Short Sleeve T-shirts" />
								</a>
								<div class="media-body">
									<div class="product-content">
										<div class="comments_note product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
											<div class="star_content">
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<meta itemprop="worstRating" content = "0" />
												<meta itemprop="ratingValue" content = "0" />
												<meta itemprop="bestRating" content = "5" />
											</div>
											<span class="nb-comments"><span itemprop="reviewCount">0</span> Comentário (s)</span>
										</div>
										<h5 class="name media-heading">
											<a class="product-name" href="tshirts/1-faded-short-sleeve-tshirts.html" title="Faded Short Sleeve T-shirts">
											Faded Short Sleeve...</a>
										</h5>
										<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
											<span itemprop="price" class="product-price">
											$16.51                                </span>
											<meta itemprop="priceCurrency" content="BRL" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="clearfix media">
						<div class="product-block">
							<div class="product-container media" itemscope itemtype="http://schema.org/Product">
								<a class="products-block-image img pull-left" href="blouses/2-blouse.html" title=""><img class="replace-2x img-responsive" src="/7-small_default/blouse.jpg" alt="Blouse" />
								</a>
								<div class="media-body">
									<div class="product-content">
										<div class="comments_note product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
											<div class="star_content">
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<meta itemprop="worstRating" content = "0" />
												<meta itemprop="ratingValue" content = "0" />
												<meta itemprop="bestRating" content = "5" />
											</div>
											<span class="nb-comments"><span itemprop="reviewCount">0</span> Comentário (s)</span>
										</div>
										<h5 class="name media-heading">
											<a class="product-name" href="blouses/2-blouse.html" title="Blouse">
											Blouse</a>
										</h5>
										<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
											<span itemprop="price" class="product-price">
											$27.00                                </span>
											<meta itemprop="priceCurrency" content="BRL" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="clearfix media">
						<div class="product-block">
							<div class="product-container media" itemscope itemtype="http://schema.org/Product">
								<a class="products-block-image img pull-left" href="summer-dresses/7-printed-chiffon-dress.html" title=""><img class="replace-2x img-responsive" src="/20-small_default/printed-chiffon-dress.jpg" alt="Printed Chiffon Dress" />
								</a>
								<div class="media-body">
									<div class="product-content">
										<div class="comments_note product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
											<div class="star_content">
												<div class="star star_on"></div>
												<div class="star star_on"></div>
												<div class="star star_on"></div>
												<div class="star"></div>
												<div class="star"></div>
												<meta itemprop="worstRating" content = "0" />
												<meta itemprop="ratingValue" content = "3" />
												<meta itemprop="bestRating" content = "5" />
											</div>
											<span class="nb-comments"><span itemprop="reviewCount">1</span> Comentário (s)</span>
										</div>
										<h5 class="name media-heading">
											<a class="product-name" href="summer-dresses/7-printed-chiffon-dress.html" title="Printed Chiffon Dress">
											Printed Chiffon Dress</a>
										</h5>
										<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
											<span class="old-price product-price">
											$20.50
											</span>
											<span itemprop="price" class="product-price">
											$16.40                                </span>
											<meta itemprop="priceCurrency" content="BRL" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="clearfix media">
						<div class="product-block">
							<div class="product-container media" itemscope itemtype="http://schema.org/Product">
								<a class="products-block-image img pull-left" href="casual-dresses/3-printed-dress.html" title=""><img class="replace-2x img-responsive" src="/8-small_default/printed-dress.jpg" alt="Printed Dress" />
								</a>
								<div class="media-body">
									<div class="product-content">
										<div class="comments_note product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
											<div class="star_content">
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<meta itemprop="worstRating" content = "0" />
												<meta itemprop="ratingValue" content = "0" />
												<meta itemprop="bestRating" content = "5" />
											</div>
											<span class="nb-comments"><span itemprop="reviewCount">0</span> Comentário (s)</span>
										</div>
										<h5 class="name media-heading">
											<a class="product-name" href="casual-dresses/3-printed-dress.html" title="Printed Dress">
											Printed Dress</a>
										</h5>
										<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
											<span itemprop="price" class="product-price">
											$26.00                                </span>
											<meta itemprop="priceCurrency" content="BRL" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="clearfix media">
						<div class="product-block">
							<div class="product-container media" itemscope itemtype="http://schema.org/Product">
								<a class="products-block-image img pull-left" href="summer-dresses/5-printed-summer-dress.html" title=""><img class="replace-2x img-responsive" src="/12-small_default/printed-summer-dress.jpg" alt="Printed Summer Dress" />
								</a>
								<div class="media-body">
									<div class="product-content">
										<div class="comments_note product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
											<div class="star_content">
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<meta itemprop="worstRating" content = "0" />
												<meta itemprop="ratingValue" content = "0" />
												<meta itemprop="bestRating" content = "5" />
											</div>
											<span class="nb-comments"><span itemprop="reviewCount">0</span> Comentário (s)</span>
										</div>
										<h5 class="name media-heading">
											<a class="product-name" href="summer-dresses/5-printed-summer-dress.html" title="Printed Summer Dress">
											Printed Summer Dress</a>
										</h5>
										<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
											<span class="old-price product-price">
											$30.51
											</span>
											<span itemprop="price" class="product-price">
											$28.98                                </span>
											<meta itemprop="priceCurrency" content="BRL" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="clearfix media">
						<div class="product-block">
							<div class="product-container media" itemscope itemtype="http://schema.org/Product">
								<a class="products-block-image img pull-left" href="summer-dresses/6-printed-summer-dress.html" title=""><img class="replace-2x img-responsive" src="/16-small_default/printed-summer-dress.jpg" alt="Printed Summer Dress" />
								</a>
								<div class="media-body">
									<div class="product-content">
										<div class="comments_note product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
											<div class="star_content">
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<div class="star"></div>
												<meta itemprop="worstRating" content = "0" />
												<meta itemprop="ratingValue" content = "0" />
												<meta itemprop="bestRating" content = "5" />
											</div>
											<span class="nb-comments"><span itemprop="reviewCount">0</span> Comentário (s)</span>
										</div>
										<h5 class="name media-heading">
											<a class="product-name" href="summer-dresses/6-printed-summer-dress.html" title="Printed Summer Dress">
											Printed Summer Dress</a>
										</h5>
										<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
											<span itemprop="price" class="product-price">
											$30.50                                </span>
											<meta itemprop="priceCurrency" content="BRL" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
				<div class="lnk">
					<a href="best-sales.html" title="Todos os mais vendidos"  class="btn btn-outline button button-small btn-sm"><span>Todos os mais vendidos</span></a>
				</div>
			</div>
		</div>';

		return $html;

	}

}
