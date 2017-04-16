<style type="text/css">
<!--    
    input[type="checkbox"]{ margin: -4px 3px; }
-->
</style>
<script type="text/javascript">
    function esconder_pais(lista){
        for(i=0; i < lista.length; i++){
            $(lista[i]).parents('.control-group').slideUp();
        }
    }
    
    function mostrar_pais(lista){
        for(i=0; i < lista.length; i++){
            $(lista[i]).parents('.control-group').slideDown();
        }
    }
    
    $(document).ready(function(){

        $('#id_cep_origem').mask('99999-999');

        $("#id_taxa_tipo").change(function() {
            if ($("#id_taxa_tipo option[value=fixo]").attr("selected")) {
              $('#id_taxa_valor').parent().addClass('input-prepend').removeClass('input-append');
              $('#id_taxa_valor').parent().find(':first-child').show();
              $('#id_taxa_valor').parent().find(':last-child').hide();
            } else if ($("#id_taxa_tipo option[value=porcentagem]").attr("selected")) {
              $('#id_taxa_valor').parent().addClass('input-append').removeClass('input-prepend');
              $('#id_taxa_valor').parent().find(':first-child').hide();
              $('#id_taxa_valor').parent().find(':last-child').show();
            } else {
              $('#id_taxa_valor').parent().removeClass('input-prepend input-append');
              $('#id_taxa_valor').parent().find(':first-child').hide();
              $('#id_taxa_valor').parent().find(':last-child').hide();
            }
        }).change();        
    
        $('#id_com_contrato').change(function() {
            if ($('#id_com_contrato option:selected').val() == 'True') {
                lista_esconder = [];
                lista_mostrar = ['#id_codigo', '#id_senha', "#id_codigo_servico", "#btn_validar_dados_contrato"];
            } else {
                lista_esconder = ['#id_codigo', '#id_senha', "#id_codigo_servico", "#btn_validar_dados_contrato"];
                lista_mostrar = [];
            }
            esconder_pais(lista_esconder);
            mostrar_pais(lista_mostrar);
        }).change();
    
        var mostrar_mensagem = function(tipo, mensagem) {
          btn = $('#btn_validar_dados_contrato');
          parent = btn.parent();
          parent.find('.alert').remove();
    
          var div = $('<div class="alert">').text(mensagem);
          div.addClass(tipo == 'erro' ? 'alert-error' : 'alert-success');
          div.insertBefore($('#btn_validar_dados_contrato'));
        };
    
        $('#btn_validar_dados_contrato').click(function() {
          var servico = $('#id_codigo_servico').val();
          var codigo = $('#id_codigo').val();
          var senha = $('#id_senha').val();
    
          if (!servico || !codigo || !senha) {
            mostrar_mensagem('erro', 'Você deve selecionar um código de serviço e depois inserir o código administrativo e a senha de acesso.');
            return false;
          }
    
          var params = {"servico": servico, "codigo": codigo, "senha": senha};
          $.post('/admin/configuracao/envio/contrato/validar', params, function(data) {
            if (data.estado == 'sucesso') {
              if (data.valido) {
                tipo = 'sucesso';
              } else {
                tipo = 'erro';
              }
              mostrar_mensagem(tipo, data.mensagem);
            } else {
              mostrar_mensagem('erro', data.erro);
            }
          }, 'json');
          return false;
        });
    });
</script>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar"><i class="icon-road"></i> Formas de envio</a> <span class="bread-separator">-</span></li>
        <li><span>Configuração de forma de envio</span></li>
    </ul>
</div>

<?php
foreach ($conf_envio as $key => $envio);
foreach ($forma_envio_shop as $key => $forma);
?>

<div class="row">
    <form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post" enctype="multipart/form-data">
        <div class="box">
            <div class="box-header">
                <h3 class="pull-left">
                    Forma de envio <?php echo $envio['ConfiguracaoEnvio']['title']; ?>
                </h3>
            </div>
            <div class="box-content">
                <div class="row-fluid">
                    <div class="span3">
                        <div class="thumbnail">
                            <img src="/admin/img/formas-de-envio/<?php echo $envio['ConfiguracaoEnvio']['logo']; ?>" />
                        </div>
                    </div>
                    <div class="span7 text-align-left">
                        <h3>
                            <?php echo $envio['ConfiguracaoEnvio']['title']; ?>
                        </h3>
                    </div>
                </div>
                <hr />
                <div class="control-group">
                    <label class="control-label" for="id_ativo">Ativado</label>
                    <div class="controls">
                        <select class="input-small" id="id_ativo" name="ativo">
                             <option value="True" <?php if (!(strcmp("True", $envio_ativo))) { echo 'selected="selected"';} ?>>Sim</option>
                             <option value="False" <?php if (!(strcmp("False", $envio_ativo))) { echo 'selected="selected"';} ?>>Não</option>
                        </select>
                    </div>
                </div>
                <?php
                $error = null;
                if (isset($error_cep)) {
                    $error='error';
                }

                ?>
                <div class="control-group <?php echo $error; ?>">
                    <label class="control-label" for="id_cep_origem">CEP de origem</label>
                    <div class="controls">
                        <input class="span2" id="id_cep_origem" maxlength="10" name="cep_origem" type="text" required value="<?php

                            if (\Lib\Validate::isPost()) {
                                echo \Lib\Tools::getValue('cep_origem');
                            } else {

                                if (isset($forma['ShopEnvioCorreios']['cep_origem'])) {
                                    echo $forma['ShopEnvioCorreios']['cep_origem'];
                                }                                
                            }
                         ?>" />
                        <i class="icon-question-sign help-text" title="CEP por onde as mercadorias serão enviadas." rel="tooltip" data-placement="right"></i>
                         <?php
                        if (isset($error_cep)) {
                            echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                        }
                        ?>
                    </div>

                </div>
                <div class="control-group ">
                    <label class="control-label" for="id_prazo_adicional">Prazo adicional</label>
                    <div class="controls">
                        <select class="input-medium" id="id_prazo_adicional" name="prazo_adicional">

                            <?php
                            $array_value = array(0,1,2,3,4,5,6,7,8,9,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90);

                            foreach ($array_value  as $key => $value) {

                                if (\Lib\Tools::getValue('prazo_adicional') != '') {
                                    $prazo_adicional = \Lib\Tools::getValue('prazo_adicional');
                                } else {

                                    if (isset($forma['ShopEnvioCorreios']['prazo_adicional'])) {
                                        $prazo_adicional = $forma['ShopEnvioCorreios']['prazo_adicional'];
                                    } else {
                                        $prazo_adicional = '';
                                    }
                                    
                                }

                                $selected = '';    
                                if (!(strcmp($value, $prazo_adicional ))) {
                                    $selected = 'selected="selected"';
                                }

                                if ($value==0) {
                                    echo '<option value="0" '.$selected .'>nenhum dia</option>' .PHP_EOL;
                                } elseif($value==1) {
                                    echo '<option value="1" '.$selected .'>mais 1 dia</option>' .PHP_EOL;
                                } else {
                                    echo '<option value="'.$value.'" '.$selected .'>mais '.$value.' dias</option>' .PHP_EOL;
                                }
                                
                            }
                            ?>

                        </select>
                        <i class="icon-question-sign help-text" title="Quantidade de dias a mais que será adicionado ao prazo. Sugerimos como margem de segurança pelo menos 1 dia." rel="tooltip" data-placement="right"></i>
                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="id_taxa_tipo">Acrescentar ao frete</label>
                    <div class="controls">
                        <span style="float: left;">

                            <select id="id_taxa_tipo" name="taxa_tipo">
                                <option value="fixo" <?php 

                                if (\Lib\Tools::getValue('taxa_tipo') !='') {
                                    $taxa_tipo = \Lib\Tools::getValue('taxa_tipo');
                                } else {

                                    if (isset($forma['ShopEnvioCorreios']['taxa_tipo'])) {
                                        $taxa_tipo = $forma['ShopEnvioCorreios']['taxa_tipo'];
                                    } else {
                                        $taxa_tipo = 'fixo';
                                    }
                                    
                                }

                                if (!(strcmp("fixo", $taxa_tipo))) { echo 'selected="selected"';}


                                 ?>>Valor fixo (R$)</option>
                                <option value="porcentagem" <?php

                                 if (!(strcmp("porcentagem", $taxa_tipo))) { echo 'selected="selected"';} 


                                 ?>>Porcentagem (%)</option>
                            </select>
                        </span>
                        <label class="control-label" for="id_taxa_valor" style="width: 30px; text-align: center;">de</label>
                        <div class="taxa-valor" style="margin-top: -1px;">
                            <span class="add-on">R$</span>
                            <input class="input-small" id="id_taxa_valor" name="taxa_valor" type="text" <?php

                            if (\Lib\Tools::getValue('taxa_valor') !='') {
                                $taxa_valor = \Lib\Tools::getValue('taxa_valor');
                            } else {

                                if (isset($forma['ShopEnvioCorreios']['taxa_valor'])) {
                                    $taxa_valor = $forma['ShopEnvioCorreios']['taxa_valor'];
                                } else {
                                    $taxa_valor = '';
                                }
                                
                            }

                            if ( $taxa_valor > 0) {
                                echo sprintf('value="%s"', \Lib\Tools::convertToDecimalBR( $taxa_valor ));
                            }
                            ?> />
                            <span class="add-on">%</span>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="control-group ">
                    <label class="control-label" for="id_com_contrato">Possui contrato com o Correios?</label>
                    <div class="controls" style="margin-top: 10px;">
                        <select class="input-small" id="id_com_contrato" name="com_contrato">   

                            <?php
                            if (\Lib\Tools::getValue('com_contrato') != '') {
                                $com_contrato = \Lib\Tools::getValue('com_contrato');
                            } else {

                                if (isset($forma['ShopEnvioCorreios']['com_contrato']) 
                                    && $forma['ShopEnvioCorreios']['com_contrato'] == 'True') {
                                    $com_contrato = 'True';
                                } else {
                                    $com_contrato = 'False';
                                }

                            }
                            ?>

                            <option value="True" <?php if (!(strcmp("True", $com_contrato))) { echo 'selected="selected"';} ?>>Sim</option>
                            <option value="False" <?php if (!(strcmp("False", $com_contrato))) { echo 'selected="selected"';} ?>>Não</option>

                        </select>
                        <span class="help-block" style="display: inline-block; margin: 0 0 0 10px; padding: 14px 0;">Saiba o que é este contrato <a href="http://blog.vialoja.com.br/pequena-franquia-virtual-contrato-com-os-correios/" target="_blank">clicando aqui</a>.</span>

                        <?php
                        if ($this->request->params['pass']['3'] == 3) {
                        ?>

                        <div class="alert alert-warning no-margin">
                            <p>
                              <b>ATENÇÃO:</b>
                            </p>
                            Esta forma de envio é disponível somente para pessoas que tenham contrato com os Correios.
                        </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="control-group ">
                    <label class="control-label" for="id_codigo_servico">Código do serviço</label>
                    <div class="controls">
                        <select id="id_codigo_servico" name="codigo_servico">

                            <?php

                            if (\Lib\Tools::getValue('codigo_servico') != '') {
                                $codigo_servico = \Lib\Tools::getValue('codigo_servico');
                            } else {

                                if (isset($forma['ShopEnvioCorreios']['codigo_servico'])) {
                                    $codigo_servico = $forma['ShopEnvioCorreios']['codigo_servico'];
                                } else {
                                    $codigo_servico = '';
                                }

                            }                            

                            foreach ($code_contrato as $key => $code) {                                

                                $selected = '';
                                if ($codigo_servico == $code['CodigoCorreios']['codigo']) {
                                    $selected = 'selected="selected"';
                                }

                                printf('<option value="%d" %s>%d - %s</option>', $code['CodigoCorreios']['codigo'], $selected, $code['CodigoCorreios']['codigo'], $code['CodigoCorreios']['servico']) . PHP_EOL;
                            }

                            ?>

                        </select>                       

                        <i class="icon-question-sign help-text" title="Esta informação está junto ao seu contrato" rel="tooltip" data-placement="right"></i>
                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="id_codigo">Código administrativo</label>
                    <div class="controls">
                        <p class="help-block">Código de 8 dígitos que consta no seu Cartão de Postagem.</p>
                        <input class="span4" id="id_codigo" maxlength="128" name="codigo" type="text" <?php

                            if (\Lib\Tools::getValue('codigo') != '') {
                                $codigo = \Lib\Tools::getValue('codigo');
                            } else {

                                if (isset($forma['ShopEnvioCorreios']['codigo'])) {
                                    $codigo = $forma['ShopEnvioCorreios']['codigo'];
                                } else {
                                    $codigo = '';
                                }
                                
                            }

                            echo sprintf('value="%s"', $codigo );
                            
                            ?> />
                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="id_senha">Senha de acesso</label>
                    <div class="controls">
                        <p class="help-block">Senha de 8 dígitos. Caso não tenha alterado, a senha é formada pelos 8 primeiros dígitos do CNPJ da sua empresa.</p>
                        <input class="span4" id="id_senha" maxlength="128" name="senha" type="text" <?php

                            if (\Lib\Tools::getValue('senha') !='') {
                                $senha = \Lib\Tools::getValue('senha');
                            } else {

                                if (isset($forma['ShopEnvioCorreios']['senha'])) {
                                    $senha = $forma['ShopEnvioCorreios']['senha'];
                                } else {
                                    $senha = '';
                                }
                                
                            }

                            echo sprintf('value="%s"', $senha );
                            
                            ?> />
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <a href="#" class="btn btn-small btn-primary" id="btn_validar_dados_contrato">Validar dados do contrato</a>
                    </div>
                </div>
                <hr />
                <h5 style="margin-bottom: 20px;">Serviços adicionais prestados pelo correios. <small>Consulte junto ao correios o valor que será acrescentado ao frete para cada serviço.</small></h5>
                <div class="control-group control-group-mini ">
                    <label class="checkbox">
                    <input id="id_mao_propria" name="mao_propria" type="checkbox" <?php

                    if (\Lib\Tools::getValue('mao_propria') == 'on') {
                        $mao_propria = 'S';
                    } else {

                        if (isset($forma['ShopEnvioCorreios']['mao_propria'])) {
                            $mao_propria = $forma['ShopEnvioCorreios']['mao_propria'];
                        } else {
                            $mao_propria = '';
                        }
                        
                    }

                    if (!(strcmp("S", $mao_propria))) { echo 'checked="checked"';} ?> />
                    Entrega em mão própria
                    </label>
                </div>

                <div class="control-group control-group-mini ">
                    <label class="checkbox">
                    <input id="id_valor_declarado" name="valor_declarado" type="checkbox" <?php 

                    if (\Lib\Tools::getValue('valor_declarado') == 'on') {
                        $valor_declarado = 'S';
                    } else {

                        if (isset($forma['ShopEnvioCorreios']['valor_declarado'])) {
                            $valor_declarado = $forma['ShopEnvioCorreios']['valor_declarado'];
                        } else {
                            $valor_declarado = '';
                        }
                        
                    }

                    if (!(strcmp("S", $valor_declarado))) { echo 'checked="checked"';} 

                    ?> />
                    Declarar valor dos produtos
                    </label>
                </div>
                <div class="control-group control-group-mini ">
                    <label class="checkbox">
                    <input id="id_aviso_recebimento" name="aviso_recebimento" type="checkbox" <?php 

                    if (\Lib\Tools::getValue('aviso_recebimento') == 'on') {
                        $aviso_recebimento = 'S';
                    } else {

                        if (isset($forma['ShopEnvioCorreios']['aviso_recebimento'])) {
                            $aviso_recebimento = $forma['ShopEnvioCorreios']['aviso_recebimento'];
                        } else {
                           $aviso_recebimento = '';
                        }

                    }                    

                    if (!(strcmp("S", $aviso_recebimento))) { echo 'checked="checked"';}

                    ?> />
                    Aviso de recebimento
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
                <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
            </div>
        </div>
    </form>
</div>
