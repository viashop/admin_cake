<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->element('favicon');

    echo $this->Html->css(
        array(
            'bootstrapLTE',
            'font-awesome.min',
            'AdminLTE',
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


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.jss/1.3.0/respond.min.js"></script>
    <![endif]-->

    <?php
    echo $this->element('admin/css-javascript/wizard');
    ?>

</head>

    <body class="skin-green wizard envio">

        <?php
        echo $this->element('admin/header');
        ?>

        <div class="content">
            <!-- Main content -->

            <?php
            echo $this->Session->flash();
            echo $this->fetch('content');
            ?>
            <!-- /.content -->

        </div>
        <!-- ./wrapper -->
        <!-- AdminLTE App -->

        <?php
        echo $this->Html->script(
            array('AdminLTE/app')
        );

        echo $this->element('loading');
        //echo $this->element('sql_dump');
        ?>
    </body>
</html>
