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
                        <a href="/cliente/login" title="Autenticação" rel="nofollow">Autenticação</a><span class="navigation-pipe">/</span>Esqueceu sua senha
                    </div>
                    <!-- /Breadcrumb -->			
                </div>
                <div class="box">
                    <h1 class="page-subheading">Esqueceu sua senha?</h1>

                    <?php echo $this->Session->flash(); ?>
                    
                    <p>Por favor informe o e-mail usado no cadastro. Nós enviaremos uma nova senha para este endereço.</p>
                    <form action="/cliente/esqueceu-a-senha" method="post" class="std" id="form_forgotpassword">
                        <fieldset>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input class="form-control" type="email" id="email" name="email" value="<?php echo \Lib\Tools::getValue('email'); ?>" required placeholder="Insira o seu e-mail"  />
                            </div>
                            <p class="submit">
                                <button type="submit" class="btn btn-outline button button-medium btn-sm"><span>Recuperar senha</span></button>
                            </p>
                        </fieldset>

                        <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

                    </form>
                </div>
                <ul class="clearfix footer_links">
                    <li class="pull-left"><a class="btn btn-outline button button-small btn-sm" href="/cliente/login" title="Voltar para o Login" rel="nofollow"><span>Voltar para o Login</span></a></li>
                </ul>
            </section>
        </div>
    </div>
</section>
