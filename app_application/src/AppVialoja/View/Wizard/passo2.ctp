<?php

if (\Lib\Tools::getValue('cidade') <=0) {
    $cidade_id = 0;
} else {
    $cidade_id = \Lib\Tools::getValue('cidade');
}
?>
<script type="text/javascript">
    CIDADE_PADRAO = <?php echo $cidade_id;?>;
    $(document).ready(function (event) {

        var loading_cidades = function() {
            var pai = $('#id_cidade_ibge');
            pai.find('option').remove();
        }

        var remover_loading_cidades = function() {
            var pai = $('#id_cidade_ibge');
            pai.find('option').remove();
            pai.removeAttr('disabled');
        }

        var atualizar_cidades = function(cidades) {
            remover_loading_cidades();
            var pai = $('#id_cidade_ibge');
            pai.find('option').remove();
            $.each(cidades, function(i, e) {
                if(CIDADE_PADRAO == e.id_ibge) {
                    pai.append(
                        $('<option>').attr({'value': 'e.id_ibge'}).html(e.nome).attr('selected', 'selected').val('230070')
                    );
                } else {
                    pai.append(
                        $('<option>').attr({'value': e.id_ibge}).html(e.nome)
                    );
                }
            });
        }

        $('#id_estado').change(function() {
            var self = $(this);
            var uf = self.val();
            loading_cidades();
            if (uf != '--') {
                $.post('/admin/cidades/getCidadeId/' + uf + '.json', {}, function(data) {
                    if (data.estado == 'SUCESSO') {
                        atualizar_cidades(data.cidades, 0);
                        return false;
                    } else {
                        remover_loading_cidades();
                    }
                }, 'json');
            }
        }).change();

        $('#fomulario-endereco').submit(function(event) {
            var nome_cidade = $('#id_cidade_ibge').find('option:selected').text();
            $('#id_cidade').val(nome_cidade);

        });

    });
</script>

<?php

if (\Lib\Validate::isPost()) {

?>
<script type="text/javascript">
    $(document).ready(function (event) {

        $('#id_email').val('<?php echo \Lib\Tools::getValue("email"); ?>');

    });
</script>

<?php
}
?>

<div id="wizard configure-sua-loja globalContainer">

    <div class="body container">

        <?php
        echo $this->element('wizard/progressBar');
        ?>

        <form method="post" action="<?php echo Router::url(); ?>" enctype="multipart/form-data" >
            <div class="step-title">
                <i class="icon-wizard icon-step">02</i>
                <h1>Configure sua loja<small class="icon-wizard icon-tools icon-title"></small></h1>
            </div>
            <div id="logoLoja" class="logo-upload pull-left">
                <div class="content no-logo">
                    <button id="buttonUploadLogo" type="button"><i class="icon-custom icon-upload-image icon-white icon-bigger"></i> <span>Enviar  logo da loja</span></button>

                    <?php
                    if (!$this->Session->read('filename_wizard')) :
                    ?>

                    <span class="img-text">Arraste seu logotipo <br />para esta área. <br />300×200 pixels</span>
                    <?php
                    endif;
                    ?>

                    <input type="file" id="fileUploadLogo" name="logo"  data-url="/admin/logo/alterar_logo_json" />
                    <span class="upload hide">Fazendo upload...</span>
                    <div id="uploadProgressbar" class="progress upload hide">
                        <div class="bar" style="width: 0%;"></div>
                    </div>

                    <?php
                    if ($this->Session->read('filename_wizard')) :
                    ?>

                    <img id="imgLogo" src="<?php echo CDN_UPLOAD . $this->Session->read('filename_wizard'); ?>" data-src="<?php echo CDN_UPLOAD; ?>"
                         alt="<?php echo \Lib\Tools::getValue('dominio'); ?>"/>

                    <?php
                    else:
                    ?>
                        <img id="imgLogo" src="/admin/img/logo-arraste.png" data-src="<?php echo CDN_UPLOAD; ?>"
                             alt="<?php echo \Lib\Tools::getValue('dominio'); ?>"/>

                    <?php
                    endif;
                    ?>
                </div>
            </div>
            <div class="main-box store-info pull-right">
                <div class="content">

                    <?php
                    $error = null;
                    if (isset($erro_nome)) {
                        $error='error';
                    }
                    ?>
                    <div class="control-group <?php echo $error; ?>">
                        <label>Nome da loja virtual</label>
                        <input class="input-name" id="id_nome" maxlength="128" name="nome" type="text" value="<?php echo \Lib\Tools::getValue('nome'); ?>" />

                        <?php
                        if (isset($erro_nome)) {
                            echo '<ul class="errorlist"><li>'. $erro_nome .'</li></ul>' . PHP_EOL;
                        }
                        ?>

                    </div>

                    <?php

                    if (!empty(\Lib\Tools::getValue('dominio'))) {
                        $nome_loja = \Lib\Tools::getValue('dominio');
                    } else {
                        $nome_loja = 'loja-' . mb_strtolower(\Lib\Tools::tokenGen());
                    }

                    $error = null;
                    if (isset($erro_dominio)) {
                        $error='error';
                    }
                    ?>
                    <div class="control-group <?php echo $error; ?>">
                        <label>Endereço provisório da loja virtual
                            <span class="personalize-dominio">
                                <br />
                                Personalize o endereço abaixo do jeito que quiser.
                            </span>
                        </label>
                        <input autocomplete="off" class="input-url span3 pull-left" id="id_apelido" maxlength="32" name="dominio" type="text" value="<?php echo $nome_loja; ?>" />
                        <span class="url-complete">.vialoja.com.br <span id="apelido-result"></span></span>

                    </div>

                    <?php
                    if (isset($erro_dominio)) {
                    ?>
                    <div id="esconder_div" class="error-dominio">
                        <ul class="errorlist"><li><?php echo $erro_dominio; ?></li></ul>
                        <img src="/admin/img/left-arrow.jpg" alt="" />
                    </div>
                    <?php
                    }
                    ?>

                    <div class="clear"></div>
                    <div class="store-url">

                        <i class="icon-wizard icon-small icon-url"></i>
                        <div>
                            <strong>http://<span class='dominio-loja'><?php echo \Lib\Tools::getValue('dominio'); ?></span>.vialoja.com.br</strong>
                            O domínio próprio da sua loja poderá ser configurado posteriormente.
                        </div>
                    </div>
                </div>
                <i class="icon-wizard icon-blueornament"></i>
                <i class="icon-wizard icon-alert">!</i>
                <div class="clear"></div>
            </div>
            <!-- .main-box -->
            <!--<div class="secondary-box clear">-->
            <div class="secondary-box clear">
                <strong class="subject-title">Qual será a finalidade da sua loja?</strong>

                <?php

                foreach ($modo as $key => $modo_valor):
                    $checked = "";
                    if ($key <= 0) {
                        $checked = 'checked="checked"';
                    }

                    if(!empty(\Lib\Tools::getValue('modo'))){

                        if (!(strcmp( \Lib\Tools::getValue('modo'), $modo_valor['ShopModo']['valor']))) {
                            $checked = 'checked="checked"';
                        }

                    }

                ?>
                <label class="radio">
                    <input <?php echo $checked; ?> type="radio" class="modo" name="modo" value="<?php echo $modo_valor['ShopModo']['valor']; ?>"> <?php echo $modo_valor['ShopModo']['titulo']; ?>
                </label>

                <?php
                endforeach;
                ?>

                <div class="clear"></div>
                <hr />
                <strong class="subject-title">Usar dados de exemplo na loja?</strong>
                <label for="copiar_dados">

                <?php
                $checked = "";
                if (!empty(\Lib\Tools::getValue('mostrar_endereco'))) {
                    $checked = "checked='checked'";
                }
                ?>
                <input id="id_copiar_dados" name="copiar_dados" type="checkbox" <?php echo $checked; ?> />
                Serão criados banners, produtos e categorias de exemplo na sua loja.
                </label>
            </div>

            <?php
            $error = null;
            if (isset($erro_atividades)) {
                $error='error';
            }
            ?>

            <div class="secondary-box clear">
                <div class="control-group last atividades <?php echo $error; ?>">
                    <strong class="subject-title">
                    Qual(is) a(s) atividade(s) da sua empresa?
                    <small style="font-weight: normal; font-size: 11px;" class="muted">Selecione no máximo 3 atividades.</small>
                    </strong>

                    <?php

                    $atividade_post = \Lib\Tools::getValue('atividades');

                    foreach ($atividades as $key => $atividade){

                        if( $key % 11 == 0 ){
                            if ($key !== 0) {
                                echo '</ul>';
                            }
                            echo  '<ul>';
                        }


                        if (isset($atividade_post) && is_array($atividade_post) && in_array($atividade['ConfiguracaoAtividade']['id_atividade'], $atividade_post)) {
                            // Set the $checked string
                            $checked = "checked='checked'";
                        } else {
                            $checked = " ";
                        }

                        echo sprintf('<li><label for="id_atividades_%d"><input id="id_atividades_%d" name="atividades[]" type="checkbox" %s value="%d" /> %s</label></li>', $key, $key, $checked, $atividade['ConfiguracaoAtividade']['id_atividade'], $atividade['ConfiguracaoAtividade']['nome'] ) . PHP_EOL;


                    }
                    echo  '</ul>';
                    ?>

                    <div class="clear"></div>
                    <div id="maximo-selecionado" class="hide alert alert-success" style="margin-bottom: 0; margin-top: 20px;">
                        Você já selecionou a quantidade máxima de atividades permitidas.
                    </div>
                    <?php
                    if (isset($erro_atividades)) {
                        echo '<div class="errorlist">Este campo é obrigatório.</div>' . PHP_EOL;
                    }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="secondary-box clear">
                <i class="icon-wizard icon-form"></i>
                <div class="control-group ">
                    <strong class="subject-title">
                    Telefone para atendimento aos seus clientes
                    </strong>
                    <input class="span4" id="id_telefone" maxlength="20" name="telefone" placeholder="(xx) xxxx-xxxx" value="<?php echo \Lib\Tools::getValue('telefone');?>" type="text" />
                    <span class="tip">opcional</span>
                </div>
                <?php
                $error = null;
                if (isset($erro_email)) {
                    $error='error';
                }
                ?>
                <div class="control-group <?php echo $error; ?>">
                    <strong class="subject-title">
                    Email para atendimento aos seus clientes
                    </strong>

                    <input class="span5" id="id_email" name="email" type="text" value="<?php echo $this->Session->read('cliente_email'); ?>" />
                    <span class="tip">opcional</span>
                    <?php
                    if (isset($erro_email)) {
                        echo '<br /><span class="errorlist">Este endereço de email é inválido.</span>'. PHP_EOL;
                    }
                    ?>

                </div>
                <div class="control-group last">
                    <span class="subject-title">
                    Localização física da loja virtual
                    </span>
                    <label class="form-inline" style="margin-bottom: 20px;">

                    <?php
                    $checked = "";
                    if (!empty(\Lib\Tools::getValue('mostrar_endereco'))) {
                        $checked = "checked='checked'";
                    }
                    ?>

                    <input id="id_mostrar_endereco" name="mostrar_endereco" type="checkbox" <?php echo $checked;?> />
                    Desejo mostrar na minha loja virtual o endereço da empresa.
                    </label>
                    <div class="endereco">
                        <div class="bot-space ">
                            <label for="cep" class="form-inline">
                            CEP: &nbsp;
                            <input class="span2" id="id_cep" maxlength="9" name="cep" placeholder="xxxxx-xxx" value="<?php echo \Lib\Tools::getValue('cep');?>" type="text" />
                            </label>
                        </div>
                        <div class="side-group bot-space hide-before-cep">
                            <div>
                                <label for="endereco">Endereço da loja</label>
                                <input class="span5 address" id="id_endereco" maxlength="100" name="endereco" value="<?php echo \Lib\Tools::getValue('endereco');?>" type="text" />
                            </div>
                            <div  >
                                <label for="numero">Número</label>
                                <input class="span2" id="id_numero" name="numero" value="<?php echo \Lib\Tools::getValue('numero');?>" type="text" />
                            </div>
                            <div>
                                <label for="complemento">Complemento</label>
                                <input class="span4" id="id_complemento" maxlength="128" name="complemento" value="<?php echo \Lib\Tools::getValue('complemento');?>" type="text" />
                            </div>
                        </div>
                        <div class="side-group hide-before-cep">
                            <div>
                                <label for="bairro">Bairro</label>
                                <input class="span4 district" id="id_bairro" maxlength="50" name="bairro" value="<?php echo \Lib\Tools::getValue('bairro');?>" type="text" />
                            </div>

                            <div>
                                <label for="estado">Estado</label>
                                <select class="input-medium span3 state" id="id_estado" name="estado">

                                    <?php

                                    foreach ($estados as $key => $estado) {

                                        if (!(strcmp( \Lib\Tools::getValue('estado'), $estado['Estados']['codigo_ibge']))) {
                                            // Set the $checked string
                                            $selected = "selected='selected'";
                                        } else {
                                            $selected = "";
                                        }


                                        echo '<option value="'. $estado['Estados']['codigo_ibge'] .'" '. $selected .'>'. $estado['Estados']['nome'] . '</option>' . PHP_EOL;
                                    }
                                    ?>
                                </select>
                            </div>

                            <div>
                                <label for="cidade">Cidade</label>

                                <select class="span3 city" style="margin-left:10px;" id="id_cidade_ibge" name="cidade">
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .secondary-box -->
            <div class="action">
                <input type="submit" id="processando" class="button-styled button-confirm btn-loading" value="Salvar e prosseguir" />
            </div>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </form>
    </div>
    <!-- .body.container -->
</div>