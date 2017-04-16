<!-- Banner -->

<section id="bottom">
	<div class="container">
		<div class="row">
			<div class="widget col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12" >
				<div class="widget-html nopadding">
					<div class="block_content">
						<div class="row">

							<?php

							if (isset( $GLOBALS['BannerShopping']['res_managewidgets_footer_all'] ) ):

								foreach ($GLOBALS['BannerShopping']['res_managewidgets_footer_all'] as $key => $banner): ?>

								<div class="col-md-6 col-sm-6  col-xs-12 effect">
									<a href="<?php echo $banner['BannerShopping']['link']; ?>" title="<?php echo $banner['BannerShopping']['titulo']; ?>" target="<?php echo $banner['BannerShopping']['target']; ?>"> <img class="img-responsive" src="<?php echo CDN .'upload/ads/banner/managewidgets/'. $banner['BannerShopping']['caminho']; ?>" alt="<?php echo $banner['BannerShopping']['nome']; ?>" /> </a>
								</div>

								<?php
								/*
								<div class="col-md-6 col-sm-6  col-xs-12 effect"><a href="#"> <img class="img-responsive" src="<?php echo CDN .'upload/ads/banner/managewidgets'. $banner['']['']; ?>" alt="" /> </a></div>
								<div class="col-md-6 col-sm-6  col-xs-12 effect"><a href="#"><img class="img-responsive" src="<?php echo CDN .'upload/ads/banner/managewidgets'. $banner['']['']; ?>" alt="" /></a></div>
								*/
								?>
								<?php
								endforeach;

							endif;
							?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Banner -->

<footer id="footer" class="footer-container">
	<section id="leo-footer-top" class="footer-top">
		<div class="container">
			<div class="inner">
				<div class="row">
					<div class="widget col-lg-8 col-md-8 col-sm-6 col-xs-12 col-sp-12" >
						<!-- Block Newsletter module-->
						<div id="newsletter_block_left" class="block inline">
							<h4 class="title_block">Receba Promoções</h4>
							<div class="block_content">

								<?php

								if (isset($_SESSION['session_news']['status'])) {

									if ($_SESSION['session_news']['status'] != 3) {

										echo '<p class="warning_inline">'. $_SESSION['session_news']['msg'] .'</p>';

									} else {

										echo '<p class="success_inline">'. $_SESSION['session_news']['msg'] .'</p>';

									}

									$_SESSION['session_news']['status'] = null;

								}

								?>

								<form action="<?php echo FULL_BASE_URL .'/newsletter/cadastrar'; ?>" method="post">
									<div>

										<?php
										if (!Validate::isBot()) {
											echo "<input type='hidden' name='token' value='". sha1(mt_rand(0,mt_getrandmax())) ."' />". PHP_EOL;
											echo '<input type="text" class="hidden" name="url_default" value="">'. PHP_EOL;
											echo '<input type="text" class="hidden" name="ckeck" value="">'. PHP_EOL;
											echo '<input style="position: absolute; width: 1px; top: -5000px; left: -5000px;" name="name" type="text">'. PHP_EOL;
										}
								        ?>
										<input class="inputNew newsletter-input form-control" id="newsletter-input" type="email" name="email" size="18" data-validate="isEmail" required placeholder="Insira o seu melhor e-mail" />
										<input type="submit" value="Cadastrar" class="button_mini btn-danger btn button-default" name="submitNewsletter" />
										<input type="hidden" name="action" value="0" />

									</div>
								</form>
							</div>
						</div>
						<!-- /Block Newsletter module-->
					</div>
					<div class="widget col-lg-4 col-md-4 col-sm-6 col-xs-12 col-sp-12" >
						<div id="social_block" class="block pull-right">
							<h4 class="title_block">Siga-nos no</h4>
							<div class="block_content">
								<ul>
									<li class="facebook">
										<a target="_blank" href="https://www.facebook.com/vialoja.com.br" title="Facebook" class="btn-tooltip" data-original-title="Facebook">
										<span>Facebook</span>
										</a>
									</li>
									<li class="twitter">
										<a target="_blank" href="http://www.twitter.com/vialojashopping" title="Twitter" class="btn-tooltip" data-original-title="Twitter">
										<span>Twitter</span>
										</a>
									</li>
									<li class="rss">
										<a target="_blank" href="http://vialoja.com.br/blog/feed/" title="RSS" class="btn-tooltip" data-original-title="RSS">
										<span>RSS</span>
										</a>
									</li>
									<li class="youtube">
										<a href="https://www.youtube.com/c/ViaLojaBR" title="Youtube" class="btn-tooltip" data-original-title="Youtube">
										<span>Youtube</span>
										</a>
									</li>
									<li class="google-plus">
										<a href="https://plus.google.com/+VialojaBr" title="Google Plus" class="btn-tooltip" data-original-title="Google Plus">
										<span>Google Plus</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- #footertop -->
	<section id="leo-footer-center" class="footer-center">
		<div class="container">
			<div class="inner">
				<div class="row " >
					<div class="widget col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12" >
						<div class="widget-html block footer-block block nopadding">
							<h4 class="title_block">
								Quem somos
							</h4>
							<div class="block_content toggle-footer">
								<div class="about-us">
									<p>ViaLoja.com - É um Shopping Virtual e Plataforma para Criação e Gestão de Lojas Virtuais.</p>
									<ul class="bullet bullet-icon">
										<!-- <li><a href="#" rel="nofollow">+0800 00000</a></li> -->

										<?php if (!Validate::isBot()): ?>

										<li class="email"><a href="#" rel="nofollow">Email: contato@vialoja.com.br</a></li>

										<?php endif ?>

									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="widget col-lg-2 col-md-2 col-sm-6 col-xs-6 col-sp-12 bullet" >
						<div class="widget-links block block nopadding footer-block">
							<h4 class="title_block">
								Global
							</h4>
							<div class="block_content toggle-footer">
								<div id="tabs543970949" class="panel-group">
									<ul class="nav-links" >
										<li><a href="<?php echo FULL_BASE_URL .'/cliente/conta/login/novo/'; ?>" title="Criar uma Conta">Criar uma Conta</a></li>
										<li><a href="<?php echo FULL_BASE_URL .'/cliente/conta/login/'; ?>" title="Efetuar Login">Efetuar Login</a></li>
										<li><a href="<?php echo FULL_BASE_URL .'/d/politica-de-privacidade/'; ?>" title="Política de Privacidade" target="_BLANK">Política de Privacidade</a></li>
										<li><a href="<?php echo FULL_BASE_URL .'/d/informacoes-sobre-cookies/'; ?>" title="Informações sobre Cookie" target="_BLANK">Informações sobre Cookie</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="widget col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12" >
						<!-- MODULE Block footer -->
						<section class="footer-block block" id="block_various_links_footer">
							<h4 class="title_block">Informação</h4>
							<ul class="toggle-footer list-group bullet">

								<?php
								/*

								<li class="item">
									<a href="#" rel="nofollow" title="Promoções">
									Promoções
									</a>
								</li>
								<li class="item">
									<a href="#" rel="nofollow" title="Novos produtos">
									Novos produtos
									</a>
								</li>
								<li class="item">
									<a href="#" rel="nofollow" title="Mais vendidos">
									Mais vendidos
									</a>
								</li>
								<li class="item">
									<a href="#" rel="nofollow" title="Nossas lojas">
									Nossas lojas
									</a>
								</li>

								*/ ?>
								<li class="item">
									<a href="<?php echo FULL_BASE_URL .'/fale-conosco/'; ?>" title="Fale conosco">
									Fale conosco
									</a>
								</li>
								<li class="item">
									<a href="#" rel="nofollow" title="Termos e condições de uso">
									Termos e condições de uso
									</a>
								</li>
								<li class="item">
									<a href="#" rel="nofollow" title="Quem somos">
									Quem somos
									</a>
								</li>
								<li>
									<a href="<?php echo FULL_BASE_URL .'/mapa-do-site/'; ?>" title="Mapa do Site">
									Mapa do Site
									</a>
								</li>
								<li>
									<a class="_blank" rel="nofollow" href="<?php echo FULL_BASE_URL; ?>">
									&copy; <?php echo date('Y'); ?> ViaLoja ™
									</a>
								</li>
							</ul>
						</section>
						<!-- /MODULE Block footer -->
					</div>
					<div class="widget col-lg-4 col-md-4 col-sm-6 col-xs-6 col-sp-12" >
						<div id="google-maps" class="block" style="background-color:#fff; padding: 1px 10px 10px 10px; margin-top:19px;">
							<h4 style="color:red">
								Compartilhe com seus amigos! ;)
							</h4>
							<div class="fb-like-box" data-href="https://www.facebook.com/vialoja.com.br" data-width="350" data-height="264" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=1436666436575548&version=v2.0";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					var leoOption = {
						productNumber:0,
						productInfo:0,
						productTran:1,
						productCdown: 0,
						productColor: 0,
					}
					   $(document).ready(function(){
						var leoCustomAjax = new $.LeoCustomAjax();
						   leoCustomAjax.processAjax();
					   });
				</script>
			</div>
		</div>
	</section>
	<!-- #footercenter -->
	<section id="footernav" class="footer-nav">
		<div class="container">
			<div class="inner">
				<div id="powered">
					Copyright <?php echo date('Y'); ?> ViaLoja. Todos os direitos reservados.
				</div>
				<!-- #poweredby -->
			</div>
		</div>
	</section>
</footer>
<!-- .footer-container -->