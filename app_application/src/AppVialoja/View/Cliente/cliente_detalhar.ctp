<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i>Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/cliente/listar"><i class="icon-user icon-custom"></i>Clientes</a> <span class="bread-separator">-</span></li>
		<li><span>Editar Cliente</span></li>
	</ul>
</div>

<div class="box pagina-cliente">
	<div class="box-header">
		<h3 class="pull-left">
			Editando cliente
		</h3>
		<form action="<?php echo Router::url(array('controller' => 'cliente','action' => 'alterar', 'grupo'), false); ?>" class="pull-right" method="post">
			<div class="controls form-inline">
				Grupo: &nbsp;
				<select name="grupo_id">

					<option value="1" <?php if (!(strcmp(1, $dados_cliente['Cliente']['id_shop_grupo'] ))) {echo 'selected="selected"';} ?>>Padrão</option>	
					
					<?php foreach ($shop_grupo as $key => $grupo): ?>

					<option value="<?php echo $dados_cliente['Cliente']['id_shop_grupo']; ?>" <?php if (!(strcmp($dados_cliente['Cliente']['id_shop_grupo'], $grupo['ClienteShopGrupo']['id_grupo'] ))) {echo 'selected="selected"';} ?>><?php echo $grupo['ClienteShopGrupo']['nome'] ?></option>	

					<?php endforeach ?>

				</select>
				<input type="submit" class="btn btn-primary" id="processando" value="Alterar" />
				<input type='hidden' name='id_cliente_shop' value='<?php echo $dados_cliente['Cliente']['id_cliente'] ?>' /> 
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
            	<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
			</div>
		</form>
	</div>
	<div class="box-content">
		<h1>
			<?php echo $dados_cliente['Cliente']['nome']; ?>
		</h1>
		<div class="detalhes-cliente">
			<h4>Dados Cadastrais</h4>
			<div class="row-fluid">
				<div class="span6 alpha">
					<ul>
						<li><span>Email:</span> <strong><?php echo $dados_cliente['Cliente']['email']; ?></strong></li>
						<li><span>Sexo:</span> <strong><?php echo $dados_cliente['Sexo']['sexo']; ?></strong></li>
						<li><span>Telefone celular:</span> <strong><?php 

						echo !empty( $dados_cliente['Cliente']['telefone_celular'] ) ? $dados_cliente['Cliente']['telefone_celular'] : "-"; 

						?></strong></li>
					</ul>
				</div>
				<div class="span6">
					<ul>
						<li><span>Telefone residencial:</span> <strong><?php 
						echo !empty( $dados_cliente['Cliente']['telefone_residencial'] ) ? $dados_cliente['Cliente']['telefone_residencial'] : "-"; 

						?></strong></li>
						<li><span>Telefone comercial:</span> <strong><?php 

						echo !empty( $dados_cliente['Cliente']['telefone_comercial'] ) ? $dados_cliente['Cliente']['telefone_comercial'] : "-"; 

						?></strong></li>
						<li><span>Data Nascimento:</span>

							<?php if (!empty($dados_cliente['Cliente']['data_nasc'])): ?>

							<strong>

							<?php echo \Lib\Tools::formatToDate( $dados_cliente['Cliente']['data_nasc'] ); ?>
							
							</strong>

							<?php
							$data_db = explode('-', $dados_cliente['Cliente']['data_nasc']);

							if (date('m') <= $data_db[1] && date('d') <= $data_db[2] ) {
								
								$data1 = new DateTime( date('Y') . '-'. $data_db[1] .'-'. $data_db[2] );

							} else {
								
								$data1 = new DateTime( date("Y",strtotime("+1 year",strtotime("now"))) . '-'. $data_db[1] .'-'. $data_db[2] );
								
							}

							$data2 = new DateTime();
							$intervalo = $data1->diff( $data2 );
	
							switch ($intervalo->m) {
								case 0:

									if ($intervalo->m == 0 && $intervalo->d == 0) {

										if (date('d') == $data_db[2]) {
											echo "<span>Aniversário <strong>HOJE</strong>.";
										} else {
											echo "<span>Aniversário em <strong>1 dia</strong>.";
										}

									} elseif($intervalo->d == 1) {
										echo "<span>Aniversário em</span> <strong>{$intervalo->d} dia</strong>.";
									} else {
										echo "<span>Aniversário em</span> <strong>{$intervalo->d} dias</strong>.";
									}
									
									break;

								case 1:

									if ($intervalo->d == 0) {
										echo "<span>Aniversário em</span> <strong>{$intervalo->m} mes</strong>.";
									} else {
										echo "<span>Aniversário em</span> <strong>{$intervalo->m} mes e {$intervalo->d} dias</strong>.";
									}
									break;
														
								default:

									echo "<span>Aniversário em</span> <strong>{$intervalo->m} meses e {$intervalo->d} dias</strong>.";
									
									break;
							}

							?>
								
							<?php else: ?>

							<strong> - <strong>
								
							<?php endif ?>
							
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6 alpha">
				<div class="espaco"></div>
				<div class="enderecos-cliente">
					<h4>Endereços</h4>
					<ul class="detalhes-endereco">
						<li><strong><?php echo !empty( $dados_cliente['Cliente']['telefone_celular'] ) ? $dados_cliente['Cliente']['telefone_celular'] : "-";  ?></strong><br/></li>
						<li class="tipo">
							<span>CPF: <strong><?php echo !empty( $dados_cliente['Cliente']['cpf'] ) ? \Lib\Tools::mask( $dados_cliente['Cliente']['cpf'], '###.###.###-##') : "-";  ?></strong></span>
							<span class="text-right">RG: <strong><?php echo !empty( $dados_cliente['Cliente']['rg'] ) ? $dados_cliente['Cliente']['rg'] : "-";  ?></strong></span>
						</li>
						<li class="separator"></li>
						<li>
							<span>
							<?php echo !empty( $endereco['ClienteEndereco']['endereco'] ) ? \Lib\Tools::strtoupper( $endereco['ClienteEndereco']['endereco'] ) : "-";  ?>,
							<?php echo !empty( $endereco['ClienteEndereco']['numero'] ) ? \Lib\Tools::strtoupper( $endereco['ClienteEndereco']['numero'] ) : "-";  ?>
							 - 
							<?php echo !empty( $endereco['ClienteEndereco']['bairro'] ) ? \Lib\Tools::strtoupper( $endereco['ClienteEndereco']['bairro'] ) : "-";  ?>
							</span>
						</li>
						<li>
							<span>
							<?php echo !empty( $endereco['ClienteEndereco']['complemento'] ) ? \Lib\Tools::strtoupper( $endereco['ClienteEndereco']['complemento'] ) : "-";  ?>
							</span>
						</li>
						<li>
							<span>
							<?php echo !empty( $cidade_estado['Cidades']['nome'] ) ? \Lib\Tools::strtoupper( $cidade_estado['Cidades']['nome'] ) : "-";  ?> -
							<?php echo !empty( $cidade_estado['Estados']['nome'] ) ? \Lib\Tools::strtoupper( $cidade_estado['Estados']['nome'] ) : "-";  ?>
							 / 
							<?php echo !empty( $cidade_estado['Estados']['sigla'] ) ? \Lib\Tools::strtoupper( $cidade_estado['Estados']['sigla'] ) : "-";  ?>
							</span>
						</li>
						<li>
							<span>CEP: <?php echo !empty( $endereco['ClienteEndereco']['cep'] ) ? \Lib\Tools::mask( $endereco['ClienteEndereco']['cep'], '#####-###' ) : "-";  ?> 
							</span>
						</li>
						<li>
							<span>Brasil</span>
						</li>

					</ul>
				</div>
			</div>
			<div class="span6">
				<div class="pedidos">
					<h4>Pedidos</h4>
					<p>Não existem pedidos cadastrados.</p>
				</div>
			</div>


			<div class="span6">
                <div class="pedidos">
                <h4>Pedidos</h4>

                    <div class="pedido">
                        <table class="table table-condensed tabela_pedidos">
                            <tr>
                                <th>ID</th>
                                <th>Data</th>
                                <th>Situação</th>
                                <th>Total</th>
                            </tr>
                            <tr>
                                <td><a href="<?php echo VIALOJA_PAINEL ?>/pedido/detalhar/1">#93964</a></td>
                                <td>31/12/2013 02:11</td>
                                <td>Pedido enviado</td>
                                <td>R$ 615,39</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

		</div>
	</div>
</div>
<div class="modal hide fade" id="AlterarSituacaoModal">
	<div class="modal-header">
		<h3>Alterar situação do cliente</h3>
	</div>
	<div class="modal-body">
		<p>
			O cliente consta como <strong>Pendente</strong>, o que deseja fazer?
		</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="button btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i> Cancelar</button>
		<a href="<?php echo VIALOJA_PAINEL ?>/cliente/aprovar/117280" class="btn btn-success"><i class="icon-white icon-ok"></i> Aprovar</a>
		<a href="<?php echo VIALOJA_PAINEL ?>/cliente/117280/negar" class="btn btn-danger">
		<i class="icon-white icon-remove"></i> Recusar</a>
	</div>
</div>
