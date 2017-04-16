<?php
$time_search = time();
?>
<div class="container">
	<div class="header-wrap row">

		<div class="col-lg-3 col-md-3 col-sm-5 col-xs-12">
			<div id="logo-theme" class="logo-store logo" style="font-size:36px;"><strong class="logo-title"><?php echo $GLOBALS['Shop']['nome_loja_shop']; ?></strong><a href="/" title="<?php echo $GLOBALS['Shop']['nome_loja_shop']; ?>" class="logo"><img src="<?php

				if (defined('LOGO_SHOP')):

				 	echo LOGO_SHOP; 

				endif;

				?>" style="max-height: 130px; max-width: 270px;" alt="<?php echo $GLOBALS['Shop']['nome_loja_shop']; ?>" /></a></div>
		</div>

		<div id="search" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="input-group">
				<div class=" box search_box">
					<form method="GET" action="/s/result/" id="search_form_<?php echo $time_search; ?>">
						<div class="filter_type category_filter pull-left">
							<span class="fa fa-caret-down"></span>
							<select name="category_id">
								<option value="0">Todas as Categorias</option>
								<?php 
								if (isset($GLOBALS['option_categoria'])):
									echo $GLOBALS['option_categoria'];									
								endif;
								?>
							</select>
						</div>
						<div id="search<?php echo $time_search; ?>" class="search pull-left">
							<input type="text" name="q" autocomplete="off" placeholder="Pesquisar em toda a loja..." value="" class="input-search ">
							<span class="button-search fa fa-search"></span>
						</div>
					</form>
					<div class="clear clr"></div>
				</div>
				<script type="text/javascript">
					(function($) {
						$("#search<?php echo $time_search; ?> span:first").mouseover(function(){
							var $this = $(this);
							var $input = $(".category_filter select[name=\"category_id\"]"); 
							if ($input.is("select") && !$('.lfClon').length) {
								var $clon = $input.clone();
								var getRules = function($ele){ return {
									position: 'absolute',
									left: $ele.offset().left,
									top: $ele.offset().top,
									width: $ele.outerWidth(),
									height: $ele.outerHeight(),
									background: '#f9f9f9',
									fontSize: '13px',
									color: '#8c8c8c',
									opacity: 0,
									margin: 0,
									padding: 0
								};};
								var rules = getRules($input);
								$clon.css(rules);
								$clon.on("mousedown.lf", function(){
									$clon.css({
										marginLeft: $input.offset().left - rules.left,
										marginTop: $input.offset().top - rules.top,
									});
									$clon.on('change blur', function(){
										$input.val($clon.val()).show();
										$clon.remove();
									});
									$clon.off('.lf');
								});
								$clon.on("mouseout.lf", function(){
									$(this).remove();
								});
								$clon.prop({id:'',className:'lfClon'});
								$clon.appendTo('body');
							}
						});
					
						var selector = '#search<?php echo $time_search; ?>';
						var text_price = "Price";
						var total = 0;
						var show_image = true;
						var show_price = true;
						var search_sub_category = true;
						var search_description = true;
					
						$(selector).find('.button-search').bind('click', function(){
							url = "/s/result/";
								 
							var category_id = $(".category_filter select[name=\"category_id\"]").first().val();
							if(typeof(category_id) == 'undefined')
								category_id = 0;
					
							var search = $('input[name=\'q\']').val();
							
							if(category_id) {
								url += '?cat=' + encodeURIComponent(category_id);
								if (search) {
									url += '&q=' + encodeURIComponent(search);
								}
							} else if(search) {
								url += '?q=' + encodeURIComponent(search);
							}
							
							location = url;
						});
					
						$(selector).find('input[name=\'q\']').bind('keydown', function(e) {
							if (e.keyCode == 13) {
								url = "/s/result/";
								
								var category_id = $(".category_filter select[name=\"category_id\"]").first().val();
								if(typeof(category_id) == 'undefined')
									category_id = 0;
					
								var search = $('input[name=\'q\']').val();
								
								if(category_id) {
									url += '?cat=' + encodeURIComponent(category_id);
									if (search) {
										url += '&q=' + encodeURIComponent(search);
									}
								} else if(search) {
									url += '?q=' + encodeURIComponent(search);
								}
								location = url;
							}
						});
						
						$(document).ready( function(){
							$(selector).find('input[name=\'q\']').autocomplete({
								delay: 500,
								position: {
										my: "left top",
										at: "left bottom",
										collision: "none"
								},
								open: function() {
									
									//autocomplete.css("top", newTop);
					
								},
								source: function(request, response) {
									var category_id = $(".category_filter select[name=\"category_id\"]").first().val();
									if(typeof(category_id) == 'undefined')
										category_id = 0;
									var limit = 5;
									var text = encodeURIComponent(request.term);
					
									var search_sub_category = search_sub_category?'&sub_category=true':'';
									var search_description = search_description?'&description=true':'';
									var formkey =  $("input[name='form_key']").val();
									if(text.length > 1){
									
									/*
									$.ajax({
										url: '/s/index/ajaxgetproduct/',
										dataType: 'json',
										data: 'filter_category_id='+category_id+'&limit='+limit+search_sub_category+search_description+'&filter_name='+encodeURIComponent(request.term),
										type:'POST',
										success: function(json) {
											response($.map(json, function(item) {
												if($('.vesautosearch_result')){
													$('.vesautosearch_result').first().html("");
												}
												total = 0;
												if(item.total){
													total = item.total;
												}
												return {
													price: item.price,
													html: item.html,
													label: item.name,
													image: item.image,
													link:  item.link,
													value: item.product_id
												}
											}));
										}
									});
									
										*/
									}
								},
								select: function(event, ui) {
									return false;
								},
								focus: function(event, ui) {
									return false;
								}
							})
								$(selector).find('input[name=\'q\']').data( "autocomplete" )._renderMenu = function(ul,b){
									var g=this;
									$.each(b,function(c,f){g._renderItem(ul,f)});
									var category_id = $(".category_filter select[name=\"category_id\"]").first().val();
									if(typeof(category_id) == 'undefined')
										category_id = 0;
					
									category_id = parseInt(category_id);
									var text_view_all = 'View all %s items';
									text_view_all = text_view_all.replace(/%s/gi, total);
					
									var url = "";
									
					
									url += '?q=' + g.term;
					
									if(category_id) {
										url += '&cat=' + encodeURIComponent(category_id);
									}
					
									return $(ul).append('<li><a href="/s/result/'+url+'" onclick="window.location=this.href">'+text_view_all+'</a></li>');
								};
								$(selector).find('input[name=\'q\']').data( "autocomplete" )._renderItem = function( ul, item ) {
									var html = item.html;
					
									var li_element = $("<li></li>").data("item.autocomplete",item).append(html).appendTo(ul);
									
									$(li_element).click(function(el){
										$(selector+' input[name=\'search\']').val('');
										if(item.link){
											window.location = item.link.replace(/&amp;/gi,'&');
										}
									});
									
									return li_element;
								};
						})
					})(jQuery);
				</script>				
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-1 col-xs-12">
			<div class="inner pull-right">
				<div class="pull-right">
					<div class="inner-toggle">
						<div class="cart-top">
							<div class="clearfix" id="cart">
								<div class="heading hidden-sm hidden-xs">
									<div class="cart-inner">
										<a href="#" title="Carrinho de Compras">
											<i class="fa fa-shopping-cart "></i>
											<h4>
												<span class="title">Carrinho de Compras</span>	

												<?php if (CakeSession::read('minicart_qtde_total')): ?>

												<span id="cart-total"><?php echo CakeSession::read('minicart_qtde_total'); ?> item(s) - <span class="price">R$ <?php echo \Lib\Tools::convertToDecimalBR( CakeSession::read('minicart_preco_total') ); ?></span></span>

												<?php elseif (isset($_COOKIE['__vialoja_minicart'])): ?>

												<span id="cart-total"><?php

												$cookieViaLoja = new \Lib\Cookie();

												$cookie = explode('|', $cookieViaLoja->getCookie('__vialoja_minicart') );

												echo $cookie[0];

												?> item(s) - <span class="price">R$ <?php echo \Lib\Tools::convertToDecimalBR( $cookie[1] ); ?></span></span>
													
												<?php else: ?>

												<span id="cart-total">0 item(s) - <span class="price">R$ 0,00</span></span>
													
												<?php endif ?>
															
												
											</h4>
										</a>
									</div>
								</div>

								<?php if (CakeSession::read('html_mobile')): ?>

								<?php echo CakeSession::read('html_mobile'); ?>
									
								<?php else: ?>								

								<div class="quick-access">
									<div class="cart-inner">
										<div class="quickaccess-toggle hidden-lg hidden-md">
											<i class="fa fa-shopping-cart "></i>                                                      
										</div>
										<div class="inner-toggle">
											<div class="content">
												<div class=" block-cart">
													<div class="block-content">
														<p class="empty">Você não tem itens no seu carrinho de compras.</p>
														<div class="actions">
															<button type="button" title="Checkout" class="button" onclick="setLocation('/checkout/onepage/')"><span><span>Checkout</span></span></button>
															<a class="view-cart" href="<?php echo FULL_BASE_URL ?>/checkout/carrinho/" title="Ver carrinho">Ver carrinho</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<?php endif ?>

							</div>
							<script type="text/javascript">
								text_confirm_delete_item = "Tem certeza de que deseja remover este item do carrinho de compras?";
								var text_cart_total = "%total% item(s) - %price%";
							</script>


							

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>