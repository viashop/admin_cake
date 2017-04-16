<!-- Content -->
<section id="columns" class="columns-container">
    <div class="container">
        <div class="row">
            <div id="top_column" class="center_column col-xs-12 col-sm-12 col-md-12">
            </div>
        </div>
        <div class="row">
            <!-- Center -->
            <section id="center_column" class="col-md-12">
                <div id="breadcrumb" class="clearfix">
                    <!-- Breadcrumb -->
                    <div class="breadcrumb clearfix">
                        <a class="home" href="/" title="Voltar para a Página Inicial"><i class="fa fa-home"></i></a>
                        <span class="navigation-pipe" >/</span>
                        <span class="navigation_page">Contato</span>
                    </div>
                    <!-- /Breadcrumb -->			
                </div>
                <h1 class="page-heading bottom-indent">
                    Atendimento ao Cliente - Fale conosco
                </h1>
                <?php echo $this->Session->flash(); ?>
                <form action="<?php echo \Lib\Tools::getUrl(); ?>" method="post" class="contact-form-box" enctype="multipart/form-data">
                    <fieldset>
                        <h3 class="page-subheading">Enviar uma mensagem</h3>
                        <div class="clearfix">
                            <div class="col-xs-12 col-md-4">

                                <?php                                       
                                if (!Validate::isBot()) {
                                        
                                    echo '<input type="text" class="hidden" name="url_default" value="">'. PHP_EOL;
                                    echo '<input type="text" class="hidden" name="ckeck" value="">'. PHP_EOL;
                                    echo '<input style="position: absolute; width: 1px; top: -5000px; left: -5000px;" name="name" type="text">'. PHP_EOL;

                                    echo "<input type='hidden' name='CSRFGuardName' value='{$CSRFGuardName}' />";                                    
                                    echo "<input type='hidden' name='CSRFGuardToken' value='{$CSRFGuardToken}' />";
                                
                                }
                                ?>
                                
                                <p class="form-group">
                                    <label for="nome">Nome:</label>
                                    <input class="form-control grey validate" type="text" id="nome" name="nome" required placeholder="Coloque seu nome aqui!" value="" />
                                </p>
                                
                                <p id="desc_contact0" class="desc_contact">&nbsp;</p>
                                <p class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input class="form-control grey validate" type="text" id="email" name="email" required placeholder="Coloque seu email aqui!" data-validate="isEmail" value="" />
                                </p>

                                <p id="desc_contact0" class="desc_contact">&nbsp;</p>
                                <div class="form-group selector1">
                                    <label for="id_contact">Assunto:</label>
                                    <select class="form-control" id="id_contact" required name="assunto">
                                        <option value="">-- Escolha --</option>
                                        <option value="Departamento Comercial">Departamento Comercial</option>
                                        <option value="Departamento Financeiro">Departamento Financeiro</option>
                                    </select>
                                </div>
                                <div class="form-group selector1">
                                    <label>Referência do pedido:</label>
                                    <input class="form-control grey" type="text" name="referencia" id="referencia" value="" />
                                </div>
                                <p class="form-group">
                                    <label for="fileUpload">Anexo:</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                                    <input type="file" name="fileUpload" id="fileUpload" class="form-control" />                                    
                                    (Extensões de arquivos permitidos: .jpg, .gif, .jpeg, .png)
                                </p>
                            </div>
                            <div class="col-xs-12 col-md-8">
                                <div class="form-group">
                                    <label for="message">Mensagem:</label>
                                    <textarea class="form-control" id="message" rows="6" required placeholder="Digite sua mensagem aqui!" name="mensagem"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="submit">

                            <button type="submit" name="submitMessage" id="submitMessage" class="button btn btn-outline button-medium"><span>Enviar</span></button>
                        </div>
                    </fieldset>
                </form>
            </section>
        </div>
    </div>
</section>
<!-- Footer -->