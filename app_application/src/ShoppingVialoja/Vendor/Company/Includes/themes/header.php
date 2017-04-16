<header id="header">
	<section class="header-container">
		<div id="topbar">
			<div class="banner">
				<div class="container">
					<div class="row">
					</div>
				</div>
			</div>
			<div class="nav">
				<div class="container">
					<div class="inner">
						<nav>
							<script type="text/javascript">
								/* Blockusreinfo */
									
								$(document).ready( function(){
									if( $(window).width() < 991 ){
											 $(".header_user_info").addClass('btn-group');
											 $(".header_user_info .links").addClass('quick-setting dropdown-menu');
										}
										else{
											$(".header_user_info").removeClass('btn-group');
											 $(".header_user_info .links").removeClass('quick-setting dropdown-menu');
										}
									$(window).resize(function() {
										if( $(window).width() < 991 ){
											 $(".header_user_info").addClass('btn-group');
											 $(".header_user_info .links").addClass('quick-setting dropdown-menu');
										}
										else{
											$(".header_user_info").removeClass('btn-group');
											 $(".header_user_info .links").removeClass('quick-setting dropdown-menu');
										}
									});
								});
							</script>
							<!-- Block user information module NAV  -->
							<div class="header_user_info pull-right">
								<div data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i><span>Principais ligações </span></div>
								<ul class="links">
								
									<?php
									
									/*
									<li class="first">
										<a id="wishlist-total" href="<?php echo FULL_BASE_URL ?>/cliente/minha-lista-de-desejos/" title="Minha lista de desejos"><i class="fa fa-heart"></i>Minha Lista de Desejos</a>
									</li>									
									*/
									
									?>									
									
									<li>
										<a href="<?php echo FULL_BASE_URL ?>/minha-conta/" title="A minha conta"><i class="fa fa-dashboard"></i>Minha Conta</a>
									</li>
									
									<li class="last">
										<a href="<?php echo FULL_BASE_URL ?>/checkout/" title="Checkout" class="last"><i class="fa fa-share"></i>Meus Pedidos</a>
									</li>
									
									<li>
										<a href="<?php echo FULL_BASE_URL ?>/checkout/carrinho/" title="Carrinho de Compras" rel="nofollow">
										<i class="fa fa-shopping-cart"></i>Meu Carrinho
										</a>
									</li>
									
									<?php if ( !CakeSession::read('cliente_nome') ): ?>
									
									<li>
										<a class="login" href="<?php

										if (\Lib\Tools::getValue('utm_referrer') !='') {

											echo \Lib\Tools::getUrl();

										} else {

											echo FULL_BASE_URL .'/cliente/conta/login/?utm_passive=false&utm_referrer=' . rawurlencode( \Lib\Tools::getUrl() );

										}

										?>" rel="nofollow" title="Entrar com sua conta de cliente">

										<i class="fa fa-unlock-alt"></i>Entrar
										</a>

									</li>
									
									<li>
										<a href="<?php echo FULL_BASE_URL .'/cliente/conta/login/novo/'; ?>" title="Cadastre-se"><i class="fa fa-user"></i>Cadastre-se</a>
									</li>
									
									<?php endif ?>

									<?php if ( CakeSession::read('cliente_nome') ): ?>

									<li>
										<a class="account" rel="nofollow" title="Ver minha conta de usuário" href="<?php echo FULL_BASE_URL ?>/minha-conta/">
										<i class="fa fa-child"></i>
										Olá, <?php echo CakeSession::read('cliente_nome'); ?>
										</a>
					
									</li>
									
									<li>
					
										<a class="login" href="<?php echo FULL_BASE_URL ?>/logout/" rel="nofollow" title="Sair de sua conta segurança">
											<i class="fa fa-lock"></i>Sair
										</a>
									</li>

									<?php endif; ?>
									
								</ul>
							</div>
					
							<?php if ( CakeSession::read('cliente_nivel') > 1 ): ?>							

							<!-- Block currencies module -->
							<div class="btn-group">
								<div data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i><span class="hidden-xs">Minha Loja</span>
								</div>
								<div class="quick-setting dropdown-menu">
									<div id="currencies-block-top">
										<form id="setCurrency" action="/" method="post">
											<input type="hidden" name="id_currency" id="id_currency" value=""/>
											<input type="hidden" name="SubmitCurrency" value="" />
											<ul id="first-currencies" class="currencies_ul toogle_content">
												<li class="selected">
													<a href="<?php echo sprintf('//app%s/admin/', env('HTTP_BASE') ); ?>" rel="nofollow" title="Painel de Controle">
													Painel de Controle
													</a>
												</li>
											</ul>
										</form>
									</div>
								</div>
							</div>
							<!-- /Block currencies module --><!-- Block languages module -->
							<div class="btn-group">
								<div data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i><span class="hidden-xs">Suporte </span>
								</div>
								<div class="quick-setting dropdown-menu">
									<div id="languages-block-top" class="languages-block">
										<ul id="first-languages" class="languages-block_ul">
											<li >
												<a href="<?php echo sprintf('http://app%s/suporte/ticket', env('HTTP_BASE') ); ?>" title="Enviar Ticket">
												<span>Tickets</span>
												</a>
											</li>
											<li style="margin-top:10px;">
												<a href="<?php echo sprintf('http://forum%s/', env('HTTP_BASE') ); ?>" title="Fórum de Ajuda">
												<span>Fóruns</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- /Block languages module -->

							<?php endif ?>

						</nav>
					</div>
				</div>
			</div>
		</div>
		<div id="header-main">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div id="header_logo" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
							<a href="<?php echo sprintf('//%s', env('HTTP_HOST') ); ?>" title="ViaLoja Shopping">
							<img class="logo img-responsive" src="<?php echo CDN_IMG . "vialoja/logos/shopping/default-header.png" ?>" alt="ViaLoja Shopping" width="172" height="45"/>
							</a>
						</div>
						<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
							<nav id="cavas_menu"  class="sf-contener leo-megamenu col-xs-4 col-sm-9 col-md-9 col-lg-9">
								<div class="" role="navigation">
									<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
										<button type="button" class="navbar-toggle btn-outline-inverse" data-toggle="collapse" data-target=".navbar-ex1-collapse">
										<span class="sr-only">Alternar navegação</span>
										<span class="fa fa-bars"></span>
										</button>
									</div>
									<!-- Collect the nav links, forms, and other content for toggling -->
									<div id="leo-top-menu" class="collapse navbar-collapse navbar-ex1-collapse">
										<ul class="nav navbar-nav megamenu">
											<li class="" >
												<a href="//<?php echo env('HTTP_HOST'); ?>" target="_self" class="has-category"><span class="menu-title">Home</span></a>
											</li>
											
											<li class=" parent dropdown aligned-center " >
												<a href="#" class="dropdown-toggle has-category" data-toggle="dropdown" target="_self"><span class="menu-title">Departamentos</span><b class="caret"></b></a>
												<div class="dropdown-sub dropdown-menu"  style="width:700px" >
													

												<?php 
												App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'dropdown-menu-inner-top');
												?>
											

												</div>
											</li>

											
											<!--
											<li class="parent dropdown  " >
												<a class="dropdown-toggle has-category" data-toggle="dropdown" href="#" target="_self"><span class="menu-title">Cosmetics</span><b class="caret"></b></a>
												<div class="dropdown-menu level1"  >
													<div class="dropdown-menu-inner">
														<div class="row">
															<div class="mega-col col-sm-12" data-type="menu" >
																<div class="mega-col-inner ">
																	<ul>
																		<li class="parent dropdown-submenu " >
																			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="menu-title">Perfume</span><b class="caret"></b></a>
																			<div class="dropdown-menu level2"  >
																				<div class="dropdown-menu-inner">
																					<div class="row">
																						<div class="mega-col col-sm-12" data-type="menu" >
																							<div class="mega-col-inner ">
																								<ul>
																									<li class=" " ><a href="#"><span class="menu-title">Fashion</span></a></li>
																								</ul>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>

											-->
											<li class="" >
												<a href="#" rel="nofollow" target="_self" class="has-category" title="Mais Vendidos"><span class="menu-title">Mais Vendidos</span></a>
											</li>

											<li class="" >
											</li>
											
											<li class="" >
												<a href="<?php echo FULL_BASE_URL; ?>/d/loja-virtual-gratis/" title="Abra sua Loja Virtual Grátis" target="_self" class="has-category"><span class="menu-title">Abra uma Loja Gratuitamente</span></a>
											</li>
										</ul>
									</div>
								</div>
							</nav>
							<script type="text/javascript">
								// <![CDATA[
									var current_link = "index.html";
									//alert(request);
									var currentURL = window.location;
									currentURL = String(currentURL);
									currentURL = currentURL.replace("https:///","").replace("http://","").replace("www.","").replace( /#\w*/, "" );
									current_link = current_link.replace("https:///","").replace("http://","").replace("www.","");
									isHomeMenu = 0;
									if($("body").attr("id")=="index") isHomeMenu = 1;
									$(".megamenu > li > a").each(function() {
										menuURL = $(this).attr("href").replace("https:///","").replace("http://","").replace("www.","").replace( /#\w*/, "" );
										if( (currentURL == menuURL) || (currentURL.replace(current_link,"") == menuURL) || isHomeMenu){
											$(this).parent().addClass("active");
											return false;
										}
									});
								// ]]>
							</script>
							<script type="text/javascript">
								(function($) {
									$.fn.OffCavasmenu = function(opts) {
										// default configuration
										var config = $.extend({}, {
											opt1: null,
											text_warning_select: "Por favor, selecione um para remover?",
											text_confirm_remove: "Tem certeza que deseja remover linha de rodapé?",
											JSON: null
										}, opts);
										// main function
										// initialize every element
										this.each(function() {
											var $btn = $('#cavas_menu .navbar-toggle');
											var $nav = null;
											if (!$btn.length)
												return;
											var $nav = $('<section id="off-canvas-nav" class="leo-megamenu"><nav class="offcanvas-mainnav" ><div id="off-canvas-button"><span class="off-canvas-nav"></span>Perto</div></nav></sections>');
											var $menucontent = $($btn.data('target')).find('.megamenu').clone();
											$("body").append($nav);
											$("#off-canvas-nav .offcanvas-mainnav").append($menucontent);
											$("#off-canvas-nav .offcanvas-mainnav").css('min-height',$(window).height()+30+"px");
											$("html").addClass ("off-canvas");
											$("#off-canvas-button").click( function(){
													$btn.click();	
											} );
											$btn.toggle(function() {
												$("body").removeClass("off-canvas-inactive").addClass("off-canvas-active");
											}, function() {
												$("body").removeClass("off-canvas-active").addClass("off-canvas-inactive");
											});
										});
										return this;
									}
								})(jQuery);
								$(document).ready(function() {
									jQuery("#cavas_menu").OffCavasmenu();
									$('#cavas_menu .navbar-toggle').click(function() {
										$('body,html').animate({
											scrollTop: 0
										}, 0);
										return false;
									});
								});
								$(document.body).on('click', '[data-toggle="dropdown"]' ,function(){
									if(!$(this).parent().hasClass('open') && this.href && this.href != '#'){
										window.location.href = this.href;
									}
								});
							</script>
							<!-- MODULE Block cart -->
							<div class="blockcart_top clearfix col-lg-3 col-md-3 col-sm-3 col-xs-8">
								<div id="cart" class="shopping_cart pull-right">
									<div class="media heading">
										<div class="title-cart pull-right btn btn-outline-inverse">
											<span class="fa fa-shopping-cart "></span>
										</div>
										<div class="cart-inner media-body">
											<h4>Carrinho de Compras</h4>
											<a href="order.html" title="Ver meu carrinho de compras" rel="nofollow">
											<span class="ajax_cart_total unvisible">
											</span>
											<span class="ajax_cart_quantity unvisible">0</span>
											<span class="ajax_cart_product_txt unvisible">item</span>
											<span class="ajax_cart_product_txt_s unvisible">item (s)</span>
											<span class="ajax_cart_no_product">(vazio)</span>
											</a>
										</div>
									</div>
									<div class="cart_block block exclusive">
										<div class="block_content">
											<!-- block list of products -->
											<div class="cart_block_list">
												<p class="cart_block_no_products">
													Sem produtos
												</p>
												<div class="cart-prices">
													<div class="cart-prices-line first-line">
														<span class="price cart_block_shipping_cost ajax_cart_shipping_cost">
														Frete grátis!
														</span>
														<span>
														Frete
														</span>
													</div>
													<div class="cart-prices-line last-line">
														<span class="price cart_block_total ajax_block_cart_total">$0.00</span>
														<span>Total</span>
													</div>
												</div>
												<p class="cart-buttons clearfix">
													<a id="button_order_cart" class="btn btn-warning button-medium button button-small pull-right" href="order.html" title="Finalizar" rel="nofollow">
													<span>
													Finalizar
													</span>
													</a>
												</p>
											</div>
										</div>
									</div>
									<!-- .cart_block -->
								</div>
							</div>
							<div id="layer_cart">
								<div class="clearfix">
									<div class="layer_cart_product col-xs-12 col-md-6">
										<span class="cross" title="Fechar janela"></span>
										<h2>
											<i class="fa fa-ok"></i>Produto adicionado ao seu carrinho de compras
										</h2>
										<div class="product-image-container layer_cart_img">
										</div>
										<div class="layer_cart_product_info">
											<span id="layer_cart_product_title" class="product-name"></span>
											<span id="layer_cart_product_attributes"></span>
											<div>
												<strong class="dark">Quantidade</strong>
												<span id="layer_cart_product_quantity"></span>
											</div>
											<div>
												<strong class="dark">Total</strong>
												<span id="layer_cart_product_price"></span>
											</div>
										</div>
									</div>
									<div class="layer_cart_cart col-xs-12 col-md-6">
										<h2>
											<!-- Plural Case [both cases are needed because page may be updated in Javascript] -->
											<span class="ajax_cart_product_txt_s  unvisible">
											Existem <span class="ajax_cart_quantity">0</span> produtos no seu carrinho.
											</span>
											<!-- Singular Case [both cases are needed because page may be updated in Javascript] -->
											<span class="ajax_cart_product_txt ">
											Existe 1 produto no seu carrinho.
											</span>
										</h2>
										<div class="layer_cart_row">
											<strong class="dark">
											Total de produtos:
											(c/ imposto)
											</strong>
											<span class="ajax_block_products_total">
											</span>
										</div>
										<div class="layer_cart_row">
											<strong class="dark">
											Total do envio:&nbsp;(c/ imposto)					</strong>
											<span class="ajax_cart_shipping_cost">
											Frete grátis!
											</span>
										</div>
										<div class="layer_cart_row">	
											<strong class="dark">
											Total
											(c/ imposto)
											</strong>
											<span class="ajax_block_cart_total">
											</span>
										</div>
										<div class="button-container">	
											<span class="continue btn btn-outline button exclusive-medium" title="Continuar comprando">
											<span>
											Continuar comprando
											</span>
											</span>
											<a class="btn btn-warning button pull-right"	href="order.html" title="Finalizar Pedido" rel="nofollow">
											<span>
											Finalizar Pedido
											</span>
											</a>	
										</div>
									</div>
								</div>
								<div class="crossseling"></div>
							</div>
							<!-- #layer_cart -->
							<div class="layer_cart_overlay"></div>
							<!-- /MODULE Block cart -->									
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</header>