<style type="text/css">
<!--
input[type="checkbox"]{
    margin-top: -5px !important;
}

.help-block {
    margin-top: -8px !important;
}

-->
</style>
<script type="text/javascript">
	$(document).ready(function(event) {
		$('#id_nome').parents('.control-group').hide();
		$('#id_imagem').parents('.control-group').hide();
		$('.banco').change(function(event) {
			event.preventDefault();
			if ($(this).val() == 'outro') {
				$('#id_nome').parents('.control-group').slideDown();
				$('#id_imagem').parents('.control-group').slideDown();
			} else {
				$('#id_nome').parents('.control-group').slideUp();
				$('#id_imagem').parents('.control-group').slideUp();
			}
	
		});
		$('#outro_banco').change(function(event) {
			$('.banco').parent().fadeToggle();
			$('#id_nome').parents('.control-group').slideToggle();
			$('#id_imagem').parents('.control-group').slideToggle();
		});
	
		// Somente exibe variacao quando for banco Caixa.
		
		$('.somente-caixa').show();
		
	});
</script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/listar"><i class="icon-custom icon-dollar"></i> Formas de pagamento</a> <span class="bread-separator">-</span></li>
		<li><span>Configurando bancos para depósito</span></li>
	</ul>
</div>
<form action="<?php echo Router::url(); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
  

	<div class="box">
		<div class="box-header">
			<h3>
				Editar banco <?php echo $banco['Bancos']['nome']; ?> para Depósito Bancário
			</h3>
		</div>
		<div class="box-content">
			<div class="control-group">
				<div class="controls">
					<h4>
						<img src="/admin/img/formas-de-pagamento/<?php echo $banco['Bancos']['logo'] .'.png'; ?>" alt="<?php echo $banco['Bancos']['nome']; ?>" style="max-width: 24px; max-height: 24px; border-radius: 3px;" />
						<?php echo $banco['Bancos']['numero'] . ' - '. $banco['Bancos']['nome']; ?>
					</h4>
				</div>
			</div>

			<div class="control-group">
				<label for="ativo" class="control-label"><strong>Banco ativo?</strong></label>
				<div class="controls">
					<select class="input-small" id="id_ativo" name="ativo">
					
					<?php 
						if (\Lib\Validate::isPost()) {
						?>	
							<option value="True" <?php if (!(strcmp("True", \Lib\Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Sim</option>
                        	<option value="False" <?php if (!(strcmp("False", \Lib\Tools::getValue("ativo")))) {echo 'selected="selected"';} ?>>Não</option>

						<?php
						} elseif (isset($config['ShopPagamentoDepositoConfig']['ativo'])) {
						?>	
							<option value="True" <?php if (!(strcmp("True", $config['ShopPagamentoDepositoConfig']['ativo']))) {echo 'selected="selected"';} ?>>Sim</option>
	                        <option value="False" <?php if (!(strcmp("False", $config['ShopPagamentoDepositoConfig']['ativo']))) {echo 'selected="selected"';} ?>>Não</option>
						<?php
						} else {
						?>	
							<option value="True" selected="selected">Sim</option>
	                        <option value="False">Não</option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			<hr>
			<?php
            $error = null;
            if (isset($error_agencia)) {
                $error='error';
            }
            ?>
			<div class="control-group <?php echo $error; ?>">
				<label for="id_agencia" class="control-label">
				<strong>Agência</strong>
				</label>
				<div class="controls">
					<input class="input-medium span3" id="id_agencia" maxlength="11" name="agencia" type="text" value="<?php

					if (\Lib\Validate::isPost()) {
						echo \Lib\Tools::getValue('agencia');
					} elseif (isset($config['ShopPagamentoDepositoConfig']['agencia'])) {
						echo $cipher->decrypt($config['ShopPagamentoDepositoConfig']['agencia']);
					}

					?>" />

					<?php
                    if (isset($error_agencia)) {
                        echo '<ul class="errorlist"><li>Por favor, informe o número da Agência Bancária.</li></ul>' . PHP_EOL;
                    }
                    ?>
				</div>
			</div>
			<hr>
			<?php
            $error = null;
            if (isset($error_numero_conta)) {
                $error='error';
            }
            ?>
			<div class="control-group <?php echo $error; ?>">
				<label for="id_numero_conta" class="control-label">
				<strong>Conta</strong>
				</label>
				<div class="controls">
					<input class="input-medium span3" id="id_numero_conta" maxlength="11" name="numero_conta" type="text" value="<?php

					if (\Lib\Validate::isPost()) {
						echo \Lib\Tools::getValue('numero_conta');
					} elseif (isset($config['ShopPagamentoDepositoConfig']['numero_conta'])) {
						echo $cipher->decrypt($config['ShopPagamentoDepositoConfig']['numero_conta']);
					}
					?>" />
					<?php
                    if (isset($error_numero_conta)) {
                        echo '<ul class="errorlist"><li>Por favor, informe o número da conta.</li></ul>' . PHP_EOL;
                    }
                    ?>
				</div>
			</div>
			<hr>
			<div class="control-group ">
				<div class="controls">
					<label class="checkbox">
					<input id="id_poupanca" name="poupanca" type="checkbox" <?php 

					if (\Lib\Validate::isPost()) {
						if (\Lib\Tools::getValue('poupanca') =='on'){
							echo 'checked="checked"';
						}
					} elseif (isset($config['ShopPagamentoDepositoConfig']['poupanca'])) {
						if ($config['ShopPagamentoDepositoConfig']['poupanca'] =='on') {
							echo 'checked="checked"';
						}
					}
					?> />
					<strong>Conta poupança?</strong>
					</label>
				</div>
			</div>

			<?php if ( $banco['Bancos']['numero'] =='104'): ?>
			<hr>	
			
			<div class="control-group  somente-caixa hide ">
				<label for="id_operacao" class="control-label">
				<strong>Operação</strong>
				</label>
				<div class="controls">

					<select class="input-small span5" id="id_operacao" name="operacao">

						<?php 

						foreach ($res_bancos_config as $key => $operacao):

							$selected = '';
							if (\Lib\Validate::isPost()) {
								if (!(strcmp( \Lib\Tools::getValue('operacao'), $operacao['BancosConfiguracao']['numero_operacao']))) {
								    // Set the $checked string
								    $selected = "selected='selected'";
								}
							} else {
								if (!(strcmp( $config['ShopPagamentoDepositoConfig']['operacao'], $operacao['BancosConfiguracao']['numero_operacao']))) {
								    // Set the $checked string
								    $selected = "selected='selected'";
								}
							}

							echo '<option value="'. $operacao['BancosConfiguracao']['numero_operacao'] .'" '. $selected .'>'. $operacao['BancosConfiguracao']['numero_operacao'] .' - '. $operacao['BancosConfiguracao']['nome_operacao'] .'</option>' . PHP_EOL;					

						endforeach;

						?>
					</select>

				</div>
			</div>

			<?php endif ?>
			<hr>
			<?php
            $error = null;
            if (isset($error_cpf_cnpj)) {
                $error='error';
            }
            ?>
			<div class="control-group <?php echo $error;?>">
				<label for="id_cpf_cnpj" class="control-label">
				<strong>CPF ou CNPJ</strong>
				</label>
				<div class="controls">
					<input class="input-medium span4" id="id_cpf_cnpj" maxlength="18" name="cpf_cnpj" type="text" value="<?php

					if (\Lib\Validate::isPost()) {
						echo \Lib\Tools::getValue('cpf_cnpj');
					} elseif (isset($config['ShopPagamentoDepositoConfig']['cpf_cnpj'])) {
						echo $cipher->decrypt($config['ShopPagamentoDepositoConfig']['cpf_cnpj']);
					}

					?>" />
					<?php
                    if (isset($error_cpf)) {
                    	echo '<ul class="errorlist"><li>Este CPF é inválido.</li></ul>' . PHP_EOL;
                    } elseif (isset($error_cnpj)) {
                    	 echo '<ul class="errorlist"><li>Este CNPJ é inválido.</li></ul>' . PHP_EOL;
                    } elseif (isset($error_cpf_cnpj)) {
                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                    }
                    ?>
				</div>
			</div>
			<hr>
			<?php
            $error = null;
            if (isset($error_favorecido)) {
                $error='error';
            }
            ?>
			<div class="control-group <?php echo $error;?>">
				<label for="id_favorecido" class="control-label">
				<strong>Favorecido</strong>
				</label>
				<div class="controls">
					<input class="input-medium span6" id="id_favorecido" maxlength="256" name="favorecido" type="text" value="<?php

					if (\Lib\Validate::isPost()) {
						echo \Lib\Tools::getValue('favorecido');
					} elseif (isset($config['ShopPagamentoDepositoConfig']['favorecido'])) {
						echo $cipher->decrypt($config['ShopPagamentoDepositoConfig']['favorecido']);
					}

					?>" />

					<?php
					if (isset($error_nome_favorecido)) {
						 echo '<ul class="errorlist"><li>Por favor, informe o nome do favorecido corretamente.</li></ul>' . PHP_EOL;
					} elseif (isset($error_favorecido)) {
                        echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
                    }
                    ?>
				</div>
			</div>
		</div>
		<div class="form-actions">

			<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
            <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />

			<button class="btn btn-primary" type="submit">
			<i class="icon-ok icon-white"></i>
			Salvar
			</button>
			<a href="<?php echo VIALOJA_PAINEL ?>/configuracao/pagamento/configuracao/editar/7" title="Cancelar cadastro do banco" class="btn"><i class="icon-remove"></i>Cancelar</a>
		</div>
	</div>
</form>
