<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="#"><i class="icon-graph icon-custom"></i>Marketing</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/recurso/newsletter/assinatura/listar"><i class="icon-envelope icon-custom"></i> Newsletter</a> <span class="bread-separator">-</span></li>
		<li><span>Listar assinaturas</span></li>
	</ul>
</div>
<div class="row">
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">
				Email Marketing
			</h3>
		</div>
		<div class="box-content">
			<div class="emkt-export">
				<p class="text">Emails para exportação:</p>
				<div class="alert alert-block"><strong>7</strong></div>
				<div class="">
					<a href="<?php echo VIALOJA_PAINEL ?>/recurso/newsletter/assinatura/exportar.csv" class="btn btn-small btn-primary"><i class="icon-download-alt icon-white"></i> Exportar em formato CSV</a>
					<a href="<?php echo VIALOJA_PAINEL ?>/recurso/newsletter/assinatura/exportar.txt" class="btn btn-small btn-primary"><i class="icon-download-alt icon-white"></i> Exportar em formato TXT</a>
				</div>
			</div>
			<hr />
			<p class="text-center">Utilize um dos nossos <a href="<?php echo VIALOJA_PAINEL ?>/recurso/parceiros">parceiros</a> de Email marketing para realizar o envio dos emails.</p>
		</div>
	</div>
	<div class="box">
		<div class="box-header">
			<h3 class="pull-left">
				Link para descadastramento
			</h3>
		</div>
		<div class="box-content">
			<p>Caso necessite, utilize o padrão do link abaixo para realizar o descadastramento dos emails:</p>
			<p>http://<?php echo $url_shop; ?>/newsletter/unsubscribe/<strong>EMAIL_CLIENTE</strong></p>
		</div>
	</div>
</div>
