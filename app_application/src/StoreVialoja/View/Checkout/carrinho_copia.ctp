<section id="columns" class="offcanvas-siderbars">
    <div class="container">
        <div class="breadcrumbs">
            <ul>
                <li class="home">
                    <a href="/" title="Go to Home Page">Home</a>
                    <span>/ </span>
                </li>
                <li class="cms_page">
                    <strong></strong>
                </li>
            </ul>
        </div>
        <div class="row">
            <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="content">
                    <div class="cart">
                        <div class="page-title title-buttons">
                            <h1>Carrinho de Compras</h1>
                            <ul class="checkout-types">
                                <li>    <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout btn-checkout" onclick="window.location='/checkout/onepage/';"><span><span>Proceed to Checkout</span></span></button></li>
                            </ul>
                        </div>
                        <form action="/checkout/cart/updatePost/" method="post">
                            <input name="form_key" type="hidden" value="FE0WKhPx41UAOB88" />
                            <fieldset>
                                <table id="shopping-cart-table" class="table table-bordered table-responsive">
                                    <col width="1" />
                                    <col />
                                    <col width="1" />
                                    <col width="1" />
                                    <col width="1" />
                                    <col width="1" />
                                    <col width="1" />
                                    <thead>
                                        <tr>
                                            <th rowspan="1">&nbsp;</th>
                                            <th rowspan="1"><span class="nobr">Produto Nome</span></th>
                                            <th rowspan="1"></th>
                                            <th class="a-center" colspan="1"><span class="nobr">Preço unitário</span></th>
                                            <th rowspan="1" class="a-center">Qtde.</th>
                                            <th class="a-center" colspan="1">Subtotal</th>
                                            <th rowspan="1" class="a-center">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td colspan="50" class="a-right">
                                                <button type="button" title="Continuar Comprando" class="button btn-continue" onclick="setLocation('/')"><span><span>Continuar Comprando</span></span></button>
                                                <button type="submit" nar"update_cart_action" value="update_qty" title="Atualizar Carrinho de Compras" class="button btn-update"><span><span>Atualizar Carrinho de Compras</span></span></button>
                                                <button type="submit" name="update_cart_action" value="empty_cart" title="Limpar Carrinho de Compras" class="button btn-empty" id="empty_cart_button"><span><span>Limpar Carrinho de Compras</span></span></button>
                                                <!--[if lt IE 8]>
                                                <input type="hidden" id="update_cart_action_container" />
                                                <script type="text/javascript">
                                                    //<![CDATA[
                                                        Event.observe(window, 'load', function()
                                                        {
                                                            // Internet Explorer (lt 8) does not support value attribute in button elements
                                                            $emptyCartButton = $('empty_cart_button');
                                                            $cartActionContainer = $('update_cart_action_container');
                                                            if ($emptyCartButton && $cartActionContainer) {
                                                                Event.observe($emptyCartButton, 'click', function()
                                                                {
                                                                    $emptyCartButton.setAttribute('name', 'update_cart_action_temp');
                                                                    $cartActionContainer.setAttribute('name', 'update_cart_action');
                                                                    $cartActionContainer.setValue('empty_cart');
                                                                });
                                                            }
                                                    
                                                        });
                                                    //]]>
                                                </script>
                                                <![endif]-->
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td><a href="/framed-sleeve-mid.html" title="Framed-Sleeve Mid" class="product-image"><img src="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/thumbnail/200x150/9df78eab33525d08d6e5fb8d27136e95/p/r/product-13-3-500x717_7.jpg" width="200" height="150" alt="Framed-Sleeve Mid" /></a></td>
                                            <td>
                                                <h2 class="product-name">
                                                    <a href="/framed-sleeve-mid.html">Framed-Sleeve Mid</a>
                                                </h2>
                                                <dl class="item-options">
                                                    <dt>Color</dt>
                                                    <dd>Green                            </dd>
                                                </dl>
                                            </td>
                                            <td class="a-center">
                                                <a href="/checkout/cart/configure/id/330/" title="Edit item parameters">Edit</a>
                                            </td>
                                            <td class="a-right">
                                                <span class="cart-price">
                                                <span class="price">$390.00</span>                
                                                </span>
                                            </td>
                                            <!-- inclusive price starts here -->
                                            <td class="a-center">
                                                <input name="cart[330][qty]" value="2" size="4" title="Qtde" class="input-text qty" maxlength="12" />
                                            </td>
                                            <!--Sub total starts here -->
                                            <td class="a-right">
                                                <span class="cart-price">
                                                <span class="price">$780.00</span>                            
                                                </span>
                                            </td>
                                            <td class="a-center"><a href="/checkout/cart/delete/id/330/uenc/aHR0cDovL3ZlbnVzZGVtby5jb20vbWFnZW50by9zdXBlcnN0b3JlL2luZGV4LnBocC9jaGVja291dC9jYXJ0Lw,,/" title="Remove item" class="btn-remove btn-remove2">Remove item</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/farlap-shirt-ruby-wines-388.html" title="Farlap Shirt - Ruby Wines" class="product-image"><img src="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/thumbnail/200x150/9df78eab33525d08d6e5fb8d27136e95/p/r/product-12-1-500x717_15.jpg" width="200" height="150" alt="Farlap Shirt - Ruby Wines" /></a></td>
                                            <td>
                                                <h2 class="product-name">
                                                    <a href="/farlap-shirt-ruby-wines-388.html">Farlap Shirt - Ruby Wines</a>
                                                </h2>
                                                <dl class="item-options">
                                                    <dt>Size</dt>
                                                    <dd>M                            </dd>
                                                </dl>
                                            </td>
                                            <td class="a-center">
                                                <a href="/checkout/cart/configure/id/331/" title="Edit item parameters">Edit</a>
                                            </td>
                                            <td class="a-right">
                                                <span class="cart-price">
                                                <span class="price">$190.00</span>                
                                                </span>
                                            </td>
                                            <!-- inclusive price starts here -->
                                            <td class="a-center">
                                                <input name="cart[331][qty]" value="1" size="4" title="Qty" class="input-text qty" maxlength="12" />
                                            </td>
                                            <!--Sub total starts here -->
                                            <td class="a-right">
                                                <span class="cart-price">
                                                <span class="price">$190.00</span>                            
                                                </span>
                                            </td>
                                            <td class="a-center"><a href="/checkout/cart/delete/id/331/uenc/aHR0cDovL3ZlbnVzZGVtby5jb20vbWFnZW50by9zdXBlcnN0b3JlL2luZGV4LnBocC9jaGVja291dC9jYXJ0Lw,,/" title="Remove item" class="btn-remove btn-remove2">Remove item</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/double-layer-super-soft.html" title="Double layer super soft" class="product-image"><img src="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/thumbnail/200x150/9df78eab33525d08d6e5fb8d27136e95/p/r/product-10-500x717_2.jpg" width="200" height="150" alt="Double layer super soft" /></a></td>
                                            <td>
                                                <h2 class="product-name">
                                                    <a href="/double-layer-super-soft.html">Double layer super soft</a>
                                                </h2>
                                                <dl class="item-options">
                                                    <dt>Color</dt>
                                                    <dd>Blue                            </dd>
                                                    <dt>Shirt Size</dt>
                                                    <dd>Medium                            </dd>
                                                </dl>
                                            </td>
                                            <td class="a-center">
                                                <a href="/checkout/cart/configure/id/332/" title="Edit item parameters">Edit</a>
                                            </td>
                                            <td class="a-right">
                                                <span class="cart-price">
                                                <span class="price">$170.00</span>                
                                                </span>
                                            </td>
                                            <!-- inclusive price starts here -->
                                            <td class="a-center">
                                                <input name="cart[332][qty]" value="1" size="4" title="Qty" class="input-text qty" maxlength="12" />
                                            </td>
                                            <!--Sub total starts here -->
                                            <td class="a-right">
                                                <span class="cart-price">
                                                <span class="price">$170.00</span>                            
                                                </span>
                                            </td>
                                            <td class="a-center"><a href="/checkout/cart/delete/id/332/uenc/aHR0cDovL3ZlbnVzZGVtby5jb20vbWFnZW50by9zdXBlcnN0b3JlL2luZGV4LnBocC9jaGVja291dC9jYXJ0Lw,,/" title="Remove item" class="btn-remove btn-remove2">Remove item</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                            <script type="text/javascript">decorateTable('shopping-cart-table')</script>
                        </form>
                        <div class="cart-collaterals row">
                            <div class="col-lg-8 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <form id="discount-coupon-form" action="/checkout/cart/couponPost/" method="post">
                                            <div class="discount">
                                                <h2>Código de Desconto</h2>
                                                <div class="discount-form">
                                                    <label for="coupon_code">Possui algum cupom de desconto?</label>
                                                    <input type="hidden" name="remove" id="remove-coupone" value="0" />
                                                    <div class="input-box">
                                                        <input class="input-text form-control" id="coupon_code" name="coupon_code" value="" placeholder="Inserir cupom de desconto aqui" />
                                                    </div>
                                                    <div class="buttons-set">
                                                        <button type="button" title="Aplicar Cupom" class="button" onclick="discountForm.submit(false)" value="Aplicar Cupom"><span><span>Inserir Cupom</span></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <script type="text/javascript">
                                            //<![CDATA[
                                            var discountForm = new VarienForm('discount-coupon-form');
                                            discountForm.submit = function (isRemove) {
                                                if (isRemove) {
                                                    $('coupon_code').removeClassName('required-entry');
                                                    $('remove-coupone').value = "1";
                                                } else {
                                                    $('coupon_code').addClassName('required-entry');
                                                    $('remove-coupone').value = "0";
                                                }
                                                return VarienForm.prototype.submit.bind(discountForm)();
                                            }
                                            //]]>
                                        </script>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">
                                        <div class="shipping">
                                            <h2>Estimativa de Frete</h2>
                                            <div class="shipping-form">
                                                <form action="/checkout/cart/estimatePost/" method="post" id="shipping-zip-form">
                                                    <p>Insira o CEP de destino para obter uma estimativa de envio.</p>
                                                    <ul class="form-list">                                                        
                                                    
                                                        <li>
                                                            <label for="postcode">CEP</label>
                                                            <div class="input-box">
                                                                <input class="input-text form-control validate-postcode" type="text" id="postcode" name="estimate_postcode" value="78400000" />
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="buttons-set">
                                                        <button type="button" title="Calcular Frete" onclick="coShippingMethodForm.submit()" class="button"><span><span>Calcular Frete</span></span></button>
                                                    </div>
                                                </form>
                                          
                                                <form id="co-shipping-method-form" action="/checkout/cart/estimateUpdatePost/">
                                                    <dl class="sp-methods">
                                                        <dt>Estimativas de Frete</dt>
                                                        <dd>
                                                            <ul>
                                                                <li>
                                                                    <input name="estimate_method" type="radio" value="flatrate_flatrate" id="s_method_flatrate_flatrate" class="radio" />
                                                                    <label for="s_method_flatrate_flatrate">PAC
                                                                    <span class="price">R$ 20,00</span></label>
                                                                </li>
                                                                <li>
                                                                    <input name="estimate_method" type="radio" value="flatrate_flatrate" id="s_method_flatrate_flatrate" class="radio" />
                                                                    <label for="s_method_flatrate_flatrate">SEDEX
                                                                    <span class="price">R$ 60,00</span></label>
                                                                </li>
                                                                <li>
                                                                    <input name="estimate_method" type="radio" value="flatrate_flatrate" id="s_method_flatrate_flatrate" class="radio" />
                                                                    <label for="s_method_flatrate_flatrate">MOTO TAXI
                                                                    <span class="price">R$ 45,00</span>
                                                                </li>
                                                            </ul>
                                                        </dd>
                                                    </dl>
                                                    <div class="buttons-set">
                                                        <button type="submit" title="Atualizar Total" class="button" name="do" value="Atualizar Total"><span><span>Atualizar Total</span></span></button>
                                                    </div>
                                                </form>
                                                <script type="text/javascript">
                                                    //<![CDATA[
                                                        var coShippingMethodForm = new VarienForm('shipping-zip-form');
                                                        var countriesWithOptionalZip = ["HK","IE","MO","PA"];
                                                    
                                                        coShippingMethodForm.submit = function () {
                                                            var country = $F('country');
                                                            var optionalZip = false;
                                                    
                                                            for (i=0; i < countriesWithOptionalZip.length; i++) {
                                                                if (countriesWithOptionalZip[i] == country) {
                                                                    optionalZip = true;
                                                                }
                                                            }
                                                            if (optionalZip) {
                                                                $('postcode').removeClassName('required-entry');
                                                            }
                                                            else {
                                                                $('postcode').addClassName('required-entry');
                                                            }
                                                            return VarienForm.prototype.submit.bind(coShippingMethodForm)();
                                                        }
                                                    //]]>
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-xs-12">
                                <div class="totals">
                                    <table id="shopping-cart-totals-table">
                                        <col />
                                        <col width="1" />
                                        <tfoot>
                                            <tr>
                                                <td style="" class="a-right" colspan="1">
                                                    <strong>Total Geral</strong>
                                                </td>
                                                <td style="" class="a-right">
                                                    <strong><span class="price">$1,140.00</span></strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td style="" class="a-right" colspan="1">
                                                    Subtotal    
                                                </td>
                                                <td style="" class="a-right">
                                                    <span class="price">$1,140.00</span>    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <ul class="checkout-types">
                                        <li>    <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout btn-checkout" onclick="window.location='/checkout/onepage/';"><span><span>Finalizar Pedido</span></span></button></li>
                                        <li><a href="/checkout/multishipping/" title="Despacho para múltiplos endereços de um pedido">Finalizar Pedido com Múltiplos Endereços</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>