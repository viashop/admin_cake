<div class="footer-top">
  <div class="container">
      <!-- Botton Skype BEGIN-->
    <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
    <!-- Botton Skype END-->

    <!-- AddThis Smart Layers BEGIN -->
    <!-- Go to http://www.addthis.com/get/smart-layers to customize -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5379d9ee05f4ffa5"></script>
    <script type="text/javascript">
      var share_desktop = true;
      var share_mobile = false;
      var follow_desktop = false;
      var follow_mobile = false;
      var mobile = false;
      addthis.layers({
        'theme' : 'transparent',
        'domain' : '<?php echo sprintf("//%s", env("HTTP_HOST") ); ?>',
        'linkFilter' : function(link, layer) {
          console.log(link.title + ' - ' + link.url + " - " + layer);
          return link;
        },
        'responsive' : {
          'maxWidth' : '979px',
          'minWidth' : '0px'
        },
        'share' : {
          'position' : 'right',
          'services' : 'facebook,more,print,tumblr,linkedin,gmail,google_plusone_share,hotmail',
          'postShareTitle' : 'Obrigado por compartilhar!',
          'postShareFollowMsg' : 'Follow us',
          'desktop' : share_desktop,
          'mobile' : share_mobile,
          'theme' : 'transparent'
        },
        'follow' : {                 'services' : [                    {'service' : 'twitter', 'id' : '<?php echo @$GLOBALS["rs_twitter"]; ?>'},
                    {'service' : 'linkedin', 'id' : ''},
                ],
        
          'title' : 'Follow',
          'postFollowTitle' : 'Obrigado por seguir!',
          'desktop' : follow_desktop,
          'mobile' : follow_mobile,
          'theme' : 'transparent'
        },

        'mobile' : {
          'buttonBarPosition' : 'bottom',
          'buttonBarTheme' : 'light',
          'mobile' : mobile
        }
      });
    </script>
      <!-- AddThis Smart Layers BEGIN -->
      <!-- Go to http://www.addthis.com/get/smart-layers to customize -->
      <div class="block module_newletter ">
          <div class="block-content">
              <div class="new-letter">
                  <div class="row">
                      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                          <div class="custom-subscribe">
                              <i class="fa fa-envelope-o"></i>
                              <div class="title">
                                  <h3>CADASTRE-SE</h3>
                                  
                                  <span>E receba ofertas especiais</span>
                              </div>
                              <form action="<?php echo sprintf('//%s/newsletter/cadastrar', env('HTTP_HOST') ); ?>" method="post" id="newsletter-validate-detail">
                  
                                  <?php                   
                                  if (!\Lib\Validate::isBot()) {

                                    echo "<input type='hidden' name='token' value='". sha1(mt_rand(0,mt_getrandmax())) ."' />". PHP_EOL;                    
                                    echo '<input type="hidden" name="id_shop_default" value="'. ID_SHOP_DEFAULT .'" />'. PHP_EOL;
                                    echo '<input type="text" class="hidden" name="url_default" value="">'. PHP_EOL;
                                    echo '<input type="text" class="hidden" name="ckeck" value="">'. PHP_EOL;
                                    echo '<input style="position: absolute; width: 1px; top: -5000px; left: -5000px;" name="name" type="text">'. PHP_EOL;
                                  
                                  }
                                  ?>
                                  <div class="subscribe-box">
                                      <div class="input-box">
                                          <input type="text" name="email" id="newsletter" title="Entre com seu melhor e-mail!" class="input-text required-entry validate-email form-control" />
                                      </div>
                                      <div class="actions">
                                          <button type="submit" title="Cadastrar" class="button"><span><span>Cadastrar</span></span></button>
                                      </div>
                                  </div>
                              </form>
                              <script type="text/javascript">
                                  //<![CDATA[
                                      var newsletterSubscriberFormDetail = new VarienForm('newsletter-validate-detail');
                                  //]]>
                              </script>
                          </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                          <div class="social-link">
                            <h3 class="title_block">Siga-nos no</h3>
                            <ul class="social">

                              <?php if (!empty($GLOBALS['ShopRedeSocial']['facebook'])): ?>
                              <li><a class="facebook" href="<?php echo $GLOBALS['ShopRedeSocial']['facebook']; ?>" target="_BLANK" title="Facebook"> <em class="fa fa-facebook stack"><span>Facebook</span></em> </a></li>
                              <?php else: ?>
                              <li><a class="facebook" rel="nofollow" href="#" title="Facebook"> <em class="fa fa-facebook stack"><span>Facebook</span></em> </a></li>
                              <?php endif ?>

                              <?php if (!empty($GLOBALS['ShopRedeSocial']['twitter'])): ?>
                              <li><a class="twitter" href="<?php echo $GLOBALS['ShopRedeSocial']['twitter']; ?>" target="_BLANK" title="Twitter"> <em class="fa fa-twitter stack"><span>Twitter</span></em> </a></li>
                              <?php else: ?>
                              <li><a class="twitter" rel="nofollow" href="#" title="Twitter"> <em class="fa fa-twitter stack"><span>Twitter</span></em> </a></li>
                              <?php endif ?>

                              <?php if (!empty($GLOBALS['ShopRedeSocial']['google_plus'])): ?>
                              <li><a class="google-plus" href="<?php echo $GLOBALS['ShopRedeSocial']['google_plus']; ?>" target="_BLANK" title="Google Plus"> <em class="fa fa-google-plus stack"> <span>Google Plus</span> </em> </a></li>
                              <?php else: ?>
                              <li><a class="google-plus" rel="nofollow" href="#" title="Google Plus"> <em class="fa fa-google-plus stack"> <span>Google Plus</span> </em> </a></li>
                              <?php endif ?>

                              <?php if (!empty($GLOBALS['ShopRedeSocial']['instagram'])): ?>
                              <li><a class="instagram" href="<?php echo $GLOBALS['ShopRedeSocial']['instagram']; ?>" target="_BLANK" title="Instagram"> <em class="fa fa-instagram stack"><span>Facebook</span></em> </a></li>
                              <?php endif ?>

                              <?php if (!empty($GLOBALS['ShopRedeSocial']['pinterest'])): ?>
                              <li><a class="pinterest" href="<?php echo $GLOBALS['ShopRedeSocial']['pinterest']; ?>" target="_BLANK" title="Pinterest"> <em class="fa fa-pinterest stack"><span>Facebook</span></em> </a></li>
                              <?php endif ?>

                              <?php if (!empty($GLOBALS['ShopRedeSocial']['youtube'])): ?>
                              <li><a class="youtube" href="<?php echo $GLOBALS['ShopRedeSocial']['youtube']; ?>" target="_BLANK" title="Youtube"> <em class="fa fa-youtube stack"> <span>Youtube</span> </em> </a></li> 
                              <?php endif ?>

                              <?php if (!empty($GLOBALS['ShopRedeSocial']['skype'])): ?>
                              <li><a class="skype" href="<?php echo sprintf('skype:%s?chat', $GLOBALS['ShopRedeSocial']['skype'] ); ?>" title="Skype"> <em class="fa fa-skype stack"> <span>Skype</span> </em> </a></li>
                              <?php endif ?>
                              
                              
                            </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="clear clr"></div>
          </div>
      </div>
  </div>
</div>
