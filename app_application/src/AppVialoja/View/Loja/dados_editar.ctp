<?php
$id_cidade = 0;
if (\Lib\Validate::isPost()) {
	$id_cidade = \Lib\Tools::getValue("cidade");
} elseif (isset($endereco['ShopEndereco']['id_cidade'])) {
	$id_cidade = $endereco['ShopEndereco']['id_cidade'];
}
?>
<script type="text/javascript">
	CIDADE_PADRAO = <?php echo $id_cidade;?>;
	$(document).ready(function (event) {
		$('#id_loja_tipo').change(function () {
			if ($(this).val() == 'PF') {
				$('#id_loja_razao_social').parents('.control-group').slideUp('fast');
				$('#id_loja_cnpj').parents('.control-group').slideUp('fast');
	
				$('#id_loja_cpf').parents('.control-group').slideDown('fast');
				$('#id_loja_nome_responsavel').parents('.control-group').slideDown('fast');
	
				$('#id_loja_cpf').mask('999.999.999-99');
				$('#id_loja_cnpj').unmask();
			}
			else if ($(this).val() == 'PJ') {
				$('#id_loja_razao_social').parents('.control-group').slideDown('fast');
				$('#id_loja_cnpj').parents('.control-group').slideDown('fast');
	
				$('#id_loja_nome_responsavel').parents('.control-group').slideUp('fast');
				$('#id_loja_cpf').parents('.control-group').slideUp('fast');
	
				$('#id_loja_cnpj').mask('99.999.999/9999-99');
				$('#id_loja_cpf').unmask();
			} else {
				$('#id_loja_razao_social').parents('.control-group').slideUp('fast');
				$('#id_loja_cnpj').parents('.control-group').slideUp('fast');
				$('#id_loja_cpf').parents('.control-group').slideUp('fast');
				$('#id_loja_nome_responsavel').parents('.control-group').slideUp('fast');
	
				$('#id_loja_cnpj').unmask();
				$('#id_loja_cpf').unmask();
			}
		}).change();
	
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
		$('#id_cep').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("cep"));?>');
		$('#id_numero').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("numero"));?>');
		$('#id_estado').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("estado"));?>');
		$('#id_cidade').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("cidade"));?>');
		$('#id_endereco').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("endereco"));?>');
		$('#id_bairro').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("bairro"));?>');
		$('#id_complemento').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("complemento"));?>');

		$('#id_mostrar_endereco').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("mostrar_endereco"));?>');
	    $('#id_nome_loja').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("nome_loja"));?>');
	    $('#id_descricao').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("descricao"));?>');
	    $('#id_loja_nome_responsavel').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("loja_nome_responsavel"));?>');
	    $('#id_loja_razao_social').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("loja_razao_social"));?>');
	    $('#id_loja_cpf').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("loja_cpf"));?>');
	    $('#id_loja_cnpj').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("loja_cnpj"));?>');
	    $('#id_telefone').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("telefone"));?>');
	    $('#id_email').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("email"));?>');
	    $('#id_blog').val('<?php echo \Lib\Tools::clean(\Lib\Tools::getValue("blog"));?>');

	});
</script>

<?php
}
?>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/dados/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
		<li><span>Dados da loja</span></li>
	</ul>
</div>
<form action="<?php echo Router::url(); ?>" method="post" id="fomulario-endereco">
	<div class="box painel-loja painel-loja-editar">
		<div class="box-header">
			<h3>Endereço da Loja</h3>
		</div>
		<div class="box-content endereco-loja">

			<?php
			if (isset($error_dados_endereco)) {
		        echo '<div class="alert alert-error">
           		Houve um erro ao tentar salvar. Verifique os erros abaixo.
        	</div>'. PHP_EOL;
			}
			?>
			

			<p class="muted intro">
				Este endereço será usado na impressão do pedido e no formulário de contato.
			</p>
			<div class="row-fluid">
				<div class="span6">
					<div class="exemplo-endereco etiqueta">
						<p>No momento em que for imprimir o seu pedido o endereço cadastrado aparecerá na etiqueta do remetente.</p>
						<img src="/admin/img/configuracao/exemplo-remetente.jpg" title="Exemplo de etiqueta" />
					</div>
				</div>
				<div class="span6">
					<div class="exemplo-endereco fale-conosco">
						<p>Dentro da loja o menu “Fale Conosco” conterá o endereço cadastrado e o mapa do google com a localização.</p>
						<img src="/admin/img/configuracao/exemplo-endereco.jpg" title="Exemplo de endereço" />
					</div>
				</div>
			</div>

			
			<div class="row-fluid">
				<div class="span6">

					<?php
		            $error = null;
		            if (isset($error_cep)) {
		                $error='error';
		            }
		            ?>
					<div class="row-fluid">
						<div class="span4">
							<div class="control-group <?php echo $error; ?>">
								<label for="" class="control-label">CEP (só números) </label>
								<div class="controls">
									<input class="span12" id="id_cep" name="cep" value="<?php 

									if (isset($endereco['ShopEndereco']['cep'])) {
										echo $endereco['ShopEndereco']['cep'];
									}
									?>" type="text" />

									<?php
									if (isset($error_cep)) {
										echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
									}
									?>
								</div>
							</div>
						</div>
						<?php
			            $error = null;
			            if (isset($error_numero)) {
			                $error='error';
			            }
			            ?>
						<div class="span4">
							<div class="control-group <?php echo $error; ?>">
								<label for="" class="control-label">  Número </label>
								<div class="controls">
									<input class="span12" id="id_numero" value="<?php

									if (isset($endereco['ShopEndereco']['numero'])) {
										echo $endereco['ShopEndereco']['numero'];
									}

									?>" maxlength="32" name="numero" type="text" />

									<?php
									if (isset($error_numero)) {
										echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
									}
									?>
								</div>
							</div>
						</div>
						<?php
			            $error = null;
			            if (isset($error_complemento)) {
			                $error='error';
			            }
			            ?>
						<div class="span4">
							<div class="control-group <?php echo $error; ?>">
								<label for="" class="control-label">Complemento</label>
								<div class="controls">
									<input class="span12" id="id_complemento" maxlength="120" name="complemento" value="<?php 

									if (isset($endereco['ShopEndereco']['complemento'])) {
										echo $endereco['ShopEndereco']['complemento'];
									}
									?>" type="text" />
									<?php
									if (isset($error_complemento)) {
										echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
									}
									?>
								</div>

							</div>
						</div>
					</div>
					<?php
		            $error = null;
		            if (isset($error_endereco)) {
		                $error='error';
		            }
		            ?>
					<!-- inner row-fluid -->
					<div class="control-group <?php echo $error; ?>">
						<label for="" class="control-label">  Endereço </label>
						<div class="controls">
							<input class="span12" id="id_endereco" maxlength="120" name="endereco" value="<?php 

							if (isset($endereco['ShopEndereco']['endereco'])) {
								echo $endereco['ShopEndereco']['endereco'];
							}
							?>" type="text" />

							<?php
						if (isset($error_endereco)) {
							echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
						}
						?>


						</div>
						
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_estado)) {
	                $error='error';
	            }
	            ?>
				<div class="span6">
					<div class="row-fluid">
						<div class="span5">
							<div class="control-group <?php echo $error; ?>">
								<label for="" class="control-label">Estado</label>
								<div class="controls">
									<select id="id_estado" name="estado" style="">
										
										<?php

	                                    foreach ($estados as $key => $estado) {


	                                    	$estado_id=null;
											if (\Lib\Validate::isPost()) {

												$estado_id = \Lib\Tools::getValue('estado');

											} else {

												if (isset($endereco['ShopEndereco']['id_estado'])) {
													$estado_id = $endereco['ShopEndereco']['id_estado'];
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
								</div>

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
						<div class="span7">
							<div class="control-group <?php echo $error; ?>">
								<label for="" class="control-label">Cidade</label>
								<div class="controls">
									<select id="id_cidade_ibge" name="cidade">
									</select>
								</div>
								<?php
								if (isset($error_cidade)) {
									echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
								}
								?>
							</div>
						</div>
					</div>
					<?php
		            $error = null;
		            if (isset($error_bairro)) {
		                $error='error';
		            }
		            ?>
					<!-- inner row-fluid -->
					<div class="row-fluid">
						<div class="span7">
							<div class="control-group <?php echo $error; ?>">
								<label for="" class="control-label">Bairro</label>
								<div class="controls">
									<input class="span12" id="id_bairro" maxlength="32" name="bairro" type="text" value="<?php

									if (isset($endereco['ShopEndereco']['bairro'])) {
										echo $endereco['ShopEndereco']['bairro'];
									}
									?>" />
									<?php
									if (isset($error_bairro)) {
										echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
									}
									?>
								</div>
							</div>
						</div>
						<div class="span5">
						</div>
					</div>
					<!-- inner row-fluid -->
				</div>
			</div>

			<div class="control-group  mostrar-endereco">
				<div class="controls">
					<select id="id_mostrar_endereco" name="mostrar_endereco">
						<option value="True" <?php if (!(strcmp("True", @$endereco['ShopEndereco']['mostrar_endereco']))) {echo 'selected="selected"';} ?>>Sim</option>
						<option value="False" <?php if (!(strcmp("False", @$endereco['ShopEndereco']['mostrar_endereco']))) {echo 'selected="selected"';} ?>>Não</option>
					</select>
				</div>
				<label for="id_mostrar_endereco" class="control-label">Mostrar endereço na loja? </label>
			</div>
		</div>
		<div class="box-footer"></div>
	</div>
	<div class="row">
		<div class="box form-horizontal">
			<div class="box-header">
				<h3>Dados da loja</h3>
			</div>
			<div class="box-content">

				<?php
				if (isset($error_atividade)) {
					echo '<div class="alert alert-important">
	                    Você deve selecionar pelo menos uma atividade para a sua loja.
	                </div>'. PHP_EOL;

				}

				if (isset($error_dados_loja)) {
			        echo ' <div class="alert alert-error">
	                    Houve um erro ao tentar salvar. Verifique os erros abaixo.
	                </div>'. PHP_EOL;
				}

	            $error = null;
	            if (isset($error_nome_loja)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?> nome_loja" style="">
					<label class="control-label" for="id_nome_loja">Nome da sua loja</label>
					<div class="controls">
						<input class="span6" id="id_nome_loja" maxlength="128" name="nome_loja" type="text" value="<?php echo $config['Shop']['nome_loja']; ?>" />

						<?php
						if (isset($error_nome_loja)) {
							echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
						}
						?>

					</div>
				</div>

				<?php
	            $error = null;
	            if (isset($error_descricao)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?> descricao" style="">
					<label class="control-label" for="id_descricao">Descrição da sua loja</label>
					<div class="controls">
						<div class="help-block">
							Preencha o campo abaixo com uma breve descrição sobre sua loja. Esta
							informação ficará disponível na página principal e para o Google.
						</div>
						<textarea class="span7" cols="5" id="id_descricao" name="descricao" rows="5"><?php echo $config['Shop']['descricao']; ?></textarea>
						<?php
						if (isset($error_descricao)) {
							echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>'. PHP_EOL;
						}
						?>
					</div>

				</div>
				<div class="control-group loja_tipo" style="">
					<label class="control-label" for="id_loja_tipo">Tipo de cadastro da loja</label>
					<div class="controls">
						<select class="span2" id="id_loja_tipo" name="loja_tipo">


							<?php
							if (!\Lib\Validate::isPost()) {
							?>

							<option value="" <?php if (!(strcmp("", $config['Shop']['loja_tipo']))) {echo 'selected="selected"';} ?>>--</option>
							<option value="PF" <?php if (!(strcmp("PF", $config['Shop']['loja_tipo']))) {echo 'selected="selected"';} ?>>Pessoa Física</option>
							<option value="PJ" <?php if (!(strcmp("PJ", $config['Shop']['loja_tipo']))) {echo 'selected="selected"';} ?>>Pessoa Jurídica</option>

							<?php
							} else {
							?>

							<option value="" <?php if (!(strcmp("", \Lib\Tools::getValue('loja_tipo')))) {echo 'selected="selected"';} ?>>--</option>
							<option value="PF" <?php if (!(strcmp("PF", \Lib\Tools::getValue('loja_tipo')))) {echo 'selected="selected"';} ?>>Pessoa Física</option>
							<option value="PJ" <?php if (!(strcmp("PJ", \Lib\Tools::getValue('loja_tipo')))) {echo 'selected="selected"';} ?>>Pessoa Jurídica</option>

							<?php
							}
							?>

						</select>
					</div>
				</div>
				<div class="control-group loja_nome_responsavel" style="">
					<label class="control-label" for="id_loja_nome_responsavel">Nome do responsável</label>
					<div class="controls">
						<input class="span4" id="id_loja_nome_responsavel" maxlength="128" name="loja_nome_responsavel" value="<?php echo $config['Shop']['loja_nome_responsavel']; ?>" type="text" />
					</div>
				</div>
				<div class="control-group loja_razao_social" style="display: none;">
					<label class="control-label" for="id_loja_razao_social">Razão Social</label>
					<div class="controls">
						<input class="span4" id="id_loja_razao_social" maxlength="128" name="loja_razao_social" type="text" value="<?php echo $config['Shop']['loja_razao_social']; ?>" />
					</div>
				</div>

				<?php
	            $error = null;
	            if (isset($error_cpf)) {
	                $error='error';
	            }
	            ?>	
				<div class="control-group <?php echo $error; ?> loja_cpf" style="display: none;">
					<label class="control-label" for="id_loja_cpf">CPF</label>
					<div class="controls">
						<input class="span3" id="id_loja_cpf" maxlength="14" name="loja_cpf" value="<?php echo $cipher->decrypt($config['Shop']['loja_cpf']); ?>" type="text" />
						<?php
						if (isset($error_cpf)) {
							echo '<ul class="errorlist"><li>Este CPF é inválido.</li></ul>'. PHP_EOL;
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
				<div class="control-group <?php echo $error; ?> loja_cnpj" style="display: none;">
					<label class="control-label" for="id_loja_cnpj">CNPJ</label>
					<div class="controls">
						<input class="span3" id="id_loja_cnpj" name="loja_cnpj" value="<?php echo $cipher->decrypt($config['Shop']['loja_cnpj']); ?>" type="text" />
						<?php
						if (isset($error_cnpj)) {
							echo '<ul class="errorlist"><li>Este CNPJ é inválido.</li></ul>'. PHP_EOL;
						}
						?>
					</div>
				</div>

				<div class="control-group telefone" style="">
					<label class="control-label" for="id_telefone">Telefone de contato</label>
					<div class="controls">
						<div class="help-block">
							Se preenchido, ficará disponível em sua loja.
						</div>
						<input class="span4" id="id_telefone" maxlength="20" name="telefone" type="text" value="<?php echo $config['Shop']['telefone']; ?>" />
					</div>
				</div>
				<?php
	            $error = null;
	            if (isset($error_email)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?> email" style="">
					<label class="control-label" for="id_email">Email de contato</label>
					<div class="controls">
						<div class="help-block">
							Se preenchido, ficará disponível na página de contato.
						</div>
						<input class="span5" id="id_email" maxlength="128" name="email" type="text" value="<?php echo $config['Shop']['email']; ?>" />
						<?php
						if (isset($error_email)) {
							echo '<ul class="errorlist"><li>Este endereço de email é inválido.</li></ul>'. PHP_EOL;
						}
						?>
					</div>
				</div>

				<?php
	            $error = null;
	            if (isset($error_atividade)) {
	                $error='error';
	            }
	            ?>
				<div class="control-group <?php echo $error; ?> atividades" style="">
					<label class="control-label" for="id_atividades">Ramo de atividade</label>
					<div class="controls">
						<div class="help-block">
							Escolha até 3 ramos de atividade.
						</div>
						
						<?php

	                    foreach ($atividades_shop as $key => $atividade){

	                        if( $key % 17 == 0 ){
	                            if ($key !== 0) {
	                                echo '</ul>';
	                            }
	                            echo  '<ul>';
	                        } 

	                        if (isset($atividade['0']['checked']) && $atividade['0']['checked'] == 'checked') {
	                            // Set the $checked string
	                            $checked = "checked='checked'";
	                        } else {
	                            $checked = " ";
	                        }

	                        echo sprintf('<li><label for="id_atividades_%d"><input id="id_atividades_%d" name="atividades[]" type="checkbox" %s value="%d" /> %s</label></li>', $key, $key, $checked, $atividade['ConfiguracaoAtividade']['id_atividade'], $atividade['ConfiguracaoAtividade']['nome'] ) . PHP_EOL;


	                    }
	                    echo  '</ul>';
	                    ?>

	                   
					</div>
					  
				</div>

				<?php
                if (isset($error_atividade)) {
                
					echo '<div class="control-group">
					<div class="controls">
						<div id="minimo-selecionado" class="hide alert alert-error">
							Escolha até 3 ramos de atividade, este campo é obrigatório.
						</div>
					</div>
				</div>' . PHP_EOL;

                }
            	?> 
				<div class="control-group">
					<div class="controls">
						<div id="maximo-selecionado" class="hide alert alert-success">
							Você já selecionou a quantidade máxima de atividades permitidas.
						</div>
					</div>
				</div>
				<hr/>
				<div class="control-group blog" style="">
					<label class="control-label" for="id_blog">Endereço de Blog</label>
					<div class="controls">
						<div class="help-block">
							Caso possua um Blog, preencha no campo abaixo para mostrar o link na sua loja.
						</div>
						<input class="span5" id="id_blog" name="blog" type="text" value="<?php echo $config['Shop']['blog']; ?>" />
					</div>
				</div>
			</div>
			<div class="form-actions">
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar Alterações</button>
				<a href="<?php echo VIALOJA_PAINEL ?>/conta" class="btn"><i class="icon-remove"></i> Cancelar</a>
			</div>
		</div>
	</div>
</form>
