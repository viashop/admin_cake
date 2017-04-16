<div id="wizard resumo globalContainer">

    <div class="body container">
        <?php
        echo $this->element('wizard/progressBar');
        ?>
        <div class="step-title">
            <i class="icon-wizard icon-step">05</i>
            <h1>Resumo do seu cadastro<small class="icon-wizard icon-aform icon-title"></small></h1>
        </div>

        <div class="secondary-box resumo">
            <i class="icon-wizard icon-form"></i>
            <div class="logo wizard" style="background:#FFF;">

                <?php
                if (empty($logo)) {
                    echo '<img src="/admin/img/sem-logo.jpg" />';
                } else {
                    $diretorio = CDN_UPLOAD . $this->Session->read('id_shop') .'/logo/';
                    echo sprintf('<img src="%s%s" />', $diretorio, $logo);
                }
                ?>
                
            </div>
            <div class="done">
                <h1><i class="icon-wizard icon-done"></i> <?php echo $nome_loja; ?></h1>
                <h3 style="margin: 0 0 15px 0">O que você quer fazer agora?</h3>
                <a target='_self' href="/admin/" class="button-styled button-select"><i class="icon-engine icon-custom icon-white"></i>Painel de Controle</a>&nbsp; &nbsp;
                <a target='_blank' href="http://<?php if(isset($dominio)){ echo $dominio;} ?>" class="button-styled button-select"><i class="icon-globe icon-white"></i>Ir para a loja</a>
            </div>
            <hr class="clear dashed" />
            <div class="tema">
                <h3>Tema selecionado</h3>
                <div class="tema-image">
                    <img src="/admin/img/tema/novo-template.jpg" />
                </div>
            </div>
            <div class="info-geral">
                <div class="dados">
                    <h3>Dados da loja</h3>
                    <ul>
                        <li><strong>Nome da loja:</strong> <span><?php echo $nome_loja; ?></span></li>
                        <li><strong>URL da loja:</strong> <span>http://<?php if(isset($dominio)){ echo $dominio;} ?></span></li>
                        <li><strong>Email:</strong> <span><?php echo $email; ?></span></li>
                    </ul>
                </div>
                <div class="formas">
                    <div class="formas-envio">
                        <h3>Formas de envio</h3>
                        <p>

                            <?php

                            if (count($formas_envio)>0) {
                                
                                foreach ($formas_envio as $key => $forma) {
                                    echo sprintf(' <img src="/admin/img/formas-de-envio/%s" width="80px" />&nbsp;&nbsp;&nbsp;', $forma['ConfiguracaoEnvio']['logo']);
                                }

                            } else {

                                echo '__';
                            }
                            ?>
                       
                        </p>
                    </div>
                    <div class="formas-pagamento">
                        <h3>Forma de pagamento</h3>
                        <p>
                            <?php

                            if (count($res_pagamentos)>0) {
                                foreach ($res_pagamentos as $key => $pagamento) {
                                    echo sprintf('<img src="/admin/img/formas-de-pagamento/%s" width="80px" />&nbsp;&nbsp;&nbsp;', $pagamento['ConfiguracaoPagamento']['logo']);
                                }
                            } else {
                                echo '__';
                            }
                            ?>

                        </p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div id="processando"></div>
        </div>
        <!-- .body.container -->
    </div>

</div>
