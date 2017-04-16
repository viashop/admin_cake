<script type="text/javascript">
	// <![CDATA[
		var current_link = "http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/";
		//alert(request);
		var currentURL = window.location;
		currentURL = String(currentURL);
		currentURL = currentURL.replace("https://","").replace("http://","").replace("www.","").replace( /#\w*/, "" );
		current_link = current_link.replace("https://","").replace("http://","").replace("www.","");
		isHomeMenu = 0;
		if($("body").attr("id")=="index") isHomeMenu = 1;
		$(".megamenu > li > a").each(function() {
			menuURL = $(this).attr("href").replace("https://","").replace("http://","").replace("www.","").replace( /#\w*/, "" );
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
				text_warning_select: "Please select One to remove?",
				text_confirm_remove: "Are you sure to remove footer row?",
				JSON: null
			}, opts);
			// main function
			// initialize every element
			this.each(function() {
				var $btn = $('#cavas_menu .navbar-toggle');
				var $nav = null;
				if (!$btn.length)
					return;
				var $nav = $('<section id="off-canvas-nav"><nav class="offcanvas-mainnav" ><div id="off-canvas-button"><span class="off-canvas-nav"></span>Close</div></nav></sections>');
				var $menucontent = $($btn.data('target')).find('.megamenu').clone();
				$("body").append($nav);
				$("#off-canvas-nav .offcanvas-mainnav").append($menucontent);
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
	
	$(window).resize(function() {
			if( $(window).width() > 767 ){
	$("body").removeClass("off-canvas-active").addClass("off-canvas-inactive");
			}
		});
	});
	$(document.body).on('click', '[data-toggle="dropdown"]' ,function(){
		if(!$(this).parent().hasClass('open') && this.href && this.href != '#'){
			window.location.href = this.href;
		}
	});
</script>



<section id="breadcrumb" class="clearfix">
	<div class="container">
		<div class="row">
			<!-- Breadcrumb -->
			<div class="breadcrumb clearfix">
				<a class="home" href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/" title="Return to Home">Home</a>
				<span class="navigation-pipe" >/</span>
				<span class="navigation_page">Your shopping cart</span>
			</div>
			<!-- /Breadcrumb -->
		</div>
	</div>
</section>
<!-- Content -->
<section id="columns" class="columns-container">
	<div class="container">
		<div class="row">
			<!-- Center -->
			<section id="center_column" class="col-md-12">
				<div class="box">
					<h1 id="cart_title" class="page-heading">Shopping-cart summary
						<span class="heading-counter">Your shopping cart contains:
						<span id="summary_products_quantity">7 products</span>
						</span>
					</h1>
					<!-- Steps -->
					<ul class="step clearfix" id="order_step">
						<li class="col-md-2-4 col-xs-12 step_current  first">
							<span><em>01.</em> Summary</span>
						</li>
						<li class="col-md-2-4 col-xs-12 step_todo second">
							<span><em>02.</em> Sign in</span>
						</li>
						<li class="col-md-2-4 col-xs-12 step_todo third">
							<span><em>03.</em> Address</span>
						</li>
						<li class="col-md-2-4 col-xs-12 step_todo four">
							<span><em>04.</em> Shipping</span>
						</li>
						<li id="step_end" class="col-md-2-4 col-xs-12 step_todo last">
							<span><em>05.</em> Payment</span>
						</li>
					</ul>
					<!-- /Steps -->
					<p style="display:none" id="emptyCartWarning" class="alert alert-warning">Your shopping cart is empty.</p>
					<div class="cart_last_product">
						<div class="cart_last_product_header">
							<div class="left">Last product added</div>
						</div>
						<a class="cart_last_product_img" href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/casual-dresses/22-louis-erard.html">
						<img src="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/88-small_default/louis-erard.jpg" alt="Nineties revival reigns supreme"/>
						</a>
						<div class="cart_last_product_content">
							<p class="product-name">
								<a href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/casual-dresses/22-louis-erard.html">
								Nineties revival reigns supreme
								</a>
							</p>
						</div>
					</div>
					<div id="order-detail-content" class="table_block table-responsive">
						<table id="cart_summary" class="table table-bordered stock-management-on">
							<thead>
								<tr>
									<th class="cart_product first_item">Product</th>
									<th class="cart_description item">Description</th>
									<th class="cart_avail item">Avail.</th>
									<th class="cart_unit item">Unit price</th>
									<th class="cart_quantity item">Qty</th>
									<th class="cart_total item">Total</th>
									<th class="cart_delete last_item">&nbsp;</th>
								</tr>
							</thead>
							<tfoot>
								<tr class="cart_total_price">
									<td rowspan="3" colspan="3" id="cart_voucher" class="cart_voucher">
										<form action="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/order" method="post" id="voucher">
											<fieldset>
												<h4>Vouchers</h4>
												<input type="text" class="discount_name form-control" id="discount_name" name="discount_name" value="" />
												<input type="hidden" name="submitDiscount" />
												<button type="submit" name="submitAddDiscount" class="button btn btn-default button-small"><span>OK</span></button>
											</fieldset>
										</form>
									</td>
									<td colspan="3" class="text-right">Total products</td>
									<td colspan="2" class="price" id="total_product">$1,232.00</td>
								</tr>
								<tr style="display: none;">
									<td colspan="3" class="text-right">
										Total gift-wrapping cost:											
									</td>
									<td colspan="2" class="price-discount price" id="total_wrapping">
										$0.00
									</td>
								</tr>
								<tr class="cart_total_delivery">
									<td colspan="3" class="text-right">Total shipping</td>
									<td colspan="2" class="price" id="total_shipping" >$2.00</td>
								</tr>
								<tr class="cart_total_voucher" style="display:none">
									<td colspan="3" class="text-right">
										Total vouchers
									</td>
									<td colspan="2" class="price-discount price" id="total_discount">
										$0.00
									</td>
								</tr>
								<tr class="cart_total_price">
									<td colspan="3" class="total_price_container text-right">
										<span>Total</span>
									</td>
									<td colspan="2" class="price" id="total_price_container">
										<span id="total_price">$1,234.00</span>
									</td>
								</tr>
							</tfoot>
							<tbody>
								<tr id="product_9_0_0_0" class="cart_item first_item address_0 odd">
									<td class="cart_product">
										<a href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/fashion/9-maxi-dress.html"><img src="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/31-small_default/maxi-dress.jpg" alt="Vivamus ultrices quam vitae nibh aliquet" width="98" height="98"  /></a>
									</td>
									<td class="cart_description">
										<p class="product-name"><a href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/fashion/9-maxi-dress.html">Vivamus ultrices quam vitae nibh aliquet</a></p>
										<small class="cart_ref">SKU : demo_9</small>			
									</td>
									<td class="cart_avail"><span class="label label-success">In Stock</span></td>
									<td class="cart_unit" data-title="Unit price">
										<span class="price" id="product_price_9_0_0">
										<span class="price">$84.00</span>
										</span>
									</td>
									<td class="cart_quantity text-center">
										<input type="hidden" value="3" name="quantity_9_0_0_0_hidden" />
										<input size="2" type="text" autocomplete="off" class="cart_quantity_input form-control grey" value="3"  name="quantity_9_0_0_0" />
										<div class="cart_quantity_button clearfix">
											<a rel="nofollow" class="cart_quantity_down btn btn-default button-minus" id="cart_quantity_down_9_0_0_0" href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/cart?add=1&amp;id_product=9&amp;ipa=0&amp;id_address_delivery=0&amp;op=down&amp;token=44910e3fef2e6289478d4e04564cc8c5" title="Subtract">
											<span><i class="icon-minus"></i></span>
											</a>
											<a rel="nofollow" class="cart_quantity_up btn btn-default button-plus" id="cart_quantity_up_9_0_0_0" href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/cart?add=1&amp;id_product=9&amp;ipa=0&amp;id_address_delivery=0&amp;token=44910e3fef2e6289478d4e04564cc8c5" title="Add"><span><i class="icon-plus"></i></span></a>
										</div>
									</td>
									<td class="cart_total" data-title="Total">
										<span class="price" id="total_product_price_9_0_0">
										$252.00									</span>
									</td>
									<td class="cart_delete text-center" data-title="Delete">
										<div>
											<a rel="nofollow" title="Delete" class="cart_quantity_delete" id="9_0_0_0" href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/cart?delete=1&amp;id_product=9&amp;ipa=0&amp;id_address_delivery=0&amp;token=44910e3fef2e6289478d4e04564cc8c5"><i class="icon-trash"></i></a>
										</div>
									</td>
								</tr>
								<tr id="product_22_0_0_0" class="cart_item last_item address_0 even">
									<td class="cart_product">
										<a href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/casual-dresses/22-louis-erard.html"><img src="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/88-small_default/louis-erard.jpg" alt="Nineties revival reigns supreme" width="98" height="98"  /></a>
									</td>
									<td class="cart_description">
										<p class="product-name"><a href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/casual-dresses/22-louis-erard.html">Nineties revival reigns supreme</a></p>
										<small class="cart_ref">SKU : demo_15</small>			
									</td>
									<td class="cart_avail"><span class="label label-success">In Stock</span></td>
									<td class="cart_unit" data-title="Unit price">
										<span class="price" id="product_price_22_0_0">
										<span class="price">$245.00</span>
										</span>
									</td>
									<td class="cart_quantity text-center">
										<input type="hidden" value="4" name="quantity_22_0_0_0_hidden" />
										<input size="2" type="text" autocomplete="off" class="cart_quantity_input form-control grey" value="4"  name="quantity_22_0_0_0" />
										<div class="cart_quantity_button clearfix">
											<a rel="nofollow" class="cart_quantity_down btn btn-default button-minus" id="cart_quantity_down_22_0_0_0" href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/cart?add=1&amp;id_product=22&amp;ipa=0&amp;id_address_delivery=0&amp;op=down&amp;token=44910e3fef2e6289478d4e04564cc8c5" title="Subtract">
											<span><i class="icon-minus"></i></span>
											</a>
											<a rel="nofollow" class="cart_quantity_up btn btn-default button-plus" id="cart_quantity_up_22_0_0_0" href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/cart?add=1&amp;id_product=22&amp;ipa=0&amp;id_address_delivery=0&amp;token=44910e3fef2e6289478d4e04564cc8c5" title="Add"><span><i class="icon-plus"></i></span></a>
										</div>
									</td>
									<td class="cart_total" data-title="Total">
										<span class="price" id="total_product_price_22_0_0">
										$980.00									</span>
									</td>
									<td class="cart_delete text-center" data-title="Delete">
										<div>
											<a rel="nofollow" title="Delete" class="cart_quantity_delete" id="22_0_0_0" href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/cart?delete=1&amp;id_product=22&amp;ipa=0&amp;id_address_delivery=0&amp;token=44910e3fef2e6289478d4e04564cc8c5"><i class="icon-trash"></i></a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- end order-detail-content -->
					<div id="HOOK_SHOPPING_CART"></div>
					<p class="cart_navigation clearfix">
						<a
							href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/order?step=1"
							class="button btn btn-default standard-checkout button-medium"
							title="Proceed to checkout">
						<span>Proceed to checkout<i class="icon-chevron-right right"></i></span>
						</a>
						<a
							href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/casual-dresses/22-louis-erard.html"
							class="button button-exclusive btn btn-default"
							title="Continue shopping">
						<span><i class="icon-chevron-left"></i>Continue shopping</span>
						</a>
					</p>
				</div>
			</section>
		</div>
	</div>
</section>