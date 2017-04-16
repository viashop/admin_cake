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
?>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/listar"><i class="icon-th-large"></i> Banners</a> <span class="bread-separator">-</span></li>
        <li><span>Criar banner</span></li>
    </ul>
</div>
<form action="<?php echo Router::url(); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="box editar-banner">
        <div class="box-header">
            <h3 class="pull-left">Criando banner</h3>
        </div>
        <div class="box-content">
            <div class="row-fluid">
                <div class="span6">
                    <div class="banner-acoes">
                        <div class="control-group">
                            <label class="control-label"><strong>Banner ativo?</strong></label>
                            <div class="controls">
                                <select class="input-small" id="id_ativo" name="ativo">
                                    <option value="True" <?php if (!(strcmp("True", \Lib\Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Sim</option>
                                    <option value="False" <?php if (!(strcmp("False", \Lib\Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Não</option>
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
                                <input class="campo_principal" id="id_nome" maxlength="128" name="nome" type="text" value="<?php echo \Lib\Tools::getValue("nome"); ?>" />

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
                                <input id="id_link" maxlength="256" name="link" type="text" value="<?php echo \Lib\Tools::getValue("link"); ?>" />
                            </div>
                        </div>
                        <div class="target control-group ">
                            <label class="control-label">Quando clicar no link:</label>
                            <div class="controls">
                                <select id="id_target" name="target">
                                    <?php 
                                    if (\Lib\Tools::getValue("ativo") != '') {
                                    ?>
                                    <option value="" <?php if (!(strcmp("", \Lib\Tools::getValue("target")))) { echo 'selected="selected"';} ?>>Abrir na mesma janela</option>
                                    <?php 
                                    } else {
                                    ?>
                                    <option value="" selected="selected">Abrir na mesma janela</option>
                                    <?php
                                    }
                                    ?>
                                    <option value="_blank" <?php if (!(strcmp("_blank", \Lib\Tools::getValue("target")))) { echo 'selected="selected"';} ?>>Abrir em nova janela</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group ">
                            <label class="control-label"><strong>Titulo do Banner:</strong></label>
                            <div class="controls">
                                <textarea cols="40" id="id_titulo" name="titulo" rows="3"><?php echo \Lib\Tools::getValue("titulo"); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="posicao-banners">
                        <h4>Posição do Banner</h4>
                        <p>Na nova estrutura o tamaho dos banners variam de acordo com a disposição escolhida no menu configurar tema e a resolução da tela, <a href="//suporte.viaja.com.br/hc/pt-br/articles/1-Banners" target="_blank">clique aqui</a> para saber mais detalhes sobre as dimensões.</p>
                        <div class="mapa-banners">
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="map fullbanner">
                                        <strong>Full banner</strong>
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="A largura maxima 1140px" class="dica tip">?</a>
                                        <div class="span3 map sidebar">
                                            <strong>Lateral f.banner</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid mini-banners">
                                <div class="span4">
                                    <div class="map minibanner"></div>
                                </div>
                                <div class="span4">
                                    <div class="map minibanner">
                                        <strong>Mini banners</strong>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="map minibanner">
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="A largura maxima 360px" class="dica tip">?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="map tarja">
                                        <strong>Banner tarja</strong>
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="A largura maxima 1140px" class="dica tip">?</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span3">
                                    <div class="map esquerda">
                                        <strong>Banner lateral</strong>
                                        <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="A largura maxima 360px" class="dica tip">?</a>
                                    </div>
                                </div>
                                <div class="span9">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="map vitrine">
                                                <strong>Banner vitrine</strong>
                                                <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="A largura maxima 850px" class="dica tip">?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid mini-banners">
                                        <div class="span4">
                                            <div class="map minibanner"></div>
                                        </div>
                                        <div class="span4">
                                            <div class="map inner minibanner">
                                                <strong>Mini Banners</strong>
                                            </div>
                                        </div>
                                        <div class="span4">
                                            <div class="map minibanner">
                                                <a href="#" data-toggle="tooltip" data-placement="top" data-original-title="A largura maxima 360px" class="dica tip">?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- mapa-banners -->
                    </div>
                    <!-- posicao-banners -->
                </div>
            </div>
            <!-- row-fluid -->
            <div class="subir-banner">
                <div class="row-fluid">
                    <div class="span6">
                        <h2>Upload da imagem</h2>
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

                        if (\Lib\Tools::getValue('mapa_imagem') =='') {
                            echo 'hide';
                        } else {

                        } ?>">
                            <div>
                                <textarea cols="40" id="id_mapa_imagem" name="mapa_imagem" rows="3"><?php echo \Lib\Tools::getValue('mapa_imagem'); ?></textarea>
                                <p class="help-block">Use o mapa da imagem para inserir um mapa de links para o seu banner. Adicione apenas as tags &lt;area&gt;, <strong>não adicione &lt;map&gt;</strong>. Para saber mais sobre mapas de imagens, <a href="http://www.w3schools.com/tags/tag_map.asp" target="_blank">clique aqui</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row-fluid -->
            </div>
            <!-- subir-banner -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Criar banner</button>
                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/listar" class="btn btn-small"><i class="icon-remove"></i> Cancelar</a>
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
            </div>
            <div class="clear"></div>
        </div>
    </div>
</form>
