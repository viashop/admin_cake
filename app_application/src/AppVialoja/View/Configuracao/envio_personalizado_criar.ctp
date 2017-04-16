<script type="text/javascript">
    function esconder_pais(lista){
        for(i=0; i < lista.length; i++){
            $(lista[i]).parents('.control-group').hide();
        }
    }
    
    function mostrar_pais(lista){
        for(i=0; i < lista.length; i++){
            $(lista[i]).parents('.control-group').show();
        }
    }
    
    $(document).ready(function(){
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
    
        
        $("#id_com_contrato").parents('.control-group').hide();
    
        $('#id_com_contrato').change(function() {
            if ($('#id_com_contrato option:selected').val() == 'True') {
                lista_esconder = [];
                lista_mostrar = ['#id_codigo', '#id_senha', "#id_codigo_servico", "#id_testar_contrato"];
            } else {
                lista_esconder = ['#id_codigo', '#id_senha', "#id_codigo_servico", "#id_testar_contrato"];
                lista_mostrar = [];
            }
            esconder_pais(lista_esconder);
            mostrar_pais(lista_mostrar);
        }).change();
    
    });
</script>


<?php
if (\Lib\Validate::isPost()) {
?>
<script type="text/javascript">
    $(document).ready(function (event) {
        
        $('#id_ativo').val('<?php echo \Lib\Tools::getValue("ativo"); ?>');
        $('#id_nome').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("nome")); ?>');
        $('#id_prazo_adicional').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("prazo_adicional")); ?>');
        $('#id_taxa_tipo').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("taxa_tipo")); ?>');
        $('#id_taxa_valor').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("taxa_valor")); ?>');

    });
</script>

<?php
}
?>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar"><i class="icon-road"></i> Formas de envio</a> <span class="bread-separator">-</span></li>
        <li><span>Criando forma de envio</span></li>
    </ul>
</div>
<form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="alert alert-info">
            <i class="icon-question-sign"></i> Para saber como configurar corretamente a forma de envio, <a href="//viloja.zendesk.com/entries/22943077-formas-de-envio" target="_blank">leia a documentação</a>.
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="pull-left">
                    Criando nova forma de envio
                </h3>
            </div>
            <div class="box-content">
                <div class="control-group">
                    <label class="control-label" for="id_ativo">Envio ativo?</label>
                    <div class="controls">
                        <select class="input-small" id="id_ativo" name="ativo">
                            <option value="True">Sim</option>
                            <option value="False">Não</option>
                        </select>
                    </div>
                </div>

                <?php
                $error = null;
                if (isset($error_nome)) {
                    $error='has-error';
                }
                ?>
                <div class="control-group <?php echo $error ?>">
                    <label class="control-label" for="id_nome">Nome da forma de envio</label>
                    <div class="controls">
                        <span class="help-block">Este é o nome que será mostrado para o cliente no momento da seleção da forma de envio no pedido.</span>
                        <input id="id_nome" class="span5" required name="nome" type="text" />
                        <?php
                        if (isset($error_nome)) {
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

                                switch ($value) {
                                    case 0:
                                        # code...
                                        echo '<option value="0" selected="selected">nenhum dia</option>'. PHP_EOL;
                                        break;
                                    
                                    case 1:
                                        # code...
                                        echo '<option value="1">mais 1 dia</option>' . PHP_EOL;
                                        break;
                                    
                                    default:
                                        printf('<option value="%d">mais %d dias</option>', $value, $value) . PHP_EOL;
                                        break;
                                }
            
                            }
                            ?>
                        </select>
                        <i class="icon-question-sign help-text" title="Quantidade de dias a mais que será adicionado ao prazo. Sugerimos como margem de segurança pelo menos 1 dia." rel="tooltip" data-placement="right"></i>
                    </div>
                </div>

                 <?php
                $error = null;
                if (isset($error_taxa_valor)) {
                    $error='has-error';
                }
                ?>
                <div class="control-group <?php echo $error ?>">
                    <label class="control-label" for="id_taxa_tipo">Acrescentar ao frete</label>
                    <div class="controls">
                        <span style="float: left;">
                            <select id="id_taxa_tipo" name="taxa_tipo">
                                <option value="fixo">Valor fixo (R$)</option>
                                <option value="porcentagem">Porcentagem (%)</option>
                            </select>
                        </span>
                        <label class="control-label" for="id_taxa_valor" style="width: 30px; text-align: center;">de</label>
                        <div class="taxa-valor" style="margin-top: -1px;">
                            <span class="add-on">R$</span>
                            <input class="input-small" id="id_taxa_valor" name="taxa_valor" type="text" />
                            <span class="add-on">%</span>
                        </div>
                        <?php
                        if (isset($error_taxa_valor)) {
                            echo '<ul class="errorlist"><li>Informe números válidos.</li></ul>' . PHP_EOL;
                        }
                        ?>
                    </div>
                </div>
                <hr />
                <div class="control-group ">
                    <label class="control-label" for="id_imagem">Imagem da forma de envio</label>
                    <div class="controls">
                        <span class="help-block">Envie a imagem que será mostrada no rodapé da sua loja.</span>
                        <input id="id_imagem" name="imagem" type="file" />
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
                <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
                <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
            </div>
        </div>
    </div>
</form>
