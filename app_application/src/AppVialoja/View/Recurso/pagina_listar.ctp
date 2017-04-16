<script type="text/javascript" src="/admin/js/ordenacao.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	$('#loading').hide();
	$('#modal-error').hide();
	
    ordenar = new Ordenar('.paginas tbody', '.paginas tr', '.paginas tr a .name', '/admin/recurso/pagina/ordenar');

    $('.btn-ordenar').click(function() {
        if($('body').hasClass('sortable-active')) {
            ordenar.destroySortable();
        } else {
            $('body').addClass('sortable-active');
            $('.box-header .pull-left .check-container, .paginas .check_box input').hide();
            $('.pagina.pagina-listar .botoes').show();
            $('.paginas .check_box .glyphicon-move').css({'display': 'block'});
            ordenar.sortable();
        }
    });

    $('#btnOrdenarAlfabetica').click(function() {
        ordenar.ordenaAlfabetica();
    });

    $('#btnSalvar').click(function() {
		$('#modal-loading').modal('show');
        ordenar.salva(function(data) {
            if(data.estado == 'SUCESSO') {
                $.loader();
                setTimeout(function() {
                    $.removeLoader();
                    $('body').removeClass('sortable-active');
                    ordenar.destroySortable();
                    $('.box-header .pull-left .check-container, .paginas .check_box input').show();
                    $('.pagina.pagina-listar .botoes, .paginas .check_box .glyphicon-move').hide();
                }, 500);
            } else {
                $.loader();
                setTimeout(function() {
                    $.removeLoader();
                    $('#modal-error .error-text').html('Houve um erro ao salvar as alterações. Tente novamente!');
					//$('#modal-error .error-text').html(data.mensagem);
                    jQuery.removeLoader();
                    $('#modal-error').modal('show');
                }, 500);
            }
        });
    });

    $('#btnVoltar').click(function() {
        location.reload();
    });
});
</script>

<?php
if (isset($flash_pagina_titulo) && !empty($flash_pagina_titulo)) {
    foreach ($flash_pagina_titulo as $key => $value) {
       echo '<div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <h4>Página "'. $value .'" removida com sucesso!</h4>
        </div>';
    }
}
?>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/pagina/listar"><i class="icon-page icon-custom"></i> Páginas</a> <span class="bread-separator">-</span></li>
		<li><span>Listar páginas</span></li>
	</ul>
</div>
<form action="/admin/recurso/pagina/remover" method="POST" >
	<div class="row pagina pagina-listar">
		<div class="box">
			<div class="box-header">
				<h3 class="pull-left">
					<span class="check-container pull-left"><input type="checkbox" class="select_all" rel=".table"></span>

					<?php
                    $total =  $this->Paginator->counter(array(
                            'format' => '%count%'
                    ));

                    if ($total ==1) {
                        echo $total . ' pagina' . PHP_EOL;
                    } else {
                        echo $total . ' paginas' . PHP_EOL;
                    }
                    ?> no total - 

                    <?php
                    echo $this->Paginator->counter(array(
                            'format' => '<small>Página %page% de %pages%</small>'
                    ));
                    ?>
				</h3>
				<div class="box-widget pull-right">
					<a href="<?php echo VIALOJA_PAINEL ?>/recurso/pagina/criar/" class="btn btn-primary"><i class="icon-plus icon-white"></i> Criar página</a>
				</div>
			</div>
			<div class="box-content table-content">
				<div class="botoes hide">
					<a href="javascript:;" class="btn btn-primary btn-small" id="btnSalvar">Salvar Alterações</a>
					<a href="javascript:;" class="btn btn-small" id="btnOrdenarAlfabetica">Ordenar em ordem alfabética</a>
					<a href="javascript:;" class="btn btn-danger btn-small" id="btnVoltar">Cancelar ordenação</a>
				</div>
				<table class="table table-generic-list control-listagem paginas">
					<tbody>

                        <?php
                        if ($total <= 0 ) {
                        ?>

                        <div class="box-content">
                            <p class="text-align-center">
                                Ainda não existe nenhuma página cadastrada.<br/>
                            </p>
                            <p class="text-align-center">
                                <a href="<?php echo VIALOJA_PAINEL ?>/recurso/pagina/criar" class="btn btn-small btn-primary"><i class="icon-plus icon-white"></i> Criar a primeira página</a>
                            </p>
                        </div>

                        <?php
                        } else {
                      
    						foreach ($res_pagina as $key => $pagina):
    						?>
    						<tr class="" data-id=<?php echo $pagina['ShopPagina']['id_pagina']; ?>>
    							<td class="check_box">
    								<input type="checkbox" name="paginas[]" value="<?php echo $pagina['ShopPagina']['id_pagina']; ?>" />
    								<i class="icon-move hide"></i>
    							</td>
    							<td class="nome">
    								<a href="<?php echo VIALOJA_PAINEL ?>/recurso/pagina/editar/<?php echo $pagina['ShopPagina']['id_pagina']; ?>">
    								<span class="name"><?php echo $pagina['ShopPagina']['titulo']; ?></span><br/>
    								</a>
    								<a href="javascript:;" class="btn btn-small btn-ordenar">Ordenar página</a>
    							</td>
    						</tr>
    						<?php
    						endforeach;

                        }
						?>
					</tbody>
				</table>
			</div>

			
		</div>

		<div class="pagination pagination-sm no-margin pull-right" style="margin: 0">
            <ul>
                <?php 
                    echo $this->Paginator->numbers( array( 'modulus' => '2', 'tag' => 'li', 'first'=>'Início', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a', 'last'=>'Último'  ) );
                ?>
            </ul>
        </div>

        <?php
        if ($total > 0 ) {
        ?>

		<div class="row-fluid">
			<div class="span4">
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
				<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>

                <?php
                echo 'Remover ';
                if ($total == 1 ) {
                    echo 'selecionado' .PHP_EOL;
                } else {
                    echo 'selecionados' .PHP_EOL;
                }
                ?>

         </button>
			</div>
		</div>

        <?php
        }
        ?>
	</div>
</form>


<div id="loading" class="modal hide">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-body text-center">
		<h3 class="loading-text">Salvando alteração...</h3>
		<img src="/admin/img/ajax-loader.gif" alt="Salvando alteração..." />
	  </div>
	</div>
  </div>
</div>

<div id="modal-error" class="modal hide">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-body">
		<h3 class="error-text"></h3>
	  </div>
	  <div class="modal-footer">
		<a href="#" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Fechar</a>
	  </div>
	</div>
  </div>
</div>