<section id="columns" class="columns-container">
	<div class="container">
		<div class="row">
			<div id="top_column" class="center_column col-xs-12 col-sm-12 col-md-12">
			</div>
		</div>
		<div class="row">
			<!-- Center -->
			<section id="center_column" class="col-md-12">
				<div id="breadcrumb" class="clearfix">
					<!-- Breadcrumb -->
					<div class="breadcrumb clearfix">
						<a class="home" href="/" title="Voltar para a Página Inicial"><i class="fa fa-home"></i></a>
						<span class="navigation-pipe" >/</span>
						<span class="navigation_page">	Redefinição de senha</span>
					</div>
					<!-- /Breadcrumb -->			
				</div>
				<h1 class="page-heading">Redefinição de senha</h1>
				<?php echo $this->Session->flash(); ?>
				<!---->
				<div class="row">
					
					<div class="col-xs-12 col-sm-12">
						<form action="<?php echo \Lib\Tools::getUrl(); ?>" method="post" id="login_form" class="box">
							<h3 class="page-subheading">Por favor preencha a sua nova senha abaixo.</h3>
							<div class="form_content clearfix">

								<div class="form-group">
									<label for="email">Nova senha</label>
									<span><input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="senha" name="senha" placeholder="Senha" value=""  /></span>
								</div>


								<div class="form-group">
									<label for="passwd">Confirmação da nova senha</label>
									<span><input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="confirmacao_senha" name="confirmacao_senha" placeholder="Confirme a senha" value="" /></span>
								</div>

								<p class="submit">
									<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' /> <input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
									<button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-outline button-medium">
									<span>
									<i class="fa fa-refresh left"></i>&nbsp;
									Redefinir Senha
									</span>
									</button>
								</p>

							</div>

						</form>

						<ul class="clearfix footer_links">
		                    <li class="pull-left"><a class="btn btn-outline button button-small btn-sm" href="/cliente/login" title="Cancelar" rel="nofollow"><span>Cancelar</span></a></li>
		                </ul>
					</div>
				</div>
			</section>
		</div>
	</div>
</section>
<!-- Footer -->