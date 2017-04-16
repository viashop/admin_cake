<div class="admin index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-xs-6 col-sm-4">

          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-flag-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Prioridade Alta</span>
              <span class="info-box-number">410</span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->

        </div>

          <div class="col-xs-6 col-sm-4">

            <div class="info-box">
                <span class="info-box-icon bg-orange"><i class="fa fa-flag-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Prioridade Média</span>
                  <span class="info-box-number">410</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->


          </div>
   

          <div class="col-xs-6 col-sm-4">

            <div class="info-box">
                <span class="info-box-icon bg-darkgray  -yellow"><i class="fa fa-flag-o"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Prioridade Baixa</span>
                  <span class="info-box-number">410</span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->


          </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-ticket"></i>
                    <h3 class="box-title">Tickets Ativos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="todo-list">

                        <?php if (count($ticketAtivo) <=0): ?>

                            Não há tickets ativos.

                        <?php else: ?>

                            <?php foreach ($ticketAtivo as $ticket): ?>

                            <li>
                                <span class="text">
                                <a href='/ticket/view/<?= $this->Number->format($ticket->id) ?>'>
                                #<?= $this->Number->format($ticket->id) ?> <?= $ticket['Conteudo']['assunto'] ?></a>
                                </span>

                                <?php if ($ticket['Status']['id'] == '1'): ?>

                                    <small class='badge bg-green'>
                                        <?= $ticket['Status']['status']  ?>
                                    </small>

                                <?php elseif ($ticket['Status']['id'] == '2' || $ticket['Status']['id'] == '3'): ?>

                                    <small class='badge bg-orange'>
                                        <?= $ticket['Status']['status']  ?>
                                    </small>

                                <?php endif ?>


                                <small class='badge bg-gray'>
                                    <?= $ticket['Departamento']['departamento']  ?>
                                </small>

                                <?php if ($ticket['Prioridade']['id'] == '1'): ?>

                                    <small class='badge bg-darkgray '>
                                        <?= $ticket['Prioridade']['prioridade']  ?>
                                    </small>

                                <?php elseif ($ticket['Prioridade']['id'] == '2'): ?>

                                    <small class='badge bg-orange'>
                                        <?= $ticket['Prioridade']['prioridade']  ?>
                                    </small>

                                <?php elseif ($ticket['Prioridade']['id'] == '3'): ?>

                                    <small class='badge bg-red'>
                                        <?= $ticket['Prioridade']['prioridade']  ?>
                                    </small>

                                <?php endif ?>

                                <small><?= $calc->calculaTempo($ticket->acao_datetime) ?></small>

                                <div class="tools">
                                    <a href='?route=tickets/manage&id=60' class='btn-right text-dark'><i class='fa fa-eye'></i></a>&nbsp;                                       <a href='#' onClick='showM("?modal=tickets/edit&reroute=dashboard&routeid=&id=60&section=");return false' class='btn-right text-dark'><i class='fa fa-edit'></i></a>&nbsp;                                      <a href='#' onClick='showM("?modal=tickets/delete&reroute=dashboard&routeid=&id=60&section=");return false' class='btn-right text-red'><i class='fa fa-trash-o'></i></a>
                                </div>
                            </li>

                            <?php endforeach; ?>

                        <?php endif ?>

                    </ul>
                </div>
                <div class="box-footer clearfix no-border">
                    <a onClick='showM("?modal=tickets/add&reroute=dashboard&routeid=&section=");return false' data-toggle="modal" class="btn btn-primary btn-sm pull-right"><i class="fa fa-ticket"></i> NEW TICKET</a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-ticket"></i>
                    <h3 class="box-title">Tickets Fechados</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="todo-list">

                        <?php if (count($ticketFechado) <=0): ?>

                            Não há tickets fechados.

                        <?php else: ?>

                            <?php foreach ($ticketFechado as $ticket): ?>

                            <li>
                                <span class="text"><a href='?route=tickets/manage&id=60'>#<?= $this->Number->format($ticket->id) ?> <?= $ticket['Conteudo']['assunto'] ?></a></span>

                                <small class='badge bg-midnightblue'>
                                    <?= $ticket['Status']['status']  ?>
                                </small>

                                 <small class='badge bg-gray'>
                                    <?= $ticket['Departamento']['departamento']  ?>
                                 </small>

                                <small><?= $calc->calculaTempo($ticket->acao_datetime) ?></small>

                                <div class="tools">
                                    <a href='?route=tickets/manage&id=60' class='btn-right text-dark'><i class='fa fa-eye'></i></a>&nbsp;                                       <a href='#' onClick='showM("?modal=tickets/edit&reroute=dashboard&routeid=&id=60&section=");return false' class='btn-right text-dark'><i class='fa fa-edit'></i></a>&nbsp;                                      <a href='#' onClick='showM("?modal=tickets/delete&reroute=dashboard&routeid=&id=60&section=");return false' class='btn-right text-red'><i class='fa fa-trash-o'></i></a>
                                </div>
                            </li>

                            <?php endforeach; ?>

                        <?php endif ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-xs-12">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>3</h3>
                        <p>Aguardando Resposta</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-circle-o"></i>
                    </div>
                    <a href="?route=tickets/ar" class="small-box-footer">Visualizar todos <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>34</h3>
                        <p>Tickets Ativos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-dot-circle-o"></i>
                    </div>
                    <a href="?route=tickets/active" class="small-box-footer">Visualizar todos <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>62</h3>
                        <p>Todos os Tickets</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-circle"></i>
                    </div>
                    <a href="?route=tickets/all" class="small-box-footer">Visualizar todos <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>37</h3>
                        <p>Usuarios Registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="?route=people/users" class="small-box-footer">Visualizar todos <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>