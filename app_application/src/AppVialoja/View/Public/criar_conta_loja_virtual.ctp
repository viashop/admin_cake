
<div id="content_area" class="">
<div style='border-top-width:1px;border-top-style:solid;border-top-color:#ededed;border-bottom-width:px;border-bottom-style:solid;border-bottom-color:;'  class="row one-column cf ui-sortable section" id="le_body_row_1" data-style="eyJib3JkZXJUb3BXaWR0aCI6IjEiLCJib3JkZXJUb3BDb2xvciI6IiNlZGVkZWQiLCJib3JkZXJCb3R0b21XaWR0aCI6IiIsImJvcmRlckJvdHRvbUNvbG9yIjoiIiwiYWRkb24iOnt9fQ==">
	<div class="fixed-width">
		<div class="one-column column cols" id="le_body_row_1_col_1">
			<?=$this->Session->flash();?>
		</div>
	</div>
</div>
<div  class="row two-columns cf ui-sortable" id="le_body_row_2" data-style="">
	<div class="fixed-width">
		<div class="one-half column cols" id="le_body_row_2_col_1">
			<div class="element-container cf" data-style="" id="le_body_row_2_col_1_el_1">
				<div class="element">
					<h2 style='font-size:40px;text-align:left;margin-bottom:20px; margin-top: -70px;'>Comece sua LOJA Gratuitamente.</h2>
				</div>
			</div>
			<div class="element-container cf" data-style="" id="le_body_row_2_col_1_el_2">
				<div class="element">
					<ul class="bullet-list 1" >
						<li style='background-image:url("http://vialoja.com.br/d/wp-content/plugins/optimizePressPlugin/lib/assets/images/bullet_block/32x32/13.png");background-repeat:no-repeat;font-size:30px;font-style:normal;font-weight:normal;'>Sem propagandas</li>
						<li style='background-image:url("http://vialoja.com.br/d/wp-content/plugins/optimizePressPlugin/lib/assets/images/bullet_block/32x32/13.png");background-repeat:no-repeat;font-size:30px;font-style:normal;font-weight:normal;'>Sem comissões</li>
						<li style='background-image:url("http://vialoja.com.br/d/wp-content/plugins/optimizePressPlugin/lib/assets/images/bullet_block/32x32/13.png");background-repeat:no-repeat;font-size:30px;font-style:normal;font-weight:normal;'>Sem taxas</li>
						<li style='background-image:url("http://vialoja.com.br/d/wp-content/plugins/optimizePressPlugin/lib/assets/images/bullet_block/32x32/13.png");background-repeat:no-repeat;font-size:30px;font-style:normal;font-weight:normal;'>Sem complicações</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="one-half column cols" id="le_body_row_2_col_2">
			<div class="element-container cf" data-style="" id="le_body_row_2_col_2_el_1">
				<div class="element">

					<div id="562676b12b088" class="optin-box optin-box-24" style="margin-right: auto;margin-left: auto; margin-top: -70px;">

						<div class="element-container cf" data-style="" id="le_body_row_1_col_1_el_1">
							<div class="element">
								<h2 style='font-size:30px;font-style:normal;font-weight:normal;color:#009BCB;text-align:left;'>Criar conta <strong>Loja Virtual</strong></h2>
							</div>
						</div>

						<form action="/public/criar-conta-loja-virtual/" method="post" class="cf op-optin-validation">
							<div style="display:none"><input type="hidden" name="op_optin_form" value="Y" /></div>
							
							<input type="text" required="required" name="nome" placeholder="Informe seu nome completo" value="<?php if(isset($nome)){ echo $nome; }?>" />

							<input type="email" required="required" name="email" placeholder="Informe seu email" value="<?php if(isset($email)){ echo $email; }?>" />

							<div class="text-box"><input type="password" min="6" maxlength="32" required="required" id="senha" name="senha" placeholder="Informe sua senha" value="" /></div>

							<div id="pstrength">
	                            <div id="input_senha_minchar"></div>
	                        </div> 

							<div class="text-box"><input type="password"  min="6" maxlength="32" required="required" name="confirmacao_senha" placeholder="Repetir sua senha" value="" /></div>

							<div class="text-box">

							<h2 style="font-size:12px;font-family:Arial, sans-serif;font-style:normal;font-weight:normal;color:#808080;text-align:center;">Ao clicar em <strong>Confirmar</strong>, você concorda com nossos <a href="http://vialoja.com.br/d/termos-de-uso/" target="_blank">Termos</a> e que você leu nossa <a href="http://vialoja.com.br/d/politica-de-privacidade/" target="_blank">Política de Dados</a>, incluindo nosso <a href="http://vialoja.com.br/d/informacoes-sobre-cookies/" target="_blank">Uso de Cookies</a>.</h2>

							</div>

							<input type='hidden' name='CSRFGuardName' value='<?php echo $CSRFGuardName; ?>' />
							
        					<input type='hidden' name='CSRFGuardToken' value='<?php echo $CSRFGuardToken; ?>' />


							<div style="text-align:center">
								<style type="text/css">#btn_1_d81ab65fcdaf4b6da1c8162604b8dfbb .text {font-size:32px;color:#f2f2f2;font-family:Arial, sans-serif;font-weight:bold;}#btn_1_d81ab65fcdaf4b6da1c8162604b8dfbb {padding:22px 40px;border-color:#009BCB;border-width:0px;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;background:#009BCB;background:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #009BCB), color-stop(100%, #009BCB));background:-webkit-linear-gradient(top, #009BCB 0%, #009BCB 100%);background:-moz-linear-gradient(top, #009BCB 0%, #009BCB 100%);background:-ms-linear-gradient(top, #009BCB 0%, #009BCB 100%);background:-o-linear-gradient(top, #009BCB 0%, #009BCB 100%);background:linear-gradient(to bottom, #009BCB 0%, #009BCB 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#009BCB, endColorstr=#009BCB, GradientType=0);box-shadow:none;}#btn_1_d81ab65fcdaf4b6da1c8162604b8dfbb .gradient {-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;}#btn_1_d81ab65fcdaf4b6da1c8162604b8dfbb .shine {-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;}#btn_1_d81ab65fcdaf4b6da1c8162604b8dfbb .active {-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;}#btn_1_d81ab65fcdaf4b6da1c8162604b8dfbb .hover {-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;}</style>
								<button type="submit" id="btn_1_d81ab65fcdaf4b6da1c8162604b8dfbb" class="css-button style-1 location_optin_box_style_24"><span class="text">Confirmar</span><span class="hover"></span><span class="active"></span></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div  class="row one-column cf ui-sortable" id="le_body_row_3" data-style="">
	<div class="fixed-width">
		<div class="one-column column cols" id="le_body_row_3_col_1">
			<div class="element-container cf" data-style="" id="le_body_row_3_col_1_el_1">
				<div class="element">
					<div style="height:60px"></div>
				</div>
			</div>
		</div>
	</div>
</div>