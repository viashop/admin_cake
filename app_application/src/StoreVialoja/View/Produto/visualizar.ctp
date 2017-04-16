<section id="columns" class="offcanvas-siderbars">
    <div class="container">

        <?php
        App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'produto'.DS.'breadcrumbs');
        ?>

        <div class="row">
            <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="content">
                    <script type="text/javascript">
                        var optionsPrice = new Product.OptionsPrice({"productId":"200","priceFormat":{"pattern":"$%s","precision":2,"requiredPrecision":2,"decimalSymbol":".","groupSymbol":",","groupLength":3,"integerRequired":1},"includeTax":"false","showIncludeTax":false,"showBothPrices":false,"productPrice":390,"productOldPrice":390,"priceInclTax":390,"priceExclTax":390,"skipCalculate":1,"defaultTax":0,"currentTax":0,"idSuffix":"_clone","oldPlusDisposition":0,"plusDisposition":0,"plusDispositionTax":0,"oldMinusDisposition":0,"minusDisposition":0,"tierPrices":[],"tierPricesInclTax":[]});
                    </script>
                    <div id="messages_product_view"></div>
                    
                    <div class="product-view">

                        <?php

                        App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'produto'.DS.'product-essential');

                        App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'produto'.DS.'product-collateral');

                        echo $this->requestAction(array(
                            'controller' => 'BoxProdutoUpsell',
                            'action' => 'box',
                            'box_tipo' => 'destaque',
                            'box_nome' => 'Produtos em Destaques',
                        ));
                        ?>

                    </div>
                    <script type="text/javascript">
                        jQuery('#tabs a').tabs();
                    </script> 
                    <script type="text/javascript">
                        var lifetime = 3600;
                        var expireAt = Mage.Cookies.expires;
                        if (lifetime > 0) {
                            expireAt = new Date();
                            expireAt.setTime(expireAt.getTime() + lifetime * 1000);
                        }
                        Mage.Cookies.set('external_no_cache', 1, expireAt);
                    </script>
                    <div class="contentBottom">
                        <div class="container">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>