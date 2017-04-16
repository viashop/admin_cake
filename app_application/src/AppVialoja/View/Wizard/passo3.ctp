<script type="text/javascript">
    $(document).ready(function() {

        $('input.envio').change(function(event) {
            var mostrar_ajuda = false;
            $.each($('input.envio:checked'), function(k, v){
                var item = $(v);
                if (item.data('configuracao')) {
                    mostrar_ajuda = true;
                    return true;
                }
            });
            if (mostrar_ajuda) {
                $('.texto-informacao').slideDown();
            } else {
                $('.texto-informacao').slideUp();
            }
        });
    })
</script>

<div id="wizard envio globalContainer">
    <!-- .navbar -->
    <div class="body container">
        <?php
        echo $this->element('wizard/progressBar');
        ?>
        <form method="post" actio="<?php echo Router::url(); ?>" >
            <div class="step-title">
                <i class="icon-wizard icon-step">03</i>
                <h1>Escolha as formas de envio da sua loja<small class="icon-wizard icon-place icon-title"></small></h1>
            </div>
            <?php
            $error = null;
            if (isset($erro_cep)) {
                $error='error';
            }
            ?>
            <div class="secondary-box clear">
                <div class="control-group <?php echo $error; ?>">
                    <strong class="subject-title">
                    Digite o CEP de origem das encomendas: &nbsp;
                    <input class="span2 mostrar_cidade_estado" id="id_cep" name="cep" value="<?php echo \Lib\Tools::getValue('cep'); ?>" type="text" />
                    <span class="cidade_estado hide"></span>
                    </strong>
                    <?php
                        if (isset($erro_cep)) {
                            echo '<ul class="errorlist"><li>'. $erro_cep .'</li></ul>' . PHP_EOL;
                        }
                    ?>    
                </div>
                <div class="list-choice">
                    <div class="list-options">
                        <h2 class="subject-title">Marque as formas de envio que deseja oferecer aos seus clientes</h2>

                        <?php

                        if ($this->request->is('post')) {
                            $post = true;
                        }

                  
                        foreach ($envio_forma as $key => $linha):

                            $id = $linha['ConfiguracaoEnvio']['id'];
                            $title = $linha['ConfiguracaoEnvio']['title'];
                            $img = $linha['ConfiguracaoEnvio']['logo'];
                            $id_js = $linha['ConfiguracaoEnvio']['id_js'];
                            $configuracao = $linha['ConfiguracaoEnvio']['configuracao'];

                            if (!isset($post)) {
                                $checked = $linha['ConfiguracaoEnvio']['checked'];
                            }

                            if (is_array(\Lib\Tools::getValue('id_envio')) && in_array($id, \Lib\Tools::getValue('id_envio'))) {
                                // Set the $checked string
                                $checked = "checked='checked'";
                            } else {
                                if (isset($post)) {
                                    $checked = " ";
                                }
                               
                            }

                        ?>
                        <!-- gateway -->
                        <div class="list-item envio with_checkbox">
                            <label for="<?php echo $id_js; ?>">
                                <ul>
                                    <li class="radio-slot">
                                        <input class="envio" type="checkbox" name="id_envio[]" value="<?php echo $id; ?>" id="<?php echo $id_js; ?>" data-configuracao="<?php echo $configuracao; ?>" <?php echo $checked; ?> />
                                    </li>
                                    <li class="logo-slot">
                                        <span class="list-item-logo <?php echo $id_js; ?>">
                                        <img src="/admin/img/formas-de-envio/<?php echo $img; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" />
                                        </span>
                                    </li>
                                </ul>
                            </label>
                        </div>

                        <?php
                        endforeach;
                        ?>
                        <!-- gateway -->
                    </div>
                    <div class="alert alert-info hide texto-informacao" style="margin: 20px 0 0 0;">
                        <h4>Configurações extras para a forma de envio</h4>
                        <p style="margin-bottom: 5px;">
                            Você escolheu uma ou mais formas de envio que precisam
                            de configuração extra para funcionar. Mas não se preocupe
                            que isto será feito assim que as configurações iniciais
                            forem finalizadas. Agora você já pode prosseguir.
                        </p>
                    </div>
                </div>
            </div>
            <!-- .main-box -->
            <div class="action">
                <input type="submit" id="processando" class="button-styled button-confirm btn-loading" value="Salvar e prosseguir" />
                <a href="<?php echo VIALOJA_PAINEL ?>/wizard/passo-2/configure-sua-loja" class="button-styled button-back" >Voltar</a>
            </div>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </form>
    </div>
    <!-- .body.container -->
</div>
