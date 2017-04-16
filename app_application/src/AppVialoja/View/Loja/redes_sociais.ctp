
<script type="text/javascript">
    function verificar_perfil_social(obj) {
        var url_perfil = obj.val();
    
        if (url_perfil.length == 0) {
            obj.removeClass('INVALIDO');
            obj.parents('.control-group').removeClass('error');
            obj.parent().find('.error').hide();
            return true;
        }
        if ($.url('path', url_perfil) != '/') {
            obj.val(url_perfil.replace(/^\//, ""));
        }
        var servico = obj.attr('name');
        var url = '/admin/loja/redes_sociais/verificar/perfil';
        $.getJSON(url,{url_perfil: url_perfil, servico: servico}, function(data) {
           if (data.status == 'VALIDO') {
            obj.parents('.control-group').addClass('success');
            obj.parents('.control-group').find('.error').fadeOut();
            obj.parents('.control-group').find('.success').fadeIn();
            obj.parents('.control-group').removeClass('error');
            obj.addClass('VALIDO');
            obj.removeClass('INVALIDO');
           } else{
            obj.parents('.control-group').removeClass('success');
            obj.parents('.control-group').addClass('error');
            obj.parents('.control-group').find('.success').fadeOut();
            obj.parents('.control-group').find('.error').fadeIn();
            obj.removeClass('VALIDO');
            obj.addClass('INVALIDO');
           }
        });
    }
    $(document).ready(function(){
        // verificações dos perfis das redes sociais
        var timer;
        $('form').submit(function(event){
            if ($('input.INVALIDO').length > 0) {
                $('body').scrollTop(0);
    
                $('input.INVALIDO').parent().find('.error').show();
                event.preventDefault();
                return false;
            };
        });
        $(document).on('keyup', '.input_rede_social', function() {
            var that = $(this);
            // $(this).parent('.email_input_wrapper').css('width', '90%');
            // $(this).parent().find('.email_verificacao').removeClass('hide');
            clearTimeout(timer);
            timer = setTimeout(function(){verificar_perfil_social(that)}, 1000);
        });
    });
</script>


<?php
foreach ($rede_social as $key => $rede);
?>
 
<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><span>Redes Sociais</span></li>
    </ul>
</div>
<div class="box redes-sociais">
    <div class="box-header">
        <h3>
            Redes Sociais
        </h3>
    </div>
    <form action="" method="post" class="form-horizontal">
        <div class="box-content">
            <p>Preencha os campos abaixo com os dados das Redes Sociais da sua empresa para deixa-las disponíveis na loja virtual.</p>
            <hr/>
            <div class="control-group">
                <div class="control-label">
                    <img src="/admin/img/redes-sociais/facebook.jpg" alt="Logo facebook" class="logo-social" />
                </div>
                <div class="controls">
                    <label for="id_facebook">Informe abaixo a URL da sua fanpage. Não confunda a URL da sua página de usuário. Para criar uma fanpage, <a href="https://www.facebook.com/pages/create.php" title="Criar fanpage" target="_blank">clique aqui</a>.<br />Fanpage com conteúdo adulto não serão permitidas devido a política do facebook.</label>
                    
                    <div class="input-prepend">
                        <span class="add-on">https://www.facebook.com/</span>
                        <input class="span5 input_rede_social" id="id_facebook" name="facebook" placeholder="seuperfil" type="text" value="<?php 

                        if (isset($rede['ShopRedeSocial']['facebook'])) {
                           echo $rede['ShopRedeSocial']['facebook'];
                        }
                        
                        ?>" />
                    </div>

                    <!--
                    <span class="error hide">
                        <img src="/admin/img/exclamation-sign.png" alt="Erro">
                        <span class="error help-inline">
                            <div class="pull-right well span4">
                                <small>
                                Página não encontrada ou não pública, caso ela exista, verifique as configurações de privacidade.
                                </small>
                            </div>
                        </span>
                    </span>
                    <span class="success hide">
                    <img src="/admin/img/ok-sign.png" alt="Sucesso">
                    </span>

                    -->



                    <span class="error hide">
                        <img src="/admin/img/exclamation-sign.png" alt="Erro">
                        <span class="error help-inline">
                            Página ou Usuário inválido.
                        </span>
                    </span>
                    <span class="success hide">
                        <img src="/admin/img/ok-sign.png" alt="Sucesso">
                    </span>



                </div>
            </div>
            <hr/>
            <div class="control-group">
                <div class="control-label">
                    <img src="/admin/img/redes-sociais/twitter.jpg" alt="Logo twitter" class="logo-social" />
                </div>
                <div class="controls">
                    <label for="id_twitter">Informe seu usuário no Twitter</label>
                    <div class="input-prepend">
                        <span class="add-on">https://twitter.com/</span>
                        <input class="span4 input_rede_social" id="id_twitter" name="twitter" placeholder="seuperfil" type="text" value="<?php 

                        if (isset($rede['ShopRedeSocial']['twitter'])) {
                           echo str_replace("https://twitter.com/", "", $rede['ShopRedeSocial']['twitter'] );
                        }
                        
                        ?>" />
                    </div>
                    <span class="error hide">
                        <img src="/admin/img/exclamation-sign.png" alt="Erro">
                        <span class="error help-inline">
                            Página ou Usuário inválido.
                        </span>
                    </span>
                    <span class="success hide">
                        <img src="/admin/img/ok-sign.png" alt="Sucesso">
                    </span>
                </div>
            </div>
            <hr/>
            <div class="control-group">
                <div class="control-label">
                    <img src="/admin/img/redes-sociais/pinterest.jpg" alt="Logo pinterest" class="logo-social" />
                </div>
                <div class="controls">
                    <label for="id_pinterest">Informe sua conta no Pinterest</label>
                    <div class="input-prepend">
                        <span class="add-on">https://www.pinterest.com/</span>
                        <input class="span4 input_rede_social" id="id_pinterest" name="pinterest" placeholder="seuperfil" type="text" value="<?php 

                        if (isset($rede['ShopRedeSocial']['pinterest'])) {
                           echo str_replace("https://www.pinterest.com/", "", $rede['ShopRedeSocial']['pinterest'] );
                        }
                        
                        ?>" />
                    </div>
                    <span class="error hide">
                        <img src="/admin/img/exclamation-sign.png" alt="Erro">
                        <span class="error help-inline">
                            Página ou Usuário inválido.
                        </span>
                    </span>
                    <span class="success hide">
                        <img src="/admin/img/ok-sign.png" alt="Sucesso">
                    </span>
                </div>
            </div>
            <hr/>
            <div class="control-group">
                <div class="control-label">
                    <img src="/admin/img/redes-sociais/instagram.jpg" alt="Logo instagram" class="logo-social" />
                </div>
                <div class="controls">
                    <label for="id_instagram">Informe sua conta no Instagram</label>
                    <div class="input-prepend">
                        <span class="add-on">http://instagram.com/</span>
                        <input class="span4 input_rede_social" id="id_instagram" name="instagram" placeholder="seuperfil" type="text" value="<?php 

                        if (isset($rede['ShopRedeSocial']['instagram'])) {
                           echo str_replace("http://instagram.com/", "", $rede['ShopRedeSocial']['instagram']);
                        }
                        
                        ?>" />
                    </div>
                    <span class="error hide">
                        <img src="/admin/img/exclamation-sign.png" alt="Erro">
                        <span class="error help-inline">
                            Página ou Usuário inválido.
                        </span>
                    </span>
                    <span class="success hide">
                        <img src="/admin/img/ok-sign.png" alt="Sucesso">
                    </span>
                </div>
            </div>
            <hr/>
            <div class="control-group">
                <div class="control-label">
                    <img src="/admin/img/redes-sociais/google_plus.jpg" alt="Logo google_plus" class="logo-social" />
                </div>
                <div class="controls">
                    <label for="id_google_plus">Informe sua conta no Google+</label>
                    <div class="input-prepend">
                        <span class="add-on">https://plus.google.com/</span>
                        <input class="span4 input_rede_social" id="id_google_plus" name="google_plus" placeholder="4500952080669631700000/posts" type="text" value="<?php 

                        if (isset($rede['ShopRedeSocial']['google_plus'])) {
                           echo str_replace("https://plus.google.com/", "", $rede['ShopRedeSocial']['google_plus']);
                        }
                        
                        ?>" />
                    </div>
                    <span class="error hide">
                        <img src="/admin/img/exclamation-sign.png" alt="Erro">
                        <span class="error help-inline">
                            Página ou Usuário inválido.
                        </span>
                    </span>
                    <span class="success hide">
                        <img src="/admin/img/ok-sign.png" alt="Sucesso">
                    </span>
                </div>
            </div>
            <hr/>
            <div class="control-group">
                <div class="control-label">
                    <img src="/admin/img/redes-sociais/youtube.jpg" alt="Logo youtube" class="logo-social" />
                </div>
                <div class="controls">
                    <label for="id_youtube">Informe sua conta no Youtube</label>
                    <div class="input-prepend">
                        <span class="add-on">https://www.youtube.com/</span>
                        <input class="span4 input_rede_social" id="id_youtube" name="youtube" placeholder="user/seuperfil" type="text" value="<?php 

                        if (isset($rede['ShopRedeSocial']['youtube'])) {
                           echo str_replace("https://www.youtube.com/", "", $rede['ShopRedeSocial']['youtube']);
                        }
                        
                        ?>" />
                    </div>
                    <span class="error hide">
                        <img src="/admin/img/exclamation-sign.png" alt="Erro">
                        <span class="error help-inline">
                            Página ou Usuário inválido.
                        </span>
                    </span>
                    <span class="success hide">
                        <img src="/admin/img/ok-sign.png" alt="Sucesso">
                    </span>
                </div>
            </div>

            <hr/>
            <div class="control-group">
                <div class="control-label">
                    <img src="/admin/img/redes-sociais/skype.jpg" alt="Logo skype" class="logo-social" />
                </div>
                <div class="controls">
                    <label for="id_skype">Informe sua conta no Skype</label>
                    <div class="input-prepend">
                        <span class="add-on">Nome Skype</span>
                        <input class="span4 input_rede_social" id="id_skype" name="skype" placeholder="seuperfil" type="text" value="<?php 

                        if (isset($rede['ShopRedeSocial']['skype'])) {
                           echo $rede['ShopRedeSocial']['skype'];
                        }
                        
                        ?>" />
                    </div>
                    <span class="error hide">
                        <img src="/admin/img/exclamation-sign.png" alt="Erro">
                        <span class="error help-inline">
                            Página ou Usuário inválido.
                        </span>
                    </span>
                    <span class="success hide">
                        <img src="/admin/img/ok-sign.png" alt="Sucesso">
                    </span>
                </div>
            </div>


            <hr/>
            <div class="control-group">
                <div class="control-label">
                    <img src="/admin/img/redes-sociais/whatsapp.jpg" alt="Logo WhatsApp" class="logo-social" />
                </div>
                <div class="controls">
                    <label for="id_whatsapp">Informe seu número no WhatsApp</label>
                    <div class="input-prepend">
                        <span class="add-on">Número WhatsApp</span>
                        <input class="span4 input_rede_social" id="id_whatsapp" name="whatsapp" placeholder="seunumero" type="text" value="<?php 

                        if (isset($rede['ShopRedeSocial']['whatsapp'])) {
                           echo $rede['ShopRedeSocial']['whatsapp'];
                        }
                        
                        ?>" />
                    </div>
                    <span class="error hide">
                        <img src="/admin/img/exclamation-sign.png" alt="Erro">
                        <span class="error help-inline">
                            Página ou Usuário inválido.
                        </span>
                    </span>
                    <span class="success hide">
                        <img src="/admin/img/ok-sign.png" alt="Sucesso">
                    </span>
                </div>
            </div>

        </div>


        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
            <a href="<?php echo VIALOJA_PAINEL ?>/conta" class="btn"><i class="icon-remove"></i> Cancelar</a>
        </div>
        <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
		<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
    </form>
</div>
