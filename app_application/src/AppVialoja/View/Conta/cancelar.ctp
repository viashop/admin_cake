
<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/conta/uso"><i class="icon-charging icon-custom"></i> Meu plano</a> <span class="bread-separator">-</span></li>
		<li><span>Cancelar uma cobrança</span></li>
	</ul>
</div>
<div class="row">
	<form action="<?php echo Router::url(); ?>" method="post">
		<div class="box">
			<div class="box-header">
				<h3>Cancelar cobrança</h3>
			</div>
			<div class="box-content">
				<div class="alert alert-info">
					<h4>ATENÇÃO</h4>
					Ao cancelar a cobrança, ela não será mais válida para pagamento.
					Caso você efetue ou tenha efetuado o pagamento de uma cobrança cancelada, ela não será identificada automaticamente pelo sistema. Caso seja necessário entre em contato conosco para tirar qualquer dúvida.
				</div>

				<?php

				/**
				*
				* Mensagem de cartão
				*
				**/

				/*<div class="alert alert-warning">
                    <h4>ATENÇÃO</h4>
                    Ao cancelar a cobrança, ela não será mais válida para pagamento.
                    
                </div>*/
				
				?>			
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Efetuar o cancelamento da cobrança</button>
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
				<a href="<?php echo VIALOJA_PAINEL ?>/conta/pagar/<?php echo $id_fatura; ?>" class="btn">Voltar para a página anterior</a>
			</div>
		</div>
	</form>
	<!-- /Full width content box -->
</div>