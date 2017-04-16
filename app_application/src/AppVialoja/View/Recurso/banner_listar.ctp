 <?php //$this->Html->script('jquery-1.7.2.js', array('inline' => false)); ?> 

<script type="text/javascript" src="/admin/js/ordenacao.js"></script>
<script>

	function OrdenarBanner(elemento) {
	  this.elemento = elemento;
	  this.ordenar_banner = null;
	  this.init(elemento);
	}
	
	OrdenarBanner.prototype.init = function(elemento) {
		var elemento = this.elemento;
		this.ordenar_banner = new Ordenar(
			'.table-' + elemento + ' .table-banner tbody',
			'.table-' + elemento + ' .table-banner tbody tr',
			'.table-' + elemento + ' .table-banner tbody .nome span',
			'/admin/recurso/banner/ordenar');
		this.organizar();
	}
	
	OrdenarBanner.prototype.organizar = function() {
		var self = $('#' + this.elemento + ' button.organizar');
		self.hide();
		this.ordenar_banner.sortable();
		$('#' + this.elemento + ' button.salvar').show();
		$('#' + this.elemento + ' button.cancelar').show();
		var pai = self.parents('.box');
		pai.slideDown();
		$('#' + this.elemento).not(pai).slideUp();
	}
	
	OrdenarBanner.prototype.cancelar = function() {
	
		this.ordenar_banner.destroySortable();
		$('#' + this.elemento + ' button.salvar').hide();
		$('#' + this.elemento + ' button.cancelar').hide();
		$('#' + this.elemento + ' button.organizar').show();
		$('#' + this.elemento).slideDown();
	}

	OrdenarBanner.prototype.salvar = function() {	
		$('#modal-loading').modal('show');
		$.loader();
		this.ordenar_banner.destroySortable();
		$('#' + this.elemento + ' button.salvar').hide();
		$('#' + this.elemento + ' button.cancelar').hide();
		$('#' + this.elemento + ' button.organizar').show();
		$('#' + this.elemento).slideDown();
	
		this.ordenar_banner.salva(function(data) {
			if (data.estado == 'SUCESSO') {
				setTimeout(function() {
					$.removeLoader();
				}, 500)

				//alert(data.mensagem);
				//location.reload();
			} else {
				setTimeout(function() {
					$.removeLoader();
					$('#modal-error .error-text').html('Houve um erro ao salvar as alterações. Tente novamente!');
					//$('#modal-error .error-text').html(data.mensagem);
					$('#modal-error').modal('show');
				}, 500)
				// Error
			}
		});
	}
	
	$(document).ready(function() {
		
		$('#modal-error').hide();		
		
		$('.organizar').click(function(event) {
			event.preventDefault();
			var box = $(this).parents('.box');
			$('.box').not(box).slideUp();
	
			var elemento = $(this).attr('data-banner-nome');
			var table = $(this).parents('.box').find('table');
			table.find('input').hide();
			table.find('.icon-move').show();
			organizar_banner = new OrdenarBanner(elemento);
		});
	
		$('.select_related').change(function(event) {
			$(this).parents('.box').find('table').find('input[type=checkbox]').trigger('click');
		});
	
		$('.salvar').click(function(event) {
			event.preventDefault();
			var table = $(this).parents('.box').find('table');
			table.find('input').show();
			table.find('.icon-move').hide();
			organizar_banner.salvar();
			$('.box').slideDown();
		});
	
		$('.cancelar').click(function(event) {
			event.preventDefault();
			var table = $(this).parents('.box').find('table');
			table.find('input').show();
			table.find('.icon-move').hide();
			organizar_banner.cancelar();
			$('.box').slideDown();
		});
	
	})
</script>

<?php
if (isset($flash_banner_nome) && !empty($flash_banner_nome)) {
    foreach ($flash_banner_nome as $key => $value) {
       echo '<div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <h4>Banner "'. $value .'" removido com sucesso!</h4>
        </div>';
    }
}
?>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/listar"><i class="icon-th-large"></i> Banners</a> <span class="bread-separator">-</span></li>
		<li><span>Listar banners</span></li>
	</ul>
</div>
<form action="/admin/recurso/banner/remover" method="POST">

	<?php

	foreach ($res_banner_posicao as $key => $posicao) {

		//Ainda não existe nenhum banner cadastrado.
		$total = $this->requestAction(array(
            'controller' => 'ShopBanner',
            'action' => 'getAllLocalTotal',
            'local' => $posicao['BannerPosicao']['local_publicacao']
        ));

	?>

	<div class="box" id="<?php echo $posicao['BannerPosicao']['local_publicacao']; ?>" style="overflow:visible;">
		<div class="box-header">
			<span class="check-container pull-left">
			<input type="checkbox" class="select_related" rel=".table" />
			</span>
			<h3 class="pull-left">
				<?php echo $total . ' '. $posicao['BannerPosicao']['nome']; ?>
				<a href="<?php echo 'http://suporte'. env('HTTP_BASE'); ?>" title="Artigo Banners" target="_blank" class="link_ext">
				<i class="icon-share"></i>
				</a>
			</h3>
			<div class="box-widget pull-right">
				<a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/criar/<?php echo $posicao['BannerPosicao']['local_publicacao']; ?>" class="btn btn-small btn-primary editar"><i class="icon-edit icon-white"></i> Criar novo banner</a>
				<button class="btn btn-small organizar" data-banner-nome="<?php echo $posicao['BannerPosicao']['local_publicacao']; ?>"><i class="icon-edit"></i> Organizar</button>
				<button class="btn btn-small btn-primary salvar hide"><i class="icon-edit icon-white"></i> Salvar</button>
				<button class="btn btn-small cancelar hide"><i class="icon-remove"></i> Cancelar</button>
			</div>
		</div>
		<div class="box-content table-content table-<?php echo $posicao['BannerPosicao']['local_publicacao']; ?> control-listagem">

			<?php
			if ($total > 0) {
			?>	

			<table class="table table-generic-list table-banner" data-local="<?php echo $posicao['BannerPosicao']['local_publicacao']; ?>">

				<?php

				$res_banner = $this->requestAction(array(
	                'controller' => 'ShopBanner',
	                'action' => 'getAllLocal',
	                'local' => $posicao['BannerPosicao']['local_publicacao']
	            ));

				foreach ($res_banner as $key => $banner) {
		
				?>

				<tr class="inativo" id="<?php echo $banner['ShopBanner']['id_banner']; ?>" data-id="<?php echo $banner['ShopBanner']['id_banner']; ?>">
					<td class="check_box">
						<input type="checkbox" name="banners[]" value="<?php echo $banner['ShopBanner']['id_banner']; ?>" />
						<i class="icon-move" style="display:none;"></i>
					</td>
					<td class="preview-area">
						<a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/editar/<?php echo $banner['ShopBanner']['local_publicacao'] . '/'. $banner['ShopBanner']['id_banner']; ?>" class="preview">
						<i class="icon-eye-open"></i>
						<img src="<?php echo CDN_UPLOAD . $this->Session->read('id_shop') . '/banner/' . $banner['ShopBanner']['caminho']; ?>" alt="Imagem <?php echo $banner['ShopBanner']['nome']; ?>" class="img-polaroid" />
						</a>
					</td>
					<td class="nome">
						<a href="<?php echo VIALOJA_PAINEL ?>/recurso/banner/editar/<?php echo $banner['ShopBanner']['local_publicacao'] . '/'. $banner['ShopBanner']['id_banner']; ?>" target="_self" title="Editar banner" class="title">
						<span><?php echo $banner['ShopBanner']['nome']; ?></span><br/>
						<small>Posição: <?php echo \Lib\Tools::firstName( $banner['ShopBanner']['local_publicacao']); ?></small>
						</a>
					</td>
					<td class="ativo">
						<span class="status">

						<?php
						if ($banner['ShopBanner']['ativo'] == 'True') {
							echo '<span class="icon-custom icon-white icon-power"></span>Ativo</span>' . PHP_EOL;
						} else {
							echo '<span class="icon-custom icon-white icon-power off"></span>Inativo</span>' . PHP_EOL;
						}
						
						?>
						
					</td>
				</tr>

				<?php
				}
				?>

			</table>

			<?php
			} else {

				echo '<div style="text-align: center; padding: 5px;">Ainda não existe nenhum banner cadastrado.</div>';
			}
			?>

		</div>
	</div>

	<?php
	}
	?>

	<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
	<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
	<button type="submit" class="btn btn-danger">
	<i class="glyphicon glyphicon-trash"></i>
	Remover banners
	</button>
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