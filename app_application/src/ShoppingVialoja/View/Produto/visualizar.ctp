<section id="columns" class="columns-container">
    <div class="container">
        <div class="row">
            <div id="top_column" class="center_column col-xs-12 col-sm-12 col-md-12">
            </div>
        </div>
        <div class="row">
            <!-- Center -->
            <section id="center_column" class="col-md-9">
                <div id="breadcrumb" class="clearfix">
                    <!-- Breadcrumb -->
                    <div class="breadcrumb clearfix">
                        <a rel="nofollow" class="home" href="<?php echo FULL_BASE_URL; ?>" title="Voltar para a Página Inicial"><i class="fa fa-home"></i></a>
                        <span class="navigation-pipe" >/</span>

                        <?php if (!empty($atividade_shop_breadcrumb_nome)): ?>
                        <a href="<?php printf('%s/c/%s/%d/', FULL_BASE_URL, \Lib\Tools::slug( $atividade_shop_breadcrumb_nome ), $atividade_shop_breadcrumb_id ); ?>" title="<?php echo $atividade_shop_breadcrumb_nome ?>"><?php echo $atividade_shop_breadcrumb_nome ?></a>
                        <span class="navigation-pipe">/</span>
                        <?php endif ?>

                        <?php 

                        echo $categoria_loja_breadcrumb;
                        echo $nome; 

                        ?>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <div class="primary_block row" itemscope itemtype="http://schema.org/Product">
                    <div class="container">
                        <div class="top-hr"></div>
                    </div>
                    <!-- left infos-->  
                    <div class="pb-left-column col-xs-12 col-sm-12 col-md-5">
                        <!-- product img-->        
                        <div id="image-block" class="clearfix">
                            <span id="view_full_size">
                            <a class="jqzoom" title="<?php echo $nome; ?>" rel="gal1" href="<?php echo $img_thickbox ?>" itemprop="url">
                                <img itemprop="image" src="<?php echo $img_large ?>" title="<?php echo $nome ?>" alt="<?php echo $nome ?>"/>
                            </a>
                            </span>
                        </div>
                        <!-- end image-block -->
                        <!-- thumbnails -->
                        <div id="views_block" class="clearfix ">

                            <!--
                            <span class="view_scroll_spacer">
                            <a id="view_scroll_left" class="" title="Outras visualizações" href="javascript:{}">
                            Anterior
                            </a>
                            </span>
                            -->
                            <div id="thumbs_list">
                
                                <ul id="thumbs_list_frame">

                                    <?php foreach ($array_thumbs_produto as $key => $thumb): ?>
                                   
                                        <?php if ($thumb['posicao'] <=0): ?>
                                        <li id="thumbnail_<?php echo $thumb['posicao']; ?>" class="last">    
                                        <?php else: ?>
                                        <li id="thumbnail_<?php echo $thumb['posicao']; ?>">
                                        <?php endif ?>
                                       
                                            <a  href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?php echo $thumb['img_large']; ?>',largeimage: '<?php echo $thumb['img_thickbox']; ?>'}" title="<?php echo $nome ?>">
                                            <img class="img-responsive" id="thumb_<?php echo $thumb['posicao']; ?>" src="<?php echo $thumb['img_cart']; ?>" alt="<?php echo $nome ?>" title="<?php echo $nome ?>" itemprop="image" />
                                            </a>
                                        </li>                                 

                                    <?php endforeach ?>

                                </ul>

                            </div>
                            <!-- end thumbs_list -->
                            <!--
                            <a id="view_scroll_right" title="Outras visualizações" href="javascript:{}">
                            Próximo
                            </a>
                            -->
                        </div>

                        <?php /*
                        <!-- end views-block -->
                        <!-- end thumbnails -->
                        <p class="resetimg clear no-print">
                            <span id="wrapResetImages" style="display: none;">
                            <a href="<?php echo $url_produto_canonical; ?>" name="resetImages">
                            <i class="fa fa-repeat"></i>
                            Mostrar todas as imagens
                            </a>
                            </span>
                        </p>

                        */ ?>
                    </div>
                    <!-- end pb-left-column -->
                    <!-- end left infos--> 
                    <!-- center infos -->
                    <div class="pb-center-column col-xs-12 col-sm-6 col-md-4">
                        <h1 itemprop="name"><?php echo $nome; ?></h1>

                        <!-- Out of stock hook -->
                        <div id="oosHook" style="display: none;">
                        </div>
                        <p class="socialsharing_product list-inline no-print">
                            <button type="button" class="btn btn-outline btn-twitter" onclick="socialsharing_twitter_click('<?php echo $nome . " ". $url_produto_canonical; ?>');">
                                <i class="fa fa-twitter"></i> Twitter
                            </button>
                            <button type="button" class="btn btn-outline btn-facebook" onclick="socialsharing_facebook_click();">
                                <i class="fa fa-facebook"></i> Facebook
                            </button>
                            <button type="button" class="btn btn-outline btn-google-plus" onclick="socialsharing_google_click();">
                                <i class="fa fa-google-plus"></i> Google+
                            </button>
                            <button type="button" class="btn btn-outline btn-pinterest" onclick="socialsharing_pinterest_click();">
                                <i class="fa fa-pinterest"></i> Pinterest
                            </button>
                        </p>
                        <p id="loja_reference">
                            <label>loja </label>
                            <span><a href="#" rel="nofollow" class="blue" target="_BLANK"><?php echo $nome_loja; ?></a></span>
                        </p>

                        <?php if ($marca != 0): ?>
                            
                         <p id="marca_reference">
                            <label>Marca </label>
                            <span><?php echo $marca; ?></span>
                        </p>
                            
                        <?php endif ?>                       
                     
                        <p id="product_condition"> 

                            <span class="text-info">                     

                            <?php 
                            if ($usado !== 'True') {
                                echo 'Novo';
                            } else {
                                echo 'Usado';
                            }
                            ?>
                            </span>                           
                        </p>
                        <div id="short_description_block">
                            <div id="short_description_content" class="rte align_justify" itemprop="description">
                                <p>
                                <?php
                                if (!empty($description)) {
                                    echo \Lib\Tools::formatList( $description, 255);
                                } elseif (!empty($descricao_completa)){
                                    echo \Lib\Tools::formatList( $descricao_completa, 255);
                                }
                                ?>
                                &nbsp;&nbsp;
                                <a href="<?php echo $url_produto_loja; ?>" rel="nofollow" title="Ver mais detalhes" target="_blank"> [+]</a> 
                                </p>
                            </div>
                            <!-- 						<p class="buttons_bottom_block">
                                <a href="javascript:{}" class="button btn btn-outline">
                                	Mais detalhes
                                </a>
                                </p>
                                -->
                            <!---->
                        </div>

                        <!-- end short_description_block -->
                        <!-- number of item in stock -->
                        <?php if (isset($gerenciado) && $gerenciado =='True'): ?>
                           
                            <p>

                                <?php if ($situacao_sem_estoque=='-1'): ?>
                                    <span style="color:red;">Este produto está indisponível</span>
                                <?php elseif($situacao_sem_estoque==0 && $quantidade <=0): ?>

                                    <span style="color:red;"><?php echo \Commons\SituacaoProdutoEstoque::disponibilidade($situacao_em_estoque); ?></span>

                                <?php elseif ($quantidade > 0): ?>
                                    
                                    <?php if ($quantidade==='1'): ?>
                                        <span><?php echo $quantidade; ?></span>
                                        <span>Item</span>
                                    <?php else: ?>
                                        <span><?php echo $quantidade; ?></span>
                                        <span>Itens</span>
                                    <?php endif ?>

                                    <span class="text-info">em estoque</span> 

                                    <?php if ($quantidade <= 10): ?>
                                         <p style="color:red;"><strong>Atenção:</strong> Últimas unidades!</p>
                                    <?php endif ?>

                                    <?php if ($situacao_em_estoque>0): ?>
                                        
                                        <p>
                                            <span><?php echo \Commons\SituacaoProdutoEstoque::disponibilidade($situacao_em_estoque); ?></span>
                                        </p>
                                        
                                    <?php endif ?>

                                <?php endif ?>

                            </p>
                            
                        <?php else: ?>

                            <?php if ($situacao_em_estoque <= 0): ?>

                            <!-- end short_description_block -->
                            <!-- number of item in stock -->
                            <p>
                                <span class="text-info">
                                    Produto em Estoque                            
                                </span>                           
                            </p>

                            <p style="color:red;"><strong>Atenção:</strong> Últimas unidades!</p>

                            <p>
                                <span><?php echo \Commons\SituacaoProdutoEstoque::disponibilidade($situacao_em_estoque); ?></span>
                            </p>

                            <?php else: ?>

                            <p>
                                <span style="color:red;"><?php echo \Commons\SituacaoProdutoEstoque::disponibilidade($situacao_em_estoque); ?></span>
                            </p>
                                
                            <?php endif ?>

                        <?php endif ?>
                        
                        <!-- Out of stock hook -->
                        <div id="oosHook" style="display: none;">
                        </div>

                        <!--  /Module ProductComments -->							<!-- usefull links-->
                        <ul id="usefull_link_block" class="clearfix no-print">
                      
                            <li class="print">
                                <a href="javascript:print();">
                                Imprimir
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end center infos-->
                    <!-- pb-right-column-->
                    <div class="pb-right-column col-xs-12 col-sm-6 col-md-3">
                        <!-- add to cart form-->
                        <form id="buy_block" action="http://demo4leotheme.com/prestashop/shopping/br/cart" method="post">
                            <!-- hidden datas -->
                            <p class="hidden">
                                <input type="hidden" name="token" value="c0b3b2573da6513d5d166afa8159f33b" />
                                <input type="hidden" name="id_product" value="2" id="product_page_product_id" />
                                <input type="hidden" name="add" value="1" />
                                <input type="hidden" name="id_product_attribute" id="idCombination" value="" />
                            </p>                            

                            <div class="box-info-product">
                                <div class="content_prices clearfix">
                                    <!-- prices -->
                                    <div class="price" >

                                        <?php if ($oferta === true): ?>

                                        <p class="our_price_display" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                            <link itemprop="availability" href="http://schema.org/InStock"/>
                                            <span itemprop="price">R$ <?php echo \Lib\Tools::convertToDecimalBR($preco_promocional); ?></span>
                                            <!---->
                                            <meta itemprop="priceCurrency" content="BRL" />
                                        </p>                                        

                                        <p id="reduction_percent">
                                            <span id="reduction_percent_display" style="color:#fff;">
                                                -<?php echo \Lib\Tools::discountPercentageValue($preco_cheio, $preco_promocional); ?>%
                                            </span>
                                        </p>
                                        <p id="old_price">
                                            <span id="old_price_display">R$ <?php echo \Lib\Tools::convertToDecimalBR($preco_cheio); ?></span>
                                            <!--  -->
                                        </p>

                                        <?php else: ?>

                                        <p class="our_price_display" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                            <link itemprop="availability" href="http://schema.org/InStock"/>

                                            <?php if (isset($preco_cheio) && $preco_cheio > 0) : ?>

                                            <span itemprop="price">R$ <?php echo \Lib\Tools::convertToDecimalBR($preco_cheio); ?></span>
                                            <!---->
                                            <meta itemprop="priceCurrency" content="BRL" />

                                            <?php else: ?>

                                            <span itemprop="price">Preço Sob Consulta</span>
                                                
                                            <?php endif ?>

                                        </p> 
                                            
                                        <?php endif ?>

                                    </div>
                                    <!-- end prices -->
                                    <p id="reduction_amount"  style="display:none">
                                        <span id="reduction_amount_display">
                                        </span>
                                    </p>
                                    <div class="clear"></div>
                                </div>

                                <?php /*
                                <!-- end content_prices -->
                                <div class="product_attributes clearfix">
                                 
                            
                                    <!-- attributes -->
                                    <div id="attributes">
                                        <div class="clearfix"></div>
                                        <fieldset class="attribute_fieldset">
                                            <label class="attribute_label" for="group_1">Tamanho :&nbsp;</label>
                                            <div class="attribute_list">
                                                <select class="form-control attribute_select no-print" name="group_1" id="group_1">
                                                    <option value="1" selected="selected" title="S">S</option>
                                                    <option value="2" title="M">M</option>
                                                    <option value="3" title="L">L</option>
                                                </select>
                                            </div>
                                            <!-- end attribute_list -->
                                        </fieldset>
                                        <fieldset class="attribute_fieldset">
                                            <label class="attribute_label" >Cor :&nbsp;</label>
                                            <div class="attribute_list">
                                                <ul id="color_to_pick_list" class="clearfix">
                                                    <li>
                                                        <a href="<?php echo $url_produto_canonical; ?>" id="color_8" name="White" class="color_pick" style="background:#ffffff;" title="White">
                                                        </a>
                                                    </li>
                                                    <li class="selected">
                                                        <a href="<?php echo $url_produto_canonical; ?>" id="color_11" name="Black" class="color_pick selected" style="background:#434A54;" title="Black">
                                                        </a>
                                                    </li>
                                                </ul>
                                                <input type="hidden" class="color_pick_hidden" name="group_3" value="11" />
                                            </div>
                                            <!-- end attribute_list -->
                                        </fieldset>
                                    </div>
                                    <!-- end attributes -->
                                </div>
                                <!-- end product_attributes -->
                                */ ?>

                                <div class="box-cart-bottom">
                                    <div >
                                        <p class="buttons_bottom_block no-print">                                        

                                            <a href="<?php echo $url_produto_loja; ?>" rel="nofollow" title="Visite a Loja" target="_blank" class="exclusive btn btn-outline visit-store-url btn-sm">
                                                <span>visite a loja </span> <i class="fa fa-arrow-right fa-1x"></i>   
                                            </a>                                     
                                        </p>
                                    </div>


                                    <?php /* ?>
                                        
                                   

                                    <p class="buttons_bottom_block no-print">
                                        <a id="wishlist_button" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '2', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" rel="nofollow"  title="Adicionar à lista de presentes">
                                        Adicionar à lista de presentes
                                        </a>
                                    </p>

                                     <?php */ ?>

                                    <!-- Productpaymentlogos module -->
                                    <div id="product_payment_logos">
                                        <div class="box-security" style="margin: 20px auto" >
                                            <center>
                                                <h5 class="product-heading-h5"></h5>

                                                <?php foreach ($res_pagamentos as $key => $pagamento):

                                                    if ($pagamento['ShopPagamento']['ativo'] == 'True'):

                                                        if (\Commons\FormaPagamentoLoja::formaAtiva($pagamento) === true): ?>

                                                        <img src="<?php echo CDN_IMG ?>formas-de-pagamento/<?php echo  $pagamento['ConfiguracaoPagamento']['logo']; ?>" alt="" class="img-responsive" />
                                                        <hr size='1'>  

                                                        <?php endif;
                                                        
                                                    endif;
                                                   
                                                endforeach; ?>

                                            </center>

                                           <?php  //pr($res_pagamentos); ?>
                                        </div>
                                    </div>
                                    <!-- /Productpaymentlogos module -->
                                    <strong></strong>
                                </div>
                                <!-- end box-cart-bottom -->
                            </div>
                            <!-- end box-info-product -->
                        </form>
                    </div>
                    <!-- end pb-right-column-->
                </div>
                <!-- end primary_block -->

                <!-- More info -->
                <section class="page-product-box">
                    <h3 class="page-subheading">MAIS INFORMAÇÕES</h3>
                    <!-- full description -->
                    <div  class="rte">
                        <p>
                            <?php 

                            if (!empty($descricao_completa)){
                                echo $descricao_completa;

                                echo '&nbsp;&nbsp;<a href="'. $url_produto_loja .'" rel="nofollow" title="Ver mais detalhes" target="_blank"> [+]</a>';
                            } else {
                                echo 'Não há informações relevantes deste produto neste momento.';
                            }
                            ?>
                            
                        </p>
                    </div>
                </section>
                <!--end  More info -->
                <!--HOOK_PRODUCT_TAB -->
                <section class="page-product-box">
                    <h3 id="#idTab5" class="idTabHrefShort page-subheading">Comentários</h3>
                    <session id="idTab5" class="tab-pane page-product-box">
                        <div id="product_comments_block_tab">
                            <p class="align_center">Não há comentários de clientes neste momento.</p>
                        </div>
                        <!-- #product_comments_block_tab -->
                    </session>
                    <!-- Fancybox -->
                    <div style="display: none;">
                        <div id="new_comment_form">
                            <form id="id_new_comment_form" action="#">
                                <h2 class="page-subheading">
                                    Escrever uma avaliação
                                </h2>
                                <div class="row">
                                    <div class="product clearfix  col-xs-12 col-sm-6">
                                        <img src="http://demo4leotheme.com/prestashop/shopping/7-medium_default/blouse.jpg" height="125" width="125" alt="Printed Summer Dress" />
                                        <div class="product_desc">
                                            <p class="product_name">
                                                <strong>Printed Summer Dress</strong>
                                            </p>
                                            <p>Sleeveless knee-length chiffon dress. V-neckline with elastic under the bust lining.</p>
                                        </div>
                                    </div>
                                    <div class="new_comment_form_content col-xs-12 col-sm-6">
                                        <h2>Escrever uma avaliação</h2>
                                        <div id="new_comment_form_error" class="error" style="display: none; padding: 15px 25px">
                                            <ul></ul>
                                        </div>
                                        <ul id="criterions_list">
                                            <li>
                                                <label>Qualidade:</label>
                                                <div class="star_content">
                                                    <input class="star" type="radio" name="criterion[1]" value="1" />
                                                    <input class="star" type="radio" name="criterion[1]" value="2" />
                                                    <input class="star" type="radio" name="criterion[1]" value="3" checked="checked" />
                                                    <input class="star" type="radio" name="criterion[1]" value="4" />
                                                    <input class="star" type="radio" name="criterion[1]" value="5" />
                                                </div>
                                                <div class="clearfix"></div>
                                            </li>
                                        </ul>
                                        <label for="comment_title">
                                        Titulos: <sup class="required">*</sup>
                                        </label>
                                        <input id="comment_title" name="title" type="text" value=""/>
                                        <label for="content">
                                        Comentários: <sup class="required">*</sup>
                                        </label>
                                        <textarea id="content" name="content"></textarea>
                                        <div id="new_comment_form_footer">
                                            <input id="id_product_comment_send" name="id_product" type="hidden" value='2' />
                                            <p class="fl required"><sup>*</sup> Campos Obrigatórios</p>
                                            <p class="fr">
                                                <button id="submitNewMessage" name="submitMessage" type="submit" class="btn button button-small btn-sm">
                                                <span>Enviar</span>
                                                </button>&nbsp;
                                                ou&nbsp;
                                                <a class="closefb" href="#">
                                                Cancelar
                                                </a>
                                            </p>
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- #new_comment_form_footer -->
                                    </div>
                                </div>
                            </form>
                            <!-- /end new_comment_form_content -->
                        </div>
                    </div>
                    <!-- End fancybox -->
                </section>
                <!--end HOOK_PRODUCT_TAB -->
                <!-- description & features -->
            </section>
            <!-- Right -->
            <section id="right_column" class="column sidebar col-md-3">
              
            
            </section>
        </div>
    </div>
</section>