<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 product-img-box">
    <div class="image">
        <span class="new-icon"><span>Novo</span></span>
        <span class="onsale"><span>Oferta</span></span>
        <a href="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/p/r/product-13-1-500x717_12.jpg" title="Farlap Shirt - Ruby Wines" class="colorbox">
        <img id="image" src="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/image/490x368/9df78eab33525d08d6e5fb8d27136e95/p/r/product-13-1-500x717_12.jpg" alt="Farlap Shirt - Ruby Wines" title="Farlap Shirt - Ruby Wines" data-zoom-image="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/p/r/product-13-1-500x717_12.jpg" class="product-image-zoom"/>        </a>
    </div>

     <div id="image-additional" class="image-additional slide carousel more-views">
        <div class="carousel-inner" id="image-gallery-zoom">


            <?php 

            $variable = array(1,1,1,2,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,);


            $i = 0;
            echo '<div class="item row">';

            foreach ($variable as $key => $value) {

                if($i !== 0 && $i%4 === 0){
                    echo '</div><div class="item row">';
                }
                
                echo '<a href="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/thumbnail/9df78eab33525d08d6e5fb8d27136e95/p/r/product-8-500x717_8.jpg" title="" class="colorbox" data-zoom-image="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/thumbnail/9df78eab33525d08d6e5fb8d27136e95/p/r/product-8-500x717_8.jpg" data-image="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/thumbnail/490x368/9df78eab33525d08d6e5fb8d27136e95/p/r/product-8-500x717_8.jpg">
                    <img src="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/thumbnail/100x75/9df78eab33525d08d6e5fb8d27136e95/p/r/product-8-500x717_8.jpg"  title="" alt="" data-zoom-image="http://venusdemo.com/magento/superstore/media/catalog/product/cache/1/thumbnail/9df78eab33525d08d6e5fb8d27136e95/p/r/product-8-500x717_8.jpg" class="product-image-zoom" />
                </a>';
                $i++;

            }
            echo '</div>';

            ?>

        </div>
        <a class="carousel-control left" href="#image-additional" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#image-additional" data-slide="next">&rsaquo;</a>
    </div>

    <script type="text/javascript">
        jQuery('#image-additional .item:first').addClass('active');
        jQuery('#image-additional').carousel({interval:false})
    </script>

    <script type="text/javascript" src="/superstore/js/venustheme/ves_tempcp/jquery/elevatezoom/elevatezoom-min.js"></script>
    
    <script type="text/javascript">
        jQuery("#image").elevateZoom({
                 gallery:'image-gallery-zoom', 
           cursor: 'pointer', 
           lensShape : "basic",
           lensSize    : 150,
           galleryActiveClass: 'active'});
        
    </script>

    <script type="text/javascript">
        <!--
        jQuery(document).ready(function() {
          jQuery('.colorbox').colorbox({
            width: '540', 
            height: '406',
            overlayClose: true,
            opacity: 0.5,
            rel: "colorbox"
          });
          jQuery('#image-gallery-zoom').find("a").click(function(){
            if(jQuery(".product-img-box .image a").length > 0) {
              var image_link = jQuery(this).attr("href");
              jQuery(".product-img-box .image a").attr("href", image_link);
            }
          })
        });
        //-->
    </script> 
</div>
