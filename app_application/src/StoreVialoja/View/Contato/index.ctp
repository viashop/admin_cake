<section id="columns" class="offcanvas-siderbars">
    <div class="container">
        <div class="breadcrumbs">
            <ul>
                <li class="home">
                    <a href="/" title="Go to Home Page">Home</a>
                    <span>/ </span>
                </li>
                <li class="cms_page">
                    <strong></strong>
                </li>
            </ul>
        </div>
        <div class="row">
            <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="content">
                    <div class="account-login">
                        <div class="page-title">
                            <h1>Fale Conosco</h1>                            

                        </div>
                        <form action="<?php echo \Lib\Tools::getUrl(); ?>" method="post" id="login-form" enctype="multipart/form-data">

                            <div class="row">

                                <div class="col-lg-12 col-sm-12 col-xs-12" style="margin:10px 0;">

                                    <?php if (isset($CSRFGuardName) && isset($CSRFGuardToken)){ ?>
									
									<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
									<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

                                    <input type="text" class="hidden" name="ckeck" value="">
                                    <input type="text" class="hidden" name="name" value="">
                                    <input type="text" class="hidden" name="url_default" value="">

                                        <?php if (!empty($email)): ?>

                                            <span>Preencha o formulário abaixo, ou entre em contato através do e-mail <a href="mailto:<?php echo $email; ?>" style="font-weight:normal; color: red"><?php echo $email; ?></a></span>
                                            
                                        <?php else: ?>

                                            <span>Preencha o formulário abaixo:</span>
                                            
                                        <?php endif ?>

                                      
                                    <?php } else { ?>

                                    <span>Preencha o formulário abaixo:</span>
                                   
                                    <?php } ?>

                                </div>
                                
                                <div class="col-lg-6 col-sm-6 col-xs-12 registered-users">
                                    <div class="content">
                                        <ul class="form-list">
                                            <li>
                                                <label for="nome" class="required"><em>*</em>Nome</label>
                                                <div class="input-box">
                                                    <input type="text" name="nome" value="<?php echo \Lib\Tools::getValue('nome') ?>" id="id_nome" class="input-text required-entry validate-nome form-control" title="Seu nome" />
                                                </div>
                                            </li>
                                            <li>
                                                <label for="email" class="required"><em>*</em>E-mail</label>
                                                <div class="input-box">
                                                    <input type="email" value="<?php echo \Lib\Tools::getValue('email') ?>" name="email" class="input-text required-entry validate-email form-control" id="id_email" title="E-mail" />
                                                </div>
                                            </li>
                                            <li>
                                                <label for="pass" class="required"><em>*</em>Telefone</label>
                                                <div class="input-box">
                                                    <input type="text" name="telefone" value="<?php echo \Lib\Tools::getValue('telefone') ?>" class="input-text required-entry validate-telefone form-control" id="id_telefone" title="Seu Telefone" />
                                                </div>
                                            </li>
                                            <li>
                                                <label for="pedido" class="required"><em>*</em>Nº do Pedido</label>
                                                <div class="input-box">
                                                    <input type="text" name="pedido" value="<?php echo \Lib\Tools::getValue('pedido') ?>" class="input-text required-entry validate-pedido form-control" id="id_pedido" title="Pedido" />
                                                </div>
                                            </li>											
											
                                            <li>
                                                <label for="mensagem" class="required"><em>*</em>Mensagem</label>
                                                <div class="input-box">
                                                    <textarea cols="40" name="mensagem" rows="6" class="input-text required-entry validate-pedido form-control" id="id_pedido" ><?php echo \Lib\Tools::getValue('mensagem') ?></textarea>
                                             
                                                </div>
                                            </li>
											
											<li><label for="anexo" class="required">Anexo:</label>
                                                <div class="input-box">
													<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
													<input type="file" name="fileUpload" id="fileUpload" class="form-control" /> 
                                                    <span style="font-size:11px;">(Extensões de arquivos permitidos: .jpg, .gif, .jpeg, .png)</span> <br />
                                                </div>
                                            </li>
											
                                        </ul>
                                        <div id="window-overlay" class="window-overlay" style="display:none;"></div>
                                        <div id="remember-me-popup" class="remember-me-popup" style="display:none;">
                                            <div class="remember-me-popup-head">
                                                <h3>O que é isso?</h3>
                                                <a href="#" class="remember-me-popup-close" title="Fechar">Fechar</a>
                                            </div>
                                            <div class="remember-me-popup-body">
                                                <p>
                                                    Verificando Lembrar-me vai deixar você acessar seu carrinho de compras no computador quando você está desconectado

                                                </p>
                                                <div class="remember-me-popup-close-button a-right">
                                                    <a href="#" class="remember-me-popup-close button" title="Close"><span>Close</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            //<![CDATA[
                                                function toggleRememberMepopup(event){
                                                    if($('remember-me-popup')){
                                                        var viewportHeight = document.viewport.getHeight(),
                                                            docHeight      = $$('body')[0].getHeight(),
                                                            height         = docHeight > viewportHeight ? docHeight : viewportHeight;
                                                        $('remember-me-popup').toggle();
                                                        $('window-overlay').setStyle({ height: height + 'px' }).toggle();
                                                    }
                                                    Event.stop(event);
                                                }
                                            
                                                document.observe("dom:loaded", function() {
                                                    new Insertion.Bottom($$('body')[0], $('window-overlay'));
                                                    new Insertion.Bottom($$('body')[0], $('remember-me-popup'));
                                            
                                                    $$('.remember-me-popup-close').each(function(element){
                                                        Event.observe(element, 'click', toggleRememberMepopup);
                                                    })
                                                    $$('#remember-me-box a').each(function(element) {
                                                        Event.observe(element, 'click', toggleRememberMepopup);
                                                    });
                                                });
                                            //]]>
                                        </script>
                                        <p class="required">* Campos obrigatórios</p>
                                        <br>
                                        <div class="buttons-set">
                                            <button type="submit" class="button f-left" title="Login" name="send" id="send2"><span><span>Enviar</span></span></button>
                                        </div>

                                    </div>
                                </div>

                                <script type="text/javascript" src="/superstore/js/google_maps_simple.js"></script>

                                <div class="col-lg-6 col-sm-6 col-xs-12 new-users">
                                    <div class="content" style="margin-top:24px;">
                                    
                                        <table class="table table-bordered">      
                                          <tbody>

                                            <?php if (isset($loja_tipo)){ ?>

                                                <?php if ($loja_tipo == 'PF'): ?>

                                                    <?php if (!empty($loja_nome_responsavel)) { ?>

                                                        <tr>
                                                          <th scope="row">Responsável:</th>
                                                          <td><?php echo $loja_nome_responsavel ?></td>
                                                        </tr>
                                                        
                                                    <?php } ?>

                                                    <?php if (!empty($loja_cpf)) { ?>

                                                        <tr>
                                                          <th scope="row">CPF: </th>
                                                          <td><?php echo $loja_cpf; ?></td>
                                                        </tr>
                                                        
                                                    <?php } ?>
                                                    
                                                <?php else: ?>

                                                    <?php if (!empty($loja_razao_social)) { ?>

                                                        <tr>
                                                          <th scope="row">Razão Social:</th>
                                                          <td><?php echo $loja_razao_social; ?></td>
                                                        </tr>
                                                        
                                                    <?php } ?>

                                                    <?php if (!empty($loja_cnpj)) { ?>

                                                        <tr>
                                                          <th scope="row">CNPJ: </th>
                                                          <td><?php echo $loja_cnpj; ?></td>
                                                        </tr>
                                                        
                                                    <?php } ?>
                                                    
                                                <?php endif ?>
                                                
                                            <?php } ?>

                                            <?php if (!empty($telefone)): ?>

                                                <tr>
                                                  <th scope="row">Telefone:</th>
                                                  <td><?php echo $telefone; ?></td>
                                                </tr>
                                                
                                            <?php endif ?>

                                            <tr>
                                              <th scope="row">Endereço:</th>
                                              <td><?php

                                                if (isset($mostrar_endereco) && $mostrar_endereco == 'True') {

                                                    $endereco_loja = null;
                                                    if (!empty($endereco)) {
                                                        $endereco_loja .= $endereco . ', ';
                                                    }

                                                    if (!empty($numero)) {
                                                        $endereco_loja .= $numero . ', ';
                                                    }

                                                    if (!empty($bairro)) {
                                                        $endereco_loja .= $bairro . ', ';
                                                    }

                                                    if (!empty($nome_cidade)) {
                                                        $endereco_loja .= $nome_cidade . ', ';
                                                    }

                                                    if (!empty($cidade_nome)) {
                                                        $endereco_loja .= $cidade_nome . ', ';
                                                    }

                                                    if (!empty($estado_sigla)) {
                                                        $endereco_loja .= $estado_sigla; 
                                                    }

                                                    if (!empty( $cep )) {
                                                        $endereco_loja .=  ' - '. $cep ; 
                                                    }

                                                    echo $endereco_loja;
                                                    
                                                }

                                               ?></td>
                                            </tr>

                                            <tr>
                                              
                                              <td colspan="2" height="212">

                                                <?php if (isset($endereco_loja)): ?>

                                                <div class="mapa" style="height:auto; background:#f9f9f9;"><!--MAPA - BEGIN -->
                                          
                                                    <div id="map_canvas" style="height: 202px;">
                                                     </div>
                        
                                                    <!-- Maps API Javascript -->

                                                    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;region=BR"></script>

                                                    <?php
                                                    
                                                    echo '<script type="text/javascript">' . PHP_EOL;
                                                    echo sprintf( "var query= '%s';", $endereco_loja ) . PHP_EOL;
                                                    echo '</script>';
                                                     
                                                    ?>
                                             
                                                    <!-- Arquivo de inicialização do mapa -->
                                                    <script src="/superstore/js/google_maps_simple.js"></script>

                                                </div><!--MAPA - END -->

                                                <?php endif ?>

                                              </td>
                                            </tr>

                                          </tbody>
                                        </table>                                        
                                        
                                    </div>
                                </div>

                            </div>
                        </form>
                        <script type="text/javascript">
                            //<![CDATA[
                                var dataForm = new VarienForm('login-form', true);
                            //]]>
                        </script>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>