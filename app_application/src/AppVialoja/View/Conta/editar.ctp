<?php
$id_cidade = 0;
if (\Lib\Validate::isPost()) {
	$id_cidade = \Lib\Tools::getValue("endereco_cidade");
} elseif (isset($dados['ShopConta']['endereco_cidade']) 
	&& $dados['ShopConta']['endereco_cidade'] !== 0 ) {
	$id_cidade = $dados['ShopConta']['endereco_cidade'];
}
?>

<script type='text/javascript'>
	CIDADE_PADRAO = '<?php echo $id_cidade;?>';
	$(document).ready(function(){
		$('#id_endereco_cep').mask('99999-999');
	
		$('#id_tipo').change(function(event){
			if($(this).val() == 'PF'){
				$('#id_razao_social').parents('.control-group').hide();
				$('#id_razao_social').attr('disabled', 'disabled');
	
				$('#id_cnpj').parents('.control-group').hide();
				$('#id_cnpj').attr('disabled', 'disabled');
	
				$('#id_cpf').parents('.control-group').show();
				$('#id_cpf').removeAttr('disabled');
				$('#id_cpf').mask('999.999.999-99');
			}else{
				$('#id_cpf').parents('.control-group').hide();
				$('#id_cpf').attr('disabled');
	
				$('#id_cnpj').parents('.control-group').show();
				$('#id_cnpj').removeAttr('disabled');
	
				$('#id_razao_social').parents('.control-group').show();
				$('#id_razao_social').removeAttr('disabled');
	
				$('#id_cnpj').mask('99.999.999/9999-99');
			}
		}).change();
	
		$('#id_forma_pagamento').change(function(event){
			if($(this).val() == 'boleto') {
				$('#pagarBoleto').slideDown();
				$('#pagarCartao').slideUp();
			} else if ($(this).val() == 'cartao_credito') {
				$('#pagarCartao').slideDown();
				$('#pagarBoleto').slideUp();
			}
		}).change();
	
		$('.btn-editar-cartao-credito').click(function() {
			$('#visualizar-cartao-credito').slideToggle();
			$('#form-cartao-credito').slideToggle();
			if ($('#form-cartao-credito').is(':visible')) {
				$('[name=editar_cartao]').removeAttr('disabled');
			} else {
				$('[name=editar_cartao]').attr('disabled', 'disabled');
			}
			return false;
		});
	
		var timer;
		$(document).on('keyup', '#id_numero', function() {
			var self = $(this);
			var pai = $('#id_numero').parents('.control-group');
			clearTimeout(timer);
			timer = setTimeout(function() {
				numero = self.val();
				if (numero.length >= 13 && numero.length <= 16 && numero.search(/\*/) >= 0) {
					// O número ainda pode ser válido pois parece ser um
					// número não editado.
					return false;
				}
	
				pai.find('.errorlist').remove();
				if (!validar_cartao_credito(numero)) {
					pai.addClass('error').removeClass('success');
	
					var span = '<ul class="errorlist"><li>O número do cartão de crédito é inválido. Insira um número válido.</li></ul>';
					pai.children('.controls').append(span);
				} else {
					pai.removeClass('error').addClass('success');
				}
			}, 1000);
		});
	
		var loading_cidades = function() {
			var pai = $('#id_cidade_ibge');
			pai.find('option').remove();
		}
	
		var remover_loading_cidades = function() {
			var pai = $('#id_cidade_ibge');
			pai.find('option').remove();
			pai.removeAttr('disabled');
		}
	
		var atualizar_cidades = function(cidades) {
			remover_loading_cidades();
			var pai = $('#id_cidade_ibge');
			pai.find('option').remove();
			$.each(cidades, function(i, e) {
				if(CIDADE_PADRAO == e.id_ibge) {
					pai.append(
						$('<option>').attr({'value': 'e.id_ibge'}).html(e.nome).attr('selected', 'selected')
					);
				} else {
					pai.append(
						$('<option>').attr({'value': e.id_ibge}).html(e.nome)
					);
				}
			});
		}
	
		$('#id_estado').change(function() {
			var self = $(this);
			var uf = self.val();
			loading_cidades();
			if (uf != '--') {
				$.post('/admin/cidades/getCidadeId/' + uf + '.json', {}, function(data) {
					if (data.estado == 'SUCESSO') {
						atualizar_cidades(data.cidades, 0);
						return false;
					} else {
						remover_loading_cidades();
					}
				}, 'json');
			}
		}).change();

		$('#fomulario-endereco').submit(function(event) {
			var nome_cidade = $('#id_cidade_ibge').find('option:selected').text();
			$('#id_cidade').val(nome_cidade);

		});
	});
</script>

<?php
if (\Lib\Validate::isPost()) {

?>
<script type="text/javascript">
    $(document).ready(function (event) {
       	
		$('#id_email_nota_fiscal').val('<?php echo \Lib\Tools::getValue("email_nota_fiscal"); ?>');
		$('#id_nome_responsavel').val('<?php echo \Lib\Tools::getValue("nome_responsavel"); ?>');
		$('#id_razao_social').val('<?php echo \Lib\Tools::getValue("razao_social"); ?>');
		$('#id_cpf').val('<?php echo \Lib\Tools::getValue("cpf"); ?>');
		$('#id_cnpj').val('<?php echo \Lib\Tools::getValue("cnpj"); ?>');
		$('#id_telefone_principal').val('<?php echo \Lib\Tools::getValue("telefone_principal"); ?>');
		$('#id_telefone_celular').val('<?php echo \Lib\Tools::getValue("telefone_celular"); ?>');
		$('#id_endereco_logradouro').val('<?php echo \Lib\Tools::getValue("endereco_logradouro"); ?>');
		$('#id_endereco_complemento').val('<?php echo \Lib\Tools::getValue("endereco_complemento"); ?>');
		$('#id_endereco_bairro').val('<?php echo \Lib\Tools::getValue("endereco_bairro"); ?>');
		$('#id_endereco_cep').val('<?php echo \Lib\Tools::getValue("endereco_cep"); ?>');
		$('#id_numero').val('<?php echo \Lib\Tools::getValue("numero"); ?>');
		$('#id_nome').val('<?php echo \Lib\Tools::getValue("nome"); ?>');
		$('#id_cvv').val('<?php echo \Lib\Tools::getValue("cvv"); ?>');
		$('#id_mes_expiracao').val('<?php echo \Lib\Tools::getValue("mes_expiracao"); ?>');
		$('#id_ano_expiracao').val('<?php echo \Lib\Tools::getValue("ano_expiracao"); ?>');

    });
</script>

<?php
}
?>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/conta/uso"><i class="icon-charging icon-custom"></i> Meu plano</a> <span class="bread-separator">-</span></li>
		<li><span>Dados da conta</span></li>
	</ul>
</div>

<div class="row">

	<div class="box">

		<form action="<?php echo Router::url(); ?>" method="post" class="form-horizontal">

			<div class="box-header">
				<h3>Dados para cobrança</h3>
			</div>
			<div class="box-content">
				<div class="control-group">
					<p>Para que a cobrança de seu plano seja realizada, precisamos que preencha corretamente os campos abaixo para a emissão da nota fiscal e avalidação do pagamento.</p>
				</div>
				<div class="control-group ">
					<label class="control-label">
					<strong>* Tipo de conta</strong>
					</label>
					<div class="controls">
						
						<select id="id_tipo" name="tipo">

							<?php
							if (\Lib\Validate::isPost()) {
							?>

							<option value="PF" <?php if (!(strcmp("PF", \Lib\Tools::getValue('tipo')))) {echo 'selected="selected"';} ?>>Pessoa Física</option>
							<option value="PJ" <?php if (!(strcmp("PJ", \Lib\Tools::getValue('tipo')))) {echo 'selected="selected"';} ?>>Pessoa Jurídica</option>

							<?php
							} elseif(isset($dados['ShopConta']['tipo'])) {
							?>

							<option value="PF" <?php if (!(strcmp("PF", $dados['ShopConta']['tipo']))) {echo 'selected="selected"';} ?>>Pessoa Física</option>
							<option value="PJ" <?php if (!(strcmp("PJ", $dados['ShopConta']['tipo']))) {echo 'selected="selected"';} ?>>Pessoa Jurídica</option>

							<?php
							} else {
							?>

							<option value="PF" selected="selected">Pessoa Física</option>
							<option value="PJ">Pessoa Jurídica</option>

							<?php
							}
							?>

						</select>
						<p class="help-block">Para sabermos se você é uma empresa ou pessoa física.</p>
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_email)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					<strong>* Email para recebimento da nota fiscal</strong>
					</label>
					<div class="controls">
						<input class="span5" id="id_email_nota_fiscal" maxlength="128" name="email_nota_fiscal" type="email" value="<?php

						if (isset($dados['ShopConta']['email_nota_fiscal'])) {

							echo $dados['ShopConta']['email_nota_fiscal'];
							
						} else {
							echo $this->Session->read('cliente_email');
						}

						?>" />
						<p class="help-block">Não pode conter: letras acentuadas ou sublinhado (_). Se o seu email contém sublinhado você não poderá usá-lo.</p>
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_nome_responsavel)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					<strong>* Nome do Responsável</strong>
					</label>
					<div class="controls">
						<input id="id_nome_responsavel" maxlength="128" name="nome_responsavel" type="text" value="<?php 

									if (isset($dados['ShopConta']['nome_responsavel'])) {
										echo $dados['ShopConta']['nome_responsavel'];
									}
									?>" />
						<?php
						if (isset($error_logradouro)) {
							echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
						}
						?>
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_razao_social)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					<strong>* Razão Social</strong>
					</label>
					<div class="controls">
						<input id="id_razao_social" maxlength="128" name="razao_social" type="text" value="<?php 

									if (isset($dados['ShopConta']['razao_social'])) {
										echo $dados['ShopConta']['razao_social'];
									}
									?>" />
						<?php
						if (isset($error_razao_social)) {
							echo '<ul class="errorlist"><li>CPF é um campo requerido quando o tipo é Pessoa Jurídica.</li></ul>'. PHP_EOL;
						}
						?>
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_cpf)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					<strong>* CPF</strong>
					</label>
					<div class="controls">
						<input id="id_cpf" maxlength="14" name="cpf" type="text" value="<?php 

									if (isset($dados['ShopConta']['cpf'])) {
										echo $cipher->decrypt($dados['ShopConta']['cpf']);
									}
									?>" />
						

						<?php
						if (isset($error_cpf_invalido)) {
							echo '<ul class="errorlist"><li>Este CPF é inválido.</li></ul>'. PHP_EOL;
						} elseif (isset($error_cpf)) {
							echo '<ul class="errorlist"><li>CPF é um campo requerido quando o tipo é Pessoa Jurídica.</li></ul>'. PHP_EOL;
						}
						?>
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_cnpj)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					<strong>* CNPJ</strong>
					</label>
					<div class="controls">
						<input id="id_cnpj" name="cnpj" type="text" value="<?php 

									if (isset($dados['ShopConta']['cnpj'])) {
										echo $cipher->decrypt($dados['ShopConta']['cnpj']);
									}
									?>" />
						<?php
						if (isset($error_cnpj_invalido)) {
							echo '<ul class="errorlist"><li>Este CNPJ é inválido.</li></ul>'. PHP_EOL;
						} elseif (isset($error_cnpj)) {
							echo '<ul class="errorlist"><li>CNPJ é um campo requerido quando o tipo é Pessoa Jurídica.</li></ul>'. PHP_EOL;
						}
						?>
					</div>
				</div>
				<div class="control-group ">
					<label class="control-label">
					Telefone fixo
					</label>
					<div class="controls">
						<input class="span2" id="id_telefone_principal_default" name="telefone_principal" type="text" value="<?php 

									if (isset($dados['ShopConta']['telefone_principal'])) {
										echo $dados['ShopConta']['telefone_principal'];
									}
									?>" />
					</div>
				</div>
				<div class="control-group ">
					<label class="control-label">
					Telefone celular
					</label>
					<div class="controls">
						<input class="span2" id="id_telefone_celular_default" name="telefone_celular" type="text" value="<?php 

									if (isset($dados['ShopConta']['telefone_celular'])) {
										echo $dados['ShopConta']['telefone_celular'];
									}
									?>" />
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_logradouro)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					<strong>* Endereço</strong>
					</label>
					<div class="controls">
						<input class="span5" id="id_endereco_logradouro" maxlength="120" name="endereco_logradouro" type="text" value="<?php 

									if (isset($dados['ShopConta']['endereco_logradouro'])) {
										echo $dados['ShopConta']['endereco_logradouro'];
									}
									?>" />

						<?php
						if (isset($error_logradouro)) {
							echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
						}
						?>
					</div>
				</div>
				<div class="control-group ">
					<label class="control-label">
					Complemento
					</label>
					<div class="controls">
						<input class="span3" id="id_endereco_complemento" maxlength="120" name="endereco_complemento" type="text" value="<?php 

									if (isset($dados['ShopConta']['endereco_complemento'])) {
										echo $dados['ShopConta']['endereco_complemento'];
									}
									?>" />
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_bairro)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					<strong>* Bairro</strong>
					</label>
					<div class="controls">
						<input class="span3" id="id_endereco_bairro" maxlength="32" name="endereco_bairro" type="text" value="<?php 

									if (isset($dados['ShopConta']['endereco_bairro'])) {
										echo $dados['ShopConta']['endereco_bairro'];
									}
									?>" />
						<?php
						if (isset($error_bairro)) {
							echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
						}
						?>
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_cep)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					<strong>* CEP (só números)</strong>
					</label>
					<div class="controls">
						<input class="span3" id="id_endereco_cep" name="endereco_cep" type="text" value="<?php 

									if (isset($dados['ShopConta']['endereco_cep'])) {
										echo $dados['ShopConta']['endereco_cep'];
									}
									?>" />
						<?php
						if (isset($error_cep)) {
							echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
						}
						?>
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_estado)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					<strong>* Estado</strong>
					</label>
					<div class="controls">

						<select id="id_estado" name="endereco_estado">
										
							<?php

	                        foreach ($estados as $key => $estado) {


	                        	$estado_id=null;

								if (\Lib\Validate::isPost()) {

									$estado_id = \Lib\Tools::getValue('endereco_estado');

								} else {

									if (isset($dados['ShopConta']['endereco_estado'])) {
										$estado_id = $dados['ShopConta']['endereco_estado'];
									}

								}


	                            if (!(strcmp( $estado_id, $estado['Estados']['codigo_ibge']))) {
	                                // Set the $checked string
	                                $selected = "selected='selected'";
	                            } else {
	                                $selected = "";
	                            }

	                            if(isset($error_estado)){

	                        		$selected = "";
	                        	}

	                            if ($key <= 0 ) {
	                            	echo sprintf('<option value="--" %s>--</option>', $selected );
	                            }

	                            echo '<option value="'. $estado['Estados']['codigo_ibge'] .'" '. $selected .'>'. $estado['Estados']['nome'] . '</option>' . PHP_EOL;
	                        }
	                        ?>
						</select>
						<?php
						if (isset($error_estado)) {
							echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
						}
						?>
						
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_cidade)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					<strong>* Cidade</strong>
					</label>
					<div class="controls">
						<select id="id_cidade_ibge" name="endereco_cidade" style="width: 380px;">
						</select>
						<?php
						if (isset($error_cidade)) {
							echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
						}
						?>
					</div>
				</div>
				<hr />
				<?php
	            $error = null;
	            if (isset($error_forma_pagamento)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?>">
					<label class="control-label">
					Como deseja efetuar o pagamento do seu plano?
					</label>
					<div class="controls">
						<select id="id_forma_pagamento" name="forma_pagamento">

							<?php
							/**
							*
							* Forma completa de pagamento
							*
							**/

							/*
							if (\Lib\Validate::isPost()) {
							?>
								<option value="cartao_credito" <?php if (!(strcmp("cartao_credito", \Lib\Tools::getValue('forma_pagamento')))) {echo 'selected="selected"';} ?>>com Cartão de crédito</option>
								<option value="boleto" <?php if (!(strcmp("boleto", \Lib\Tools::getValue('forma_pagamento')))) {echo 'selected="selected"';} ?>>com Boleto bancário</option>

							<?php	
							} else {
							?>

								<?php
								if (isset($dados['ShopConta']['forma_pagamento'])) {
								?>

								<option value="cartao_credito" <?php if (!(strcmp("cartao_credito", @$dados['ShopConta']['forma_pagamento']))) {echo 'selected="selected"';} ?>>com Cartão de crédito</option>
								<option value="boleto" <?php if (!(strcmp("boleto", @$dados['ShopConta']['forma_pagamento']))) {echo 'selected="selected"';} ?>>com Boleto bancário</option>

								<?php
								} else {
								?>

								<option value="cartao_credito">com Cartão de crédito</option>
								<option value="boleto" selected="selected">com Boleto bancário</option>

								<?php
								}
								?>

							<?php
							}//end post

							*/
							?>


							<option value="cartao_credito">com Cartão de crédito - Indisponível</option>
							<option value="boleto" selected="selected">com Boleto bancário</option>
						</select>
					</div>
				</div>


				<?php
						if (isset($error_forma_pagamento)) {
						echo '<div class="controls">
						<div class="alert alert-error">
							<p>A cobrança via cartão de crédito não está disponível no momento, somente via boleto bancário.
						</div>
				</div>'. PHP_EOL;
				}
				?>

				
				<div id="pagarCartao">

					<div class="controls">
							<div class="alert alert-error">
								<p>A cobrança via cartão de crédito não está disponível no momento, somente via boleto bancário.
							</div>
					</div>

					<?php
					/*
					?>
					<div id="visualizar-cartao-credito" class="control-group ">
	                    <label class="control-label">Cartão de crédito</label>
	                    <div class="controls">
	                        <p class="only-text">
	                            Os seus pagamentos serão efetuados com seguinte cartão de crédito:
	                        </p>
	                        <p>
	                            <img src="/admin/img/cartoes-de-credito/diners_club-32.png" />
	                            <strong>DINERS_CLUB</strong><br/>
	                            Número: <strong>3011-******-3331</strong><br/>
	                            Nome do portador: <strong>Joanilson souza</strong><br/>
	                            Validade: <strong>11/2029</strong>
	                        </p>
	                        <p>
	                            <a href="#" class="btn-editar-cartao-credito btn btn-small"><i class="icon-edit"></i> Editar cartão</a>
	                        </p>
	                    </div>
	                </div>


	                <div id="form-cartao-credito" class="hide">
	                
					

					<div id="form-cartao-credito" >
						<div class="controls" style="padding-bottom: 5px;">
							<img src="/admin/img/cartoes-de-credito/mastercard-32.png" />
							<img src="/admin/img/cartoes-de-credito/visa-32.png" />
							<img src="/admin/img/cartoes-de-credito/diners_club-32.png" />
							&nbsp; <small style="font-size: 11px; color: #999;">(bandeiras aceitas)</small>
						</div>
						<?php
			            $error = null;
			            if (isset($error_numero)) {
			                $error='error';
			            }
			            ?>
						<div class="control-group <?php echo $error; ?>">
							<label class="control-label"><strong>Número do cartão</strong></label>
							<div class="controls">
								<input id="id_numero" maxlength="16" name="numero" type="text" value="<?php 

								if (isset($dados['ShopConta']['numero'])) {
									echo $cipher->decrypt($dados['ShopConta']['numero']);
								}
								
								?>" />
								<?php

								if (isset($error_numero_invalido)) {
									echo '<ul class="errorlist"><li>Este número de cartão de crédito é inválido.</li></ul>'. PHP_EOL;
								} elseif (isset($error_numero)) {
									echo '<ul class="errorlist"><li>Por favor, entre com um número de cartão de crédito.</li></ul>'. PHP_EOL;
								}
								?>
							</div>
							
						</div>

						<?php
			            $error = null;
			            if (isset($error_nome)) {
			                $error='error';
			            }
			            ?>
						<input type="hidden" name="editar_cartao" value="1" />
						<div class="control-group <?php echo $error; ?>">
							<label class="control-label">Nome do portador</label>
							<div class="controls">
								<input id="id_nome" maxlength="50" name="nome" type="text" value="<?php 

								if (isset($dados['ShopConta']['nome'])) {
									echo $cipher->decrypt($dados['ShopConta']['nome']);
								}

								?>" />
								<p class="help-block">Escreva o nome exatamente igual ao nome que se encontra no cartão de crédito.</p>
								<?php
								if (isset($error_nome)) {
									echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
								}
								?>
							</div>
						</div>

						<?php
			            $error = null;
			            if (isset($error_cvv)) {
			                $error='error';
			            }
			            ?>
						<input type="hidden" name="editar_cartao" value="1" />
						<div class="control-group <?php echo $error; ?>">
							<label class="control-label">Código de segurança</label>
							<div class="controls">
								<input id="id_cvv" maxlength="4" name="cvv" style="width: 50px;" type="text" />
								<span style="margin: -2px 0 0 10px;" class="icon-custom icon-card" rel="tooltip" data-original-title="Código de segurança que fica atrás do cartão de crédito."></span>
								<?php
								if (isset($error_cvv)) {
									echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
								}
								?>
							</div>
						</div>
						<input type="hidden" name="editar_cartao" value="1" />
						<div class="control-group">
							<label class="control-label">Data de expiração</label>
							<div class="controls">
								<select id="id_mes_expiracao" name="mes_expiracao" style="width: 60px;">
									
									<?php
									for($i=1; $i <= 12; $i++){
										echo '<option value="'. $i .'">'. $i .'</option>' . PHP_EOL;
									}
									?>
								</select>
								<span class="add-on">&nbsp;/&nbsp;</span>
								<select id="id_ano_expiracao" name="ano_expiracao" style="width: 75px;">
									
									<?php

									for($i=0; $i <= 15; $i++){
										$today     = new \DateTime();
										$next_year = $today->modify("+{$i} year");
										$year = $next_year->format('Y'). '<br />';

										echo '<option value="'. $year .'">'. $year .'</option>' . PHP_EOL;
									}
									?>
								</select>
							</div>
						</div>
						<div class="controls">
							<div class="alert alert-info">
								<p>A cobrança será gerada no momento da mudança de plano e mensalmente na mesma data de assinatura.</p>
								A falta de pagamento suspenderá automaticamente a sua loja. Durante o período que permanecer suspensa sua loja será mostrada como loja em manutenção para seus clientes.
							</div>
						</div>
					</div>


					<?php
					*/
					?>

				</div>


				<div id="pagarBoleto">
					<div class="controls">
						<div class="alert alert-info">
							<p>O boleto bancário será gerado no momento da mudança de plano e mensalmente no mesmo dia de sua assinatura.</p>
							A falta de pagamento suspenderá automaticamente a sua loja. Durante o período que permanecer suspensa sua loja será mostrada como loja em manutenção para seus clientes.
						</div>
					</div>
				</div>


			</div>

			
			<div class="form-actions">
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
				<a href="<?php echo VIALOJA_PAINEL ?>/conta/editar" class="btn"><i class="icon-remove"></i> Cancelar</a>
			</div>

		</form>
	</div>

</div>
<!-- /Full width content box -->
