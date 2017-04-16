<html lang="pt-BR">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout ,' - ', $this->Session->read('loja_nome'); ?>
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php
    echo $this->element('favicon');

    echo $this->Html->css(
        array(
            'bootstrapLTE',
            'font-awesome.min',
            'ionicons.min',
            'AdminLTE'
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
    echo $this->element('admin/css-javascript/main');
    echo $this->element('admin/css-javascript/catalogo/troute');
    ?>
</head>

    <body class="skin-green">

        <?php
        echo $this->element('admin/header');
        ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php
            echo $this->element('admin/sidebar');
            ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Main content -->
                <!-- Correção <section class="content"> -->

                <section class="content">
                    <?php
                    echo $this->Session->flash();
                    echo $this->fetch('content');
                    echo $this->element('admin/footer');
                    ?>
                </section>
                <!-- /.content -->
            </aside>
            <!-- /.right-side -->

        </div>
        <!-- ./wrapper -->
        <!-- AdminLTE App -->
        <?php
        echo $this->Html->script(
            array('AdminLTE/app')
        );

        echo $this->element('loading_processando');
        //echo $this->element('sql_dump');
        ?>
    </body>
</html>
