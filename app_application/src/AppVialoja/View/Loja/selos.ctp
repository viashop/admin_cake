<?php

foreach ($selos as $key => $dados);

?>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><span>Selos</span></li>
    </ul>
</div>
<div class="box pagina-selos">
    <div class="box-header">
        <h3>
            Selos
            <a href="http://vialoja.com.br/comunidade/" title="Artigo O que é o E-bit" target="_blank" class="link_ext">
            <i class="icon-share"></i>
            </a>
        </h3>
    </div>
    <form action="" method="post" class="form-horizontal">
        <div class="box-content">
            <div class="row">
                <p><strong>E-bit</strong></p>
                <p>Caso não tenha um cadastro no E-bit, <a href="http://www.ebit.com.br/cadastre-sua-loja" target="_blank">clique aqui</a> e cadastre sua loja.</p>
                <div class="left">
                    <label for="id_selo_ebit">1 - Insira o Selo e-bit (informe o código html enviado pelo e-bit por email):</label>
                    <textarea cols="40" id="id_selo_ebit" name="selo_ebit" rows="7"><?php 

                    if (isset($dados['ShopSelos']['selo_ebit'])) {
                         echo $dados['ShopSelos']['selo_ebit']; 
                    }                

                    ?></textarea>
                </div>
                <div class="right">
                    <label for="id_banner_ebit">2 - Insira o Banner e-bit (informe o código html enviado pelo e-bit por email):</label>
                    <textarea cols="40" id="id_banner_ebit" name="banner_ebit" rows="7"><?php 

                    if (isset($dados['ShopSelos']['banner_ebit'])) {
                        echo $dados['ShopSelos']['banner_ebit']; 
                    }

                    ?></textarea>
                </div>
            </div>
            <div>
                <p class="exemplo"><b>Modelo de como ficará</b></p>


                <div class="text-align-center">

                    <a id="seloEbit" href="http://www.ebit.com.br/#" target="_blank" onclick="redir(this.href);">Avaliação de Lojas e-bit</a>
<script type="text/javascript" id="getSelo" src="https://a248.e.akamai.net/f/248/52872/0s/img.ebit.com.br/ebitBR/selo-ebit/js/getSelo.js?12345" >
</script>
                    <img src="/admin/img/samples/exemplo-selobanner-ebit.jpg" alt="" />
                </div>
            </div>
            <hr/>
            <p class="alert alert-warning">É necessário ter domínio próprio para configuração dos selos abaixo. <a href="<?php echo VIALOJA_PAINEL ?>/loja/configuracao/editar" title="">Clique aqui</a> para configurar domínio próprio.</p>
            <div class="control-group">
                <p>
                    Para que o selo apareça no site é necessário que seja verificado pelo Google Safe Browsing.<br/>
                    <a href="http://www.google.com/safebrowsing/diagnostic?site=<?php echo $dominio['ShopDominio']['dominio']; ?>" title="Verificar site no Google Safe" target="_blank">Clique aqui</a> e veja se está verificado.
                </p>
                <label class="checkbox">

                <?php

                $disabled = 'disabled="disabled"';
                if ($dominio['ShopDominio']['subdominio_plataforma'] === 'False' 
                    && $dominio['ShopDominio']['main'] == '1') {
                    $disabled = '';
                }

                $checked = null;
                if (isset($dados['ShopSelos']['selo_google_safe']) 
                    && $dados['ShopSelos']['selo_google_safe'] == 'on') {
                    $checked = 'checked="checked"';
                }
                ?>   

                <input <?php echo $disabled; ?> id="id_selo_google_safe" name="selo_google_safe" type="checkbox" <?php echo $checked; ?> /> Ativar Selo do Google Browsing Safe
                </label>
                <img src="/admin/img/selos/google-safe-browsing.png" alt="Norton Secured" class="img-float" />
            </div>
            <div class="control-group">
                <p>
                    Para que o selo apareça no site é necessário que seja verificado pelo Norton Secured.<br/>
                    <a href="https://safeweb.norton.com/report/show?url=<?php echo $dominio['ShopDominio']['dominio']; ?>" title="Verificar site no Norton Secured" target="_blank">Clique aqui</a> e veja se está verificado.
                </p>
                <label class="checkbox">

                <?php

                $checked = null;
                if (isset($dados['ShopSelos']['selo_norton_secured']) 
                    && $dados['ShopSelos']['selo_norton_secured'] == 'on') {
                   $checked = 'checked="checked"';
                }
                ?>   

                <input <?php echo $disabled; ?> id="id_selo_norton_secured" name="selo_norton_secured" type="checkbox" <?php echo $checked; ?> /> Ativar selo do Norton Secured
                </label>
                <img src="/admin/img/selos/norton-secured.png" alt="Norton Secured" class="img-float" />
            </div>
            <hr />
            <div class="control-group">
                <p>
                    <small>Disponível somente para a nova estrutura de layout.</small>
                </p>

                <?php
                $checked = 'checked="checked"';
                if (isset($dados['ShopSelos']['selo_seomaster']) 
                    && $dados['ShopSelos']['selo_seomaster'] == 'off') {
                    $checked = '';
                }
                ?>

                <label class="checkbox">
                <input <?php echo $checked; ?> id="id_selo_seomaster" name="selo_seomaster" type="checkbox" /> Ativar selo do Certificado 100% SEO
                </label>
                <img src="/admin/img/selos/seomaster.png" alt="Certificado 100% SEO" class="img-float" style="max-height: 60px; top: 0;" />
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
            <a href="<?php echo VIALOJA_PAINEL ?>/" class="btn"><i class="icon-remove"></i> Cancelar</a>
        </div>
        <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
		<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
    </form>
</div>
