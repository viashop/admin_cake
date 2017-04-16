<?php foreach ($res_produto as $key => $produto); ?>

<script type="text/javascript">
    // <![CDATA[
        var current_link = "../index.html";
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
                text_warning_select: "Por favor, selecione um para remover?",
                text_confirm_remove: "Tem certeza que deseja remover do rodapé?",
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
                <a class="home" href="http://<?php echo env('HTTP_HOST'); ?>" title="Return to Home">Home</a>
                <span class="navigation-pipe" >/</span>
                <a href="../3-women.html" title="Women">Women</a><span class="navigation-pipe">/</span><a href="../4-beauty-health.html" title="Beauty &amp; Health">Beauty &amp; Health</a><span class="navigation-pipe">/</span><?php echo @$produto['ShopProduto']['nome']; ?>
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
                    <div itemscope itemtype="http://schema.org/Product">
                        <div class="primary_block row">
                            <div class="container">
                                <div class="top-hr"></div>
                            </div>
                            <!-- left infos-->  
                            <div class="pb-left-column col-xs-12 col-sm-4 col-md-5">
                                <!-- product img-->        
                                <div id="image-block" class="clearfix">
                                    <span class="new-box">
                                    <span class="new-label product-label">Novo</span>
                                    </span>
                                    <span class="discount">Redução de preço!</span>
                                    <span id="view_full_size">

                                    <?php
                                    $img_posicao_0 = $res_imagens;
                                    rsort ($img_posicao_0);
                                    foreach ($img_posicao_0 as $key => $imagem_0); 
                                    ?>                                        
                                   
                                    <a class="jqzoom" title="Colourblock Bowler" rel="gal1" href="<?php echo CDN_LOJA .'produto/'. $id_produto .'/thickbox/'. $imagem_0['ShopProdutoImagem']['nome_imagem']; ?>" itemprop="url">

                                    <img itemprop="image" src="<?php echo CDN_LOJA .'produto/'. $id_produto .'/large/'. $imagem_0['ShopProdutoImagem']['nome_imagem']; ?>" title="Colourblock Bowler" alt="Colourblock Bowler"/>

                                    </a>

                                    </span>
                                </div>
                                <!-- end image-block -->
                                <!-- thumbnails -->
                                <div id="views_block" class="clearfix ">
                                    <div id="thumbs_list">
                                        <ul id="thumbs_list_frames">

                                            <?php
                                            foreach ($res_imagens as $key => $imagem):                                                 
                                            ?>                                          

                                            <li  style="margin:5px;" id="thumbnail_<?php echo $imagem['ShopProdutoImagem']['id_imagem']; ?>">
                                                <a href="javascript:void(0);" rel="{gallery: 'gal1', smallimage: '<?php echo CDN_LOJA .'produto/'. $id_produto .'/large/'. $imagem['ShopProdutoImagem']['nome_imagem']; ?>',largeimage: '<?php echo CDN_LOJA .'produto/'. $id_produto .'/thickbox/'. $imagem['ShopProdutoImagem']['nome_imagem']; ?>'}" title="Colourblock Bowler">
                                                <img class="img-responsive" id="thumb_<?php echo $imagem['ShopProdutoImagem']['id_imagem']; ?>" src="<?php echo CDN_LOJA .'produto/'. $id_produto .'/cart/'. $imagem['ShopProdutoImagem']['nome_imagem']; ?>" alt="Colourblock Bowler" title="Colourblock Bowler" height="80" width="80" itemprop="image" />
                                                </a>
                                            </li>

                                            <?php endforeach ?>

                                            
                                        </ul>
                                    </div>
                                    <!-- end thumbs_list -->
                                </div>

                                <!-- end views-block -->
                                <!-- end thumbnails -->
                                <p class="resetimg clear no-print">
                                    <span id="wrapResetImages" style="display: none;">
                                    <a href="17-shoulder-bag.html" name="resetImages">
                                    <i class="icon-repeat"></i>
                                    Exibir todas as imagens
                                    </a>
                                    </span>
                                </p>
                            </div>
                            <!-- end pb-left-column -->
                            <!-- end left infos--> 
                            <!-- center infos -->
                            <div class="pb-center-column col-xs-12 col-sm-7 col-md-6">
                                <h1 itemprop="name"><?php echo @$produto['ShopProduto']['nome']; ?></h1>
                                <p class="socialsharing_product list-inline no-print">
                                    <button type="button" class="btn btn-default btn-twitter" onclick="socialsharing_twitter_click('Dummy%20text%20of%20the%20printing%20and%20typesetting%20http/www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/17-shoulder-bag.2b8.del');">
                                        <i class="icon-twitter"></i> Tweet
                                        <!-- <img src="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/modules/socialsharing/img/twitter.gif" alt="Tweet" /> -->
                                    </button>
                                    <button type="button" class="btn btn-default btn-facebook" onclick="socialsharing_facebook_click();">
                                        <i class="icon-facebook"></i> Compartilhar
                                        <!-- <img src="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/modules/socialsharing/img/facebook.gif" alt="Facebook Like" /> -->
                                    </button>
                                    <button type="button" class="btn btn-default btn-google-plus" onclick="socialsharing_google_click();">
                                        <i class="icon-google-plus"></i> Google+
                                        <!-- <img src="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/modules/socialsharing/img/google.gif" alt="Google Plus" /> -->
                                    </button>
                                    <button type="button" class="btn btn-default btn-pinterest" onclick="socialsharing_pinterest_click('../../146-thickbox_default/shoulder-bag.jpg');">
                                        <i class="icon-pinterest"></i> Pinterest
                                        <!-- <img src="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/modules/socialsharing/img/pinterest.gif" alt="Pinterest" /> -->
                                    </button>
                                </p>
                                <div id="product_comments_block_extra" class="no-print" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                    <div class="comments_note">
                                        <span>Avaliação&nbsp;</span>
                                        <div class="star_content clearfix">
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <div class="star star_on"></div>
                                            <meta itemprop="worstRating" content = "0" />
                                            <meta itemprop="ratingValue" content = "5" />
                                            <meta itemprop="bestRating" content = "5" />
                                        </div>
                                    </div>
                                    <!-- .comments_note -->
                                    <ul class="comments_advices">
                                        <li>
                                            <a href="#idTab5" class="reviews">
                                            Comentários (<span itemprop="reviewCount">1</span>)
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--  /Module ProductComments -->							<!-- usefull links-->
                                <ul id="usefull_link_block" class="clearfix no-print">
                                    <li class="sendtofriend">
                                        <a id="send_friend_button" href="#send_friend_form">
                                        Endique
                                        </a>
                                        <div style="display: none;">
                                            <div id="send_friend_form">
                                                <h2  class="page-subheading">
                                                    Enviar a um amigo
                                                </h2>
                                                <div class="row">
                                                    <div class="product clearfix col-xs-12 col-sm-6">
                                                        <img src="../../146-home_default/shoulder-bag.jpg" height="250" width="250" alt="<?php echo @$produto['ShopProduto']['nome']; ?>" />
                                                        <div class="product_desc">
                                                            <p class="product_name">
                                                                <strong><?php echo @$produto['ShopProduto']['nome']; ?></strong>
                                                            </p>
                                                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        </div>
                                                    </div>
                                                    <!-- .product -->
                                                    <div class="send_friend_form_content col-xs-12 col-sm-6" id="send_friend_form_content">
                                                        <div id="send_friend_form_error"></div>
                                                        <div id="send_friend_form_success"></div>
                                                        <div class="form_container">
                                                            <p class="intro_form">
                                                                Destinatário :
                                                            </p>
                                                            <p class="text">
                                                                <label for="friend_name">
                                                                Nome de seu amigo <sup class="required">*</sup> :
                                                                </label>
                                                                <input id="friend_name" name="friend_name" type="text" value=""/>
                                                            </p>
                                                            <p class="text">
                                                                <label for="friend_email">
                                                                Endereço do seu amigo E-mail <sup class="required">*</sup> :
                                                                </label>
                                                                <input id="friend_email" name="friend_email" type="text" value=""/>
                                                            </p>
                                                            <p class="txt_required">
                                                                <sup class="required">*</sup> Os campos obrigatórios
                                                            </p>
                                                        </div>
                                                        <p class="submit">
                                                            <button id="sendEmail" class="btn button button-small" name="sendEmail" type="submit">
                                                            <span>Enviar</span>
                                                            </button>&nbsp;
                                                            ou&nbsp;
                                                            <a class="closefb" href="#">
                                                            Cancelar
                                                            </a>
                                                        </p>
                                                    </div>
                                                    <!-- .send_friend_form_content -->
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="print">
                                        <a href="javascript:print();">
                                        Imprimir
                                        </a>
                                    </li>
                                </ul>
                                <p id="product_reference">
                                    <label>Código: </label>
                                    <span class="editable" itemprop="sku"><?php echo @$produto['ShopProduto']['sku']; ?></span>
                                </p>
                                <p id="product_condition">
                                    <label>Condições: </label>
                                    <link itemprop="itemCondition" href="http://schema.org/NewCondition"/>
                                    <span class="editable"><?php

                                    if ($produto['ShopProduto']['usado'] == 'True') {
                                        echo 'USADO';
                                    } else {
                                        echo 'NOVO';
                                    }

                                    ?></span>
                                </p>
                                <div id="short_description_block">
                                    <div id="short_description_content" class="rte align_justify" itemprop="description">
                                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    </div>
                                    <p class="buttons_bottom_block">
                                        <a href="javascript:{}" class="button">
                                        Mais detalhes
                                        </a>
                                    </p>
                                    <!---->
                                </div>
                                <!-- end short_description_block -->
                                <!-- number of item in stock -->
                                <p id="pQuantityAvailable">

                                    <span id="quantityAvailable"><?php echo @$produto['ShopProduto']['quantidade']; ?></span>

                                    <?php if ($produto['ShopProduto']['quantidade'] == 1): ?>
                                    <span  id="quantityAvailableTxt">Item</span>
                                        
                                    <?php else: ?>

                                    <span  id="quantityAvailableTxtMultiple">Itens</span>

                                    <?php endif ?>                                    
                                    
                                </p>
                                <!-- availability -->
                                <p id="availability_statut" style="display: none;">
                                    <span id="availability_value"></span>
                                </p>

                                <?php if ($produto['ShopProduto']['quantidade'] == 1): ?>

                                <p class="warning_inline" id="last_quantities">Aviso: Último produto em estoque!</p>

                                <?php elseif ($produto['ShopProduto']['quantidade'] <= 0): ?>                               

                                <p id="availability_date">
                                    <span id="availability_date_label">Data de disponibilidade:</span>
                                    <span id="availability_date_value">00/00/0000</span>
                                </p>

                                <?php endif ?>

                                <!-- Out of stock hook -->
                                <div id="oosHook" style="display: none;">
                                </div>
                                <!-- pb-right-column-->
                                <div class="pb-right-column">
                                    <!-- add to cart form-->
                                    <form id="buy_block" action="http://www.demo4leotheme.com/prestashop/leo_styleshop_demo/en/cart" method="post">
                                        <!-- hidden datas -->
                                        <p class="hidden">
                                            <input type="hidden" name="token" value="44910e3fef2e6289478d4e04564cc8c5" />
                                            <input type="hidden" name="id_product" value="17" id="product_page_product_id" />
                                            <input type="hidden" name="add" value="1" />
                                            <input type="hidden" name="id_product_attribute" id="idCombination" value="" />
                                        </p>
                                        <div class="box-info-product">
                                            <div class="content_prices clearfix">
                                                <!-- prices -->
                                                <div class="price">
                                                    <p id="reduction_percent">
                                                        <span id="reduction_percent_display">
                                                        -9%                                 </span>
                                                    </p>
                                                    <p id="reduction_amount"  style="display:none">
                                                        <span id="reduction_amount_display">
                                                        </span>
                                                    </p>
                                                    <p id="old_price">
                                                        <span id="old_price_display">R$ 244,00</span>
                                                        <!--  -->
                                                    </p>


                                                    <p class="our_price_display" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                        <link itemprop="availability" href="http://schema.org/InStock"/>
                                                        <span id="our_price_display" itemprop="price">R$ 222,04</span>
                                                        <!---->
                                                        <meta itemprop="priceCurrency" content="USD" />
                                                    </p>
                                                    
                                                </div>
                                                <!-- end prices -->
                                                <div class="clear"></div>
                                            </div>
                                            <!-- end content_prices -->
                                            <div class="product_attributes clearfix">
                                                <!-- quantity wanted -->
                                                <p id="quantity_wanted_p">
                                                    <label>Quantidade</label>
                                                    <input type="text" name="qty" id="quantity_wanted" class="text" value="1" />
                                                    <a href="#" data-field-qty="qty" class="btn btn-default button-minus product_quantity_down">
                                                    <span><i class="icon-minus"></i></span>
                                                    </a>
                                                    <a href="#" data-field-qty="qty" class="btn btn-default button-plus product_quantity_up">
                                                    <span><i class="icon-plus"></i></span>
                                                    </a>
                                                    <span class="clearfix"></span>
                                                </p>
                                                <!-- minimal quantity wanted -->
                                                <p id="minimal_quantity_wanted_p" style="display: none;">
                                                    Este produto não é vendido individualmente. Você deve selecionar pelo menos <b id="minimal_quantity_label">1</b> quantidade para este produto.
                                                </p>
                                            </div>
                                            <!-- end product_attributes -->
                                            <div class="box-cart-bottom">
                                                <div>
                                                    <p id="add_to_cart" class="buttons_bottom_block no-print">
                                                        <button type="submit" name="Submit" class="exclusive">
                                                        <span>Adicionar ao carrinho</span>
                                                        </button>
                                                    </p>
                                                </div>
                                                <p class="buttons_bottom_block no-print">
                                                    <a id="wishlist_button" href="#" onclick="WishlistCart('wishlist_block_list', 'add', '17', $('#idCombination').val(), document.getElementById('quantity_wanted').value); return false;" rel="nofollow"  title="Add to my wishlist">
                                                    Adicionar à lista de desejos
                                                    </a>
                                                </p>
                                                <!-- Productpaymentlogos module -->
                                                <div id="product_payment_logos">
                                                    <div class="box-security">
                                                        <h5 class="product-heading-h5"></h5>
                                                        <img src="../../modules/productpaymentlogos/img/payment-logo.png" alt="" class="img-responsive" />
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
                            <!-- end center infos-->
                        </div>
                        <!-- end primary_block -->
                        <div class="tabs-group">
                            <script type="text/javascript">
                                $(document).ready(function(){
                                		$('.page-product-heading li:first, .tab-content section:first').addClass('active');
                                	});
                            </script>
                            <ul class="nav nav-tabs tab-info page-product-heading">
                                <li><a href="#tab2" data-toggle="tab">Mais informações</a></li>
                                <li><a href="#idTab5" data-toggle="tab">Comentários</a></li>
                            </ul>
                            <div class="tab-content">
                                <!-- More info -->
                                <section id="tab2" class="tab-pane page-product-box active">
                                    <!-- full description -->
                                    <div  class="rte">
                                        <p>Etiam tincidunt mi a dui dapibus convallis in in orci. Vivamus ultrices quam vitae nibh aliquet lobortis. Morbi sit amet tristique felis. Aenean tellus nulla, facilisis eget porta non, volutpat at ligula. Praesent eu nisi leo. Proin mollis libero quis enim vehicula aliquet. Quisque tempus, nisi at molestie bibendum, nulla leo dignissim nulla, et dictum magna sapien a orci. Integer ultrices nulla et turpis posuere at rutrum metus sollicitudin.</p>
                                        <p>Aenean consequat sagittis lacinia. Praesent mollis tincidunt risus, quis dictum ante scelerisque vel. Lorem Ipsum is simply <?php echo @$produto['ShopProduto']['nome']; ?> industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>
                                    </div>
                                </section>
                                <!--end  More info -->
                                <!--HOOK_PRODUCT_TAB -->		
                                <session id="idTab5" class="tab-pane page-product-box">
                                    <div id="product_comments_block_tab">
                                        <div class="comment row" itemprop="review" itemscope itemtype="http://schema.org/Review">
                                            <div class="comment_author col-sm-2 col-md-2">
                                                <span>Grade&nbsp;</span>
                                                <div class="star_content clearfix"  itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                                    <div class="star star_on"></div>
                                                    <div class="star star_on"></div>
                                                    <div class="star star_on"></div>
                                                    <div class="star star_on"></div>
                                                    <div class="star star_on"></div>
                                                    <meta itemprop="worstRating" content = "0" />
                                                    <meta itemprop="ratingValue" content = "5" />
                                                    <meta itemprop="bestRating" content = "5" />
                                                </div>
                                                <div class="comment_author_infos">
                                                    <strong itemprop="author">John D</strong>
                                                    <meta itemprop="datePublished" content="2014-04-22" />
                                                    <em>04/22/2014</em>
                                                </div>
                                            </div>
                                            <!-- .comment_author -->
                                            <div class="comment_details col-sm-10 col-md-10">
                                                <p itemprop="name" class="title_block">
                                                    <strong>Nineties revival</strong>
                                                </p>
                                                <p itemprop="reviewBody">Nineties revival reigns supreme with the spaghetti-strap slip dress stealing the what’s hot top spot.</p>
                                                <ul>
                                                </ul>
                                            </div>
                                            <!-- .comment_details -->
                                        </div>
                                        <!-- .comment -->
                                    </div>
                                    <!-- #product_comments_block_tab -->
                                </session>
                                <!-- Fancybox -->
                                <div style="display: xnone;">
                                    <div id="new_comment_form">
                                        <form id="id_new_comment_form" action="#">
                                            <h2 class="page-subheading">
                                                Escreva um comentário
                                            </h2>
                                            <div class="row">
                                                <div class="product clearfix  col-xs-12 col-sm-6">
                                                    <img src="../../146-medium_default/shoulder-bag.jpg" height="125" width="125" alt="<?php echo @$produto['ShopProduto']['nome']; ?>" />
                                                    <div class="product_desc">
                                                        <p class="product_name">
                                                            <strong><?php echo @$produto['ShopProduto']['nome']; ?></strong>
                                                        </p>
                                                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                    </div>
                                                </div>
                                                <div class="new_comment_form_content col-xs-12 col-sm-6">
                                                    <h2>Escreva um comentário</h2>
                                                    <div id="new_comment_form_error" class="error" style="display: xnone; padding: 15px 25px">
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
                                                    Título: <sup class="required">*</sup>
                                                    </label>
                                                    <input id="comment_title" name="title" type="text" value=""/>
                                                    <label for="content">
                                                    Comentário <sup class="required">*</sup>
                                                    </label>
                                                    <textarea id="content" name="content"></textarea>
                                                    <div id="new_comment_form_footer">
                                                        <input id="id_product_comment_send" name="id_product" type="hidden" value='17' />
                                                        <p class="fl required"><sup>*</sup> Campos obrigatórios</p>
                                                        <p class="fr">
                                                            <button id="submitNewMessage" name="submitMessage" type="submit" class="btn button button-small">
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
                                <!--end HOOK_PRODUCT_TAB -->
                                <!-- description & features -->
                            </div>
                        </div>
                    </div>
                    <!-- itemscope product wrapper -->
                </div>
            </section>
        </div>
    </div>
</section>