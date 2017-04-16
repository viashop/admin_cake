<section id="columns" class="columns-container">
    <div class="container">
        <div class="row">
            <div id="top_column" class="center_column col-xs-12 col-sm-12 col-md-12">
            </div>
        </div>
        <div class="row">
            <!-- Center -->
            <section id="center_column" class="col-md-12">
                <div id="breadcrumb" class="clearfix">
                    <!-- Breadcrumb -->
                    <div class="breadcrumb clearfix">
                        <a class="home" href="//<?php echo env('HTTP_HOST'); ?>" title="Voltar para a Página Inicial"><i class="fa fa-home"></i></a>
                        <span class="navigation-pipe" >/</span>
                        <span class="navigation_page">Minha Conta</span>
                    </div>
                    <!-- /Breadcrumb -->			
                </div>
                <h1 class="page-heading">Minha Conta</h1>
                <?php
                echo $this->Session->flash();
                ?>
                <p class="info-account">Bem-vindo &agrave; sua conta. Aqui voc&ecirc; pode gerenciar todas as suas informa&ccedil;&otilde;es pessoais e encomendas.</p>
                <div class="row addresses-lists">
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <ul class="myaccount-link-list">
                            <li><a href="/minha-conta/addresses" title="Adicionar meu endereço principal"><i class="fa fa-building"></i><span>Adicionar meu endereço principal</span></a></li>
                            <li><a href="/minha-conta/order-history" title="Compras"><i class="fa fa-list-ol"></i><span>Hist&oacute;rico de pedidos e detalhes</span></a></li>
                            <li><a href="/minha-conta/order-slip" title="Cr&eacute;ditos"><i class="fa fa-ban"></i><span>Vales de cr&eacute;ditos</span></a></li>
                            <li><a href="/minha-conta/addresses" title="Endere&ccedil;os"><i class="fa fa-building"></i><span>Meus endere&ccedil;os</span></a></li>
                            <li><a href="/minha-conta/dados" title="Informa&ccedil;&atilde;o"><i class="fa fa-user"></i><span>Meus dados pessoais</span></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <ul class="myaccount-link-list">
                            <li><a href="/minha-conta/discount" title="Cupons de desconto"><i class="fa fa-barcode"></i><span>Meus vales</span></a></li>
                            <!-- MODULE WishList -->
                            <li class="lnk_wishlist">
                                <a href="/minha-conta/module/blockwishlist/mywishlist" title="Minhas listas de presentes">
                                <i class="fa fa-heart"></i>
                                <span>Minhas listas de presentes</span>
                                </a>
                            </li>
                            <!-- END : MODULE WishList -->
                        </ul>
                    </div>
                </div>
                <ul class="footer_links clearfix">
                    <li class="pull-left"><a class="btn btn-outline button button-small btn-sm" href="http://demo4leotheme.com/prestashop/shopping/" title="In&iacute;cio"><span><i class="fa fa-home"></i> In&iacute;cio</span></a></li>
                </ul>
            </section>
        </div>
    </div>
</section>