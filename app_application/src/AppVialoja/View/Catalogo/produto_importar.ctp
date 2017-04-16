<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/catalogo/produto/listar"><i class="icon-custom icon-cart"></i> Produtos</a> <span class="bread-separator">-</span></li>
		<li><span>Importar produtos</span></li>
	</ul>
</div>
<div class="pagina-importacao">
	<div class="box-section">
		<h3><i class="icon-circle-arrow-down"></i> Importar XLS <small>Serão importados até <?php

			if (isset($produto_ilimitado)) {

				if ($produto_ilimitado === true) {
					echo "<strong>Ilimitados</strong>";
				}

			} else {

				echo "<strong>". \Lib\Tools::convertToDecimalBR($total_liberado,0) ."</strong>";


			}

		?> produtos na sua conta.</small></h3>
		<div class="box-warning">
			<ul>
				<li><i class="icon-custom icon-big icon-check"></i><span>São suportados apenas arquivos no formato <strong>XLS</strong> e tamanho máximo de <strong>5 MB</strong></span></li>
				<li><i class="icon-custom icon-big icon-check"></i><span>Faça o download da <a href="<?php echo VIALOJA_PAINEL ?>/arquivo/produto/importar/modelo.xls"><i class="icon-file icon-custom"></i>Tabela modelo</a> é imprescindível que a sua tabela tenha os mesmos campos da tabela padrão.</span></li>

				<li>
					<i class="icon-custom icon-big icon-check"></i>
					<span>
					Caso o produto já exista na loja os dados da loja serão mantidos (utilizando o mesmo SKU).
					</span>
				</li>
			</ul>
		</div>
		<br>
		<form action="/admin/catalogo/produto/importar/validacao" method="POST" enctype="multipart/form-data" class="custom-box importar-xls">
			<button type="submit" class="btn btn-success  pull-right span3" id="processando"><i class="icon-white icon-circle-arrow-up"></i> Importar produtos</button>
			<div class="escolher-arquivo">
				<input id="id_arquivo" name="arquivo" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/x-xls" />
			</div>
			<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
		</form>
	</div>
	<hr />
	<div class="box-section">
		<h3><i class="icon-circle-arrow-down"></i> Atualizar XLS</h3>
		<div class="box-warning">
			<ul>
				<li><i class="icon-custom icon-big icon-check"></i><span>São suportados apenas arquivos no formato <strong>XLS</strong> e tamanho máximo de <strong>5 MB</strong></span></li>
				<li><i class="icon-custom icon-big icon-check"></i><span>Faça o download da sua <a href="<?php echo VIALOJA_PAINEL ?>/arquivo/produto/atualizar/arquivo.xls"><i class="icon-file icon-custom"></i>Tabela modelo</a>. <strong>Atenção, o modelo de atualização é diferente do modelo de importação</strong>.</span></li>
				<li><i class="icon-custom icon-big icon-check"></i><span>Para atualizar os dados do produto não altere o <strong>SKU.</strong></span></li>
			</ul>
		</div>
		<br>
		<form action="/admin/catalogo/produto/importar/validacao" method="POST" enctype="multipart/form-data" class="custom-box importar-xls">
			<button type="submit" class="btn btn-success  pull-right span3" id="processando"><i class="icon-white icon-circle-arrow-up"></i> Atualizar produtos</button>
			<div class="escolher-arquivo">
				<input type="hidden" name="atualizar" value="True" />
				<input id="id_arquivo" name="arquivo" type="file" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/x-xls" />
			</div>
			<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
			<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
		</form>
	</div>
	<hr>
	<div class="box-section">
		<h3><i class="icon-circle-arrow-down"></i> Importar do Mercado Livre</h3>
	</div>
	<div class="custom-box importar-mercado-livre">
		<div class="row-fluid">
			<div class="span3">
				<img src="/admin/img/recurso/mercadolivre.gif" alt="Mercado livre" style="width: 150px" />
			</div>
			<div class="span5">
				<small class='muted'>Importe seus produtos e outros produtos direto do MercadoLivre!</small>
			</div>
			<?php
			/*
			<a class='btn btn-success pull-right span3' href="/admin/catalogo/produto/mercadolivre/listar/"><i class="icon-circle-arrow-down icon-white"></i> Importar do MercadoLivre</a>

			*/
			?>
			<a class='btn btn-success pull-right span3' href="javascript:;" onclick="return alert('Importação via Mercado Livre em desenvolvimento.');"><i class="icon-circle-arrow-down icon-white"></i> Importar do MercadoLivre</a>
		</div>
	</div>
</div>
