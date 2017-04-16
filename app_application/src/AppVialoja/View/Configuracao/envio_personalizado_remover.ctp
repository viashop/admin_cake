<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/envio/listar"><i class="icon-road"></i> Formas de envio</a> <span class="bread-separator">-</span></li>
        <li><span>Remover forma de envio</span></li>
    </ul>

</div>

<form class="horizontal-form" action="<?php echo Router::url(); ?>" method="post">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Remover forma de envio personalizada</h3>
        </div>
        <div class="box-content">
            <p> Deseja realmente remover <strong><?php echo $dados['ShopEnvioPersonalizado']['nome']; ?></strong>?</p>
        </div>
        <div class="btn-group-md text-right">
            <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/listar" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>&nbsp;&nbsp;
            <button type="submit" class="btn btn-danger" id="processando"><span class="glyphicon glyphicon-ok"></span> Remover </button>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' /> &nbsp;&nbsp;
        </div>
        <br />
    </div>
</form>
