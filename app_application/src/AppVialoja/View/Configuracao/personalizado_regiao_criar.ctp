<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar"><i class="icon-road"></i> Formas de envio</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/personalizado/<?php echo $id_envio_personalizado; ?>/editar"><i class="icon-wrench"></i> Envio &quot;teste&quot;</a> <span class="bread-separator">-</span></li>
		<li><span>Criar região</span></li>
    </ul>
</div>

<?php
if (\Lib\Validate::isPost()) {
?>
<script type="text/javascript">
    $(document).ready(function (event) {
        
        $('#id_pais').val('<?php echo \Lib\Tools::getValue("pais"); ?>');
        $('#id_nome').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("nome")); ?>');
        $('#id_ad_valorem').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("ad_valorem")); ?>');
        $('#id_kg_adicional').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("kg_adicional")); ?>');

    });
</script>
<?php
}
?>

<form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">Criando uma região para teste</h3>
		</div>
		<div class="box-content">
			<div class="form-group ">
				<label class="control-label col-sm-3">País</label>
				<div class="col-sm-9">
					<select class="form-control" id="id_pais" name="pais">
						<option value="Brasil" selected="selected">Brasil</option>
					</select>
				</div>
			</div>
			<?php
            $error = null;
            if (isset($error_nome)) {
                $error='has-error';
            }
            ?>
			<div class="form-group <?php echo $error ?>">
				<label class="control-label col-sm-3">Nome</label>
				<div class="col-sm-9">
					<p class="help-block">Coloque o nome da região abrangida. Por exemplo: &quot;São Paulo&quot;, &quot;Osasco&quot; ou &quot;Grande São Paulo&quot;.</p>
					<input class="form-control" id="id_nome" name="nome" type="text" value="" />
					<?php
                    if (isset($error_nome)) {
                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                    }
                    ?>
				</div>
			</div>
			<?php
            $error = null;
            if (isset($error_ad_valorem)) {
                $error='has-error';
            }
            ?>
			<div class="form-group <?php echo $error ?>">
				<label class="control-label col-sm-3">Ad Valorem</label>
				<div class="col-sm-9">
					<p class="help-block">Valor em porcentagem. Usada por transportadoras para agregar seguro na mercadoria que não está assegurada quando não está em tráfego. Verifique com a sua transportadora o valor que você deve configurar aqui.</p>
					<input class="form-control" id="id_ad_valorem" name="ad_valorem" type="text" value="" />
					<?php
                    if (isset($error_ad_valorem)) {
                        echo '<ul class="errorlist"><li>Informe um número inteiro.</li></ul>' . PHP_EOL;
                    }
                    ?>
				</div>
			</div>
			<?php
            $error = null;
            if (isset($error_kg_adicional)) {
                $error='has-error';
            }
            ?>
			<div class="form-group <?php echo $error ?>">
				<label class="control-label col-sm-3">Preço por KG adicional</label>
				<div class="col-sm-9">
					<p class="help-block">Valor que será pago por KG adicional que ultrapassar o limite de peso desta configuração. Caso não possa ultrapassar o limite de peso, deixe este valor em branco. Valor igual a 0,00 significa que o cliente não será cobrado por KG adicional.</p>
					<input class="form-control" id="id_kg_adicional" name="kg_adicional" type="text" value="" />

					<?php
                    if (isset($error_kg_adicional)) {
                        echo '<ul class="errorlist"><li>Informe um número.</li></ul>' . PHP_EOL;
                    }
                    ?>
				</div>
			</div>
		</div>

		<div class="form-actions">
			<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Salvar alterações</button>
			<a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/personalizado/<?php echo $id_envio_personalizado; ?>/editar" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
			
		</div>

		<div class="box-footer"></div>
	</div>
</form>