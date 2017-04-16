    
<link rel="stylesheet" type="text/css" href="/admin/css/codemirror.css" />
<script src="/admin/js/codemirror/codemirror-compressed.js" type="text/javascript" charset="utf-8"></script>
<script src="/admin/js/codemirror/mode/css/css.js" type="text/javascript" charset="utf-8"></script>
<script>
$(document).ready(function() {
    var editor = CodeMirror.fromTextArea(document.getElementById("id_css"), {
        mode: "css",
        value: "Insira aqui o seu CSS personalizado.",
        lineNumbers: true,
        lineWrapping: true,
        smartIndent: true,
        indentUnit: 4,
        tabSize: 4,
        indentWithTabs: false
    });
});
</script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/tema/alterar"><i class="icon-window icon-custom"></i> Aparência</a> <span class="bread-separator">-</span></li>
		<li><span>Editar CSS</span></li>
	</ul>
</div>
<form action="<?php echo Router::url(); ?>" method="post" class="form-vertical">
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3>Editar CSS</h3>
			</div>
			<div class="box-content">
				<div class="control-group">
					<div class="css-editar">
						<h1>Área de customização do tema</h1>
						<p><b>Aqui você poderá alterar a aparência do tema que você escolheu com o uso de CSS</b></p>
						<p>Os temas possuem <span class="color1">ids</span> e <span class="color1">classes</span> específicos para cada setor, desta maneira você poderá customizar os setores de sua loja individualmente.</p>
						<b>Você poderá alterar</b>
						<ul>
							<li><span>As principais cores de textos (como o preço ou título dos produtos) </span></li>
							<li><span>Backgrounds do topo, corpo, rodapé ou de toda a loja</span></li>
							<li><span>Cores e tamanhos dos botões </span></li>
							<li><span>Customizar o formato de suas tabelas e muito mais</span></li>
						</ul>
						<p>Tudo com o uso de apenas uma <span class="color1">classe</span> ou <span class="color1"> id</span> no editor de CSS a abaixo, aprenda como fazer lendo a nossa <a href="http://<?php echo $url_shop; ?>/documentacao" target="_blank">documentação</a>.</p>
						<p><strong>IMPORTANTE:</strong> Tenha pelo menos um produto em seu carrinho de compras para que as alterações sejam visíveis imediatamente após a mudança. Caso não tenha, pode demorar até 15 minutos para ficarem visíveis.</p>
					</div>
					<label class="control-label"></label>
					<div class="controls">
						<textarea cols="20" id="id_css" name="css" rows="25" style="font-family: monospace;"><?php 

						if(\Lib\Tools::getValue('css')){
							echo \Lib\Tools::getValue('css');
						} else {
							echo $css;
						}

						?></textarea>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
				<a href="#" class="btn"><i class="icon-remove"></i> Cancelar</a>
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
			</div>
		</div>
	</div>
</form>
<!-- /Full width content box -->
