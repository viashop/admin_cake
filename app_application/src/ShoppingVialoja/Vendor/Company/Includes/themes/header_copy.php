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
									<li class="first">
										<a id="wishlist-total" href="/cliente/minha-lista-de-desejos" title="Minha lista de desejos"><i class="fa fa-heart"></i>Minha Lista de Desejos</a>
									</li>
									<li><a class="login" href="/cliente/conta/login" rel="nofollow" title="Entrar com sua conta de cliente">
										<i class="fa fa-unlock-alt"></i>Entrar
										</a>
									</li>
									<li>
										<a href="/cliente/conta" title="A minha conta"><i class="fa fa-user"></i>Minha Conta</a>
									</li>
									<li class="last"><a href="/checkout" title="Checkout" class="last"><i class="fa fa-share"></i> Meus Pedidos</a></li>
									<li>
										<a href="/checkout/carrinho" title="Carrinho de Compras" rel="nofollow">
										<i class="fa fa-shopping-cart"></i>Meu Carrinho
										</a>
									</li>
								</ul>
							</div>
							<!-- Block currencies module -->
							<div class="btn-group">
								<div data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i><span class="hidden-xs">Moeda: </span>
									$USD
								</div>
								<div class="quick-setting dropdown-menu">
									<div id="currencies-block-top">
										<form id="setCurrency" action="http://demo4leotheme.com/prestashop/shopping/br/" method="post">
											<input type="hidden" name="id_currency" id="id_currency" value=""/>
											<input type="hidden" name="SubmitCurrency" value="" />
											<ul id="first-currencies" class="currencies_ul toogle_content">
												<li class="selected">
													<a href="javascript:setCurrency(1);" rel="nofollow" title="Dollar">
													$ Dollar
													</a>
												</li>
												<li >
													<a href="javascript:setCurrency(2);" rel="nofollow" title="Euros">
													€ Euros
													</a>
												</li>
											</ul>
										</form>
									</div>
								</div>
							</div>
							<!-- /Block currencies module --><!-- Block languages module -->
							<div class="btn-group">
								<div data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i><span class="hidden-xs">Idiomas: </span>
									<span><img src="/img/l/5.jpg" alt="br" width="16" height="11" /></span>				 
								</div>
								<div class="quick-setting dropdown-menu">
									<div id="languages-block-top" class="languages-block">
										<ul id="first-languages" class="languages-block_ul">
											<li >
												<a href="http://demo4leotheme.com/prestashop/shopping/en/" title="English (English)">
												<span><img src="/img/l/1.jpg" alt="en" width="16" height="11" />&nbsp;English</span>
												</a>
											</li>
											<li >
												<a href="http://demo4leotheme.com/prestashop/shopping/fr/" title="Français (French)">
												<span><img src="/img/l/3.jpg" alt="fr" width="16" height="11" />&nbsp;Français</span>
												</a>
											</li>
											<li >
												<a href="http://demo4leotheme.com/prestashop/shopping/de/" title="Deutsch (German)">
												<span><img src="/img/l/4.jpg" alt="de" width="16" height="11" />&nbsp;Deutsch</span>
												</a>
											</li>
											<li class="selected">
												<span><img src="/img/l/5.jpg" alt="br" width="16" height="11" />&nbsp;Portuguese-Brazil</span>
											</li>
											<li >
												<a href="http://demo4leotheme.com/prestashop/shopping/it/" title="Italiano (Italian)">
												<span><img src="/img/l/6.jpg" alt="it" width="16" height="11" />&nbsp;Italiano</span>
												</a>
											</li>
											<li >
												<a href="http://demo4leotheme.com/prestashop/shopping/es/" title="Español (Spanish)">
												<span><img src="/img/l/7.jpg" alt="es" width="16" height="11" />&nbsp;Español</span>
												</a>
											</li>
											<li >
												<a href="http://demo4leotheme.com/prestashop/shopping/ru/" title="Russian">
												<span><img src="/img/l/8.jpg" alt="ru" width="16" height="11" />&nbsp;Russian</span>
												</a>
											</li>
											<li >
												<a href="http://demo4leotheme.com/prestashop/shopping/pl/" title="Polish">
												<span><img src="/img/l/9.jpg" alt="pl" width="16" height="11" />&nbsp;Polish</span>
												</a>
											</li>
											<li >
												<a href="http://demo4leotheme.com/prestashop/shopping/ar/" title="Arabic">
												<span><img src="/img/l/10.jpg" alt="ar" width="16" height="11" />&nbsp;Arabic</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- /Block languages module -->
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
							<a href="//demo4leotheme.com/prestashop/shopping/" title="Leo Shopping">
							<img class="logo img-responsive" src="/img/logos/vialoja.png" alt="Leo Shopping" width="172" height="45"/>
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
												<a href="index.html" target="_self" class="has-category"><span class="menu-title">Home</span></a>
											</li>
											<li class=" parent dropdown aligned-left " >
												<a href="#" class="dropdown-toggle has-category" data-toggle="dropdown" target="_self"><span class="menu-title">Featured</span><b class="caret"></b></a>
												<div class="dropdown-sub dropdown-menu"  style="width:500px" >
													<div class="dropdown-menu-inner">
														<div class="row">
															<div class="mega-col col-sm-6" >
																<div class="mega-col-inner ">
																	<div class="leo-widget">
																		<div class="widget-links">
																			<div class="menu-title">
																				Networking
																			</div>
																			<div class="widget-inner">
																				<div id="tabs530305434" class="panel-group">
																					<ul class="nav-links">
																						<li ><a href="#link1" >Lorem ipsum dolor</a></li>
																						<li ><a href="#link2" >In et sollicitudin odio</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" >Morbi nunc lectus</a></li>
																						<li ><a href="#link1" >Pellentesque rutrum</a></li>
																						<li ><a href="#link1" >Morbi nunc lectus</a></li>
																						<li ><a href="#link1" >Pellentesque rutrum</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" ></a></li>
																						<li ><a href="#link1" ></a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="leo-widget">
																		<div class="widget-links">
																			<div class="menu-title">
																				Electronics
																			</div>
																			<div class="widget-inner">
																				<div id="tabs121421072" class="panel-group">
																					<ul class="nav-links">
																						<li ><a href="#link1" >Pellentesque rutrum</a></li>
																						<li ><a href="#link2" > Morbi nunc lectus</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" >Pellentesque rutrum</a></li>
																						<li ><a href="#link1" >Lorem ipsum dolor</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" ></a></li>
																						<li ><a href="#link1" ></a></li>
																						<li ><a href="#link1" ></a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="leo-widget">
																		<div class="widget-links">
																			<div class="menu-title">
																				Accessories
																			</div>
																			<div class="widget-inner">
																				<div id="tabs1271825828" class="panel-group">
																					<ul class="nav-links">
																						<li ><a href="#link1" >Accessories</a></li>
																						<li ><a href="#link2" >Morbi nunc lectus</a></li>
																						<li ><a href="#link1" > Pellentesque rutrum</a></li>
																						<li ><a href="#link1" >Morbi nunc lectus</a></li>
																						<li ><a href="#link1" >Pellentesque rutrum</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" >Lorem ipsum dolor</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" ></a></li>
																						<li ><a href="#link1" ></a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="mega-col col-sm-6" >
																<div class="mega-col-inner ">
																	<div class="leo-widget">
																		<div class="widget-html">
																			<div class="widget-inner">
																				<p><img class="img-responsive" src="/themes/shopping/img/modules/leomanagewidgets/banner-left-1.jpg" alt="" /></p>
																				<p><img class="img-responsive" src="/themes/shopping/img/modules/leomanagewidgets/banner-left-2.jpg" alt="" /></p>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class=" parent dropdown aligned-center " >
												<a href="#" class="dropdown-toggle has-category" data-toggle="dropdown" target="_self"><span class="menu-title">Fashion</span><b class="caret"></b></a>
												<div class="dropdown-sub dropdown-menu"  style="width:700px" >
													<div class="dropdown-menu-inner">
														<div class="row">
															<div class="mega-col col-sm-4" >
																<div class="mega-col-inner ">
																	<div class="leo-widget">
																		<div class="widget-links">
																			<div class="menu-title">
																				Networking
																			</div>
																			<div class="widget-inner">
																				<div id="tabs513532375" class="panel-group">
																					<ul class="nav-links">
																						<li ><a href="#link1" >Lorem ipsum dolor</a></li>
																						<li ><a href="#link2" >In et sollicitudin odio</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" >Morbi nunc lectus</a></li>
																						<li ><a href="#link1" >Pellentesque rutrum</a></li>
																						<li ><a href="#link1" >Morbi nunc lectus</a></li>
																						<li ><a href="#link1" >Pellentesque rutrum</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" ></a></li>
																						<li ><a href="#link1" ></a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="mega-col col-sm-4" >
																<div class="mega-col-inner ">
																	<div class="leo-widget">
																		<div class="widget-links">
																			<div class="menu-title">
																				Electronics
																			</div>
																			<div class="widget-inner">
																				<div id="tabs84382187" class="panel-group">
																					<ul class="nav-links">
																						<li ><a href="#link1" >Pellentesque rutrum</a></li>
																						<li ><a href="#link2" > Morbi nunc lectus</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" >Pellentesque rutrum</a></li>
																						<li ><a href="#link1" >Lorem ipsum dolor</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" ></a></li>
																						<li ><a href="#link1" ></a></li>
																						<li ><a href="#link1" ></a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="mega-col col-sm-4" >
																<div class="mega-col-inner ">
																	<div class="leo-widget">
																		<div class="widget-links">
																			<div class="menu-title">
																				Accessories
																			</div>
																			<div class="widget-inner">
																				<div id="tabs1595424464" class="panel-group">
																					<ul class="nav-links">
																						<li ><a href="#link1" >Accessories</a></li>
																						<li ><a href="#link2" >Morbi nunc lectus</a></li>
																						<li ><a href="#link1" > Pellentesque rutrum</a></li>
																						<li ><a href="#link1" >Morbi nunc lectus</a></li>
																						<li ><a href="#link1" >Pellentesque rutrum</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" >Lorem ipsum dolor</a></li>
																						<li ><a href="#link1" >Integer gravida cons</a></li>
																						<li ><a href="#link1" ></a></li>
																						<li ><a href="#link1" ></a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
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
											<li class="" >
												<a href="best-sales.html" target="_self" class="has-category"><span class="menu-title">Best Seller</span></a>
											</li>
											<li class="" >
												<a href="contact-us.html" target="_self" class="has-category"><span class="menu-title">ABRA UMA LOJA GRATUITAMENTE</span></a>
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