<div id="slideshow" class="clearfix">
	<div class="row" >
		<div class="widget col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12" >
			<div class="bannercontainer banner-fullwidth" style="padding: 0;margin: 0px 0px 20px;background-color:#d9d9d9">
				<div id="sliderlayerHome" class="rev_slider fullwidthbanner" style="width:100%;height:370px; " >
					
					<?php echo $GLOBALS['BannerShopping']['res_sliderlayer_all']; ?>

					<ul>

						<?php
						/*
						?>
						<li data-masterspeed="300" data-transition="random" data-slotamount="7" data-thumb="<?php echo CDN ?>'static/img/banner/sliderlayer/slideshow.png">
							<img src="<?php echo CDN ?>'static/img/banner/sliderlayer/slideshow.png" alt=""/>
							<div class="caption fade easeOutExpo"
								data-x="0"
								data-y="0"
								data-speed="300"
								data-start="400"
								data-easing="easeOutExpo">
								<img src="<?php echo CDN. 'static/img/banner/sliderlayer/'. $banner['BannerShopping']['caminho']; ?>" alt=""/>
							</div>

							<div class="caption fade easeOutExpo"
								data-x="49"
								data-y="56"
								data-speed="300"
								data-start="800"
								data-easing="easeOutExpo">
								<img src="<?php echo CDN. 'static/img/banner/sliderlayer/'. $banner['BannerShopping']['slide']; ?>" alt=""/>
							</div>

						</li>

						<li data-masterspeed="300" data-transition="random" data-slotamount="7" data-thumb="<?php echo CDN ?>'static/img/banner/sliderlayer/slideshow.png">
							<img src="<?php echo CDN ?>'static/img/banner/sliderlayer/slideshow.png" alt=""/>
							<div class="caption fade easeOutExpo"
								data-x="0"
								data-y="0"
								data-speed="300"
								data-start="400"
								data-easing="easeOutExpo">
								<img src="<?php echo CDN. 'static/img/banner/sliderlayer/'. $banner['BannerShopping']['caminho']; ?>" alt=""/>
							</div>

							<div class="caption big_orange fade easeOutExpo"
								data-x="79"
								data-y="139"
								data-speed="300"
								data-start="800"
								data-easing="easeOutExpo"style="font-size:48px;background-color:transparent;color:#ffffff">
								Summer Hat
							</div>

							<div class="caption big_white sft easeOutExpo"
								data-x="214"
								data-y="96"
								data-speed="300"
								data-start="1200"
								data-easing="easeOutExpo"style="background-color:transparent">
								The Perfect
							</div>

							<div class="caption medium_text sfb easeOutExpo"
								data-x="115"
								data-y="194"
								data-speed="300"
								data-start="1600"
								data-easing="easeOutExpo"style="font-size:18px;color:#ffffff">
								Universally Flattering
							</div>
						
						</li>

						<li data-masterspeed="300" data-transition="random" data-slotamount="7" data-thumb="<?php echo CDN ?>'static/img/banner/sliderlayer/slideshow.png">
							<img src="<?php echo CDN ?>'static/img/banner/sliderlayer/slideshow.png" alt=""/>
							<div class="caption fade easeOutExpo"
								data-x="0"
								data-y="0"
								data-speed="300"
								data-start="400"
								data-easing="easeOutExpo">
								<img src="<?php echo CDN. 'static/img/banner/sliderlayer/'. $banner['BannerShopping']['caminho']; ?>" alt=""/>
							</div>
						</li>

						<?php
						*/
						?>

						

					</ul>
					<div class="tp-bannertimer tp-top"></div>
				</div>
			</div>
			<script type="text/javascript">
				var tpj=jQuery;
				
				if (tpj.fn.cssOriginal!=undefined)
				tpj.fn.css = tpj.fn.cssOriginal;
				
				tpj("#sliderlayerHome").revolution(
				{
					delay:9000,
				startheight:370,
				startwidth:875,
				
				
				hideThumbs:0,
				
				thumbWidth:100,                     
				thumbHeight:50,
				thumbAmount:5,
								 navigationType:"bullet",
								 navigationArrows:"verticalcentered",                
								 navigationStyle:"round",          
				
				navOffsetHorizontal:0,
					 navOffsetVertical:20,  
				
				touchenabled:"on",         
				onHoverStop:"on",                     
				shuffle:"on",  
				stopAtSlide: -1,                        
				stopAfterLoops:-1,                     
				
				hideCaptionAtLimit:0,              
				hideAllCaptionAtLilmit:0,              
				hideSliderAtLimit:0,           
				fullWidth:"on",
				shadow:0
				});
				$( document ).ready(function() {
				   $('.caption',$('#sliderlayerHome')).click(function(){
					   if($(this).data('link') != undefined && $(this).data('link') != '') location.href = $(this).data('link');
				   });
				});
				
			</script>

			<?php
			//widget-tab
			//App::import('Vendor', 'Company'. DS .'Includes'. DS .'themes'. DS .'widget-tab');
			?>

		</div>
	</div>
</div>