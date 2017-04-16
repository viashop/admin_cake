<!-- Content -->
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
						<a class="home" href="http://demo4leotheme.com/prestashop/shopping/" title="Voltar para a P&aacute;gina Inicial"><i class="fa fa-home"></i></a>
						<span class="navigation-pipe" >/</span>
						<span class="navigation_page">Seus endere&ccedil;os</span>
					</div>
					<!-- /Breadcrumb -->			
				</div>
				<div class="box">
					<h1 class="page-subheading">Seus endere&ccedil;os</h1>
					<p class="info-title">
						Para adicionar um novo endere&ccedil;o, por favor preencha o formul&aacute;rio abaixo.
					</p>
					<p class="required"><sup>*</sup>Campo obrigat&oacute;rio</p>
					<form action="http://demo4leotheme.com/prestashop/shopping/br/address" method="post" class="std form-horizontal" id="add_address">
						<!--h3 class="page-subheading">Seu endere&ccedil;o</h3-->
						<div class="required form-group">
							<label class="control-label col-sm-4" for="firstname">Nome <sup>*</sup></label>
							<div class="col-sm-6">
								<input class="is_required validate form-control" data-validate="isName" type="text" name="firstname" id="firstname" value="Wagner" />
							</div>
						</div>
						<div class="required form-group">
							<label class="control-label col-sm-4" for="lastname">Sobrenome <sup>*</sup></label>
							<div class="col-sm-6">
								<input class="is_required validate form-control" data-validate="isName" type="text" id="lastname" name="lastname" value="Duarte" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4" for="company">Empresa</label>
							<div class="col-sm-6">
								<input class="form-control validate" data-validate="isGenericName" type="text" id="company" name="company" value="" />
							</div>
						</div>
						<div class="required form-group">
							<label class="control-label col-sm-4" for="address1">Endere&ccedil;o <sup>*</sup></label>
							<div class="col-sm-6">
								<input class="is_required validate form-control" data-validate="isAddress" type="text" id="address1" name="address1" value="" />
							</div>
						</div>
						<div class="required form-group">
							<label class="control-label col-sm-4" for="address2">Bairro</label>
							<div class="col-sm-6">
								<input class="validate form-control" data-validate="isAddress" type="text" id="address2" name="address2" value="" />
							</div>
						</div>
						<div class="required form-group">
							<label class="control-label col-sm-4" for="city">Cidade <sup>*</sup></label>
							<div class="col-sm-6">
								<input class="is_required validate form-control" data-validate="isCityName" type="text" name="city" id="city" value="" maxlength="64" />
							</div>
						</div>
						<div class="required id_state form-group">
							<label class="control-label col-sm-4" for="id_state">Estado <sup>*</sup></label>
							<div class="col-sm-6">
								<select class="form-control" name="id_state" id="id_state">
									<option value="">-</option>
								</select>
							</div>
						</div>
						<div class="required postcode form-group unvisible">
							<label class="control-label col-sm-4" for="postcode">CEP / C&oacute;digo Postal <sup>*</sup></label>
							<div class="col-sm-6">
								<input class="is_required validate form-control" data-validate="isPostCode" type="text" id="postcode" name="postcode" value="" />
							</div>
						</div>
						<div class="required form-group">
							<label class="control-label col-sm-4" for="id_country">Pa&iacute;s<sup>*</sup></label>
							<div class="col-sm-6">
								<select class="form-control" id="id_country" name="id_country">
									<option value="21" >United States</option>
								</select>
							</div>
						</div>
						<div class="form-group phone-number">
							<label class="control-label col-sm-4" for="phone">Telefone fixo <sup>**</sup></label>
							<div class="col-sm-6">
								<input class="is_required validate form-control" data-validate="isPhoneNumber" type="tel" id="phone" name="phone" value=""  />
							</div>
						</div>
						<div class="inline-infos required"><label class="col-sm-offset-4 col-sm-6">** Voc&ecirc; deve informar pelo menos um n&uacute;mero de telefone</label></div>
						<div class="clearfix"></div>
						<div class="required form-group">
							<label class="control-label col-sm-4" for="phone_mobile">Telefone celular <sup>**</sup></label>
							<div class="col-sm-6">
								<input class="validate form-control" data-validate="isPhoneNumber" type="tel" id="phone_mobile" name="phone_mobile" value="" />
							</div>
						</div>
						<div class="required dni form-group unvisible">
							<label class="control-label col-sm-4" for="dni">N&uacute;mero de identifica&ccedil;&atilde;o <sup>*</sup></label>
							<div class="col-sm-6">
								<input class="is_required form-control" data-validate="isDniLite" type="text" name="dni" id="dni" value="" />
								<span class="form_info">DNI / NIF / NIE</span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4" for="other">Informa&ccedil;&otilde;es adicionais</label>
							<div class="col-sm-6">
								<textarea class="validate form-control" data-validate="isMessage" id="other" name="other" cols="26" rows="3" ></textarea>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="required form-group" id="adress_alias">
							<label class="control-label col-sm-4" for="alias">Identifique este endere&ccedil;o para futura refer&ecirc;ncia <sup>*</sup></label>
							<div class="col-sm-6">
								<input type="text" id="alias" class="is_required validate form-control" data-validate="isGenericName" name="alias" value="Meu endere&ccedil;o" />
							</div>
						</div>
						<p class="submit2 text-right">
							<input type="hidden" name="id_address" value="0" />			<input type="hidden" name="back" value="order.php?step=1&amp;multi-shipping=0" />						<input type="hidden" name="select_address" value="0" />			<input type="hidden" name="token" value="76a0ad76a75dad2f86e01eb8a1e04e1c" />		
							<button type="submit" name="submitAddress" id="submitAddress" class="btn btn-outline button button-medium">
							<span>
							Salvar
							</span>
							</button>
						</p>
					</form>
				</div>
				<ul class="footer_links clearfix">
					<li class="pull-left">
						<a class="btn btn-outline button button-small btn-sm" href="http://demo4leotheme.com/prestashop/shopping/br/addresses">
						<span><i class="fa fa-user"></i> Voltar para seus endere&ccedil;os</span>
						</a>
					</li>
				</ul>
			</section>
		</div>
	</div>
</section>