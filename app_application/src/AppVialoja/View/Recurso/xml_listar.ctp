
<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/xml/listar"><i class="icon-check"></i> Comparadores de preço</a> <span class="bread-separator">-</span></li>
		<li><span>Listar comparadores</span></li>
	</ul>
</div>
<div class="alert alert-info">
	<div class="title">
		<h5 class="pull-left">Como funcionam os comparadores:</h5>
	</div>
	<p>
		&nbsp;&nbsp;Os comparadores de preços são ferramentas muito importante para que a sua loja venda mais.
		São Ferramentas que cadastram produtos, de diferentes lojas do mesmo ramo, para que os
		clientes possam comparar os preços entre elas.
	</p>
	<p>
		<strong>Para colocar os produtos da sua loja em um comparador de preço,
		é preciso se cadastrar na ferramenta de comparação e informá-los o link do seu arquivo XML.</strong>
	</p>
	<p>
		Abaixo temos os comparadores que trabalhamos.
	</p>
</div>
<div class="row xml xml-listar">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">
				Comparadores
				<a href="http://vialoja.com.br/comunidade/hc/pt-br/articles/200383214" title="Artigo Configurando comparadores de preço" target="_blank" class="link_ext">
				<i class="icon-share"></i>
				</a>
			</h3>
		</div>
		<div class="box-content table-content">
			<table class="table table-generic-list table-xml">

				<?php
				foreach ($result AS $key => $obj) {

					//<tr class="">
				?>
				<tr class="inativo">
					<td class="image">
						<img src="/admin/img/comparadores-de-preco/<?php echo $obj['Comparador']['img']; ?>" alt="<?php echo $obj['Comparador']['nome']; ?>" />
					</td>
					<td>
						<p>
							<b><?php echo $obj['Comparador']['nome']; ?></b>
						</p>
						<p>

							<?php
							if (!empty($obj['Comparador']['url'])) {
							
							?>
							<small>Cadastre-se no <a href="<?php echo $obj['Comparador']['url']; ?>" title="Página de cadastro <?php echo $obj['Comparador']['nome']; ?>" target="_blank"><?php echo $obj['Comparador']['nome']; ?></a>.</small>

							<?php
							}
							?>
						<p>
							<a href="<?php echo VIALOJA_PAINEL ?>/recurso/xml/editar/<?php echo $obj['Comparador']['id']; ?>" title="Configurações <?php echo $obj['Comparador']['nome']; ?>" class="btn">Configurar</a>
					</td>
				</tr>

				<?php
				}
				?>
				
			</table>
		</div>
	</div>
</div>
