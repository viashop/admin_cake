                    <ul class="breadcrumb">
                        <li>
                            <?php
                            echo $this->Html->link(
                                'Home',
                                '/',
                                array('title' => 'Home')
                            );
                            ?>    
                            <span class="divider"></span>
                        </li>
                        <li>

                            <?php
                            echo $this->Html->link(
                                'Tickets de Suporte',
                                '/ticket',
                                array('title' => 'Ticket')
                            );
                            ?>
                            <span class="divider"></span>
                        </li>
                        <li class="active">Listar tickets</li>
                    </ul>
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $this->Session->flash(); ?>
    
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <h5>Bem-vindo à sua Área do Cliente. Na Área do Cliente você poderá visualizar e atualizar seus dados, ver detalhes de seus produtos/serviços e domínios, enviar tickets de suporte e solicitar Produtos/Serviços adicionais.</h5>
                            </div>
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><strong><?php echo $total; ?></strong> Tickets de Suporte abertos</h3>
                                </div><!-- /.box-header -->
                                <div>
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a href="/suporte/ticket/enviarticket/" title="Enviar ticket"><i class="fa fa-mail-forward"></i> Enviar ticket</a></li>
                                    </ul>
                                </div>
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="bg-light-blue" style="width: 90px">TICKET-ID</th>
                                            <th class="bg-light-blue" style="width: 30px">Departamento</th>
                                            <th class="bg-light-blue" style="width: 120px">Data</th>
                                            <th class="bg-light-blue">Assunto</th>
                                            <th class="bg-light-blue " style="width: 40px; text-align:center;">Status</th>
                                            <th class="bg-light-blue" style="width: 40px">Prioridade</th>
                                        </tr>
                                        <?php
                                        if( ! \Respect\Validation\Validator::notBlank()->validate( $results ) ){
                                            echo '<tr>
                                                    <td colspan="6" align="center">Nenhum ticket encontrado</td>
                                                </tr>';

                                        } else {

                                            foreach ($results as $ticket) {
                                               
                                                # code...
                                                echo '<tr>';

                                                echo '<td><a href="/suporte/ticket/ticketid/'. $ticket['Ticket']['hash'] .'">'. $ticket['Ticket']['id'] .'</a></td>';

                                                if($ticket['Ticket']['departamento_id'] == 1){
                                                    echo '<td>'. \Lib\Tools::getDepartamentoTicket( $ticket['Ticket']['departamento_id'] )  .'</td>';
                                                } elseif($ticket['Ticket']['departamento_id'] == 2){
                                                    echo '<td>'. \Lib\Tools::getDepartamentoTicket( $ticket['Ticket']['departamento_id'] )  .'</td>';
                                                } elseif ($ticket['Ticket']['departamento_id'] == 3){
                                                    echo '<td>'. \Lib\Tools::getDepartamentoTicket( $ticket['Ticket']['departamento_id'] )  .'</td>';
                                                }

                                                $date = new \DateTime($ticket['Ticket']['created']);
                                                echo '<td>'. $date->format('d/m/Y H:i') .'</td>';
                                                if( $ticket['Ticket']['ler'] == 0){
                                                    echo '<td><i class="fa fa-eye-slash"></i> <a href="/suporte/ticket/ticketid/'. $ticket['Ticket']['hash'] .'"><strong>'. $ticket['Ticket']['assunto'] .'</strong></a></td>';
                                                } else {
                                                    echo '<td><i class="fa fa-eye"></i> <a href="/suporte/ticket/ticketid/'. $ticket['Ticket']['hash'] .'">'. $ticket['Ticket']['assunto'] .'</a></td>';
                                                }

                                                echo '<td align="center">';
                                                if( $ticket['Ticket']['status'] == 0){
                                                    echo '<span class="label label-success">';
                                                    echo \Lib\Tools::getStatusTicket($ticket['Ticket']['status'] );
                                                    echo '</span>';
                                                } elseif ($ticket['Ticket']['status'] == 1) {
                                                    echo '<span class="label label-warning">';
                                                    echo \Lib\Tools::getStatusTicket($ticket['Ticket']['status'] );
                                                    echo '</span>';
                                                } elseif ($ticket['Ticket']['status'] == 2) {
                                                    echo '<span class="label label-primary">';
                                                    echo \Lib\Tools::getStatusTicket($ticket['Ticket']['status'] );
                                                    echo '</span>';
                                                } elseif ($ticket['Ticket']['status'] == 3) {
                                                    echo '<span class="label label-default">';
                                                    echo \Lib\Tools::getStatusTicket($ticket['Ticket']['status'] );
                                                    echo '</span>';
                                                }
                                                echo '</td>';

                                                echo '<td align="center">';
                                                if( $ticket['Ticket']['prioridade'] == 0){
                                                    echo '<span class="label label-default">';
                                                    echo \Lib\Tools::getPrioridadeTicket( $ticket['Ticket']['prioridade'] );
                                                    echo '</span>';
                                                } elseif ($ticket['Ticket']['prioridade'] == 1) {
                                                    echo '<span class="label label-warning">';
                                                    echo \Lib\Tools::getPrioridadeTicket( $ticket['Ticket']['prioridade'] );
                                                    echo '</span>';
                                                } elseif ($ticket['Ticket']['prioridade'] == 2) {
                                                    echo '<span class="label label-danger">';
                                                    echo \Lib\Tools::getPrioridadeTicket( $ticket['Ticket']['prioridade'] );
                                                    echo '</span>';
                                                }

                                                echo '</td>';

                                                echo '</tr>';
                                            }

                                        }

                                        ?>
                                    </table>
                                </div><!-- /.box-body -->

                            </div><!-- /.box -->

                            <div class="box-footer clearfix">
                                <ul class="pagination">
                                    <?php 
                                        echo $this->Paginator->numbers( array( 'modulus' => '2', 'tag' => 'li', 'first'=>'Início', 'separator' => '', 'currentClass' => 'active', 'currentTag' => 'a', 'last'=>'Último'  ) );
                                    ?>
                                </ul>
                            </div>

                        </div><!-- /.col -->
                    </div><!-- /.row -->