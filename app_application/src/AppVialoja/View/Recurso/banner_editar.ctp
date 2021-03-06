<script type="text/javascript">
    $(document).ready(function() {
        $('#toggle-mapa-imagem').click(function() {
            $('#mapa-imagem').slideToggle();
            return false;
        });
        $('#id_local_publicacao').change(function(event) {
            var valor = $(this).val();
           // console.log(valor);
            if (valor == 'minibanner') {
                $('#alerta_minibanner').show();
                $('#id_pagina_publicacao').val('pagina_inicial');
                $('#id_pagina_publicacao').parents('.control-group').slideUp();
            } else {
                $('#id_pagina_publicacao').removeAttr('readonly');
                $('#id_pagina_publicacao').parents('.control-group').slideDown();
                $('#alerta_minibanner').hide();
            }
    
            $('.map').removeClass('active');
            $('.map.' + valor).addClass('active');
    
        }).change();
    
    });
</script>

<?php
foreach ($res_banner_posicao as $key => $posicao);
foreach ($res_banner_shop as $key => $dados);
?>

<?php
if (\Lib\Validate::isPost()) {

?>
<script type="text/javascript">
    $(document).ready(function (event) {
        
        $('#id_ativo').val('<?php echo \Lib\Tools::getValue("ativo"); ?>');
        $('#id_nome').val('<?php echo \Lib\Tools::getValue("nome"); ?>');
        $('#id_link').val('<?php echo \Lib\Tools::getValue("link"); ?>');
        $('#id_target').val('<?php echo \Lib\Tools::getValue("target"); ?>');
        $('#id_titulo').val('<?php echo \Lib\Tools::getValue("titulo"); ?>');
        $('#id_mapa_imagem').val('<?php echo \Lib\Tools::getValue("mapa_imagem"); ?>');

    });
</script>

<?php
}
?>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/listar"><i class="icon-th-large"></i> Banners</a> <span class="bread-separator">-</span></li>
        <li><span>Editar banner</span></li>
    </ul>
</div>
<form action="<?php echo Router::url(); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="box editar-banner">
        <div class="box-header">
            <h3 class="pull-left">Editando banner</h3>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <div class="span6">
                    <div class="banner-acoes">
                        <div class="control-group">
                            <label class="control-label"><strong>Banner ativo?</strong></label>
                            <div class="controls">
                                <select class="input-small" id="id_ativo" name="ativo">
                                    <option value="True" <?php if (!(strcmp("True", $dados['ShopBanner']['ativo']))) {echo 'selected="selected"';} ?>>Sim</option>
                                    <option value="False" <?php if (!(strcmp("False", $dados['ShopBanner']['ativo']))) {echo 'selected="selected"';} ?>>Não</option>
                                </select>
                            </div>
                        </div>

                        <?php
                        $error = null;
                        if (isset($error_nome)) {
                            $error='error';
                        }
                        ?>
                        <div class="control-group <?php echo $error; ?>">
                            <label class="control-label"><strong>Nome do banner:</strong></label>
                            <div class="controls">
                                <input class="campo_principal" id="id_nome" maxlength="128" name="nome" type="text" value="<?php echo $dados['ShopBanner']['nome']; ?>" />

                                <?php
                                if (isset($error_nome)) {
                                    echo '<br />
                                    <span class="text-error">Este campo é obrigatório.</span>' . PHP_EOL;
                                    }
                                ?>
                                
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="" class="control-label">
                            <strong>
                            Posição do banner:
                            </strong>
                            </label>
                            <div class="controls">
                                <h4>
                                    <?php echo $posicao['BannerPosicao']['nome']; ?>
                                </h4>
                            </div>
                        </div>
                        <input type="hidden" name="local_publicacao" id="id_local_publicacao" value="<?php echo $posicao['BannerPosicao']['local_publicacao']; ?>" />
                        <div class="control-group ">
                            <label class="control-label"><strong>Local do banner:</strong></label>
                            <div class="controls">
                                <select id="id_pagina_publicacao" name="pagina_publicacao">

                                    <?php
                                    foreach ($res_banner_local as $key => $local) {

                                        $selected = '';
                                        if (\Lib\Tools::getValue('pagina_publicacao') !='') {
                                            $selected = 'selected="selected"';
                                        } else {

                                            if (!(strcmp($local['BannerLocal']['pagina_publicacao'] , $dados['ShopBanner']['pagina_publicacao']))) {

                                               $selected = 'selected="selected"';

                                            }
                                        }
                                   
                                        echo '<option value="'. $local['BannerLocal']['pagina_publicacao'] .'" '.  $selected .'>'. $local['BannerLocal']['nome'] .'</option>' . PHP_EOL;

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group ">
                            <label class="control-label">Link do banner:</label>
                            <div class="controls">
                                <input id="id_link" maxlength="256" name="link" type="text" value="<?php echo $dados['ShopBanner']['link']; ?>" />
                            </div>
                        </div>
                        <div class="target control-group ">
                            <label class="control-label">Quando clicar no link:</label>
                            <div class="controls">
                                <select id="id_target" name="target">

                                    <option value="" <?php if (!(strcmp("", $dados['ShopBanner']['target']))) { echo 'selected="selected"';} ?>>Abrir na mesma janela</option>
                                    
                                    <option value="_blank" <?php if (!(strcmp("_blank", $dados['ShopBanner']['target']))) { echo 'selected="selected"';} ?>>Abrir em nova janela</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group ">
                            <label class="control-label"><strong>Titulo do Banner:</strong></label>
                            <div class="controls">
                                <textarea cols="40" id="id_titulo" name="titulo" rows="3"><?php echo $dados['ShopBanner']['titulo']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">

                    <?php
                    //echo $this->element('/admin/css-javascript/posicao-banners');
                    ?>
                    <!-- posicao-banners -->
                </div>
            </div>


            <!-- row-fluid -->
            <div class="subir-banner">
                <div class="row-fluid">
                    <div class="span6">
                        <h2>Upload da imagem</h2>

                        <?php
                        if (!empty($dados['ShopBanner']['caminho'])) {
                        ?>
                        <div class="banner img-polaroid">
                            <img src="<?php echo CDN_UPLOAD . $this->Session->read('id_shop') . '/banner/' . $dados['ShopBanner']['caminho']; ?>" />
                        </div>
                        <span class="modificar">Modificar banner:</span>
                        <?php
                        }
                        ?>
                        <div class="">
                            <div>
                                <input id="id_caminho" name="caminho" type="file" accept="image/*" />
                                <?php
                                if (isset($error_caminho)) {
                                    echo '<br /> <span class="text-error">Este campo é obrigatório.</span>';
                                }
                                ?>
                                <br /> 
                                <small class="help-text"> Tamanho máximo do arquivo: <strong>500 KB</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="span6">
                        <h2>Mapa da imagem</h2>
                        <a href="#" id="toggle-mapa-imagem" class="btn btn-mini"><i class="icon-th"></i> Inserir mapa da imagem</a>
                        <div id="mapa-imagem" class=" <?php

                        if ( empty( $dados['ShopBanner']['mapa_imagem'] )  ) {
                            echo 'hide';                        
                        } else {

                            if (\Lib\Validate::isPost()) {

                                if ( \Lib\Tools::getValue('mapa_imagem') =='' ) {
                                    echo 'hide';
                                }
                            }

                        }
                        ?>">
                            <div>
                                <textarea cols="40" id="id_mapa_imagem" name="mapa_imagem" rows="3"><?php echo $dados['ShopBanner']['mapa_imagem']; ?></textarea>
                                <p class="help-block">Use o mapa da imagem para inserir um mapa de links para o seu banner. Adicione apenas as tags &lt;area&gt;, <strong>não adicione &lt;map&gt;</strong>. Para saber mais sobre mapas de imagens, <a href="http://www.w3schools.com/tags/tag_map.asp" target="_blank">clique aqui</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row-fluid -->
            </div>
            <!-- subir-banner -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/listar" class="btn btn-small"><i class="icon-remove"></i> Cancelar</a>
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
            </div>
            <div class="clear"></div>
        </div>
    </div>
</form>
