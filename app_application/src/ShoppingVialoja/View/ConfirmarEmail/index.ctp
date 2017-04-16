<?php if ($user_email): ?>

<script type="text/javascript">
    $(document).ready(function(){
        $("#reenviar_email").click(function(evento) {

            $('#resp').slideToggle(2000);       

            $.post('/reenviar_email_confirmacao',{ token: '<?php echo $this->Session->read('tokenEmail'); ?>', email: '<?php echo $user_email; ?>'},function(data){
                if (data == '<?php echo $user_email; ?>') {

                    //$('#resp').slideToggle("fast");
                };

            });

        });

    });
</script>

<?php endif ?>

<div id="content">
    <div id="queue-page-holder">
        <div id="section-top" class="section-verify">
            <div class="center">
                <img src="/interfaces/vialoja/static/img/new_email.png" />
            </div>
            <h1>Acabamos de enviar um <strong>e-mail de verificação</strong> para <?php if ($user_email) {
                echo $user_email;
            } else {
                echo 'none';

            } ?></h1>
            <h4 class="grey7">E-mail errado? <a href="<?php echo FULL_BASE_URL; ?>/d/loja-virtual-gratis/" id="not-you-button" class="grey6 underline"> Clique aqui para começar de novo</a>.</h4>
            <hr />
            <h1 class="sub-header pink">Por favor, abra agora a Caixa de Entrada do email, acesse a mensagem enviada pelo ViaLoja e <strong>Clique no Link de Confirmação</strong>.</h1>
            <br />
            <div align="center">

                <div id="resp" class="alert alert-success center" style="max-width:600px; display: none;">
                   E-mail foi enviado de novo, por favor, verifique sua caixa de entrada.
                </div>
            </div>
     
            <h4 class="grey7">
                <p>

                    Se ainda não recebeu a mensagem, não esqueça de verificar as suas pastas de spam ou lixo eletrônico, e caso use Gmail, nas abas Promoções e Sociais.<br />
                    O e-mail foi enviado por "contato@<?php echo ltrim( env('HTTP_BASE'), '.' ); ?>",
                    ou <a href="#enviar" id="reenviar_email">clique aqui</a> para reenviar o email de confirmação.
                </p>
                <br />
                <h5 class="grey7">
                    <p>
                        
                        <strong>Porquê uma mensagem de correio eletrônico de confirmação?</strong>
                        <br>
                        Protege a sua identidade.
                        <br>
                        Permite acesso a aplicações e locais na Web da ViaLoja Shopping que requerem confirmação.
                        <br>
                        Receberá notificações de pedidos, pagamentos e contatos.
                    </p>
                </5>

            </h4>

        </div>
    </div>
</div>