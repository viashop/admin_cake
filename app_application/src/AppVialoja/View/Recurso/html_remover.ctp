<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/html/listar"><i class="icon-tools icon-custom"></i> HTML</a> <span class="bread-separator">-</span></li>
        <li><span>Remover</span></li>
    </ul>
</div>
<div class="box">
    <div class="box-header">
        <h3>Remover código?</h3>
    </div>
    <div class="box-content">

        <?php
        foreach ($result_code as $key => $code);
        ?>
        <form action="<?php echo Router::url(); ?>" method="POST">
            <p>
                Deseja realmente remover o código <strong><?php echo $code['ShopCode']['descricao'];?></strong>?
            </p>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
            <input type="hidden" name="confirmacao" value="confirmacao">
            <input type="hidden" name="id_code" value="<?php echo $code['ShopCode']['id_code'];?>">
            <button class="btn btn-danger">
            <i class="icon-white icon-trash"></i> Remover
            </button>
            <a href="<?php echo VIALOJA_PAINEL ?>/recurso/html/listar" class="btn"> Cancelar</a>
        </form>
    </div>
    <div class="box-footer"></div>
</div>