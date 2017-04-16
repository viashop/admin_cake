<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar"><i class="icon-road"></i> Formas de envio</a> <span class="bread-separator">-</span></li>
        <li><span>Removendo região</span></li>
    </ul>
</div>

<form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="pull-left">Removendo região <?php echo $regiao; ?></h3>
            </div>
            <div class="box-content">
                <p>Tem certeza que deseja remover a região <?php echo $regiao; ?>?</p>
                <div class="alert alert-error">
                    <h4>Atenção!</h4>
                    As respectivas faixas de CEP e peso desta região também serão removidas.
                </div>
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
                <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
                <input type='hidden' name='url_redirect' value='<?php echo $referer; ?>' />

                <button type="submit" class="btn btn-danger"><i class="icon-trash icon-white"></i> Sim, remover</button>
                <a href="<?php echo $referer; ?>" class="btn"><i class="icon-remove"></i> Cancelar</a>
            </div>
        </div>
    </div>
</form>
