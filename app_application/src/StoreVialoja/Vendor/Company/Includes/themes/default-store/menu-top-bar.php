<div class="container">											

	<?php 

	if ( CakeSession::read('cliente_nivel') > 1 ): ?>	

	<?php 
	$class_auto_login = $GLOBALS['class_auto_login'];
	?>
	
	<div class="settings pull-left">
		<div class="dropdown">
			<a data-toggle="dropdown" href="#"><i class="fa fa-gear"></i><span>Minha Loja</span><i class="fa fa-angle-down"></i></a>
			<div class="dropdown-menu" role="menu" aria-labelledby="dLabel">

				<div class="">
					<ul>
						<li class="selected">
							<a href="<?php echo $class_auto_login->urlAutoLoginPainelAdmin(); ?>" target="_BLANK" title="Painel de Controle">Painel de Controle</a> 				
						</li>				
					</ul>
				</div>

			</div>
		</div>
	</div>


	<div class="settings pull-left" style="margin-left:6px;">
		<div class="dropdown">
			<a data-toggle="dropdown" href="#"><i class="fa fa-gear"></i><span>Suporte:</span><i class="fa fa-angle-down"></i></a>
			<div class="dropdown-menu" role="menu" aria-labelledby="dLabel">


				<div class="currency ">
					<ul>
						<li class="euro">	
							<a href="<?php echo VIALOJA_FORUM; ?>" title="Fórum de Ajuda" target="_blank"> 
							Fórum
							</a>			
						</li>
						<li class="dollar">	
							<a href="<?php echo VIALOJA_TICKET_CLIENTE;  ?>" title="Ticket de Suporte" target="_blank"> 
							Ticket				
							</a>			
						</li>
					</ul>
				</div>

			</div>
		</div>
	</div>


	<?php endif; ?>

	<div class="topLinks pull-right">
		<div class="quick-access">
			<div class="quickaccess-toggle hidden-lg hidden-md">
				<i class="fa fa-list"></i>                                                          
			</div>
			<div class="inner-toggle">
				<ul class="links">
					<li ><a href="<?php echo FULL_BASE_URL ?>/cliente/minha-lista-de-desejos/" rel="nofollow" title="Minha Lista de Desejos" ><i class="fa fa-heart"></i> Minha Lista de Desejos</a></li>
					
					<?php if ( CakeSession::read('cliente_nome') ): ?>
					<li class=" last" ><a href="<?php echo FULL_BASE_URL ?>/cliente/conta/logoff/" title="Sair"><i class="fa fa-lock"></i> Sair</a></li>	
					<?php else: ?>
					<li class=" last" ><a href="<?php echo FULL_BASE_URL ?>/cliente/conta/login/" title="Entrar"><i class="fa fa-unlock-alt"></i> Entrar</a></li>	
					<?php endif ?>
					
					<li class="first" ><a href="<?php echo FULL_BASE_URL ?>/cliente/conta/" rel="nofollow" title="Minha Conta"><i class="fa fa-user"></i> Minha Conta</a></li>
					<li ><a href="<?php echo FULL_BASE_URL ?>/checkout/" rel="nofollow" title="Meus Pedidos" class="top-link-checkout"><i class="fa fa-share"></i> Meus Pedidos</a></li>
					<li ><a href="<?php echo FULL_BASE_URL ?>/checkout/carrinho/" rel="nofollow" title="Meu Carrinho" class="top-link-cart"><i class="fa fa-shopping-cart"></i> 


						Meu Carrinho

						<?php 

						if (CakeSession::read('minicart_qtde_total')){
							$total_item = CakeSession::read('minicart_qtde_total');
							if ($total_item > 1) {
								echo "( $total_item itens ) ";
							} elseif ($total_item == 1) {
								echo "( $total_item item ) ";
							}

						}
						?>

					</a></li>
					<li >
						<?php if ( CakeSession::read('cliente_nome') ): ?>

						<span class="welcome-msg"> <i class="fa fa-child"></i> Olá, <?php echo CakeSession::read('cliente_nome') ?></span>
							
						<?php else: ?>

						<span class="welcome-msg">Seja bem-vindo(a)!</span>
							
						<?php endif ?>	

					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
