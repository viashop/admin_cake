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
                            <h1>Login ou Criar Conta</h1>
                        </div>
                        <form action="/cliente/conta/loginPost" method="post" id="login-form">
                            <input name="form_key" type="hidden" value="XLgnfXA6ePqiyOFf" />
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12 new-users">
                                    <div class="content">
                                        <h2>Cria nova conta</h2>
                                        <p>Ao criar uma conta em nossa loja, você será capaz de se mover através do processo de compra mais rapidamente, armazenar múltiplos endereços de envio, ver e rastrear seus pedidos em sua conta e muito mais.</p>
                                        <div class="buttons-set">
                                            <button type="button" title="Criar uma conta" class="button" onclick="window.location='/cliente/conta/criar';"><span><span>Criar uma conta</span></span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12 registered-users">
                                    <div class="content">
                                        <h2>Já tenho conta</h2>
                                        <p>Se você tem uma conta conosco, por favor faça login.</p>
                                        <ul class="form-list">
                                            <li>
                                                <label for="email" class="required"><em>*</em>Endereço de email</label>
                                                <div class="input-box">
                                                    <input type="text" name="login[username]" value="" id="email" class="input-text required-entry validate-email form-control" title="Endereço de email" />
                                                </div>
                                            </li>
                                            <li>
                                                <label for="pass" class="required"><em>*</em>Senha</label>
                                                <div class="input-box">
                                                    <input type="password" name="login[password]" class="input-text required-entry validate-password form-control" id="pass" title="Senha" />
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
                                            <a href="/cliente/conta/esqueceu-a-senha" class="f-right" title="Esqueceu sua senha?">Esqueceu sua senha?</a>
                                            <button type="submit" class="button f-left" title="Login" name="send" id="send2"><span><span>Login</span></span></button>
                                        </div>
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