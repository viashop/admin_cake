<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/listar"><i class="icon-th-large"></i> Organizar</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/listar"><i class="icon-th"></i> Grades</a> <span class="bread-separator">-</span></li>
        <li><span>Editar variação</span></li>
    </ul>
</div>

<?php
foreach ($res_variacao as $key => $variacao);
?>

<form action="<?php echo Router::url(); ?>" method="post">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Editando variação da grade</h3>
            <div class="box-widget pull-right">
            </div>
        </div>
        <?php
        $error = null;
        if (isset($error_variacao)) {
            $error='has-error';
        }
        ?>
        <div class="box-content">
            <div class="form-horizontal">
                <div class="form-group obrigatorio campo_nome <?php echo $error; ?>">
                    <label class="control-label col-sm-3">
                    Nome da variação da grade
                    </label>
                    <div class="col-sm-9">
                        <input class="campo_principal form-control" id="id_nome" maxlength="128" name="nome" type="text" value="<?php 

                        if (\Lib\Validate::isPost()) {
                            echo \Lib\Tools::getValue('nome');
                        } else {
                            echo $variacao['ShopGradeVariacao']['nome'];
                        }                        

                        ?>" required />
                        <?php
                        if (isset($error_variacao)) {
                            echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="processando"><i class="glyphicon glyphicon-ok"></i> 
                Salvar alterações
                </button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/editar/<?php echo $this->request->params['pass'][1]; ?>" class="btn btn-default"> <span class="glyphicon glyphicon-remove"></span> Cancelar</a>
            <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        </div>

    </div>
</form>