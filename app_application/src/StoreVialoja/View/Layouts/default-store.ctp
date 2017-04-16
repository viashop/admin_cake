<?php
ob_start();
function ob_get_length_callback() {
    return ob_get_length();
}
?>
<!DOCTYPE html>
<html dir="ltr" class="ltr" lang="pt-BR">   
	<?php

	if (defined('HOME_SHOP_LOJA')) {
		App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'head_inc'.DS.'home');
		echo '<body id="offcanvas-container" class="  cms-index-index cms-home offcanvas-container layout-fullwidth fs13  ">';
	}
	
	if (defined('PRODUTO_SHOP_LOJA')) {
		App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'head_inc'.DS.'produto');
		echo '<body id="offcanvas-container" class="  catalog-product-view catalog-product-view product-farlap-shirt-ruby-wines categorypath-desktops-html category-desktops offcanvas-container layout-fullwidth fs13  ">';
	}

	if (defined('CATEGORIA_SHOP_LOJA')) {
		App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'head_inc'.DS.'categoria');
		echo '<body id="offcanvas-container" class="  catalog-category-view categorypath-desktops-7-html category-desktops offcanvas-container layout-fullwidth fs13  ">';
	}

	if (defined('SEARCH_SHOP_LOJA')) {
		App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'head_inc'.DS.'categoria');
		echo '<body id="offcanvas-container" class="  catalog-category-view categorypath-desktops-7-html category-desktops offcanvas-container layout-fullwidth fs13  ">';
	}

	if (defined('CART_SHOP_LOJA')) {
		App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'head_inc'.DS.'cart');
		echo '<body id="offcanvas-container" class="  checkout-cart-index offcanvas-container layout-fullwidth fs13  ">';
	}

	if (defined('ONEPAGE_SHOP_LOJA')) {
		App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'head_inc'.DS.'cart');
		echo '<body id="offcanvas-container" class="  checkout-onepage-index offcanvas-container layout-fullwidth fs13  ">';
	}

	if (defined('CUSTOMER_SHOP_LOJA')) {

		App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'head_inc'.DS.'customer');

		if (defined('CUSTOMER_LOGIN_SHOP_LOJA')) {

			echo '<body id="offcanvas-container" class="  customer-account-login offcanvas-container layout-fullwidth fs13  ">';

		}

		if (defined('CUSTOMER_FORGOTPASSWORD_SHOP_LOJA')) {

			echo '<body id="offcanvas-container" class="  customer-account-forgotpassword offcanvas-container layout-fullwidth fs13  ">';

		}

		if (defined('CUSTOMER_CREATE_SHOP_LOJA')) {

			echo '<body id="offcanvas-container" class="  customer-account-create offcanvas-container layout-fullwidth fs13  ">';

		}

	}

	if (defined('WHISLIST_INDEX_SHOP_LOJA')) {
		App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'head_inc'.DS.'wishlist_index');

		echo '<body id="offcanvas-container" class="  wishlist-index-index offcanvas-container layout-fullwidth fs13  ">';
	}

	?>    
        <section id="page" class="offcanvas-pusher" role="main">
            <section id="header" class="header">
                <section id="topbar">
					
					<?php
					App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'menu-top-bar');
					?>                    
					
                </section>
				
                <section id="header-main">
				
					<?php
					App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'header-main');
					?>
                    
                </section>
				
                <section id="ves-mainnav">
				
					<?php
					App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'main-nav');
					?>
					
                </section>
            </section>
            
            <section id="sys-notification">
                <div class="container">
                    <div id="notification"><?php echo $this->Session->flash(); ?></div>
                </div>
            </section>
			
			<!-- BEGIN - Content -->
			<?php
			if (defined('MY_ACCOUNT')) {

			/**
			*
			* Add html < section id="columns" class="offcanvas-siderbars">
			* A estrutura do Html da conta de usuário é diferente do rentante do template
			*
			**/				

			?>

			<section id="columns" class="offcanvas-siderbars">
			    <div class="container">
			        
			        <?php
			        App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'customer_inc'.DS.'breadcrumbs');
			        ?>

			        <div class="row col2-left-layout">

			            <?php
			            App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'customer_inc'.DS.'aside-left');
			            ?>
						
			            <!-- BEGIN - Content -->
			            <?php			            
			            echo $this->fetch('content');
			            ?>
			            <!-- END -Content -->
							
			        </div>
			    </div>
			</section>

			<?php
			} else {

				/**
				*
				* A tag < section id="columns" class="offcanvas-siderbars">
				* está presente nas views de cada pagina
				*
				**/
				
				echo $this->Session->flash();
            	echo $this->fetch('content');
			}
			
			?>
			<!-- END -Content -->
			
            <section id="ves-massbottom1" class="ves-massbottom1">
                <div class="container">
				
					<?php

					if (!\Lib\Tools::hideIncludeCart()) {


						/*
						if (defined('HOME_SHOP_LOJA')) {
						
							//Somente index o resumo do blog
							App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'resumo-blog');
						
						}
						*/
						//marcas				

						App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'brand-carousel');
						/*
						App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'module-aboutus');
						*/

					}

					?>
					
                </div>
            </section>
			
            <section id="footer">                
				
				<?php

				if (!\Lib\Tools::hideIncludeCart()) {
					App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'footer-top');
				} else {
					echo '<br /><hr>';
				}

				App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'footer-links');

				App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'powered');
				?>                
				                
            </section>
			
			<?php
			//Otimização de cores e layout
			if ( CakeSession::read('cliente_nivel') > 1 ) {			
				App::import('Vendor', 'Company'. DS .'Includes'.DS.'themes'.DS.'default-store'.DS.'paneltool');
			}
			?>
			            
        </section>
    </body>
</html>
<?php 
$this->requestAction(
	array(
		'controller' => 'Log',
		'action' => 'shopVisitaAdd',
		'trafego_bytes' => ob_get_length_callback()
	) 
);