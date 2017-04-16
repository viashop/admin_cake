<?php
if (isset($flash_produto_excluido)) {

    if ($flash_produto_excluido > 1) {

		echo sprintf('<div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <h4>%d produtos foram removidos!</h4>
        </div>', $flash_produto_excluido);

    } else {

    	echo '<div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <h4>1 produto foi removido!</h4>
        </div>';    	

    }
}

/**
*
* Produtos recuperados
*
**/

if (isset($flash_produto_recuperado)) {

    if ($flash_produto_recuperado > 1) {

		echo sprintf('<div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <h4>%d produtos foram recuperados!</h4>
        </div>', $flash_produto_recuperado);

    } else {

    	echo '<div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <h4>1 produto foi recuperado!</h4>
        </div>';    	

    }
}
?>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/listar"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
		<li><span>Listar produtos removidos</span></li>
	</ul>
</div>
<h3>Lixeira de produtos</h3>

<form id="formulario-acao" action="/admin/catalogo/produto/remover/lixeira" method="post">
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="pull-left">
					<span class="check-container pull-left"><input type="checkbox" class="select_all" rel=".table" /></span>

					<span class="pull-left" style="min-width:300px;">			
                    <?php
                    echo $this->Paginator->counter(array(
                            'format' => '%count% produtos no total - <small>Página %page% de %pages%</small>'
                    ));

                    $total = $this->Paginator->counter(array('format' => '%count%'));
                    ?>
                	</span>

				</h3>
				<div class="box-widget pull-right">
					<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/listar" class="btn"><i class="icon-arrow-left"></i> Voltar para a lista de produtos</a>
				</div>
			</div>


			<?php
            if ($total <= 0 ) {
            ?>

            <div class="box-content">
                <p class="text-align-center">
                    Não existem produtos na lixeira.<br/>
                </p>
                
            </div>

            <?php
            } else {
            ?>

			<div class="box-content table-content">
				<table class="table table-produto table-generic-list">

					<?php
					foreach ($res_lista_produto as $key => $produto):

					if ($produto['ShopProduto']['ativo'] == 'True') {
						echo '<tr class="">' . PHP_EOL;
					} else {
						echo '<tr class="inativo">' . PHP_EOL;
					}	
					?>

						<td class="check_box">
							<input type="checkbox" name="produtos[]" value="<?php echo $produto['ShopProduto']['id_produto']; ?>" />
						</td>
						<td class="imagem">
							<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/editar/<?php echo $produto['ShopProduto']['id_produto']; ?>" target="_self" title="Editar Produto">
								<?php
						
								if (\Respect\Validation\Validator::notBlank()->validate($produto['ShopProdutoImagem']['nome_imagem'])) {

									echo sprintf( '<img src="%s/%d/produto/%d/small/%s" />',
									CDN_UPLOAD,
									$produto['ShopProduto']['id_shop_default'],
									$produto['ShopProduto']['id_produto'],
									$produto['ShopProdutoImagem']['nome_imagem']

									) . PHP_EOL;

								} else {
									echo '<img src="/admin/img/static-loja/produto-sem-imagem.gif" />' . PHP_EOL;
								}
								?>
							
							</a>
						</td>
						<td class="nome">
							<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/editar/<?php echo $produto['ShopProduto']['id_produto']; ?>" target="_self" title="Editar Produto" class="title">
							<?php
							if (!empty($produto['ShopProduto']['nome'])) {
								echo $produto['ShopProduto']['nome'];
							} else {
								echo 'None';
							}

							?>
							<br/>
							<small>
							SKU: <?php echo $produto['ShopProduto']['sku']; ?><br/>
							Tipo:

							<?php
							if ($produto['ShopProduto']['tipo'] == 'atributo') {
								echo 'Com opções' . PHP_EOL;
							} else {
								echo 'Normal' . PHP_EOL;	
							}
							?> 
							
							</small>
							</a>

							<?php 
							if ($produto['ShopProduto']['destaque'] == 'True') {

								echo '<p>
									<span class="badge badge-warning"><i class="icon-star icon-white"></i> Destaque</span>
								</p>' . PHP_EOL;

							}
							?>
						</td>

						<td class="preco">

						<?php
						if ($produto['ShopProduto']['preco_sob_consulta'] == 'True') {
							echo 'Preço sob consulta ';
						} else {

							$preco_cheio = \Lib\Tools::convertToDecimalBR($produto['ShopProduto']['preco_cheio']);
							$preco_promocional = \Lib\Tools::convertToDecimalBR($produto['ShopProduto']['preco_promocional']);

							if ($preco_cheio > 0 && $preco_promocional > 0) {

								echo sprintf('<strike>de R$ %s</strike><br/>
								por R$ %s', $preco_cheio, $preco_promocional);

							} elseif ($preco_cheio > 0 ) {
								echo sprintf('R$ %s', $preco_cheio);
							} else {
								echo '-';
							}

						}
						?>
		
						</td>

						<td class="ativo">
							<span class="status check">

							<?php
							if ($produto['ShopProduto']['ativo'] == 'True') {
								
								echo '<span class="icon-custom icon-white icon-power"></span>Ativo
							</span>' . PHP_EOL;
							
							} else {

								echo '<span class="icon-custom icon-white icon-power off"></span>Inativo
							</span>' . PHP_EOL;
							}
							?>

						</td>
						<td class="estoque">
							<span class="status none">
							<?php
							if ($produto['ShopProduto']['situacao_em_estoque'] == '0' ) {
								echo '<span class="icon-custom icon-white icon-check"></span>Disponível' . PHP_EOL;

							} else {

								echo '<span class="icon-custom icon-white icon-close"></span>Indisponível' . PHP_EOL;
							}
							?>

							<br/><small>em estoque</small>
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

		<?php if ($total > 0 ): ?>

		<div class="row-fluid">

			<div class="row-fluid">
				<div class="span8">
					<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
					<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
					<a class="btn btn-danger submit-form"><i class="glyphicon glyphicon-trash"></i> Remover produtos selecionados</a>

					&nbsp;&nbsp;&nbsp;&nbsp; <span class="text-muted">ou</span> &nbsp;&nbsp;&nbsp;
					
					<a class="btn submit-form recuperar"><i class="icon icon-ok-circle"></i> Recuperar selecionados</a>
				</div>
			</div>

			<div class="span8">
				<div class="pagination pagination-sm no-margin pull-right" style="margin: 0">
					<ul>
						<?php 
		                    echo $this->Paginator->numbers( array( 'modulus' => '2', 'tag' => 'li', 'first'=>'Início', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a', 'last'=>'Último'  ) );
		                ?>
					</ul>
				</div>
			</div>
		</div>

		<?php endif ?>

	</div>
</form>

