<style type="text/css">
<!--
input[type="checkbox"]{
    margin-top: -5px !important;
}

.help-block {
    margin-top: -8px !important;
}

.ative{
    margin-left: 180px;
}

-->
</style>
 
<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar"></i> Formas de pagamento</a> <span class="bread-separator">-</span></li>
        <li><span>Configurando formas de pagamento</span></li>
    </ul>
</div>
<div class="alert alert-danger">
    <h4>Este recurso não está disponível para o seu plano</h4>
    <p>Atualize seu plano para que esta forma de pagamento fique disponível na sua loja.</p>
    <p><a href="<?php echo VIALOJA_PAINEL ?>/loja/uso#planos" class="btn btn-small"><i class="icon-edit"></i> Ir para a tela de alteração de plano</a></p>
</div>

<div class="row config-pagamento-editar">

    <form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post" id="formPagamentoEditar">
        <div class="box">
            <div class="box-header">
                <h3 class="pull-left">Forma de pagamento Depósito Bancário</h3>
            </div>
            <div class="box-content">
                <div class="control-group">
                    <div class="controls">
                        <img src="/admin/img/formas-de-pagamento/deposito-logo.png" />
                    </div>
                </div>


                <hr>

                <div class="control-group ative">
                    <p>Ative um ou mais bancos abaixo para que a forma de pagamento por Depósito seja habilitada na sua loja</p>                 

                </div>

                <hr>
                <div class="control-group">
                    <label class="control-label">Pagamento ativo?</label>
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

                            <?php if (isset($status_pagamento['ShopPagamento']['ativo'])): ?>

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
                <div id="forma-pagamento-corpo" class="">

                    <?php
                    $error = null;
                    if (isset($error_email_comprovante)) {
                        $error='error';
                    }
                    ?>

                    <div class="control-group <?php echo $error; ?> email_comprovante">
                        <label class="control-label" for="id_email_comprovante">E-mail para comprovante</label>
                        <div class="controls">
                            <span data-toggle="popover" data-original-title="Será o email informado ao seu cliente para enviar o comprovante, caso não preencha, será apresentado o email: <?php echo $email_comprovante_usuario ?>" title="Email para comprovante">
                            <input id="id_email_comprovante" class="span6" name="email_comprovante" placeholder="<?php echo $email_comprovante_usuario ?>" value="<?php 

                            if (\Lib\Validate::isPost()) {
                                echo \Lib\Tools::getValue('email_comprovante');
                            } elseif (isset($dados_deposito['ShopPagamentoDeposito']['email_comprovante'])) {
                                echo $cipher->decrypt($dados_deposito['ShopPagamentoDeposito']['email_comprovante']);
                            }

                            ?>" type="text" />
                            <?php
                            if (isset($error_email_comprovante)) {
                                echo '<ul class="errorlist"><li>Por favor, informe um e-mail válido.</li></ul>' . PHP_EOL;
                            }
                            ?>
                            </span>
                            <span class=" icon-info-sign" data-toggle="tooltip" data-placement="top" data-original-title="Será o email informado ao seu cliente para enviar o comprovante, caso não preencha, será apresentado o email: <?php echo $email_comprovante_usuario ?>"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="control-group aplicar_no_total" >
                        <div class="controls">
                            <label class="checkbox">
                                <input id="id_desconto" name="desconto" type="checkbox" <?php 

                                if (\Lib\Tools::getValue('desconto') =='on'){
                                    echo 'checked="checked"'; 
                                } elseif (isset($dados_deposito['ShopPagamentoDeposito']['desconto'])) {
                                    if ($dados_deposito['ShopPagamentoDeposito']['desconto'] =='on') {
                                        echo 'checked="checked"';
                                    }
                                }
                                ?> />
                                <strong>Usar desconto?</strong>
                            </label>
                            
                            <p class="help-block">Define se o depósito usará desconto.</p>
                            
                        </div>
                    </div>

                    <hr>
                    <div class="control-group    desconto_valor">
                        <label class="control-label" for="id_desconto_valor">Desconto aplicado</label>
                        <div class="controls">
                            <div class="input-append" data-toggle="popover" data-content="Informe neste campo qual será o percentual de desconto que será aplicado para esta forma de pagamento. Esta informação ficará disponível junto aos seus produtos." title="Desconto">
                                <input class="input-desconto span2" id="id_desconto_valor" name="desconto_valor" type="text" value="<?php

                            if (\Lib\Validate::isPost()) {
                                echo \Lib\Tools::getValue('desconto_valor');
                            } elseif (isset($dados_deposito['ShopPagamentoDeposito']['desconto_valor'])) {
                                echo \Lib\Tools::convertToDecimalBR($dados_deposito['ShopPagamentoDeposito']['desconto_valor']);
                            } else {
                                echo '0,00';
                            }

                            ?>" />
                                <span class="add-on">%</span>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="control-group    informacao_complementar">
                        <label class="control-label" for="id_informacao_complementar">Informação complementar</label>
                        <div class="controls">
                            <textarea cols="40" id="id_informacao_complementar" name="informacao_complementar" rows="3"><?php

                            if (\Lib\Validate::isPost()) {
                                echo \Lib\Tools::getValue('informacao_complementar');
                            } elseif (isset($dados_deposito['ShopPagamentoDeposito']['informacao_complementar'])) {
                                echo \Lib\Tools::htmlentitiesDecodeUTF8($dados_deposito['ShopPagamentoDeposito']['informacao_complementar']);
                            }

                            ?></textarea>
                            <p class="help-block">Esta informação será apresentada junto dos dados bancários para o cliente.</p>
                        </div>
                    </div>
                    <hr>

                    <div class="control-group aplicar_no_total" >
                        <div class="controls">
                            <label class="checkbox">
                                <input id="id_aplicar_no_total" name="aplicar_no_total" type="checkbox" <?php 

                                if (\Lib\Validate::isPost()) {
                                    if (\Lib\Tools::getValue('aplicar_no_total') =='on'){
                                        echo 'checked="checked"';                                        
                                    }
                                } elseif (isset($dados_deposito['ShopPagamentoDeposito']['aplicar_no_total'])) {
                                    if ($dados_deposito['ShopPagamentoDeposito']['aplicar_no_total'] === 'on') {
                                        echo 'checked="checked"';
                                    }
                                }
                                ?> />
                                <strong>Aplicar no total?</strong>
                            </label>
                            
                            <p class="help-block">Aplicar desconto no total da compra (incluir por exemplo o frete).</p>                            
                            
                        </div>
                    </div>

                    <hr>
                    <div id="parcelamento" class="hide">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab-deposito" title="Parcelas Depósito Bancário" data-toggle="tab"><img src="/admin/img/formas-de-pagamento/deposito-logo.png" alt="Logomarca Depósito Bancário" /></a>
                            </li>
                            <li>
                                <h4>Simulação de parcelamento <small>Igual ao que será mostrado na sua loja.</small></h4>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-deposito">
                                <div id="parcelas" class="itens-">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-produto">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Banco</th>
                            <th>Agencia</th>
                            <th>Conta</th>
                            <th>Poupança?</th>
                            <th>CPF / CNPJ</th>
                            <th>Favorecido</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($res_bancos as $key => $banco): ?>                        
                    <tr>
                        <td class="image">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/<?php echo $banco['Bancos']['id'] ?>">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            <img src="/admin/img/formas-de-pagamento/<?php echo $banco['Bancos']['logo'] .'.png'; ?>" alt="<?php echo $banco['Bancos']['nome'] ?>" class="banco"/>
                            </span>
                            </a>
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/<?php echo $banco['Bancos']['id'] ?>">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                                <?php echo $banco['Bancos']['numero'] . ' - ' . $banco['Bancos']['nome'] ?>
                            </span>
                            </a>
                        </td>
                        <td>
                            <?php
                            if (!empty($banco['ShopPagamentoDepositoConfig']['agencia'])):
                                echo $cipher->decrypt($banco['ShopPagamentoDepositoConfig']['agencia']);
                            else:
                                echo '-';
                            endif;
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($banco['ShopPagamentoDepositoConfig']['numero_conta'])):
                                echo $cipher->decrypt($banco['ShopPagamentoDepositoConfig']['numero_conta']);
                            else:
                                echo '-';
                            endif;
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($banco['ShopPagamentoDepositoConfig']['poupanca']) 
                                && $banco['ShopPagamentoDepositoConfig']['poupanca'] == 'on'):
                                echo '<i class="fa fa-check-circle"></i> Sim';
                            else:
                                echo '-';
                            endif;
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($banco['ShopPagamentoDepositoConfig']['cpf_cnpj'])):
                                echo $cipher->decrypt($banco['ShopPagamentoDepositoConfig']['cpf_cnpj']);
                            else:
                                echo '-';
                            endif;
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($banco['ShopPagamentoDepositoConfig']['favorecido'])):
                                echo $cipher->decrypt($banco['ShopPagamentoDepositoConfig']['favorecido']);
                            else:
                                echo '-';
                            endif;
                            ?>
                        </td>
                       
                        <td class="ativo">

                          <?php if ($banco['ShopPagamentoDepositoConfig']['ativo'] =='True'): ?>

                            <span class="label label-success">
                                Ativo
                            </span>
                              
                          <?php else: ?>

                            <span class="label label-important">
                                Inativo
                            </span>
                              
                          <?php endif ?>                            
                            
                        </td>

                        <td class="botao-remover">

                            <a href="<?php 

                            $confirm = '';

                            if (is_numeric($banco['ShopPagamentoDepositoConfig']['numero_banco_default'])) {
                                echo \Lib\Tools::getUrl() .'/remover/'. $banco['ShopPagamentoDepositoConfig']['numero_banco_default'];


                                $confirm = 'onclick="return confirm(&#039;Tem certeza que deseja remover o Banco '. $banco['Bancos']['nome'] .'?&#039;);"';


                            } else {
                                echo 'javascript:;';
                            }                           

                            



                             ?>" <?php echo $confirm; ?> title="Remover Banco" class="btn btn-danger btn-xs remover-banco" >
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>

                    <?php endforeach ?>
                </table>
            </div>
        </div>
        <div class="form-actions">
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
            <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
        </div>
    </form> 
</div>
