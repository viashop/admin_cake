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
                    <h1 class="page-subheading">A recuperação da senha foi iniciada!</h1>
                   
                    <p>Verifique sua caixa de entrada do email <?php echo \Lib\Tools::getValue('email'); ?>. </p>

                    <p>
                        <strong>Para finalizar a recuperação da senha você deve seguir os passos que estão no email recebido</strong>.
                    </p>
                    <ul class="clearfix footer_links">
                        <li class="pull-left"><a class="btn btn-outline button button-small btn-sm" href="/cliente/login" title="Voltar para o Login" rel="nofollow"><span>Voltar para o Login</span></a></li>
                    </ul>
                    <br />
                    <p>
                        Se ainda não recebeu a mensagem, não esqueça de verificar na sua caixa de spam, ou <a href="/cliente/esqueceu-a-senha" style="color:#009BCB;">clique aqui</a> para reenviar o email de recuperação. <br />Se você não conseguir recuperar a sua senha, <a href="//suporte.vialoja.com.br" style="color:#009BCB;">entre em contato com o suporte técnico</a>.
                    </p>                     
                 
                </div>               
                
            </section>
        </div>
    </div>
</section>
