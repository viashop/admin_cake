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
                        <span class="navigation_page">Endere&ccedil;os</span>
                    </div>
                    <!-- /Breadcrumb -->			
                </div>
                <h1 class="page-heading">Endere&ccedil;os</h1>
                <!-- Steps -->
                <ul class="step clearfix" id="order_step">
                    <li class="col-md-2-4 col-xs-12 step_done first">
                        <a href="http://demo4leotheme.com/prestashop/shopping/br/order">
                        <em>01.</em> Resumo
                        </a>
                    </li>
                    <li class="col-md-2-4 col-xs-12 step_done step_done_last second">
                        <a href="http://demo4leotheme.com/prestashop/shopping/br/order?step=1&amp;multi-shipping=">
                        <em>02.</em> Entre
                        </a>
                    </li>
                    <li class="col-md-2-4 col-xs-12 step_current third">
                        <span><em>03.</em> Endere&ccedil;o</span>
                    </li>
                    <li class="col-md-2-4 col-xs-12 step_todo four">
                        <span><em>04.</em> Frete</span>
                    </li>
                    <li id="step_end" class="col-md-2-4 col-xs-12 step_todo last">
                        <span><em>05.</em> Pagamento</span>
                    </li>
                </ul>
                <!-- /Steps -->
                <form action="http://demo4leotheme.com/prestashop/shopping/br/order" method="post">
                    <div class="addresses clearfix">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="address_delivery select form-group selector1">
                                    <label for="id_address_delivery">Escolha o endere&ccedil;o de entrega:</label>
                                    <select class="form-control address_select" name="id_address_delivery" id="id_address_delivery">
                                        <option value="13" selected="selected">
                                            Meu endereço
                                        </option>
                                    </select>
                                    <span class="waitimage"></span>
                                </div>
                                <p class="checkbox addressesAreEquals">
                                    <input type="checkbox" name="same" id="addressesAreEquals" value="1" checked="checked" />
                                    <label for="addressesAreEquals">Usar o mesmo endere&ccedil;o para cobran&ccedil;a.</label>
                                </p>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div id="address_invoice_form" class="select form-group selector1" style="display: none;">
                                    <a href="http://demo4leotheme.com/prestashop/shopping/br/address?back=order.php%3Fstep%3D1&amp;select_address=1" title="Adicionar" class="button button-small btn-sm btn btn-outline">
                                    <span>
                                    Adicionar um novo endere&ccedil;o
                                    </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <ul class="address item box" id="address_delivery">
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <ul class="address alternate_item box" id="address_invoice">
                                </ul>
                            </div>
                        </div>
                        <!-- end row -->
                        <p class="address_add submit">
                            <a href="http://demo4leotheme.com/prestashop/shopping/br/address?back=order.php%3Fstep%3D1" title="Adicionar" class="button button-small btn-sm btn btn-outline">
                            <span>Adicionar um novo endere&ccedil;o</span>
                            </a>
                        </p>
                        <div id="ordermsg" class="form-group">
                            <label>Se voc&ecirc; quiser comentar como foi a sua compra, por favor escreva abaixo.</label>
                            <textarea class="form-control" cols="60" rows="6" name="message"></textarea>
                        </div>
                    </div>
                    <!-- end addresses -->
                    <p class="cart_navigation clearfix">
                        <input type="hidden" class="hidden" name="step" value="2" />
                        <input type="hidden" name="back" value="" />
                        <a href="http://demo4leotheme.com/prestashop/shopping/br/order?step=0" title="Anterior" class="button-exclusive btn btn-outline btn-sm">
                        Continuar comprando
                        </a>
                        <button type="submit" name="processAddress" class="button btn btn-outline button-medium pull-right btn-sm">
                        <span>Finalizar Pedido</span>
                        </button>
                    </p>
                </form>
            </section>
        </div>
    </div>
</section>
