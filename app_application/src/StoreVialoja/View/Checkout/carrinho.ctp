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

                    <?php if (count($carrinho_lista)<=0): ?>

                    <div class="page-title">
                        <h1> Carrinho de Compras está Vazio.</h1>
                    </div>
                    <div class="cart-empty">
                        <p>Você não tem itens no seu carrinho de compras.</p>
                        <p><a href="//<?php echo env('HTTP_HOST'); ?>">Clique Aqui</a> para continuar Comprando.</p>
                    </div>

                    <?php else: ?>

                    <div class="cart">
                        <div class="page-title title-buttons">
                            <h1>Carrinho de Compras</h1>
                            <ul class="checkout-types">
                                <li>    <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout btn-checkout" onclick="window.location='/checkout/onepage/';"><span><span>Proceed to Checkout</span></span></button></li>
                            </ul>
                        </div>
                        <form action="/checkout/carrinho/atualizarPost" method="post">
                            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
                            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
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
                                                <button type="submit" name="update_cart_action" value="update_qty" title="Atualizar Carrinho de Compras" class="button btn-update"><span><span>Atualizar Carrinho de Compras</span></span></button>
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

                                        <?php 
                                        //pr($carrinho_lista);

                                        foreach ($carrinho_lista as $key => $desconto) {

                                            if ($key <=0) {
                                                # code...
                                                $total_desconto = $desconto['ShopCupomDesconto']['valor'];
                                                $codigo_desconto = $desconto['ShopCupomDesconto']['codigo'];
                                                $tipo_desconto = $desconto['ShopCupomDesconto']['tipo'];
                                            }

                                        }

                                        $subtotal_pedido=0;
                                        $subtotal_produto=0;

                                        foreach ($carrinho_lista as $key => $carrinho): 

                                        $qtde = $carrinho['ShopCarrinhoProdutoDescricao']['qtde'];
                                        $preco = $carrinho['ShopCarrinhoProdutoDescricao']['preco'];
                                        $subtotal_produto = $preco * $qtde;
                                        $subtotal_pedido +=  $subtotal_produto;

                                        $url_img = CDN .'static/img/imagem-padrao/cart/produto-sem-imagem.gif';
                                        $nome_imagem = $carrinho['ShopProdutoImagem']['nome_imagem'];
                                        $id_produto = $carrinho['ShopCarrinhoProdutoDescricao']['id_produto_default'];

                                        if (!empty($nome_imagem)) {

                                            $url_root = sprintf( '%s%d%sproduto%s%d%scart%s%s',
                                                CDN_ROOT_UPLOAD,
                                                ID_SHOP_DEFAULT,
                                                DS,
                                                DS,
                                                $id_produto,
                                                DS,
                                                DS,
                                                $nome_imagem
                                            );

                                            if (is_file($url_root)) {

                                                $url_img = sprintf( '%s%d/produto/%d/cart/%s',
                                                    CDN_UPLOAD,
                                                    ID_SHOP_DEFAULT,
                                                    $id_produto,
                                                    $nome_imagem
                                                );                               

                                            }

                                        }

                                        ?>
                                        
                                        <tr>
                                            <td><center><a href="/p/<?php echo \Lib\Tools::slug( $carrinho['ShopProduto']['nome'] ) .'/'. $id_produto; ?>/" title="<?php echo $carrinho['ShopProduto']['nome'] ?>" class="product-image"><img src="<?php echo $url_img; ?>" style="max-height:100px;" alt="<?php echo $carrinho['ShopProduto']['nome'] ?>" /></a></center></td>
                                            <td>
                                                <h2 class="product-name">
                                                    <a href="/p/<?php echo \Lib\Tools::slug( $carrinho['ShopProduto']['nome'] ) .'/'. $id_produto; ?>/"><?php echo $carrinho['ShopProduto']['nome'] ?></a>
                                                </h2>
                                                <dl class="item-options">
                                                    <dt>Color</dt>
                                                    <dd>Green</dd>
                                                </dl>
                                            </td>
                                
                                            <td class="a-right">
                                                <span class="cart-price">
                                                <span class="price">R$ <?php echo \Lib\Tools::convertToDecimalBR( $carrinho['ShopCarrinhoProdutoDescricao']['preco']) ?></span>
                                                </span>
                                            </td>
                                            <!-- inclusive price starts here -->
                                            <td class="a-center">
                                                <input name="cart[<?php echo $carrinho['ShopCarrinhoProdutoDescricao']['id_carrinho_descricao'] ?>][qty]" value="<?php echo $qtde ?>" size="4" title="Qtde" class="input-text qty" maxlength="12" />
                                            </td>
                                            <!--Sub total starts here -->
                                            <td class="a-right">
                                                <span class="cart-price">
                                                <span class="price">R$ <?php echo \Lib\Tools::convertToDecimalBR( $subtotal_produto ) ?></span>
                                                </span>
                                            </td>
                                            <td class="a-center"><a href="/checkout/carrinho/remover/id/<?php echo $carrinho['ShopCarrinhoProdutoDescricao']['id_carrinho_descricao'] . '/'. $carrinho['ShopCarrinhoProdutoDescricao']['key'] ?>" <a onclick='return confirm("Tem certeza que deseja remover este item do carrinho?");' title="Remove item" class="btn-remove btn-remove2">Remove item</a></td>
                                        </tr>

                                        <?php endforeach ?>
            
                                    </tbody>
                                </table>
                            </fieldset>
                            <script type="text/javascript">decorateTable('shopping-cart-table')</script>
                        </form>
                        <div class="cart-collaterals row">
                            <div class="col-lg-8 col-sm-6 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12 col-xs-12">

                                       <?php if (isset($cupom_ativo) && $cupom_ativo !== false): ?>                                           
                                        <form id="discount-coupon-form" action="/checkout/carrinho/descontoPost" method="post">
                                            <div class="discount">
                                                <h2>Código de Desconto</h2>
                                                <div class="discount-form">
                                                    <label for="coupon_code">Possui algum cupom de desconto?</label>
                                                    <input type="hidden" name="remove" id="remove-coupone" value="0" />
                                                    <input type="hidden" name="cupom_desconto" value="True" />
                                                    <div class="input-box">
                                                        <input class="input-text form-control" id="coupon_code" name="cupom_code" value="<?php 

                                                        if (\Lib\Validate::isPost()) {
                                                            echo \Lib\Tools::getValue('cupom_code');
                                                        } elseif (isset( $codigo_desconto ) ) {
                                                            echo $codigo_desconto;
                                                        }

                                                        ?>" placeholder="Inserir cupom de desconto aqui" />
                                                    </div>
                                                    <div class="buttons-set">
                                                        <button type="button" title="Aplicar Cupom" class="button" onclick="discountForm.submit(false)" value="Inserir Cupom"><span><span>Inserir Cupom</span></span></button>
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

                                        <?php endif ?>
                                    </div>
                                    <a name="frete"></a>
                                    <div class="col-lg-6 col-sm-12 col-xs-12">

                                        <div class="shipping">
                                            <h2>Calcule o frete para sua região</h2>

                                            <div class="shipping-form">
                                                <form action="/checkout/carrinho/freteCalcularPost" method="post" id="shipping-zip-form">

                                                    <input type="hidden" name="frete_carrinho_acao" value="calcular" />
                                                    <input type="hidden" name="remove" id="remove-cepcode" value="0" />


                                                    <p><i class="fa fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Para fins de contagem do prazo de entrega, sábados, domingos e feriados não são considerados dias úteis. Postagens ocorridas aos sábados, domingos, feriados e depois do horário limite de postagem (DH), considerar o próximo dia útil como o Dia da Postagem."></i> Insira o CEP de destino para obter uma estimativa de envio.</p>
                                                    <ul class="form-list"> 
                                                    
                                                        <li>
                                                            <label for="postcode">CEP</label>
                                                            <div class="input-box">
                                                                <input class="input-text form-control validate-postcode" type="text" id="cep_code" name="cep_code" value="<?php echo $carrinho_cep; ?>" />
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="buttons-set">
                                                        <button type="submit" title="Calcular Frete" onclick="coShippingMethodForm.submit()" class="button"><span><span>Calcular Frete</span></span></button>
                                                    </div>
                                                </form>

                                                <?php if (isset($carrinho_cep)) { ?>

                                                <?php

                                                if (isset($arr_return_frete) && \Lib\Validate::isNotNull($arr_return_frete)):

                                                $envio_correios = \Lib\Tools::getArrayKeySpecific('envio_correios', $arr_return_frete);
                                                $envio_motoboy = \Lib\Tools::getArrayKeySpecific('envio_motoboy', $arr_return_frete);
                                                $envio_pessoalmente = \Lib\Tools::getArrayKeySpecific('envio_pessoalmente', $arr_return_frete);
                                                $envio_transportadora =  \Lib\Tools::getArrayKeySpecific('envio_transportadora', $arr_return_frete);
                                                $envio_personalizado =  \Lib\Tools::getArrayKeySpecific('envio_personalizado', $arr_return_frete);

                                                if (count($envio_correios)>0 
                                                || count($envio_motoboy)>0 
                                                || count($envio_pessoalmente)>0 
                                                || count($envio_transportadora)>0 || count($envio_personalizado)>0) {
                                                ?>
                                          
                                                <form id="co-shipping-method-form" action="/checkout/carrinho/freteAtualizarPost" method="post">

                                                     <input type="hidden" name="frete_carrinho_acao" value="atualizar" />

                                                    <dl class="sp-methods">
                                                        <dt>Frete para sua região <i class="fa fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Para fins de contagem do prazo de entrega, sábados, domingos e feriados não são considerados dias úteis. Postagens ocorridas aos sábados, domingos, feriados e depois do horário limite de postagem (DH), considerar o próximo dia útil como o Dia da Postagem."></i></dt>
                                                        <dd>

                                                            <table class="table table-striped">

                                                                <?php if ( isset($tipo_desconto) && $tipo_desconto == 'frete_gratis'): ?>

                                                                <tr>
                                                                    <th><input name="forma_envio_id[]" type="radio" checked="checked" value="frete_gratis" id="s_method_flatrate_flatrate" class="radio" /></th>
                                                                    <td style="font-weight: bold">Frete Grátis</td>
                                                                    <td><span style="font-size:13px; font-weight: normal;">CUPOM</span></td>
                                                                    <td><span class="price">R$ 0,00</span></td>
                                                                </tr>

                                                                <?php endif; ?>

                                                                <?php

                                                                if (isset($envio_formas, $envio_correios) 
                                                                    && \Lib\Validate::isNotNull($envio_formas) 
                                                                    && !empty($envio_correios) && count($envio_correios) > 0 ) :

                                                                    foreach ($envio_correios as $key => $servico) :

                                                                        foreach ($envio_formas as $key => $envio) {

                                                                            if ($envio['ShopEnvioCorreios']['codigo_servico'] == $servico->Codigo) {
                                                                                $taxa_tipo = $envio['ShopEnvioCorreios']['taxa_tipo'];
                                                                                $taxa_valor = $envio['ShopEnvioCorreios']['taxa_valor'];
                                                                                $prazo_adicional = $envio['ShopEnvioCorreios']['prazo_adicional'];
                                                                                $id_envio = $envio['ShopEnvioCorreios']['id_envio_default'];
                                                                                $nome = $envio['CodigoCorreios']['nome'];
                                                                            }
                                                                            
                                                                        }

                                                                        if($servico->Erro == 0) {

                                                                            if (isset($id_envio)) {

                                                                                $prazo = $servico->PrazoEntrega + 1;
                                                                                if ($prazo_adicional > 0) {
                                                                                    $prazo += $prazo_adicional;
                                                                                }

                                                                                if ($taxa_tipo == 'fixo') {
                                                                                    $valor_final = floatval($servico->Valor) + $taxa_valor;
                                                                                } else {

                                                                                    $valor = floatval( $servico->Valor );
                                                                                    $percentual   = ( $taxa_valor / 100.0 );
                                                                                    $valor_final += ( $percentual * $valor );

                                                                                }                           

                                                                                if ( $prazo <= 1) {
                                                                                    $prazo_data = sprintf('Dia da postagem<br /> +%s dia útil', $prazo);
                                                                                } else {
                                                                                    $prazo_data = sprintf('Dia da postagem<br /> +%s dias úteis', $prazo);
                                                                                }

                                                                                $checked = '';
                                                                                if (!(strcmp($carrinho_id_envio, $id_envio))) {
                                                                                    $checked = 'checked="checked"';
                                                                                    $frete_checked_valor = $valor_final;
                                                                                    $frete_checked_nome = $nome;
                                                                                }
                                                                                
                                                                                echo '<tr>
                                                                                        <th><input name="forma_envio_id[]" type="radio" '.$checked.' value="'.  $id_envio .'" id="s_method_flatrate_flatrate" class="radio" /></th>
                                                                                        <td style="font-weight: bold">'. $nome .'</td>
                                                                                        <td><span style="font-size:13px; font-weight: normal;">'. $prazo_data .'</span></td>
                                                                                        <td><span class="price">R$ '. \Lib\Tools::convertToDecimalBR( $valor_final ) .'</span></td>
                                                                                    </tr> ' . PHP_EOL;
                                                                            }        

                                                                        } else {

                                                                           

                                                                        }

                                                                    endforeach;

                                                                endif;

                                                   
                                                                if ( isset($envio_motoboy ) && \Lib\Validate::isNotNull( $envio_motoboy ) ) {
                                                                                              
                                                                    foreach ($envio_motoboy as $key => $envio):

                                                                        if ($envio['ShopEnvioMotoboy']['id_envio_default']) {

                                                                            $prazo = $envio['ShopEnvioMotoboy']['prazo_entrega'];
                                                                            if ( $prazo <= 1) {
                                                                                $prazo_data = sprintf('%s dia útil', $prazo);
                                                                            } else {
                                                                                $prazo_data = sprintf('%s dias úteis', $prazo);
                                                                            }

                                                                            $checked = '';
                                                                            if (!(strcmp($carrinho_id_envio, $envio['ShopEnvioMotoboy']['id_envio_default']))) {
                                                                                $checked = 'checked="checked"';
                                                                                $frete_checked_valor = $envio['ShopEnvioMotoboy']['valor'];
                                                                                $frete_checked_nome = 'MotoBoy';
                                                                            }                                                                        

                                                                            echo '<tr>
                                                                                <th><input name="forma_envio_id[]" type="radio" '. $checked .' value="'. $envio['ShopEnvioMotoboy']['id_envio_default'] .'" id="s_method_flatrate_flatrate" class="radio" /></th>
                                                                                <td style="font-weight: bold">MotoBoy</td>
                                                                                <td><span style="font-size:13px; font-weight: normal;">'. $prazo_data .'</span></td>
                                                                                <td><span class="price">R$ '. \Lib\Tools::convertToDecimalBR( $envio['ShopEnvioMotoboy']['valor'] ) .'</span></td>
                                                                            </tr>';

                                                                        }

                                                                    endforeach;

                                                                }


                                                                if ( \Lib\Validate::isNotNull($envio_pessoalmente) ) {

                                                                    foreach ($envio_pessoalmente as $envio) : 

                                                                        if (isset($envio['ShopEnvioPessoalmente']['id_envio_default'])) {

                                                                            $checked = '';
                                                                            if (!(strcmp($carrinho_id_envio, $envio['ShopEnvioPessoalmente']['id_envio_default']))) {
                                                                                $checked = 'checked="checked"';
                                                                                $frete_checked_valor = 0.00;
                                                                                $frete_checked_nome = 'Retirar Pessoalmente';
                                                                            }

                                                                            echo '<tr>
                                                                                    <th><input name="forma_envio_id[]" type="radio" '.$checked.' value="'. $envio['ShopEnvioPessoalmente']['id_envio_default'] .'" id="s_method_flatrate_flatrate" class="radio" /></th>
                                                                                    <td style="font-weight: bold">Retirar Pessoalmente</td>
                                                                                    <td><span style="font-size:13px; font-weight: normal;">'. $envio['ShopEnvioPessoalmente']['regiao'] .'</span></td>
                                                                                    <td><span class="price">R$ 0,00</span></td>
                                                                                </tr> ' . PHP_EOL;

                                                                        }    


                                                                    endforeach;

                                                                }

                                                                if ( \Lib\Validate::isNotNull($envio_transportadora) ) {

                                                                    $calc_kg_adicional_personalizado = false;

                                                                    if (array_key_exists('calcular_kg_adicional', $envio_transportadora)){

                                                                        $calc_kg_adicional_personalizado = true;

                                                                        foreach ($envio_transportadora as $key => $envio) {

                                                                            if ($key !== 'calcular_kg_adicional' && !empty($envio['ShopEnvioTransportadora']['peso_final'])) {

                                                                                if (isset($envio['ShopEnvioTransportadora']['id_envio_default'])) {

                                                                                    $valor = 0;
                                                                                    if ( !empty($envio['ShopEnvioTransportadora']['kg_adicional']) ) {

                                                                                        $peso_final = $envio['ShopEnvioTransportadora']['peso_final'];              
                                                                                        $valor = $envio['ShopEnvioTransportadora']['valor'];                
                                                                                        $peso  = round( floatval( $total_peso ) );
                                                                                        $valor += ( $envio['ShopEnvioTransportadora']['kg_adicional'] * ( $peso - $peso_final ) );

                                                                                    }

                                                                                    $prazo_entrega = $envio['ShopEnvioTransportadora']['prazo_entrega'];
                                                                                    if ( $prazo_entrega <= 1) {
                                                                                        $prazo_data = sprintf('Dia da postagem<br /> +%s dia útil', $prazo_entrega);
                                                                                    } else {
                                                                                        $prazo_data = sprintf('Dia da postagem<br /> +%s dias úteis', $prazo_entrega);
                                                                                    }

                                                                                    $checked = '';
                                                                                    if (!(strcmp($carrinho_id_envio, $envio['ShopEnvioTransportadora']['id_envio_default']))) {
                                                                                        $checked = 'checked="checked"';
                                                                                        $frete_checked_valor = $valor;
                                                                                        $frete_checked_nome = 'Transportadora'
    ;
                                                                                    }

                                                                                    echo '<tr>
                                                                                            <th><input name="forma_envio_id[]" type="radio" '.$checked.' value="'.  $envio['ShopEnvioTransportadora']['id_envio_default'] .'" id="s_method_flatrate_flatrate" class="radio" /></th>
                                                                                            <td style="font-weight: bold">Transportadora</td>
                                                                                            <td><span style="font-size:13px; font-weight: normal;">'. $prazo_data .'</span><br /><i style="font-size:12px; font-weight:normal;"> ('. $envio['ShopEnvioTransportadora']['regiao'] .')</i></td>
                                                                                            <td><span class="price">R$ '. \Lib\Tools::convertToDecimalBR( $valor ) .'</span></td>
                                                                                        </tr> ' . PHP_EOL; 

                                                                                }                               

                                                                            }

                                                                        }

                                                                    }


                                                                    if ($calc_kg_adicional_personalizado === false ) {

                                                                        foreach ($envio_transportadora as $key => $envio) {

                                                                            if (isset($envio['ShopEnvioTransportadora']['id_envio_default'])) {

                                                                                $prazo_entrega = $envio['ShopEnvioTransportadora']['prazo_entrega'];
                                                                                if ( $prazo_entrega <= 1) {
                                                                                    $prazo_data = sprintf('Dia da postagem<br /> +%s dia útil', $prazo_entrega);
                                                                                } else {
                                                                                    $prazo_data = sprintf('Dia da postagem<br /> +%s dias úteis', $prazo_entrega);
                                                                                }

                                                                                $checked = '';
                                                                                if (!(strcmp($carrinho_id_envio, $envio['ShopEnvioTransportadora']['id_envio_default']))) {
                                                                                    $checked = 'checked="checked"';
                                                                                    $frete_checked_valor = $envio['ShopEnvioTransportadora']['valor'];
                                                                                    $frete_checked_nome = 'Transportadora';
                                                                                }

                                                                                echo '<tr>
                                                                                        <th><input name="forma_envio_id[]" type="radio" '.$checked.' value="'.  $envio['ShopEnvioTransportadora']['id_envio_default'] .'" id="s_method_flatrate_flatrate" class="radio" /></th>
                                                                                        <td style="font-weight: bold">Transportadora<br /><i style="font-size:12px; font-weight:normal;">'. $envio['ShopEnvioTransportadora']['regiao'] .'</i></td>
                                                                                        <td><span style="font-size:13px; font-weight: normal;">'. $prazo_data .'</span></td>
                                                                                        <td><span class="price">R$ '. \Lib\Tools::convertToDecimalBR( $envio['ShopEnvioTransportadora']['valor'] ) .'</span></td>
                                                                                    </tr> ' . PHP_EOL; 

                                                                            }

                                                                        }

                                                                    }

                                                                }


                                                                //Fora da faixa de Cep, efetuar calculo por preco por kg adcional
                                                                if ( \Lib\Validate::isNotNull($envio_personalizado) ) {
                                                            
                                                                    $calc_kg_adicional_personalizado = false;

                                                                    if (array_key_exists('calcular_kg_adicional', $envio_personalizado)){

                                                                        $calc_kg_adicional_personalizado = true;    

                                                                        foreach ($envio_personalizado as $key => $envio) {
                                                                        
                                                                            if ($key !== 'calcular_kg_adicional' && !empty($envio['ShopEnvioPersonalizadoPeso']['peso_fim'])) {


                                                                                if (isset($envio['ShopEnvioPersonalizado']['id_envio_default'])) {

                                                                                    /**
                                                                                     * Acrescenta ao frete 
                                                                                     * definido em personalização
                                                                                     */                 
                                                                                    $prazo_entrega = $envio['ShopEnvioPersonalizadoFaixa']['prazo_entrega'];

                                                                                    if ($envio['ShopEnvioPersonalizado']['prazo_adicional'] > 0) {
                                                                                        $prazo_entrega += $envio['ShopEnvioPersonalizado']['prazo_adicional'];
                                                                                    }

                                                                                    if ( $prazo_entrega <= 1) {
                                                                                        $prazo_data = sprintf('Dia da postagem<br /> +%s dia útil', $prazo_entrega);
                                                                                    } else {
                                                                                        $prazo_data = sprintf('Dia da postagem<br /> +%s dias úteis', $prazo_entrega);
                                                                                    }

                                                                                    $valor = 0;
                                                                                    if ( !empty($envio['ShopEnvioPersonalizadoRegiao']['kg_adicional']) ) {

                                                                                        $peso_fim = $envio['ShopEnvioPersonalizadoPeso']['peso_fim'];               
                                                                                        $valor = $envio['ShopEnvioPersonalizadoPeso']['valor'];             
                                                                                        $peso  = round( floatval( $total_peso ) );
                                                                                        $valor += ( $envio['ShopEnvioPersonalizadoRegiao']['kg_adicional'] * ( $peso - $peso_fim ) );

                                                                                    }

                                                                                    /**
                                                                                     * Acrescenta ao frete 
                                                                                     * definido em personalização
                                                                                     */
                                                                                    if (!empty($envio['ShopEnvioPersonalizado']['taxa_valor'])) {

                                                                                        if ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'fixo') {

                                                                                            $valor += $envio['ShopEnvioPersonalizado']['taxa_valor'];

                                                                                        } elseif ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'porcentagem') {

                                                                                            $percentual = ( $envio['ShopEnvioPersonalizado']['taxa_valor'] / 100.0 );
                                                                                            $valor += ( $percentual * $valor );


                                                                                        }

                                                                                    }


                                                                                    /**
                                                                                     * Preço por KG adicional
                                                                                     * Valor que será pago por KG adicional que ultrapassar o limite de peso desta configuração
                                                                                     */ 
                                                                                
                                                                               
                                                                                
                                                                                    $checked = '';
                                                                                    if (!(strcmp($carrinho_id_envio, $envio['ShopEnvioPersonalizado']['id_envio_default']))) {
                                                                                        $checked = 'checked="checked"';
                                                                                        $frete_checked_valor = $valor;
                                                                                        $frete_checked_nome = $envio['ShopEnvioPersonalizado']['nome'];
                                                                                    }                        

                                                                                    echo '<tr>
                                                                                            <th><input name="forma_envio_id[]" type="radio" '.$checked.' value="'. $envio['ShopEnvioPersonalizado']['id_envio_default'] .'" id="s_method_flatrate_flatrate" class="radio" /></th>
                                                                                            <td style="font-weight: bold">'. $envio['ShopEnvioPersonalizado']['nome'] .'<br /><i style="font-size:12px; font-weight:normal;">'. $envio['ShopEnvioPersonalizadoRegiao']['nome'] .'</i></td>
                                                                                            <td><span style="font-size:13px; font-weight: normal;">'. $prazo_data .'</span></td>
                                                                                            <td><span class="price">R$ '. \Lib\Tools::convertToDecimalBR( $valor ) .'</span></td>
                                                                                        </tr> ' . PHP_EOL;

                                                                                }      


                                                                            }

                                                                            $envio_personalizado = null;

                                                                        }
                                                                        
                                                                    }

                                                                    //Dentro da Faixa de Peso
                                                                    if ($calc_kg_adicional_personalizado === false) {

                                                                        foreach ($envio_personalizado as $key => $envio) {

                                                                            /**
                                                                             * Acrescenta ao frete 
                                                                             * definido em personalização
                                                                             */                 
                                                                            $prazo_entrega = $envio['ShopEnvioPersonalizadoFaixa']['prazo_entrega'];

                                                                            if ($envio['ShopEnvioPersonalizado']['prazo_adicional'] > 0) {
                                                                                $prazo_entrega += $envio['ShopEnvioPersonalizado']['prazo_adicional'];
                                                                            }

                                                                            if ( $prazo_entrega <= 1) {
                                                                                $prazo_data = sprintf('Dia da postagem<br /> +%s dia útil', $prazo_entrega);
                                                                            } else {
                                                                                $prazo_data = sprintf('Dia da postagem<br /> +%s dias úteis', $prazo_entrega);
                                                                            }

                                                                            $valor = $envio['ShopEnvioPersonalizadoPeso']['valor'];

                                                                            /**
                                                                             * Acrescenta ao frete 
                                                                             * definido em personalização
                                                                             */
                                                                            if (!empty($envio['ShopEnvioPersonalizado']['taxa_valor'])) {

                                                                                if ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'fixo') {

                                                                                    $valor += $envio['ShopEnvioPersonalizado']['taxa_valor'];

                                                                                } elseif ($envio['ShopEnvioPersonalizado']['taxa_tipo'] == 'porcentagem') {

                                                                                    $percentual = ( $envio['ShopEnvioPersonalizado']['taxa_valor'] / 100.0 );
                                                                                    $valor += ( $percentual * $valor );

                                                                                }

                                                                            }


                                                                            if (isset($envio['ShopEnvioPersonalizado']['id_envio_default'])) {

                                                                                $checked = '';
                                                                                if (!(strcmp($carrinho_id_envio, $envio['ShopEnvioPersonalizado']['id_envio_default']))) {
                                                                                    $checked = 'checked="checked"';
                                                                                    $frete_checked_valor = $valor;
                                                                                    $frete_checked_nome = $envio['ShopEnvioPersonalizado']['nome'];
                                                                                }

                                                                                echo '<tr>
                                                                                        <th><input name="forma_envio_id[]" type="radio" '.$checked.' value="'.  $envio['ShopEnvioPersonalizado']['id_envio_default'] .'" id="s_method_flatrate_flatrate" class="radio" /></th>
                                                                                        <td style="font-weight: bold">'. $envio['ShopEnvioPersonalizado']['nome'] .'<br /><i style="font-size:12px; font-weight:normal;">'. $envio['ShopEnvioPersonalizadoRegiao']['nome'] .'</i></td>
                                                                                        <td><span style="font-size:13px; font-weight: normal;">'. $prazo_data .'</span></td>
                                                                                        <td><span class="price">R$ '. \Lib\Tools::convertToDecimalBR( $valor ) .'</span></td>
                                                                                    </tr> '. PHP_EOL;

                                                                            }    


                                                                        }

                                                                    }

                                                                }

                                                                ?>

                                                            </table>

                                                        </dd>
                                                    </dl>
                                                    <div class="buttons-set">
                                                        <button type="submit" title="Atualizar Total" class="button" name="do" value="Atualizar Total"><span><span>Atualizar Total</span></span></button>
                                                    </div>
                                                </form>

                                                <?php } ?>

                                                <?php endif ?>

                                                <?php } ?>

                                                <script type="text/javascript">
                                                    //<![CDATA[
                                                        var coShippingMethodForm = new VarienForm('shipping-zip-form');             
                                                    
                                                        coShippingMethodForm.submit = function (isRemove) {                                                          
                                                            if (isRemove) {
                                                                $('cep_code').removeClassName('required-entry');
                                                                $('remove-cep-code').value = "1";
                                                            }
                                                            else {
                                                                $('cep_code').addClassName('required-entry');
                                                                $('remove-cep-code').value = "0";
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
                                <a name="total"></a>
                                <div class="totals">
                                    <table id="shopping-cart-totals-table">
                                        <col />
                                        <col width="1" />
                                        <tfoot>
                                            <tr>
                                                <td style="" class="a-right" colspan="1">
                                                    <strong>Total Geral</strong>
                                                </td>
                                                <?php 
                                                /**
                                                 * Calcula preço final
                                                 */                                                
                                                $total_pedido = $subtotal_pedido;
                                                 
                                                $total_frete = 0;   
                                                if (isset($frete_checked_valor)) {
                                                    $total_frete = $frete_checked_valor;
                                                }                                                                                               

                                                switch ($tipo_desconto) {
                                       
                                                    case 'porcentagem':
                                                        //$total_pedido = $total_pedido * ( 1 - $total_desconto / 100 );
                                                        $total_desconto = ($total_desconto / 100) * $total_pedido;
                                                        $total_pedido = ( $total_pedido - $total_desconto );
                                                        break;

                                                    case 'fixo':
                                                        $total_pedido = ( $total_pedido - $total_desconto );
                                                        break;
                                                    
                                                    default:
                                                        # code...
                                                        break;
                                                }                                                

                                                if (isset($total_frete)) {
                                                    $total_pedido = ( $total_pedido + $total_frete );
                                                }                                                

                                                ?>
                                                <td style="" class="a-right">
                                                    <strong><span class="price">R$ <?php echo \Lib\Tools::convertToDecimalBR( $total_pedido ); ?></span></strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td style="" class="a-right" colspan="1">
                                                    Subtotal    
                                                </td>
                                                <td style="" class="a-right">
                                                    <span class="price">R$ <?php echo \Lib\Tools::convertToDecimalBR( $subtotal_pedido ); ?></span>
                                                </td>
                                            </tr>

     
                                            <?php if (isset($tipo_desconto)){ ?>

                                                <?php if ($tipo_desconto == 'frete_gratis'): ?>

                                                <tr>
                                                    <td style="font-size:15px;" class="a-right" colspan="1">
                                                        Desconto (CUPOM)   
                                                    </td>
                                                    <td style="" class="a-right">
                                                        <span class="price">Frete</span>    
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size:15px;" class="a-right" colspan="1">
                                                        Forma de envio
                                                    </td>
                                                    <td style="" class="a-right">
                                                        <span class="price">Frete Grátis</span>    
                                                    </td>
                                                </tr>

                                                <?php else: ?>

                                                    <tr>
                                                        <td style="font-size:15px;" class="a-right" colspan="1">
                                                            Desconto (CUPOM)   
                                                        </td>
                                                        <td style="" class="a-right">                                                

                                                            <span class="price">- R$ <?php echo \Lib\Tools::convertToDecimalBR( $total_desconto ); ?></span>
                                                      
                                                        </td>
                                                    </tr>

                                                    <?php if (isset($frete_checked_nome, $frete_checked_valor)): ?>

                                                        <tr>
                                                            <td style="font-size:15px;" class="a-right" colspan="1">
                                                                Forma de envio (<?php echo $frete_checked_nome; ?>)  
                                                            </td>
                                                            <td style="" class="a-right">
                                                                <span class="price">R$ <?php echo \Lib\Tools::convertToDecimalBR($frete_checked_valor ); ?></span>
                                                            </td>
                                                        </tr>

                                                     <?php endif ?>

                                                <?php endif; ?>

                                            <?php } else { ?>

                                                <?php if (isset($frete_checked_nome, $frete_checked_valor)): ?>

                                                    <tr>
                                                        <td style="font-size:15px;" class="a-right" colspan="1">
                                                            Forma de envio (<?php echo $frete_checked_nome; ?>)  
                                                        </td>
                                                        <td style="" class="a-right">
                                                            <span class="price">R$ <?php echo \Lib\Tools::convertToDecimalBR($frete_checked_valor ); ?></span>
                                                        </td>
                                                    </tr>

                                                 <?php endif ?>

                                            <?php }?>

                                        </tbody>
                                    </table>
                                    <ul class="checkout-types">
                                        <li><button type="button" id="btn-proceed-checkout" title="Finalizar Pedido" class="button btn-proceed-checkout btn-checkout"><span><span>Finalizar Pedido</span></span></button></li>
                                        
                                        <?php
                                        /*
                                        <li><a href="/checkout/multishipping/" title="Despacho para múltiplos endereços de um pedido">Finalizar Pedido com Múltiplos Endereços</a></li>
                                        */    
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endif ?>
                </div>
            </section>
        </div>
    </div>
</section>