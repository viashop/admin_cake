<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="/painel"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar"><i class="icon-briefcase"></i> Minha loja</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/tema/editar"><i class="icon-custom icon-window"></i> Aparência</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/html/listar"><i class="icon-custom icon-pencil"></i> Código HTML</a> <span class="bread-separator">-</span></li>
        <li><span>Edição básica</span></li>
    </ul>
</div>
<form action="<?php echo Router::url(); ?>" method="post" class="">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3>Código HTML</h3>
                <div class="box-widget pull-right">
                    <a href="<?php echo VIALOJA_PAINEL ?>/recurso/html/listar" class="btn btn-primary">Avançado</a>
                </div>
            </div>
            <div class="box-content">
                <p>
                    É comum, você lojista, ter necessidades em relação a códigos html para as mais diversas finalidades, seja instalar um chat de terceiro ou uma ferramenta de monitoramento que não estejamos integrados. Para suprir essa necessidade, criamos dois campos que permite que você insira um script no cabeçalho ou rodapé. Abaixo seguem os campos disponíveis.
                </p>
                <div class="control-group html_cabecalho">
                    <label class="control-label" for="id_html_cabecalho">Código no cabeçalho</label>
                    <div class="help-block">Este código será adicionado dentro da tag &lt;head&gt; e &lt/head&gt; em todas as páginas da loja.</div>
                    <textarea cols="40" id="id_html_cabecalho" name="html_cabecalho" rows="10"><?php

                    if (isset($html_cabecalho)) {
                    	echo $html_cabecalho;
                    }
                    ?></textarea>
                </div>
                <div class="control-group html_rodape">
                    <label class="control-label" for="id_html_rodape">Código no rodapé</label>
                    <div class="help-block">Este código HTML será adicionado logo antes do fechamento da tag &lt;/body&gt; em todas as páginas da loja.</div>
                    <textarea cols="40" id="id_html_rodape" name="html_rodape" rows="10"><?php

                    if (isset($html_rodape)) {
                    	echo $html_rodape;
                    }
                    ?></textarea>
                </div>
            </div>
            <div class="form-actions">
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
                <a href="<?php echo VIALOJA_PAINEL ?>/" class="btn"><i class="icon-remove"></i> Cancelar</a>
            </div>
        </div>
    </div>
</form>