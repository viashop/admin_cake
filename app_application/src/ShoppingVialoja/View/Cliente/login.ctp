<style type="text/css">
<!--
.border_login_form{
	border: 1px solid #ccc;
	padding: 5px;
}
.border_account_form{
	border: 1px solid #ccc;
	padding: 5px;
}
.form_content{
	margin-left: 10px;
}
-->
</style>

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
						<span class="navigation_page">	Autenticação</span>
					</div>
					<!-- /Breadcrumb -->			
				</div>
				<h1 class="page-heading">Autenticação</h1>
				<?php echo $this->Session->flash(); ?>
				<!---->
				<div class="row">

					<?php 

					$criar_conta = '<div class="col-xs-12 col-sm-6">
						<form action="'. \Lib\Tools::getUrl() .'" method="post" id="create-account_form" class="box border_account_form">
							<h3 class="page-subheading">Criar uma conta</h3>
							<div class="form_content clearfix">
								<p>Informe o seu e-mail para cadastro</p>
								<div class="alert alert-danger" id="create_account_error" style="display:none"></div>
								<div class="form-group">
									<label for="email_create">E-mail</label>
									<input type="email" class="is_required validate account_input form-control" data-validate="isEmail" id="email_create" name="email_create" required placeholder="Insira o seu e-mail verdadeiro"  />
								</div>
								<div class="submit">
									<input type="hidden" class="hidden" name="back" value="criar_conta" />						<button class="btn btn-outline button button-medium exclusive" type="submit" id="SubmitCreate" name="SubmitCreate">
									<span>
									<i class="fa fa-user left"></i>&nbsp;
									Criar uma conta
									</span>
									</button>
									<input type="hidden" class="hidden" name="SubmitCreate" value="Criar uma conta" />
								</div>
							</div>
						</form>
					</div>';

					$efetua_login = '<div class="col-xs-12 col-sm-6">
						<form action="'. \Lib\Tools::getUrl() .'" method="post" id="login_form" class="box border_login_form">
							<h3 class="page-subheading">Já tem cadastro no ViaLoja?</h3>
							<div class="form_content clearfix">
								<div class="form-group">
									<label for="email">E-mail</label>
									<input class="is_required validate account_input form-control" data-validate="isEmail" type="email" id="email" name="email" required value="'. \Lib\Tools::getValue('email') .'"  />
								</div>
								<div class="form-group">
									<label for="passwd">Senha</label>
									<span><input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="passwd" name="senha" required value=""  /></span>
								</div>
								<a href="/cliente/esqueceu-a-senha" title="Recuperar sua senha" rel="nofollow">Esqueceu sua senha?</a></p>
								<p class="submit">
									
									<input type="hidden" name="CSRFGuardName" value="'. $CSRFGuardName .'" />
									<input type="hidden" name="CSRFGuardToken" value="'. $CSRFGuardToken .'" />
									
									<button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-outline button-medium">
									<span>
									<i class="fa fa-lock left"></i>&nbsp;
									Entrar
									</span>
									</button>
								</p>
							</div>
						</form>
					</div>';

					if (isset($this->request->pass['2']) && $this->request->pass['2']):

						echo $criar_conta;
						echo $efetua_login;
						
					else:

						echo $efetua_login;
						echo $criar_conta;

					endif;

					?>

				</div>
			</section>
		</div>
	</div>
</section>
<!-- Footer -->