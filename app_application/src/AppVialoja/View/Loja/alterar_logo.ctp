<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/tema/alterar"><i class="icon-window icon-custom"></i> Aparência</a> <span class="bread-separator">-</span></li>
		<li><span>Alterar logos e ícone da página</span></li>
	</ul>
</div>
<div class="row-fluid">
	<div class="box">
		<div class="box-header">
			<h3>Alterar logos e ícone da página</h3>
		</div>
		<div class="box-content">
			<h4>Logo do Site</h4>
			<p class="muted">A logo será mostrada no topo da sua loja, em todas as páginas. <br /><strong>Para que a logo fique visível em dispositivos Mobiles e Desktops, recomendamos o tamanho de 300x200.</strong></p>
			<div class="row">
				<form action="/admin/logo/alterar_logo" method="post" enctype="multipart/form-data" class="horizontal-form">
					<div class="span3">
						<div class="thumbnail" id="conta_logo">
							<?php
			                if (empty($logo)) {
			                    echo '<img src="/admin/img/sem-logo.jpg" alt="Sem logo." />';
			                } else {
			                    echo sprintf('<img src="%s%s" />', $dir_logo, $logo);
			                }
			                ?>
						</div>
					</div>

					<?php
					$erro_logo_div = '';
					if (isset($erro_logo)) {
						$erro_logo_div = 'error';
					}
					?>

					<div class="span8">
						<div class="control-group <?php echo $erro_logo_div; ?>">
							<label class="control-label" for="id_logo">Envie sua logo</label>
							<div class="controls">
								<input id="id_logo" name="logo" type="file" accept="image/*" />
								<p class="help-block">Tamanho máximo do arquivo: <strong>1MB</strong></p>

								<?php
								if (isset($erro_logo)) {
									echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
								}
								?>

							</div>
						</div>
						<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i>
						Enviar logo
						</button>

						<?php
			                if (!empty($logo)) {
			                	echo '<a href="<?php echo VIALOJA_PAINEL ?>/logo/remover_logo" class="btn btn-danger">
		                            <i class="icon-remove icon-white"></i> Remover logo
		                        </a>';
			                }
			             ?> 
                        
						<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
						<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
						<input type='hidden' name='xmlhttprequest' value='off' />
					</div>
				</form>
			</div>
			<hr/>
			<h4>Background do Topo</h4>
			<p class="muted">O Background do topo será mostrada como fundo da logo, e será mostrada em todas as páginas. <br /><strong>Para que o background fique visível em dispositivos Mobiles e Desktops, recomendamos o tamanho de 1130x188.</strong></p>
			<div class="row">
				<form action="/admin/logo/alterar_background" method="post" enctype="multipart/form-data" class="horizontal-form">
					<div class="span3">
						<div class="thumbnail" id="conta_background">
							<?php
			                if (empty($background)) {
			                    echo '<img src="/admin/img/sem-background.png" alt="Sem background." />';
			                } else {
			                    echo sprintf('<img src="%s%s" />', $dir_background, $background);
			                }
			                ?>
						</div>
					</div>

					<?php
					$erro_background_div = '';
					if (isset($erro_background)) {
						$erro_background_div = 'error';
					}
					?>

					<div class="span8">
						<div class="control-group <?php echo $erro_background_div; ?>">
							<label class="control-label" for="id_background">Envie seu background</label>
							<div class="controls">
								<input id="id_background" name="background" type="file" accept="image/*" />
								<p class="help-block">Tamanho máximo do arquivo: <strong>1MB</strong></p>

								<?php
								if (isset($erro_background)) {
									echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
								}
								?>

							</div>
						</div>
						<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i>
						Enviar background
						</button>

						<?php
			                if (!empty($background)) {
			                	echo '<a href="<?php echo VIALOJA_PAINEL ?>/logo/remover_background" class="btn btn-danger">
		                            <i class="icon-remove icon-white"></i> Remover background
		                        </a>';
			                }
			             ?> 
                        
						<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
						<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
						<input type='hidden' name='xmlhttprequest' value='off' />
					</div>
				</form>
			</div>
			<hr/>
			<h4>Compartilhar Logo</h4>

			<p class="muted"><strong>Para que a logo fique visível no facebook, ele deve ter o tamanho mínimo de 200x200.</strong></p>

			<div class="row">
				<form action="/admin/logo/alterar_logo_social" method="post" enctype="multipart/form-data" class="horizontal-form">
					<div class="span3">
						<div class="thumbnail" id="conta_logo_social">
							<?php
			                if (empty($logo_social)) {
			                    echo '<img src="/admin/img/sem-logo.jpg" alt="Sem logo." />';
			                } else {
			                    echo sprintf('<img src="%s%s" />', $dir_logo_social, $logo_social);
			                }
			                ?>
						</div>
					</div>

					<?php
					$erro_logo_social_div = '';
					if (isset($erro_logo_social)) {
						$erro_logo_social_div = 'error';
					}
					?>

					<div class="span8">
						<div class="control-group <?php echo $erro_logo_social_div; ?>">
							<label class="control-label" for="id_logo">Envie sua logo</label>
							<div class="controls">
								<input id="id_logo_social" name="logo_social" type="file" accept="image/*" />
								<p class="help-block">Tamanho máximo do arquivo: <strong>1MB</strong></p>

								<?php
								if (isset($erro_logo_social)) {
									echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
								}
								?>

							</div>
						</div>
						<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i>
						Enviar logo
						</button>

						<?php
			                if (!empty($logo_social)) {
			                	echo '<a href="<?php echo VIALOJA_PAINEL ?>/logo/remover_logo_social" class="btn btn-danger">
		                            <i class="icon-remove icon-white"></i> Remover logo
		                        </a>';
			                }
			             ?> 
                        
						<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
						<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
						<input type='hidden' name='xmlhttprequest' value='off' />
					</div>
				</form>
			</div>
			<hr/>
			<h4>Ícone da página</h4>
			<p class="muted">O ícone, ou <em>favicon</em>, será mostrado no navegador do seu cliente ao lado do endereço da loja ou na aba, ao lado do título. Todos os ícones são redimensionados para o tamanho máximo de 128px x 128px.</p>
			<p class="muted alert">
				É recomendado o envio de um ícone no formato <em>.ico</em> para que seja suportado 
				em todos os navegadores.
				<br>
				<small>(caso seja enviado em outro formato o arquivo será redimensionado para 128px x 128px como informado acima).</small>
			</p>
			<div class="row">
				<form action="/admin/logo/alterar_favicon" method="POST" enctype="multipart/form-data" class="horizontal-form">
					<div class="span3">
						<div class="thumbnail">

							<?php
			                if (empty($favicon)) {
			                    echo '<img src="/admin/img/sem-icone.png" alt="Sem logo." />';
			                } else {
			                    echo sprintf('<img src="%s%s" />', $dir_favicon, $favicon);
			                }
			                ?>
						</div>
					</div>

					<?php
					$erro_favicon_div = '';
					if (isset($erro_favicon)) {
						$erro_favicon_div = 'error';
					}
					?>

					<div class="span8">
						<div class="control-group <?php echo $erro_favicon_div; ?>">
							<label class="control-label" for="id_favicon">Envie seu ícone</label>
							<div class="controls">
								<input id="id_favicon" name="favicon" type="file" accept=".png, .ico " />
								<p class="help-block">Tamanho máximo do arquivo: <strong>100KB</strong></p>

								<?php
								if (isset($erro_favicon)) {
									echo '<ul class="errorlist"><li>Este campo é obrigatório.</li></ul>' . PHP_EOL;
								}
								?>
							</div>
						</div>
						<button class="btn btn-primary" type="submit"><i class="icon-ok icon-white"></i>
						Enviar ícone da página
						</button>

						<?php
			                if (!empty($favicon)) {
			                	echo '<a href="<?php echo VIALOJA_PAINEL ?>/logo/remover_favicon" class="btn btn-danger">
                                <i class="icon-remove icon-white"></i> Remover ícone da página
                            </a>';
			                }
			             ?>   
						
						<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
						<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Full width content box -->
