<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
    
<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar"></i> Formas de pagamento</a> <span class="bread-separator">-</span></li>
        <li><span>Listar formas de pagamento</span></li>
    </ul>
</div>
<div class="alert alert-error">
    <h3>O PayPal ainda não está corretamente configurado</h3>
    <p>
        Para você efetuar vendas na sua loja você deve configurar corretamente a forma de pagamento.<br/>
        <a style="margin-top: 5px;" class="btn btn-small" href="/admin/configuracao/pagamento/editar/3"><i class="icon-cog"></i> Configurar a forma de pagamento PayPal</a>
    </p>
</div>

<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Formas de pagamento</h3>
        </div>
        <div class="box-content table-content">
            <table class="table table-pagamento table-generic-list">

                <?php foreach ($res_pagamentos as $key => $pagamento): ?>

                <tr class="">
                    <td class="imagem">
                        <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/editar/<?php echo $pagamento['ConfiguracaoPagamento']['id_config_pagamento'] ?>" target="_self" title="Editar Produto">
                        <img src="/admin/img/formas-de-pagamento/<?php echo $pagamento['ConfiguracaoPagamento']['logo'] ?>" />
                        </a>
                    </td>
                    <td class="nome">
                        <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/editar/<?php echo $pagamento['ConfiguracaoPagamento']['id_config_pagamento'] ?>" target="_self" title="Editar Produto" class="title">
                        <?php echo $pagamento['ConfiguracaoPagamento']['nome'] ?><br/>
                        </a>
                    </td>
                    <td class="ativo" style="width: 130px;">
                        <span class="status">

                        <?php
                        if (isset($id_plano) && $id_plano <= 1) {

                            switch ($pagamento['ConfiguracaoPagamento']['slug']) {
                                
                                case 'pagamento_deposito':
                                case 'pagamento_boleto':                              
                                    echo '<span class="icon-warning-sign"></span> <b>Não disponível</b> <span class=" icon-info-sign" data-toggle="tooltip" data-placement="top" data-original-title="Recurso disponível a partir do plano 2"></span>';
                                    break;
                                default:

                                    if ($pagamento['ShopPagamento']['ativo'] == 'True'):

                                        if ($pagamento['ConfiguracaoPagamento']['slug'] == 'pagamento_paypal') {
                                   
                                            if (empty($pagamento['ShopPagamentoFacilitador']['usuario'])) {
                                                echo '<span class="icon-custom icon-white icon-power on"></span> Não configurado </span>' . PHP_EOL;
                                            } else {
                                                echo '<span class="icon-custom icon-white icon-power on"></span> Ativo </span>' . PHP_EOL;
                                            }

                                        } else {

                                            if (empty($pagamento['ShopPagamentoFacilitador']['usuario'])
                                                || empty($pagamento['ShopPagamentoFacilitador']['token']) ) {
                                                echo '<span class="icon-custom icon-white icon-power on"></span> Não configurado </span>' . PHP_EOL;
                                            } else {
                                                echo '<span class="icon-custom icon-white icon-power on"></span> Ativo </span>' . PHP_EOL;
                                            }

                                        }                          
                                        
                                    else:                       

                                        echo '<span class="icon-custom icon-white icon-power off"></span> Inativo
                                        </span>' . PHP_EOL;
                                        
                                    endif;

                                    break;                               
                                
                            }

                        } else {


                            if ($pagamento['ShopPagamento']['ativo'] == 'True'):

                                switch ($pagamento['ConfiguracaoPagamento']['slug']) {
                                    case 'pagamento_paypal':

                                        if (empty($pagamento['ShopPagamentoFacilitador']['usuario'])) {
                                            echo '<span class="icon-custom icon-white icon-power on"></span> Não configurado </span>' . PHP_EOL;
                                        } else {
                                            echo '<span class="icon-custom icon-white icon-power on"></span> Ativo </span>' . PHP_EOL;
                                        }

                                        break;

                                    case 'pagamento_deposito':

                                        if (isset($pagamento['ShopPagamentoDepositoConfig']['ativo']) 
                                            && $pagamento['ShopPagamentoDepositoConfig']['ativo'] == 'True' ) {
                                            
                                            if (empty($pagamento['ShopPagamentoDepositoConfig']['agencia']) 
                                                || empty($pagamento['ShopPagamentoDepositoConfig']['numero_conta']) 
                                                || empty($pagamento['ShopPagamentoDepositoConfig']['favorecido'])) {

                                                echo '<span class="icon-custom icon-white icon-power on"></span> Não configurado </span>' . PHP_EOL;
                                            
                                            } else {

                                                echo '<span class="icon-custom icon-white icon-power on"></span> Ativo </span>' . PHP_EOL;
                                            }

                                        } else {

                                            echo '<span class="icon-custom icon-white icon-power on"></span> Não configurado </span>' . PHP_EOL;
                                        }

                                        break;   
                                    
                                    default:
                                        
                                        if (empty($pagamento['ShopPagamentoFacilitador']['usuario'])
                                        || empty($pagamento['ShopPagamentoFacilitador']['token']) ) {
                                            echo '<span class="icon-custom icon-white icon-power on"></span> Não configurado </span>' . PHP_EOL;
                                        } else {
                                            echo '<span class="icon-custom icon-white icon-power on"></span> Ativo </span>' . PHP_EOL;
                                        }

                                        break;
                                }

                            else:                         

                                echo '<span class="icon-custom icon-white icon-power off"></span> Inativo
                                </span>' . PHP_EOL;
                                
                            endif;

                        }
                        ?>
                       
                    </td>
                </tr>
                    
                <?php endforeach ?>

            </table>
        </div>
    </div>
</div>
