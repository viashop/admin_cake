<div class="dropdown-menu-inner">
	<div class="row">
		<div class="mega-col col-sm-4">
			<div class="mega-col-inner ">
				<div class="leo-widget">
					<div class="widget-links">
						<div class="widget-heading">
							Departamentos do Shopping
						</div>

						<div class="widget-inner">
							<div id="tabs<?php echo \Lib\Tools::uniqid();?>" class="panel-group">
								<ul class="nav-links">

								<?php 

								foreach ($GLOBALS['ConfiguracaoAtividade']['res_atividades_all'] as $key => $atividade): 

									if ($key <=10 ):

										$id_atividade = $atividade['ConfiguracaoAtividade']['id_atividade'];
										$nome_atividade = $atividade['ConfiguracaoAtividade']['nome'];

										printf('<li><a href="%s/c/%s/%d/" title="%s">%s</a></li>',
											FULL_BASE_URL,
											\Lib\Tools::slug( $nome_atividade ), 
											$id_atividade,  
											$nome_atividade, 
											$nome_atividade 
										) . PHP_EOL;
																											

									endif;

								endforeach;

								?>

								</ul>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="mega-col col-sm-4">
			<div class="mega-col-inner ">
				<div class="leo-widget">
					<div class="widget-links">
						<div class="widget-heading">
							
						</div>

						<div class="widget-inner">
							<div id="tabs<?php echo \Lib\Tools::uniqid();?>" class="panel-group">
								<ul class="nav-links">
									<?php 

									foreach ($GLOBALS['ConfiguracaoAtividade']['res_atividades_all'] as $key => $atividade): 

										if ($key >= 11 &&  $key <= 21 ):

											$id_atividade = $atividade['ConfiguracaoAtividade']['id_atividade'];
											$nome_atividade = $atividade['ConfiguracaoAtividade']['nome'];

											printf('<li><a href="%s/c/%s/%d/" title="%s">%s</a></li>',
												FULL_BASE_URL,
												\Lib\Tools::slug( $nome_atividade ), 
												$id_atividade,  
												$nome_atividade, 
												$nome_atividade 
											) . PHP_EOL;
																											

										endif;

									endforeach;

									?>
								</ul>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="mega-col col-sm-4">
			<div class="mega-col-inner ">
				<div class="leo-widget">
					<div class="widget-links">
						<div class="widget-heading">
							
						</div>

						<div class="widget-inner">
							<div id="tabs<?php echo \Lib\Tools::uniqid();?>" class="panel-group">
								<ul class="nav-links">
									<?php 

									foreach ($GLOBALS['ConfiguracaoAtividade']['res_atividades_all'] as $key => $atividade): 

										if ($key >= 22 ):

											$id_atividade = $atividade['ConfiguracaoAtividade']['id_atividade'];
											$nome_atividade = $atividade['ConfiguracaoAtividade']['nome'];

											printf('<li><a href="%s/c/%s/%d/" title="%s">%s</a></li>',
												FULL_BASE_URL,
												\Lib\Tools::slug( $nome_atividade ), 
												$id_atividade,  
												$nome_atividade, 
												$nome_atividade 
											) . PHP_EOL;
																											

										endif;

									endforeach;

									?>
								</ul>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>