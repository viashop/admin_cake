<div id="leo-mainnav" class="clearfix">
	<div class="container">
		<div class="inner">
			<div class="row ">
				<div class="widget col-lg-9 col-md-9 col-sm-12 col-xs-12 col-sp-12">
					<!-- Block search module -->
					<div id="leo_search_block_top" class="  exclusive">
						<form method="get" action="/s/productsearch/" id="leosearchtopbox">
							<input type="hidden" name="orderby" value="position" />
							<input type="hidden" name="orderway" value="desc" />
							<div class=" clearfix">
								<select class="col-md-3 col-sm-3 col-xs-12" name="cate" id="cate">
									<option value="">Todas os departamentos</option>

									<?php
									echo $GLOBALS['ConfiguracaoAtividade']['res_atividades_option_all'];
									?>

								</select>
								<input class="search_query col-md-9 col-sm-9 col-xs-12 grey" type="text" id="leo_search_query_top" name="q" value="<?php echo \Lib\Tools::getValue('q'); ?>" />
								<button type="submit" id="leo_search_top_button" class="btn btn-outline-inverse button button-small"><i class="fa fa-search"></i></button> 
							</div>
						</form>
					</div>
					<!-- /Block search module -->
				</div>
				<div class="widget col-lg-3 col-md-3 col-sm-12 col-xs-12 col-sp-12 pull-right">
					<div id="leo-verticalmenu" class="leo-verticalmenu  block nopadding float-vertical float-vertical-right">
						<h4 class="title_block float-vertical-button" href="javascript:s;"><i class="fa fa-bars"></i>Departamentos<i class="fa fa-angle-down pull-right" style="
							"></i></h4>
						<div class="box-content block_content">
							<div id="verticalmenu" class="verticalmenu" role="navigation">
								<ul class="nav navbar-nav megamenu left">
									<li class=" parent dropdown ">
										<a href="#" class="dropdown-toggle has-category" data-toggle="dropdown" target="_self"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_03.png') no-repeat;"><span class="menu-title">Ver todos os Deparamentos</span><span class="sub-title">Lista todas os departamentos</span></span></a><b class="caret"></b>
										
										<!-- html begin box menu -->

										<div class="dropdown-sub dropdown-menu"  style="width:700px;left: -700px; ">
											<?php 
											App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'dropdown-menu-inner_dpto');
											?>
										</div>

										<!-- html end -->

									</li>

									<li class="">
										<a href="<?php echo FULL_BASE_URL ?>/c/moda-e-acessorios/24/" target="_self" class="has-category" title="Moda e Acessórios"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_10.png') no-repeat;"><span class="menu-title">Moda e Acessórios</span><span class="sub-title">Moda feminina, masculina e infantil</span></span></a>
									</li>
									
									<li class="">
										<a href="<?php echo FULL_BASE_URL ?>/c/bebes-e-cia/7/" target="_self" class="has-category" title="Bebês e Cia"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_14.png') no-repeat;"><span class="menu-title">Bebês e Cia </span><span class="sub-title">Roupas para Bebês e Acessórios</span></span></a>
									</li>

									<li class="">
										<a href="<?php echo FULL_BASE_URL ?>/c/eletrodomesticos/13/" target="_self" class="has-category" title="Eletrodomésticos"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_12.png') no-repeat;"><span class="menu-title">Eletrodomésticos</span><span class="sub-title">Variedades de marcas e modelos </span></span></a>
									</li>

									<li class="">
										<a href="<?php echo FULL_BASE_URL ?>/c/eletronicos/14/" target="_self" class="has-category" title="Eletrônicos"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_18.png') no-repeat;"><span class="menu-title">Eletrônicos</span><span class="sub-title">Encontre as melhores marcas e novidades </span></span></a>
									</li>

									<li class="">
										<a href="<?php echo FULL_BASE_URL ?>/c/informatica/20/" target="_self" class="has-category" title="Informática"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_18.png') no-repeat;"><span class="menu-title">Informática</span><span class="sub-title">Informática, Computadores e Acessórios </span></span></a>
									</li>
									
									<li class="">
										<a href="<?php echo FULL_BASE_URL ?>/c/casa-e-decoracao/10/" target="_self" class="has-category" title="Casa e Decoração"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_16.png') no-repeat;"><span class="menu-title">Casa e Decoração </span><span class="sub-title">Quer decorar sua casa?</span></span></a>
									</li>
									
									<li class="">
										<a href="<?php echo FULL_BASE_URL ?>/c/cosmeticos-perfumaria-e-cuidados-pessoais/12/" target="_self" class="has-category" title="Cosméticos e Perfumaria"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_20.png') no-repeat;"><span class="menu-title">Cosméticos e Perfumaria</span><span class="sub-title">Cosméticos, Perfumaria e Cuidados Pessoais</span></span></a>
									</li>
									<li class="">
										<a href="<?php echo FULL_BASE_URL ?>/c/moveis/25/" target="_self" class="has-category" title="Móveis"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_20.png') no-repeat;"><span class="menu-title">Móveis </span><span class="sub-title">Móveis e Objetos de Decoração</span></span></a>
									</li>

									<li class="">
										<a href="<?php echo FULL_BASE_URL ?>/c/construcao-e-ferramentas/11/" target="_self" class="has-category" title="Construção e Ferramentas"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_20.png') no-repeat;"><span class="menu-title">Construção e Ferramentas</span><span class="sub-title">Linhas de Construção Civil</span></span></a>
									</li>
			
									<li class="">
										<a href="#" target="_self" class="has-category" title="Ver todas as lojas"><span class="hasicon menu-icon" style="background:url('/themes/shopping/img/modules/leomenusidebar/icons/Untitled-3_20.png') no-repeat;"><span class="menu-title">Ver todas as lojas </span><span class="sub-title">Todas as Lojas presente no Shopping</span></span></a>
									</li>
								
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>