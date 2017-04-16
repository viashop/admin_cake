<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> admin</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/listar"><i class="icon-th-large"></i> Organizar</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/listar"><i class="icon-th"></i> Grades</a> <span class="bread-separator">-</span></li>
        <li><span>Editar grade</span></li>
    </ul>
</div>
<div class="box">
    <div class="box-header">
        <h3 class="pull-left">Editando grade</h3>
        <div class="box-widget pull-right">
        </div>
    </div>
    <div class="box-content">
        <form action="<?php echo Router::url(); ?>" method="post">

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
                        <input class="campo_principal form-control" id="id_nome" maxlength="128" name="nome" type="text" value="<?php 

                        if (\Lib\Validate::isPost()) {
                            echo \Lib\Tools::getValue('nome');
                        } else {
                            echo $grade['ShopGrade']['nome'];
                        }                        

                        ?>" required />
                        <p class="help-block">Nome da grade para controle interno</p>
                        <?php
                        if (isset($error_grade)) {
                            echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="btn-group-md text-right">
                
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Alterar nome</button>

                &nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;&nbsp;


                <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/listar" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>

                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
            </div>
        </form>
        <hr/>

        <form action="/admin/catalogo/grade/<?php echo $this->request->params['pass']['2']; ?>/variacao/criar" method="post">
            <h3>Variações da grade</h3>
            <table class="table table-striped table-hover">

                <?php
                foreach ($res_variacao as $key => $variacao) {
                ?>

                <tr>
                    <td style="vertical-align: middle; width: 470px">
                        <?php echo $variacao['ShopGradeVariacao']['nome']; ?>
                    </td>
                    <td style="vertical-align: middle;">
                        <span class="label label-default">
                            <?php

                            $total_vinculado = $this->requestAction(
                                array(
                                    'controller' => 'ShopProdutoVariacao',
                                    'action' => 'getTotalVariacaoVinculado',
                                    'id_grade_variacao' => $variacao['ShopGradeVariacao']['id_variacao']
                                )
                            );

                            if ($total_vinculado == '1' ) {
                                echo $total_vinculado .' produto vinculado';
                            }  else {
                                echo $total_vinculado .' produtos vinculados';
                            }

                            ?></span>
                    </td>
                    <td style="text-align: right">
                        <a class="btn btn-default btn-mini" href="/admin/catalogo/grade/<?php echo $this->request->params['pass']['2']; ?>/variacao/editar/<?php echo $variacao['ShopGradeVariacao']['id_variacao']; ?>">
                        <span class="glyphicon glyphicon-edit"></span> Editar
                        </a>
                        <a class="btn btn-danger btn-mini" href="/admin/catalogo/grade/<?php echo $this->request->params['pass']['2']; ?>/variacao/remover/<?php echo $variacao['ShopGradeVariacao']['id_variacao']; ?>">
                        <span class="glyphicon glyphicon-remove"></span> Remover
                        </a>
                    </td>
                </tr>

                <?php
                }
                ?>

                <tr>
                    <td colspan="3">
                        <div class="input-group">
                            <input class="form-control" type="text" name="nome" required placeholder="Nome da nova variação"  />
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok icon-white"></span> Criar nova variação</button>

                                <?php
                                if (isset($this->request->query['next'])){
                                ?>

                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->request->query['next']; ?>#opcoes-produto" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                Voltar
                                </a>
                                <?php
                                }   
                                ?>

                            </div>

                            <div class="input-group-btn">
                                
                            </div>

                        </div>
                        <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
						<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

                        
                    </td>
                </tr>
             
            </table>
        </form>

    </div>
</div>