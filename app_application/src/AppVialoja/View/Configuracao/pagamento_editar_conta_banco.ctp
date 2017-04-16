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
    <form class="form-horizontal" action="/admin/configuracao/pagamento/7/configuracao/editar" method="post" id="formPagamentoEditar">
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
                <div class="control-group">
                    <label class="control-label">Pagamento ativo?</label>
                    <div class="controls">
                        <select class="input-small" id="id_ativo" name="ativo">
                            <option value="True" selected="selected">Sim</option>
                            <option value="False">Não</option>
                        </select>
                    </div>
                </div>
                <div id="forma-pagamento-corpo" class="">
                    <div class="control-group    email_comprovante">
                        <label class="control-label" for="id_email_comprovante">E-mail para comprovante</label>
                        <div class="controls">
                            <span data-toggle="popover" data-content="Será o email informado ao seu cliente para enviar o comprovante, caso não preencha, será apresentado o email: wsduarte@outlook.com" title="Email para comprovante">
                            <input id="id_email_comprovante" name="email_comprovante" placeholder="wsduarte@outlook.com" type="text" />
                            </span>
                        </div>
                    </div>
                    <div class="control-group    desconto_valor">
                        <label class="control-label" for="id_desconto_valor">Desconto aplicado</label>
                        <div class="controls">
                            <div class="input-append" data-toggle="popover" data-content="Informe neste campo qual será o percentual de desconto que será aplicado para esta forma de pagamento. Esta informação ficará disponível junto aos seus produtos." title="Desconto">
                                <input class="input-small" id="id_desconto_valor" name="desconto_valor" type="text" />
                                <span class="add-on">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group    informacao_complementar">
                        <label class="control-label" for="id_informacao_complementar">Informação complementar</label>
                        <div class="controls">
                            <textarea cols="40" id="id_informacao_complementar" name="informacao_complementar" rows="3">
</textarea>
                            <p class="help-block">Esta informação será apresentada junto dos dados bancários para o cliente.</p>
                        </div>
                    </div>
                    <div class="control-group    aplicar_no_total">
                        <label class="control-label" for="id_aplicar_no_total">Aplicar no total?</label>
                        <div class="controls">
                            <select id="id_aplicar_no_total" name="aplicar_no_total">
                                <option value="True">Sim</option>
                                <option value="False" selected="selected">Não</option>
                            </select>
                            <p class="help-block">Aplicar desconto no total da compra (incluir por exemplo o frete).</p>
                        </div>
                    </div>
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
                        </tr>
                    </thead>
                    <tr>
                        <td class="image">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/4">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            <img src="/admin/img/formas-de-pagamento/banco-bb-logo.png" alt="Banco do Brasil" class="banco"/>
                            </span>
                            </a>
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/4">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            001 - Banco do Brasil
                            </span>
                            </a>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="ativo">
                            <span class="status none">
                            <span class="icon-custom icon-white icon-power off"></span> Não configurado
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="image">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/2">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            <img src="/admin/img/formas-de-pagamento/banco-itau-logo.png" alt="Banco Itaú" class="banco"/>
                            </span>
                            </a>
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/2">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            341 - Banco Itaú
                            </span>
                            </a>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="ativo">
                            <span class="status none">
                            <span class="icon-custom icon-white icon-power off"></span> Não configurado
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="image">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/1">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            <img src="/admin/img/formas-de-pagamento/banco-bradesco-logo.png" alt="Bradesco" class="banco"/>
                            </span>
                            </a>
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/1">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            237 - Bradesco
                            </span>
                            </a>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="ativo">
                            <span class="status none">
                            <span class="icon-custom icon-white icon-power off"></span> Não configurado
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="image">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/6">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            <img src="/admin/img/formas-de-pagamento/banco-caixa-logo.png" alt="Caixa Econômica" class="banco"/>
                            </span>
                            </a>
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/6">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            104 - Caixa Econômica
                            </span>
                            </a>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="ativo">
                            <span class="status none">
                            <span class="icon-custom icon-white icon-power off"></span> Não configurado
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="image">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/5">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            <img src="/admin/img/formas-de-pagamento/banco-citi-logo.png" alt="CitiBank" class="banco"/>
                            </span>
                            </a>
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/5">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            477 - CitiBank
                            </span>
                            </a>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="ativo">
                            <span class="status none">
                            <span class="icon-custom icon-white icon-power off"></span> Não configurado
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="image">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/3">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            <img src="/admin/img/formas-de-pagamento/banco-hsbc-logo.png" alt="HSBC" class="banco"/>
                            </span>
                            </a>
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/3">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            399 - HSBC
                            </span>
                            </a>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="ativo">
                            <span class="status none">
                            <span class="icon-custom icon-white icon-power off"></span> Não configurado
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="image">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/7">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            <img src="/admin/img/formas-de-pagamento/banco-santander-logo.png" alt="Santander" class="banco"/>
                            </span>
                            </a>
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/7">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            033 - Santander
                            </span>
                            </a>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="ativo">
                            <span class="status none">
                            <span class="icon-custom icon-white icon-power off"></span> Não configurado
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="image">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/8">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            <img src="/admin/img/formas-de-pagamento/banco-sicoob-logo.png" alt="SICOOB" class="banco"/>
                            </span>
                            </a>
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/banco/editar/8">
                            <span rel="tooltip" data-original-title="Clique aqui para editar as configurações deste banco.">
                            756 - SICOOB
                            </span>
                            </a>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="ativo">
                            <span class="status none">
                            <span class="icon-custom icon-white icon-power off"></span> Não configurado
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="form-actions">
            <input type='hidden' name='csrfmiddlewaretoken' value='sRhsr7ZB9wGAmavYHaaKhutp2UfkL1C0' />
            <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
            <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
        </div>
    </form> 
</div>
