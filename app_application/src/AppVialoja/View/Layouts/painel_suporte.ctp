<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
        <?php echo $title_for_layout ,' - ', 'ViaLoja.com'; ?>
        </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        echo $this->element('favicon');
        echo $this->Html->css(
                            array(
                                'bootstrap.min',
                                'font-awesome.min',
                                'ionicons.min',
                                'AdminLTE',
                                'loading',
                            )
                        );

        ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
       
    </head>
    <body class="skin-green">

        <?php
        echo $this->element('admin'.DS.'header');
        ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <?php
                    App::import('Vendor', 'Company' . DS . 'Common'. DS .'suporte'.DS. $this->params['controller'] .'-sidebar');
                    ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <?php
                    App::import('Vendor', 'Company' . DS . 'Common'. DS .'suporte'. DS .'content-header');
                    ?>
                </section>

                <!-- Main content -->
                <section class="content">

                    <?php
                    //echo $this->Session->flash();
                    echo $this->fetch('content');
                    //App::import('Vendor', 'Company' . DS . 'Common' . DS . 'painel-footer');
                    ?>

                </section><!-- /.content -->

                <footer align="center">
                    <div>Copyright ©<?php echo date('Y'); ?> - ViaLoja - Todos os direitos reservados.</div>
                </footer>
                
            </aside><!-- /.right-side -->


        
        </div><!-- ./wrapper -->

        
         <?php
            echo $this->Html->script(
                array(
                    '//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js',
                    'bootstrap.min',
                    'AdminLTE/app'
                )
            );
        ?>
        
       <!-- Begin Loading api 1.4.4
        ================================================== -->
        <?php
        echo $this->Html->script( '//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js');
        ?>
        <div id="loading">
        <p><?php echo $this->Html->image('ajax-loader.gif', array('alt' => 'Loading')); ?> &nbsp;&nbsp;Processando aguarde...</p>
        </div>
        <script language="javascript" type="text/javascript">
                $(function(){
                    $('#loading').hide();
                    $('#processando').click(function(){
                        $('#loading').show();
                    });
                });
        </script>
        <!-- end Loading -->
        <?php
        /**
        *
        * Editor de texto
        *
        **/
        App::import('Vendor', 'Company' . DS . 'Common'. DS .'editor'. DS .'ckeditor');
        ?>
        
    </body>
</html>