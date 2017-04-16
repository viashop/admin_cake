<div class="row-fluid">

    <?php
    if ($grade_id == '3') :
    ?>

    <ul class="span4">
        
        <?php
        foreach ($res_variacao_cor as $key => $variacao):
        ?>

        <li class="pull-left">
            <a href="#" class="opcao-cor principal img-thumbnail " data-cor="<?php echo $variacao['ShopGradeVariacao']['hex']; ?>" data-aid="<?php echo $variacao['ShopGradeVariacao']['id_variacao']; ?>" data-nome="<?php echo $variacao['ShopGradeVariacao']['nome']; ?>" rel="tooltip" title="<?php echo $variacao['ShopGradeVariacao']['nome']; ?>" style="background: <?php echo $variacao['ShopGradeVariacao']['hex']; ?>; width:20px; height:20px; margin:5px; float:left;"></a>

        </li>
        
        <?php
        endforeach;
        ?>
        
    </ul>
    <ul class="span4">

        <?php
        foreach ($res_variacao_cor as $key => $variacao):
        ?>

        <li class="pull-left">
            <a href="#" class="opcao-cor img-thumbnail " data-cor="<?php echo $variacao['ShopGradeVariacao']['hex']; ?>" data-nome="<?php echo $variacao['ShopGradeVariacao']['nome']; ?>" data-bid="<?php echo $variacao['ShopGradeVariacao']['id_variacao']; ?>" rel="tooltip" title="<?php echo $variacao['ShopGradeVariacao']['nome']; ?>" style="background: <?php echo $variacao['ShopGradeVariacao']['hex']; ?>; width:20px; height:20px; margin:5px; float:left;"></a>
        </li>
        
        <?php
        endforeach;
        ?>
        
    </ul>

    <div class="preview span4">
	    <div class="img-thumbnail" style="width:100%;">
            <div class="cor_principal" style="height:110px;"></div>
            <div class="cor_secundaria" style="height:110px;"></div>
	    </div>
        <div class="nome text-align-center">
            <strong>
                <span class="nome_principal"></span> / <span class="nome_secundario"></span>
            </strong>

            <div id='item1'>
                <span class="id1 hide"></span>
            </div>
            <div id='item2'>
                <span class="id2 hide"></span>
            </div>

        </div>
    </div>

    <?php
    else :
    ?>

    <ul class="span4">
        
        <?php
        foreach ($res_variacao_cor as $key => $variacao):
        ?>

        <li class="pull-left">
            <a href="#" class="opcao-cor principal img-thumbnail " data-cor="<?php echo $variacao['ShopGradeVariacao']['hex']; ?>" data-aid="<?php echo $variacao['ShopGradeVariacao']['id_variacao']; ?>" data-nome="<?php echo $variacao['ShopGradeVariacao']['nome']; ?>" rel="tooltip" title="<?php echo $variacao['ShopGradeVariacao']['nome']; ?>" style="background: <?php echo $variacao['ShopGradeVariacao']['hex']; ?>; width:20px; height:20px; margin:5px; float:left;"></a>
        </li>
        
        <?php
        endforeach;
        ?>
        
    </ul>
    
    <div class="preview span4">
        <div class="img-thumbnail" style="width:100%;">
            <div class="cor_principal" style="height:200px;"></div>
        </div>
        <div class="nome text-align-center">
            <strong>
                <span class="nome_principal"></span>
            </strong>
            <div id='item1'>
                <span class="id1 hide"></span>
            </div>
        </div>
    </div>
    
    <?php
    endif;
    ?>

</div>
