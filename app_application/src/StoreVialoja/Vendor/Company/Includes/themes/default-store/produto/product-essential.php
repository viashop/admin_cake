<div class="product-essential">

    <div class="no-display">
        <input type="hidden" name="product" value="200" />
        <input type="hidden" name="related_product" id="related-products-field" value="" />
    </div>

    <div class="row">

        <?php

        echo $GLOBALS['html_images_produto'];

        //App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'produto'.DS.'produtct-image');
        ?>

        <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 product-shop">

            <div class="product-name">
                <h1>
                    <?php
                    if (isset($GLOBALS['ShopProduto']['nome'])) {
                        echo $GLOBALS['ShopProduto']['nome'];
                    }
                    ?>
                </h1>
            </div> 

            <?php if ($GLOBALS['Shop']['comentarios_produtos'] == 'True'): ?> 

            <div class="col-md-12 column">
                <div class="row clearfix">
                    <div class="ratings">
                        <p class="rating-links">                     
                            <?php echo \Lib\Tools::totalComentariosUrlFacebook(); ?> Comentários
                        </p>
                    </div>
                </div>
            </div>

            <?php endif ?>                  

            <?php
             /*
            <div class="ratings">
                <div class="rating-box">
                    <div class="rating" style="width:80%"></div>
                </div>
                <p class="rating-links">
                    <meta itemprop="rating" content="4"/>
                    <meta itemprop="count" content="1"/>
                    <a href="/superstore/index.php/review/product/list/id/200/category/38/">1 Reviews</a>
                    <span class="separator">|</span>
                    <a href="/superstore/index.php/review/product/list/id/200/category/38/#review-form">Add Your Review</a>
                </p>
            </div>

            */
            ?>

            <div class="col-md-12 produto_codigo_marca">
                <div class="row clearfix">
                    <div class="col-md-6">

                        <?php if (!empty($GLOBALS['ShopProduto']['sku'] )): ?>

                        <span class="cor-secundaria">
                            <b>Código: </b>
                            <span itemprop="sku"><?php echo $GLOBALS['ShopProduto']['sku']; ?></span>
                        </span>
                            
                        <?php endif ?>
                       
                    </div>

                    <?php if (\Lib\Validate::isNotNull($GLOBALS['marca'])): ?>

                    <div class="col-md-6 column">

                        <div class="product-brand" style="clear:both">

                            <span class="cor-secundaria" itemtype="http://schema.org/Brand" itemscope="itemscope" itemprop="brand">
                                <b>Marca: </b>

                                
                                    <a itemprop="name" href="<?php echo sprintf('%s/m/%s/%d/', FULL_BASE_URL, $GLOBALS['marca']['ShopMarca']['apelido'], $GLOBALS['marca']['ShopMarca']['id_marca'] ) ?>" title="<?php echo $GLOBALS['marca']['ShopMarca']['nome']; ?>"><?php echo $GLOBALS['marca']['ShopMarca']['nome']; ?></a>
                            </span>                    

                        </div>
                    </div>

                    <?php endif ?>

                </div>
            </div>

            <div class="col-md-12 produto_atributo">

                <div class="row clearfix">

                    <div class="principal">

                        <div class="atributos">
                            <div class="atributo-cor">
                                <span>
                                Selecione a opção de
                                <b class="cor-secundaria">Cor</b>:
                                </span>
                                <ul>
                                    <li>
                                        <a href="javascript:;" class="atributo-item" data-grade-id="8945" data-variacao-id="37063" data-pode-ter-imagens="true">
                                        <span style="border-color: #E06666;"  >
                                        </span>
                                        <i class="icon-remove hide"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="atributo-item" data-grade-id="8945" data-variacao-id="37069" data-pode-ter-imagens="true">
                                        <span style="border-color: #FFFF00;"  >
                                        </span>
                                        <i class="icon-remove hide"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="atributo-item" data-grade-id="8945" data-variacao-id="37096" data-pode-ter-imagens="true">
                                        <span style="border-color: #FFFFFF;"  >
                                        </span>
                                        <i class="icon-remove hide"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <script type="text/javascript"></script>
                            <div class="atributo-comum">
                                <span>
                                Selecione a opção de
                                <b class="cor-secundaria">Parte de Cima</b>:
                                </span>

                                <ul>
                                    <li>
                                        <a href="javascript:;" class="atributo-item" data-grade-id="47938" data-variacao-id="220552" data-pode-ter-imagens="false">
                                        <span>
                                        G
                                        </span>
                                        <i class="icon-remove hide"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="atributo-item" data-grade-id="47938" data-variacao-id="220553" data-pode-ter-imagens="false">
                                        <span>
                                        G1
                                        </span>
                                        <i class="icon-remove hide"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>            

                    </div>

                </div>

            </div>


            <div class="col-md-12 produto_preco">
                <div class="row clearfix" >
                    <div class="col-md-6">

                        <div class="price-box">

                            <?php

                            $preco_promocional = $GLOBALS['ShopProduto']['preco_promocional'];
                            $preco_cheio       = $GLOBALS['ShopProduto']['preco_cheio']; 
                            $preco_produto_final = $preco_cheio;

                            $oferta = \Lib\Validate::isValueBigger($preco_cheio, $preco_promocional);

                            if ($oferta ===true) {

                                /**
                                 * 
                                 * e é promoção muda o preço final
                                 * na variavel $preco_produto_final
                                 * para preço cheio, no calculos dos Correios
                                 * 
                                 */
                                $preco_produto_final = $preco_promocional;

                            ?>

                                    
                            <p class="old-price">
                                <span class="price-label">Preço normal:</span>
                                <span class="price" id="old-price-204">
                                    R$ <?php echo \Lib\Tools::convertToDecimalBR( $preco_cheio ) ?>
                                </span>
                            </p>

                            <p class="special-price">
                                <span class="price-label">Preço Especial</span>
                                <span class="price" id="product-price-204">
                                    R$ <?php echo \Lib\Tools::convertToDecimalBR( $preco_promocional ) ?>
                                </span>
                            </p>
                            <meta content="BRL" itemprop="currency"/>
                            <meta content="<?php echo \Lib\Tools::convertToDecimalBR( $preco_cheio ) ?>" itemprop="price"/>
                            
                            <?php } ?>

                            <div>
                                <span class="preco-parcela">
                                    até <strong class="cor-secundaria ">6x</strong> de
                                    <strong class="cor-secundaria">R$ 19,99</strong>
                                    <!--googleoff: all-->
                                    <span>sem juros</span>
                                    <!--googleon: all-->
                                </span>
                            </div>                                                
                
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="product-options-bottom">

                            <form action="<?php printf('//%s/checkout/carrinho/adicionar/id/%d/token/%s/', env('HTTP_HOST'), $GLOBALS['ShopProduto']['produto_id'], $GLOBALS['ShopProduto']['produto_key'] ); ?>" method="post">
                                <input type='hidden' name='CSRFGuardName' value='<?php echo $GLOBALS['CSRFGuardName']; ?>' /> 
                                <input type='hidden' name='CSRFGuardToken' value='<?php echo $GLOBALS['CSRFGuardToken']; ?>' />
                                <div class="add-to-cart" >
                                    <div class="quantity-adder pull-left">
                                        <div class="quantity-number pull-left">
                                            <label for="qty">Qtde:</label>
                                            <input type="text" name="qty" id="qty" maxlength="3" value="1" title="Qty" class="input-text qty" />
                                        </div>
                                        <div class="quantity-wrapper pull-left">
                                            <span class="add-up add-action fa fa-plus"></span> 
                                            <span class="add-down add-action fa fa-minus"></span>
                                        </div>
                                    </div>
                                    <button type="submit" title="Comprar Agora" class="button btn-cart"><span><span class="comprar"><i class="fa fa-shopping-cart"></i> Comprar</span></span></button>
                                </div>

                            </form>
                           
                        </div>

                        <div style="clear:both;" >
                            <p class="availability in-stock">
                                <span class="p-icons">
                                    <i class="fa fa-check"></i>
                                </span>
                                    Disponibilidade: 
                                <strong>

                                <?php

                                //array de disponiblidade de produto
                                $arr_disponiblidade = array(0,1,2,3,4,5,6,7,8,9,10,15,20,25,30,45,60,90);

                                foreach ($arr_disponiblidade  as $key => $estoque) {

                                    switch ($estoque) {
                                        case 0:
                                            # code...
                                            if (!(strcmp("0", $GLOBALS['ShopProduto']['situacao_em_estoque']))) {
                                                echo 'Imediata'. PHP_EOL;
                                            }

                                            break;
                                        
                                        case 1:
                                            # code...
                                            if (!(strcmp("1", $GLOBALS['ShopProduto']['situacao_em_estoque']))) {
                                                echo 'Para 1 dia útil'. PHP_EOL;
                                            }
                                            break;
                                        
                                        default:
                                            if (!(strcmp("". $estoque ."", $GLOBALS['ShopProduto']['situacao_em_estoque']))) {
                                                printf('Para %d dias úteis', $estoque) . PHP_EOL;
                                            }
                                            
                                            break;
                                    }
                
                                }
                                ?>

                                </strong>


                            </p>
                        </div>
                    </div>
                </div>
            </div>   

             

            <!--

            <div style="clear:both">

                <p class="email-friend">
                    <span class="p-icons">
                        <img src="/superstore/skin/frontend/default/ves_superstore/images/email.png" alt="In stock" />
                    </span>
                    <a href="/superstore/index.php/sendfriend/product/send/id/200/cat_id/38/">Recomendar aos amigos</a>
                </p>
            </div>
            -->


            <div class="col-md-12 produto_calcula_frete">
                <div class="row clearfix">
                    <div class="col-md-6">                        

                        <form class="form-inline" id="enviar_cep" method="post">
                            <div class="form-group">
                                Calcule o frete para sua região
                                <label class="sr-only" for="cep">Cep</label>
                                <div class="input-group">

                                    <div class="input-group-addon">
                                        <i class="fa fa-truck"></i>
                                    </div>

                                    <input type="text" class="form-control" id="id_cep" name="cep" placeholder="CEP">
                                    <input type="hidden" name="peso" value="<?php echo $GLOBALS['ShopProduto']['peso']; ?>">
                                    <input type="hidden" name="preco" value="<?php echo $preco_produto_final; ?>">
                                    <input type="hidden" name="altura" value="<?php echo $GLOBALS['ShopProduto']['altura']; ?>">
                                    <input type="hidden" name="largura" value="<?php echo $GLOBALS['ShopProduto']['largura']; ?>">
                                    <input type="hidden" name="comprimento" value="<?php echo $GLOBALS['ShopProduto']['comprimento']; ?>">
                                    <input type="hidden" name="produto" value="<?php echo $GLOBALS['ShopProduto']['produto_id']; ?>">
                                    <input type="hidden" name="loja" value="<?php echo ID_SHOP_DEFAULT; ?>">

                                    <div class="input-group-addon" style="padding:2px;">
                                        <button type="submit"  class="btn btn-default">Calcular</button>
                                    </div>

                                </div>
                            </div>
                        </form>                 
                    </div>

                    <div class="col-md-6 url_buscacep">

                        <div>
                            <a href="http://www.buscacep.correios.com.br/" title="Busca cep nos Correios" target="_blank">
                            <i class="fa fa-question-circle"></i>&nbsp; Não sei meu CEP</a>
                        </div>                            
                      
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-md-12">
                        <div id="saida"></div>                        
                    </div>
                </div>
                
            </div>


            <div class="col-md-12 produto_parcelas">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active">
                        <a href="#pagseguro" data-toggle="tab"><img src="<?php echo CDN ?>/static/img/formas-de-pagamento/pagseguro-logo.png" alt="PagSeguro" /></a>
                    </li>
                    <li>
                        <a href="#BCash" data-toggle="tab"><img src="<?php echo CDN ?>/static/img/formas-de-pagamento/pagamento_digital-logo.png" alt="BCash" /></a>
                    </li>
                   
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="pagseguro">


                        <table class="table">
                            <tr>
                                <td>


                                    <!--googleoff: all-->
              
                                    <ul  style="text-align: left;">
                                      
                                        
                                          <li class="parcela p-1 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">1x</b>
                                              de R$ 87,00
                                              <!--googleoff: all-->
                                              
                                                sem juros
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                        
                                          <li class="parcela p-2 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">2x</b>
                                              de R$ 43,50
                                              <!--googleoff: all-->
                                              
                                                sem juros
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                        
                                          <li class="parcela p-3 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">3x</b>
                                              de R$ 29,00
                                              <!--googleoff: all-->
                                              
                                                sem juros
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                        
                                          <li class="parcela p-4 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">4x</b>
                                              de R$ 23,40
                                              <!--googleoff: all-->
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                        
                                          <li class="parcela p-5 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">5x</b>
                                              de R$ 18,99
                                              <!--googleoff: all-->
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                        
                                          <li class="parcela p-6 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">6x</b>
                                              de R$ 16,05
                                              <!--googleoff: all-->
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                    </ul>
                                  
                                    <ul style="text-align: left;">
                                      
                                        
                                          <li class="parcela p-7 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">7x</b>
                                              de R$ 13,96
                                              <!--googleoff: all-->
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>                           
                                      
                                        
                                          <li class="parcela p-8 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">8x</b>
                                              de R$ 12,39
                                              <!--googleoff: all-->
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                        
                                          <li class="parcela p-9 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">9x</b>
                                              de R$ 11,17
                                              <!--googleoff: all-->
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                        
                                          <li class="parcela p-10 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">10x</b>
                                              de R$ 10,19
                                              <!--googleoff: all-->
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                        
                                          <li class="parcela p-11 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">11x</b>
                                              de R$ 9,40
                                              <!--googleoff: all-->
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                        
                                          <li class="parcela p-12 ">
                                            <span class="cor-secundaria">
                                              <b class="cor-principal">12x</b>
                                              de R$ 8,73
                                              <!--googleoff: all-->
                                              
                                              <!--googleon: all-->
                                            </span>
                                          </li>
                                        
                                      
                                    </ul>
                                  
                                  <!--googleon: all-->
                                


                            </td>                       
                        </tr>

                        </table>

                    </div>
                    <div class="tab-pane fade" id="BCash">
                        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                    </div>
                </div>
            </div>
           
        </div>

    </div>

    <script type="text/javascript" src="http://getbootstrap.com/2.3.2/assets/js/bootstrap-tab.js"></script>

    <script type="text/javascript">

    $('#myTab a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })


        //<![CDATA[
            var productAddToCartForm = new VarienForm('product_addtocart_form');
            productAddToCartForm.submit = function(button, url) {
                if (this.validator.validate()) {
                    var form = this.form;
                    var oldUrl = form.action;
        
                    if (url) {
                       form.action = url;
                    }
                    var e = null;
                    try {
                        this.form.submit();
                    } catch (e) {
                    }
                    this.form.action = oldUrl;
                    if (e) {
                        throw e;
                    }
        
                    if (button && button != 'undefined') {
                        button.disabled = true;
                    }
                }
            }.bind(productAddToCartForm);
        
            productAddToCartForm.submitLight = function(button, url){
                if(this.validator) {
                    var nv = Validation.methods;
                    delete Validation.methods['required-entry'];
                    delete Validation.methods['validate-one-required'];
                    delete Validation.methods['validate-one-required-by-name'];
                    // Remove custom datetime validators
                    for (var methodName in Validation.methods) {
                        if (methodName.match(/^validate-datetime-.*/i)) {
                            delete Validation.methods[methodName];
                        }
                    }
        
                    if (this.validator.validate()) {
                        if (url) {
                            this.form.action = url;
                        }
                        this.form.submit();
                    }
                    Object.extend(Validation.methods, nv);
                }
            }.bind(productAddToCartForm);
        //]]>
    </script>
</div>