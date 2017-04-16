<script type='text/javascript' charset='utf-8'>
    function makeid(){
        var text = "";
        var possible = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
    
        for( var i=0; i < 9; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));
    
        return text;
    }
    $(document).ready(function(){

        $("#id_valor_minimo").maskMoney({showSymbol:true, decimal:",", thousands:"."});

        $('#id_validade').mask('99/99/9999');
        $('#toggle-categoria').change(function(event){
            event.preventDefault();
            $('div.categorias').slideToggle();
        })
        $("#id_tipo").change(function(event){
            var value = $(this).val();
            var input_numero = $('#id_valor');
            var numero = input_numero.val();
    
            $('#id_valor').parents('.control-group').slideUp(function(){
                if (value == 'fixo') {
                    $('span.fixo').css({ display: 'inline-block' });
                    $('span.porcentagem').hide();
                } else if (value == 'porcentagem') {
                    $('span.fixo').hide();
                    $('span.porcentagem').css({ display: 'inline-block' });
                } else {
                    $('span.fixo').hide();
                    $('span.porcentagem').hide();
                }
            });
    
            if (value != 'porcentagem') {
                $('.aplicar-no-total').slideUp();
            } else {
                $('.aplicar-no-total').slideDown();
            }
    
            if (value != 'frete_gratis') {
                $('#id_valor').parents('.control-group').slideDown();
            }
        }).change();
        $('#gerar-string').click(function(event){
            event.preventDefault();
            var string = makeid();
            $('#id_codigo').val(string);
        });
    });


</script>

<?php
if (\Lib\Validate::isPost()) {

?>
<script type="text/javascript">
    $(document).ready(function (event) {
        
        $('#id_codigo').val('<?php echo \Lib\Tools::getValue("codigo"); ?>');
        $('#id_valor').val('<?php echo \Lib\Tools::getValue("valor"); ?>');
        $('#id_valor_minimo').val('<?php echo \Lib\Tools::getValue("valor_minimo"); ?>');
        $('#id_quantidade').val('<?php echo \Lib\Tools::getValue("quantidade"); ?>');
        $('#id_quantidade_por_cliente').val('<?php echo \Lib\Tools::getValue("quantidade_por_cliente"); ?>');
        $('#id_validade').val('<?php echo \Lib\Tools::getValue("validade"); ?>');
        $('#id_aplicar_no_total').val('<?php echo \Lib\Tools::getValue("aplicar_no_total"); ?>');

    });
</script>

<?php
}
?>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/cupom/listar"><i class="icon-dollar icon-custom"></i>Cupons de desconto</a> <span class="bread-separator">-</span></li>
        <li><span>Criar cupom</span></li>
    </ul>
</div>
<form action="<?php echo Router::url(); ?>" method="post" class="form-horizontal">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Criando cupom</h3>
            <div class="box-widget pull-right">
                <h4>
                </h4>
            </div>
        </div>
        <div class="box-content">
            <div class="control-group">
                <label for="" class="control-label">Cupom ativo?</label>
                <div class="controls">
                    <select class="input-small" id="id_ativo" name="ativo">
                        <option value="True" <?php if (!(strcmp("True", \Lib\Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Sim</option>
                        <option value="False" <?php if (!(strcmp("False", \Lib\Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Não</option>
                    </select>
                </div>
            </div>

            <?php
            $error = null;
            if (isset($error_codigo)) {
                $error='error';
            }
            ?>
            <div class="control-group obrigatorio campo_nome <?php echo $error; ?>">
                <label class="control-label"><label for="id_codigo">Código do cupom:</label></label>
                <div class="controls">
                    <p>
                        <input id="id_codigo" class="span4" maxlength="32" name="codigo" type="text" required />
                        &nbsp; &nbsp;<a class="btn" href='#' id='gerar-string'><i class="icon-refresh"></i> Gerar código aleatório</a>
                    </p>
                    <?php
                    if (isset($error_codigo)) {
                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                    }
                    ?>                    
                    <p class="help-block">O código do cupom é o que você dará para o seu cliente preencher no carrinho de compras.</p>
                </div>
            </div>

            <?php
            $error = null;
            if (isset($error_descricao)) {
                $error='error';
            }
            ?>
            <div class="control-group obrigatorio campo_nome <?php echo $error; ?>">
                <label class="control-label"><label for="id_descricao">Descrição do cupom:</label></label>
                <div class="controls">
                    <textarea cols="40" id="id_descricao" name="descricao" rows="3"><?php echo \Lib\Tools::getValue("descricao"); ?></textarea>
                    <?php
                    if (isset($error_descricao_comp)) {
                        echo '<ul class="errorlist"><li>Certifique-se de que o valor tenha no máximo 128 caracteres (ele possui '. $error_descricao_comp .').</li></ul>' . PHP_EOL;
                    } elseif (isset($error_descricao)) {
                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                    }
                    ?>
                </div>
            </div>
            <div class="control-group obrigatorio campo_nome ">
                <label class="control-label"><label for="id_tipo">Tipo de cupom:</label></label>
                <div class="controls">
                    <select id="id_tipo" name="tipo">
                        <option value="fixo" <?php if (!(strcmp("fixo", \Lib\Tools::getValue("tipo")))) {echo 'selected="selected"';} ?>>Valor fixo</option>
                        <option value="porcentagem"<?php if (!(strcmp("porcentagem", \Lib\Tools::getValue("tipo")))) {echo 'selected="selected"';} ?>>Porcentagem</option>
                        <option value="frete_gratis" <?php if (!(strcmp("frete_gratis", \Lib\Tools::getValue("tipo")))) {echo 'selected="selected"';} ?>>Frete grátis</option>
                    </select>
                    <p class="help-block">O tipo do cupom define como o desconto será aplicado. O desconto do tipo Fixo e Porcentagem é aplicado sobre o subtotal, não é levado em consideração do valor do frete. Já o tipo Frete Gratis faz com que o desconto fique no valor do frete.</p>
                </div>
            </div>
            <?php
            $error = null;
            if (isset($error_valor)) {
                $error='error';
            }
            ?>
            <div class="control-group obrigatorio campo_nome <?php echo $error; ?>">
                <label class="control-label"><label for="id_valor">Valor:</label></label>
                <div class="controls">
                    <div class="input-prepend input-append"><span class="add-on fixo hide">R$</span><input class="input-small" id="id_valor" name="valor" type="text" /><span class="add-on porcentagem hide">%</span></div>
                    <?php
                    if (isset($error_valor)) {
                        echo '<ul class="errorlist"><li>O valor do desconto não pode ser maior que 100%.</li></ul>' . PHP_EOL;
                    }
                    ?>
                    <p class="help-block">Este é o valor que será aplicado pelo cupom.</p>
                </div>
            </div>
            <?php
            $error = null;
            if (isset($error_valor_minimo)) {
                $error='error';
            }
            ?>
            <div class="control-group obrigatorio campo_nome <?php echo $error; ?>">
                <label class="control-label"><label for="id_valor_minimo">Valor Minimo:</label></label>
                <div class="controls">
                    <div class="input-prepend input-append"><span class="add-on">R$</span><input class="input-small" id="id_valor_minimo" name="valor_minimo" type="text" /></div>
                    <p class="help-block">Caso seja definido este é o valor mínimo para que o cupom seja aplicado. Se o valor dos produtos no carrinho não atingir este valor, o cupom não é aplicado.</p>
                </div>
            </div>
            <?php
            $error = null;
            if (isset($error_quantidade)) {
                $error='error';
            }
            ?>
            <div class="control-group obrigatorio campo_nome <?php echo $error; ?>">
                <label class="control-label"><label for="id_quantidade">Quantidade de cupons:</label></label>
                <div class="controls">
                    <input class="span2" id="id_quantidade" name="quantidade" type="text" />
                    <?php
                    if (isset($error_quantidade)) {
                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                    }
                    ?>
                    <p class="help-block">Define a quantidade de vezes que este cupom poderá ser usado. A cada vez que o cupom é usado este número é reduzido automaticamente.</p>
                </div>
            </div>
            
            <div class="control-group obrigatorio campo_nome ">
                <label class="control-label"><label for="id_cumulativo">Cupom acumulativo?</label></label>
                <div class="controls">
                    <select id="id_cumulativo" class="span2" name="cumulativo">
                        <option value="False" <?php if (!(strcmp("False", \Lib\Tools::getValue("cumulativo")))) {echo 'selected="selected"';} ?>>Não</option>
                        <option value="True" <?php if (!(strcmp("True", \Lib\Tools::getValue("cumulativo")))) {echo 'selected="selected"';} ?>>Sim</option>
                    </select>
                    <p class="help-block">Somar desconto com forma de pagamento ou outros descontos.</p>
                </div>
            </div>
            <?php
            $error = null;
            if (isset($error_quantidade_por_cliente)) {
                $error='error';
            }
            ?>
            <div class="control-group obrigatorio campo_nome <?php echo $error; ?>">
                <label class="control-label"><label for="id_quantidade_por_cliente">Quantidade por cliente:</label></label>
                <div class="controls">
                    <input class="input-mini" id="id_quantidade_por_cliente" name="quantidade_por_cliente" type="text" />
                    <p class="help-block">Número máximo de vezes que um cliente pode usar este cupom. Para não limitar deixe o campo em branco.</p>
                </div>
            </div>
            <?php
            $error = null;
            if (isset($error_validade)) {
                $error='error';
            }
            ?>
            <div class="control-group obrigatorio campo_nome <?php echo $error; ?>">
                <label class="control-label"><label for="id_validade">Validade:</label></label>
                <div class="controls">
                    <input class="input-small span2" id="id_validade" name="validade" type="text" />
                    <?php
                    if (isset($error_validade)) {
                        echo '<ul class="errorlist"><li>Data do cupom inválida, a data precisa estar no futuro.</li></ul>' . PHP_EOL;
                    }
                    ?>
                    <p class="help-block">Data até quando o cupom é válido. Para definir indeterminadamente deixe o campo em branco.</p>
                </div>
            </div>
            <div class="control-group obrigatorio campo_nome aplicar-no-total ">
                <label class="control-label"><label for="id_aplicar_no_total">Aplicar no total?</label></label>
                <div class="controls">
                    <select id="id_aplicar_no_total" name="aplicar_no_total">
                        <option value="True">Sim</option>
                        <option value="False" selected="selected">Não</option>
                    </select>
                    <p class="help-block">Aplicar desconto no total da compra (incluir por exemplo o frete).</p>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Criar cupom</button>
            <a href="<?php echo VIALOJA_PAINEL ?>/recurso/cupom/listar" class="btn"><i class="icon-remove"></i> Cancelar</a>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>
    </div>
</form>
