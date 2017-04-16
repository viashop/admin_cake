
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>CKEDitor | Selecione uma imagem para incorporar</title>
        <link rel="stylesheet" href="/admin/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="/admin/css/bootstrap-datepicker.css" type="text/css">
        <link rel="stylesheet" href="/admin/css/jquery.switch.css" type="text/css">
        <link rel="stylesheet" href="/admin/css/jquery.fancybox.css" type="text/css">
        <link rel="stylesheet" href="/admin/css/custom.css" type="text/css">

        <link rel="stylesheet" href="/admin/js/galleriffic/css/basic.css" type="text/css" />
        <link rel="stylesheet" href="/admin/js/galleriffic/css/galleriffic-2.css" type="text/css" />
        <script type="text/javascript" src="/admin/js/galleriffic/js/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="/admin/js/galleriffic/js/jquery.galleriffic.js"></script>
        <script type="text/javascript" src="/admin/js/galleriffic/js/jquery.opacityrollover.js"></script>

        <!-- We only want the thunbnails to display when javascript is disabled -->
        <script type="text/javascript">
            document.write('<style>.noscript { display: none; }</style>');
        </script>
        <style type="text/css">
            .thumbs a { width: 80px; height: 80px; background: #EEE; }
            div.slideshow a.advance-link { height: auto; line-height: 1em; }
            div.slideshow span.image-wrapper { position: relative; }
            div.slideshow-container { height: auto; }
            div.caption-container { top: 0; }
        </style>
    </head>
    <body>
        <div id="page">
            <div id="container" style="width: 880px">
                <h3>Adicionar imagem</h3>
                
                    <p>Clique na imagem que deseja usar e depois clique em "Incorporar imagem" para adicioná-la no campo.</p>
                

                <!-- Start Advanced Gallery Html Containers -->
                <div id="gallery" class="content">
                    <div class="slideshow-container">
                        <div id="loading" class="loader"></div>
                        <div id="slideshow" class="slideshow"></div>
                    </div>
                    <div id="caption" class="caption-container"></div>
                </div>
                <div id="thumbs" class="navigation">
                    <ul class="thumbs noscript">
                        
                        <?php
                        foreach ($result as $key => $dados) {
                        ?>

                        <li>
                            <a class="thumb" href="<?php echo $arquivo . $dados['ShopArquivo']['nome']; ?>">

                                <img src="<?php echo $arquivo .'small/'. $dados['ShopArquivo']['nome']; ?>" />

                            </a>
                            <div class="caption">
                                <div class="submit-row">
                                    <input href="<?php echo $arquivo .'thickbox/'. $dados['ShopArquivo']['nome']; ?>" class="default embed btn btn-primary" type="submit" name="_embed" value="Incorporar imagem" />
                                </div>
                            </div>
                        </li>

                        <?php
                        }
                        ?>
                               
                    </ul>
                </div>
                <div style="clear: both;"></div>
            </div>
        </div>
        <script type="text/javascript">
            // helper functions
            function getUrlParam(paramName) {
                var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
                var match = window.location.search.match(reParam) ;

                return (match && match.length > 1) ? match[1] : '' ;
            }
            function scale_image() {
                var max_width = 500;
                var image = $(".advance-link > img");
                var image_width = image.width();
                if (image_width > max_width) {
                    var aspect = image.height() / image_width;
                    var image_height = max_width * aspect;
                    image.width(max_width);
                    image.height(image_height);
                }
            }

            // embedder
            $('.embed').live('click', function() {
                var funcNum = getUrlParam('CKEditorFuncNum');
                var fileUrl = $(this).attr('href');
                window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
                window.close();
            });

            // galleriffic
            jQuery(document).ready(function($) {
                // We only want these styles applied when javascript is enabled
                $('div.navigation').css({'width' : '300px', 'float' : 'left'});
                $('div.content').css('display', 'block');

                // Initially set opacity on thumbs and add
                // additional styling for hover effect on thumbs
                var onMouseOutOpacity = 0.67;
                $('#thumbs ul.thumbs li').opacityrollover({
                    mouseOutOpacity:   onMouseOutOpacity,
                    mouseOverOpacity:  1.0,
                    fadeSpeed:         'fast',
                    exemptionSelector: '.selected'
                });

                // Initialize Advanced Galleriffic Gallery
                var gallery = $('#thumbs').galleriffic({
                    delay:                     2500,
                    numThumbs:                 15,
                    preloadAhead:              10,
                    enableTopPager:            true,
                    enableBottomPager:         true,
                    maxPagesToShow:            7,
                    imageContainerSel:         '#slideshow',
                    controlsContainerSel:      '#controls',
                    captionContainerSel:       '#caption',
                    loadingContainerSel:       '#loading',
                    renderSSControls:          true,
                    renderNavControls:         true,
                    playLinkText:              'Play Slideshow',
                    pauseLinkText:             'Pause Slideshow',
                    prevLinkText:              '&lsaquo; Previous Photo',
                    nextLinkText:              'Next Photo &rsaquo;',
                    nextPageLinkText:          'Next &rsaquo;',
                    prevPageLinkText:          '&lsaquo; Prev',
                    enableHistory:             false,
                    autoStart:                 false,
                    syncTransitions:           false,
                    defaultTransitionDuration: 500,
                    onSlideChange:             function(prevIndex, nextIndex) {
                        // 'this' refers to the gallery, which is an extension of $('#thumbs')
                        this.find('ul.thumbs').children()
                            .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                            .eq(nextIndex).fadeTo('fast', 1.0);
                    },
                    onPageTransitionOut:       function(callback) {
                        this.fadeTo('fast', 0.0, callback);
                    },
                    onPageTransitionIn:        function() {
                        this.fadeTo('fast', 1.0);
                    },
                    onTransitionIn:        function(newSlide, newCaption, isSync) {
                        scale_image();
                        newSlide.fadeTo(this.getDefaultTransitionDuration(isSync), 1.0);
                        if (newCaption)
                            newCaption.fadeTo(this.getDefaultTransitionDuration(isSync), 1.0);
                    }
                });
            });
        </script>
    </body>
</html>
