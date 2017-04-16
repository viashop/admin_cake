<style type="text/css">
<!--
input[type="checkbox"]{
    margin-top: -5px !important;
}

.help-block {
    margin-top: -8px !important;
}

.conheca{
    margin-left: 180px;
}
-->
</style>

<!-- configuração PagSeguro -->

<script type="text/javascript">
    $(document).ready(function() {

        $('#id_mostrar_parcelamento').change(function(event) {
            $('#parcelamento').stop().slideToggle();
            $('.control-group.maximo_parcelas, .control-group.parcelas_sem_juros').stop().slideToggle();
            $('#configuracao-parcelamento').stop().slideToggle();
            $('.alert-gateway').stop().slideToggle();
        });

        if($('#id_mostrar_parcelamento').attr('checked')) {
            $("#configuracao-parcelamento").show();
            $(".alert-gateway").show();
            $(".maximo_parcelas").show();
            $(".parcelas_sem_juros").show();
            $("#parcelamento").show();
        }
    
    
        $('[data-toggle=popover]').popover({'trigger': 'hover'});
    
    
        var parcelas = [];
        for (i = 0; i < $('#id_maximo_parcelas option').length; i++) {
            parcelas[i] = parseInt($('#id_maximo_parcelas option')[i].value);
        }
    
    
        $('#id_maximo_parcelas').change( function (event) {
            var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val());
    
            // Desativa parcelas do parcelas_sem_juros baseado no numero maximo de parcela.
            $('#id_parcelas_sem_juros option').removeAttr('disabled');
            for (i = 1; i <= parcelas.length; i++) {
                if (parcela_selecionada != 0 && parcela_selecionada != parseInt(parcelas[parcelas.length -1])) {
                    $('#id_parcelas_sem_juros option')[0].setAttribute('disabled', 'disabled');
                    $('#id_parcelas_sem_juros option[value="' + parcela_selecionada + '"]').attr('selected', 'true');
                }
                if (parcela_selecionada > 0 && parcela_selecionada < parcelas[i]) {
                    $('#id_parcelas_sem_juros option')[i].setAttribute('disabled', 'disabled');
                }
            }
    
            renovar_simulacao('maximo');
        });
    
    
        $('#id_parcelas_sem_juros').change( function (event) {
            renovar_simulacao('sem_juros');
        });
    
    
        // Esconde ou mostra as parcelas no simulacao de parcelamento.
        function renovar_simulacao(quem_chama) {
            $('#parcelas .parcela, #parcelas .parcela-sem-juros').hide();
    
            var parcela_selecionada    = parseInt($('#id_maximo_parcelas').val()),
                parcela_sj_selecionada = parseInt($('#id_parcelas_sem_juros').val());
    
            for (i = 1; i <= parcelas.length; i++) {
                if (parcela_selecionada == 0) {
                    if (quem_chama == 'maximo') {
                        $('#parcelas .parcela-sem-juros').hide();
                        $('#parcelas .parcela').show();
                    } else {
                        $('#parcelas .parcela').show();
                        var tmp_length = $('#parcelas .parcela-sem-juros:visible').length;
                        for (j = 1; j <= tmp_length; j++) {
                            $('#parcelas .parcela.p-' + j).hide();
                        }
                    }
                }
                else if (parcela_selecionada >= parcelas[i]) {
                    $('#parcelas .parcela.p-' + parcelas[i]).show();
                    $('#parcelas .parcela-sem-juros.p-' + parcelas[i]).hide();
                }
    
                if (parcela_sj_selecionada == 0) {
                    $('#parcelas .parcela-sem-juros').show();
                    $('#parcelas .parcela').hide();
                }
                else if (parcela_sj_selecionada >= parcelas[i] ) {
                    $('#parcelas .parcela.p-' + parcelas[i]).hide();
                    $('#parcelas .parcela-sem-juros.p-' + parcelas[i]).show();
                }
            }
        }
        renovar_simulacao();
        
         /*
    
        $('#formPagamentoEditar').submit(function() {
            if($('#id_li_msg').length && !$('#id_li_msg').is(':checked') && $('#id_ativo').val() != 'False') {
                $('#modal-error .error-text').html('Você precisa confirmar que leu e seguiu os passos.');
                jQuery.removeLoader();
                $('#modal-error').modal('show');
                return false;
            }
   
            if($('#li_msg').length && !$('#li_msg').is(':checked')) {
                $('.aviso-li-msg').remove();
                $('#mainContent').prepend('<div class="alert alert-error aviso-li-msg"><a class="close" data-dismiss="alert">×</a> <h4>Você precisa confirmar a leitura dos passos.</h4></div>');
                return false;
            }
  
        });
       
         
        $('#id_ativo').change(function() {
            var self = $(this);
            if (self.val() == 'True') {
                $('#forma-pagamento-corpo').slideDown();
            } else {
                $('#forma-pagamento-corpo').slideUp();
            }
        }).change();
        */
        
    });
</script>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar"></i> Formas de pagamento</a> <span class="bread-separator">-</span></li>
        <li><span>Configurando formas de pagamento</span></li>
    </ul>
</div>
<div class="row config-pagamento-editar">
    <form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post" id="formPagamentoEditar">
        <div class="box">
            <div class="box-header">
                <h3 class="pull-left">Forma de pagamento PagSeguro</h3>
            </div>
            <div class="box-content">
                <div class="control-group">
                    <div class="controls">
                        <img src="/admin/img/formas-de-pagamento/pagseguro-logo.png" />
                    </div>
                </div>
                <hr>

                <div class="control-group conheca">
                    <p>Para que o PagSeguro funcione corretamente, siga o seguintes passos:</p>
                    <p>1. Tenha uma conta no PagSeguro do tipo Vendedor. <a href="https://pagseguro.uol.com.br/account/viewDetails.jhtml" target="_blank">Clique aqui</a> para fazer a mudança;</p>
                    <p>2. No PagSeguro, entre no menu <strong>Preferências -> Frete</strong> e depois marque a opção <strong>Frete adicional com valor fixo</strong> e coloque o valor de <strong>R$ 0,00 reais</strong> e clique em <strong>CONFIRMAR</strong> no final da página.</p>
                 

                </div>
                <hr>
                <div class="control-group">
                    <label class="control-label"><strong>Pagamento ativo?</strong></label>
                    <div class="controls">
                        <select class="input-small" id="id_ativo" name="ativo">                     
                            <?php
                            if (\Lib\Tools::getValue("ativo") !="") {
                            ?>
                            <option value="True" <?php if (!(strcmp("True", \Lib\Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Sim</option>
                            <option value="False" <?php if (!(strcmp("False", \Lib\Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Não</option>

                            <?php
                            } else {
                            ?>

                            <?php if (!empty($status_pagamento['ShopPagamento']['ativo'])): ?>

                                <option value="True" <?php if (!(strcmp("True", $status_pagamento['ShopPagamento']['ativo']))) { echo 'selected="selected"';} ?>>Sim</option>

                                <option value="False" <?php if (!(strcmp("False", $status_pagamento['ShopPagamento']['ativo']))) {echo 'selected="selected"';} ?>>Não</option>
                                
                            <?php else: ?>

                                <option value="True">Sim</option>
                                <option value="False" selected="selected">Não</option>
                                
                            <?php endif ?>                         
                            
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                </div>
                <hr>
                <div class="convite-cadastro">
                    Ainda não tem conta no PagSeguro?<br/>
                    <a href="//www.pagseguro.com.br/" title="Criar conta PagSeguro" class="btn btn-info btn-mini" target="_blank">cadastre-se</a>
                </div>
                <div id="forma-pagamento-corpo" >

                    <?php
                    $error = null;
                    if (isset($error_usuario)) {
                        $error='error';
                    }
                    ?>
                    <div class="control-group <?php echo $error; ?> usuario">
                        <label class="control-label" for="id_usuario"><strong>Seu e-mail no PagSeguro</strong></label>
                        <div class="controls">
                            <input class="span6" id="id_usuario" maxlength="128" name="usuario" value="<?php 

                            if (\Lib\Validate::isPost()) {
                                echo \Lib\Tools::getValue('usuario');
                            } elseif (isset($facilitador['ShopPagamentoFacilitador']['usuario'])) {
                                echo $cipher->decrypt($facilitador['ShopPagamentoFacilitador']['usuario']);
                            }

                            ?>"  type="text" />
                            <?php
                            if (isset($error_usuario)) {
                                echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <?php
                    $error = null;
                    if (isset($error_token)) {
                        $error='error';
                    }
                    ?>
                    <div class="control-group <?php echo $error ?> token">
                        <label class="control-label" for="id_token"><strong>Seu Token de Segurança</strong></label>
                        <div class="controls">
                            <input class="span6" id="id_token" maxlength="32" name="token" value="<?php 

                            if (\Lib\Validate::isPost()) {
                                echo \Lib\Tools::getValue('token');
                            } elseif (isset($facilitador['ShopPagamentoFacilitador']['token'])) {
                                echo $cipher->decrypt($facilitador['ShopPagamentoFacilitador']['token']);
                            }

                            ?>"  type="text" />
                            <?php
                            if (isset($token_invalido)) {
                                echo '<ul class="errorlist"><li>Token de Segurança inválido.</li></ul>' . PHP_EOL;
                            } elseif (isset($error_token)) {
                                echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                            }
                            ?>
                        </div>
                    </div>

                    <hr />
                    <div class="control-group valor">
                        <label class="control-label" for="id_usuario"><strong>Valor mínimo</strong></label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">R$</span>
                                <input class="input-price" style="width:150px;" id="valor_minimo_aceitavel" type="text" name="valor_minimo_aceitavel" value="<?php

                                if (\Lib\Validate::isPost()) {
                                    echo \Lib\Tools::getValue('valor_minimo_aceitavel');
                                } elseif (isset($facilitador['ShopPagamentoFacilitador']['valor_minimo_aceitavel'])) {
                                    echo \Lib\Tools::convertToDecimalBR($facilitador['ShopPagamentoFacilitador']['valor_minimo_aceitavel']);
                                } else {
                                    echo '0,00';
                                }

                                ?>" />
                                <p class="help-block">Informe o valor mínimo para exibir esta forma de pagamento.</p>

                            </div>

                        </div>
                    </div>

                    <hr />
                    <div class="control-group valor">
                        <label class="control-label" for="id_usuario"><strong>Valor mínimo da parcela</strong></label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">R$</span>
                                <input class="input-price" style="width:150px;" id="valor_minimo_parcela" type="text" name="valor_minimo_parcela" value="<?php

                                if (\Lib\Validate::isPost()) {
                                    echo \Lib\Tools::getValue('valor_minimo_parcela');
                                } elseif (isset($facilitador['ShopPagamentoFacilitador']['valor_minimo_parcela'])) {
                                    echo \Lib\Tools::convertToDecimalBR($facilitador['ShopPagamentoFacilitador']['valor_minimo_parcela']);
                                } else {
                                    echo '0,00';
                                }

                                ?>" />
                                
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="control-group ">
                        <div class="controls">
                            <label class="checkbox">
                            <input id="id_mostrar_parcelamento" name="mostrar_parcelamento" type="checkbox" <?php 

                                if (\Lib\Validate::isPost()) {
                                    if (\Lib\Tools::getValue('mostrar_parcelamento') =='on'){
                                        echo 'checked="checked"';                                        
                                    }
                                } elseif (isset($facilitador['ShopPagamentoFacilitador']['mostrar_parcelamento'])) {
                                    if ($facilitador['ShopPagamentoFacilitador']['mostrar_parcelamento'] === 'on') {
                                        echo 'checked="checked"';
                                    }
                                }
                                ?> />
                            <strong>Marque para mostrar o parcelamento na listagem dos produtos e na página do produto.</strong>
                            </label>
                        </div>
                    </div>
                    <div class="controls hide" id="configuracao-parcelamento">
                        <h4>Configuração do parcelamento</h4>
                        <div class="control-group">
                            <div class="alert alert-error alert-gateway" style="margin-bottom: 0; display: none;">Para que o parcelamento funciona corretamente durante o pagamento do pedido, é necessário configurá-lo também no <b>PagSeguro</b>.
                            </div>
                        </div>
                        <div class="control-group   hide maximo_parcelas">
                            <label class="control-label" for="id_maximo_parcelas">Máximo de parcelas</label>
                            <div class="controls">
                                <select id="id_maximo_parcelas" name="maximo_parcelas">
                                    <?php
                                    for ($i=0; $i <= 12; $i++) {

                                        $selected ='';
                                        if (\Lib\Validate::isPost()) {
                                            if (!(strcmp($i, \Lib\Tools::getValue('maximo_parcelas')))) {
                                                // Set the $checked string
                                                $selected = "selected='selected'";
                                            }
                                        } else {

                                            if (isset($facilitador['ShopPagamentoFacilitador']['maximo_parcelas'])) {
                                                if (!(strcmp($i, $facilitador['ShopPagamentoFacilitador']['maximo_parcelas']))) {
                                                    // Set the $checked string
                                                    $selected = "selected='selected'";
                                                }
                                            }

                                        }

                                        if ($i <= 0 ) {
                                            echo "<option value=\"0\" $selected>Todas</option>". PHP_EOL;
                                        } else {
                                            echo "<option value=\"$i\" $selected>$i</option>". PHP_EOL;
                                        }                                       
                                        
                                    }
                                    ?>
                                </select>
                                <p class="help-block">Quantidade máxima de parcelas para esta forma de pagamento.</p>
                            </div>
                        </div>
                        <div class="control-group   hide parcelas_sem_juros">
                            <label class="control-label" for="id_parcelas_sem_juros">Parcelas sem juros</label>
                            <div class="controls">
                                <select id="id_parcelas_sem_juros" name="parcelas_sem_juros">
                                    <?php
                                    for ($i=0; $i <= 12; $i++) {

                                        $selected ='';
                                        if (\Lib\Validate::isPost()) {
                                            if (!(strcmp($i, \Lib\Tools::getValue('parcelas_sem_juros')))) {
                                                // Set the $checked string
                                                $selected = "selected='selected'";
                                            }
                                        } else {

                                            if (isset($facilitador['ShopPagamentoFacilitador']['parcelas_sem_juros'])) {

                                                if (!(strcmp($i, $facilitador['ShopPagamentoFacilitador']['parcelas_sem_juros']))) {
                                                    // Set the $checked string
                                                    $selected = "selected='selected'";
                                                }

                                            }

                                        }

                                        if ($i <= 0 ) {
                                            echo "<option value=\"0\" $selected>Todas</option>". PHP_EOL;
                                        } else {
                                            echo "<option value=\"$i\" $selected>$i</option>". PHP_EOL;
                                        }                                       
                                        
                                    }
                                    ?>
                                </select>
                                <p class="help-block">Numero de parcelas sem juros para esta forma de pagamento.</p>
                            </div>
                        </div>
                        <div id="parcelamento" class="hide">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab-pagamento_digital" title="Parcelas PagSeguro" data-toggle="tab"><img src="/admin/img/formas-de-pagamento/pagseguro-logo.png" alt="Logomarca PagSeguro" /></a>
                                </li>
                                <li>
                                    <h4>Simulação de parcelamento <small>Igual ao que será mostrado na sua loja.</small></h4>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-pagamento_digital">
                                    <div id="parcelas" class="itens-&lt;itertools.izip_longest object at 0xa492730&gt;">
                                        <ul class="pull-left">
                                            <li class="parcela p-1" style="display: none;">
                                                <p><b>1x</b> de  <b class="text-error">R$ 1.000,00</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-1" style="display: none;">
                                                <p><b>1x</b> de  <b class="text-error">R$ 1.000,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-2" style="display: none;">
                                                <p><b>2x</b> de  <b class="text-error">R$ 520,10</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-2" style="display: none;">
                                                <p><b>2x</b> de  <b class="text-error">R$ 500,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-3" style="display: none;">
                                                <p><b>3x</b> de  <b class="text-error">R$ 353,64</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-3" style="display: none;">
                                                <p><b>3x</b> de  <b class="text-error">R$ 333,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-4" style="display: none;">
                                                <p><b>4x</b> de  <b class="text-error">R$ 270,50</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-4" style="display: none;">
                                                <p><b>4x</b> de  <b class="text-error">R$ 250,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-5" style="display: none;">
                                                <p><b>5x</b> de  <b class="text-error">R$ 220,71</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-5" style="display: none;">
                                                <p><b>5x</b> de  <b class="text-error">R$ 200,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-6" style="display: none;">
                                                <p><b>6x</b> de  <b class="text-error">R$ 187,58</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-6" style="display: none;">
                                                <p><b>6x</b> de  <b class="text-error">R$ 166,00</b> sem juros</p>
                                            </li>
                                        </ul>
                                        <ul class="pull-left">
                                            <li class="parcela p-7" style="display: none;">
                                                <p><b>7x</b> de  <b class="text-error">R$ 163,98</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-7" style="display: none;">
                                                <p><b>7x</b> de  <b class="text-error">R$ 142,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-8" style="display: none;">
                                                <p><b>8x</b> de  <b class="text-error">R$ 146,34</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-8" style="display: none;">
                                                <p><b>8x</b> de  <b class="text-error">R$ 125,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-9" style="display: none;">
                                                <p><b>9x</b> de  <b class="text-error">R$ 132,67</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-9" style="display: none;">
                                                <p><b>9x</b> de  <b class="text-error">R$ 111,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-10" style="display: none;">
                                                <p><b>10x</b> de  <b class="text-error">R$ 121,78</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-10" style="display: none;">
                                                <p><b>10x</b> de  <b class="text-error">R$ 100,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-11" style="display: none;">
                                                <p><b>11x</b> de  <b class="text-error">R$ 112,91</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-11" style="display: none;">
                                                <p><b>11x</b> de  <b class="text-error">R$ 90,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-12" style="display: none;">
                                                <p><b>12x</b> de  <b class="text-error">R$ 105,56</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-12" style="display: none;">
                                                <p><b>12x</b> de  <b class="text-error">R$ 83,00</b> sem juros</p>
                                            </li>
                                        </ul>
                                        <ul class="pull-left">
                                            <li class="parcela p-13" style="display: none;">
                                                <p><b>13x</b> de  <b class="text-error">R$ 99,38</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-13" style="display: none;">
                                                <p><b>13x</b> de  <b class="text-error">R$ 76,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-14" style="display: none;">
                                                <p><b>14x</b> de  <b class="text-error">R$ 94,12</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-14" style="display: none;">
                                                <p><b>14x</b> de  <b class="text-error">R$ 71,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-15" style="display: none;">
                                                <p><b>15x</b> de  <b class="text-error">R$ 89,59</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-15" style="display: none;">
                                                <p><b>15x</b> de  <b class="text-error">R$ 66,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-16" style="display: none;">
                                                <p><b>16x</b> de  <b class="text-error">R$ 85,66</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-16" style="display: none;">
                                                <p><b>16x</b> de  <b class="text-error">R$ 62,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-17" style="display: none;">
                                                <p><b>17x</b> de  <b class="text-error">R$ 82,23</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-17" style="display: none;">
                                                <p><b>17x</b> de  <b class="text-error">R$ 58,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-18" style="display: none;">
                                                <p><b>18x</b> de  <b class="text-error">R$ 79,21</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-18" style="display: none;">
                                                <p><b>18x</b> de  <b class="text-error">R$ 55,00</b> sem juros</p>
                                            </li>
                                        </ul>
                                        <ul class="pull-left">
                                            <li class="parcela p-19" style="display: none;">
                                                <p><b>19x</b> de  <b class="text-error">R$ 76,53</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-19" style="display: none;">
                                                <p><b>19x</b> de  <b class="text-error">R$ 52,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-20" style="display: none;">
                                                <p><b>20x</b> de  <b class="text-error">R$ 74,15</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-20" style="display: none;">
                                                <p><b>20x</b> de  <b class="text-error">R$ 50,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-21" style="display: none;">
                                                <p><b>21x</b> de  <b class="text-error">R$ 72,03</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-21" style="display: none;">
                                                <p><b>21x</b> de  <b class="text-error">R$ 47,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-22" style="display: none;">
                                                <p><b>22x</b> de  <b class="text-error">R$ 70,12</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-22" style="display: none;">
                                                <p><b>22x</b> de  <b class="text-error">R$ 45,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-23" style="display: none;">
                                                <p><b>23x</b> de  <b class="text-error">R$ 68,41</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-23" style="display: none;">
                                                <p><b>23x</b> de  <b class="text-error">R$ 43,00</b> sem juros</p>
                                            </li>
                                            <li class="parcela p-24" style="display: none;">
                                                <p><b>24x</b> de  <b class="text-error">R$ 66,86</b></p>
                                            </li>
                                            <li class="parcela-sem-juros p-24" style="display: none;">
                                                <p><b>24x</b> de  <b class="text-error">R$ 41,00</b> sem juros</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label"></div>
                        <div class="controls">
                            <div class="alert alert-info alert-block">
                                <h4>Siga atentamente nossas instruções para que o pagamento funcione corretamente.</h4>
                                <ol>
                                    <li>Entre em sua conta do <a href="//pagseguro.uol.com.br" title="Login PagSeguro" target="+">PagSeguro</a>;</li>
                                    <li>Acesse o link <a href="//pagseguro.uol.com.br/integracao/token-de-seguranca.jhtml" title="" target="_blank">https://pagseguro.uol.com.br/integracao/token-de-seguranca.jhtml</a>;</li>
                                    <li>Gere o <b>Token de Segurança</b> e preencha nos campos de mesmo nome nesta página;</li>
                                    <li>Acesse o link <a href="//pagseguro.uol.com.br/integracao/retorno-automatico-de-dados.jhtml" title="" target="_blank">https://pagseguro.uol.com.br/integracao/retorno-automatico-de-dados.jhtml</a> e no campo <b>chamado Definir URL para receber as notificações</b> preencha com <b><?php echo $url_notificacao; ?></b>.</li>
                                    <li>Clique em ativar</li>
                                </ol>
                                <div>
                                    <label class="checkbox">
                                        <input id="id_li_msg" name="li_msg" type="checkbox" required <?php 

                                        if (\Lib\Validate::isPost()) {
                                            if (\Lib\Tools::getValue('li_msg') =='on'){
                                                echo 'checked="checked"';                                        
                                            }
                                        } elseif (isset($facilitador['ShopPagamentoFacilitador']['li_msg'])) {
                                            if ($facilitador['ShopPagamentoFacilitador']['li_msg'] == 'on') {
                                                echo 'checked="checked"';
                                            }
                                        }
                                        ?> />Li e segui todos os passos.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
                <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
                <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
            </div>
        </div>
    </form>
</div>
