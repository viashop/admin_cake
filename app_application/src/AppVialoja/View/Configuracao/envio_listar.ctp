<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar"><i class="icon-road"></i> Formas de envio</a> <span class="bread-separator">-</span></li>
        <li><span>Listar formas de envio</span></li>
    </ul>
</div>
<div class="row">
    <div class="alert alert-info">
        Para configurar frete grátis vá em <b>Marketing > Frete Grátis</b> ou <a href="<?php echo VIALOJA_PAINEL ?>/recurso/fretegratis/editar" title="Marketing Frete Grátis">clique aqui</a>.
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Formas de envio</h3>
        </div>
        <div class="box-content table-content">
            <table class="table table-envio table-generic-list">

                <?php
                foreach ($envio_forma as $key => $envio) {
                ?>

                <tr class="">
                    <td class="imagem">
                        <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/editar/<?php echo $envio['ConfiguracaoEnvio']['id']; ?>/<?php echo $envio['ConfiguracaoEnvio']['slug']; ?>" target="_self" title="Editar forma de envio">
                        <img src="/admin/img/formas-de-envio/<?php echo $envio['ConfiguracaoEnvio']['logo']; ?>" />
                        </a>
                    </td>
                    <td class="nome">
                        <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/editar/<?php echo $envio['ConfiguracaoEnvio']['id']; ?>/<?php echo $envio['ConfiguracaoEnvio']['slug']; ?>" target="_self" title="Editar forma de envio" class="title">
                        <?php echo $envio['ConfiguracaoEnvio']['title']; ?><br/>
                        </a>
                    </td>
                    <td class="ativo">
                        <span class="status">

                        <?php
                        if (in_array($envio['ConfiguracaoEnvio']['id'], $forma_envio_shop)) {
                            echo '<span class="icon-custom icon-white icon-power"></span>Ativo
                        </span>';
                        } else {
                            echo '<span class="icon-custom icon-white icon-power off"></span>Inativo
                        </span>';
                        }
                        
                        ?>

                        
                    </td>
                    <!--
                    <td class="ativo">
                        <span class="status">
                        <span class="icon-custom icon-white icon-power"></span>Ativo
                        </span>
                    </td>
                    -->
                </tr>

                <?php
                }
                ?>

            </table>
        </div>
    </div>


    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Formas de envio personalizada</h3>

            <?php if (count($forma_envio_shop_personalizado) >0): ?>               
            
            <div class="box-widget pull-right">
                <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/personalizado/criar" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar nova forma de envio
                </a>
            </div>

            <?php endif ?>

        </div>

        <?php if (count($forma_envio_shop_personalizado) >0): ?> 

        <div class="box-content table-content">

            <table class="table table-envio table-generic-list">

                <?php foreach ($forma_envio_shop_personalizado as $key => $envio): ?>

                <tr class="">

                    <td class="imagem">
                        <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/personalizado/<?php echo $envio['ShopEnvioPersonalizado']['id']; ?>/editar" target="_self" title="Editar forma de envio personalizada">

                            <?php if (!empty($envio['ShopEnvioPersonalizado']['imagem'])): ?>
                                
                                <img src="<?php echo $imagem_envio_personalizado . $envio['ShopEnvioPersonalizado']['imagem']; ?>">

                            <?php endif ?>


                        </a>
                    </td>
             
                    <td class="nome">
                        <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/personalizado/<?php echo $envio['ShopEnvioPersonalizado']['id']; ?>/editar" target="_self" title="Editar forma de envio" class="title">
                        <?php echo $envio['ShopEnvioPersonalizado']['nome']; ?><br/>
                        </a>
                    </td>

                    <td class="ativo">
                        <span class="status">
                        <?php
                        if ($envio['ShopEnvioPersonalizado']['ativo'] === 'True') {
                            echo '<span class="icon-custom icon-white icon-power"></span>Ativo
                        </span>';
                        } else {
                            echo '<span class="icon-custom icon-white icon-power off"></span>Inativo
                        </span>';
                        }                            
                        ?>
                    </td>
          
                </tr>

                 <?php endforeach ?>

            </table>
        </div>

        <?php else: ?>

            <p class="text-align-center">
                Ainda não existem formas de envio personalizadas.<br/>
            </p>
            <p class="text-align-center">
                <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/personalizado/criar" class="btn btn-primary">
                <i class="icon-plus icon-white"></i>
                Adicionar nova forma de envio
                </a>
            </p>
                
        <?php endif ?>

    </div>

    <a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/calcular" class="btn btn-primary">
    <i class="icon-ok icon-white"></i>
        Simular calculo de frete
    </a>
</div>
