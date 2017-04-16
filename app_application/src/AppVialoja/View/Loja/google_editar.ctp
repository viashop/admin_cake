<script type="text/javascript">
	$(document).ready(function() {
	
		$('.btn-upload-file').click(function() {
			$('.upload-file').slideToggle();
			$('.upload-file-ok').slideToggle();
		});
	
		// 
		// $('#id_dominio').parents().filter('.control-group').hide();
		// 
		// $('#id_usar_dominio_proprio').click(function() {
		//     pai_dominio_proprio = $('#id_dominio').parents().filter('.control-group');
		//     pai_subdominio_sistema = $('#id_apelido').parents().filter('.control-group');
	
		//     if ($(this).attr('checked')) {
		//         // console.log('checked');
		//         pai_dominio_proprio.show();
		//         pai_subdominio_sistema.hide();
		//     } else {
		//         // console.log('unchecked');
		//         pai_dominio_proprio.hide();
		//         pai_subdominio_sistema.show();
		//     }
		// });
	
		$('#btn-video-analytics').video({
			id: 'sHicqn5fcn4'
		});
	
		$('#btn-video-adwords').video({
			id: 'ooboyuJof1s'
		});
	});
</script>

<div class="bread-container">
	<ul class="breadcrumb">
		<li><a href="<?php echo VIALOJA_PAINEL ?>/"><i class="icon-custom icon-engine"></i> Painel</a> <span class="bread-separator">-</span></li>
		<li><a href="<?php echo VIALOJA_PAINEL ?>/loja/editar"><i class="icon-tools icon-custom"></i> Configurações</a> <span class="bread-separator">-</span></li>
		<li><span>Configurações do Google</span></li>
	</ul>
</div>
<form action="<?php echo Router::url(); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
	<div class="row">
		<div class="box">
			<div class="box-header">
				<h3>Google Analytics</h3>
				<a href="#video" title="" class="btn btn-video" id="btn-video-analytics"><i class="icon-custom icon-video"></i></a>
			</div>
			<div class="box-content">

				<?php
				if (!isset($google['ShopConfiguracoesGoogle']['google_analytics_code'])){
				?>
				<div class="alert alert-info alert-block">
					<p><b>Não deixe de configurar o Google Analytics!</b></p>
					<p>
						Acompanhe seu tráfego usando o Google Analytics, com ele você poderá acompanhar todo o tráfego, páginas mais visitadas, conversões para vendas, entre outras informações.
					</p>
					<p>
						Cadastre-se <a href="http://www.google.com.br/analytics" target="_blank">Clicando aqui</a>.
					<p>
				</div>

				<?php
				}

				foreach ($config_google as $key => $google);
				?>
				<div>
					<label class="control-label" for="id_google_analytics_code">
					<strong>
					Google Analytics ID (Tracking ID)
					</strong>
					</label>
					<div class="controls ">
						<input class="span3" id="id_google_analytics_code" maxlength="128" name="google_analytics_code" placeholder="UA-XXXXXX-X" type="text" value="<?php
						if (isset($google['ShopConfiguracoesGoogle']['google_analytics_code'])) {
							echo $google['ShopConfiguracoesGoogle']['google_analytics_code'];
						}

						?>" />
						<p class="help-block">O ID será algo parecido com isto: UA-31855766-1.</p>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
			</div>
		</div>
		<div class="box">
			<div class="box-header">
				<h3>
					Confirmar a propriedade de <?php echo $dominio;?>
					<a href="http://vialoja.com.br/comunidade/hc/pt-br/articles/200383054" title="Artigo Configuração do Google Webmasters" target="_blank" class="link_ext">
					<i class="icon-share"></i>
					</a>
				</h3>
			</div>
			<div class="box-content">
				<p>A confirmação de propriedade pode ser utilizada para os serviços <a href="http://www.google.com.br/webmasters" title="Google Webmasters">Google Webmasters</a> ou <a href="http://www.google.com.br/apps" title="Google Apps">Google Apps</a>.</p>
				<p>
					Durante o processo de confirmação de propriedade, escolha a opção para envio de arquivo. Caso não esteja disponível na tela durante o processo, clique em <b>Métodos alternativos</b>, depois em <b>Carregamento de ficheiro HTML</b>.
				</p>
				<p>Salve o primeiro arquivo no campo abaixo e depois clique em <b>confirmar</b> no Google.</p>
				<br/>

				<div class="">
                    <label class="control-label" for="id_google_verification_file">
                        <strong>
                            Arquivo HTML
                        </strong>
                    </label>

                    <?php
                    $hide = null;
					if (isset($google['ShopConfiguracoesGoogle']['google_verification_file']) 
						&& !empty($google['ShopConfiguracoesGoogle']['google_verification_file'])) {
						$hide = 'hide';

						$url = sprintf('http://%s/%s', $dominio, $google['ShopConfiguracoesGoogle']['google_verification_file']);

					?>
                    
                    <div class="controls upload-file-ok">
                        <div class="alert alert-success">
                        <h5 style="padding: 5px 0 5px;">O arquivo HTML de verificação foi corretamente instalado.</h5>
                        <p>Você pode visualizar ele em <a href="<?php echo $url;?>" target="_blank"><?php echo $url;?></a></p>
                        <p><button type="button" class="btn-upload-file btn btn-small"><i class="icon-upload"></i> Enviar outro arquivo</button></p>
                        </div>
                    </div>

                    <?php
                	}
                    ?>
                    
                    <div class="controls upload-file <?php echo $hide; ?>">
                        <div class="fileupload" style="padding: 5px; background: #EEE; border: #DDD; margin-bottom: 10px;">
                        	<input id="id_google_verification_file" name="google_verification_file" type="file" accept=".html" />
                        </div>
                        
                    </div>
                </div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
			</div>
		</div>
		<div class="box">
			<div class="box-header">
				<h3>Google Adwords - TAG de conversão</h3>
				<a href="#video" title="" class="btn btn-video" id="btn-video-adwords"><i class="icon-custom icon-video"></i></a>
			</div>
			<div class="box-content">
				<p>Informe abaixo o código de conversão de vendas do Adwords. Este código será executado na conclusão do pedido.</p>
				<div class="control-group ">
					<textarea cols="20" id="id_google_adwords_code" name="google_adwords_code" rows="10" style="font-family: monospace;"><?php
						if (isset($google['ShopConfiguracoesGoogle']['google_adwords_code'])) {
							echo $google['ShopConfiguracoesGoogle']['google_adwords_code'];
						}

						?></textarea>
				</div>
			</div>

			<div class="form-actions">
				<input type='hidden' name='csrfmiddlewaretoken' value='sRhsr7ZB9wGAmavYHaaKhutp2UfkL1C0' />
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
			</div>
		</div>
		<div class="box">
			<div class="box-header">
				<h3>Google Adwords - Tag de remarketing</h3>
			</div>
			<div class="box-content">
				<p>Informe abaixo o código de remarketing. Caso tenha dúvida do que é, <a href="http://www.google.com.br/ads/innovations/remarketing.html" target="_blank">clique aqui</a>.</p>
				<div class="control-group ">
					<textarea cols="20" id="id_google_adwords_remarketing_code" name="google_adwords_remarketing_code" rows="10" style="font-family: monospace;"><?php
						if (isset($google['ShopConfiguracoesGoogle']['google_adwords_remarketing_code'])) {
							echo $google['ShopConfiguracoesGoogle']['google_adwords_remarketing_code'];
						}

						?></textarea>
				</div>
			</div>
			<div class="form-actions">
				<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> 
				<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
				<button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Salvar alterações</button>
			</div>
		</div>
	</div>
</form>