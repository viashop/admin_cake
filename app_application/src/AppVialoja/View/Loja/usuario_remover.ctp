<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar"><i class="icon-briefcase"></i> Minha loja</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/configuracao/editar"><i class="icon-custom icon-tools"></i> Configurações</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/loja/usuario/listar"><i class="icon-custom icon-users"></i> Usuários</a> <span class="bread-separator">-</span></li>
        <li><span>Remover usuário</span></li>
    </ul>
</div>

<form class="form-horizontal" action="<?php echo Router::url(); ?>" method="post">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <h3>Removendo <?php echo $nome;?></h3>
            </div>
            <div class="box-content">
                <p>Você tem certeza que deseja remover permanentemente o usuário <strong><?php echo $nome;?></strong>?</p>    
           
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-danger" id="processando"><i class="glyphicon glyphicon-ok"></i> 
                    Sim, remover o usuário
                    </button>&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;<a href="<?php echo VIALOJA_PAINEL ?>/loja/usuario/editar/<?php echo $id?>" class="btn btn-default"> <span class="glyphicon glyphicon-remove"></span> Não, cancelar</a>
                <input type="hidden" name="confirmar" value="True" />
                <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
                <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
            </div>
        </div>
    </div>
</form>