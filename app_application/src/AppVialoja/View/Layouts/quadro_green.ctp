<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from codefeed.in.iis2103.shared-servers.com/tabs/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Thu, 10 Apr 2014 01:00:17 GMT -->
<head>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    echo $this->element('favicon');

    echo $this->Html->css(
                            array(
                                'bootstrap.min',
                                'bootstrap-responsive.min',
                                'preview.min',
                                'http://fonts.googleapis.com/css?family=PT+Sans:400,700',
                                'font-awesome.min',
                                'style',
                            )
                        );



    /*


    $this->set('description_for_layout','My page description');
    $this->set('keywords_for_layout','Keyword1,Keyword2,Keyword3');  //here you can load keywords dynamically
    echo $this->Html->meta( 'description',
        $description_for_layout
    );

    echo $this->Html->meta(
        'keywords',
        $keywords_for_layout
    );
    */

    ?>
    <?php echo $this->Html->script('jquery-1.7.2'); ?> 
    <?php echo $this->Html->script('ajaxAccounts'); ?> 

    <!--[if IE 7]>
        <?php
        echo $this->Html->css('font-awesome-ie7.min'); 
        ?>
    <![endif]-->
        <!--[if IE 8]>
            <style type="text/css">
            .navbar-inner{
                filter:none;
            }
         </style>
    <![endif]-->
</head>
<style type="text/css">
    .container{
        max-width: 800px;
    }
</style>
<body class=" ">

    <div class="container">

        <?php echo $this->Session->flash(); ?>
        
        <?php echo $this->fetch('content'); ?>

    </div>

    <?php
    echo $this->Html->script(
                            array(
                                'jquery-1.9.1.min',
                                'bootstrap.min',
                                //'tabs-addon'
                            )
                        );
    ?>

    <?php //echo $this->element('sql_dump'); ?>

</body>

</html>