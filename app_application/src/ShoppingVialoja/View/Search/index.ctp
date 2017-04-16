<section id="columns" class="columns-container">
	<div class="container">
		<div class="row">
			<div id="top_column" class="center_column col-xs-12 col-sm-12 col-md-12">
			</div>
		</div>
		<div class="row">
			<!-- Center -->
			<section id="center_column" class="col-md-12">

				<div id="breadcrumb" class="clearfix">
					<!-- Breadcrumb -->
					<div id="breadcrumb" class="clearfix">
	                    <!-- Breadcrumb -->
	                    <div class="breadcrumb clearfix">
	                        <a class="home" href="//<?php echo env('HTTP_HOST'); ?>" title="Voltar para a Página Inicial"><i class="fa fa-home"></i></a>
	                        <span class="navigation-pipe" >/</span>
	                        <span class="navigation_page">Busca</span>
	                    </div>
	                    <!-- /Breadcrumb -->			
	                </div>
					<!-- /Breadcrumb -->			
				</div>

				<h1 class="page-heading  product-listing">
                    Busca&nbsp; "<?php echo \Lib\Tools::getValue('q'); ?>"
                    <small class="heading-counter">

                    <?php  $total = $this->Paginator->counter(array('format' => '%count%'));  ?>	

                    <?php if ($total <= 0 ): ?>
                    	0 resultados foram encontrados.
                    <?php elseif ($total == 1 ): ?>
                    	1 resultado foi encontrado.
                    <?php else: ?>
                    	<?php echo $total; ?> resultados foram encontrados.
                    <?php endif ?>
                    
                	</small>
                </h1>

                <?php if ($total <= 0 ): ?>

                <p class="alert alert-warning">
                    Sua pesquisa não teve resultados&nbsp;"<?php echo \Lib\Tools::getValue('q'); ?>"
                </p>

                <?php endif ?>
				<div class="content_sortPagiBar clearfix">
					<div class="sortPagiBar clearfix row">
						<div class="col-md-10 col-sm-8 col-xs-6">
							<div class="sort">
								<div class="display hidden-xs btn-group pull-left">
									<div id="grid"><a rel="nofollow" href="#" title="Grade"><i class="fa fa-th-large"></i></a></div>
									<div id="list"><a rel="nofollow" href="#" title="Lista"><i class="fa fa-th-list"></i></a></div>
								</div>
								<form id="productsSortForm" action="<?php echo \Lib\Tools::getUrl(); ?>" class="productsSortForm form-horizontal pull-left hidden-xs ">

									<div class="select">
										<label for="selectProductSort">Ordenado por</label>					
										<select class="form-control selectProductSort" id="selectProductSort">

											<?php

											$qr = str_replace(' ', '+', \Lib\Tools::getValue('q') );
											$cate = str_replace(' ', '+', \Lib\Tools::getValue('cate') );

											$orderby = \Lib\Tools::getValue('orderby');
											$orderway = \Lib\Tools::getValue('orderway');
											
											if ($orderby == 'posicao' && $orderway == 'asc' ) {
												echo '<option value="posicao:asc&cate='. $cate .'&q='. $qr .'" selected="selected">--</option>';
											} else {
												echo '<option value="posicao:asc&cate='. $cate .'&q='. $qr .'" selected="selected">--</option>';
											}

											if ($orderby == 'preco' && $orderway == 'asc' ) {
												echo '<option value="preco:asc&cate='. $cate .'&q='. $qr .'" selected="selected">Mais Barato</option>';
											} else {
												echo '<option value="preco:asc&cate='. $cate .'&q='. $qr .'">Mais Barato</option>';
											}

											if ($orderby == 'preco' && $orderway == 'desc' ) {
												echo '<option value="preco:desc&cate='. $cate .'&q='. $qr .'" selected="selected">Mais Caro</option>';
											} else {
												echo '<option value="preco:desc&cate='. $cate .'&q='. $qr .'">Mais Caro</option>';
											}

											if ($orderby == 'nome' && $orderway == 'asc' ) {
												echo '<option value="nome:asc&cate='. $cate .'&q='. $qr .'" selected="selected">De A a Z</option>';
											} else {
												echo '<option value="nome:asc&cate='. $cate .'&q='. $qr .'">De A a Z</option>';
											}

											if ($orderby == 'nome' && $orderway == 'desc' ) {
												echo '<option value="nome:desc&cate='. $cate .'&q='. $qr .'" selected="selected">De Z a A</option>';
											} else {
												echo '<option value="nome:desc&cate='. $cate .'&q='. $qr .'">De Z a A</option>';
											}

											if ($orderby == 'quantidade' && $orderway == 'desc' ) {
												echo '<option value="quantidade:desc&cate='. $cate .'&q='. $qr .'" selected="selected">Disponivel</option>';
											} else {
												echo '<option value="quantidade:desc&cate='. $cate .'&q='. $qr .'">Disponivel</option>';
											}

											if ($orderby == 'referencia' && $orderway == 'asc' ) {
												echo '<option value="referencia:asc&cate='. $cate .'&q='. $qr .'" selected="selected">Referência: Menor primeiro</option>';
											} else {
												echo '<option value="referencia:asc&cate='. $cate .'&q='. $qr .'">Referência: Menor primeiro</option>';
											}

											if ($orderby == 'referencia' && $orderway == 'desc' ) {
												echo '<option value="referencia:desc&cate='. $cate .'&q='. $qr .'" selected="selected">Referência: Maior primeiro</option>';
											} else {
												echo '<option value="referencia:desc&cate='. $cate .'&q='. $qr .'">Referência: Maior primeiro</option>';
											}

											?>
											
										</select>
									</div>


								</form>
								<!-- /Sort products -->
								<!-- nbr product/page -->
								<!-- /nbr product/page -->
							</div>
						</div>

						<?php /* ?>
						<div class="product-compare col-md-2 col-sm-4 col-xs-6">
							<form method="post" action="/products-comparison" class="compare-form">
								<button type="submit" class="btn btn-outline button button-medium bt_compare bt_compare" disabled="disabled">
								<span>Comparar (<strong class="total-compare-val">0</strong>)</span>
								</button>
								<input type="hidden" name="compare_product_count" class="compare_product_count" value="0" />
								<input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
							</form>
						</div>
						<?php */ ?>
					</div>
				</div>

				<!-- Products list -->
				<div  class="nomargin product_list grid row ">

					<?php if (count($res_produto) <= 0 ): ?>
					
					<br />
					<p class="alert alert-warning">Não há produtos cadastrados até o momento nesta seção.</p>
						
					<?php endif ?>					

					<?php 

					foreach ($res_produto as $key => $produto): 

					$preco_promocional = $produto['ShopProduto']['preco_promocional'];
					$preco_cheio = $produto['ShopProduto']['preco_cheio'];
					$id_produto = $produto['ShopProduto']['id_produto'];
					$nome_foto = $produto['ShopProdutoImagem']['nome_imagem'];
					$nome = $produto['ShopProduto']['nome'];
					$id_shop_default = $produto['Shop']['id_shop'];
					$nome_categoria = $produto['ShopCategoria']['nome_categoria'];

					$image_padrao = CDN .'static/img/imagem-padrao/medium/produto-sem-imagem.gif';

					if (!empty($nome_foto)) {

						$url_root = sprintf( '%s%d%sproduto%s%d%smedium%s%s',
							CDN_ROOT_UPLOAD,
							$id_shop_default,
							DS,
							DS,
							$id_produto,
							DS,
							DS,
							$nome_foto
						);

						if (!is_file($url_root)) {

							$url_img = $image_padrao;

						} else {

							$url_img = sprintf( '%s%d/produto/%d/medium/%s',
								CDN_UPLOAD,
								$id_shop_default,
								$id_produto,
								$nome_foto
							);

						}

					} else {

						$url_img = $image_padrao;

					}

					?>


					<?php if ($key <=0 ): ?>

					<div class="nopadding ajax_block_product col-sp-12 col-xs-12 col-sm-6 col-md-3 first-in-line first-item-of-tablet-line last-item-of-mobile-line"  style="height:270px;">
						
					<?php else: ?>
						
					<div class="nopadding ajax_block_product col-sp-12 col-xs-12 col-sm-6 col-md-3 last-item-of-tablet-line	last-item-of-mobile-line"  style="height:270px;">
					
					<?php endif ?>

						<div class="product-container text-center product-block" itemscope itemtype="http://schema.org/Product">
							<div class="left-block">
								<div class="product-image-container image" align="center">
									<div class="leo-more-info" data-idproduct="1"></div>
									<a class="product_img_link"	href="<?php printf('%s/p/%s/%s/%d/', FULL_BASE_URL, \Lib\Tools::slug($nome_categoria), \Lib\Tools::slug($nome), $id_produto ); ?>" title="<?php echo $produto['ShopProduto']['nome']; ?>" itemprop="url">

									<div align="center">

										<img class="replace-2x img-responsive" src="<?php echo $url_img; ?>" alt="<?php echo $produto['ShopProduto']['nome']; ?>" title="<?php echo $produto['ShopProduto']['nome']; ?>" itemprop="image" />

									</div>
									<span class="product-additional" data-idproduct="1"></span>
									</a>
									
									<?php /* ?>

									<a class="quick-view btn-outline-inverse btn" href="<?php printf('%s/p/%s/%s/%d/', FULL_BASE_URL, \Lib\Tools::slug($nome_categoria), \Lib\Tools::slug($nome), $id_produto); ?>" rel="<?php printf('%s/p/%s/%d/', FULL_BASE_URL, \Lib\Tools::slug($nome_categoria), \Lib\Tools::slug($nome), $id_produto); ?>" title="Visualização rápida">
									<i class="fa fa-plus"></i>
									</a>

									<?php */ ?>
									
								</div>
							</div>
							<div class="right-block">
								<div class="product-meta">

									<?php /* ?>
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
									<?php */ ?>
									<h5 itemprop="name" class="name">
										<a class="product-name" href="<?php printf('%s/p/%s/%d/', FULL_BASE_URL, \Lib\Tools::slug($nome_categoria), \Lib\Tools::slug($nome), $id_produto ); ?>" title="<?php echo $produto['ShopProduto']['nome']; ?>" itemprop="url">
										<?php echo \Lib\Tools::formatList($nome,40); ?>
										</a>
									</h5>
									<?php /* ?>
									<p class="product-desc" itemprop="description">
										Faded short sleeve t-shirt with high neckline. Soft and stretchy material for a comfortable fit. Accessorize with a straw hat and you're ready for summer!
									</p>
									<?php */ ?>

									<?php

									if (isset($preco_promocional, $preco_cheio) 
										&& $preco_promocional > 0 
										&& $preco_cheio > 0 
										&& $preco_promocional < $preco_cheio ) {
										
										echo '<div class="content_price price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
												de
												<span class="old-price product-price">
													 R$ '. \Lib\Tools::convertToDecimalBR( $preco_cheio ) .'
												</span>

												<span class="price-percent-reduction">-'. \Lib\Tools::discountPercentageValue($preco_cheio,$preco_promocional) .'%</span>
												<br />
												<br />
												por
												<span itemprop="price" class="price product-price">
													
													R$ '. \Lib\Tools::convertToDecimalBR( $preco_promocional ) .'

												</span>
												<meta itemprop="priceCurrency" content="BRL" />
											</div>';


										} elseif (isset($preco_cheio) && $preco_cheio > 0) {											
											echo '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
												<span itemprop="price" class="price product-price">
												R$ '. \Lib\Tools::convertToDecimalBR( $preco_cheio ) .'
												</span>
												<meta itemprop="priceCurrency" content="BRL" />
											</div>';

										} else {

											echo '<div class="content_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
												
												<span itemprop="price" class="old-price product-price" style="color:#F2434A">
													Preço Sob Consulta
												</span>

											</div>';

										}

									?>

							
									<div class="product-flags">
									</div>

									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
										<span class="available-now">
											<link itemprop="availability" href="http://schema.org/InStock" />
											Em estoque							
										</span>
									</div>

									<div class="functional-buttons clearfix">
										<div class="cart" style="display: none;">
											<a class="button ajax_add_to_cart_button btn btn-outline" href="#" rel="nofollow" title="Adicionar ao carrinho" data-id-product="1">
											<i class="fa fa-shopping-cart"></i>
											<span>Adicionar ao carrinho</span>
											</a>
										</div>
										<div class="wishlist" style="display: none;">
											<a class="btn-tooltip btn btn-outline-inverse addToWishlist wishlistProd_1" rel="nofollow"href="#" rel="nofollow" onclick="WishlistCart('wishlist_block_list', 'add', '1', false, 1); return false;" data-toggle="tooltip" title="Adicionar à Lista de presentes">
											<i class="fa fa-heart"></i>
											<span>Adicionar à Lista de presentes</span>
											</a>
										</div>
										<div class="compare" style="display: none;">
											<a class="add_to_compare compare btn btn-outline-inverse" href="<?php echo '#' //printf('%s/p/%s/%s/%d/', FULL_BASE_URL, \Lib\Tools::slug($nome_categoria), \Lib\Tools::slug($nome), $id_produto ); ?>" rel="nofollow" data-id-product="1" title="Adicionar para comparar">
											<i class="fa fa-files-o"></i>
											<span>Adicionar para comparar</span>
											</a>						
										</div>
									</div>

								</div>
							</div>
						</div>
						<!-- .product-container> -->
					</div>

					<?php endforeach ?>

					<?php /* ?>
					<div class="nopadding ajax_block_product col-sp-12 col-xs-12 col-sm-6 col-md-3 last-item-of-tablet-line
						last-item-of-mobile-line">
						<div class="product-container text-center product-block" itemscope itemtype="http://schema.org/Product">
							<div class="left-block">
								<div class="product-image-container image">
									<div class="leo-more-info" data-idproduct="2"></div>
									<a class="product_img_link"	href="blouses/2-blouse.html" title="Blouse" itemprop="url">
									<img class="replace-2x img-responsive" src="/7-home_default/blouse.jpg" alt="Blouse" title="Blouse" itemprop="image" />
									<span class="product-additional" data-idproduct="2"></span>
									</a>
									<a class="quick-view btn-outline-inverse btn" href="blouses/2-blouse.html" rel="/blouses/2-blouse.html" title="Visualização rápida">
									<i class="fa fa-plus"></i>
									</a>
								</div>
							</div>
							<div class="right-block">
								<div class="product-meta">
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
									<h5 itemprop="name" class="name">
										<a class="product-name" href="blouses/2-blouse.html" title="Blouse" itemprop="url">
										Blouse
										</a>
									</h5>
									<p class="product-desc" itemprop="description">
										Short sleeved blouse with feminine draped sleeve detail.
									</p>
									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
										<span itemprop="price" class="price product-price">
										R$ 27.00						</span>
										<meta itemprop="priceCurrency" content="BRL" />
									</div>
									<div class="product-flags">
									</div>
									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
										<span class="available-now">
											<link itemprop="availability" href="http://schema.org/InStock" />
											Em estoque							
										</span>
									</div>
									<div class="functional-buttons clearfix">
										<div class="cart">
											<a class="button ajax_add_to_cart_button btn btn-outline" href="ordera9c3.html?add=1&amp;id_product=2&amp;token=c0b3b2573da6513d5d166afa8159f33b" rel="nofollow" title="Adicionar ao carrinho" data-id-product="2">
											<i class="fa fa-shopping-cart"></i>
											<span>Adicionar ao carrinho</span>
											</a>
										</div>
										<div class="wishlist">
											<a class="btn-tooltip btn btn-outline-inverse addToWishlist wishlistProd_2" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '2', false, 1); return false;" data-toggle="tooltip" title="Adicionar à Lista de presentes">
											<i class="fa fa-heart"></i>
											<span>Adicionar à Lista de presentes</span>
											</a>
										</div>
										<div class="compare">
											<a class="add_to_compare compare btn btn-outline-inverse" href="blouses/2-blouse.html" data-id-product="2" title="Adicionar para comparar">
											<i class="fa fa-files-o"></i>
											<span>Adicionar para comparar</span>
											</a>						
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .product-container> -->
					</div>

					<div class="nopadding ajax_block_product col-sp-12 col-xs-12 col-sm-6 col-md-3 first-item-of-tablet-line last-item-of-mobile-line
						">
						<div class="product-container text-center product-block" itemscope itemtype="http://schema.org/Product">
							<div class="left-block">
								<div class="product-image-container image">
									<div class="leo-more-info" data-idproduct="7"></div>
									<a class="product_img_link"	href="summer-dresses/7-printed-chiffon-dress.html" title="Printed Chiffon Dress" itemprop="url">
									<img class="replace-2x img-responsive" src="/20-home_default/printed-chiffon-dress.jpg" alt="Printed Chiffon Dress" title="Printed Chiffon Dress" itemprop="image" />
									<span class="product-additional" data-idproduct="7"></span>
									</a>
									<a class="quick-view btn-outline-inverse btn" href="summer-dresses/7-printed-chiffon-dress.html" rel="/summer-dresses/7-printed-chiffon-dress.html" title="Visualização rápida">
									<i class="fa fa-plus"></i>
									</a>
								</div>
							</div>
							<div class="right-block">
								<div class="product-meta">
									<div class="comments_note product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
										
										<!--

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
										
										-->

										<span class="nb-comments"><span itemprop="reviewCount">1</span> Comentário (s)</span>
									</div>
									<h5 itemprop="name" class="name">
										<a class="product-name" href="summer-dresses/7-printed-chiffon-dress.html" title="Printed Chiffon Dress" itemprop="url">
										Printed Chiffon Dress
										</a>
									</h5>
									<p class="product-desc" itemprop="description">
										Printed chiffon knee length dress with tank straps. Deep v-neckline.
									</p>
									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
										<span itemprop="price" class="price product-price">
										R$ 16.40
										</span>
										<meta itemprop="priceCurrency" content="BRL" />
										<span class="old-price product-price">
										R$ 20.50
										</span>
										<span class="price-percent-reduction">-20%</span>
									</div>
									<div class="product-flags">
										<span class="discount label label-danger">Redução do preço!</span>
									</div>
									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
										<span class="available-now">
											<link itemprop="availability" href="http://schema.org/InStock" />
											Em estoque							
										</span>
									</div>
									<div class="functional-buttons clearfix">
										<div class="cart">
											<a class="button ajax_add_to_cart_button btn btn-outline" href="order0f19.html?add=1&amp;id_product=7&amp;token=c0b3b2573da6513d5d166afa8159f33b" rel="nofollow" title="Adicionar ao carrinho" data-id-product="7">
											<i class="fa fa-shopping-cart"></i>
											<span>Adicionar ao carrinho</span>
											</a>
										</div>
										<div class="wishlist">
											<a class="btn-tooltip btn btn-outline-inverse addToWishlist wishlistProd_7" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '7', false, 1); return false;" data-toggle="tooltip" title="Adicionar à Lista de presentes">
											<i class="fa fa-heart"></i>
											<span>Adicionar à Lista de presentes</span>
											</a>
										</div>
										<div class="compare">
											<a class="add_to_compare compare btn btn-outline-inverse" href="summer-dresses/7-printed-chiffon-dress.html" data-id-product="7" title="Adicionar para comparar">
											<i class="fa fa-files-o"></i>
											<span>Adicionar para comparar</span>
											</a>						
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .product-container> -->
					</div>

					<div class="nopadding ajax_block_product col-sp-12 col-xs-12 col-sm-6 col-md-3 last-in-line
						last-item-of-tablet-line
						last-item-of-mobile-line
						">
						<div class="product-container text-center product-block" itemscope itemtype="http://schema.org/Product">
							<div class="left-block">
								<div class="product-image-container image">
									<div class="leo-more-info" data-idproduct="3"></div>
									<a class="product_img_link"	href="casual-dresses/3-printed-dress.html" title="Printed Dress" itemprop="url">
									<img class="replace-2x img-responsive" src="/8-home_default/printed-dress.jpg" alt="Printed Dress" title="Printed Dress" itemprop="image" />
									<span class="product-additional" data-idproduct="3"></span>
									</a>
									<a class="quick-view btn-outline-inverse btn" href="casual-dresses/3-printed-dress.html" rel="/casual-dresses/3-printed-dress.html" title="Visualização rápida">
									<i class="fa fa-plus"></i>
									</a>
								</div>
							</div>
							<div class="right-block">
								<div class="product-meta">
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
									<h5 itemprop="name" class="name">
										<a class="product-name" href="casual-dresses/3-printed-dress.html" title="Printed Dress" itemprop="url">
										Printed Dress
										</a>
									</h5>
									<p class="product-desc" itemprop="description">
										100% cotton double printed dress. Black and white striped top and orange high waisted skater skirt bottom.
									</p>
									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
										<span itemprop="price" class="price product-price">
										R$ 26.00						
										</span>
										<meta itemprop="priceCurrency" content="BRL" />
									</div>
									<div class="product-flags">
									</div>
									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
										<span class="available-now">
											<link itemprop="availability" href="http://schema.org/InStock" />
											Em estoque							
										</span>
									</div>
									<div class="functional-buttons clearfix">
										<div class="cart">
											<a class="button ajax_add_to_cart_button btn btn-outline" href="order8aa3.html?add=1&amp;id_product=3&amp;token=c0b3b2573da6513d5d166afa8159f33b" rel="nofollow" title="Adicionar ao carrinho" data-id-product="3">
											<i class="fa fa-shopping-cart"></i>
											<span>Adicionar ao carrinho</span>
											</a>
										</div>
										<div class="wishlist">
											<a class="btn-tooltip btn btn-outline-inverse addToWishlist wishlistProd_3" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '3', false, 1); return false;" data-toggle="tooltip" title="Adicionar à Lista de presentes">
											<i class="fa fa-heart"></i>
											<span>Adicionar à Lista de presentes</span>
											</a>
										</div>
										<div class="compare">
											<a class="add_to_compare compare btn btn-outline-inverse" href="casual-dresses/3-printed-dress.html" data-id-product="3" title="Adicionar para comparar">
											<i class="fa fa-files-o"></i>
											<span>Adicionar para comparar</span>
											</a>						
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .product-container> -->
					</div>

					<div class="nopadding ajax_block_product col-sp-12 col-xs-12 col-sm-6 col-md-3 first-in-line last-line first-item-of-tablet-line last-item-of-mobile-line
						">
						<div class="product-container text-center product-block" itemscope itemtype="http://schema.org/Product">
							<div class="left-block">
								<div class="product-image-container image">
									<div class="leo-more-info" data-idproduct="5"></div>
									<a class="product_img_link"	href="summer-dresses/5-printed-summer-dress.html" title="Printed Summer Dress" itemprop="url">
									<img class="replace-2x img-responsive" src="/12-home_default/printed-summer-dress.jpg" alt="Printed Summer Dress" title="Printed Summer Dress" itemprop="image" />
									<span class="product-additional" data-idproduct="5"></span>
									</a>
									<a class="quick-view btn-outline-inverse btn" href="summer-dresses/5-printed-summer-dress.html" rel="/summer-dresses/5-printed-summer-dress.html" title="Visualização rápida">
									<i class="fa fa-plus"></i>
									</a>
								</div>
							</div>
							<div class="right-block">
								<div class="product-meta">
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
									<h5 itemprop="name" class="name">
										<a class="product-name" href="summer-dresses/5-printed-summer-dress.html" title="Printed Summer Dress" itemprop="url">
										Printed Summer Dress
										</a>
									</h5>
									<p class="product-desc" itemprop="description">
										Long printed dress with thin adjustable straps. V-neckline and wiring under the bust with ruffles at the bottom of the dress.
									</p>
									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
										<span itemprop="price" class="price product-price">
										R$ 28.98						</span>
										<meta itemprop="priceCurrency" content="BRL" />
										<span class="old-price product-price">
										R$ 30.51
										</span>
										<span class="price-percent-reduction">-5%</span>
									</div>
									<div class="product-flags">
										<span class="discount label label-danger">Redução do preço!</span>
									</div>
									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
										<span class="available-now">
											<link itemprop="availability" href="http://schema.org/InStock" />
											Em estoque							
										</span>
									</div>
									<div class="functional-buttons clearfix">
										<div class="cart">
											<a class="button ajax_add_to_cart_button btn btn-outline" href="order62d3.html?add=1&amp;id_product=5&amp;token=c0b3b2573da6513d5d166afa8159f33b" rel="nofollow" title="Adicionar ao carrinho" data-id-product="5">
											<i class="fa fa-shopping-cart"></i>
											<span>Adicionar ao carrinho</span>
											</a>
										</div>
										<div class="wishlist">
											<a class="btn-tooltip btn btn-outline-inverse addToWishlist wishlistProd_5" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '5', false, 1); return false;" data-toggle="tooltip" title="Adicionar à Lista de presentes">
											<i class="fa fa-heart"></i>
											<span>Adicionar à Lista de presentes</span>
											</a>
										</div>
										<div class="compare">
											<a class="add_to_compare compare btn btn-outline-inverse" href="summer-dresses/5-printed-summer-dress.html" data-id-product="5" title="Adicionar para comparar">
											<i class="fa fa-files-o"></i>
											<span>Adicionar para comparar</span>
											</a>						
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .product-container> -->
					</div>

					<div class="nopadding ajax_block_product col-sp-12 col-xs-12 col-sm-6 col-md-3 last-line last-item-of-tablet-line
						last-item-of-mobile-line
						last-mobile-line">
						<div class="product-container text-center product-block" itemscope itemtype="http://schema.org/Product">
							<div class="left-block">
								<div class="product-image-container image">
									<div class="leo-more-info" data-idproduct="6"></div>
									<a class="product_img_link"	href="summer-dresses/6-printed-summer-dress.html" title="Printed Summer Dress" itemprop="url">
									<img class="replace-2x img-responsive" src="/16-home_default/printed-summer-dress.jpg" alt="Printed Summer Dress" title="Printed Summer Dress" itemprop="image" />
									<span class="product-additional" data-idproduct="6"></span>
									</a>
									<a class="quick-view btn-outline-inverse btn" href="summer-dresses/6-printed-summer-dress.html" rel="/summer-dresses/6-printed-summer-dress.html" title="Visualização rápida">
									<i class="fa fa-plus"></i>
									</a>
								</div>
							</div>
							<div class="right-block">
								<div class="product-meta">
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
									<h5 itemprop="name" class="name">
										<a class="product-name" href="summer-dresses/6-printed-summer-dress.html" title="Printed Summer Dress" itemprop="url">
										Printed Summer Dress
										</a>
									</h5>
									<p class="product-desc" itemprop="description">
										Sleeveless knee-length chiffon dress. V-neckline with elastic under the bust lining.
									</p>
									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
										<span itemprop="price" class="price product-price">
										R$ 30.50						</span>
										<meta itemprop="priceCurrency" content="BRL" />
									</div>
									<div class="product-flags">
									</div>
									<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
										<span class="available-now">
											<link itemprop="availability" href="http://schema.org/InStock" />
											Em estoque							
										</span>
									</div>
									<div class="functional-buttons clearfix">
										<div class="cart">
											<a class="button ajax_add_to_cart_button btn btn-outline" href="ordere327.html?add=1&amp;id_product=6&amp;token=c0b3b2573da6513d5d166afa8159f33b" rel="nofollow" title="Adicionar ao carrinho" data-id-product="6">
											<i class="fa fa-shopping-cart"></i>
											<span>Adicionar ao carrinho</span>
											</a>
										</div>
										<div class="wishlist">
											<a class="btn-tooltip btn btn-outline-inverse addToWishlist wishlistProd_6" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '6', false, 1); return false;" data-toggle="tooltip" title="Adicionar à Lista de presentes">
											<i class="fa fa-heart"></i>
											<span>Adicionar à Lista de presentes</span>
											</a>
										</div>
										<div class="compare">
											<a class="add_to_compare compare btn btn-outline-inverse" href="summer-dresses/6-printed-summer-dress.html" data-id-product="6" title="Adicionar para comparar">
											<i class="fa fa-files-o"></i>
											<span>Adicionar para comparar</span>
											</a>						
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- .product-container> -->
					</div>
					<?php */ ?>

				</div>

				<div class="content_sortPagiBar">
					<div class="bottom-pagination-content clearfix row">
						<div class="col-md-12 col-sm-8 col-xs-6">
							<!-- Pagination -->
							<div id="pagination_bottom" class="pagination clearfix pull-left">

								<?php

								if (\Lib\Tools::getValue('q') !='') {

									$this->Paginator->options(
										array('url'=> array(
											'controller' => 's',
											'action' =>'productsearch', 
											'?' => array(
													'orderby' => \Lib\Tools::getValue('orderby'),
													'orderway' => \Lib\Tools::getValue('orderway'),
													'cate' => \Lib\Tools::getValue('cate'),
													'q' => \Lib\Tools::getValue('q'),
											 	)
											),
											'convertKeys' => array('page')
										)
									);

								} else {

									$this->Paginator->options(
										array('url'=> array(
											'controller' => 's',
											'action' =>'productsearch'),
											'convertKeys' => array('page')
										)
									);

								}


				                echo $this->Paginator->numbers( array( 'modulus' => '2', 'tag' => 'span', 'first'=>'Início', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a', 'last'=>'Último'  ) );
				                ?>

							</div>

							<div class="product-count pull-right">


								<?php
			                   

			                    if ($total ==1) {
			                    
				                    echo $this->Paginator->counter(array(
				                            'format' => 'Mostrando %page% a %pages% de %count% item'
				                    ));


			                    } else {
			                    	echo $this->Paginator->counter(array(
				                            'format' => 'Mostrando %page% a %pages% de %count% itens'
				                    ));

			                    }                 
			                    
			                    ?>



								
							</div>

							<!-- /Pagination -->
						</div>

						<?php /* ?>
						<div class="product-compare col-md-2 col-sm-4 col-xs-6">
							<form method="post" action="/products-comparison" class="compare-form">
								<button type="submit" class="btn btn-outline button button-medium bt_compare bt_compare_bottom" disabled="disabled">
								<span>Comparar (<strong class="total-compare-val">0</strong>)</span>
								</button>
								<input type="hidden" name="compare_product_count" class="compare_product_count" value="0" />
								<input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
							</form>
						</div>

						<?php */ ?>

					</div>
				</div>
			</section>
		</div>
	</div>
</section>