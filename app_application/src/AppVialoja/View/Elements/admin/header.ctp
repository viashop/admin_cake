<header class="header">

    <a href="" class="logo">
			<!-- Add the class icon to your logo image or logo icon to add the margining -->
		<img src="<?php echo CDN_IMG . "vialoja/logos/admin/default-header.png" ?>">

    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <?php
        if ($this->request->controller !== 'wizard') {
        ?>
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </a>
        <?php
        }
        ?>
        <div class="navbar-right">
            <ul class="nav navbar-nav">

                <!-- user Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="<?php echo VIALOJA_SUPORTE; ?>" target="_blank" title="Central de Ajuda" class="dropdown-toggle">
                        <i class="fa fa-cogs"></i>
                        <span>Central de Ajuda</span>
                    </a>
                </li>

				<li class="dropdown user user-menu">
                    <a href="<?php echo VIALOJA_FORUM; ?>" target="_blank" title="Fórum - Comunidade  de Ajuda!" class="dropdown-toggle">
                        <i class="fa fa-comments"></i>
                        <span>Fórum</span>
                    </a>
                </li>

                <?php
                if ($this->request->controller !== 'wizard') {
                ?>

                    <!-- user Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="<?php

                        printf( VIALOJA_DESK ."/usuario");

                    ?>" title="Tickets de suporte" class="dropdown-toggle">
                            <i class="fa fa-ticket"></i>
                            <span>Tickets de Suporte</span>
                        </a>
                    </li>


                <?php } ?>

                <?php
                /*
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell"></i>
                    <span class="label label-success">5</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="//admin.vialoja.com.br/admin/img/img-themes/avatar3.png" class="img-circle" alt="User Image"/>
                                        </div>
                                        <h4>
                                            Equipe de Suporte
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <p>Por que não comprar um novo tema impressionante?</p>
                                    </a>
                                </li>
                                <!-- end message -->
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="//admin.vialoja.com.br/admin/img/img-themes/avatar2.png" class="img-circle" alt="user image"/>
                                        </div>
                                        <h4>
                                            AdminLTE Design Team
                                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                        </h4>
                                        <p>Por que não comprar um novo tema impressionante?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="//admin.vialoja.com.br/admin/img/img-themes/avatar.png" class="img-circle" alt="user image"/>
                                        </div>
                                        <h4>
                                            Desenvolvedores
                                            <small><i class="fa fa-clock-o"></i> Today</small>
                                        </h4>
                                        <p>Por que não comprar um novo tema impressionante?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="//admin.vialoja.com.br/admin/img/img-themes/avatar2.png" class="img-circle" alt="user image"/>
                                        </div>
                                        <h4>
                                            Departamento De Vendas
                                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                        </h4>
                                        <p>Por que não comprar um novo tema impressionante?</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="//admin.vialoja.com.br/admin/img/img-themes/avatar.png" class="img-circle" alt="user image"/>
                                        </div>
                                        <h4>
                                            Os revisores
                                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                                        </h4>
                                        <p>Por que não comprar um novo tema impressionante?</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">Veja todas as mensagens</a></li>
                    </ul>
                </li>
                */?>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell"></i>
                    <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu dropdown-notifications-corrects">
                        <li class="header">Você tem 10 notificações</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                    <i class="ion ion-ios7-people info"></i> 5 novos membros juntaram-se hoje
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa fa-warning danger"></i> Muito longa descrição aqui que pode não caber na página e pode causar problemas de design
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="fa fa-users warning"></i> 5 novos membros aderiram
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="ion ion-ios7-cart success"></i> 25 vendas feitas
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                    <i class="ion ion-ios7-person danger"></i> Você mudou seu nome de usuário
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">Ver tudo</a></li>
                    </ul>
                </li>

                <?php
                /*
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-tasks"></i>
                    <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Você tem 9 tarefas</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Projetar alguns botões
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Criar um bom tema
                                            <small class="pull-right">40%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">40% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Alguma tarefa que eu preciso fazer
                                            <small class="pull-right">60%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">60% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                                <li>
                                    <!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Fazer belas transições
                                            <small class="pull-right">80%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">80% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">Ver todas as tarefas</a>
                        </li>
                    </ul>
                </li>
                */
                ?>

                <?php if ( !empty( $this->Session->read('cliente_nome') ) ) : ?>


                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i>


                        <span><?php echo \Lib\Tools::firstName($this->Session->read('cliente_nome')); ?> <i
                                class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="//admin.vialoja.com.br/admin/img/img-themes/avatar3.png" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo \Lib\Tools::firstName($this->Session->read('cliente_nome')); ?> -
                                Empresa
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="/admin/logout" class="btn btn-default btn-flat">Sair com segurança</a>
                            </div>
                        </li>
                    </ul>
                </li>

                 <?php endif ?>
            </ul>
        </div>
    </nav>
</header>