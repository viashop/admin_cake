<?php
if (\Lib\Validate::isPost()) {

?>
<script type="text/javascript">
    $(document).ready(function (event) {
       	
		$('#id_ativo').val('<?php echo \Lib\Tools::getValue("ativo"); ?>');
		$('#id_destaque').val('<?php echo \Lib\Tools::getValue("destaque"); ?>');
		$('#id_nome').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("nome")); ?>');
		$('#id_descricao').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("descricao")); ?>');

    });
</script>

<?php
}
?>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><i class="icon icon-tag"></i> <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/marca/listar">Marca</a> <span class="bread-separator">-</span></li>
		<li><span>Editar marca</span></li>
	</ul>
</div>

<?php
foreach ($res_marca as $key => $marca);
?>

<form enctype="multipart/form-data" action="<?php echo Router::url(); ?>" method="post" class="form-horizontal">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">
                Editando marca <?php echo $marca['ShopMarca']['nome']; ?>
            </h3>
        </div>
        <div class="box-content">
            <div class="control-group">
                <label class="control-label" for="id_ativo">Marca ativa?</label>
                <div class="controls">
                    <select class="input-small" id="id_ativo" name="ativo">
                        <option value="True" <?php if (!(strcmp("True", $marca['ShopMarca']['ativo']))) {echo 'selected="selected"';} ?>>Sim</option>
                        <option value="False" <?php if (!(strcmp("False", $marca['ShopMarca']['ativo']))) {echo 'selected="selected"';} ?>>Não</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="id_destaque">Marca em destaque?</label>
                <div class="controls">
                    <span class="help-block">Marcas com destaques aparecem no carrosel de marcas na sua página home da loja.</span>
                    <select class="input-small" id="id_destaque" name="destaque">
                        <option value="True" <?php if (!(strcmp("True", $marca['ShopMarca']['destaque']))) {echo 'selected="selected"';} ?>>Sim</option>
                        <option value="False" <?php if (!(strcmp("False", $marca['ShopMarca']['destaque']))) {echo 'selected="selected"';} ?>>Não</option>
                    </select>
                </div>
            </div>
            <?php
            $error = null;
            if (isset($error_nome)) {
                $error='error';
            }
            ?>
            <div class="control-group obrigatorio campo_nome <?php echo $error; ?>">
                <label class="control-label" for="id_nome">Nome da marca</label>
                <div class="controls">
                    <input class="campo_principal urlify" id="id_nome" required maxlength="128" name="nome" rel=".url-slug,#id_apelido" type="text" value="<?php echo $marca['ShopMarca']['nome']; ?>" />
                    <div class="control-seamless-editable">
                        <span class="control">http://<?php echo $url_shop;?>/m/<span class="url-slug"><?php echo $marca['ShopMarca']['apelido']; ?></span>/</span>
                        <input id="id_apelido" maxlength="128" name="apelido" type="text" value="<?php echo $marca['ShopMarca']['apelido']; ?>" />
                    </div>
                    <?php
                    if (isset($error_nome)) {
                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                    }
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="id_imagem">Logo</label>
                <div class="controls">
                	<?php
                	if (!empty($marca['ShopMarca']['logo'])) {

                		echo sprintf('<div><img src="%s%s" alt="Logo da Marca" style="margin-bottom: 10px;"></div>', $dir_marcas, $marca['ShopMarca']['logo']) . PHP_EOL;
                	}
                	?>
                    <input id="id_imagem" name="imagem" type="file" accept="image/*" />
                </div>
            </div>
            <?php
            $error = null;
            if (isset($error_descricao_comp)) {
                $error='has-error';
            }
            ?>
            <div class="control-group <?php echo $error; ?>">
                <label for="id_descricao" class="control-label"><label for="id_descricao">Descrição:</label></label>
                <div class="controls">
                    <p class="help-block">A descrição da marca será mostrada na página da marca, logo abaixo do menu lateral. Este conteúdo é de extrema importância para os motores de busca.</p>
                    <textarea cols="40" id="id_descricao" name="descricao" rows="4"><?php echo $marca['ShopMarca']['descricao']; ?></textarea>
                    <?php
                    if (isset($error_descricao_comp)) {
                        echo '<ul class="errorlist"><li>Certifique-se de que o valor tenha no máximo 128 caracteres (ele possui '. $error_descricao_comp .').</li></ul>' . PHP_EOL;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
            <i class="icon-ok icon-white"></i>
            Salvar alterações
            </button>
            <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/marca/listar" title="" class="btn"/><i class="icon-remove"></i> Cancelar</a>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>
    </div>
</form>