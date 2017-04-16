<script type="text/javascript">

$(document).ready(function(){

    $("#tipo_cpf").click(function(evento){

        if ($("#tipo_cpf").attr("checked")){            

            $("#id_nome_completo").css("display", "block");
            $("#id_sexo").css("display", "block");
            $("#id_cpf").css("display", "block");
            $("#id_data_nasc").css("display", "block");
            $("#id_aliases").css("display", "block");

            $("#id_razao_social").css("display", "none");
            $("#id_cnpj").css("display", "none");
            $("#id_tributo").css("display", "none");
            $("#id_ie").css("display", "none");
            $("#id_responsavel").css("display", "none");

        }

    });

    
    $("#tipo_cnpj").click(function(evento){

        if ($("#tipo_cnpj").attr("checked")){            

            $("#id_razao_social").css("display", "block");
            $("#id_cnpj").css("display", "block");
            $("#id_tributo").css("display", "block");
            $("#id_ie").css("display", "block");
            $("#id_responsavel").css("display", "block");

            $("#id_nome_completo").css("display", "none");
            $("#id_cpf").css("display", "none");
            $("#id_sexo").css("display", "none");
            $("#id_data_nasc").css("display", "none");
            $("#id_aliases").css("display", "none");

        }

    });

    <?php
    if (Validate::isPost()) {
    ?>    

        if ($("#tipo_cnpj").attr("checked")){

            $("#id_razao_social").css("display", "block");
            $("#id_cnpj").css("display", "block");
            $("#id_tributo").css("display", "block");
            $("#id_ie").css("display", "block");
            $("#id_responsavel").css("display", "block");

            $("#id_nome_completo").css("display", "none");
            $("#id_cpf").css("display", "none");
            $("#id_sexo").css("display", "none");
            $("#id_data_nasc").css("display", "none");
            $("#id_aliases").css("display", "none");
        }

    <?php
    }
    ?>
    
});

jQuery(document).ready(function($){   
  $('#senha').pstrength();   
});

</script>

<a id="dados"></a>
<section id="columns" class="columns-container">
    <div class="container">
        <div class="row">
            <div id="top_column" class="center_column col-xs-12 col-sm-12 col-md-12"> </div>
        </div>
        <div class="row">
            <section id="center_column" class="col-md-12">
                <div id="noSlide" style="display: block;">
                    <h1 class="page-heading">Criar uma conta</h1>
                    <?php
                    $error_flash = $this->Session->flash();

                    if (isset($error_flash)) {
                        echo $error_flash;
                    }

                    ?>
                   
                    <form id="account-creation_form" class="std box form-horizontal" method="post" name="form" action="<?php echo \Lib\Tools::getUrl(); ?>">
                        <div class="account_creation">
                            <h3 class="page-subheading">Dados Cadastrais</h3>
                            <p class="info-title">
                            Por favor, preencha os dados corretamente pois a qualquer monento poderemos pedir a confirmação dos dados.
                        </p>

                            <p class="required">
                                <span style="color:red">
                                    <sup>*</sup>
                                    Campo obrigatório
                                </span>
                            </p>

                            <div class="clearfix form-group">
                                <label class="control-label col-sm-4">Tipo de cadastro</label>
                                <div class="col-sm-6" style="font-size:12px; font-weight: lighter;">
                                    <div class="radio-inline">
                                        <label for="tipo_cpf" class="top">
                                        <input name="tipo_cadastro" id="tipo_cpf" value="cpf" type="radio" <?php

                                        if (!Validate::isPost()) {
                                            echo 'checked="checked"';
                                        } else {

                                            if (!(strcmp("cpf", \Lib\Tools::getValue('tipo_cadastro')))) { echo 'checked="checked"';
                                            }

                                        }
                                        ?>>
                                        Pessoa física</label>
                                    </div>
                                    <div class="radio-inline">
                                        <label for="tipo_cnpj" class="top">
                                        <input name="tipo_cadastro" id="tipo_cnpj" value="cnpj" type="radio" <?php if (!(strcmp("cnpj", \Lib\Tools::getValue('tipo_cadastro')))) {echo 'checked="checked"';} ?>>
                                        Empresa pessoa jurídica</label>
                                    </div>
                                </div>
                            </div>

                            <div class="required form-group" id="id_nome_completo">
                                <label class="control-label col-sm-4" for="nome_completo">
                                Nome Completo
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-6">
                                    <input id="nome_completo" class="is_required validate form-control" type="text" value="<?php echo \Lib\Tools::getValue('nome_completo'); ?>" name="nome_completo">
                                </div>
                            </div>

                            <div class="required form-group" id="id_razao_social" style="display: none;">
                                <label class="control-label col-sm-4" for="razao_social">
                                Razão social da empresa
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-6">
                                    <input id="razao_social" class="is_required validate form-control" type="text" value="<?php echo \Lib\Tools::getValue('razao_social'); ?>" name="razao_social">
                                </div>
                            </div>

                            <div class="clearfix form-group" id="id_sexo">
                                <label class="control-label col-sm-4">
                                    Sexo
                                    <sup>*</sup>
                                </label>
                                <div class="col-sm-6">

                                    <div class="row">
                                        <div class="col-sm-4 col-xs-4">

                                            <select id="sexo" class="form-control" name="sexo">
                                                <option value="" <?php if (!(strcmp("", \Lib\Tools::getValue('sexo')))) {echo 'selected="selected"';} ?>>Selecione</option>
                                                <option value="1" <?php if (!(strcmp("1", \Lib\Tools::getValue('sexo')))) {echo 'selected="selected"';} ?>>Masculino</option>
                                                <option value="2" <?php if (!(strcmp("2", \Lib\Tools::getValue('sexo')))) {echo 'selected="selected"';} ?>>Feminino</option>
                                            </select>

                                         </div>   
                                    </div> 
                                    
                                </div>
                            </div>

                            <div class="required form-group" id="id_cpf">
                                <label class="control-label col-sm-4" for="cpf">
                                CPF
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-6">

                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6">

                                            <input id="cpf" class="is_required validate form-control" type="text" value="<?php echo \Lib\Tools::getValue('cpf'); ?>" name="cpf">

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="required form-group" id="id_cnpj" style="display: none;">
                                <label class="control-label col-sm-4" for="cnpj">
                                CNPJ
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-6">

                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6">

                                            <input id="cnpj" class="is_required validate form-control" type="text" value="<?php echo \Lib\Tools::getValue('cnpj'); ?>" name="cnpj">

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>


                            <div class="clearfix form-group" id="id_tributo" style="display: none;">
                                <label class="control-label col-sm-4">Informações tributárias</label>
                                <div class="col-sm-6" style="font-size:12px; font-weight: lighter;">
                                    <div class="radio-inline">
                                        <label for="info_tributo1" class="top">
                                        <input name="info_tributo" id="info_tributo1" value="1" type="radio" <?php

                                        if (!Validate::isPost()) {
                                            echo 'checked="checked"';
                                        } else {

                                            if (!(strcmp("1", \Lib\Tools::getValue('info_tributo')))) { echo 'checked="checked"';
                                            }

                                        }
                                        ?>>
                                        Contribuinte ICMS</label>
                                    </div>
                                    <div class="radio-inline">
                                        <label for="info_tributo2" class="top">
                                        <input name="info_tributo" id="info_tributo2" value="2" type="radio" <?php if (!(strcmp("2", \Lib\Tools::getValue('info_tributo')))) {echo 'checked="checked"';} ?>>
                                         Não Contribuinte</label>
                                    </div>
                                    <div class="radio-inline">
                                        <label for="info_tributo3" class="top">
                                        <input name="info_tributo" id="info_tributo3" value="3" type="radio" <?php if (!(strcmp("3", \Lib\Tools::getValue('info_tributo')))) {echo 'checked="checked"';} ?>>
                                         Isento de Inscrição Estadual</label>
                                    </div>
                                </div>
                            </div>


                            <div class="required form-group" id="id_ie" style="display: none;">
                                <label class="control-label col-sm-4" for="cnpj">
                                Inscrição Estadual
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-6">

                                    <div class="row">
                                        <div class="col-sm-6 col-xs-6">

                                            <input id="ie" class="is_required validate form-control" type="text" value="<?php echo \Lib\Tools::getValue('ie'); ?>" name="ie">

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>


                            <div class="required password form-group" id="id_data_nasc">
                                <label class="control-label col-sm-4" for="data_nasc">
                                Data de nascimento
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-3">
                                    <input id="data_nasc" class="is_required validate form-control" type="text" name="data_nasc" value="<?php echo \Lib\Tools::getValue('data_nasc'); ?>" onBlur="VerificaData(this.value);">
                                    <span class="form_info">Ex.: 00/00/0000</span>
                                </div>
                            </div>

                            <div class="required password form-group">
                                <label class="control-label col-sm-4" for="data_nasc">
                                Telefone
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-3">
                                    <input id="telefone_residencial" class="is_required validate form-control" type="tel" name="telefone_residencial" value="<?php echo \Lib\Tools::getValue('telefone_residencial'); ?>" required>
                                </div>
                            </div>

                            <div class="required password form-group">
                                <label class="control-label col-sm-4" for="telefone_celular">
                                Telefone celular
                                </label>
                                <div class="col-sm-3">
                                    <input id="telefone_celular" class="is_required validate form-control" type="tel" name="telefone_celular" value="<?php echo \Lib\Tools::getValue('telefone_celular'); ?>">
                                </div>
                            </div>

                            <div class="required form-group" id="id_aliases">
                                <label class="control-label col-sm-4" for="aliases">
                                Como gostaria de ser chamado?
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-6">
                                    <input id="aliases" class="is_required validate form-control" type="text" value="<?php echo \Lib\Tools::getValue('aliases'); ?>" name="aliases">
                                </div>
                            </div>

                            <div class="required form-group" id="id_responsavel" style="display: none;">
                                <label class="control-label col-sm-4" for="responsavel">
                                Responsável
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-6">
                                    <input id="responsavel" class="is_required validate form-control" type="text" value="<?php echo \Lib\Tools::getValue('responsavel'); ?>" name="responsavel">
                                </div>
                            </div>                             

                            <div class="required form-group">
                                <label class="control-label col-sm-4" for="email">
                                E-mail
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-6">
                                    <input id="email" class="is_required validate form-control" type="email" value="<?php echo @$email; ?>" name="email" required placeholder="Informe seu email">
                                </div>
                            </div>

                            <div class="required password form-group">
                                <label class="control-label col-sm-4" for="senha">
                                Senha vialoja.com
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-3">
                                    <input id="senha" class="is_required validate form-control" type="password" name="senha" required>
                                    <span class="form_info">(mín. 6 caracteres)</span>

                                    <div id="pstrength">
                                        <div id="input_senha_minchar" style="max"></div>
                                    </div> 
                                </div>
                                
                            </div>

                            <div class="required password form-group">
                                <label class="control-label col-sm-4" for="confirmacao_senha">
                                Confirme sua senha
                                <sup>*</sup>
                                </label>
                                <div class="col-sm-3">
                                    <input id="confirmacao_senha" class="is_required validate form-control" type="password" name="confirmacao_senha" required>
                                </div>
                            </div>
                           

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <div class="checkbox">
                                        <input id="optin" type="checkbox" checked="checked" value="True" name="optin">
                                        <label for="optin">Receber ofertas da ViaLoja.com por e-mail?</label>

                                    </div>
                                    <div class="checkbox">
                                        <input id="check" type="checkbox" value="True" name="check" required <?php

                                        if (\Lib\Tools::getValue('check') =='True') {
                                            echo 'checked="checked"';
                                        }

                                        ?>>
                                        <label for="optin">Li e aceito todos os <a href="/termos" target="_BLANK" style="color:blue;">termos de serviço.</a></label>

                                    </div>
                                    <br />
                                    <button id="submitAccount" class="btn btn-outline button button-medium" name="submitAccount" type="submit">
                                    <span>Cadastrar</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="submit clearfix">
                            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                            <input type="hidden" value="1" name="email_create">
                            <input type="hidden" value="1" name="is_novo_cliente">
                            <input class="hidden" type="hidden" value="minha-conta" name="back">
                            
                        </div>
                    </form>

                    <?php
                    if (isset($error_flash)) {
                        echo $error_flash;
                    }

                    ?>
                </div>

            </section>
        </div>
    </div>
</section>