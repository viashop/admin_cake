<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/listar"><i class="icon-th-large"></i> Organizar</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/listar"><i class="icon-th"></i> Grades</a> <span class="bread-separator">-</span></li>
        <li><span>Remover a grade</span></li>
    </ul>
</div>

<form class="horizontal-form" action="<?php echo Router::url(); ?>" method="post">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Removendo a grade</h3>
        </div>
        <div class="box-content">
            <p> Deseja realmente remover a grade <strong><?php echo $grade['ShopGrade']['nome']; ?></strong>?</p>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-danger" id="processando"><i class="glyphicon glyphicon-ok"></i> 
                Remover a grade
                </button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/listar" class="btn btn-default"> <span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>

    </div>
</form>
