<?php
if (isset($flash_cupom_codigo) && !empty($flash_cupom_codigo)) {
    foreach ($flash_cupom_codigo as $key => $value) {
       echo '<div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <h4>Cupom "'. $value .'" removido com sucesso!</h4>
        </div>';
    }
}
?>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/cupom/listar"><i class="icon-dollar icon-custom"></i>Cupons de desconto</a> <span class="bread-separator">-</span></li>
        <li><span>Listar cupons</span></li>
    </ul>
</div>

<form action="/admin/recurso/cupom/remover/" method="post">
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

                    if ($total == 1 ) {
                        echo $total .' cupom';
                    } else {
                        echo $total .' cupons';
                    }
                    ?>
                   
                </h3>
                <div class="box-widget pull-right">
                    <a href="<?php echo VIALOJA_PAINEL ?>/recurso/cupom/criar" class="btn btn-small btn-primary"><i class="icon-plus icon-white"></i> Criar cupom</a>
                </div>
            </div>


            <?php

            if ($total <= 0 ) {
            ?>

            <div class="box-content">
                <p class="text-align-center">
                    Ainda não existe nenhum cupom de desconto cadastrado.<br/>
                </p>
                <p class="text-align-center">
                    <a href="<?php echo VIALOJA_PAINEL ?>/recurso/cupom/criar" class="btn btn-small btn-primary"><i class="icon-plus icon-white"></i> Criar a primeiro cupom de desconto</a>
                </p>
            </div>

            <?php
            } else {
            ?>
            <div class="box-content  table-content">
                <table class="table table-generic-list table-marca">

                    <?php
                    foreach ($res_cupom as $key => $cupom) {
                    ?>
                    <tr class="">
                        <td class="check_box">
                            <input type="checkbox" name="cupons[]" value="<?php echo $cupom['ShopCupomDesconto']['id_cupom'];?>" />
                        </td>
                        <td class="nome">
                            <a href="<?php echo VIALOJA_PAINEL ?>/recurso/cupom/editar/<?php echo $cupom['ShopCupomDesconto']['id_cupom'];?>">
                            <?php echo $cupom['ShopCupomDesconto']['codigo'];?><br/>
                            <small><?php echo $cupom['ShopCupomDesconto']['descricao'];?></small>
                            </a>
                        </td>
                        <td class="quantidade" style="text-align: center">
                            <small>
                            Restam:<br/>
                            <?php
                            if ($cupom['ShopCupomDesconto']['quantidade']=="1") {
                                echo $cupom['ShopCupomDesconto']['quantidade'];
                                echo ' unidade';
                            } else {
                                echo $cupom['ShopCupomDesconto']['quantidade'];
                                echo ' unidades';    
                            }
                            ?> 
                            
                            </small>
                        </td>
                        <td class="data" style="text-align: center">
                            <small>
                            Validade:<br/>
                            <?php
                            if ($cupom['ShopCupomDesconto']['validade'] == "0000-00-00") {
                                echo 'indefinida';
                            } else {

                                $date = new \DateTime();
                                if ($date->format('Y-m-d') > $cupom['ShopCupomDesconto']['validade']) {
                                    echo 'Expirado em ';
                                }

                                echo \Lib\Tools::formatToDate($cupom['ShopCupomDesconto']['validade']);
                            }
                            ?>
                            </small>
                        </td>
                        <td class="utilizada" style="text-align: center">
                            <small>
                            Utilizados:<br/>
                            <?php
                            if ($cupom['ShopCupomDesconto']['utilizados'] > 0) {
                                echo $cupom['ShopCupomDesconto']['utilizados'];
                            } else {
                                echo 'nenhum';
                            }
                            ?>                            
                            </small>
                        </td>
                        <td class="ativo">
                            <span class="status">

                                <?php
                                if ($cupom['ShopCupomDesconto']['ativo'] == "True") {
                                    echo '<span class="icon-custom icon-white icon-power"></span>Ativo' . PHP_EOL;
                                } else {
                                    echo '<span class="icon-custom icon-white icon-power off"></span>Inativo' . PHP_EOL;
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    
                </table>
            </div>

            <?php
            }
            ?>
        </div>
        <div class="row-fluid">

            <?php
            if ($total > 0 ) {
            ?>
            <div class="span4">
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
            </div>

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
    </div>
</form>