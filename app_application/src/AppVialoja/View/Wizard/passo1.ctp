
<div id="wizard configure-sua-loja globalContainer">

    <div class="body container">

        <?php
        echo $this->element('wizard/progressBar');
        ?>

        <form method="post" action="<?php echo Router::url(); ?>" enctype="multipart/form-data" >
            <div class="step-title">
                <i class="icon-wizard icon-step">01</i>
                <h1>Configure usuário<small class="icon-wizard icon-key icon-title"></small></h1>
            </div>


            <!-- .main-box -->
            <!--<div class="secondary-box clear">-->
            <?php
            $error = null;
            if (isset($erro_nome)) {
                $error='error';
            }
            ?>

            <div class="secondary-box clear">
                <i class="icon-wizard icon-form"></i>
                <div class="control-group <?php if(isset($erro_nome)){echo 'error';} ?>">
                    <strong class="subject-title">
                    Nome completo
                    </strong>
                    <input class="input-name" id="id_nome" maxlength="128" name="nome" required placeholder="Informe seu nome completo" value="<?php
                    if(isset($nome)){

                        echo $nome;

                    } else {

                        echo $this->Session->read('cliente_nome');

                    } ?>" type="text" />

                    <?php
                    if (isset($erro_nome)) {
                        echo '<p class="help-block">'. $erro_nome .'</p>' . PHP_EOL;
                    }
                    ?>

                </div>

                <div class="control-group">
                    <strong class="subject-title">
                    E-mail de acesso
                    </strong>

                    <input class="input-name" id="id_email" name="email" disabled="disabled" maxlength="128" type="email" required value="<?php echo $this->Session->read('cliente_email'); ?>" /> <i class="icon icon-info-sign" rel="tooltip" title="O endereço de e-mail é o seu login de acesso e poderá ser mudado posteriormente."></i>


                </div>

                <div class="control-group <?php if(isset($erro_senha) || isset($erro_confirme) || isset($erro_check)){echo 'error';} ?>">
                    <strong class="subject-title">
                    Crie uma senha
                    </strong>

                    <input class="input-name span4" id="id_senha" name="senha" type="password" required />
                    <?php
                    if (isset($erro_senha)) {
                        echo '<p class="help-block">'. $erro_senha .'</p>' . PHP_EOL;
                    }
                    ?>

                    <style type="text/css">
                    #pstrength{
                        max-width: 310px;
                        margin-bottom: 10px;
                    }
                    </style>

                    <div id="pstrength">
                        <div id="input_senha_minchar" style="max"></div>
                    </div>

                    <strong class="subject-title">
                    Confirme a senha
                    </strong>

                    <input class="input-name span4" id="confirmacao_senha" name="confirmacao_senha" type="password" required />
                    <?php
                    if (isset($erro_confirme)) {
                        echo '<p class="help-block">'. $erro_confirme .'</p>' . PHP_EOL;
                    }

                    $error = null;
                    if (isset($erro_check)) {
                        $error='error';
                    }
                    ?>

                    <div class="controls">
                        <label class="checkbox">
                            <input id="id_termos" required name="check" checked="checked" type="checkbox" <?php if(isset($check)){ echo 'checked="checked"'; }?>/>
                            <span <?php if(isset($erro_check)){echo 'class="error_check"';} ?>>Li e aceito todos os </span><a href="<?php echo VIALOJA_TERMO_USO; ?>" title="Termos de serviço" target="_blank">termos de serviço</a>.
                        </label>
                        <?php
                        if (isset($erro_check)) {
                            echo '<p class="help-block">'. $erro_check .'</p><br />' . PHP_EOL;
                        }
                        ?>
                    </div>

                </div>

            </div>
            <!-- .secondary-box -->
            <div class="action">
                <input type="submit" class="button-styled button-confirm btn-loading " value="Salvar e prosseguir" />
            </div>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </form>
    </div>
    <!-- .body.container -->
</div>

<script type="text/javascript" src="/admin/js/jquery-pstrength.js"></script>

 <!-- jquery-pstrength medidor de senha api 1.7.1 -->
<script type="text/javascript">
  jQuery(document).ready(function($){
      $('#id_senha').pstrength();
  });
</script>