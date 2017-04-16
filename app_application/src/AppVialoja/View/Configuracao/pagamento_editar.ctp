<script type="text/javascript">
    $(document).ready(function() {
        $('#id_mostrar_parcelamento').change(function(event) {
            $('#parcelamento').stop().slideToggle();
            $('.control-group.maximo_parcelas, .control-group.parcelas_sem_juros').stop().slideToggle();
            $('#configuracao-parcelamento').stop().slideToggle();
            $('.alert-gateway').stop().slideToggle();
        });
    
    
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
    
    
        $('#formPagamentoEditar').submit(function() {
            if($('#id_li_msg').length && !$('#id_li_msg').is(':checked') && $('#id_ativo').val() != 'False') {
                $('#modal-error .error-text').html('Você precisa confirmar que leu e seguiu os passos.');
                jQuery.removeLoader();
                $('#modal-error').modal('show');
                return false;
            }
    /*
            if($('#li_msg').length && !$('#li_msg').is(':checked')) {
                $('.aviso-li-msg').remove();
                $('#mainContent').prepend('<div class="alert alert-error aviso-li-msg"><a class="close" data-dismiss="alert">×</a> <h4>Você precisa confirmar a leitura dos passos.</h4></div>');
                return false;
            }
    */
        });
    
         
        $('#id_ativo').change(function() {
            var self = $(this);
            if (self.val() == 'True') {
                $('#forma-pagamento-corpo').slideDown();
            } else {
                $('#forma-pagamento-corpo').slideUp();
            }
        }).change();
        
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
<div class="alert alert-danger">
    <h4>Este recurso não está disponível para o seu plano</h4>
    <p>Atualize seu plano para que esta forma de pagamento fique disponível na sua loja.</p>
    <p><a href="<?php echo VIALOJA_PAINEL ?>/loja/uso#planos" class="btn btn-small"><i class="icon-edit"></i> Ir para a tela de alteração de plano</a></p>
</div>
<div class="row config-pagamento-editar">
    <form class="" action="/admin/configuracao/pagamento/8/configuracao/editar" method="post" id="formPagamentoEditar">
        <div class="box">
            <div class="box-header">
                <h3 class="pull-left">Forma de pagamento Boleto Bancário</h3>
            </div>
            <div class="box-content">
                <div class="control-group">
                    <div class="controls">
                        <img src="//cdn.awsli.com.br/static/admin/img/formas-de-pagamento/boleto-logo.png" />
                    </div>
                </div>
                <div class="alert alert-info" style="margin-top: 20px;">
                    <h4><strong>ATENÇÃO:</strong> Antes de habilitar o pagamento via Boleto Bancário é necessário efetuar a liberação da carteira bancário junto ao seu gerente.</h4>
                </div>
                <div class="control-group">
                    <label class="control-label">Pagamento ativo?</label>
                    <div class="controls">
                        <select class="input-small" id="id_ativo" name="ativo">
                            <option value="True">Sim</option>
                            <option value="False" selected="selected">Não</option>
                        </select>
                    </div>
                </div>
                <div id="forma-pagamento-corpo" class="hide">
                    <script type="text/javascript">
                        banco_carteira_json = {"2": {"5": {"convenio": false, "nome": "Carteira 175"}}};
                        
                        $(document).ready(function() {
                            var bancos_tamanho_conta = {"2": 5, "1": 7, "6": 8, "4": 6};
                        
                            var alterar_carteiras = function(banco_id) {
                                var carteira_select = $('#id_carteira');
                        
                                var carteiras = undefined;
                                for (var i in banco_carteira_json) {
                                    if (i == banco_id) {
                                        carteiras = banco_carteira_json[banco_id];
                                    }
                                }
                        
                                if (!carteiras) {
                                    // console.log('Seleção incorreta. Tenta novamente.');
                                }
                        
                                carteira_select.empty();
                                for (var j in carteiras) {
                                    $('<option>').attr({'value': j}).text(carteiras[j].nome).data('convenio', carteiras[j].convenio).appendTo(carteira_select);
                                }
                            }
                        
                            var bind_carteira_change = function() {
                                $('#id_carteira').unbind().change(function() {
                                    var self = $(this);
                                    var convenio_parent = $('#id_banco_convenio').parents('.control-group');
                        
                                    if (self.find(':selected').data('convenio') == true) {
                                        convenio_parent.show();
                                    } else {
                                        convenio_parent.hide();
                                    }
                                }).change();
                            }
                        
                            $('#id_banco').change(function() {
                                var self = $(this);
                                var selected = self.find(':selected');
                                alterar_carteiras(selected.val());
                                bind_carteira_change();
                        
                                banco_id = selected.val();
                                tamanho = bancos_tamanho_conta[banco_id];
                                if (!tamanho) {
                                    return false;
                                }
                        
                                // console.log('a');
                        
                                var help_block = $('#id_banco_conta').parents('.control-group').find('.help-block');
                                help_block.text(help_block.text().replace(/\d+/, tamanho));
                            }).change();
                        
                            $('#id_empresa_cnpj').mask('99.999.999/9999-99');
                        });
                    </script>
                    <h4>Dados da empresa</h4>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">CNPJ:</label>
                                <div class="controls">
                                    <input class="span12" id="id_empresa_cnpj" maxlength="18" name="empresa_cnpj" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Beneficiário:</label>
                                <div class="controls">
                                    <input class="span12" id="id_empresa_beneficiario" maxlength="128" name="empresa_beneficiario" type="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Endereço:</label>
                                <div class="controls">
                                    <input class="span12" id="id_empresa_endereco" maxlength="64" name="empresa_endereco" type="text" />
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Estado:</label>
                                <div class="controls">
                                    <select class="span12" id="id_empresa_estado" name="empresa_estado">
                                        <option value="--">--</option>
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP">SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Cidade:</label>
                                <div class="controls">
                                    <input class="span12" id="id_empresa_cidade" maxlength="64" name="empresa_cidade" type="text" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>Dados bancários</h4>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Banco:</label>
                                <div class="controls">
                                    <select class="span12" id="id_banco" name="banco">
                                        <option value="2">Banco Itaú</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Carteira:</label>
                                <div class="controls">
                                    <select class="span12" id="id_carteira" name="carteira">
                                        <option value="5">Carteira 175</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Agência:</label>
                                <div class="controls">
                                    <input class="span12" id="id_banco_agencia" maxlength="4" name="banco_agencia" type="text" />
                                    <p class="help-block">Preencha a agência com 4 dígitos.</p>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Conta Corrente sem o dígito:</label>
                                <div class="controls">
                                    <input class="span12" id="id_banco_conta" maxlength="11" name="banco_conta" type="text" />
                                    <p class="help-block">Preencha a conta corrente com <strong>5 dígitos</strong>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Convênio:</label>
                                <div class="controls">
                                    <input class="span12" id="id_banco_convenio" maxlength="7" name="banco_convenio" type="text" />
                                    <p class="help-block">Preencha a código do convênio com 7 dígitos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4>Instruções no boleto</h4>
                    <div class="row-fluid">
                        <div class="control-group ">
                            <label for="" class="control-label">Linha 1:</label>
                            <div class="controls">
                                <input class="span12" disabled="disabled" id="id_linha_1" maxlength="128" name="linha_1" type="text" value="SR CAIXA NÃO ACEITAR APÓS VENCIMENTO." />
                                <p class="help-block">Esta linha não pode ser alterada.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="control-group ">
                            <label for="" class="control-label">Linha 2:</label>
                            <div class="controls">
                                <input class="span12" id="id_linha_2" maxlength="128" name="linha_2" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="control-group ">
                            <label for="" class="control-label">Linha 3:</label>
                            <div class="controls">
                                <input class="span12" id="id_linha_3" maxlength="128" name="linha_3" type="text" />
                            </div>
                        </div>
                    </div>
                    <h4>Descontos</h4>
                    <div class="row-fluid">
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Desconto aplicado:</label>
                                <div class="controls">
                                    <div class="input-append">
                                        <input id="id_desconto_valor" name="desconto_valor" type="text" />
                                        <span class="add-on">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="control-group ">
                                <label for="" class="control-label">Aplicar no total?:</label>
                                <div class="controls">
                                    <select id="id_aplicar_no_total" name="aplicar_no_total">
                                        <option value="True">Sim</option>
                                        <option value="False" selected="selected">Não</option>
                                    </select>
                                    <p class="help-block">Aplicar desconto no total da compra (incluir por exemplo o frete).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        <h4>Verifique todos os dados com atenção. Se algum campo for preenchido incorretamente o Boleto Bancário poderá não ser emitido ou, em alguns casos, o pagamento não poderá ser corretamente identificado. Após salvar, imprima o boleto de teste e faça o pagamento do mesmo para garantir o funcionamento.</h4>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <input type='hidden' name='csrfmiddlewaretoken' value='sRhsr7ZB9wGAmavYHaaKhutp2UfkL1C0' />
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
                <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
            </div>
        </div>
    </form>
</div>
