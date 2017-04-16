<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar"><i class="icon-briefcase"></i> Minha loja</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/galeria/listar"><i class="icon-custom icon-image"></i> Mídia</a> <span class="bread-separator">-</span></li>
        <li><span>Remover arquivo</span></li>
    </ul>
</div>

<form action="<?php echo Router::url(); ?>" method="post">
    <div class="box">
        <div class="box-header">
            <h3>Remover arquivo</h3>
        </div>
        <div class="box-content">
            <p>Tem certeza que deseja remover o arquivo <strong><?php echo @$result['ShopArquivo']['nome'];?></strong>?</p>
            <p class="alert alert-info no-margin">
                Este arquivo será permanentemente excluido,
                toda e qualquer referência a ele será perdida. Se você tiver
                algum link apontando para este arquivo ele deixará de
                funcionar.
            </p>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-danger" id="processando"><i class="glyphicon glyphicon-ok"></i> 
                Sim, remover o arquivo
                </button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/recurso/galeria/listar" class="btn btn-default"> <span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>
  
    </div>
</form>