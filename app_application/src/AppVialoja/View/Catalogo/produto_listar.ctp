<?php
if (\Lib\Tools::getValue('q') !='') {
?>
<script type="text/javascript">
    $(document).ready(function (event) {
       	
		$('#q').val('<?php echo \Lib\Tools::getValue("q"); ?>');
		$('#filtros').val('<?php echo \Lib\Tools::getValue("filtro"); ?>');
		$('#listagem').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("listagem")); ?>');

    });
</script>

<?php
}


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
?>
<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/listar/"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
		<li><span>Listar produtos</span></li>
	</ul>
</div>
<form action="/admin/catalogo/produto/buscar" method="get">
	<div class="box">
		<div class="box-header">
			<h3>Filtrar produtos</h3>
		</div>
		<div class="box-content">
			<div class="control-group">
				<div class="controls form-inline">
					<input class="span5" type="text" id='q' name="q" value="" />
					<select name="listagem" id="listagem" class="span2">
						<option  value="alfabetica">Alfabetica</option>
						<option  value="ultimos_produtos">Últimos Produtos</option>
						<option  value="destaque">Destaque</option>
						<option  value="mais_vendidos">Mais vendidos</option>
					</select>
					<select name="filtro" id="filtros" class="span2">
						<option value="">- Filtro -</option>
						<option  value="ativo">Ativos</option>
						<option  value="inativo">Inátivos</option>
					</select>
					<button type="submit" class="btn btn-primary span2 pull-right"><i class="icon-white icon-search"></i> Filtrar</button>

					<?php
					if (\Lib\Tools::getValue('q') != '') {
						echo '<a class="btn btn-danger" href="/admin/catalogo/produto/listar"><span class="glyphicon glyphicon-remove"></span> Remover</a>'. PHP_EOL;
					}
					?>
					
				</div>
				<p class="help-block" style="margin: 5px 0 0 0">
					Use o campo acima para efetuar uma busca nos produtos. A busca é feita no nome, descrição, URL e código do produto.
				</p>
			</div>
		</div>
	</div>
	<input type="hidden" name="page" value="1" />
</form>

<?php
if (isset($q) && !empty($q)) {
	echo sprintf('<h3 style="color:#444; font-weight:normal; margin:-10px 0 10px 0">Produtos que contém o texto "%s"</h3>', $q ). PHP_EOL;
}
?>
<style type="text/css">
<!--
.sdsad{
	width: 
}
-->
</style>

<form id="formulario-acao" action="/admin/catalogo/produto/remover" method="post">
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3 class="pull-left">
					<span class="check-container pull-left"><input type="checkbox" class="select_all" rel=".table" /></span>
					<span class="pull-left">

                    <?php

                    if (\Lib\Tools::getValue('q') !='') {

	                    $this->Paginator->options(
							array('url'=> array(
								'controller' => 'catalogo',
								'action' =>'produto', 'buscar', 
								'?' => array(
										'q' => \Lib\Tools::getValue('q'),
										'listagem' => \Lib\Tools::getValue('listagem'),
										'filtro' => \Lib\Tools::getValue('filtro')
								 	)
								),
								'convertKeys' => array('page')
							)
						);

	                } else {

	                	$this->Paginator->options(
							array('url'=> array(
								'controller' => 'catalogo',
								'action' =>'produto', 'listar'),
								'convertKeys' => array('page')
							)
						);

	                }

                    $total = $this->Paginator->counter(array('format' => '%count%'));

                    if ($total ==1) {

                    	echo $this->Paginator->counter(array(
	                            'format' => '%count% produto no total - <small>Página %page% de %pages%</small>'
	                    ));

                    } else {
                    	echo $this->Paginator->counter(array(
	                            'format' => '%count% produtos no total - <small>Página %page% de %pages%</small>'
	                    ));

                    }                 
                    
                    ?>

	                </span>
	            </h3>
				<div class="box-widget pull-right">
					<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/lixeira/" class="btn"><i class="icon-trash"></i> Ver lixeira</a>
					<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/criar" class="btn btn-small btn-primary"><i class="icon icon-plus icon-white"></i> Criar produto</a>
				</div>
			</div>

			<?php
            if ($total <= 0 ) {
            ?>

            <div class="box-content">
                <p class="text-center">
                    Ainda não existe nenhum produto cadastrado.<br/>
                </p>
                <p class="text-center">
                    <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/criar" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus"></span> Criar o primeiro produto</a>
                </p>
                
            </div>

            <?php
            } else {
            ?>

			<div class="box-content table-content">
				<table class="table table-produto table-generic-list">

					<thead>
						<tr>
							<th></th>
							<th>Produto</th>
							<th></th>
							<th>Preço</th>
							<th>Status</th>
							<th>Estoque</th>
						</tr>
					</thead>

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
								echo '<strong>'. 'Com opções' .'</strong>' . PHP_EOL;
							} else {
								echo '<strong>'. 'Normal' .'</strong>' . PHP_EOL;
							}
						 

							echo '&nbsp; | &nbsp;Categoria: ';
							if (!empty($produto['ShopCategoria']['nome_categoria'])){ 
								echo '<strong>'. $produto['ShopCategoria']['nome_categoria'] .'</strong>' . PHP_EOL;
							} else {
								echo '<span class="text-info">Indefinida</span>';
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
						<td class="estoques">
							<?php
							if ($produto['ShopProduto']['tipo'] == 'atributo') {

								echo '<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/editar/'. $produto['ShopProduto']['id_produto'] .'#opcoes-produto" class="label label-info">
                                  Consultar variação
                                </a>' . PHP_EOL;

							} else {

								if ($produto['ShopProduto']['gerenciado'] == 'True' ) {

									if ($produto['ShopProduto']['quantidade'] <= 0) {

										echo '<span class="label label-error">
				                           		Indisponível
					    		        </span>' . PHP_EOL;

									} else {

										echo '<span class="label label-success">
				                                '. number_format( $produto['ShopProduto']['quantidade'] ) .'
					    		        </span>' . PHP_EOL;

					    		    }

								} else {
								
									if ($produto['ShopProduto']['situacao_em_estoque'] <= 0 ) {
										echo '<span class="label label-success">
				                                Disponível
					    		        </span>' . PHP_EOL;

									} else {

										echo '<span class="label label-error">
				                           		Indisponível
					    		        </span>' . PHP_EOL;
									}

								}

							}
							?>
							
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
		<div class="row-fluid">
			<div class="span8">
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
				<a class="btn btn-danger submit-form"><i class="glyphicon glyphicon-trash"></i> Mover produtos selecionados para lixeira</a>
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
		<hr>

		<div class="row-fluid">
			<h5>Uso: <?php echo $porcentagem_uso; ?>% cheio</h5>
			<p class="muted">
				Usando <?php echo $total_produto_uso; ?> de <?php 

				if (isset($produto_ilimitado) && $produto_ilimitado === true) {
					echo 'produtos ilimitados ativos';
				} else {
					echo $total_produto_plano . ' produtos ativos.';
				}
				?>
				 <br/>
				<a href="<?php echo VIALOJA_PAINEL ?>/loja/uso">Ver mais informações</a>
			</p>
		</div>
	</div>
</form>

