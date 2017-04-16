<?php
if (isset($flash_marca_nome) && !empty($flash_marca_nome)) {
    foreach ($flash_marca_nome as $key => $value) {
       echo '<div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <h4>Marca "'. $value .'" removida com sucesso!</h4>
        </div>';
    }
}
?>
<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><i class="icon icon-tag"></i> <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/marca/listar">Marca</a> <span class="bread-separator">-</span></li>
		<li><span>Listar marcas</span></li>
	</ul>
</div>
<form action="/admin/catalogo/marca/remover" method="post">
    <div class="row">
        <div class="box">
            <div class="box-header">
                <span class="check-container pull-left">
                <input type="checkbox" class="select_all" rel=".table" />
                </span>
                <h3 class="pull-left">

                    <?php
                    $total =  $this->Paginator->counter(array(
                            'format' => '%count%'
                    ));

                    if ($total ==1) {
                        echo $total . 'marca' . PHP_EOL;
                    } else {
                        echo $total . 'marcas' . PHP_EOL;
                    }
                    ?>
                   
                </h3>
                <div class="box-widget pull-right">
                    <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/marca/criar" class="btn btn-small btn-primary"><i class="icon-plus icon-white"></i> Criar marca</a>
                </div>
            </div>
            <?php
            if ($total <= 0 ) {
            ?>

            <div class="box-content">
                <p class="text-align-center">
                    Ainda não existe nenhuma marca cadastrada.<br/>
                </p>
                <p class="text-align-center">
                    <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/marca/criar" class="btn btn-small btn-primary"><i class="icon-plus icon-white"></i> Criar a primeira marca</a>
                </p>
            </div>

            <?php
            } else {
            ?>

            <div class="box-content table-content">
                <table class="table table-generic-list table-marca">

                    <?php
                    foreach ($res_marca as $key => $marca):
                    ?>
                    <tr class="">
                       
                        <td class="imagem">
                            <?php
                            if (!empty($marca['ShopMarca']['logo'])) {

                                echo sprintf('<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/marca/editar/%s" target="_self" title="Editar marca" class="title "><img src="%s%s" alt="Logo da Marca"></a>', $marca['ShopMarca']['id_marca'], $dir_marcas, $marca['ShopMarca']['logo']) . PHP_EOL;
                            }
                            ?>
                        </td>
                        <td class="check_box">
                            <input type="checkbox" name="marcas[]" value="<?php echo $marca['ShopMarca']['id_marca']; ?>" />
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/marca/editar/<?php echo $marca['ShopMarca']['id_marca']; ?>" target="_self" title="Editar marca" class="title ">
                            <?php echo $marca['ShopMarca']['nome']; ?><br/>
                            <small><?php echo $marca['ShopMarca']['apelido']; ?></small>
                            </a>
                            <p>
                            </p>
                        </td>
                        <td class="ativo">
                            <span class="status">
                                <?php
                                if ($marca['ShopMarca']['ativo'] == 'True') {
                                    echo '<span class="icon-custom icon-white icon-power"></span>
                                Ativa' . PHP_EOL;
                                } else {
                                    echo '<span class="icon-custom icon-white icon-power off"></span>Inativo' . PHP_EOL;
                                }
                                ?>                                
                            </span>
                            
                        </td>
                    </tr>

                    <?php
                    endforeach;
                    ?>
                </table>
            </div>

            <?php
            }
            ?>

        </div>
        <?php
        if ($total > 0 ) {
        ?>
        <input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
		<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
        <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> 
            <?php
            if ($total > 1) {
                echo 'Remover selecionados'. PHP_EOL;
            } else {
                 echo 'Remover selecionado'. PHP_EOL;
            }
            ?>
        </button>

        <?php
        }
        ?>

        <div class="pagination pagination-sm no-margin pull-right" style="margin: 0">
            <ul>
                <?php 
                    echo $this->Paginator->numbers( array( 'modulus' => '2', 'tag' => 'li', 'first'=>'Início', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a', 'last'=>'Último'  ) );
                ?>
            </ul>
        </div>
    </div>
</form>