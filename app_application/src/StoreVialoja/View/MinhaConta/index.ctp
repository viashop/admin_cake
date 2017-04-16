<script type="text/javascript">
	// <![CDATA[
		var current_link = "../minha-conta/";
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
				<a class="home" href="../" title="Return to Home">Home</a>
				<span class="navigation-pipe" >/</span>
				<span class="navigation_page">Minha conta</span>
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
					<h1 class="page-heading">Minha Conta</h1>
					<p class="info-account">Bem-vindo à sua conta. Aqui você pode gerenciar todas as suas informações pessoais e encomendas.</p>
					<div class="row addresses-lists">
						<div class="col-xs-12 col-sm-6 col-lg-4">
							<ul class="myaccount-link-list">
								<li><a href="../minha-conta/order-history" title="Orders"><i class="icon-list-ol"></i><span>Meus pedidos e detalhes</span></a></li>
								<li><a href="../minha-conta/order-slip" title="Credit slips"><i class="icon-ban-circle"></i><span>Meu crédito deslizamentos</span></a></li>
								<li><a href="../minha-conta/addresses" title="Addresses"><i class="icon-building"></i><span>Meus endereços</span></a></li>
								<li><a href="../minha-conta/identity" title="Information"><i class="icon-user"></i><span>Os meus dados pessoais</span></a></li>
							</ul>
						</div>
						<div class="col-xs-12 col-sm-6 col-lg-4">
							<ul class="myaccount-link-list">
								<li><a href="../minha-conta/discount" title="Vouchers"><i class="icon-barcode"></i><span>Meus comprovantes</span></a></li>
								<!-- MODULE WishList -->
								<li class="lnk_wishlist">
									<a 	href="../minha-conta/module/blockwishlist/mywishlist" title="My wishlists">
									<i class="icon-heart"></i>
									<span>Minha lista de desejos</span>
									</a>
								</li>
								<!-- END : MODULE WishList -->
							</ul>
						</div>
					</div>
				</div>
				<ul class="footer_links clearfix">
					<li><a href="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/" title="Home"><span><i class="icon-home"></i> Home</span></a></li>
				</ul>
			</section>
		</div>
	</div>
</section>