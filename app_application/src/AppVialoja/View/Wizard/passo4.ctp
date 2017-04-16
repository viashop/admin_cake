
<script type="text/javascript">
    $(document).ready(function() {
        $('#forma_pagamento').submit(function(event) {
                $.loader('Finalizando configuração da loja...', true);
                return true;
            });
    });
    
</script>

<div id="wizard globalContainer">
    <!-- .navbar -->
    <div class="body container">
        <?php
        echo $this->element('wizard/progressBar');
        ?>
        <form method="post" action="<?php echo Router::url(); ?>" id="forma_pagamento">
            <div class="step-title title-pagamento">
                <i class="icon-wizard icon-step">04</i>
                <h1>Escolha as formas de pagamento disponíveis em sua loja<small class="icon-wizard icon-card icon-title"></small></h1>
            </div>
            <div class="list-choice">
                <div class="head">
                    <i class="icon-wizard icon-greyarrow"></i>
                    <i class="icon-wizard icon-whitearrow"></i>
                    <ul>
                        <li class="colored a-vista"><strong>Cartão débito, boleto e transferência</strong></li>
                        <li class="colored"><strong>Cartão<br/>de crédito<br/>parcelado</strong></li>
                        <li><img src="/admin/img/samples/visa.png" title="Cartão visa" /></li>
                        <li><img src="/admin/img/samples/mastercard.png" title="Cartão Mastercard" /></li>
                        <li><img src="/admin/img/samples/hipercard.png" title="Cartão Hipercard" /></li>
                        <li><img src="/admin/img/samples/itau.png" title="Banco Itau" /></li>
                        <li><img src="/admin/img/samples/bradesco.png" title="Banco Bradesco" /></li>
                        <li><img src="/admin/img/samples/bb.png" title="Banco do Brasil" /></li>
                        <li><img src="/admin/img/samples/boleto.png" title="Boleto" /></li>
                    </ul>
                    <span class="clear"></span>
                </div>
                <div class="list-options">

                    <?php
                    foreach ($res_pagamentos as $key => $pagamento):

                    switch ($pagamento['ConfiguracaoPagamento']['slug']) {
                        
                        case 'pagamento_mercado_pago':
                        case 'pagamento_pagseguro':
                        case 'pagamento_pagamento_digital':
                        case 'pagamento_paypal':                         
                        
                    ?>

                    <div id="<?php echo $pagamento['ConfiguracaoPagamento']['slug']; ?>" class="list-item active ">
                        <label for="<?php echo $pagamento['ConfiguracaoPagamento']['id_for']; ?>">
                            <ul>
                                <li class="radio-slot">
                                    <input type="radio" name="id_pagamento[]" value="<?php echo $pagamento['ConfiguracaoPagamento']['id_config_pagamento']; ?>" id="<?php echo $pagamento['ConfiguracaoPagamento']['id_for']; ?>" <?php echo $pagamento['ConfiguracaoPagamento']['checked']; ?>  />
                                </li>
                                <li class="logo-slot">
                                    <span class="list-item-logo <?php echo $pagamento['ConfiguracaoPagamento']['id_for']; ?>"><?php echo $pagamento['ConfiguracaoPagamento']['id_for']; ?></span>
                                </li>
                                <li class="value-slot">
                                    <span class="single-value">
                                    4,99%
                                    </span>
                                    <span class="single-value">
                                    4,99%
                                    </span>
                                </li>
                                <li class="check-slot">
                                    <ul>
                                        <li><i class="icon-wizard icon-small icon-<?php echo $pagamento['ConfiguracaoPagamento']['cartao_visa']; ?>"></i></li>
                                        <li><i class="icon-wizard icon-small icon-<?php echo $pagamento['ConfiguracaoPagamento']['cartao_master_card']; ?>"></i></li>
                                        <li><i class="icon-wizard icon-small icon-<?php echo $pagamento['ConfiguracaoPagamento']['cartao_hipercard'] ; ?>"></i></li>
                                        <li><i class="icon-wizard icon-small icon-<?php echo $pagamento['ConfiguracaoPagamento']['banco_itau']; ?>"></i></li>
                                        <li><i class="icon-wizard icon-small icon-<?php echo $pagamento['ConfiguracaoPagamento']['banco_bradesco']; ?>"></i></li>
                                        <li><i class="icon-wizard icon-small icon-<?php echo $pagamento['ConfiguracaoPagamento']['banco_bb']; ?>"></i></li>
                                        <li><i class="icon-wizard icon-small icon-<?php echo $pagamento['ConfiguracaoPagamento']['boleto'] ; ?>"></i></li>
                                    </ul>
                                </li>
                            </ul>
                        </label>
                    </div>

                    <?php

                        # code...
                            break;
                        
                        default:
                            # code...
                            break;
                    }

                    endforeach;

                    /*
                    ?>

                    <!-- list-item -->
                    <div id="pagamento_pagseguro" class="list-item ">
                        <label for="pagseguro">
                            <ul>
                                <li class="radio-slot">
                                    <input type="radio" name="id_pagamento[]" value="1" id="pagseguro"  />
                                </li>
                                <li class="logo-slot">
                                    <span class="list-item-logo pagseguro">PagSeguro</span>
                                </li>
                                <li class="value-slot">
                                    <span class="single-value">
                                    4,79%
                                    </span>
                                    <span>
                                    4,79% <br />+ R$ 0,40
                                    </span>
                                </li>
                                <li class="check-slot">
                                    <ul>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                    </ul>
                                </li>
                            </ul>
                        </label>
                    </div>
                    <!-- list-item -->
                    <div id="pagamento_pagamento_digital" class="list-item ">
                        <label for="pagamentodigital">
                            <ul>
                                <li class="radio-slot">
                                    <input type="radio" name="id_pagamento[]" value="2" id="pagamentodigital" checked="checked" />
                                </li>
                                <li class="logo-slot">
                                    <span class="list-item-logo pagamentodigital">Bcash</span>
                                </li>
                                <li class="value-slot">
                                    <span class="single-value">
                                    2,89%
                                    </span>
                                    <span class="single-value">
                                    6,39%
                                    </span>
                                </li>
                                <li class="check-slot">
                                    <ul>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                    </ul>
                                </li>
                            </ul>
                        </label>
                    </div>
                    <!-- list-item -->
                    <div id="pagamento_paypal" class="list-item ">
                        <label for="paypal">
                            <ul>
                                <li class="radio-slot">
                                    <input type="radio" name="id_pagamento[]" value="3" id="paypal"  />
                                </li>
                                <li class="logo-slot">
                                    <span class="list-item-logo paypal">paypal</span>
                                </li>
                                <li class="value-slot">
                                    <span class="single-value">-</span>
                                    <span>
                                    <i class="icon-wizard icon-tax"></i>
                                    6,4% <br />+ R$ 0,60
                                    </span>
                                </li>
                                <li class="check-slot">
                                    <ul>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-greycheck"></i></li>
                                        <li><i class="icon-wizard icon-small icon-none"></i></li>
                                        <li><i class="icon-wizard icon-small icon-none"></i></li>
                                        <li><i class="icon-wizard icon-small icon-none"></i></li>
                                        <li><i class="icon-wizard icon-small icon-none"></i></li>
                                        <li><i class="icon-wizard icon-small icon-none"></i></li>
                                    </ul>
                                </li>
                            </ul>
                        </label>
                    </div>
                    */
                    ?>

                    <?php
                    foreach ($res_pagamentos as $key => $pagamento):


                    if ($pagamento['ConfiguracaoPagamento']['slug'] == 'pagamento_deposito') :
                        
                    ?>

                    <!-- list-item -->
                    <div id="<?php echo $pagamento['ConfiguracaoPagamento']['slug']; ?>" class="list-item ">
                        <label for="<?php echo $pagamento['ConfiguracaoPagamento']['id_for']; ?>">
                            <ul>
                                <li class="radio-slot">
                                    <input type="checkbox" name="id_pagamento[]" value="<?php echo $pagamento['ConfiguracaoPagamento']['id_config_pagamento']; ?>" id="<?php echo $pagamento['ConfiguracaoPagamento']['id_for']; ?>"  />
                                </li>
                                <li class="logo-slot">
                                    <span class="list-item-logo depositobancario">
                                    <?php echo $pagamento['ConfiguracaoPagamento']['nome']; ?>
                                    </span>
                                </li>
                                <li class="check-slot">
                                    <ul>
                                        <li><img src="/admin/img/samples/caixa.png" alt="Caixa Econômica" class="" /></li>
                                        <li><img src="/admin/img/samples/santander.png" alt="Santander" class="" /></li>
                                        <li><img src="/admin/img/samples/hsbc.png" alt="HSBC" class="" /></li>
                                        <li><img src="/admin/img/samples/itau.png" alt="Itau" class="" /></li>
                                        <li><img src="/admin/img/samples/bradesco.png" alt="Bradesco" class="" /></li>
                                        <li><img src="/admin/img/samples/bb.png" alt="Banco do Brasil" class="" /></li>
                                        <li><img src="/admin/img/samples/citi.png" alt="CitiBank" class="" /></li>
                                    </ul>
                                </li>
                            </ul>
                        </label>
                    </div>
                    <!-- list-item -->
                    <?php

                    endif;

                    endforeach;

                    ?>

                </div>
                <!-- list-options -->
            </div>
            <!-- list-choice -->
            <div class="action row-fluid">
                <div class="span6 alpha">
                    <p class="span12">
                        <small>
                        * A integração com o PagSeguro gera custos de operação que são repassados para a ViaLoja Shopping pelo PagSeguro (0,5%). Porém isso não altera o valor da taxa cobrada às lojas pelo PagSeguro pelas transações, 4,79%.
                        </small>
                        <small class="span12">* O depósito bancário esta disponivél somente do plano 2 em diante.</small>
                    </p>
                </div>
                <div class="span6 omega">
                    <input type="submit" id="processando" class="button-styled button-confirm btn-loading" value="Salvar e prosseguir" />
                    <a href="<?php echo VIALOJA_PAINEL ?>/wizard/passo-3/escolha-a-forma-de-pagamento-da-sua-loja" class="button-styled button-back">Voltar</a>
                </div>
            </div>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </form>
    </div>
    <!-- .body.container -->
</div>
