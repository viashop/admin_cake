<?php
if (isset($flash_categoria_nome) && !empty($flash_categoria_nome)) {
    foreach ($flash_categoria_nome as $key => $value) {
       echo '<div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <h4>Categoria "'. $value .'" removida com sucesso!</h4>
        </div>';
    }
}
?>

<div class="bread-container">
    <ul class="breadcrumb">
        <li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/listar"><i class="icon-th-large"></i> Organizar</a> <span class="bread-separator">-</span></li>
        <li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/listar"><i class="icon-bookmark"></i> Categorias</a> <span class="bread-separator">-</span></li>
        <li><span>Listar categorias</span></li>
    </ul>
</div>

<form action="/admin/catalogo/categoria/remover" method="post">
	<div class="row categoria categoria-listar">
		<div class="box">
			<div class="box-header">
				<h3 class="pull-left">
					<span class="check-container pull-left"><input type="checkbox" class="select_all" rel=".categorias" /></span>
					<?php
					if ($count_categoria == '1' ) {
						echo $count_categoria . ' categoria';
					} else {
						echo $count_categoria . ' categorias';
					}
					?>
				</h3>
				<div class="box-widget pull-right">
					<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/criar" class="btn btn-small btn-primary"><i class="icon-plus icon-white"></i> Criar categoria</a>
				</div>
			</div>

			<?php
			if ($count_categoria > 0 ) {
			?>
			<div class="box-content table-content">
				<div class=" botoes">
					<a href="javascript:;" class="btn btn-primary btn-small hide" id="btnSalvar">Salvar Alterações</a>
					<a href="javascript:;" class="btn btn-small hide" id="btnOrdenarAlfabetica">Ordenar em ordem alfabética</a>
					<a href="javascript:;" class="btn btn-danger btn-small hide" id="btnVoltar">Cancelar ordenação</a>
				</div>

				<ol class="categorias sortableplus">
				<?php
				echo $res_lista_categoria;
				?>
				</ol>



				<!-- categories -->
				<div class="form-actions">
					<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
					<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
					<button type="submit" class="btn btn-danger" id="btnRemover"><i class="glyphicon glyphicon-trash"></i> Remover selecionados</button>
				</div>
			</div>

			<?php
			} else {
			?>

			<div class="box-content">
                <p class="text-align-center">Ainda não existe nenhuma categoria cadastrada.</p>
                <p class="text-align-center"><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/categoria/criar" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus"></span> Criar a primeira categoria</a></p>
          
            </div>

            <?php
			}
			?>

		</div>

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