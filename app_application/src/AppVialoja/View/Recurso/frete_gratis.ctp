<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/listar"><i class="icon-th-large"></i> Banners</a> <span class="bread-separator">-</span></li>
        <li><span>Frete grátis</span></li>
    </ul>
</div>
<form method="post" class="form-horizontal" action="<?php echo Router::url(); ?>">
    <div class="box marketing-frete-gratis">
        <div class="box-header">
            <h3>Configurações Frete Grátis</h3>
        </div>
        <div class="box-content form-inline">
            <div class="control-group">
                <div class="control-label">Prazo de entrega</div>
                <div class="controls">
                    <p class="alert-text">Será usado o mesmo prazo da forma com menor valor disponível.</p>
                </div>
            </div>
            <?php

            foreach ($frete_gratis as $key => $frete):

                $frete_shop = $this->requestAction(
                        array(
                                'controller' => 'ShopFreteGratis',
                                'action' => 'checkFrete',
                                'name' => $frete['RecursoFreteGratis']['name']
                        ) 
                    );

                $valor=$checked =null;
                if ( \Respect\Validation\Validator::notBlank()->validate( $frete_shop ) ) {

                    foreach ($frete_shop as $key => $dados);

                    if ($dados['ShopFreteGratis']['regiao_name'] == $frete['RecursoFreteGratis']['name'] ) {
                        $checked = 'checked="checked"';
                        $valor = \Lib\Tools::convertToDecimalBR($dados['ShopFreteGratis']['regiao_valor']);
                    }
                }

            ?>
            <hr/>
            <div class="control-group ">
                <div class="control-label">&nbsp;</div>
                <div class="controls">
                    <label class="checkbox"><input id="id_<?php echo $frete['RecursoFreteGratis']['name']; ?>_ativo" name="regiao_<?php echo $frete['RecursoFreteGratis']['name']; ?>" value="<?php echo $frete['RecursoFreteGratis']['name']; ?>" type="checkbox" <?php echo $checked; ?> /> Frete grátis para Região <b><?php echo $frete['RecursoFreteGratis']['regiao']; ?></b> acima de</label>
                    <div class="input-prepend">
                        <span class="add-on">R$</span>
                        <input class="input-price" style="width:100px;" id="id_<?php echo $frete['RecursoFreteGratis']['name']; ?>_valor" name="<?php echo $frete['RecursoFreteGratis']['name']; ?>_valor" type="text" value="<?php echo $valor; ?>" />
                        <input type="hidden" name="title_regiao_<?php echo $frete['RecursoFreteGratis']['name']; ?>" value="<?php echo $frete['RecursoFreteGratis']['regiao']; ?>">
                    </div>
                </div>
            </div>
            

            <?php
            endforeach;
            ?>
        </div>
        <div class="form-actions">
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
            <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
            <a href="<?php echo VIALOJA_PAINEL ?>/" class="btn btn-small"><i class="icon-remove"></i> Cancelar</a>
        </div>
    </div>
</form>