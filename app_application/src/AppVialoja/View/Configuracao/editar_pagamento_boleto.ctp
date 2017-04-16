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
<!--<div id="loadingDiv" style="display: none;">carregando...</div>-->

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar"></i> Formas de pagamento</a> <span class="bread-separator">-</span></li>
        <li><span>Configurando formas de pagamento</span></li>
    </ul>
</div>

<div id="erroTecnico">
</div>

<div class="row config-pagamento-editar">
    <form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post" id="formPagamentoEditar">
        <div class="box">
            <div class="box-header">
                <h3 class="pull-left">Configurações</h3>
            </div>
            <div class="box-content">
                <div class="control-group">
                    <div class="controls">
                        <img src="/admin/img/formas-de-pagamento/boleto-logo.png" />
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-group">
                        <p>Preencha todos os dados para habilitar o boleto bancário</p>
                    </div>
                </div>
                <div id="alertaAviso" class="alert alert-info" style="margin-top: 20px;">
                    <h4><strong>ATENÇÃO:</strong> Antes de habilitar o pagamento via Boleto Bancário é necessário efetuar a liberação da carteira bancário junto ao seu gerente.</h4>
                </div>
             

                <div class="control-group">
                    <label class="control-label"><strong>Pagamento ativo?</strong></label>
                    <div class="controls">
                        <select class="input-small" id="id_ativo" name="ativo">                     
                            <?php
                            if (Tools::getValue("ativo") !="") {
                            ?>
                            <option value="True" <?php if (!(strcmp("True", Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Sim</option>
                            <option value="False" <?php if (!(strcmp("False", Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Não</option>

                            <?php
                            } else {
                            ?>

                            <?php if (!empty($pagamento['ShopPagamento']['ativo'])): ?>

                                <option value="True" <?php if (!(strcmp("True", $pagamento['ShopPagamento']['ativo']))) { echo 'selected="selected"';} ?>>Sim</option>

                                <option value="False" <?php if (!(strcmp("False", $pagamento['ShopPagamento']['ativo']))) {echo 'selected="selected"';} ?>>Não</option>
                                
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


                <div class="convite-cadastro">
                </div>
                <div id="forma-pagamento-corpo">
                    <input id="id_json" name="json" type="hidden" value="{&quot;empresa_estado&quot;: null, &quot;carteira&quot;: null, &quot;dias_vencimento&quot;: 2, &quot;empresa_beneficiario&quot;: null, &quot;banco_agencia&quot;: null, &quot;empresa_cidade&quot;: null, &quot;linha_2&quot;: null, &quot;banco_convenio&quot;: null, &quot;empresa_endereco&quot;: null, &quot;linha_1&quot;: &quot;SR CAIXA N\u00c3O ACEITAR AP\u00d3S VENCIMENTO.&quot;, &quot;linha_3&quot;: null, &quot;empresa_cnpj&quot;: null, &ququot;banco&quot;: null, &quot;banco_conta&quot;: null}" />
         
                    <div class="control-group valor">
                        <label class="control-label" for="id_usuario"><strong>Valor mínimo</strong></label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">R$</span>
                                <input class="input-price" style="width:150px;" id="valor_minimo_aceitavel" type="text" name="valor_minimo_aceitavel" value="0,00" />
                                <p class="help-block">Informe o valor mínimo para exibir esta forma de pagamento.</p>

                            </div>

                        </div>
                    </div>

                    <div class="control-group " >
                        <div class="controls spanoffset-3">
                            <label class="checkbox">
                            <input id="id_desconto" name="desconto" type="checkbox" />
                            Usar desconto?
                            </label>
                            <p class="help-block">Define se o depósito usará desconto.</p>
                        </div>
                    </div>                   

                    <div class="control-group    desconto_valor">
                        <label class="control-label" for="id_desconto_valor">Desconto aplicado</label>
                        <div class="controls">
                            <div class="input-append" data-toggle="popover" data-content="Informe neste campo qual será o percentual de desconto que será aplicado para esta forma de pagamento. Esta informação ficará disponível junto aos seus produtos." title="Desconto">
                                <input class="input-small" id="id_desconto_valor" name="desconto_valor" type="text" value="0,00" />
                                <span class="add-on">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="control-group " >
                        <div class="controls spanoffset-3">
                            <label class="checkbox">
                            <input id="id_aplicar_no_total" name="aplicar_no_total" type="checkbox" />
                            Aplicar no total?
                            </label>
                            <p class="help-block">Aplicar desconto no total da compra (incluir por exemplo o frete).</p>
                        </div>
                    </div>
                    <script type="text/javascript">
                        var bancoCarteiraJson = {"1": {"2": {"convenio": false, "nome": "Carteira 25"}}, "3": {"7": {"convenio": true, "nome": "Carteira CNR"}}, "2": {"5": {"convenio": false, "nome": "Carteira 175"}}, "4": {"1": {"convenio": true, "nome": "Carteira 18"}}, "7": {"6": {"convenio": true, "nome": "Carteira 102 / CSR"}}, "6": {"4": {"convenio": false, "nome": "SIGCB - Carteira SR"}}};
                        
                        var errosValidacao = {};
                        
                        var jsonResultado = {
                            empresa_beneficiario: null,
                            empresa_cnpj: null,
                            empresa_endereco: null,
                            empresa_cidade: null,
                            empresa_estado: null,
                            dias_vencimento: null,
                            banco: null,
                            carteira: null,
                            banco_agencia: null,
                            banco_conta: null,
                            banco_convenio: null,
                            linha_1: null,
                            linha_2: null,
                            linha_3: null
                        };
                        var requeridos = ["empresa_cnpj", "empresa_beneficiario", "empresa_endereco", "empresa_estado", "empresa_cidade", "dias_vencimento", "banco", "carteira", "banco_agencia", "banco_conta", "banco_convenio"];
                        var bancoSelecionado = null;
                        $(document).ready(function() {
                            var preencheCampos = function() {
                                var $json = $("#id_json");
                                if ($json.val()) {
                                    var jsonRetorno = JSON.parse($json.val());
                                    for (var campo in jsonResultado) {
                                        if (jsonRetorno.hasOwnProperty(campo)) {
                                            jsonResultado[campo] = jsonRetorno[campo];
                                        }
                                    }
                                }
                                for (var propriedade in jsonResultado) {
                                    if (propriedade != "linha_1") {
                                        var campoId = propriedade;
                                        var esconderId = null;
                                        if (propriedade == "empresa_cnpj") {
                                            if (!jsonResultado[propriedade]) {
                                                campoId = "cpf";
                                                esconderId = "cnpj";
                                            }
                                            else {
                                                campoId = (jsonResultado[propriedade].length == 14 ? "cnpj" : "cpf");
                                                esconderId = (jsonResultado[propriedade].length == 14 ? "cpf" : "cnpj");
                                            }
                                            var $esconder = $("#id_" + esconderId);
                                            $esconder.prop("disabled", false);
                                            $esconder.parents(".control-group").hide();
                                            $("#btn_" + campoId).button('toggle');
                                        }
                                        var $campo = $("#id_" + campoId);
                                        $campo.prop("disabled", false);
                                        $campo.val(jsonResultado[propriedade]);
                                        if (propriedade == "banco") {
                                            $campo.change();
                                        }
                                        if (errosValidacao.hasOwnProperty(propriedade)) {
                                            var $formGroup = $campo.parents(".control-group");
                                            $formGroup.addClass("has-error");
                                            $formGroup.find(".errorlist li").remove();
                                            $formGroup.find(".errorlist").append("<li>" + errosValidacao[propriedade] + "</li>");
                                            $formGroup.find(".errorlist").show();
                                        }
                                    }
                                }
                            };
                        
                            $(".documento").click(function() {
                                var $this = $(this);
                                var documento = $this.data("documento");
                                var esconderId = (documento == "cnpj" ? "cpf" : "cnpj");
                                var $exibir = $("#id_" + documento);
                                var $esconder = $("#id_" + esconderId);
                                $exibir.parents(".control-group").show();
                                $esconder.parents(".control-group").hide();
                            });
                        
                            var bancosTamanhoConta = {"2": 5, "1": 7, "6": 6, "4": 6, "7": 8, "3": 5};
                            $('#id_banco').change(function() {
                                var self = $(this);
                                alterar_carteiras(self.val());
                                var bancoId = self.val();
                                var tamanho = bancosTamanhoConta[bancoId];
                                bancoSelecionado = bancoId;
                                bind_carteira_change();
                                if (!tamanho) {
                                    return false;
                                }
                                var helpBlock = $('#id_banco_conta').parents('.control-group').find('.help-block');
                                helpBlock.text(helpBlock.text().replace(/\d+/, tamanho));
                            });
                        
                            var alterar_carteiras = function (banco_id) {
                                var selectCarteira = $('#id_carteira');
                                var carteiras = undefined;
                                for (var i in bancoCarteiraJson) {
                                    if (i == banco_id) {
                                        carteiras = bancoCarteiraJson[banco_id];
                                    }
                                }
                                selectCarteira.empty();
                                for (var j in carteiras) {
                                    $('<option>').attr({'value': j}).text(carteiras[j].nome).data('convenio', carteiras[j].convenio).appendTo(selectCarteira);
                                }
                            };
                        
                            var bind_carteira_change = function () {
                                $('#id_carteira').unbind().change(function () {
                                    var self = $(this);
                                    var convenioParent = $('#id_banco_convenio').parents('.control-group');
                                    if (self.find(':selected').data('convenio') == true) {
                                        convenioParent.show();
                                    } else {
                                        convenioParent.hide();
                                    }
                                    var $labelConvenio = $(".label-convenio");
                                    $labelConvenio.text("Convênio:");
                                    var $helpConvenio = $(".help-convenio");
                                    $helpConvenio.text("Preencha o código do convênio.");
                                    if (bancoSelecionado == "7") {
                                        $labelConvenio.text("Código do Cliente (PSK):");
                                        $helpConvenio.text("Preencha o Código Cliente (PSK) com 7 dígitos.")
                                    }
                                    if (bancoSelecionado == "3") {
                                        $labelConvenio.text("Código do Beneficiário:");
                                        $helpConvenio.text("Preencha o Código do Beneficiário com 7 dígitos.")
                                    }
                                }).change();
                            };
                        
                            preencheCampos();
                            $('#id_cnpj').mask('99.999.999/9999-99');
                            $('#id_cpf').mask('999.999.999-99');
                            $('#id_dias_vencimento').mask('9?9');
                        
                            var escondeAlertas = function() {
                                $(".alert").not("#alertaAviso").not("#alertaBotaoTeste").not("#alertaInfo").hide();
                            };
                        
                            $("#formPagamentoEditar").submit(function(e) {
                                escondeAlertas();
                                if ($("#id_ativo").val() == 'True') {
                                    var temErro = false;
                                    var campoId = null;
                                    for (var indice in requeridos) {
                                        campoId = requeridos[indice];
                                        if (campoId == "empresa_cnpj") {
                                            campoId = ($("#btn_cnpj").hasClass("active") ? "cnpj" : "cpf");
                                        }
                                        var $campoRequerido = $("#id_" + campoId);
                                        var $formGroup = $campoRequerido.parents(".control-group");
                                        $formGroup.removeClass("has-error");
                                        $formGroup.find(".errorlist").hide();
                                        if (!$campoRequerido.val()) {
                                            if (campoId != "banco_convenio" || (campoId == "banco_convenio" && ["3", "4", "7"].indexOf($("#id_banco").val()) > -1)) {
                                                temErro = true;
                                                $formGroup.addClass("has-error");
                                                $formGroup.find(".errorlist li").remove();
                                                $formGroup.find(".errorlist").append("<li>Este campo é obrigatório</li>");
                                                $formGroup.find(".errorlist").show();
                                            }
                                        }
                                    }
                                    if (temErro) {
                                        e.preventDefault();
                                        $("html, body").animate({scrollTop : 0 });
                                        var $alertaErro = $("#alertaErro");
                                        $alertaErro.prependTo("#mainContent").show();
                                        return false
                                    }
                                }
                                for (var propriedade in jsonResultado) {
                                    campoId = propriedade;
                                    if (campoId == "empresa_cnpj") {
                                        campoId = ($("#btn_cnpj").hasClass("active") ? "cnpj" : "cpf");
                                    }
                                    var $campo = $("#id_" + campoId);
                                    var valor = $campo.val();
                                    if (propriedade == "empresa_cnpj") {
                                        valor = valor.replace(/\./g, "");
                                        valor = valor.replace(/\//g, "");
                                        valor = valor.replace(/\-/g, "");
                                    }
                                    jsonResultado[propriedade] = valor;
                                }
                                $("#id_json").val(JSON.stringify(jsonResultado));
                            });
                        
                            $("#emitirBoletoTeste").click(function() {
                                var mensagemDeErro = function(data) {
                                    var conteudo = data.content;
                                    var textoTecnico = [];
                                    var mensagem = status == 'erro_servidor' ? conteudo['mensagem'] : conteudo.hasOwnProperty('conteudo') ? conteudo['conteudo'] : conteudo;
                                    if (conteudo.hasOwnProperty('excecao')) {
                                        var excecao = conteudo['excecao'];
                                        textoTecnico = [
                                            'Erro: ' + excecao['nome'],
                                            'Mensagem: ' + excecao['mensagem']
                                        ];
                                        mensagem = excecao['mensagem'];
                                        for (var stack = 0; stack < excecao['stack_trace'].length; stack++) {
                                            textoTecnico.push([
                                                'Codigo: ' + excecao['stack_trace'][stack]['codigo'],
                                                'Em: ' + excecao['stack_trace'][stack]['local']
                                            ].join('<br />'))
                                        }
                                    }
                                    var alertaBoletoTeste = [
                                        '<div id="alertaBoletoTeste" class="alert alert-danger">',
                                        '<a class="close" data-dismiss="alert">×</a>',
                                        '<div id="erroTecnico" style="display: none;">' + textoTecnico.join('<br />') + '</div>',
                                        '<h4 class="texto-erro">' + mensagem + '</h4>',
                                        '</div>'
                                    ];
                                    return alertaBoletoTeste.join("");
                                };
                                escondeAlertas();
                                var url = "https://admin.lojaintegrada.com.br/painel/configuracao/pagamento/boleto/configuracao/teste/BoletoTeste/GET";
                                $.getJSON(url)
                                        .fail(function(data) {
                                            data = JSON.parse(data.responseText);
                                            var htmlModal = mensagemDeErro(data);
                                            var $modalBoletoTeste = $("#modalBoletoTeste");
                                            $modalBoletoTeste.find(".corpo").html(htmlModal);
                                            $modalBoletoTeste.modal('show')
                                        })
                                        .done(function(data) {
                                            var htmlModal = "";
                                            if (data.status == 'sucesso') {
                                                htmlModal = data.content.dados
                                            }
                                            else {
                                                htmlModal = mensagemDeErro(data);
                                            }
                                            var $modalBoletoTeste = $("#modalBoletoTeste");
                                            $modalBoletoTeste.find(".corpo").html(htmlModal);
                                            $modalBoletoTeste.modal('show')
                                        });
                            })
                        });
                    </script>
                    <div id="alertaErro" class="alert alert-danger" style="display: none;">
                        <a class="close" data-dismiss="alert">×</a>
                        <h4>Existem erros nos dados enviados. Corrija os campos marcados e tente novamente.</h4>
                    </div>
                    <div class="alert alert-success" id="alertaBotaoTeste">
                        <h4>Emitir boleto de teste</h4>
                        <p>Para testar as configurações de pagamento faça a emissão de um boleto de teste e verifique se o boleto foi gerado corretamente.</p>
                        <p>
                            <button type="button" id="emitirBoletoTeste" class="btn btn-default">
                            <span class="glyphicon glyphicon-barcode"></span> Gerar boleto de teste
                            </button>
                        </p>
                    </div>
                    <h4>Dados do Beneficiário</h4>
                    <div class="control-group">
                        <label class="control-label">Tipo de documento:</label>
                        <div class="span6">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary documento" id="btn_cpf" data-documento="cpf">
                                <input type="radio" autocomplete="off" name="documento" id="cpf" />CPF
                                </label>
                                <label class="btn btn-primary documento" id="btn_cnpj" data-documento="cnpj">
                                <input type="radio" autocomplete="off" name="documento" id="cnpj" />CNPJ
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="id_cpf" class="control-label">CPF:</label>
                        <div class="span6">
                            <input class="form-control" id="id_cpf" maxlength="18" name="cpf" value="" type="text" disabled="disabled" style="width: 160px" />
                            <ul class="errorlist" style="display: none">
                                <li>Este campo é obrigatório.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="id_cnpj" class="control-label">CNPJ:</label>
                        <div class="span6">
                            <input class="form-control" id="id_cnpj" maxlength="18" name="cnpj" value="" type="text" disabled="disabled" style="width: 160px" />
                            <ul class="errorlist" style="display: none">
                                <li>Este campo é obrigatório.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_empresa_beneficiario" class="control-label">Nome:</label>
                        <div class="span6">
                            <input class="form-control" id="id_empresa_beneficiario" maxlength="128" name="empresa_beneficiario" value="" type="text" disabled="disabled" />
                            <ul class="errorlist" style="display: none">
                                <li>Este campo é obrigatório.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_empresa_endereco" class="control-label">Endereço:</label>
                        <div class="span6">
                            <input class="form-control" id="id_empresa_endereco" maxlength="64" name="empresa_endereco" value="" type="text" disabled="disabled" />
                            <ul class="errorlist" style="display: none">
                                <li>Este campo é obrigatório.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_empresa_estado" class="control-label">Estado:</label>
                        <div class="span6">
                            <select class="form-control" id="id_empresa_estado" name="empresa_estado" disabled="disabled">
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
                            <ul class="errorlist" style="display: none">
                                <li>Este campo é obrigatório.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_empresa_cidade" class="control-label">Cidade:</label>
                        <div class="span6">
                            <input class="form-control" id="id_empresa_cidade" maxlength="64" name="empresa_cidade" value="" type="text" disabled="disabled" style="width: 320px" />
                            <ul class="errorlist" style="display: none">
                                <li>Este campo é obrigatório.</li>
                            </ul>
                        </div>
                    </div>
                    <h4>Dados bancários</h4>
                    <div class="control-group ">
                        <label for="id_banco" class="control-label">Banco:</label>
                        <div class="span6">
                            <select class="form-control" id="id_banco" name="banco" disabled="disabled">
                                <option value="">--</option>
                                <option value="2">Banco Itaú</option>
                                <option value="1">Bradesco</option>
                                <option value="4">Banco do Brasil</option>
                                <option value="6">Caixa Econômica</option>
                                <option value="3">HSBC</option>
                                <option value="7">Santander</option>
                            </select>
                            <ul class="errorlist" style="display: none">
                                <li>Este campo é obrigatório.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_carteira" class="control-label">Carteira:</label>
                        <div class="span6">
                            <select class="form-control" id="id_carteira" name="carteira" disabled="disabled">
                                <option value="">--</option>
                                <option value="5">Carteira 175</option>
                                <option value="2">Carteira 25</option>
                                <option value="1">Carteira 18</option>
                                <option value="6">Carteira 102 / CSR</option>
                                <option value="7">Carteira CNR</option>
                                <option value="4">SIGCB - Carteira SR</option>
                            </select>
                            <ul class="errorlist" style="display: none">
                                <li>Este campo é obrigatório.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_banco_agencia" class="control-label">Agência:</label>
                        <div class="span6">
                            <input class="form-control" id="id_banco_agencia" maxlength="4" name="banco_agencia" value="" type="text" disabled="disabled" style="width: 70px" />
                            <p class="help-block">Preencha a agência com 4 dígitos.</p>
                            <ul class="errorlist" style="display: none">
                                <li>Este campo é obrigatório.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_banco_conta" class="control-label">Conta Corrente sem o dígito:</label>
                        <div class="span6">
                            <input class="form-control" id="id_banco_conta" maxlength="11" name="banco_conta" value="" type="text" disabled="disabled" style="width: 100px" />
                            <p class="help-block">Preencha a conta corrente com 7 dígitos.</p>
                            <ul class="errorlist" style="display: none">
                                <li>Este campo é obrigatório.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_banco_convenio" class="label-convenio control-label">Convênio:</label>
                        <div class="span6">
                            <input class="form-control" id="id_banco_convenio" maxlength="8" name="banco_convenio" value="" type="text" disabled="disabled" style="width: 100px" />
                            <p class="help-convenio help-block">Preencha a código do convênio.</p>
                            <ul class="errorlist" style="display: none"></ul>
                        </div>
                    </div>
                    <h4>Instruções no boleto</h4>
                    <div class="control-group ">
                        <label for="id_dias_vencimento" class="control-label">Dias para vencimento:</label>
                        <div class="span6">
                            <input class="form-control" id="id_dias_vencimento" maxlength="2" name="dias_vencimento" type="text" disabled="disabled" style="width: 50px" />
                            <p class="help-block">Dias para o vencimento do boleto.</p>
                            <ul class="errorlist" style="display: none"></ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_linha_1" class="control-label">Linha 1:</label>
                        <div class="span6">
                            <input class="form-control" disabled="disabled" id="id_linha_1" maxlength="64" name="linha_1" type="text" value="SR CAIXA NÃO ACEITAR APÓS VENCIMENTO." />
                            <p class="help-block">Esta linha não pode ser alterada.</p>
                            <ul class="errorlist" style="display: none"></ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_linha_2" class="control-label">Linha 2:</label>
                        <div class="span6">
                            <input class="form-control" id="id_linha_2" maxlength="64" name="linha_2" value="" type="text" disabled="disabled" />
                            <ul class="errorlist" style="display: none"></ul>
                        </div>
                    </div>
                    <div class="control-group ">
                        <label for="id_linha_3" class="control-label">Linha 3:</label>
                        <div class="span6">
                            <input class="form-control" id="id_linha_3" maxlength="64" name="linha_3" value="" type="text" disabled="disabled" />
                            <ul class="errorlist" style="display: none"></ul>
                        </div>
                    </div>
                    <div class="alert alert-info" id="alertaInfo">
                        <h4>Verifique todos os dados com atenção. Se algum campo for preenchido incorretamente o Boleto Bancário poderá não ser emitido ou, em alguns casos, o pagamento não poderá ser corretamente identificado. Após salvar, imprima o boleto de teste e faça o pagamento do mesmo para garantir o funcionamento.</h4>
                    </div>
                    <div id="modalBoletoTeste" class="modal fade">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="no-margin">Boleto de teste</h4>
                                </div>
                                <div class="modal-body corpo">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="button btn btn-default" data-dismiss="modal" aria-hidden="true">
                                    <span class="glyphicon glyphicon-remove"></span>
                                    Fechar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="btn-group-md text-right">
    <input type='hidden' name='csrfmiddlewaretoken' value='LjreeFW9unfs5t7LkiRhQsVm8f0hfg84' />
    <a href="https://admin.lojaintegrada.com.br/painel/configuracao/pagamento/listar" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
    <button type="submit" class="btn btn-primary btn-save"><span class="glyphicon glyphicon-ok"></span> Salvar alterações</button>
    </div>
    <div id="saveButton">
    <div class="container">
    <div class="button-container">
    <button type="submit" class="btn btn-save btn-primary"><i class="glyphicon glyphicon-ok"></i> Salvar alterações</button>
    </div>
    </div>
    </div>
    </div>
    </form>
</div>
