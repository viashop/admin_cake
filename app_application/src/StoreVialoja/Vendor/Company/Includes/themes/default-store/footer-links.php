<div class="footer-center">
	<div class="container">
		<div class="block module_custom-footer-links ">
			<div class="block-content">
				<div class="custom-footer-links">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<h3>Sobre a Loja</h3>
							<?php if ( !empty($GLOBALS['Shop']['descricao'])): ?>							
								
							<p><?php echo nl2br(\Lib\Tools::formatList($GLOBALS['Shop']['descricao'],105)); ?></p>
								
							<?php endif ?>
							
							<br />
							<ul class="contacts">

								<?php if (!empty($GLOBALS['Shop']['telefone'])): ?>
								<li class="first"><span>Fone: <?php echo $GLOBALS['Shop']['telefone']; ?></span></li>	
								<?php endif ?>

								<?php if ( !empty($GLOBALS['ShopRedeSocial']['whatsapp']) ): ?>
								<li class="last"><span style="font-size:15px"><span style="font-weight:bold">WhatsApp:</span> <?php echo $GLOBALS['ShopRedeSocial']['whatsapp']; ?></span></li>
								<?php endif ?>					
								
								<?php if (!empty($GLOBALS['Shop']['email'])){ ?>

									<?php if (!\Lib\Validate::isBot()) : ?>
									<li class="last"><span>E-mail: <?php echo $GLOBALS['Shop']['email']; ?></span></li>
									<?php endif ?>

								<?php } ?>

							</ul>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<h3>Informações e Suporte</h3>
							<ul class="custom-links">
								<li><em class="fa fa-stop"></em><a title="Contato" href="<?php echo FULL_BASE_URL.'/contato/'; ?>">Contato</a></li>
									
								<?php if (!isset($GLOBALS['Shop']['blog'])): ?>

								<li><em class="fa fa-stop"></em><a title="Blog" rel="nofollow" href="<?php echo $GLOBALS['Shop']['blog']; ?>" target="_blank">Blog</a></li>
									
								<?php else: ?>

								<li><em class="fa fa-stop"></em><a title="Blog" href="#" rel="nofollow">Blog</a></li>
									
								<?php endif ?>
								
								<li><em class="fa fa-stop"></em><a title="Mapa do Site" href="#" rel="nofollow">Mapa do Site</a></li>
							</ul>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<h3>Conteúdo</h3>
							<ul class="custom-links">

								<?php foreach ($GLOBALS['res_liks_paginas_footer'] as $key => $pagina): ?>
								
								<li><em class="fa fa-stop"></em><a title="<?php echo $pagina['ShopPagina']['titulo']; ?>" href="<?php echo sprintf('%s/t/%s/', FULL_BASE_URL, $pagina['ShopPagina']['url']); ?>"><?php echo $pagina['ShopPagina']['titulo'] ?></a></li>
									
								<?php endforeach ?>

								
							</ul>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

							<?php if (!\Lib\Tools::hideIncludeCart()): ?>

							<!--<h3>Compartilhe com seus amigos</h3>-->
							<ul class="custom-links" style="margin-left:-23px;">

								<?php if (isset($GLOBALS['ShopRedeSocial']['facebook'])): ?>
								
								<div class="fb-like-box" data-href="<?php echo $GLOBALS['ShopRedeSocial']['facebook']; ?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>									
								<?php else: ?>	
								
								<div class="fb-like-box" data-href="https://www.facebook.com/vialojashopping" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
								
								<?php endif ?>
								
							</ul>

							<?php endif ?>

						</div>
						
					</div>
				</div>
				<div class="clear clr"></div>
			</div>
		</div>
	</div>
</div>

<?php if (!\Lib\Tools::hideIncludeCart()): ?>
	
<div class="footer-bottom"></div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php endif ?>