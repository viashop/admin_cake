<div id="powered">
	<div class="container">
		<div class="copyright">
			<div class="row">
				<div class="col-md-7 col-lg-7 col-sm-7 col-xs-12">
					<div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>Top</a></div>					

					<?php if (isset($GLOBALS['ConfiguracaoPagamento'])): ?>
						
					<h4>formas de pagamento</h4>

					<?php endif ?>

					<p style="margin-top:5px;">

						<?php
					
                        if ($GLOBALS['ConfiguracaoPagamento'] !== null) {

                        	$records = array_column($GLOBALS['ConfiguracaoPagamento'], 'ConfiguracaoPagamento');

                        	function arrays_unique($string='')
                        	{
                        		$string = array_diff($string, array("none"));
                        		return array_unique($string);
                        	}
                        	
                        	$cartao_visa = arrays_unique( array_column($records, 'cartao_visa') );
                        	$cartao_master_card = arrays_unique( array_column($records, 'cartao_master_card') );
                        	$cartao_hipercard = arrays_unique( array_column($records, 'cartao_hipercard') );
                        	$banco_itau = arrays_unique( array_column($records, 'banco_itau') );
                        	$banco_bradesco = arrays_unique( array_column($records, 'banco_bradesco') );
                        	$banco_bb = arrays_unique( array_column($records, 'banco_bb') );
                        	$boleto = arrays_unique( array_column($records, 'boleto') );                        	
                        	

                        	if (isset($cartao_visa[0]) && $cartao_visa[0] == 'greycheck') {
                        		echo '<img  style="margin: 15px 15px 15px 0" src="'. sprintf('%s/static/img/samples/visa.png', CDN) .'" title="Cartão visa" alt="Cartão visa" />';
                        	}                        

                        	if (isset($cartao_master_card[0]) && $cartao_master_card[0] == 'greycheck') {
                        		echo '<img  style="margin: 15px 15px 15px 0" src="'. sprintf('%s/static/img/samples/mastercard.png', CDN) .'" title="Cartão Mastercard" alt="Cartão Mastercard" />';
                        	}

                        	if (isset($cartao_hipercard[1]) && $cartao_hipercard[1] == 'greycheck') {
                        		echo '<img  style="margin: 15px 15px 15px 0" src="'. sprintf('%s/static/img/samples/hipercard.png', CDN) .'" title="Cartão Hipercard" alt="Cartão Hipercard" />';
                        	} elseif (isset($cartao_hipercard[0]) && $cartao_hipercard[0] == 'greycheck') {
                        		echo '<img  style="margin: 15px 15px 15px 0" src="'. sprintf('%s/static/img/samples/hipercard.png', CDN) .'" title="Cartão Hipercard" alt="Cartão Hipercard" />';
                        	}

                        	if (isset($banco_itau[0]) && $banco_itau[0] == 'greycheck') {
                        		echo '<img  style="margin: 15px 15px 15px 0" src="'. sprintf('%s/static/img/samples/itau.png', CDN) .'" title="Banco Itaú" alt="Banco Itaú" />';
                        	}

                        	if (isset($banco_bradesco[0]) && $banco_bradesco[0] == 'greycheck') {
                        		echo '<img  style="margin: 15px 15px 15px 0" src="'. sprintf('%s/static/img/samples/bradesco.png', CDN) .'" title="Banco Bradesco" alt="Banco Bradesco" />';
                        	}

                        	if (isset($banco_bb[0]) && $banco_bb[0] == 'greycheck') {
                        		echo '<img  style="margin: 15px 15px 15px 0" src="'. sprintf('%s/static/img/samples/bb.png', CDN) .'" title="Banco do Brasil" alt="Banco do Brasil" />';
                        	}

                        	if (isset($boleto[0]) && $boleto[0] == 'greycheck') {
                        		echo '<img  style="margin: 15px 15px 15px 0" src="'. sprintf('%s/static/img/samples/boleto.png', CDN) .'" title="Boleto" alt="Boleto" />';
                        	}

                        }
                        ?>

					</p>


					<p style="margin-top:5px;">

						<?php
					
                        if ($GLOBALS['ConfiguracaoPagamento'] !== null) {

                            foreach ($GLOBALS['ConfiguracaoPagamento'] as $key => $intermediador) {

                                echo '<img  style="margin: 15px 15px 15px 0" src="'. sprintf('%s/static/img/formas-de-pagamento/%s', CDN , $intermediador['ConfiguracaoPagamento']['logo']) .'" alt="'. $intermediador['ConfiguracaoPagamento']['nome']  .'" title="'. $intermediador['ConfiguracaoPagamento']['nome']  .'" />';

                            }
                        }
                        ?>

					</p>

				</div>
				<div class="col-md-5 col-lg-5 col-sm-5 col-xs-12">


					<?php if (isset($GLOBALS['ShopSelos']['mostrar_txt_certificados'])): ?>
						
					<h4>certificados</h4>
					
					<?php endif ?>			
					

                	<?php if (!empty($GLOBALS['ShopSelos']['banner_ebit'])): ?>
              
					<div class="row">

						<?php echo \Lib\Tools::htmlentitiesDecodeUTF8( $GLOBALS['ShopSelos']['banner_ebit'] ); ?>

					</div>

					<?php endif ?>

					<div class="row">

						<?php if (!empty($GLOBALS['ShopSelos']['selo_ebit'])): ?>

						<div class="col-md-3 col-lg-3 col-sm-3 col-xs-12">

							<?php echo \Lib\Tools::htmlentitiesDecodeUTF8( $GLOBALS['ShopSelos']['selo_ebit'] ); ?>							

						</div>

						<?php endif ?>

						<div class="col-md-9 col-lg-9 col-sm-9 col-xs-12">

							<?php if (isset($GLOBALS['ShopSelos']['selo_google_safe']) && $GLOBALS['ShopSelos']['selo_google_safe'] == 'on'): ?>

							<a href="http://www.google.com/safebrowsing/diagnostic?site=<?php echo env('HTTP_HOST'); ?>" target="_BLANK" title="Google Browsing Safe">
								<img  style="margin: 15px 15px 15px 0" src="<?php echo sprintf('%s/static/img/selos/google-safe-browsing.png', CDN)  ?>" alt="" />
							</a>

							<?php endif ?>

							<?php if (isset($GLOBALS['ShopSelos']['selo_norton_secured']) && $GLOBALS['ShopSelos']['selo_norton_secured'] == 'on'): ?>

							<a href="https://safeweb.norton.com/report/show?url=<?php echo env('HTTP_HOST'); ?>" target="_BLANK" title="Norton Secured">
								<img  style="margin: 15px 15px 15px 0" src="<?php echo sprintf('%s/static/img/selos/norton-secured.png', CDN)  ?>" alt="" />
							</a>

							<?php endif ?>


							<?php 
							/*

							if (isset($GLOBALS['selo_seomaster']) && $GLOBALS['selo_seomaster'] == 'on'): ?>

							

							<?php endif */ ?>

						</div>						

					</div>					

				</div>

			</div>

			<div class="row">

			<hr>

				<div style="font-size:12px; margin:20px 0 -15px 0;" align="center">
					<?php 

					if ($GLOBALS['Shop']['loja_tipo'] == 'PF') {

						echo $GLOBALS['Shop']['loja_nome_responsavel'] . ' - CPF: ' .
						$GLOBALS['Shop']['loja_cpf'] . ' ';

					} elseif ($GLOBALS['Shop']['loja_tipo'] == 'PJ') {

						echo $GLOBALS['Shop']['loja_nome_responsavel'] . ' - CNPJ: ' .
						$GLOBALS['Shop']['loja_cpf'] . ' ';

					}

					echo '© Copyright '. date('Y') .' - Todos os direitos reservados.';

					?>
					
				</div>

				<?php 

				if ( ( strpos( env('HTTP_HOST'), 'vialoja') === false ) && ( $GLOBALS['Shop']['id_plano'] <= 1) ) : 

				?>

					<div style="margin-top:15px;" align="center">

						<a href="http://vialoja.com.br" title="ViaLoja.com">
							<img  style="margin: 15px 15px -25px 0" src="<?php echo sprintf('%s/static/img/vialoja/logos/footer-loja/logo.png', CDN); ?>" alt="ViaLoja.com" />
						</a>
						
					</div>

				<?php endif ?>

			</div>
		</div>
	</div>
	
</div>
<section id="before_body_end">
	
</section>