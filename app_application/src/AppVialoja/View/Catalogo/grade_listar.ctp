<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><i class="icon-th"></i> <a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/listar">Grades</a> <span class="bread-separator">-</span></li>
		<li><span>Listar grades</span></li>
	</ul>
</div>
<div class="alert alert-info">
	<h3>Grades para o produto</h3>
	<p>Aqui você deverá criar as grades que irá usar nos seus produtos.</p>
	<p><strong>Uma grade define o tipo de opção que o cliente escolherá, por exemplo: Cor, Tamanho, Tensão.</strong> Depois de criar as grades para um produto você definirá os valores, por exemplo: Amarelo, Azul e Verde para Cor; P, M e G para Tamanho; 110v e 220v para Tensão.</p>
</div>
<div class="row">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">
				<?php
				echo count($res_grade) . ' grades';
				?>
			</h3>
			<div class="box-widget pull-right">
				<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/criar" class="btn btn-small btn-primary"><i class="icon-plus icon-white"></i> Criar grade</a>
			</div>
		</div>
		<div class="box-content  table-content">
			<table class="table table-generic-list table-grade">

				<?php
				foreach ($res_grade as $key => $grade):
				?>
				<tr class="ativo">
					<td style="width: 1px;"> </td>
					<td class="nome" style="width: 60%">

						<?php
						if ($grade['ShopGrade']['default'] != 1) {
						?>

						<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/editar/<?php echo $grade['ShopGrade']['id_grade']; ?>" target="_self" title="Editar grade" class="title ">

						<?php
						}

						echo $grade['ShopGrade']['nome'];

						if (!empty($grade['ShopGrade']['tipo'])) {
							echo ' <strong class="muted">'. $grade['ShopGrade']['tipo'] .'</strong>'. PHP_EOL;
						}
						?>
						
						<br/>
						<small>
						<?php

						$dados = $this->requestAction(
			                array(
			                    'controller' => 'ShopGradeVariacao',
			                    'action' => 'getVariacoesGrade',
			                    'id' => $grade['ShopGrade']['id_grade']
			                )
			            );


			            if ( \Respect\Validation\Validator::notBlank()->validate( $dados ) ) {

			            	$count = count($dados);
				            foreach ($dados as $key => $valor) {

				            	$key=$key+1;
				            	if ($key !== $count ) {
				            		echo $valor . ', ';
				            	} else {
				            		echo $valor;
				            	}
				            	
				            }

				        }
			            ?>
						
						</small>

						<?php
						if ($grade['ShopGrade']['default'] != 1) {
							echo '</a>'. PHP_EOL;
						}
						?>
					</td>
					<td style="vertical-align: middle;">
						<span class="label">
							<?php

			                $total_vinculado = $this->requestAction(
				                array(
				                    'controller' => 'ShopProdutoGrade',
				                    'action' => 'getTotalGradeVinculado',
				                    'id_grade' => $grade['ShopGrade']['id_grade']
				                )
				            );

				            if ($total_vinculado == '1' ) {
				            	echo $total_vinculado .' produto vinculado';
				            }  else {
				            	echo $total_vinculado .' produtos vinculados';
				            }

							?>

							</span>
					</td>

					<td class="actions text-align-right">
						<?php
						if ($grade['ShopGrade']['default'] != 1) {
						?>
							<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/editar/<?php echo $grade['ShopGrade']['id_grade']; ?>" class="btn btn-mini"><i class="icon-edit"></i> Editar</a>
							<a href="<?php echo VIALOJA_PAINEL ?>/catalogo/grade/remover/<?php echo $grade['ShopGrade']['id_grade']; ?>" class="btn btn-danger btn-mini"><i class="glyphicon glyphicon-trash"></i> Remover</a>
						<?php
						}
						?>
					</td>
					<td style="width: 1px;"> </td>

				</tr>

				<?php
				endforeach;
				?>

			</table>
		</div>
	</div>
</div>
