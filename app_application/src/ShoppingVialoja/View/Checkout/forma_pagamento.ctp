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
                        <a class="home" href="http://demo4leotheme.com/prestashop/shopping/" title="Voltar para a P&aacute;gina Inicial"><i class="fa fa-home"></i></a>
                        <span class="navigation-pipe" >/</span>
                        <span class="navigation_page">Sua forma de pagamento</span>
                    </div>
                    <!-- /Breadcrumb -->			
                </div>
                <h1 class="page-heading">Escolha uma forma de pagamento</h1>
                <!-- Steps -->
                <ul class="step clearfix" id="order_step">
                    <li class="col-md-2-4 col-xs-12 step_done first">
                        <a href="http://demo4leotheme.com/prestashop/shopping/br/order">
                        <em>01.</em> Resumo
                        </a>
                    </li>
                    <li class="col-md-2-4 col-xs-12 step_done second">
                        <a href="http://demo4leotheme.com/prestashop/shopping/br/order?step=1&amp;multi-shipping=">
                        <em>02.</em> Entre
                        </a>
                    </li>
                    <li class="col-md-2-4 col-xs-12 step_done third">
                        <a href="http://demo4leotheme.com/prestashop/shopping/br/order?step=1&amp;multi-shipping=">
                        <em>03.</em> Endere&ccedil;o
                        </a>
                    </li>
                    <li class="col-md-2-4 col-xs-12 step_done step_done_last four">
                        <a href="http://demo4leotheme.com/prestashop/shopping/br/order?step=2&amp;multi-shipping=">
                        <em>04.</em> Frete
                        </a>
                    </li>
                    <li id="step_end" class="col-md-2-4 col-xs-12 step_current last">
                        <span><em>05.</em> Pagamento</span>
                    </li>
                </ul>
                <!-- /Steps -->
                <div class="paiement_block">
                    <div id="HOOK_TOP_PAYMENT"></div>
                    <div id="order-detail-content" class="table_block table-responsive">
                        <table id="cart_summary" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="cart_product first_item">Produto</th>
                                    <th class="cart_description item">Descri&ccedil;&atilde;o</th>
                                    <th class="cart_availability item">Disp.</th>
                                    <th class="cart_unit item">Pre&ccedil;o Unit&aacute;rio</th>
                                    <th class="cart_quantity item">Qtd</th>
                                    <th class="cart_total last_item">Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="cart_total_price">
                                    <td colspan="4" class="text-right">Total de produtos:</td>
                                    <td colspan="2" class="price" id="total_product">$55.98</td>
                                </tr>
                                <tr class="cart_total_voucher" style="display:none">
                                    <td colspan="4" class="text-right">
                                        Total da embalagem para presente:																																	
                                    </td>
                                    <td colspan="2" class="price-discount price" id="total_wrapping">
                                        $0.00
                                    </td>
                                </tr>
                                <tr class="cart_total_delivery">
                                    <td colspan="4" class="text-right">Total do frete</td>
                                    <td colspan="2" class="price" id="total_shipping" >$2.00</td>
                                </tr>
                                <tr class="cart_total_voucher" style="display:none">
                                    <td colspan="4" class="text-right">
                                        Total de cupons:																																	
                                    </td>
                                    <td colspan="2" class="price-discount price" id="total_discount">
                                        $0.00
                                    </td>
                                </tr>
                                <tr class="cart_total_price">
                                    <td colspan="2" id="cart_voucher" class="cart_voucher">
                                        <div id="cart_voucher" class="table_block">
                                            <form action="http://demo4leotheme.com/prestashop/shopping/br/order" method="post" id="voucher">
                                                <fieldset>
                                                    <h4>Cupons de desconto</h4>
                                                    <input type="text" id="discount_name" class="form-control" name="discount_name" value="" />
                                                    <input type="hidden" name="submitDiscount" />
                                                    <button type="submit" name="submitAddDiscount" class="button btn btn-outline button-small btn-sm"><span>Ok</span></button>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </td>
                                    <td colspan="2" class="text-right total_price_container">
                                        <span>Total</span>
                                    </td>
                                    <td colspan="1" class="price total_price_container" id="total_price_container">
                                        <span id="total_price">$57.98</span>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr id="product_5_19_0_13" class="cart_item address_13 odd">
                                    <td class="cart_product">
                                        <a href="http://demo4leotheme.com/prestashop/shopping/br/summer-dresses/5-printed-summer-dress.html#/size-s/color-yellow"><img src="http://demo4leotheme.com/prestashop/shopping/12-small_default/printed-summer-dress.jpg" alt="Printed Summer Dress" width="98" height="98"  /></a>
                                    </td>
                                    <td class="cart_description">
                                        <p class="product-name"><a href="http://demo4leotheme.com/prestashop/shopping/br/summer-dresses/5-printed-summer-dress.html#/size-s/color-yellow">Printed Summer Dress</a></p>
                                        <small class="cart_ref">SKU : demo_5</small>		<small><a href="http://demo4leotheme.com/prestashop/shopping/br/summer-dresses/5-printed-summer-dress.html#/size-s/color-yellow">Color : Yellow, Size : S</a></small>	
                                    </td>
                                    <td class="cart_avail"><span class="label label-success">In stock</span></td>
                                    <td class="cart_unit" data-title="Pre&ccedil;o Unit&aacute;rio">
                                        <span class="price" id="product_price_5_19_13">
                                        <span class="price special-price">$28.98</span>
                                        <span class="price-percent-reduction small">
                                        -5%
                                        </span>
                                        <span class="old-price">$30.51</span>
                                        </span>
                                    </td>
                                    <td class="cart_quantity text-center">
                                        <span>
                                        1
                                        </span>
                                    </td>
                                    <td class="cart_total" data-title="Total">
                                        <span class="price" id="total_product_price_5_19_13">
                                        $28.98									</span>
                                    </td>
                                </tr>
                                <tr id="product_2_7_0_13" class="cart_item address_13 even">
                                    <td class="cart_product">
                                        <a href="http://demo4leotheme.com/prestashop/shopping/br/blouses/2-blouse.html#/size-s/color-black"><img src="http://demo4leotheme.com/prestashop/shopping/7-small_default/blouse.jpg" alt="Blouse" width="98" height="98"  /></a>
                                    </td>
                                    <td class="cart_description">
                                        <p class="product-name"><a href="http://demo4leotheme.com/prestashop/shopping/br/blouses/2-blouse.html#/size-s/color-black">Blouse</a></p>
                                        <small class="cart_ref">SKU : demo_2</small>		<small><a href="http://demo4leotheme.com/prestashop/shopping/br/blouses/2-blouse.html#/size-s/color-black">Color : Black, Size : S</a></small>	
                                    </td>
                                    <td class="cart_avail"><span class="label label-success">In stock</span></td>
                                    <td class="cart_unit" data-title="Pre&ccedil;o Unit&aacute;rio">
                                        <span class="price" id="product_price_2_7_13">
                                        <span class="price">$27.00</span>
                                        </span>
                                    </td>
                                    <td class="cart_quantity text-center">
                                        <span>
                                        1
                                        </span>
                                    </td>
                                    <td class="cart_total" data-title="Total">
                                        <span class="price" id="total_product_price_2_7_13">
                                        $27.00									</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end order-detail-content -->
                    <div id="HOOK_PAYMENT">
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <p class="payment_module">
                                    <a 
                                        class="bankwire" 
                                        href="http://demo4leotheme.com/prestashop/shopping/br/module/bankwire/payment" 
                                        title="Pagar por transferência bancária/depósito">
                                    Pagar por transferência bancária/depósito <span>(você deve informar o pagamento assim que for efetivado)</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <p class="payment_module">
                                    <a class="cheque" href="http://demo4leotheme.com/prestashop/shopping/br/module/cheque/payment" title="Pagamento por cheque">
                                    Pagamento por cheque <span>(o processo de pagamento demorará mais)</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <p class="cart_navigation clearfix">
                        <a href="http://demo4leotheme.com/prestashop/shopping/br/order?step=2" title="Anterior" class="button-exclusive btn btn-outline btn-sm">
                        Continuar comprando
                        </a>
                    </p>
                </div>
                <!-- end HOOK_TOP_PAYMENT -->								
            </section>
        </div>
    </div>
</section>