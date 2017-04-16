<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><i class="icon-th"></i> <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/listar">Grades</a> <span class="bread-separator">-</span></li>
		<li><span>Criar grade</span></li>
	</ul>
</div>
<div class="alert alert-info">
	<h3>Grades para o produto</h3>
	<p>Aqui você deverá criar as grades que irá usar nos seus produtos.</p>
	<p><strong>Uma grade define o tipo de opção que o cliente escolherá, por exemplo: Cor, Tamanho, Tensão.</strong> Depois de criar as grades para um produto você definirá os valores, por exemplo: Amarelo, Azul e Verde para Cor; P, M e G para Tamanho; 110v e 220v para Tensão.</p>
</div>

<form action="<?php echo Router::url(); ?>" method="post">
    <div class="box">
        <div class="box-header">
            <h3 class="pull-left">Criando grade</h3>
            <div class="box-widget pull-right">
            </div>
        </div>
        <div class="box-content">
            <div class="form-horizontal">
                <?php
                $error = null;
                if (isset($error_grade)) {
                    $error='has-error';
                }
                ?>
                <div class="form-group obrigatorio campo_nome <?php echo $error; ?>">
                    <label class="control-label col-sm-3">
                    Nome da grade
                    </label>
                    <div class="col-sm-9">
                        <input class="campo_principal form-control" id="id_nome" maxlength="128" name="nome" type="text" required />
                        <?php
                        if (isset($error_grade)) {
                            echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                        }
                        ?> 
                    </div>
                </div>
            </div>
            <div class="btn-group-md text-right">
                <a href='/admin/catalogo/grade/listar' class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Criar grade</button>
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
            </div>
        </div>
    </div>
</form>