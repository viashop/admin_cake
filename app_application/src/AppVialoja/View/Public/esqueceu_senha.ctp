<div style='border-top-width:1px;border-top-style:solid;border-top-color:#ededed;border-bottom-width:px;border-bottom-style:solid;border-bottom-color:;'  class="row one-column cf ui-sortable section" id="le_body_row_1">
	<div class="fixed-width">
		<div class="one-column column cols" id="le_body_row_1_col_1">
			<div class="element-container cf" data-style="" id="le_body_row_1_col_1_el_1">
				<div class="element">
					<h2 style='font-size:30px;color:#009BCB;text-align:left;'>Esqueceu sua senha?</h2>
				</div>
			</div>

			<div class="element-container cf" data-style="" id="le_body_row_1_col_1_el_2">
				<div class="element">
					<h2 style='font-size:14px;font-family:Arial, sans-serif;font-style:normal;font-weight:normal;color:#666666;text-align:center;margin-top:10px;'>Para iniciar a recuperação da sua senha, preencha o endereço de email cadastrado e aguarde as instruções que serão enviadas por email.</h2>
				</div>
			</div>

			<?=$this->Session->flash();?>

		</div>
	</div>
</div>
<div style='padding-top:0px;padding-bottom:10px;border-top-width:px;border-top-style:solid;border-top-color:;border-bottom-width:px;border-bottom-style:solid;border-bottom-color:;'  class="row one-column cf ui-sortable section" id="le_body_row_2">
	<div class="fixed-width">
		<div class="one-column column cols" id="le_body_row_2_col_1">
			<div class="element-container cf" data-style="" id="le_body_row_2_col_1_el_1">
				<div class="element">
					<div id="5625d31069d67" class="optin-box optin-box-24" style="margin-right: auto;margin-left: auto;">
						<form action="<?php echo Router::url(); ?>" method="post" class="cf op-optin-validation">
							<input type="email" required="required" name="email" placeholder="Informe seu email cadastrado" value="<?php if(isset($email)){echo $email;}?>" />
							<div style="text-align:center">
								<style type="text/css">#btn_1_9894b86652d2e265a6e99705ac3ad7f9 .text {font-size:32px;color:#f2f2f2;font-family:Arial, sans-serif;font-weight:bold;}#btn_1_9894b86652d2e265a6e99705ac3ad7f9 {padding:22px 40px;border-color:#009BCB;border-width:0px;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;background:#009BCB;background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #009BCB), color-stop(100%, #009BCB));background:-webkit-linear-gradient(top, #009BCB 0%, #009BCB 100%);background:-moz-linear-gradient(top, #009BCB 0%, #009BCB 100%);background:-ms-linear-gradient(top, #009BCB 0%, #009BCB 100%);background:-o-linear-gradient(top, #009BCB 0%, #009BCB 100%);background:linear-gradient(to bottom, #009BCB 0%, #009BCB 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#009BCB, endColorstr=#009BCB, GradientType=0);box-shadow:none;}#btn_1_9894b86652d2e265a6e99705ac3ad7f9 .gradient {-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;}#btn_1_9894b86652d2e265a6e99705ac3ad7f9 .shine {-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;}#btn_1_9894b86652d2e265a6e99705ac3ad7f9 .active {-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;}#btn_1_9894b86652d2e265a6e99705ac3ad7f9 .hover {-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;}</style>
								<button type="submit" id="btn_1_9894b86652d2e265a6e99705ac3ad7f9" class="css-button style-1 location_optin_box_style_24"><span class="text">Recuperar Senha</span><span class="hover"></span><span class="active"></span></button>
								<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
        					<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="element-container cf" data-style="" id="le_body_row_2_col_1_el_2">
				<div class="element">
					<div style="height:20px"></div>
				</div>
			</div>
			<div class="element-container cf" data-style="" id="le_body_row_2_col_1_el_3">
				<div class="element">
					<h2 style='font-size:12px;font-family:Arial, sans-serif;font-style:normal;font-weight:normal;text-align:center;'><a title="Voltar para login" href="/public/login/">← Voltar para login</a></h2>
				</div>
			</div>
			<div class="element-container cf" data-style="" id="le_body_row_2_col_1_el_4">
				<div class="element">  </div>
			</div>
		</div>
	</div>
</div>