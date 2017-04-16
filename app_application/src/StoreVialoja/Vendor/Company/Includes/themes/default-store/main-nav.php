<div class="container">
	<div class="ves-megamenu">
		<nav id="mainmenutop" class="navbar-inverse">
			<div class="megamenu" role="navigation">
				<div class="navbar">
					<a href="javascript:;" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle hidden-lg hidden-md" type="button">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>
					<div class="collapse navbar-collapse navbar-ex1-collapse hidden-sm hidden-xs">
						<ul class="nav navbar-nav megamenu">

							<li class=" " >
								<a href=""><span class="menu-icon" style="background:url('/superstore/media/ves_megamenu/i/c/ico-home_1.png') no-repeat;"><span class="menu-title">Home</span></span></a>
							</li>

							<?php if (defined('FULL_BANNERES_SHOP') || defined('SHOW_CATEGORIAS_MAIN_NAV')): ?>								

								<?php if (isset($GLOBALS['lista_categorias_main_nav'])): ?>
								<li class="parent dropdown  aligned-left " >
									<a class="dropdown-toggle" data-toggle="dropdown" rel="nofollow" href=""><span class="menu-title">Categorias</span><b class="caret"></b></a>
									<div class="dropdown-menu  level1"  >
										<div class="dropdown-menu-inner">
											<div class="row">
												<div class="mega-col col-sm-12"  data-colwidth="12"  data-type="menu" >
													<div class="mega-col-inner">
														<ul>														
															<?php echo $GLOBALS['lista_categorias_main_nav']; ?>															
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
								
								<?php endif ?>
							<?php endif ?>

							<?php foreach ($GLOBALS['res_liks_paginas_header'] as $key => $pagina): ?>
								
							<li class=" " >
								<a title="<?php echo $pagina['ShopPagina']['titulo']; ?>" href="<?php echo sprintf('%s/t/%s/', FULL_BASE_URL, $pagina['ShopPagina']['url']); ?>"><span class="menu-title"><?php echo $pagina['ShopPagina']['titulo'] ?></span></a>
							</li>
								
							<?php endforeach ?>
							
							<li class=" " >
								<a title="Contato" href="<?php echo sprintf('%s/contato/', FULL_BASE_URL ) ?>"><span class="menu-title">Contato</span></a>
							</li>

							<?php if (!empty($GLOBALS['Shop']['blog'])): ?>

							<li class=" " >
								<a title="Blog" href="<?php echo $GLOBALS['Shop']['blog']; ?>" target="_blank"><span class="menu-title">Blog</span></a>
							</li>
								
							<?php endif ?>							

						</ul>
					</div>
				</div>
			</div>
		</nav>
	</div>
	<script type="text/javascript">
		jQuery(window).ready( function(){
		
			/*  Fix First Click Menu */
			jQuery(document.body).on('click', '#mainmenutop [data-toggle="dropdown"]' ,function(event){
				event.stopImmediatePropagation();
				jQuery(this).parent().show();
				if(!jQuery(this).parent().hasClass('open') && this.href && this.href != '#'){
					window.location.href = this.href;
				}
		
			});
			jQuery(document.body).on('dblclick', '#mainmenutop [data-toggle="dropdown"]' ,function(event){
				event.stopImmediatePropagation();
				jQuery(this).parent().show();
				if(!jQuery(this).parent().hasClass('open') && this.href && this.href != '#'){
					window.location.href = this.href;
				}
		
			});
		});
	</script>    
</div>