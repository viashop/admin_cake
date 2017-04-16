
<link rel="stylesheet" type="text/css" href="/admin/css/codemirror.css" />
<script src="/admin/js/codemirror/codemirror-compressed.js" type="text/javascript" charset="utf-8"></script>
<script src="/admin/js/codemirror/mode/css/css.js" type="text/javascript" charset="utf-8"></script>
<script src="/admin/js/codemirror/mode/javascript/javascript.js" type="text/javascript" charset="utf-8"></script>
<script src="/admin/js/codemirror/mode/xml/xml.js" type="text/javascript" charset="utf-8"></script>

<script>
    $(document).ready(function() {
        var editor = CodeMirror.fromTextArea(document.getElementById("id_conteudo"), {
            mode: "css",
            value: "Insira aqui o seu CSS personalizado.",
            lineNumbers: true,
            lineWrapping: true,
            smartIndent: true,
            indentUnit: 4,
            tabSize: 4,
            indentWithTabs: false
        });
    	$('#id_tipo').change(function(event) {
    		var valor = $(this).val();
    		if (valor == 'html') {
    			editor.setOption('mode', 'text/html');
    			editor.setOption('htmlMode', true);
    		} else {
    			editor.setOption('htmlMode', false);
    			editor.setOption('mode', valor);
    		}
    	}).change();
    });
</script>
</head>
 
<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/html/listar"><i class="icon-tools icon-custom"></i> HTML</a> <span class="bread-separator">-</span></li>
        <li><span>Criar</span></li>
    </ul>
</div>
<div class="box">
    <div class="box-header">
        <h3>Criar código HTML</h3>
    </div>
    <div class="box-content">
        <form action="<?php echo Router::url(); ?>" method="POST">
            <div class="control-group ">
                <label class="control-label" for="id_descricao">Descrição</label>
                <div class="controls">
                    <input id="id_descricao" maxlength="32" name="descricao" type="text" value="<?php

                    if (isset($descricao)) {
                        echo $descricao;
                    }
                    ?>"/>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" for="id_local_publicacao">Local publicação</label>
                <div class="controls">
                    <select id="id_local_publicacao" name="local_publicacao">
                        <option value="cabecalho" <?php if (!(strcmp('cabecalho', \Lib\Tools::getValue('local_publicacao')))) {echo "selected=\"selected\"";} ?>>Cabeçalho</option>
                        <?php
                        if (!\Lib\Validate::isPost()) {
                            echo '<option value="rodape" selected="selected">Rodapé</option>' . PHP_EOL;
                        } else {    
                        ?>
                        <option value="rodape" <?php if (!(strcmp('rodape', \Lib\Tools::getValue('local_publicacao')))) {echo "selected=\"selected\"";} ?>>Rodapé</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" for="id_pagina_publicacao">Página publicação</label>
                <div class="controls">
                    <select id="id_pagina_publicacao" name="pagina_publicacao">

                        <option value="" <?php if (!(strcmp('', \Lib\Tools::getValue('pagina_publicacao')))) {echo "selected=\"selected\"";} ?>>---------</option>

                        <option value="todas" <?php if (!(strcmp('todas', \Lib\Tools::getValue('pagina_publicacao')))) {echo "selected=\"selected\"";} ?>>Todas as páginas</option>

                        <option value="loja/index" <?php if (!(strcmp('loja/index', \Lib\Tools::getValue('pagina_publicacao')))) {echo "selected=\"selected\"";} ?>>Página inicial - Home</option>

                        <option value="loja/produto_detalhar" <?php if (!(strcmp('loja/produto_detalhar', \Lib\Tools::getValue('pagina_publicacao')))) {echo "selected=\"selected\"";} ?>>Página do produto</option>

                        <option value="loja/categoria_listar" <?php if (!(strcmp('loja/categoria_listar', \Lib\Tools::getValue('pagina_publicacao')))) {echo "selected=\"selected\"";} ?>>Página da categoria</option>

                        <option value="loja/carrinho_index" <?php if (!(strcmp('loja/carrinho_index', \Lib\Tools::getValue('pagina_publicacao')))) {echo "selected=\"selected\"";} ?>>Página do carrinho</option>

                        <option value="checkout/checkout_finalizacao" <?php if (!(strcmp('checkout/checkout_finalizacao', \Lib\Tools::getValue('pagina_publicacao')))) {echo "selected=\"selected\"";} ?>>Página do pedido</option>

                        <option value="checkout/checkout_obrigado" <?php if (!(strcmp('checkout/checkout_obrigado', \Lib\Tools::getValue('pagina_publicacao')))) {echo "selected=\"selected\"";} ?>>Página de finalização do pedido</option>
                       
                    </select>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" for="id_tipo">Tipo de código</label>
                <div class="controls">
                    <select id="id_tipo" name="tipo">
                        <option value="css" <?php if (!(strcmp('css', \Lib\Tools::getValue('tipo')))) {echo "selected=\"selected\"";} ?>>Cascade Style Sheet (CSS)</option>
                        <?php
                        if (!\Lib\Validate::isPost()) {
                            echo ' <option value="html" selected="selected">HTML</option>' . PHP_EOL;
                        } else {    
                        ?>
                        <option value="html" <?php if (!(strcmp('html', \Lib\Tools::getValue('tipo')))) {echo "selected=\"selected\"";} ?>>HTML</option>
                        <?php
                        }
                        ?>
                        <option value="javascript" <?php if (!(strcmp('javascript', \Lib\Tools::getValue('tipo')))) {echo "selected=\"selected\"";} ?>>JavaScript</option>
                    </select>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" for="id_conteudo">Conteúdo</label>
                <div class="controls">

                    <textarea id="id_conteudo" maxlength="6000" name="conteudo" ><?php

                    if (isset($conteudo)) {
                        echo $conteudo;
                    }
                    ?></textarea>
                    <p class="help-block">Tamanho máximo de 6000 caracteres</p>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">
            <i class="icon-white icon-plus"></i> Salvar código HTML
            </button>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </form>
    </div>
    <div class="box-footer"></div>
</div>
