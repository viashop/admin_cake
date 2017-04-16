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
                    <div class="page-title">
                        <h1>Esqueceu sua senha?</h1>
                    </div>
                    <!--
                    <ul class="messages">
                        <li class="error-msg">
                            <ul>
                                <li>
                                    <span>E-mail inválido.</span>
                                </li>
                            </ul>
                        </li>
                    </ul>-->
                    <form action="/cliente/esqueceu-a-senha-post" method="post" id="form-validate">
                        <div class="fieldset">
                            <h2 class="legend">Recuperar sua Senha</h2>
                            <p>Digite seu e-mail abaixo. Você receberá um link para redefinir sua senha.</p>
                            <ul class="form-list">
                                <li>
                                    <label for="email_address" class="required"><em>*</em>Endereço de Email</label>
                                    <div class="input-box">
                                        <input type="text" name="email" alt="email" id="email_address" class="input-text required-entry validate-email" value="" />
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="buttons-set">
                            <p class="required">* Os campos obrigatórios</p>
                            <p class="back-link"><a href="/cliente/login"><small>&laquo; </small>Voltar para o Login</a></p>
                            <button type="submit" title="Enviar" class="button"><span><span>Enviar</span></span></button>
                        </div>
                    </form>
                    <script type="text/javascript">
                        //<![CDATA[
                            var dataForm = new VarienForm('form-validate', true);
                        //]]>
                    </script>
                </div>
            </section>
        </div>
    </div>
</section>