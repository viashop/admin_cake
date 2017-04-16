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
                        <span class="navigation_page">Frete:</span>
                    </div>
                    <!-- /Breadcrumb -->			
                </div>
                <div id="carrier_area">
                    <h1 class="page-heading">Frete:</h1>
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
                        <li class="col-md-2-4 col-xs-12 step_done step_done_last third">
                            <a href="http://demo4leotheme.com/prestashop/shopping/br/order?step=1&amp;multi-shipping=">
                            <em>03.</em> Endere&ccedil;o
                            </a>
                        </li>
                        <li class="col-md-2-4 col-xs-12 step_current four">
                            <span><em>04.</em> Frete</span>
                        </li>
                        <li id="step_end" class="col-md-2-4 col-xs-12 step_todo last">
                            <span><em>05.</em> Pagamento</span>
                        </li>
                    </ul>
                    <!-- /Steps -->
                    <form id="form" action="http://demo4leotheme.com/prestashop/shopping/br/order?multi-shipping=" method="post" name="carrier_area">
                        <div class="order_carrier_content box">
                            <div id="HOOK_BEFORECARRIER">
                            </div>
                            <div class="delivery_options_address">
                                <p class="carrier_title">
                                    Selecione a forma de envio para o endere&ccedil;o: Meu endereço
                                </p>
                                <div class="delivery_options">
                                    <div class="table-responsive delivery_option item">
                                        <div>
                                            <table class="resume table table-bordered">
                                                <tr>
                                                    <td class="delivery_option_radio">
                                                        <input id="delivery_option_13_0" class="delivery_option_radio" type="radio" name="delivery_option[13]" data-key="2," data-id_address="13" value="2," checked="checked" />
                                                    </td>
                                                    <td class="delivery_option_logo">
                                                        <img src="http://demo4leotheme.com/prestashop/shopping/img/s/2.jpg" alt="My carrier"/>
                                                    </td>
                                                    <td>
                                                        <strong>My carrier</strong>
                                                        Delivery next day!
                                                    </td>
                                                    <td class="delivery_option_price">
                                                        <div class="delivery_option_price">
                                                            $2.00																																																										
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end delivery_option -->
                                </div>
                                <!-- end delivery_options -->
                                <div class="hook_extracarrier" id="HOOK_EXTRACARRIER_13"></div>
                            </div>
                            <!-- end delivery_options_address -->				
                            <div id="extra_carrier" style="display: none;"></div>
                            <p class="carrier_title">Presente</p>
                            <p class="checkbox gift">
                                <input type="checkbox" name="gift" id="gift" value="1"  />
                                <label for="gift">
                                Gostaria que o pedido fosse embrulhado para presente.
                                </label>
                            </p>
                            <p id="gift_div">
                                <label for="gift_message">Se preferir, adicione um cart&atilde;o ao presente:</label>
                                <textarea rows="2" cols="120" id="gift_message" class="form-control" name="gift_message"></textarea>
                            </p>
                            <p class="carrier_title">Termos do servi&ccedil;o</p>
                            <p class="checkbox">
                                <input type="checkbox" name="cgv" id="cgv" value="1"  />
                                <label for="cgv">Eu concordo com os termos do servi&ccedil;o e vou cumpri-los incondicionalmente.</label>
                                <a href="http://demo4leotheme.com/prestashop/shopping/br/content/3-terms-and-conditions-of-use?content_only=1" class="iframe" rel="nofollow">(Leia os Termos do Servi&ccedil;o)</a>
                            </p>
                        </div>
                        <!-- end delivery_options_address -->
                        <p class="cart_navigation clearfix">
                            <input type="hidden" name="step" value="3" />
                            <input type="hidden" name="back" value="" />
                            <a
                                href="http://demo4leotheme.com/prestashop/shopping/br/order?step=1&amp;multi-shipping="
                                title="Anterior"
                                class="button-exclusive btn btn-outline btn-sm">
                            Continuar comprando
                            </a>
                            <button type="submit" name="processCarrier" class="button btn btn-outline standard-checkout button-medium pull-right btn-sm">
                            <span>
                            Finalizar Pedido
                            </span>
                            </button>
                        </p>
                    </form>
                </div>
                <!-- end carrier_area -->
            </section>
        </div>
    </div>
</section>