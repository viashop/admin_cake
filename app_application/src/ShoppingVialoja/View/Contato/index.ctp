<div id="content">
    <div class="section">
        <div class="container">
            <h1 class="page-title">Fale Conosco</h1>
            <br /><br />
            <div>
                <p class="center">Se você deseja chegar até nós, você pode nos enviar um e-mail, preenchendo o formulário abaixo.</p>
                <form id="cform" name="cform" method="post" action="<?php echo \Lib\Tools::getUrl(); ?>">

                    <?php                                       
                    if (!Validate::isBot()) {
                            
                        echo '<input type="text" class="hidden" name="url_default" value="">'. PHP_EOL;
                        echo '<input type="text" class="hidden" name="ckeck" value="">'. PHP_EOL;
                        echo '<input style="position: absolute; width: 1px; top: -5000px; left: -5000px;" name="name" type="text">'. PHP_EOL;

                        echo "<input type='hidden' name='CSRFGuardName' value='{$CSRFGuardName}' />";
                        echo "<input type='hidden' name='CSRFGuardToken' value='{$CSRFGuardToken}' />";
                    
                    }
                    ?>

                    <div id="contact-message"></div>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome" class="borderbox" />
                    <input type="email" id="email" name="email" placeholder="Seu endereço de email" class="borderbox" />
                    <textarea id="message" name="message" placeholder="Mensagem" class="borderbox"></textarea>
                    <div class="floatl"><button id="submit" class="btn btn-primary" type="submit">Enviar</button></div>
                    <div class="clear"></div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    /**
     * Validate contact form
     */
    $('#cform').submit(function() {
        "use strict";
    
        var fields = [$('#nome'), $('#email'), $('#message')],
            msg = $('#contact-message'),
            url = $(this).attr('action'),
            valid = true;
    
        // reset messages
        msg.hide();
    
        $.each(fields, function(i) {
            if (fields[i].val().length === 0 ){
                valid = false;
                msg.text('Todos os campos são obrigatórios, por favor, corrija os campos vazios.');
            }
            if (fields[i].attr('id') === 'email' && !validateEmail(this.val())) {
                valid = false;
                msg.text('Por favor, forneça um endereço de email válido.');
            }
        });
    
        if (valid) {
            $('#submit').attr('disabled', 'disabled');
            $('#submit').text('Enviando...');
    
            $.post(url, $(this).serializeArray(), function () {
                $('#fields-holder').hide();
                $('#submit').hide();
                msg.attr('class', 'success-message');
                msg.text('Obrigado por entrar em contato conosco - nós entraremos em contato com você o mais breve possível.');
    
                $.each(fields, function(i) {
                    fields[i].attr('disabled', 'disabled').addClass('disabled');
                });
            });
        } else {
            $('#submit').text('Submit');
            msg.attr('class', 'error-message');
    
            // Auto hide message after 3.5 secs if it's an error
            setTimeout(function(){
                msg.slideUp('fast');
            }, 3500);
        }
    
        msg.slideDown('fast');
    
        return false;
    });
</script>
