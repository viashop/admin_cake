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
				<span class="navigation_page">	Authentication</span>
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
				<h1 class="page-heading">Authentication</h1>
				<!---->
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<form action="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/login" method="post" id="create-account_form" class="box">
							<h3 class="page-subheading">Create an account</h3>
							<div class="form_content clearfix">
								<p>Please enter your email address to create an account.</p>
								<div class="alert alert-danger" id="create_account_error" style="display:none"></div>
								<div class="form-group">
									<label for="email_create">Email address</label>
									<input type="text" class="is_required validate account_input form-control" data-validate="isEmail" id="email_create" name="email_create" value="" />
								</div>
								<div class="submit">
									<input type="hidden" class="hidden" name="back" value="" />						<button class="btn btn-default button button-medium exclusive" type="submit" id="SubmitCreate" name="SubmitCreate">
									<span>
									<i class="icon-user left"></i>
									Create an account
									</span>
									</button>
									<input type="hidden" class="hidden" name="SubmitCreate" value="Create an account" />
								</div>
							</div>
						</form>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<form action="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/login" method="post" id="login_form" class="box">
							<h3 class="page-subheading">Already registered?</h3>
							<div class="form_content clearfix">
								<div class="form-group">
									<label for="email">Email address</label>
									<input class="is_required validate account_input form-control" data-validate="isEmail" type="text" id="email" name="email" value="" />
								</div>
								<div class="form-group">
									<label for="passwd">Password</label>
									<span><input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="passwd" name="passwd" value="" /></span>
								</div>
								<p class="lost_password form-group"><a href="password-recovery.html" title="Recover your forgotten password" rel="nofollow">Esqueceu sua senha?</a></p>
								<p class="submit">
									<input type="hidden" class="hidden" name="back" value="" />						<button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-default button-medium">
									<span>
									<i class="icon-lock left"></i>
									Sign in
									</span>
									</button>
								</p>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</section>